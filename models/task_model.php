<?php

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

    function __construct()
    {
    
        $this->db = new Connection();
    }

    public function get()
    {
        $sql = "SELECT t.id,t.name,t.description,t.state,t.init_date,t.finish_date,t.person_id,p.name FROM task t, user u, person p WHERE u.person_id=p.id and t.person_id=u.person_id and t.id=$this->id";

        return $this->db->ExecSelect($sql);
    }


    public function getCoworkers($id)
    {
        $sql = "SELECT p.id,p.name FROM taskXperson txp, person p WHERE txp.task_id  = $id and txp.person_id=p.id";

        return $this->db->ExecSelect($sql);
    }

    
    public function list()
    {
        $sql = "SELECT t.id,t.name,t.description,t.state,t.init_date,t.finish_date,t.person_id,p.name FROM task t, user u, person p WHERE u.person_id=p.id and t.person_id=u.person_id";

        return $this->db->ExecSelect($sql);
    }


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
 
    public function delete()
    {
        $sql1 = "DELETE FROM taskXperson WHERE task_id = $this->id";
        $bool=$this->db->ExecQuery($sql1);
        $sql1 = "DELETE FROM task WHERE id = $this->id";
        return $this->db->ExecQuery($sql1);       
    }



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

    
    public function get_id()
    {
        return $this->id;
    }

    public function set_id($id)
    {
        $this->id = $id;
    }

    
    public function get_name()
    {
        return $this->name;
    }

    public function set_name($name)
    {
        $this->name = $name;
    }

    
    public function get_description()
    {
        return $this->description;
    }

    public function set_description($description)
    {
        $this->description = $description;
    }

    public function get_init_date()
    {
        return $this->init_date;
    }

    public function set_init_date($init_date)
    {
        $this->init_date = $init_date;
    }

    
    public function get_finish_date()
    {
        return $this->finish_date;
    }

    public function set_finish_date($finish_date)
    {
        $this->finish_date = $finish_date;
    }

        
    public function get_state()
    {
        return $this->state;
    }

    public function set_state($state)
    {
        $this->state = $state;
    }


    public function get_creator()
    {
        return $this->creator;
    }

    public function set_creator($creator)
    {
        $this->creator = $creator;
    }

    public function get_coworkers()
    {
        return $this->coworkers;
    }

    public function set_coworkers($coworkers)
    {
        $this->coworkers = $coworkers;
    }


 

}
?>