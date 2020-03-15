<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = ['patiant_id','order_id','order_date','order_status','total','pay_type','order_confirm_by','collection_fees','total','is_home_collection','shipping_name','shipping_phone','shipping_address'];
}
