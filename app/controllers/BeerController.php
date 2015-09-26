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
		//
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
		//
	}

}