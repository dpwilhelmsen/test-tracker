<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('OrganizationTableSeeder');
		$this->call('AreaTableSeeder');
		$this->call('ProjectTableSeeder');
		$this->call('TypeTableSeeder');
		$this->call('TestTableSeeder');
		$this->call('TestSessionTableSeeder');
		$this->call('ScheduledTestTableSeeder');
	}

}