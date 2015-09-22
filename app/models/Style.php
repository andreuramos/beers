<?php

class Style extends \Eloquent {
	protected $table = "style";
	protected $fillable = ['name','description','style_id'];

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
}