<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Estados extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); // Cargar la librería
        $this->load->model('Estados_model'); // Cargar el modelo correctamente
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
        // llamos todas las estados registradas en la base de datos
        $estados = $this->Estados_model->obtenerEstados();
        // cargamos la vista con la lista de estados
        $data['estados'] = $estados;
        // cargamos la vista con la lista de estados
        $this->load->view('admin/estados', $data);
    }
    // metodo para realizar registro de estado
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
            $this->form_validation->set_rules('estado', 'Estado', 'required');
            if ($this->form_validation->run() == TRUE) {
                $estado = $this->input->post('estado');
                $data = array(
                    'estado' => $estado
                );
                $register_estado = $this->Estados_model->registrarEstado($data);
                if ($register_estado) {
                    $this->session->set_flashdata('success', 'Estado registrado exitosamente.');
                    redirect(base_url('estados'));
                } else {
                    $this->session->set_flashdata('error', 'Ha ocurrido un error al registrar la estado.');
                    redirect(base_url('estados'));
                }
            } else {
                $this->session->set_flashdata('error', 'Por favor, completa todos los campos obligatorios.');
                redirect(base_url('estados'));
            }
        } else {
            $this->session->set_flashdata('error', 'Ha ocurrido un error al registrar la estado.');
            redirect(base_url('estados'));
        }
    }
}