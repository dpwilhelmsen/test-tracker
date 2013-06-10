<?php
use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder {
	
	public function run()
	{
		DB::table('areas')->delete();
		
		Area::create(array(
				'title' => 'Frontend',
				'description' => 'Frontend description',
				'organization_id' => Organization::all()->first()->id,
		));
	}
}