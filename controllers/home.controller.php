<?php

/**
 * Este controlador está encargado de mostrar la pantalla principal del sistema
 * y sus servicios generales (Acerca de, Ayuda, Soporte, entre otros).
*/
class HomeController
{
    // Propiedad que encapsula el modelo principal del controlador
    private $model;

    /**
     * Constructor de la clase.
     * @return void
    */
    public function __construct()
    {
    }

    /**
     * Acción Index.  Es la encargada de recibir al usuario luego del login.
     * Funciona como acción menú del sistema.
     * @return void
    */
    public function Index()
    {
        require_once "./views/layout/header.php";
        require_once "./views/home/index.php";
        require_once "./views/layout/footer.php";
    }
}

?>