<?php
class Organization extends BaseModel 
{
	protected $table = 'organizations';
	
	public static $rules = array(
			'title' => 'Required|Unique:organizations'
		);
	
	public function users()
	{
		return $this->belongsToMany('User');
	}
	
	public function tests()
	{
		return $this->hasMany('Test');
	}
	
	public function sessions()
	{
		return $this->hasMany('TestSession');
	}
	
	public function types()
	{
		return $this->hasMany('Type');
	}
	
	public function projects()
	{
		return $this->hasMany('Project');
	}
	
	public function areas()
	{
		return $this->hasMany('Area');
	}
	
	public function setSlug($slug=null)
	{
		$this->slug = $slug ?: strtolower(
				preg_replace('/[^A-Za-z0-9-]+/', '-', $this->title));
		$validator = Validator::make(array('slug' => $this->slug), 
				array('slug' => 'Required|Unique:organizations|AlphaDash'));
		if ($validator->fails()) {
			$this->incrementSlug();
		}
	}
	protected function incrementSlug()
	{
		preg_match('/.+-([0-9]+)$/i', $this->slug, $match);
		$this->slug = empty($match) 
			? $this->slug.'-1' 
			: preg_replace('/(.+-)([0-9]+)$/i', '${1}'.++$match[1], $this->slug); 
		$validator = Validator::make(array('slug' => $this->slug),
				array('slug' => 'Required|Unique:organizations|AlphaDash'));
		if ($validator->fails())
			$this->incrementSlug();
	}
}