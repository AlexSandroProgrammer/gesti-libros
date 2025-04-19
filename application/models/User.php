<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Model
{
    //TODO: METODOS

    // * metodo para registrar usuario
    function insertUser($data)
    {
        $this->db->insert('users', $data);
    }
    // * metodo para validar contraseña y correo para habilitar el inicio de sesion
    function validateUser($email, $password){
        $query = $this->db->query("SELECT * FROM users WHERE email = '$email' AND password = '$password' AND id_type_user = 1 AND id_state = 1");
        if($query->num_rows() == 1){
            return $query->row();
        }else{
            return false;
        }

    }
}