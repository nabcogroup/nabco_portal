<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Libs\Base\BaseModel;

class TicketDetail extends BaseModel
{
    protected $table = "ticket_details";

    public function ticketCosting() {

        return $this->hasMany('App\Models\TicketCosting','ticket_details_id','id');

    }



}
