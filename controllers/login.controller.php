<?php

require_once './models/user_model.php';
require_once './controllers/home.controller.php';

/**
 * Controlador encargado de administrar la seguridad en el sistema.  Por medio de sus accions
 * el usuario se podrá loguear o desloguear.
*/
class LoginController
{
    private $model;

    public function __construct()
    {
       
    }

    /**
     * Acción Index.  Encargada de mostrar el formulario del login al usuario.
     * @param $message.  Es el mensaje que se quiere mostrar como feedback al usuario.
     * @return void
    */
    public function index($message = "")
    {
        require_once "./views/layout/header.php";
        if(isset($message) && !empty($message))
        {
            require_once "./views/layout/message.php";   
        }
        require_once "./views/user/index.php";
        require_once "./views/layout/footer.php";
    }

    /**
     * Acción Login.  Encargada de realizar la validación de las credenciales de acceso
     * proporcionadas por el usuario.
     * @return void
    */
    public function login()
    {
        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;

        if($username == '' || $password=='')
        {
            $this->index("Usuario y/o contraseña inválidos.");
        }
        else
        {
            $this->model = new user_model(null);
            $user = $this->model->get_user_by_login($username, $password);
            if($user != null)
            {
                $_SESSION['person'] = serialize($user);
                $home_controller = new HomeController();
                $home_controller->index();
            }
            else
            {
                $this->index("Usuario y/o contraseña inválidos.");
            }
        }
    }

    /**
     * Acción Logout. Se encarga de destruir la sesión y direccionar al formulraio 
     * de login al usuario.
     * @return void
    */
    public function logout()
    {
        session_destroy();
        $this->index();
    }
}

?>