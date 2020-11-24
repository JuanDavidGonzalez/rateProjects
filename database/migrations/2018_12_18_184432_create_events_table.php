<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	public function up()
	{
		Schema::create('events', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->datetime('start_date');
			$table->datetime('end_date');
			$table->string('name');
			$table->string('headquarters', 255);
			$table->string('city', 255);
			$table->tinyInteger('status');
		});
	}

	public function down()
	{
		Schema::drop('events');
	}
}