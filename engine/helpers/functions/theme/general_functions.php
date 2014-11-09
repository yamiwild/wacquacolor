<?php
/*
* ------------------------------------------------------------------
* Este arquivo não pode ser acessado diretamente
* ------------------------------------------------------------------
*/
if (!defined('ENG_BASEPATH')) exit(utf8_decode('Você não pode acessar este arquivo diretamente diretamente.'));



/*
* -----------------------------------------------------------------------------
* Funções base do Framework
* -----------------------------------------------------------------------------
*/

/*
	Variaveis
 */
$title_page = '';

$lay = new WeLayout();


/*
 *
 *   Incluir um arquivo fora do escopo
 *   Global
 *
 */

function global_include($script_path) {
  	// Verifica se o arquivo existe
    if (isset($script_path) && is_file($script_path)):
        // Extrai variáveis do escopo global
        extract($GLOBALS, EXTR_REFS);
        ob_start();
        include_once $script_path;
        return ob_get_clean();
    else:
        ob_clean();
        exit(utf8_decode($script_path.' Não foi encontrado.'));
    endif;

}


/*
	Esta função retorna o caminho do tema atual
*/
function get_base_theme_path(){
	if(defined('THEME_PATH')):
		$path = THEME_PATH;
		if(is_dir($path))
			return $path;
		else
			exit('Não foi possível localizar o diretório do tema.');
	endif;
}

/*
	Esta função inclui o arquivo includes/base_theme/header.php
*/
function get_header(){
	if(!is_fatal_error()):
		$theme_path = get_base_theme_path();
		$path = $theme_path.'includes/base_theme/header.php';

		if(is_file($path)):
			echo global_include($path);
		else:
			exit('Não foi possível localizar o arquivo header.php');
		endif;
	endif;
}

/*
	Esta função inclui o arquivo includes/base_theme/head.php
*/
function get_head(){
	if(!is_fatal_error()):
		$theme_path = get_base_theme_path();
		$path = $theme_path.'includes/base_theme/head.php';

		if(is_file($path)):
			global $lay;
			echo global_include($path);
			//include_once $path;
		else:
			exit('Não foi possível localizar o arquivo head.php');
		endif;
	endif;
}

/*
	Esta função inclui o arquivo includes/base_theme/content.php
*/
function get_content(){
	$theme_path = get_base_theme_path();
	$path = $theme_path.'includes/base_theme/content.php';

	if(is_file($path)):
		global $lay;
		echo global_include($path);
	else:
		exit('Não foi possível localizar o arquivo content.php');
	endif;
}

/*
	Esta função inclui o arquivo includes/base_theme/footer.php
*/
function get_footer(){
	if(!is_fatal_error()):
		$theme_path = get_base_theme_path();
		$path = $theme_path.'includes/base_theme/footer.php';

		if(is_file($path)):
			global $lay;
			echo global_include($path);
		else:
			exit('Não foi possível localizar o arquivo footer.php');
		endif;
	endif;
}


/*
	Esta função inclui o arquivo includes/base_theme/loop.php
*/

function get_loop(){
	loop();
}


/*
	Esta funcção é responsável por carregar o conteúdo da página
	O método se encontra em : engine/core/layout/WeLayout.Core.php
*/

function loop(){
	global $lay;
	$lay->loop();
}

/*
	Incluir arquivo
*/
function include_file($file){
	global $lay;
	if(strpos($file, '/')):
		$theme_path = get_base_theme_path().$file;
		$file = $theme_path;
		if(is_file($file))
			echo global_include($file);
		else
			exit(utf8_decode('Não foi possível localizar o arquivo '.$file));
	else:
		$theme_path = get_base_theme_path();
		$file = $theme_path.'includes/'.$file;
		if(is_file($file))
			echo global_include($file);
		else
			exit(utf8_decode('Não foi possível localizar o arquivo '.$file));
	endif;

}


/*
	URL base 'http://'...
 */
function base_url(){

	$default = new WeDefault();
	return $default->base_url();
}

/*
	Retorna a url do projeto
 */
function base_url_project(){
	return 'http://'.HTTP_HOST.'/'.REAL_BASE_URL.'/';
}

/*
	URL do tema ataul
	O método se encontra em : engine/core/default/weDefault.Core.php
*/
function theme_base_url(){

	return 'http://'.HTTP_HOST.'/'.REAL_BASE_URL.'/layout/themes/'.THEME.'/';
}

