<?php
class AreaControllerTest extends TestCase
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

		$area = new Area();
		$area->title = 'Area Title';
		$area->description = 'Area Description';
		$area->organization()->associate($this->_organization);
		
		$area->save();
		
		$indexResults = $this->call('GET', 'api/v1/area', 
				array('organization' => $this->_organization->id));
		$this->assertContains($area->title, $indexResults->getContent());
	}
	
	public function testStore()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$this->call('POST', 'api/v1/area', 
				array('title' => 'Area Title',
					'description' => 'Description',
					'organization' => $this->_organization->id));
		$area = Area::where('title', 'Area Title')->first();
		$this->assertTrue($area->title === 'Area Title');
	}
	
	public function testShow()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$area = new Area();
		$area->title = 'New Title';
		$area->description = 'Description';
		$area->organization()->associate($this->_organization);
		
		$area->save();
		
		$indexResults = $this->call('GET', 'api/v1/area/'.$area->id);
		$this->assertContains($area->title, $indexResults->getContent());
	}
	
	public function testUpdate()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$area = new Area();
		$area->title = 'New Title';
		$area->description = 'Description';
		$area->organization()->associate($this->_organization);
		
		$area->save();
		
		$indexResults = $this->call('PUT', 'api/v1/area/'.$area->id, 
				array('title' => 'Changed Title'));
		$area = Area::find($area->id);
		$this->assertTrue($area->title === 'Changed Title');
	}
	
	
	public function testDestroy()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$area = new Area();
		$area->title = 'New Title';
		$area->description = 'Description';
		$area->organization()->associate($this->_organization);
		
		$area->save();
		
		$indexResults = $this->call('DELETE', 'api/v1/area/'.$area->id);
		$this->assertEmpty(Area::where('id', $area->id)->first());
	}
}