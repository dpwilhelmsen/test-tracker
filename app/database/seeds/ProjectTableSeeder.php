<?php
use Illuminate\Database\Seeder;
class ProjectTableSeeder extends Seeder {
	
	public function run()
	{
		DB::table('projects')->delete();
		
		Project::create(array(
				'title' => 'First Project',
				'description' => 'Project description',
				'organization_id' => Organization::all()->first()->id,
				'active' => 1,
		));
	}
}