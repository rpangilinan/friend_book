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
		redirect(base_url('/users/sign_in'));
	}
	
	public function register_user()
	{
		$user = new User();

		$user->first_name = $this->input->post('first_name');
		$user->last_name = $this->input->post('last_name');
		$user->email = $this->input->post('email');
		$user->password = $this->input->post('password');
		$user->created_at = date('Y:m:d h:i:s a', time());

		if($user->save())
		{
			$data['status'] = TRUE;
			$data['location'] = '/users/sign_in';
		}
		else
		{
			$data['message'] = $user->error->string;
			$data['status'] = FALSE;
		}

		echo json_encode($data);
	}

	public function get_users()
	{

	}

	public function get_user($user_id)
	{

	}
}
?>
