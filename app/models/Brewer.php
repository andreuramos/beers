<?php

class Brewer extends \Eloquent {
	protected $table = "brewer";
	protected $fillable = ['name','url','locality_id'];

	public function locality(){
		return $this->hasOne('Locality','locality_id');
	}

	private function image(){
		return $this->belongsTo('Image','brewer_id','id');
	}

	public function logo(){
		if(count($this->image())){
			return $this->image()->first();
		}
		return null;
	}

	public function logoUrl(){
		if($this->logo()!==null){
			return $this->logo()->path;
		}
		return null;
	}
}