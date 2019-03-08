<!-- Project list -->
<div class="panel panel-flat">
    <div class = "row m-10">
        <a href="#">
            <button class = "btn bg-success btn-labeled" id = "add_user"><b><i class="icon-plus2"></i></b>Add User</button>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table text-nowrap datatable-user-list">
            <thead>
            <tr>
                <!-- <th style="width: 5px"></th> -->
                <th style="">UserID</th>
                <th style="">Name</th>
                <th style="">Email</th>
                <th style="">Divisi</th>
                <th style="">Role</th>
                <th style="">Status</th>
<!--                <th>Team</th>-->
<!--                <th>Start date</th>-->
<!--                <th>End date</th>-->
<!--                <th>Category</th>-->
                <th style="width: 20px;"><i class="icon-arrow-down12"></i></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
</div>

<div id="modal_add_user" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">User</h5>
            </div>

            <div class="modal-body ">
                <div class="col-lg-12">
                    <form method = "POST"  id = "add_user_form" enctype="multipart/form-data" class = "form-validate-jquery">
                          <div class="form-group">
                               <div class="row">
                                    <div class="col-sm-6">
                                         <label>Name</label> 
                                         <!-- <select id="emp_name" name="emp_id" data-placeholder="Test" class="select">
                                            <?php foreach ($user as $k => $v) { ?>
                                            <option value="<?php echo $v->employee_id?>" <?php echo $v->attr?>><?php echo $v->employee_name ?></option>
                                            <?php }?>
                                         </select> -->
                                         <select id="emp_name" name="emp_id" data-placeholder="Select employee name" class="select">
                                            <?php foreach ($user as $k => $value) { ?>
                                            <option value="<?php echo $value->employee_id ?>" <?php echo $v->attr?>><?php echo $value->employee_name ?></option>
                                            <?php }?>
                                         </select>
                                         <input type = "hidden" name = "emp_fullname" id = "emp_fullname">
                                    </div> 
                                    <div class="col-sm-6">
                                         <label>Email</label> 
                                         <input type="text" id = "email" name = "email" class="form-control"> 
                                    </div> 
                                </div>
                          </div>
                          <div class="form-group"> 
                            <div class="row">
                                <div class="col-sm-12"> 
                                <label class="checkbox-inline text-semibold">
                                        <input type="checkbox" id = "all_project" value = "1" class="styled item" name = "all_project">
                                        All Project
                                    </label> 
                            </div>
                            </div>
                        </div>
                          <div class="form-group"> 
                            <div class="row">
                                <div class="col-sm-12"> 
                                <label>Assign to Project</label> 
                                <input type="hidden" id = "user_id" name = "user_id" class="form-control"> 
                                <select disabled id="project" name="project[]" data-placeholder="Select project" class="select" multiple ="multiple">
                                    <option value="" dissabled>Select projects</option>
                                    <?php foreach ($projects as $i => $f) { ?>
                                    <option value="<?php echo $f->id?>"><?php echo $f->project_id ." - ".$f->project_name ?></option>
                                    <?php }?>
                                </select> 
                            </div>
                            </div>
                        </div>
                        <div class="row">
                               <div class="col-sm-6">
                                    <div class="form-group"> 
                                         <label>Divisi/Department</label> 
                                         <select id="department" name="department" data-placeholder="Select department" class="select">
                                            <?php foreach ($dept as $key => $value) { ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->department_name ?></option>
                                            <?php }?>
                                         </select>
                                    </div> 
                               </div>
                               <div class="col-sm-6">
                                    <div class="form-group"> 
                                         <label>Area Assigned</label> 
                                         <input type="text" class="form-control" id = "area_assigned" name = "area_assigned">
                                    </div> 
                               </div>
                          </div>
                          <div class="row">
                               <div class="col-sm-12">
                                    <div class="form-group"> 
                                         <label>Role</label> 
                                         <select id="roles" name="role" data-placeholder="Select roles" class="select">
                                            <?php foreach ($role as $key => $value) { ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->role_name ?></option>
                                            <?php }?>
                                         </select>
                                    </div> 
                               </div>
                          </div>
                          <div class = "permission-list">
                                <p class = "text-semibold">Role Permission</p>
                                <?php foreach($menu as $i => $m) { ?>
                                    <?php foreach ($m->submenu as $k => $sub) {?>
                                    <div class = 'col-md-4'>
                                    <div class="form-group pt-15">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="styled head" menu_id = "<?php echo $sub->id_menu ?>">
                                                <p class = "text-semibold"><?php echo $sub->name?></p>
                                            </label>
                                        </div>
                                        <?php foreach ($sub->permission as $d => $p) {?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="styled m-<?php echo $sub->id_menu?>-c" name = "permission[<?php echo $p->id_permission?>]" value = "<?php echo $p->id_permission?>">
                                                <?php echo $p->name?>
                                            </label>
                                        </div>
                                        <?php } ?>
                                    </div> 
                                    </div>
                                    <?php }?>
                                <?php }?>
                          </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="submit" name = "submit_form" value = "true" class="btn btn-primary">Save</button>
            </div>
            </form> 
        </div>
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

        $( ".head" ).each(function( index ) {
//            console.log();
            var c = ".m-"+$(this).attr('menu_id')+"-c";
            var s = c + ":not(:checked)"
            if($(c).length != 0){
                if($(s).length == 0){
                    $(this).prop('checked', true);
                    $(this).parent().addClass('checked');
                }
            }
        });

        $(".item").change(function() {
            if(this.checked) {
                $('#project').val("");
                $('#project').prop('disabled', true);
            } else {
                $('#project').prop('disabled', false);
            }
        });

        $('#add_user').on('click', function() {
            $('.permission-list').addClass('hidden');
            $('#modal_add_user').modal('show');
            $('#emp_name').on('change',function(){
                var values = $(this).val();
                $.ajax({
                    url: JS_BASE_URL + '/administration/getEmpDetail',
                    type: 'POST',
                    data : {emp_code : values},
                    dataType: 'json',
                    async: false,
                    success: function (res) {
                        $("#emp_fullname").val(res.fullname);
                        $("#email").val(res.email);
                    }
                });
            });
            $('#user_id').val('');
            $('#add_user_form')[0].reset();
            $('#roles').on('change',function(){
                $('input[name="checkbox"]').prop('checked', false);
                $('input[type="checkbox"]').parent().removeClass('checked');
                role_id = $(this).val();
                $.ajax({
                    url: JS_BASE_URL + '/administration/role_permission',
                    type: 'POST',
                    data : {role : role_id},
                    dataType: 'json',
                    async: false,
                    success: function (res) {
                        if (res.status == 'Success') {
                            $.each(res.data, function (i, val) {
                                cat = 'permission['+val+']';
                                // cat = 'P'+val;
                                $('input[name="'+cat+'"]').prop('checked', true);
                                $('input[name="'+cat+'"]').parent().addClass('checked');
                            });

                            $( ".head" ).each(function( index ) {
                                var c = ".m-"+$(this).attr('menu_id')+"-c";
                                var s = c + ":not(:checked)"
                                if($(c).length != 0){
                                    console.log($(s));
                                    if($(s).length == 0){
                                        // console.log('kecentang semua');
                                        $(this).prop('checked', true);
                                        $(this).parent().addClass('checked');
                                    } else {
                                        $(this).parent().removeClass('checked');
                                    }
                                }
                            });
                        }

                    }
                });
                $('.permission-list').removeClass('hidden');

            });
            $('.select').select2();


        });
