<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    //
    public function quest() {
  		return $this->hasOne('App\Quest');
    }
    
    public function user() {
    	return $this->HasOne('App\Models\Access\User\User');
    }
}
