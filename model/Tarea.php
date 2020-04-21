<?php
//Creacion de la clase Tarea
    class Tarea
    {
        //Variable de conexión
        private $conn;

        //Tabla de la base de datos
        private $tabla = 'tarea';

        //Variables de la clase
        public $codigo;
        public $nombre;
        public $descripcion;        
        public $fechaInicio;
        public $fechaFin;
        public $estado;

        //Constructor de la clase con inyección de la conexión de base de datos
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //Función para leer un registro
        public function leer()
        {
            //Construccion de consulta SELECT
            $query = 'SELECT * FROM ' . $this->tabla . ' WHERE codigo = ? LIMIT 0,1';

            //Preparación de la consulta
            $stmt = $this->conn->prepare($query);

            //Anidación de variable
            $stmt->bindParam(1, $this->codigo);

            //Ejecución de la consulta
            $stmt->execute();

            //Extración de la respuesta
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Asignacion a variables de la columnas de la tabla
            $this->codigo = $row['codigo'];
            $this->nombre = $row['nombre'];
            $this->descripcion = $row['descripcion'];
            $this->fechaInicio = $row['fechaInicio'];
            $this->fechaFin = $row['fechaFin'];
            $this->estado = $row['estado'];

            //Retorno de la respuesta
            return $stmt;
        }

        //Función para leer todos los registros registro
        public function leerTodos()
        {
            //Construcción de consulta SELECT
            $query = 'SELECT * FROM ' . $this->tabla . ' WHERE estado = 1';

             //Preparación de la consulta
            $stmt = $this->conn->prepare($query);

            //Ejecución de la consulta
            $stmt->execute();

            //Retorno de la respuesta
            return $stmt;
        }

        //Función para insertar registro
        public function insertar()
        {
            //Construcción de consulta INSERT
            $query = 'INSERT INTO ' . $this->tabla . ' SET 
            nombre =:nombre,
            descripcion =:descripcion,
            fechaInicio =:fechaInicio,
            fechaFin =:fechaFin,
            estado =:estado';
            
            //Preparación de la consulta
                $stmt = $this->conn->prepare($query);

                //Anidación de variableS
                $this->nombre = htmlspecialchars(strip_tags($this->nombre));
                $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
                $this->fechaInicio = htmlspecialchars(strip_tags($this->fechaInicio));
                $this->fechaFin = htmlspecialchars(strip_tags($this->fechaFin));
                $this->estado = htmlspecialchars(strip_tags($this->estado));

                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->bindParam(':descripcion', $this->descripcion);
                $stmt->bindParam(':fechaInicio', $this->fechaInicio);
                $stmt->bindParam(':fechaFin', $this->fechaFin);
                $stmt->bindParam(':estado', $this->estado);

                //Ejecución de la consulta
                if($stmt->execute())
                {
                    return true;
                }
                else
                {
                    printf("Error: %s.\n", $stmt->error);
                    return false;
                }

        }

        //Función para actualizar registro
        public function actualizar()
        {
            //Construcción de consulta UPDATE
            $query = 'UPDATE ' . $this->tabla . ' SET
            nombre =:nombre,
            descripcion =:descripcion,
            fechaInicio =:fechaInicio,
            fechaFin =:fechaFin,
            estado =:estado
            WHERE 
            codigo =:codigo';

            //Preparación de la consulta
                $stmt = $this->conn->prepare($query);

                //Anidación de variables
                $this->nombre = htmlspecialchars(strip_tags($this->nombre));
                $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
                $this->fechaInicio = htmlspecialchars(strip_tags($this->fechaInicio));
                $this->fechaFin = htmlspecialchars(strip_tags($this->fechaFin));
                $this->estado = htmlspecialchars(strip_tags($this->estado));

                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->bindParam(':descripcion', $this->descripcion);
                $stmt->bindParam(':fechaInicio', $this->fechaInicio);
                $stmt->bindParam(':fechaFin', $this->fechaFin);
                $stmt->bindParam(':estado', $this->estado);

                //Ejecución de la consulta
                if($stmt->execute())
                {
                    return true;
                }
                else
                {
                    printf("Error: %s.\n", $stmt->error);
                    return false;
                }

        }

        //Función para eliminar registro
        public function eliminar()
        {
            //Construcción de consulta DELETE
            $query = 'DELETE FROM ' . $this->tabla . ' WHERE codigo =:codigo';

            //Preparación de la consulta
            $stmt = $this->conn->prepare($query);

            //Eliminación de caracteres especiales
            $this->codigo = htmlspecialchars(strip_tags($this->codigo));

            //Anidación de variables
            $stmt->bindParam(':codigo', $this->codigo);

            //Ejecución de la consulta
            if($stmt->execute())
            {
                return true;
            }
            else
            {
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
        }

    }