<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduledTestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scheduled_tests', function(Blueprint $table)
		{
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
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('scheduled_tests');
	}

}
