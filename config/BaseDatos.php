<?php 

//Inclusion de manejador de errores
include_once('NewError.php');

//Creacion de la clase BaseDatos
    class BaseDatos 
    {
        //Constantes de conexión de laa base de datos
        private $host = 'localhost';
        private $dbname = 'computacionservidorweb';
        private $username = 'root';
        private $password = '';

        //Variables de conexión
        private $conn;
        private $error;

        //Constructor de clase
        public function __construct()
        {
            //Inicializacion del manejador de errores
            $this->error = new NewError();
        }


        //Función para iniciar conexión
        public function conexion()
        {
            $this->conn = null;

            try
            {
                //Inicialización de PDO con cadena de conexión
                $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->username,$this->password);

                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                //Mensaje de error
                $this->error->throwError(500, 'Error de conexión: ' . $e->getMessage());
            }

            //Retorno de la conexión
            return $this->conn;
        }
    }

?>