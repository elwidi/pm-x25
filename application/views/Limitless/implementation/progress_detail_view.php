<script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/editors/summernote/summernote.min.js"></script>
<div class="panel panel-white">
    <input type="hidden" id="project_id" value="<?php echo $project_id ?>" class="form-control">
    <ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">
        <li class="<?php echo ($active_tab == '')?  "active": ""?>"><a href="#project-tasks" data-toggle="tab" aria-expanded="false"><i
                    class="icon-stack4 position-left"></i> Tasks and Assignment</a></li>
        <li class="<?php echo ($active_tab == 'daily_progress')?  "active": ""?>"><a href="#project-daily" data-toggle="tab" aria-expanded="false"><i
                    class="icon-stats-growth2"></i> Daily Progress Report</a></li>
        <li class="<?php echo ($active_tab == "team")?  "active": ""?>"><a href="#project-segmen" data-toggle="tab" aria-expanded="false"><i
                    class="icon-git-branch"></i> Detail Scope</a></li>
        <li class="<?php echo ($active_tab == "vendor")?  "active": ""?>"><a href="#project-cr" data-toggle="tab" aria-expanded="false"><i
                    class="icon-loop"></i> Change Request</a></li>
        <li class="<?php echo ($active_tab == "vendor")?  "active": ""?>"><a href="#project-doc" data-toggle="tab" aria-expanded="false"><i
                    class="icon-archive"></i> Document Library</a></li>
        <li class="<?php echo ($active_tab == "vendor")?  "active": ""?>"><a href="#project-steerco" data-toggle="tab" aria-expanded="false"><i
                    class="icon-folder-upload2"></i> Upload Steering Commitee</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade <?php echo ($active_tab == '')? "active in" : ""?>" id="project-tasks">
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
        <div class="tab-pane fade <?php echo ($active_tab == 'daily_progress')? "active in" : ""?>" id="project-daily">
            <div class="panel-body" style="padding-top: 0">
                <h4>Daily Progress Report</h4>
                <div class="heading-elements">
                </div>

                <div class="col-md-12">
                    <form action="/index.php/implementation/save_progress/" method="post" class="form-horizontal">
                        <div class = "col-md-9">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Baseline</label>
                                <div class="col-lg-2">
                                    <input type = "hidden" name = "project_id" id = "project_id" value = "<?php echo $project_id?>">
                                    <input type="number" class="form-control bc" name = "baseline" id = "baseline" step= "0.01">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Completion</label>
                                <div class="col-lg-2">
                                    <!-- <input type="text" class="form-control" name = "area"> -->
                                    <input type="number" class="form-control bc" name = "completion" id = "completion" step= "0.01">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">GAP</label>
                                <div class="col-lg-2">
                                    <!-- <input type="text" class="form-control" name = "area"> -->
                                    <input type="text" class="form-control disabled" id = "gap" disabled="disabled">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-framed table-xs" id="jjj" style="font-weight: bold;">
                                    <thead class="bg-info-800">
                                    <tr>
                                        <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">ACTIVITY</th>
                                        <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">SCOPE</th>
                                        <th rowspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">DAILY BASELINE</th>
                                        <th colspan="2" class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">COMPLETE</th>
                                    </tr>

                                    <tr>
                                        <th class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">UOM</th>
                                        <th class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">Qty</th>
                                        <th class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">Qty</th>
                                        <th class="text-center" style="background-color: rgb(31,78,120);color:#ffffff;">%</th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <br/>
                            <div class="form-group mt-10"> 
                                <div class="row">
                                    <div class="col-sm-12"> 
                                        <label class="text-semibold">Important Remark</label>
                                        <textarea class="form-control" name = "remark" id = "remark"></textarea>
                                    </div>
                                </div> 
                            </div>

                            <div class="table-responsive m-10">
                            <table class="table table-condensed table-bordered" style="font-weight: bold;" id = "project_chart">
                                <thead>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                            <!-- <div class="text">
                                <button type="button" id = "row" class="btn btn-primary btn-labeled btn-xs"><b><i class = "icon-plus3"></i></b>Add Date</button>
                            </div> -->
                            <!-- <div class="table-responsive m-10">
                                <table class="table table-bordered table-striped table-xs" id = "table_chart">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Plan</th>
                                            <th>Actual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <td><input type="text" name="chart[0][date]" class="form-control date"></td>
                                            <td><input type="number" name="chart[0][plan]" step = "0.01" class="form-control"></td>
                                            <td><input type="number" name="chart[0][actual]" step = "0.01" class="form-control"></td>
                                    </tbody>
                                </table>
                            </div> -->
                            <div class="text">
                                <button type="submit" id = "sbmt" class="btn btn-primary" disabled>Submit</button> &nbsp; &nbsp;
                            </div>
                        </div>
                </div>
            </div>  
        </div>

        <div class="tab-pane fade <?php echo ($active_tab == 'vendor')? "active in" : ""?>" id="project-segmen">
            <div class="panel-body" style="padding-top: 0">
                <h4>Detail Scope</h4>

                <div class="heading-elements">
                </div>
            </div>
        </div>

        <div class="tab-pane fade <?php echo ($active_tab == 'project-charter')? "active in" : ""?>" id="project-cr">
            <div class="panel-body" style="padding-top: 0">
                <h4>Change Request</h4>

                <div class="heading-elements">
                </div>
            </div>
        </div>

        <div class="tab-pane fade <?php echo ($active_tab == 'pip')? "active in" : ""?>" id="project-doc">
            <div class="panel-body" style="padding-top: 0">
                <h4>Document Library</h4>

            </div>

        </div>
        <div class="tab-pane fade <?php echo ($active_tab == 'pip')? "active in" : ""?>" id="project-steerco">
            <div class="panel-body" style="padding-top: 0">
                <h4>Upload Steering Document</h4>

            </div>

        </div>
    </div>
