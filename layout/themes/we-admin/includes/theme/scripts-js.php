<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<?php
	if(get_request('mode') == 'login'):
		include_file('includes/theme/login/js/login-core.php');
	else:
		include_file('includes/theme/dashboard/js/dashboard-core.php');
	endif;
?>


