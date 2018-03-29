<?php

namespace App\Models;

use App\Models\ValueObjects\Configuration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Libs\Base\BaseModel;

class Employee extends BaseModel
{

    use SoftDeletes;


    protected $table = "employees";

    protected $fillable = ["employee_no","first_name","last_name","middle_name","nationality","passport","qatar_id","mobile_no","date_joined","configuration","department_id"];

    protected $appends = ['full_name'];

    public function department() {

        return $this->belongsTo('App\Models\Department','department_id','id');

    }


    public static function createInstance() {

        $employee =  Employee();

        $employee->configuration = Configuration::createInstance();

        return $employee;
    }

    public function __construct(array $attributes = [])
    {
        if(count($attributes) > 0) {
            if(isset($attributes->configuration)) {
                $configuration = new Configuration($attributes['configuration']);
                $attributes['configuration'] = $configuration->toSerialize();
            }
            else {
                $attributes['configuration'] = serialize(Configuration::createInstance());
            }
        }


        parent::__construct($attributes);
    }


    public function getFullNameAttribute() {
        return $this->attributes['last_name'] . ' ' . $this->attributes['first_name'];
    }

    public function setDepartment($department_name) {
        $this->department_id = Department::where('name', $department_name)->firstOrFail()->id;
    }


    public function scopeGetByDepartment($query,$department_id) {

        return $query->whereNull('deleted_at')->where('department_id');
    }

    public function scopeGetByNo($query,$emplyee_no) {
        return $query->where('employee_no',$emplyee_no)->first();
    }
}
