<?php

class AjaxController extends \BaseController {

	/**************************/
	/* Backend Ajax Functions */
	/**************************/

	public function styleAutocomplete($term)
	{
		$terms = [];
		foreach(Style::where('name','like',"%".$term."%")->get() as $style){
			$terms[] = $style->name;
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
}