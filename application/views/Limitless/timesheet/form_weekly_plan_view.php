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
                    <form action="/index.php/timesheet/addWeeklyPlan/" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">It isnt project anymore</label>

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
                                                <input type="checkbox" class = "styled prm" name = "param[<?php echo $v->id?>]" id = "param<?php echo $v->id?>">
                                                <?php echo $v->parameter_name?>
                                            </label>
                                        </div>
                                    </div>
                                    <? } ?>

                                </div>
                                <?php }?>

                            </div>
                        </div>

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
                            <button type="submit" class="btn btn-primary">Submit</button>
                            &nbsp; &nbsp;
                        </div>
                        <br/>

                        <div class="tabs">
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
                                        <label class="col-lg-2 control-label">Area</label>
                                        <select class="select dgb" name="areaid" id="areaid">
                                            <option value=""></option>
                                            <?php foreach ($work_location as $key => $value) { ?>
                                            <option value="<?php echo $value->location ?>"><?php echo $value->location ?></option>  
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

    <script type="text/javascript">
        $(function () {
            $("#parameters").hide();
            $(".ymmd").change(function () {
                $('.prm').prop('checked', false);
                $('.prm').parent().removeClass('checked');
                // id = '37';
                var start = $("#start").val(),
                    end = $("#end").val();
                var pc_id = $("#pc_id").val();
                var project_id = $("#project").val();
                var range_date = "";
                var h_total = "";
                var dt = [];
                var param = [];
                var field_inspector = "";
                $('.temp').remove();
                if (project_id == "" || pc_id == "") {
                } else {
                    $.ajax({
                        url: JS_BASE_URL + '/timesheet/dateRange/',
                        type: 'POST',
                        dataType: 'json',
                        data: {start: start, end: end},
                        async: false,
                        success: function (res) {
                            $("#plan").removeClass('hidden');
                            h_total = res;
                            $.each(res, function (index, value) {
                                dt.push(moment(value).format('YYYY-MM-DD'));
                                range_date += "<th width='350px'>" + value + "</th>";
                            });

                        }
                    });
                    $.ajax({
                        url: JS_BASE_URL + '/timesheet/getPersonPlan/',
                        type: 'POST',
                        dataType: 'json',
                        data: {pc_id: pc_id, project: project_id, start: start, end: end},
                        async: false,
                        success: function (e) {
                            if(e.status == 'success'){
                                $("#parameters").show();
                                $.each(e.data, function (index, val) {
                                    tablename = "#table_" + index.toLowerCase();
                                    var exist = $(tablename).length;
                                    var row = "";
                                    area = index.toLowerCase();
                                    var a = 0;
                                    
                                    $.each(val, function (f, g) {
                                        row += "<tr>";
                                        row += "<td>" + g.fullname + "</td>";
                                        plan = g.existing_plan.length;
                                        if (plan == 0) {
                                            $.each(h_total, function (i, val) {
                                                // console.log(a);
                                                row += "<td><input type = 'hidden' name = 'p[" + area + "][" + a + "][planning][" + i + "][date]' value = '" + val + "'/><input type = 'hidden' name = 'p[" + area + "][" + a + "][planning][" + i + "][user_id]' value = '" + g.user_id + "'/><textarea rows='3' class = 'form-control ' name = 'p[" + area + "][" + a + "][planning][" + i + "][desc]'></textarea></td>";
                                            });
                                            // row += "<td><a class = 'del'><i class = 'icon-trash'></i></a></td>";
                                        } else {
                                            param = g.existing_plan[0].parameter;
                                            var r = [];
                                            $.each(g.existing_plan, function (w, p) {
                                                r.push(p.plan_date);
                                            });
                                            
                                            $.each(dt, function (i, val) {
                                                var idx = r.indexOf(val);
                                                if(idx < 0){
                                                    row += "<td><input type = 'hidden' name = 'p[" + area + "][" + a + "][planning][" + i + "][date]' value = '" + val + "'/><input type = 'hidden' name = 'p[" + area + "][" + a + "][planning][" + i + "][user_id]' value = '" + g.user_id + "'/><textarea rows='3' class = 'form-control ' name = 'p[" + area + "][" + a + "][planning][" + i + "][desc]'></textarea></td>";
                                                } else {
                                                    row += "<td><input type = 'hidden' name = 'p[" + area + "][" + a + "][planning][" + i + "][id]' value = '" + g.existing_plan[idx].daily_plan_id + "'/><textarea rows='3' class = 'form-control ' name = 'p[" + area + "][" + a + "][planning][" + i + "][desc]'>" + g.existing_plan[idx].plan + "</textarea></td>";
                                                }
                                                // row += "<td><input type = 'hidden' name = 'p[" + area + "][" + a + "][planning][" + i + "][date]' value = '" + val + "'/><input type = 'hidden' name = 'p[" + area + "][" + a + "][planning][" + i + "][user_id]' value = '" + g.user_id + "'/><textarea rows='3' class = 'form-control ' name = 'p[" + area + "][" + a + "][planning][" + i + "][desc]'></textarea></td>";
                                            });
                                            // $.each(g.existing_plan, function (w, p) {
                                                
                                            // });

                                            /*var sl = h_total.length - plan;
                                            for (i = 0; i < sl; i++) {
                                                var index = i + plan;
                                                row += "<td><input type = 'hidden' name = 'p[" + area + "][" + a + "][planning][" + index + "][date]' value = '" + h_total[index] + "'/><input type = 'hidden' name = 'p[" + area + "][" + a + "][planning][" + index + "][user_id]' value = '" + g.user_id + "'/><textarea rows='3' class = 'form-control ' name = 'p[" + area + "][" + a + "][planning][" + index + "][desc]'></textarea></td>";
                                            }*/
                                        }
                                        a++;
                                        row += "</tr>";

                                    });

                                    if (exist == 0) {
                                        var tab = '<div class = "row temp table ' + index.toLowerCase() + '" area = ""><legend class = "text-semibold">' + index + '</legend>' +
                                            '<div class="table-responsive">' +
                                            '<table class="table table-bordered table-striped table-xs " id = "table_' + index.toLowerCase() + '">' +
                                            '<thead class="bg-info-800">' +
                                            '<tr>' +
                                            '<th width="200px">Name</th>' +
                                            range_date +
                                                // '<th></th>'+
                                            '</tr>' +
                                            '</thead>' +
                                            '<tbody>' +
                                            row +
                                            '</tbody>' +
                                            '</table>' +
                                            '</div></div>';
                                        $(".tabs").append(tab);
                                    }
                                });
                                $.each(param, function (i, val) {
                                    var idp = "#param"+val;
                                    $(idp).prop('checked', true);
                                    $(idp).parent().addClass('checked');
                                });

                            } else {
                                $("#parameters").hide();
                            }
                            
                        }
                    });
                }
            });


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
        });
    </script>

    </div>
