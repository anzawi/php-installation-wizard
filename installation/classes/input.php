<?php

/**
 * Input
 * 
 * @copyright 2015
 * @version 0.0.1
 * @access public
 */
class Input {

    /**
     * Input::get()
     * 
     * get posted/geted value
     * 
     * @param mixed $item
     * @return string
     */
    public static function get($item) {
        // if post the item return item value
        if (isset($_POST[$item])) {
            return $_POST[$item];
            // if get the item return item value
        } else if (isset($_GET[$item])) {
            return $_GET[$item];
        }
        
        // if not post/get return empty string
        return '';
    }

    /**
     * Input::setSession()
     * insert session
     * @param mixed $name
     * @param mixed $value
     * @return string
     */
    public static function setSession($name, $value) {
        // set session called $name and value is $value
        return $_SESSION[$name] = $value;
    }

    /**
     * Input::deleteSession()
     * delete session
     * @param mixed $name
     * @return void
     */
    public static function deleteSession($name) {
        // is session exsist delete it
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * Input::session()
     * 
     * @param mixed $item
     * @param string $value
     * @return string
     */
    public static function session($item, $value = '') {
        // if $value isset then call array session so return value of key $item
        if ($value) {
            if (isset($_SESSION[$item][$value])) {
                return $_SESSION[$item][$value];
            }
        }
        
        // if $value not set then return session $item value
        if (isset($_SESSION[$item])) {
            return $_SESSION[$item];
        }

        return '';
    }

}
