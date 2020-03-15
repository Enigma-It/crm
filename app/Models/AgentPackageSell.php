<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentPackageSell extends Model
{
     protected $table = "health_card_sell";
     protected $fillable = ['org_name','member_name','phone','address','email','age','sex','	package_type','hospital_price','yearly_price','status'];
}
