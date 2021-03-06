/* ------------------------------------------------------------------------------

 *  Datatables data sources
 *
 *  @Kardiwan <kardiwan@gmail.com>
 *
 * ---------------------------------------------------------------------------- */

$(function() {
  // Table setup
  // ------------------------------

  // Setting datatable defaults
  $.extend($.fn.dataTable.defaults, {
    autoWidth: false,
    columnDefs: [
      {
        //orderable: false,
        //width: '100px',
        //targets: [ 5 ]
      }
    ],
    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
    language: {
      search: "<span>Filter:</span> _INPUT_",
      lengthMenu: "<span>Show:</span> _MENU_",
      paginate: {
        first: "First",
        last: "Last",
        next: "&rarr;",
        previous: "&larr;"
      }
    },
    drawCallback: function() {
      $(this)
        .find("tbody tr")
        .slice(-3)
        .find(".dropdown, .btn-group")
        .addClass("dropup");
    },
    preDrawCallback: function() {
      $(this)
        .find("tbody tr")
        .slice(-3)
        .find(".dropdown, .btn-group")
        .removeClass("dropup");
    }
  });

  // Dendy 01-04-2019
  $(".datatable-progress-parameter-list").dataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/toolManagement/datatableProgressParameter",
      type: "POST"
    },
    columnDefs: [
      /*{
                render: function (data, type, row) {
                    return '<span class="text-size-small text-default"> ' + row.tools_id + '</span>';
                },
                orderable: false,
                targets: 0
            },*/
      {
        render: function(data, type, row) {
          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            row.no +
            "</div>"
          );
        },
        orderable: false,
        targets: 0,
        width: "10px"
      },
      {
        render: function(data, type, row) {
          // return '<span class="text-size-small text-default"> ' + row.description + '</span>';
          return (
            '<span class="text-size-small text-default">' +
            row.parameter_name +
            "</span>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.measurement +
            "</span>"
          );
        },
        orderable: false,
        targets: 2
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.group_name +
            "</span>"
          );
        },
        orderable: false,
        targets: 3
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" class = "edit-parameter" pp_id = "' +
            row.id +
            '"><i class="icon-pencil"></i>Edit Parameter</a></li>' +
            // '<li><a href="#" class = "delete-tools" tools_id = "' +
            // row.id +
            // '"><i class="icon-trash"></i>Delete Tools</a></li>' +
            // "</ul>" +
            // "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        visible: true,
        targets: 4
      }
    ],
    order: [3, "asc"],
    // columns: [
    //   { data: "email" },
    //   { data: "full_name" },
    //   { data: "title" },
    //   { data: "join_date" },
    //   { data: "work_location" }
    // ],
    fnDrawCallback: function() {
      CallbackPP();
    }
  });

  // Project list - datatable
  $(".datatable-projects-list").dataTable({
    processing: true,
    serverSide: true,
    lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],
    ajax: {
      url: JS_BASE_URL + "/planning/dataTableProjectList",
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            row.no +
            "</div>"
          );
        },
        orderable: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          var bgColor = [
            "bg-teal-400",
            "bg-warning-400",
            "bg-blue",
            "bg-success-400",
            "bg-pink-400",
            "bg-brown-400"
          ];
          var rand = bgColor[Math.floor(Math.random() * bgColor.length)];

          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            data +
            "</div>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          var bgColor = [
            "bg-teal-400",
            "bg-warning-400",
            "bg-blue",
            "bg-success-400",
            "bg-pink-400",
            "bg-brown-400"
          ];
          var rand = bgColor[Math.floor(Math.random() * bgColor.length)];

          //return '<div class="media-left media-middle">' +
          //'<a href="' + JS_BASE_URL + '/projects/id/' + row.id + '" class="btn ' + rand + ' btn-rounded btn-icon btn-xs">' +
          //'<span class="letter-icon">' + data.substr(0,1) + '</span>' +
          //'<span class="letter-icon">' + row.id + '</span>' +
          //'</a>' +
          //'</div>' +
          return (
            '<div class="media-body">' +
            '<a href="' +
            JS_BASE_URL +
            "/planning/id/" +
            row.id +
            '" class="display-inline-block font-weight-semibold">' +
            data +
            "</a>" +
            //'<div class="text-muted text-size-small"><span class="status-mark border-success position-left"></span>' + row.company + '</div>' +
            "</div>"
          );
        },
        orderable: false,
        targets: 2
      },
      {
        render: function(data, type, row) {
          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            data +
            "</div>"
          );
        },
        orderable: false,
        targets: 3
      },
      {
        render: function(data, type, row) {
          if (row.completion == "") {
            row.completion = "0.00";
          }
          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            row.completion +
            "%</div>"
          );
        },
        orderable: false,
        targets: 4
      },
      {
        render: function(data, type, row) {
          if (row.start_date == null) {
            row.start_date = "-";
          }

          if (row.description == null) {
            row.description = "-";
          }

          if (row.description.length >= 25) {
            row.description = row.description.substring(0, 20) + "...";
          }
          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            row.description +
            "</div>"
          );
        },
        orderable: false,
        visible: false,
        targets: 5
      },
      {
        render: function(data, type, row) {
          if (row.start_date == null) {
            row.start_date = "-";
          }
          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            row.customer +
            "</div>"
          );
        },
        orderable: false,
        visible: false,
        targets: 6
      },
      {
        visible: false,
        targets: 7
      },
      {
        visible: false,
        targets: 8
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            //'<li><a href="#" target="_blank"><i class="icon-clipboard3"></i> Application form</a></li>' +
            // '<li><a class = "assign" data-id = "'+row.emp_requisition_id+'" candidate_id = "'+row.candidate_id+'"><i class="icon-users2"></i> Assign Inteviewer</li>'
            '<li><a class = "edit_project" project_id = "' +
            row["id"] +
            '" source = "list"><i class="icon-pencil5"></i>Edit Project</a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        targets: 9
      }
    ],
    //dom: '<"datatable-scroll"t><"datatable-footer"ip>',
    order: [8, "asc"],
    columns: [
      { data: "id" },
      { data: "project_id" },
      { data: "project_name" },
      { data: "status" },
      { data: "team" },
      { data: "completion" },
      { data: "customer" },
      { data: "description" },
      { data: "category" }
    ],
    fnDrawCallback: function() {
      CallbackProject();
      /*this.api().on('draw', function() {
             CallbackMilestone();
             });*/
    }
  });


 $(".datatable-progress-tracking").dataTable({
    processing: true,
    serverSide: true,
    lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],
    ajax: {
      url: JS_BASE_URL + "/implementation/dataTableProgressTracking",
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            row.no +
            "</div>"
          );
        },
        orderable: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          var bgColor = [
            "bg-teal-400",
            "bg-warning-400",
            "bg-blue",
            "bg-success-400",
            "bg-pink-400",
            "bg-brown-400"
          ];
          var rand = bgColor[Math.floor(Math.random() * bgColor.length)];

          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            data +
            "</div>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          var bgColor = [
            "bg-teal-400",
            "bg-warning-400",
            "bg-blue",
            "bg-success-400",
            "bg-pink-400",
            "bg-brown-400"
          ];
          var rand = bgColor[Math.floor(Math.random() * bgColor.length)];
          return (
            '<div class="media-body">' +
            '<a href="' +
            JS_BASE_URL +
            "/implementation/progress/" +
            row.id +
            '" class="display-inline-block font-weight-semibold">' +
            data +
            "</a>" +
            "</div>"
          );
        },
        orderable: false,
        targets: 2
      },
      {
        render: function(data, type, row) {
          return (
            // "<div class='text-wrap width-200'>" + row.cities + "</div>";
            '<div class = "text-wrap width-200">' +
            row.cities +
            "</div>"
          );
        },
        orderable: false,
        targets: 3
      },
      {
        render: function(data, type, row) {
          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            row.scope +
            "</div>"
          );
        },
        orderable: false,
        targets: 4
      },
      {
        render: function(data, type, row) {
          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            row.pm_name +
            "</div>"
          );
        },
        orderable: false,
        visible: true,
        targets: 5
      },
      {
        render: function(data, type, row) {
          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            row.status +
            "</div>"
          );
        },
        orderable: false,
        visible: true,
        targets: 6
      },
      {
        render: function(data, type, row) {
         if (row.completion == "") {
            row.completion = "0.00";
          }
          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            row.completion +
            "%</div>"
          );
        },
        orderable: false,
        targets: 7
      },
     /* {
        visible: false,
        targets: 8
      }*//*,
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            //'<li><a href="#" target="_blank"><i class="icon-clipboard3"></i> Application form</a></li>' +
            // '<li><a class = "assign" data-id = "'+row.emp_requisition_id+'" candidate_id = "'+row.candidate_id+'"><i class="icon-users2"></i> Assign Inteviewer</li>'
            '<li><a class = "edit_project" project_id = "' +
            row["id"] +
            '" source = "list"><i class="icon-pencil5"></i>Edit Project</a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        targets: 9
      }*/
    ],
    //dom: '<"datatable-scroll"t><"datatable-footer"ip>',
    order: [8, "asc"],
    columns: [
      { data: "id" },
      { data: "project_id" },
      { data: "project_name" },
      { data: "status" },
      { data: "team" },
      { data: "completion" },
      { data: "customer" },
      { data: "description" },
      { data: "category" }
    ],
    fnDrawCallback: function() {
      CallbackProject();
      /*this.api().on('draw', function() {
             CallbackMilestone();
             });*/
    }
  });

  var project_id = $("#project_id").val();
  $(".datatable-milestone-list").dataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/planning/dataTableMilestone/" + project_id,
      type: "POST"
    },
    columnDefs: [
      /*{
             render: function (data, type, row) {

             return '<div class="checkbox"><input type="checkbox" class="styled"></div>';
             },
             orderable: false,
             targets: 0
             },*/
      {
        render: function(data, type, row) {
          return (
            '<h6 class="text-default"> ' +
            row.a.milestone_name +
            "</h6>" +
            '<div class="text-muted text-size-small"><i class="icon-calendar2 position-left"></i> ' +
            row.a.due_date +
            "</div>"
          );
        },
        orderable: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.b.fullname +
            "</span>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        visible: false,
        targets: 2
      },
      {
        visible: false,
        targets: 3
      },
      {
        visible: false,
        targets: 4
      },
      {
        visible: false,
        targets: 5
      },
      {
        visible: false,
        targets: 6
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" class = "attach_tasklist" project_id = "' +
            project_id +
            '" ><i class="icon-attachment"></i>Attach a tasklist</a></li>' +
            '<li><a href="#" class = "edit_milestone" milestone_id="' +
            row.a.id +
            '"><i class="icon-pencil6"></i>Edit Milestone</a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        visible: true,
        targets: 7
      }
    ],
    order: [1, "desc"],
    columns: [
      { data: "a.milestone_name" },
      { data: "a.due_date" },
      { data: "a.description" },
      { data: "a.responsible_to" },
      { data: "a.can_see_it" },
      { data: "a.should_follow_it" },
      { data: "b.fullname" },
      { data: "a.id" }
    ],
    fnDrawCallback: function() {
      CallbackMilestone();
      /*this.api().on('draw', function() {
             CallbackMilestone();
             });*/
    }
  });

  $(".datatable-task-list").dataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/planning/dataTableTaskList/" + project_id,
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<span class="text-default ml-20">' + row.a.tasks_name + "</span>"
          );
        },
        orderable: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.a.start_date +
            "</span>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.a.due_date +
            "</span>"
          );
        },
        orderable: false,
        targets: 2
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.a.progress +
            "% </span>"
          );
        },
        orderable: false,
        targets: 3
      },
      {
        visible: false,
        targets: 4
      },
      {
        visible: false,
        targets: 5
      },
      {
        visible: false,
        targets: 6
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            /*                        '<li><a href="#" class = "attach_tasklist" project_id = "'+row.a.project_id+'"><i class="icon-attachment"></i>Attach a tasklist</a></li>' +*/
            '<li><a href="#" class = "edit-task" task_id = "' +
            row.a.id +
            '"><i class=" icon-pencil" ></i>Edit Task</a></li>' +
            '<li><a href="#" class = "delete-task" task_id = "' +
            row.a.id +
            '"><i class=" icon-trash" ></i>Delete Task</a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        visible: true,
        targets: 7
      },
      {
        visible: false,
        targets: 8
      }
    ],
    //dom: '<"datatable-scroll"t><"datatable-footer"ip>',
    order: [[4, "asc"], [6, "asc"]],
    columns: [
      { data: "a.tasks_name" },
      { data: "a.start_date" },
      { data: "a.due_date" },
      { data: "a.progress" },
      { data: "a.task_list_id" },
      { data: "a.progress" },
      { data: "a.id" },
      { data: "b.task_list_name" },
      { data: "a.projects_id" }
    ],
    fnDrawCallback: function() {
      callBackTaskList();
      /*this.api().on('draw', function() {
             CallbackMilestone();
            });*/
      var api = this.api();
      var rows = api.rows({ page: "current" }).nodes();
      var last = null;

      api
        .column(7, { page: "current" })
        .data()
        .each(function(group, i) {
          if (last !== group) {
            $(rows)
              .eq(i)
              .before(
                '<tr class="group"><td colspan="7"><b>' +
                  group +
                  "</b></td></tr>"
              );

            last = group;
          }
        });
    }
  });

  $(".datatable-people-list").dataTable({
    saveState: true,
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/resource/datatable_resourceAllocation/" + project_id,
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' +
            row.fullname +
            "</span>"
          );
        },
        orderable: true,
        targets: 0
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.position_title +
            "</span>"
          );
        },
        orderable: true,
        targets: 1
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            moment(row.join_date_to_project).format("DD-MM-YYYY") +
            "</span>"
          );
        },
        orderable: true,
        targets: 2
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' + row.loc + "</span>"
          );
        },
        orderable: false,
        targets: 3
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list pull-right">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" res_id = "' +
            row.id +
            '" class = "edit_rp" ><i class="icon-pencil"></i>Edit Resource</a></li>' +
            '<li><a href="#" res_id = "' +
            row.id +
            '" class = "delete_rp" ><i class="icon-trash"></i>Delete </a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;

          // return '<span class="text-size-small text-default pull-right"><i class = "icon-chevron-down"></i></span>';
        },
        orderable: false,
        targets: 4
      }
    ],
    // dom: '<"datatable-scroll"t><"datatable-footer"ip>',
    order: [0, "desc"],
    columns: [{ data: "a.id" }, { data: "b.fullname" }, { data: "b.email" }],
    fnDrawCallback: function() {
      resourceProjectCB();
    }
  });

  $(".datatable-project-vendor-list").dataTable({
    saveState: true,
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/planning/datatable_vendor_project/" + project_id,
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' +
            row.vendor_name +
            "</span>"
          );
        },
        orderable: true,
        targets: 0
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.scopes +
            "</span>"
          );
        },
        orderable: true,
        targets: 1
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.location +
            "</span>"
          );
        },
        orderable: true,
        targets: 2
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list pull-right">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" pv_id = "' +
            row.id +
            '" class = "edit_pv" ><i class="icon-pencil"></i>Edit</a></li>' +
            '<li><a href="#" pv_id = "' +
            row.id +
            '" class = "delete_pv" ><i class="icon-trash"></i>Delete </a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;

          // return '<span class="text-size-small text-default pull-right"><i class = "icon-chevron-down"></i></span>';
        },
        orderable: false,
        targets: 3
      }
    ],
    // dom: '<"datatable-scroll"t><"datatable-footer"ip>',
    order: [0, "desc"],
    columns: [{ data: "a.id" }, { data: "b.fullname" }, { data: "b.email" }],
    fnDrawCallback: function() {
      // resourceProjectCB();
      projectVendorCB();
    }
  });

  // Start Dendy 21-03-2019
  $(".datatable-project-charter-list").dataTable({
    saveState: true,
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/planning/datatable_project_charter/" + project_id,
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            row.no +
            "</div>"
          );
        },
        orderable: false,
        targets: 0,
        width: "10px"
      },
      {
        render: function(data, type, row) {
          return (
            "<a href='" +
            SITE_URL +
            "assets/file/planning/" +
            row.filename_encrypt +
            "' class='display-inline-block font-weight-semibold' target='_blank'" +
            '<span class="text-size-small text-default"> ' +
            row.filename +
            "</span>" +
            "</a>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list pull-right">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" pc_id = "' +
            row.id +
            '" class = "delete-pc" ><i class="icon-trash"></i>Delete </a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;

          // return '<span class="text-size-small text-default pull-right"><i class = "icon-chevron-down"></i></span>';
        },
        orderable: false,
        targets: 2
      }
    ],
    // dom: '<"datatable-scroll"t><"datatable-footer"ip>',
    order: [0, "desc"],
    // columns: [{ data: "filename" }],
    fnDrawCallback: function() {
      // resourceProjectCB();
      projectCharterCB();
    }
  });
  // End Dendy 21-03-2019

  // Start Dendy 26-03-2019
  $(".datatable-project-kmz-list").dataTable({
    saveState: true,
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/planning/datatable_project_kmz/" + project_id,
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<div class = "display-inline-block text-default letter-icon-title">' +
            row.no +
            "</div>"
          );
        },
        orderable: false,
        targets: 0,
        width: "10px"
      },
      {
        render: function(data, type, row) {
          return (
            "<a href='" +
            SITE_URL +
            "assets/file/planning/" +
            row.filename_encrypt +
            "' class='display-inline-block font-weight-semibold' target='_blank'" +
            '<span class="text-size-small text-default"> ' +
            row.filename +
            "</span>" +
            "</a>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list pull-right">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" pc_id = "' +
            row.id +
            '" class = "delete-pk" ><i class="icon-trash"></i>Delete </a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;

          // return '<span class="text-size-small text-default pull-right"><i class = "icon-chevron-down"></i></span>';
        },
        orderable: false,
        targets: 2
      }
    ],
    // dom: '<"datatable-scroll"t><"datatable-footer"ip>',
    order: [0, "desc"],
    // columns: [{ data: "filename" }],
    fnDrawCallback: function() {
      // resourceProjectCB();
      projectKMZCB();
    }
  });
  // End Dendy 26-03-2019

  // Start Dendy 26-03-2019
  $(".datatable-project-segment-list").dataTable({
    saveState: true,
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/planning/datatable_project_segment/" + project_id,
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' + row.no + "</span>"
          );
        },
        orderable: false,
        targets: 0,
        width: "10px"
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.segment_name +
            "</span>"
          );
        },
        orderable: true,
        targets: 1
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.cluster +
            "</span>"
          );
        },
        orderable: true,
        targets: 2
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.vendor_name +
            "</span>"
          );
        },
        orderable: true,
        targets: 3
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list pull-right">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" sg_id = "' +
            row.id +
            '" class = "edit_sg" ><i class="icon-pencil"></i>Edit Segment</a></li>' +
            '<li><a href="#" sg_id = "' +
            row.id +
            '" class = "edit_sp" ><i class="icon-pencil"></i>Add Span</a></li>' +
            // '<li><a href="#" pv_id = "' +
            // row.id +
            // '" class = "delete_pv" ><i class="icon-trash"></i>Delete </a></li>' +
            // "</ul>" +
            // "</li>" +
            "</ul>";
          return action_menu;

          // return '<span class="text-size-small text-default pull-right"><i class = "icon-chevron-down"></i></span>';
        },
        orderable: false,
        // targets: 2
        targets: 4
      }
    ],
    // dom: '<"datatable-scroll"t><"datatable-footer"ip>',
    order: [0, "desc"],
    fnDrawCallback: function() {
      // resourceProjectCB();
      projectSegmentCB();
    }
  });
  // End Dendy 26-03-2019

  $(".datatable-role-list").dataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/administration/datatableRole/",
      type: "POST"
    },
    columnDefs: [
      /*{
             render: function (data, type, row) {

             return '<div class="checkbox"><input type="checkbox" class="styled"></div>';
             },
             orderable: false,
             targets: 0
             },*/
      {
        render: function(data, type, row) {
          return (
            '<div class="text-muted text-size-small"></i> ' + row.no + "</div>"
          );
        },
        orderable: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.role_name +
            "</span>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="/administration/rolePermissions/' +
            row.id +
            '" class = "attach_tasklist" ><i class="icon-user-lock"></i>Role Permission</a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        visible: true,
        targets: 2
      }
    ],
    order: [1, "desc"],
    columns: [{ data: "id" }, { data: "role_name" }],
    fnDrawCallback: function() {}
  });

  $(".datatable-permission-list").dataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/administration/datatablePermission/",
      type: "POST"
    },
    columnDefs: [
      /*{
             render: function (data, type, row) {

             return '<div class="checkbox"><input type="checkbox" class="styled"></div>';
             },
             orderable: false,
             targets: 0
             },*/
      {
        render: function(data, type, row) {
          return '<div class="text-size-small"></i> ' + row.name + "</div>";
        },
        orderable: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.description +
            "</span>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.menu_name +
            "</span>"
          );
        },
        orderable: false,
        targets: 2
      },
      {
        visible: false,
        targets: 3
      },
      {
        visible: false,
        targets: 4
      },
      {
        visible: false,
        targets: 5
      },
      {
        visible: false,
        targets: 6
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        visible: true,
        targets: 7
      }
    ],
    order: [1, "desc"],
    columns: [
      { data: "name" },
      { data: "description" },
      { data: "id_permission" },
      { data: "menu_id" },
      { data: "created_at" },
      { data: "created_by" },
      { data: "updated_at" },
      { data: "created_by" }
    ],
    fnDrawCallback: function() {
      CallbackMilestone();
      /*this.api().on('draw', function() {
             CallbackMilestone();
             });*/
    }
  });

  $(".datatable-user-list").dataTable({
    processing: true,
    serverSide: true,
    stateSave: true,
    ajax: {
      url: JS_BASE_URL + "/administration/datatableUser/1",
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' +
            row.user_id +
            "</span>"
          );
        },
        orderable: false,
        // visible: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          // return '<span class="text-size-small text-default"> ' + row.fullname + '</span>';
          return (
            '<a href="#" class = "edit-user" user_id = "' +
            row.user_id +
            '">' +
            row.fullname +
            "</a>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' +
            row.email +
            "</span>"
          );
        },
        orderable: false,
        // visible: false,
        targets: 2
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.department_name +
            "</span>"
          );
        },
        orderable: false,
        targets: 3
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.role_name +
            "</span>"
          );
        },
        orderable: false,
        targets: 4
      },
      {
        render: function(data, type, row) {
          var a = "";
          if (row.active == 1) {
            a =
              '<a class="label label-flat border-green text-success active" user_id = "' +
              row.user_id +
              '" title = "Deactive User">Active</span> ';
          } else {
            a =
              '<a class="label label-flat border-danger text-danger inactive" user_id = "' +
              row.user_id +
              '" title = "Activate User">Inactive</span> ';
          }

          return a;
          // return '<span class="text-size-small text-default">' + row.role_name + '</span>';
        },
        orderable: false,
        targets: 5
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<a href="#" class = "edit-user" user_id = "' +
            row.user_id +
            '"><i class="icon-pencil"></i></a>';
          /*var action_menu = '<ul class="icons-list">' +
                        '<li class="dropdown">' +
                        '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
                        '<ul class="dropdown-menu dropdown-menu-right">' +
                        '<li><a href="#" class = "edit-user" user_id = "' + row.user_id + '"><i class="icon-pencil"></i>Edit User</a></li>' +
                        '</ul>' +
                        '</li>' +
                        '</ul>';*/
          return action_menu;
        },
        orderable: false,
        visible: true,
        targets: 6
      }
    ],
    // order: [0, "asc"],
    columns: [
      { data: "user_id" },
      { data: "user_id" },
      { data: "user_id" },
      { data: "user_id" }
    ],
    fnDrawCallback: function() {
      CallbackUser();
      /*this.api().on('draw', function() {
             CallbackMilestone();
             });*/
    }
  });

  $(".datatable-resource-list").dataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/resource/datatableResource/",
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<a href="' +
            JS_BASE_URL +
            "/resource/details/" +
            row.id +
            '"><span class="text-size-small text-default"> ' +
            row.fullname +
            "</span></a>"
          );
        },
        orderable: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' +
            row.position_title +
            "</span>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.join_date +
            "</span>"
          );
        },
        orderable: false,
        targets: 2
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.work_location +
            "</span>"
          );
        },
        orderable: false,
        targets: 3
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" class = "edit-resource" res_id = "' +
            row.id +
            '"><i class="icon-pencil"></i>Edit Resource</a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        visible: true,
        targets: 4
      }
    ],
    order: [1, "desc"],
    columns: [
      { data: "email" },
      { data: "full_name" },
      { data: "title" },
      { data: "join_date" },
      { data: "work_location" }
    ],
    fnDrawCallback: function() {
      CallbackResource();
    }
  });

  $(".datatable-resource-allocation").dataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/resource/datatableAllocateResource/",
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' +
            row.fullname +
            "</span>"
          );
        },
        orderable: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' +
            row.project_name +
            "</span>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" class = "edit-resource" res_id = "' +
            row.id +
            '"><i class="icon-pencil"></i>Edit Resource</a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        visible: true,
        targets: 2
      }
    ],
    order: [1, "desc"],
    columns: [{ data: "email" }, { data: "full_name" }, { data: "title" }],
    fnDrawCallback: function() {
      CallbackResource();
    }
  });
  $(".datatable-tools-list").dataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/toolmanagement/datatableTools/",
      type: "POST"
    },
    columnDefs: [
      /*{
                render: function (data, type, row) {
                    return '<span class="text-size-small text-default"> ' + row.tools_id + '</span>';
                },
                orderable: false,
                targets: 0
            },*/
      {
        render: function(data, type, row) {
          // return '<span class="text-size-small text-default"> ' + row.description + '</span>';
          return (
            '<a href="#" class = "detail-tools" tools_id = "' +
            row.id +
            '">' +
            row.description +
            "</a>"
          );
        },
        orderable: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.pr_number +
            "</span>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.pr_date +
            "</span>"
          );
        },
        orderable: false,
        targets: 2
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.po_number +
            "</span>"
          );
        },
        orderable: false,
        targets: 3
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.po_date +
            "</span>"
          );
        },
        orderable: false,
        targets: 4
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" class = "edit-tools" tools_id = "' +
            row.id +
            '"><i class="icon-pencil"></i>Edit Tools</a></li>' +
            '<li><a href="#" class = "delete-tools" tools_id = "' +
            row.id +
            '"><i class="icon-trash"></i>Delete Tools</a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        visible: true,
        targets: 5
      }
    ],
    order: [1, "desc"],
    columns: [
      { data: "email" },
      { data: "full_name" },
      { data: "title" },
      { data: "join_date" },
      { data: "work_location" }
    ],
    fnDrawCallback: function() {
      CallbackTools();
    }
  });

  $(".datatable-issue-risk-list").dataTable({
    processing: true,
    serverSide: true,
    lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]],
    ajax: {
      url: JS_BASE_URL + "/issueRisk/datatableIssueRisk/",
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' +
            row.issue_no +
            "</span>"
          );
        },
        orderable: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          var issue_risk = row.issue_risk.substring(0, 50) + "...";
          // return '<span class="text-size-small text-default"> ' + row.issue_risk + '</span>';
          return (
            '<a href="#" class = "detail-issue-risk" issue_risk = "' +
            row.id +
            '">' +
            issue_risk +
            "</a>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.project_name +
            "</span>"
          );
        },
        orderable: false,
        targets: 2
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.project_scope +
            "</span>"
          );
        },
        orderable: false,
        targets: 3
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            capt(row.issue_or_risk) +
            "</span>"
          );
        },
        orderable: false,
        targets: 4
      },
      {
        render: function(data, type, row) {
          if (row.raised_date == "") {
            row.raised_date = "-";
          } else {
            row.raised_date = moment(row.raised_date).format("DD-MM-YYYY");
          }
          return (
            '<span class="text-size-small text-default">' +
            row.raised_date +
            "</span>"
          );
        },
        orderable: false,
        targets: 5
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            capt(row.status) +
            "</span>"
          );
        },
        orderable: false,
        targets: 6
      },
      {
        render: function(data, type, row) {
          if (row.target_to_close == "") {
            row.target_to_close = "-";
          } else {
            row.target_to_close = moment(row.target_to_close).format(
              "DD-MM-YYYY"
            );
          }
          if (row.over == 0) {
            return (
              '<span class="text-size-small text-default">' +
              row.target_to_close +
              "</span>"
            );
          } else {
            return (
              '<span class="text-size-small text-danger-600">' +
              row.target_to_close +
              "</span>"
            );
          }
        },
        orderable: false,
        targets: 7
      },
      {
        render: function(data, type, row) {
          var a = "",
            b = "";
          if (row.closable == 0) {
            a =
              '<span class="label label-flat border-grey text-grey-600">Close</span> ';
            /*a = 'style = "pointer-events:none;"';
                        b = "disabled"*/
          } else if (row.status == "CLOSE") {
            a =
              '<span class="label label-flat border-grey text-grey-600">' +
              row.status +
              "</span> ";
          } else {
            a =
              '<a href="#" title="Closed" class = "issue_close ' +
              b +
              '" issue_risk = "' +
              row.id +
              '" ' +
              a +
              '><span class="label label-flat border-danger text-danger-600">' +
              row.status +
              "</span></i></a> ";
          }

          if (row.status == "OPEN") {
            b =
              '<a href="#" title="Follow up" class = "issue_follow_up" issue_risk = "' +
              row.id +
              '"><span class="label label-flat border-primary text-primary-600">Follow Up</span></a> ';
          } else {
            b =
              '<span class="label label-flat border-grey text-grey-600">Follow Up</span> ';
          }
          return (
            '<span class="text-size-small text-default">' +
            b +
            a +
            " " +
            "</span>"
          );
        },
        orderable: false,
        targets: 8
      },
      {
        render: function(data, type, row) {
          return (
            '<a href="#" title="Attachment" class = "issue_attachment" issue_risk = "' +
            row.id +
            '"><i class = "icon-attachment"><span class="badge bg-warning-400">' +
            row.attc +
            "</span></i></a> "
          );
          // var js_base = JS_BASE_URL.replace('index.php', '');
          /*if(row.file_attachment !== ""){
                        return '<a target = "_blank" href="'+js_base+'/assets/file/issue_risk/'+row.file_attachment+'" class = "detail-issue-risk"><i class = "icon-attachment"></i></a>';
                    } else {
                        return '<span><i class = "icon-attachment"></i></span>';
                    }*/
          // return '<span class="text-size-small text-default"> ' + row.issue_risk + '</span>';
        },
        orderable: false,
        targets: 9
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" class = "edit-issue-risk" issue_risk = "' +
            row.id +
            '"><i class="icon-pencil"></i>Edit</a></li>' +
            '<li><a href="#" class = "delete-issue-risk" issue_risk = "' +
            row.id +
            '"><i class="icon-trash"></i>Delete</a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        visible: true,
        targets: 10
      }
    ],
    order: [1, "desc"],
    columns: [
      { data: "email" },
      { data: "full_name" },
      { data: "title" },
      { data: "join_date" },
      { data: "work_location" }
    ],
    language: {
      search: "Search :"
    },
    fnDrawCallback: function() {
      CallbackIssueRisk();
    }
  });

  $(".datatable-transmittal-daily-list").dataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/toolManagement/datatableTransmittalDaily/",
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          // return '<span class="text-size-small text-default"> ' + row.tools_name + '</span>';
          return (
            '<a href="#" class = "detail-trans" trans_id = "' +
            row.id +
            '">' +
            row.tools_name +
            "</a>"
          );
        },
        orderable: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' +
            row.serial_number +
            "</span>"
          );
          /*return '<a href="#" class = "detail-issue-risk" issue_risk = "' + row.id + '">'+row.serial_number+'</a>';*/
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.date_of_borrowing +
            "</span>"
          );
        },
        orderable: false,
        targets: 2
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.date_of_returning +
            "</span>"
          );
        },
        orderable: false,
        targets: 3
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.remark_borrowing +
            "</span>"
          );
        },
        orderable: false,
        targets: 4
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" class = "edit-trans" trans_id = "' +
            row.id +
            '"><i class="icon-pencil"></i>Edit</a></li>' +
            '<li><a href="#" class = "delete-trans" trans_id = "' +
            row.id +
            '"><i class="icon-trash"></i>Delete</a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        visible: true,
        targets: 5
      }
    ],
    order: [1, "desc"],
    columns: [
      { data: "email" },
      { data: "full_name" },
      { data: "title" },
      { data: "join_date" },
      { data: "work_location" }
    ],
    fnDrawCallback: function() {
      CallbackTransmittal();
    }
  });

  $(".datatable-customer-list").dataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/planning/datatableCustomer/",
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' + row.no + "</span>"
          );
          // return '<a href="#" class = "detail-tools" tools_id = "' + row.id + '">'+row.description+'</a>';
        },
        orderable: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.customer_name +
            "</span>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.customer_address +
            "</span>"
          );
        },
        orderable: false,
        targets: 2
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.customer_phone +
            "</span>"
          );
        },
        orderable: false,
        targets: 3
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.customer_email +
            "</span>"
          );
        },
        orderable: false,
        targets: 4
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.other_customer_details +
            "</span>"
          );
        },
        orderable: false,
        targets: 5
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" class = "edit-customer" customer_id = "' +
            row.id +
            '"><i class="icon-pencil"></i>Edit</a></li>' +
            '<li><a href="#" class = "delete-customer" customer_id = "' +
            row.id +
            '"><i class="icon-trash"></i>Delete</a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        visible: true,
        targets: 6
      }
    ],
    order: [1, "desc"],
    columns: [
      { data: "email" },
      { data: "full_name" },
      { data: "title" },
      { data: "join_date" },
      { data: "work_location" }
    ],
    fnDrawCallback: function() {
      CallbackCustomer();
    }
  });

  $(".datatable-vendor-list").dataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/planning/datatable_vendor/",
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' + row.no + "</span>"
          );
          // return '<a href="#" class = "detail-tools" tools_id = "' + row.id + '">'+row.description+'</a>';
        },
        orderable: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.vendor_name +
            "</span>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.vendor_address +
            "</span>"
          );
        },
        orderable: false,
        targets: 2
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.vendor_phone +
            "</span>"
          );
        },
        orderable: false,
        targets: 3
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.vendor_email +
            "</span>"
          );
        },
        orderable: false,
        targets: 4
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.other_details +
            "</span>"
          );
        },
        orderable: false,
        targets: 5
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" class = "edit-vendor" vendor_id = "' +
            row.id +
            '"><i class="icon-pencil"></i>Edit</a></li>' +
            '<li><a href="#" class = "delete-vendor" vendor_id = "' +
            row.id +
            '"><i class="icon-trash"></i>Delete</a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        visible: true,
        targets: 6
      }
    ],
    order: [1, "desc"],
    columns: [
      { data: "email" },
      { data: "full_name" },
      { data: "title" },
      { data: "join_date" },
      { data: "work_location" }
    ],
    fnDrawCallback: function() {
      CallBackVendor();
    }
  });

  $(".datatable-issuecategory-list").dataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/issueRisk/datatableIssueCategories",
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' + row.id + "</span>"
          );
        },
        orderable: false,
        // visible: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' +
            row.issue_category +
            "</span>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<a href="#" class = "edit-user" user_id = "' +
            row.user_id +
            '"><i class="icon-pencil"></i></a>';
          /*var action_menu = '<ul class="icons-list">' +
                        '<li class="dropdown">' +
                        '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
                        '<ul class="dropdown-menu dropdown-menu-right">' +
                        '<li><a href="#" class = "edit-user" user_id = "' + row.user_id + '"><i class="icon-pencil"></i>Edit User</a></li>' +
                        '</ul>' +
                        '</li>' +
                        '</ul>';*/
          return action_menu;
        },
        orderable: false,
        visible: false,
        targets: 2
      }
    ],
    // order: [0, "asc"],
    columns: [
      /*{data: "user_id"},
            {data: "user_id"},
            {data: "user_id"},
            {data: "user_id"},*/
    ],
    fnDrawCallback: function() {
      // CallbackUser();
      /*this.api().on('draw', function() {
             CallbackMilestone();
             });*/
    }
  });

  $(".datatable-projectscope-list").dataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/issueRisk/datatableProjectScope",
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' + row.id + "</span>"
          );
        },
        orderable: false,
        // visible: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          // return '<span class="text-size-small text-default"> ' + row.fullname + '</span>';
          return (
            '<span class="text-size-small text-default"> ' +
            row.project_scope +
            "</span>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<a href="#" class = "edit-user" user_id = "' +
            row.user_id +
            '"><i class="icon-pencil"></i></a>';
          /*var action_menu = '<ul class="icons-list">' +
                        '<li class="dropdown">' +
                        '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
                        '<ul class="dropdown-menu dropdown-menu-right">' +
                        '<li><a href="#" class = "edit-user" user_id = "' + row.user_id + '"><i class="icon-pencil"></i>Edit User</a></li>' +
                        '</ul>' +
                        '</li>' +
                        '</ul>';*/
          return action_menu;
        },
        orderable: false,
        visible: false,
        targets: 2
      }
    ],
    // order: [0, "asc"],
    columns: [
      /*{data: "user_id"},
            {data: "user_id"},
            {data: "user_id"},
            {data: "user_id"},*/
    ],
    fnDrawCallback: function() {
      // CallbackUser();
      /*this.api().on('draw', function() {
             CallbackMilestone();
             });*/
    }
  });

  $(".datatable-rules-list").dataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: JS_BASE_URL + "/implementation/datatable_rules/",
      type: "POST"
    },
    columnDefs: [
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default"> ' + row.no + "</span>"
          );
          // return '<a href="#" class = "detail-tools" tools_id = "' + row.id + '">'+row.description+'</a>';
        },
        orderable: false,
        targets: 0
      },
      {
        render: function(data, type, row) {
          // return '<span class="text-size-small text-default">' + row.role_name + '</span>';
          return (
            '<a href="#" class = "detail-rule" rule_id = "' +
            row.id +
            '">' +
            row.role_name +
            "</a>"
          );
        },
        orderable: false,
        targets: 1
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' + row.name + "</span>"
          );
        },
        orderable: false,
        targets: 2
      },
      {
        render: function(data, type, row) {
          return (
            '<span class="text-size-small text-default">' +
            row.point +
            "</span>"
          );
        },
        orderable: false,
        targets: 3
      },
      {
        render: function(data, type, row) {
          var action_menu =
            '<ul class="icons-list">' +
            '<li class="dropdown">' +
            '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>' +
            '<ul class="dropdown-menu dropdown-menu-right">' +
            '<li><a href="#" class = "edit-rules" rule_id = "' +
            row.id +
            '"><i class="icon-pencil"></i>Edit</a></li>' +
            // '<li><a href="#" class = "delete-vendor" vendor_id = "' + row.id + '"><i class="icon-trash"></i>Delete</a></li>' +
            "</ul>" +
            "</li>" +
            "</ul>";
          return action_menu;
        },
        orderable: false,
        visible: true,
        targets: 4
      }
    ],
    order: [1, "desc"],
    columns: [
      { data: "email" },
      { data: "full_name" },
      { data: "title" },
      { data: "join_date" },
      { data: "work_location" }
    ],
    fnDrawCallback: function() {
      CallBackRules();
    }
  });

  //==============================================================================================================

  // Javascript sourced data
  var dataSet = [
    ["Trident", "Internet Explorer 4.0", "Win 95+", "4", "X"],
    ["Trident", "Internet Explorer 5.0", "Win 95+", "5", "C"],
    ["Trident", "Internet Explorer 5.5", "Win 95+", "5.5", "A"],
    ["Trident", "Internet Explorer 6", "Win 98+", "6", "A"],
    ["Gecko", "Firefox 1.0", "Win 98+ / OSX.2+", "1.7", "A"],
    ["Gecko", "Firefox 1.5", "Win 98+ / OSX.2+", "1.8", "A"],
    ["Gecko", "Firefox 2.0", "Win 98+ / OSX.2+", "1.8", "A"],
    ["Gecko", "Firefox 3.0", "Win 2k+ / OSX.3+", "1.9", "A"],
    ["Gecko", "Camino 1.0", "OSX.2+", "1.8", "A"],
    ["Gecko", "Camino 1.5", "OSX.3+", "1.8", "A"],
    ["Webkit", "Safari 1.2", "OSX.3", "125.5", "A"],
    ["Webkit", "Safari 1.3", "OSX.3", "312.8", "A"],
    ["Webkit", "Safari 2.0", "OSX.4+", "419.3", "A"],
    ["Presto", "Opera 7.0", "Win 95+ / OSX.1+", "-", "A"],
    ["Presto", "Opera 7.5", "Win 95+ / OSX.2+", "-", "A"],
    ["Misc", "NetFront 3.1", "Embedded devices", "-", "C"],
    ["Misc", "NetFront 3.4", "Embedded devices", "-", "A"],
    ["Misc", "Dillo 0.8", "Embedded devices", "-", "X"],
    ["Misc", "Links", "Text only", "-", "X"]
  ];

  $(".datatable-js").dataTable({
    data: dataSet,
    columnDefs: []
  });

  // Nested object data
  $(".datatable-nested").dataTable({
    ajax: "assets/demo_data/tables/datatable_nested.json",
    columns: [
      { data: "name[, ]" },
      { data: "hr.0" },
      { data: "office" },
      { data: "extn" },
      { data: "hr.2" },
      { data: "hr.1" }
    ]
  });

  // Generate content for a column
  var table = $(".datatable-generated").DataTable({
    ajax: "assets/demo_data/tables/datatable_ajax.json",
    columnDefs: [
      {
        targets: 2,
        data: null,
        defaultContent: "<button class='label label-default'>Show</button>"
      },
      {
        orderable: false,
        targets: [0, 2]
      }
    ]
  });

  $(".datatable-generated tbody").on("click", "button", function() {
    var data = table.row($(this).parents("tr")).data();
    alert(data[0] + "'s location is: " + data[2]);
  });

  // External table additions
  // ------------------------------

  // Add placeholder to the datatable filter option
  $(".dataTables_filter input[type=search]").attr(
    "placeholder",
    "Type to filter..."
  );

  // Enable Select2 select for the length option
  $(".dataTables_length select").select2({
    minimumResultsForSearch: Infinity,
    width: "auto"
  });
});

