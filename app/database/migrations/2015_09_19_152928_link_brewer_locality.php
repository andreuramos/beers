<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LinkBrewerLocality extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('brewer',function(Blueprint $table){
			$table->integer('locality_id')->unsigned();
			$table->foreign('locality_id')->references('id')->on('locality');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('brewer',function(Blueprint $table){
			$table->dropForeign('brewer_locality_locality_id_foreign');
			$table->dropColumn('locality_id');
		});
	}

}
