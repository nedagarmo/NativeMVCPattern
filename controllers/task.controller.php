<?php

require_once './models/task_model.php';
require_once './models/person_model.php';


class TaskController
{
    private $model;
    private $modelPersona;

    /**
     * Constructor.  Encapsula el modelo en la propeidad correspondiente.
     * @return void
    */
    public function __construct()
    {
       $this->model = new task_model();
       $this->modelPersona = new person_model();      
    }
    
    /**
     * Acción Index.  Encargada de mostrar la lista de tareas guardadas en la base de datos.
     * @return void
    */
    public function index()
    {         
        $tasks = $this->model->list();
        $tamanio = count($tasks);       
        for ($x=0;$x<$tamanio; $x++){
            $coworkers = $this->model->getCoworkers($tasks[$x][0]);    
            array_push ( $tasks[$x] , $coworkers );
        }           
       
        require_once "./views/layout/header.php";
        require_once "./views/task/index.php";
        require_once "./views/layout/footer.php";
    }

    /**
     * Acción Insert.  Encargada de mostrar el formulario de registro de una tarea.
     * @return void
    */
    public function insert()
    {
        $people = $this->modelPersona->list();
        $users = $this->modelPersona->list_person_user();
        require_once "./views/layout/header.php";
        require_once "./views/task/insert.php";
        require_once "./views/layout/footer.php";
    }

    /**
     * Acción Edit.  Encargada de mostrar el formulario de edición de una tarea
     * @return void
    */
    public function edit()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $this->model->set_id($id);
        $task = $this->model->get()[0];
        $coworkers = $this->model->getCoworkers($task[0]);      
        array_push ( $task , $coworkers );
        $people = $this->modelPersona->list();
        $users = $this->modelPersona->list_person_user();
        require_once "./views/layout/header.php";
        require_once "./views/task/edit.php";
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
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $state = isset($_POST['state'])  ? $_POST['state'] : null;
        $initDate = isset($_POST['initDate']) ? $_POST['initDate'] : null;
        $finishDate = isset($_POST['finishDate']) ? $_POST['finishDate'] : null;
        $creator = isset($_POST['creator']) ? $_POST['creator'] : null;
        $coworkers = isset($_POST['coworkers']) ? $_POST['coworkers'] : null;
      

        if($name == '' || $description=='' || $state == '' || $initDate == '' || $finishDate=='' || $creator=='' ||  $coworkers=='' )
        {
            $this->insert();
        }
        else
        {
            $this->model->set_name($name);
            $this->model->set_description($description);
            $this->model->set_state($state);
            $this->model->set_init_date($initDate);
            $this->model->set_finish_date($finishDate);
            $this->model->set_creator($creator);
            $this->model->set_coworkers($coworkers);
  
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
     * Acción Delete.  Encargada de mostrar el formulario de confirmación para eliminar
     * el registro.
     * @return void
    */
    public function delete()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : null;       
        $this->model->set_id($id);
        $task = $this->model->get()[0];
        $coworkers = $this->model->getCoworkers($task[0]);    
        array_push ( $task , $coworkers ); 

        require_once "./views/layout/header.php";
        require_once "./views/task/delete.php";
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

    /**
     * Acción Update.  Encargada de validar la información proporcionada por el usuario
     * y ejecutar la respectiva operación update.
     * @return void
    */
    public function update()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $state = isset($_POST['state'])  ? $_POST['state'] : null;
        $initDate = isset($_POST['initDate']) ? $_POST['initDate'] : null;
        $finishDate = isset($_POST['finishDate']) ? $_POST['finishDate'] : null;
        $creator = isset($_POST['creator']) ? $_POST['creator'] : null;
        $coworkers = isset($_POST['coworkers']) ? $_POST['coworkers'] : null;

        if($id == '' || $name == '' || $description=='' || $state == '' || $initDate == '' || $finishDate=='' || $creator=='' ||  $coworkers=='')
        {
            $_GET['id'] = $id;
            $this->edit();
        }
        else
        {
            $this->model->set_id($id);
            $this->model->set_name($name);
            $this->model->set_description($description);
            $this->model->set_state($state);
            $this->model->set_init_date($initDate);
            $this->model->set_finish_date($finishDate);
            $this->model->set_creator($creator);
            $this->model->set_coworkers($coworkers);
    
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
}

?>