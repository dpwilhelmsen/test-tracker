<?php

class Create_Defects {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('defects', function($table) {
			$table->increments('id');
			$table->integer('test_id');
			$table->string('title', 255);
			$table->text('content');
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
		Schema::drop('defects');
	}

}