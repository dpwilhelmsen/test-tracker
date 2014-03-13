<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestSessionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('test_sessions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 255);
			$table->boolean('active');
			$table->integer('project_id');
			$table->integer('user_id');
			$table->integer('organization_id');
			$table->date('completed_at');
			$table->text('test_order');
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
		Schema::drop('test_sessions');
	}

}
