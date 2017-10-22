<?php

class DashboardController extends \BaseController {


	public function index()
	{
		return View::make('backend.home');
	}


	/**
	 * Localities index page
	 * @return View
	 */
	public function localities(){
		$localities = [];
		foreach(Locality::all() as $locality){
			$localities[] = Locality::find($locality->id);
		}
		return View::make('backend.locality.index',['localities'=>$localities]);
	}

	/**
	 * Submit locality form
	 */
	public function saveLocality(){
		if(Input::get('locality_id')!=null){ //edit style
			$locality = Locality::find(Input::get('locality_id'));
		}else{//create style
			$locality = new Locality();
		}
		$parent_locality_id=null;
		if(Input::get('parent_locality')!=null){
			$parent_locality = Locality::find(Input::get('parent_locality_id'));
			if($parent_locality) $parent_locality_id=$parent_locality->id;
		}

		$locality->name=Input::get('name');
		$locality->type=Input::get('type');
		$locality->locality_id = $parent_locality_id;
		$locality->latitude = Input::get('latitude');
		$locality->longitude = Input::get('longitude');
		$locality->code = Input::get('code');
		$locality->save();
		if(Input::hasFile('flag')) {

			$f = Input::file('flag');
			//Change the image name: s<number_of_service>-<filename>.
			$filename = 'locality-' . $locality->id . '-flag-' . $f->getClientOriginalName();
			//Move it to our public folder
			$f->move(public_path() . '/upload/', $filename);
			//This is the path to show it on the web
			$complete_path = '/upload/' . $filename;
			//create the gallery
			$image = array(
				'path'          => $complete_path,
				'locality_id'   => $locality->id,
				'beer_id'       => NULL
			);
			if($locality->flag()) {
				$locality->flag()->fill($image)->save();
			}else {
				Image::create($image);
			}
		}
		return Redirect::back()->withMessage('Locality created correctly');
	}

	/**
	 * Deletes the speified style
	 * @param $id
	 * @return mixed
	 */
	public function deleteLocality($id){
		if(!count(Locality::where('locality_id',$id))) {
			Locality::find($id)->delete();
			return Redirect::back()->withMessage('Locality deleted correctly');
		}else{
			return Redirect::back()->withMessage("Locality can't be deleted. Delete the child localities first");
		}
	}

	/**
	 * Styles index page
	 * @return View
	 */
	public function styles(){
		$styles = [];
		foreach(Style::all() as $style){
			$styles[] = Style::find($style->id);
		}
		return View::make('backend.style.index',['styles'=>$styles]);
	}

	/**
	 * Submit style form
	 */
	public function saveStyle(){
		if(Input::get('style_id')!=null){ //edit style
			$style = Style::find(Input::get('style_id'));
		}else{//create style
			$style = new Style();
		}
		if(Input::get('parent_style')!=null){
			$parent_style = Style::where('name',Input::get('parent_style'))->first();
			if($parent_style) $parent_style_id=$parent_style->id;
		}else $parent_style_id=null;
		$style->name=Input::get('name');
		$style->description=Input::get('description');
		$style->style_id = $parent_style_id;
		$style->wikipedia_url = Input::get('wikipedia');
		$style->save();
		return Redirect::back()->withMessage('Style created correctly');
	}

	/**
	 * Deletes the speified style
	 * @param $id
	 * @return mixed
	 */
	public function deleteStyle($id){
		Style::find($id)->delete();
		return Redirect::back();
	}

	/**
	 * Index of the account settings page
	 */
	public function account(){
		$user = Auth::user();
		return View::make('backend.account',['user'=>$user]);
	}

	/**
	 * Generates an export of the entire collection, including an importable csv file
	 * and an image set ready to import.
	 *
	 */
	public function export(){
		$filename = date_create()->format('YmdHis')."_export.csv";
		$filepath = public_path()."/downloads/".$filename;
		$handle = fopen($filepath,"w+");
		$headers = ['brewer','name','style','family','album','page','position','country',
		'city','year','month','day','purchased','comment','tags'];
		fputcsv($handle,$headers);
		$csv = [];
		foreach(Beer::all() as $beer){
			$beer_r = [
				$beer->brewer->first()->name,
				$beer->name,
				$beer->style->name,
				$beer->getFamily()->name,
				$beer->album,
				$beer->page,
				$beer->position,
				$beer->getCountry()->name,
				$beer->getCityStr()
			];
			fputcsv($handle,$beer_r);
		}
		fclose($handle);
		$headers = [
			'Content-Type'	=> "text/csv"
		];
		return Response::download($filepath,$filename,$headers);

	}

}