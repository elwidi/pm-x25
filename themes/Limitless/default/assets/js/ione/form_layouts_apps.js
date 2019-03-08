/* ------------------------------------------------------------------------------

 *  # Form layouts
 *
 *  @Kardiwan <kardiwan@gmail.com>
 *
 * ---------------------------------------------------------------------------- */

$(function () {


    // Select2 select
    // ------------------------------

    // Basic
    $('.select').select2();

    $('.select-nosearch').select2({
        minimumResultsForSearch: Infinity
    });

    // Single picker
    $('.daterange-single').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: 'DD-MM-YYYY'
        },
    });


    //
    // Select with icons
    //

    // Format icon
    function iconFormat(icon) {
        var originalOption = icon.element;
        if (!icon.id) {
            return icon.text;
        }
        var $icon = "<i class='icon-" + $(icon.element).data('icon') + "'></i>" + icon.text;

        return $icon;
    }

    // Initialize with options
    $(".select-icons").select2({
        templateResult: iconFormat,
        minimumResultsForSearch: Infinity,
        templateSelection: iconFormat,
        escapeMarkup: function (m) {
            return m;
        }
    });


    // Styled form components
    // ------------------------------

    // Checkboxes, radios
    $(".styled").uniform({radioClass: 'choice'});

    // File input
    $(".file-styled").uniform({
        fileButtonClass: 'action btn bg-primary'
    });

    // Add date range switcher
    // ------------------------------

    // Menu
    var menu = $("#select_date").multiselect({
        buttonClass: 'btn btn-link text-semibold',
        enableHTML: true,
        dropRight: true,
        onChange: function () {
            change(), $.uniform.update();
        },
        buttonText: function (options, element) {
            var selected = '';
            options.each(function () {
                selected += $(this).html() + ', ';
            });
            return '<span class="status-mark border-warning position-left"></span>' + selected.substr(0, selected.length - 2);
        }
    });

    // Radios
    $(".multiselect-container input").uniform({radioClass: 'choice'});


    // Prompt travel request approval - Alert combination
    /*$('.prompt_travel_req_approval').on('click', function() {
     swal({
     title: "Are you sure?",
     text: "Are you sure you want to approve!",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#EF5350",
     confirmButtonText: "Yes, approve it!",
     cancelButtonText: "No, cancel pls!",
     closeOnConfirm: false,
     closeOnCancel: false,
     showLoaderOnConfirm: true
     },
     function(isConfirm){
     if (isConfirm) {

     setTimeout(function() {

     var travel_req_id =  $('#travel_req_id').val();
     var baseURL = window.location.protocol + '//' + window.location.hostname + '';
     var url = baseURL + "/selfservice/mss/approveTravelRequest/" + travel_req_id;

     $.ajax({
     type: "GET",
     url: url,
     async: false,
     dataType: "json",
     success: function (result) {
     if(result.status=='Success')
     {
     swal({
     title: "Approved!",
     text: "Your travel request has been approved.",
     confirmButtonColor: "#66BB6A",
     type: "success"
     },
     function(isConfirm){
     location.reload();
     });
     }
     }
     });

     }, 2000);

     }
     else {
     swal({
     title: "Cancelled",
     text: "cancel and not process anything.",
     confirmButtonColor: "#2196F3",
     type: "error"
     });
     }
     });
     });*/

    // Prompt Rejected
    /*$('.prompt_travel_req_reject').on('click', function() {
     swal({
     title: "Reject!",
     text: "Write something that is the reason:",
     type: "input",
     showCancelButton: true,
     confirmButtonColor: "#2196F3",
     closeOnConfirm: false,
     animation: "slide-from-top",
     inputPlaceholder: "Write something"
     },
     function(inputValue){
     if (inputValue === false) return false;
     if (inputValue === "") {
     swal.showInputError("You need to write something!");
     return false
     }

     var travel_req_id =  $('#travel_req_id').val();
     var baseURL = window.location.protocol + '//' + window.location.hostname + '';
     var url = baseURL + "/selfservice/mss/rejectTravelRequest/";

     var data = { travel_req_id: travel_req_id, reason_status: inputValue };

     $.ajax({
     type: "POST",
     url: url,
     data: data,
     async: false,
     dataType: "json",
     success: function (result) {
     if(result.status=='Success')
     {
     swal({
     title: "Rejected!",
     text: "You wrote: " + inputValue,
     type: "success",
     confirmButtonColor: "#2196F3"
     },
     function(isConfirm){
     location.reload();
     });
     }
     }
     });


     });
     });*/

    // Prompt Cancelled
    /* $('.prompt_travel_req_cancel').on('click', function() {
     swal({
     title: "Cancel!",
     text: "Write something that is the reason:",
     type: "input",
     showCancelButton: true,
     confirmButtonColor: "#2196F3",
     closeOnConfirm: false,
     animation: "slide-from-top",
     inputPlaceholder: "Write something"
     },
     function(inputValue){
     if (inputValue === false) return false;
     if (inputValue === "") {
     swal.showInputError("You need to write something!");
     return false
     }

     var travel_req_id =  $('#travel_req_id').val();
     var baseURL = window.location.protocol + '//' + window.location.hostname + '';
     var url = baseURL + "/selfservice/mss/cancelTravelRequest/";

     var data = { travel_req_id: travel_req_id, reason_status: inputValue };

     $.ajax({
     type: "POST",
     url: url,
     data: data,
     async: false,
     dataType: "json",
     success: function (result) {
     if(result.status=='Success')
     {
     swal({
     title: "Cancelled!",
     text: "You wrote: " + inputValue,
     type: "success",
     confirmButtonColor: "#2196F3"
     },
     function(isConfirm){
     location.reload();
     });
     }
     }
     });


     });
     });*/

    // Prompt travel claim approval - Alert combination
    /*$('.prompt_travel_claim_approval').on('click', function() {
     swal({
     title: "Are you sure?",
     text: "Are you sure you want to approve!",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#EF5350",
     confirmButtonText: "Yes, approve it!",
     cancelButtonText: "No, cancel pls!",
     closeOnConfirm: false,
     closeOnCancel: false,
     showLoaderOnConfirm: true
     },
     function(isConfirm){
     if (isConfirm) {

     setTimeout(function() {

     var travel_req_id =  $('#travel_req_id').val();
     var travel_claim_id =  $('#travel_claim_id').val();
     var baseURL = window.location.protocol + '//' + window.location.hostname + '';
     var url = baseURL + "/selfservice/mss/approveTravelClaim/" + travel_req_id + "/" + travel_claim_id;

     $.ajax({
     type: "GET",
     url: url,
     async: false,
     dataType: "json",
     success: function (result) {
     if(result.status=='Success')
     {
     swal({
     title: "Approved!",
     text: "Your travel request has been approved.",
     confirmButtonColor: "#66BB6A",
     type: "success"
     },
     function(isConfirm){
     location.reload();
     });
     }
     }
     });

     }, 2000);

     }
     else {
     swal({
     title: "Cancelled",
     text: "cancel and not process anything.",
     confirmButtonColor: "#2196F3",
     type: "error"
     });
     }
     });
     });*/

    // Prompt Rejected
    /*$('.prompt_travel_claim_reject').on('click', function() {
     swal({
     title: "Reject!",
     text: "Write something that is the reason:",
     type: "input",
     showCancelButton: true,
     confirmButtonColor: "#2196F3",
     closeOnConfirm: false,
     animation: "slide-from-top",
     inputPlaceholder: "Write something"
     },
     function(inputValue){
     if (inputValue === false) return false;
     if (inputValue === "") {
     swal.showInputError("You need to write something!");
     return false
     }

     var travel_req_id =  $('#travel_req_id').val();
     var travel_claim_id =  $('#travel_claim_id').val();
     var baseURL = window.location.protocol + '//' + window.location.hostname + '';
     var url = baseURL + "/selfservice/mss/rejectTravelClaim/";

     var data = { travel_req_id: travel_req_id, travel_claim_id: travel_claim_id, reason_status: inputValue };

     $.ajax({
     type: "POST",
     url: url,
     data: data,
     async: false,
     dataType: "json",
     success: function (result) {
     if(result.status=='Success')
     {
     swal({
     title: "Rejected!",
     text: "You wrote: " + inputValue,
     type: "success",
     confirmButtonColor: "#2196F3"
     },
     function(isConfirm){
     location.reload();
     });
     }
     }
     });


     });
     });
     */
    // Prompt Cancelled
    /*$('.prompt_travel_claim_cancel').on('click', function() {
     swal({
     title: "Cancel!",
     text: "Write something that is the reason:",
     type: "input",
     showCancelButton: true,
     confirmButtonColor: "#2196F3",
     closeOnConfirm: false,
     animation: "slide-from-top",
     inputPlaceholder: "Write something"
     },
     function(inputValue){
     if (inputValue === false) return false;
     if (inputValue === "") {
     swal.showInputError("You need to write something!");
     return false
     }

     var travel_req_id =  $('#travel_req_id').val();
     var travel_claim_id =  $('#travel_claim_id').val();
     var baseURL = window.location.protocol + '//' + window.location.hostname + '';
     var url = baseURL + "/selfservice/mss/cancelTravelClaim/";

     var data = { travel_req_id: travel_req_id, travel_claim_id: travel_claim_id, reason_status: inputValue };

     $.ajax({
     type: "POST",
     url: url,
     data: data,
     async: false,
     dataType: "json",
     success: function (result) {
     if(result.status=='Success')
     {
     swal({
     title: "Cancelled!",
     text: "You wrote: " + inputValue,
     type: "success",
     confirmButtonColor: "#2196F3"
     },
     function(isConfirm){
     location.reload();
     });
     }
     }
     });


     });
     });*/
    /*$('.emp_requisition_approve').on('click', function() {
     swal({
     title: "Are you sure?",
     text: "Are you sure you want to approve!",
     type: "warning",
     showCancelButton: true,
     confirmButtonColor: "#EF5350",
     confirmButtonText: "Yes, approve it!",
     cancelButtonText: "No, cancel pls!",
     closeOnConfirm: false,
     closeOnCancel: false
     },
     function(isConfirm){
     if (isConfirm) {
     var emp_requisition_id =  $('#emp_requisition_id').val();
     var baseURL = window.location.protocol + '//' + window.location.hostname + '';
     var url = baseURL + "/selfservice/mss/approveEmpRequisition/" + emp_requisition_id ;

     $.ajax({
     type: "GET",
     url: url,
     async: false,
     dataType: "json",
     success: function (result) {
     if(result.status=='Success')
     {
     swal({
     title: "Approved!",
     text: "Your employee requisition has been approved.",
     confirmButtonColor: "#66BB6A",
     type: "success"
     },
     function(isConfirm){
     location.reload();
     }
     );
     }
     }
     });
     }
     else {
     swal({
     title: "Cancelled",
     text: "cancel and not process anything.",
     confirmButtonColor: "#2196F3",
     type: "error"
     });
     }
     });
     });*/
    /*$('.emp_requisition_reject').on('click', function() {
     swal({
     title: "Reject!",
     text: "Write something that is the reason:",
     type: "input",
     showCancelButton: true,
     confirmButtonColor: "#2196F3",
     closeOnConfirm: false,
     animation: "slide-from-top",
     inputPlaceholder: "Write something"
     },
     function(inputValue){
     if (inputValue === false) return false;
     if (inputValue === "") {
     swal.showInputError("You need to write something!");
     return false
     }
     var emp_requisition_id =  $('#emp_requisition_id').val();
     var baseURL = window.location.protocol + '//' + window.location.hostname + '';
     var url = baseURL + "/selfservice/mss/rejectEmpRequisition/";

     var data = { emp_requisition_id: emp_requisition_id, reason_status: inputValue };

     $.ajax({
     type: "POST",
     url: url,
     data: data,
     async: false,
     dataType: "json",
     success: function (result) {
     if(result.status=='Success')
     {
     swal({
     title: "Rejected!",
     text: "You wrote: " + inputValue,
     type: "success",
     confirmButtonColor: "#2196F3"
     },
     function(isConfirm){
     location.reload();
     }
     );
     }
     }
     });
     });
     });
     $('.emp_requisition_cancel').on('click', function() {
     swal({
     title: "Cancel!",
     text: "Write something that is the reason:",
     type: "input",
     showCancelButton: true,
     confirmButtonColor: "#2196F3",
     closeOnConfirm: false,
     animation: "slide-from-top",
     inputPlaceholder: "Write something"
     },
     function(inputValue){
     if (inputValue === false) return false;
     if (inputValue === "") {
     swal.showInputError("You need to write something!");
     return false
     }

     var emp_requisition_id =  $('#emp_requisition_id').val();
     var baseURL = window.location.protocol + '//' + window.location.hostname + '';
     var url = baseURL + "/selfservice/mss/cancelEmpRequisition/";

     var data = { emp_requisition_id: emp_requisition_id, reason_status: inputValue };

     $.ajax({
     type: "POST",
     url: url,
     data: data,
     async: false,
     dataType: "json",
     success: function (result) {
     if(result.status=='Success')
     {
     swal({
     title: "Cancelled!",
     text: "You wrote: " + inputValue,
     type: "success",
     confirmButtonColor: "#2196F3"
     },
     function(isConfirm){
     location.reload();
     });
     }
     }
     });
     });
     });*/

    // Custom bootbox dialog with form
    $('#add_project_form').on('click', function () {

        var company = "";
        $.ajax({
            url: JS_BASE_URL + '/planning/getCompany',
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function (res) {
                if (res.status == 'Success') {
                    $.each(res.data, function (i, val) {
                        company += '<option value="' + val.company_name + '">' + val.company_name + '</option> ';
                    });
                }
            }
        });
        var scope = "";
        $.ajax({
            url: JS_BASE_URL + '/planning/getProjectScope',
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function (res) {
                if (res.status == 'Success') {
                    $.each(res.data, function (i, val) {
                        scope += '<option value="' + val.project_scope + '">' + val.project_scope + '</option> ';
                    });
                }
            }
        });

        var noproject = "";
        $.ajax({
            url: JS_BASE_URL + '/planning/projectId',
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function (res) {
                if (res.status == 'Success') {
                    noproject = res.data;
                }
            }
        });
        console.log(noproject);
        var resource = "";
        $.ajax({
            url: JS_BASE_URL + '/planning/getResource',
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function (res) {
                if (res.status == 'Success') {
                    $.each(res.data, function (i, val) {
                        resource += '<option value="' + val.user_id + '">' + val.fullname + '</option> ';
                    });
                }
            }
        });
        var list_customer = "";
        $.ajax({
            url: JS_BASE_URL + '/planning/all_customer',
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function (res) {
                if (res.status == 'Success') {
                    $.each(res.data, function (i, val) {
                        list_customer += '<option value="' + val.id + '">' + val.customer_name + '</option> ';
                    });
                }
            }
        });

        var list_user = "";
        $.ajax({
            url: JS_BASE_URL + '/administration/activeUser',
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function (res) {
                if (res.status == 'Success') {
                    $.each(res.data, function (i, val) {
                        list_user += '<option value="' + val.user_id + '" >' + val.fullname + '</option> ';
                    });
                }
            }
        });

        var list_leader = "";
        $.ajax({
            url : JS_BASE_URL + '/resource/position_person',
            type : 'POST',
            dataType : 'json',
            data : {position : '2'},
            async : false,
            success : function (res) {
                if (res.status = 'success'){
                    $.each(res.data, function(i, val){
                        list_leader += '<option value="' + val.user_id + '">' + val.fullname + '</option> ';
                    });
                }
            }
        });

        var list_area = "";
        $.ajax({
            url : JS_BASE_URL + '/planning/get_work_location',
            type : 'GET',
            dataType : 'json',
            async : false,
            success : function (res){
                if(res.status == 'success'){
                    $.each(res.data, function(i, val){
                        list_area += '<option value = "' + val.location +'">' + val. location + '</option>';
                    });

                    console.log(res.data);
                }
            }
        });
        bootbox.dialog({
                title: "Add Project",
                message: '<div class="row">' +
                '<div class="col-md-12">' +
                '<form action="#" id = "new_project_form">' +
                '<div class="form-group">' +
                '<div class="row">' +
                '<div class="col-sm-12">' +
                '<label class="text-semibold">Project ID</label>' +
                '<input type="text" placeholder="Project name" value = "'+noproject+'" id = "project_id" name = "project_id" class="form-control input-lg text-semibold">' +
                '<span class="help-block text-danger hidden" id = "existing">Project ID is existing</span>'+
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '<div class="row">' +
                '<div class="col-sm-12">' +
                '<label class="text-semibold">What\'s the Project Name?</label>' +
                '<input type="text" placeholder="Project name" name = "project_name" class="form-control input-lg text-semibold">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">' +
                '<li class="active"><a href="#tab_description" data-toggle="tab" aria-expanded="true">Description</a></li>' +
                '<li class=""><a href="#tab_dates" data-toggle="tab" aria-expanded="false">Dates</a></li>' +
                // '<li class=""><a href="#tab_scope" data-toggle="tab" aria-expanded="false">Scope</a></li>' +
                '<li class=""><a href="#tab_pic" data-toggle="tab" aria-expanded="false">Authorized User</a></li>' +
                '<li class=""><a href="#tab_leader" data-toggle="tab" aria-expanded="false">Leader</a></li>' +
                '<li class=""><a href="#tab_company" data-toggle="tab" aria-expanded="false">Company</a></li>' +
                '<li class=""><a href="#tab_customer" data-toggle="tab" aria-expanded="false">Customer</a></li>' +
                '<li class=""><a href="#tab_cities" data-toggle="tab" aria-expanded="false">Cities</a></li>' +
                // '<li class=""><a href="#tab_resource" data-toggle="tab" aria-expanded="false">Resource</a></li>' +
                '</ul>' +
                '<div class="tab-content">' +
                '<div class="tab-pane fade active in" id="tab_description">' +
                '<div class="form-group">' +
                '<label class="mt-10 text-semibold">Provide a Description (Optional):</label>' +
                '<textarea rows="4" cols="5" name = "project_description" placeholder="Description..." class="form-control"></textarea>' +
                '</div>' +
                '</div>' +
                '<div class="tab-pane fade" id="tab_dates">'+
                '<label class="mt-10"><span class="text-semibold">Project Dates</span> (Optional)<br/><small class="text-muted">Adding a start and end date provides your team a useful way to see the duration of this project which helps with planning your tasks and milestones</small></label>'+
                '<div class="row">'+
                '<div class="col-sm-6">'+
                '<label>Start Date</label>'+
                '<div class="input-group">'+
                '<span class="input-group-addon"><i class="icon-calendar22"></i></span> '+
                '<input type="text" class="form-control daterange-single" name="project_start_date" value="" placeholder="Pick a date"> '+
                '</div>'+
                '</div>'+
                '<div class="col-sm-6">'+
                '<label>End Date</label>'+
                '<div class="input-group">'+
                '<span class="input-group-addon"><i class="icon-calendar22"></i></span>'+
                '<input type="text" class="form-control daterange-single" name = "project_end_date" value="" placeholder="Pick a date">'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="tab-pane fade" id="tab_pic">' +
                '<div class="form-group">' +
                '<label class="mt-10 text-semibold">Authorized User</label>' +
                '<select id="pic" name="pic[]" data-placeholder="Select PIC for this Project" class="select" multiple = "multiple">' +
                '<option value="">No Scope</option>' +
                list_user +
                '</select>' +
                '</div>' +
                '</div>' +
                 '<div class="tab-pane fade" id="tab_leader">' +
                '<div class="form-group">' +
                '<label class="mt-10 text-semibold">Leader</label>' +
                '<select id="leader" name="leader[]" data-placeholder="Select Leader for this Project" class="select" multiple = "multiple">' +
                '<option value="">Select Person</option>' +
                list_leader +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div class="tab-pane fade" id="tab_scope">' +
                '<div class="form-group">' +
                '<label class="mt-10 text-semibold">Project Scope:</label>' +
                '<select id="scope" name="scope[]" data-placeholder="Select project scope" class="select" multiple="multiple">' +
                '<option value="">No Scope</option>' +
                scope +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div class="tab-pane fade" id="tab_company">' +
                '<div class="form-group">' +
                '<label class="mt-10 text-semibold">This Project is for Company:</label>' +
                '<select id="country" name="project_company" data-placeholder="Select your company" class="select">' +
                '<option value="">No Company</option>' +
                company +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div class="tab-pane fade" id="tab_customer">' +
                '<div class="form-group">' +
                '<label class="mt-10 text-semibold">This Project is for Customer:</label>' +
                '<select data-placeholder="Select person" id="customer" name="customer" class="select">' +
                list_customer +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div class="tab-pane fade" id="tab_cities">' +
                '<div class="form-group">' +
                '<label class="mt-10 text-semibold">Cities:</label>' +
                '<select data-placeholder="Select cities" id="cities" name="cities[]" class="select" multiple="multiple">' +
                list_area +
                '</select>' +
                '</div>' +
                '</div>' +
                '<div class="tab-pane fade" id="tab_resource">' +
                '<div class="form-group">' +
                '<label class="mt-10 text-semibold">Who should be added to this project?</label>' +
                '<select data-placeholder="Select person" name="team[]" class="select" multiple="multiple">' +
                resource +
                '</select>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</form>' +
                '</div>' +
                '</div>',
                buttons: {
                    success: {
                        label: "Add Project",
                        className: "btn-success",
                        callback: function () {
                            var formProject = $('#new_project_form');
                            $.ajax({
                                url: JS_BASE_URL + '/planning/saveProject',
                                type: 'POST',
                                dataType: 'json',
                                data: formProject.serialize(),
                                success: function (res) {
                                    if (res.status == 'Success') {
                                        window.location.replace(JS_BASE_URL + '/planning/allProject')
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

        $( "#project_id" ).focusout(function() {
            current = $(this).val();
            $.ajax({
                url: JS_BASE_URL + '/planning/check_existing',
                type: 'POST',
                dataType: 'json',
                data : {project_id : current},
                async: false,
                success: function (res) {
                    console.log(res);
                    if (res.status == 'Success') {
                        $('#existing').removeClass('hidden');
                    } else {
                        $('#existing').addClass('hidden');
                    }
                }
            });
        })

        // Single picker
        $(".daterange-single").val('');
        $('.daterange-single').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'DD-MM-YYYY'
            }
            // autoUpdateInput : false
        });
    });


    $(".tree-default").fancytree({
        init: function (event, data) {
            $('.has-tooltip .fancytree-title').tooltip();
        }
    });
    var base_url = JS_BASE_URL.replace('index.php', '');
    var cur_url = document.URL;
    var cur_url = cur_url.split("/"),
        id_project = cur_url[cur_url.length - 1];

    var page = 0;
    //console.log(last_element);
    $(".tree-table").fancytree({
        extensions: ["filter", "table"],
        quicksearch: true,
        table: {
            indentation: 20,      // indent 20px per node level
            nodeColumnIdx: 1,     // render the node title into the 2nd column
            //checkboxColumnIdx: 0  // render the checkboxes into the 1st column
        },
        source: {
            url: base_url + "/planning/projectTaskList/" + id_project
        },
        lazyLoad: function (event, data) {
            data.result = {url: "ajax-sub2.json"};

        },
        renderColumns: function (event, data) {
            var node = data.node,
                $tdList = $(node.tr).find(">td");
            // (index #0 is rendered by fancytree by adding the checkbox)
            $tdList.eq(0).text(node.getIndexHier()).addClass("alignRight");

            //$tdList.eq(1).html(node+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class = 'progress'>Progress</a>");

            // (index #2 is rendered by fancytree)
            $tdList.eq(2).text(node.data.due_date);

            // Style checkboxes
            $(".styled").uniform({radioClass: 'choice'});

        },
        renderNode: function (event, data) {
            var node = data.node;
            var $nodeSpan = $(node.span);
            //console.log(data.node);

            if (node.folder != true) {
                if (!$nodeSpan.data('rendered')) {

                    var deleteButton = $('<a class = "mr-10 progress" task_id = "' + node.data.id + '"><i class="icon-stats-growth2"></i></a>');
                    var a = $('<a><i class="icon-user-plus"></i></a>');

                    $nodeSpan.append(deleteButton);
                    $nodeSpan.append(a);

                    deleteButton.hide();
                    a.hide();

                    $nodeSpan.hover(function () {
                        // mouse over
                        deleteButton.show();
                        a.show();

                    }, function () {

                        // mouse out
                        deleteButton.hide();
                        a.hide();
                    })

                    // span rendered
                    $nodeSpan.data('rendered', true);

                    //deleteButton.click(function(){
                    /* bootbox.dialog({
                     title: "Add Milestone",
                     message: '<div class="row"> ' +
                     '<div class="col-md-12">' +
                     '<form action="#" id = "add_milestone_form">' +
                     '<div class="form-group">' +
                     '<div class="row">'+
                     '<div class="col-sm-12">'+
                     '<label>Name the milestone</label> '+
                     '<input type="text" name = "milestone" class="form-control"> '+
                     '</div> '+
                     '</div> '+
                     '</div>'+
                     '<div class="row">'+
                     '<div class="col-sm-6">'+
                     '<div class="form-group"> '+
                     '<label>Who is responsible?</label> '+
                     '<select id="country" name="asignee" data-placeholder="Anyone" class="select company">'+
                     '<option value="">Anyone</option> '+
                     '</select>' +
                     '</div> ' +
                     '</div>' +
                     '<div class="col-sm-6">' +
                     '<label>Due Date</label>' +
                     '<div class="input-group">' +
                     '<span class="input-group-addon"><i class="icon-calendar22"></i></span>' +
                     '<input type="text" id = "due_date" class="form-control daterange-single" name = "milestone_due_date" placeholder="No date">' +
                     '</div>' +
                     '</div>' +
                     '</div>' +
                     '<ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">'+
                     '<li class="active"><a href="#a" data-toggle="tab" aria-expanded="true">Notes</a></li>'+
                     ' <li class=""><a href="#b" data-toggle="tab" aria-expanded="false">Followers</a></li>'+
                     '</ul>'+
                     '<div class="tab-content">'+
                     '<div class="tab-pane fade active in" id="a">'+
                     '<div class="form-group">'+
                     '<label class = "m-10">Provide a Description (Optional):</label> '+
                     '<textarea rows="4" cols="5" name = "description" placeholder="Description..." class="form-control"></textarea>'+
                     '</div>'+
                     '</div>'+
                     '<div class="tab-pane fade" id="b">'+
                     '<div class="form-group">'+
                     '<label class = "m-10">Who can see it?</label>'+
                     '<select data-placeholder="Select user" class="select company" multiple = "multiple">'+
                     '<option value="anyone">Anyone in this project</option>'+
                     '<option value="me">Me</option>'+
                     '</select>'+
                     '</div>'+
                     '</div>'+
                     '</form>' +
                     '</div>' +
                     '</div>',
                     buttons: {
                     success: {
                     label: "Add Milestone",
                     className: "btn-success",
                     callback: function () {
                     /!*var form = $('#add_milestone_form');
                     $.ajax({
                     url:  JS_BASE_URL +'/projects/saveMilestone',
                     type : 'POST',
                     dataType: 'json',
                     data: form.serialize(),
                     success: function(res) {
                     var dbmil = $('.datatable-milestone-list').dataTable();
                     if(res.status == 'Success'){
                     dbmil.api().ajax.reload();
                     }
                     }
                     });*!/

                     }
                     }
                     }
                     }
                     );*/
                    deleteButton.popover({
                        title: "Set Progress in %",
                        html: true,
                        content: '<form id = "prog_form"><input type="text" name = "progress" class="form-control slider"><input type = "hidden" name = "task_id" value = "' + node.data.id + '"></form>',
                        placement: 'bottom',
                        trigger: 'click'
                    }).on('shown.bs.popover', function () {
                        var p = deleteButton.popover();
                        deleteButton.popover().data("bs.popover").tip().css({"width": "300px"});
                        $(".slider").ionRangeSlider({
                            type: "single",
                            grid: true,
                            values: [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
                            onFinish: function (data) {
                                var form = $('#prog_form');
                                $.ajax({
                                    url: JS_BASE_URL + '/projects/saveProgress',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: form.serialize(),
                                    async: false,
                                    success: function (res) {
                                        if (res.status == 'Success') {
                                            deleteButton.popover('hide');
                                            var newSourceOption = {
                                                url: base_url + "/projects/projectTaskList/" + id_project,
                                                type: 'POST',
                                                data: {page: page},
                                                dataType: 'json'
                                            };

                                            var tree = $('.tree-table').fancytree('getTree');
                                            tree.reload(newSourceOption);
                                        }
                                    }
                                });
                            }
                        });
                    });


                    //});
                    a.click(function () {
                        alert('assign');
                    });
                }
            }
            // check if span of node already rendered

        }
    });

    $('#next').click(function () {
        var a = $('input[name=search]').val();
        page += 10;
        if (page != 0) {
            $('#prev').html("Prev - ");
            $('#prev').removeClass('hidden');
        }
        var newSourceOption = {
            url: base_url + "/projects/projectTaskList/" + id_project,
            type: 'POST',
            data: {page: page, searchvalue: a},
            dataType: 'json'
        };

        var tree = $('.tree-table').fancytree('getTree');
        tree.reload(newSourceOption);
    });

    $('#prev').click(function () {
        var a = $('input[name=search]').val();
        page -= 10;
        var newSourceOption = {
            url: base_url + "/projects/projectTaskList/" + id_project,
            type: 'POST',
            data: {page: page, searchvalue: a},
            dataType: 'json'
        };

        var tree = $('.tree-table').fancytree('getTree');
        tree.reload(newSourceOption);
    });
    $("input[name=search]").keyup(function (e) {
        var a = $('input[name=search]').val();
        page = 0;
        var newSourceOption = {
            url: base_url + "/projects/projectTaskList/" + id_project,
//                url: "<?php //echo base_url();?>//themes/Limitless/default/assets/demo_data/fancytree/fancytree.json",
            type: 'POST',
            data: {page: page, searchvalue: a},
            dataType: 'json'
        };

        var tree = $('.tree-table').fancytree('getTree');
        tree.reload(newSourceOption);
    }).focus();
    //$("input[name=search]").keyup(function(e){
    //    var n,
    //        tree = $.ui.fancytree.getTree(),
    //        args = "autoApply autoExpand fuzzy hideExpanders highlight leavesOnly nodata".split(" "),
    //        opts = {},
    //        filterFunc = $("#branchMode").is(":checked") ? tree.filterBranches : tree.filterNodes,
    //        match = $(this).val();
    //    $.each(args, function(i, o) {
    //        opts[o] = $("#" + o).is(":checked");
    //    });
    //    opts.mode = $("#hideMode").is(":checked") ? "hide" : "dimm";
    //    if(e && e.which === $.ui.keyCode.ESCAPE || $.trim(match) === ""){
    //        $("button#btnResetSearch").click();
    //        return;
    //    }
    //    if($("#regex").is(":checked")) {
    //        // Pass function to perform match
    //        n = filterFunc.call(tree, function(node) {
    //            return new RegExp(match, "i").test(node.title);
    //        }, opts);
    //    } else {
    //        // Pass a string to perform case insensitive matching
    //        n = filterFunc.call(tree, match, opts);
    //    }
    //    $("button#btnResetSearch").attr("disabled", false);
    //    $("span#matches").text("(" + n + " matches)");
    //}).focus();

    $("button#btnResetSearch").click(function (e) {
        tree = $.ui.fancytree.getTree(),
            $("input[name=search]").val("");
        $("span#matches").text("");
        tree.clearFilter();
    }).attr("disabled", true);

    var validator = $(".form-validate-jquery").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
       /* success: function(label) {
            label.addClass("validation-valid-label").text("")
        },*/
        rules: {
            email: {
                email: true
            },
        },
        messages: {
            custom: {
                required: "This is a custom error message",
            },
            agree: "Please accept our policy"
        }
    });


});
