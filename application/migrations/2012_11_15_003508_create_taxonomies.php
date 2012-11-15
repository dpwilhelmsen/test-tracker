<?php

class Create_Taxonomies {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('taxonomies', function($table) {
			$table->increments('id');
			$table->string('type', 255);
			$table->string('title',255);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Scheme::drop('taxonomies');
	}

}