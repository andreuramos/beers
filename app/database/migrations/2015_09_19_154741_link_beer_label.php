<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LinkBeerLabel extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('beer_label',function(Blueprint $table){
			$table->integer('beer_id')->unsigned();
			$table->integer('label_id')->unsigned();
			$table->foreign('beer_id')->references('id')->on('beer');
			$table->foreign('label_id')->references('id')->on('label');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('beer_label',function(Blueprint $table){
			$table->dropForeign('beer_label_beer_beer_id_foreign');
			$table->dropForeign('beer_label_label_label_id_foreign');
		});

		Schema::drop('beer_label');
	}

}
