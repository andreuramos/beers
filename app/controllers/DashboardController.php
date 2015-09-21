<?php

class DashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /dashboard
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('backend.home');
	}

	public function brewers(){
		$brewers = Brewer::all();
		return View::make('backend.brewer.index',['brewers'=>$brewers]);
	}

	public function styles(){
		$styles = Style::all();
		return View::make('backend.style.index',['styles'=>$styles]);
	}



}