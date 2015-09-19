<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LinkBeerWithBrewer extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('beer_brewer',function(Blueprint $table){
			$table->integer('beer_id')->unsigned();
			$table->foreign('beer_id')->references('id')->on('beer');
			$table->integer('brewer_id')->unsigned();
			$table->foreign('brewer_id')->references('id')->on('brewer');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('beer',function(Blueprint $table){
			$table->dropForeign('brewer_beer_brewer_brewer_id_foreign');
			$table->dropForeign('beer_beer_brewer_beer_id_foreign');
			$table->dropColumn('brewer_id');
			$table->dropColumn('beer_id');
		});
		Schema::drop('beer_brewer');
	}

}
