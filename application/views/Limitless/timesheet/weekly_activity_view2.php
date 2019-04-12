<!-- Bordered striped table -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Daily Activity Report</h5>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Project</label>
                        <div class="col-lg-4">
                            <select class="select ymmd" id = "project_id" name="project" data-placeholder="Select Project...">
                                <option value=""></option>
                                <?php foreach ($projects as $key => $value) { ?>
                                <option value="<?php echo $value->id?>"><?php echo $value->project_name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <?php if($userRole[0] <= 3) { ?>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Project Coordinator</label>
                        <div class="col-lg-4">
                            <select class="select ymmd" name="coordinator_id" id = "pc_id" data-placeholder="Select Project Coordinator...">
                                <option value=""></option>
                                <?php foreach ($coordinator as $key => $value) { ?>
                                <option value="<?php echo $value->user_id?>"><?php echo $value->fullname?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <?php } ?>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Start</label>
                        <div class="col-lg-2">
                            <input type="text" class="form-control daterange-single ymmd" name = "start" value = "<?php echo date('d-m-Y', strtotime('monday this week'))?>" id = "start" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">End</label>
                        <div class="col-lg-2">
                            <input type="text" value= "<?php echo date('d-m-Y', strtotime("+6 day", strtotime('monday this week')));?>" class="form-control daterange-single ymmd" name = "end" id = "end">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-lg-2 control-label">Area</label>
                        <div class="col-lg-4">
                            <select class="select ymmd" name="area[]" id = "area" multiple="multiple">
                                <?php foreach ($work_location as $key => $value) { ?>
                                <option value="<?php echo $value->location?>"><?php echo $value->location?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div> -->
                    <br/>
                    <div class = "tabs">
                        
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div id="modal_photo" class="modal fade">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header bg-teal-800">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title date_time"></h5>
            </div>

            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <span class="text-semibold">Koordinat: </span><span class="koordinat"></span><br/>
                        <span class="text-semibold">Activity: </span><span class="act"></span><br/>
                        <br/>
                    </div>
                </div>

                <img class="zppm text-center" width="558px" />

            </div>
            </form> 
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $(".ymmd").change(function(){
            var pc_id = $("#pc_id").val(),
                project_id = $("#project_id").val(),
                dt = [];
                start = $("#start").val(),
                end = $("#end").val(),
                area = $("#area").val();
            var range_date = "";
            var pa = "";
            if((start == "" & end != "") || (start != "" & end == "")){
                return false;
            } else {
                $.ajax({
                    url: JS_BASE_URL + '/timesheet/getPlanAct2/',
                    type: 'POST',
                    dataType: 'json',
                    data : {start: start, end: end, pc_id : pc_id, project_id : project_id, area:area},
                    async: false,
                    success: function (res) {
                        $('.table').remove();
                        $('#table_plan').DataTable().destroy();
                        $('#table_plan tbody').empty();
                        $('.ef').remove();
                        if(res.status == 'success'){
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
                                        range_date +="<th colspan = '2' class = 'text-center'>"+value+"</th>";
                                        pa += "<th class = 'text-center'>Plan & Progress</th><th class = 'text-center' style = 'width:1000px;'>Activity</th>";
                                    });

                                }
                            });

                            var  tab = '<div class = "row ef">';
                            tab += '<div class="table-responsive">';
                            tab += '<table class="table table-bordered table-striped table-xs" id="table_plan">';
                            tab += '<thead class="bg-info-800">';
                            tab += '<tr>';
                            tab += '<th rowspan="2">Name</th>';
                            tab += range_date ;
                            tab += '</tr>';
                            tab += '<tr>';
                            tab += pa ;
                            tab += '</tr>';
                            tab += '</thead>';
                            tab += '<tbody>';

                            // var body = '<tbody>';

                            $.each(res.data, function( index, val ) {
                                tab += '<tr>';
                                tab += '<td>';
                                tab += val.fullname;
                                tab += '</td>';
                                var ep = val.progress,
                                progress_date = [];
                                $.each(ep, function(k,v){
                                    progress_date.push(k);
                                });
                                if(progress_date.length == 0){
                                    /**TO DO : if no progress**/
                                    $.each(dt, function( t, u ) {
                                        tab += '<td class = "text-muted">No Plan</td>';
                                        tab += '<td class = "text-muted">No Activity</td>';
                                    })
                                } else {
                                    $.each(dt, function( f, g ) {
                                        var idx = progress_date.indexOf(g);
                                        var v = moment(g).format('dddd, DD MMM YYYY');
                                        if(idx < 0){
                                            tab += '<td class = "text-muted">No Plan</td>';
                                            tab += '<td class = "text-muted">No Activity</td>';
                                        } else {
                                            var plan = ep[g].plan,
                                                activity = ep[g].activity,
                                                plan_id = [],
                                                activity_status = "";
                                            tab += '<td style = "vertical-align:top;">';
                                            /*** TO DO : table activity here ***/
                                            /*** table begins ***/
                                            tab += '<table class = "table table-bordered table-striped" >';
                                            tab += '<thead>';
                                            tab += '<tr>';
                                            tab += '<td>Time</td>';
                                            tab += '<td>Plan</td>';
                                            tab += '<td>Segmen</td>';
                                            tab += '<td>Span</td>';
                                            tab += '<td>Target</td>';
                                            tab += '<td>UOM</td>';
                                            tab += '<td>Achievement</td>';
                                            tab += '</tr>';
                                            tab += '<tbody>';

                                            activity_status = plan.status_activity;
                                            plan_id.push(plan.daily_plan_id);
                                            var work_in = plan.work_in.split(' '),
                                                work_out = plan.work_out.split(' '),
                                                pm_detail = plan.parameter_detail;

                                            $.each(pm_detail, function(n, data){
                                                if(data.value == null){
                                                    data.value = "-";
                                                }
                                                tab += '<tr>';
                                                tab += '<td>'+work_in[1]+' - '+work_out[1]+'</td>';
                                                tab += '<td>'+data.parameter_name+'</td>';
                                                tab += '<td>'+data.segment_name+'</td>';
                                                tab += '<td>'+data.span_hh_start+'-'+data.span_hh_end+'</td>';
                                                tab += '<td>'+data.target+'</td>';
                                                tab += '<td>'+data.uom+'</td>';
                                                tab += '<td>'+data.value+'</td>';
                                                tab += '</tr>';
                                            })
                                            
                                            tab += '</tbody>';
                                            tab += '</table>';
                                            /*** table end ***/
                                            tab += '</td>';



                                            if(activity.length == 0){
                                                tab += '<td class = "text-muted">No Activity Yet</td>';
                                            } else {
                                                if(activity.length == 0){
                                                    tab += '<td class = "text-muted">No Activity Yet</td>';

                                                } else {
                                                    var plan_ids = plan_id.toString();
                                                    tab += '<td style = "vertical-align:top;">';
                                                    if(activity_status == 'Approved'){
                                                        badge = '<span class = "badge badge-success pull-left">'+activity_status+'</span>';
                                                        tab += '<div class = "row">'+badge+'</div>';
                                                    } else if(activity_status == 'Rejected'){
                                                        badge = '<span class = "badge badge-danger pull-left">'+activity_status+'</span>';
                                                        tab += '<div class = "row">'+badge+'<ul class="icons-list pull-right"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i> <span class="caret"></span></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="javascript:;" class="approve_activity" plan_ids = "'+plan_ids+'" waspang = "'+val.fullname+'" date = "'+v+'"><i class="icon-checkmark2"></i> Approve</a></li><li><a href="javascript:;" class="reject_activity" plan_ids = "'+plan_ids+'" waspang = "'+val.fullname+'" date = "'+v+'"><i class="icon-close2"></i> Reject</a></li></ul></li></ul></div>';
                                                    } else {
                                                        tab += '<div class = "row"><span class = "badge badge-primary pull-left">Submitted</span><ul class="icons-list pull-right"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i> <span class="caret"></span></a><ul class="dropdown-menu dropdown-menu-right"><li><a href="javascript:;" class="approve_activity" plan_ids = "'+plan_ids+'" waspang = "'+val.fullname+'" date = "'+v+'"><i class="icon-checkmark2"></i> Approve</a></li><li><a href="javascript:;" class="reject_activity" plan_ids = "'+plan_ids+'" waspang = "'+val.fullname+'" date = "'+v+'"><i class="icon-close2"></i> Reject</a></li></ul></li></ul></div>';
                                                    }

                                                    // if(activity_status == "" || activity_status == null){
                                                    //     //toggle approval
                                                        
                                                    // } else {
                                                        
                                                    // }
                                                    $.each(activity, function( k, l ) {
                                                        tab += '<div class="timeline-date text-muted">'+
                                                            '<i class="icon-history position-left"></i> <span class="text-semibold">'+l.capture_hour+'</span>'+
                                                            '</div>'+
                                                            '<div class="timeline-row">'+
                                                            '<div class="timeline-icon">'+
                                                            '</div>'+
                                                            '<div class="panel panel-flat timeline-content">'+
                                                            '<div class="panel-body">'+
                                                            l.actual+
                                                            '<br/><br/><div class = "row">'+
                                                            '<a class = "zoom_modal" source ="http://android.moratelindo.co.id/project_management/images/'+l.photo_1+'" time = "'+l.capture_hour+'" date = "'+l.activity_date+'" latitude = "'+l.latitude+'" longitude = "'+l.longitude+'" status = "'+l.status+'" act = "'+l.actual+'"><img src = "http://android.moratelindo.co.id/project_management/images/'+l.photo_1+'" height="42" width="42"></a>' ;
                                                        if(l.photo_2 !== null){
                                                            tab += '&nbsp;&nbsp;<a class = "zoom_modal" source ="http://android.moratelindo.co.id/project_management/images/'+l.photo_2+'" time = "'+l.capture_hour+'" date = "'+l.activity_date+'" latitude = "'+l.latitude+'" longitude = "'+l.longitude+'" status = "'+l.status+'" act = "'+l.actual+'"><img src = "http://android.moratelindo.co.id/project_management/images/'+l.photo_2+'" height="42" width="42"></a>';
                                                        }

                                                        if(l.photo_3 !== null){
                                                            tab += '&nbsp;&nbsp;<a class = "zoom_modal" source ="http://android.moratelindo.co.id/project_management/images/'+l.photo_3+'" time = "'+l.capture_hour+'" date = "'+l.activity_date+'" latitude = "'+l.latitude+'" longitude = "'+l.longitude+'" status = "'+l.status+'" act = "'+l.actual+'"><img src = "http://android.moratelindo.co.id/project_management/images/'+l.photo_3+'" height="42" width="42"></a>';
                                                        }

                                                        if(l.photo_4 !== null){
                                                            tab += '&nbsp;&nbsp;<a class = "zoom_modal" source ="http://android.moratelindo.co.id/project_management/images/'+l.photo_4+'" time = "'+l.capture_hour+'" date = "'+l.activity_date+'" latitude = "'+l.latitude+'" longitude = "'+l.longitude+'" status = "'+l.status+'" act = "'+l.actual+'"><img src = "http://android.moratelindo.co.id/project_management/images/'+l.photo_4+'" height="42" width="42"></a>';
                                                        }

                                                        if(l.photo_5 !== null){
                                                            tab += '&nbsp;&nbsp;<a class = "zoom_modal" source ="http://android.moratelindo.co.id/project_management/images/'+l.photo_5+'" time = "'+l.capture_hour+'" date = "'+l.activity_date+'" latitude = "'+l.latitude+'" longitude = "'+l.longitude+'" status = "'+l.status+'" act = "'+l.actual+'"><img src = "http://android.moratelindo.co.id/project_management/images/'+l.photo_5+'" height="42" width="42"></a>';
                                                        }

                                                        tab += '</div>' +
                                                            '</div>'+
                                                            '</div>'+
                                                            '</div>'+
                                                            '</div>'+
                                                            '</div>';
                                                    });
                                                    tab += "</td>";
                                                }
                                            }
                                        }
                                    })
                                }
                                tab += '</tr>';
                            })
                            '</tbody>'
                            '</table>'+
                            '</div>';
                            $(".tabs").append(tab);


                            
                            $('.approve_activity').click(function(){
                                var plan_ids = $(this).attr('plan_ids'),
                                    date = $(this).attr('date'),
                                    waspang = $(this).attr('waspang');
                                var status = 'Approved';
                                swal({
                                    title: "Approve?",
                                    text: "Are you sure you want to approve activity "+waspang+" on "+date+"?",
                                    type: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#EF5350",
                                    confirmButtonText: "Yes, approve it",
                                    cancelButtonText: "No, cancel please",
                                    closeOnConfirm: false,
                                    closeOnCancel: false,
                                    showLoaderOnConfirm: true
                                },
                                function(isConfirm){
                                    if (isConfirm) {
                                        setTimeout(function() {
                                            $.ajax({
                                                type: "POST",
                                                url: JS_BASE_URL + '/timesheet/approve_activity/',
                                                data : {ids : plan_ids, status : status, reason : ""},
                                                async: false,
                                                dataType: "json",
                                                success: function (result) {
                                                    if(result.status == 'success')
                                                    {
                                                        swal({
                                                            title: "Approved",
                                                            text: "Activity has been approved.",
                                                            confirmButtonColor: "#66BB6A",
                                                            type: "success"
                                                        },
                                                        function(isConfirm){
                                                            location.reload();
                                                        });
                                                    }
                                                }
                                            });

                                        }, 2000);

                                    }
                                    else {
                                        swal({
                                            title: "Cancelled",
                                            text: "cancel and not process anything.",
                                            confirmButtonColor: "#2196F3",
                                            type: "error"
                                        });
                                    }
                                });
                            });

                            $('.reject_activity').on('click', function() {
                                var plan_ids = $(this).attr('plan_ids'),
                                    date = $(this).attr('date'),
                                    waspang = $(this).attr('waspang');
                                var status = 'Rejected';
                                swal({
                                    title: "Reject",
                                    text: "Reason:",
                                    type: "input",
                                    showCancelButton: true,
                                    confirmButtonColor: "#2196F3",
                                    closeOnConfirm: false,
                                    animation: "slide-from-top",
                                    inputPlaceholder: "Write something"
                                    },
                                function(inputValue){
                                    if (inputValue === false) return false;
                                    if (inputValue === "") {
                                        swal.showInputError("You need to write something!");
                                        return false
                                    }
                                    setTimeout(function() {
                                        $.ajax({
                                            type: "POST",
                                            url: JS_BASE_URL + '/timesheet/approve_activity/',
                                            data : {ids : plan_ids, status : status, reason : inputValue},
                                            async: false,
                                            dataType: "json",
                                            success: function (result) {
                                                if(result.status == 'success')
                                                {
                                                    swal({
                                                        title: "Rejected",
                                                        text: "Activity has been rejected.",
                                                        confirmButtonColor: "#66BB6A",
                                                        type: "success"
                                                    },
                                                    function(isConfirm){
                                                        location.reload();
                                                    });
                                                }
                                            }
                                        });
                                    }, 2000);
                                });
                            });


                        } else {
                            $('#table_plan').DataTable().destroy();
                            $('#table_plan tbody').empty();
                            $('.table').remove();
                            $('.ef').remove();
                            var x = "<div class = 'table text-semibold'><h6>No Plan / Activity</h6></div>"
                            $(".tabs").append(x);
                        }

                    },
                    complete : function (res){
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
                        }
                    }
                });
            }

            $('.zoom_modal').click(function(){
                var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                var d = new Date($(this).attr('date'));
                var dayName = days[d.getDay()];

                var imagesrc = $(this).attr('source');
                var date_time = dayName + ', ' + moment($(this).attr('date')).format('DD MMM YYYY') +' '+$(this).attr('time'),
                    kordinat = $(this).attr('latitude') + ', '+  $(this).attr('longitude');
                    status = $(this).attr('status'),
                    act = $(this).attr('act');

                $('.date_time').html(date_time);
                $('.act').html(act);
                $('.koordinat').html(kordinat);
                $('.status').html(status);

                $('.zppm').attr("src", imagesrc);
                $('#modal_photo').modal('show');
            });
        });

        

    });
</script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js"></script>



