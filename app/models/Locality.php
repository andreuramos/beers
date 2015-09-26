<?php

class Locality extends \Eloquent {
	protected $table="locality";
	protected $fillable = [];

	public function flag(){
		$res = DB::table('image')->where('locality_id',$this->id)->first();
		if($res) return Image::find($res->id);
		return null;
	}
}