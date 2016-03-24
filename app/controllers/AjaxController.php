<?php

class AjaxController extends \BaseController {

	/**************************/
	/* Backend Ajax Functions */
	/**************************/

	public function brewerAutocomplete($term){
		$terms = [];
		foreach(Brewer::where('name','like',"%".$term."%")->get() as $brewer){
			$country = $brewer->country()?"(".$brewer->country()->name.")":null;
			$terms[] = ['id'=>$brewer->id,'name'=>$brewer->name,'pretty_name'=>$brewer->name." ".$country];
		}
		return Response::json($terms);
	}

	public function localityAutocomplete($term){
		$terms = [];
		foreach(Locality::where('name','like',"%".$term."%")->get() as $locality){
			$terms[] = ['id'=>$locality->id,'name'=>$locality->name,'pretty_name'=>$locality->completeName()];
		}
		return Response::json($terms);
	}

	public function getLocality($id){
		$locality = Locality::find($id);
		return Response::json([
			'id'=>$id,
			'name'=>$locality->name,
			'parent_locality'=>$locality->locality_id?Locality::find($locality->locality_id)->name:null,
			'type'=>$locality->type,
			'latitude'=>$locality->latitude,
			'longitude'=>$locality->longitude,
			'code'=>$locality->code,
			'flag'=>$locality->flag()?$locality->flag()->path:null
			//...
		]);
	}


	public function styleAutocomplete($term)
	{
		$terms = [];
		foreach(Style::where('name','like',"%".$term."%")->get() as $style){
			if($style->style_id) $parent = " (".Style::find($style->style_id)->name.")";
			else $parent = "";
			$terms[] = ['name'=>$style->name,'id'=>$style->id,'pretty_name'=>$style->name.$parent];
		}
		return Response::json($terms);
	}

	public function getStyle($id){
		$style = Style::find($id);
		return Response::json([
			'id'			=>$style->id,
			'name'			=>$style->name,
			'parent_style'	=>$style->getParentStyleName(),
			'description'	=>$style->description,
			'wikipedia'		=>$style->wikipedia_url
		]);
	}
	/*******************/
	/* Form Validation */
	/*******************/

	public function validateBeerForm(){
		$rules = [
			'name' => 'required',
			'brewer-1_id' => 'required|exists:brewer,id',
			'style'	=> 'required|exists:style,name'
		];
		for($i=1;$i<=Input::get('sticker-count');$i++){
			$rules['sticker-'.$i] = 'required|image';
		}
		$validator = Validator::make(Input::all(),$rules);
		if($validator->fails()){
			return Response::json(['status'=>0]);
		}else{
			return Response::json(['status'=>1]);
		}
	}
}