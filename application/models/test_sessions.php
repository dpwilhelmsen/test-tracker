<?php
class Test_Session extends BaseModel
{
	public function user()
	{
		return $this->belongs_to('User');
	}
	public function project()
	{
		return $this->belongs_to('Project');
	}
	
	public function tests()
	{
		return $this->has_many('Scheduled_Test', 'session_id');
	}
}