<?php


/*
* ------------------------------------------------------------------
* Este arquivo não pode ser acessado diretamente
* ------------------------------------------------------------------
*/
if (!defined('ENG_BASEPATH')) exit(utf8_decode('Você não pode acessar este arquivo diretamente diretamente.'));


/*
* ------------------------------------------------------------------
* O WE-Framework irá fazer uma checagem dos arquivos do motor
* ------------------------------------------------------------------
*/
$core_files = array();


//Arquivos do motor
$core_files['config'] 		= ENG_BASEPATH.'core/config/WeConfig.Core.php';
$core_files['autoload' ] 	= ENG_BASEPATH.'core/autoload/WeAutoload.Core.php';
$core_files['constants'] 	= ENG_BASEPATH.'core/constants/WeConstants.Core.php';
$core_files['log'] 			= ENG_BASEPATH.'core/log/WeLog.Core.php';
$core_files['database'] 	= ENG_BASEPATH.'core/database/WeDataBase.Core.php';
$core_files['default'] 		= ENG_BASEPATH.'core/default/WeDefault.Core.php';
$core_files['helpers'] 		= ENG_BASEPATH.'core/helpers/WeHelpers.Core.php';
$core_files['language'] 	= ENG_BASEPATH.'core/language/WeLanguage.Core.php';
$core_files['layout'] 		= ENG_BASEPATH.'core/layout/WeLayout.Core.php';
$core_files['module'] 		= ENG_BASEPATH.'core/module/WeModule.Core.php';
$core_files['security'] 	= ENG_BASEPATH.'core/security/WeSecurity.Core.php';
$core_files['init'] 		= ENG_BASEPATH.'core/init/WeFramework.Core.php';
//MCV
$core_files['controller'] 	= ENG_BASEPATH.'core/module/mvc/WeController.Class.php';
$core_files['model'] 		= ENG_BASEPATH.'core/module/mvc/WeModel.Class.php';

$flag_core = array();

/*
	Arquivos adicionais
 */
$extra_files['theme_functions']	= ENG_BASEPATH.'helpers/functions/theme/general_functions.php';



/*
* ----------------------------------------------------------------
* Os arquivos existem? caso não, o framework não será iniciado
* ----------------------------------------------------------------
 */
if(count($core_files) > 0):
	foreach ($core_files as $path => $fcore):
		if(!is_file($fcore)):
			$flag_core[] = $fcore;
		endif;
	endforeach;
else:
	exit(utf8_decode("Nenhum arquivo do sistema encontrado, inclua os arquivos do sistema em: ").pathinfo(__FILE__, PATHINFO_BASENAME));
endif;

//Arquivos não encontrados
if(count($flag_core) > 0):
	foreach ($flag_core as $erfile):
		echo utf8_decode('Impossível iniciar o WE-Framework sem o arquivo: ').pathinfo($erfile, PATHINFO_BASENAME).'<br/>';
	endforeach;
	exit();
endif;

/*
* -----------------------------------------------------------------
* Se os arquivos do motor existirem, carrega os arquivos base/core
* -----------------------------------------------------------------
*/

foreach ($core_files as $fcore):
	//Incluindo arquivos do motor
	require_once $fcore;
endforeach;

unset($core_files['controller']);
unset($core_files['model']);


/*
* -----------------------------------------------------------------
* Incluímos os arquivos adicionais /lib
* -----------------------------------------------------------------
*/
foreach ($extra_files as $flib):
	//Verificamos se o arquivo existe
	if(is_file($flib))
		require_once $flib;
	else
		exit(utf8_decode('Não foi possível localizar o arquivo '.$flib));
endforeach;


/*
*------------------------------------------------------------------
* Inicia o motor do framework
*------------------------------------------------------------------
*/



//Definições de configuração
$options = $config;
//Iniciando Framework
$we = new WeFramework();
$we->_init_instance($options, $core_files);

/*
	Controller da Aplicação
*/
	/*
		Contante do MODULE
		Módulo atual
 	*/
	define('MODULE', get_request('mode'));

	if(DEFINITION == 'application' && defined('APP')):
		$controller_file = ucfirst(MODULE).'.Controller.php';
		$controller_path = APP_BASEPATH.APP.'/'.MODULE.'/controller/'.$controller_file;
		if(is_file($controller_path)):
			include_once $controller_path;
			$class = ucfirst(MODULE).'_Controller';
			$controller = new $class();
			//Método da URL
			$method = get_request('page');
			if(method_exists($controller, $method))
				$controller->$method();
			elseif(method_exists($controller, 'index'))
				$controller->index();

			$we_extract = $controller->extract_data_view();
			if($we_extract)
				extract($we_extract);
		endif;
	endif;

/*
	Autenticação do usuário
 */
$we->user_auth(array('we-admin' => 'login'));

/*
	Inicia página HTML do tema atual
*/
include_once $we->file_index_theme();









