<!-- Project list -->
<div class="panel panel-flat">
    <form id = "add_permission_form" method = "POST" action = "<?php echo base_url();?>/administration/updateRolePermission">

    <div class = "row m-10">
        <table class="table table-borderless text-nowrap">
            <tbody>
            <tr>
                <th style="width: 50px">Role Name : </th>
                <th style="width: 300px"><?php echo $role->role_name; ?></th>
            </tr>
            </tbody>
        </table>
    </div>

        <div class = "row m-20">
            <a href="#">
                <input type = "submit" class = "btn bg-success" id = "add_permission" <?php echo $dissabled?> value = "Save Permission"/>
            </a>
        </div>


        <div class="row">

            <!--<div class = "col-md-3 m-20">
                <div class="form-group pt-15">
                    <label class="display-block text-semibold">Left stacked styled</label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="styled">Checked styled
                        </label>
                    </div>
                </div>
            </div>-->
            <div class = "col-md-11 m-20">
                <input type = "hidden" name = "role_id" value = "<?php echo $role->id?>"? />
                <div class="panel-group content-group-md">
                    <?php foreach($menu as $i => $m){?>
                    <!---from here!--->
                    <div class="panel panel-white">
                        <div class="panel-heading">
                        <h6 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group<?php echo $i?>"><?php echo $m->name?></a>
                        </h6>
                    </div>
                        <div id="accordion-group<?php echo $i?>" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class = "row">
                                <?php foreach ($m->submenu as $k => $sub) {?>
                                <div class = "col-md-4">
                                    <div class="form-group pt-15">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" <?php echo $dissabled?> class="styled head" menu_id = "<?php echo $sub->id_menu ?>"> <p class="text-semibold"><?php echo $sub->name?></p>
                                            </label>
                                        </div>
<!--                                        <label class="text-semibold"><input type="checkbox" class="styled head" > --><!--</label>-->
                                        <?php foreach ($sub->permission as $d => $p) {?>
                                        <div class="checkbox">
                                            <?php
                                            $checked = "";
                                            if($p->havePermission ==1) $checked = 'checked = "checked"'?>
                                            <label>
                                                <input type="checkbox" <?php echo $dissabled?> name = "P<?php echo $p->id_permission?>" value = "1" class="styled m-<?php echo $sub->id_menu?>-c" <?php echo $checked .'">'. $p->name?>
                                            </label>
                                        </div>
                                        <?php }?>

                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php }?>
                    <!---to here!--->
                </div>
            </div>
        </div>
        </form>
    </div>
    <div class="table-responsive">
        <!--<table class="table text-nowrap datatable-role-permission-list">
            <thead>
            <tr>
                 <th style="width: 5px"></th>
                <th style="width: 300px">Role Name</th>
                <th style="width: 500px">Description</th>
                <th style="width: 5px;"><i class="icon-arrow-down12"></i></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>-->

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
            var c = ".m-"+$(this).attr('menu_id')+"-c";
            var s = c + ":not(:checked)"
            if($(c).length != 0){
                if($(s).length == 0){
                    $(this).prop('checked', true);
                    $(this).parent().addClass('checked');
                }
            }
        });
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