function capt(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function CurrencyFormat(number) {
  return (Math.round(number * 100) / 100).toLocaleString("id");
}

function alertSuccess() {
  new PNotify({
    title: "Success",
    text: "Data has been saved.",
    addclass: "alert alert-success alert-styled-right",
    type: "success"
  });
}

// Dendy 22-03-2019
function alertDeleteSuccess() {
  new PNotify({
    title: "Success",
    text: "Data has been deleted.",
    addclass: "alert alert-success alert-styled-right",
    type: "success"
  });
}

var CallbackMilestone = function() {
  $(".attach_tasklist").on("click", function() {
    var option = "";
    var project_id = $(this).attr("project_id");
    var milestone_id = $(this).attr("milestone_id");

    $.ajax({
      url: JS_BASE_URL + "/projects/getTaskList",
      type: "POST",
      dataType: "json",
      data: { project_id: project_id },
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            option +=
              '<option value="' +
              val.id +
              '">' +
              val.task_list_name +
              "</option> ";
          });
        }
      }
    });
    bootbox.dialog({
      title: "Attach Task List",
      message:
        '<div class="row">  ' +
        '<div class="col-md-12">' +
        '<form action="#" id = "task_list_form">' +
        '<div class="form-group">' +
        '<input type = "hidden" name = "milestone_id" value = "' +
        milestone_id +
        '">' +
        '<select name="task_list_id" data-placeholder="Select tasklist" class="select">' +
        '<option value="">No Milestone</option>' +
        option +
        "</select>" +
        "</div>" +
        "</form>" +
        "</div>" +
        "</div>",
      buttons: {
        success: {
          label: "Attach Task List",
          className: "btn-success",
          callback: function() {
            var form = $("#task_list_form");
            $.ajax({
              url: JS_BASE_URL + "/projects/attachTaskList",
              type: "POST",
              dataType: "json",
              data: form.serialize(),
              success: function(res) {
                /*if(res.status == 'Success'){
                                     window.location.replace(JS_BASE_URL +'/projects/all');
                                     }*/
              }
            });
          }
        }
      }
    });

    $(".select")
      .parents(".bootbox")
      .removeAttr("tabindex");
    $(".select").select2();

    // Single picker
    $(".daterange-single").daterangepicker({
      singleDatePicker: true
    });
  });

  $(".edit_milestone").on("click", function() {
    var milestone_name = "",
      responsible_user = "",
      due_date = "",
      note = "",
      followers = "";
    var project = "";
    var milestone_id = $(this).attr("milestone_id");
    $.ajax({
      url: JS_BASE_URL + "/projects/getMilestoneDetail/" + milestone_id,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          milestone_name = res.data[0].milestone_name;
          responsible_user = res.data[0].responsible_to;
          due_date = res.data[0].due_date;
          note = res.data[0].description;
          project = res.data[0].projects_id;
        }
      }
    });
    var option = "";
    console.log(project);
    $.ajax({
      url: JS_BASE_URL + "/planning/getPeopleInProject/" + project,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            var selected = "";
            if (responsible_user == val.id) {
              selected = "selected";
            }
            option +=
              '<option value="' +
              val.id +
              '" ' +
              selected +
              ">" +
              val.name +
              "</option> ";
          });
        }
      }
    });
    console.log(option);
    bootbox.dialog({
      title: "Edit Milestone",
      message:
        '<div class="row"> ' +
        '<div class="col-md-12">' +
        '<form action="#" id = "add_milestone_form">' +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Name the milestone</label> " +
        '<input type="text" name = "milestone" value = "' +
        milestone_name +
        '"class="form-control"> ' +
        //'<input type="hidden" name = "project_id"  value = "<?php echo $project_id?>" class="form-control">' +
        "</div> " +
        "</div> " +
        "</div>" +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        '<div class="form-group"> ' +
        "<label>Who is responsible?</label> " +
        '<select id="country" name="asignee" data-placeholder="Anyone" class="select company">' +
        '<option value="">Anyone</option> ' +
        option +
        "</select>" +
        "</div> " +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>Due Date</label>" +
        '<div class="input-group">' +
        '<span class="input-group-addon"><i class="icon-calendar22"></i></span>' +
        '<input type="text" id = "due_date" class="form-control daterange-single" name = "milestone_due_date" placeholder="No date">' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">' +
        '<li class="active"><a href="#a" data-toggle="tab" aria-expanded="true">Notes</a></li>' +
        ' <li class=""><a href="#b" data-toggle="tab" aria-expanded="false">Followers</a></li>' +
        "</ul>" +
        '<div class="tab-content">' +
        '<div class="tab-pane fade active in" id="a">' +
        '<div class="form-group">' +
        '<label class = "m-10">Provide a Description (Optional):</label> ' +
        '<textarea rows="4" cols="5" name = "description" placeholder="Description..." class="form-control"></textarea>' +
        "</div>" +
        "</div>" +
        '<div class="tab-pane fade" id="b">' +
        '<div class="form-group">' +
        '<label class = "m-10">Who can see it?</label>' +
        '<select data-placeholder="Select user" class="select company" multiple = "multiple">' +
        '<option value="anyone">Anyone in this project</option>' +
        '<option value="me">Me</option>' +
        "</select>" +
        "</div>" +
        "</div>" +
        "</form>" +
        "</div>" +
        "</div>",
      buttons: {
        success: {
          label: "Save",
          className: "btn-success",
          callback: function() {
            var form = $("#add_milestone_form");
            $.ajax({
              url: JS_BASE_URL + "/projects/saveMilestone",
              type: "POST",
              dataType: "json",
              data: form.serialize(),
              success: function(res) {
                var dbmil = $(".datatable-milestone-list").dataTable();
                if (res.status == "Success") {
                  dbmil.api().ajax.reload();
                }
              }
            });
          }
        }
      }
    });

    $(".select")
      .parents(".bootbox")
      .removeAttr("tabindex");
    $(".select").select2();
    // Single picker
    $(".daterange-single").daterangepicker({
      singleDatePicker: true
    });
  });
};
var callBackTaskList = function() {
  $(".edit-task").on("click", function() {
    var taskName = "",
      startDate = "",
      endDate = "",
      progress = "",
      tasklistId = "";
    var taskId = $(this).attr("task_id");
    var projectId = "";
    $.ajax({
      url: JS_BASE_URL + "/planning/taskDetail/" + taskId,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          console.log(res.data);
          taskName = res.data.tasks_name;
          startDate = res.data.start_date;
          endDate = res.data.due_date;
          progress = res.data.progress;
          tasklistId = res.data.description;
          projectId = res.data.projects_id;
        }
      }
    });
    var option = "";
    $.ajax({
      url: JS_BASE_URL + "/planning/getTaskList/",
      type: "POST",
      data: { project_id: projectId },
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            var selected = "";
            if (tasklistId == val.id) {
              selected = "selected";
            }
            option +=
              '<option value="' +
              val.id +
              '" ' +
              selected +
              ">" +
              val.task_list_name +
              "</option> ";
          });
        }
      }
    });
    bootbox.dialog({
      title: "Edit Task",
      message:
        '<div class="row"> ' +
        '<div class="col-md-12">' +
        '<form action="#" id = "add_milestone_form">' +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Name the task</label> " +
        '<input type="hidden" name = "task_id" value = "' +
        taskId +
        '"> ' +
        '<input type="text" name = "task_name" value = "' +
        taskName +
        '"class="form-control"> ' +
        //'<input type="hidden" name = "project_id"  value = "<?php echo $project_id?>" class="form-control">' +
        "</div> " +
        "</div> " +
        "</div>" +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        '<div class="form-group"> ' +
        "<label>Start Date</label> " +
        '<div class="input-group">' +
        '<span class="input-group-addon"><i class="icon-calendar22"></i></span>' +
        '<input type="text" id = "start_date" class="form-control daterange-single" name = "start_date" placeholder="No date">' +
        "</div> " +
        "</div> " +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>End Date</label>" +
        '<div class="input-group">' +
        '<span class="input-group-addon"><i class="icon-calendar22"></i></span>' +
        '<input type="text" id = "end_date" class="form-control daterange-single" name = "due_date" placeholder="No date">' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        '<div class="form-group"> ' +
        "<label>Progress</label> " +
        '<div class="input-group">' +
        '<input type="progress" id = "progress" class="form-control" name = "progress">' +
        '<span class="input-group-addon">%</span>' +
        "</div> " +
        "</div> " +
        "</div> " +
        '<div class="col-sm-6">' +
        '<div class="form-group"> ' +
        "<label>Task List</label> " +
        '<select id="tasklist" name="tasklist" data-placeholder="Select scope" class="select"> ' +
        option +
        "</select> " +
        "</div> " +
        "</div> " +
        "</div> " +
        "</form>" +
        "</div>",
      buttons: {
        success: {
          label: "Save",
          className: "btn-success",
          callback: function() {
            var form = $("#add_milestone_form");
            $.ajax({
              url: JS_BASE_URL + "/planning/updateTask",
              type: "POST",
              dataType: "json",
              data: form.serialize(),
              success: function(res) {
                var dbt = $(".datatable-task-list").dataTable();
                if (res.status == "Success") {
                  dbmil.api().ajax.reload();
                }
              }
            });
          }
        }
      }
    });

    $(".select")
      .parents(".bootbox")
      .removeAttr("tabindex");
    $(".select").select2();
    // Single picker
    $(".daterange-single").daterangepicker({
      singleDatePicker: true
    });
    // Single picker
    if (startDate !== null) {
      start_date = startDate;
      $("#start_date").daterangepicker({
        singleDatePicker: true,
        startDate: moment(startDate).format("DD-MM-YYYY"),
        locale: {
          format: "DD-MM-YYYY"
        }
      });
    } else {
      $("#start_date").val("");
    }
    if (endDate != null) {
      end_date = endDate;
      $("#end_date").daterangepicker({
        singleDatePicker: true,
        startDate: moment(end_date).format("DD-MM-YYYY"),
        locale: {
          format: "DD-MM-YYYY"
        }
      });
    } else {
      $("#end_date").val("");
    }
  });

  $(".delete-task").on("click", function() {
    var taskId = $(this).attr("task_id");
    swal(
      {
        title: "Are you sure?",
        text: "Are you sure you want to delete this task?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#EF5350",
        confirmButtonText: "Yes, delete it",
        cancelButtonText: "No, cancel please",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          var baseURL =
            window.location.protocol + "//" + window.location.hostname + "";
          var url = baseURL + "/planning/deleteTask/";
          var t1 = $(".datatable-task-list").dataTable();
          $.ajax({
            type: "POST",
            url: url,
            async: false,
            data: { taskId: taskId },
            dataType: "json",
            success: function(result) {
              if (result.status == "Success") {
                swal(
                  {
                    title: "Deleted!",
                    text: "This task has been deleted",
                    confirmButtonColor: "#66BB6A",
                    type: "success"
                  },
                  function(isConfirm) {
                    //location.reload();
                    t1.api().ajax.reload();
                  }
                );
              }
            }
          });
        } else {
          swal({
            title: "Cancelled",
            text: "cancel and not process anything.",
            confirmButtonColor: "#2196F3",
            type: "error"
          });
        }
      }
    );
  });
};

