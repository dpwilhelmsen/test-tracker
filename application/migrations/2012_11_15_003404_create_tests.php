<?php

class Create_Tests {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tests', function($table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->text('description');
			$table->integer('status');
			$table->integer('area');
			$table->text('conditions');
			$table->text('steps');
			$table->integer('assigned_id');
			$table->integer('author_id');
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
		Schema::drop('tests');
	}

}