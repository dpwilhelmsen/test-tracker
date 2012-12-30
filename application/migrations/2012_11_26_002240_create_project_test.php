<?php

use Laravel\Database\Schema;

class Create_Project_Test {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_test', function($table) {
			$table->increments('id');
			$table->integer('test_id');
			$table->integer('project_id');
			$table->timestamps();
		});	
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project_test');
	}

}