<!-- Project list -->
<div class="panel panel-flat">
    <div class = "row m-10">
        <a href="#">
            <button class = "btn bg-success btn-labeled" id = "add_tools"><b><i class="icon-plus2"></i></b>Add Tools</button>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table text-nowrap datatable-tools-list">
            <thead>
            <tr>
                <th>Tool Description</th>
                <th>PR Number</th>
                <th>PR Date</th>
                <th>PO Number</th>
                <th>PO Date</th>
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
            var option = "";
            <?php foreach ($tools as $key => $value) { ?>
            option += '<option value="<?php echo $value->id ?>"><?php echo $value->tools_name ?></option>';
            <?php }?>
            bootbox.dialog({
                    title: "Add Tool Inventory",
                    message: '<div class="row"> ' +
                    '<div class="col-md-12">' +
                    '<form action="#" id = "add_user_form">' +
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-12">' +
                    '<label>Tool</label> '+
                    '<select id="tools_id" name="tools_id" data-placeholder="" class="select">'+
                    option +
                    '</select>' +
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-12">' +
                    '<label>Tools Description</label> '+
                    '<input type="text" class="form-control" name = "description" value="">'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">' +
                    '<li class="active"><a href="#a" data-toggle="tab" aria-expanded="true">PO/PR</a></li>' +
                    ' <li class=""><a href="#b" data-toggle="tab" aria-expanded="false">Detail</a></li>' +
                    ' <li class=""><a href="#c" data-toggle="tab" aria-expanded="false">Condition</a></li>' +
                    ' <li class=""><a href="#d" data-toggle="tab" aria-expanded="false">Remarks</a></li>' +
                    '</ul>' +
                    '<div class="tab-content">' +
                    '<div class="tab-pane fade active in" id="a">' +
                    '<div class="form-group mt-10">' +
                    '<div class="row">'+
                    '<div class="col-sm-6">' +
                    '<label>PR Number</label> '+
                    '<input type="text" class="form-control" name = "pr_number" value="">'+
                    '</div>'+
                    '<div class="col-sm-6">' +
                    '<label>PO Number</label> '+
                    '<input type="text" id = "po_number" name = "po_number" class="form-control "> '+
                    '</div> '+
                    '</div> '+
                    '</div> '+
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-6">' +
                    '<label>PR Date</label> '+
                    '<input type="text" id = "pr_date" name = "pr_date" class="form-control daterange-single"> '+
                    '</div>'+
                    '<div class="col-sm-6">' +
                    '<label>PO Date</label> '+
                    '<input type="text" id = "po_date" name = "po_date" class="form-control daterange-single"> '+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="tab-pane fade" id="b">' +
                    '<div class="form-group mt-10">' +
                    '<div class="row">'+
                    '<div class="col-sm-6">' +
                    '<label>Brand</label> '+
                    '<input type="text" id = "brand" name = "brand" class="form-control"> '+
                    '</div>'+
                    '<div class="col-sm-6">' +
                    '<label>Type</label> '+
                    '<input type="text" id = "type" name = "type" class="form-control"> '+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-6">' +
                    '<label>Serial Number</label> '+
                    '<input type="text" id = "serial_number" name = "serial_number" class="form-control"> '+
                    '</div>'+
                    '<div class="col-sm-6">' +
                    '<label>Waranty</label> '+
                    '<input type="text" id = "waranty" name = "waranty" class="form-control"> '+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="tab-pane fade" id="c">' +
                    '<div class="form-group mt-10">' +
                    '<div class="row">'+
                    '<div class="col-sm-6">' +
                    '<label>Current Area/Position</label> '+
                    '<input type="text" id = "current_area" name = "current_area" class="form-control"> '+
                    '</div>'+
                    '<div class="col-sm-6">' +
                    '<label>Condition</label> '+
                    '<input type="text" id = "condition" name = "condition" class="form-control"> '+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-6">' +
                    '<label>New/Rent</label> '+
                    '<select id="new" name="new" data-placeholder="" class="select">'+
                    '<option value="" dissabled>Select</option>'+
                    '<option value="new">New</option>'+
                    '<option value="rent">Rent</option>'+
                    '</select>' +
                    '</div>'+
                    '<div class="col-sm-6">' +
                    '<label>Price</label> '+
                    '<input type="text" id = "price" pattern="[0-9.]+" name = "price" class="form-control"> '+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="tab-pane fade" id="d">' +
                    '<div class="form-group mt-10">' +
                    '<div class="row">'+
                    '<div class="col-sm-12">' +
                    '<label>Remarks</label> '+
                    '<textarea rows="4" cols="5" name = "remarks" placeholder="Description..." class="form-control"></textarea>' +
                    '</div>'+
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
                                    url:  JS_BASE_URL +'/toolManagement/addTools/',
                                    type : 'POST',
                                    dataType: 'json',
                                    data: form.serialize(),
                                    success: function(res) {
                                        var dbmil = $('.datatable-tools-list').dataTable();
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
            /*$('.daterange-single').daterangepicker({
                singleDatePicker: true,
            });*/

            $('#po_date').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'DD-MM-YYYY'
                },
                autoUpdateInput :false
                }, function(startDate, label){
                $('#po_date').val(startDate.format('DD-MM-YYYY'));
            });

            $('#pr_date').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'DD-MM-YYYY'
                },
                autoUpdateInput :false
                }, function(startDate, label){
                $('#pr_date').val(startDate.format('DD-MM-YYYY'));
            });

        });


    });
</script>