</div>


<script type="text/javascript">
    $(function () {
        var project_id = $('#project_id').val();
        $.ajax({
            url: JS_BASE_URL + '/implementation/project_milestone/',
            type: 'POST',
            dataType: 'json',
            data : {project : project_id},
            async: false,
            success: function (res) {
                if(res.status == 'Success'){
                    $('#sbmt').removeAttr('disabled');
                    var row = "";
                    var l = 0;
                    $.each(res.data, function( index, val ) {
                        row += '<tr class = "embed"><td colspan = "7" class = "text-semibold" style="background-color: rgb(0,0,0);color:#ffffff;">'+index+'</td></tr>';
                        $.each(val, function( i, d ) {
                            row += '<tr class = "embed"><td>'+d.milestone_name+'</td><td style="text-align: center;">'+d.uom+'</td><td style="text-align: center;">'+d.qty+'</td><td style="text-align: center;">'+d.daily_baseline+'</td>';
                            project_id = d.pr_id;
                            completion = d.completion;
                            if(d.ms_value !== null){
                                remark = d.ms_value.remark;
                                row += '<td><input type = "hidden" name = "milestone['+l+'][id]" value ="'+d.id+'"><input type = "hidden" name = "milestone['+l+'][prev_qty]" value ="'+d.ms_value.complete_qty+'"><input type = "hidden" id = "baseline'+l+'" value ="'+d.qty+'"><input type = "number" class = "quantity form-control" id = "qty'+l+'" name = "milestone['+l+'][qty]" placeholder = "'+d.ms_value.complete_qty+'" step= "0.01"></td>';
                                row += '<td><input type = "hidden" name = "milestone['+l+'][prev_percent]" value ="'+d.ms_value.complete_percent+'"><input type = "text" class = "form-control" name = "milestone['+l+'][percent]" id = "percent'+l+'" placeholder = "'+d.ms_value.complete_percent+'" readonly></td>';
                            } else {
                                row += '<td><input type = "hidden" name = "milestone['+l+'][id]" value ="'+d.id+'"><input type = "hidden" id = "baseline'+l+'" value ="'+d.qty+'"><input type = "text" class = "quantity form-control" placeholder = "0" name = "milestone['+l+'][qty]" id = "qty'+l+'"></td>';
                                row += '<td><input type = "text" class = "form-control" name = "milestone['+l+'][percent]" id = "percent'+l+'" placeholder = "0"></td>';
                            }
                            row += '</tr>';
                            l++;
                        });
                    });

                    $('#project_id').val(project_id);
                    $('#remark').val(remark);
                    $('#completion').val(completion);
                    $('#remark').summernote();
                    
                    $('.tabs').show();
                    $("#jjj tbody").append(row);

                    $('.quantity').keyup(function(){
                        var nilai = $(this).val();
                        var qty = $(this).attr('id');
                        var prc = "#"+qty.replace('qty','percent');
                        var bl = "#"+qty.replace('qty','baseline');
                        var scope = $(bl).val();
                        var a = scope.replace(",","");
                        var percent = nilai/a*100;
                        var head = percent.toString().split(".");

                        percent = percent.toPrecision(3);

                        $(prc).val(percent);
                    });

                    $.ajax({
                        url: JS_BASE_URL + '/planning/months_json/',
                        type: 'POST',
                        data: {id: project_id},
                        dataType: 'json',
                        async: false,
                        success: function (res) {
                            var header;
                            header = "<tr class = 'dstr'>";
                            header += "<td>Month</td>";

                            $.each(res, function (i, val) {
                                header += "<td style='background-color: rgb(31,78,120);color:#ffffff;'>"+val.month+"</td>";
                            });
                            header += "</tr>";

                            var plan;
                            plan = "<tr class = 'dstr'>";
                            plan += "<td>Plan</td>";

                            $.each(res, function (i, val) {
                                idS = val.month.toLowerCase()+"_"+val.year;
                                plan += "<td><span id='plan_"+idS+"'></td>";
                            });
                            plan += "</tr>";

                            plan += "<tr class = 'dstr'>";
                            plan += "<td>Actual</td>";

                            $.each(res, function (i, val) {
                                idS = val.month.toLowerCase()+"_"+val.year;
                                plan += "<td><span id='actual_"+idS+"'></td>";
                            });
                            plan += "</tr>";

                            $("#project_chart thead").append(header);
                            $("#project_chart tbody").append(plan);
                            $.ajax({
                                url: JS_BASE_URL + '/planning/get_plan/',
                                type: 'POST',
                                data: {id: project_id},
                                dataType: 'json',
                                async: false,
                                success: function (res) {
                                    if (res.status == 'Success') {
                                        console.log(res.data);
                                        $('#baseline').val(res.data.month_plan);
                                        gap = res.data.month_plan - res.data.month_actual;
                                        if(gap < 10){
                                            gap = gap.toPrecision(3);
                                        } else {
                                            gap = gap.toPrecision(3);
                                        }

                                        if(gap == "NaN"){
                                            $('#gap').val(0);
                                        } else {
                                            $('#gap').val(gap);
                                        }

                                        $.each(res.data.all, function (i, val) {
                                            var id_plan = "#plan_"+val.month.toLowerCase()+"_"+val.year;
                                            var id_act = "#actual_"+val.month.toLowerCase()+"_"+val.year;

                                            $(id_plan).html(val.plan);
                                            $(id_act).html(val.actual);
                                        });

                                    } else {

                                    }
                                }
                            });
                        }
                    });
                }
                else {
                    $('.tabs').hide();
                }
            }
        });
    });

    $( ".bc" ).change(function() {
        var baseline = $('#baseline').val();
        var completion = $('#completion').val();

        var e = baseline - completion;
        e = e.toPrecision(4);
        $('#gap').val(e);
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

    $('.add_task').on('click', function () {
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

</script>

