<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LocalityImages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('image',function(Blueprint $t){
			$t->integer('locality_id')->unsigned()->nullable('after','brewer_id');
			$t->foreign('locality_id')->references('id')->on('locality');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('image',function(Blueprint $t){
			$t->dropForeign('image_locality_locality_id_foreign');
			$t->drop('locality_id');
		});
	}

}
