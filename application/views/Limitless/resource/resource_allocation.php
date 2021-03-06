<!-- Project list -->
<div class="panel panel-flat">
    <div class = "row m-10">
        <a href="#">
            <button class = "btn bg-success btn-labeled" id = "add_resource"><b><i class="icon-plus2"></i></b>Allocate Resource</button>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table text-nowrap datatable-resource-allocation">
            <thead>
            <tr>
                <!-- <th style="width: 5px"></th> -->
                <th style="width: 500px">Resource Name</th>
                <th style="width: 50px">Project Name</th>
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
        <?php foreach ($resource as $key => $value) { ?>
        option += '<option value="<?php echo $value->id ?>"><?php echo $value->fullname ?></option>';
        <?php }?>

        var option2 = "";
        <?php foreach ($projects as $i => $v) { ?>
        option2 += '<option value="<?php echo $v->id ?>"><?php echo $v->project_name ?></option>';
        <?php }?>
        $('#add_resource').on('click', function() {
            bootbox.dialog({
                    title: "Add Resource",
                    message: '<div class="row"> ' +
                    '<div class="col-md-12">' +
                    '<form action="#" id = "add_user_form">' +
                    '<div class="form-group">' +
                    '<label>Email</label> '+
                    '<input type="hidden" id = "user_id" name = "user_id" class="form-control"> '+
                    '<select id="resource_id" name="resource_id" data-placeholder="Select a user" class="select">'+
                    '<option value="" dissabled>Select resource</option>'+
                    option +
                    '</select>' +
                    '</div>'+
                    '<div class="form-group">' +
                    '<label>Email</label> '+
                    '<input type="hidden" id = "user_id" name = "user_id" class="form-control"> '+
                    '<select id="project_id" name="project_id" data-placeholder="Select a user" class="select">'+
                    '<option value="" dissabled>Select project</option>'+
                    option2 +
                    '</select>' +
                    '</div>'+
                    '</form>' +
                    '</div>' +
                    '</div>',
                    buttons: {
                        success: {
                            label: "Allocate",
                            className: "btn-success",
                            callback: function () {
                                var form = $('#add_user_form');
                                $.ajax({
                                    url:  JS_BASE_URL +'/resource/saveAllocate/',
                                    type : 'POST',
                                    dataType: 'json',
                                    data: form.serialize(),
                                    success: function(res) {
                                        var dbmil = $('.datatable-user-list').dataTable();
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

            $( "#email" ).change(function() {
                res = $(this).val().split("-");
                $("#name").val(res[2]);
                $("#user_id").val(res[0]);
            });
        });


    });
</script>


