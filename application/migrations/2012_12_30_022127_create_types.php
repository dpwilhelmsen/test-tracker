<?php

use Laravel\Database\Schema;

class Create_Types {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('types', function ($table){
			$table->increments('id');
			$table->string('title',255);
			$table->text('description');
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
		Schema::drop('types');
	}

}