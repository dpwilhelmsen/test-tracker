<?php
class OrganizationControllerTest extends TestCase
{
	public function testIndex() 
	{
		Route::enableFilters();
		$this->seed();
		$user = User::first();
		$this->be($user);
		
		$organization = new Organization();
		$organization->title = 'Org. Title';
		$organization->setSlug();
		$organization->save();
		$organization->users()->save($user);
		
		$indexResults = $this->call('GET', 'api/v1/organization');
		$this->assertContains($organization->title, $indexResults->getContent());
	}
	
	public function testStore()
	{
		Route::enableFilters();
		$this->seed();
		$user = User::first();
		$this->be($user);
		
		$this->call('POST', 'api/v1/organization', array('title' => 'Organization Title'));
		$organization = Organization::where('title', 'Organization Title')->first();
		$this->assertTrue($organization->title === 'Organization Title');
	}
	
	public function testShow()
	{
		Route::enableFilters();
		$this->seed();
		$user = User::first();
		$this->be($user);
		
		$organization = new Organization();
		$organization->title = 'Org. Title';
		$organization->setSlug();
		$organization->save();
		$organization->users()->save($user);
		
		$indexResults = $this->call('GET', 'api/v1/organization/'.$organization->id);
		$this->assertContains($organization->title, $indexResults->getContent());
	}
	
	public function testUpdate()
	{
		Route::enableFilters();
		$this->seed();
		$user = User::first();
		$this->be($user);
		
		$organization = new Organization();
		$organization->title = 'Org. Title';
		$organization->setSlug();
		$organization->save();
		$organization->users()->save($user);
		
		$indexResults = $this->call('PUT', 'api/v1/organization/'.$organization->id,
				array('title' => 'New Title'));
		$organization = Organization::where('id', $organization->id)->first();
		$this->assertTrue($organization->title === 'New Title');
	}
	
	public function testDestroy()
	{
		Route::enableFilters();
		$this->seed();
		$user = User::first();
		$this->be($user);
		
		$organization = new Organization();
		$organization->title = 'Org. Title';
		$organization->setSlug();
		$organization->save();
		$organization->users()->save($user);
		
		$indexResults = $this->call('DELETE', 'api/v1/organization/'.$organization->id);
		$this->assertEmpty(Organization::where('id', $organization->id)->first());
	}
}