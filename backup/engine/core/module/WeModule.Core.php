<?php

/*
* ------------------------------------------------------------------
* Este arquivo não pode ser acessado diretamente
* ------------------------------------------------------------------
*/
if (!defined('ENG_BASEPATH')) exit(utf8_decode('Você não pode acessar este arquivo diretamente diretamente.'));


/*
* --------------------------------------------------------------------------------
* Funcionalidade: Classe responsável por gerenciar módulos do Framework
* --------------------------------------------------------------------------------
 */

class WeModule {


	public function init_ger_module(){
		$index_app = THEME_PATH;
		/*
			Valida se o arquivo index.php existe dentro do tema
		 */
		if(is_file(THEME_PATH.'index.php')):

		else:
			exit(utf8_decode('O Tema <b>'.THEME.'</b> não foi encontrado'));
		endif;

	}


}