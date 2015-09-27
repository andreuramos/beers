<?php

class Locality extends \Eloquent {
	protected $table="locality";
	protected $fillable = [];

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
}