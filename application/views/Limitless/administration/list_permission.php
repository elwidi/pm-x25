<!-- Project list -->
<div class="panel panel-flat">
    <div class = "row m-10">
        <a href="#">
            <button class = "btn bg-success btn-labeled" id = "add_permission"><b><i class="icon-plus2"></i></b>Add Permission</button>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table text-nowrap datatable-permission-list">
            <thead>
            <tr>
                <!-- <th style="width: 5px"></th> -->
                <th style="width: 300px">Permission Name</th>
                <th style="width: 500px">Description</th>
                <th style="width: 50px"></th>
                <th style="width: 50px"></th>
                <th style="width: 50px"></th>
                <th style="width: 50px"></th>
                <th style="width: 50px">Menu</th>
                <th style="width: 5px;"><i class="icon-arrow-down12"></i></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
</div>
<!-- /project list -->

<!-- Vertical form modal -->
<!--<div id="modal_form_vertical" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Add User</h5>
            </div>

            <form action="#">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>First name</label>
                                <input type="text" placeholder="Eugene" class="form-control">
                            </div>

                            <div class="col-sm-6">
                                <label>Last name</label>
                                <input type="text" placeholder="Kopyov" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Address line 1</label>
                                <input type="text" placeholder="Ring street 12" class="form-control">
                            </div>

                            <div class="col-sm-6">
                                <label>Address line 2</label>
                                <input type="text" placeholder="building D, flat #67" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>City</label>
                                <input type="text" placeholder="Munich" class="form-control">
                            </div>

                            <div class="col-sm-4">
                                <label>State/Province</label>
                                <input type="text" placeholder="Bayern" class="form-control">
                            </div>

                            <div class="col-sm-4">
                                <label>ZIP code</label>
                                <input type="text" placeholder="1031" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Email</label>
                                <input type="text" placeholder="eugene@kopyov.com" class="form-control">
                                <span class="help-block">name@domain.com</span>
                            </div>

                            <div class="col-sm-6">
                                <label>Phone #</label>
                                <input type="text" placeholder="+99-99-9999-9999" data-mask="+99-99-9999-9999" class="form-control">
                                <span class="help-block">+99-99-9999-9999</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</div>-->
<!-- /vertical form modal -->

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
        <?php foreach ($menu as $key => $value) { ?>
            option += '<option value="<?php echo $value->id_menu ?>"><?php echo $value->name ?></option>';
        <?php }?>
        $('#add_permission').on('click', function() {
            bootbox.dialog({
                    title: "Add Permission",
                    message: '<div class="row"> ' +
                    '<div class="col-md-12">' +
                    '<form action="#" id = "add_permission_form">' +
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-12">'+
                    '<label>Permission Name</label> '+
                    '<input type="text" name = "permission_name" class="form-control"> '+
                    '</div> '+
                    '</div> '+
                    '</div>'+
                    '<div class="row">'+
                    '<div class="col-sm-12">'+
                    '<div class="form-group"> '+
                    '<label>Menu</label> '+
                    '<select id="country" name="menu" data-placeholder="Test" class="select company">'+
                    option +
                    '</select>' +
                    '</div> ' +
                    '</div>' +
                    '</div>' +
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
                                var form = $('#add_permission_form');
                                $.ajax({
                                    url:  JS_BASE_URL +'/users/savePermission',
                                    type : 'POST',
                                    dataType: 'json',
                                    data: form.serialize(),
                                    success: function(res) {
                                        var dbmil = $('.datatable-permission-list').dataTable();
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



