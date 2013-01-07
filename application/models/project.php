<?php
class Project extends Eloquent
{
	public static $timestamps = true;
	
	public function tests()
	{
		return $this->has_many_and_belongs_to('Test');
	}
	
	public function sessions()
	{
		return $this->has_many('Test_Session');
	}
	
	public function active_sessions()
	{
		return $this->sessions()->where_status('active');
	}
	
	public function completed_sessions()
	{
		return $this->sessions()->where_status('completed');
	}
}