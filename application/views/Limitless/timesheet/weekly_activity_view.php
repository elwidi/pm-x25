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
                            <!-- <input type="text" class="form-control" name = "area"> -->
                            <select class="select ymmd" id = "project_id" name="project" data-placeholder="Select Project...">
                                <option value=""></option>
                                <?php foreach ($projects as $key => $value) { ?>
                                <option value="<?php echo $value->id?>"><?php echo $value->project_name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
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
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Area</label>
                        <div class="col-lg-4">
                            <!-- <input type="text" class="form-control" name = "area"> -->
                            <select class="select ymmd" name="area[]" id = "area" multiple="multiple">
                                <?php foreach ($work_location as $key => $value) { ?>
                                <option value="<?php echo $value->location?>"><?php echo $value->location?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
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

                        <!-- <span class="text-semibold">Status : </span><span class="status text-semibold"></span> -->
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

            if((start == "" & end != "") || (start != "" & end == "")){
                return false;
            } else {
                $.ajax({
                    url: JS_BASE_URL + '/timesheet/getPlanAct/',
                    type: 'POST',
                    dataType: 'json',
                    data : {start: start, end: end, pc_id : pc_id, project_id : project_id, area:area},
                    async: false,
                    success: function (res) {
                        $('.table').remove();
                        if(res.status == 'success'){
                            var range_date = "";
                            var pa = "";
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
                                        range_date +="<th colspan = '3' class = 'text-center'>"+value+"</th>";
                                        pa += "<th class = 'text-center'>Plan</th><th class = 'text-center'>Activity</th><th class = 'text-center'>Progress</th>"
                                    });

                                }
                            });
                            $.each(res.data, function( index, val ) {
                                var e = "";
                                $.each(val, function( i, v ) {
                                    e += "<tr class = 'fi'>";
                                    e += "<td style='vertical-align: top;'>"+v[0].assigned+"</td>";
                                    var r = [];
                                    $.each(v, function (w, p) {
                                        r.push(p.plan_date);
                                    });
                                    $.each(dt, function (i, val) {
                                        var idx = r.indexOf(val);

                                        if(idx < 0 ){
                                            e += "<td style='vertical-align: top;'></td><td style='vertical-align: top;'></td>";
                                        } else {
                                            e += "<td style='vertical-align: top;'>"+v[idx].plan+"</td>";
                                            e += "<td>";
                                            if(v[idx].activity.length > 0){
                                                e += '<div class="timeline timeline-left">'+
                                                '<div class="timeline-container">';
                                                $.each(v[idx].activity, function( k, l ) {
                                                    e += '<div class="timeline-date text-muted">'+
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
                                                        e+= '&nbsp;&nbsp;<a class = "zoom_modal" source ="http://android.moratelindo.co.id/project_management/images/'+l.photo_2+'" time = "'+l.capture_hour+'" date = "'+l.activity_date+'" latitude = "'+l.latitude+'" longitude = "'+l.longitude+'" status = "'+l.status+'" act = "'+l.actual+'"><img src = "http://android.moratelindo.co.id/project_management/images/'+l.photo_2+'" height="42" width="42"></a>';
                                                    }

                                                    if(l.photo_3 !== null){
                                                        e+= '&nbsp;&nbsp;<a class = "zoom_modal" source ="http://android.moratelindo.co.id/project_management/images/'+l.photo_3+'" time = "'+l.capture_hour+'" date = "'+l.activity_date+'" latitude = "'+l.latitude+'" longitude = "'+l.longitude+'" status = "'+l.status+'" act = "'+l.actual+'"><img src = "http://android.moratelindo.co.id/project_management/images/'+l.photo_3+'" height="42" width="42"></a>';
                                                    }

                                                    if(l.photo_4 !== null){
                                                        e+= '&nbsp;&nbsp;<a class = "zoom_modal" source ="http://android.moratelindo.co.id/project_management/images/'+l.photo_4+'" time = "'+l.capture_hour+'" date = "'+l.activity_date+'" latitude = "'+l.latitude+'" longitude = "'+l.longitude+'" status = "'+l.status+'" act = "'+l.actual+'"><img src = "http://android.moratelindo.co.id/project_management/images/'+l.photo_4+'" height="42" width="42"></a>';
                                                    }

                                                    if(l.photo_5 !== null){
                                                        e+= '&nbsp;&nbsp;<a class = "zoom_modal" source ="http://android.moratelindo.co.id/project_management/images/'+l.photo_5+'" time = "'+l.capture_hour+'" date = "'+l.activity_date+'" latitude = "'+l.latitude+'" longitude = "'+l.longitude+'" status = "'+l.status+'" act = "'+l.actual+'"><img src = "http://android.moratelindo.co.id/project_management/images/'+l.photo_5+'" height="42" width="42"></a>';
                                                    }

                                                    e+= '</div>' +
                                                        '</div>'+
                                                        '</div>'+
                                                        '</div>'+
                                                        '</div>'+
                                                        '</div>';
                                                });
                                            } else {
                                                e += "-";
                                            }
                                            e += "</td>";

                                            e += "<td>"
                                            $.each(v[idx].parameter, function( f, h ) {
                                                e += "<p>"+h.parameter_name+": </p><p>"+h.value+"</p>"
                                            });
                                            e += "</td>";
                                        }

                                    });
                                    
                                    e += "</tr>";
                                });
                                var tab = '<div class = "row table '+index.toLowerCase()+'" area = ""><legend class = "text-semibold">'+index+'</legend>'+
                                '<div class="table-responsive">'+
                                '<table class="table table-bordered table-striped table-xs " id = "table_'+index.toLowerCase()+'">'+
                                '<thead class="bg-info-800">'+
                                '<tr>'+
                                '<th rowspan="2">Name</th>'+
                                range_date +
                                '</tr>'+
                                '<tr>'+
                                pa +
                                '</tr>'+
                                '</thead>'+
                                '<tbody>'+
                                e +
                                '</tbody>'+
                                '</table>'+
                                '</div></div>';
                                $(".tabs").append(tab);
                                    
                            });
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
                        } else {
                            $('.table').remove();
                            var x = "<div class = 'table text-semibold'><h6>No Plan / Activity</h6></div>"
                            $(".tabs").append(x);
                        }

                    }
                });
            }
        });
    });
</script>
