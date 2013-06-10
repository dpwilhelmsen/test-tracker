<?php
use Illuminate\Database\Seeder;
class TypeTableSeeder extends Seeder {
	
	public function run()
	{
		DB::table('types')->delete();
		
		Type::create(array(
				'title' => 'First Type',
				'description' => 'Project description',
				'organization_id' => Organization::all()->first()->id,
		));
	}
}