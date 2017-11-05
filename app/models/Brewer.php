<?php

class Brewer extends \Eloquent {
	protected $table = "brewer";
	protected $fillable = ['name','url','locality_id','url','address','latitude','longitude'];

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

	/**
	 * return the country Locality Model Object of this brewer
	 */
	public function country(){
		$locality = $this->locality;
		if(!$locality || $locality->type=="continent") return null;
		while($locality->type!="country"){
			$locality = Locality::find($locality->locality_id);
		}
		return $locality;
	}

	public function localityHierarchy(){
		$hierarchy = [];
		$locality = Locality::find($this->locality_id);
		$hierarchy[] = $locality;
		while($locality->locality_id){
			$locality = Locality::find($locality->locality_id);
			$hierarchy[] = $locality;
		}
		return $hierarchy;
	}
}