/*
	Carrega página
	O método se encontra em : engine/core/layout/WeLayout.Core.php
*/

function load_page($page){
	global $lay;
	$lay->load_page($page);
}

/*
	Redirecionar página
*/

function redirect_url($url){
	header('Location: '.$url);
}


/*
	Verifica váriaveis passadas via URL . Retorna True/False
 */

function check_url($get, $conditions = ''){
	$var_url = array('mode', 'page', 'subpage', 'content', 'action', 'naction');

}

/*
	Páginas de erro
	O método se encontra em : engine/core/layout/WeLayout.Core.php
*/


function error_page($page){
	global $lay;
	$lay->error_page($page);
}

/*
	Carregar página de erro
	O método se encontra em : engine/core/layout/WeLayout.Core.php
*/
function set_error(){
	global $lay;
	$lay->set_error();
}


/*
	Carregar página de erro
	O método se encontra em : engine/core/layout/WeLayout.Core.php
*/
function is_fatal_error(){
	if(get_request('mode') == 'fatal-error')
		return true;
	else
		return false;
}

/*
	Carregar página de erro fatal
	O método se encontra em : engine/core/layout/WeLayout.Core.php
*/

function set_fatal_error(){
	global $lay;
	$lay->set_fatal_error();
}

/*
	Página inicial da aplicação
*/
function index_page(){
	if(defined('THEME_INDEX'))
		return THEME_INDEX;
	else
		return '';

}

/*
	Verifica se o usuário está em outro tema, sem ser o tema principal
*/

function is_extra_theme(){
	if(defined('THEME_EXTRA_FLAG'))
		return THEME_EXTRA_FLAG;
	else
		return false;
}


/*
	Esta função tem como finalidade trazer valor de uma variável antes ou depois de sua posição da URL
 */
function walk_url($url_request, $count = 0){
	$url = htaccess_param_url();
	$key = array_search($url_request, $url);

	if($count > 0):
		return $_GET[$url[$count]];
	else:
		$url_request = $url[$key+1];
		if(!empty($url_request) && isset($_GET[$url_request]))
			return $_GET[$url_request];
	endif;

}


/*
	Esta função tem como finalidade trazer valor de uma variável antes ou depois de sua posição da URL
 */
function isset_request($request){
	if(isset($_REQUEST[$request])):
		$val = $_REQUEST[$request];
		if(!empty($val))
			return filter_var($val, FILTER_SANITIZE_URL);
		else
			return false;
	else:
		return false;
	endif;
}

/*
	Monta uma sessão com os parâmetros das variáveis URL
 */

function htaccess_param_url(){
	if(count($_SESSION['HTACCESS_PARAM_URL']) > 0)
		return $_SESSION['HTACCESS_PARAM_URL'];
}

/*
	Este método retorna o valor de uma varíavel da URL ou POST
	O método se encontra em : engine/core/layout/WeLayout.Core.php
 */
function get_request($request){
	global $lay;
	return $lay->get_request($request);
}

/*
	Este método retorna o a chave/variavel da  URL
	O método se encontra em : engine/core/layout/WeLayout.Core.php
 */
function get_key_request($request){
	global $lay;
	return $lay->get_key_request($request);
}


/*
	Este método retorna true/false
	Verifica via URL se o parâmetro passado condiz com a página atual
	O método se encontra em : engine/core/layout/WeLayout.Core.php
 */
function require_page($request, $file = ''){
	global $lay;

	if($lay->get_key_request($request)):
		if(!empty($file))
			include_file($file);
		return true;
	else:
		return false;
	endif;
}


/*
	Retorna o Título da página
 */
function get_title(){

	global $lay;
	echo  $lay->get_title();
}

/*
	Arameza o título da página
*/
function set_title($title = ''){

	global $lay;
	$lay->set_title($title);
}


/*
	Retorna em numero a quantidade parametroa da url que estão setadas
 */

function current_url(){
	$param = htaccess_param_url();
	$count = 0;

	foreach ($param as $var) {
		if(isset($_GET[$var]))
			$count++;
	}

	return $count;
}


/*
	Conversão de data
 */
function date_to_br($date){
	$date = date('d/m/Y', strtotime($date));

	return $date;
}

function date_to_us($date){
	$date = explode('/', $date);
	$newDate = $date[2].'-'.$date[1].'-'.$date[0];

	return $newDate;
}

