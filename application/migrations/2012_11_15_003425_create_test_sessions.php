<?php

class Create_Test_Sessions {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('test_sessions', function($table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->boolean('active');
			$table->integer('project_id');
			$table->integer('user_id');
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
		Schema::drop('test_sessions');
	}

}