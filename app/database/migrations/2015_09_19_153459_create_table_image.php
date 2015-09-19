<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableImage extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('image',function(Blueprint $table){
			$table->increments('id');
			$table->integer('beer_id')->unsigned()->nullable();
			$table->integer('brewer_id')->unsigned()->nullable();
			$table->string('path');
			$table->foreign('beer_id')->references('id')->on('beer');
			$table->foreign('brewer_id')->references('id')->on('brewer');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('image',function(Blueprint $table){
			$table->dropForeign('image_beer_beer_id_foreign');
			$table->dropForeign('image_brewer_brewer_id_foreign');
		});

		Schema::drop('image');
	}

}
