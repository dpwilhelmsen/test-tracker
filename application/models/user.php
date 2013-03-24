<?php
class User extends BaseModel 
{
	public function completed_sechduled_tests()
	{
		return $this->has_many('Scheduled_Test', 'completed_user');
	}
}