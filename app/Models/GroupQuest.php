<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupQuest extends Model
{
    protected $table = 'group_quest';

    public function quest() {
		return $this->belongsTo('App\Quest');
	}

	
}
