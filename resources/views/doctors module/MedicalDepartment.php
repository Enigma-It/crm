<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalDepartment extends Model
{
	protected $table ='medical_department';
    protected $fillable = ['name'];
}
