<?php
class Area extends Eloquent
{
	protected $table = 'areas';
	
	public function test()
	{
		return $this->hasMany('Test');
	}
}