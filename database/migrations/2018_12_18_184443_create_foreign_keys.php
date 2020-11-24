<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('college_id')->references('id')->on('colleges')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('seedbeds', function(Blueprint $table) {
			$table->foreign('group_id')->references('id')->on('groups')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('evaluations', function(Blueprint $table) {
			$table->foreign('criterion_id')->references('id')->on('criteria')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('evaluations', function(Blueprint $table) {
			$table->foreign('project_id')->references('id')->on('projects')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('evaluations', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('assignments', function(Blueprint $table) {
			$table->foreign('project_id')->references('id')->on('projects')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('assignment_user', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('assignment_user', function(Blueprint $table) {
			$table->foreign('assignment_id')->references('id')->on('assignments')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_college_id_foreign');
		});
		Schema::table('seedbeds', function(Blueprint $table) {
			$table->dropForeign('seedbeds_group_id_foreign');
		});
		Schema::table('evaluations', function(Blueprint $table) {
			$table->dropForeign('evaluations_criterion_id_foreign');
		});
		Schema::table('evaluations', function(Blueprint $table) {
			$table->dropForeign('evaluations_project_id_foreign');
		});
		Schema::table('evaluations', function(Blueprint $table) {
			$table->dropForeign('evaluations_user_id_foreign');
		});
		Schema::table('assignments', function(Blueprint $table) {
			$table->dropForeign('assignments_project_id_foreign');
		});
		Schema::table('assignment_user', function(Blueprint $table) {
			$table->dropForeign('assignment_user_user_id_foreign');
		});
		Schema::table('assignment_user', function(Blueprint $table) {
			$table->dropForeign('assignment_user_assignment_id_foreign');
		});
	}
}