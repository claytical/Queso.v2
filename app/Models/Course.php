<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function users() {
    	return $this->belongsToMany('App\Models\Access\User\User')->withPivot('instructor', 'active');

    }

    public function announcements() {
        return $this->hasMany('App\Announcement');
    }

    public function tags() {
        return $this->hasManyThrough('App\Tag', 'App\Content');
    }

    public function content() {
        return $this->hasMany('App\Content');
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
