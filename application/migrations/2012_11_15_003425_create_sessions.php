<?php

class Create_Sessions {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sessions', function($table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->integer('author_id');
			$table->date('completed_at');
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
		Schema::drop('sessions');
	}

}