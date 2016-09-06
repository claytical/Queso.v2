<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Content extends Model
{
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function course() {
    	return $this->hasOne('App\Course');
    }

    public function files() {
    	return $this->belongsToMany('App\FileAttachment');
    }
}
