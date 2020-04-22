<?php

class person_model 
{
    private $id;
    private $name;
    private $identification;
    private $email;
    private $phone;

    public $db;

    function __construct()
    {
        $this->db = new Connection();
    }

    public function get()
    {
        $sql = "SELECT p.id, p.name, p.identification, p.email, p.phone, u.username FROM person p LEFT JOIN user u ON u.person_id = p.id WHERE p.id = $this->id";

        return $this->db->ExecSelect($sql);
    }

    public function list()
    {
        $sql = "SELECT p.id, p.name, p.identification, p.email, p.phone, u.username FROM person p LEFT JOIN user u ON u.person_id = p.id";

        return $this->db->ExecSelect($sql);
    }

    public function insert()
    {
        $sql = "INSERT INTO person (name, identification, email, phone) VALUES ('$this->name', '$this->identification', '$this->email', '$this->phone')";
        return $this->db->ExecQuery($sql);
    }

    public function update()
    {
        $sql = "UPDATE person  SET name = '$this->name', identification = '$this->identification', email = '$this->email', phone = '$this->phone' WHERE id = $this->id";

        return $this->db->ExecQuery($sql);
    }

    public function delete()
    {
        $sql1 = "DELETE FROM user WHERE person_id = $this->id";

        $this->db->ExecQuery($sql1);

        $sql2 = "DELETE FROM person WHERE id = $this->id";

        return $this->db->ExecQuery($sql2);
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

    public function get_identification()
    {
        return $this->identification;
    }

    public function set_identification($identification)
    {
        $this->identification = $identification;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function set_email($email)
    {
        $this->email = $email;
    }

    public function get_phone()
    {
        return $this->phone;
    }

    public function set_phone($phone)
    {
        $this->phone = $phone;
    }

}


?>