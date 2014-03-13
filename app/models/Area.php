<?php
class Area extends BaseModel
{
	protected $table = 'areas';
	
	public static $rules = array(
				'title' => 'Required',
		);
	
	public function test()
	{
		return $this->hasMany('Test');
	}
	
	public function organization()
	{
		return $this->belongsTo('Organization');
	}
}