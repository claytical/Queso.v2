<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    //
    public function quest() {
  		return $this->hasOne('App\Quest');
    }
}
