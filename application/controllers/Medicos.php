<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Medicos extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); // Cargar la librería
        $this->load->model('Medicos_model'); // Cargar el modelo correctamente
        $this->load->model('Sedes_model'); // Cargar el modelo correctamente
        $this->load->model('Estados_model'); // Cargar el modelo correctamente
    }
    //  método para mostrar página inicial
    public function index() {
        // validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
        // llamos todas las medicos registradas en la base de datos
        $medicos = $this->Medicos_model->obtenerMedicos();
        // validamos de que si no trae medicos entonces enviamos un mensaje de que no hay medicos registradas
        // cargamos la vista con la lista de medicos
        $data['medicos'] = $medicos;    
        // cargamos la vista con la lista de medicos
        $this->load->view('admin/medicos', $data);
    }
    //  método para mostrar formulario registro de medicos
    public function view_registrar(){
        // validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
        // llamos todas las medicos registradas en la base de datos
        $sedes = $this->Sedes_model->obtenerSedes();
        $estados = $this->Estados_model->obtenerEstados();
        // validamos de que si no trae sedes entonces enviamos un mensaje de que no hay sedes registradas
        if (empty($sedes)) {
            $this->session->set_flashdata('error', 'No hay sedes registradas. por tal motivo no puedes registrar medicos.');
            $this->load->view('admin/medicos');
            return;
        }
        // validamos de que si no trae estados entonces enviamos un mensaje de que no hay estados registrados
        if (empty($estados)) {
            $this->session->set_flashdata('error', 'No hay estados registrados. por tal motivo no puedes registrar medicos.');
            $this->load->view('admin/medicos');
            return;
        }
        // cargamos la vista con la lista de estados
        $data['estados'] = $estados;
        // cargamos la vista con la lista de sedes
        $data['sedes'] = $sedes;
        // cargamos la vista con el formulario de registro
        $this->load->view('admin/registrar_medico', $data);
    }
    // metodo para realizar registro de medico
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
            $this->form_validation->set_rules('documento', 'Documento', 'required|is_unique[users.documento]');
            $this->form_validation->set_rules('names', 'Names', 'required');
            $this->form_validation->set_rules('surnames', 'Surnames', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('id_sede', 'Id Sede', 'required');
            $this->form_validation->set_rules('id_type_user', 'Id Type User', 'required');
            $this->form_validation->set_rules('id_state', 'Id State', 'required');
            if ($this->form_validation->run() == TRUE) {
                // Obtener los valores de los campos del formulario
                $documento = $this->input->post('documento');
                $names = $this->input->post('names');
                $surnames = $this->input->post('surnames');
                $email = $this->input->post('email');
                $id_sede = $this->input->post('id_sede');
                $id_type_user = $this->input->post('id_type_user');
                $id_state = $this->input->post('id_state');
                $data = array(
                    'documento' => $documento,
                    'names' => $names,
                   'surnames' => $surnames,
                    'email' => $email,
                    'id_sede' => $id_sede,
                    'id_type_user' => $id_type_user,
                    'id_state' => $id_state,
                );
                $register_medico = $this->Medicos_model->registrarMedico($data);
                if ($register_medico) {
                    $this->session->set_flashdata('success', 'Medico registrado exitosamente.');
                    redirect(base_url('medicos'));
                } else {
                    $this->session->set_flashdata('error', 'Ha ocurrido un error al registrar el medico.');
                    redirect(base_url('form_registrar_medico'));
                }
            } else {
                $this->session->set_flashdata('error', 'Error al momento de registrar el formulario.');
                redirect(base_url('form_registrar_medico'));
            }
        } else {
            $this->session->set_flashdata('error', 'Ha ocurrido un error al registrar el medico.');
            redirect(base_url('form_registrar_medico'));
        }
    }
    // metodo para mostrar los datos del medico para editarlos
    public function view_editar($documento){
        // validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
        // llamo el medico por documento
        $medico_edit = $this->Medicos_model->obtenerMedicoPorDocumento($documento);
        // validamos que si no trae medico entonces enviamos un mensaje de que no hay medico registrado
        if (empty($medico_edit)) {
            $this->session->set_flashdata('error', 'No se ha encontrado el medico con el documento: '. $documento);
            redirect(base_url('medicos'));
            return;
        }
        // llamo todos los estados y sedes
        $sedes = $this->Sedes_model->obtenerSedes();
        $estados = $this->Estados_model->obtenerEstados();
        // validamos de que si no trae sedes entonces enviamos un mensaje de que no hay sedes registradas
        if (empty($sedes)) {
            $this->session->set_flashdata('error', 'No hay sedes registradas. por tal motivo no puedes registrar medicos.');
            redirect(base_url('medicos'));
            return;
        }
        // validamos de que si no trae estados entonces enviamos un mensaje de que no hay estados registrados
        if (empty($estados)) {
            $this->session->set_flashdata('error', 'No hay estados registrados. por tal motivo no puedes registrar medicos.');
            redirect(base_url('medicos'));
            return;
        }
        // cargamos la vista con la lista de estados
        $data['medico_edit'] = $medico_edit;
        // cargamos la vista con la lista de estados
        $data['estados'] = $estados;
        // cargamos la vista con la lista de sedes
        $data['sedes'] = $sedes;
        // cargamos la vista con el formulario de actualizacion
        $this->load->view('admin/editar_medico', $data);
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
            $this->form_validation->set_rules('documento', 'Documento', 'required');
            $this->form_validation->set_rules('names', 'Names', 'required');
            $this->form_validation->set_rules('surnames', 'Surnames', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('id_sede', 'Id Sede', 'required');
            $this->form_validation->set_rules('id_type_user', 'Id Type User', 'required');
            $this->form_validation->set_rules('id_state', 'Id State', 'required');
            if ($this->form_validation->run() == TRUE) {
                // Obtener los valores de los campos del formulario
                $documento = $this->input->post('documento');
                $names = $this->input->post('names');
                $surnames = $this->input->post('surnames');
                $email = $this->input->post('email');
                $id_sede = $this->input->post('id_sede');
                $id_type_user = $this->input->post('id_type_user');
                $id_state = $this->input->post('id_state');
                $data = array(
                    'names' => $names,
                    'surnames' => $surnames,
                    'email' => $email,
                    'id_sede' => $id_sede,
                    'id_type_user' => $id_type_user,
                    'id_state' => $id_state,
                );
                $register_medico = $this->Medicos_model->actualizarMedico($documento, $data);
                if ($register_medico) {
                    $this->session->set_flashdata('success', 'Los datos se han actualizado correctamente.');
                    redirect(base_url('medicos'));
                    return;
                } else {
                    $this->session->set_flashdata('error', 'Ha ocurrido un error al momento de editar el medico.');
                    redirect(base_url('medicos'));
                    return;
                }
            } else {
                $this->session->set_flashdata('error', 'Error al momento de actualizar los datos del medico.');
                redirect(base_url('medicos') );
                return;
            }
        } else {
            $this->session->set_flashdata('error', 'Ha ocurrido un error al momento actualizar los datos el medico.');
            redirect(base_url('medicos'));
            return;
        }
    }

    //* metodo para eliminar los datos del medico
    public function eliminar($documento){
        // validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
        // llamo el medico por documento
        $medico_eliminar = $this->Medicos_model->obtenerMedicoPorDocumento($documento);
        // validamos que si no trae medico entonces enviamos un mensaje de que no hay medico registrado
        if (empty($medico_eliminar)) {
            $this->session->set_flashdata('error', 'No se ha encontrado el medico con el documento: '. $documento);
            redirect(base_url('medicos'));
            return;
        }
        // eliminamos el medico
        $borrar_medico = $this->Medicos_model->eliminarMedico($documento);
        if ($borrar_medico){
            $this->session->set_flashdata('success', 'El medico ha sido eliminado correctamente.');
            redirect(base_url('medicos'));
            return;
        }
        else{
            $this->session->set_flashdata('error', 'Ha ocurrido un error al momento de eliminar el medico.');
            redirect(base_url('medicos'));
            return;
        }
    }
}