var CallbackProject = function() {
  $(".edit_project").on("click", function() {
    var project_id = $(this).attr("project_id");
    var source = $(this).attr("source");
    var option = "";
    var that = this;
    var id_project = $(this).attr("project_id");
    var project_name = "",
      startDate = "",
      endDate = "",
      company2 = "",
      description = "",
      completion = 0;
    $.ajax({
      url: JS_BASE_URL + "/planning/getProjectDetail/" + project_id,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          project_name = res.data[0].project_name;
          description = res.data[0].description;
          company = res.data[0].company;
          startDate = res.data[0].start_date;
          endDate = res.data[0].end_date;
          customer = res.data[0].customer;
          scope = res.data[0].scope;
          customer_name = res.data[0].customer;
          pic = res.data[0].pic_id;
          status = res.data[0].status;
          capacity = res.data[0].capacity;
          baseline = res.data[0].baseline;
          leader = res.data[0].leader_id;
          detail = res.data[0];
        }
      }
    });

    var pics = [];

    if (pic != null) {
      pic = pic.split(",");
      $.each(pic, function(i, val) {
        val = val.replace("|", "");
        val = val.replace("|", "");
        pics.push(val);
      });
    }

    var leaders = [];
    if (leader != null) {
      leader = leader.split(",");
      $.each(leader, function(i, val) {
        val = val.replace("|", "");
        val = val.replace("|", "");
        leaders.push(val);
      });
    }

    cities = [];
    if (detail.cities != null) {
      detail.cities = detail.cities.split(",");
      cities = detail.cities;
    }

    var list_company = "";
    $.ajax({
      url: JS_BASE_URL + "/planning/getCompany",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            var slctd = "";
            if (company == val.company_name) {
              slctd += "selected";
            }
            list_company +=
              '<option value="' +
              val.company_name +
              '" ' +
              slctd +
              ">" +
              val.company_name +
              "</option>";
          });
        }
      }
    });
    var list_scope = "";
    $.ajax({
      url: JS_BASE_URL + "/planning/getProjectScope",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, dt) {
            var slctd = "";
            if (scope == dt.project_scope) {
              slctd += "selected";
            }
            list_scope +=
              '<option value="' +
              dt.project_scope +
              '" ' +
              slctd +
              ">" +
              dt.project_scope +
              "</option>";
          });
        }
      }
    });
    var list_resource = "";
    $.ajax({
      url: JS_BASE_URL + "/planning/getResource",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            list_resource +=
              '<option value="' +
              val.user_id +
              '">' +
              val.fullname +
              "</option> ";
          });
        }
      }
    });

    var list_user = "";
    $.ajax({
      url: JS_BASE_URL + "/administration/activeUser",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          // console.log(pic);

          $.each(res.data, function(i, val) {
            // val.replace("|")
            var slctd = "";
            if (pics.includes(val.user_id)) {
              slctd += "selected";
            }
            list_user +=
              '<option value="' +
              val.user_id +
              '"' +
              slctd +
              " >" +
              val.fullname +
              "</option> ";
          });
        }
      }
    });

    var list_leader = "";

    $.ajax({
      url: JS_BASE_URL + "/resource/position_person",
      type: "POST",
      dataType: "json",
      data: { position: "2" },
      async: false,
      success: function(res) {
        if ((res.status = "success")) {
          $.each(res.data, function(i, val) {
            var slctd = "";
            if (leaders.length > 0) {
              if (leaders.includes(val.user_id)) {
                slctd += "selected";
              }
            }
            list_leader +=
              '<option value="' +
              val.user_id +
              '"' +
              slctd +
              " >" +
              val.fullname +
              "</option> ";
          });
        }
      }
    });
    var list_customer = "";
    $.ajax({
      url: JS_BASE_URL + "/planning/all_customer",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            var slctd = "";
            if (customer == val.id) {
              slctd += "selected";
            }
            list_customer +=
              '<option value="' +
              val.customer_name +
              '" ' +
              slctd +
              ">" +
              val.customer_name +
              "</option> ";
          });
        }
      }
    });

    var list_status = "";
    $.ajax({
      url: JS_BASE_URL + "/planning/get_status",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            var slctd = "";
            if (status == val.status) {
              slctd += "selected";
            }
            list_status +=
              '<option value="' +
              val.status +
              '" ' +
              slctd +
              ">" +
              val.status +
              "</option> ";
          });
        }
      }
    });

    var list_area = "";
    $.ajax({
      url: JS_BASE_URL + "/planning/get_work_location",
      type: "GEkT",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "success") {
          $.each(res.data, function(i, val) {
            var slctd = "";
            if (cities.length > 0) {
              if (cities.includes(val.location)) {
                slctd += "selected";
              }
            }
            list_area +=
              '<option value="' +
              val.location +
              '"  ' +
              slctd +
              ">" +
              val.location +
              "</option> ";
          });
        }
      }
    });
    console.log(list_area);
    bootbox
      .dialog({
        title: "Edit Project",
        message:
          '<div class="row">' +
          '<div class="col-md-12">' +
          '<form action="#" id="edit_project_form">' +
          '<div class="form-group">' +
          '<div class="row">' +
          '<div class="col-sm-12">' +
          '<label class="text-semibold">What\'s the Project Name?</label>' +
          '<input type="hidden" name="project_id" value="' +
          project_id +
          '" class="form-control">' +
          '<input type="text" placeholder="Project name" name="project_name" value="' +
          project_name +
          '" class="form-control input-lg text-semibold">' +
          "</div>" +
          "</div>" +
          "</div>" +
          '<div class="form-group">' +
          '<div class="row">' +
          '<div class="col-sm-12">' +
          '<label class="text-semibold">Status</label>' +
          '<select id="status" name="status" data-placeholder="Select status" class="select">' +
          '<option value="">No Status</option>' +
          list_status +
          "</select>" +
          "</div>" +
          "</div>" +
          "</div>" +
          '<ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">' +
          '<li class="active"><a href="#tab_description" data-toggle="tab" aria-expanded="true">Description</a></li>' +
          '<li class=""><a href="#tab_dates" data-toggle="tab" aria-expanded="false">Dates</a></li>' +
          // '<li class=""><a href="#tab_scope" data-toggle="tab" aria-expanded="false">Scope</a></li>' +
          '<li class=""><a href="#tab_company" data-toggle="tab" aria-expanded="false">Company</a></li>' +
          '<li class=""><a href="#tab_customer" data-toggle="tab" aria-expanded="false">Customer</a></li>' +
          // '<li class=""><a href="#tab_resource" data-toggle="tab" aria-expanded="false">Resource</a></li>' +
          '<li class=""><a href="#tab_pic" data-toggle="tab" aria-expanded="false">Authorized User</a></li>' +
          '<li class=""><a href="#tab_leader" data-toggle="tab" aria-expanded="false">Leader</a></li>' +
          '<li class=""><a href="#tab_capacity" data-toggle="tab" aria-expanded="false">Capacity</a></li>' +
          '<li class=""><a href="#tab_cities" data-toggle="tab" aria-expanded="false">Cities</a></li>' +
          // '<li class=""><a href="#tab_baseline" data-toggle="tab" aria-expanded="false">Baseline</a></li>' +
          "</ul>" +
          '<div class="tab-content">' +
          '<div class="tab-pane fade active in" id="tab_description">' +
          /*'<div class="form-group">' +
                '<div class="row">' +
                '<div class="col-sm-12">' +
                '<label class="mt-10 text-semibold">Project Completion</label>' +
                '<div class="input-group col-sm-8">' +
                '<input type="text" placeholder="Project completion in percent" name = "completion" value = "' + completion + '" class="form-control">' +
                '<span class="input-group-addon">%</span> ' +
                '</div>' +
                '</div>' +
                '</div>' +*/
          /*'</div>' +*/
          '<div class="form-group">' +
          '<label class="mt-10 text-semibold">Provide a Description (Optional):</label>' +
          '<textarea rows="4" cols="5" name="project_description" placeholder="Description..." class="form-control">' +
          description +
          "</textarea>" +
          "</div>" +
          "</div>" +
          '<div class="tab-pane fade" id="tab_dates">' +
          '<label class="mt-10"><span class="text-semibold">Project Dates</span> (Optional)<br/><small class="text-muted">Adding a start and end date provides your team a useful way to see the duration of this project which helps with planning your tasks and milestones</small></label>' +
          '<div class="row">' +
          '<div class="col-sm-6">' +
          "<label>PL Start</label>" +
          '<div class="input-group">' +
          '<span class="input-group-addon"><i class="icon-calendar22"></i></span> ' +
          '<input type="text" class="form-control daterange-single" id="start_date" name="project_start_date"> ' +
          "</div>" +
          "</div>" +
          '<div class="col-sm-6">' +
          "<label>PL Finish</label>" +
          '<div class="input-group">' +
          '<span class="input-group-addon"><i class="icon-calendar22"></i></span>' +
          '<input type="text" class="form-control daterange-single" id = "end_date" name="project_end_date">' +
          "</div>" +
          "</div>" +
          "</div>" +
          "</div>" +
          '<div class="tab-pane fade" id="tab_scope">' +
          '<div class="form-group">' +
          '<label class="mt-10 text-semibold">Project Scope:</label>' +
          '<select id="scope" name="scope" data-placeholder="Select project scope" class="select">' +
          '<option value="">No Scope</option>' +
          list_scope +
          "</select>" +
          "</div>" +
          "</div>" +
          '<div class="tab-pane fade" id="tab_company">' +
          '<div class="form-group">' +
          '<label class="mt-10 text-semibold">This Project is for Company:</label>' +
          '<select id="country" name="project_company" data-placeholder="Select your company" class="select">' +
          '<option value="">No Company</option>' +
          list_company +
          "</select>" +
          "</div>" +
          "</div>" +
          '<div class="tab-pane fade" id="tab_customer">' +
          '<div class="form-group">' +
          '<label class="mt-10 text-semibold">This Project is for Customer:</label>' +
          '<select id="customer" name="customer" data-placeholder="Select customer" class="select">' +
          '<option value="">Select</option>' +
          list_customer +
          "</select>" +
          "</div>" +
          "</div>" +
          '<div class="tab-pane fade" id="tab_resource">' +
          '<div class="form-group">' +
          '<label class="mt-10 text-semibold">Who should be added to this project?</label>' +
          '<select data-placeholder="Select person" name="team[]" class="select" multiple="multiple">' +
          list_resource +
          "</select>" +
          "</div>" +
          "</div>" +
          '<div class="tab-pane fade" id="tab_pic">' +
          '<div class="form-group">' +
          '<label class="mt-10 text-semibold">Authorized User</label>' +
          '<select id="pic" name="pic[]" data-placeholder="Select PIC for this Project" class="select" multiple = "multiple">' +
          '<option value="">No Scope</option>' +
          list_user +
          "</select>" +
          "</div>" +
          "</div>" +
          '<div class="tab-pane fade" id="tab_leader">' +
          '<div class="form-group">' +
          '<label class="mt-10 text-semibold">Leader</label>' +
          '<select id="leader" name="leader[]" data-placeholder="Select Leader for this Project" class="select" multiple = "multiple">' +
          '<option value="">Select Person</option>' +
          list_leader +
          "</select>" +
          "</div>" +
          "</div>" +
          '<div class="tab-pane fade" id="tab_cities">' +
          '<div class="form-group">' +
          '<label class="mt-10 text-semibold">Cities:</label>' +
          '<select data-placeholder="Select cities" id="cities" name="cities[]" class="select" multiple="multiple">' +
          list_area +
          "</select>" +
          "</div>" +
          "</div>" +
          '<div class="tab-pane fade" id="tab_capacity">' +
          '<div class="form-group">' +
          '<label class="mt-10 text-semibold">Capacity</label>' +
          '<input type="text" class="form-control" id = "capacity" name = "capacity" value = "' +
          capacity +
          '">' +
          "</div>" +
          "</div>" +
          '<div class="tab-pane fade" id="tab_baseline">' +
          '<div class="form-group">' +
          '<div class="col-sm-6">' +
          '<label class="text-semibold">Baseline</label>' +
          '<div class="input-group">' +
          '<input type="number" step = "0.01" class="form-control" id = "baseline" name = "baseline" value = "' +
          baseline +
          '">' +
          '<span class="input-group-addon">%</span>' +
          "</div>" +
          "</div>" +
          // '<input type="text" class="form-control" id = "capacity" name = "baseline" value = "'+baseline+'">'+
          "</div>" +
          "</div>" +
          "</div>" +
          "</form>" +
          "</div>" +
          "</div>",
        buttons: {
          success: {
            label: "Update Project",
            className: "btn-success",
            callback: function() {
              var editProject = $("#edit_project_form");
              var table1 = $(".datatable-projects-list").dataTable();
              $.ajax({
                url: JS_BASE_URL + "/planning/editProject",
                type: "POST",
                dataType: "json",
                data: editProject.serialize(),
                success: function(res) {
                  if (res.status == "Success") {
                    new PNotify({
                      title: "Success",
                      text: "Data has been saved",
                      icon: "icon-checkmark3",
                      addclass: "bg-success",
                      delay: "3000"
                    });

                    if (source == "list") {
                      table1.api().ajax.reload();
                    } else {
                      // window.location.replace(JS_BASE_URL + '/planning/id/'+project_id);
                    }
                  }
                }
              });
            }
          }
        }
      })
      .find("div.modal-dialog")
      .addClass("modal-lg");

    $(".select")
      .parents(".bootbox")
      .removeAttr("tabindex");
    $(".select").select2();
    $("#select").select2("val", company2);

    // $('.daterange-single').daterangepicker({
    //     singleDatePicker: true,
    // });

    // console.log(startDate);
    if (startDate !== null && startDate !== "0000-00-00") {
      $("#start_date").daterangepicker({
        singleDatePicker: true,
        startDate: moment(startDate).format("DD-MM-YYYY"),
        locale: {
          format: "DD-MM-YYYY"
        }
      });
    } else {
      var bulan_ini = moment()
        .startOf("month")
        .format("DD-MM-YYYY");
      $("#start_date").daterangepicker({
        singleDatePicker: true,
        startDate: bulan_ini,
        locale: {
          format: "DD-MM-YYYY"
        }
      });
    }

    console.log(endDate);
    if (endDate !== null && endDate !== "0000-00-00") {
      $("#end_date").daterangepicker({
        singleDatePicker: true,
        startDate: moment(endDate).format("DD-MM-YYYY"),
        locale: {
          format: "DD-MM-YYYY"
        }
      });
    } else {
      var bulan_depan = moment()
        .startOf("month")
        .add(1, "M")
        .format("DD-MM-YYYY");
      // $('#end_date').val('test');
      $("#end_date").daterangepicker({
        singleDatePicker: true,
        startDate: bulan_depan,
        locale: {
          format: "DD-MM-YYYY"
        }
      });

      /*$('#end_date').daterangepicker({
                singleDatePicker: true,
                // startDate : '00-00-0000',
                locale: {
                    format: 'DD-MM-YYYY'
                },
            });*/
    }
    // $('#start_date').daterangepicker({
    //     singleDatePicker: true,
    //     startDate: moment(detail.further_action_date).format('DD-MM-YYYY'),
    //     locale: {
    //         format: 'DD-MM-YYYY'
    //     },
    // });
    // $('#start_date').daterangepicker({
    //     singleDatePicker: true,
    //     // startDate: moment(startDate).format('DD-MM-YYYY'),
    //     /*locale: {
    //         format: 'DD-MM-YYYY'
    //     },*/
    // });
    // Single picker
    // if (startDate !== null) {
    //     start_date = startDate;
    //     $('#start_date').daterangepicker({
    //         singleDatePicker: true,
    //         startDate: moment(startDate).format('DD-MM-YYYY'),
    //         locale: {
    //             format: 'DD-MM-YYYY'
    //         },
    //     });
    // } else {
    //     $('#start_date').val('');
    // }
    // if (endDate != null) {
    //     end_date = endDate;
    //     $('#end_date').daterangepicker({
    //         singleDatePicker: true,
    //         startDate: moment(end_date).format('DD-MM-YYYY'),
    //         locale: {
    //             format: 'DD-MM-YYYY'
    //         },
    //     });
    // } else {
    //     $('#end_date').val('');
    // }
  });
};

