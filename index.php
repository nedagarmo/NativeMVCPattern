<?php
session_start();
require_once "config/connection.php";
$action = isset($_GET['a']) ? $_GET['a'] : "Index";

if(isset($_SESSION['person']))
{
    if(!isset($_GET['c']))
    {
        require_once "controllers/home.controller.php";

        $controller = new HomeController();
        call_user_func(array($controller,"Index"));
    }
    else
    {
        $controller = $_GET['c'];

        require_once "controllers/$controller.controller.php";

        $controller = ucwords($controller)."Controller";
        $controller = new $controller;

        call_user_func(array($controller, $action));
    }
}
else
{
    require_once "controllers/login.controller.php";

    $controller = new LoginController();
    call_user_func(array($controller, $action));
}
?>