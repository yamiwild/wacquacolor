<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo theme_base_url() ?>assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/scripts/weframework.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/admin/layout/scripts/search-menu.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->


<script src="<?php echo theme_base_url() ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo theme_base_url() ?>assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script>
jQuery(document).ready(function() {
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init() // init quick sidebar
});
</script>

<!-- SCRIPTS PAGE -->
<?php if(require_page('products')): ?>
<!-- Data Tables -->
<script type="text/javascript" src="<?php echo theme_base_url() ?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo theme_base_url() ?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo theme_base_url() ?>assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo theme_base_url() ?>assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="<?php echo theme_base_url() ?>assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="<?php echo theme_base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script>
    $(document).ready(function(){
        $('#datatable').DataTable();
    });
</script>
<?php endif; ?>

<?php if(require_page('products/register')): ?>
<script type="text/javascript" src="<?php echo theme_base_url() ?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo theme_base_url() ?>assets/global/plugins/ckeditor/ckeditor.js"></script>
<?php endif; ?>

<?php if(require_page('products/edit/*')): ?>
<script type="text/javascript" src="<?php echo theme_base_url() ?>assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo theme_base_url() ?>assets/global/plugins/ckeditor/ckeditor.js"></script>
<?php endif; ?>

<!--  END SCRIPTS PAGE -->

<!-- END JAVASCRIPTS -->

