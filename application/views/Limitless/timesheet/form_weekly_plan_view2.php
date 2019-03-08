<!-- Bordered striped table -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Weekly Work Plan</h5>
        <div class="heading-elements">
            <div class="btn-group">
                <button type="button" id = "assign_fi" class="btn bg-info-800 btn-labeled btn-labeled-left" aria-expanded="false"> <b><i class = "icon-tree5"></i></b>Assign Field Inspector</button>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <div class="panel-body" style="padding-top: 0">

        <div class="row">
            <div class="col-md-12">
                <form action="/index.php/timesheet/addWeeklyPlan/" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Project</label>
                        <div class="col-lg-4">
                            <!-- <input type="text" class="form-control" name = "area"> -->
                            <select class="select ymmd" id = "project" name="project">
                                <option value=""></option>
                                <?php foreach ($projects as $key => $value) { ?>
                                <option value="<?php echo $value->id?>"><?php echo $value->project_name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Coordinator</label>
                        <div class="col-lg-4">
                            <select class="select ymmd" name="coordinator_id" id = "pc_id">
                                <option value=""></option>
                                <?php foreach ($coordinator as $key => $value) { ?>
                                <option value="<?php echo $value->user_id?>"><?php echo $value->fullname?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Start</label>
                        <div class="col-lg-3">
                            <input type="text" class="form-control daterange-single ymmd" name = "start" value = "<?php echo date('d-m-Y', strtotime('monday this week'))?>" id = "start" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">End</label>
                        <div class="col-lg-3">
                            <input type="text" value= "<?php echo date('d-m-Y', strtotime("+6 day", strtotime('monday this week')));?>" class="form-control daterange-single ymmd" name = "end" id = "end">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-lg-2 control-label">Area</label>
                        <div class="col-lg-4">
                            <select class="select" name="area[]" id = "area" multiple="multiple">
                                <?php foreach ($work_location as $key => $value) { ?>
                                <option value="<?php echo $value->location?>"><?php echo $value->location?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div> -->
                    <div class="text">
                        <button type="submit" class="btn btn-primary">Submit</button> &nbsp; &nbsp;
                    </div>
                    <br/>
                    <div class = "tabs">
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
                    <form method = "POST"  id = "assign_fi_form" class="form-horizontal"> 
                        <div class="form-group mt-10"> 
                            <div class="row">
                                <div class="col-sm-12"> 
                                    <label>Project Coordinator</label> 
                                    <select id="pcid" name="pcid" data-placeholder="Select Project Coordinator" class="select dgb" required="required">
                                        <option value = ""></option>
                                        <?php foreach ($coordinator as $key => $value) { ?>
                                        <option value="<?php echo $value->user_id?>"><?php echo $value->fullname?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="form-group mt-10">
                            <div class="row">
                                <div class="col-sm-12"> 
                                    <label class="col-lg-2 control-label">Area</label>
                                    <select class="select dgb" name="areaid" id = "areaid">
                                        <option value = ""></option>
                                        <?php foreach ($work_location as $key => $value) { ?>
                                        <option value="<?php echo $value->location?>"><?php echo $value->location?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-10"> 
                            <div class="row">
                                <div class="col-sm-12"> 
                                    <label>Field Inspector</label> 
                                    <select id="ghf" name="fi_id[]" data-placeholder="Select Filed Inspector" class="select" required="required" multiple="multiple">
                                    <?php foreach ($users as $key => $value) { ?>
                                    <option value="<?php echo $value->user_id?>"><?php echo $value->fullname?></option>
                                    <?php }?>
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

<!-- <div id="modal_add_risk" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Add Issue/Risk</h5>
            </div>

            <div class="modal-body ">

                <div class="col-md-12"> 
                    <form method = "POST"  id = "add_risk_form" enctype="multipart/form-data" class = "form-validate-jquery"> 
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Project</label>
                                        <select id="project_id" name="project_id" data-placeholder="Select project" class="select" required="required">
                                            <option value="">No Project</option>
                                            <?php foreach ($users as $value){?>
                                                <option value="<?php echo $value->user_id?>"><?php echo $value->fullname?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Person</label>
                                        <select id="project_coordinator" name="project_coordinator" data-placeholder="Select person" class="select" required="required" multiple="multiple">
                                            <option value="">No Project</option>
                                            <?php foreach ($users as $value){?>
                                                <option value="<?php echo $value->user_id?>"><?php echo $value->fullname?></option>
                                            <?php }?>
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
</div> -->


<script type="text/javascript">
    $(function () {
        $("#area").change(function() {
            var start = $("#start").val(),
                end = $("#end").val();
            var areas = $(this).val();
            var pc_id = $("#pc_id").val();
            var range_date = "";
            var h_total = "";
            var field_inspector = "";
            $.ajax({
                url: JS_BASE_URL + '/timesheet/dateRange/',
                type: 'POST',
                dataType: 'json',
                data : {start: start, end: end},
                async: false,
                success: function (res) {
                    $("#plan").removeClass('hidden');
                    h_total = res;
                    $.each(res, function( index, value ) {
                        range_date +="<th>"+value+"</th>";
                    });

                }
            });
            $.ajax({
                url: JS_BASE_URL + '/timesheet/getFieldInspector/',
                type: 'POST',
                dataType: 'json',
                data : {pc_id : pc_id},
                async: false,
                success: function (e) {
                    field_inspector += '<option value="">Select Person</option> ';
                    if(e.status == 'success'){
                        $.each(e.data, function( index, val ) {
                            field_inspector += '<option value="' + val.user_id + '">' + val.fullname + '</option> ';
                        });  
                    }
                    
                    
                }
            });
            var all = [];
            <?php foreach ($work_location as $key => $value) {?>
                all.push("<?php echo $value->location ?>");
            <? } ?>
            $.each(all, function( index, val ) {
                var match = 0;
                $.each(areas, function( i, v ) {
                    if(val == v){
                        match = 1;
                    }
                });
                if(match == 0){
                    name = "."+val.toLowerCase();
                    $(name).remove();
                }
            });
            $.each(areas, function( index, val ) {
                tablename = "#table_"+val.toLowerCase();
                var exist = $(tablename).length;
                if(exist == 0){
                    var tab = '<div class = "row table '+val.toLowerCase()+'" area = ""><legend class = "text-semibold">'+val+'&nbsp; &nbsp; <button type="button" area = "'+val.toLowerCase()+'" class="btn btn-sm bg-teal-800 add-person">Add Person</button></legend>'+
                    '<div class="table-responsive">'+
                    '<table class="table table-bordered table-striped table-xs " id = "table_'+val.toLowerCase()+'">'+
                    '<thead class="bg-info-800">'+
                    '<tr>'+
                    '<th>Name</th>'+
                    range_date +
                    '<th></th>'+
                    '</tr>'+
                    '</thead>'+
                    '<tbody>'+
                    '<tr>'+
                    '</tr>'+
                    '</tbody>'+
                    '</table>'+
                    '</div></div>';
                    $(".tabs").append(tab);
                }
                
            });
            var a = 0;
            $(".add-person").click(function() {
                var area = $(this).attr('area');
                // tablename2 = "#table_"+area+">tbody>tr";
                // var a = $(tablename2).length;
                var e = "";
                    e += "<tr class = 'fi'>";
                    e += "<td><select class='select' name='p["+area+"]["+a+"][user]' placeholder = 'Select person'>"+field_inspector+"</select></td>";
                $.each(h_total, function( i, val ) {
                    e += "<td><input type = 'hidden' name = 'p["+area+"]["+a+"][planning]["+i+"][date]' value = '"+val+"'/><textarea class = 'form-control ' name = 'p["+area+"]["+a+"][planning]["+i+"][desc]'></textarea></td>";
                });
                e += "<td><a class = 'del'><i class = 'icon-trash'></i></a></td>";
                tablename = "#table_"+area+">tbody";
                e+= "</tr>";
                $(tablename).append(e);
                $('.select').select2();
                a++;

                $(".del").click(function() {
                    $(this).parent().parent().remove();
                });
            });
            
        });

        $(".ymmd").change(function() {
            var start = $("#start").val(),
                end = $("#end").val();
            var pc_id = $("#pc_id").val();
            var project_id = $("#project").val();
            var range_date = "";
            var h_total = "";
            var dt = [];
            var field_inspector = "";
            $('.temp').remove();
            if(project_id == "" || pc_id == ""){
            } else {
                $.ajax({
                    url: JS_BASE_URL + '/timesheet/dateRange/',
                    type: 'POST',
                    dataType: 'json',
                    data : {start: start, end: end},
                    async: false,
                    success: function (res) {
                        $("#plan").removeClass('hidden');
                        h_total = res;
                        $.each(res, function( index, value ) {
                            dt.push(moment(value).format('YYYY-MM-DD'));
                            range_date +="<th>"+value+"</th>";
                        });

                    }
                });
                $.ajax({
                    url: JS_BASE_URL + '/timesheet/getPersonPlan/',
                    type: 'POST',
                    dataType: 'json',
                    data : {pc_id : pc_id, project : project_id, start : start, end: end},
                    async: false,
                    success: function (e) {
                        $.each(e.data, function( index, val ) {
                            tablename = "#table_"+index.toLowerCase();
                            var exist = $(tablename).length;
                            var row = "";
                            area = index.toLowerCase();
                            var a = 0;
                            $.each(val, function( f, g ) {
                                row += "<tr>";
                                row +="<td>"+g.fullname+"</td>";
                                plan = g.existing_plan.length;
                                if(plan == 0){
                                    $.each(h_total, function( i, val ) {
                                        // console.log(a);
                                        row += "<td><input type = 'hidden' name = 'p["+area+"]["+a+"][planning]["+i+"][date]' value = '"+val+"'/><input type = 'hidden' name = 'p["+area+"]["+a+"][planning]["+i+"][user_id]' value = '"+g.user_id+"'/><textarea class = 'form-control ' name = 'p["+area+"]["+a+"][planning]["+i+"][desc]'></textarea></td>";
                                    });
                                    // row += "<td><a class = 'del'><i class = 'icon-trash'></i></a></td>";
                                } else {
                                    $.each(g.existing_plan, function( w, p ) {
                                        row += "<td><input type = 'hidden' name = 'p["+area+"]["+a+"][planning]["+w+"][id]' value = '"+p.daily_plan_id+"'/><textarea class = 'form-control ' name = 'p["+area+"]["+a+"][planning]["+w+"][desc]'>"+p.plan+"</textarea></td>"; 
                                    });

                                    var sl = h_total.length - plan;
                                    for (i = 0; i < sl; i++) {
                                        var index = i + plan;
                                        row += "<td><input type = 'hidden' name = 'p["+area+"]["+a+"][planning]["+index+"][date]' value = '"+h_total[index]+"'/><input type = 'hidden' name = 'p["+area+"]["+a+"][planning]["+index+"][user_id]' value = '"+g.user_id+"'/><textarea class = 'form-control ' name = 'p["+area+"]["+a+"][planning]["+index+"][desc]'></textarea></td>";
                                    } 
                                }
                                a++;
                                row += "</tr>";
                                
                            });

                            if(exist == 0){
                                var tab = '<div class = "row temp table '+index.toLowerCase()+'" area = ""><legend class = "text-semibold">'+index+'</legend>'+
                                '<div class="table-responsive">'+
                                '<table class="table table-bordered table-striped table-xs " id = "table_'+index.toLowerCase()+'">'+
                                '<thead class="bg-info-800">'+
                                '<tr>'+
                                '<th>Name</th>'+
                                range_date +
                                // '<th></th>'+
                                '</tr>'+
                                '</thead>'+
                                '<tbody>'+
                                row +
                                '</tbody>'+
                                '</table>'+
                                '</div></div>';
                                $(".tabs").append(tab);
                            }
                        });
                            
                        // });
                        /*field_inspector += '<option value="">Select Person</option> ';
                        if(e.status == 'success'){
                            $.each(e.data, function( index, val ) {
                                field_inspector += '<option value="' + val.user_id + '">' + val.fullname + '</option> ';
                            });  
                        }*/
                        
                        
                    }
                });
                // var all = [];
                // <?php foreach ($work_location as $key => $value) {?>
                //     all.push("<?php echo $value->location ?>");
                // <? } ?>
                // $.each(all, function( index, val ) {
                //     var match = 0;
                //     $.each(areas, function( i, v ) {
                //         if(val == v){
                //             match = 1;
                //         }
                //     });
                //     if(match == 0){
                //         name = "."+val.toLowerCase();
                //         $(name).remove();
                //     }
                // });

                // var a = 0;
                // $(".add-person").click(function() {
                //     var area = $(this).attr('area');
                //     // tablename2 = "#table_"+area+">tbody>tr";
                //     // var a = $(tablename2).length;
                //     var e = "";
                //         e += "<tr class = 'fi'>";
                //         e += "<td><select class='select' name='p["+area+"]["+a+"][user]' placeholder = 'Select person'>"+field_inspector+"</select></td>";
                //     $.each(h_total, function( i, val ) {
                //         e += "<td><input type = 'hidden' name = 'p["+area+"]["+a+"][planning]["+i+"][date]' value = '"+val+"'/><textarea class = 'form-control ' name = 'p["+area+"]["+a+"][planning]["+i+"][desc]'></textarea></td>";
                //     });
                //     e += "<td><a class = 'del'><i class = 'icon-trash'></i></a></td>";
                //     tablename = "#table_"+area+">tbody";
                //     e+= "</tr>";
                //     $(tablename).append(e);
                //     $('.select').select2();
                //     a++;

                //     $(".del").click(function() {
                //         $(this).parent().parent().remove();
                //     });
                // });
            }
        });


        $("#pc_id").change(function(){
            $(".fi").remove();
        });

        // $('#assign_fi').click(function() {
            
        //     $("#pcid").val(37);
        //     $('#modal_assign_fi').modal('show');
        //     $('#assign_fi_form')[0].reset();

        //     $(".dgb").change(function() {
        //         var pc = $("#pcid").val(),
        //             area = $("#areaid").val();

        //         if(pc !== "" && area !== ""){
        //             $.ajax({
        //                 url: JS_BASE_URL + '/timesheet/getFieldInspectorByArea/',
        //                 type: 'POST',
        //                 dataType: 'json',
        //                 data : {pc_id: pc, area: area},
        //                 async: false,
        //                 success: function (res) {
        //                     // $('#ghf').val('175');
        //                     // $('#ghf option[value=' + 175 + ']').attr('selected', true);
        //                     if(res.status == 'Success'){
        //                         // var a = [];
        //                         // $.each(res.data, function( index, val ) {
        //                         //     a.push(val.user_id)
        //                         // });  
        //                         // $('#fi_id').val('175');
        //                     }
        //                 }
        //             });
        //         }
        //     });
        // });

        
    });

    // $('#assign_fi').on('click', function () {
    //         $('#modal_assign_fi').modal('show');
    //         $(".dgb").change(function() {
    //             var pc = $("#pcid").val(),
    //                 area = $("#areaid").val();
    //             var detail;
    //             if(pc !== "" && area !== ""){
    //                 $.ajax({
    //                     url: JS_BASE_URL + '/timesheet/getFieldInspectorByArea/',
    //                     type: 'POST',
    //                     data : {pc_id: pc, area: area},
    //                     dataType: 'json',
    //                     async: false,
    //                     success: function (res) {
    //                         if (res.status == 'success') {
    //                             var a=[];
    //                             $.each(res.data, function( index, val ) {
    //                                 a.push(val.user_id)
    //                             });
    //                             detail = a;
    //                         }
    //                     }
    //                 });
    //                 $('#ghf').val(detail[0]);
    //                 console.log(detail);
    //             }

    //         });
    //         /*
    //         var detail = [];
    //         if(pc !== "" && area !== ""){
    //             $.ajax({
    //                 url: JS_BASE_URL + '/issueRisk/detail/' + issueRisk,
    //                 type: 'GET',
    //                 dataType: 'json',
    //                 async: false,
    //                 success: function (res) {
    //                     if (res.status == 'Success') {
    //                         detail = res.data;
    //                     }
    //                 }
    //             });
    //         }*/
            

    //         // console.log(detail);
    //         // $("#ghf").val(detail.type_of_issue_risk);


    //         // $('.modal-title').text('Edit Issue/Risk')

    //         // $('#modal_add_risk').modal('show');
    //         // $("#issue_id").val(detail.id);
    //         // $("#no_issue").val(detail.issue_no);
    //         // $("#input_date").val(detail.created_date);
    //         // // $("#raised_by").val(detail.);
    //         // $("#issue_risk").val(detail.issue_risk);
    //         // $("#category").val(detail.type_of_issue_risk);
    //         // $("#project_id").val(detail.projects_id);
    //         // $("#project_scope").val(detail.project_scope);
    //         // $("#project_manager").val(detail.pm_id);
    //         // $("#pic").val(detail.pic_id);
    //         // $("#potential_impact").val(detail.potential_impact);
    //         // $("#issue_only").val(detail.issue_or_risk);
    //         // $("#status").val(detail.status);
    //         // $("#raised_date").val(detail.raised_date);
    //         // // $("#raised_by").val(detail.);
    //         // $("#issue_only").val(detail.issue_only);
    //         // $('#risk_only_probability').val(detail.risk_only_probability);
    //         // $("#risk_only_impact").val(detail.risk_only_impact);
    //         // $("#risk_only_significance").val(detail.risk_only_significance);
    //         // $("#current_response").val(detail.current_response);
    //         // $("#current_response_date").val(detail.current_response_date);
    //         // $("#further_action").val(detail.further_action);
    //         // $("#further_action_date").val(detail.further_action_date);
    //         // $("#file_attc").html(detail.file_attachment);
    //         // $("#file_attc").removeClass('hidden');
    //         // $("#status option[value=closed]").removeAttr('disabled');

    //         // if($("#issue_or_risk").val() === 'risk'){
    //         //     $('.risk').show();
    //         //     $('.issue').hide();
    //         // } else {
    //         //     $('.risk').hide();
    //         //     $('.issue').show();
    //         // }
    //         // $( "#issue_or_risk" ).change(function() {
    //         //     if($(this).val() === 'risk'){
    //         //         $('.risk').fadeIn(300);
    //         //         $('.issue').fadeOut(300);
    //         //     } else {
    //         //         $('.risk').fadeOut(300);
    //         //         $('.issue').fadeIn(300);
    //         //     }
    //         // });
    //         // $('.select').parents('.bootbox').removeAttr('tabindex');
    //         // $('.select').select2();

    //         // if(detail.further_action_date != null){
    //         //     $('#further_action_date').daterangepicker({
    //         //         singleDatePicker: true,
    //         //         startDate: moment(detail.further_action_date).format('DD-MM-YYYY'),
    //         //         locale: {
    //         //             format: 'DD-MM-YYYY'
    //         //         },
    //         //     });
    //         // } else {
    //         //     $('#further_action_date').daterangepicker({
    //         //         singleDatePicker: true,
    //         //         locale: {
    //         //         format: 'DD-MM-YYYY'
    //         //         },
    //         //         autoUpdateInput :false
    //         //         }, 
    //         //     function(startDate, label){
    //         //         $('#further_action_date').val(startDate.format('DD-MM-YYYY'));
    //         //     });
    //         //  }
    //         // if(detail.current_response_date != null){
    //         //     $('#current_response_date').daterangepicker({
    //         //         singleDatePicker: true,
    //         //         startDate: moment(detail.current_response_date).format('DD-MM-YYYY'),
    //         //         locale: {
    //         //             format: 'DD-MM-YYYY'
    //         //         },
    //         //     });
    //         // } else {
    //         //     $('#current_response_date').daterangepicker({
    //         //         singleDatePicker: true,
    //         //         locale: {
    //         //         format: 'DD-MM-YYYY'
    //         //         },
    //         //         autoUpdateInput :false
    //         //         }, function(startDate, label){
    //         //             $('#current_response_date').val(startDate.format('DD-MM-YYYY'));
    //         //         });
    //         // }
    //     });
    
    $("#project_id").on('change', function () {
        var a = ['175','176']
        $("#project_coordinator").select2();
        $("#project_coordinator").val(a).trigger("change");
        // console.log()
        // $("#project_coordinator").val(176);
        // alert('Event Fired');
        // var pc = $("#project_id").val(),
        //     area = 'JAKARTA';
        // // var detail;
        // if(pc !== "" && area !== ""){
        //     $.ajax({
        //         url: JS_BASE_URL + '/timesheet/getFieldInspectorByArea/',
        //         type: 'POST',
        //         data : {pc_id: pc, area: area},
        //         dataType: 'json',
        //         async: false,
        //         success: function (res) {
        //             $("#project_coordinator").val(detail.pic_id);

        //             /*if (res.status == 'success') {
        //                 var a=[];
        //                 $.each(res.data, function( index, val ) {
        //                     a.push(val.user_id)
        //                 });
        //                 // detail = a;

                        
        //             }*/
        //         }
        //     });
        //     // $('#ghf').val(detail[0]);
        //     // console.log(detail);
        // }

    });
    $('#assign_fi').on('click', function () {
        // var issueRisk = $(this).attr('issue_risk');
        var issueRisk = 65;
        var detail;
        $.ajax({
            url: JS_BASE_URL + '/issueRisk/detail/' + issueRisk,
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function (res) {
                if (res.status == 'Success') {
                    detail = res.data;
                }
            }
        });

        console.log(detail);

        $('.modal-title').text('Edit Issue/Risk')

        $('#modal_add_risk').modal('show');
        // $("#issue_id").val(detail.id);
        // $("#no_issue").val(detail.issue_no);
        // $("#input_date").val(detail.created_date);
        // // $("#raised_by").val(detail.);
        // $("#issue_risk").val(detail.issue_risk);
        // $("#category").val(detail.type_of_issue_risk);
        $("#project_id").val(detail.projects_id);
        // $("#project_coordinator").val(detail.pic_id);
        // $("#project_scope").val(detail.project_scope);
        // $("#project_manager").val(detail.pm_id);


        // // $("#pic").val(detail.pic_id);
        // $("#potential_impact").val(detail.potential_impact);
        // $("#issue_only").val(detail.issue_or_risk);
        // $("#status").val(detail.status);
        // $("#raised_date").val(detail.raised_date);
        // // $("#raised_by").val(detail.);
        // $("#issue_only").val(detail.issue_only);
        // $('#risk_only_probability').val(detail.risk_only_probability);
        // $("#risk_only_impact").val(detail.risk_only_impact);
        // $("#risk_only_significance").val(detail.risk_only_significance);
        // $("#current_response").val(detail.current_response);
        // $("#current_response_date").val(detail.current_response_date);
        // $("#further_action").val(detail.further_action);
        // $("#further_action_date").val(detail.further_action_date);
        // $("#file_attc").html(detail.file_attachment);
        // $("#file_attc").removeClass('hidden');
        // $("#status option[value=closed]").removeAttr('disabled');

        // $("#project_id").on('change', function () {
        //     $("#project_coordinator").val(detail.pic_id);
        //     // alert('Event Fired');
        //     // var pc = $("#project_id").val(),
        //     //     area = 'JAKARTA';
        //     // // var detail;
        //     // if(pc !== "" && area !== ""){
        //     //     $.ajax({
        //     //         url: JS_BASE_URL + '/timesheet/getFieldInspectorByArea/',
        //     //         type: 'POST',
        //     //         data : {pc_id: pc, area: area},
        //     //         dataType: 'json',
        //     //         async: false,
        //     //         success: function (res) {
        //     //             $("#project_coordinator").val(detail.pic_id);

        //     //             /*if (res.status == 'success') {
        //     //                 var a=[];
        //     //                 $.each(res.data, function( index, val ) {
        //     //                     a.push(val.user_id)
        //     //                 });
        //     //                 // detail = a;

                            
        //     //             }*/
        //     //         }
        //     //     });
        //     //     // $('#ghf').val(detail[0]);
        //     //     // console.log(detail);
        //     // }

        // });

        if($("#issue_or_risk").val() === 'risk'){
            $('.risk').show();
            $('.issue').hide();
        } else {
            $('.risk').hide();
            $('.issue').show();
        }
        $( "#issue_or_risk" ).change(function() {
            if($(this).val() === 'risk'){
                $('.risk').fadeIn(300);
                $('.issue').fadeOut(300);
            } else {
                $('.risk').fadeOut(300);
                $('.issue').fadeIn(300);
            }
        });
        $('.select').parents('.bootbox').removeAttr('tabindex');
        $('.select').select2();

        if(detail.further_action_date != null){
            $('#further_action_date').daterangepicker({
                singleDatePicker: true,
                startDate: moment(detail.further_action_date).format('DD-MM-YYYY'),
                locale: {
                    format: 'DD-MM-YYYY'
                },
            });
        } else {
            $('#further_action_date').daterangepicker({
                singleDatePicker: true,
                locale: {
                format: 'DD-MM-YYYY'
                },
                autoUpdateInput :false
                }, 
            function(startDate, label){
                $('#further_action_date').val(startDate.format('DD-MM-YYYY'));
            });
         }
        if(detail.current_response_date != null){
            $('#current_response_date').daterangepicker({
                singleDatePicker: true,
                startDate: moment(detail.current_response_date).format('DD-MM-YYYY'),
                locale: {
                    format: 'DD-MM-YYYY'
                },
            });
        } else {
            $('#current_response_date').daterangepicker({
                singleDatePicker: true,
                locale: {
                format: 'DD-MM-YYYY'
                },
                autoUpdateInput :false
                }, function(startDate, label){
                    $('#current_response_date').val(startDate.format('DD-MM-YYYY'));
                });
        }
    });

</script>
