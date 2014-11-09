<?php
class Logout_Controller extends WeController{

	public function __construct(){
		$this->load()->model('logout');
		$this->logout();
	}



}

?>