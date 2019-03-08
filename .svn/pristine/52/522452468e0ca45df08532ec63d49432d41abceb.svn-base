<!-- Project list -->
<div class="panel panel-flat">
    <div class = "row m-10">
        <a href="#">
            <button class = "btn bg-success btn-labeled" id = "add_tools"><b><i class="icon-plus2"></i></b>Add</button>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table text-nowrap datatable-transmittal-daily-list">
            <thead>
            <tr>
                <th>Tool Description</th>
                <th>Serial Number</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Dikembalikan</th>
                <th>Remark</th>
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

            var projects = "";
            <?php foreach ($project as $key => $value) { ?>
            projects += '<option value="<?php echo $value->id ?>"><?php echo $value->project_name ?></option>';
            <?php }?>

            var pic = "<option value = ''>Select PIC</option>";
            <?php foreach ($pic as $key => $value) { ?>
            pic += '<option value="<?php echo $value->id ?>"><?php echo $value->fullname ?></option>';
            <?php }?>
            bootbox.dialog({
                    title: "Add",
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
                    '<label>Serial Number</label> '+
                    '<input type="text" class="form-control" name = "serial_number" id = "serial_number" value="">'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">' +
                    '<li class="active"><a href="#a" data-toggle="tab" aria-expanded="true">Borrowing</a></li>' +
                    ' <li class=""><a href="#b" data-toggle="tab" aria-expanded="false">Returning</a></li>' +
                    ' <li class=""><a href="#c" data-toggle="tab" aria-expanded="false">Remarks</a></li>' +
                    '</ul>' +
                    '<div class="tab-content">' +
                    '<div class="tab-pane fade active in" id="a">' +
                    '<div class="form-group mt-10">' +
                    '<div class="row">'+
                    '<div class="col-sm-6">' +
                    '<label>Date of Borrowing</label> '+
                    '<input type="text" id = "date_of_borrowing" name = "date_of_borrowing" class="form-control daterange-single"> '+
                    '</div>'+
                    '<div class="col-sm-6">' +
                    '<label>for Project/Area</label> '+
                    '<select id="project_id" name="project_id" data-placeholder="" class="select">'+
                    projects +
                    '</select>' +
                    '</div> '+
                    '</div> '+
                    '</div> '+
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-6">' +
                    '<label>PIC</label> '+
                    '<select id="pic_borrowers" name="pic_borrowers" data-placeholder="" class="select">'+
                    pic +
                    '</select>' +
                    '</div>'+
                    '<div class="col-sm-6">' +
                    '<label>Condition</label> '+
                    '<input type="text" id = "conditions_of_borrowing" name = "conditions_of_borrowing" class="form-control"> '+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="tab-pane fade" id="b">' +
                    '<div class="form-group mt-10">' +
                    '<div class="row">'+
                    '<div class="col-sm-6">' +
                    '<label>Date of Returning</label> '+
                    '<input type="text" id = "date_of_returning" name = "date_of_returning" class="form-control daterange-single"> '+
                    '</div>'+
                    '<div class="col-sm-6">' +
                    '<label>PIC</label> '+
                    '<select id="pic_returning" name="pic_returning" data-placeholder="" class="select">'+
                    pic +
                    '</select>' +
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-12">' +
                    '<label>Condition</label> '+
                    '<input type="text" id = "conditions_of_returning" name = "conditions_of_returning" class="form-control"> '+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="tab-pane fade" id="c">' +
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
                            label: "Add",
                            className: "btn-success",
                            callback: function () {
                                var form = $('#add_user_form');
                                $.ajax({
                                    url:  JS_BASE_URL +'/toolManagement/saveTransmit/',
                                    type : 'POST',
                                    dataType: 'json',
                                    data: form.serialize(),
                                    success: function(res) {
                                        var dbmil = $('.datatable-transmittal-daily-list').dataTable();
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

            $('.select').parents('.bootbox').removeAttr('tabindex');
            $('.select').select2();

            // Single picker
            /*$('.daterange-single').daterangepicker({
                singleDatePicker: true,
            });*/

            $('#date_of_borrowing').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'DD-MM-YYYY'
                },
                autoUpdateInput :false
                }, function(startDate, label){
                $('#date_of_borrowing').val(startDate.format('DD-MM-YYYY'));
            });

            $('#date_of_returning').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'DD-MM-YYYY'
                },
                autoUpdateInput :false
                }, function(startDate, label){
                $('#date_of_returning').val(startDate.format('DD-MM-YYYY'));
            });

        });


    });
</script>


