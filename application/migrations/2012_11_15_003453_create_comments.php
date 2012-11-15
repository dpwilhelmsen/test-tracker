<?php

class Create_Comments {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function($table) {
			$table->increments('id');
			$table->integer('test_id');
			$table->integer('commenter');
			$table->text('content');
			$table->timestamps();
		});
		
		/**
		 * `id` bigint(20) NOT NULL AUTO_INCREMENT,
		  `test_id` bigint(20) NOT NULL,
		  `commenter` bigint(20) NOT NULL,
		  `content` longtext NOT NULL,
		  `date` datetime NOT NULL,
		 */
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}