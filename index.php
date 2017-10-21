<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'init.php';
require_once 'helpers.php';

if (isset($_REQUEST['controller']) && isset($_REQUEST['action'])) {
    $controller = $_REQUEST['controller'];
    $action     = $_REQUEST['action'];
} else {
    $controller = 'users';
    $action     = 'home';
}

require_once 'views/layout.php';
