<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderdetails extends Model
{
    protected $table = "order_details";
    protected $fillable = ['order_id','item_id','item_type','quantity','unit_cost','total'];
}
