<?php
if(!isset($_SESSION['req']))
	header('location: server_requirements');
if(isset($_POST['db_info']))
{
	if(\Wizaraty\Classes\Token::check($_POST['_token']))
	{
		if(!testConnection())
		{
			$_SESSION['help'] = help();
			return false;
		}

		$_SESSION['db_host'] 		= $_POST['database_host'];	
		$_SESSION['db_name'] 		= $_POST['database_name'];
		$_SESSION['db_username'] 	= $_POST['database_username'];
		$_SESSION['db_password'] 	= $_POST['database_password'];
		$_SESSION['db'] 	= true;

		header('location: admin_account');
	}
}


function testConnection()
{
	if(empty($_POST['database_host']) || empty($_POST['database_name']) || empty($_POST['database_username']))
	{
		return false;
	}

	$database= new \Wizaraty\Classes\Costum\Model($_POST['database_host'], $_POST['database_name'], $_POST['database_username'], $_POST['database_password']);

	return $database->testConnection();
}

function help()
{
	return _x("Plase Follow Steps : <br>") .
				"<ul>".
				"<li>" .  _x('Create New Database From PHPMyAdmin') . "</li>".
				"<li>".  _x('Enter Database Information (Fill Fields)') . "</li>".
				"<li>" . _x('Click \" Test Connection \"') . "</li>".
				"<li>" .  _x('if Connection pass Click "Continue"  button')  . "</li>".
				"<li>" .  _x('if you have a problem with configure Database contact us on') . \Wizaraty\Classes\Config::get('author_email') . "</li>".
				"</ul>";
}

if(isset($_POST['help']))
{
	$_SESSION['help'] = help();
}