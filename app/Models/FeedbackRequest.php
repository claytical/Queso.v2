<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackRequest extends Model
{
    //
    public function quest() {
        return $this->hasOne('App\Quest');
    }

    public function course() {
    	return $this->hasOne('App\Course');
    }

    public function user() {
    	return $this->hasOne('App\Models\Access\User\User');
    }

    public function sender() {
    	return $this->hasOne('App\Models\Access\User', 'from_user_id');
    }
}
