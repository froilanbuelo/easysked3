<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitee extends Model
{
    public function appointment(){
    	return $this->belongsTo(Appointment::class);
    }
}
