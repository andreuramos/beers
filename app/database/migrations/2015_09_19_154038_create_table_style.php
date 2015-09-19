<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStyle extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('style',function(Blueprint $table){
			$table->increments('id');
			$table->string('name');
			$table->string('description');
			$table->integer('style_id')->unsigned()->nullable();
			$table->foreign('style_id')->references('id')->on('style');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('style',function(Blueprint $table){
			$table->dropForeign('style_style_style_id_foreign');
		});
		Schema::drop('style');
	}

}
