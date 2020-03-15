<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmptyBoxCollection extends Model
{
    
    protected $table = "empty_box_collection";
    protected $fillable = ['dispatch_date','empty_box_qty','submitted_by','status'];
}
