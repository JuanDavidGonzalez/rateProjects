<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	public function up()
	{
		Schema::create('projects', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->enum('status', array('proposal', 'inprogress', 'finished'));
			$table->enum('from', array('seedbed', 'group'));
			$table->string('projectable_type');
			$table->integer('projectable_id');
			$table->string('file_path', 255)->nullable();
			$table->string('educational_level');
		});
	}

	public function down()
	{
		Schema::drop('projects');
	}
}