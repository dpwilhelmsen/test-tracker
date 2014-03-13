<?php
class Project extends BaseModel
{
	protected $table = 'projects';
	
	public static $rules = array(
				'title' => 'required',
		);
	
	public function tests()
	{
		return $this->belongsToMany('Test');
	}
	
	public function sessions()
	{
		return $this->hasMany('TestSession');
	}
	
	public function organization()
	{
		return $this->belongsTo('Organization');
	}
}