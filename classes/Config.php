<?php namespace Wizaraty\Classes;

class Config
{
	public static function get($option)
	{
		$config = include dirname(realpath(__DIR__)) . '/config.php';

		if(isset($config[$option]))
			return $config[$option];

		return false;
	}
}