<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('main.php');

class Users extends Main
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function sign_in()
	{
		if($this->is_login())
		{
			redirect(base_url('/main'));
		}
		else
		{
			$this->load->view('login');
		}
	}

	public function login()
	{
		$user = new User();
		
		$user->email = $this->input->post('email');
		$user->password = $this->input->post('password');

		if($user->login())
		{
			$data['message'] = 'Login Successful!';
			$data['status'] = TRUE;
		}
		else
		{
			$data['message'] = $user->error->login;
			$data['status'] = FALSE;
		}

		echo json_encode($data);
	}

	public function register()
	{
		$this->load->view('register');
	}

	public function sign_out()
	{
		$this->session->sess_destroy();
		redirect(base_url('/login'));
	}
	
	public function register_user()
	{
		$post_data = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('user_name', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'min_length[8]|required|');
		
		if($this->form_validation->run() === FALSE)
		{
			$data['errors'] = validation_errors();
			$data['success'] = FALSE;
			echo json_encode($data);
		}
		else
		{
			$add_user = $this->User_model->add_user($this->input->post());

			$data['success'] = TRUE;
			$data['location'] = '/login';
			echo json_encode($data);	

		}
	}

	public function get_users()
	{
		$this->view_data['users'] = $this->User_model->get_users();
		$this->load->view('user', $this->view_data);
	}


	public function get_user($user_id)
	{
		$this->view_data['work_history'] = $this->Clock_model->get_history($user_id);
		$this->load->view('single_user', $this->view_data);
	}

}
?>
