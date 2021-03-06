<!-- Project list -->
<div class="panel panel-flat">
    <div class = "row m-10">
        <div class = "col-md-6">
          <a href="#">
            <button class = "btn bg-success btn-labeled" id = "add_risk"><b><i class="icon-plus2"></i></b>Add Issue/Risk</button>
          </a>
        </div>

        <div class = "col-md-6">
          <a href="#">
            <a class = "btn pull-right btn-default" href = "<?php echo base_url();?>/issueRisk/expExcel">Export Excel</a>
          </a>
        </div>
    </div>

    <div class = "row m-10">

        <!--
        <div class="col-sm-1">
            <select id="status_issue" class="form-control select">
                <option value="All Status">All</option>
                <option value="Open">Open</option>
                <option value="Close">Close</option>
            </select>
        </div>
        -->

        <div class="btn-group pull-right" data-toggle="buttons">
            <label class="btn btn-default">
                <input id="status_issue_all" type="checkbox" value=""> All
            </label>

            <label class="btn btn-default">
                <input id="status_issue_open" type="checkbox" value="Open"> Open
            </label>

            <label class="btn btn-default">
                <input id="status_issue_close" type="checkbox" value="Close"> Close
            </label>
        </div>

    </div>

    <div class="table-responsive">
        <table class="table text-nowrap datatable-issue-risk-list">
            <thead>
            <tr>
                <th>No Issue Register</th>
                <th>Issue Risk Description</th>
                <th>Project</th>
                <th>Project Scope</th>
                <th>Type</th>
                <th>Raised Date</th>
                <th>Status</th>
                <th>Target to Close</th>
                <th>Action</th>
                <th>Attachment</th>
                <th style="width: 20px;"><i class="icon-arrow-down12"></i></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div id="modal_add_risk" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Add Issue/Risk</h5>
            </div>

            <div class="modal-body ">
                <div class="col-md-12"> 
                    <form method = "POST"  id = "add_risk_form" enctype="multipart/form-data" class = "form-validate-jquery"> 
                        <div class="form-group mt-10"> 
                               <div class="row">
                                    <div class="col-sm-6"> 
                                        <label>Date</label> 
                                        <input type="text" id = "input_date" name = "input_date" class="form-control daterange-single" readonly="readonly" disabled="">
                                    </div>
                                    <div class="col-sm-6"> 
                                        <label>Issue/Risk Register ID</label> 
                                        <input type = "hidden" id = "issue_id" name = "issue_id"> 
                                        <input type="text" id = "no_issue" name = "no_issue" class="form-control" placeholder = "Please select project first"> 
                                    </div> 
                               </div> 
                          </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Project</label>
                                        <select id="project_id" name="project_id" data-placeholder="Select project" class="select" required="required">
                                            <option value="">No Project</option>
                                            <?php foreach ($project as $value){?>
                                                <option value="<?php echo $value->id?>"><?php echo $value->project_id." - ".$value->project_name?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                          <div class="form-group mt-10"> 
                               <div class="row">
                                   <div class="col-sm-6">
                                       <label>Project Scope</label>
                                       <select id="project_scope" name="project_scope" data-placeholder="Select project" class="select" required="required">
                                           <option value="">No Scope</option>
                                           <?php foreach ($scope as $value){?>
                                               <option value="<?php echo $value->project_scope?>"><?php echo $value->project_scope ?></option>
                                           <?php }?>
                                       </select>
                                   </div>
                                    <div class="col-sm-6">
                                        <label>Category</label>
                                        <select id="category" name="category" data-placeholder="Select category" name = "category" class="select" required="required">
                                            <option value="">No Category</option>
                                            <?php foreach ($cat as $value){?>
                                                <option value="<?php echo $value->issue_category?>"><?php echo $value->issue_category?></option>
                                            <?php }?>
                                        </select>
                                        <!--                                        <input type="text" id = "category" name = "category" class="form-control">-->
                                    </div>

                               </div> 
                          </div>
                        <div class="form-group mt-10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Issue/Risk Description</label>
                                    <textarea rows="4" cols="5" id = "issue_risk" name = "issue_risk" placeholder="Description..." class="form-control" required="required"></textarea>
                                </div>
                            </div>
                        </div>
                          <div class="form-group mt-10"> 
                               <div class="row">
                                    <div class="col-sm-6"> 
                                        <label>Project Manager</label> 
                                        <select id="project_manager" name="project_manager" data-placeholder="Select person" class="select" required="required">
                                            <option value="">Project Manager</option> 
                                            <?php foreach ($resource as $value){?>
                                            <option value="<?php echo $value->user_id?>"><?php echo $value->fullname?></option> 
                                              <?php }?>
                                         </select>
                                    </div>
                                    <div class="col-sm-6"> 
                                        <label>PIC</label> 
                                        <select id="pic" name="pic" data-placeholder="Select person" class="select" required="required">
                                            <option value="">No PIC</option> 
                                            <option value="">Project Manager</option> 
                                            <?php foreach ($resource as $value){?>
                                            <option value="<?php echo $value->user_id?>"><?php echo $value->fullname?></option> 
                                              <?php }?>
                                         </select>
                                    </div> 
                               </div> 
                          </div>
                          <div class="form-group mt-10"> 
                               <div class="row">
                                    <div class="col-sm-4">
                                        <label>Raised By</label>
                                        <input type="text" disabled class="form-control" name = "raised_by" id = "raised_by" value="<?php echo $obj_fullname?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Raised Date</label>
                                        <input type="text" id = "raised_date" name = "raised_date" class="form-control daterange-single"> 
                                    </div>
                                   <div class="col-sm-4">
                                       <label>Target to Close</label>
                                       <input type="text" id = "target_to_close" name = "target_to_close" class="form-control daterange-single">
                                   </div>
                               </div> 
                          </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Potential Impact</label>
                                    <textarea rows="3" cols="5" id = "potential_impact" name = "potential_impact" placeholder="Potential Impact..." class="form-control"></textarea>
                                    <!--<input type="text" id = "potential_impact" name = "potential_impact" class="form-control"> -->
                                </div>
                            </div>
                        </div>
                          <!-- <div class="form-group"> 
                               <div class="row">
                                    <div class="col-sm-12"> 
                                         <label>Potential Impact</label> 
                                         <input type="text" id = "potential_impact" name = "potential_impact" class="form-control"> 
                                    </div>
                               </div>
                          </div> -->
                          <!-- <div class="form-group"> 
                               <div class="row">
                                    <div class="col-sm-12"> 
                                         <label>Project</label> 
                                         <select id="project_id" name="project_id" data-placeholder="Select project" class="select">
                                              <option value="">No Project</option> 
                                              <?php foreach ($project as $value){?>
                                              <option value="<?php echo $value->id?>"><?php echo $value->project_id." - ".$value->project_name?></option> 
                                              <?php }?>
                                         </select> 
                                    </div>
                               </div>
                          </div> -->
                          <!-- <div class="form-group"> 
                               <div class="row">
                                    <div class="col-sm-12"> 
                                         <label>Issue/Risk</label> 
                                         <input type="text" class="form-control" name = "issue_risk" id = "issue_risk" value="">
                                    </div>
                               </div>
                          </div> -->
                          <!-- <div class="form-group"> 
                               <div class="row">
                                    <div class="col-sm-12"> 
                                         <label>Potential Impact</label> 
                                         <input type="text" id = "potential_impact" name = "potential_impact" class="form-control"> 
                                    </div>
                               </div>
                          </div> -->
                          <div class="form-group mt-10"> 
                               <div class="row">
                                    <div class="col-sm-4">
                                         <label>Issue or Risk</label> 
                                         <select id="issue_or_risk" name="issue_or_risk" data-placeholder="" class="select" required="required">
                                              <option value="issue" selected>Issue</option>
                                              <option value="risk">Risk</option>
                                         </select> 
                                    </div>
                                   <div class="col-sm-4">
                                       <label>Level of Attention</label>
                                       <select id="issue_only" name="issue_only" data-placeholder="" class="select">
                                           <option value="Not Significant">Not Significant</option>
                                           <option value="Significant">Significant</option>
                                           <option value="Very Significant">Very Significant</option>
                                       </select>
                                   </div>
                                    <div class="col-sm-4">
                                         <label>Status</label> 
                                         <select id="status" name="status" data-placeholder="" class="select">
                                              <option value="OPEN">Open</option>
                                              <option value="CLOSE">Closed</option>
                                         </select> 
                                    </div> 
                               </div> 
                          </div> 
                          <div class="form-group mt-10"> 
                               <div class="row">
                                    <div class="col-sm-12">
                                         <label>Attach Supporting document</label> 
                                         <input type="file" name="attach_doc" class="form-control">
                                         <span class="help-block hidden" id = "file_attc"></span>
                                    </div> 
                               </div> 
                          </div> 

                          <div class = "risk">
                              <legend class="text-semibold"></i>Risk Only</legend>
                              <div class="form-group mt-10"> 
                                         <div class="row">
                                              <div class="col-sm-6"> 
                                                   <label>Probability</label> 
                                                   <input type="text" id = "risk_only_probability" name = "risk_only_probability" class="form-control"> 
                                              </div>
                                              <div class="col-sm-6"> 
                                                   <label>Impact</label> 
                                                   <input type="text" id = "risk_only_impact" name = "risk_only_impact" class="form-control"> 
                                              </div>
                                         </div>
                                    </div>
                                    <div class="form-group"> 
                                         <div class="row">
                                              <div class="col-sm-12"> 
                                                   <label>Significance</label> 
                                                   <input type="text" id = "risk_only_significance" name = "risk_only_significance" class="form-control"> 
                                              </div>
                                         </div>
                                    </div>
                          </div>

                            <legend class="text-semibold"></i>Response</legend>
                            <div class="form-group mt-10"> 
                                 <div class="row">
                                      <div class="col-sm-8">
                                           <label>Current Response (mention date)</label> 
                                           <input type="text" id = "current_response" name = "current_response" class="form-control"> 
                                      </div>
                                      <div class="col-sm-4">
                                           <label>Current Response Date</label> 
                                           <input type="text" id = "current_response_date" name = "current_response_date" class="form-control daterange-single"> 
                                      </div>
                                 </div>
                            </div>
                            <div class="form-group"> 
                                 <div class="row">
                                      <div class="col-sm-8">
                                           <label>Further Action (mention date)</label> 
                                           <input type="text" id = "further_action" name = "further_action" class="form-control"> 
                                      </div>
                                      <div class="col-sm-4">
                                           <label>Further Action Date</label> 
                                           <input type="text" id = "further_action_date" name = "further_action_date" class="form-control daterange-single"> 
                                      </div>
                                 </div>
                            </div>

                          


                          <!-- <ul class="nav nav-lg nav-tabs nav-tabs-bottom nav-tabs-toolbar no-margin"> 
                               <li class="active"><a href="#a" data-toggle="tab" aria-expanded="true">Detail</a></li> 
                               <li class="risk"><a href="#b" data-toggle="tab" aria-expanded="false">Risk</a></li> 
                               <li class=""><a href="#c" data-toggle="tab" aria-expanded="false">Response</a></li> 
                          </ul>  -->
                          <!-- <div class="tab-content"> 
                               <div class="tab-pane fade active in" id="a"> 
                                    <div class="form-group mt-10"> 
                                         <div class="row">
                                              <div class="col-sm-6"> 
                                                   <label>Raised Date</label> 
                                                   <input type="text" id = "raised_date" name = "raised_date" class="form-control daterange-single"> 
                                              </div>
                                              <div class="col-sm-6"></div> 
                                         </div> 
                                    </div> 
                                    <div class="form-group"> 
                                         <div class="row">
                                              <div class="col-sm-6"> 
                                              </div>
                                              <div class="col-sm-6 issue"> 
                                              </div>
                                         </div>
                                    </div>
                               </div>
                               <div class="tab-pane fade" id="b"> 
                                    <div class="form-group mt-10"> 
                                         <div class="row">
                                              <div class="col-sm-6"> 
                                                   <label>Probability</label> 
                                                   <input type="text" id = "risk_only_probability" name = "risk_only_probability" class="form-control"> 
                                              </div>
                                              <div class="col-sm-6"> 
                                                   <label>Impact</label> 
                                                   <input type="text" id = "risk_only_impact" name = "risk_only_impact" class="form-control"> 
                                              </div>
                                         </div>
                                    </div>
                                    <div class="form-group"> 
                                         <div class="row">
                                              <div class="col-sm-12"> 
                                                   <label>Significance</label> 
                                                   <input type="text" id = "risk_only_significance" name = "risk_only_significance" class="form-control"> 
                                              </div>
                                         </div>
                                    </div>
                               </div>
                               <div class="tab-pane fade" id="c"> 
                                    <div class="form-group mt-10"> 
                                         <div class="row">
                                              <div class="col-sm-6"> 
                                                   <label>Current Response (mention date)</label> 
                                                   <input type="text" id = "current_response" name = "current_response" class="form-control"> 
                                              </div>
                                              <div class="col-sm-6"> 
                                                   <label>Current Response Date</label> 
                                                   <input type="text" id = "current_response_date" name = "current_response_date" class="form-control daterange-single"> 
                                              </div>
                                         </div>
                                    </div>
                                    <div class="form-group"> 
                                         <div class="row">
                                              <div class="col-sm-6"> 
                                                   <label>Further Action (mention date)</label> 
                                                   <input type="text" id = "further_action" name = "further_action" class="form-control"> 
                                              </div>
                                              <div class="col-sm-6"> 
                                                   <label>Further Action Date</label> 
                                                   <input type="text" id = "further_action_date" name = "further_action_date" class="form-control daterange-single"> 
                                              </div>
                                         </div>
                                    </div>
                               </div>
                     </div>  -->
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

<div id="view_risk" class="modal fade">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">General Issue & Risk Information</h5>
            </div>

            <div class="modal-body">
                <div class="col-md-7"> 
                    <legend class="text-semibold"></i>Issue/Risk Detail</legend>
                    <div class="form-group mt-10"> 
                        <div class="row">
                            <div class="col-sm-2">
                                <label>Date</label> 
                                <input type="text" id = "input_date2" class="form-control" readonly="readonly">
                            </div>
                            <div class="col-sm-2">
                                <label>No. Issue Register</label>
                                <input type="text" id = "no_issue2" class="form-control" placeholder = "Please select project first" readonly="readonly"> 
                            </div>
                            <div class="col-sm-8">
                                <label>Project</label>
                                <input type="text" id = "project_id2" class="form-control" readonly="readonly">
                            </div>
                        </div>
                        <!--
                        <div class="form-group mt-10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Project</label>
                                    <input type="text" id = "project_id2" class="form-control" readonly="readonly">
                                </div>
                            </div>
                        </div>
                        -->

                        <div class="form-group mt-10"> 
                               <div class="row">
                                   <div class="col-sm-6">
                                       <label>Project Scope</label>
                                       <input type="text" id = "project_scope2" class="form-control" readonly="readonly">
                                   </div>
                                    <div class="col-sm-6">
                                        <label>Category</label>
                                        <input type="text" id = "category2" class="form-control" readonly="readonly">
                                        <!--                                        <input type="text" id = "category" name = "category" class="form-control">-->
                                    </div>

                               </div> 
                        </div>
                        <div class="form-group mt-10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Issue/Risk Description</label>
                                    <textarea rows="2" cols="5" id = "issue_risk2" name = "issue_risk" placeholder="Description..." class="form-control" readonly="readonly"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-10"> 
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Project Manager</label> 
                                    <input type="text" id = "project_manager2" class="form-control" readonly="readonly">
                                </div>
                                <div class="col-sm-4">
                                    <label>PIC</label> 
                                    <input type="text" id = "pic2" class="form-control" readonly="readonly">
                                </div>
                                <div class="col-sm-4">
                                    <label>Raised By</label>
                                    <input type="text" disabled class="form-control" name = "raised_by" id = "raised_by2" readonly="readonly">
                                </div>
                            </div> 
                        </div>
                        <div class="form-group mt-10"> 
                            <div class="row">
                                <div class="col-sm-2">
                                    <label>Raised Date</label>
                                    <input type="text" id = "raised_date2" name = "raised_date" class="form-control" readonly="readonly"> 
                                </div>
                               <div class="col-sm-2">
                                   <label>Target to Close</label>
                                   <input type="text" id = "target_to_close2" name = "target_to_close" class="form-control" readonly="readonly">
                               </div>
                                <div class="col-sm-8">
                                    <label>Potential Impact</label>
                                    <div class = "col-md-12 well" id = "potential_impact2"></div>
                                    <!-- <textarea rows="3" cols="5" id = "potential_impact2" name = "potential_impact" placeholder="Potential Impact..." class="form-control" readonly=""></textarea> -->
                                    <!--<input type="text" id = "potential_impact" name = "potential_impact" class="form-control"> -->
                                </div>
                            </div>
                         </div>
                        <div class="form-group mt-10">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Issue or Risk</label>
                                    <input type="text" id = "issue_or_risk2" name = "target_to_close" class="form-control" readonly="readonly"> 
                                </div>
                                <div class="col-sm-4">
                                    <label>Level of Attention</label>
                                    <input type="text" id = "issue_only2" name = "target_to_close" class="form-control" readonly="readonly"> 
                               </div>
                                <div class="col-sm-4">
                                    <label>Status</label>
                                    <input type="text" id = "status2" name = "target_to_close" class="form-control" readonly="readonly"> 
                                </div> 
                            </div> 
                        </div> 
                        <div class="form-group mt-10"> 
                            <div class="row">
                                <div class="col-sm-12">
                                     <label>Attachment: </label> 
                                     <span id = "file_attc2"></span>
                                </div> 
                            </div> 
                        </div>
                        <div class = "risk">
                            <legend class="text-semibold"></i>Risk Only</legend>
                            <div class="form-group mt-10"> 
                                <div class="row">
                                    <div class="col-sm-6"> 
                                        <label>Probability</label> 
                                        <input type="text" id = "risk_only_probability2" name = "risk_only_probability" class="form-control"> 
                                    </div>
                                    <div class="col-sm-6"> 
                                       <label>Impact</label> 
                                       <input type="text" id = "risk_only_impact2" name = "risk_only_impact" class="form-control"> 
                                    </div>
                                </div>
                                <div class="form-group"> 
                                     <div class="row">
                                          <div class="col-sm-12"> 
                                               <label>Significance</label> 
                                               <input type="text" id = "risk_only_significance2" name = "risk_only_significance" class="form-control"> 
                                          </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5"> 
                    <legend class="text-semibold">Response</legend>
                    <div class="form-group mt-10"> 
                        <div class="row">
                            <div class="col-sm-8">
                                <label>Current Response (mention date)</label> 
                                <input type="text" id = "current_response2" name = "current_response" class="form-control" readonly> 
                            </div>
                            <div class="col-sm-4">
                                <label>Current Response Date</label> 
                                <input type="text" id = "current_response_date2" name = "current_response_date" class="form-control" readonly=""> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group"> 
                        <div class="row">
                            <div class="col-sm-8">
                                <label>Further Action (mention date)</label> 
                                <input type="text" id = "further_action2" name = "further_action" class="form-control" readonly=""> 
                            </div>
                            <div class="col-sm-4">
                                <label>Further Action Date</label> 
                                <input type="text" id = "further_action_date2" name = "further_action_date" class="form-control" readonly=""> 
                            </div>
                        </div>
                    </div>
                    <legend class="text-semibold">Follow Up and Closing</legend>
                    <div class="form-group mt-10""> 
                       <div class = "table-responsive">
                           <table id = "issueDetail" class="table table-borderless">
                              <thead>
                                 <tr>
                                    <td>Type</td>
                                    <td width="120px">Date</td>
                                    <td>Description</td>
                                    <td></td>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <!-- <button type="button" id = "finalClose2" name = "submit_close" value = "true" class="btn btn-danger">Close Issue</button> -->
            </div>
        </div>
    </div>
</div>

<div id="issue_close" class="modal fade">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Close Issue/Risk</h5>
            </div>

            <div class="modal-body">
                <div class="col-md-12"> 
                    <form method = "POST"  action= "/issueRisk/close" id = "close_form" enctype="multipart/form-data"> 
                          <div class="form-group"> 
                               <div class="row">
                                    <div class="col-sm-10">
                                         <span>Issue/Risk Description</span> 
                                         <h6 id = "issue_risk_desc2"></h6>
                                         <input type = "hidden" id = "tobe_closed" name = "for_issue">
                                    </div>

                                    <div class="col-sm-2">
                                         <span>Raised Date</span> 
                                         <h6 id = "issue_dates2"></h6>  
                                    </div>
                               </div>
                          </div>
                            <div class = "table-responsive">
                              <table id = "follow_up2" class="table table-borderless">
                                <thead>
                                  <tr>
                                    <td>Date</td>
                                    <td>Follow Up Description</td>
                                    <td>Attachment</td>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class = "closing_issue"></div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" id = "finalClose2" name = "submit_close" value = "true" class="btn btn-danger">Close Issue</button>
            </div>
            </form> 
        </div>
    </div>
</div>

<div id="attachment_modal" class="modal fade">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Attachment Issue/Risk</h5>
            </div>

            <div class="modal-body">
                <div class="col-md-12"> 
                    <form method = "POST"  action= "/issueRisk/close" id = "close_form" enctype="multipart/form-data"> 
                          <div class="form-group"> 
                               <div class="row">
                                    <div class="col-sm-10">
                                         <span>Issue/Risk Description</span> 
                                         <h6 id = "issue_risk_desc3"></h6>
                                    </div>

                                    <div class="col-sm-2">
                                         <span>Raised Date</span> 
                                         <h6 id = "issue_dates3"></h6>  
                                    </div>
                               </div>
                          </div>
                            <div class = "table-responsive">
                              <table id = "allAttachment" class="table table-borderless">
                                <thead>
                                  <tr>
                                    <td width="150px">Date</td>
                                    <td>Attachment</td>
                                    <td width="200px">Type</td>
                                  </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            </div>
            </form> 
        </div>
    </div>
</div>

<div id="modal_follow_up" class="modal fade">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Follow Up Issue/Risk</h5>
            </div>
            <div class="modal-body">
                <div class="col-md-12"> 
                    <form method = "POST"  action= "/issueRisk/updateFollowUp" id = "follow_up_form" enctype="multipart/form-data" > 
                          <div class="form-group"> 
                               <div class="row">
                                    <div class="col-sm-6">
                                         <span>Issue/Risk Description</span> 
                                         <h6 id = "issue_risk_desc"></h6> 
                                         <input type = "hidden" id = "for_issue" name = "for_issue"> 
                                         <input type = "hidden" id = "deleted_follow_up" name = "deleted_follow_up"> 
                                         <input type = "hidden" id = "idx" name = "idx"> 
                                    </div>
                                    <div class="col-sm-2"> 
                                         <span>Raised Date</span>
                                         <h6 id = "issue_dates"></h6>
                                    </div>
                                    <div class="col-sm-3">
                                         <span>Project</span> 
                                         <h6 id = "name_project">PALAPA RING BARAT</h6>
                                    </div>
                                    <div class="col-sm-1">
                                          <button type = "button" class="btn btn-primary pull-right btn-s" id = "addChild">Add</button>
                                    </div>

                               </div>
                          </div>
                            <div class = "table-responsive">
                                <table id = "follow_up" class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <td width="150px">Date</td>
                                            <td>Follow Up Description</td>
                                            <td width="250px">Attachment</td>
                                            <td width="50px"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <button type="button" name = "submit_followup" value = "true" id = "closing" class="btn bg-purple">Close Issue/Risk</button>
                            <div id = "close_date1">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" id = "finalClose" value = "true" class="btn btn-danger">Close</button>
                <button type="submit" name = "submit_followup" value = "true" class="btn btn-primary">Follow Up</button>
            </div>
            </form> 
        </div>
    </div>
</div>



<script type="text/javascript">
   $(function () {
      var message = '<?php echo $this->session->flashdata('message')?>';
        if(message != '') {
            new PNotify({
                title: 'Success',
                text: message,
                icon: 'icon-checkmark3',
                addclass: 'bg-success',
                delay: '3000'
            });
        }
        $('#project_id').on('change', function(){
            var project_id = $(this).val();
            $.ajax({
                url: JS_BASE_URL + '/issueRisk/generateId/',
                type: 'POST',
                dataType: 'json',
                data : {project_id: project_id},
                async: false,
                success: function (res) {
                   if (res.status == 'Success') {
                        $('#no_issue').val(res.data);
                   }
                }
            });
        });
        var dbissue = $('.datatable-issue-risk-list').dataTable();

        dbissue.api().columns(6)
               .search( 'Open' )
               .draw();

       $('#status_issue').on( 'change', function () {
//           if ( that.search() !== this.value ) {
           dbissue.api()
                   .search( this.value )
                   .draw();
//           }
       });
       $('#status_issue_all').on( 'change', function () {
        // table.columns(2).search( this.value ).draw();
           dbissue.api().columns(6)
               .search( this.value )
               .draw();
       });
       $('#status_issue_open').on( 'change', function () {
           dbissue.api().columns(6)
               .search( this.value )
               .draw();
       });
       $('#status_issue_close').on( 'change', function () {
           dbissue.api().columns(6)
               .search( this.value )
               .draw();
       });

        $('#add_risk').on('click', function() {
            $('#modal_add_risk').modal('show');
            $('#add_risk_form')[0].reset();
            $("#status option[value=closed]").attr('disabled','disabled');
            $("#file_attc").addClass('hidden');
            $('.risk').hide();
            $( "#issue_or_risk" ).change(function() {
                console.log($(this).val());
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
                    format: 'DD-MM-YYYY'
                },
            });
        });

        $(document).on("click", ".dismiss", function(){
            var fu = $(this).attr('follow_up');
            console.log(fu);
            var dfu = $('#deleted_follow_up').val();
            dfu = dfu + ","+fu;
            $('#deleted_follow_up').val(dfu);
            deleteRow(this);
        });

        function deleteRow(buttonElement){
            // console.log(buttonElement);
            $(buttonElement).parent().parent().remove();
        }

        $("#close_issue").click(function(event){
            var issue = $('#tobe_closed').val();
            $.ajax({
                url: JS_BASE_URL + '/issueRisk/close/',
                type: 'POST',
                dataType: 'json',
                data : {issue: issue},
                async: false,
                success: function (res) {
                   if (res.status == 'Success') {
                      new PNotify({
                         title: 'Success',
                         text: 'Issue has been closed',
                         icon: 'icon-checkmark3',
                         addclass: 'bg-success',
                         delay: '3000'
                      });
                      var dbmil = $('.datatable-issue-risk-list').dataTable();
                      dbmil.api().ajax.reload();
                   }
                }
            });
        });

        $("#addChild").click(function(event){
            event.preventDefault;
            // alert(numRowChilds);
            addNewChild();
            return false;
        });

        var numRowChilds=$('#follow_up tbody').children().length;

        function addNewChild(){
            var row='<tr>';
            row += '<td><input type="text" name = "follow_up['+numRowChilds+'][date]" class="form-control daterange-single"></td><td><input type="text" name = "follow_up['+numRowChilds+'][description]" class="form-control"></td><td><input type="file" name = "attachment'+numRowChilds+'" class="form-control"><td><a href="#" class ="dismiss"><i class ="icon-trash"></i></span></td></td>';
            row+='</td></tr>';  
            $("#follow_up tbody").append(row);
            $('.daterange-single').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'YYYY-MM-DD'
                },
            });
            numRowChilds++;
        }
    });
</script>


