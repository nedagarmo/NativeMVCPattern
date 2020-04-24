<?php
include_once "person_model.php";

/**
 * Modelo User.  Se encarga de encapsular un objeto (registro) almacenado en la BD.
 * Adicionalmente contiene métodos de modificación de datos CRUD. 
 */
class user_model extends person_model
{
    private $username;
    private $password;

    /**
     * Constructor.  Encargado de crear el objeto a la conexión de base de datos.
     * Además, carga la información de la persona relacionada al usuario.
     * @return void
    */
    public function __construct($personId = null)
    {
        parent::__construct();

        if(isset($personId))
        {
            $this->load_person($personId);
        }
    }

    /**
     * Método que carga la data de la persona al objeto actual
     * @param $id. Identificador de la persona.
     * @return void
     */
    public function load_person($id)
    {
        $this->set_id($id);

        $person = $this->get()[0];
        
        $this->set_id($person[0]);
        $this->set_name($person[1]);
        $this->set_identification($person[2]);
        $this->set_email($person[3]);
        $this->set_phone($person[4]);
    }

    /**
     * Método de encapsulamiento para obtener el nombre de usuario.
     * @return string
    */
    public function get_username()
    {
        return $this->username;
    }

    /**
     * Método de encapsulamiento para setear el nombre de usuario.
     * @param $username.
     * @return void
    */
    public function set_username($username)
    {
        $this->username = $username;
    }

    /**
     * Método de encapsulamiento para obtener la contraseña.
     * @return string
    */
    public function get_password()
    {
        return $this->password;
    }

    /**
     * Método de encapsulamiento para setear la contraseña.
     * @param $password.
     * @return void
    */
    public function set_password($password)
    {
        $this->password = $password;
    }

    /**
     * Método Get User.  Se encarga de obtener un registro de la base de datos. Se filtra por la propiedad
     * id que antes de la ejecución de este método debió haber sido asignada con el valor 
     * correspondiente.
     * @return array
    */
    public function get_user()
    {
        $id = $this->get_id();
        
        $sql = "SELECT * FROM user WHERE person_id = $id";

        return $this->db->ExecSelect($sql);
    }

    /**
     * Método que obtiene los datos de la persona por medio de las credenciales de acceso
     * (usuario y contraseña)
     * @param $username. Nombre de usuario
     * @param $password. Contraseña
     * @return array
     */
    public function get_user_by_login($username, $password)
    {
        $id = $this->get_id();
        
        $sql = "SELECT p.id, p.name FROM user u INNER JOIN person p ON u.person_id = p.id WHERE u.username = '$username' and u.password = '$password'";

        return $this->db->ExecSelect($sql);
    }

    /**
     * Acción List User.  Se encarga de obtener la lista de registros guardados en la base de datos.
     * @return array (matriz de consulta)
    */
    public function list_user()
    {
        $sql = "SELECT * FROM user";

        return $this->db->ExecSelect($sql);
    }

    /**
     * Método Insert User.  Se encarga de insertar como nuevo registro en la base de datos la información
     * encapsulada en las propiedades respectivas de la clase.
     * @return boolean
    */
    public function insert_user()
    {
        $id = $this->get_id();

        $sql = "INSERT INTO user (username, password, person_id) VALUES ('$this->username', '$this->password', '$id')";

        return $this->db->ExecQuery($sql);
    }

    /**
     * Método Update User.  Se encarga de actualizar un registro existente en la base de datos, basándose en 
     * la información encapsulada en las propiedades respectivas de la clase.
     * @return boolean
    */
    public function update_user()
    {
        $id = $this->get_id();

        $sql = "UPDATE user SET username = '$this->username', password = '$this->password' WHERE person_id = $id";

        return $this->db->ExecQuery($sql);
    }

    /**
     * Método Delete User.  Elimina la tarea filtrando por la propiedad id de la clase.
     * @return boolean
    */
    public function delete_user()
    {
        $id = $this->get_id();

        $sql = "DELETE FROM user WHERE person_id = $this->id";

        return $this->db->ExecQuery($sql);
    }  
}


?>