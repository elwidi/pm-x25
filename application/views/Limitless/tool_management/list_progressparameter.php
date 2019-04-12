<!-- Project list -->
<div class="panel panel-flat">
    <div class = "row m-10">
        <a href="#">
            <button class = "btn bg-success btn-labeled" id = "add_parameter"><b><i class="icon-plus2"></i></b>Add Parameter</button>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table text-nowrap datatable-progress-parameter-list">
            <thead>
            <tr>
                <th>No.</th>
                <th>Parameter</th>
                <th>Measurement</th>
                <th>Milestone Group</th>                
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
        $('#add_parameter').on('click', function() {
            var groupName = "", uomName = "";
            <?php foreach ($milestone_group as $key => $value) { ?>
            groupName += '<option value="<?php echo $value->id ?>"><?php echo $value->group_name ?></option>';
            <?php }?>
            <?php foreach ($milestone_uom as $key => $value) { ?>
            uomName += '<option value="<?php echo $value->id ?>"><?php echo $value->uom_name ?></option>';
            <?php }?>
            bootbox.dialog({
                    title: "Add Progress Parameter",
                    message: '<div class="row"> ' +
                    '<div class="col-md-12">' +
                    '<form action="#" id = "add_progress_parameter">' +
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-12">' +
                    '<label>Milestone Group</label> '+
                    '<select id="ms_group_id" name="ms_group_id" data-placeholder="" class="select">'+
                    groupName +
                    '</select>' +
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-12">' +
                    '<label>Parameter Name</label> '+
                    '<input type="text" class="form-control" name = "parameter_name" value="">'+
                    '</div>'+
                    '</div>'+
                    '</div>'+                                        
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-12">' +
                    '<label>Measurement</label> '+
                    '<select name="measurement_id" data-placeholder="" class="select">'+
                    uomName +
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
                                var form = $('#add_progress_parameter');
                                $.ajax({
                                    url:  JS_BASE_URL +'/toolManagement/addProgressParameter/',
                                    type : 'POST',
                                    dataType: 'json',
                                    data: form.serialize(),
                                    success: function(res) {                                        
                                        var dbmil = $('.datatable-progress-parameter-list').dataTable();
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


