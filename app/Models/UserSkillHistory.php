<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSkillHistory extends Model
{
    public function skills() {
    	return $this->hasMany('App\Skill');    	
    }

    public function users() {
    	return $this->hasMany('App\User');    	
    }

    public function submissions() {
    	return $this->hasMany('App\Submission');    	
    }


}
