<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosticPatient extends Model
{
    protected $table = 'diagnostic_patient';
    protected $fillable = ['refd_by','created_by','patient_name','patient_age','patient_phone','patient_gender','date','patient_id','total_amount','discount','payable_amount','receive_amount','due_amount','discount_amount'];							
}
