<?php

/**
 * CheckRequired
 * 
 * @copyright 2015
 * @version 0.0.1
 * @access public
 * 
 * check system Requirement
 */
class CheckRequired {

    private $_pdoExtention,
            $_phpVirsion,
            $_safeMode,
            $_errors = false;

    

    /**
     * CheckRequired::__construct()
     * 
     * @return void
     */
    public function __construct() {
        /**
         * set all var's eqal false
         */
        $this->_pdoExtention = false;
        $this->_phpVirsion   = false;
        $this->_safeMode     = false;
        
        /**
         * called check methods
         */
        $this->checkPdoEx();
        $this->checkPhpVr();
        $this->checkSafeMo();
    }

    /**
     * CheckRequired::checkPdoEx()
     * 
     * @return void
     * 
     * check if pdo Extention are installed or not
     * if installed set @var _pdoExtention eqal true else _errors equal true
     */
    private function checkPdoEx() {
        if(defined('PDO::ATTR_DRIVER_NAME')) {
            $this->_pdoExtention = true;
        } else {
            $this->_errors = true;
        }
    }
    
    /**
     * CheckRequired::checkPhpVr()
     * 
     * @return void
     * check PHP Virsion if greater than than 5.3.0 set @var _phpVirsion eqal true else _errors true
     */
    private function checkPhpVr() {
        if(phpversion() >= 5.3) {
            $this->_phpVirsion = true;
        } else {
            $this->_errors = true;
        }
    }
    
    /**
     * CheckRequired::checkSafeMo()
     * 
     * @return void
     * 
     * check PHP safemode if turned on  set @var _safeMode eqal false else _errors equal true
     */
    private function checkSafeMo() {
        if(!ini_get('safe_mode')) {
            $this->_safeMode = true;
        } else {
            $this->_errors = true;
        }
    }
    
    /**
     * CheckRequired::pdo()
     * 
     * @return boolean
     */
    public function pdo() {
        return $this->_pdoExtention;
    }
    
    /**
     * CheckRequired::php()
     * 
     * @return boolean
     */
    public function php() {
        return $this->_phpVirsion;
    }
    
    /**
     * CheckRequired::safeMode()
     * 
     * @return boolean
     */
    public function safeMode() {
        return $this->_safeMode;
    }

    
    /**
     * CheckRequired::whatePhpVirsion()
     * 
     * @return int
     * 
     * get PHP Virsion
     */
    public function whatePhpVirsion() {
        $v = phpversion();
        $v = explode('.', $v);
        array_pop($v);
        $v = implode('.', $v);
        
        return $v;
    }
    
    /**
     * CheckRequired::errors()
     * 
     * @return bool
     */
    public function errors() {
        return $this->_errors;
    }
}
