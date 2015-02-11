<?php

/**
 * this main page 
 * define all variables
 */
// do not show to user any error from server
error_reporting(0);
// kill session when browser closed
session_set_cookie_params(0);
// start session
session_start(); 

// define require directory
define('ROOT', dirname(__FILE__) . '/'); // root folder 
define('CLS', ROOT . 'installation/classes/'); // classes folder
define('FUNC', ROOT . 'installation/functions/'); // functions folder

// define domain name 
define('SITE', 'http://' . $_SERVER['SERVER_NAME'] . '/');

// include functions
require_once FUNC . 'autoload.php';
require_once FUNC . 'testConnection.php';

// autoload classes
spl_autoload_register('autoloader');

// get header
require_once ROOT . 'installation/header.php';
// if isset step convert step number to file name of this step and include it
if (isset($_GET['step']) && is_numeric($_GET['step'])) {
    $step = $_GET['step'];
    if (is_file(ROOT . 'installation/' . conv($step) . '.php')) {
        include_once ROOT . 'installation/' . conv($step) . '.php';
    } else {
        include_once ROOT . 'installation/stepOne.php';
    }
    // if step is not isset incluse step one
} else {
    include_once ROOT . 'installation/stepOne.php';
}
// get footer
require_once ROOT . 'installation/footer.php';
