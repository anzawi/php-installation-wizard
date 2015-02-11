<?php
/**
 * this file to write database (sql statements).
 * 
 * variable to tables structure and another variable to insert or other transaction
 */
$sql = <<<SQL
CREATE TABLE {$db->getPrefix()}persons
(
PersonID int,
LastName varchar(255),
FirstName varchar(255),
Address varchar(255),
City varchar(255)
);
SQL;

$insertAdminInformation = "INSERT INTO "
        . "{$db->getPrefix()}persons "
        . "(PersonID,LastName,FirstName) "
                . "VALUES "
                . "(1, '{$db->getAdmin()['username']}', '{$db->getAdmin()['password']}');";
?>