<?php

class person_model 
{
    private $id;
    private $name;
    private $description;
    private $init_date;
    private $finish_date;
    private $state;
    private $creator;
    private $coworkers;

    function __construct($id, $name, $description, $init_date, $finish_date, $state, $creator, $coworkers)
    {
        $this->id = $id;
        $this->name = $name;
        $this->identification = $identification;
        $this->init_date = $init_date;
        $this->finish_date = $finish_date;
        $this->state = $state;
        $this->creator = $creator;
        $this->coworkers = $coworkers;
    }
}


?>