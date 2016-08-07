<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSkillHistory extends Model
{
    public function skills() {
    	return $this->hasMany('App\Skill');    	
    }

    public function users() {
    	return $this->hasMany('App\Models\Access\User');    	
    }

    public function quests() {
    	return $this->hasManyThrough('App\Quest', 'App\Models\Access\User');
   	}

}
