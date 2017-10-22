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

	public function getCountry(){
		$brewed_at = $this->brewer->first()->locality;
		while($brewed_at->locality_id && $brewed_at->type!="country"){
			$brewed_at = Locality::find($brewed_at->locality_id);
		}
		return $brewed_at;
	}

	public function getCity(){
		return $this->brewer->first()->locality;
	}

	public function getCityStr(){
		$loc = $this->getCity();
		$str = "";
		while($loc->type!="country" && $loc->locality_id){
			if($str) $str.=", ";
			$str .= $loc->name;
			$loc = Locality::find($loc->locality_id);
		}
		return $str;
	}

	public function getFamily(){
		$style = $this->style;
		while($style->style_id){
			$style = Style::find($style->style_id);
		}
		return $style;
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