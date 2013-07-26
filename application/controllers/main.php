<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{
	public $view_data = array();
	public $user_session = array();

	public function __construct()
	{
		parent::__construct();		
		$this->user_session = $this->session->userdata('user_session');
	}

	public function index()
	{
		if($this->is_login() == FALSE)
		{
			redirect(base_url('/users/sign_in'));
		}
		else
		{
			// $this->view_data = $this->User_model->get_user($this->user_session['id']);
			// $this->load->view('main', $this->view_data);
		}		
	}
	
	public function is_login()
	{
		if($this->user_session['logged_in'])
			return TRUE;
		else
			return FALSE;
	}
}
?>
