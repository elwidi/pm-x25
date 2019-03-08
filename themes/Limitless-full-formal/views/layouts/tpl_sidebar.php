<!-- Main navigation -->
<div class="sidebar-category sidebar-category-visible">
    <div class="sidebar-user-material">
        <div class="category-content">
            <div class="sidebar-user-material-content">
                <a href="#"><img src="<?php echo $obj_photo;?>" class="img-circle img-responsive" alt=""></a>
                <h6><?php echo $obj_fullname;?></h6>
                <span class="text-size-small"><?php echo $obj_position_title;?></span>
            </div>

            <div class="sidebar-user-material-menu">
                <a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
            </div>
        </div>

        <div class="navigation-wrapper collapse" id="user-nav">
            <ul class="navigation">
                <li><a href="#"><i class="icon-user-plus"></i> <span>My profile</span></a></li>
                <li><a href="#"><i class="icon-coins"></i> <span>My balance</span></a></li>
                <li><a href="#"><i class="icon-comment-discussion"></i> <span><span class="badge bg-teal-400 pull-right">58</span> Messages</span></a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="icon-cog5"></i> <span>Account settings</span></a></li>
                <li><a href="javascript:clickLogout();"><i class="icon-switch2"></i> <span>Logout</span></a></li>
            </ul>
        </div>
    </div>

    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">

            <!-- Employee self service -->
            <li class="navigation-header"><span>Employee Self Service</span> <i class="icon-menu" title="Main pages"></i></li>
            <li><a href="<?php echo base_url();?>ess/dashboard"><i class="icon-display"></i> <span>Dashboard</span></a></li>
            <li><a href="<?php echo base_url();?>ess/myPersonalInformation"><i class="icon-user-check"></i> <span>My personal information</span></a></li>
            <li><a href="<?php echo base_url();?>ess/myWorkingInformation"><i class="icon-stack2"></i> <span>My working information</span></a></li>
            <li><a href="<?php echo base_url();?>ess/myLeaveInformation"><i class="icon-airplane3"></i> <span>My leave information</span></a></li>
            <li>
                <a href="#"><i class="icon-clipboard2"></i> <span>My training information</span></a>
                <ul>
                    <li><a href="<?php echo base_url();?>ess/individualTrainingReport">Individual training report </a></li>
                    <li><a href="<?php echo base_url();?>ess/feedbackForm">Feedback form</a></li>
                    <li><a href="<?php echo base_url();?>ess/assessmentForm">Assessment form</a></li>
                </ul>
            </li>
            <li class="navigation-header"><span>E-Learning</span> <i class="icon-menu" title="Main pages"></i></li>
            <li><a href="<?php echo base_url();?>eLearning"><i class="icon-graduation"></i> <span>E-learning</span></a></li>
            <!-- /ess -->

            <!-- Manager self service -->
            <!--
            <li class="navigation-header"><span>Manager Self Service</span> <i class="icon-menu" title="Forms"></i></li>
            <li><a href="#"><i class="icon-width"></i> <span>My personnel action to approve </span></a></li>
            <li>
                <a href="#"><i class="icon-pencil3"></i> <span>My employee loan to approve</span></a>
                <ul>
                    <li><a href="form_inputs_basic.html">Basic inputs</a></li>
                    <li><a href="form_checkboxes_radios.html">Checkboxes &amp; radios</a></li>
                </ul>
            </li>
            -->
            <!-- /mss -->

        </ul>
    </div>
</div>
<!-- /main navigation -->

<script>
    function clickLogout()
    {
        var opt = confirm("Are you sure to Sign out from this application ?");
        if(opt==true)
        {
            window.location.href="http://application.moratelindo.co.id/index.php/logout/clear/<?php echo $_COOKIE['SSOID'];?>";
        }
    }

</script>