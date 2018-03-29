<?php
/**
 * Created by PhpStorm.
 * User: arnold.mercado
 * Date: 3/25/2018
 * Time: 4:41 PM
 */

namespace App\Http\Controllers\Traits;


use http\Env\Request;

trait UserFilterRequest
{
    public function documentUserFilter(Request $request,&$user) {

        $data = $request->all();

        if($user->isUserRole()) {
            $data['requestor_id'] = $user->employee_id;
        }

        return $data;
    }
}