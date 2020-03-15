<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentBooking extends Model
{
    protected $table = "appointment_booking";
    protected $fillable = [
        'date', 'time', 'booking_patient_id', 'doctor_id', 'status', 'visit_payment'
    ];
}
