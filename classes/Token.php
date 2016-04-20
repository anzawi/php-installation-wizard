<?php namespace Wizaraty\Classes;

class Token
{
	public static function generate()
	{
		$token = sha1(uniqid() * time());
		$_SESSION['_token'] = $token;
		return $token;
	}

	public static function check($token)
	{
		if($token === $_SESSION['_token'])
		{
			unset($_SESSION['_token']);
			return true;
		}

		unset($_SESSION['_token']);
		return false;
	}
}