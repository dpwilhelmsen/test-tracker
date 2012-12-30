<?php

class Create_Areas {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('areas', function ($table){
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
		Schema::drop('areas');
	}

}