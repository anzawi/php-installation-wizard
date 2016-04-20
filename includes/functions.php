<?php 
// Start Session
	session_start();

// check if request come from AJAX , DON'T Allow Other
if (strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) !== 'xmlhttprequest')
{
    header('HTTP/1.1 500 Error: Request must come from Ajax!');
    exit();
}

// include composer autoload
include_once('../vendor/autoload.php');

if(isset($_POST['action']) && $_POST['action'] != '')
{
	// check if function we need is exist
	if(function_exists($_POST['action']))
		call_user_func($_POST['action']);
	else 
	{
		header('HTTP/1.1 404 Error: the function ' . $_POST['action'] . ' not found');
		exit();
	}
}


// this function to check connection with db
function testConnection()
{
	// check if posted information is not empty
	if(empty($_POST['db_host']) || empty($_POST['db_name']) || empty($_POST['db_username']))
	{
		header('HTTP/1.1 401 Error Empty Parameters');
		die();
	}

	// create object from Our (Costum) Model
	$db= new \Wizaraty\Classes\Costum\Model($_POST['db_host'], $_POST['db_name'], $_POST['db_username'], $_POST['db_password']);

	// check connection
	if($db->testConnection())
	{
		die('success connect with ' . $_POST['db_name']);
	}

	header('HTTP/1.1 401 Error Can\'t Connect with DB');
	die();
}


/**
 * Create Database Tables
 * @return [type] [description]
 */
function createDatabaseTables()
{
	$db= new \Wizaraty\Classes\Costum\Model($_SESSION['db_host'], $_SESSION['db_name'], $_SESSION['db_username'], $_SESSION['db_password']);
	$db->tables();
	die('ok');
}

/**
 * Insert Admin Information
 * @return [type] [description]
 */
function createAdminAccount()
{
	$db= new \Wizaraty\Classes\Costum\Model($_SESSION['db_host'], $_SESSION['db_name'], $_SESSION['db_username'], $_SESSION['db_password']);
	$db->createAdmin([
				'username'=> $_SESSION['admin_username'],
				'email'	  => $_SESSION['admin_password'],
				'password'=> $_SESSION['admin_email'],
				'permissions' => 1

		]);
}

/**
 * Generate Config file
 * @return [type] [description]
 */
function createConfigFile()
{
	// get config file path from Config.php file
	$path = \Wizaraty\Classes\Config::get('config_file_path');
	if(!$path)
		return;

	// check if config file is not exist create one and get 777 permissions
	if(!file_exists($path))
	{
		mkdir($path, 0777, true);
	}

	/**
	 * Here You can Add All your script Config
	 * in example here I'will Create array for database information
	 * @var ARRAY
	 */
	$config = [
			'host' 			=> $_SESSION['db_host'],
			'usrsername' 		=> $_SESSION['db_username'],
			'password' 		=> $_SESSION['db_password'],
			'database_name' => $_SESSION['db_name'],
	];
	/**
	 * Othe Example
	 */
	/*
	$config = [
		"database" => [
			'host' 			=> $_SESSION['db_host'],
			'usrsername' 		=> $_SESSION['db_username'],
			'password' 		=> $_SESSION['db_password'],
			'database_name' => $_SESSION['db_name'],
		],

		"script_info" => [
			"author" 	  => "Mohammad Anzawi",
			"author_uri"  => "http://codcanyon.net",

			"script_name" => "Wizaraty"
			"script_v"	  => "1.0.0",
		],

		"Test" => [
			// ....
		],
	];
*/

	// open cinfig file and save the $config array in
	$filename = rtrim($path, '/') . '/' . 'config.php';
	$fh = fopen($filename, "w");
    if (!is_resource($fh)) {
        return false;
    }

    $confFile = "<?php \n return [ \n";
    foreach ($config as $key => $value) {
         
        	$confFile .= sprintf(" '%s' => '%s' ,\n", 
        		$key, $value);
    }
    
    fwrite($fh, $confFile . ' ];');
    
    // close the file
    fclose($fh);

    // remove database information from SESSION Global variable
	unset($_SESSION['db_host']);
	unset($_SESSION['db_name']);
	unset($_SESSION['db_username']);
	unset($_SESSION['db_password']);

	return true;
}