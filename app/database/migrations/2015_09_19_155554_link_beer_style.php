<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LinkBeerStyle extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('beer',function(Blueprint $table){
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
		Schema::table('beer',function(Blueprint $table){
			$table->dropForeign('beer_style_style_id_foreign');
			$table->dropColumn('style_id');
		});
	}

}
