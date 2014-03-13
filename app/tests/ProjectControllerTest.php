<?php
class ProjectControllerTest extends TestCase
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

		$project = new Project();
		$project->title = 'New Title';
		$project->description = 'Description';
		$project->active = 1;
		$project->organization()->associate($this->_organization);
		
		$project->save();
		
		$indexResults = $this->call('GET', 'api/v1/project', 
				array('organization' => $this->_organization->id));
		$this->assertContains($project->title, $indexResults->getContent());
	}
	
	public function testStore()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$this->call('POST', 'api/v1/project', 
				array('title' => 'Project Title',
					'description' => 'Description',
					'active' => 1,
					'organization' => $this->_organization->id));
		$project = Project::where('title', 'Project Title')->first();
		$this->assertTrue($project->title === 'Project Title');
	}
	
	public function testShow()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$project = new Project();
		$project->title = 'New Title';
		$project->description = 'Description';
		$project->active = 1;
		$project->organization()->associate($this->_organization);
		
		$project->save();
		
		$indexResults = $this->call('GET', 'api/v1/project/'.$project->id);
		$this->assertContains($project->title, $indexResults->getContent());
	}
	
	public function testUpdate()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$project = new Project();
		$project->title = 'New Title';
		$project->description = 'Description';
		$project->active = 1;
		$project->organization()->associate($this->_organization);
		
		$project->save();
		
		$indexResults = $this->call('PUT', 'api/v1/project/'.$project->id, 
				array('title' => 'Changed Title'));
		$project = Project::find($project->id);
		$this->assertTrue($project->title === 'Changed Title');
	}
	
	
	public function testDestroy()
	{
		Route::enableFilters();
		$this->seed();
		$this->_user = User::first();
		$this->be($this->_user);
		
		$this->setUpOrganization();
		
		$project = new Project();
		$project->title = 'New Title';
		$project->description = 'Description';
		$project->active = 1;
		$project->organization()->associate($this->_organization);
		
		$project->save();
		
		$indexResults = $this->call('DELETE', 'api/v1/project/'.$project->id);
		$this->assertEmpty(Project::where('id', $project->id)->first());
	}
}