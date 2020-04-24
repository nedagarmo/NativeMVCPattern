<?php

/** 
 * Clase de conexión
 * En cargada de permitir el acceso a la base de datos, de todo el sistema, 
 * mediante el controlador mysqli.
*/
class Connection 
{
    private $Server;
    private $User;
    private $Password;
    private $Database;
    private $Connection;

    /**
     * Constructor de la clase. Será el encargado de crear la conexión y encapsularla en la propiedad
     * correspondiente.
     * @return void
    */
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

    /**
     * Este método se encargará de ejecutar la query parametrizada y devolverá un array 
     * con los resultados.
     * @param $sql es la query que se ejecutará.
     * @return array
    */
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

    /**
     * Este método se encargará de ejecutar la query parametrizada y devolverá un 
     * bool según lo haya hecho con o sin errores.
     * @param $sql es la query que se ejecutará.
     * @return boolean
    */
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

    /**
     * Este método se encargará de consultar el id del último registro insertado.
     * @return int
    */
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

    /**
     * Este método se encargará de cerrar la conexión que se abre con la instancia
     * de esta clase, pues se crea en el constructor.
     * @return void
    */
    public function CloseConnection()
    {
        $this->Connection->close();
    }
}
?>