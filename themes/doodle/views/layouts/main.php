<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Doodle I Fast build Admin dashboard for any platform</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content=""/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url();?>themes/doodle/favicon.ico">
    <link rel="icon" href="<?php echo base_url();?>themes/doodle/favicon.ico" type="image/x-icon">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url();?>themes/doodle/vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>

    <!-- Data table CSS -->
    <link href="<?php echo base_url();?>themes/doodle/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo base_url();?>themes/doodle/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>themes/doodle/dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<!-- Preloader -->
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<!-- /Preloader -->
<div class="wrapper theme-5-active pimary-color-red">
    <!-- Top Menu Items -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <?php include 'tpl_main_header.php';?>
    </nav>
    <!-- /Top Menu Items -->

    <!-- Left Sidebar Menu -->
    <div class="fixed-sidebar-left">
        <?php include 'tpl_sidebar_left.php';?>
    </div>
    <!-- /Left Sidebar Menu -->

    <!-- Right Sidebar Menu -->
    <div class="fixed-sidebar-right">
        <?php include 'tpl_sidebar_left.php';?>
    </div>
    <!-- /Right Sidebar Menu -->

    <!-- Right Setting Menu -->
    <div class="setting-panel">
        <ul class="right-sidebar nicescroll-bar pa-0">
            <li class="layout-switcher-wrap">
                <ul>
                    <li>
                        <span class="layout-title">Scrollable sidebar</span>
							<span class="layout-switcher">
								<input type="checkbox" id="switch_3" class="js-switch"  data-color="#ea6c41" data-secondary-color="#878787" data-size="small"/>
							</span>
                        <h6 class="mt-30 mb-15">Theme colors</h6>
                        <ul class="theme-option-wrap">
                            <li id="theme-1" class="active-theme"><i class="zmdi zmdi-check"></i></li>
                            <li id="theme-2"><i class="zmdi zmdi-check"></i></li>
                            <li id="theme-3"><i class="zmdi zmdi-check"></i></li>
                            <li id="theme-4"><i class="zmdi zmdi-check"></i></li>
                            <li id="theme-5"><i class="zmdi zmdi-check"></i></li>
                            <li id="theme-6"><i class="zmdi zmdi-check"></i></li>
                        </ul>
                        <h6 class="mt-30 mb-15">Primary colors</h6>
                        <div class="radio mb-5">
                            <input type="radio" name="radio-primary-color" id="pimary-color-red" checked value="pimary-color-red">
                            <label for="pimary-color-red"> Red </label>
                        </div>
                        <div class="radio mb-5">
                            <input type="radio" name="radio-primary-color" id="pimary-color-blue" value="pimary-color-blue">
                            <label for="pimary-color-blue"> Blue </label>
                        </div>
                        <div class="radio mb-5">
                            <input type="radio" name="radio-primary-color" id="pimary-color-green" value="pimary-color-green">
                            <label for="pimary-color-green"> Green </label>
                        </div>
                        <div class="radio mb-5">
                            <input type="radio" name="radio-primary-color" id="pimary-color-yellow" value="pimary-color-yellow">
                            <label for="pimary-color-yellow"> Yellow </label>
                        </div>
                        <div class="radio mb-5">
                            <input type="radio" name="radio-primary-color" id="pimary-color-pink" value="pimary-color-pink">
                            <label for="pimary-color-pink"> Pink </label>
                        </div>
                        <div class="radio mb-5">
                            <input type="radio" name="radio-primary-color" id="pimary-color-orange" value="pimary-color-orange">
                            <label for="pimary-color-orange"> Orange </label>
                        </div>
                        <div class="radio mb-5">
                            <input type="radio" name="radio-primary-color" id="pimary-color-gold" value="pimary-color-gold">
                            <label for="pimary-color-gold"> Gold </label>
                        </div>
                        <div class="radio mb-35">
                            <input type="radio" name="radio-primary-color" id="pimary-color-silver" value="pimary-color-silver">
                            <label for="pimary-color-silver"> Silver </label>
                        </div>
                        <button id="reset_setting" class="btn  btn-info btn-xs btn-outline btn-rounded mb-10">reset</button>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <button id="setting_panel_btn" class="btn btn-success btn-circle setting-panel-btn shadow-2dp"><i class="zmdi zmdi-settings"></i></button>
    <!-- /Right Setting Menu -->

    <!-- Right Sidebar Backdrop -->
    <div class="right-sidebar-backdrop"></div>
    <!-- /Right Sidebar Backdrop -->

    <!-- Main Content -->
    <div class="page-wrapper">

        <?php echo $content; ?>

        <!-- Footer -->
        <footer class="footer container-fluid pl-30 pr-30">
            <?php include 'tpl_footer.php';?>
        </footer>
        <!-- /Footer -->

    </div>
    <!-- /Main Content -->

</div>
<!-- /#wrapper -->

<!-- JavaScript -->

<!-- jQuery -->
<script src="<?php echo base_url();?>themes/doodle/vendors/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url();?>themes/doodle/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Data table JavaScript -->
<script src="<?php echo base_url();?>themes/doodle/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>

<!-- Slimscroll JavaScript -->
<script src="<?php echo base_url();?>themes/doodle/dist/js/jquery.slimscroll.js"></script>

<!-- simpleWeather JavaScript -->
<script src="<?php echo base_url();?>themes/doodle/vendors/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url();?>themes/doodle/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
<script src="<?php echo base_url();?>themes/doodle/dist/js/simpleweather-data.js"></script>

<!-- Progressbar Animation JavaScript -->
<script src="<?php echo base_url();?>themes/doodle/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="<?php echo base_url();?>themes/doodle/vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>

<!-- Fancy Dropdown JS -->
<script src="<?php echo base_url();?>themes/doodle/dist/js/dropdown-bootstrap-extended.js"></script>

<!-- Sparkline JavaScript -->
<script src="<?php echo base_url();?>themes/doodle/vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>

<!-- Owl JavaScript -->
<script src="<?php echo base_url();?>themes/doodle/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

<!-- ChartJS JavaScript -->
<script src="<?php echo base_url();?>themes/doodle/vendors/chart.js/Chart.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="<?php echo base_url();?>themes/doodle/vendors/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>themes/doodle/vendors/bower_components/morris.js/morris.min.js"></script>
<script src="<?php echo base_url();?>themes/doodle/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

<!-- Switchery JavaScript -->
<script src="<?php echo base_url();?>themes/doodle/vendors/bower_components/switchery/dist/switchery.min.js"></script>

<!-- Init JavaScript -->
<script src="<?php echo base_url();?>themes/doodle/dist/js/init.js"></script>
<script src="<?php echo base_url();?>themes/doodle/dist/js/dashboard-data.js"></script>
</body>


</html>


