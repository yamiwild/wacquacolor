<?php

class Login_Model extends WeModel{

	/*
		Variaveis
	*/
	public $_login;
	public $_senha;
	public $_flag_error = false;
	public $_error;

	/*
	|
	| Getter e Setter
	|
	|
	 */

	/* Set Login  */
	public function set_username($login){
		if(isset($login) && !empty($login)){
			$this->_login = $login;
			$this->_flag_error = false;
		}else{
			$this->_flag_error = true;
			$this->_error ='Preencha os dados corretamente';
		}
	}
	/* Get Login*/
	private function get_username(){
		return $this->_login;
	}

	/* Set Senha*/

	public function set_password($senha){
		if(isset($senha) && !empty($senha)){
			$this->_senha = $senha;
			$this->_senha = md5($this->_senha);
			$this->_flag_error = false;
		}else{
			$this->_flag_error = true;
			$this->_error = 'Preencha os dados corretamente';
		}
	}

	/* Get Senha  */

	private function get_password(){
		return $this->_senha;
	}

	/*
	|
	| Métodos
	|
	|
	 */

	/* Error */
	public function get_flag_error(){
		return $this->_flag_error;
	}

	public function get_error_login(){
		if(!empty($this->_error)){
			return $this->_error;
		}
	}


	/*
		Método de autenticação do usuário

	 */
	public function login_auth(){

		$username = $this->get_username();
		$password = $this->get_password();


        $sql = "SELECT USE_COD,
                       USE_NAME,
                       USE_EMAIL
                  FROM fw_user
                 WHERE USE_LOGIN = :USE_LOGIN
                   AND USE_PASSWORD = :USE_PASSWORD";

		$stmt = $this->db->prepare($sql);
		$stmt->execute(array(':USE_LOGIN' => $username,
                             ':USE_PASSWORD' => $password));
		$rows = $stmt->rowCount();
		$data = $stmt->fetch(PDO::FETCH_OBJ);

		if($rows == 1):
			if(!$this->get_session('AUTH')):

				//Criação de sessões
				$arr_session = array('AUTH' => true,
						             'USER_COD' => $data->USE_COD,
						             'USER_NAME' => $data->USE_NAME,
						             'USER_EMAIL' => $data->USE_EMAIL);

				$this->set_session($arr_session);

				header('Location: dashboard');

			else:
				header('Location: dashboard');
			endif;
		else:
			$this->_flag_error = true;
			$this->_error = "Login ou senha inválido";
		endif;

	}

}

?>