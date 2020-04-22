<?php

class HomeController
{
    private $model;

    public function __construct()
    {
       // $this->model = new Person();
    }

    public function Index()
    {
        require_once "./views/layout/header.php";
        require_once "./views/home/index.php";
        require_once "./views/layout/footer.php";
    }
}

?>