var CallbackUser = function() {
  $(".edit-user").on("click", function() {
    $('input[name="checkbox"]').prop("checked", false);
    $('input[type="checkbox"]')
      .parent()
      .removeClass("checked");
    $("#add_user_form")[0].reset();
    var option = "";
    var that = this;
    var userId = $(this).attr("user_id");
    var detail;
    $.ajax({
      url: JS_BASE_URL + "/administration/userDetail/" + userId,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "success") {
          detail = res.data;
        }
      }
    });

    console.log(detail);
    $("#user_id").val(detail.user_id);
    $("#emp_name").val(detail.sso_id);
    $("#emp_fullname").val(detail.fullname);
    $("#email").val(detail.email);
    $("#project").val(detail.project);
    $("#roles").val(detail.role_id);
    $("#area_assigned").val(detail.work_location);
    $("#department").val(detail.department);
    $(".permission-list").removeClass("hidden");
    $.ajax({
      url: JS_BASE_URL + "/administration/getUserPermission",
      type: "POST",
      data: { role: detail.role_id, user: detail.user_id },
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            cat = "permission[" + val + "]";
            // cat = 'P'+val;
            $('input[name="' + cat + '"]').prop("checked", true);
            $('input[name="' + cat + '"]')
              .parent()
              .addClass("checked");
          });

          $(".head").each(function(index) {
            var c = ".m-" + $(this).attr("menu_id") + "-c";
            var s = c + ":not(:checked)";
            if ($(c).length != 0) {
              console.log($(s));
              if ($(s).length == 0) {
                // console.log('kecentang semua');
                $(this).prop("checked", true);
                $(this)
                  .parent()
                  .addClass("checked");
              } else {
                // console.log('ga kecentang semua');

                // $(this).prop('checked', true);
                // $(this).prop('checked', false);
                $(this)
                  .parent()
                  .removeClass("checked");
              }
            }
          });
        }
      }
    });

    $.ajax({
      url: JS_BASE_URL + "/administration/all_project_access",
      type: "POST",
      data: { user_id: detail.user_id },
      dataType: "json",
      async: false,
      success: function(res) {
        // console.log(res);
        if (res.status == "success") {
          $("#all_project").prop("checked", true);
          $("#all_project")
            .parent()
            .addClass("checked");
        } else {
          $("#all_project")
            .parent()
            .removeClass("checked");
          $("#project").removeAttr("disabled");
        }
        // if (res.status == 'Success') {
        //     $.each(res.data, function (i, val) {
        //         cat = 'permission['+val+']';
        //         // cat = 'P'+val;
        //         $('input[name="'+cat+'"]').prop('checked', true);
        //         $('input[name="'+cat+'"]').parent().addClass('checked');
        //     });

        //     $( ".head" ).each(function( index ) {
        //         var c = ".m-"+$(this).attr('menu_id')+"-c";
        //         var s = c + ":not(:checked)"
        //         if($(c).length != 0){
        //             console.log($(s));
        //             if($(s).length == 0){
        //                 // console.log('kecentang semua');
        //                 $(this).prop('checked', true);
        //                 $(this).parent().addClass('checked');
        //             } else {
        //                 // console.log('ga kecentang semua');

        //                 // $(this).prop('checked', true);
        //                 // $(this).prop('checked', false);
        //                 $(this).parent().removeClass('checked');
        //             }
        //         }
        //     });
        // }
      }
    });
    // $("#roles").append('<option value="test">Test</option>');
    $("#roles").on("change", function() {
      $('input[name="checkbox"]').prop("checked", false);
      $('input[type="checkbox"]')
        .parent()
        .removeClass("checked");
      role_id = $(this).val();
      $.ajax({
        url: JS_BASE_URL + "/administration/role_permission",
        type: "POST",
        data: { role: role_id },
        dataType: "json",
        async: false,
        success: function(res) {
          if (res.status == "Success") {
            $.each(res.data, function(i, val) {
              cat = "permission[" + val + "]";
              // cat = 'P'+val;
              $('input[name="' + cat + '"]').prop("checked", true);
              $('input[name="' + cat + '"]')
                .parent()
                .addClass("checked");
            });

            $(".head").each(function(index) {
              var c = ".m-" + $(this).attr("menu_id") + "-c";
              var s = c + ":not(:checked)";
              if ($(c).length != 0) {
                console.log($(s));
                if ($(s).length == 0) {
                  // console.log('kecentang semua');
                  $(this).prop("checked", true);
                  $(this)
                    .parent()
                    .addClass("checked");
                } else {
                  // console.log('ga kecentang semua');

                  // $(this).prop('checked', true);
                  // $(this).prop('checked', false);
                  $(this)
                    .parent()
                    .removeClass("checked");
                }
              }
            });
          }
        }
      });
      $(".permission-list").removeClass("hidden");
    });

    $("#modal_add_user").modal("show");
    $("#emp_name").on("change", function() {
      var values = $(this).val();
      $.ajax({
        url: JS_BASE_URL + "/administration/getEmpDetail",
        type: "POST",
        data: { emp_code: values },
        dataType: "json",
        async: false,
        success: function(res) {
          $("#emp_fullname").val(res.fullname);
          $("#email").val(res.email);
        }
      });
    });

    /*var scopes = ["Submarine", "Inland", "Civil Work", "FTTB", "FTTH"];
         var optionScope = "";
         $.each(scopes, function(i, val) {
         var selected = "";
         if (scope == val) {selected += "selected"};
         optionScope += '<option value="'+val+'" '+selected+'>'+val+'</option>';
         });*/
    /*bootbox.dialog({
                title: "Edit User",
                message: '<div class="row"> ' +
                '<div class="col-md-12">' +
                '<form action="#" id = "edit_user_form">' +
                '<div class="form-group">' +
                '<div class="row">' +
                '<div class="col-sm-6">' +
                '<label>Email</label> ' +
                '<input type="hidden" name = "user_id" value = "' + userId + '" class="form-control"> ' +
                '<select id="country" name="email" data-placeholder="Test" class="select">' +
                option2 +
                '</select>' +
                '</div> ' +
                '<div class="col-sm-6">' +
                '<label>Name</label> ' +
                '<input type="text" name = "fullname" value = "' + name + '" class="form-control"> ' +
                '</div> ' +
                '</div>' +
                '</div>' +
                '<div class="row">' +
                '<div class="col-sm-12">' +
                '<div class="form-group"> ' +
                '<label>Role</label> ' +
                '<select id="country" name="role" data-placeholder="Test" class="select">' +
                option +
                '</select>' +
                '</div> ' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</form>' +
                '</div>' +
                '</div>',
                buttons: {
                    success: {
                        label: "Save",
                        className: "btn-success",
                        callback: function () {
                            var form = $('#edit_user_form');
                            $.ajax({
                                url: JS_BASE_URL + '/administration/editUser',
                                type: 'POST',
                                dataType: 'json',
                                data: form.serialize(),
                                success: function (res) {
                                    var dbmil = $('.datatable-user-list').dataTable();
                                    if (res.status == 'Success') {
                                        dbmil.api().ajax.reload();
                                    }
                                }
                            });

                        }
                    }
                }
            }
        );*/

    $(".select")
      .parents(".bootbox")
      .removeAttr("tabindex");
    $(".select").select2();
    //$("#select").select2("val", company2);

    // Single picker
  });

  $(".active").on("click", function() {
    var status = "active",
      user_id = $(this).attr("user_id");
    $.ajax({
      url: JS_BASE_URL + "/administration/update_status/",
      type: "POST",
      dataType: "json",
      data: { status: status, user_id: user_id },
      async: false,
      success: function(res) {
        if (res.status == "success") {
          var datatable = $(".datatable-user-list").dataTable();
          datatable.api().ajax.reload();
        }
      }
    });
  });

  $(".inactive").on("click", function() {
    var status = "inactive",
      user_id = $(this).attr("user_id");
    $.ajax({
      url: JS_BASE_URL + "/administration/update_status/",
      type: "POST",
      dataType: "json",
      data: { status: status, user_id: user_id },
      async: false,
      success: function(res) {
        if (res.status == "success") {
          var datatable = $(".datatable-user-list").dataTable();
          datatable.api().ajax.reload();
        }
      }
    });
  });
};

