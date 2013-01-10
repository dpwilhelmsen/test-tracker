<?php

class Create_Scheduled_Tests {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scheduled_tests', function($table) {
			$table->increments('id');
			$table->integer('session_id');
			$table->integer('test_id');
			$table->integer('status');
			$table->integer('assigned_user');
			$table->integer('completed_user');
			$table->integer('weight');
			$table->integer('defects');
			$table->timestamps();
		});
		
		/**
		 * `id` bigint(20) NOT NULL AUTO_INCREMENT,
		  `session_id` bigint(20) NOT NULL,
		  `test_id` bigint(20) NOT NULL,
		  `status` bigint(20) NOT NULL,
		  `test_date` datetime NOT NULL,
		  `completed_user` bigint(20) NOT NULL,
		  `defects` bigint(20) NOT NULL,
		 */
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('scheduled_tests');
	}

}