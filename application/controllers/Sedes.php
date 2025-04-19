<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sedes extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); // Cargar la librería
        $this->load->model('Sedes_model'); // Cargar el modelo correctamente
    }
    //  método para mostrar página inicial
    public function index(){
        // validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
        // llamamos todas las sedes registradas en la base de datos
        $sedes = $this->Sedes_model->obtenerSedes();
        // cargamos la vista con la lista de sedes
        $data['sedes'] = $sedes;
        // cargamos la vista con la lista de sedes
        $this->load->view('admin/sedes', $data);
    }
    //  método para mostrar formulario registro de sedes
    public function view_registrar(){
        // validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
        $this->load->view('admin/registrar_sede');
    }
    // metodo para realizar registro de sede
    public function register() {
		// validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
		// validamos que el formulario sea enviado por el emtodo POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('nombre_sede', 'Nombre de Sede', 'required');
            $this->form_validation->set_rules('direccion', 'Direccion', 'required');
            $this->form_validation->set_rules('telefono', 'Telefono', 'required');
            if ($this->form_validation->run() == TRUE) {
                $nombre_sede = $this->input->post('nombre_sede');
                $direccion = $this->input->post('direccion');
                $telefono = $this->input->post('telefono');
                $data = array(
                    'nombre_sede' => $nombre_sede,
                    'direccion' => $direccion,
                    'telefono' => $telefono,
                );
                $register_sede = $this->Sedes_model->registrarSede($data);
                if ($register_sede) {
                    $this->session->set_flashdata('success', 'Sede registrada exitosamente.');
                    redirect(base_url('sedes'));
                } else {
                    $this->session->set_flashdata('error', 'Ha ocurrido un error al registrar la sede.');
                    redirect(base_url('form_registrar_sede'));
                }
            } else {
                $this->session->set_flashdata('error', 'Por favor, completa todos los campos obligatorios.');
                redirect(base_url('form_registrar_sede'));
            }
        } else {
            $this->session->set_flashdata('error', 'Ha ocurrido un error al registrar la sede.');
            redirect(base_url('form_registrar_sede'));
        }
    }

        // metodo para mostrar los datos del medico para editarlos
        public function view_editar($sede){
            // validar sesión
            $session_data = $this->session->userdata('UserLoginSession');
            if (!isset($session_data['documento'])) {
                $this->session->sess_destroy();
                redirect(base_url('welcome'));
                return;
            }
            // llamo la sede por el id
            $sede_edit = $this->Sedes_model->obtenerSedePorId($sede);
            // validamos que si no trae medico entonces enviamos un mensaje de que no hay medico registrado
            if (empty($sede_edit)) {
                $this->session->set_flashdata('error', 'No se ha encontrado la sede con el id: '. $sede);
                redirect(base_url('sedes'));
                return;
            }
            // cargamos la vista con la lista de estados
            $data['sede_edit'] = $sede_edit;
            // cargamos la vista con el formulario de actualizacion
            $this->load->view('admin/editar_sede', $data);
        }
        //* metodo para actualizar los datos del medico
        public function actualizar(){
            // validar sesión
            $session_data = $this->session->userdata('UserLoginSession');
            if (!isset($session_data['documento'])) {
                $this->session->sess_destroy();
                redirect(base_url('welcome'));
                return;
            }
            // validamos que el formulario sea enviado por el emtodo POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->form_validation->set_rules('id_sede', 'ID de Sede', 'required');
                $this->form_validation->set_rules('nombre_sede', 'Nombre de Sede', 'required');
                $this->form_validation->set_rules('direccion', 'Direccion', 'required');
                $this->form_validation->set_rules('telefono', 'Telefono', 'required');
                if ($this->form_validation->run() == TRUE) {
                    $id_sede = $this->input->post('id_sede');
                    $nombre_sede = $this->input->post('nombre_sede');
                    $direccion = $this->input->post('direccion');
                    $telefono = $this->input->post('telefono');
                    $data = array(
                        'nombre_sede' => $nombre_sede,
                        'direccion' => $direccion,
                        'telefono' => $telefono,
                    );
                    $actualizar_sede = $this->Sedes_model->actualizarSede($id_sede, $data);
                    if ($actualizar_sede) {
                        $this->session->set_flashdata('success', 'Sede actualizada exitosamente.');
                        redirect(base_url('sedes'));
                    } else {
                        $this->session->set_flashdata('error', 'Ha ocurrido un error al momento de actualizar la sede.');
                        redirect(base_url('sedes'));
                    }
                } else {
                    $this->session->set_flashdata('error', 'Por favor, completa todos los campos obligatorios.');
                    redirect(base_url('sedes'));
                }
            } else {
                $this->session->set_flashdata('error', 'Ha ocurrido un error al momento actualizar los datos de la sede.');
                redirect(base_url('sedes'));
                return;
            }
        }
    
        //* metodo para eliminar los datos del medico
        public function eliminar($sede){
            // validar sesión
            $session_data = $this->session->userdata('UserLoginSession');
            if (!isset($session_data['documento'])) {
                $this->session->sess_destroy();
                redirect(base_url('welcome'));
                return;
            }
            // llamo el medico por sede
            $sede_eliminar = $this->Sedes_model->obtenerSedePorId($sede);
            // validamos que si no trae medico entonces enviamos un mensaje de que no hay medico registrado
            if (empty($sede_eliminar)) {
                $this->session->set_flashdata('error', 'No se ha encontrado la sede con el id: '. $sede);
                redirect(base_url('sedes'));
                return;
            }
            // eliminamos la sede
            $borrar_medico = $this->Sedes_model->eliminarSede($sede);
            if ($borrar_medico){
                $this->session->set_flashdata('success', 'El medico ha sido eliminado correctamente.');
                redirect(base_url('sedes'));
                return;
            }else{
                $this->session->set_flashdata('error', 'Ha ocurrido un error al momento de eliminar el medico.');
                redirect(base_url('sedes'));
                return;
            }
        }
}