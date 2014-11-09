<?php
	if(get_request('mode') == 'login'):
		include_file('includes/theme/login/footer.php');
	else:
		include_file('includes/theme/dashboard/footer.php');
	endif;

	include_file('includes/theme/scripts-js.php');
?>

</body>
</html>