<?php

/**
 * Modelo Task.  Se encarga de encapsular un objeto (registro) almacenado en la BD.
 * Adicionalmente contiene métodos de modificación de datos CRUD. 
 */
class task_model 
{
    private $id;
    private $name;
    private $description;
    private $init_date;
    private $finish_date;
    private $state;
    private $creator_id;
    private $creator_name;
    private $coworkers;
    public $db;

    /**
     * Constructor.  Encargado de crear el objeto a la conexión de base de datos.
     * @return void
    */
    function __construct()
    {
        $this->db = new Connection();
    }

    /**
     * Método GET.  Se encarga de obtener un registro de la base de datos. Se filtra por la propiedad
     * id que antes de la ejecución de este método debió haber sido asignada con el valor 
     * correspondiente.
     * @return array
    */
    public function get()
    {
        $sql = "SELECT t.id,t.name,t.description,t.state,t.init_date,t.finish_date,t.person_id,p.name FROM task t, user u, person p WHERE u.person_id=p.id and t.person_id=u.person_id and t.id=$this->id";

        return $this->db->ExecSelect($sql);
    }

    /**
     * Obtiene la lista de colaboradores
     * @param $id.  Identificador de la tarea
     * @return array
     */
    public function getCoworkers($id)
    {
        $sql = "SELECT p.id,p.name FROM taskXperson txp, person p WHERE txp.task_id  = $id and txp.person_id=p.id";

        return $this->db->ExecSelect($sql);
    }

    /**
     * Acción List.  Se encarga de obtener la lista de registros guardados en la base de datos.
     * @return array (matriz de consulta)
    */
    public function list()
    {
        $sql = "SELECT t.id,t.name,t.description,t.state,t.init_date,t.finish_date,t.person_id,p.name FROM task t, user u, person p WHERE u.person_id=p.id and t.person_id=u.person_id";

        return $this->db->ExecSelect($sql);
    }

    /**
     * Método Insert.  Se encarga de insertar como nuevo registro en la base de datos la información
     * encapsulada en las propiedades respectivas de la clase. Adicionalmente, le asigna a cada 
     * colaborador la tarea.
     * @return boolean
    */
    public function insert()
    {
        $sql = "INSERT INTO task (name, description, state, init_date,finish_date,person_id) VALUES ('$this->name', '$this->description', '$this->state', '$this->init_date', '$this->finish_date','$this->creator')";
        
        $bool=$this->db->ExecQuery($sql);
        $ultimo=$this->db->getLastId();        

        foreach ($this->coworkers as $coworker):
            $sql = "INSERT INTO taskXperson (task_id,person_id) VALUES ('$ultimo','$coworker')"; 
            $bool=$this->db->ExecQuery($sql);
        endforeach;
        
        return $bool;

    }
    
    /**
     * Método Delete.  Elimina la tarea filtrando por la propiedad id de la clase.
     * @return boolean
    */
    public function delete()
    {
        $sql1 = "DELETE FROM taskXperson WHERE task_id = $this->id";
        $bool=$this->db->ExecQuery($sql1);
        $sql1 = "DELETE FROM task WHERE id = $this->id";
        return $this->db->ExecQuery($sql1);       
    }

    /**
     * Método Update.  Se encarga de actualizar un registro existente en la base de datos, basándose en 
     * la información encapsulada en las propiedades respectivas de la clase.  Lo propio con los
     * colaboradores asociados a la tarea.
     * @return boolean
    */
    public function update()
    {
        $sql = "UPDATE task  SET name = '$this->name', description = '$this->description', state = '$this->state', init_date = '$this->init_date', finish_date='$this->finish_date', person_id='$this->creator' WHERE id = $this->id";
        $bool=$this->db->ExecQuery($sql);
        $sql = "DELETE FROM taskXperson WHERE task_id = $this->id";
        $bool=$this->db->ExecQuery($sql);

        foreach ($this->coworkers as $coworker):
            $sql = "INSERT INTO taskXperson (task_id,person_id) VALUES ('$this->id','$coworker')"; 
            $bool=$this->db->ExecQuery($sql);
        endforeach;

        return $bool;
    }

    /**
     * Método de encapsulamiento para obtener el id.
     * @return int
    */
    public function get_id()
    {
        return $this->id;
    }

    /**
     * Método de encapsulamiento para setear el id.
     * @param $id.
     * @return void
    */
    public function set_id($id)
    {
        $this->id = $id;
    }

    /**
     * Método de encapsulamiento para obtener el nombre.
     * @return string
    */
    public function get_name()
    {
        return $this->name;
    }

    /**
     * Método de encapsulamiento para setear el nombre.
     * @param $name.
     * @return void
    */
    public function set_name($name)
    {
        $this->name = $name;
    }

    /**
     * Método de encapsulamiento para obtener la descripción.
     * @return string
    */
    public function get_description()
    {
        return $this->description;
    }

    /**
     * Método de encapsulamiento para setear la descripción.
     * @param $description.
     * @return void
    */
    public function set_description($description)
    {
        $this->description = $description;
    }

    /**
     * Método de encapsulamiento para obtener la fecha de inicio.
     * @return date
    */
    public function get_init_date()
    {
        return $this->init_date;
    }

    /**
     * Método de encapsulamiento para setear la fecha de inicio.
     * @param $init_date.
     * @return void
    */
    public function set_init_date($init_date)
    {
        $this->init_date = $init_date;
    }

    /**
     * Método de encapsulamiento para obtener la fecha de finalización.
     * @return date
    */
    public function get_finish_date()
    {
        return $this->finish_date;
    }

    /**
     * Método de encapsulamiento para setear la fecha de finalización.
     * @param $finish_date.
     * @return void
    */
    public function set_finish_date($finish_date)
    {
        $this->finish_date = $finish_date;
    }

    /**
     * Método de encapsulamiento para obtener el estado de la tarea.
     * @return int
    */    
    public function get_state()
    {
        return $this->state;
    }

    /**
     * Método de encapsulamiento para setear el estado de la tarea.
     * @param $state.
     * @return void
    */
    public function set_state($state)
    {
        $this->state = $state;
    }

    /**
     * Método de encapsulamiento para obtener el creador.
     * @return int
    */
    public function get_creator()
    {
        return $this->creator;
    }

    /**
     * Método de encapsulamiento para setear el creador de la tarea.
     * @param $creator.
     * @return void
    */
    public function set_creator($creator)
    {
        $this->creator = $creator;
    }

    /**
     * Método de encapsulamiento para obtener los colaboradores.
     * @return string
    */
    public function get_coworkers()
    {
        return $this->coworkers;
    }

    /**
     * Método de encapsulamiento para setear los colaboradores de la tarea.
     * @param $coworkers.
     * @return void
    */
    public function set_coworkers($coworkers)
    {
        $this->coworkers = $coworkers;
    }
}
?>