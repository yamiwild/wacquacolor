<?php
/*
* ------------------------------------------------------------------
* Este arquivo não pode ser acessado diretamente
* ------------------------------------------------------------------
*/

if (!defined('ENG_BASEPATH')) exit(utf8_decode('Você não pode acessar este arquivo diretamente diretamente.'));

Class WeFramework extends WeAutoload{



	//Vars
	private static $instance = null;
	private static $init_instance = null;


	public function _init_instance($options, $core_files){
		if(isset(self::$init_instance)):
			return self::$init_instance();
		else:
			self::$init_instance = $this->_init($options, $core_files);
		endif;
	}

	public function _init($options, $core_files){



		//No motor não exispe apenas classes, por tanto vamos retirar do array
		unset($core_files['config']);
		unset($core_files['constants']);
		unset($core_files['init']);
		unset($core_files['autoload']);


		/*
		|
		|	Instanciando as classes do motor
		|
		*/

		foreach ($core_files as $core => $fcore):
			//Guarda somente o nome do arquivo
			$file_name = explode('.', pathinfo($fcore, PATHINFO_BASENAME));
			$obj_class = lcfirst($file_name[0]);

			//Verifica se a classe existe
			if(class_exists($obj_class)):
				//Faz herança com as classes do motor
				parent::addExt(new $obj_class);

			else:
				exit(utf8_decode('A classe <b>'.$obj_class.'</b> não foi encontrada/declarada em : '.$fcore));

			endif;

		endforeach;


		/*
		|	Iniciando Conxão com o banco de dados
		*/
			$this->init_db_connection($options['db']);

		/*
			Cria JS
		*/
			$this->touch_essential_js();
	}

	/*
	|
	| Singleton
	|
	*/

	public static function _weframework_instance(){
		if(!isset(self::$instance)):
			self::$instance = new WeFramework();
		endif;
		return self::$instance;
	}


	/*
		Inicia o nível aplication

	 */

	public function _init_application(){
		$path_controller = APP_BASEPATH.'/';
	}


	/**
	 *  Cria JavaScript	 *
	 */
	private function touch_essential_js(){
		if(defined('THEME_PATH')):
			$dir = THEME_PATH.'assets/scripts/';
			if(is_dir($dir)):
				$file = $dir.'weframework.js';
				if(!is_file($file)):
					touch($file);
					include_once ENG_BASEPATH.'lib/weframework/js/JavaScript.Class.php';
					$js = new JavaScript();
					$methods = get_class_methods ('JavaScript');
					$fp = fopen($file, 'w');
					foreach ($methods as $method):
						fwrite($fp, $js->$method().PHP_EOL);
					endforeach;
					fclose($fp);
				endif;
			endif;
		endif;
	}


}