<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthPackage extends Model
{
    protected $table = "health_package";
    protected $fillable = ['package_type','test_id','life_insurance','health_insurance','hospital_price','yearly_price'];
}
