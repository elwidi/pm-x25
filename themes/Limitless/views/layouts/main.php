<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project Management</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/favicon.png">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>themes/Limitless/default/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>themes/Limitless/default/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>themes/Limitless/default/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>themes/Limitless/default/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>themes/Limitless/default/assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/core/libraries/jquery_ui/core.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/core/libraries/jquery_ui/effects.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/extensions/cookie.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>


    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/forms/styling/uniform.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/pickers/daterangepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/notifications/bootbox.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/ui/fullcalendar/fullcalendar.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/notifications/pnotify.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/forms/validation/validate.min.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/notifications/sweet_alert.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/trees/fancytree_all.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/trees/fancytree_childcounter.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/core/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/ione/datatables_apps.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/ione/form_layouts_apps.js"></script>
    <!-- <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/pages/extra_trees.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/loaders/progressbar.min.js"></script>

    <!-- <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/pages/dashboard.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/pages/extra_fullcalendar.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/source/jsGanttImproved/jsgantt.css" />
    <script language="javascript" src="<?php echo base_url();?>assets/source/jsGanttImproved/jsgantt.js"></script>

    <!-- /theme JS files -->

    <script type="text/javascript">
        var JS_BASE_URL = '<?php echo site_url(); ?>index.php';
        var SITE_URL = '<?php echo site_url(); ?>';
    </script>
</head>

<body class="navbar-bottom navbar-top">

<!-- Main navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">

    <?php include 'tpl_main_header.php';?>

</div>
<!-- /main navbar -->

<!-- Second navbar -->
<div class="navbar navbar-default" id="navbar-second">

    <?php include 'tpl_second_header.php';?>

</div>
<!-- /second navbar -->

<!-- Page header -->
<div class="page-header">

    <?php include 'tpl_page_header.php';?>

</div>
<!-- /page header -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <?php include 'tpl_sidebar.php';?>
        <!-- /main sidebar -->

        <!-- Main content -->
        <div class="content-wrapper">

            <?php echo $content; ?>

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->


<!-- Footer -->
<div class="navbar navbar-default navbar-fixed-bottom footer">

    <?php include 'tpl_footer.php';?>

</div>
<!-- /footer -->

</body>
</html>

