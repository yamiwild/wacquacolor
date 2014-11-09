<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo theme_base_url() ?>assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo theme_base_url() ?>assets/scripts/weframework.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo theme_base_url() ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo theme_base_url() ?>assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo theme_base_url() ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/admin/pages/scripts/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
	jQuery(document).ready(function() {
	 	Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		QuickSidebar.init() // init quick sidebar
	  	Login.init();
	});
</script>
<!-- END JAVASCRIPTS -->