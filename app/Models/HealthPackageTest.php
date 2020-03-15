<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthPackageTest extends Model
{
    protected $table = "health_package_price";
    protected $fillable = ['package_type','hospital_price','yearly_price'];
}
