<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public function appointmentType(){
    	return $this->belongsTo(AppointmentType::class);
    }
    public function invitees(){
    	return $this->hasMany(Invitee::class);
    }
}