// Dendy 01-01-2019
var CallbackPP = function() {
  $(".edit-parameter").on("click", function() {
    var ppId = $(this).attr("pp_id");
    var detail, groupName, uomName;
    $.ajax({
      url: JS_BASE_URL + "/toolManagement/getProgressParameterDetail/" + ppId,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          detail = res.data;
        }
      }
    });
    $.ajax({
      url: JS_BASE_URL + "/toolManagement/getMilestoneGroupPP/",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          groupName = res.data;
        }
      }
    });
    $.ajax({
      url: JS_BASE_URL + "/toolManagement/getMilestoneUOMPP/",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          uomName = res.data;
        }
      }
    });

    detail.parameter_name = detail.parameter_name ? detail.parameter_name : "";
    detail.measurement = detail.measurement ? detail.measurement : "";

    bootbox.dialog({
      title: "Edit Progress Parameter",
      message:
        '<div class="row"> ' +
        '<div class="col-md-12">' +
        '<form action="#" id = "edit_pp">' +
        '<input type="hidden" class="form-control" name = "parameter_id" value="' +
        detail.id +
        '">' +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Milestone Group</label> " +
        '<select id="ms_group_id" name="ms_group_id" data-placeholder="" class="select">' +
        groupName +
        "</select>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Parameter Name</label> " +
        '<input type="text" class="form-control" name = "parameter_name" value="' +
        detail.parameter_name +
        '">' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Measurement</label> " +
        '<select id="ms_uom" name="measurement" data-placeholder="" class="select">' +
        uomName +
        "</select>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</form>" +
        "</div>" +
        "</div>",
      buttons: {
        success: {
          label: "Update",
          className: "btn-success",
          callback: function() {
            var form = $("#edit_pp");
            $.ajax({
              url: JS_BASE_URL + "/toolManagement/updateProgressParameter/",
              type: "POST",
              dataType: "json",
              data: form.serialize(),
              success: function(res) {
                alertSuccess();
                var dbmil = $(".datatable-progress-parameter-list").dataTable();
                if (res.status == "Success") {
                  dbmil.api().ajax.reload();
                }
              }
            });
          }
        }
      }
    });
    $("#ms_group_id").select2({ data: Object.values(groupName) });
    $("#ms_uom").select2({ data: Object.values(uomName) });
    $("#ms_group_id")
      .val(detail.ms_group_id)
      .trigger("change");
    $("#ms_uom")
      .val(detail.measurement)
      .trigger("change");
  });
};

var CallbackResource = function() {
  $(".edit-resource").on("click", function() {
    var option = "";
    var that = this;
    var resourceId = $(this).attr("res_id");
    var name = "",
      email = "",
      userId = "",
      joinDate = "",
      title = "",
      workLocation = "";

    $.ajax({
      url: JS_BASE_URL + "/resource/detail/" + resourceId,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          name = res.data.fullname;
          email = res.data.email;
          userId = res.data.user_id;
          joinDate = res.data.join_date;
          title = res.data.title;
          workLocation = res.data.work_location;
        }
      }
    });
    var option = "";
    $.ajax({
      url: JS_BASE_URL + "/administration/activeUser/",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        //console.log(res);

        $.each(res.data, function(i, val) {
          var selected = "";
          if (userId == val.user_id) {
            selected += "selected";
          }
          option +=
            '<option value="' +
            val.user_id +
            "-" +
            val.email +
            "-" +
            val.fullname +
            '" ' +
            selected +
            ">" +
            val.email +
            "</option>";
        });
      }
    });

    bootbox.dialog({
      title: "Edit Resource",
      message:
        '<div class="row"> ' +
        '<div class="col-md-12">' +
        '<form action="#" id = "add_user_form">' +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Name</label> " +
        '<input type="hidden" id = "user_id" name = "user_id" class="form-control" value="' +
        userId +
        '"> ' +
        '<input type="text" id = "name" name = "name" class="form-control" disabled = "disabled" value = "' +
        name +
        '"> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>Join Date</label> " +
        '<input type="text" class="form-control daterange-single" name = "join_date" placeholder="Pick a date" value = "' +
        joinDate +
        '">' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>Title</label> " +
        '<input type="text" id = "title" name = "title" class="form-control" value = "' +
        title +
        '"> ' +
        "</div> " +
        "</div> " +
        "</div> " +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>Work Location</label> " +
        '<input type="text" id = "work_location" name = "work_location" class="form-control" value = "' +
        workLocation +
        '"> ' +
        /*'<select id="name" name="work_location" data-placeholder="Select a user" class="select">'+
                 '<option value="" dissabled>Select a user</option>'+
                 option +
                 '</select>' +*/
        "</div>" +
        "</div>" +
        "</div>" +
        "</form>" +
        "</div>" +
        "</div>",
      buttons: {
        success: {
          label: "Add User",
          className: "btn-success",
          callback: function() {
            var form = $("#add_user_form");
            $.ajax({
              url: JS_BASE_URL + "/resource/editResource/" + resourceId,
              type: "POST",
              dataType: "json",
              data: form.serialize(),
              success: function(res) {
                var db = $(".datatable-resource-list").dataTable();
                if (res.status == "Success") {
                  db.api().ajax.reload();
                }
              }
            });
          }
        }
      }
    });

    $(".select")
      .parents(".bootbox")
      .removeAttr("tabindex");
    $(".select").select2();
    $(".daterange-single").daterangepicker({
      singleDatePicker: true,
      locale: {
        format: "YYYY-MM-DD"
      }
    });

    $("#email").change(function() {
      res = $(this)
        .val()
        .split("-");
      $("#name").val(res[2]);
      $("#user_id").val(res[0]);
    });
  });
};

var CallbackTools = function() {
  $(".edit-tools").on("click", function() {
    var toolsId = $(this).attr("tools_id");
    console.log(toolsId);
    var detail;
    $.ajax({
      url: JS_BASE_URL + "/toolManagement/detail/" + toolsId,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          detail = res.data;
        }
      }
    });

    var selected_new = "",
      selected_rent = "";
    if (detail.new_rent == "new") {
      selected_new = "selected";
    } else {
      selected_rent = "selected";
    }
    bootbox.dialog({
      title: "Edit Tool Inventory",
      message:
        '<div class="row"> ' +
        '<div class="col-md-12">' +
        '<form action="#" id = "edit_tool_form">' +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Tools Description</label> " +
        '<input type="text" class="form-control" name = "description" value="' +
        detail.description +
        '">' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>ID Tools</label> " +
        '<input type="hidden" class="form-control" name = "id_tool" value="' +
        detail.id +
        '">' +
        '<input type="text" class="form-control" name = "tools_id" value="' +
        detail.tools_id +
        '">' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">' +
        '<li class="active"><a href="#a" data-toggle="tab" aria-expanded="true">PO/PR</a></li>' +
        ' <li class=""><a href="#b" data-toggle="tab" aria-expanded="false">Detail</a></li>' +
        ' <li class=""><a href="#c" data-toggle="tab" aria-expanded="false">Condition</a></li>' +
        ' <li class=""><a href="#d" data-toggle="tab" aria-expanded="false">Remarks</a></li>' +
        "</ul>" +
        '<div class="tab-content">' +
        '<div class="tab-pane fade active in" id="a">' +
        '<div class="form-group mt-10">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>PR Number</label> " +
        '<input type="text" class="form-control" name = "pr_number" value="' +
        detail.pr_number +
        '">' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>PO Number</label> " +
        '<input type="text" id = "po_number" name = "po_number" class="form-control" value="' +
        detail.po_number +
        '"> ' +
        "</div> " +
        "</div> " +
        "</div> " +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>PR Date</label> " +
        '<input type="text" id = "pr_date" name = "pr_date" class="form-control daterange-single" value=""> ' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>PO Date</label> " +
        '<input type="text" id = "po_date" name = "po_date" class="form-control daterange-single" value=""> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="tab-pane fade" id="b">' +
        '<div class="form-group mt-10">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>Brand</label> " +
        '<input type="text" id = "brand" name = "brand" class="form-control" value="' +
        detail.brand +
        '"> ' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>Type</label> " +
        '<input type="text" id = "type" name = "type" class="form-control" value="' +
        detail.type +
        '"> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>Serial Number</label> " +
        '<input type="text" id = "serial_number" name = "serial_number" class="form-control" value="' +
        detail.serial_number +
        '"> ' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>Waranty</label> " +
        '<input type="text" id = "waranty" name = "waranty" class="form-control" value="' +
        detail.warranty +
        '"> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="tab-pane fade" id="c">' +
        '<div class="form-group mt-10">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>Current Area/Position</label> " +
        '<input type="text" id = "current_area" name = "current_area" class="form-control" value="' +
        detail.position +
        '"> ' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>Condition</label> " +
        '<input type="text" id = "condition" name = "condition" class="form-control" value="' +
        detail.condition +
        '"> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>New/Rent</label> " +
        '<select id="new" name="new" data-placeholder="" class="select">' +
        '<option value="" dissabled>Select</option>' +
        '<option value="new" ' +
        selected_new +
        ">New</option>" +
        '<option value="rent" ' +
        selected_rent +
        ">Rent</option>" +
        "</select>" +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>Price</label> " +
        '<input type="text" id = "price" name = "price" class="form-control" value="' +
        detail.price +
        '"> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="tab-pane fade" id="d">' +
        '<div class="form-group mt-10">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Remarks</label> " +
        '<textarea rows="4" cols="5" name = "remarks" placeholder="Description..." class="form-control">' +
        detail.remarks +
        "</textarea>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</form>" +
        "</div>" +
        "</div>",
      buttons: {
        success: {
          label: "Update",
          className: "btn-success",
          callback: function() {
            var form = $("#edit_tool_form");
            $.ajax({
              url: JS_BASE_URL + "/toolManagement/update/",
              type: "POST",
              dataType: "json",
              data: form.serialize(),
              success: function(res) {
                alertSuccess();
                var dbmil = $(".datatable-tools-list").dataTable();
                if (res.status == "Success") {
                  dbmil.api().ajax.reload();
                }
              }
            });
          }
        }
      }
    });
    $(".select")
      .parents(".bootbox")
      .removeAttr("tabindex");
    $(".select").select2();
    if (detail.po_date != null) {
      $("#po_date").daterangepicker({
        singleDatePicker: true,
        startDate: moment(detail.po_date).format("DD-MM-YYYY"),
        locale: {
          format: "DD-MM-YYYY"
        }
      });
    } else {
      $("#po_date").daterangepicker(
        {
          singleDatePicker: true,
          locale: {
            format: "DD-MM-YYYY"
          },
          autoUpdateInput: false
        },
        function(startDate, label) {
          $("#po_date").val(startDate.format("DD-MM-YYYY"));
        }
      );
    }
    if (detail.pr_date != null) {
      $("#pr_date").daterangepicker({
        singleDatePicker: true,
        startDate: moment(detail.pr_date).format("DD-MM-YYYY"),
        locale: {
          format: "DD-MM-YYYY"
        }
      });
    } else {
      $("#pr_date").daterangepicker(
        {
          singleDatePicker: true,
          locale: {
            format: "DD-MM-YYYY"
          },
          autoUpdateInput: false
        },
        function(startDate, label) {
          $("#pr_date").val(startDate.format("DD-MM-YYYY"));
        }
      );
    }
  });

  $(".detail-tools").on("click", function() {
    var toolsId = $(this).attr("tools_id");
    console.log(toolsId);
    var detail;
    $.ajax({
      url: JS_BASE_URL + "/toolManagement/detail/" + toolsId,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          detail = res.data;
        }
      }
    });

    var selected_new = "",
      selected_rent = "";
    if (detail.new_rent == "new") {
      selected_new = "selected";
    } else {
      selected_rent = "selected";
    }
    bootbox.dialog({
      title: "Edit Tool Inventory",
      message:
        '<div class="row"> ' +
        '<div class="col-md-12">' +
        '<form action="#" id = "edit_tool_form">' +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Tools Description</label> " +
        '<input type="text" disabled = "disabled" class="form-control" name = "description" value="' +
        detail.description +
        '">' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>ID Tools</label> " +
        '<input type="hidden" class="form-control" name = "id_tool" value="' +
        detail.id +
        '">' +
        '<input type="text" disabled = "disabled" class="form-control" name = "tools_id" value="' +
        detail.tools_id +
        '">' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">' +
        '<li class="active"><a href="#a" data-toggle="tab" aria-expanded="true">PO/PR</a></li>' +
        ' <li class=""><a href="#b" data-toggle="tab" aria-expanded="false">Detail</a></li>' +
        ' <li class=""><a href="#c" data-toggle="tab" aria-expanded="false">Condition</a></li>' +
        ' <li class=""><a href="#d" data-toggle="tab" aria-expanded="false">Remarks</a></li>' +
        "</ul>" +
        '<div class="tab-content">' +
        '<div class="tab-pane fade active in" id="a">' +
        '<div class="form-group mt-10">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>PR Number</label> " +
        '<input type="text" class="form-control" disabled = "disabled" name = "pr_number" value="' +
        detail.pr_number +
        '">' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>PO Number</label> " +
        '<input type="text" id = "po_number" disabled = "disabled" name = "po_number" class="form-control" value="' +
        detail.po_number +
        '"> ' +
        "</div> " +
        "</div> " +
        "</div> " +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>PR Date</label> " +
        '<input type="text" id = "pr_date" disabled = "disabled" name = "pr_date" class="form-control daterange-single" value=""> ' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>PO Date</label> " +
        '<input type="text" id = "po_date" disabled = "disabled" name = "po_date" class="form-control daterange-single" value=""> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="tab-pane fade" id="b">' +
        '<div class="form-group mt-10">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>Brand</label> " +
        '<input type="text" id = "brand" name = "brand" disabled = "disabled" class="form-control" value="' +
        detail.brand +
        '"> ' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>Type</label> " +
        '<input type="text" id = "type" name = "type" disabled = "disabled" class="form-control" value="' +
        detail.type +
        '"> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>Serial Number</label> " +
        '<input type="text" id = "serial_number" disabled = "disabled" name = "serial_number" class="form-control" value="' +
        detail.serial_number +
        '"> ' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>Waranty</label> " +
        '<input type="text" id = "waranty" disabled = "disabled" name = "waranty" class="form-control" value="' +
        detail.warranty +
        '"> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="tab-pane fade" id="c">' +
        '<div class="form-group mt-10">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>Current Area/Position</label> " +
        '<input type="text" id = "current_area" disabled = "disabled" name = "current_area" class="form-control" value="' +
        detail.position +
        '"> ' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>Condition</label> " +
        '<input type="text" id = "condition" disabled = "disabled" name = "condition" class="form-control" value="' +
        detail.condition +
        '"> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>New/Rent</label> " +
        '<select disabled = "disabled" id="new" name="new" data-placeholder="" class="select">' +
        '<option value="" dissabled>Select</option>' +
        '<option value="new" ' +
        selected_new +
        ">New</option>" +
        '<option value="rent" ' +
        selected_rent +
        ">Rent</option>" +
        "</select>" +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>Price</label> " +
        '<input type="text" id = "price" disabled = "disabled" name = "price" class="form-control" value="' +
        detail.price +
        '"> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="tab-pane fade" id="d">' +
        '<div class="form-group mt-10">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Remarks</label> " +
        '<textarea rows="4" cols="5" disabled = "disabled" name = "remarks" placeholder="Description..." class="form-control">' +
        detail.remarks +
        "</textarea>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</form>" +
        "</div>" +
        "</div>"
    });
    $(".select")
      .parents(".bootbox")
      .removeAttr("tabindex");
    $(".select").select2();
    if (detail.po_date != null) {
      $("#po_date").daterangepicker({
        singleDatePicker: true,
        startDate: moment(detail.po_date).format("DD-MM-YYYY"),
        locale: {
          format: "DD-MM-YYYY"
        }
      });
    } else {
      $("#po_date").daterangepicker(
        {
          singleDatePicker: true,
          locale: {
            format: "DD-MM-YYYY"
          },
          autoUpdateInput: false
        },
        function(startDate, label) {
          $("#po_date").val(startDate.format("DD-MM-YYYY"));
        }
      );
    }
    if (detail.pr_date != null) {
      $("#pr_date").daterangepicker({
        singleDatePicker: true,
        startDate: moment(detail.pr_date).format("DD-MM-YYYY"),
        locale: {
          format: "DD-MM-YYYY"
        }
      });
    } else {
      $("#pr_date").daterangepicker(
        {
          singleDatePicker: true,
          locale: {
            format: "DD-MM-YYYY"
          },
          autoUpdateInput: false
        },
        function(startDate, label) {
          $("#pr_date").val(startDate.format("DD-MM-YYYY"));
        }
      );
    }
  });

  $(".delete-tools").on("click", function() {
    var toolsId = $(this).attr("tools_id");
    // Setup
    var notice = new PNotify({
      title: "Confirmation",
      text: "<p>Are you sure you want delete this tool?</p>",
      hide: false,
      type: "info",
      confirm: {
        confirm: true,
        buttons: [
          {
            text: "Yes",
            addClass: "btn btn-sm btn-primary"
          },
          {
            addClass: "btn btn-sm btn-link"
          }
        ]
      },
      buttons: {
        closer: false,
        sticker: false
      },
      history: {
        history: false
      }
    });

    // On confirm
    notice.get().on("pnotify.confirm", function() {
      $.ajax({
        url: JS_BASE_URL + "/toolManagement/delete/",
        type: "POST",
        dataType: "json",
        data: { id: toolsId },
        success: function(res) {
          alertSuccess();
          var dbmil = $(".datatable-tools-list").dataTable();
          if (res.status == "Success") {
            dbmil.api().ajax.reload();
          }
        }
      });
    });

    // On cancel
    notice.get().on("pnotify.cancel", function() {
      // alert('Oh ok. Chicken, I see.');
    });
  });
};

