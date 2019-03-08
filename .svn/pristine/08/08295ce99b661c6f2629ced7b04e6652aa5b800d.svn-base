<!-- Project list -->
<div class="panel panel-flat">
    <div class = "row m-10">
        <a href="#">
            <button class = "btn bg-success btn-labeled" id = "add_resource"><b><i class="icon-plus2"></i></b>Add Resource</button>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table text-nowrap datatable-resource-list">
            <thead>
            <tr>
                <!-- <th style="width: 5px"></th> -->
                <th style="width: 500px">Name</th>
                <th style="width: 250px">Title</th>
                <th style="width: 50px">Join Date</th>
                <th style="width: 50px">Work Location</th>
<!--                <th>Team</th>-->
<!--                <th>Start date</th>-->
<!--                <th>End date</th>-->
<!--                <th>Category</th>-->
                <th style="width: 20px;"><i class="icon-arrow-down12"></i></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
</div>

<style>
    .dataTable{
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
        var option = "";
        <?php foreach ($activeUser as $key => $value) { ?>
        option += '<option value="<?php echo $value->user_id ?>"><?php echo $value->fullname ?></option>';
        <?php }?>

        var role = "";
        <?php foreach ($roles as $i => $v) { ?>
        role += '<option value="<?php echo $v->role_name?>"><?php echo $v->role_name ?></option>';
        <?php } ?>

        var project = "";
        <?php foreach ($project as $k => $d) { ?>
        project += '<option value="<?php echo $d->id?>"><?php echo $d->project_name ?></option>';
        <?php } ?>

        $('#add_resource').on('click', function() {
            bootbox.dialog({
                    title: "Add Resource",
                    message: '<div class="row"> ' +
                    '<div class="col-md-12">' +
                    '<form action="#" id = "add_user_form">' +
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-12">' +
                    '<label>Name</label> '+
                    '<input type="hidden" id = "user_id" name = "user_id" class="form-control"> '+
                    '<select id="name" name="name" data-placeholder="Select a user" class="select">'+
                    '<option value="" dissabled>Select a user</option>'+
                    option +
                    '</select>' +
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-6">' +
                    '<label>Join Date</label> '+
                    '<input type="text" class="form-control daterange-single" name = "join_date" value="" placeholder="Pick a date">'+
                    '</div>'+
                    '<div class="col-sm-6">' +
                    '<label>Title</label> '+
                    '<input type="text" id = "title" name = "title" class="form-control"> '+
                    '</div> '+
                    '</div> '+
                    '</div> '+
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-6">' +
                    '<label>Work Location</label> '+
                    '<input type="text" id = "work_location" name = "work_location" class="form-control"> '+
                    '</div>'+
                    '<div class="col-sm-6">' +
                    '<label>Assign to Position</label> '+
                    '<select id="name" name="position" data-placeholder="Select position" class="select">'+
                    '<option value="">Select a user</option>'+
                    role +
                    '</select>' +
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-12">' +
                    '<label>Assign to Project</label> '+
                    '<input type="hidden" id = "user_id" name = "user_id" class="form-control"> '+
                    '<select id="project" name="project[]" data-placeholder="Select a user" class="select" multiple ="multiple">'+
                    '<option value="" dissabled>Select a user</option>'+
                    project +
                    '</select>' +
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</form>' +
                    '</div>' +
                    '</div>',
                    buttons: {
                        success: {
                            label: "Add User",
                            className: "btn-success",
                            callback: function () {
                                var form = $('#add_user_form');
                                $.ajax({
                                    url:  JS_BASE_URL +'/resource/addResource/',
                                    type : 'POST',
                                    dataType: 'json',
                                    data: form.serialize(),
                                    success: function(res) {
                                        var dbmil = $('.datatable-resource-list').dataTable();
                                        if(res.status == 'Success'){
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

            // Single picker
            $('.daterange-single').daterangepicker({
                singleDatePicker: true,
            });

        });


    });
</script>


