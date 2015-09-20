<?php


use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'user';
	protected $fillable = ['name','email'];
	protected $guarded = ['password'];
	protected $hidden = array('password', 'remember_token');




	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	public function getAuthPassword()
	{
		return $this->password;
	}

	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getRememberToken(){
		return $this->remember_token;
	}

	public function setRememberToken($value){
		$this->remember_token = $value;
	}

	public function getRememberTokenName(){
		return 'remember_token';
	}

	public function setPassword($pw){
		$this->password = $pw;
		$this->save();
	}

}