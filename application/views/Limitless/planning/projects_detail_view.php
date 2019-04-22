<script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/visualization/c3/c3.min.js"></script>


<div class="panel panel-white">
    <input type="hidden" id="project_id" value="<?php echo $project_id ?>" class="form-control">
    <ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">
        <li class="<?php echo ($active_tab == '')?  "active": "" ?>"><a href="#project-overview" data-toggle="tab" aria-expanded="true"><i
                    class="icon-menu7 position-left"></i> Overview</a></li>
        <li class=""><a href="#project-tasks" data-toggle="tab" aria-expanded="false"><i
                    class="icon-stack4 position-left"></i> Tasks and Assignment</a></li>
        <li class="<?php echo ($active_tab == 'milestone')?  "active": ""?>"><a href="#project-milestones" data-toggle="tab" aria-expanded="false"><i
                    class="icon-flag8 position-left"></i> Milestones</a></li>
        <li class="<?php echo ($active_tab == "team")?  "active": ""?>"><a href="#project-people" data-toggle="tab" aria-expanded="false"><i
                    class="icon-people position-left"></i> Project Team</a></li>
        <li class="<?php echo ($active_tab == "vendor")?  "active": ""?>"><a href="#project-vendor" data-toggle="tab" aria-expanded="false"><i
                    class="icon-grid6 position-left"></i> Vendor</a></li>
        <li class="<?php echo ($active_tab == "project-charter")?  "active": ""?>"><a href="#project-charter" data-toggle="tab" aria-expanded="false"><i
                    class="icon-clipboard2 position-left"></i> Approved Project Charter</a></li>
        <li class="<?php echo ($active_tab == "pip")?  "active": ""?>"><a href="#pip" data-toggle="tab" aria-expanded="false"><i
                    class="icon-list-unordered position-left"></i> PIP</a></li>
        <li class="<?php echo ($active_tab == "kmz")?  "active": ""?>"><a href="#kmz" data-toggle="tab" aria-expanded="false"><i
                    class="icon-statistics position-left"></i> KMZ</a></li>
        <li class="<?php echo ($active_tab == "boq")?  "active": ""?>"><a href="#boq" data-toggle="tab" aria-expanded="false"><i
                    class="icon-clipboard2 position-left"></i> BOQ</a></li>
        <li class="<?php echo ($active_tab == "segment")?  "active": ""?>"><a href="#segment" data-toggle="tab" aria-expanded="false"><i
                    class="icon-git-branch position-left"></i> Detail Scope</a></li>

    </ul>

    <div class="tab-content">
        <div class="tab-pane fade <?php echo ($active_tab == '')? "active in" : ""?>" id="project-overview">
            <div class="panel-body" style="padding-top: 0">
                <h4>Overview</h4>

                <div class="heading-elements">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-labeled btn-labeled-right dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><b><i class="icon-menu7"></i></b> Action <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#" class="add_task_list"><i class="icon-folder-plus4"></i> Add Task List</a></li>
                            <li><a href="#" class="add_task"><i class="icon-file-plus"></i> Add Task</a></li>
                            <li><a href="#" class="add_milestone"><i class="icon-flag8"></i> Add Milestone</a></li>
                            <li><a href="#" class="add_user"><i class="icon-user"></i> Add Project Team</a></li>
                            <li><a href="#" class="edit_project" project_id = "<?php echo $project->id?>" source = "detail"><i class="icon-pencil"></i>Edit Project</a></li>
                        </ul>
                    </div>
                </div>


                <div class="col-md-12">
                    <form class="form-horizontal" action="#">
                        <div class="panel-body">

                            <!--
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-semibold">Project Name:</label>
                                <div class="col-lg-3">
                                    <div class="form-control-plaintext"><?php echo $project->project_name?></div>
                                </div>
                                <label class="col-lg-3 col-form-label text-semibold">Plan Start:</label>
                                <div class="col-lg-3">
                                    <div class="form-control-plaintext"><?php //echo $project->project_name?></div>
                                </div>
                                <label class="col-lg-3 col-form-label text-semibold">Vendor Information:</label>
                                <div class="col-lg-3">
                                    <div class="form-control-plaintext"><?php //echo $project->project_name?></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label text-semibold">Project Company:</label>
                                <div class="col-lg-3">
                                    <div class="form-control-plaintext"><?php echo $project->company?></div>
                                </div>
                                <label class="col-lg-3 col-form-label text-semibold">Plan Finish:</label>
                                <div class="col-lg-3">
                                    <div class="form-control-plaintext"><?php //echo $project->project_name?></div>
                                </div>
                                <label class="col-lg-3 col-form-label text-semibold">Scope of Work:</label>
                                <div class="col-lg-3">
                                    <div class="form-control-plaintext"><?php //echo $project->project_name?></div>
                                </div>
                            </div>

                            <br/>
                            <br/>
                            <br/>
                            -->

                            <div class="form-group mb-5">
                                <label class="col-lg-1 control-label text-semibold">Project Name:</label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"><?php echo $project->project_name?></div>
                                </div>
                                <label class="col-lg-1 control-label text-semibold">Plan Start:</label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"><?php echo date('d-M-Y', strtotime($project->start_date));?></div>
                                </div>
                                <label class="col-lg-2 control-label text-semibold">Vendor Information:</label>
                                <div class="col-lg-2">
                                    <div class="form-control-static">
                                        <?php foreach($vendor_info as $key => $value) {
                                            echo $value->vendor_name . '<br/> ';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-5">
                                <label class="col-lg-1 control-label text-semibold">Project Company:</label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"><?php echo $project->company?></div>
                                </div>
                                <label class="col-lg-1 control-label text-semibold">Plan Finish:</label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"><?php echo date('d-M-Y', strtotime($project->end_date));?></div>
                                </div>
                                <label class="col-lg-1 control-label text-semibold"></label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"><?php //echo $project->project_name?></div>
                                </div>
                            </div>

                            <div class="form-group mb-5">
                                <label class="col-lg-1 control-label text-semibold">Customer:</label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"><?php echo $project->customer?></div>
                                </div>
                                <label class="col-lg-1 control-label text-semibold">Scope of Work:</label>
                                <div class="col-lg-2">
                                    <div class="form-control-static">
                                            <?php foreach($scope_of_work as $key => $value) {
                                                echo $value->group_name . ', ';
                                            }
                                            ?>
                                    </div>
                                </div>
                                <label class="col-lg-1 control-label text-semibold"></label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"></div>
                                </div>
                            </div>

                            <div class="form-group mb-5">
                                <label class="col-lg-1 control-label text-semibold">Leader:</label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"><?php echo $project->leader?></div>
                                </div>
                                <label class="col-lg-1 control-label text-semibold">Area Project:</label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"><?php echo ucwords(strtolower(str_replace(',',', ',$project->cities)));?></div>
                                </div>
                                <label class="col-lg-2 control-label text-semibold"></label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"><?php //echo $project->project_name?></div>
                                </div>
                            </div>

                            <div class="form-group mb-5">
                                <label class="col-lg-1 control-label text-semibold">Completion:</label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"><?php echo $project->completion."%"?></div>
                                </div>
                                <label class="col-lg-2 control-label text-semibold"> </label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"><?php //echo $project->project_name?></div>
                                </div>
                                <label class="col-lg-2 control-label text-semibold"></label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"><?php //echo $project->project_name?></div>
                                </div>
                            </div>

                            <div class="form-group mb-5">
                                <label class="col-lg-1 control-label text-semibold">Km Cable:</label>
                                <div class="col-lg-2">
                                    <?php if(!empty($km_cable))
                                        {
                                            if($km_cable->qty >= 1000)  {
                                                $e = number_format($km_cable->qty, 2);
                                            } else {
                                                $e =$km_cable->qty;
                                            }

                                            //$e =$km_cable->qty;
                                            $f =$km_cable->uom;
                                        } else {
                                            $e = '';
                                            $f = '';
                                        }?>
                                    <div class="form-control-static"><?php echo $e?> <?php echo $f?></div>
                                </div>
                                <label class="col-lg-1 control-label text-semibold"> </label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"><?php //echo $project->project_name?></div>
                                </div>
                                <label class="col-lg-2 control-label text-semibold"></label>
                                <div class="col-lg-2">
                                    <div class="form-control-static"><?php //echo $project->project_name?></div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-md-12">
                    <div class="chart-container">
                        <div class="chart emp" id="c3-axis"></div>
                    </div>
                </div>
            </div>
            <!--
            <div class="row">
                <div class="col-lg-6">

                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Task Status</h5>  
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="chart-container has-scroll">
                                <div class="chart has-fixed-height has-minimum-width" id="basic_donut"></div>
                            </div>
                        </div>

                       <div class="content-group-sm">
                            <p class="text-semibold">Extra small progress bar</p>
                            <div class="progress progress-xs"> <div class="progress-bar progress-bar-info" style="width: 75%"> <span class="sr-only">75% Complete</span> </div></div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                </div>
            </div>
            -->
        </div>


        <!--<div class="tab-pane fade" id="project-tasks">
            <div class="table-responsive panel-group panel-group-control panel-group-control-left">
                <table class="table table-sm text-nowrap">
                    <thead>
                    <tr>
                        <th></th>
                        <th class="col-md-2">Assigned To</th>
                        <th class="col-md-2">Priority</th>
                        <th class="col-md-2">Due Date</th>
                        <th class="col-md-2">Progress</th>
                        <th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    <div class = "row m-10">
                        <a href="#">
                            <button class = "btn bg-success btn-labeled" id = "add_milestone"><b><i class="icon-plus2"></i></b>Add Milestone</button>
                        </a>
                    </div>
                    <div class = "row m-10">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <button class = "btn bg-success btn-labeled"><b><i class="icon-plus2"></i></b>Add...</button>
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="#" id = "add_task_list"><i class="icon-folder-plus4"></i> Add Task List</a></li>
                                    <li><a href="#" id = "add_task"><i class="icon-file-plus"></i> Add Task</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="row m-10">
                        <div class="col-lg-3">
                            <input name="search" placeholder="Filter..." autocomplete="off" class = "form-control">
                        </div>
                        <button id="btnResetSearch" class = "btn btn-primary"><i class="icon-cross2"></i></button>
                        <span id="matches"></span>
                    </div>


                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table tree-table">
                                <thead>
                                <tr>
                                    <th style="width: 80px;">#</th>
                                    <th>Items</th>
                                    <th style="width: 80px;">Due Date</th>
                                    <th style="width: 46px;">Like</th>
                                    <th style="width: 46px;"></th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>

                            <div class = "text-right"><a id = "prev" class = "hidden"></a><a id = "next">Next</a></div>
                        </div>
                    </div>
            </div>
            <table id="jqGrid"></table>
            <div id="jqGridPager"></div>
        </div>-->

        <div class="tab-pane fade" id="project-tasks">

            <div class="panel-body" style="padding-top: 0">
                <h4>Tasks and Assignment</h4>

                <div class="heading-elements">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-labeled btn-labeled-right dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><b><i class="icon-menu7"></i></b> Add Task <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#" class="add_task_list"><i class="icon-folder-plus4"></i> Add Task List</a></li>
                            <li><a href="#" class="add_task"><i class="icon-file-plus"></i> Add Task</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            <table class="table table-xlg text-nowrap">
                <tbody>
                <tr>
                    <td class="col-md-3">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom legitRipple"><i class="icon-task"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold">Total Issue & Risk</div>
                                <div class="text-muted"><?php echo number_format($total_issue);?> Issue / Risk</div>
                            </li>
                        </ul>
                    </td>

                    <td class="col-md-3">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom legitRipple"><i class="icon-target2"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold">Total Open Issue & Risk</div>
                                <div class="text-muted"><?php echo number_format($open_issue);?> Issue / Risk</div>
                            </li>
                        </ul>
                    </td>

                    <td class="col-md-3">
                        <ul class="list-inline text-center">
                            <li>
                                <a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-xs valign-text-bottom legitRipple"><i class="icon-clipboard3"></i></a>
                            </li>
                            <li class="text-left">
                                <div class="text-semibold">Total Close Issue & Risk</div>
                                <div class="text-muted"><?php echo number_format($close_issue);?> Issue / Risk</div>
                            </li>
                        </ul>
                    </td>

                    <td class="col-md-3">

                    </td>

                </tr>
                </tbody>
            </table>



            <table class="table text-nowrap datatable-task-list">
                <thead>
                <tr>
                    <th>Task</th>
                    <th>Start Date</th>
                    <th>Due Date</th>
                    <th>Progresss</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th class="text-center text-muted" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade <?php echo ($active_tab == 'milestone')? "active in" : ""?>" id="project-milestones">
            <div class="panel-body" style="padding-top: 0">
                <h4>Milestone</h4>

                <div class="heading-elements">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-labeled btn-labeled-right dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><b><i class="icon-menu7"></i></b> Add Milestone <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#" class="add_milestone"><i class="icon-flag8"></i> Add Milestone</a></li>
                            <li><a href="#" class="add_value"><i class="icon-quill4"></i> Edit Milestone Value</a></li>
                        </ul>
                    </div>
                </div>
                <br/>
                <div class = "col-md-12">
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered" style="font-weight: bold;">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">ACTIVITY</th>
                                    <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">SCOPE</th>
                                 <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">CR</th>
                                 <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">BASELINE</th>
                                    <!--    <th colspan="2" class="text-center">PREVIOUS</th>
                                    <th colspan="2" class="text-center">PROGRESS</th>
                                    <th colspan="2" class="text-center">COMPLETE</th> -->
                                </tr>
                                <tr>
                                    <th class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">UoM</th>
                                    <th class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">Qty</th>
                                    <!--<th class="text-center">Qty</th>
                                    <th class="text-center">%</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">%</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-center">%</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($milestones as $key => $value){ 
                                    ?>
                                <tr class="text-semibold">
                                    <td colspan="10" style="background-color: rgb(0,0,0);color:#ffffff;"><?php echo $value->group_name?></td>
                                    <!-- <td colspan="2"></td> -->
                                </tr>
                                <?php foreach($value->mil as $k => $v){?>
                                <tr class="" id="mil_<?php echo $v->id?>">
                                    <td><?php echo $v->milestone_name?></td>
                                    <td class="text-center"><?php echo $v->uom?></td>
                                    <td class="text-center"><?php if($v->qty >= 1000)  { echo number_format($v->qty, 2);} else {echo $v->qty;}?></td>
                                    <td class = "text-center"><?php if($v->cr_qty >= 1000)  { echo number_format($v->cr_qty, 2);} else {echo $v->cr_qty;}?></td>
                                    <td class="text-center"><?php if($v->daily_baseline >= 1000)  { echo number_format($v->daily_baseline, 2);} else {echo $v->daily_baseline;}?></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br/>

                <div class = "col-md-12 mt-20 row">
                    <form action="/index.php/planning/save_plan/" method="post" class="form-horizontal" id = "project_plan_form">
                    <div class="table-responsive">
                        <table class= "table-condensed table-bordered" style="font-weight: bold;">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="hidden" name="project_id" value = <?php echo $project->id?>></th>
                                    <?php foreach ($project_gap as $mth) { ?>
                                        <th class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;"><?php echo $mth['month']." '".substr($mth['year'],-2)?></th>
                                    <? } ?>
                                    <!--    <th colspan="2" class="text-center">PREVIOUS</th>
                                    <th colspan="2" class="text-center">PROGRESS</th>
                                    <th colspan="2" class="text-center">COMPLETE</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <th class="text-center" >Plan</th>
                                <?php foreach ($project_gap as $key => $mth) { ?>
                                    <td class="text-center"  width='200px'>
                                        <input type="hidden" name="plan[<?php echo $key?>][date]" value = "<?php echo strtolower($mth['month'])."_".$mth['year']?>">
                                        <input type="hidden" name="plan[<?php echo $key?>][id]" id = "id_<?php echo strtolower($mth['month'])."_".$mth['year']?>">
                                        <input type="number" step = "0.001" id = "plan_<?php echo strtolower($mth['month'])."_".$mth['year']?>" class = "form-control" name="plan[<?php echo $key?>][plan]">
                                    </td>
                                <? } ?>
                            </tbody>
                        </table>
                    </div>
                    <br/>
                    <div class="text">
                        <button type="submit" id = "sbmt" class="btn btn-success">Save Plan</button> &nbsp; &nbsp;
                    </div>
                    </form>
                </div>
            </div>
            
        </div>

        <div class="tab-pane fade <?php echo ($active_tab == 'team')? "active in" : ""?>" id="project-people">
            <div class="panel-body" style="padding-top: 0">
                <h4>Project Team</h4>

                <div class="heading-elements">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-labeled btn-labeled-left add_user"><b><i class="icon-puzzle"></i></b>Add Team</button>
                    </div>
                </div>
            </div>

            <table class="table text-nowrap datatable-people-list">
                <thead>
                <tr> 
                    <th>Name</th>
                    <th>Position</th>
                    <th>Join date to Project</th>
                    <th>City</th>
                    <th><i class = "icon-chevron-down pull-right"></i></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade <?php echo ($active_tab == 'vendor')? "active in" : ""?>" id="project-vendor">
            <div class="panel-body" style="padding-top: 0">
                <h4>Project Vendor</h4>

                <div class="heading-elements">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-labeled btn-labeled-left add_vendor"><b><i class="icon-plus3"></i></b>Add Vendor</button>
                    </div>
                </div>
            </div>

            <table class="table text-nowrap datatable-project-vendor-list">
                <thead>
                <tr> 
                    <th>Vendor</th>
                    <th>Scope</th>
                    <th>Area Vendor</th>
                    <th><i class = "icon-chevron-down pull-right"></i></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade <?php echo ($active_tab == 'project-charter')? "active in" : ""?>" id="project-charter">
            <div class="panel-body" style="padding-top: 0">
                <h4>Approve Project Charter</h4>

                <!-- Start Dendy 20-03-2019 -->
                <div class="heading-elements">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-labeled btn-labeled-left upload-project-charter"><b><i class="icon-plus3"></i></b>Upload PDF File</button>
                    </div>
                </div>
            </div>

            <table class="table text-nowrap datatable-project-charter-list">
                <thead>
                <tr> 
                    <th>No</th>
                    <th>Filename</th>
                    <th><i class = "icon-chevron-down pull-right"></i></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <!-- End Dendy 20-03-2019 -->
        </div>

        <div class="tab-pane fade <?php echo ($active_tab == 'pip')? "active in" : ""?>" id="pip">
            <div class="panel-body" style="padding-top: 0">
                <h4>Project Implementation Plan</h4>

            </div>



        </div>

        <div class="tab-pane fade <?php echo ($active_tab == 'kmz')? "active in" : ""?>" id="kmz">
            <div class="panel-body" style="padding-top: 0">
                <h4>KMZ</h4>

                <!-- Start Dendy 26-03-2019 -->
                <div class="heading-elements">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-labeled btn-labeled-left upload-project-kmz"><b><i class="icon-plus3"></i></b>Upload KMZ File</button>
                    </div>
                </div>
            </div>

            <table class="table text-nowrap datatable-project-kmz-list">
                <thead>
                <tr> 
                    <th>No</th>
                    <th>Filename</th>
                    <th><i class = "icon-chevron-down pull-right"></i></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <!-- End Dendy 26-03-2019 -->
        </div>

        <div class="tab-pane fade <?php echo ($active_tab == 'boq')? "active in" : ""?>" id="boq">
            <div class="panel-body" style="padding-top: 0">
                <h4>BOQ</h4>

            </div>



        </div>

        <div class="tab-pane fade <?php echo ($active_tab == 'segment')? "active in" : ""?>" id="segment">
            <div class="panel-body" style="padding-top: 0">
                <h4>Detail Scope</h4>
                
                <!-- Start Dendy 26-03-2019 -->
                <!-- <div class="heading-elements">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-labeled btn-labeled-left add_segment"><b><i class="icon-plus3"></i></b>Add Segment</button>
                    </div>
                </div> -->
            </div>

            <ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">
                <?php foreach ($milestone_grup as $t => $l) {
                    $show = "hidden";
                    if(in_array($l->id, $project_scope_id)){
                        $show = "";
                    }

                    ?>
                <li class="<?php echo $show?>"><a href="#mile-grup<?php echo $l->id?>" data-toggle="tab" aria-expanded="true"><?php echo $l->group_name ?></a></li>
                <?php } ?>
            </ul>

            <div class = "tab-content">
                <div class="tab-pane fade active in" id="mile-grup1">
                    <div class="panel-body" style="padding-top: 0">
                    
                        <h4>SITAC + CME + MW</h4>
                        
                        <!-- Start Dendy 26-03-2019 -->
                        <div class="heading-elements">
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="mile-grup2">
                    <div class="panel-body" style="padding-top: 0">
                        <h4>INLAND</h4>
                        <div class="heading-elements">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-labeled btn-labeled-left add_segment"><b><i class="icon-plus3"></i></b>Add Segment</button>
                            </div>
                        </div>
                        <table class="table text-nowrap datatable-project-segment-list">
                            <thead>
                            <tr> 
                                <th>No</th>
                                <th>Segment Name</th>
                                <th>Cluster</th>
                                <th>Vendor</th>
                                <th><i class = "icon-chevron-down pull-right"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="mile-grup3">
                    <div class="panel-body" style="padding-top: 0">
                        <h4>SUBMARINE</h4>
                        
                        <!-- Start Dendy 26-03-2019 -->
                        <div class="heading-elements">
                        </div>
                    </div>
                </div> 
                <div class="tab-pane fade" id="mile-grup4">
                    <div class="panel-body" style="padding-top: 0">
                        <h4>ISP (EQUIPMENT)</h4>
                        
                        <!-- Start Dendy 26-03-2019 -->
                        <div class="heading-elements">
                        </div>
                    </div>
                </div> 
                <div class="tab-pane fade" id="mile-grup5">
                    <div class="panel-body" style="padding-top: 0">
                        <h4>DOC ATP READINESS</h4>
                        
                        <!-- Start Dendy 26-03-2019 -->
                        <div class="heading-elements">
                        </div>
                    </div>
                </div> 

                <div class="tab-pane fade" id="mile-grup6">
                    <div class="panel-body" style="padding-top: 0">
                        <h4>ATP</h4>
                        
                        <!-- Start Dendy 26-03-2019 -->
                        <div class="heading-elements">
                        </div>
                    </div>
                </div> 
                <div class="tab-pane fade" id="mile-grup7">
                    <div class="panel-body" style="padding-top: 0">
                        <h4>BAST</h4>
                        
                        <!-- Start Dendy 26-03-2019 -->
                        <div class="heading-elements">
                        </div>
                    </div>
                </div> 
            </div>
            
        </div>
    </div>

</div>

<div id="modal_edit_value" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Edit Milestone Value</h5>
            </div>

            <div class="modal-body ">
                <div class="col-lg-12">
                    <form method = "POST"  action = "/planning/saveMsValue" id = "add_milestone_form" enctype="multipart/form-data" class = "form-validate-jquery">
                        <input type = "hidden" name = "project_id" value = "<?php echo $project_id?>"/>
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">ACTIVITY</th>
                                    <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">SCOPE</th>
                                    <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">CR</th>
                                    <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">BASELINE</th>
                                    <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">ACTION</th>
                                </tr>
                                <tr>
                                    <th class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">UoM</th>
                                    <th class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($milestones as $key => $value){ 
                                    ?>
                                <tr class="text-semibold">
                                    <td colspan="10" style="background-color: rgb(0,0,0);color:#ffffff;"><?php echo $value->group_name?></td>
                                </tr>
                                <?php foreach($value->mil as $k => $v){?>
                                <tr class="" >
                                    <td>
                                        <?php echo $v->milestone_name?>
                                        <input type="hidden" name="value[<?php echo $v->id?>][project_id]" value = "<?php echo $v->project_id?>">
                                        <input type="hidden" name="value[<?php echo $v->id?>][milestone_grup_id]" value = "<?php echo $v->milestone_grup_id?>">
                                        <input type="hidden" name="value[<?php echo $v->id?>][milestone_id]" value = "<?php echo $v->milestone_id?>">
                                    </td>
                                    <td>
                                       <!--  <input type="text" class = "form-control" name = "value[<?php echo $v->id?>][uom]" value = "<?php echo $v->uom?>"> -->
                                        <select class="form-control select" name = "value[<?php echo $v->id?>][uom]">
                                            <?php foreach ($uom as $key => $value) { 
                                                if($value->uom_name == $v->uom){
                                                    $select = 'selected';
                                                } else {
                                                    $select = '';
                                                }
                                                ?>
                                                 <option value="<?php echo $value->uom_name?>" <?php echo $select?>><?php echo $value->uom_name?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                    <td><input type="number" step = "0.001" class = "form-control" name = value[<?php echo $v->id?>][qty] value = "<?php echo $v->qty?>"></td>
                                    <td><input type="number" step = "0.001" class = "form-control" name = value[<?php echo $v->id?>][cr_qty] value = "<?php echo $v->cr_qty?>"></td>
                                    <td><input type="number" step = "0.001" class = "form-control" name = value[<?php echo $v->id?>][baseline] value = "<?php echo $v->daily_baseline?>"></td>
                                    <td><a href = "#" class = "delete_milestone" mls_id = "<?php echo $v->id?>"><i class = 'icon-trash-alt'></i></a></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                        <br/>
                </div>
            </div>
            <br/>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" name = "submit_form" value = "true" class="btn btn-primary">Save</button>
            </div>
            </form> 
        </div>
    </div>
</div>
<div id="modal_add_milestone" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Add Milestone</h5>
            </div>

            <div class="modal-body ">
                <div class="col-lg-12">
                    <form method = "POST"  action = "/planning/saveMils" id = "add_milestone_form" enctype="multipart/form-data" class = "form-validate-jquery">
                          <div class="form-group">
                               <div class="row">
                                    <div class="col-sm-12">
                                         <label>Milestone</label>
                                         <input type = "hidden" name = "project_id" value = "<?php echo $project_id?>"/> 
                                         <select id="milestone_grup" name="milestone_grup" data-placeholder="Test" class="select">
                                            <?php foreach ($milestone_grup as $k => $v) { ?>
                                            <option value="<?php echo $v->id?>"><?php echo $v->group_name ?></option>
                                            <?php }?>
                                         </select>
                                    </div> 
                                </div>
                          </div>
                          <div class = "permission-list">
                            <?php foreach($milestone as $i => $m) { ?>
                                <div class = "milestone m<?php echo $i?>">
                                    <?php foreach ($m as $k => $sub) {?>
                                    <div class = 'col-md-12'>
                                        <div class='col-md-4'>
                                            <div class="form-group pt-15">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="styled item" name = "milestone[<?php echo $sub->id?>]" value = "<?php echo $sub->id?>">
                                                        <?php echo $sub->milestone_name?>
                                                    </label>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class='col-md-4'>
                                            <select disabled id = "uom<?php echo $sub->id?>" class="uom form-control select" name = "uom[<?php echo $sub->id?>]">
                                                <?php foreach ($uom as $key => $value) { ?>
                                                     <option value="<?php echo $value->uom_name?>"><?php echo $value->uom_name?></option>
                                                <?php }?>
                                            </select>
                                            <div class="form-group pt-15">
                                            </div>
                                        </div> 
                                    </div>
                                    <?php }?>
                                </div>
                                <?php }?>
                          </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" name = "submit_form" value = "true" class="btn btn-primary">Save</button>
            </div>
            </form> 
        </div>
    </div>
</div>


<div id="modal_add_resource" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Add Team Project</h5>
            </div>

            <div class="modal-body ">
                <div class="col-lg-12">
                    <form method = "POST"  action = "/resource/saveRes" id = "add_milestone_form" enctype="multipart/form-data" class = "form-validate-jquery">
                    <div class="form-group">
                       <div class="row">
                            <div class="col-sm-12">
                                 <label>Position</label>
                                 <input type = "hidden" name = "project_id" value = "<?php echo $project_id?>"/> 
                                 <select id="position_id" name="position_id" data-placeholder="Select position" class="select">
                                    <option value = ""></option>
                                    <?php foreach ($position as $k => $v) { ?>
                                    <option value="<?php echo $v->id?>"><?php echo $v->position_title ?></option>
                                    <?php }?>
                                 </select>
                            </div> 
                        </div>
                    </div>

                    <div class="form-group project_coordinator hidden">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Project Coordinator</label>
                                <select id="project_coordinator" name="project_coordinator" data-placeholder="Select Resource" class="select">
                                    <option value = ""></option>
                                    <?php foreach ($project_coordi as $value) { ?>
                                        <option
                                            value="<?php echo $value->user_id ?>"><?php echo $value->fullname ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Resource</label>
                                <select id="users_id" name="user_id[]" data-placeholder="Select Resource" class="select" required="required" multiple="multiple">
                                    <?php foreach ($resource as $value) { ?>
                                        <option
                                            value="<?php echo $value->user_id ?>"><?php echo $value->fullname ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>City</label>
                                <select id="area" name="area[]" data-placeholder="Select City" class="select" required="required" multiple>
                                    <option value = ""></option>
                                    <?php foreach ($area as $value) { ?>
                                        <option value="<?php echo $value->location_id?>"><?php echo $value->location ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" name = "submit_form" value = "true" class="btn btn-primary">Save</button>
            </div>
            </form> 
        </div>
    </div>
</div>


<div id="modal_edit_resource" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Edit Resource</h5>
            </div>

            <div class="modal-body ">
                <div class="col-lg-12">
                    <form method = "POST"  action = "" id = "edit_resource_from" class = "form-validate-jquery">
                        <div class="form-group">
                           <div class="row">
                                <div class="col-sm-12">
                                     <label>Name</label>
                                     <input type="hidden" name="resource_id" id = "resource_id">
                                     <input type="text" name="resource_name" id ="resource_name" class = "form-control" disabled>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group res_project_coordinator hidden">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Project Coordinator</label>
                                <select id="resource_project_coordinator" name="resource_project_coordinator" data-placeholder="Select Resource" class="select">
                                    <option value = ""></option>
                                    <?php foreach ($project_coordi as $value) { ?>
                                        <option
                                            value="<?php echo $value->user_id ?>"><?php echo $value->fullname ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Position</label>
                                    <select id="resource_position" name="resource_position" data-placeholder="Select position" class="select">
                                        <option value = ""></option>
                                        <?php foreach ($position as $k => $v) { ?>
                                        <option value="<?php echo $v->id?>"><?php echo $v->position_title ?></option>
                                        <?php }?>
                                     </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>City</label>
                                    <select id="resource_area" name="resource_area[]" class="select" required="required" multiple>
                                        <option value = ""></option>
                                        <?php foreach ($area as $value) { ?>
                                            <option value="<?php echo $value->location_id?>"><?php echo $value->location ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Join Date</label>
                                    <input type="resource_join_date"  id = "resource_join_date" name="resource_join_date" class = "form-control daterange-single">
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-close" data-dismiss="modal">Close</button>
                <button type="submit" name = "submit_form" value = "true" class="btn btn-primary">Save</button>
            </div>
            </form> 
        </div>
    </div>
</div>


<div id="modal_add_vendor" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Vendor</h5>
            </div>

            <div class="modal-body ">
                <div class="col-lg-12">
                    <form method = "POST"  action = "" id = "vendor_form" enctype="multipart/form-data" class = "form-validate-jquery">
                    <div class="form-group">
                       <div class="row">
                            <div class="col-sm-12">
                                 <label>Vendor</label>
                                 <input type = "hidden" name = "project_id" value = "<?php echo $project_id?>"/> 
                                 <input type = "hidden" name = "project_vendor_id" id = "project_vendor_id" value = ""/> 
                                 <select id="vendor_id" name="vendor_id" data-placeholder="Select vendor" class="select">
                                    <option value = ""></option>
                                    <?php foreach ($vendor as $k => $v) { ?>
                                    <option value="<?php echo $v->id?>"><?php echo $v->vendor_name ?></option>
                                    <?php }?>
                                 </select>
                            </div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Scope</label>
                                <select id="scope_id" name="scope_id[]" data-placeholder="Select Scope" class="select" required="required" multiple>
                                    <option value = ""></option>
                                    <?php foreach ($scope as $value) { ?>
                                        <option value="<?php echo $value->id?>"><?php echo $value->project_scope ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Area Vendor</label>
                                <select id="area_id" name="area_id[]" data-placeholder="Select Area" class="select" required="required" multiple>
                                    <option value = ""></option>
                                    <?php foreach ($area as $value) { ?>
                                        <option value="<?php echo $value->location_id?>"><?php echo $value->location ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" name = "submit_form" value = "true" class="btn btn-primary">Save</button>
            </div>
            </form> 
        </div>
    </div>
</div>

<!-- Start Dendy 20-03-2019 -->
<div id="modal_upload_project_charter" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Project Charter</h5>
            </div>

            <div class="modal-body ">
                <div class="col-lg-12">
                    <form method="POST"  action="" id="project_charter_form" enctype="multipart/form-data" class = "form-validate-jquery">
                    <div class="form-group">
                       <div class="row">
                            <div class="col-sm-12">
                                 <label>File Project Charter</label>    
                                 <input type = "hidden" name = "project_id" value = "<?php echo $project_id?>"/> 
                                 <input type="file" name="project_charter_file" class="file-styled" size="20"/>                                  
                            </div> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" name = "submit_form" value = "true" class="btn btn-primary">Save</button>
            </div>
            </form> 
        </div>
    </div>
</div>
<!-- End 20-03-2019 -->

<!-- Start Dendy 26-03-2019 -->
<div id="modal_upload_project_kmz" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Project Charter</h5>
            </div>

            <div class="modal-body ">
                <div class="col-lg-12">
                    <form method="POST"  action="" id="project_kmz_form" enctype="multipart/form-data" class = "form-validate-jquery">
                    <div class="form-group">
                       <div class="row">
                            <div class="col-sm-12">
                                 <label>File Project KMZ</label>    
                                 <input type = "hidden" name = "project_id" value = "<?php echo $project_id?>"/> 
                                 <input type="file" name="project_kmz_file" class="file-styled" size="20" />                                  
                            </div> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" name = "submit_form" value = "true" class="btn btn-primary">Save</button>
            </div>
            </form> 
        </div>
    </div>
</div>
<!-- End 26-03-2019 -->

<!-- Start Dendy 27-03-2019 // modified : laras 12/4/2019 -->
<div id="modal_add_segment" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Segment</h5>
            </div>

            <div class="modal-body ">
                <div class="col-lg-12">
                    <form method = "POST"  action = "" id = "segment_form" enctype="multipart/form-data" class = "form-validate-jquery">
                    <div class="form-group">
                       <div class="row">
                            <div class="col-sm-12">
                                 <label>Segment</label>
                                 <input type = "hidden" name = "project_id" value = "<?php echo $project_id?>"/>
                                 <input type = "hidden" name = "segment_id"/>
                                 <input type="text" name="segment_name" class="form-control">
                            </div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Cluster</label>
                                <input type="text" name="cluster" class="form-control">                                
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Vendor</label>
                                <select id="vendor_id" name="vendor_id[]" data-placeholder="Select vendor" class="select" required="required" multiple>
                                    <option value = ""></option>
                                </select>                                
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" name = "submit_form" value = "true" class="btn btn-primary">Save</button>
            </div>
            </form> 
        </div>
    </div>
</div>
<!-- End Dendy 27-03-2019 -->

<!-- Start Dendy 27-03-2019 -->
<div id="modal_edit_segment" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Add Span</h5>
            </div>

            <div class="modal-body ">
                <div class="col-lg-12">
                    <form class = "form-validate-jquery" id="save-project-segment-span">
                        <input type = "hidden" name = "project_id" value = "<?php echo $project_id?>"/>
                        <input type = "hidden" name = "segment_id"/>
                        <table class="table table-condensed table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">NO.</th>
                                    <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">SPAN</th>                                    
                                    <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">ACTION</th>
                                </tr>
                                <tr>
                                    <th class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">HH START</th>
                                    <th class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;text-align: center;">HH END</th>
                                </tr>
                            </thead>
                            <tbody id="segment-span">                                
                                <tr class="text-semibold">
                                    <td colspan="10" style="background-color: rgb(0,0,0);color:#ffffff;" id="segment_name"></td>
                                </tr>                                
                            </tbody>
                        </table>
                        <br/>
                </div>
            </div>
            <br/>
            <div class="modal-footer">
                <button type="button" class="btn btn-primaty pull-left" id="add_span">Add Span</button>
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" name = "submit_form" value = "true" class="btn btn-primary">Save</button>
            </div>
            </form> 
        </div>
    </div>
</div>
<!-- End Dendy 27-03-2019 -->


<script type="text/javascript">
    $(function () {
        $.ajax({
            url: JS_BASE_URL + '/dailyProgressReport/daily_project_chart/',
            type: 'POST',
            data : {project_id : <?php echo $project->id?>},
            dataType: 'json',
            async: false,
            success: function (res) {
                console.log(res);
                if(res.status == 'Success'){
                    var chart_date = [];
                    var daily = [];
                    mth = 0;
                    dates = res.data.date2;
                    daily.push('daily');
                    $.each(dates, function(key, val){
                        daily.push(val);
                        mth++;
                    })
                    if(mth < 3) mth = 3;
                    chart_date.push('dates');
                    $.each(res.data.date, function(key, val){
                        chart_date.push(val);
                    });

                    // $.each(res.data, function(key,value){
                    var chartId = '#c3-axis';
                    var axis_additional = c3.generate({
                        bindto: chartId,
                        size: { height: 300, width : 1300},
                        data: {
                            xs: {
                                'Daily': 'daily',
                                'Baseline': 'dates',
                            },
                            columns: [
                                chart_date,
                                daily,
                                res.data.plan,
                                res.data.d_actual
                            ],

                            /*regions: {
                                'Baseline': [{'style':'dashed','type': 'spline'}]
                            },*/
                            type: 'spline',
                        },
                        bar: {
                            width: {
                                ratio: 0.1 // this makes bar width 50% of length between ticks
                            }
                        },
                        color: {
                            pattern : ['#cecece', '#45852c', '#009688', '#4CAF50']
                        },
                        axis: {
                            x: {
                                type: 'timeseries',
                                tick: {
                                    culling: {
                                        max: 1
                                    },
                                    format: function (chart_date) {
                                        if(chart_date.getDate() == 1 || chart_date.getDate() == 20){
                                            var y = chart_date.getFullYear();
                                            var e = y.toString();
                                            e = e.substring(2,4);
                                            return monthName(chart_date.getMonth()) +'-'+ e; 
                                        } else {
                                            return "";
                                        }
                                    }
                                }
                            }
                        },
                        tooltip: {
                            format: {
                                title: function (d) { 

                                    var a = d.toString().substring(4); 
                                    var e = a.substring(0, 11);
                                    return e;

                                },
                            }
                        }
                    });
                } else {
                    var chartId = '#c3-axis';
                    axis_additional = c3.generate({
                        // x: 'x',
                        bindto: chartId,
                        size: { height: 300, width : 600},
                        data: {
                            columns: [
                                // ['Baseline', 30, 20, 50, 40, 60, 50],
                                // ['Actual', 200, 130, 90, 240, 130, 220],
                                // ['Cum. Baseline', 300, 200, 160, 400, 250, 250],
                                // ['Cum. Actual', 200, 130, 90, 240, 130, 220],
                            ],
                            type: 'bar',
                            types: {
                                'Cum. Baseline': 'line',
                                'Cum. Actual': 'line',
                            },
                            axes: {
                                'Baseline': 'y',
                                'Actual': 'y2'
                            }
                        },
                        bar: {
                            width: {
                                ratio: 0.1 // this makes bar width 50% of length between ticks
                            }
                            // or
                            //width: 100 // this makes bar width 100px
                        },
                        color: {
                            pattern : ['#cecece', '#F44336', '#009688', '#4CAF50']
                        },
                        axis: {
                            y2: {
                                show: true
                            },
                            x: {
                                type: 'category',
                                categories: ['2018-11-05','2018-11-15','2018-11-19','2018-11-20','2018-11-22','2018-11-26']
                            }
                        },
                        grid: {
                            y: {
                                show: true
                            }
                        }
                    });
                }

            }
        });

        function toDate(string) {
          var from = string.split("-");
          return new Date(from[2], from[1] - 1, from[0]);
        }

        function monthName(index) {
            var month = [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'Mei',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Okt',
                'Nov',
                'Des'
            ];

            return month[index];
        }
        /*$.ajax({
            url: JS_BASE_URL + '/dailyProgressReport/get_charts/',
            type: 'POST',
            data : {project_id : <?php echo $project->id?>},
            dataType: 'json',
            async: false,
            success: function (res) {
                if(res.status == 'Success'){
                    // $.each(res.data, function(key,value){
                    var chartId = '#c3-axis';
                    var axis_additional = c3.generate({
                        bindto: chartId,
                        size: { height: 300, width : 1000},
                        data: {
                            columns: [
                                // ['x','2018-11-05','2018-11-15','2018-11-19','2018-11-20','2018-11-22','2018-11-26'],
                                // ['Baseline', 30, 20, 50, 40, 60, 50],
                                res.data.plan,
                                res.data.actual,
                                // res.data.cum_baseline,
                                // res.data.cum_actual
                            ],
                            type: 'line',
                            // types: {
                            //     'Cum. Baseline': 'line',
                            //     'Cum. Actual': 'line',
                            // },
                            axes: {
                                'Baseline': 'y',
                                'Actual': 'y'
                                // 'Cum. Baseline' :'y2',
                                // 'Cum. Actual' :'y2'
                            }
                        },
                        bar: {
                            width: {
                                ratio: 0.1 // this makes bar width 50% of length between ticks
                            }
                            // or
                            //width: 100 // this makes bar width 100px
                        },
                        color: {
                            pattern : ['#FF9800', '#F44336', '#009688', '#4CAF50']
                        },
                        axis: {
                            // y2: {
                            //     show: true
                            // },
                            x: {
                                type: 'category',
                                categories: res.data.date,
                                // tick: {
                                //     rotate: 45,
                                //     multiline: false
                                // },
                                // height: 130
                            }
                        },
                        grid: {
                            y: {
                                show: true
                            }
                        },
                        // legend: {
                        //     show: false
                        // }
                    });
                } else {
                    var chartId = '#c3-axis';
                    axis_additional = c3.generate({
                        // x: 'x',
                        bindto: chartId,
                        size: { height: 300, width : 600},
                        data: {
                            columns: [
                                // ['Baseline', 30, 20, 50, 40, 60, 50],
                                // ['Actual', 200, 130, 90, 240, 130, 220],
                                // ['Cum. Baseline', 300, 200, 160, 400, 250, 250],
                                // ['Cum. Actual', 200, 130, 90, 240, 130, 220],
                            ],
                            type: 'bar',
                            types: {
                                'Cum. Baseline': 'line',
                                'Cum. Actual': 'line',
                            },
                            axes: {
                                'Baseline': 'y',
                                'Actual': 'y2'
                            }
                        },
                        bar: {
                            width: {
                                ratio: 0.1 // this makes bar width 50% of length between ticks
                            }
                            // or
                            //width: 100 // this makes bar width 100px
                        },
                        color: {
                            pattern : ['#FF9800', '#F44336', '#009688', '#4CAF50']
                        },
                        axis: {
                            y2: {
                                show: true
                            },
                            x: {
                                type: 'category',
                                categories: ['2018-11-05','2018-11-15','2018-11-19','2018-11-20','2018-11-22','2018-11-26']
                            }
                        },
                        grid: {
                            y: {
                                show: true
                            }
                        }
                    });
                }

            }
        });*/
        //el - 4/3/2019
        $('#position_id').change(function(){
            if($(this).val() == 10){
                $('.project_coordinator').removeClass('hidden');
            } else {
                $("#project_coordinator").val('').trigger("change");
                $('.project_coordinator').addClass('hidden');
            }
        })

        var option = "";
        $.ajax({
            url: JS_BASE_URL + '/planning/getPeopleInProject/' +<?php echo $project_id?>,
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function (res) {
                if (res.status == 'Success') {
                    $.each(res.data, function (i, val) {
                        option += '<option value="' + val.id + '">' + val.name + '</option> ';
                    });
                }
            }
        });

        var page = 0;


        $.ajax({
            url: JS_BASE_URL + '/planning/get_plan/',
            type: 'POST',
            data: {id: <?php echo $project->id?>},
            dataType: 'json',
            async: false,
            success: function (res) {
                if (res.status == 'Success') {
                    $.each(res.data.all, function (i, val) {
                        val.month = val.month.toLowerCase();
                        var id = '#plan_'+val.month+'_'+val.year;
                        var id2 = '#id_'+val.month+'_'+val.year;
                        $(id).val(val.plan);
                        $(id2).val(val.id);
                    });

                }
            }
        });


        


        // Configuration
        // ------------------------------

        /*require(
         [
         'echarts',
         'echarts/theme/limitless',
         'echarts/chart/pie',
         'echarts/chart/funnel'
         ],


         // Charts setup
         function (ec, limitless) {


         // Initialize charts
         // ------------------------------

         var basic_donut = ec.init(document.getElementById('basic_donut'), limitless);

         basic_donut_options = {

         // Add title
         title: {
         text: 'Browser popularity',
         subtext: 'Open source information',
         x: 'center'
         },

         // Add legend
         legend: {
         orient: 'vertical',
         x: 'left',
         data: ['Internet Explorer','Opera','Safari','Firefox','Chrome']
         },


         // Enable drag recalculate
         calculable: true,

         // Add series
         series: [
         {
         name: 'Browsers',
         type: 'pie',
         radius: ['50%', '70%'],
         center: ['50%', '57.5%'],
         itemStyle: {
         normal: {
         label: {
         show: true
         },
         labelLine: {
         show: true
         }
         },
         emphasis: {
         label: {
         show: true,
         formatter: '{b}' + '\n\n' + '{c} ({d}%)',
         position: 'center',
         textStyle: {
         fontSize: '17',
         fontWeight: '500'
         }
         }
         }
         },

         data: [
         {value: 335, name: 'Internet Explorer'},
         {value: 310, name: 'Opera'},
         {value: 234, name: 'Safari'},
         {value: 135, name: 'Firefox'},
         {value: 1548, name: 'Chrome'}
         ]
         }
         ]
         };

         basic_donut.setOption(basic_donut_options);


         // Resize charts
         // ------------------------------

         window.onresize = function () {
         setTimeout(function (){
         basic_donut.resize();
         }, 200);
         }
         }
         );*/
        $('.popover-show').popover({
            title: 'Assign a User',
            html: true,
            placement: 'bottom',
            content: '<div class="row">  ' +
            '<div class="col-md-12">' +
            '<form action="#" id = "z_form">' +
            '<div class="form-group">' +
            '<label>Select a User</label>' +
            '<select name="user_id" id = "new_assignee" data-placeholder="Select milestone" class="select">' +
            '<option value="">No Milestone</option>' +
            option +
            '</select>' +
            '</div>' +
            '<input type= "hidden" class = "task_id" name = "task_id">' +
            '<button type= "button" class = "btn btn-success save">SAVE</button>' +
            '</form>' +
            '</div>' +
            '</div>',
            trigger: 'click'
        }).on('shown.bs.popover', function () {
            $('.select').parents('.popover-content').removeAttr('tabindex');
            $('.select').select2();
            $(".task_id").val($(this).attr('task_id'));
            $('.save').click(function () {
                var isProcessing = false;
                var form = $("#z_form");
                $.ajax({
                    type: "POST",
                    url: JS_BASE_URL + '/projects/updateAssignee',
                    data: form.serialize(),
                    beforeSend: function () {
                        if (isProcessing) {
                            return false;
                        }
                    },
                    success: function (response) {
                        isProcessing = true;

                        return false;
                        // console.log('response');
                        // window.location.replace(JS_BASE_URL +'/projects/id/11');
                    },
                    complete: function () {
                        isProcessing = false;
                    }
                });
            });
        });
        $('.popover-show').click(function () {
            var task_id = $(this).attr('task_id');
            $('.popover-show').not(this).popover('hide');
        });
        var option2 = "";
        $.ajax({
            url: JS_BASE_URL + '/planning/getTaskList/',
            type: 'POST',
            data: {project_id: <?php echo $project_id?>},
            dataType: 'json',
            async: false,
            success: function (res) {
                if (res.status == 'Success') {
                    $.each(res.data, function (i, val) {
                        option2 += '<option value="' + val.id + '">' + val.task_list_name + '</option> ';
                    });

                }
            }
        });

        $('.add_task').on('click', function () {
            bootbox.dialog({
                    title: "Add Task",
                    message: '<div class="row"> ' +
                    '<div class="col-md-12">' +
                    '<form action="#" id = "add_task_form">' +
                    '<div class="form-group">' +
                    '<div class="row">' +
                    '<div class="col-sm-12">' +
                    '<label>Name the task</label> ' +
                    '<input type="text" name = "task_name" class="form-control"> ' +
                    '<input type="hidden" name = "project_id"  value = "<?php echo $project_id?>" class="form-control">' +
                    '</div> ' +
                    '</div> ' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-sm-6">' +
                    '<div class="form-group"> ' +
                    '<label>Start Date</label> ' +
                    '<div class="input-group">' +
                    '<span class="input-group-addon"><i class="icon-calendar22"></i></span>' +
                    '<input type="text" id = "start_date" class="form-control daterange-single" name = "start_date" placeholder="No date">' +
                    '</div> ' +
                    '</div> ' +
                    '</div>' +
                    '<div class="col-sm-6">' +
                    '<label>End Date</label>' +
                    '<div class="input-group">' +
                    '<span class="input-group-addon"><i class="icon-calendar22"></i></span>' +
                    '<input type="text" id = "end_date" class="form-control daterange-single" name = "due_date" placeholder="No date">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-sm-6">' +
                    '<div class="form-group"> ' +
                    '<label>Progress</label> ' +
                    '<div class="input-group">' +
                    '<input type="progress" id = "progress" class="form-control" name = "progress">' +
                    '<span class="input-group-addon">%</span>' +
                    '</div> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div class="col-sm-6">' +
                    '<div class="form-group"> ' +
                    '<label>Task List</label> ' +
                    '<select id="tasklist" name="tasklist" data-placeholder="Select scope" class="select"> ' +
                    option2 +
                    '</select> ' +
                    '</div> ' +
                    '</div> ' +
                    '</div> ' +
                    '</form>' +
                    '</div>',
                    buttons: {
                        success: {
                            label: "Save",
                            className: "btn-success",
                            callback: function () {
                                var form = $('#add_task_form');
                                $.ajax({
                                    url: JS_BASE_URL + '/planning/saveTask',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: form.serialize(),
                                    success: function (res) {
                                        var dbt = $('.datatable-task-list').dataTable();
                                        if (res.status == 'Success') {
                                            dbmil.api().ajax.reload();
                                        }
                                    }
                                });

                            }
                        }
                    }
                }
            );

            $('.select').parents('.bootbox').removeAttr('tabindex');
            $('.select').select2();
            $('#task_list').parents('.bootbox').removeAttr('tabindex');
            $('#task_list').select2();
            // Single picker
            $('#start_date').daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false
            }, function (ddate) {
                $('#start_date').val(ddate.format('DD-MM-YYYY'));
            });

            $('#end_date').daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false
            }, function (ddate) {
                $('#end_date').val(ddate.format('DD-MM-YYYY'));
            });
        });

        $.ajax({
            url: JS_BASE_URL + '/planning/milestone/',
            type: 'POST',
            data: {project_id: <?php echo $project_id?>},
            dataType: 'json',
            async: false,
            success: function (res) {
                if (res.status == 'Success') {
                    $.each(res.data, function (i, val) {
                        // console.log(val);
                        var name = "milestone["+val.milestone_id+"]";
                        var name2 = "uom["+val.milestone_id+"]";
                        $('input[name="'+name+'"]').prop('checked', true);
                        $('input[name="'+name+'"]').prop('disabled', true);
                        $('input[name="'+name+'"]').parent().addClass('checked');
                        $('input[name="'+name+'"]').parent().parent().addClass('disabled');
                        // $('input[name="'+name+'"]').addAttr;
                        $('input[name="'+name2+'"]').val(val.uom);
                    });

                }
            }
        });

        $('.add_milestone').on('click', function () {
            $('#modal_add_milestone').modal('show');
            $(".milestone").hide();
            $(".m1").show();

            $('#milestone_grup').on('change',function(){
                // console.log($(this).val());
                /*if ($(this).val == 'all') {
                    $(".miles").hide();
                    $(".tab").fadeIn('slow');
                } else {*/
                    $(".milestone").hide();
                    // $(".tab").hide();
                    var c = ".m" + $(this).val();
                    $(c).fadeIn('slow');
                // }
            });

            $(".item").change(function() {
                var e = $(this).attr('name');

                e = e.replace("milestone", "");
                e = e.replace("[", "");
                e = e.replace("]", "");

                var c = "#uom" + e;
                if(this.checked) {
                    $(c).prop('disabled', false);
                } else {
                    $(c).val("");
                    $(c).prop('disabled', true);
                }
            });
            
        });

        $('.add_value').on('click', function () {
            $('#modal_edit_value').modal('show');
            
        });

        // Start Dendy 27-03-2019
        $('.add_segment').on('click', function () {
            $("#modal_add_segment input[name='segment_id']").val('');
            $("#modal_add_segment input[name='segment_name']").val('');
            $("#modal_add_segment input[name='cluster']").val('');
            $('#modal_add_segment').modal('show');
            var option = "";
            $.ajax({
                url: JS_BASE_URL + '/planning/get_project_vendor/',
                type: 'POST',
                dataType: 'json',
                data: {id: <?php echo $project_id?>},
                async: false,
                success: function (res) {
                    $('#modal_add_segment #vendor_id').find('option').remove();
                    if (res.status == 'success') {
                        $.each(res.data, function(a, b){
                            option += '<option value = "'+b.id+'">'+b.vendor_name+'</option>';
                        })
                        $('#modal_add_segment #vendor_id').append(option);
                    }
                }
            });           
        });
        // End Dendy 27-03-2019

        // Start Dendy 27-03-2019
        $('#add_span').on('click', function(e) {
            e.preventDefault();            
            let trLength = $("#modal_edit_segment #segment-span").children().length;
            $("#modal_edit_segment #segment-span").append(`
                <tr class="segment-span-row">
                    <td>${trLength}.</td>
                    <td><input type="text" class="form-control" name="new_span[${trLength}][span_hh_start]"></td>
                    <td><input type="text" class="form-control" name="new_span[${trLength}][span_hh_end]"></td>             
                    <td><a href = "#" class = "delete_span"><i class = 'icon-trash-alt'></i></a></td>
                </tr>
            `);
        });
        // End Dendy 27-03-2019

        // Start Dendy 27-03-2019
        $('#modal_edit_segment').on('hidden.bs.modal', function (e) {
            let spanRow = $('#modal_edit_segment #segment-span').children();
            for (let i = 0; i < spanRow.length; i++) {
                if (i != 0) {
                    spanRow[i].remove();
                }
            }            
        });
        // End Dendy 27-03-2019

        // Start Dendy 27-03-2019
        $('#segment_form').submit(function(e){
            e.preventDefault();
            var form = $(this);
            
            $.ajax({
                url: JS_BASE_URL + '/planning/save_project_segment/',
                type: 'POST',
                dataType: 'json',
                data: form.serialize(),
                async: false,
                success: function (res) {
                    if (res.status == 'success') {
                        var table1 = $('.datatable-project-segment-list').dataTable();
                        alertSuccess();
                        $('#modal_add_segment').modal('toggle');
                        table1.api().ajax.reload();
                    }
                }
            });
        });
        // End Dendy 27-03-2019

        // Start Dendy 29-03-2019
        $('#modal_edit_segment #save-project-segment-span').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            $.ajax({
                url: JS_BASE_URL + '/planning/save_project_segment_span',
                type: 'POST',
                dataType: 'json',
                data: form.serialize(),
                async: false,
                success: function(res) {
                    if (res.status == 'success') {
                        $('#modal_edit_segment').trigger('hidden.bs.modal');
                        $.ajax({
                            url: JS_BASE_URL + "/planning/project_segment_detail/",
                            type: "POST",
                            data: { segment: $('#modal_edit_segment input[name="segment_id"]').val() },
                            dataType: "json",
                            async: false,
                            success: function(res) {
                                if (res.status == "success") {
                                    detail = res.data;                                      

                                    if (
                                        detail.span_id != null &&
                                        detail.span_hh_start != null &&
                                        detail.span_hh_end != null
                                    ) {
                                        let span_id = detail.span_id.split(",");
                                        let span_hh_start = detail.span_hh_start.split(",");
                                        let span_hh_end = detail.span_hh_end.split(",");

                                        if (span_hh_start.length == span_hh_end.length) {
                                        for (let i = 0; i < span_hh_start.length; i++) {
                                            $("#modal_edit_segment #segment-span").append(`
                                                <tr class="segment-span-row">
                                                <td>${i + 1}.</td>
                                                <td><input type="text" class="form-control" name="span[${span_id[i]}][span_hh_start]" value="${
                                                span_hh_start[i]
                                                }"></td>
                                                <td><input type="text" class="form-control" name="span[${span_id[i]}][span_hh_end]" value="${
                                                span_hh_end[i]
                                                }"></td>             
                                                <td><a href = "#" class = "delete_span" span_id="${
                                                    span_id[i]
                                                }"><i class = 'icon-trash-alt'></i></a></td>
                                                </tr>
                                            `);
                                        }
                                        }
                                    }
                                }
                            }
                        });
                    }
                    alertSuccess();
                }
            });
        });
        // End Dendy 29-03-2019

        // Start Dendy 29-03-2019
        $(document).on('click', '.delete_span', function() {
            var id = $(this).attr('span_id'),
                tr = $(this).parent().parent();

                
                var notice = new PNotify({
                    title: 'Confirmation',
                    text: '<p>Are you sure you want delete this span?</p>',
                    hide: false,
                type: 'info',
                confirm: {
                    confirm: true,
                    buttons: [
                        {
                            text: 'Yes',
                            addClass: 'btn btn-sm btn-primary'
                        },
                        {
                            addClass: 'btn btn-sm btn-link'
                        }
                    ]
                },
                buttons: {
                    closer: false,
                    sticker: false
                },
                history: {
                    history: false
                }
            })
            // On confirm
            notice.get().on('pnotify.confirm', function() {
                if (id == undefined) {
                    tr.remove();
                    return;                    
                }
                $.ajax({
                    url:  JS_BASE_URL +'/planning/delete_project_segment_span/',
                    type : 'POST',
                    dataType: 'json',
                    data: {id : id},
                    success: function(res) {                                       
                        alertDeleteSuccess();
                        tr.remove();

                        // Active this code if user want the number recreate from 1 after update
                        // $('#modal_edit_segment').trigger('hidden.bs.modal');
                        // $.ajax({
                        //     url: JS_BASE_URL + "/planning/project_segment_detail/",
                        //     type: "POST",
                        //     data: { segment: $('#modal_edit_segment input[name="segment_id"]').val() },
                        //     dataType: "json",
                        //     async: false,
                        //     success: function(res) {
                        //         if (res.status == "success") {
                        //         detail = res.data;
                        //         console.log(detail);                                
                        //             if (
                        //                 detail.span_id != null &&
                        //                 detail.span_hh_start != null &&
                        //                 detail.span_hh_end != null
                        //             ) {
                        //                 let span_id = detail.span_id.split(",");
                        //                 let span_hh_start = detail.span_hh_start.split(",");
                        //                 let span_hh_end = detail.span_hh_end.split(",");

                        //                 if (span_hh_start.length == span_hh_end.length) {
                        //                 for (let i = 0; i < span_hh_start.length; i++) {
                        //                     $("#modal_edit_segment #segment-span").append(`
                        //                     <tr class="segment-span-row">
                        //                     <td>${i + 1}.</td>
                        //                     <td><input type="text" class="form-control" name="span[${span_id[i]}][span_hh_start]" value="${
                        //                     span_hh_start[i]
                        //                     }"></td>
                        //                     <td><input type="text" class="form-control" name="span[${span_id[i]}][span_hh_end]" value="${
                        //                     span_hh_end[i]
                        //                     }"></td>             
                        //                     <td><a href = "#" class = "delete_span" span_id="${
                        //                         span_id[i]
                        //                     }"><i class = 'icon-trash-alt'></i></a></td>
                        //                     </tr>
                        //                 `);
                        //                 }
                        //                 }
                        //             }
                        //         }
                        //     }
                        //     });
                    }
                });
            })

            // On cancel
            notice.get().on('pnotify.cancel', function() {
                // alert('Oh ok. Chicken, I see.');
            });            
        });
        // End Dendy 29-03-2019

        $('.add_task_list').on('click', function () {
            bootbox.dialog({
                    title: "Add Task List",
                    message: '<div class="row">  ' +
                    '<div class="col-md-12">' +
                    '<form action="#" id = "task_list_form">' +
                    '<div class="form-group">' +
                    '<div class="row">' +
                    '<div class="col-sm-12">' +
                    '<label>Name the list of the tasks</label>' +
                    '<input type="text" placeholder="Task List Name" name = "task_list_name" class="form-control">' +
                    '<input type="hidden" name = "project_id"  value = "<?php echo $project_id?>" class="form-control">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Notes (Optional):</label>' +
                    '<textarea rows="4" name = "notes" cols="5" id = "task_list_notes" placeholder="Notes" class="form-control"></textarea>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Parent Task List</label>' +
                    '<select name="" data-placeholder="Select milestone" class="select">' +
                    '<option value="">No Milestone</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Attach Task Lisk to Milestone (Optional)</label>' +
                    '<select name="milestone_id" data-placeholder="Select milestone" class="select">' +
                    '<option value="">No Milestone</option>' +
                    '</select>' +
                    '</div>' +

                    '</form>' +
                    '</div>' +
                    '</div>',
                    buttons: {
                        success: {
                            label: "Add Task List",
                            className: "btn-success",
                            callback: function () {
                                var form = $('#task_list_form');
                                $.ajax({
                                    url: JS_BASE_URL + '/planning/saveTaskList',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: form.serialize(),
                                    success: function (res) {
                                        console.log(res);
                                        if (res.status == 'Success') {
                                            window.location.replace(JS_BASE_URL + '/planning/id/<?php echo $project_id?>');
                                        }
                                    }
                                });

                            }
                        }
                    }
                }
            );

            $('.select').parents('.bootbox').removeAttr('tabindex');
            $('.select').select2();

            // Single picker
            $('.daterange-single').daterangepicker({
                singleDatePicker: true,

            });
        });

        $('.add_user').on('click', function(){
            $('#modal_add_resource').modal('show');

            $("#position_id").change(function () {
                    $("#users_id").select2();
                    $("#users_id").val("").trigger("change");
                    $("#users_id option:disabled").removeAttr('disabled').trigger("change");;
                    var position = $("#position_id").val(),
                        project = $("#project_id").val();
                    $.ajax({
                        url: JS_BASE_URL + '/resource/position_project/',
                        type: 'POST',
                        dataType: 'json',
                        data: {position_id: position, project_id: project},
                        async: false,
                        success: function (res) {
                            if (res.status == 'success') {
                                var a = [];
                                $.each(res.data, function (index, val) {
                                    $('#users_id option[value="'+val.user_id+'"]').attr("disabled", true).trigger("change");
                                });

                               /* $("#users_id").select2();
                                $("#users_id").val(a).trigger("change");*/
                            }
                        }
                    });
                });
        });


        $('#edit_resource_from').submit(function(e){
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: JS_BASE_URL + '/resource/update_allocation/',
                type: 'POST',
                dataType: 'json',
                data: form.serialize(),
                async: false,
                success: function (res) {
                    if (res.status == 'success') {
                        var table1 = $('.datatable-people-list').dataTable();
                        alertSuccess();
                        $('#modal_edit_resource').modal('toggle');
                        table1.api().ajax.reload();
                    }
                }
            });
        });

        $('.delete_milestone').on('click', function (){
            var id = $(this).attr('mls_id'),
                elem = $(this).parent().parent(),
                mil = "#mil_"+id;

            console.log(elem);
            var notice = new PNotify({
                title: 'Confirmation',
                text: '<p>Are you sure you want delete this milestone?</p>',
                hide: false,
                type: 'info',
                confirm: {
                    confirm: true,
                    buttons: [
                        {
                            text: 'Yes',
                            addClass: 'btn btn-sm btn-primary'
                        },
                        {
                            addClass: 'btn btn-sm btn-link'
                        }
                    ]
                },
                buttons: {
                    closer: false,
                    sticker: false
                },
                history: {
                    history: false
                }
            })

            // On confirm
            notice.get().on('pnotify.confirm', function() {
                $.ajax({
                    url:  JS_BASE_URL +'/planning/delete_milestone/',
                    type : 'POST',
                    dataType: 'json',
                    data: {id : id},
                    success: function(res) {
                        alertSuccess();
                        elem.remove();
                        $(mil).remove();
                    }
                });
            })

            // On cancel
            notice.get().on('pnotify.cancel', function() {
                // alert('Oh ok. Chicken, I see.');
            });
        });


        $('.add_vendor').on('click', function () {
            $('#project_vendor_id').val('');
            $("#vendor_id").val('').trigger("change");
            $("#scope_id").val('').trigger("change");
            $('#modal_add_vendor').modal('show');
            
        });

        // Start Dendy 20-03-2019
        $('.upload-project-charter').on('click', function () {
            $('#modal_upload_project_charter').modal('show');
        });
        // End Dendy 20-03-2019

        // Start Dendy 26-03-2019
        $('.upload-project-kmz').on('click', function () {
            $('#modal_upload_project_kmz').modal('show');
        });
        // End Dendy 26-03-2019

        $('#vendor_form').submit(function(e){
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: JS_BASE_URL + '/planning/save_project_vendor/',
                type: 'POST',
                dataType: 'json',
                data: form.serialize(),
                async: false,
                success: function (res) {
                    if (res.status == 'success') {
                        var table1 = $('.datatable-project-vendor-list').dataTable();
                        alertSuccess();
                        $('#modal_add_vendor').modal('toggle');
                        table1.api().ajax.reload();
                    }
                }
            });
        });

        // Start Dendy 20-03-2019
        $('#project_charter_form').submit(function(e){
            e.preventDefault();
            var form = $(this);       
            $.ajax({
                url: JS_BASE_URL + '/planning/upload_project_charter/',
                type: 'POST',
                dataType: 'json',
                data: new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                async: false,
                success: function (res) {
                    if (res.status == 'success') {
                        var table1 = $('.datatable-project-charter-list').dataTable();
                        alertSuccess();
                        $('#modal_upload_project_charter').modal('toggle');
                        table1.api().ajax.reload();
                        $(`#modal_upload_project_charter input[name="project_charter_file"]`).val('');
                    }else{
                        new PNotify({
                            title: 'Warning',
                            text: res.status,
                            addclass: 'bg-danger'
                        });
                    }
                }
            });
        });
        // End Dendy 20-03-2019

        // Start Dendy 26-03-2019
        $('#project_kmz_form').submit(function(e){
            e.preventDefault();
            var form = $(this);       
            $.ajax({
                url: JS_BASE_URL + '/planning/upload_project_kmz/',
                type: 'POST',
                dataType: 'json',
                data: new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                async: false,
                success: function (res) {
                    if (res.status == 'success') {
                        var table1 = $('.datatable-project-kmz-list').dataTable();
                        alertSuccess();
                        $('#modal_upload_project_kmz').modal('toggle');
                        table1.api().ajax.reload();
                        $(`#modal_upload_project_kmz input[name="project_kmz_file"]`).val('');
                    }else{
                        new PNotify({
                            title: 'Warning',
                            text: res.status,
                            addclass: 'bg-danger'
                        });
                    }
                }
            });
        });
        // End Dendy 26-03-2019


        CallbackProject();
    });

</script>
