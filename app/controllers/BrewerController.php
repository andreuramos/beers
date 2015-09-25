<?php

class BrewerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /brewer
	 *
	 * @return Response
	 */
	public function index()
	{
		$brewers = Brewer::all();
		return View::make('backend.brewer.index',['brewers'=>$brewers]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /brewer/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('backend.brewer.form',['brewer'=>new Brewer()]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /brewer
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Input::get('brewer_id')){
			$brewer = Brewer::find(Input::get('brewer_id'));
		}else{
			$brewer = new Brewer();
		}

		$locality = Locality::where('name',Input::get('locality'))->first();
		if(!$locality) return Redirect::back()->withInput()->withMessage('Invalid Locality');

		$brewer->name = Input::get('name');
		$brewer->url  = Input::get('url');
		$brewer->locality_id = $locality->id;
		$brewer->save();
		echo "<pre>".print_r(Input::all(),1)."</pre>";exit;
		if(Input::hasFile('logo')) {
			echo "Has file";
			$f = Input::file('logo');
			//Change the image name: s<number_of_service>-<filename>.
			$filename = 'brewer-' . $brewer->id . '-' . $f->getClientOriginalName();
			//Move it to our public folder
			$f->move(public_path() . '/upload/', $filename);
			//This is the path to show it on the web
			$complete_path = '/upload/' . $filename;
			//create the gallery
			$image = array(
				'path'          => $complete_path,
				'brewer_id'     => $brewer->id,
				'beer_id'       => NULL
			);
			echo "<pre>".print_r($image,1)."</pre>";exit;
			Image::create($image);
		}

		return Redirect::to('/dashboard/brewers');
	}


	/**
	 * Show the form for editing the specified resource.
	 * GET /brewer/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('backend.brewer.form',['brewer'=>Brewer::find($id)]);
	}


	/**
	 * Remove the specified resource from storage.
	 * DELETE /brewer/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}