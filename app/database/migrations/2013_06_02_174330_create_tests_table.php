<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->text('description');
			$table->integer('status');
			$table->integer('area');
			$table->text('conditions');
			$table->text('steps');
			$table->integer('assigned_id');
			$table->integer('author_id');
			$table->integer('organization_id');
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
		Schema::drop('tests');
	}

}
