<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Libs\Base\BaseModel;

class LeaveForm extends BaseModel
{
    protected $table = "leave_forms";

    protected $fillable = ["employee_id", "leave_start","no_of_days","purpose","country_of_destination","person_contact_no","person_to_contact","place_to_stay",
                            "travel_date","joined_date","resources","remarks","status"];

    protected $hidden = ["request_id"];

    protected $appends = ["leave_end"];

    public function header() {
        return $this->belongsTo('App\Models\DocumentRequest','document_requests_id','id');
    }

    public function employee() {
        return $this->belongsTo('App\Models\Employee','employee_id','id');
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }


    public function setLeaveStartAttribute($value)
    {
        if ($value instanceof Carbon) {

            $this->attributes['leave_start'] = $value->toDateString();
        } else {

            $this->attributes['leave_start'] = Carbon::parse($value)->toDateString();
        }
    }

    public function setTravelDateAttribute($value) {
        if ($value instanceof Carbon) {
            $this->attributes['travel_date'] = $value->toDateString();
        }
        else {
            $this->attributes['travel_date'] = Carbon::parse($value)->toDateString();
        }
    }

    public function getLeaveEndAttribute($key)
    {
        return Carbon::parse($this->attributes['leave_start'])->addDay($this->attributes['no_of_days'] ?? 0)->toDateString();
    }

    public function setJoinedDateAttribute($value) {
        if ($value instanceof Carbon) {
            $this->attributes['joined_date'] = $value->toDateString();
        }
        else {
            $this->attributes['joined_date'] = Carbon::parse($value)->toDateString();
        }
    }


    public function setToPending() {
        $this->attributes['status'] = 'pending';
    }

    public function setToConfirm() {
        $this->attributes['status'] = 'confirmed';
    }

    public function setToCancel() {
        $this->attributes['status'] = 'cancel';
    }

    public function save(array $options = [])
    {



        //calculate no of days;

        //default status is pending


        return parent::save($options); // TODO: Change the autogenerated stub
    }
}
