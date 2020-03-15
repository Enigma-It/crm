<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorAppointment extends Model
{
     protected $table = 'doctor_appointments';
     protected $fillable = ['doctor_id', 'patient_name', 'phone', 'email', 'apt_date', 'apt_time', '	sex'];

     public function getDoctorName(){
     	return $this->hasOne('App\Models\Doctor','id','doctor_id');
     }
}
