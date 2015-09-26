<?php

class Brewer extends \Eloquent {
	protected $table = "brewer";
	protected $fillable = ['name','url','locality_id'];

	public function locality(){
		return $this->hasOne('Locality','id','locality_id');
	}

	public function image(){
		return $this->hasMany('Image','brewer_id','id');
	}

	public function beer(){
		return $this->belongsToMany('Beer');
	}

	public function logo(){
		if(count($this->image())){
			return $this->image()->first();
		}
		return null;
	}

	public function logoUrl(){
		$img = DB::table('image')->where('brewer_id',$this->id)->orderBy('created_at','desc')->first();
		if($img!==null){
			return $img->path;
		}
		return null;
	}
}