var CallbackIssueRisk = function() {
  $(".edit-issue-risk").on("click", function() {
    var issueRisk = $(this).attr("issue_risk");
    var detail;
    $.ajax({
      url: JS_BASE_URL + "/issueRisk/detail/" + issueRisk,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          detail = res.data;
        }
      }
    });

    console.log(detail);

    $(".modal-title").text("Edit Issue/Risk");

    $("#modal_add_risk").modal("show");
    $("#issue_id").val(detail.id);
    $("#no_issue").val(detail.issue_no);
    $("#input_date").val(detail.created_date);
    // $("#raised_by").val(detail.);
    $("#issue_risk").val(detail.issue_risk);
    $("#category").val(detail.type_of_issue_risk);
    $("#project_id").val(detail.projects_id);
    $("#project_scope").val(detail.project_scope);
    $("#project_manager").val(detail.pm_id);
    $("#pic").val(detail.pic_id);
    $("#potential_impact").val(detail.potential_impact);
    $("#issue_only").val(detail.issue_or_risk);
    $("#status").val(detail.status);
    $("#raised_date").val(detail.raised_date);
    // $("#raised_by").val(detail.);
    $("#issue_only").val(detail.issue_only);
    $("#risk_only_probability").val(detail.risk_only_probability);
    $("#risk_only_impact").val(detail.risk_only_impact);
    $("#risk_only_significance").val(detail.risk_only_significance);
    $("#current_response").val(detail.current_response);
    $("#current_response_date").val(detail.current_response_date);
    $("#further_action").val(detail.further_action);
    $("#further_action_date").val(detail.further_action_date);
    $("#file_attc").html(detail.file_attachment);
    $("#file_attc").removeClass("hidden");
    $("#status option[value=closed]").removeAttr("disabled");

    if ($("#issue_or_risk").val() === "risk") {
      $(".risk").show();
      $(".issue").hide();
    } else {
      $(".risk").hide();
      $(".issue").show();
    }
    $("#issue_or_risk").change(function() {
      if ($(this).val() === "risk") {
        $(".risk").fadeIn(300);
        $(".issue").fadeOut(300);
      } else {
        $(".risk").fadeOut(300);
        $(".issue").fadeIn(300);
      }
    });
    $(".select")
      .parents(".bootbox")
      .removeAttr("tabindex");
    $(".select").select2();

    if (detail.further_action_date != null) {
      $("#further_action_date").daterangepicker({
        singleDatePicker: true,
        startDate: moment(detail.further_action_date).format("DD-MM-YYYY"),
        locale: {
          format: "DD-MM-YYYY"
        }
      });
    } else {
      $("#further_action_date").daterangepicker(
        {
          singleDatePicker: true,
          locale: {
            format: "DD-MM-YYYY"
          },
          autoUpdateInput: false
        },
        function(startDate, label) {
          $("#further_action_date").val(startDate.format("DD-MM-YYYY"));
        }
      );
    }
    if (detail.current_response_date != null) {
      $("#current_response_date").daterangepicker({
        singleDatePicker: true,
        startDate: moment(detail.current_response_date).format("DD-MM-YYYY"),
        locale: {
          format: "DD-MM-YYYY"
        }
      });
    } else {
      $("#current_response_date").daterangepicker(
        {
          singleDatePicker: true,
          locale: {
            format: "DD-MM-YYYY"
          },
          autoUpdateInput: false
        },
        function(startDate, label) {
          $("#current_response_date").val(startDate.format("DD-MM-YYYY"));
        }
      );
    }
  });

  $(".detail-issue-risk").on("click", function() {
    $("#view_risk").modal("show");

    var issueRisk = $(this).attr("issue_risk");
    var detail;
    $.ajax({
      url: JS_BASE_URL + "/issueRisk/detail/" + issueRisk,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          detail = res.data;
        }
      }
    });
    var js_base = JS_BASE_URL.replace("index.php", "");
    if (detail.file_attachment == null) {
      var link = "No Attachment";
    } else {
      var link =
        '<a target = "_blank" href="' +
        js_base +
        "/assets/file/issue_risk/" +
        detail.file_attachment +
        '" class = "detail-issue-risk">Download File</a>';
    }
    $("#issue_id2").val(detail.id);
    $("#no_issue2").val(detail.issue_no);
    // $("#input_date2").val(detail.created_date);
    // $("#input_date2").val(moment(detail.created_date).format('MM/DD/YYYY'));
    $("#input_date2").val(detail.created_date);

    // $("#raised_by").val(detail.);
    $("#issue_risk2").val(detail.issue_risk);
    $("#category2").val(detail.type_of_issue_risk);
    $("#project_id2").val(detail.project_name);
    $("#project_scope2").val(detail.project_scope);
    $("#category2").val(detail.type_of_issue_risk);
    $("#project_manager2").val(detail.pm_name);
    $("#pic2").val(detail.pic_name);
    $("#potential_impact2").html(detail.potential_impact);
    // $("#target_to_close2").val(detail.target_to_close);
    $("#target_to_close2").val(
      moment(detail.target_to_close).format("DD-MM-YYYY")
    );
    $("#issue_only2").val(detail.issue_or_risk);
    $("#status2").val(detail.status);
    $("#raised_date2").val(detail.raised_date);
    $("#raised_by2").val(detail.raised_by);
    $("#issue_only2").val(detail.issue_only);
    $("#risk_only_probability2").val(detail.risk_only_probability);
    $("#risk_only_impact2").val(detail.risk_only_impact);
    $("#risk_only_significance2").val(detail.risk_only_significance);
    $("#current_response2").val(detail.current_response);
    $("#current_response_date2").val(detail.current_response_date);
    $("#further_action2").val(detail.further_action);
    $("#further_action_date2").val(detail.further_action_date);
    $("#file_attc2").html(link);
    $("#status option[value=closed]").removeAttr("disabled");

    $.ajax({
      url: JS_BASE_URL + "/issueRisk/actions/",
      type: "POST",
      data: { issue_id: issueRisk },
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          followUp = res.data;
          $(".prepend").remove();
          var count = 0;
          if (followUp !== undefined) {
            $.each(res.data, function(i, val) {
              var js_base = JS_BASE_URL.replace("index.php", "");
              console.log(val.date);
              if (val.date == "") {
                val.date = "-";
              } else {
                val.date = moment(val.date).format("DD-MM-YYYY");
              }
              if (val.file == null) {
                row += '<tr class = "prepend">';
                row +=
                  "<td><span>" +
                  val.type +
                  "</span></td><td><span>" +
                  val.date +
                  "</span></td><td><span>" +
                  val.desc +
                  '</span></td><td><span title = "No Attachment"><i class ="icon-file-download"></i></span></td>';
                row += "</tr>";
              } else {
                row += '<tr class = "prepend">';
                row +=
                  "<td><span>" +
                  val.type +
                  "</span></td><td><span>" +
                  val.date +
                  "</span></td><td><span>" +
                  val.desc +
                  '</span></td><td><a target = "_blank" href="' +
                  js_base +
                  "/assets/file/issue_risk/" +
                  val.file +
                  '" class = "detail-issue-risk"><i class ="icon-file-download"></i></a>';
                row += "</tr>";
              }
              count++;
            });
            $("#issueDetail tbody").append(row);
            $(".daterange-single").daterangepicker({
              singleDatePicker: true,
              locale: {
                format: "YYYY-MM-DD"
              }
            });
          }
        } else {
          $(".prepend").remove();
          var row = '<tr class = "prepend"><td>No Follow Up</td></tr>';
          console.log(row);
          $("#issueDetail tbody").append(row);
        }
      }
    });

    /*bootbox.dialog({
            title: "Detail Issue/Risk",
            message: '<div class="row"> ' +
            '<div class="col-md-12">' +
            '<form action="#" id = "add_risk_form">' +
            '<div class="form-group">' +
            '<div class="row">'+
            '<div class="col-sm-12">' +
            '<label>Project</label> '+
            '<input type="hidden" class="form-control" name = "issue_id" value="'+detail.id+'">'+
            '<select id="project_id" disabled = "disabled" name="project_id" data-placeholder="" class="select">'+
            list_project +
            '</select>' +
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">' +
            '<div class="row">'+
            '<div class="col-sm-12">' +
            '<label>Issue/Risk</label> '+
            '<input type="text" class="form-control" name = "issue_risk" id = "issue_risk" disabled = "disabled" value="'+detail.issue_risk+'">'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="form-group mt-10">' +
            '<div class="row">'+
            '<div class="col-sm-6">' +
            '<label>Type of Risk/Issue</label> '+
            '<input type="text" class="form-control" disabled = "disabled" name = "type_of_issue_risk" value="'+detail.type_of_issue_risk+'">'+
            '<span class="help-block">Permit, Material, Financial, Document, etc.</span>' +
            '</div>'+
            '<div class="col-sm-6">' +
            '<label>Status</label> '+
            '<select id="status" disabled = "disabled" name="status" data-placeholder="" class="select">'+
            '<option value="open" '+selected_open+'>Open</option>'+
            '<option value="closed" '+selected_closed+'>Closed</option>'+
            '</select>' +
            '</div> '+
            '</div> '+
            '</div> '+
            '<ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">' +
            '<li class="active"><a href="#a" data-toggle="tab" aria-expanded="true">Detail</a></li>' +
            ' <li class="risk"><a href="#b" data-toggle="tab" aria-expanded="false">Risk</a></li>' +
            ' <li class=""><a href="#c" data-toggle="tab" aria-expanded="false">Response</a></li>' +
            '</ul>' +
            '<div class="tab-content">' +
            '<div class="tab-pane fade active in" id="a">' +
            '<div class="form-group mt-10">' +
            '<div class="row">'+
            '<div class="col-sm-6">' +
            '<label>Raised Date</label> '+
            '<input type="text" disabled = "disabled" id = "raised_date" name = "raised_date" class="form-control daterange-single" value="'+detail.raised_date+'"> '+
            '</div>'+
            '<div class="col-sm-6">' +
            '<label>Issue or Risk</label> '+
            '<select id="issue_or_risk" disabled = "disabled" name="issue_or_risk" data-placeholder="" class="select">'+
            '<option value="issue" '+selected_issue+'>Issue</option>'+
            '<option value="risk" '+selected_risk+'>Risk</option>'+
            '</select>' +
            '</div> '+
            '</div> '+
            '</div> '+
            '<div class="form-group">' +
            '<div class="row">'+
            '<div class="col-sm-6">' +
            '<label>Potential Impact</label> '+
            '<input type="text" disabled = "disabled" id = "potential_impact" name = "potential_impact" class="form-control" value="'+detail.potential_impact+'">'+
            '</div>'+
            '<div class="col-sm-6 issue">' +
            '<label>Issue Only</label> '+
            '<select id="issue_only" disabled = "disabled" name="issue_only" data-placeholder="" class="select">'+
            '<option value="Not Significant" '+not_sign+'>Not Significant</option>'+
            '<option value="Significant" '+sign+'>Significant</option>'+
            '<option value="Very Significant" '+very_sign+'>Very Significant</option>'+
            '</select>' +
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="tab-pane fade" id="b">' +
            '<div class="form-group mt-10">' +
            '<div class="row">'+
            '<div class="col-sm-6">' +
            '<label>Probability</label> '+
            '<input type="text" disabled = "disabled" id = "risk_only_probability" name = "risk_only_probability" class="form-control" value="'+detail.risk_only_probability+'"> '+
            '</div>'+
            '<div class="col-sm-6">' +
            '<label>Impact</label> '+
            '<input type="text" disabled = "disabled" id = "risk_only_impact" name = "risk_only_impact" class="form-control" value="'+detail.risk_only_impact+'"> '+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">' +
            '<div class="row">'+
            '<div class="col-sm-12">' +
            '<label>Significance</label> '+
            '<input type="text" disabled = "disabled" id = "risk_only_significance" name = "risk_only_significance" class="form-control" value="'+detail.risk_only_significance+'"> '+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="tab-pane fade" id="c">' +
            '<div class="form-group mt-10">' +
            '<div class="row">'+
            '<div class="col-sm-6">' +
            '<label>Current Response</label> '+
            '<input type="text" disabled = "disabled" id = "current_response" name = "current_response" class="form-control" value="'+detail.current_response+'"> '+
            '</div>'+
            '<div class="col-sm-6">' +
            '<label>Current Response Date</label> '+
            '<input type="text" disabled = "disabled" id = "current_response_date" name = "current_response_date" class="form-control daterange-single"> '+
            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">' +
            '<div class="row">'+
            '<div class="col-sm-6">' +
            '<label>Further Action</label> '+
            '<input type="text" disabled = "disabled" id = "further_action" name = "further_action" class="form-control" value="'+detail.further_action+'">'+
            '</div>'+
            '<div class="col-sm-6">' +
            '<label>Further Action Date</label> '+
            '<input type="text" disabled = "disabled" id = "further_action_date" name = "further_action_date" class="form-control daterange-single"> '+
            '</div>'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</form>' +
            '</div>' +
            '</div>'
        });*/

    if (detail.issue_or_risk === "risk") {
      $(".risk").show();
      $(".issue").hide();
    } else {
      $(".risk").hide();
      $(".issue").show();
    }
    /*$( "#issue_or_risk" ).change(function() {
            if($(this).val() === 'risk'){
                $('.risk').fadeIn(300);
                $('.issue').fadeOut(300);
            } else {
                $('.risk').fadeOut(300);
                $('.issue').fadeIn(300);
            }
        });
        $('.select').parents('.bootbox').removeAttr('tabindex');
        $('.select').select2();

        $('.daterange-single').daterangepicker({
            singleDatePicker: true,
            locale: {
                format: 'YYYY-MM-DD'
            },
        });*/
  });

  $(".delete-issue-risk").on("click", function() {
    var issueRisk = $(this).attr("issue_risk");
    // Setup
    var notice = new PNotify({
      title: "Confirmation",
      text: "<p>Are you sure you want delete this issue/risk?</p>",
      hide: false,
      type: "info",
      confirm: {
        confirm: true,
        buttons: [
          {
            text: "Yes",
            addClass: "btn btn-sm btn-primary"
          },
          {
            addClass: "btn btn-sm btn-link"
          }
        ]
      },
      buttons: {
        closer: false,
        sticker: false
      },
      history: {
        history: false
      }
    });

    // On confirm
    notice.get().on("pnotify.confirm", function() {
      $.ajax({
        url: JS_BASE_URL + "/issueRisk/delete/",
        type: "POST",
        dataType: "json",
        data: { id: issueRisk },
        success: function(res) {
          var dbmil = $(".datatable-issue-risk-list").dataTable();
          if (res.status == "Success") {
            alertSuccess();
            dbmil.api().ajax.reload();
          }
        }
      });
    });

    // On cancel
    notice.get().on("pnotify.cancel", function() {
      // alert('Oh ok. Chicken, I see.');
    });
  });

  $(".issue_follow_up").on("click", function() {
    $("#deleted_follow_up").val("");
    $("#closing").hide();
    $("#finalClose").hide();
    $("#idx").val("");
    var issueRisk = $(this).attr("issue_risk");
    var detail;
    var followUp;
    $.ajax({
      url: JS_BASE_URL + "/issueRisk/detail/" + issueRisk,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          detail = res.data;
          $("#issue_risk_desc").html(detail.issue_risk);
          $("#issue_dates").html(detail.raised_date);
          $("#name_project").html(detail.project_name);
        }
      }
    });
    $("#modal_follow_up").modal("show");
    $("#for_issue").val(detail.id);
    var row = "";
    $.ajax({
      url: JS_BASE_URL + "/issueRisk/followUp/" + issueRisk,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          followUp = res.data;
          $("#closing_state").remove();
          $(".prepend").remove();
          var count = 0;
          if (followUp !== undefined) {
            $.each(res.data, function(i, val) {
              var js_base = JS_BASE_URL.replace("index.php", "");
              row += '<tr class = "prepend">';
              row +=
                '<td><input type="text" disabled = "disabled" value = "' +
                val.follow_up_date +
                '" class="form-control daterange-single"></td><td><textarea disabled = "disabled" type="text" class="form-control">' +
                val.follow_up_description +
                ' </textarea></td><td><a target = "_blank" href="' +
                js_base +
                "/assets/file/issue_risk/" +
                val.file_attachment +
                '" class = "detail-issue-risk">Download File</a><td><a href="#" class ="dismiss" follow_up = "' +
                val.id +
                '"><i class ="icon-trash"></i></span></td></td>';
              row += "</td></tr>";
              count++;
            });
            row +=
              '<tr class = "prepend"><td><input type="text" name = "follow_up[' +
              count +
              '][date]" class="form-control daterange-single"></td><td><textarea type="text" name = "follow_up[' +
              count +
              '][description]" class="form-control"></textarea></td><td><input type="file" name = "attachment' +
              count +
              '" class="form-control"> </td><td></tr>';
            $("#idx").val(count);
            $("#closing").show();
            $("#closing").on("click", function() {
              $("#closing_state").remove();

              $("#finalClose").show();

              var closeddd =
                '<div id = "closing_state"><br><br><div class="form-group"><div class="row"><div class="col-sm-2"><span>Closed Date</span><input type="text" id = "closing_date" name = "closing_date" class="form-control daterange-single"></div><div class="col-sm-6"><span>Closing Description</span><textarea rows="4" cols="5" name = "closing_desc" placeholder="Description..." class="form-control"></textarea></div><div class="col-sm-3"><span>Attachment</span><input type="file" name="closing_attc" class="form-control"><input type = "hidden" id = "tobe_closed"></div></div></div>';

              $("#close_date1").append(closeddd);

              $(".daterange-single").daterangepicker({
                singleDatePicker: true,
                locale: {
                  format: "DD-MM-YYYY"
                }
              });
            });

            $("#finalClose").on("click", function() {
              // alert('test');
              var notice = new PNotify({
                title: "Confirmation",
                text: "<p>Are you sure you want to close?</p>",
                hide: false,
                type: "warning",
                confirm: {
                  confirm: true,
                  buttons: [
                    {
                      text: "Yes",
                      addClass: "btn btn-sm btn-primary"
                    },
                    {
                      addClass: "btn btn-sm btn-link"
                    }
                  ]
                },
                buttons: {
                  closer: false,
                  sticker: false
                },
                history: {
                  history: false
                }
              });

              // On confirm
              notice.get().on("pnotify.confirm", function() {
                $("#follow_up_form").submit();
              });

              // On cancel
              notice.get().on("pnotify.cancel", function() {});
            });
            $("#follow_up tbody").append(row);

            $(".daterange-single").daterangepicker({
              singleDatePicker: true,
              locale: {
                format: "DD-MM-YYYY"
              }
            });
          }
        } else {
          $(".closing_sate").remove();
          $(".prepend").remove();
          $("#closing").hide();
          $("#finalClose").hide();
          // <textarea rows="4" cols="5" id="issue_risk" name="issue_risk" placeholder="Description..." class="form-control" required="required" aria-required="true"></textarea>
          var row =
            '<tr class = "prepend"><td><input type="text" name = "follow_up[0][date]" class="form-control daterange-single"></td><td><textarea rows="2" name = "follow_up[0][description]" class="form-control"></textarea></td><td><input type="file" name = "attachment0" class="form-control"> </td><td></tr>';
          $("#idx").val(0);
          $("#follow_up tbody").append(row);
          $(".daterange-single").daterangepicker({
            singleDatePicker: true,
            locale: {
              format: "DD-MM-YYYY"
            }
          });
        }
      }
    });
  });

  $(".issue_close").on("click", function() {
    $("#xd").remove();
    var issueRisk = $(this).attr("issue_risk");
    var detail;
    var followUp;
    $(".daterange-single").daterangepicker({
      singleDatePicker: true,
      locale: {
        format: "YYYY-MM-DD"
      }
    });

    $.ajax({
      url: JS_BASE_URL + "/issueRisk/detail/" + issueRisk,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          detail = res.data;
          $("#issue_risk_desc2").html(detail.issue_risk);
          $("#issue_dates2").html(detail.raised_date);
        }
      }
    });
    var row = "";
    $.ajax({
      url: JS_BASE_URL + "/issueRisk/followUp/" + issueRisk,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          followUp = res.data;
          $(".prepend").remove();
          var count = 0;
          if (followUp !== undefined) {
            $.each(res.data, function(i, val) {
              var js_base = JS_BASE_URL.replace("index.php", "");
              row += '<tr class = "prepend">';
              row +=
                "<td><span>" +
                val.follow_up_date +
                "</span></td><td><span>" +
                val.follow_up_description +
                '</span></td><td><a target = "_blank" href="' +
                js_base +
                "/assets/file/issue_risk/" +
                val.file_attachment +
                '" class = "detail-issue-risk">Download File</a>';
              row += "</tr>";
              count++;
            });
            $("#follow_up2 tbody").append(row);
            $(".daterange-single").daterangepicker({
              singleDatePicker: true,
              locale: {
                format: "YYYY-MM-DD"
              }
            });
          }
        } else {
          $(".prepend").remove();
          var row = '<tr class = "prepend"><td>No Follow Up</td></tr>';
          $("#follow_up tbody").append(row);
          $(".daterange-single").daterangepicker({
            singleDatePicker: true,
            locale: {
              format: "YYYY-MM-DD"
            }
          });
        }
      }
    });
    var a =
      '<div id = "xd"><legend class="text-semibold"></i>Closing</legend><div class="form-group"><div class="row"><div class="col-sm-2"><span>Closed Date</span><input type="text" id = "closing_date" name = "closing_date" class="form-control daterange-single"  required = "required"></div><div class="col-sm-6"><span>Closing Description</span><textarea rows="4" cols="5" name = "closing_desc" placeholder="Description..." class="form-control"  required = "required"></textarea></div><div class="col-sm-3"><span>Attachment</span><input type="file" name="closing_attc" class="form-control" required = "required"></div></div></div></div>';
    $(".closing_issue").append(a);

    $("#issue_close").modal("show");
    $(".daterange-single").daterangepicker({
      singleDatePicker: true,
      locale: {
        format: "DD-MM-YYYY"
      }
    });
    $("#tobe_closed").val(detail.id);

    $("#finalClose2").on("click", function() {
      // alert('test');
      var notice = new PNotify({
        title: "Confirmation",
        text: "<p>Are you sure you want to close?</p>",
        hide: false,
        type: "warning",
        confirm: {
          confirm: true,
          buttons: [
            {
              text: "Yes",
              addClass: "btn btn-sm btn-primary"
            },
            {
              addClass: "btn btn-sm btn-link"
            }
          ]
        },
        buttons: {
          closer: false,
          sticker: false
        },
        history: {
          history: false
        }
      });

      // On confirm
      notice.get().on("pnotify.confirm", function() {
        $("#close_form").submit();
      });

      // On cancel
      notice.get().on("pnotify.cancel", function() {});
    });
  });

  $(".issue_attachment").on("click", function() {
    var issueRisk = $(this).attr("issue_risk");
    var detail;
    var followUp;
    $(".daterange-single").daterangepicker({
      singleDatePicker: true,
      locale: {
        format: "YYYY-MM-DD"
      }
    });

    $.ajax({
      url: JS_BASE_URL + "/issueRisk/detail/" + issueRisk,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          detail = res.data;
          $("#issue_risk_desc3").html(detail.issue_risk);
          $("#issue_dates3").html(detail.raised_date);
        }
      }
    });
    var row = "";
    $.ajax({
      url: JS_BASE_URL + "/issueRisk/attachment/",
      type: "POST",
      data: { issue_id: issueRisk },
      dataType: "json",
      async: false,
      success: function(res) {
        $(".prepend").remove();
        // if()
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            var js_base = JS_BASE_URL.replace("index.php", "");
            row += '<tr class = "prepend">';
            row +=
              "<td><span>" +
              val.date +
              '</span></td><td><a target = "_blank" href="' +
              js_base +
              "/assets/file/issue_risk/" +
              val.file_attachment +
              '" class = "detail-issue-risk">Download File</a><td><span>' +
              val.type +
              "</span></td>";
            row += "</tr>";
          });
          $("#allAttachment tbody").append(row);
        } else {
          $(".prepend").remove();
          var row = '<tr class = "prepend"><td>No Attachment</td></tr>';
          $("#allAttachment tbody").append(row);
        }
        /*if (res.status == 'Success') {
                    followUp = res.data;
                    $('.prepend').remove();
                    var count =0;
                    if(followUp !== undefined){
                        $.each(res.data, function (i, val) {
                            var js_base = JS_BASE_URL.replace('index.php', '');
                            row +='<tr class = "prepend">';
                            row += '<td><span>'+val.follow_up_date+'</span></td><td><a target = "_blank" href="'+js_base+'/assets/file/issue_risk/'+val.file_attachment+'" class = "detail-issue-risk">Download File</a><td><span>'+val.type+'</span></td>';
                            row +='</tr>';
                            count++;
                        });
                        $("#allAttachment tbody").append(row);
                    } 
                } else {
                    $('.prepend').remove();
                    var row = '<tr class = "prepend"><td>No Follow Up</td></tr>';
                    $("#follow_up tbody").append(row);
                    $('.daterange-single').daterangepicker({
                        singleDatePicker: true,
                        locale: {
                            format: 'YYYY-MM-DD'
                        },
                    });
                }*/
      }
    });

    $("#attachment_modal").modal("show");
    $(".daterange-single").daterangepicker({
      singleDatePicker: true,
      locale: {
        format: "DD-MM-YYYY"
      }
    });
  });
};

