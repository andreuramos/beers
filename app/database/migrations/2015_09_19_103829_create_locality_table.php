<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locality',function(Blueprint $table){
			$table->increments('id');
			$table->string('name');
			$table->enum('type',['city','region','province','country','continent']);
			$table->float('latitude');
			$table->float('longitude');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('locality');
	}

}
