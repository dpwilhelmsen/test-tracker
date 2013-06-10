<?php
use Illuminate\Database\Seeder;

class OrganizationTableSeeder extends Seeder {
	
	public function run()
	{
		DB::table('organizations')->delete();
		
		Organization::create(array(
				'title' => 'Test Org',
				'slug' => 'test-org',
		));
	}
}