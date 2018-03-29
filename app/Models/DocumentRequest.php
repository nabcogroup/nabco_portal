<?php

namespace App\Models;

use App\Models\LeaveForm;
use App\Models\Traits\DocumentMaker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Libs\Base\BaseModel;

class DocumentRequest extends BaseModel
{

    use DocumentMaker;

    protected $table = "document_requests";

    protected $request = false;

    protected $fillable = ["doc_type","requestor_id","doc_no"];

    protected $hidden = ["requestor_id"];

    protected $attributeTempForm = [];

    public static function createDocumentInstance($options) {

        if(is_array($options)) {
            $document = new DocumentRequest($options);
        }
        else {
            $document = new DocumentRequest();
            $document->createDocument($options);
        }

        return $document;
    }


    public function __construct(array $attributes = [])
    {

        if(count($attributes) > 0) {
            $this->attributeTempForm = $attributes['form'];
        }

        parent::__construct($attributes);
    }



    public function isAnyViolation() {

        $violation = false;


        //create rule
        if($this->id == null) {

            if($this->attributes['doc_type'] == hash('md5','leave')) {
                //check if any pending
                $count = LeaveForm::where('employee_id',$this->attributes['requestor_id'])->where('status','pending')->count();
                $violation = ($count > 0) ? true : false;
            }
        }

        return $violation;
    }


    public function save(array $options = [])
    {
        $create = false;

        if($this->id == null) {

            $this->attributes['doc_no'] = $this->createDocumentNo();

            $create = true;

        }

        $save = parent::save($options); // TODO: Change the autogenerated stub

        if($create) {

            $this->attributeTempForm['status'] = 'pending';

            $this->document()->create($this->attributeTempForm);

        }

        return $save;

    }

    public function getWithDocumentForm() {

        $this->attributes['form'] = $this->document()->first();

        return $this;
    }


    public function scopeGetDocument($query,$docNo) {

        return $query->where('doc_no',$docNo)->first();
    }

    public function scopeGetByRequestor($query,$requestor_id) {
        return $query->where('requestor_id',$requestor_id);
    }



}