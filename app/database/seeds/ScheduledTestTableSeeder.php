<?php
use Illuminate\Database\Seeder;
class ScheduledTestTableSeeder extends Seeder {
	
	public function run()
	{
		DB::table('scheduled_tests')->delete();
		ScheduledTest::create(array(
				'session_id' => TestSession::all()->first()->id,
				'test_id' => Test::find(1),
				'status' => Organization::all()->first()->id,
		));
	}
}