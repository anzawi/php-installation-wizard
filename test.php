<?php
session_start();

$_SESSION['db_host']		= 'localhost';
$_SESSION['db_name']		= 'wizaraty';
$_SESSION['db_username']	= 'root';
$_SESSION['db_password']	= '';

$_SESSION['admin_username']  = 'username';
$_SESSION['admin_password']  = 'email';
$_SESSION['admin_email']  = 'password';


include_once('vendor/autoload.php');