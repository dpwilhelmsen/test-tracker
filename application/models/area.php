<?php
class Area extends Eloquent
{
	public function test()
	{
		return $this->has_many('Test');
	}
}