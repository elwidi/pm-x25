<script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/visualization/c3/c3.min.js"></script>


<div class="panel panel-white">
    <input type="hidden" id="project_id" value="<?php echo $project_id ?>" class="form-control">
    <ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">
        <li class="<?php echo ($active_tab == '')?  "active": "" ?>"><a href="#project-overview" data-toggle="tab" aria-expanded="true"><i
                    class="icon-menu7 position-left"></i> Overview</a></li>
        <li class=""><a href="#project-tasks" data-toggle="tab" aria-expanded="false"><i
                    class="icon-stack4 position-left"></i> Tasks</a></li>
        <li class="<?php echo ($active_tab == 'milestone')?  "active": ""?>"><a href="#project-milestones" data-toggle="tab" aria-expanded="false"><i
                    class="icon-flag8 position-left"></i> Milestones</a></li>
        <li class="<?php echo ($active_tab == "team")?  "active": ""?>"><a href="#project-people" data-toggle="tab" aria-expanded="false"><i
                    class="icon-people position-left"></i> Project Team</a></li>

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
                            <div class="form-group">
                                <label class="col-lg-2 control-label text-semibold">Project Name:</label>
                                <div class="col-lg-9">
                                    <div class="form-control-static"><?php echo $project->project_name?></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label text-semibold">Project Company:</label>
                                <div class="col-lg-9">
                                    <div class="form-control-static"><?php echo $project->company?></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label text-semibold">Customer:</label>
                                <div class="col-lg-9">
                                    <div class="form-control-static"><?php echo $project->customer_name?></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label text-semibold">Leader:</label>
                                <div class="col-lg-9">
                                    <div class="form-control-static"><?php echo $project->leader?></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label text-semibold">Completion:</label>
                                <div class="col-lg-9">
                                    <div class="form-control-static"><?php echo $project->completion."%"?></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label text-semibold">Km Cable:</label>
                                <div class="col-lg-9">
                                    <div class="form-control-static"></div>
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
                <h4>Tasks</h4>

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
                                    <td class="text-center"><?php echo number_format($v->qty);?></td>
                                    <td class="text-center"><?php echo number_format($v->daily_baseline);?></td>
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br/>

                <div class = "col-md-12 mt-20">
                    <form action="/index.php/planning/save_plan/" method="post" class="form-horizontal" id = "project_plan_form">
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered" style="font-weight: bold;">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="hidden" name="project_id" value = <?php echo $project->id?>></th>
                                    <?php foreach ($project_gap as $mth) { ?>
                                        <th class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;"><?php echo $mth['month']?></th>
                                    <? } ?>
                                    <!--    <th colspan="2" class="text-center">PREVIOUS</th>
                                    <th colspan="2" class="text-center">PROGRESS</th>
                                    <th colspan="2" class="text-center">COMPLETE</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <th class="text-center" >Plan</th>
                                <?php foreach ($project_gap as $key => $mth) { ?>
                                    <th class="text-center">
                                        <input type="hidden" name="plan[<?php echo $key?>][date]" value = "<?php echo strtolower($mth['month'])."_".$mth['year']?>">
                                        <input type="hidden" name="plan[<?php echo $key?>][id]" id = "id_<?php echo strtolower($mth['month'])."_".$mth['year']?>">
                                        <input type="number" step = "0.01" id = "plan_<?php echo strtolower($mth['month'])."_".$mth['year']?>" class = "form-control" name="plan[<?php echo $key?>][plan]">
                                    </th>
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
                                    <td><?php echo $v->milestone_name?></td>
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
                                    <td> <input type="text" class = "form-control" name = value[<?php echo $v->id?>][qty] value = "<?php echo $v->qty?>"></td>
                                    <td><input type="text" class = "form-control" name = value[<?php echo $v->id?>][baseline] value = "<?php echo $v->daily_baseline?>"></td>
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
                <h5 class="modal-title">Allocate Resource to Project</h5>
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



<script type="text/javascript">
    $(function () {
        $.ajax({
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
                                res.data.cum_baseline,
                                res.data.cum_actual
                            ],
                            type: 'bar',
                            types: {
                                'Cum. Baseline': 'line',
                                'Cum. Actual': 'line',
                            },
                            axes: {
                                'Baseline': 'y',
                                'Actual': 'y',
                                'Cum. Baseline' :'y2',
                                'Cum. Actual' :'y2'
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
                                categories: res.data.date,
                                /*tick: {
                                    rotate: 45,
                                    multiline: false
                                },
                                height: 130*/
                            }
                        },
                        grid: {
                            y: {
                                show: true
                            }
                        },
                        /*legend: {
                            show: false
                        }*/
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
        });

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

        CallbackProject();
        // $('.add_user').on('click', function () {
        //     var option = "";
        //     $.ajax({
        //         url: JS_BASE_URL + '/projects/getPeopleNotInProject/' +<?php echo $project_id?>,
        //         type: 'GET',
        //         dataType: 'json',
        //         async: false,
        //         success: function (res) {
        //             if (res.status == 'Success') {
        //                 console.log(res.data);
        //                 $.each(res.data, function (i, val) {
        //                     option += '<option value="' + val.id + '">' + val.name + '</option> ';
        //                 });
        //             }
        //         }
        //     });
        //     bootbox.dialog({
        //             title: "Add people to this project",
        //             message: '<div class="row">  ' +
        //             '<div class="col-md-12">' +
        //             '<form action="#" id = "task_list_form">' +
        //             '<div class="form-group">' +
        //             '<input type="hidden" name = "project_id"  value = "<?php echo $project_id?>" class="form-control">' +
        //             '<select name="team[]" data-placeholder="Select people" class="select" multiple = "multiple">' +
        //             '<option value="">No Milestone</option>' +
        //             option +
        //             '</select>' +
        //             '</div>' +
        //             '</form>' +
        //             '</div>' +
        //             '</div>',
        //             buttons: {
        //                 success: {
        //                     label: "Add people",
        //                     className: "btn-success",
        //                     callback: function () {
        //                         var form = $('#task_list_form');
        //                         $.ajax({
        //                             url: JS_BASE_URL + '/projects/addUser',
        //                             type: 'POST',
        //                             dataType: 'json',
        //                             data: form.serialize(),
        //                             success: function (res) {
        //                                 /*if(res.status == 'Success'){
        //                                  window.location.replace(JS_BASE_URL +'/projects/all');
        //                                  }*/
        //                             }
        //                         });

        //                     }
        //                 }
        //             }
        //         }
        //     );

        //     $('.select').parents('.bootbox').removeAttr('tabindex');
        //     $('.select').select2();

        //     // Single picker
        //     $('.daterange-single').daterangepicker({
        //         singleDatePicker: true,

        //     });
        // });

    });

</script>