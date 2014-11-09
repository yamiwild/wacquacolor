<?php
/*
* ------------------------------------------------------------------
* Este arquivo não pode ser acessado diretamente
* ------------------------------------------------------------------
*/
if (!defined('ENG_BASEPATH')) exit(utf8_decode('Você não pode acessar este arquivo diretamente diretamente.'));

class WeDatabase extends WeAutoload{

	public $hostname;
	public $username;
	public $password;
	public $database;
	public $driver	= 'mysql';
	public $charset = 'utf8';
	public $db;

	public function __construct(){
		//Iremos adicionar alguns componentes para esta classe
		$this->addExt(new WeLog);
		$this->addExt(new WeLayout);
	}

	public function init_db_connection($options){
		extract($options);
		//Verifica se o framework pode se conectar ao banco de dados
		if($connection && DEFINITION != 'html'):
			if(empty($hostname) || $hostname == ''):
				exit(utf8_decode('Falha ao conectar a base de dados: Hostaname desconhecido.'));
			else:
				if(empty($database) || $database == ''):
					exit(utf8_decode('Falha ao conectar a base de dados: Nome da base de dados não definido.'));
				else:


					$this->hostname = $hostname;
					$this->database = $database;
					$this->username = $username;
					$this->password = $password;
					$this->driver	= $driver;
					$this->charset	= $charset;

					/*
					* Inica instancia do PDO
					*/

					if(!count($pdo_options) > 0 || !isset($pdo_options)):
						$pdo_options = array(
							PDO::ATTR_PERSISTENT => true,
							PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT
						);
					endif;


					try {
						$this->db = new PDO($this->driver.':host='.$this->hostname.';dbname='.$this->database, $this->username, $this->password, $pdo_options);
						$this->db->exec("SET NAMES ".$this->charset);
					}catch (PDOException $e){
						$this->log_db($e->getMessage());
						die('Erro ao estabelecar conex�o com a base de dados');
					}

					return $this->db;
				endif;
			endif;
		endif;

	}

}


