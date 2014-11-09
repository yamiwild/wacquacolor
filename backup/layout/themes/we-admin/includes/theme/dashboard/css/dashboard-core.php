<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo theme_base_url() ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo theme_base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo theme_base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo theme_base_url() ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo theme_base_url() ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->
<?php if(require_page('products')): ?>
<link rel="stylesheet" type="text/css" href="<?php echo theme_base_url() ?>assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo theme_base_url() ?>assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo theme_base_url() ?>assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo theme_base_url() ?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<?php endif; ?>

<?php if(require_page('products/register')): ?>
<link rel="stylesheet" type="text/css" href="<?php echo theme_base_url() ?>assets/global/plugins/select2/select2.css"/>
<?php endif; ?>

<?php if(require_page('products/edit/*')): ?>
<link rel="stylesheet" type="text/css" href="<?php echo theme_base_url() ?>assets/global/plugins/select2/select2.css"/>
<?php endif; ?>

<?php if(require_page('budgets') || require_page('budgets/show/*')): ?>
<link href="<?php echo theme_base_url() ?>assets/admin/pages/css/invoice.css" rel="stylesheet" type="text/css"/>
<?php endif; ?>

<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME STYLES -->
<link href="<?php echo theme_base_url() ?>assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo theme_base_url() ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo theme_base_url() ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo theme_base_url() ?>assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo theme_base_url() ?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->

