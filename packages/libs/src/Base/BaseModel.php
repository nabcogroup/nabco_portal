<?php

namespace Libs\Base;

use Illuminate\Database\Eloquent\Model;


class BaseModel extends Model {
    

    public function toMap($fields = array()) {
        if(sizeof($fields) > 0) {
            foreach ($fields as $key => $value) {
                if($this->isFillable($key) && !in_array($key,$this->appends)) {
                    $this->{$key} = $value;
                }
            }
        }
        return $this;
    }

    public function createNewId() {

        $lastRecord = $this->orderBy('id','desc')->first();
        if($lastRecord == null)
            return 1;

        return $lastRecord->id++;
    }

    
}

