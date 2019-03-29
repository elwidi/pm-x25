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
                    <form action="/index.php/timesheet/save_plan/" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Project</label>

                            <div class="col-lg-4">
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
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Project Coordinator</label>

                            <div class="col-lg-4">
                                <select class="select ymmd" name="coordinator_id" id="pc_id" data-placeholder="Select Project Coordinator...">
                                    <option value=""></option>
                                    <?php foreach ($coordinator as $key => $value) { ?>
                                        <option
                                            value="<?php echo $value->user_id ?>"><?php echo $value->fullname ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Start</label>

                            <div class="col-lg-2">
                                <input type="text" class="form-control daterange-single ymmd" name="start"
                                       value="<?php echo date('d-m-Y', strtotime('monday this week')) ?>" id="start">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">End</label>

                            <div class="col-lg-2">
                                <input type="text"
                                       value="<?php echo date('d-m-Y', strtotime("+6 day", strtotime('monday this week'))); ?>"
                                       class="form-control daterange-single ymmd" name="end" id="end">
                            </div>
                        </div>

                        <!--
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Segmen</label>

                            <div class="col-lg-4">
                                <select class="select ymmd" name="segmen_ids[]" id="segmen_ids" disabled multiple data-placeholder="Please select project first" >
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Span</label>

                            <div class="col-lg-4">
                                <select class="select ymmd" disabled name="span_ids[]" id="span_ids" multiple data-placeholder="Please select segmen first">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id = "parameters">
                            <label class="col-lg-2 control-label">Progress Parameters</label>

                            <div class="col-lg-8">
                                <?php foreach ($parameters as $key => $value) { ?>
                                <div class="form-group pt-15">
                                    <div class="checkbox">
                                        <label>
                                            <p class = "text-semibold"><?php echo $key ?></p>
                                        </label>
                                    </div>
                                    <?php foreach ($value as $k => $v) { ?>
                                    <div class="col-sm-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class = "styled prm" param_id = "<?php echo $v->id?>" param_name = "<?php echo $v->parameter_name?>" uom = "<?php echo $v->measurement?>"  name = "param[<?php echo $v->id?>]" id = "param<?php echo $v->id?>">
                                                <?php echo $v->parameter_name?>
                                            </label>
                                        </div>
                                    </div>
                                    <? } ?>

                                </div>
                                <?php }?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Area</label>

                            <div class="col-lg-4">
                                <select class="select" name="area_id[]" id="area_ids" multiple>
                                    <option value=""></option>
                                    <?php foreach ($work_location as $key => $value) { ?>
                                    <option value="<?php echo $value->location ?>"><?php echo $value->location ?></option>  
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        -->

                        <!-- <div class = "parameter">
                                <p class = "text-semibold">Parameters</p>
                                <?php foreach($parameters as $i => $m) { ?>
                                    <div class = 'col-md-4'>
                                    <div class="form-group pt-15">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="styled head" menu_id = "<?php echo $i ?>">
                                                <p class = "text-semibold"><?php echo $i?></p>
                                            </label>
                                        </div>
                                        <?php foreach ($m as $d => $p) {?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="styled m-<?php echo $i?>-c" name = "param[<?php echo $p->parameter_name?>]" value = "<?php echo $p->parameter_name?>">
                                                <?php echo $p->parameter_name?>
                                            </label>
                                        </div>
                                    </div> 
                                    </div>
                                    <?php }?>
                                <?php }?>
                          </div> -->
                        <!-- <div class="form-group">
                        <label class="col-lg-2 control-label">Area</label>
                        <div class="col-lg-4">
                            <select class="select" name="area[]" id = "area" multiple="multiple">
                                <?php foreach ($work_location as $key => $value) { ?>
                                <option value="<?php echo $value->location ?>"><?php echo $value->location ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        </div> -->
                        <div class="text">
                            <button type="button" class="btn bg-info-800" id="apply_set_2">Create weekly Plan</button>
                             <button type="submit" name="submit_form" value="true" class="btn btn-primary submit hidden">Save</button>
                            &nbsp; &nbsp;
                        </div>
                        <br/>

                        <div class="tabs table-responsive">
                        </div>
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
                        <form method="POST" action="/index.php/administration/saveParent/" id="assign_fi_form"
                              enctype="multipart/form-data" class="form-validate-jquery">
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
                    <h5 class="modal-title">Weekly Plan</h5>
                </div>
                <div class="modal-body">
                    <div class="col-md-12"> 
                        <form method = "POST"  action= "/issueRisk/updateFollowUp" id = "follow_up_form" enctype="multipart/form-data" > 
                              <div class="form-group"> 
                                   <div class="row">
                                        <div class="col-sm-1">
                                              <button type = "button" class="btn btn-primary btn-s" id = "addChild">Add Plan</button>
                                        </div>

                                   </div>
                              </div>
                              <div class="row mb-20">
                                <div class = "table-responsive">
                                    <table id = "follow_up" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td>Time</td>
                                                <td>Plan Description</td>
                                                <td>Segmen</td>
                                                <td>Span</td>
                                                <td>Target</td>
                                                <td>UoM</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

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
                var project_id = $(this).val();
                var $segment = $('#segmen_ids');
                $segment.removeAttr('disabled');
                $segment.find('option').remove().end()
                $.ajax({
                    url: JS_BASE_URL + '/planning/project_segmen/',
                    type: 'POST',
                    dataType: 'json',
                    data: {project_id: project_id},
                    async: false,
                    success: function (res) {
                        if(res.status=='Success'){
                            var option = "";
                            $.each(res.data, function(index,val){
                                option += '<option value = "'+val.id+'">'+val.segment_name+'</option>';
                            })
                            segment = res.data;
                            $segment.append(option);
                        } else {
                            $('#span_ids').attr('disabled');
                            $segment.find('option').remove().end()
                        }
                    }
                });
            });


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
                var vendor_option = "";
                var segment_option = "";
                var vendor_arr = [];
                // console.log(segment);
                var dt=[];
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


            //TODO: Create weekly plan
            $('#apply_set_2').click(function(){

                var project_id = $("#project").val();
                var pc_id = $("#pc_id").val();
                var start = $("#start").val();
                var end = $("#end").val();
                var dt = [];
                var range_date = "";
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
                            range_date += "<th width='1000px'>" + value + "</th>";
                        });
                    }
                });

                // alert(start);

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
                                row += '<tr>';
                                row += '<td>'+value.fullname+'<br/><button type = "button" class = "btn bg-teal-400 btn-sm create_plan" user_id = "'+value.user_id+'">Create Plan</button></td>';

                                $.each(dt, function(i, dt){
                                    row += '<td></td>';
                                })
                                row += '</tr>';
                            });


                            var tab = '<div class = "row temp table">' +
                                '<div class="table-responsive">' +
                                '<table class="table table-bordered table-striped table-xs ">' +
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
                    }
                });


                $('.create_plan').click(function(){
                    var user_id = $(this).attr('user_id');
                    $('#modal_create_plan').modal('show');
                    // console.log(user_id);
                })
            })



        });
    </script>

    </div>
