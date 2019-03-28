<!-- Project list -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Projects list<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements" style="right: 130px;">
            <!-- <div class="col-sm-2"> -->
                <select id="status_project" class="form-control select">
                    <option value="On Progress">On Progress</option>
                    <option value="Complete">Complete</option>
                    <option value="Cancel">Cancel</option>
                    <option value="Early Stage">Early Stage</option>
                </select>
            <!-- </?Sdiv> -->
        </div>
        <a class = "btn pull-right btn-default" href = "<?php echo base_url();?>Planning/expExcel" style="margin-top: -33px;">Export Excel</a>
    </div>

    <div class="table-responsive">
        <table class="table text-nowrap datatable-projects-list">
            <thead>
            <tr>
                <th>No</th>
                <th>Project ID</th>
                <th>Project name</th>
                <th>Status</th>
                <th>Completion</th>
                <th>Customer</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Category</th>
                <th class="text-center text-muted" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!-- /project list -->

<!-- Vertical form modal -->
<div id="modal_form_vertical" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Create New Project</h5>
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
</div>
<!-- /vertical form modal -->

<script type="text/javascript">
    $(function () {
        var dbproject = $('.datatable-projects-list').dataTable();
        dbproject.api().columns(6)
               .search('On Progress')
               .draw();
        $('#status_project').on( 'change', function () {
            dbproject.api().columns(6)
               .search( this.value )
               .draw();
        });
   });
</script>

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




