<?php
/*
* ------------------------------------------------------------------
* Este arquivo não pode ser acessado diretamente
* ------------------------------------------------------------------
*/
if (!defined('ENG_BASEPATH')) exit(utf8_decode('Você não pode acessar este arquivo diretamente diretamente.'));

Class weDefault {

	//Mensagem HTML
	private $message = NULL;


	//URL Base
	public function base_url(){
		if(defined('HTTP_HOST') && defined('BASE_URL')):
			if(is_extra_theme())
				if(BASE_URL != '')
					$url = 'http://'.HTTP_HOST.'/'.BASE_URL.'/'.THEME_ALIAS.'/';
				else
					$url = 'http://'.HTTP_HOST.'/'.THEME_ALIAS.'/';
			elseif(BASE_URL != '')
				$url = 'http://'.HTTP_HOST.'/'.BASE_URL.'/';
			else
				$url = 'http://'.HTTP_HOST.'/';
		else:
			$url = 'http://';
		endif;
		return $url;
	}


	// Mensagem
	public function set_message($msg, $status){
		$response = NULL;

		switch($status):
			case 'error':
				$response = '
							<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<strong>Erro!</strong> '.$msg.'</a>
							</div>
							';
				break;

			case 'success':
				$response = '
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<strong>Sucesso!</strong> '.$msg.'</a>
							</div>
							';
				break;

			case 'warning':
				$response = '
							<div class="alert alert-warning alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<strong>Aviso!</strong> '.$msg.'</a>
							</div>
							';
				break;

			case 'info':
				$response = '
							<div class="alert alert-info alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
								<strong>Info!</strong> '.$msg.'</a>
							</div>
							';
				break;
		endswitch;
		$this->message = $response;
	}


	// Retorna Mensagem armazena
	public function get_message(){
		if(!empty($this->message)):
			$msg = $this->message;
			$this->message = NULL;
			return $msg;
		else:
			return '';
		endif;
	}


}