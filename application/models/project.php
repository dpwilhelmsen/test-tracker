<?php
class Project extends Eloquent
{
	public static $timestamps = true;
	public function tests()
	{
		return $this->has_many_and_belongs_to('Test');
	}
}