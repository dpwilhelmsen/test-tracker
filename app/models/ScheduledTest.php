<?php
class ScheduledTest extends Eloquent
{
	protected $table = 'scheduled_tests';
	public $includes = array('test');
	
	public function session()
	{
		return $this->belongsTo('Session');
	}
	
	public function test()
	{
		return $this->belongsTo('Test');
	}
	
	public function completed_user()
	{
		return $this->belongsTo('User', 'completed_user');
	}
}