<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sedes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // * método para registrar sede
    public function registrarSede($data)
    {
        // Realiza la inserción en la base de datos
        $this->db->insert('sedes', $data);

        // Verifica si la inserción fue exitosa
        if ($this->db->affected_rows() > 0) {
            return true; // La inserción fue exitosa
        } else {
            return false; // La inserción falló
        }
    }

    // * método para obtener todas las sedes
    public function obtenerSedes()
    {
        $query = $this->db->get('sedes');
        return $query->result();
    }

    //* metodo para hacer un conteo de sedes
    public function contarSedes(){
        $query = $this->db->query("SELECT COUNT(*) as totalSedes FROM sedes");
        if($query->num_rows() >= 1){
            return $query->row()->totalSedes;
        }else{
            return 0;
        }
    }
    // * método para obtener los medicos de acuerdo a su respectiva sede
    public function obtenerCantidadMedicosPorSede() {
        $query = $this->db->query(" SELECT sedes.nombre_sede AS nombre, COUNT(users.documento) AS cantidad FROM users INNER JOIN sedes ON users.id_sede = sedes.id_sede WHERE users.id_type_user = 2 GROUP BY sedes.nombre_sede");   
        return $query->result_array();
    }

    // * método para obtener sede por id
    public function obtenerSedePorId($sede){
        $query = $this->db->query("SELECT * FROM sedes WHERE sedes.id_sede = '$sede'");
        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return null;
        }
    }
     // * método para actualizar datos de la sede
     public function actualizarSede($sede, $data) {
        // Usar consultas preparadas para evitar inyecciones SQL
        $this->db->where('id_sede', $sede);
        $this->db->update('sedes', $data);
        if ($this->db->affected_rows() > 0) {
            return true; // La actualización fue exitosa
        } else {
            return false; // La actualización falló
        }
        
    }
    // * método para eliminar sedes y medicos de esa sede
    public function eliminarSede($sede){
        $this->db->where('id_sede', $sede);
        $this->db->delete('sedes');
        if ($this->db->affected_rows() > 0) {
            return true; // La eliminación fue exitosa
        } else {
            return false; // La eliminación falló
        }
    }
}