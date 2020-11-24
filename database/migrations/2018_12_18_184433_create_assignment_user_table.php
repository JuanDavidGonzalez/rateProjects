<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssignmentUserTable extends Migration {

	public function up()
	{
		Schema::create('assignment_user', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('assignment_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('assignment_user');
	}
}