<?php
/*
| ------------------------------------------------------------
|
| Defina ações de requisições ajax nes documento
|
| ------------------------------------------------------------
*/

if(isset($_POST['ajax_request']) && $_POST['ajax_request'] == 'hello')
	hello_ajax();


/*
	Só um hello
 */

function hello_ajax(){
	echo 'Hello';
}


?>