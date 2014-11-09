<?php
ob_start();
session_start();

/*
 *---------------------------------------------------------------
 * NOME DA PASTA DO MOTOR DO FRAMEWORK
 *---------------------------------------------------------------
 *
 * Esta variável deve conter o nome da aonde se encontra o motor do framework.
 * Por padrão, a pasta do motor é "engine"
 *
 */
	$engine_folder = 'engine';

/*
 *---------------------------------------------------------------
 * PASTA DA APLICAÇÂO
 *---------------------------------------------------------------
 *
 * Esta variável armazena o caminho aonde a aplicação se encontra.
 * Você pode colocar a aplicação em outro directório, para isso altere
 * altere o valor desta variável, colocando o caminho aonde o mesmo se encontra.
 */
	$application_folder = 'application';

/*
 *---------------------------------------------------------------
 * PASTA LAYOUT
 *---------------------------------------------------------------
 *
 * Esta pasta irá conter os arquivos js, imagens, css e html.
 * É nesta pasta que o front-end será criado.
 * O padrão do framework é "layout".
 */
	$layout_folder = 'layout';



/*
 * ---------------------------------------------------------------
 *  Configura o diretório do framework
 * ---------------------------------------------------------------
 */

	// Definindo o Diretórios

	if (defined('STDIN')):

		chdir(dirname(__FILE__));

	endif;


	if (realpath($engine_folder) !== FALSE):

		$engine_folder = realpath($engine_folder).'/';

	endif;

	// assegurar que há uma barra no final
	$engine_folder = rtrim($engine_folder, '/').'/';

	// Verifica se a pasta do motor do framework existe
	if (!is_dir($engine_folder)):

		exit(utf8_decode("O caminho da pasta do motor/sistema não está definido corretamente. Arquivo: ").pathinfo(__FILE__, PATHINFO_BASENAME));

	endif;


/*
 * ---------------------------------------------------------------------
 *  Após o diretório do motor ter sido definido, criaremos as constantes
 * ---------------------------------------------------------------------
 */

	//Caminho do diretório do FrameWork
	define('BASEPATH', str_replace("\\", "/", dirname(rtrim(__FILE__, '/'))).'/');

	// Caminho do diretório do motor
	define('ENG_BASEPATH', str_replace("\\", "/", $engine_folder));

	// Nome da pasta do motor "engine_folder"
	define('ENGINE_DIR', trim(strrchr(trim(ENG_BASEPATH, '/'), '/'), '/'));



/*
* ---------------------------------------------------------------------------
* Assim como o diretório do Motor, iremos definir constantes para a Aplicação
* ---------------------------------------------------------------------------
 */

	if (realpath($application_folder) !== FALSE):

		$application_folder = realpath($application_folder).'/';

	endif;

	// assegurar que há uma barra no final
	$application_folder = rtrim($application_folder, '/').'/';

	//Remove barras invertidas e adiciona barra no final
	$application_folder = str_replace("\\", "/", $application_folder);


	// The path to the "application" folder
	if (is_dir($application_folder)):

		define('APP_BASEPATH', $application_folder);

	else:

		if (!is_dir(BASEPATH.$application_folder)):

			exit(utf8_decode("O caminho da pasta aplicação não está definido corretamente. Arquivo: ").pathinfo(__FILE__, PATHINFO_BASENAME));

		endif;

		define('APP_BASEPATH', BASEPATH.$application_folder);

	endif;

	define('APP_DIR', trim(strrchr(trim(APP_BASEPATH, '/'), '/'), '/'));

/*
* ---------------------------------------------------------------------------
* Assim como o diretório do Motor, iremos definir constantes para o Layout
* ---------------------------------------------------------------------------
 */

	if (realpath($layout_folder) !== FALSE):

		$layout_folder = realpath($layout_folder).'/';

	endif;

	// assegurar que há uma barra no final
	$layout_folder = rtrim($layout_folder, '/').'/';

	//Remove barras invertidas e adiciona barra no final
	$layout_folder = str_replace("\\", "/", $layout_folder);


	// The path to the "application" folder
	if (is_dir($layout_folder)):

		define('LAY_BASEPATH', $layout_folder);

	else:

		if (!is_dir(BASEPATH.$layout_folder)):

			exit(utf8_decode("A pasta do layout não foi encontrada. Acesse o seguinte arquivo para configurar o diretório corretamente: ").pathinfo(__FILE__, PATHINFO_BASENAME));

		endif;

		define('LAY_BASEPATH', BASEPATH.$layout_folder);

	endif;

	define('LAY_DIR', trim(strrchr(trim(LAY_BASEPATH, '/'), '/'), '/'));


require_once ENG_BASEPATH.'core/init/WeInit.php';

/* Fim do arquivo index.php */
/* Localização: ./index.php */