<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    public function course() {
    	return $this->belongsTo('App\Course');
    }
}
