<?php
	if(get_request('mode') == 'login'):
		include_file('includes/theme/login/content.php');
	else:
		include_file('includes/theme/dashboard/content.php');
	endif;
?>