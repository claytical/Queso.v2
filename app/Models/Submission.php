<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    public function quest() {
  		return $this->belongsTo('App\Quest');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function history() {
    	return $this->hasMany('App\UserSkillHistory');
    }


}