//        
       /* $('#add_user').on('click', function() {
            bootbox.dialog({
                    title: "Add User",
                    message: '<div class="row"> ' +
                    '<div class="col-lg-12">' +
                    '<form action="#" id = "add_user_form">' +
                    '<div class="form-group">' +
                    '<div class="row">'+
                    '<div class="col-sm-6">'+
                    '<label>Email</label> '+
                    '<select id="emp_name" name="fullname" data-placeholder="Test" class="select">'+
                    option2 +
                    '</select>' +
                    '</div> '+
                    '<div class="col-sm-6">'+
                    '<label>Name</label> '+
                    '<input type="text" name = "email" class="form-control"> '+
                    '</div> '+
                    '</div>'+
                    '</div>'+
                    '<div class="row">'+
                    '<div class="col-sm-12">'+
                    '<div class="form-group"> '+
                    '<label>Role</label> '+
                    '<select id="country" name="role" data-placeholder="Test" class="select">'+
                    option +
                    '</select>' +
                    '</div> ' +
                    '</div>' +
                    '</div>' +
                    '<div class = "permission-list">'+
                    '</div>' +
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
                                    url:  JS_BASE_URL +'/administration/addUser',
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
            ).find("div.modal-dialog").addClass("modal-lg");

            $('.select').parents('.bootbox').removeAttr('tabindex');
            $('.select').select2();
            // Single picker
            $('.daterange-single').daterangepicker({
                singleDatePicker: true,
            });

            $('#emp_name').on('change',function(){
                var row = '<div class = "prepend"';
                row += '<p>Test</p>';
                row += '<div class="form-group pt-15">';
                row += '<label class="display-block text-semibold">Left stacked styled</label>';
                row += '<div class="checkbox">';
                row += '<label>';
                row += '<div class="checker"><span><input type="checkbox" class="styled"></span></div>';
                // row += '<input type="checkbox" class="styled" checked="checked">';
                row += 'Checked styled';
                row += '</label>';
                row += '</div>';
                row += '</div>';
                row += '</div>';
                row += '</div>';

                $(".permission-list").append(row);
            });
        });*/
    });

    $(".head").change(function() {
        var m = $(this).attr('menu_id');
        console.log(m);
        if(this.checked) {
            changeCheck(m);
        } else {
            removeCheck(m);
        }
    });

    function changeCheck(m)
    {
        var c = ".m-"+m+"-c";
        $(c).parent().removeClass('checked');
        $(c).prop('checked', true);
        $(c).parent().addClass('checked');
    }

    function removeCheck(m)
    {
        var c = ".m-"+m+"-c";
        $(c).parent().removeClass('checked');
        $(c).removeAttr('checked');
    }
</script>

