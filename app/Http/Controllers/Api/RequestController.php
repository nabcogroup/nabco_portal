<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Traits\UserFilterRequest;
use App\Models\DocumentRequest;
use App\Models\Employee;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Libs\Supports\Result;

class RequestController extends Controller
{

    public function index(Request $request)
    {

        //portal
        //supervisor
        //hr
        $requestDocuments = DocumentRequest::getByRequestor($request->user()->employee_id)
            ->with([
                'leaveForm' => function($query) {
                    $query->with('employee');
                }
                ])->get();

        return Result::jsonResponse($requestDocuments);
    }

    /************************************
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @TODO: create a new document base on document type
     *
     * /************************************/
    public function create(Request $request)
    {

        $userInit = $this->getUserInfo($request);

        $requestDoc = DocumentRequest::createDocumentInstance($userInit['doc_type']);

        //attach employee
        $requestDoc->form->employee = $userInit['employee'];

        $requestDoc->config = $userInit['config'];

        return Result::jsonResponse($requestDoc);

    }

    public function store(Request $request)
    {

        //check user capability
        $data = $this->extractDataAndSetUserAuthority($request);

        //validation here....
        $validator = $this->validateDocumentRequest($data);

        if ($validator->fails()) {
            return Result::badRequest(["error" => $validator->errors()]);
        }
        //************************************************
        $document = DocumentRequest::createDocumentInstance($data);
        //check if there's any pending
        if ($document->isAnyViolation()) return Result::badRequest(["error" => "You still have pending vacation"]);

        //create
        $document->save();

        return Result::jsonOk(["message" => "Success"]);


    }


    public function show(Request $request)
    {

        $docNo = $request->get('doc_no');

        $document = DocumentRequest::getDocument($docNo)->getWithDocumentForm();

        return Result::jsonResponse($document);

    }


    protected function validateDocumentRequest($request)
    {

        $rules = DocumentRequest::createDocumentRule($request['doc_type']);

        $validator = Validator::make($request['form'], $rules);

        $validator->after(function ($validator) use ($request) {
            if (!DocumentRequest::isValidDocument($request['doc_type'])) {
                $validator->errors()->add('form', 'No valid document');
            }
        });

        return $validator;

    }




    /***************************************
     * @TODO put user id on leave form id
     *************************/
    protected function extractDataAndSetUserAuthority(Request $request)
    {

        $user = $request->user();

        $data = $request->all();

        if($user->isUserRole()) {
            //add employee id
            $data['requestor_id'] = $user->employee_id;
            $data['form']['employee_id'] = $user->employee_id;
        }

        return $data;
    }


    protected function getUserInfo(Request $request)
    {
        $doc = [];

        $employee = Employee::findOrFail($request->user()->employee_id);

        //check if user is only access for portal
        if ($request->user()->isUserRole()) {
            $doc = [
                "doc_type"      =>  "leave",
                "employee"   =>     $employee,
                "config"        => [
                    "access_only"   =>  "portal"
                ]
            ];
        }

        return $doc;
    }

    protected function allowedAccessTo() {

    }
}
