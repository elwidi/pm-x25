<script type="text/javascript"
        src="<?php echo base_url() ?>themes/Limitless/default/assets/js/plugins/visualization/c3/c3.min.js"></script>

<!-- Resource View -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Resource View</h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        <div class="form-group">
            <label>Select Resource:</label>
            <select id="role" name="role" data-placeholder="Select role" class="select text-bold">
                <option value="all">All Resource View</option>
                <?php foreach ($roles as $key => $r) { ?>
                    <option
                        value="<?php echo str_replace(" ", "_", strtolower($r->role_name)) ?>"><?php echo $r->role_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<!-- /resource view -->


<div class="row tab1 all">
    <div class="col-md-6 col-lg-6">
    <?php foreach ($role as $key => $r) { ?>

        <?php if($r->role_name!='Field Inspector' && $r->role_name!='Admin'){ ?>

            <div class="panel panel-flat">
                <div class="panel-heading text-center">
                    <h4 class="panel-title text-semibold"><?php echo strtoupper($r->role_name); ?></h4>
                    <small class="text-info"><i class=icon-primitive-square></i>Availability</small>
                    <small class="text-warning"><i class=icon-primitive-square></i> Outstanding Work</small>
                </div>

                <div class="panel-body">
                    <?php foreach ($r->resource as $i => $res) { ?>

                        <div class="col-md-3" style="text-align: right;">
                            <label class="text-right"><?php echo $res->fullname; ?></label>
                        </div>
                        <div class="col-md-9 mb-10">
                            <div class="progress">
                                <div class="progress-bar bg-info" style="width: <?php echo $res->availbility ?>%">
                                    <span> <?php echo $res->availbility; ?>%</span>
                                </div>
                                <div class="progress-bar progress-bar-warning"
                                     style="width: <?php echo $res->os_work ?>%">
                                    <span> <?php echo $res->os_work; ?>%</span>
                                </div>
                            </div>
                        </div>
                        <br/>

                    <?php } ?>
                </div>
            </div>

    <?php } ?>
    <?php } ?>
    </div>

    <div class="col-md-6 col-lg-6">
        <?php foreach ($role as $key => $r) { ?>

            <?php if($r->role_name=='Field Inspector' || $r->role_name=='Admin'){ ?>

                <div class="panel panel-flat">
                    <div class="panel-heading text-center">
                        <h4 class="panel-title text-semibold"><?php echo strtoupper($r->role_name); ?></h4>
                        <small class="text-info"><i class=icon-primitive-square></i>Availability</small>
                        <small class="text-warning"><i class=icon-primitive-square></i> Outstanding Work</small>
                    </div>

                    <div class="panel-body">
                        <?php foreach ($r->resource as $i => $res) { ?>

                            <div class="col-md-3" style="text-align: right;">
                                <label class="text-right"><?php echo $res->fullname; ?></label>
                            </div>
                            <div class="col-md-9 mb-10">
                                <div class="progress">
                                    <div class="progress-bar bg-info" style="width: <?php echo $res->availbility ?>%">
                                        <span> <?php echo $res->availbility; ?>%</span>
                                    </div>
                                    <div class="progress-bar progress-bar-warning"
                                         style="width: <?php echo $res->os_work ?>%">
                                        <span> <?php echo $res->os_work; ?>%</span>
                                    </div>
                                </div>
                            </div>
                            <br/>

                        <?php } ?>
                    </div>
                </div>

            <?php } ?>
        <?php } ?>
    </div>
</div>



<?php foreach ($role as $i => $p) { ?>
    <div class="row tab <?php echo $p->code ?>">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading text-center">
                    <h4 class="panel-title text-semibold"><?php echo strtoupper($p->role_name); ?></h4>
                    <small class="text-info"><i class=icon-primitive-square></i>Availability</small>
                    <small class="text-warning"><i class=icon-primitive-square></i> Outstanding Work</small>
                </div>

                <div class="panel-body">
                    <!-- <div style="overflow-x: scroll;position:relative;">
                    <div style="width: 4520px"> -->
                    <table class="table table-bordered text-nowrap">
                        <thead>
                        <tr class="bg-indigo-800">
                            <th rowspan="2">No</th>
                            <th rowspan="2" class="text-center">Name</th>
                            <th colspan="2" rowspan="2" class="text-center">Total Project</th>
                            <th rowspan="2" class="text-center">Availability</th>
                            <th rowspan="2" class="text-center">Oustanding Work</th>
                            <?php //for ($x = 1; $x <= $p->max_project; $x++) {
                                //echo "<th colspan = '3' class=\"text-center\">Project " . $x . "</th>";
                            //} ?>
                        </tr>
                        <!-- <tr class="bg-indigo-800">
                            <?php for ($x = 1; $x <= $p->max_project; $x++) {
                                /*echo "<th class=\"text-center\">Code</th>";
                                echo "<th class=\"text-center\">Project Name</th>";
                                echo "<th class=\"text-center\">Completion</th>";*/
                            } ?>
                        </tr> -->
                        </thead>
                        <tbody>
                        <?php $no = 1;
                        foreach ($p->resource as $key => $u) { ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><a href="#" class = "detail-resource" res_id = "<?php echo $u->user_id?>"><?php echo $u->fullname;?></a></td>
                                <td><?php echo $u->total_project; ?></td>
                                <td><?php for ($x = 0; $x < $u->total_project; $x++) {
                                        echo "<span class = 'badge badge-success' >" . $u->project[$x]->id . "</span> ";
                                    } ?></td>
                                <td><?php echo $u->availbility; ?>%</td>
                                <td><?php echo $u->os_work; ?>%</td>
                                <?php /*for ($x = 0; $x < $u->total_project; $x++) {
                                    echo "<td>" . $u->project[$x]->id . "</td>";
                                    echo "<td>" . $u->project[$x]->project_name . "</td>";
                                    echo "<td>" . $u->project[$x]->completion . "%</td>";
                                }*/ ?>
                                <?php /*for ($x = 0; $x < $p->max_project - $u->total_project; $x++) {
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                }*/ ?>
                            </tr>
                            <?php $no++;
                        } ?>
                        </tbody>
                    </table>
                    </div>
                    </div>
                    <br/>

                    <div class="col-md-6 col-lg-6">
                        <?php foreach ($p->resource as $i => $res) { ?>

                            <div class="col-md-3" style="text-align: right;">
                                <label class="text-right"><?php echo $res->fullname; ?></label>
                            </div>
                            <div class="col-md-9 mb-10">
                                <div class="progress">
                                    <div class="progress-bar bg-info" style="width: <?php echo $res->availbility ?>%">
                                        <span> <?php echo $res->availbility; ?>%</span>
                                    </div>
                                    <div class="progress-bar progress-bar-warning"
                                         style="width: <?php echo $res->os_work ?>%">
                                        <span> <?php echo $res->os_work; ?>%</span>
                                    </div>
                                </div>
                            </div>
                            <br/>

                        <?php } ?>
                    </div>
                    <div class="col-md-6 col-lg-6">
                    </div>


                </div>
            </div>
        </div>
    </div>
<?php } ?>



<style>
    .dataTable {
        border-collapse: collapse;
    }

    .dataTable tbody > tr:first-child > td {
        border-top: none;
        border-top: 1px solid #ddd;
        border-collapse: collapse;
    }

    .table > tbody > tr.border-double > td {
        border-top-width: 3px;
        border-top-style: double;
    }
</style>

<script type="text/javascript">
    $(function () { 
        $(".tab").hide();
        $(".detail-resource").click(function () {
            var detail;
            $.ajax({
                url: JS_BASE_URL + '/resource/detailTransmit/' + transId,
                type: 'GET',
                dataType: 'json',
                async: false,
                success: function (res) {
                    if (res.status == 'Success') {
                        detail = res.data;
                    }
                }
            });
            bootbox.dialog({
                title: "Add Customer",
                message: '<div class="row"> ' +
                '<div class="col-md-12">' +
                '<form action="#" id = "add_user_form">' +
                '<div class="form-group">' +
                '<div class="row">'+
                '<div class="col-sm-12">' +
                '<label>Customer Name</label> '+
                '<label>Customer Name</label> '+
                '</select>' +
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="form-group">' +
                '<div class="row">'+
                '<div class="col-sm-12">' +
                '<label>Adress</label> '+
                '<input type="text" class="form-control" name = "customer_address" id = "customer_address" value="">'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="form-group">' +
                '<div class="row">'+
                '<div class="col-sm-6">' +
                '<label>Email</label> '+
                '<input type="text" class="form-control" name = "customer_email" id = "customer_email" value="">'+
                '</div>'+
                '<div class="col-sm-6">' +
                '<label>Phone</label> '+
                '<input type="text" id = "po_number" name = "customer_phone" id = "customer_phone" class="form-control "> '+
                '</div> '+
                '</div> '+
                '</div> '+
                '<div class="form-group">' +
                '<div class="row">'+
                '<div class="col-sm-12">' +
                '<label>Other Details</label> '+
                '<textarea rows="4" cols="5" name = "other_customer_detail" id = "other_customer_detail" class="form-control"></textarea>' +
                '</div>'+
                '</div>'+
                '</div>'+
                '</form>' +
                '</div>' +
                '</div>',
                buttons: {
                    success: {
                        label: "Add",
                        className: "btn-success",
                        callback: function () {
                            var form = $('#add_user_form');
                            $.ajax({
                                url:  JS_BASE_URL +'/planning/add_customer/',
                                type : 'POST',
                                dataType: 'json',
                                data: form.serialize(),
                                success: function(res) {
                                    var dbmil = $('.datatable-customer-list').dataTable();
                                    if(res.status == 'Success'){
                                        alertSuccess();
                                        dbmil.api().ajax.reload();
                                    }
                                }
                            });

                        }
                    }
                }
            });
        });
    });

    $("#role").change(function () {
        console.log($(this).val());
        if ($(this).val == 'all') {
            $(".tab1").hide();
            $(".tab").fadeIn('slow');
        } else {
            $(".tab1").hide();
            $(".tab").hide();
            var c = "." + $(this).val();
            $(c).fadeIn('slow');
        }
    });
</script>


