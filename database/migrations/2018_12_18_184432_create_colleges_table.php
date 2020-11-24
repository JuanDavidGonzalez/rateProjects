<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCollegesTable extends Migration {

	public function up()
	{
		Schema::create('colleges', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('initials', 255);
			$table->string('city', 255);
		});
	}

	public function down()
	{
		Schema::drop('colleges');
	}
}