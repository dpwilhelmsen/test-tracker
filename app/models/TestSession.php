<?php
class TestSession extends Eloquent
{
	protected $table = 'test_sessions';
	
	public function user()
	{
		return $this->belongsTo('User');
	}
	public function project()
	{
		return $this->belongsTo('Project');
	}
	
	public function tests()
	{
		return $this->hasMany('ScheduledTest', 'session_id');
	}
}