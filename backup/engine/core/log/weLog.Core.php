<?php
/*
* ------------------------------------------------------------------
* Este arquivo não pode ser acessado diretamente
* ------------------------------------------------------------------
*/
if (!defined('ENG_BASEPATH')) exit(utf8_decode('Você não pode acessar este arquivo diretamente diretamente.'));

/*
* --------------------------------------------------------------------------
* Esta classe é responsável pela geração de logs de error
* --------------------------------------------------------------------------
 */

Class WeLog{

  private $LOG_PATH;
  private $DB_LOG_PATH;
  private $GENERAL_LOG_PATH;
  private $PATH;

  public function __construct(){
    /*
      Se as constantes LOG_PATH, DB_LOG_PATH, GENERAL_LOG_PATH, criaremos
      pastas padrões de logs
     */
    if(!defined('LOG_PATH')):
      $this->LOG_PATH = ENG_BASEPATH.'log/';
    else:
      $this->LOG_PATH = LOG_PATH;
    endif;

    if(!defined('DB_LOG_PATH')):
       $this->DB_LOG_PATH = $this->LOG_PATH.'db/';
    else:
      $this->DB_LOG_PATH = DB_LOG_PATH;
    endif;

    if(!defined('GENERAL_LOG_PATH')):
        $this->GENERAL_LOG_PATH = $this->LOG_PATH.'general/';
    else:
      $this->GENERAL_LOG_PATH = GENERAL_LOG_PATH;
    endif;

    /*
      Criação de diretórios de erros
    */

    if(!is_dir($this->LOG_PATH)):
      if(!mkdir($this->LOG_PATH)):
          exit(utf8_decode('Não é possível criar diretórios ou arquivos em: '.$this->LOG_PATH.' verifique se o seu usuário tem permissões para executar esta operação.'));
      else:
        if(!is_dir($this->DB_LOG_PATH))
          if(!mkdir($this->DB_LOG_PATH))
            $thsi->DB_LOG_PATH = $this->LOG_PATH;

        if(!is_dir($this->GENERAL_LOG_PATH))
          if(!mkdir($this->GENERAL_LOG_PATH))
            $thsi->GENERAL_LOG_PATH = $this->LOG_PATH;
      endif;

    else:
        if(!is_dir($this->DB_LOG_PATH))
          if(!mkdir($this->DB_LOG_PATH))
            $thsi->DB_LOG_PATH = $this->LOG_PATH;

        if(!is_dir($this->GENERAL_LOG_PATH))
          if(!mkdir($this->GENERAL_LOG_PATH))
            $thsi->GENERAL_LOG_PATH = $this->LOG_PATH;
    endif;


  }

  /*
   Erros de Banco de dados
  */
    public function log_db($msg, $path = ''){
      //Verifica se o caminho do log foi especificado pelo usuário
      if(!isset($path) || $path != '' || !empty($path))
        $this->PATH = $path;
      else
        $this->PATH = $this->DB_LOG_PATH;

      $date = date('Y-m-d H:i:s');
      $log = "| ".$date." -------------------------------------------------------------\r\n";
      $log .= "|\r\n";
      $log .= "| Error: ".$msg."\r\n";
      $log .= "|\r\n";
      $log .= "| ---------------------------------------------------------------------------------\r\n\r\n";

      error_log($log, 3, $this->PATH.'error_log.log');

    }

  /*
    Erros em geral
  */
    public function log_general($msg, $path = ''){
      //Verifica se o caminho do log foi especificado pelo usuário
      if(!isset($path) || $path != '' || !empty($path))
        $this->PATH = $path;
      else
        $this->PATH = $this->GENERAL_LOG_PATH;

      $date = date('Y-m-d H:i:s');
      $log = "| ".$date." -------------------------------------------------------------\r\n";
      $log .= "|\r\n";
      $log .= "| Error: ".$msg."\r\n";
      $log .= "|\r\n";
      $log .= "| ---------------------------------------------------------------------------------\r\n\r\n";

      error_log($log, 3, $this->PATH.'error_log.log');
    }

    public function set_log($msg, $path = ''){
       //Verifica se o caminho do log foi especificado pelo usuário
      if(!isset($path) || $path != '' || !empty($path))
        $this->PATH = $path;
      else
        $this->PATH = $this->LOG_PATH;

      $date = date('Y-m-d H:i:s');
      $log = "| ".$date." -------------------------------------------------------------\r\n";
      $log .= "|\r\n";
      $log .= "| Error: ".$msg."\r\n";
      $log .= "|\r\n";
      $log .= "| ---------------------------------------------------------------------------------\r\n\r\n";

      error_log($log, 3, $this->PATH.'error_log.log');
    }

}

?>