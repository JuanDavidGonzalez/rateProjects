<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupsTable extends Migration {

	public function up()
	{
		Schema::create('groups', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('initials', 255);
			$table->string('interest_area', 255);
			$table->tinyInteger('colciencias');
			$table->tinyInteger('status');
		});
	}

	public function down()
	{
		Schema::drop('groups');
	}
}