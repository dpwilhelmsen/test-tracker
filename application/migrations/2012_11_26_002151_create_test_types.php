<?php

use Laravel\Database\Schema;

class Create_Test_Types {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('test_types', function($table) {
			$table->increments('id');
			$table->integer('test_id');
			$table->integer('taxonomy_id');
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
		Schema::drop('test_types');
	}

}