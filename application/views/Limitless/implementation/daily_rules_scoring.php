<script type="text/javascript" src="<?php echo base_url();?>themes/Limitless/default/assets/js/plugins/editors/summernote/summernote.min.js"></script>
<!-- Project list -->
<div class="panel panel-flat">
    <!-- <div class = "row m-10">
        <a href="#">
            <button class = "btn bg-success btn-labeled" id = "add_vendor"><b><i class="icon-plus2"></i></b>Add Vendor</button>
        </a>
    </div> -->

    <div class="table-responsive">
        <table class="table text-nowrap datatable-rules-list">
            <thead>
            <tr>
                <th>No</th>
                <th>Code</th>
                <th>Name</th>
                <th>Point</th>
                <th style="width: 20px;"><i class="icon-arrow-down12"></i></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
</div>

<div id="modal_rules" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Rules and Scoring</h5>
            </div>
 
            <div class="modal-body ">
                <div class="col-lg-12">
                    <form method = "POST"  action = "" id = "rule_form" class = "form-validate-jquery">
                        <div class="form-group">
                           <div class="row">
                                <div class="col-sm-12">
                                     <label>Code</label>
                                     <input type="hidden" name="rule_id" id = "rule_id">
                                     <input type="text" name="rule_code" id ="rule_code" class = "form-control">
                                </div> 
                            </div>
                        </div>

                        <div class="form-group">
                           <div class="row">
                                <div class="col-sm-12">
                                     <label>Name</label>
                                     <input type="text" name="rule_name" id ="rule_name" class = "form-control">
                                </div> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Description</label>
                                    <textarea class = "form-control" name = "rule_description" id = "rule_description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                                <div class="col-sm-12">
                                     <label>Point</label>
                                     <input type="text" name="rule_point" id ="rule_point" class = "form-control">
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


<div id="view_rules" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Rules and Scoring</h5>
            </div>
 
            <div class="modal-body ">
                <div class="col-lg-12">
                    <form method = "POST"  action = "" id = "rule_form" class = "form-validate-jquery">
                        <div class="form-group">
                           <div class="row">
                                <div class="col-sm-12">
                                     <label class = 'text-semibold'>Code</label>
                                     <!-- <input type="hidden" name="rule_id" id = "rule_id"> -->
                                     <div class="form-control-static" id = "code_rule"></div>
                                </div> 
                            </div>
                        </div>

                        <div class="form-group">
                           <div class="row">
                                <div class="col-sm-12">
                                     <label class = 'text-semibold'>Name</label>
                                     <div class="form-control-static" id = "name_rule"></div>
                                     <!-- <input type="text" name="rule_name" id ="rule_name" class = "form-control"> -->
                                </div> 
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class = 'text-semibold'>Description</label>
                                    <div class="form-control-static" id = "desc_rule"></div>
                                    <!-- <textarea class = "form-control" name = "rule_description" id = "rule_description"></textarea> -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                                <div class="col-sm-12">
                                     <label class = 'text-semibold'>Point</label>
                                     <div class="form-control-static" id = "point_rule"></div>
                                     <!-- <input type="text" name="rule_point" id ="rule_point" class = "form-control"> -->
                                </div> 
                            </div>
                        </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-close" data-dismiss="modal">Close</button>
            </div>
            </form> 
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#rule_form').submit(function(e){
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: JS_BASE_URL + '/implementation/save_rule/',
                type: 'POST',
                dataType: 'json',
                data: form.serialize(),
                async: false,
                success: function (res) {
                    if (res.status == 'success') {
                        var table1 = $('.datatable-rules-list').dataTable();
                        alertSuccess();
                        $('#modal_rules').modal('toggle');
                        table1.api().ajax.reload();
                    }
                }
            });
        });
    });
</script>


