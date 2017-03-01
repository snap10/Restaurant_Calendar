<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('DBHandler.php');
require_once ('utils/helper.php');

if (isset($_GET['controller']) && isset($_GET['action'])) {
$controller = $_GET['controller'];
$action     = $_GET['action'];
}else{
$controller = 'pages';
$action     = 'home';
}

/**
Enforce Controllercode before Layouts gets loaded to be able to change header information
Every Controller that wants to change header information should go here.
*/
if(strcmp($controller,'session')==0){
    require_once('routes.php');
}


require_once('views/layout.php');

?>