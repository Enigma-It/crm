<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestDepartment extends Model
{
   	protected $table ='test_department';
    protected $fillable = ['name', 'status'];

    public function getAllTestName()
    {
        return $this->hasMany('App\Models\PathologyTest','test_dept_id','id');
    }
}
