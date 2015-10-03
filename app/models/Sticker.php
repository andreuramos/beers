<?php

class Sticker extends \Eloquent {
	protected $table = "sticker";
	protected $fillable = ['beer_id','image_id','type'];

	public function beer(){
		return $this->belongsTo('Beer');
	}

	public function image(){
		return $this->belongsTo('Image');
	}
}