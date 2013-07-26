<?php

class User extends DataMapper
{
	var $has_many = array('friend');

	var $validation = array(
		'email' => array(
			'label' => 'Email',
			'rules' => array('required', 'valid_email')
			),
		'password' => array(
			'label' => 'Password',
			'rules' => array('required', 'min_length' => 6, 'encrypt')
				),
		'first_name' => array(
			'label' => 'First Name',
			'rules' => array('required', 'min_length' => 2)
				),
		'last_name' => array(
			'label' => 'Last Name',
			'rules' => array('required', 'min_length' => 2)
			)
	);

	function login()
	{
		$user = new User();
		$user->where('email', $this->email)->get();
		$this->salt = $user->salt;
		$this->validate()->get();

		if(empty($this->id))
		{
			$this->error_message('login', 'Email or password invalid');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	function _encrypt($password)
	{
		if(!empty($this->{$password}))
		{
			if(empty($this->salt))
			{
				$this->salt = md5(uniqid(rand(), true));
			}
			$this->{$password} = sha1($this->salt . $this->{$password});
		}
	}
}
?>
