<?php

include_once "person_model.php";

class user_model extends person_model
{
    private $username;
    private $password;

    public function __construct($id)
    {
        parent::__construct();

        $this->set_id($id);

        $person = $this->get()[0];
        
        $this->set_id($person[0]);
        $this->set_name($person[1]);
        $this->set_identification($person[2]);
        $this->set_email($person[3]);
        $this->set_phone($person[4]); 
    }

    public function get_username()
    {
        return $this->username;
    }

    public function set_username($username)
    {
        $this->username = $username;
    }

    public function get_password()
    {
        return $this->password;
    }

    public function set_password($password)
    {
        $this->password = $password;
    }

    public function get_user()
    {
        $id = $this->get_id();
        
        $sql = "SELECT * FROM user WHERE person_id = $id";

        return $this->db->ExecSelect($sql);
    }

    public function list_user()
    {
        $sql = "SELECT * FROM user";

        return $this->db->ExecSelect($sql);
    }

    public function insert_user()
    {
        $id = $this->get_id();

        $sql = "INSERT INTO user (username, password, person_id) VALUES ('$this->username', '$this->password', '$id')";

        return $this->db->ExecQuery($sql);
    }

    public function update_user()
    {
        $id = $this->get_id();

        $sql = "UPDATE user SET username = '$this->username', password = '$this->password' WHERE person_id = $id";

        return $this->db->ExecQuery($sql);
    }

    public function delete_user()
    {
        $id = $this->get_id();

        $sql = "DELETE FROM user WHERE person_id = $this->id";

        return $this->db->ExecQuery($sql);
    }

}


?>