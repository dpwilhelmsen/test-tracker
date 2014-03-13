<?php
class ScheduledTest extends BaseModel
{
	protected $table = 'scheduled_tests';
	public $includes = array('test');
	public static $rules = array(
			'session' => 'required|is_a:Session',
			'test' => 'required|is_a:Test',
			'status' => 'required',
	);
	
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