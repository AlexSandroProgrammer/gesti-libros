<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Medicos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // * método para registrar medico
    public function registrarMedico($data)
    {
        // Realiza la inserción en la base de datos
        $this->db->insert('users', $data);

        // Verifica si la inserción fue exitosa
        if ($this->db->affected_rows() > 0) {
            return true; // La inserción fue exitosa
        } else {
            return false; // La inserción falló
        }
    }

    // * método para obtener todas las medicos
    public function obtenerMedicos(){
        $query = $this->db->query("SELECT * FROM users INNER JOIN estados ON users.id_state = estados.id_estado INNER JOIN tipos ON users.id_type_user = tipos.id INNER JOIN sedes ON users.id_sede = sedes.id_sede WHERE users.id_type_user = 2");
        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return [];
        }
    }

    //* metodo para hacer un conteo de medicos
    public function contarMedicos(){
        $query = $this->db->query("SELECT COUNT(*) as totalMedicos FROM users WHERE id_type_user = 2");
        if($query->num_rows() >= 1){
            return $query->row()->totalMedicos;
        }else{
            return 0;
        }
    }

    // * método para realizar un conteo de medicos de acuerdo a su sede y dividirlos por estado
    public function contarMedicosPorSedeYEstado(){
        $query = $this->db->query("SELECT  s.nombre_sede, e.estado, COUNT(u.documento) AS cantidad_medicos FROM users u JOIN sedes s ON u.id_sede = s.id_sede JOIN estados e ON u.id_state = e.id_estado WHERE u.id_type_user = 2 GROUP BY s.nombre_sede, e.estado ORDER BY s.nombre_sede, e.estado;");
        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return [];
        }
    }

    // * método para obtener medico por documento
    public function obtenerMedicoPorDocumento($documento){
        $query = $this->db->query("SELECT * FROM users INNER JOIN estados ON users.id_state = estados.id_estado INNER JOIN tipos ON users.id_type_user = tipos.id INNER JOIN sedes ON users.id_sede = sedes.id_sede WHERE users.documento = '$documento' AND users.id_type_user = 2");
        if($query->num_rows() >= 1){
            return $query->row();
        }else{
            return null;
        }
    }
    
    // * método para actualizar medico
    public function actualizarMedico($documento, $data) {
        $email = $data['email'];
        // Usar consultas preparadas para evitar inyecciones SQL
        $sql = "SELECT * FROM users WHERE email = ? AND documento <> ?";
        $query = $this->db->query($sql, array($email, $documento));
        if ($query->num_rows() == 0) {
            $this->db->where('documento', $documento);
            $this->db->update('users', $data);
            if ($this->db->affected_rows() > 0) {
                return true; // La actualización fue exitosa
            } else {
                return false; // La actualización falló
            }
        } else {
            return false; // El email ya se encuentra registrado en el sistema
        }
    }
    
    
    // * método para eliminar medico
    public function eliminarMedico($documento){
        $this->db->where('documento', $documento);
        $this->db->delete('users');
        if ($this->db->affected_rows() > 0) {
            return true; // La eliminación fue exitosa
        } else {
            return false; // La eliminación falló
        }
    }
}