<?php
/**
 * 
 * @param type mixed $host
 * @param type mixed $username
 * @param type mixed $pass
 * @param type mixed $db
 * @param type mixed $pref
 * @return boolean true if can connect , false if not
 */
function testConnection($host = '', $username = '', $pass = '', $db = '', $pref = '') {
    // if $host isset check if can connect with database
    if ($host) {
        // delete testConnection session
        Input::deleteSession('testConnection');
        try {
            // connect with database use pdo
            $conn = new PDO('mysql:host=' . $host . ';dbname=' . $db . '', $username, $pass);
            
            // set database connection in session array called db
            Input::setSession('db', array(
                'host' => $host,
                'user' => $username,
                'db'   => $db,
                'pass' => $pass,
                'pr'   => $pref
            ));
            // return true
            return true;
        } catch (PDOException $e) {
            // if connect false or cant set connection information teurn false
            return false;
        }
    }
    return false;
}

/**
 * 
 * @param type int $num
 * @return string
 * 
 * convert strep number to string (the page name)
 */
function conv($num) {
    $page = 'stepOne';
    if (is_numeric($num)) {
        switch ($num) {
            case 2: $page = 'stepTow';
                break;
            case 3: $page = 'stepThree';
                break;
            case 4: $page = 'stepFour';
                break;
            case 5: $page = 'stepFive';
        }
    }

    return $page;
}
