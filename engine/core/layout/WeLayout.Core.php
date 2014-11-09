<?php

/*
* ------------------------------------------------------------------
* Este arquivo não pode ser acessado diretamente
* ------------------------------------------------------------------
*/
if (!defined('ENG_BASEPATH')) exit(utf8_decode('Você não pode acessar este arquivo diretamente diretamente.'));



Class WeLayout {

	//Vars
	static $title_page = '';

	/*
		Caminho do tema atual
	*/
	public function get_base_theme_path(){
		if(defined('THEME_PATH'))
			return THEME_PATH;
		else
			exit('Não foi possível localizar o diretório do tema.');
	}

	/*
		Página index.php do tema
	*/

	public function file_index_theme(){
		$path = $this->get_base_theme_path().'index.php';

		//Verifica se o arquivo existe
		if(is_file($path)):
			//inclui página inicial do tema
			return $path;
		else:
			exit(utf8_decode('Falha ao carregar o tema.'. THEME.'/index.php não existe.'));
		endif;
	}


	public function load_page($page){
		//Camimho do diretório html
		$path = $this->get_base_theme_path().'pages/';

		//Verfica se a variável $page está sendo passado um arquivo
		if (strpos($page, ".") !== false):
		   	$file = $path.$page;
		   	if(is_file($file)):
		   		echo $this->global_include($file);
		   	else:
		   		exit('Não foi possível localizar o arquivo '.$page);
		   endif;
		else:
			if(is_extra_theme()):
				$walk = walk_url('mode');
			    $file = $path.$walk.'/'.$walk.'.php';
			   	if(is_file($file)):
			   		echo $this->global_include($file);
			   		//include_once $file;
			   	else:
			   		redirect_url(base_url().'error/404');
			   		//exit('Não foi possível localizar o arquivo '.$page.'.php');
			   	endif;
			else:
			    $file = $path.$page.'/'.$page.'.php';
			   	if(is_file($file)):
			   		echo $this->global_include($file);
			   	else:
			   		redirect_url(base_url().'error/404');
			   		//exit('Não foi possível localizar o arquivo '.$page.'.php');
			   	endif;
			endif;
		endif;


	}

	/*
		Redirecionar página
	*/
	public function redirect_url($url){
		header('Location: '.$url);
	}


	/*
		Retorna o nome do arquivo de uma url de diretório
	*/

	public function get_file_name_path($path){
		return phpinfo($path. PATHINFO_BASENAME);
	}


	/*
		Páginas de erro
	*/



	public function error_page($page){

		if(is_extra_theme())
			$page = walk_url($page);

		$path = get_base_theme_path().'pages/error/'.$page;
		if(is_file($path)):
			$page = explode('.', $page);
			$page = $page[0];
			$url = base_url().'error/'.$page;
			redirect_url($url);
		endif;
	}

	/*
		Carregar página de erro
	*/
	public function set_error(){
		if(isset($_REQUEST['page'])):
			if(is_extra_theme()):
				$cod = walk_url('page', 2);
				$error_page = $cod.'.php';
				$this->load_page('error/'.$error_page);
			else:
				$cod = $_REQUEST['page'];
				$error_page = $cod.'.php';
				$this->load_page('error/'.$error_page);
			endif;
		endif;
	}

	/*
		Carregar página de erro
	*/
	public function set_fatal_error(){
		if(isset($_REQUEST['page'])):
			if(is_extra_theme()):
				$cod = walk_url('page', 2);
				$error_page = $cod.'.php';
				$this->load_page('error/'.$error_page);
			else:
				$cod = $_REQUEST['page'];
				$error_page = $cod.'.php';
				$this->load_page('error/'.$error_page);
			endif;
		endif;
	}


	/*
		Este método retorna o valor de uma varíavel da URL ou POST
	 */
	public function get_request($request){
		if(is_extra_theme()):
			return walk_url($request);
		else:
			if(isset($_GET[$request]))
				return $_GET[$request];
			else
				return false;
		endif;
	}

	/*
		Este método retorna a variável da URL com base no valor
	 */

	public function get_key_request($param){
        if (strpos($param, "/") !== false):

			$exp = explode('/', $param);
			$flag = 0;

			$urlr = $_GET;
			if(is_extra_theme())
				unset($urlr['mode']);

			foreach ($exp as $url):
				$key = array_search($url, $urlr);
				if($key || $key != '' || $url == '*')
					$flag++;
				else
					return false;
			endforeach;

			if($flag > 0 && (count($urlr) == $flag)):
				return true;
            else:
                return false;
			endif;

		else:
			$key = array_search($param, $_GET);
			if($key || $key != ''):
				$url = $_GET;
				if(is_extra_theme())
					unset($url['mode']);

				if(isset($url['PHPSESSID']))
                    unset($url['PHPSESSID']);

                if(isset($url[$key]) && count($url) == 1)
					return $key;
				else
					return false;
			else:
				return false;
			endif;
		endif;
	}

	/*
		Esta funcção é responsável por carregar o conteúdo da página

	*/

	public function loop(){

		//Página a ser carrregada
		$page = '';

		//verifica se o usuário está em tema diferente do principal
		if(is_extra_theme()):
			//Sendo assim, movemos a varável da url $_REQUEST['mode'] para $_REQUEST['page']
			$walk = walk_url('mode');
			if(empty($walk))
				redirect_url(base_url().index_page());
			else
				$page = $walk;
		else:
			if(get_request('mode'))
				$page = get_request('mode');
			else
				redirect_url(base_url().index_page());

		endif;

		//Se a variável $page estiver com valor, carregamos o conteúdo da página
		if(!empty($page)):
			//Verificamos se a página não é a de erro, caso não,  carregaremos o conteúdo da página
			if($page == 'error'):
				set_error();
			elseif($page == 'fatal-error'):
				set_fatal_error();
			else:
				load_page($page);
			endif;

		endif;
	}

	/*
		Título da página
	 */

		/*
			Retorna o Título da página
		*/

	public function get_title(){

		return  self::$title_page;
	}

	/*
		Arameza o título da página
	*/
	 public function set_title($title = ''){

	 	if(is_array($title)):
	 		foreach ($title as $page => $t):
	 			if(is_array($t)):
	 				$this->set_title($t);
	 			else:
	 				$request = array_search($page, $_REQUEST);
	 				if($request):
	 					$request = $t;
	 					self::$title_page = $request;
	 				endif;
	 			endif;

	 			if(!isset($request) || !$request):
		 			$default = array_search($page, $_REQUEST);
		 			if(empty(self::$title_page) && isset($title[$page]['default']) && isset($_REQUEST[$default]) && $_REQUEST[$default] == $page):
		 				$request = $title[$page]['default'];
		 				self::$title_page = $request;
		 			endif;
		 		endif;

	 		endforeach;

	 	else:
	 		if(empty($title))
				self::$title_page = '';
			else
				self::$title_page = $title;
	 	endif;

	}


	/*
	 *  Include Session
	 *
	 */

	public function include_session($path){
		$_SESSION['HTML_INCLUDES'][] = $path;
	}



	public function global_include($script_path) {
	    // check if the file to include exists:
	    if (isset($script_path) && is_file($script_path)) {
	        // extract variables from the global scope:
	        extract($GLOBALS, EXTR_REFS);
	        ob_start();
	        include($script_path);
	        return ob_get_clean();
	    } else {
	        ob_clean();
	        trigger_error($script_path.' Não foi encontrado.');
	    }
	}




}