var CallbackTransmittal = function() {
  $(".edit-trans").on("click", function() {
    var transId = $(this).attr("trans_id");
    var detail;
    $.ajax({
      url: JS_BASE_URL + "/toolManagement/detailTransmit/" + transId,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          detail = res.data;
        }
      }
    });
    var list_project;
    $.ajax({
      url: JS_BASE_URL + "/planning/getProjects",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            var slctd = "";
            if (detail.project_id == val.id) {
              slctd += "selected";
            }
            list_project +=
              '<option value="' +
              val.id +
              '" ' +
              slctd +
              ">" +
              val.project_name +
              "</option>";
          });
        }
      }
    });

    var resource;
    var resource2 = '<option value="">Select PIC</option>';
    $.ajax({
      url: JS_BASE_URL + "/resource/all_resource",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            var slctd = "",
              slctd2 = "";
            if (detail.pic_borrowers == val.id) {
              slctd += "selected";
            }
            if (detail.pic_returning == val.id) {
              slctd2 += "selected";
            }
            resource +=
              '<option value="' +
              val.id +
              '" ' +
              slctd +
              ">" +
              val.fullname +
              "</option>";
            resource2 +=
              '<option value="' +
              val.id +
              '" ' +
              slctd2 +
              ">" +
              val.fullname +
              "</option>";
          });
        }
      }
    });

    var tools;
    $.ajax({
      url: JS_BASE_URL + "/toolManagement/all_tools",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            var slctd = "";
            if (detail.tools_id == val.id) {
              slctd += "selected";
            }
            tools +=
              '<option value="' +
              val.id +
              '" ' +
              slctd +
              ">" +
              val.tools_name +
              "</option>";
          });
        }
      }
    });

    bootbox.dialog({
      title: "Edit",
      message:
        '<div class="row"> ' +
        '<div class="col-md-12">' +
        '<form action="#" id = "add_user_form">' +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Tool</label> " +
        '<input type="hidden" name = "trans_id" value = "' +
        detail.id +
        '">' +
        '<select id="tools_id" name="tools_id" data-placeholder="" class="select">' +
        tools +
        "</select>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Serial Number</label> " +
        '<input type="text" class="form-control" name = "serial_number" id = "serial_number" value = "' +
        detail.serial_number +
        '">' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">' +
        '<li class="active"><a href="#a" data-toggle="tab" aria-expanded="true">Borrowing</a></li>' +
        ' <li class=""><a href="#b" data-toggle="tab" aria-expanded="false">Returning</a></li>' +
        ' <li class=""><a href="#c" data-toggle="tab" aria-expanded="false">Remarks</a></li>' +
        "</ul>" +
        '<div class="tab-content">' +
        '<div class="tab-pane fade active in" id="a">' +
        '<div class="form-group mt-10">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>Date of Borrowing</label> " +
        '<input type="text" id = "date_of_borrowing" name = "date_of_borrowing" class="form-control daterange-single" value = "' +
        detail.date_of_borrowing +
        '"> ' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>for Project/Area</label> " +
        '<select id="project_id" name="project_id" data-placeholder="" class="select">' +
        list_project +
        "</select>" +
        "</div> " +
        "</div> " +
        "</div> " +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>PIC</label> " +
        '<select id="pic_borrowers" name="pic_borrowers" data-placeholder="" class="select">' +
        resource +
        "</select>" +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>Condition</label> " +
        '<input type="text" id = "conditions_of_borrowing" name = "conditions_of_borrowing" class="form-control" value = "' +
        detail.conditions_of_borrowing +
        '"> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="tab-pane fade" id="b">' +
        '<div class="form-group mt-10">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>Date of Returning</label> " +
        '<input type="text" id = "date_of_returning" name = "date_of_returning" class="form-control daterange-single"> ' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>PIC</label> " +
        '<select id="pic_returning" name="pic_returning" data-placeholder="" class="select">' +
        resource2 +
        "</select>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Condition</label> " +
        '<input type="text" id = "conditions_of_returning" name = "conditions_of_returning" class="form-control" value = "' +
        detail.conditions_of_returning +
        '"> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="tab-pane fade" id="c">' +
        '<div class="form-group mt-10">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Remarks</label> " +
        '<textarea rows="4" cols="5" name = "remarks" placeholder="Description..." class="form-control">' +
        detail.remark_borrowing +
        "</textarea>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</form>" +
        "</div>" +
        "</div>",
      buttons: {
        success: {
          label: "Update",
          className: "btn-success",
          callback: function() {
            var form = $("#add_user_form");
            $.ajax({
              url: JS_BASE_URL + "/toolManagement/updateTransmit/",
              type: "POST",
              dataType: "json",
              data: form.serialize(),
              success: function(res) {
                var dbmil = $(".datatable-transmittal-daily-list").dataTable();
                if (res.status == "Success") {
                  alertSuccess();
                  dbmil.api().ajax.reload();
                }
              }
            });
          }
        }
      }
    });

    $(".select")
      .parents(".bootbox")
      .removeAttr("tabindex");
    $(".select").select2();

    $("#date_of_borrowing").daterangepicker(
      {
        singleDatePicker: true,
        locale: {
          format: "YYYY-MM-DD"
        },
        autoUpdateInput: false
      },
      function(startDate, label) {
        $("#date_of_borrowing").val(startDate.format("DD-MM-YYYY"));
      }
    );
    if (detail.date_of_returning == null) {
      $("#date_of_returning").daterangepicker(
        {
          singleDatePicker: true,
          locale: {
            format: "YYYY-MM-DD"
          },
          autoUpdateInput: false
        },
        function(startDate, label) {
          $("#date_of_returning").val(startDate.format("DD-MM-YYYY"));
        }
      );
    } else {
      $("#date_of_returning").val(detail.date_of_returning);
      $("#date_of_returning").daterangepicker(
        {
          singleDatePicker: true,
          locale: {
            format: "YYYY-MM-DD"
          },
          autoUpdateInput: false
        },
        function(startDate, label) {
          $("#date_of_returning").val(startDate.format("DD-MM-YYYY"));
        }
      );
    }
  });

  $(".detail-trans").on("click", function() {
    var transId = $(this).attr("trans_id");
    var detail;
    $.ajax({
      url: JS_BASE_URL + "/toolManagement/detailTransmit/" + transId,
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          detail = res.data;
        }
      }
    });
    var list_project;
    $.ajax({
      url: JS_BASE_URL + "/planning/getProjects",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            var slctd = "";
            if (detail.project_id == val.id) {
              slctd += "selected";
            }
            list_project +=
              '<option value="' +
              val.id +
              '" ' +
              slctd +
              ">" +
              val.project_name +
              "</option>";
          });
        }
      }
    });

    var resource;
    var resource2 = '<option value="">Select PIC</option>';
    $.ajax({
      url: JS_BASE_URL + "/resource/all_resource",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            var slctd = "",
              slctd2 = "";
            if (detail.pic_borrowers == val.id) {
              slctd += "selected";
            }
            if (detail.pic_returning == val.id) {
              slctd2 += "selected";
            }
            resource +=
              '<option value="' +
              val.id +
              '" ' +
              slctd +
              ">" +
              val.fullname +
              "</option>";
            resource2 +=
              '<option value="' +
              val.id +
              '" ' +
              slctd2 +
              ">" +
              val.fullname +
              "</option>";
          });
        }
      }
    });

    var tools;
    $.ajax({
      url: JS_BASE_URL + "/toolManagement/all_tools",
      type: "GET",
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          $.each(res.data, function(i, val) {
            var slctd = "";
            if (detail.tools_id == val.id) {
              slctd += "selected";
            }
            tools +=
              '<option value="' +
              val.id +
              '" ' +
              slctd +
              ">" +
              val.tools_name +
              "</option>";
          });
        }
      }
    });

    bootbox.dialog({
      title: "Detail",
      message:
        '<div class="row"> ' +
        '<div class="col-md-12">' +
        '<form action="#" id = "add_user_form">' +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Tool</label> " +
        '<select id="tools_id" name="tools_id" data-placeholder="" disabled = "disabled" class="select">' +
        tools +
        "</select>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Serial Number</label> " +
        '<input type="text" class="form-control" disabled = "disabled" name = "serial_number" id = "serial_number" value = "' +
        detail.serial_number +
        '">' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin">' +
        '<li class="active"><a href="#a" data-toggle="tab" aria-expanded="true">Borrowing</a></li>' +
        ' <li class=""><a href="#b" data-toggle="tab" aria-expanded="false">Returning</a></li>' +
        ' <li class=""><a href="#c" data-toggle="tab" aria-expanded="false">Remarks</a></li>' +
        "</ul>" +
        '<div class="tab-content">' +
        '<div class="tab-pane fade active in" id="a">' +
        '<div class="form-group mt-10">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>Date of Borrowing</label> " +
        '<input type="text" disabled = "disabled" id = "date_of_borrowing" name = "date_of_borrowing" class="form-control daterange-single" value = "' +
        detail.date_of_borrowing +
        '"> ' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>for Project/Area</label> " +
        '<select id="project_id" disabled = "disabled" name="project_id" data-placeholder="" class="select">' +
        list_project +
        "</select>" +
        "</div> " +
        "</div> " +
        "</div> " +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>PIC</label> " +
        '<select id="pic_borrowers" disabled = "disabled" name="pic_borrowers" data-placeholder="" class="select">' +
        resource +
        "</select>" +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>Condition</label> " +
        '<input type="text" disabled = "disabled" id = "conditions_of_borrowing" name = "conditions_of_borrowing" class="form-control" value = "' +
        detail.conditions_of_borrowing +
        '"> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="tab-pane fade" id="b">' +
        '<div class="form-group mt-10">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>Date of Returning</label> " +
        '<input type="text" disabled = "disabled" id = "date_of_returning" name = "date_of_returning" class="form-control daterange-single" value = "' +
        detail.date_of_returning +
        '"> ' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>PIC</label> " +
        '<select id="pic_returning" disabled = "disabled" name="pic_returning" data-placeholder="" class="select">' +
        resource2 +
        "</select>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Condition</label> " +
        '<input type="text" disabled = "disabled" id = "conditions_of_returning" name = "conditions_of_returning" class="form-control" value = "' +
        detail.conditions_of_returning +
        '"> ' +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="tab-pane fade" id="c">' +
        '<div class="form-group mt-10">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Remarks</label> " +
        '<textarea rows="4" cols="5" disabled = "disabled" name = "remarks" placeholder="Description..." class="form-control">' +
        detail.remark_borrowing +
        "</textarea>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</form>" +
        "</div>" +
        "</div>"
    });

    $(".select")
      .parents(".bootbox")
      .removeAttr("tabindex");
    $(".select").select2();
  });

  $(".delete-trans").on("click", function() {
    var transId = $(this).attr("trans_id");
    // Setup
    var notice = new PNotify({
      title: "Confirmation",
      text: "<p>Are you sure you want this transaction?</p>",
      hide: false,
      type: "info",
      confirm: {
        confirm: true,
        buttons: [
          {
            text: "Yes",
            addClass: "btn btn-sm btn-primary"
          },
          {
            addClass: "btn btn-sm btn-link"
          }
        ]
      },
      buttons: {
        closer: false,
        sticker: false
      },
      history: {
        history: false
      }
    });

    // On confirm
    notice.get().on("pnotify.confirm", function() {
      $.ajax({
        url: JS_BASE_URL + "/toolManagement/delete_trans/",
        type: "POST",
        dataType: "json",
        data: { id: transId },
        success: function(res) {
          alertSuccess();
          var dbmil = $(".datatable-transmittal-daily-list").dataTable();
          if (res.status == "Success") {
            dbmil.api().ajax.reload();
          }
        }
      });
    });

    // On cancel
    notice.get().on("pnotify.cancel", function() {
      // alert('Oh ok. Chicken, I see.');
    });
  });
};

