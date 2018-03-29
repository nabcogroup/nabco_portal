<?php

namespace Libs\Supports;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


/*******
*
 * Result
 * Version 2.0
 *
 */
class Result
{
    public static function ok($message = '',$data = []) {

        return [
            'isOk'      => true,
            'message'   => $message,
            'data'      =>  $data
        ];
    }



    public static function response($data = array()) {

        //turn to camelCase
        return response()->json($data,200);
    }

    public static function jsonOk($message = '',$data = []) {
        $result = [
            'isOk'      => true,
            'message'   => $message,
            'data'      =>  $data
        ];

        //turn to camelCase
        return response()->json($result,200);
    }

    public static function jsonResponse($data = array(),$message = '',$isOk = true) {

        $result = [
            'isOk'      =>  $isOk,
            'message'   =>  $message,
            'data'      =>  $data,

        ];

        //turn to camelCase
        return response()->json($result,200);
    }

    public static function badRequest($errors = array()) {

        return new JsonResponse($errors,500);

    }

    public static function badRequestWeb($exception) {

        return Response::view('errors.500',compact('exception'))->header('Content-Type', "text/html");

    }
}