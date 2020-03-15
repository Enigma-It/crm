<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';
    protected $fillable = ['first_name', 'last_name', 'department', 'phone_no', 'gender', 'marital_status', 'blood_group', 'dob', 'joining_date', 'work_experience', 'present_address', 'permanent_address', 'biography', 'specialist', 'educational_qualification', 'image', 'attachments', 'status', 'email', 'password', 'checkup_slot_period', 'new_patient_visit', 'old_patient_visit', 'appointment_details', 'appointment_day_slot_schedule'];
}
