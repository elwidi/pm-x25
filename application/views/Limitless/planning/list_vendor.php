<!-- Project list -->
<div class="panel panel-flat">
    <div class = "row m-10">
        <a href="#">
            <button class = "btn bg-success btn-labeled" id = "add_vendor"><b><i class="icon-plus2"></i></b>Add Vendor</button>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table text-nowrap datatable-vendor-list">
            <thead>
            <tr>
                <th>No</th>
                <th>Vendor Name</th>
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

<div id="modal_vendors" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Vendors</h5>
            </div>

            <div class="modal-body ">
                <div class="col-lg-12">
                    <form method = "POST"  action = "" id = "vendor_form" class = "form-validate-jquery">
                        <div class="form-group">
                           <div class="row">
                                <div class="col-sm-12">
                                     <label>Name</label>
                                     <input type="hidden" name="vendor_id" id = "vendor_id">
                                     <input type="text" name="vendor_name" id ="vendor_name" class = "form-control">
                                </div> 
                            </div>
                        </div>

                        <div class="form-group">
                           <div class="row">
                                <div class="col-sm-12">
                                     <label>Address</label>
                                     <input type="text" name="vendor_address" id ="vendor_address" class = "form-control">
                                </div> 
                            </div>
                        </div>

                        <div class="form-group">
                           <div class="row">
                                <div class="col-sm-6">
                                     <label>Email</label>
                                     <input type="text" name="vendor_email" id ="vendor_email" class = "form-control">
                                </div> 
                                <div class="col-sm-6">
                                     <label>Phone</label>
                                     <input type="text" name="vendor_phone" id ="vendor_phone" class = "form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Other Details</label>
                                    <textarea class = "form-control" name = "vendor_details" id = "vendor_details"></textarea>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-close" data-dismiss="modal">Close</button>
                <button type="submit" name = "submit_form" value = "true" class="btn btn-primary">Save</button>
            </div>
            </form> 
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#add_vendor').click(function(){
            $('#vendor_id').val('');
            $('#vendor_form')[0].reset();
            $("#modal_vendors").modal('show');
        });

        $('#vendor_form').submit(function(e){
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: JS_BASE_URL + '/planning/save_vendor/',
                type: 'POST',
                dataType: 'json',
                data: form.serialize(),
                async: false,
                success: function (res) {
                    if (res.status == 'success') {
                        var table1 = $('.datatable-vendor-list').dataTable();
                        alertSuccess();
                        $('#modal_vendors').modal('toggle');
                        table1.api().ajax.reload();
                    }
                }
            });
        });
    });
</script>


