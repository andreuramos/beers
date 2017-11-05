<?php

class Style extends \Eloquent {
	protected $table = "style";
	protected $fillable = ['name','description','style_id'];

	public function beer(){
		return $this->hasMany('Beer');
	}

	public function parentStyle(){
		return $this->hasOne("Style",'style_id');
	}

	/**
	 * Return the parent style name if any. Null if not parent style
	 * @return null|String
	 */
	public function getParentStyleName(){
		if($this->style_id!=null){
			return self::find($this->style_id)->name;
		}
		return null;
	}

	public function substyles(){
		$substyles = [];
		foreach(DB::table('style')->where('style_id',$this->id)->get() as $substyle){
			$substyle = Style::find($substyle->id);
			$substyles[] = $substyle;
			foreach($substyle->substyles() as $s_substyle){
				$substyles[] = $s_substyle;
			}
		}
		return $substyles;
	}

	/**
	 * Recursive function that returns this style and its substyles beers
	 */
	public function beers(){
		$beers = [];
		foreach($this->beer as $beer) $beers[] = Beer::find($beer->id);
		foreach($this->substyles() as $substyle){
			foreach($substyle->beer as $beer) $beers[] = Beer::find($beer->id);
		}
		return $beers;
	}
}