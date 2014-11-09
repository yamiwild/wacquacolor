<?php

/*
* ------------------------------------------------------------------
* Este arquivo não pode ser acessado diretamente
* ------------------------------------------------------------------
*/
if (!defined('ENG_BASEPATH')) exit(utf8_decode('Você não pode acessar este arquivo diretamente diretamente.'));

Class WeHelpers {


	/*
		Método para carregar um helper
	 */
	public function get_helper($path){
		$path = ENG_BASEPATH.'helpers/'.$path;
		if(is_file($path)):
			include_once $path;
		else:
			exit(utf8_decode('Falha ao inlcuir arquivo <b>'.pathinfo($path, PATHINFO_BASENAME).'</b>'));
		endif;
	}


    /*
        Carrega o projeto Respect
     */
    public function load_respect( $class ){
        $ext = '.php';
        $aux_path = 'engine/helpers/respect/';


        if (strpos($class, "\\") !== false)
            $class = str_replace('\\', '/', $class);

        if (strpos($class, ".") !== false)
            $ext = '';


        $class =  BASEPATH . $aux_path . $class . $ext;

        if( ! file_exists( $class )):
            exit(utf8_decode("A arquivo {$class} não foi encontrado"));
        else:
            include_once $class;
        endif;

    }
}