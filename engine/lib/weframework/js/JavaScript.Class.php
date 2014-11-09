<?php

class JavaScript {

	public function generate_base_url(){
		$content = 'function base_url()
					{
						return "'.base_url().'"
					}';
		return $content;

	}

	public function generate_base_url_project(){
		$content = 'function base_url_project()
					{
						return "'.base_url_project().'"
					}';
		return $content;

	}


	public function theme_base_url(){
		$content = 'function theme_base_url()
					{
						return "'.theme_base_url().'"
					}';
		return $content;

	}
}

?>