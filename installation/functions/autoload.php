<?php
/**
 * 
 * @param type $class
 * 
 * autoload classes
 */
function autoloader($class) {
    require_once CLS . $class . '.php';
}