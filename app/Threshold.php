<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Threshold extends Model
{
    public function quest()
    {
        return $this->belongsTo('App\Quest');
    }

    public function skill()
    {
        return $this->belongsTo('App\Skill');
    }


}
