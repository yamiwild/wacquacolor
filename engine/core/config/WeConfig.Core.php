<?php
/*
* ------------------------------------------------------------------
* Este arquivo não pode ser acessado diretamente
* ------------------------------------------------------------------
*/
if (!defined('ENG_BASEPATH')) exit(utf8_decode('Você não pode acessar este arquivo diretamente.'));

/*
*--------------------------------------------------------------------
*
* Arquivo de configuração do WE-Framework
*
* -------------------------------------------------------------------
*/

/*
| -------------------------------------------------------------------
| Configurações Globais - Dicionário
| -------------------------------------------------------------------
|	[definition] O WE-Framework pode se adptar a 2 níveis de desenvolvimento.
|					- application
|						Utiliza recursos MVC e conexão com uma base de dados
|					- html
|						Não utiliza MVC e não faz conexão com uma base de dados
|
|
| -------------------------------------------------------------------
*/

$config['definition'] = 'application';

/*
| -------------------------------------------------------------------
| APLICAÇÃO - Dicionário
| -------------------------------------------------------------------
|	['base_url'] URL base da aplicação * não precisa colocar http://, por padrão o WE-Framework
|				 irá adicionar o host. Ex: http://hostname.com.br/valor_base_url
|	['index_module'] Página/Módulo que será carregado assim que o usuário acessar a aplicação.
|	['charset'] Charset da aplicação
|	[themes] Defina os temas que estão dentro da pasta layout/themes/
|	[main_theme] Informe aqui o tema principal que será carregado inicialmente
|	[theme_index] Nesta sessção você deve definir uma página inicial para cada tema definido em [themes]
|   [theme_alias] O tema pode ser carregado via url dominio/nome_do_tema, neste idetem você pode definir um
|				 nome adicional para carregar o tema.
|   ['app_themes] Idica qual será o tema a ser usado para a aplicação
|				  NOTA: Altere as configurações abaixo quando ['definition'] for igual á 'application'
| -------------------------------------------------------------------
*/


$config['base_url'] 	= 'clientes/acquacolor';

$config['charset'] 		= 'utf-8';



/*
   Altere as configurações abaixo quando ['definition'] for igual á 'application'
 */

$config['app_themes'] = array('we-admin' => 'we-admin', 'site' => 'site');



/*
	Definição de temas
 */
$config['themes'] = array('site', 'we-admin', 'we-framework');


/*
	Tema principal - o primeiro tema a ser carregado
*/
$config['main_theme'] = 'site';

/*
	Pagina inicial - Defina a página inicial para cada tema
*/

$config['theme_index'] = array('site' => 'home',
                               'we-admin' => 'login',
							   'we-framework' => 'home');


/*
	URL ALIAS - Defina um nome para o tema ser carregado pela URL
*/

$config['theme_alias'] = array('we-framework' => 'we');






/*
|  BANCO DE DADOS - Dicinionário
| -------------------------------------------------------------------
|
|	['connection'] TRUE/FALSE -  Habilita / desabilita a conexão com o banco de dados.
|	['hostname'] O Hostname do servidor.
|	['username'] O nome de usuário usado para conectar ao banco de dados
|	['password'] A senha usada para conectar ao banco de dados
|	['database'] O nome do banco de dados você deseja se conectar
|	['driver'] O tipo de banco de dados. ou seja: mysql. Atualmente suportados:
|				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['charset'] O conjunto de caracteres usado na comunicação com o banco de dados
|	['pdo_options'] Neste array, você pode adicionar recursos ao PDO. Por padrão o WE Framework
|					utiliza a seguinte configuração:

|						PDO::ATTR_PERSISTENT => true
|						PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT

|                   *NOTA: Ao usar 'pdo_options', as configurações padrões serão limpas
|						   e não serão incluída nas suas configurações personalizadas.
|
*
*--------------------------------------------------------
 */

$config['db']['connection'] = true;

$config['db']['hostname'] 	= 'localhost';

$config['db']['username'] 	= 'root';

$config['db']['password'] 	= '';

$config['db']['database'] 	= 'cli_acquacolor';

$config['db']['driver'] 	= 'mysql';

$config['db']['charset'] 	= 'utf8';

$config['db']['pdo_options'] = array();




/*
|  Servidor de E-mail - Dicinionário
| -------------------------------------------------------------------
|
|	['host'] Host do servidor. Ex.: smtp.dominio.com.br
|	['username'] O nome de usuário usado para se autenciar no servidor
|	['password'] A senha usada para conectar ao servidro de e-mail
|
|
*
*--------------------------------------------------------
 */


$config['email']['host'] 		= 'smtp.grupodpg.com.br';

$config['email']['username'] 	= 'brito@grupodpg.com.br';

$config['email']['password'] 	= 'Grupodpg10!';



/*
* -------------------------------------------------------------------
|  Erros - Dicinionário
| -------------------------------------------------------------------
|
|	['environment']   	Ambiente padrão: development, testing e production. Será criado uma constante ENVIRONMENT
|					  	NOTA: Se você colocar um ambiente diferente do listado acima, altere o error_debug abaixo
|
|	['error_debug'] 	Diferentes ambientes irá requerir diferentes níveis de erros.
|						Por padrão 'development' irá mostrar todos os erros mas 'testing' e 'produção' irá ocultar.
|							-> 2 Ativa erros simples E_ERROR | E_WARNING | E_PARSE
|							-> 1 Ativa todos os errors do PHP
|							-> 0 oculta todos os erros
						* NOTA: Para criar um novo nível de dubug , acesse o arquivos engine/constants/WeConstants.Core.php
|
*
*--------------------------------------------------------
*/


$config['environment'] = 'developement';

$config['error_debug'] = array(
	                           	'developement' 	=> 1,
	                           	'testing'	  	=> 2,
	                           	'production'   	=> 0
	                           );


/*
 * ----------------------------------------------------------------------
|  ERROR LOG - Dicinionário
| -----------------------------------------------------------------------
|
|	['log_path'] Diretório aonde será criado os arquivos de logs, o diretório padrão é => engine/log.
|				 No arquivo de constantes 'engine/core/constants/WeConstants.Core.php' está definido
				 por padrão duas constantes,
|
*
*------------------------------------------------------------------------
*/

$config['log_path'] = ENG_BASEPATH.'log/';


/*
	Parâmetros URL do HTACCESS
*/

$config['htaccess_param_url'] = array('mode', 'page', 'subpage', 'content', 'action', 'naction', 'naction2');

?>

