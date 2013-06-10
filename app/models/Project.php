<?php
class Project extends Eloquent
{
	protected $table = 'projects';
	
	public function tests()
	{
		return $this->belongsToMany('Test');
	}
	
	public function sessions()
	{
		return $this->hasMany('TestSession');
	}
}