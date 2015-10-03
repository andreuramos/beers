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

	public function mainStickerPath(){
		$img = DB::table('sticker')->where('beer_id',$this->id)->first();
		if(!$img) return null;
		return Sticker::find($img->id)->image->path;
	}

	/**
	 * Selects randomly up to $amount beer records
	 * @param $amount int
	 * @return array
	 */
	public static function random($amount){
		$seed = mt_rand(0,999);
		$beers = [];
		$res = DB::table('beer')->orderBy(DB::raw('RAND('.$seed.')'))->take($amount)->get();
		foreach($res as $beer){
			$beers[] = self::find($beer->id);
		}
		return $beers;
	}
}