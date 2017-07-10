<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public function quest() {
  		return $this->belongsTo('App\Quest');
    }

    public function user() {
    	return $this->belongsTo('App\Models\Access\User');
    }
    
    public function feedback_to() {
    	return $this->hasManyThrough('App\Feedback', 'App\Quest', 'to_user_id', 'quest_id');
    }

    public function feedback_from() {
    	return $this->hasManyThrough('App\Feedback', 'App\Quest', 'from_user_id', 'quest_id');
    }

}
