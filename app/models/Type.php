<?php

class Type extends Eloquent
{
	protected $table = 'types';
	
	public function tests()
	{
		return $this->belongsToMany('Test');
	}
}