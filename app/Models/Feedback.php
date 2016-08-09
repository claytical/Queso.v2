<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //

    public function user_from() {
    	return $this->belongsToMany('App\Models\Access\User\User', 'from_user_id');
    }

    public function user_to() {
    	return $this->belongsToMany('App\Models\Access\User\User', 'to_user_id');
    }

    public function quest() {
    	return $this->hasOne('App\Quest');
    }
}
