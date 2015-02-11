<?php

/**
 * createDbAndOtherTransAction
 * 
 * @copyright 2015
 * @version 0.0.1
 * @access public
 * 
 * to create tables
 */
class createDbAndOtherTransAction {

    /**
     *
     * @var type string
     * 
     * database information
     */
    private $_mysqlHost,
            $_mysqlUsername,
            $_mysqlPassword,
            $_mysqlDatabase,
            $_prefix;
    /**
     *
     * @var type array
     * 
     * admin information to insert into table
     */
    private $_admin = array();

    /**
     * createDbAndOtherTransAction::__construct()
     * 
     * @return void
     */
    public function __construct() {
        /**
         * set database information
         */
        $this->_mysqlHost = Input::session('db', 'host');
        $this->_mysqlUsername = Input::session('db', 'user');
        $this->_mysqlPassword = Input::session('db', 'pass');
        $this->_mysqlDatabase = Input::session('db', 'db');
        $this->_prefix = Input::session('db', 'pr');
        
        /**
         * set admin information
         */
        $this->_admin['username'] = Input::session('admin', 'admin');
        $this->_admin['password'] = Input::session('admin', 'pass');
        $this->_admin['email'] = Input::session('admin', 'email');

        /**
         * connect with database
         */
        $this->connect();
    }

    /**
     * createDbAndOtherTransAction::connect()
     * 
     * @return void
     * 
     * connect with database -> type mysql
     */
    private function connect() {
        mysql_connect($this->_mysqlHost, $this->_mysqlUsername, $this->_mysqlPassword);
        mysql_select_db($this->_mysqlDatabase);
    }

    /**
     * createDbAndOtherTransAction::create()
     * 
     * @param string $sql
     * @return boolean
     * 
     * import tables to database
     */
    public function create($sql = '') {
        if ($sql) {
            // Temporary variable, used to store current query
            $templine = '';
            // Read in entire file
            $lines = explode('\n', $sql);
            // Loop through each line
            foreach ($lines as $line) {
                // Skip it if it's a comment
                if (substr($line, 0, 2) == '--' || $line == '')
                    continue;

                // Add this line to the current segment
                $templine .= $line;
                // If it has a semicolon at the end, it's the end of the query
                if (substr(trim($line), -1, 1) == ';') {
                    // Perform the query
                    if (!mysql_query($templine))
                        return false;
                    // Reset temp variable to empty
                    $templine = '';
                }
            }

            return true;
        }


        return false;
    }

    /**
     * createDbAndOtherTransAction::transaction()
     * 
     * @param string $query
     * @return boolean
     * 
     * insert admin information
     */
    public function transaction($query = '') {
        if ($query) {
            if (mysql_query($query))
                return true;

            return false;
        }
        return false;
    }

    /**
     * createDbAndOtherTransAction::getAdmin()
     * 
     * @param mixed $key
     * @return array
     * 
     * return admin information
     */
    public function getAdmin() {
        return $this->_admin;
    }

    /**
     * 
     * @return type string
     * 
     * get prefix tables
     */
    public function getPrefix() {
        return $this->_prefix;
    }

}
