<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileAttachment extends Model
{
    //
    public function user() {
        return $this->hasOne('App\Models\Access\User');
    }

    public function course() {
    	return $this->hasOne('App\Course');
    }
}
