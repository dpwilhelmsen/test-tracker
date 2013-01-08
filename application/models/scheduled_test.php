<?php
class Scheduled_Test extends Eloquent
{
	public static $table = 'scheduled_tests';
	public function session()
	{
		return $this->belongs_to('Session');
	}
	
	public function test()
	{
		return Test::where('id', '=', $this->test_id)->first();
	}
	
	public function status()
	{
		
	}
	
	public function completed_user()
	{
		return $this->has_one('User');
	}
	
	public function defects()
	{
		return $this->has_many('Defects');
	}
}