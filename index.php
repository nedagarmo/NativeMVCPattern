<?php

require_once "config/connection.php";
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

    $action = isset($_GET['a']) ? $_GET['a'] : "Index";

    call_user_func(array($controller, $action));
}
?>