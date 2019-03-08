<!-- Project list -->
<div class="panel panel-flat">
    <div class = "row m-10">
        <a href="#">
            <button class = "btn bg-success btn-labeled" id = "add_tools"><b><i class="icon-plus2"></i></b>Add Customer</button>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table text-nowrap datatable-customer-list">
            <thead>
            <tr>
                <th>No</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Detail</th>
                <th style="width: 20px;"><i class="icon-arrow-down12"></i></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#add_tools').on('click', function() {
            bootbox.dialog({
                    title: "Add Customer",
                    message: '<div class="row"> ' +
                    '<div class="col-md-12">' +
                    '<form action="#" id = "add_user_form">' +
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-12">' +
                    '<label>Customer Name</label> '+
                    '<input type="text" class="form-control" name = "customer_name" id = "customer_name" value="">'+
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
                }
            );

        });


    });
</script>


