<ul class="nav navbar-nav no-border visible-xs-block">
    <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
</ul>

<div class="navbar-collapse collapse" id="navbar-second-toggle">
    <ul class="nav navbar-nav">

        <li class="<?php if($this->uri->segment(1)=='home'){ echo 'active'; } ?>"><a href="<?php echo base_url();?>index.php/home"><i class="icon-home4 position-left"></i> Home</a></li>

        <li class="dropdown <?php if($this->uri->segment(1)=='planning'){ echo 'active'; } ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-design position-left"></i> Planning <span class="caret"></span>
            </a>
            <ul class="dropdown-menu width-200">
                <li class="dropdown-header">Planning</li>
                <li>
                    <a href="<?php echo base_url();?>index.php/planning/allProject">Project List</a>
                </li>
                <li class="dropdown-header">Customer</li>
                <li><a href="<?php echo base_url();?>index.php/planning/customer">Customer List</a></li>
                <li class="dropdown-header">Vendor</li>
                <li><a href="<?php echo base_url();?>index.php/planning/vendors">Vendor List</a></li>
            </ul>
        </li>

        <!--
        <li class="<?php if($this->uri->segment(1)=='survey'){ echo 'active'; } ?>"><a href="<?php echo base_url();?>index.php/survey"><i class="icon-clipboard2 position-left"></i> Survey</a></li>
        -->

        <li class="dropdown <?php if($this->uri->segment(1)=='implementation'){ echo 'active'; } ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-graph position-left"></i> Implementation <span class="caret"></span>
            </a>
            <ul class="dropdown-menu width-200">
                <li class="dropdown-header">Implementation</li>
                <li><a href="<?php echo base_url();?>index.php/implementation/progressTracking">Progress Tracking</a></li>
                <li><a href="<?php echo base_url();?>index.php/implementation/dailyProgress">Input Daily Progress Report</a></li>
                <li><a href="<?php echo base_url();?>index.php/timesheet/dailyWeeklyPlan2">Input Weekly Plan</a></li>
                <li><a href="<?php echo base_url();?>index.php/implementation/progressTask">Progress Task</a></li>
                <!--
                <li><a href="<?php echo base_url();?>index.php/implementation/">Submarine</a></li>
                <li><a href="<?php echo base_url();?>index.php/implementation/">Inland / OSP</a></li>
                <li><a href="<?php echo base_url();?>index.php/implementation/">FTTH</a></li>
                <li><a href="<?php echo base_url();?>index.php/implementation/">FTTB</a></li>
                <li><a href="<?php echo base_url();?>index.php/implementation/">Fiberization</a></li>
                <li><a href="<?php echo base_url();?>index.php/implementation/">MCP</a></li>
                <li><a href="<?php echo base_url();?>index.php/implementation/">Backbone</a></li>
                <li><a href="<?php echo base_url();?>index.php/implementation/">ISP/IP</a></li>
                <li><a href="<?php echo base_url();?>index.php/implementation/">Site structure</a></li>
                -->
                <li class="dropdown-header">Configuration</li>
                <li><a href="<?php echo base_url();?>index.php/implementation/daily_activity_rules">Daily Activity Rules and Scoring</a></li>
                <li><a href="<?php echo base_url();?>index.php/toolManagement/dailyProgressParameter">Daily Progress Parameter</a></li>
            </ul>
        </li>

        <li class="dropdown <?php if($this->uri->segment(1)=='acceptance'){ echo 'active'; } ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-share4 position-left"></i> Acceptance <span class="caret"></span>
            </a>

            <ul class="dropdown-menu width-200">
                <li class="dropdown-header">Document Center</li>
                <li><a href="<?php echo base_url();?>index.php/acceptance">Document Center</a></li>
            </ul>
        </li>


        <li class="dropdown <?php if($this->uri->segment(1)=='report'){ echo 'active'; } ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-file-presentation position-left"></i> Report <span class="caret"></span>
            </a>

            <ul class="dropdown-menu width-200">
                <li class="dropdown-header">Daily Progress Report</li>
                <li><a href="<?php echo base_url();?>index.php/dailyProgressReport/summaryProgressReport">Summary Progress Report</a></li>
                <li><a href="<?php echo base_url();?>index.php/dailyProgressReport/progressPerProject">Progress per Project</a></li>
                <li><a href="<?php echo base_url();?>index.php/dailyProgressReport/progressNational">Progress National</a></li>
                <li><a href="<?php echo base_url();?>index.php/timesheet/weeklyActivity2">Daily Report Plan</a></li>
                <li><a href="#">Summary Weekly Plan</a></li>
                <li><a href="#">Vendor Analysis Report</a></li>

          <li class="dropdown-header">Timesheet</li>
                <li class="dropdown-submenu dropdown-submenu-hover">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Weekly Work Plan</a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url();?>index.php/timesheet/formWeeklyPlan">Input Weekly Plan</a></li>
                        <li><a href="<?php echo base_url();?>index.php/timesheet/weeklyActivity">Daily Activity Report</a></li>
                        <!--
                        <li class="dropdown-submenu dropdown-submenu-hover">
                            <a href="#">Three columns</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header highlight">Sidebar position</li>
                                <li><a href="../seed/3_col_dual.html">Dual sidebars</a></li>
                                <li><a href="../seed/3_col_double.html">Double sidebars</a></li>
                            </ul>
                        </li>
                        <li><a href="../seed/4_col.html">Four columns</a></li>
                        -->
                    </ul>
                </li>
            </ul>

        </li>

        <li class="<?php if($this->uri->segment(1)=='projectCommercial'){ echo 'active'; } ?>"><a href="<?php echo base_url();?>index.php/projectCommercial"><i class="icon-calculator4 position-left"></i> Project Commercial</a></li>

        <li class="dropdown <?php if($this->uri->segment(1)=='administration'){ echo 'active'; } ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-history position-left"></i> Issue & Risk <span class="caret"></span>
            </a>

            <ul class="dropdown-menu width-200">
                <li class="dropdown-header">Issue & Risk</li>
                <li><a href="<?php echo base_url();?>index.php/issueRisk">Issue & Risk Register</a></li>
                <li class="dropdown-header">Setting</li>
                <li><a href="<?php echo base_url();?>index.php/issueRisk/projectScope">Project Scope</a></li>
                <li><a href="<?php echo base_url();?>index.php/issueRisk/issueCategories">Issue Categories</a></li>
            </ul>
        </li>

        <li class="<?php if($this->uri->segment(1)=='documentation'){ echo 'active'; } ?>"><a href="<?php echo base_url();?>index.php/documentation"><i class="icon-certificate position-left"></i> Documentation</a></li>

        <li class="dropdown <?php if($this->uri->segment(1)=='resource'){ echo 'active'; } ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-people position-left"></i> Resource <span class="caret"></span>
            </a>

            <ul class="dropdown-menu width-200">
                <li class="dropdown-header">Resource Allocation</li>
                <li><a href="<?php echo base_url();?>index.php/resource">Resources List</a></li>
                <li><a href="<?php echo base_url();?>index.php/resource/availability">Resources Avaibility</a></li>
            </ul>
        </li>

        <li class="<?php if($this->uri->segment(1)=='toolManagement'){ echo 'active'; } ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-wrench3 position-left"></i> Tool Management <span class="caret"></span>
            </a>

            <ul class="dropdown-menu width-200">
                <li class="dropdown-header">Tools Inventory</li>
                <li><a href="<?php echo base_url();?>index.php/toolManagement">Tools Inventory</a></li>
                <li><a href="<?php echo base_url();?>index.php/toolManagement/transmittalDaily">Tool Transmittal Daily</a></li>
                <li class="dropdown-header">Administration</li>
                <li class="dropdown-submenu dropdown-submenu-hover">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">User Management</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header highlight">User</li>
                        <li><a href="<?php echo base_url();?>index.php/administration">User List</a></li>
                        <li><a href="<?php echo base_url();?>index.php/administration/roles">User Role</a></li>
                        <!--
                        <li class="dropdown-submenu dropdown-submenu-hover">
                            <a href="#">Three columns</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header highlight">Sidebar position</li>
                                <li><a href="../seed/3_col_dual.html">Dual sidebars</a></li>
                                <li><a href="../seed/3_col_double.html">Double sidebars</a></li>
                            </ul>
                        </li>
                        <li><a href="../seed/4_col.html">Four columns</a></li>
                        -->
                    </ul>
                </li>
            </ul>
        </li>

    </ul>

    <ul class="nav navbar-nav navbar-right">
        <!--
        <li>
            <a href="#">
                <i class="icon-history position-left"></i>
                Changelog
                <span class="label label-inline position-right bg-success-400">1.6</span>
            </a>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="icon-cog3"></i>
                <span class="visible-xs-inline-block position-right">Share</span>
                <span class="caret"></span>
            </a>

            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
            </ul>
        </li>
        -->
    </ul>
</div>
