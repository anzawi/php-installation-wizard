<?php

session_start();
require_once(__DIR__ . '/vendor/autoload.php');
use \Wizaraty\Classes\Url;

$url = new Url('/');
require_once('func/function.php');
include_once('template/main.php');
