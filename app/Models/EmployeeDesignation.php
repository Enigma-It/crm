<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDesignation extends Model
{
    protected $table = "employee_designation";

    protected $fillable = [
        'name', 'branch_id'				
    ];
}
