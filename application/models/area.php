<?php
class Area extends Eloquent
{
	public function test()
	{
		return has_many_and_belongs_to('Test');
	}
}