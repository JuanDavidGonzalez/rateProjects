<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCriteriaTable extends Migration {

	public function up()
	{
		Schema::create('criteria', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('description', 255);
			$table->integer('weighing')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('criteria');
	}
}