<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssignmentsTable extends Migration {

	public function up()
	{
		Schema::create('assignments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('classroom');
			$table->enum('day', array('wednesday', 'thursday'));
			$table->string('hour');
			$table->integer('project_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('assignments');
	}
}