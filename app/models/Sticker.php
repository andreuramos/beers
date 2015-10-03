<?php

class Sticker extends \Eloquent {
	protected $table = "sticker";
	protected $fillable = ['beer_id','image_id','type'];
}