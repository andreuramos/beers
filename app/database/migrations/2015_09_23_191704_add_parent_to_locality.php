<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentToLocality extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('locality',function(Blueprint $t){
			$t->integer('locality_id')->unsigned()->nullable();
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
		Schema::table('locality',function(Blueprint $t){
			$t->dropForeign('locality_locality_locality_id_foreign');
			$t->dropColumn('locality_id');
		});
	}

}