function datetime_to_us($date){
	$date = date('Y/m/d H:i:s', strtotime($date));

	return $date;
}

function datetime_to_br($date){
	$date = date('d/m/Y H:i:s', strtotime($date));

	return $date;
}

function get_name_month($month, $flag = false){
	$month = strtolower($month);
	$result = NULL;
	$arrm = array(1 => "janeiro",
		          2 => "fevereiro",
		          3 => "março",
		          4 => "abril",
		          5 => "maio",
		          6 => "junho",
		          7 => "julho",
		          8 => "agosto",
		          9 => "setembro",
		          10 => "outubro",
		          11 => "novembro",
		          12 => "dezembro");
	if(!$flag):
		if(isset($arrm[$month])):
			$result =  $arrm[$month];
		endif;
	else:
		$key = array_search($month, $arrm);
		if($key || !empty($key)):
			$result = $key;
		endif;
	endif;

	return $result;
}

/**
 * Mount link URL
 */
function pretty_url($string)
{

    $final = strtolower($string);
    $final = str_replace("’", "-", $final);
    $final = str_replace("?", "", $final);
    $final = str_replace("!", "", $final);
    $final = str_replace(".", "", $final);
    $final = str_replace("/", "", $final);
    $final = str_replace("#", "", $final);
    $final = str_replace("@", "", $final);
    $final = str_replace(":", "", $final);
    $final = str_replace(" ", "-", $final);
    $final = str_replace("&", "e", $final);
    $final = str_replace(",", "", $final);
    $final = str_replace(";", "", $final);

    $final = str_replace("á", "a", $final);
    $final = str_replace("à", "a", $final);
    $final = str_replace("â", "a", $final);
    $final = str_replace("ä", "a", $final);
    $final = str_replace("ã", "a", $final);

    $final = str_replace("é", "e", $final);
    $final = str_replace("è", "e", $final);
    $final = str_replace("ê", "e", $final);
    $final = str_replace("ë", "e", $final);

    $final = str_replace("í", "i", $final);
    $final = str_replace("ì", "i", $final);
    $final = str_replace("î", "i", $final);
    $final = str_replace("ï", "i", $final);

    $final = str_replace("ó", "o", $final);
    $final = str_replace("ò", "o", $final);
    $final = str_replace("ô", "o", $final);
    $final = str_replace("ö", "o", $final);
    $final = str_replace("õ", "o", $final);

    $final = str_replace("ú", "u", $final);
    $final = str_replace("ù", "u", $final);
    $final = str_replace("û", "u", $final);
    $final = str_replace("ü", "u", $final);

    $final = str_replace("Á", "A", $final);
    $final = str_replace("À", "A", $final);
    $final = str_replace("Â", "A", $final);
    $final = str_replace("Ã", "A", $final);
    $final = str_replace("Ä", "A", $final);

    $final = str_replace("É", "E", $final);
    $final = str_replace("È", "E", $final);
    $final = str_replace("Ê", "E", $final);
    $final = str_replace("Ë", "E", $final);

    $final = str_replace("Í", "I", $final);
    $final = str_replace("Ì", "I", $final);
    $final = str_replace("Î", "I", $final);
    $final = str_replace("Ï", "I", $final);

    $final = str_replace("Ó", "O", $final);
    $final = str_replace("Ò", "O", $final);
    $final = str_replace("Ô", "O", $final);
    $final = str_replace("Õ", "O", $final);
    $final = str_replace("Ö", "O", $final);

    $final = str_replace("Ú", "U", $final);
    $final = str_replace("Ù", "U", $final);
    $final = str_replace("Û", "U", $final);
    $final = str_replace("Ü", "U", $final);

    $final = str_replace("ç", "c", $final);
    $final = str_replace("ñ", "n", $final);

    $final = str_replace("Ç", "C", $final);
    $final = str_replace("Ñ", "N", $final);

    return $final;
}


/*
	Autoload para o Respect
 */

function respect_loader( $class ){

    $ext = '.php';
    $aux_path = 'engine/helpers/respect/';


    if (strpos($class, "\\") !== false)
        $class = str_replace('\\', '/', $class);

    if (strpos($class, ".") !== false)
        $ext = '';


    $class =  BASEPATH . $aux_path . $class . $ext;

    if( ! file_exists( $class )):
        exit(utf8_decode("O arquivo {$class} não foi encontrado"));
    else:
        include_once $class;
    endif;

}



spl_autoload_register('respect_loader');

