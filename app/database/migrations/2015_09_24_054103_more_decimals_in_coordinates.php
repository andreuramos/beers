<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoreDecimalsInCoordinates extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('locality',function(Blueprint $table){
			$table->dropColumn('latitude');
			$table->dropColumn('longitude');
		});
		Schema::table('locality',function(Blueprint $table){
			$table->decimal('latitude', 10, 7);
			$table->decimal('longitude', 10, 7);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('locality',function(Blueprint $table){
			$table->dropColumn('latitude');
			$table->dropColumn('longitude');
		});
		Schema::table('locality',function(Blueprint $table){
			$table->float('latitude');
			$table->float('longitude');
		});
	}

}
