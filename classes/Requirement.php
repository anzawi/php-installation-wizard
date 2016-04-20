<?php namespace Wizaraty\Classes;

class Requirement
{
	private $_errors = [];
	/**
	 * Getting System Info
	 * 	- PHP Version
	 * 	- Server OS
	 */
	
	public function getPhpVersion($foo)
	{
		if(phpversion($foo) >= Config::get('php_version'))
			return true;

		$this->setError('php_version', 'PHP vesion Must be <strong>' . Config::get('php_version') . '</strong> or higher, the current version is <strong>' . phpversion($foo) . '</strong>');
		return false;
	}
	
	public function getServerOS()
	{
		return  PHP_OS . ' | ' . php_uname();
	}

	/**
	 * Required PHP Settings
	 * 	- PDO Support
	 * 	- Database Extension (pdo_mysql)
	 * 	- Safe Mode
	 * 	- Session Support
	 */
	
	// check if PDO Extension is Supported
	public function checkPdo($foo)
	{
		if (class_exists('PDO') && defined('PDO::ATTR_DRIVER_NAME')) return true;

		$this->setError('pdo', 'this Server not Supported PDO');
		return false;
	}

	// check if is in safe mode
	public function checkSafeMode($foo)
	{
		if(!ini_get("safe_mode"))
			return true;

		$this->setError('safe_mode', 'this server Work on SAFE MODE !');
		return false;
	}

	// check if session is support
	public function checkSessionSupport($foo)
	{
		if(function_exists('session_start')) return true;

		$this->setError('session', 'Session Support not enabeld on this Server');
		return false;
	}

	/**
	 * Extensions
	 * 	- Curl
	 */
	public function checkCurl($foo)
	{
		if(function_exists('curl_version'))
			return true;

		$this->setError('curl', 'the CURL not enabeld in this server');
		return false;
	}

	/**
	 * Modes
	 * 	- Mode Rewrite
	 */
	public function checkModeRewrite($foo)
	{
		return true;
		if (function_exists('apache_get_modules')) 
		{
			if(in_array('mod_rewrite', \apache_get_modules()))
				return true;
		}
		elseif(getenv('HTTP_MOD_REWRITE') == 'On'
			|| array_key_exists('HTTP_MOD_REWRITE', $_SERVER))
		{
		    return true;
		}


		$this->setError('mod_rewrite', 'the Mode Rewrite not available on this server');
		return false;
	}
	
	/**
	 * Directories and Files
	 * 	check if x path is writable or not
	 */
	public function checkIfDirIsWritable($foo)
	{
		//mkdir(Config::get('config_file_path', 7777));
		if(is_writable(Config::get('config_file_path')))
			return true;

		$this->setError("is_writable", "Can't Write on " . Config::get('config_file_path'));
		return false;	
	}


	// set error to save error if the requirement is return false
	protected function setError($errorName = '' , $errorMessage = '')
	{
		$this->_errors[$errorName] = $errorMessage;
	}

	public function getErrors()
	{
		return $this->_errors;
	}

	// if this method return true then no evrything is ok
	public function pass()
	{
		return (!count($this->getErrors()) ? true : false);
	}
}