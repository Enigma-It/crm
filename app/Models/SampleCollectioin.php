<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleCollectioin extends Model
{
    protected $table ='sample_delivery';
    protected $fillable = ['delivery_id','franchise_id','sample_qty','sample_status'];
}
