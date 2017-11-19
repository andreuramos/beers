<?php

class Locality extends \Eloquent {
	protected $table="locality";
	protected $fillable = [];

	public static function countCountries(){
		return DB::table('locality')->where('type','country')->count();
	}

	/**
	 * returns the flag Image Model Object if any
	 * @return null
	 */
	public function flag(){
		$res = DB::table('image')->where('locality_id',$this->id)->first();
		if($res) return Image::find($res->id);
		return null;
	}

	/**
	 * returns the locality name including hierarchy
	 * @return String
	 */
	public function completeName(){
		$name = $this->name;
		if($this->locality_id!=null){
			$name .= ", ".Locality::find($this->locality_id)->completeName();
		}
		return $name;
	}

	public function hierarchy(){
		$hierarchy = [];
		$parent = $this;
		while($parent->locality_id){
			$parent = Self::find($parent->locality_id);
			$hierarchy[] = $parent;
		}
		return $hierarchy;
	}

	public function descendants(){
		$descendants = [];
		$db_desc = DB::table('locality')->where('locality_id',$this->id)->get();
		foreach($db_desc as $dsc){
			$descendants[] = Self::find($dsc->id);
		}
		return $descendants;
	}

	/**
	 * Returns all the brewers associated to this locality or one of
	 * its descendants
	 * @return array of Brewer objects
	 */
	public function brewers(){
		$brewers = [];
		$db_brewers = DB::table('brewer')->where('locality_id',$this->id)->get();
		foreach($db_brewers as $brewer){
			$brewers[] = Brewer::find($brewer->id);
		}
		//recursion
		foreach($this->descendants() as $desc){
			foreach($desc->brewers() as $brewer) $brewers[] = $brewer;
		}
		return $brewers;
	}

	public function beers(){
		$beer_ids = [];
		foreach($this->brewers() as $brewer){
			foreach($brewer->beer as $beer){
				if(!in_array($beer->id,$beer_ids)){
					$beer_ids[] = $beer->id;
				}
			}
		}
		$beers = [];
		foreach($beer_ids as $b_id){
			$beers[] = Beer::find($b_id);
		}
		return $beers;
	}
}