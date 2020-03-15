<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentBookingPatient extends Model
{
    protected $table = "appointment_booking_patient";
    protected $fillable = [
        'name', 'contact_number'
    ];
}
