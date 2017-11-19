<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BrewerFloatCoords extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('brewer',function(Blueprint $t){
			$t->dropColumn('latitude');
			$t->dropColumn('longitude');

		});
		Schema::table('brewer',function(Blueprint $t){
			$t->float('latitude',10,8);
			$t->float('longitude',10,8);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('brewer',function(Blueprint $t) {
			$t->dropColumn('latitude');
			$t->dropColumn('longitude');
		});
		Schema::table('brewer',function(Blueprint $t){
			$t->float('latitude');
			$t->float('longitude');
		});
	}

}
