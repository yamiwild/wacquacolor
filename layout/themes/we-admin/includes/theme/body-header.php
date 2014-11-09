<?php
if(get_request('mode') == 'login'):
	include_file('includes/theme/login/header.php');
else:
	include_file('includes/theme/dashboard/header.php');
endif;
?>