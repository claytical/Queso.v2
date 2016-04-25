<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
	public function course() {
		return $this->belongsTo('App\Course');
	}

    public function redemption_codes() {
  		return $this->hasMany('App\Redemption');
    }

    public function submissions() {
    	return $this->hasMany('App\Submission');
    }

    public function users() {
    	return $this->belongsToMany('App\User');
    }

    public function type() {
    	return $this->hasOne('App\QuestType');
    }

    public function skills() {
    	return $this->belongsToMany('App\Quest')->withPivot('amount');
    }

    public function thresholds() {
    	return $this->hasMany('App\Threshold');
    }

}
