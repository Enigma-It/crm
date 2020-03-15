<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employees";
    protected $fillable = ['name','email','phone_no','division_id','district_id','thana_id','designation_id','present_address','permanent_address','monthly_salary','joining_date','resign_date','image','status','branch_id', 'user_type','employee_id'];


    public function getType()
    {
        return $this->hasOne('App\Models\UserType','id','user_type');
    }
    public function getDesignation()
    {
        return $this->hasOne('App\Models\EmployeeDesignation','id','designation_id');
    }
    public function divisionName()
    {
        return $this->hasOne('App\Models\Division','id','division_id');
    }
    public function districtName()
    {
        return $this->hasOne('App\Models\District','id','district_id');
    }
    public function thanaName()
    {
        return $this->hasOne('App\Models\Thana','id','thana_id');
    }
    
}
