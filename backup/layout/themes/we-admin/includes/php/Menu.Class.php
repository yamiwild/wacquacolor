<?php

class Menu extends WeFramework{

	public function __construct(){
		parent::_weframework_instance();
	}

	public function mount_menu(){

		$modules = $this->get_modules();
		$count = 0;
		$class = '';

		foreach ($modules as $m) {
			$section = $this->get_modules_section($m->MOD_COD);
			$mod_url = ($section)?'javascript:;':base_url().$m->MOD_URL;
			$class = $this->get_selected($m->MOD_NAME_URL);

			if($class != '')
				$class = 'class="'.$class;
			if($count == 0)
				$class .= ' start';

			$class .= '"';


			echo '<li '.$class.'>';
			echo '<a href="'.$mod_url.'">';
			echo '<i class="'.$m->MOD_ICON.'"></i>';
			echo '<span class="title">'.$m->MOD_NAME.'</span>';


			if($section):
				echo '<span class="arrow "></span>';
				echo '</a>';
				echo '<ul class="sub-menu">';
				foreach ($section as $s) {
					echo '<li>';
					echo '<a href="'.base_url().$s->MOS_URL.'">';
					echo '<i class="'.$s->MOS_ICON.'"></i> ';
					echo $s->MOS_NAME;
					echo '</a>';
					echo '</li>';
				}
				echo '</ul>';
				echo '</li>';
			else:
				echo '</a>';
				echo '</li>';
			endif;

		}

	}


	private function get_modules(){

		$sql = 'SELECT
					F_MOD.MOD_COD,
					F_MOD.MOD_NAME,
					F_MOD.MOD_ICON,
					F_MOD.MOD_URL,
					F_MOD.MOD_NAME_URL
				FROM fw_user AS F_USER
				INNER JOIN fw_rel_profile_module_privilege AS FR_PRO
				ON FR_PRO.PRO_COD = F_USER.PRO_COD
				INNER JOIN fw_module_privilege AS F_MODP
				ON F_MODP.PRI_COD = FR_PRO.PRI_COD
				INNER JOIN fw_module AS F_MOD
				ON F_MOD.MOD_COD = F_MODP.MOD_COD
				WHERE F_USER.USE_COD = :USE_COD
				AND F_MOD.MOD_VISIBLE = 1
				GROUP BY F_MOD.MOD_COD';

		$stmt = $this->db->prepare($sql);
		$query = $stmt->execute(array(':USE_COD' => $_SESSION['USER_COD']));

		if($query):
			$data = $stmt->fetchAll(PDO::FETCH_OBJ);
			return $data;
		else:
			echo 'Error';
			return false;
		endif;
	}

	private function get_modules_section($mod_cod){

		$sql =
			 'SELECT	MS.*
					FROM fw_user AS US
		INNER JOIN fw_profile AS PR ON PR.PRO_COD = US.USE_COD
		INNER JOIN fw_rel_profile_module_privilege AS PI ON PI.PRO_COD = PR.PRO_COD
		INNER JOIN fw_module_privilege AS MP ON MP.PRI_COD = PI.PRI_COD
		INNER JOIN fw_module_section AS MS ON MS.MOS_COD = MP.MOS_COD
				 WHERE MP.MOS_COD IS NOT NULL
		    	 AND US.USE_COD = :USE_COD
			     AND MS.MOS_VISIBLE = 1
			     AND MP.MOD_COD = :MOD_COD
			     GROUP BY MS.MOS_COD';

		$stmt = $this->db->prepare($sql);
		$query = $stmt->execute(array(':USE_COD' => $_SESSION['USER_COD'], ':MOD_COD' => $mod_cod));
		$rows = $stmt->rowCount();

		if($query):
			if($rows > 0):
				$data = $stmt->fetchAll(PDO::FETCH_OBJ);
				return $data;
			else:
				return false;
			endif;
		else:
			echo 'Error';
			return false;
		endif;
	}


	//Verificar módulo/página atual em que o usuário se encontra
	public function get_selected($mod_name_url = ''){
		if(!empty($mod_name_url)):
			if(isset_request('mode')):

				$page = get_request('mode');
				$class = '';

				if($mod_name_url == $page)
					$class = 'active open';

				return $class;
			endif;
		endif;
	}


}


?>