<?php
	if(get_request('mode') == 'login'):
		include_file('includes/theme/login/css/login-core.php');
	else:
		include_file('includes/theme/dashboard/css/dashboard-core.php');
	endif;
?>

