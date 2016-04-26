<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function tag() {
    	return $this->hasOne('App\Tag');
    }

    public function course() {
    	return $this->hasOne('App\Course');
    }
}
