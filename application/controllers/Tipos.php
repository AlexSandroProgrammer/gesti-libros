<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tipos extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); // Cargar la librería
        $this->load->model('Tipos_model'); // Cargar el modelo correctamente
    }
    //  método para mostrar página inicial
    public function index()
    {
        // validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
        // llamos todas las tipos registradas en la base de datos
        $tipos = $this->Tipos_model->obtenerTipos();
        // cargamos la vista con la lista de tipos
        $data['tipos'] = $tipos;
        // cargamos la vista con la lista de tipos
        $this->load->view('admin/tipos_usuarios', $data);
    }
    // metodo para realizar registro de tipo_usuario
    public function register(){
		// validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
		// validamos que el formulario sea enviado por el emtodo POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('tipo_usuario', 'Tipo Usuario', 'required');
            if ($this->form_validation->run() == TRUE) {
                $tipo_usuario = $this->input->post('tipo_usuario');
                $data = array(
                    'tipo_usuario' => $tipo_usuario
                );
                $register_tipo = $this->Tipos_model->registrarTipo($data);
                if ($register_tipo) {
                    $this->session->set_flashdata('success', 'Tipo_usuario registrado exitosamente.');
                    redirect(base_url('tipos'));
                } else {
                    $this->session->set_flashdata('error', 'Ha ocurrido un error al registrar la tipo_usuario.');
                    redirect(base_url('tipos'));
                }
            } else {
                $this->session->set_flashdata('error', 'Por favor, completa todos los campos obligatorios.');
                redirect(base_url('tipos'));
            }
        } else {
            $this->session->set_flashdata('error', 'Ha ocurrido un error al registrar la tipo_usuario.');
            redirect(base_url('tipos'));
        }
    }
}