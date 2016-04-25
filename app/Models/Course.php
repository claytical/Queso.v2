<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function users() {
    	return $this->belongsToMany('App\User')->withPivot('instructor', 'active');

    }
    
    public function teams() {
    	return $this->hasManyThrough('App\Team', 'App\User');
    }

    public function skills() {
    	return $this->hasMany('App\Skill');
    }

    public function quests() {
    	return $this->hasMany('App\Quest');

    }

    public function levels() {
    	return $this->hasMany('App\Level');
    }

    public function submissions() {
    	return $this->hasManyThrough('App\Submission', 'App\Quest');
    }


}
