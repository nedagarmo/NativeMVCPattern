<?php

require_once './models/user_model.php';

class UserController
{
    private $model;

    /**
     * Acción Insert.  Encargada de mostrar el formulario de registro de un usuario.
     * @return void
    */
    public function insert()
    {
        $person_id = isset($_GET['id']) ? $_GET['id'] : null;

        require_once "./views/layout/header.php";
        require_once "./views/user/insert.php";
        require_once "./views/layout/footer.php";
    }

    /**
     * Acción Create.  Encargada de validar la información proporcionada por el usuario
     * y ejecutar la operación insert respectiva.
     * @return void
    */
    public function create()
    {
        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        $person_id = isset($_POST['person_id'])  ? $_POST['person_id'] : null;

        if($username == '' || $password=='' || $person_id == '')
        {
            $this->insert();
        }
        else
        {
            $this->model = new user_model($person_id);
            $this->model->set_username($username);
            $this->model->set_password($password);
    
            if($this->model->insert_user())
            {
                $people = $this->model->list();
                require_once "./views/layout/header.php";
                require_once "./views/person/index.php";
                require_once "./views/layout/footer.php";
            }
            else
            {
                $this->insert();
            }
        }   
    }

    /**
     * Acción Edit.  Encargada de mostrar el formulario de edición de un usuario.
     * @return void
    */
    public function edit()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        $this->model = new user_model($id);

        $user = $this->model->get_user()[0];

        require_once "./views/layout/header.php";
        require_once "./views/user/edit.php";
        require_once "./views/layout/footer.php";
    }

    /**
     * Acción Update.  Encargada de validar la información proporcionada por el usuario
     * y ejecutar la respectiva operación update.
     * @return void
    */
    public function update()
    {
        $person_id = isset($_POST['person_id']) ? $_POST['person_id'] : null;
        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        $old_password = isset($_POST['old_password']) ? $_POST['old_password'] : null;
        $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : null;
        $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;

        if($person_id == '' ||$username == '' || $password =='' || $old_password == '' || $new_password == '' || $confirm_password == '')
        {
            $_GET['id'] = $id;
            $this->edit();
        }
        else
        {
            if(($password == $old_password) && ($new_password == $confirm_password))
            {
                $this->model = new user_model($person_id);
                
                $this->model->set_username($username);
                $this->model->set_password($password);
        
                if($this->model->update_user())
                {
                    $people = $this->model->list();
                    require_once "./views/layout/header.php";
                    require_once "./views/person/index.php";
                    require_once "./views/layout/footer.php";
                }
                else
                {
                    $_GET['id'] = $person_id;
                    $this->edit();
                }
            }
            else
            {
                $_GET['id'] = $person_id;
                $this->edit();
            }
        }   
    }
}

?>