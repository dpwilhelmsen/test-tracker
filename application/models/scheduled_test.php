<?php
use Laravel\Auth\Drivers\Eloquent;

class Scheduled_Test extends Eloquent
{
	public function session()
	{
		return $this->belongs_to('Session');
	}
	
	public function test()
	{
		return $this->has_one('Test');
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