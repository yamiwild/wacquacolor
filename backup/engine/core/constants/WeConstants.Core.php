<?php
/*
* ------------------------------------------------------------------
* Este arquivo não pode ser acessado diretamente
* ------------------------------------------------------------------
*/
if (!defined('ENG_BASEPATH')) exit(utf8_decode('Você não pode acessar este arquivo diretamente diretamente.'));

/*
*----------------------------------------------------------
* Constantes
* Este arquivo contém as constantes principais do Framework
* ---------------------------------------------------------
*/

/*
	DIRECTORY SEPARATOR '/'
 */

define( 'DS', '/' );

/*
| ----------------------------------------------------------
|
|  APPLICATION - Definição do tipo de uso da aplicação
|
| ----------------------------------------------------------
*/


/*
	Definição
 */
if($config['definition'] != ''):

	$definition = $config['definition'];

	switch ($definition):
			case 'application':
				define('DEFINITION', $definition);
				break;
			case 'html':
				define('DEFINITION', $definition);
				break;

			default:
				exit(utf8_decode('A definição da aplicação é inválida.'));
				break;
	endswitch;

else:
	exit(utf8_decode('A definição da aplicação não foi definida corretamente.'));
endif;

/*
| ----------------------------------------------------------
|
|  ENVIRONMENT - Definição de ambiente
|
| ----------------------------------------------------------
*/
if(isset($config['environment'])):
	$environment = $config['environment'];

	if(isset($config['error_debug'][$environment])):
		$level = $config['error_debug'][$environment];

		switch ($level):
				case 2:
					error_reporting(E_ERROR | E_WARNING | E_PARSE);
					define('ENVIRONMENT', $environment);
					break;
				case 1:
					error_reporting(-1);
					define('ENVIRONMENT', $environment);
					break;
				case 0:
					error_reporting(0);
					define('ENVIRONMENT', $environment);
					break;

				default:
					exit(utf8_decode('O nível do "error_dubug" está incorreto.'));
					break;
		endswitch;
	else:
		exit(utf8_decode('O "error_dubug" não foi definido.'));
	endif;

else:
	exit(utf8_decode('O ambiente da aplicação não foi definido corretamente.'));
endif;


/*
	TEMAS e APP
*/

