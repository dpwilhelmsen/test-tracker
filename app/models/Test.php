<?php
class Test extends BaseModel
{
	protected $table = 'tests';
	public static $rules = array(
			'title' => 'Required',
			'area' => 'belongs_to_user_organization'
	);
	
	public static function boot()
	{
		parent::boot();
		static::saving(function($test){
			$test->prepareFields();
		});
	}	
	
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
		return $this->belongsTo('User');
	}
	
	public function prepareFields()
	{
		return true;
	}
	
	public function organization()
	{
		return $this->belongsTo('Organization');
	}
}