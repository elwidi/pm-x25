<!-- Project list -->
<div class="panel panel-flat">
    <!--<div class = "row m-10">
        <a href="#">
            <button class = "btn bg-success btn-labeled" id = "add_permission"><b><i class="icon-plus2"></i></b>Add Role</button>
        </a>
    </div>-->

    <div class="table-responsive">
        <table class="table text-nowrap datatable-role-list">
            <thead>
            <tr>
                <!-- <th style="width: 5px"></th> -->
                <th style="width: 300px">No</th>
                <th style="width: 500px">Role</th>
                <th style="width: 5px;"><i class="icon-arrow-down12"></i></th>
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
        $('#add_permission').on('click', function() {
            bootbox.dialog({
                    title: "Add Role",
                    message: '<div class="row"> ' +
                    '<div class="col-md-12">' +
                    '<form action="#" id = "add_role_fprm">' +
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-12">'+
                    '<label>Role Name</label> '+
                    '<input type="text" name = "permission_name" class="form-control"> '+
                    '</div> '+
                    '</div> '+
                    '</div>'+
                    '<div class="form-group">'+
                    '<label class = "m-10">Permission Description (Optional):</label> '+
                    '<textarea rows="4" cols="5" name = "description" placeholder="Description..." class="form-control"></textarea>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</form>' +
                    '</div>' +
                    '</div>',
                    buttons: {
                        success: {
                            label: "Add Permission",
                            className: "btn-success",
                            callback: function () {
                                var form = $('#add_role_form');
                                $.ajax({
                                    url:  JS_BASE_URL +'/users/savePermission',
                                    type : 'POST',
                                    dataType: 'json',
                                    data: form.serialize(),
                                    success: function(res) {
                                        var dbmil = $('.datatable-milestone-list').dataTable();
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



