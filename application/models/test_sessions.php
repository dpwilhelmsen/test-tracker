<?php
class Test_Session extends Eloquent
{
	public function user()
	{
		return $this->belongs_to('User');
	}
}