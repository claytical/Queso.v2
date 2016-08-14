<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //

    public function user_from() {
    	return $this->hasOne('App\Models\Access\User\User', 'id', 'from_user_id');
    }

    public function user_to() {
    	return $this->hasOne('App\Models\Access\User\User', 'id', 'to_user_id');
    }

    public function quest() {
    	return $this->hasOne('App\Quest');
    }
}
