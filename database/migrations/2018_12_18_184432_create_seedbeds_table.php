<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeedbedsTable extends Migration {

	public function up()
	{
		Schema::create('seedbeds', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('initials', 255);
			$table->string('line', 255);
			$table->integer('group_id')->unsigned();
			$table->tinyInteger('status')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('seedbeds');
	}
}