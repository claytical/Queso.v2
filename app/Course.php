<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function users() {
    	return $this->belongsToMany('App\Models\Access\User\User');

    }
    
    public function scopeActive($query)
    {
        return $query->where('active', '=', 1);
    }

    public function user_quests() {
        return $this->hasManyThrough('App\Models\Access\User\User', 'App\Quest');
    }

    public function announcements() {
        return $this->hasMany('App\Announcement');
    }

    public function feedback_requests() {
        return $this->hasMany('App\FeedbackRequest');
    }

    public function tags() {
        return $this->hasManyThrough('App\Tag', 'App\Content');
    }

    public function content() {
        return $this->hasMany('App\Content');
    }
    
    public function files() {
        return $this->hasMany('App\FileAttachment');
    }

    public function teams() {
    	return $this->hasMany('App\Team');
    }
    

/*
    public function teams() {
        return $this->hasMany('App\Team');
    }
  */  
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
