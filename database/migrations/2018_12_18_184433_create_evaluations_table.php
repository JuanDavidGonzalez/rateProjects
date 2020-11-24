<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationsTable extends Migration {

	public function up()
	{
		Schema::create('evaluations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('criterion_id')->unsigned();
			$table->integer('project_id')->unsigned();
			$table->integer('user_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('evaluations');
	}
}