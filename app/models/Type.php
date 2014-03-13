<?php

class Type extends BaseModel
{
	protected $table = 'types';
	public static $rules = array(
		'title' => 'Required',
	);
	
	
	public function tests()
	{
		return $this->belongsToMany('Test');
	}
	
	public function organization()
	{
		return $this->belongsTo('Organization');
	}
}