<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = "patients";
    protected $fillable = [
        'patient_id', 'patient_name', 'guardian_name', 'gender', 'phone_no', 'image', 'email', 'address', 'blood_group', 'register_date', 'patient_case', 'status','nationality','religion','guardian_phn'    
    ];
}
