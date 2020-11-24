<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParticipantsTable extends Migration {

	public function up()
	{
		Schema::create('participants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->enum('type', array('groupMember', 'leader', 'tutor', 'director', 'speaker', 'assistant'));
			$table->integer('participantable_id')->unsigned();
			$table->string('participantable_type', 255);
			$table->enum('document_type', array('TI', 'CC', 'CE'))->nullable();
			$table->string('document_num', 255)->nullable();
			$table->string('email', 255)->nullable();
			$table->string('phone', 255)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('participants');
	}
}