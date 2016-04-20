<?php 
if(!isset($_SESSION['db_host']))
{
	$_SESSION['help'] = _x("Plase Enter Database Information Agian");
	header('location: db_settings');
}

if(!isset($_SESSION['admin']))
	header('location: admin_account');