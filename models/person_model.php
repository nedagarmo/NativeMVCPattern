<?php

/**
 * Modelo Persona.  Se encarga de encapsular un objeto (registro) almacenado en la BD.
 * Adicionalmente contiene métodos de modificación de datos CRUD. 
 */
class person_model 
{
    private $id;
    private $name;
    private $identification;
    private $email;
    private $phone;

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
        $sql = "SELECT p.id, p.name, p.identification, p.email, p.phone, u.username FROM person p LEFT JOIN user u ON u.person_id = p.id WHERE p.id = $this->id";

        return $this->db->ExecSelect($sql);
    }

    /**
     * Acción List.  Se encarga de obtener la lista de registros guardados en la base de datos.
     * @return array (matriz de consulta)
    */
    public function list()
    {
        $sql = "SELECT p.id, p.name, p.identification, p.email, p.phone, u.username FROM person p LEFT JOIN user u ON u.person_id = p.id";

        return $this->db->ExecSelect($sql);
    }

    /**
     * Método Insert.  Se encarga de insertar como nuevo registro en la base de datos la información
     * encapsulada en las propiedades respectivas de la clase.
     * @return boolean
    */
    public function insert()
    {
        $sql = "INSERT INTO person (name, identification, email, phone) VALUES ('$this->name', '$this->identification', '$this->email', '$this->phone')";
        return $this->db->ExecQuery($sql);
    }

    /**
     * Método Update.  Se encarga de actualizar un registro existente en la base de datos, basándose en 
     * la información encapsulada en las propiedades respectivas de la clase.
     * @return boolean
    */
    public function update()
    {
        $sql = "UPDATE person  SET name = '$this->name', identification = '$this->identification', email = '$this->email', phone = '$this->phone' WHERE id = $this->id";

        return $this->db->ExecQuery($sql);
    }

    /**
     * Método List Person User.  Lista las personas que tienen asociado un usuario.
     * @return array
    */
    public function list_person_user()
    {
        $sql = "SELECT p.id,p.name from user u, person p where p.id = u.person_id ";

        return $this->db->ExecSelect($sql);
    }

    /**
     * Método Delete.  Elimina la persona y el usuario asociado filtrando por la propiedad id de la clase.
     * @return boolean
    */
    public function delete()
    {
        $sql1 = "DELETE FROM user WHERE person_id = $this->id";

        $this->db->ExecQuery($sql1);

        $sql2 = "DELETE FROM person WHERE id = $this->id";

        return $this->db->ExecQuery($sql2);
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
     * Método de encapsulamiento para obtener la identificación.
     * @return string
    */
    public function get_identification()
    {
        return $this->identification;
    }

    /**
     * Método de encapsulamiento para setear la identificación.
     * @param $identification.
     * @return void
    */
    public function set_identification($identification)
    {
        $this->identification = $identification;
    }

    /**
     * Método de encapsulamiento para obtener el correo electrónico.
     * @return string
    */
    public function get_email()
    {
        return $this->email;
    }

    /**
     * Método de encapsulamiento para setear el email.
     * @param $email.
     * @return void
    */
    public function set_email($email)
    {
        $this->email = $email;
    }

    /**
     * Método de encapsulamiento para obtener el teléfono.
     * @return string
    */
    public function get_phone()
    {
        return $this->phone;
    }

    /**
     * Método de encapsulamiento para setear el teléfono.
     * @param $phone.
     * @return void
    */
    public function set_phone($phone)
    {
        $this->phone = $phone;
    }


}


?>