<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Libs\Base\BaseModel;

class Role extends BaseModel
{


    public function users() {

        return $this->belongsToMany("App\Models\User",'user_roles','role_id','user_id');

    }
}
