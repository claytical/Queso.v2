<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupQuest extends Model
{
    protected $table = 'group_quest';

    public function quest() {
		return $this->belongsTo('App\Quest');
	}

	public function users() {
		return $this->belongsToMany('App\Models\Access\User\User', 'group_quest_users', 'group_quest_id', 'user_id');

	}
}
