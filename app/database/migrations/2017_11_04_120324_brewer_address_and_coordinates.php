<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BrewerAddressAndCoordinates extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('brewer',function(Blueprint $t){
			$t->string('address')->nullable();
			$t->float('latitude')->nullable();
			$t->float('longitude')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('brewer',function(Blueprint $t){
			$t->dropColumn('address');
			$t->dropColumn('latitude');
			$t->dropColumn('longitude');
		});
	}

}
