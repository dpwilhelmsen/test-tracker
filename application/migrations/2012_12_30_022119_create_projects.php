<?php

use Laravel\Database\Schema;

class Create_Projects {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function ($table){
			$table->increments('id');
			$table->string('title',255);
			$table->text('description');
			$table->boolean('active');
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
		Schema::drop('projects');
	}

}