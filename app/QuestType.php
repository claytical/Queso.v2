<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestType extends Model
{
    public function quests() {
    	return $this->hasMany('App\Quest');
    }

}