// Verifica se os temas estão configurados
if(count($config['themes']) > 0):
	//Verifica se foi definido um tema principal
	if($config['main_theme'] != ''):
		//Verifica se foi definido as páginas iniciais do tema
		if(count($config['theme_index']) > 0):
			//Criação de variáveis de configuração
			$themes 			= $config['themes'];
			$main_theme 		= $config['main_theme'];
			$theme_index 		= $config['theme_index'];
			$theme_alias 		= $config['theme_alias'];
			$current_theme 		= '';
			$index_page 		= '';
			//Verifica se existe uma tema com o primeiro parâmetro da URL
			$mode = (isset($_REQUEST['mode']))?$_REQUEST['mode']:'';

			//Verficamos se existe um alias e se $mode representa um tema
			if(is_array($theme_alias) && count($theme_alias) > 0):
				//Procuramos no array se existe um alias que equivale ao $mode
				if(in_array($mode, $theme_alias)):
					//Se  for encontrado um alias, armazenamos o valor
					$current_theme = array_search($mode, $theme_alias);
					//Definos constante para alias
					define('THEME_ALIAS', $mode);
				endif;
			endif;

			//Se não for encontrado um alias e o tema não tiver sido definido
			if(empty($current_theme) || $current_theme == '' && !defined('THEME_ALIAS')):
				//Verificamos se na url foi digitado o nome do tema
				if(is_dir(LAY_BASEPATH.'themes/'.$mode) && !empty($mode)):
					$current_theme = $mode;
					define('THEME_ALIAS', $current_theme);
				else:
					//Se não foi encontrado o tema passado pela URL, definimos o tema principal
					$current_theme = $main_theme;
				endif;
			endif;

			//Com o tema defido, verificamos se o tema realmente existe fisicamente.
			if(is_dir(LAY_BASEPATH.'themes/'.$current_theme)):
				//Se o tema realmente existir fisicamente, definiremos em seguida as constantes
				define('THEME', $current_theme);
				define('MAIN_THEME', $main_theme);
				define('THEME_PATH', LAY_BASEPATH.'themes/'.THEME.'/');

				//Após definir algumas constantes, vamos verificar a aplicação
				if(DEFINITION == 'application'):
					if(isset($config['app_themes'])):
						$app_themes = $config['app_themes'];
						if(count($app_themes) > 0):
							foreach ($app_themes as $app => $theme):
								if($theme == THEME):
									define('APP_THEME', $theme);
									define('APP', $app);
									break;
								endif;
							endforeach;
						else:
							exit(utf8_decode('DEFINITION é de nível application, não foi detectado nenhuma aplicação a ser inicializado. Verifique as configurações em WeConfig.Core.php na linha 69'));
						endif;
					else:
						exit(utf8_decode('APP_THEMES não definido, DEFINITION é de nível application e precisa ser definido um tema para a aplicação. Verifique as configurações em WeConfig.Core.php na linha 69'));
					endif;
				endif;

				//Vamos agora verificar a página inicial do tema atual
				if(isset($theme_index[THEME])):
					$index_page = $theme_index[THEME];
					//Verificamos se a página existe
					$page_path = THEME_PATH.'pages/'.$index_page.'/'.$index_page.'.php';
					if(is_file($page_path)):
						//Vamos criar umas constante para definir se um tema atual é diferente do tema principal TRUE/FALSE
						if(!defined('THEME_ALIAS'))
							define('THEME_EXTRA_FLAG', FALSE);
						else
							define('THEME_EXTRA_FLAG', TRUE);

						//Vamos definir também uma constante para a página inicial
						define('THEME_INDEX', $index_page);

					else:
						exit(utf8_decode('Página inicial do tema <b>'.THEME.'</b> não foi definida.'));
					endif;

				else:
					exit(utf8_decode('Página inicial do tema <b>'.THEME.'</b> não foi definida.'));
				endif;

			else:
				exit(utf8_decode('O tema <b>'.$current_theme.'</b> não foi encontrado'));
			endif;
		else:
			exit(utf8_decode('A página inicial do tema não foi definido.'));
		endif;
	else:
		exit(utf8_decode('O tema principal não foi definido.'));
	endif;

else:
	exit(utf8_decode('Nenhum tema definido no arquivo de configuração.'));
endif;

/*
|
|	Servidor de E-mail
|
 */
define('SRV_EMAIL_HOST', $config['email']['host']);
define('SRV_EMAIL_USERNAME', $config['email']['username']);
define('SRV_EMAIL_PASSWORD', $config['email']['password']);


/* --------------------------------------------------------
|
|	LOG - Diretórios de log (Dicionário)
|
|   [LOG_PATH] Diretório padrão de logs
|	[DB_LOG_PATH] Log exclusivo para erros de banco de dados
|	[GENERAL_LOG_PATH] Log de erros em geral
|
| ---------------------------------------------------------
*/
if(isset($config['log_path'])):
	$log_path = $config['log_path'];
else:
	$log_path = ENG_BASEPATH.'log/';
endif;

//Define uma constante para o diretório de log
define('LOG_PATH', $log_path);

define('DB_LOG_PATH', LOG_PATH.'db/');

define('GENERAL_LOG_PATH', LOG_PATH.'general/');




/*
| ----------------------------------------------------------
|
|  URL - URL BASE
|
| ----------------------------------------------------------
*/

define('HTTP_HOST', $_SERVER['HTTP_HOST']);
define('REAL_BASE_URL',  $config['base_url']);

if(defined('HOT_THEME_ALIAS'))
	define('BASE_URL', $config['base_url'].'/'.HOT_THEME_ALIAS);
else
	define('BASE_URL', $config['base_url']);




/*
| -----------------------------------------------------------
|
| HTACCESS
|
| -----------------------------------------------------------
 */

if(count($config['htaccess_param_url']) > 0):
	$_SESSION['HTACCESS_PARAM_URL'] = $config['htaccess_param_url'];
endif;



?>