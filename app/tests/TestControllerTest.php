<?php
class TestControllerTest extends TestCase
{
	private $_user;
	private $_organization;
	
	private function setUpOrganization()
	{
		$this->_organization = new Organization();
		$this->_organization->title = 'Org. Title';
		$this->_organization->setSlug();
		$this->_organization->save();
		$this->_organization->users()->save($this->_user);
	}
	
	public function testIndex() 
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();

		$test = new Test();
		$test->title = 'Test Title';
		$test->description = 'Test Description';
		$test->conditions = 'Test Conditions';
		$test->expected_results = 'Test Expected results';
		$test->steps = 'Test Steps';
		$test->status = 1;
		$test->organization()->associate($this->_organization);
		
		$test->save();
		
		$indexResults = $this->call('GET', 'api/v1/test', 
				array('organization' => $this->_organization->id));
		$this->assertContains($test->title, $indexResults->getContent());
	}
	
	public function testStore()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		$this->call('POST', 'api/v1/test', 
				array('title' => 'Test Title',
					'description' => 'Test Description',
					'conditions' => 'Test Conditions',
					'expected_results' => 'Test Expected results',
					'steps' => 'Test Steps',
					'status' => 1,
					'organization' => $this->_organization->id));
		$test = Test::where('title', 'Test Title')->first();
		$this->assertTrue($test->title === 'Test Title');
	}
	
	public function testShow()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$test = new Test();
		$test->title = 'New Title';
		$test->description = 'Description';
		$test->organization()->associate($this->_organization);
		
		$test->save();
		
		$indexResults = $this->call('GET', 'api/v1/test/'.$test->id);
		$this->assertContains($test->title, $indexResults->getContent());
	}
	
	public function testUpdate()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$test = new Test();
		$test->title = 'Test Title';
		$test->description = 'Test Description';
		$test->conditions = 'Test Conditions';
		$test->expected_results = 'Test Expected results';
		$test->steps = 'Test Steps';
		$test->status = 1;
		$test->organization()->associate($this->_organization);
		
		$test->save();
		
		$indexResults = $this->call('PUT', 'api/v1/test/'.$test->id, 
				array('title' => 'Changed Title'));
		$test = Test::find($test->id);
		$this->assertTrue($test->title === 'Changed Title');
	}
	
	
	public function testDestroy()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$test = new Test();
		$test->title = 'Test Title';
		$test->description = 'Test Description';
		$test->conditions = 'Test Conditions';
		$test->expected_results = 'Test Expected results';
		$test->steps = 'Test Steps';
		$test->status = 1;
		$test->organization()->associate($this->_organization);
		
		$test->save();
		
		$indexResults = $this->call('DELETE', 'api/v1/test/'.$test->id);
		$this->assertEmpty(Test::where('id', $test->id)->first());
	}
}