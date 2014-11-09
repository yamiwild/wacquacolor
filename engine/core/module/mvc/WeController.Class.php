<?php

class WeController extends WeAutoload{

	public function __construct(){
		/*
			Carregar classe auxiliares
		 */
		$security_path 	= ENG_BASEPATH . 'core' . DS . 'security' . DS . 'WeSecurity.Core.php';

		$this->autoload_class($security_path, 'WeSecurity');

	}

	public function load(){
		return $this;
	}


	public function model($model = '', $obj = ''){

		if(!empty($model) || $model != ''):
			$fpath = APP_BASEPATH.APP.'/'.$model.'/model/'.ucfirst($model).'.Model.php';

			if($obj != '')
				$nclass = $obj;
			else
				$nclass = $model.'_Model';

			$this->autoload_class($fpath, $nclass);

		else:
			echo utf8_decode('Falha ao carregar model. O Model não existe ou não foi informado correntamente.');
			exit();
		endif;

	}

	/*
		Transfere os dados do controller para a view
	 */
	public function view($view, $data){

		if(isset($_POST) || count($_POST) > 0):
            foreach ($_POST as $key => $value):
				unset($_GET[$key]);
				unset($_POST[$key]);
			endforeach;
		endif;
		if(get_key_request($view)):
			$this->session_view($data);
		endif;

	}

	/*
		Carrega Controller
	 */

	public function controller($model = '', $obj = ''){

		if(!empty($model) || $model != ''):
			$fpath = APP_BASEPATH.APP.'/'.$model.'/controller/'.$model.'.Controller.php';

			if($obj != '')
				$nclass = $obj;
			else
				$nclass = $model.'_Model';

			$this->autoload_class($fpath, $nclass);

		else:
			echo utf8_decode('Falha ao carregar o controller. O controlador não existe ou não foi informado correntamente.');
			exit();
		endif;

	}

	/*
		Carrega componetes
	 */
	public function component($component = '', $obj = '',  $module = '', $path = ''){

		if(!empty($component) || $component != ''):
			if(is_array($component)):
				if(count($component) > 0):
					foreach ($component as $comp => $objj):
						if(is_int($comp)):
							$comp = $objj;
						endif;
						$fpath = $this->component_validation($comp, $module, $path);
						$objj = $this->obj_component_validation($comp, $objj);
						$this->autoload_class($fpath, $objj);
					endforeach;
				else:
					$ar_key = array_keys($component);
					$comp = $ar_key[0];
					if(is_int($comp)):
						$obj = $component[0];
						$component = $component[0];
					else:
						$obj = $component[$comp];
						$component = $comp;
					endif;

					$obj = $this->obj_component_validation($component, $obj);

					$fpath = $this->component_validation($component, $module, $path);

					$this->autoload_class($fpath, $obj);

				endif;
			else:

				$fpath = $this->component_validation($component, $module, $path);
				$obj = $this->obj_component_validation($component, $obj);
				$this->autoload_class($fpath, $obj);

			endif;

		else:
			echo utf8_decode('Falha ao carregar componente. O componente não existe ou não foi informado correntamente.');
			exit();
		endif;

	}

	/*
		Carrega classe extra
	 */
	protected function autoload_class($path, $obj){
		if(is_file($path)):
			include_once $path;
			return parent::addExt(new $obj);
		else:
			exit(utf8_decode('Não foi possível localizar '.$path));
		endif;

	}

	/*
		Valida objeto do componente
	 */

	protected function obj_component_validation($component, $obj = ''){
		if(empty($obj) || $obj == ''):
			if(strpos($component, '_Component') !== false)
				$nobj = $component;
			else
				$nobj = $component.'_Component';

		else:
			if(strpos($obj, '_Component') !== false)
				$nobj = $obj;
			else
				$nobj = $obj.'_Component';
		endif;

		return $nobj;
	}


	/*
		Valida componente
	*/
	protected function component_validation($component, $module = '', $path = ''){
		if(strpos($component, '.Component') !== false):
			if(strpos($component, '/') !== false):
				if(strpos($component, '.php') !== false)
					$file = $component;
				else
					$file = $component.'.php';
			else:
				if(strpos($component, '.php') !== false)
					$file = $component;
				else
					$file = $component.'.php';
			endif;

		else:

			if(strpos($component, '/') !== false):
				if(strpos($component, '.php') !== false)
					$file = $component;
				else
					$file = $component.'.Component.php';
			else:
				if(strpos($component, '.php') !== false)
					$file = $component;
				else
					$file = $component.'.Component.php';
			endif;
		endif;

		if(!empty($path) || $path != '' && $module == ''):
			$path = rtrim($path, '/').'/';
			return $path.$file;
		elseif($module != '' || !empty($module)):
			return APP_BASEPATH.APP.'/'.$module.'/components/'.$file;
		elseif(empty($module) || $module == ''):
			return APP_BASEPATH.APP.'/'.MODULE.'/components/'.$file;
		else:
			return false;
		endif;
	}


	/*
		Cria uma sessão para fazer a transferência de dados
	*/
	public function session_view($data){

		if(!isset($_SESSION['WE_VIEW_DATA'])):
			if(is_array($data) && count($data) > 0):
				foreach ($data as $var => $val):
					$_SESSION['WE_VIEW_DATA'][$var] = $val;
				endforeach;
			endif;
		endif;
	}


	/*
		Extrai os dados da sessão
	*/
	public function extract_data_view(){
		if(isset($_SESSION['WE_VIEW_DATA'])):
			$data = $_SESSION['WE_VIEW_DATA'];
			if(is_array($data) && count($data) > 0):
				unset($_SESSION['WE_VIEW_DATA']);
				return $data;
			else:
				unset($_SESSION['WE_VIEW_DATA']);
				return $data;
			endif;
		else:
			return false;
		endif;
	}






}


?>