<?php

class Connection 
{
    private $Server;
    private $User;
    private $Password;
    private $Database;
    private $Connection;

    public function __construct()
    {
        $this->Server = "localhost";
        $this->User = "root";
        $this->Password = "";
        $this->Database = "taskmanager";

        $this->Connection = new mysqli($this->Server, $this->User, $this->Password, $this->Database);

        if (mysqli_connect_errno()) {
            printf("Error de conexión: %s\n", mysqli_connect_error());
            exit();
        }
    }

    public function ExecSelect($sql)
    {
        try 
        {
            $container = $this->Connection->Query($sql);
            return $container->fetch_all();
        }
        catch (\Throwable $th) 
        {
            return null;
        }
        
    }

    public function ExecQuery($sql)
    {
        try 
        {
            $this->Connection->Query($sql);

            return true;
        } 
        catch (\Throwable $th) 
        {
            return false;
        }        
    }

    public function getLastId()
    {
        try 
        {            
            return $this->Connection->insert_id;
        } 
        catch (\Throwable $th) 
        {
            return false;
        }        
    }





    public function CloseConnection()
    {
        $this->Connection->close();
    }
}
?>