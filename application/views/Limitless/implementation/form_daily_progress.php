<script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/editors/summernote/summernote.min.js"></script>
<!-- Bordered striped table -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Daily Progress Report</h5>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form action="/index.php/implementation/save_progress/" method="post" class="form-horizontal">
                    <div class="form-group col-md-9">
                        <label class="col-lg-2 control-label">Project</label>
                        <div class="col-lg-4">
                            <!-- <input type="text" class="form-control" name = "area"> -->
                            <select class="select ymmd" id = "project" name="project" data-placeholder="Select Project...">
                                <option value="">Select Project...</option>
                                <?php foreach ($projects as $key => $value) { ?>
                                <option value="<?php echo $value->id?>"><?php echo $value->project_name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-lg-2 control-label">Nama PIC</label>
                        <div class="col-lg-4">
                            <select class="select ymmd" name="coordinator_id" id = "pic_id">
                                <option value=""></option>
                                <?php foreach ($pic as $key => $value) { ?>
                                <option value="<?php echo $value->user_id?>"><?php echo $value->fullname?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div> -->
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
                    

                    <div class = "tabs col-md-9">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Baseline</label>
                            <div class="col-lg-2">
                                <input type = "hidden" name = "project_id" id = "project_id">
                                <input type="text" class="form-control bc" name = "baseline" id = "baseline">
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
        </form>
    </div>
</div>

<style>
    table {
        border-collapse: collapse;
    }

    table, th, td {
        border: 2px solid #000000;
    }
</style>


<script type="text/javascript">
    $(function () {
        $('.tabs').hide();

        $(".ymmd").change(function() {
            $('.tmpl').remove();
            $('.embed').remove();
            $('.dstr').remove();
            $('#remark').val("");
            // var e = $(this).val();
            var project_id = $('#project').val(),
                pic_id = $('#pic_id').val();
            if(project_id !== "" && pic_id !== ""){
                var remark = "";
                $.ajax({
                    url: JS_BASE_URL + '/implementation/project_milestone/',
                    type: 'POST',
                    dataType: 'json',
                    data : {project : project_id, pic : pic_id},
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
                                    // baseline = d.baseline;
                                    completion = d.completion;
                                    /*gap = baseline - completion;
                                    gap = gap.toPrecision(4);*/
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

                            /*$.ajax({
                                url: JS_BASE_URL + '/implementation/chart_value/',
                                type: 'POST',
                                dataType: 'json',
                                data : {project_id : project_id},
                                async: false,
                                success: function (res) {
                                    // console.log('chart');
                                    // console.log(res);
                                    if(res.status == 'Success'){
                                        var row = '';
                                        $.each(res.data, function( i, d ) {
                                            row += '<tr class = "tmpl">';
                                            row += '<td><input type="hidden" name="chart['+i+'][id]" value = "'+res.data.id+'"><input type="text" name="chart['+i+'][date]" class="form-control date" value = "'+d.added_date+'"></td><td><input type="hidden" name="chart['+i+'][prev_plan]" value = "'+d.plan+'"><input type="number" name="chart['+i+'][plan]" step = "0.01" class="form-control" placeholder = "'+d.plan+'"></td><td><input type="hidden" name="chart['+i+'][prev_actual]" value = "'+d.actual+'"><input type="number" name="chart['+i+'][actual]" step = "0.01" placeholder = "'+d.actual+'" class="form-control"></td>';
                                            row += "</tr>";
                                        });
                                        var idx = res.data.length;
                                        row += '<tr class = "tmpl">';
                                            row += '<td><input type="text" name="chart['+idx+'][date]" class="form-control date"></td><td><input type="number" name="chart['+idx+'][plan]" step = "0.01" class="form-control"></td><td><input type="number" name="chart['+idx+'][actual]" step = "0.01" class="form-control"></td>';
                                            row += "</tr>";
                                    } else {
                                        var row = '<tr class = "tmpl">';
                                        row += '<td><input type="text" name="chart[0][date]" class="form-control date"></td><td><input type="number" name="chart[0][plan]" step = "0.01" class="form-control"></td><td><input type="number" name="chart[0][actual]" step = "0.01" class="form-control"></td>';
                                        row += "</tr>";
                                    }
                                    
                                    // console.log(row);



                                    $("#table_chart tbody").append(row);

                                    $('.date').daterangepicker({
                                        singleDatePicker: true,
                                        locale: {
                                            format: 'DD-MM-YYYY'
                                        },
                                    });
                                }
                            });*/

                            $('#project_id').val(project_id);
                            $('#remark').val(remark);
                            $('#completion').val(completion);
                            // console.log(gap);
                            /*if(gap == "NaN"){
                                $('#gap').val(0);
                            } else {
                                $('#gap').val(gap);
                            }*/

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
                                    // console.log(res);
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



                                    // console.log(header);

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
            }
            
        });

        $( ".bc" ).change(function() {
            var baseline = $('#baseline').val();
            var completion = $('#completion').val();

            var e = baseline - completion;
            e = e.toPrecision(4);
            $('#gap').val(e);
        });

        $('#qty1').focusout(function(){
            console.log('event triggered');
        });       

        $('#row').click(function(){
            var index = $('#table_chart>tbody>tr').length;
            // console.log(index);
            var row = '<tr class = "tmpl">'+
                    '<td><input type="text" name="chart['+index+'][date]" class="form-control daterange-single"></td>'+
                    '<td><input type="number" name="chart['+index+'][plan]" step = "0.01" class="form-control"></td>'+
                    '<td><input type="number" name="chart['+index+'][actual]" step = "0.01" class="form-control"></td>'+
                    '</tr>';
            index++;

            $("#table_chart>tbody").append(row);
            $('.daterange-single').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'DD-MM-YYYY'
                },
            });

        });

        // $(".ymmd").change(function() {
        //     var start = $("#start").val(),
        //         end = $("#end").val();
        //     var pc_id = $("#pc_id").val();
        //     var project_id = $("#project").val();
        //     var range_date = "";
        //     var h_total = "";
        //     var dt = [];
        //     var field_inspector = "";
        //     $('.temp').remove();
        //     if(project_id == "" || pc_id == ""){
        //     } else {
        //         $.ajax({
        //             url: JS_BASE_URL + '/timesheet/dateRange/',
        //             type: 'POST',
        //             dataType: 'json',
        //             data : {start: start, end: end},
        //             async: false,
        //             success: function (res) {
        //                 $("#plan").removeClass('hidden');
        //                 h_total = res;
        //                 $.each(res, function( index, value ) {
        //                     dt.push(moment(value).format('YYYY-MM-DD'));
        //                     range_date +="<th>"+value+"</th>";
        //                 });

        //             }
        //         });
        //         $.ajax({
        //             url: JS_BASE_URL + '/timesheet/getPersonPlan/',
        //             type: 'POST',
        //             dataType: 'json',
        //             data : {pc_id : pc_id, project : project_id, start : start, end: end},
        //             async: false,
        //             success: function (e) {
        //                 $.each(e.data, function( index, val ) {
        //                     tablename = "#table_"+index.toLowerCase();
        //                     var exist = $(tablename).length;
        //                     var row = "";
        //                     area = index.toLowerCase();
        //                     var a = 0;
        //                     $.each(val, function( f, g ) {
        //                         row += "<tr>";
        //                         row +="<td>"+g.fullname+"</td>";
        //                         plan = g.existing_plan.length;
        //                         if(plan == 0){
        //                             $.each(h_total, function( i, val ) {
        //                                 // console.log(a);
        //                                 row += "<td><input type = 'hidden' name = 'p["+area+"]["+a+"][planning]["+i+"][date]' value = '"+val+"'/><input type = 'hidden' name = 'p["+area+"]["+a+"][planning]["+i+"][user_id]' value = '"+g.user_id+"'/><textarea class = 'form-control ' name = 'p["+area+"]["+a+"][planning]["+i+"][desc]'></textarea></td>";
        //                             });
        //                             // row += "<td><a class = 'del'><i class = 'icon-trash'></i></a></td>";
        //                         } else {
        //                             $.each(g.existing_plan, function( w, p ) {
        //                                 row += "<td><input type = 'hidden' name = 'p["+area+"]["+a+"][planning]["+w+"][id]' value = '"+p.daily_plan_id+"'/><textarea class = 'form-control ' name = 'p["+area+"]["+a+"][planning]["+w+"][desc]'>"+p.plan+"</textarea></td>"; 
        //                             });

        //                             var sl = h_total.length - plan;
        //                             for (i = 0; i < sl; i++) {
        //                                 var index = i + plan;
        //                                 row += "<td><input type = 'hidden' name = 'p["+area+"]["+a+"][planning]["+index+"][date]' value = '"+h_total[index]+"'/><input type = 'hidden' name = 'p["+area+"]["+a+"][planning]["+index+"][user_id]' value = '"+g.user_id+"'/><textarea class = 'form-control ' name = 'p["+area+"]["+a+"][planning]["+index+"][desc]'></textarea></td>";
        //                             } 
        //                         }
        //                         a++;
        //                         row += "</tr>";
                                
        //                     });

        //                     if(exist == 0){
        //                         var tab = '<div class = "row temp table '+index.toLowerCase()+'" area = ""><legend class = "text-semibold">'+index+'</legend>'+
        //                         '<div class="table-responsive">'+
        //                         '<table class="table table-bordered table-striped table-xs " id = "table_'+index.toLowerCase()+'">'+
        //                         '<thead class="bg-info-800">'+
        //                         '<tr>'+
        //                         '<th>Name</th>'+
        //                         range_date +
        //                         // '<th></th>'+
        //                         '</tr>'+
        //                         '</thead>'+
        //                         '<tbody>'+
        //                         row +
        //                         '</tbody>'+
        //                         '</table>'+
        //                         '</div></div>';
        //                         $(".tabs").append(tab);
        //                     }
        //                 });
                            
        //                 // });
        //                 /*field_inspector += '<option value="">Select Person</option> ';
        //                 if(e.status == 'success'){
        //                     $.each(e.data, function( index, val ) {
        //                         field_inspector += '<option value="' + val.user_id + '">' + val.fullname + '</option> ';
        //                     });  
        //                 }*/
                        
                        
        //             }
        //         });
        //         // var all = [];
        //         // <?php foreach ($work_location as $key => $value) {?>
        //         //     all.push("<?php echo $value->location ?>");
        //         // <? } ?>
        //         // $.each(all, function( index, val ) {
        //         //     var match = 0;
        //         //     $.each(areas, function( i, v ) {
        //         //         if(val == v){
        //         //             match = 1;
        //         //         }
        //         //     });
        //         //     if(match == 0){
        //         //         name = "."+val.toLowerCase();
        //         //         $(name).remove();
        //         //     }
        //         // });

        //         // var a = 0;
        //         // $(".add-person").click(function() {
        //         //     var area = $(this).attr('area');
        //         //     // tablename2 = "#table_"+area+">tbody>tr";
        //         //     // var a = $(tablename2).length;
        //         //     var e = "";
        //         //         e += "<tr class = 'fi'>";
        //         //         e += "<td><select class='select' name='p["+area+"]["+a+"][user]' placeholder = 'Select person'>"+field_inspector+"</select></td>";
        //         //     $.each(h_total, function( i, val ) {
        //         //         e += "<td><input type = 'hidden' name = 'p["+area+"]["+a+"][planning]["+i+"][date]' value = '"+val+"'/><textarea class = 'form-control ' name = 'p["+area+"]["+a+"][planning]["+i+"][desc]'></textarea></td>";
        //         //     });
        //         //     e += "<td><a class = 'del'><i class = 'icon-trash'></i></a></td>";
        //         //     tablename = "#table_"+area+">tbody";
        //         //     e+= "</tr>";
        //         //     $(tablename).append(e);
        //         //     $('.select').select2();
        //         //     a++;

        //         //     $(".del").click(function() {
        //         //         $(this).parent().parent().remove();
        //         //     });
        //         // });
        //     }
        // });


        // $("#pc_id").change(function(){
        //     $(".fi").remove();
        // });
    });
</script>
