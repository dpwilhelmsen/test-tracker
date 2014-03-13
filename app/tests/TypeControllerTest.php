<?php
class TypeControllerTest extends TestCase
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

		$type = new Type();
		$type->title = 'New Title';
		$type->description = 'Description';
		$type->organization()->associate($this->_organization);
		
		$type->save();
		
		$indexResults = $this->call('GET', 'api/v1/type', 
				array('organization' => $this->_organization->id));
		$this->assertContains($type->title, $indexResults->getContent());
	}
	
	public function testStore()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$this->call('POST', 'api/v1/type', 
				array('title' => 'Type Title',
					'description' => 'Description',
					'organization' => $this->_organization->id));
		$type = Type::where('title', 'Type Title')->first();
		$this->assertTrue($type->title === 'Type Title');
	}
	
	public function testShow()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$type = new Type();
		$type->title = 'New Title';
		$type->description = 'Description';
		$type->organization()->associate($this->_organization);
		
		$type->save();
		
		$indexResults = $this->call('GET', 'api/v1/type/'.$type->id);
		$this->assertContains($type->title, $indexResults->getContent());
	}
	
	public function testUpdate()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$type = new Type();
		$type->title = 'New Title';
		$type->description = 'Description';
		$type->organization()->associate($this->_organization);
		
		$type->save();
		
		$indexResults = $this->call('PUT', 'api/v1/type/'.$type->id, 
				array('title' => 'Changed Title'));
		$type = Type::find($type->id);
		$this->assertTrue($type->title === 'Changed Title');
	}
	
	
	public function testDestroy()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$type = new Type();
		$type->title = 'New Title';
		$type->description = 'Description';
		$type->organization()->associate($this->_organization);
		
		$type->save();
		
		$indexResults = $this->call('DELETE', 'api/v1/type/'.$type->id);
		$this->assertEmpty(Type::where('id', $type->id)->first());
	}
}