<?php

class Beer extends \Eloquent {
	protected $table="beer";
	protected $fillable = ['brewer_id','style_id','album','page','position'];

	public function image(){
		return $this->hasMany('Image','beer_id','id');
	}

	public function sticker(){
		return $this->hasMany('Sticker');
	}

	public function brewer(){
		return $this->belongsToMany('Brewer');
	}

	public function style(){
		return $this->belongsTo('Style');
	}

	public function firstImage(){
		$img = DB::table('image')->where('beer_id',$this->id)->first();
		return Image::find($img->id);
	}
}