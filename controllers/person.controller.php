<?php

require_once './models/person_model.php';

class PersonController
{
    private $model;

    public function __construct()
    {
       $this->model = new person_model();
    }

    public function index()
    {
        $people = $this->model->list();
        require_once "./views/layout/header.php";
        require_once "./views/person/index.php";
        require_once "./views/layout/footer.php";
    }

    public function insert()
    {
        require_once "./views/layout/header.php";
        require_once "./views/person/insert.php";
        require_once "./views/layout/footer.php";
    }

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

    public function edit()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $this->model->set_id($id);
        $person = $this->model->get()[0];

        require_once "./views/layout/header.php";
        require_once "./views/person/edit.php";
        require_once "./views/layout/footer.php";
    }

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

    public function delete()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $this->model->set_id($id);
        $person = $this->model->get()[0];

        require_once "./views/layout/header.php";
        require_once "./views/person/delete.php";
        require_once "./views/layout/footer.php";
    }

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