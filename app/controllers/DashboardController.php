<?php

class DashboardController extends \BaseController {


	public function index()
	{
		return View::make('backend.home');
	}

	public function brewers(){
		$brewers = Brewer::all();
		return View::make('backend.brewer.index',['brewers'=>$brewers]);
	}

	/**
	 * Styles index page
	 * @return View
	 */
	public function styles(){
		$styles = Style::all();
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



}