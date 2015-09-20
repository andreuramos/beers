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
		//
		echo "Welcome to the dashboard";
		return View::make('backend.home');
	}

	public function styles(){
		$styles = Style::all();
		return View::make('backend.style.index',['styles'=>$styles]);
	}

}