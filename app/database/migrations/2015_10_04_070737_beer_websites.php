<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BeerWebsites extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('beer',function(Blueprint $t){
			$t->string('ratebeer')->nullable();
			$t->string('beeradvocate')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('beer',function(Blueprint $t){
			$t->dropColumn('ratebeer');
			$t->dropColumn('beeradvocate');
		});
	}

}
