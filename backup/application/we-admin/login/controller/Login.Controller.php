<?php
class Login_Controller extends WeController{

	public function __construct(){

		$this->load()->model('login');
	}

	public function index(){
		$this->auth($_POST);
	}

	public function auth($post = ''){

		//var scope
		$error = '';
		$post = (!empty($post))?$post:$_POST;

		extract($post);
		if(isset($use_login) && isset($use_password)):
			$this->set_username($use_login);
			$this->set_password($use_password);
			//Erro
			if(!$this->get_flag_error()):
				$this->login_auth();
			else:
				$error = $this->get_error_login();
			endif;
			//Verifica se tem algum erro armazenado na classe
			if($this->get_flag_error()):
				$error = $this->get_error_login();
			endif;


		endif;

		if(!empty($error))
			$this->load()->view('login', array('error' => $error));
	}

}

?>