<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		return View::make('frontend.home');
	}

	public function login(){
		return View::make('frontend.login');
	}

	public function dologin(){
		$email = $_POST['email'];
		$password = $_POST['password'];
		$user = User::where('email',$email)->first();
		if(!$user) return Redirect::back();

		if (Hash::check($password,$user->password)) {
			Auth::login($user);
			return Redirect::intended('dashboard');
		}
		return Redirect::back();

	}

	public function logout(){
		Auth::logout();
		return Redirect::to('/');
	}

}
