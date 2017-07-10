<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function content() {
    	return $this->hasMany('App\Content');
    }

}
