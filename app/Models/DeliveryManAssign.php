<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryManAssign extends Model
{
    protected $table = 'delivery_man_assign';
    protected $fillable = ['delivery_man_id','agent_id','franchise_id'];
}
