<?php
use Illuminate\Database\Seeder;
class TestSessionTableSeeder extends Seeder {
	
	public function run()
	{
		DB::table('test_sessions')->delete();
		
		TestSession::create(array(
				'title' => 'First Test Session',
				'active' => 1,
				'project_id' => Project::all()->first()->id,
		));
	}
}