var CallbackCustomer = function() {
  $(".edit-customer").on("click", function() {
    var customerId = $(this).attr("customer_id");
    var detail;
    $.ajax({
      url: JS_BASE_URL + "/planning/detail_customer/",
      type: "POST",
      data: { id: customerId },
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          detail = res.data;
        }
      }
    });

    bootbox.dialog({
      title: "Add Customer",
      message:
        '<div class="row"> ' +
        '<div class="col-md-12">' +
        '<form action="#" id = "this_form">' +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Customer Name</label> " +
        '<input type="hidden" name = "customer_id" value="' +
        detail.id +
        '">' +
        '<input type="text" class="form-control" name = "customer_name" id = "customer_name" value="' +
        detail.customer_name +
        '">' +
        "</select>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Adress</label> " +
        '<input type="text" class="form-control" name = "customer_address" id = "customer_address" value="' +
        detail.customer_address +
        '">' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-6">' +
        "<label>Email</label> " +
        '<input type="text" class="form-control" name = "customer_email" id = "customer_email" value="' +
        detail.customer_email +
        '">' +
        "</div>" +
        '<div class="col-sm-6">' +
        "<label>Phone</label> " +
        '<input type="text" id = "po_number" name = "customer_phone" id = "customer_phone" class="form-control" value="' +
        detail.customer_phone +
        '"> ' +
        "</div> " +
        "</div> " +
        "</div> " +
        '<div class="form-group">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        "<label>Other Details</label> " +
        '<textarea rows="4" cols="5" name = "other_customer_detail" id = "other_customer_detail" class="form-control">' +
        detail.other_customer_details +
        "</textarea>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</form>" +
        "</div>" +
        "</div>",
      buttons: {
        success: {
          label: "Add",
          className: "btn-success",
          callback: function() {
            var form = $("#this_form");
            $.ajax({
              url: JS_BASE_URL + "/planning/update_customer/",
              type: "POST",
              dataType: "json",
              data: form.serialize(),
              success: function(res) {
                var dbmil = $(".datatable-customer-list").dataTable();
                if (res.status == "Success") {
                  alertSuccess();
                  dbmil.api().ajax.reload();
                }
              }
            });
          }
        }
      }
    });
  });

  $(".delete-customer").on("click", function() {
    var customerId = $(this).attr("customer_id");
    // Setup
    var notice = new PNotify({
      title: "Confirmation",
      text: "<p>Are you sure you want delete this tool?</p>",
      hide: false,
      type: "info",
      confirm: {
        confirm: true,
        buttons: [
          {
            text: "Yes",
            addClass: "btn btn-sm btn-primary"
          },
          {
            addClass: "btn btn-sm btn-link"
          }
        ]
      },
      buttons: {
        closer: false,
        sticker: false
      },
      history: {
        history: false
      }
    });

    // On confirm
    notice.get().on("pnotify.confirm", function() {
      $.ajax({
        url: JS_BASE_URL + "/planning/delete_customer/",
        type: "POST",
        dataType: "json",
        data: { id: customerId },
        success: function(res) {
          var dbmil = $(".datatable-customer-list").dataTable();
          if (res.status == "Success") {
            alertSuccess();
            dbmil.api().ajax.reload();
          }
        }
      });
    });

    // On cancel
    notice.get().on("pnotify.cancel", function() {
      // alert('Oh ok. Chicken, I see.');
    });
  });
};

var resourceProjectCB = function() {
  $(".edit_rp").click(function(e) {
    var allocationId = $(this).attr("res_id");
    $.ajax({
      url: JS_BASE_URL + "/resource/resource_allocate_detail/",
      type: "POST",
      data: { resource: allocationId },
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "success") {
          detail = res.data;
          $("#resource_id").val(detail.id);
          $("#resource_name").val(detail.fullname);
          $("#resource_position")
            .val(detail.position_id)
            .trigger("change");
          // if(detail.loc != null){
          detail.loc = detail.loc.split(",");
          $("#resource_area")
            .val(detail.loc)
            .trigger("change");
          // }
          $("#resource_join_date").val(
            moment(detail.join_date_to_project).format("DD-MM-YYYY")
          );
          console.log(detail.spv_id);
          if(detail.position_id == 10){
              $("#resource_project_coordinator").val(detail.spv_id).trigger("change");
              $('.res_project_coordinator').removeClass('hidden');
          } else {
              $("#resource_project_coordinator").val('').trigger("change");
              $('.res_project_coordinator').addClass('hidden');
          }
        }
      }
    });
    $("#modal_edit_resource").modal("show");
  });

  $(".delete_rp").click(function() {
    var allocationId = $(this).attr("res_id");
    var notice = new PNotify({
      title: "Confirmation",
      text: "<p>Are you sure you want delete this data?</p>",
      hide: false,
      type: "warning",
      confirm: {
        confirm: true,
        buttons: [
          {
            text: "Yes",
            addClass: "btn btn-sm btn-primary"
          },
          {
            addClass: "btn btn-sm btn-link"
          }
        ]
      },
      buttons: {
        closer: false,
        sticker: false
      },
      history: {
        history: false
      }
    });

    // On confirm
    notice.get().on("pnotify.confirm", function() {
      $.ajax({
        url: JS_BASE_URL + "/resource/deactive_resource/",
        type: "POST",
        data: { resource: allocationId },
        dataType: "json",
        async: false,
        success: function(res) {
          if (res.status == "success") {
            var table1 = $(".datatable-people-list").dataTable();
            alertSuccess();
            table1.api().ajax.reload();
          }
        }
      });
    });

    // // On cancel
    // notice.get().on('pnotify.cancel', function() {
    // });
  });
};

var CallBackVendor = function() {
  $(".edit-vendor").on("click", function() {
    var vendorId = $(this).attr("vendor_id");
    var detail;
    $.ajax({
      url: JS_BASE_URL + "/planning/vendor_detail/",
      type: "POST",
      data: { id: vendorId },
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "Success") {
          detail = res.data;
          $("#vendor_id").val(detail.id);
          $("#vendor_name").val(detail.vendor_name);
          $("#vendor_address").val(detail.vendor_address);
          $("#vendor_phone").val(detail.vendor_phone);
          $("#vendor_email").val(detail.vendor_email);
          $("#vendor_details").val(detail.other_details);

          $("#modal_vendors").modal("show");
        }
      }
    });
  });

  $(".delete-vendor").on("click", function() {
    var vendorId = $(this).attr("vendor_id");
    // Setup
    var notice = new PNotify({
      title: "Confirmation",
      text: "<p>Are you sure you want delete this data?</p>",
      hide: false,
      type: "info",
      confirm: {
        confirm: true,
        buttons: [
          {
            text: "Yes",
            addClass: "btn btn-sm btn-primary"
          },
          {
            addClass: "btn btn-sm btn-link"
          }
        ]
      },
      buttons: {
        closer: false,
        sticker: false
      },
      history: {
        history: false
      }
    });

    // On confirm
    notice.get().on("pnotify.confirm", function() {
      $.ajax({
        url: JS_BASE_URL + "/planning/delete_vendor/",
        type: "POST",
        dataType: "json",
        data: { id: vendorId },
        success: function(res) {
          if (res.status == "Success") {
            var table1 = $(".datatable-vendor-list").dataTable();
            alertSuccess();
            table1.api().ajax.reload();
          }
        }
      });
    });

    // On cancel
    notice.get().on("pnotify.cancel", function() {
      // alert('Oh ok. Chicken, I see.');
    });
  });
};

var CallBackRules = function() {
  $(".edit-rules").on("click", function() {
    var ruleId = $(this).attr("rule_id");
    var detail;
    $.ajax({
      url: JS_BASE_URL + "/implementation/rules_detail/",
      type: "POST",
      data: { id: ruleId },
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "success") {
          detail = res.data;
          // console.log(detail);
          $("#rule_id").val(detail.id);
          $("#rule_code").val(detail.role_name);
          $("#rule_name").val(detail.name);
          $("#rule_description").val(detail.description);
          $("#rule_point").val(detail.point);

          $("#rule_description").summernote();

          console.log(detail.description);

          $("#modal_rules").modal("show");
        }
      }
    });
  });

  $(".detail-rule").on("click", function() {
    var ruleId = $(this).attr("rule_id");
    var detail;
    $.ajax({
      url: JS_BASE_URL + "/implementation/rules_detail/",
      type: "POST",
      data: { id: ruleId },
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "success") {
          detail = res.data;
          $("#code_rule").html(detail.role_name);
          $("#name_rule").html(detail.name);
          $("#desc_rule").html(detail.description);
          $("#point_rule").html(detail.point);

          $("#view_rules").modal("show");
        }
      }
    });
  });
};

var projectVendorCB = function() {
  $(".edit_pv").click(function(e) {
    var vendorId = $(this).attr("pv_id");
    $("#project_vendor_id").val("");
    $("#vendor_id")
      .val("")
      .trigger("change");
    $("#scope_id")
      .val("")
      .trigger("change");
    $("#area_id")
      .val("")
      .trigger("change");

    $.ajax({
      url: JS_BASE_URL + "/planning/project_vendor_detail/",
      type: "POST",
      data: { vendor: vendorId },
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "success") {
          detail = res.data;
          console.log(detail.id);
          $("#project_vendor_id").val(detail.id);
          $("#vendor_id")
            .val(detail.vendor_id)
            .trigger("change");
          if (detail.scopes != null) {
            detail.scopes = detail.scopes.split(",");
          }
          if (detail.areas != null) {
            detail.areas = detail.areas.split(",");
          }
          $("#scope_id")
            .val(detail.scopes)
            .trigger("change");
          $("#area_id")
            .val(detail.areas)
            .trigger("change");
        }
      }
    });
    $("#modal_add_vendor").modal("show");
  });
  $(".delete_pv").on("click", function() {
    var vendorId = $(this).attr("pv_id");
    // Setup
    var notice = new PNotify({
      title: "Confirmation",
      text: "<p>Are you sure you want delete this data?</p>",
      hide: false,
      type: "info",
      confirm: {
        confirm: true,
        buttons: [
          {
            text: "Yes",
            addClass: "btn btn-sm btn-primary"
          },
          {
            addClass: "btn btn-sm btn-link"
          }
        ]
      },
      buttons: {
        closer: false,
        sticker: false
      },
      history: {
        history: false
      }
    });

    // On confirm
    notice.get().on("pnotify.confirm", function() {
      $.ajax({
        url: JS_BASE_URL + "/planning/delete_project_vendor/",
        type: "POST",
        dataType: "json",
        data: { id: vendorId },
        success: function(res) {
          if (res.status == "Success") {
            var table1 = $(".datatable-project-vendor-list").dataTable();
            alertDeleteSuccess();
            table1.api().ajax.reload();
          }
        }
      });
    });

    // On cancel
    notice.get().on("pnotify.cancel", function() {
      // alert('Oh ok. Chicken, I see.');
    });
  });
};

// Start Dendy 21-03-2019
var projectCharterCB = function() {
  $(".delete-pc").on("click", function() {
    var charterId = $(this).attr("pc_id");
    // Setup
    var notice = new PNotify({
      title: "Confirmation",
      text: "<p>Are you sure you want delete this data?</p>",
      hide: false,
      type: "info",
      confirm: {
        confirm: true,
        buttons: [
          {
            text: "Yes",
            addClass: "btn btn-sm btn-primary"
          },
          {
            addClass: "btn btn-sm btn-link"
          }
        ]
      },
      buttons: {
        closer: false,
        sticker: false
      },
      history: {
        history: false
      }
    });

    // On confirm
    notice.get().on("pnotify.confirm", function() {
      $.ajax({
        url: JS_BASE_URL + "/planning/delete_project_charter/",
        type: "POST",
        dataType: "json",
        data: { id: charterId },
        success: function(res) {
          if (res.status == "Success") {
            var table1 = $(".datatable-project-charter-list").dataTable();
            alertDeleteSuccess();
            table1.api().ajax.reload();
          }
        }
      });
    });

    // On cancel
    notice.get().on("pnotify.cancel", function() {
      // alert('Oh ok. Chicken, I see.');
    });
  });
};
// End Dendy 21-03-2019

// Start Dendy 26-03-2019
var projectKMZCB = function() {
  $(".delete-pk").on("click", function() {
    var charterId = $(this).attr("pc_id");
    // Setup
    var notice = new PNotify({
      title: "Confirmation",
      text: "<p>Are you sure you want delete this data?</p>",
      hide: false,
      type: "info",
      confirm: {
        confirm: true,
        buttons: [
          {
            text: "Yes",
            addClass: "btn btn-sm btn-primary"
          },
          {
            addClass: "btn btn-sm btn-link"
          }
        ]
      },
      buttons: {
        closer: false,
        sticker: false
      },
      history: {
        history: false
      }
    });

    // On confirm
    notice.get().on("pnotify.confirm", function() {
      $.ajax({
        url: JS_BASE_URL + "/planning/delete_project_kmz/",
        type: "POST",
        dataType: "json",
        data: { id: charterId },
        success: function(res) {
          if (res.status == "Success") {
            var table1 = $(".datatable-project-kmz-list").dataTable();
            alertDeleteSuccess();
            table1.api().ajax.reload();
          }
        }
      });
    });

    // On cancel
    notice.get().on("pnotify.cancel", function() {
      // alert('Oh ok. Chicken, I see.');
    });
  });
};
// End Dendy 26-03-2019

// Start 27-03-2019
var projectSegmentCB = function() {
  $(".edit_sp").click(function(e) {
    var segmentId = $(this).attr("sg_id");

    $.ajax({
      url: JS_BASE_URL + "/planning/project_segment_detail/",
      type: "POST",
      data: { segment: segmentId },
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "success") {
          detail = res.data;
          // console.log(detail);
          $("#modal_edit_segment input[name='segment_id']").val(detail.id);
          $("#segment_name").html(detail.segment_name);

          if (
            detail.span_id != null &&
            detail.span_hh_start != null &&
            detail.span_hh_end != null
          ) {
            let span_id = detail.span_id.split(",");
            let span_hh_start = detail.span_hh_start.split(",");
            let span_hh_end = detail.span_hh_end.split(",");

            if (span_hh_start.length == span_hh_end.length) {
              for (let i = 0; i < span_hh_start.length; i++) {
                $("#modal_edit_segment #segment-span").append(`
                <tr class="segment-span-row">
                  <td>${i + 1}.</td>
                  <td><input type="text" class="form-control" name="span[${
                    span_id[i]
                  }][span_hh_start]" value="${span_hh_start[i]}"></td>
                  <td><input type="text" class="form-control" name="span[${
                    span_id[i]
                  }][span_hh_end]" value="${span_hh_end[i]}"></td>             
                  <td><a href = "#" class = "delete_span" span_id="${
                    span_id[i]
                  }"><i class = 'icon-trash-alt'></i></a></td>
                </tr>
              `);
              }
            }
          }
        }
      }
    });
    $("#modal_edit_segment").modal("show");
  });
  $(".edit_sg").click(function(e) {
    var segmentId = $(this).attr("sg_id");

    $.ajax({
      url: JS_BASE_URL + "/planning/project_segment_detail/",
      type: "POST",
      data: { segment: segmentId },
      dataType: "json",
      async: false,
      success: function(res) {
        if (res.status == "success") {
          detail = res.data;
          console.log(detail);
          $("#modal_add_segment input[name='segment_id']").val(detail.id);
          $("#modal_add_segment input[name='segment_name']").val(detail.segment_name);
          $("#modal_add_segment input[name='cluster']").val(detail.cluster);
          if(detail.vendor_ids != null){
            detail.vendor_ids = detail.vendor_ids.split(",");
          }
          $.ajax({
              url: JS_BASE_URL + '/planning/get_project_vendor/',
              type: 'POST',
              dataType: 'json',
              data: {id: detail.project_id},
              async: false,
              success: function (res) {
                  $('#modal_add_segment #vendor_id').find('option').remove();
                  var option = "";
                  if (res.status == 'success') {
                    console.log(detail.vendor_ids);
                    $.each(res.data, function(a, b){
                        option += '<option value = "'+b.id+'">'+b.vendor_name+'</option>';
                    })
                    $('#modal_add_segment #vendor_id').append(option);
                    if(detail.vendor_ids != null){
                      $("#modal_add_segment #vendor_id").val(detail.vendor_ids).trigger("change");
                    }
                  }
              }
          });
        }
      }
    });
    $("#modal_add_segment").modal("show");
  });
};
