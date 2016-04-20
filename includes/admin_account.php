<?php 
if(!isset($_SESSION['db']))
	header('location: db_settings');
if(isset($_POST['admin']))
{
	if(\Wizaraty\Classes\Token::check($_POST['_token']))
	{
		if(!preg_match("/^[A-Za-z]+$/", $_POST['admin_username']))
			$_SESSION['errors'][] = _x('Admin Username Must be <strong>Alphabetic</strong> Characters');

		if(/*!preg_match("/^[A-Za-z1-9$.\/\*#@%^&()-_`,<>!\'\"\+]+$/", $_POST['admin_password']) ||*/ 
				strlen($_POST['admin_password']) < 6)
			$_SESSION['errors'][] = _x("Admin Password <strong>Incorrect Format</strong> - min lingth for password <strong>6</strong> charecters");

		if(!filter_var($_POST['admin_email'], FILTER_VALIDATE_EMAIL))
			$_SESSION['errors'][] = _x('Incorrect Admin <strong>Email Format</strong>');
	}

	if(isset($_SESSION['errors']) && count($_SESSION['errors']))
		return false;

	$_SESSION['admin_username'] = $_POST['admin_username'];
	$_SESSION['admin_password'] = htmlentities($_POST['admin_password']);
	$_SESSION['admin_email']    = $_POST['admin_email'];
	$_SESSION['admin']  = true;


	header('Location: ready_install');
}