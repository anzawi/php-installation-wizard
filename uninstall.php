<?php
/**
 * Delete All installation files and folders
 */

error_reporting(0);
if (isset($_GET['uninstall'])) {
    define('ROOT', dirname(__FILE__) . '/');
    define('CLS', ROOT . 'installation/classes/');
    define('FUNC', ROOT . 'installation/functions/');

        // error to store errors if found
        $errors = array();
        
        // all installation files directory
        $files = array(
            CLS . 'checkRequired.php',
            CLS . 'input.php',
            CLS . 'createDbAndOtherTransAction.php',
            
            ROOT . 'installation/css/bootstrap.css',
            ROOT . 'installation/css/style.css',
            ROOT . 'installation/css/loader.gif',
            
            FUNC . 'autoload.php',
            FUNC . 'testConnection.php',
            
            ROOT . 'installation/footer.php',
            ROOT . 'installation/header.php',
            ROOT . 'installation/stepFive.php',
            ROOT . 'installation/stepFour.php',
            ROOT . 'installation/stepOne.php',
            ROOT . 'installation/stepThree.php',
            ROOT . 'installation/stepTow.php',
            ROOT . 'installation/InitializedDatabase.js',
            
            ROOT . 'sql.php',
            ROOT . 'install.php',
        );
        
        // delete files
        foreach ($files as $file) {
            if (!unlink($file)) {
                $errors[] = 'the file in directory ( ' . $file . ' ) unable to removed automatically ';
            }
        }
        // all installation folders directory
        $folders = array(
            CLS,
            FUNC,
            ROOT . 'installation/css',
            ROOT . 'installation'
            
        );
        
        // delete folders
        foreach ($folders as $folder) {
            if (!rmdir($folder)) {
                $errors[] = 'the folder in directory ( ' . $folder . ' ) unable to removed automatically ';
            }
        }
        
        // if no errors redirect to login form else echo errors
        if (count($errors) < 1) {
            header('Location:' . $_SERVER['SERVER_NAME'] . 'wizard/admin/login.php');
        } else {
            echo "<center>";

            foreach ($errors as $error) {
                echo $error . '<br>';
            }

            echo "</center>";
        }
    }
