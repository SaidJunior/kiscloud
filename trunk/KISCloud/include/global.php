<?php

/*
 * DB Connection
 */

$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host=localhost;dbname=KISCLOUD', 'root', 'p@ssw0rd', $pdo_options);

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$PATH_FILE = "/var/www/html/KISCloud";
$PATH = $_SERVER['DOCUMENT_ROOT'] . "/KISCloud/";

if(empty($_SERVER['DOCUMENT_ROOT'])){
    //PHP CLI
    $PATH=$PATH_FILE;
}

/*
 * Include Core Objects
 */

include_once $PATH . '/core/Connectors/SSHConnector.php';
include_once $PATH . '/core/KisCore.php';
include_once $PATH . '/core/SSHParser.php';
include_once $PATH . '/core/CoreObjects.php';
?>
