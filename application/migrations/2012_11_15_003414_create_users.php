<?php

class Create_Users {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('username', 256);
			$table->string('password', 256);
			$table->string('name', 128);
			$table->string('email', 256);
			$table->timestamps();
		});
		
		DB::table('users')->insert(array(
				'username'  => 'admin',
				'password'  => Hash::make('password'),
				'name'  => 'Admin'
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}