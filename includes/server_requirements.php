<?php
if(isset($_POST['req_is_pass']) && $_POST['req_is_pass'] === 'Continue')
{
	if(\Wizaraty\Classes\Token::check($_POST['_token']))
	{
		$_SESSION['req'] = true;
		header('location: db_settings');
		exit();
	}
}
	
use \Wizaraty\Classes\Requirement;
use \Wizaraty\Classes\Config;

$requerment = new Requirement();
$req = [];

/**
 * get all Requirment from Config file
 */
foreach (Config::get("requirements") as $methodName => $isEnable) 
{
	// check if requirment is not have false value
	if($isEnable !== false)
	{
		if(!call_user_func_array([$requerment, $methodName], [true]))
		{
			$req[$methodName] = false;
		}
		else
		{
			$req[$methodName] = true;
		}
	}
}