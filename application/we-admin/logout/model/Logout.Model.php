<?php

class Logout_Model extends WeModel{

	public function logout(){
		$this->unset_session('*');
	}

}

?>