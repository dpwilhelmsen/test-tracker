<?php
class Scheduled_Test extends BaseModel
{
	public static $table = 'scheduled_tests';
	public $includes = array('test');
	
	public function session()
	{
		return $this->belongs_to('Session');
	}
	
	public function test()
	{
		return $this->belongs_to('Test');
	}
	
	public function completed_user()
	{
		return $this->belongs_to('User', 'completed_user');
	}
	
	public function defects()
	{
		return $this->has_many('Defects');
	}
}