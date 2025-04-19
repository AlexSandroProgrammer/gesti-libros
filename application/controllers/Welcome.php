<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation'); // Cargar la librería
	}
	//  metodo para mostrar pagina inicial
	public function index()
	{
		$this->load->view('auth/login');
	}
	// funcion para realizar registro de usuario en el modulo de autenticacion
	public function register()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Configurar las reglas de validación para los campos del formulario
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('names', 'Names', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('surnames', 'Surnames', 'required');
			$this->form_validation->set_rules('documento', 'Documento', 'required');
			$this->form_validation->set_rules('id_type_user', 'Id_Type_User', 'required');
			$this->form_validation->set_rules('id_state', 'Id_State', 'required');
			if ($this->form_validation->run() == TRUE) {
				// Obtener los valores de los campos del formulario
				$email = $this->input->post('email');
				$names = $this->input->post('names');
				$surnames = $this->input->post('surnames');
				$password = $this->input->post('password');
				$documento = $this->input->post('documento');
				$id_type_user = $this->input->post('id_type_user');
				$id_state = $this->input->post('id_state');
				// Procesar los datos y guardarlos en la base de datos
				$data = array(
					'email' => $email,
					'names' => $names,
					'password' => $password,
					'surnames' => $surnames,
					'documento' => $documento,
					'id_type_user' => $id_type_user,
					'id_state' => $id_state,
				);

				// llamamos el modelo de usuarios
				$this->load->model('User');
				$this->User->insertUser($data);
				$this->session->set_flashdata('success', 'Usuario Registrado exitosamente');
				// Redirigir al usuario a la página de inicio de sesión
				redirect('/welcome');
			}
		}else {
			$this->load->view('/welcome');
		}
	}
	//  metodo para realizar inicio de sesion
	public function login(){
		// Implementar el codigo para iniciar sesion con la libreria de sesiones de codeigniter
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			// Configurar las reglas de validación para los campos del formulario
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');		
			if ($this->form_validation->run() == TRUE) {
				// Obtener los valores de los campos del formulario
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				// Procesar los datos y guardarlos en la base de datos
				// llamamos el modelo de usuarios
				$this->load->model('User');
				$validate = $this->User->validateUser($email, $password);
				// validamos si todo funciono correctamente
				if($validate != false){
					// guardamos los datos de la sesion
					$documento = $validate->documento;
					$email = $validate->email;
					// guardamos del usuario en un arreglo
					$session_data = array(
						'documento' => $documento,
                        'email' => $email
					);
					$this->session->set_userdata('UserLoginSession',$session_data);
                    redirect(base_url('/admin'));
                }
				
				$this->session->set_flashdata('error', 'Por favor verifica tus credenciales');
				$this->load->view('auth/login');
			}else{
				// Mostrar los errores de validación
                $this->session->set_flashdata('error', 'Por favor verifica tus credenciales');
				$this->load->view('auth/login');
			}
            
		}

	}
}