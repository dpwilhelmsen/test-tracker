<?php
use Illuminate\Database\Seeder;
class TestTableSeeder extends Seeder {
	
	public function run()
	{
		DB::table('tests')->delete();
		
		Test::create(array(
				'title' => 'First Test',
				'description' => 'Project description',
				'area' => Area::all()->first()->id,
				'conditions' => 'Some Conditions',
				'steps' => 'Steps',
		));
	}
}