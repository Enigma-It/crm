<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleCollectionMaster extends Model
{
    protected $table ='sample_delivery_master';
    protected $fillable = ['delivery_id','franchise_id','sample_qty'];
}
