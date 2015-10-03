<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSticker extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sticker',function (Blueprint $t){
			$t->increments('id');
			$t->integer('image_id')->unsigned();
			$t->foreign('image_id')->references('id')->on('image');
			$t->integer('beer_id')->unsigned();
			$t->foreign('beer_id')->references('id')->on('beer');
			$t->enum('type',['front','top','back']);
			$t->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sticker');
	}

}
