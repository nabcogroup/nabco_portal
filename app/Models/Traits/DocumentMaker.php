<?php
/**
 * Created by PhpStorm.
 * User: arnold.mercado
 * Date: 3/24/2018
 * Time: 9:16 PM
 */

namespace App\Models\Traits;


use App\Models\LeaveForm;
use Carbon\Carbon;

trait DocumentMaker
{

    public function createDocument($request_type) {

        $init = [];

        if($request_type == 'leave') {
            $init = [
                'leave_start'               =>  Carbon::now(),
                'no_of_days'                =>  0,
                'purpose'                   =>  '',
                'country_of_destination'    =>  '',
                'person_contact_no'         =>  '',
                'person_to_contact'         =>  '',
                'place_to_stay'             =>  '',
                'travel_date'               =>  Carbon::now(),
                'joined_date'               =>  null
            ];
        }

        $this->doc_type = hash('md5',$request_type);

        $this->form = new LeaveForm($init);

    }



    public function document() {

        $doc_type = $this->attributes['doc_type'];
        if($doc_type == hash('md5','leave')) {
            return $this->hasMany('App\Models\LeaveForm','request_id','id');
        }
        return false;
    }

    public function leaveForm() {

        return $this->hasMany('App\Models\LeaveForm','request_id','id');

    }


    public function createDocumentNo() {

        if($this->attributes['doc_type'] == hash('md5','leave')) return "LF-".Carbon::now()->year."-".$this->createNewId();

        return "";
    }

    public static function createDocumentRule($doc_type) {

        if($doc_type == hash('md5','leave')) {
            $rules = [
                "leave_start"   =>  "required|date",
                "no_of_days"    =>  "required|integer",
                "travel_date"   =>  "required|date",
                "country_of_destination"    =>  "required|string",
                "purpose"       =>  "required|string",
            ];
        }
        else {
            $rules = [];
        }

        return $rules;
    }

    public static function isValidDocument($doc_type) {

        if($doc_type == hash('md5','leave')) {
            return true;
        }
        else if($doc_type == hash('md5','ticket')) {
            return true;
        }

        return false;
    }



}