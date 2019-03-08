<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Project Management</title>

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
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/pickers/daterangepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/forms/validation/validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/notifications/pnotify.min.js"></script>


    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/core/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/ione/datatables_apps.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/ione/form_layouts_apps.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/ui/ripple.min.js"></script>
    <!-- /theme JS files -->

    <script type="text/javascript">
        var JS_BASE_URL = '<?php echo site_url(); ?>';
    </script>

</head>

<body class="layout-boxed navbar-bottom navbar-top">

    <!-- Main navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <?php include 'tpl_main_header.php';?>
    </div>
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
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