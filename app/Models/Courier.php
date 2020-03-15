<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $table = "couriers";
    protected $fillable = ['courier_type','name','email','phone','address','courier_commision'];
}
