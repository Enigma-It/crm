<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourierSampleCollection extends Model
{
    protected $table = "courier_sample_collection";
    protected $fillable = ['courier_id','collected_date','box_qty','bus_number','supervisor_name','supervisor_contact_number','destination_place','	arriving_place','arriving_time','status'];
}
