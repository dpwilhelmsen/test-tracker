<?php

class Test extends Eloquent
{
	public static $timestamps = true;
	
	public function comments()
	{
		return $this->has_many('Comment');
	}
	
	public function defects()
	{
		return $this->has_many('Defect');
	}
	
	public function scheduled_tests()
	{
		return $this->belongs_to('Scheduled_Test');
	}
	
	public function sessions()
	{
		
	}
	
	public function types()
	{
		return $this->has_many_and_belongs_to('Taxonomy', 'test_types');
	}
	
	public function sections()
	{
		return $this->has_many_and_belongs_to('Taxonomy', 'test_sections');
	}
	
	public function projects()
	{
		return $this->has_many_and_belongs_to('Taxonomy', 'test_projects');
	}
	
	public function user()
	{
		return $this->has_many_and_belongs_to('User');
	}

}