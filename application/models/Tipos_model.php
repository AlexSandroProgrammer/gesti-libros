<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tipos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    // * método para registrar estado
    public function registrarTipo($data)
    {
        // Realiza la inserción en la base de datos
        $this->db->insert('tipos', $data);

        // Verifica si la inserción fue exitosa
        if ($this->db->affected_rows() > 0) {
            return true; // La inserción fue exitosa
        } else {
            return false; // La inserción falló
        }
    }
    // * método para obtener todas las estados
    public function obtenerTipos()
    {
        $query = $this->db->get('tipos');
        return $query->result();
    }

    //* metodo para hacer un conteo de tipos de usuario
    public function contarTipos(){
        $query = $this->db->query("SELECT COUNT(*) as totalTipos FROM tipos");
        if($query->num_rows() >= 1){
            return $query->row()->totalTipos;
        }else{
            return 0;
        }
    }
}