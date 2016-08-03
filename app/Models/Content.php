<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Content extends Model implements HasMedia
{

    public function course() {
    	return $this->hasOne('App\Course');
    }
}
