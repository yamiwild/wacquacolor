<?php

/*
* ------------------------------------------------------------------
* Este arquivo não pode ser acessado diretamente
* ------------------------------------------------------------------
*/
if (!defined('ENG_BASEPATH')) exit(utf8_decode('Você não pode acessar este arquivo diretamente diretamente.'));



Class WeSecurity {


/*
	Verifica se o usuário está autenticado
*/
public function user_auth($config = false){
	if($config):
		if(is_array($config)):
			if(!$this->get_session('AUTH')):
				foreach ($config as $theme => $page):
					if(THEME == $theme && get_request('mode') != $page):
						session_destroy();
						header('Location: '.base_url().$page);
					endif;
				endforeach;
			endif;
		else:
			exit(utf8_decode('Autenticação incorreta!'));
		endif;
	else:
		exit(utf8_decode('Autenticação requerida!'));
	endif;
}

/*
	Retorna o valor de uma variável de sessão
*/
public function get_session($key){
	if(isset($_SESSION)):
		if(is_array($key)):
			$r = $this->recursive_session($key);
			return $r;
		elseif(isset($_SESSION[$key])):
			return $_SESSION[$key];
		else:
			return NULL;
		endif;
	endif;

}

/*
	Cria Sessão
 */
public function set_session($sessions){
	if(isset($_SESSION)):
		if(is_array($sessions)):
			foreach ($sessions as $ses => $value):
				$_SESSION[$ses] = $value;
			endforeach;
		else:
			exit('Parameter set_session must to be array');
		endif;
	endif;

}

/*
	Elimina Sessão
 */
public function unset_session($sessions){
	if(isset($_SESSION)):
		if(is_array($sessions)):
			foreach ($sessions as $ses):
				if(isset($_SESSION[$ses]))
					unset($_SESSION[$ses]);
				else
					exit('{$_SESSION[$ses]} not exists');
			endforeach;

		elseif($sessions == '*'):
			session_destroy();

		elseif(isset($_SESSION[$sessions])):
			unset($_SESSION[$sessions]);

		else:
			exit("The SESSION {$sessions} not exists");
		endif;
	endif;

}

private function recursive_session($arr){
	if(is_array($arr)):
		foreach ($arr as $a):
			if(is_array($a)):
				$r = $this->recursive_session($a);
				return $r;
			else:
				return $a;
			endif;
		endforeach;
	else:
		return $arr;
	endif;
}

}