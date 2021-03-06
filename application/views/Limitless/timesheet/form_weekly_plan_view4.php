<!-- Bordered striped table -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Input Weekly Plan</h5>

        <div class="heading-elements">
            <div class="btn-group">
                <button type="button" id="assign_fi" class="btn bg-info-800 btn-labeled btn-labeled-left"
                        aria-expanded="false"><b><i class="icon-tree5"></i></b>Assign Field Inspector
                </button>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <div class="panel-body" style="padding-top: 0">

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <form action="/index.php/timesheet/save_plan/" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Project</label>

                                <div class="col-lg-8">
                                    <!-- <input type="text" class="form-control" name = "area"> -->
                                    <select class="select ymmd" id="project" name="project" data-placeholder="Select Project...">
                                        <option value=""></option>
                                        <?php foreach ($projects as $key => $value) { ?>
                                            <option
                                                value="<?php echo $value->id ?>"><?php echo $value->project_name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php if($userRole[0] <= 3) { ?>
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Project Coordinator</label>

                                <div class="col-lg-8">
                                    <select class="select ymmd" name="coordinator_id" id="pc_id" data-placeholder="Select Project Coordinator...">
                                        <option value=""></option>
                                        <?php foreach ($coordinator as $key => $value) { ?>
                                            <option
                                                value="<?php echo $value->user_id ?>"><?php echo $value->fullname ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php } ?>


                            <div class="form-group">
                                <label class="col-lg-4 control-label">Start</label>

                                <div class="col-lg-4">
                                    <input type="text" class="form-control daterange-single ymmd" name="start"
                                           value="<?php echo date('d-m-Y', strtotime('monday this week')) ?>" id="start">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 control-label">End</label>

                                <div class="col-lg-4">
                                    <input type="text"
                                           value="<?php echo date('d-m-Y', strtotime("+6 day", strtotime('monday this week'))); ?>"
                                           class="form-control daterange-single ymmd" name="end" id="end">
                                </div>
                            </div>
                            <div class="text">
                                <button type="button" class="btn bg-info-800" id="apply_set_2">Create weekly Plan</button>
                                 <button type="submit" name="submit_form" value="true" class="btn btn-primary submit hidden">Save</button>
                                &nbsp; &nbsp;
                            </div>
                            <br/>


                    </div> 

                    <div class = "col-md-6">
                        <?php if($userRole[0] == 5 or $userRole[0] ==1 ) {?>
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <span class="panel-title">Field Inspector </span>
                            </div>
                            <div class = "panel-body">
                                <div id="waspang_display"></div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="tabs table-responsive"></div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <div id="modal_assign_fi" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Assign Field Inspector</h5>
                </div>

                <div class="modal-body ">
                    <div class="col-md-12">
                        <form method="POST" action="/index.php/administration/save_parent/" id="assign_fi_form"
                              enctype="multipart/form-data" class="form-validate-jquery">
                            <?php if($userRole[0] <= 3) { ?>

                            <div class="form-group mt-10">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Project Coordinator</label>
                                        <select id="pcid" name="pcid" data-placeholder="Select Project Coordinator"
                                                class="select dgb" required="required">
                                            <option value=""></option>
                                            <?php foreach ($coordinator as $key => $value) { ?>
                                            <option value="<?php echo $value->user_id ?>"><?php echo $value->fullname ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <div class="form-group mt-10">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-lg-2 control-label">Project</label>
                                        <select class="select dgb" name="project_id" id="project_id">
                                            <option value=""></option>
                                            <?php foreach ($projects as $key => $value) { ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->project_name ?></option>  
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-10">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="col-lg-2 control-label">Area</label>
                                        <select class="select dgb" name="areaid[]" id="areaid[]" multiple>
                                            <option value=""></option>
                                            <?php foreach ($work_location as $key => $value) { ?>
                                            <option value="<?php echo $value->location_id ?>"><?php echo $value->location ?></option>  
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-10">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Field Inspector</label>
                                        <select id="fi_id" name="fi_id[]" data-placeholder="Select Filed Inspector"
                                                class="select" required="required" multiple="multiple"
                                                style="height: 500;">
                                            <?php foreach ($users as $value) { ?>
                                                <option
                                                    value="<?php echo $value->user_id ?>"><?php echo $value->fullname ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit_form" value="true" class="btn btn-primary">Save</button>
                </div>

                
                </form>
            </div>
        </div>
    </div>

    <div id="modal_create_plan" class="modal fade">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Weekly Plan</h5><span id = "user_name"></span>
                </div>
                <div class="modal-body">
                    <div class="col-md-12"> 
                        <form method = ""  action= "" id = "weekly_plan_form" enctype="multipart/form-data" > 
                              <div class="form-group"> 
                                   <div class="row">
                                        <div class="col-sm-1">
                                              <button type = "button" class="btn bg-teal-800 btn-s" id = "addPlan">Add Plan</button>
                                        </div>

                                   </div>
                              </div>
                              <div class="row mb-20">
                                <input type = "hidden" id = "plan_user_id" name = "plan_user_id">
                                <input type = "hidden" id = "user_location" name = "plan_location">
                                <input type = "hidden" id = "plan_project_id" name = "plan_project_id">
                                <input type = "hidden" id = "plan_start_date" name = "plan_start_date">
                                <input type = "hidden" id = "plan_end_date" name = "plan_end_date">
                                <input type = "hidden" id = "plan_pc_id" name = "plan_pc_id">
                                <div class = "table-responsive">
                                    <table id = "table_plan2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <td width="200px">Tanggal</td>
                                                <td width="200px">Time</td>
                                                <td>Plan Description</td>
                                                <td width="200px">Segmen</td>
                                                <td width="200px">Span</td>
                                                <td width="200px">Target</td>
                                                <td>UoM</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id = "loading-image"><h5>Loading</h5></div>
                    </div>
                </div>
                <br/>
                <br/>
                <div class="modal-footer">
                    <!-- <button type="button" id = "finalClose" value = "true" class="btn btn-danger">Close</button> -->
                    <button type="submit" name = "submit_followup" value = "true" class="btn btn-primary">Posting</button>
                </div>
                </form> 
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            var segment = [];
            var span = [];
            $("#project").change(function(){
                getWaspang();
            });

            $("#pc_id").change(function(){
                getWaspang();
            })

            function getWaspang(){
                var project_id = $('#project').val();
                var pc_id = $("#pc_id").val();
                $.ajax({
                    url: JS_BASE_URL + '/timesheet/get_waspang_team/',
                    type: 'POST',
                    dataType: 'json',
                    data: {project_id: project_id, pc_id : pc_id},
                    async: false,
                    success: function (res) {
                        console.log(res);
                        $('.list-waspang').remove();
                        var people = "";
                        if(res.status=='success'){
                            people += '<ul style = "float: left;" class = "list-waspang">';
                            $.each(res.data, function(p, n){
                                people += '<li>'+n.fullname+'</list>'
                            })

                        } else {
                            people = '<span>Please assign field inspector first</span>';
                        }

                        $('#waspang_display').html(people);

                    }
                });
            }


            $('#segmen_ids').change(function(){
                var segmen_ids = $(this).val();
                var $span = $('#span_ids');
                $span.find('option').remove().end()
                $span.removeAttr('disabled');
                $.ajax({
                    url: JS_BASE_URL + '/planning/segmen_span/',
                    type: 'POST',
                    dataType: 'json',
                    data: {ids: segmen_ids},
                    async: false,
                    success: function (res) {
                        if(res.status == 'Success'){
                            var option = "";
                            $.each(res.data, function(index,val){
                                option += '<option value = "'+val.id+'">['+val.segment_name+'] '+val.span_hh_start+'-'+val.span_hh_end+'</option>';
                                // span.push(val.id);
                            })
                            span = res.data;
                            $span.append(option);
                        } else {
                            $span.find('option').remove().end()
                        }
                    }
                }); 
            });

            $('#apply_set').click(function(){
                $('.prsn').remove();
                $('.submit').removeClass('hidden');
                var row = "",
                    area_id = $("#area_ids").val(),
                    start = $("#start").val(),
                    end = $("#end").val();
                    pc_id = $("#pc_id").val(),
                    segmen_ids = $("#segmen_ids").val(),
                    span_ids = $("#span_ids").val(),
                    project_id = $("#project").val();
                    project_id = $("#project").val();

                var $e = $(".prm:checked");
                // console.log($e);
                var dt=[];
                var vendor_option = "";
                var segment_option = "";
                var vendor_arr = [];
                // console.log(segment);
                $.ajax({
                    url: JS_BASE_URL + '/timesheet/dateRange/',
                    type: 'POST',
                    dataType: 'json',
                    data: {start: start, end: end},
                    async: false,
                    success: function (res) {
                        // h_total = res;
                        $.each(res, function (index, value) {
                            dt.push(moment(value).format('YYYY-MM-DD'));
                        });
                    }
                });

                $.ajax({
                    url: JS_BASE_URL + '/planning/project_vendor/',
                    type: 'POST',
                    dataType: 'json',
                    data: {project_id : project_id},
                    async: false,
                    success: function (res) {
                        if(res.status === 200 ){
                            vendor_arr = res.data;
                            $.each(vendor_arr, function (index, value) {
                                vendor_option += '<option value = "'+value.vendor_id+'">'+value.vendor_name+'</option>';
                            });
                        }
                    }
                });

                $.each(segment, function (index, value) {
                    var idx = segmen_ids.indexOf(value.id);
                    if(idx >= 0){
                        segment_option += '<option value = "'+value.id+'">'+value.segment_name+'</option>';

                    }
                });

                var param = [];
                $(".prm:checked").each(function( index ) {
                    a = {};
                    a['nama'] = $(this).attr('param_name');
                    a['id'] = $(this).attr('param_id');
                    a['uom'] = $(this).attr('uom');
                    param.push(a);
                });


                

                $.ajax({
                    url: JS_BASE_URL + '/timesheet/load_daily_plan/',
                    type: 'POST',
                    dataType: 'json',
                    data: {project_id: project_id, pc : pc_id, area: area_id, start : start, end:end},
                    async: false,
                    success: function (res) {
                        if(res.status == 'success'){
                            $.each(res.data, function (index, area) {
                                var row = "";
                                $.each(area, function(key, person){
                                    // console.log(key);
                                    row += '<div class = "row prsn">';
                                    row += '<h5>'+person.fullname+'</h5>';
                                    var existing_plan = person.existing_plan;

                                    
                                    // if(existing_plan.length == 0){
                                        $.each(dt, function(k, v){
                                            var table = '';
                                            var l = 0;
                                            $.each(span_ids, function(i, v){
                                                table +='<table class="table table-bordered table-striped table-xs hidden person_'+person.user_id+' param_'+v+'">'+
                                                        '<thead>'+
                                                        '<tr>'+
                                                        '<th>Parameter</th>'+
                                                        '<th>Target</th>'+
                                                        '<th>UOM</th>'+
                                                        '</tr>'+
                                                        '</thead>'+
                                                        '<tbody>';
                                                var l = 0;
                                                $.each(param, function(j, p){
                                                    // console.log(l);
                                                    table += '<tr>'+
                                                            '<td><input type="text" class="form-control" name = "p['+index+']['+key+']['+k+'][prog]['+v+']['+l+'][parameter_name]" value = "'+p.nama+'" readonly><input type="hidden" class = "segmen_thats_'+v+'" name = "p['+index+']['+key+']['+k+'][prog]['+v+']['+l+'][segmen]"><input type="hidden" name = "p['+index+']['+key+']['+k+'][prog]['+v+']['+l+'][span]" value = "'+v+'"></td>'+
                                                            '<td><input type="hidden" name = "p['+index+']['+key+']['+k+'][prog]['+v+']['+l+'][parameter_id]" value = "'+p.id+'"><input type="text" class="form-control" name = "p['+index+']['+key+']['+k+'][prog]['+v+']['+l+'][target]"></td>'+
                                                            '<td><input type="text" class="form-control" name = "p['+index+']['+key+']['+k+'][prog]['+v+']['+l+'][uom]" value = "'+p.uom+'" readonly></td>'+
                                                            '</tr>';
                                                        l++;
                                                })      
                                                // table += 
                                                table += '</tbody></table>';
                                            })

                                            row += '<div class="col-md-3 ">'+
                                                '<div class="panel panel-flat">'+
                                                '<div class="panel-heading">'+
                                                '<h5 class="panel-title">'+moment(v).format('dddd, D-MM-YYYY')+'</h5>'+
                                                '</div>'+
                                                '<div class="panel-body">'+
                                                '<div class="form-group">'+
                                                '<label>Working Hours:</label>'+
                                                '<input type="hidden" name = "p['+index+']['+key+']['+k+'][id]" value = "'+person.user_id+'">'+
                                                '<input type="hidden" name = "p['+index+']['+key+']['+k+'][date]" value = "'+v+'">'+
                                                '<input type="text" class="form-control daterange-time" name = "p['+index+']['+key+']['+k+'][work_hours]">'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                '<label>Plan:</label>'+
                                                '<textarea rows="5" cols="5" class="form-control" name = "p['+index+']['+key+']['+k+'][plan]"></textarea>'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                '<label>Vendor</label>'+
                                                '<select class="select" name = "p['+index+']['+key+']['+k+'][vendor]">'+
                                                '<option = ""></option>'+
                                                vendor_option+
                                                '</select>'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                '<label>Segmen</label>'+
                                                '<select class="select plan_segment">'+
                                                '<option = ""></option>'+
                                                segment_option+
                                                '</select>'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                '<label>Span</label>'+
                                                '<select class="select plan_span" person_id = '+person.user_id+'>'+
                                                '<option = ""></option>'+
                                                '</select>'+
                                                '</div>'+
                                                '<div class="form-group">'+
                                                /*'<button type="button" id="assign_fi" class="btn bg-info-800 btn-labeled btn-labeled-left btn-xs" aria-expanded="false"><b><i class="icon-plus3"></i></b>Add Parameters'+
                                                '</button>'+*/
                                                table+
                                                '</div>'+
                                                '</div>'+
                                                '</div>'+
                                                '</div>';
                                        }) 

                                       row += "</div>";
                                       row += "<br/>";
                                    // } else {

                                    // }
                                })

                                var tab = '<div class = "row temp prsn table ' + index.toLowerCase() + '" area = ""><legend class = "text-semibold">' + index + '</legend>' 
                                    +row
                                    +'</div>';
                                $(".tabs").append(tab);
                            });

                        }

                        $('.plan_segment').change(function(){
                            var $span = $(this).parent().parent().parent().find('.plan_span');
                            $span.find('option').remove().end();
                            var segmen_id = $(this).val();
                            var span_option = "";
                            span_option += '<option value = ""></option>';
                            $.each(span, function(i, sp){
                                var idx = span_ids.indexOf(sp.id);
                                if(idx >= 0 && sp.segment_id == segmen_id){
                                    span_option += '<option value = "'+sp.id+'">'+sp.span_hh_start+'-'+sp.span_hh_end+'</option>';
                                }
                            });
                            $span.append(span_option);
                        });

                        $('.plan_span').change(function(){
                            var span = $(this).val();
                            var segmen_id = $('.plan_segment').val();
                            var orang = $(this).attr('person_id');
                            var param = ".param_"+$(this).val();
                            var tg = ".segmen_thats_"+$(this).val();
                            var orang = ".person_"+orang;
                            var $span = $(this).parent().parent().parent().find('.plan_segment');
                            $(this).parent().parent().find(tg).val($span.val())
                            $(this).parent().parent().parent().find(orang).addClass('hidden');
                            $(this).parent().parent().parent().find(param).removeClass('hidden');



                            /*var $span = $(this).parent().parent().parent().find('.plan_span');
                            $span.find('option').remove().end();
                            var segmen_id = $(this).val();
                            var span_option = "";
                            $.each(span, function(i, sp){
                                var idx = span_ids.indexOf(sp.id);
                                if(idx >= 0 && sp.segment_id == segmen_id){
                                    span_option += '<option value = "'+sp.id+'">'+sp.span_hh_start+'-'+sp.span_hh_end+'</option>';
                                }
                            });
                            $span.append(span_option); */
                        });

                        $('.daterange-time').daterangepicker({
                            timePicker: true,
                            applyClass: 'bg-slate-600',
                            cancelClass: 'btn-default',
                            locale: {
                                format: 'MM/DD/YYYY h:mm a'
                            }
                        });
                        $('.select').select2();
                    }
                });

                $(".tabs").append(row);
            })

            $("#pc_id").change(function () {
                $(".fi").remove();
            });

            $('#assign_fi').click(function () {

                // $("#pcid").val(37);
                $('#modal_assign_fi').modal('show');
                $('#assign_fi_form')[0].reset();

                $(".dgb").change(function () {
                    $("#fi_id").select2();
                    $("#fi_id").val("").trigger("change");
                    var pc = $("#pcid").val(),
                        area = $("#areaid").val();

                    if (pc !== "" && area !== "") {
                        $.ajax({
                            url: JS_BASE_URL + '/timesheet/getFieldInspectorByArea/',
                            type: 'POST',
                            dataType: 'json',
                            data: {pc_id: pc, area: area},
                            async: false,
                            success: function (res) {
                                // $('#ghf').val('175');
                                // $('#ghf option[value=' + 175 + ']').attr('selected', true);
                                if (res.status == 'success') {
                                    var a = [];
                                    $.each(res.data, function (index, val) {
                                        a.push(val.user_id)
                                    });
                                    $("#fi_id").select2();
                                    $("#fi_id").val(a).trigger("change");
                                }
                            }
                        });
                    }
                });
            });


            $('#apply_set_2').click(function(){
                loadDailyPlan();
            })

            function loadDailyPlan(){
                $('.temp').remove();
                var project_id = $("#project").val();
                var pc_id = $("#pc_id").val();
                var start = $("#start").val();
                var end = $("#end").val();
                var dt = [];
                var data_date = [];
                var range_date = "",
                    parameters = "",
                    segmen = "";

                $.ajax({
                    url: JS_BASE_URL + '/timesheet/dateRange/',
                    type: 'POST',
                    dataType: 'json',
                    data: {start: start, end: end},
                    async: false,
                    success: function (res) {
                        data_date = res;
                        // h_total = res;
                        $.each(res, function (index, value) {
                            dt.push(moment(value).format('YYYY-MM-DD'));
                            range_date += "<th width='1000px'>" + value + "</th>";
                        });
                    }
                });


                $.ajax({
                    url: JS_BASE_URL + '/timesheet/load_daily_plan2/',
                    type: 'POST',
                    dataType: 'json',
                    data: {project_id: project_id, pc_id: pc_id, start: start, end: end},
                    async: false,
                    success: function (res) {
                        if(res.status == 'success'){
                            var row = "";
                            $.each(res.data, function (index, value) {
                                console.log(value);
                                row += '<tr>';
                                row += '<td>'+value.fullname+'<br/><button type = "button" class = "btn bg-teal-400 btn-sm create_plan" user_id = "'+value.user_id+'" user_name = "'+value.fullname+'" loc = "'+value.loc+'">Setting Plan</button></td>';
                                ep = value.existing_plan;

                                if(ep.length == 0){
                                    $.each(dt, function(i, dt){
                                        row += '<td>-</td>';
                                    })
                                } else {
                                    var plan_date = [];
                                    $.each(ep, function(k,v){
                                        plan_date.push(k);
                                    });
                                    $.each(dt, function(index, date){
                                        var idx = plan_date.indexOf(date);
                                        if(idx < 0){
                                            row += '<td>-</td>';
                                        } else {
                                            row += '<td>';
                                            row += '<table class = "table table-bordered table-striped">';
                                            row += '<thead>';
                                            row += '<tr>';
                                            row += '<td>Time</td>';
                                            row += '<td>Plan</td>';
                                            row += '<td>Segmen</td>';
                                            row += '<td>Span</td>';
                                            row += '<td>Target</td>';
                                            row += '<td>UOM</td>';
                                            row += '<td>Vendor</td>';
                                            row += '</tr>';
                                            row += '<tbody>';
                                            $.each(ep[date], function(key, plan){
                                                var work_in = plan.work_in.split(' '),
                                                    work_out = plan.work_out.split(' ');
                                                row += '<tr>';
                                                row += '<td>'+work_in[1]+' - '+work_out[1]+'</td>';
                                                row += '<td>'+plan.parameter_name+'</td>';
                                                row += '<td>'+plan.segment_name+'</td>';
                                                row += '<td>'+plan.span_hh_start+'-'+plan.span_hh_end+'</td>';
                                                row += '<td>'+plan.target+'</td>';
                                                row += '<td>'+plan.uom+'</td>';
                                                row += '<td>'+plan.vendor+'</td>';
                                                row += '</tr>';
                                            })
                                            row += '</tbody>';
                                            row += '</table>';
                                            row += '</td>';
                                        }
                                    })
                                }
                                row += '</tr>';
                            });


                            var tab = '<div class = "row temp table">' +
                                '<div class="table-responsive">' +
                                '<table class="table table-bordered table-striped table-xs" id = "table_plan">' +
                                '<thead class="bg-info-800">' +
                                '<tr>' +
                                '<th width="200px">Name</th>' +
                                range_date +
                                '</tr>' +
                                '</thead>' +
                                '<tbody>' +
                                row +
                                '</tbody>' +
                                '</table>' +
                                '</div></div>';
                            $(".tabs").append(tab);
                        }
                    },
                    complete : function (res){
                        console.log('test even fired');
                        if(res.responseJSON.status == 'success'){
                            var table = $('#table_plan').DataTable( {
                                ordering:       false,
                                searching:      false,
                                info :          false,
                                scrollY:        "350px",
                                scrollX:        true,
                                scrollCollapse: true,
                                paging:         false,
                                fixedColumns: {
                                    leftColumns: 1
                                }
                            });

                            console.log($('#table_plan'));
                        }
                    }
                });

                var param_array = [];
                $.ajax({
                    url: JS_BASE_URL + '/timesheet/load_parameters/',
                    type: 'GET',
                    dataType: 'json',
                    async: false,
                    success: function (res) {
                        if(res.status == 'success'){
                            // console.log(res.data);
                            $.each(res.data, function(i,p){
                                parameters += '<option value = ""></option>';
                                $.each(p, function(idx, param){
                                    param_array.push(param);
                                    parameters += '<option value ="'+param.id+'">'+param.parameter_name+'</option>';
                                })
                            })
                        }
                    }
                });

                var uom_option = "";
                var uom_array = [];
                $.ajax({
                    url: JS_BASE_URL + '/timesheet/load_uom/',
                    type: 'GET',
                    dataType: 'json',
                    async: false,
                    success: function (res) {
                        if(res.status == 'success'){
                            uom_array = res.data;
                            $.each(res.data, function(i,p){
                                uom_option += '<option value ="'+p.uom_name+'">'+p.uom_name+'</option>';
                            })
                        }
                    }
                });

                segmen_array = [];
                $.ajax({
                    url: JS_BASE_URL + '/planning/project_segmen/',
                    type: 'POST',
                    dataType: 'json',
                    data: {project_id: project_id},
                    async: false,
                    success: function (res) {
                        if(res.status=='Success'){
                            segmen_array = res.data;
                            // console.log(res.data);
                            segmen += '<option value = ""></option>';
                            $.each(res.data, function(index,val){
                                segmen += '<option value = "'+val.id+'">'+val.segment_name+'</option>';
                            })
                        }
                    }
                });


                $('.create_plan').unbind('click').bind('click', function (event) {
                    event.preventDefault();
                    var user_id = $(this).attr('user_id'),
                        user_name = $(this).attr('user_name'),
                        loc = $(this).attr('loc');
                    $('#plan_user_id').val(user_id);
                    $('#user_name').html(user_name);
                    $('#user_location').val(loc);
                    $('#plan_project_id').val(project_id);
                    $('#plan_pc_id').val(pc_id);
                    $('#plan_start_date').val(start);
                    $('#plan_end_date').val(end);
                    $('#table_plan2 tbody').children().remove();
                    $('#modal_create_plan').modal('show');
                    getUserPlan(user_id);
                })

                function getUserPlan(user_id){
                    $('#loading-image').show();
                    $.ajax({
                        url: JS_BASE_URL + '/timesheet/person_weekly_plan/',
                        type: 'POST',
                        data : {user_id : user_id, project_id : project_id, start : start, end:end},
                        dataType: 'json',
                        async: false,
                        success: function (res) {
                            if(res.status == 'success'){
                                var row='';
                                var d = [];
                                $.each(res.data, function(f, person_plan){
                                    plan_detail = person_plan;
                                    span_array = [];
                                    $.ajax({
                                        url: JS_BASE_URL + '/planning/segmen_span/',
                                        type: 'POST',
                                        dataType: 'json',
                                        data: {ids: plan_detail.segment_id},
                                        async: false,
                                        success: function (res) {
                                            if(res.status == 'Success'){
                                                span_array = res.data
                                            } else {
                                            }
                                        }
                                    });
                                    var idx = d.indexOf(person_plan.plan_date);
                                    if(idx < 0){
                                        var dis = '';
                                    } else {
                                        var dis = "disabled";
                                    }
                                    row +='<tr>';
                                    row += '<input type = "hidden" name = "plan['+f+'][plan_id]" value = "'+person_plan.plan_id+'" />';
                                    row += '<input type = "hidden" name = "plan['+f+'][parameter_id]" value = "'+person_plan.id+'" />';
                                    var dates = '<select name = "plan['+f+'][date]" class = "select date_plan">';
                                    dates += '<option value = ""></option>';
                                    var work_in = moment(person_plan.work_in).format('MM/DD/YYYY h:mm a'),
                                        work_out = moment(person_plan.work_out).format('MM/DD/YYYY h:mm a'),
                                        time = work_in +" - "+work_out;
                                    $.each(dt, function(i, v){
                                        var selected = '',
                                        date_formated = moment(v).format('YYYY-MM-DD');
                                        v = moment(v).format('dddd, DD MMM YYYY');
                                        if(person_plan.plan_date == date_formated){
                                            selected = 'selected';
                                        }
                                        dates += '<option value = "'+date_formated+'" '+selected+'>'+v+'</option>';
                                    })
                                    dates += '</select>';
                                    row += '<td>'+dates+'<input type = "hidden" class = "helpers" name="helper_'+f+'" value = "'+person_plan.plan_date+'"></td>';
                                    row += '<td><input type = "text" class = "form-control timepicker time_'+f+'" name = "plan['+f+'][time]" value = "'+time+'" '+dis+' /></td>';
                                    row += '<td>';
                                    row += '<select class = "select param_id" name = "plan['+f+'][parameter]">';           
                                    $.each(param_array, function(j, l){
                                        var selected = '';
                                        if(plan_detail.parameter_id == l.id){
                                            selected = 'selected';
                                        }
                                        row += '<option value = "'+l.id+'" '+selected+'>'+l.parameter_name+'</option>';
                                    })
                                    row += '</select>';
                                    row += '<input type = hidden name = "plan['+f+'][param_name]" class = "param_name" value = "'+plan_detail.parameter_name+'" />';
                                    row += '</td>' ;
                                    row += '<td><select class = "select segmen_project" name = "plan['+f+'][segmen]">';
                                    $.each(segmen_array, function(a, b){
                                        var selected = '';
                                        if(plan_detail.segment_id == b.id){
                                            selected = 'selected';
                                        }
                                        row += '<option value = "'+b.id+'" '+selected+'>'+b.segment_name+'</option>';
                                    })
                                    row += '</select>';
                                    row += '</td>' ;
                                    row += '<td><select class = "select span_project" name = "plan['+f+'][span]">';
                                    $.each(span_array, function(e,f){
                                        var selected = '';
                                        if(plan_detail.span_id == f.id){
                                            selected = 'selected';
                                        }
                                        row += '<option value = "'+f.id+'" '+selected+'>'+f.span_hh_start+'-'+f.span_hh_end+'</option>';
                                    })
                                    row += '</select>';
                                    row += '</td>' ;
                                    row += '<td><input type = "number" class = "form-control" name = "plan['+f+'][target]" value = "'+plan_detail.target+'">';
                                    row += '</td>' ;
                                    row += '<td><select class = "select" name = "plan['+f+'][uom]">';
                                    $.each(uom_array, function(c,d){
                                        var selected = '';
                                        if(plan_detail.uom == d.uom_name){
                                            selected = 'selected';
                                        }
                                        row += '<option value = "'+d.uom_name+'" '+selected+'>'+d.uom_name+'</option>';
                                    })
                                    row += '</select>';
                                    row += '</td>' ;
                                    row += '<td>' ;
                                    row += '<span class = "delete_plan"><i class="icon-trash"></i></span>';
                                    row += '</td>' ;
                                    row += '</tr>';

                                    d.push(person_plan.plan_date);
                                })
                                

                                $("#table_plan2 tbody").append(row);

                                
                                
                            }
                        },
                        complete: function(){
                            $('#loading-image').hide();
                            
                            $('.timepicker').daterangepicker({
                                timePicker: true,
                                /*startDate : date,
                                endDate : date,*/
                                applyClass: 'bg-slate-600',
                                cancelClass: 'btn-default',
                                 locale: {
                                    format: 'MM/DD/YYYY h:mm a'
                                }
                            }).on('show.daterangepicker', function (ev, picker) {
                                picker.container.find(".calendar-table").hide();
                            });

                            $('.date_plan').change(function(){
                                g = $(this).val();
                                var $helper = $(this).parent().parent().find('.helpers');
                                $helper.val(g);
                                var $h = $(this).parent().parent().parent().find('.helpers[value="'+g+'"]');
                                var $timepicker = $(this).parent().parent().find('.timepicker');

                                if($h.length > 1){
                                    var elemen_helper = $h.attr('name'),
                                    l = elemen_helper.split('_');
                                    console.log(elemen_helper);
                                    var elemen_target = '.time_'+l[1];
                                    var r = $(elemen_target).val();
                                    $timepicker.val(r);
                                    $timepicker.prop("disabled", true);
                                } else {
                                    $timepicker.prop("disabled", false);
                                    date = moment($(this).val()).format('MM/DD/YYYY h:mm a');
                                    $timepicker.daterangepicker({
                                        timePicker: true,
                                        startDate : date,
                                        endDate : date,
                                        applyClass: 'bg-slate-600',
                                        cancelClass: 'btn-default',
                                         locale: {
                                            format: 'MM/DD/YYYY h:mm a'
                                        }
                                    }).on('show.daterangepicker', function (ev, picker) {
                                        picker.container.find(".calendar-table").hide();
                                    });
                                }
                            });

                            $('.delete_plan').click(function(){
                                $(this).parent().parent().remove();
                            })
                            $('.segmen_project').change(function(){
                                var segmen_id = $(this).val();
                                var $span = $(this).parent().parent().find('.span_project');
                                $span.find('option').remove().end()
                                $.ajax({
                                    url: JS_BASE_URL + '/planning/segmen_span/',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {ids: segmen_id},
                                    async: false,
                                    success: function (res) {
                                        if(res.status == 'Success'){
                                            var span_option = "";
                                            span_option += '<option value = ""></option>';
                                            $.each(res.data, function(i, sp){
                                                span_option += '<option value = "'+sp.id+'">'+sp.span_hh_start+'-'+sp.span_hh_end+'</option>';
                                            });
                                            $span.append(span_option);
                                        } else {
                                            $span.find('option').remove().end()
                                        }
                                    }
                                });
                            });

                            $('.param_id').change(function(){
                                var id = $(this).val();
                                var $param_name = $(this).parent().find('.param_name');
                                $.ajax({
                                    url: JS_BASE_URL + '/timesheet/param_name/',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: {id : id},
                                    async: false,
                                    success: function (res) {
                                        if (res.status == 'success') {
                                            $param_name.val(res.data.parameter_name);
                                        }
                                    }
                                });
                            })
                            $('.timepicker').change(function(){
                                var $helper = $(this).parent().parent().find('.helpers');
                                var g = $helper.val();
                                console.log($helper.val());
                                var t = $(this).val();

                                $( ".helpers" ).each(function(){
                                    if($(this).val() == g){
                                        var $timepicker = $(this).parent().parent().find('.timepicker');
                                        $timepicker.val(t); 
                                    }
                                })
                            })
                            $('.select').select2();
                        }
                    });


                }

                


                $("#addPlan").unbind('click').bind('click', function (event) {
                    event.preventDefault;
                    person_id = $('#plan_user_id').val();
                    var numPlan=$('#table_plan2 tbody').children().length;
                    addNewPlan(numPlan, person_id);
                });

                function addNewPlan(numPlan, person_id){
                    var row='<tr>';
                    var dates = '<select name = "plan['+numPlan+'][date]" class = "select date_plan">';
                    dates += '<option value = ""></option>';

                    $.each(dt, function(i, v){
                        c = moment(v).format('dddd, DD MMM YYYY');
                        dates += '<option value = "'+moment(v).format('YYYY-MM-DD')+'">'+c+'</option>';
                    })
                    dates += '</select>';

                    row += '<td>'+dates+'<input type = "hidden" class = "helpers" name="helper_'+numPlan+'"></td>';
                    row += '<td><input type = "text" class = "form-control timepicker time_'+numPlan+'" name = "plan['+numPlan+'][time]" /></td>';
                    row += '<td><select class = "select param_id" name = "plan['+numPlan+'][parameter]">';
                    row += parameters ;
                    row += '</select>';
                    row += '<input type = hidden name = "plan['+numPlan+'][param_name]" class = "param_name" />';
                    row += '</td>' ;
                    row += '<td><select class = "select segmen_project" name = "plan['+numPlan+'][segmen]">';
                    row += segmen ;
                    row += '</select>';
                    row += '</td>' ;
                    row += '<td><select class = "select span_project" name = "plan['+numPlan+'][span]">';
                    row += '</select>';
                    row += '</td>' ;
                    row += '<td><input type = "number" class = "form-control" name = "plan['+numPlan+'][target]">';
                    row += '</td>' ;
                    row += '<td><select class = "select" name = "plan['+numPlan+'][uom]">';
                    row += uom_option;
                    row += '</select>';
                    row += '</td>' ;
                    row += '<td>' ;
                    row += '<span class = "delete_plan"><i class="icon-trash"></i></span>';
                    row += '</td>' ;
                    row += '</tr>';
                    $("#table_plan2 tbody").append(row);
                    numPlan++;

                    $('.select').select2();

                    $('.date_plan').change(function(){
                        g = $(this).val();
                        var $helper = $(this).parent().parent().find('.helpers');
                        $helper.val(g);
                        var $h = $(this).parent().parent().parent().find('.helpers[value="'+g+'"]');
                        var $timepicker = $(this).parent().parent().find('.timepicker');

                        if($h.length > 1){
                            var elemen_helper = $h.attr('name'),
                            l = elemen_helper.split('_');
                            console.log(elemen_helper);
                            var elemen_target = '.time_'+l[1];
                            var r = $(elemen_target).val();
                            $timepicker.val(r);
                            $timepicker.prop("disabled", true);
                        } else {
                            date = moment($(this).val()).format('MM/DD/YYYY h:mm a');
                            $timepicker.daterangepicker({
                                timePicker: true,
                                startDate : date,
                                endDate : date,
                                applyClass: 'bg-slate-600',
                                cancelClass: 'btn-default',
                                 locale: {
                                    format: 'MM/DD/YYYY h:mm a'
                                }
                            }).on('show.daterangepicker', function (ev, picker) {
                                picker.container.find(".calendar-table").hide();
                            });
                        }
                        
                    });

                    $('.delete_plan').click(function(){
                        $(this).parent().parent().remove();
                    })

                    $('.segmen_project').change(function(){
                        var segmen_id = $(this).val();
                        var $span = $(this).parent().parent().find('.span_project');
                        $span.find('option').remove().end()
                        $.ajax({
                            url: JS_BASE_URL + '/planning/segmen_span/',
                            type: 'POST',
                            dataType: 'json',
                            data: {ids: segmen_id},
                            async: false,
                            success: function (res) {
                                if(res.status == 'Success'){
                                    var span_option = "";
                                    span_option += '<option value = ""></option>';
                                    $.each(res.data, function(i, sp){
                                        span_option += '<option value = "'+sp.id+'">'+sp.span_hh_start+'-'+sp.span_hh_end+'</option>';
                                    });
                                    $span.append(span_option);
                                } else {
                                    $span.find('option').remove().end()
                                }
                            }
                        });
                    });

                    $('.param_id').change(function(){
                        var id = $(this).val();
                        var $param_name = $(this).parent().find('.param_name');
                        $.ajax({
                            url: JS_BASE_URL + '/timesheet/param_name/',
                            type: 'POST',
                            dataType: 'json',
                            data: {id : id},
                            async: false,
                            success: function (res) {
                                if (res.status == 'success') {
                                    $param_name.val(res.data.parameter_name);
                                }
                            }
                        });
                    })

                    $('.timepicker').change(function(){
                        var $helper = $(this).parent().parent().find('.helpers');
                        var g = $helper.val();
                        console.log($helper.val());
                        var t = $(this).val();

                        $( ".helpers" ).each(function(){
                            if($(this).val() == g){
                                var $timepicker = $(this).parent().parent().find('.timepicker');
                                $timepicker.val(t); 
                            }
                        })
                    })
                }

                $('#weekly_plan_form').unbind('submit').bind('submit', function (e) {
                    e.preventDefault();
                    var form = $(this);
                    // console.log)_
                    $.ajax({
                        url: JS_BASE_URL + '/timesheet/save_weekly_plan/',
                        type: 'POST',
                        dataType: 'json',
                        data: form.serialize(),
                        async: false,
                        success: function (res) {
                            if (res.status == 'success') {
                                alertSuccess();
                                $('#modal_create_plan').modal('toggle');
                                loadDailyPlan();
                            }
                        }
                    });
                });
            }

        });
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>

    </div>
