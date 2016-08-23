<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{

	public function course() {
		return $this->belongsTo('App\Course');
	}

    public function quests() {
    	return $this->belongsToMany('App\Quest')->withPivot('amount');;
    }

    public function users() {
    	return $this->belongsToMany('App\Models\Access\User')->withPivot('quest_id', 'amount');    	
    }

    public function thresholds() {
    	return $this->hasMany('App\Theshold');
    }

    public function history() {
    	return $this->hasMany('App\UserSkillHistory');
    }

}
