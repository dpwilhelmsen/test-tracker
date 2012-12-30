<?php

use Laravel\Database\Schema;

class Create_Area_Test {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('area_test', function($table) {
			$table->increments('id');
			$table->integer('test_id');
			$table->integer('area_id');
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
		Schema::drop('area_test');
	}

}