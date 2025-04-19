<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); // Cargar la librería
        $this->load->model('Medicos_model'); // Cargar el modelo correctamente
        $this->load->model('Sedes_model'); // Cargar el modelo correctamente
        $this->load->model('Estados_model'); // Cargar el modelo correctamente
        $this->load->model('Tipos_model'); // Cargar el modelo correctamente
    }
	//  metodo para mostrar pagina inicial
	public function index(){
        // validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
        // realizamos un conteo de medicos para conocer la cantidad de medicos por sede
        $datosSedes = $this->Sedes_model->obtenerCantidadMedicosPorSede();
        $data['datosMedicosDivEstYSede'] = $this->Medicos_model->contarMedicosPorSedeYEstado();
        // Convertir los datos al formato necesario para el gráfico de Variable Radius Pie
        $datos_grafico = [];
        foreach ($datosSedes as $row) {
            $datos_grafico[] = [
                'name' => $row['nombre'],
                'y' => (int) $row['cantidad'],
                'z' => (int) $row['cantidad'] // El tamaño de los puntos en el gráfico
            ];
        }
        $data['datos_grafico_area'] = json_encode($datos_grafico);
        // contar médicos registrados en la base de datos
        $data['medicos'] = $this->Medicos_model->contarMedicos();
        // contar sedes registradas en la base de datos
        $data['sedes'] = $this->Sedes_model->contarSedes();
        // contar estados registrados en la base de datos
        $data['estados'] = $this->Estados_model->contarEstados();
        // contar tipos de usuarios registrados en la base de datos
        $data['tipos'] = $this->Tipos_model->contarTipos();
        // cargar la vista con la lista de médicos, sedes, estados y tipos de usuarios    
		$this->load->view('admin/index', $data);
	}
}