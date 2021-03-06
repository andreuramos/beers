<?php

class BeerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /beer
	 *
	 * @return Response
	 */
	public function index()
	{
		$beers = Beer::all();
		return View::make('backend.beer.index',['beers'=>$beers]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /beer/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('backend.beer.form',['beer'=>new Beer()]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /beer
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Input::get('beer_id')){
			$beer = Beer::find(Input::get('beer_id'));
			echo "already in db beer";
		}else{
			$beer = new Beer();
			echo "new beer!";
		}

		$brewers = [];
		for($i=1;$i<=Input::get('brewer-count');$i++) {
			$brewer = Brewer::find(Input::get('brewer-'.$i.'_id'));
			if (!$brewer) return Redirect::back()->withInput()->withMessage('Invalid Brewer '.$i);
			$brewers[] = $brewer->id;
		}
		$style = Style::find(Input::get('style_id'));
		if(!$style) return Redirect::back()->withInput()->withMessage('Invalid Style');

		$beer->name = Input::get('name');
		//$beer->brewer_id = $brewer->id;
		$beer->style_id = $style->id;
		$beer->ratebeer = Input::get('ratebeer_url');
		$beer->beeradvocate= Input::get('beeradvocate_url');
		$beer->album = Input::get('album');
		$beer->page  = Input::get('page');
		$beer->position = Input::get('position');
		$beer->save();

		$beer->brewer()->sync($brewers);

		for($i=1; $i<=Input::get('sticker-count');$i++) {
			if (Input::hasFile('sticker-'.$i)) {
				$f = Input::file('sticker-' . $i);
				//Change the image name: s<number_of_service>-<filename>.
				$filename = 'beerr-' . $beer->id . '-' . $f->getClientOriginalName();
				//Move it to our public folder
				$f->move(public_path() . '/upload/', $filename);
				//This is the path to show it on the web
				$complete_path = '/upload/' . $filename;
				//create the gallery
				$image = array(
					'path' => $complete_path,
					'brewer_id' => NULL,
					'beer_id' => $beer->id,
				);
				$img = Image::create($image);
				if(Input::get('sticker-'.$i.'_id')!=null){
					$sticker = Sticker::find(Input::get('sticker-'.$i.'_id'));
					$sticker->img_id = $img->id;
					$sticker->type = "front";//Input::get('sticker-'.$i.'_type');
					$sticker->save();
				}else {
					$sticker = Sticker::create([
						'beer_id' 	=> $beer->id,
						'image_id' 	=> $img->id,
						'type'		=> "front"//Input::get('sticker-'.$i.'_type')
					]);
				}
				echo "Sticker created ".$sticker->id;
			}else{
				if(Input::file('sticker-'.$i)->isValid()) echo "IS FUCKIN VALID";
				else echo "IS FUCKIN INVALID";
				echo 'sticker-'.$i." has no file";
				echo "<pre>".print_r(Input::all(),1)."</pre>";
				exit;
			}
		}
		return Redirect::to('dashboard/beers');
	}

	/**
	 * Display the specified resource.
	 * GET /beer/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /beer/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('backend.beer.form',['beer'=>Beer::find($id)]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /beer/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /beer/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$beer = Beer::find($id);
		foreach(Image::where('beer_id',$id) as $img) $img->delete();
		foreach($beer->image as $image) $image->delete();
		foreach(Sticker::where('beer_id',$id) as $sticker) $sticker->delete();
		$beer->brewer()->sync([]);
		$beer->delete();
		return Redirect::to('/dashboard/beers');
	}

}