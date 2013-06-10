<?php
class Test extends Eloquent
{
	protected $table = 'tests';
	
	public function scheduled_tests()
	{
		return $this->belongsTo('Scheduled_Test');
	}
	
	public function sessions()
	{
		
	}
	
	public function types()
	{
		return $this->belongsToMany('Type');
	}
	
	public function area()
	{
		return $this->belongsTo('Area');
	}
	
	public function projects()
	{
		return $this->belongsToMany('Project');
	}
	
	public function user()
	{
		return $this->belongsToMany('User');
	}
}