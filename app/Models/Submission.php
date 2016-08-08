<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    public function quest() {
  		return $this->hasOne('App\Quest');
    }

    public function user() {
    	return $this->belongsTo('App\Models\Access\User');
    }


}
