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

	public function findLocality(){
		$type = Input::get('type');
		$name = Input::get('name');
		$loc = Locality::where('name',$name)->where('type',$type)->first();
		if($loc){
			return Response::json(['status'=>1]);
		}
		return Response::json(['status'=>0]);
	}

	/**
	 * Searches in the wikipedia API for the flag of the given locality
	 * @return String JSON Array
	 */
	public function findFlag(){
		$name = Input::get('name');
		$base_url = "https://en.wikipedia.org/w/api.php?action=query&format=json";
		$url = $base_url.'&prop=images&titles='.$name;

		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$json_res = curl_exec($ch);
		$res = json_decode($json_res,1);
		echo "<pre>".print_r($res,1)."</pre>";
		try{
			foreach($res['query']['pages'] as $k=>$page){
				foreach($page['images'] as $j=>$img){
					$file_url = $base_url.'&prop=pageimages&titles='.$img['title'];
					echo "REQUESTING FILE URL: $file_url<br>";
					$ch_img = curl_init($file_url);
					curl_setopt($ch_img,CURLOPT_RETURNTRANSFER,true);
					$img_rs = json_decode(curl_exec($ch_img),1);
					if($img_rs && array_key_exists('query',$img_rs)) {
						foreach($img_rs['query']['pages'] as $page){
							echo '<img src="'.$page['thumbnail']['source'].'">';
						}
					}else{
						echo "<pre>".print_r($img_rs,1)."</pre>";
					}
				}
			}

		}catch(Exception $e){
			return Response::json(['status'=>0,'msg'=>$e->getMessage()]);
		}
		exit;

		return Response::json(['status'=>0,'msg'=>"Not found"]);
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

	public function searchElement($element_name,$text=null){
		$html = "";
		$elements = [];
		$db_elements = DB::table($element_name)->where('name','like',"%".$text."%")->get();
		foreach($db_elements as $db_element){
			switch($element_name){
				case "beer": $elements[] = Beer::find($db_element->id);break;
				case "brewer": $elements[] = Brewer::find($db_element->id);break;
				case "locality": $elements[] = Locality::find($db_element->id);break;
				case "style": $elements[] = Style::find($db_element->id);break;
			}
		}

		foreach($elements as $element){

			$html .= '<li class="list-group-item clearfix">';
			if($element_name=="locality" && $element->flag())
				$html.='<img src="'.$element->flag()->path.'" style="height:15px">&nbsp;';
			elseif($element_name=="brewer" && $element->logo())
				$html.='<img src="'.$element->logo()->path.'" style="height:15px">&nbsp;';

			$html.='<span>'.$element->name.'</span>'.
			'<div class="btn-group pull-right">';
			if($element_name=="brewer" || $element_name=="beer")
					$html.='<a href="'.URL::to('/dashboard/'.$element_name.'s/edit/'.$element->id).'">';

			$html.= '<button type="button" class="btn btn-info" ';
			if($element_name!="brewer" && $element_name=="beer")
				$html.='onclick="editElement('.$element->id.')"';
			$html.='>Edit</button>';
			if($element_name=="brewer" || $element_name=="beer")
				$html.='</a>';

			$html .='<a href="'.URL::to('/dashboard/'.$element_name.'s/delete/'.$element->id).'"><button type="button" class="btn btn-danger">Delete</button></a>';
			$html.='</div></li>';
		}
		return Response::json(['html'=>$html]);
	}

	public function beerMap(){
		$points = [];
		foreach(Beer::all() as $beer){
			$brewer = $beer->brewer->first();
			$points[] = [
				'name' => $beer->name,
				'latlng' => [
					'lat'=>$brewer->latitude,
					'lng' => $brewer->longitude
				]
			];
		}
		return Response::json(['points'=>$points]);
	}

	public function beerLocation($id){
		$beer = Beer::find($id);
		if(!$beer) return Response::json(['status'=>0]);
		$locality = $beer->brewer->first()->locality;
		return Response::json(['status'=>1,
			'point'=>[
				'lat'=>$locality->latitude,
				'lng'=>$locality->longitude,
				'name'=>$beer->name
			]
		]);
	}

	public function findbeer(){
		$text = Input::get('text');
		$results = [];
		foreach(Beer::search($text) as $beer){
			$country = $beer->getCountry();
			$results[] = [
				'id'	=> $beer->id,
				'name'	=> $beer->name,
				'flag'	=> $country->flag()?$country->flag()->path:null,
				'city'	=> $beer->getCity()->name
			];
		}
		return Response::json([
			'status'=>1,
			'beers' => $results
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