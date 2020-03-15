<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosticPatientTest extends Model
{
    protected $table = 'diagnostic_patient_test';
    protected $fillable = ['patient_id','diagnostic_id','test_id','quantity','test_amount','test_delivery_date','test_delivery_time','progress_status','collection_status'];
}
