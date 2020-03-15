<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PathologyTest extends Model
{
    protected $table ='pathology_test';
    protected $fillable = ['test_name', 'short_name' ,'test_dept_id','total_price','specimen','fr_price','pr_price','status','delivery_day','is_health_card'];

    public function getTestDept(){
    	return $this->hasOne('App\Models\TestDepartment','id','test_dept_id');
    }
}
