<?php

require_once './models/person_model.php';

/**
 * Controlador encargado de las operaciones sobre el modelo persona.
*/
class PersonController
{
    private $model;

    /**
     * Constructor.  Encapsula el modelo en la propeidad correspondiente.
     * @return void
    */
    public function __construct()
    {
       $this->model = new person_model();
    }

    /**
     * Acción Index.  Encargada de mostrar la lista de personas.
     * @return void
    */
    public function index()
    {
        $people = $this->model->list();
        require_once "./views/layout/header.php";
        require_once "./views/person/index.php";
        require_once "./views/layout/footer.php";
    }

    /**
     * Acción Insert.  Encargada de mostrar el formulario de registro de una persona.
     * @return void
    */
    public function insert()
    {
        require_once "./views/layout/header.php";
        require_once "./views/person/insert.php";
        require_once "./views/layout/footer.php";
    }

    /**
     * Acción Create.  Encargada de validar la información proporcionada por el usuario
     * y ejecutar la operación insert respectiva.
     * @return void
    */
    public function create()
    {
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $identification = isset($_POST['identification']) ? $_POST['identification'] : null;
        $email = isset($_POST['email'])  ? $_POST['email'] : null;
        $phone = isset($_POST['phone']) ? $_POST['phone'] : null;

        if($name == '' || $identification=='' || $email == '' || $phone == '')
        {
            $this->insert();
        }
        else
        {
            $this->model->set_name($name);
            $this->model->set_identification($identification);
            $this->model->set_email($email);
            $this->model->set_phone($phone);
    
            if($this->model->insert())
            {
                $this->index();
            }
            else
            {
                $this->insert();
            }
        }   
    }

    /**
     * Acción Edit.  Encargada de mostrar el formulario de edición de una persona
     * @return void
    */
    public function edit()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $this->model->set_id($id);
        $person = $this->model->get()[0];

        require_once "./views/layout/header.php";
        require_once "./views/person/edit.php";
        require_once "./views/layout/footer.php";
    }

    /**
     * Acción Update.  Encargada de validar la información proporcionada por el usuario
     * y ejecutar la respectiva operación update.
     * @return void
    */
    public function update()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $identification = isset($_POST['identification']) ? $_POST['identification'] : null;
        $email = isset($_POST['email'])  ? $_POST['email'] : null;
        $phone = isset($_POST['phone']) ? $_POST['phone'] : null;

        if($id == '' ||$name == '' || $identification=='' || $email == '' || $phone == '')
        {
            $_GET['id'] = $id;
            $this->edit();
        }
        else
        {
            $this->model->set_id($id);
            $this->model->set_name($name);
            $this->model->set_identification($identification);
            $this->model->set_email($email);
            $this->model->set_phone($phone);
    
            if($this->model->update())
            {
                $this->index();
            }
            else
            {
                $_GET['id'] = $id;
                $this->edit();
            }
        }   
    }

    /**
     * Acción Delete.  Encargada de mostrar el formulario de confirmación para eliminar
     * el registro.
     * @return void
    */
    public function delete()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $this->model->set_id($id);
        $person = $this->model->get()[0];

        require_once "./views/layout/header.php";
        require_once "./views/person/delete.php";
        require_once "./views/layout/footer.php";
    }

    /**
     * Acción Confirm_Delete.  Encargada de ejecutar la eliminación del registro en la 
     * base de datos.
     * @return void
    */
    public function confirm_delete()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : null;

        if($id == '')
        {
            $_GET['id'] = $id;
            $this->delete();
        }
        else
        {
            $this->model->set_id($id);
    
            if($this->model->delete())
            {
                $this->index();
            }
            else
            {
                $_GET['id'] = $id;
                $this->delete();
            }
        }   
    }
}

?>