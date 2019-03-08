<?php

class IssueRisk_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function setUserId()
    {
        $cookie = base64_decode($_COOKIE['SSOID']);
        $crop = explode('+', $cookie);
        return $crop[0];
    }

    public function getIssueRiskDetail($id){
        $this->db->select('a.*, b.project_name, c.fullname as pm_name, d.fullname as pic_name,e.fullname as raised_by');
        $this->db->from('pm_issue_risk_register a');
        $this->db->join('pm_projects b','a.projects_id = b.id','left');
        $this->db->join('pm_user c','a.pm_id = c.user_id','left');
        $this->db->join('pm_user d','a.pic_id = d.user_id','left');
        $this->db->join('pm_user e','a.created_by = e.sso_id','left');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        $tools = $query->row();
        return $tools;
    }

    private function _get_datatable_issueRisk_query()
    {
	    $roles = $this->apps->info();
        $role = $roles['userRole'][0];
        $projects = $roles['projects'];
	   //Get user Id project
	    $this->db->select('*');
        $this->db->from('pm_user');
        $this->db->where('sso_id', $this->setUserId());
        $user_query = $this->db->get();
        $user = $user_query->row();
	    $user_id = $user->user_id;

        /*
         $column_order = array("tools_id", "description", "pr_number", "pr_date", "po_number", "po_date");*/
        $column_search = array("issue_no","project_scope","issue_risk","issue_or_risk","type_of_issue_risk","raised_date","a.status","target_to_close","potential_impact","issue_or_risk","issue_only","risk_only_probability","risk_only_impact","risk_only_significance","current_response","current_response_date","further_action","further_action_date","file_attachment","closing_date","closing_attachment","closing_description","remark","fullname");
        $this->db->select('b.project_name, a.*');
        $this->db->from('pm_issue_risk_register a');
        $this->db->join('pm_projects b','a.projects_id = b.id');
        $this->db->join('pm_user c','a.pm_id = c.user_id','left');
        // $this->db->join('pm_user d','a.pic_id = c.user_id','left');
        
        // if($role!=1){
        //     $a = '(pm_id ='.$user_id.' or pic_id = '.$user_id.')';
        //     $this->db->where($a);
        //     // $this->db->where('pm_id',$user_id);
        //     // $this->db->or_where('pic_id',$user_id);
        // }
        if($role!=1 && $roles['allProject'] == 'false'){
            if(isset($roles['userPermission']['viewAllIssueRisk'])){
                $p = array();
                foreach($projects as $v){
                    $p[] = $v->id;
                }
                $this->db->where_in('projects_id',$p);
            } else {
                $a = '(a.pm_id ='.$user_id.' or a.pic_id = '.$user_id.')';
                $this->db->where($a);
            }
            
        }
        $i = 0;
        $condition = '(';
        if($_POST['columns'][6]['search']['value']){
            $status = $_POST['columns'][6]['search']['value'];

            if($status == 'Open'){
                $this->db->where('a.status', 'OPEN');
            }

            if($status == 'Close'){
                $this->db->where('a.status', 'CLOSE');
            }
        }

        foreach ($column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($_POST['search']['value'] == "AllStatus"){} else {
                    if($i===0) // first loop
                        {
                            $condition .= $item." LIKE '%".$_POST['search']['value']."%' ESCAPE '!'";
                        }
                        else
                        {
                            $condition .= " OR ".$item." LIKE '%".$_POST['search']['value']."%' ESCAPE '!'";
                            // $this->db->or_like($item, $_POST['search']['value']);
                        }
                    }
                    $i++;
                
                }

                // if($_POST['search']['value'] == "Open"){
                //     $this->db->like('status', $_POST['search']['value']);
                // }

                // if($_POST['search']['value'] == "Close"){
                //     $this->db->like('status', $_POST['search']['value']);
                // }
        }

        $condition .= ")";


        if($_POST['search']['value']){
            $this->db->where($condition);
        }

        $this->db->order_by('created_date','desc');

        /*if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }*/

    }

    function get_datatable_issueRisk()
    {
        $this->_get_datatable_issueRisk_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_issueRisk()
    {
        $this->_get_datatable_issueRisk_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_issueRisk()
    {
        $roles = $this->apps->info();
        $role = $roles['userRole'][0];

        $this->db->select('*');
        $this->db->from('pm_user');
        $this->db->where('sso_id', $this->setUserId());
        $user_query = $this->db->get();
        $user = $user_query->row();
        $user_id = $user->user_id;

        $this->db->from("pm_issue_risk_register");
        /*if($role!=1){
            $this->db->where('pm_id',$user_id);
            $this->db->or_where('pic_id',$user_id);
        }*/
        return $this->db->count_all_results();
    }

    public function issueRiskExcel()
    {
        $roles = $this->apps->info();
        $role = $roles['userRole'][0];
        $projects = $roles['projects'];

        $this->db->select('*');
        $this->db->from('pm_user');
        $this->db->where('sso_id', $this->setUserId());
        $user_query = $this->db->get();
        $user = $user_query->row();
        $user_id = $user->user_id;
        
        /*$this->db->select('*');
        $this->db->from('pm_user');
        $this->db->where('sso_id', $this->setUserId());
        $user_query = $this->db->get();
        $user = $user_query->row();
        $user_id = $user->user_id;
        // $user_id = 17;
        $column_search = array("status","project_name","issue_risk","issue_or_risk");
        $this->db->select('b.project_name, a.*');
        $this->db->from('pm_issue_risk_register a');
        $this->db->join('pm_projects b','a.projects_id = b.id');
        */
        $this->db->select('a.*, b.project_name, c.fullname as pm_name, d.fullname as pic_name,e.fullname as raised_by');
        $this->db->from('pm_issue_risk_register a');
        $this->db->join('pm_projects b','a.projects_id = b.id','left');
        $this->db->join('pm_user c','a.pm_id = c.user_id','left');
        $this->db->join('pm_user d','a.pic_id = d.user_id','left');
        $this->db->join('pm_user e','a.created_by = e.sso_id','left');
        if($role!=1){
            if(isset($roles['userPermission']['viewAllIssueRisk'])){
                $p = array();
                foreach($projects as $v){
                    $p[] = $v->id;
                }
                $this->db->where_in('projects_id',$p);
            } else {
                $a = '(pm_id ='.$user_id.' or pic_id = '.$user_id.')';
                $this->db->where($a);
            }
            
        }
        /*if($role!=1){
            $this->db->where('pm_id',$user_id);
            $this->db->or_where('pic_id',$user_id);
        }*/
        $query = $this->db->get();
        $issues = $query->result();
        return $issues;
    }

    public function getMaxId(){
        $query = $this->db->query("SELECT MAX(id) AS issue_id FROM pm_issue_risk_register");
        return $query->row();
    }

    public function saveNewIssueRisk($attc = ""){

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        /*$raised_date = null;
        $current_response_date = null;
        $further_action_date = null;

        if(!empty($raised_date)){
            $raised_date = date('Y-m-d H:i:s', strtotime($this->input->post('raised_date')));
        }

        if(!empty($current_response_date)){
            $current_response_date = ;
        }

        if(!empty($further_action_date)){
            $further_action_date = date('Y-m-d', strtotime($this->input->post('further_action_date')));
        }*/

        $data = array(
            'projects_id' => $this->input->post('project_id'),
            'issue_no' => $this->input->post('no_issue'),
            'issue_risk' => $this->input->post('issue_risk'),
            'type_of_issue_risk' => $this->input->post('category'),
            'raised_date' => date('Y-m-d', strtotime($this->input->post('raised_date'))),
            'project_scope' => $this->input->post('project_scope'),
            'pm_id' => $this->input->post('project_manager'),
            'pic_id' => $this->input->post('pic'),
            'target_to_close' => date('Y-m-d', strtotime($this->input->post('target_to_close'))),
            'status' => $this->input->post('status'),
            'potential_impact' => $this->input->post('potential_impact'),
            'issue_or_risk' => $this->input->post('issue_or_risk'),
            'issue_only' => $this->input->post('issue_only'),
            'risk_only_probability' => $this->input->post('risk_only_probability'),
            'risk_only_impact' => $this->input->post('risk_only_impact'),
            'risk_only_significance' => $this->input->post('risk_only_impact'),
            'current_response' => $this->input->post('current_response'),
            'current_response_date' => date('Y-m-d', strtotime($this->input->post('current_response_date'))),
            'further_action' => $this->input->post('further_action'),
            'further_action_date' => date('Y-m-d', strtotime($this->input->post('further_action_date'))),
            'file_attachment' => $attc,
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->setUserId(),
        );

        $this->db->insert('pm_issue_risk_register', $data);

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }

        return true;
    }

    public function updateIssueRisk($attc = ""){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $raised_date = $this->input->post('raised_date');
        $current_response_date = $this->input->post('current_response_date');
        $further_action_date = $this->input->post('further_action_date');

        if(!empty($raised_date)){
            $raised_date = date('Y-m-d H:i:s', strtotime($this->input->post('raised_date')));
        }

        if(!empty($current_response_date)){
            $current_response_date = date('Y-m-d H:i:s', strtotime($this->input->post('current_response_date')));
        }

        if(!empty($further_action_date)){
            $further_action_date = date('Y-m-d H:i:s', strtotime($this->input->post('further_action_date')));
        }

        $issueId = $this->input->post('issue_id');

        if(!empty($attc)){
            $data = array(
                'issue_no' => $this->input->post('no_issue'),
                'projects_id' => $this->input->post('project_id'),
                'issue_risk' => $this->input->post('issue_risk'),
                'type_of_issue_risk' => $this->input->post('type_of_issue_risk'),
                'raised_date' => $raised_date,
                'status' => strtoupper($this->input->post('status')),
                'potential_impact' => $this->input->post('potential_impact'),
                'issue_or_risk' => $this->input->post('issue_or_risk'),
                'project_scope' => $this->input->post('project_scope'),
                'pm_id' => $this->input->post('project_manager'),
                'pic_id' => $this->input->post('pic'),
                'target_to_close' => date('Y-m-d', strtotime($this->input->post('target_to_close'))),
                'issue_only' => $this->input->post('issue_only'),
                'risk_only_probability' => $this->input->post('risk_only_probability'),
                'risk_only_impact' => $this->input->post('risk_only_impact'),
                'risk_only_significance' => $this->input->post('risk_only_impact'),
                'current_response' => $this->input->post('current_response'),
                'current_response_date' => $this->input->post('current_response_date'),
                'further_action' => $this->input->post('further_action'),
                'further_action_date' => $this->input->post('further_action_date'),
                'file_attachment' => $attc,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => $this->setUserId(),
            );
        } else {
            $data = array(
                'issue_no' => $this->input->post('no_issue'),
                'projects_id' => $this->input->post('project_id'),
                'issue_risk' => $this->input->post('issue_risk'),
                'type_of_issue_risk' => $this->input->post('type_of_issue_risk'),
                'raised_date' => $raised_date,
                'project_scope' => $this->input->post('project_scope'),
                'status' => strtoupper($this->input->post('status')),
                'pm_id' => $this->input->post('project_manager'),
                'pic_id' => $this->input->post('pic'),
                'target_to_close' => date('Y-m-d', strtotime($this->input->post('target_to_close'))),
                'potential_impact' => $this->input->post('potential_impact'),
                'issue_or_risk' => $this->input->post('issue_or_risk'),
                'issue_only' => $this->input->post('issue_only'),
                'risk_only_probability' => $this->input->post('risk_only_probability'),
                'risk_only_impact' => $this->input->post('risk_only_impact'),
                'risk_only_significance' => $this->input->post('risk_only_impact'),
                'current_response' => $this->input->post('current_response'),
                'current_response_date' => $this->input->post('current_response_date'),
                'further_action' => $this->input->post('further_action'),
                'last_updated_date' => date('Y-m-d H:i:s'),
                'last_updated_by' => $this->setUserId(),
            );
        }


        $this->db->where('id', $issueId);
        $this->db->update('pm_issue_risk_register', $data);

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }

        return true;
    }

    public function deleteIssueRisk($id)
    {
        $this->db->delete('pm_issue_risk_register', array('id' => $id));
        return true;
    }


    public function saveFollowUp($attc = ""){

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $issueId = $this->input->post('for_issue');
        $follow_up = $this->input->post('follow_up');
        $deleted = explode(",", $this->input->post('deleted_follow_up'));
        foreach ($deleted as $k => $v) {
            $this->db->delete('pm_issue_follow_up', array('id' => $v));
        }
        foreach ($follow_up as $key => $value) {
            $date = $value['date'];
            if(!empty($date)){
                $date = date('Y-m-d', strtotime($date));
            }else {
                $date = null;
            }

            if(empty($attc)){
                $fl = null;
            } else {
                $fl = $attc[$key];
            }

            if(!empty($value['desription']) || $value['description'] != ""){
                $data = array(
                    'issue_id' => $issueId,
                    'follow_up_date' => $date,
                    'follow_up_description' => $value['description'],
                    'file_attachment' => $fl,
                    'created_date' => date('Y-m-d H:i:s'),
                    'created_by' => $this->setUserId(),
                );
                // var_dump($data);
                $this->db->insert('pm_issue_follow_up', $data);
            }
        }

        // exit();


        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }

        return true;
    }

    public function getFollowUp($id){
        $this->db->select('*');
        $this->db->from('pm_issue_follow_up');
        $this->db->where('issue_id', $id);
        $query = $this->db->get();
        $follow_up = $query->result();
        return $follow_up;
    }


    public function allCategory(){
        $this->db->select('*');
        $this->db->from('pm_issue_categories');
        $query = $this->db->get();
        $cat = $query->result();
        return $cat;
    }

    public function getIssueCategoryById($id){
        $this->db->select('*');
        $this->db->from('pm_issue_categories');
        $this->db->where('id',$id);
        $query = $this->db->get();
        $cat = $query->row();
        return $cat;
    }

    public function getProjectScopeById($id){
        $this->db->select('*');
        $this->db->from('pm_project_scope');
        $this->db->where('id',$id);
        $query = $this->db->get();
        $scope = $query->row();
        return $scope;
    }

    public function getIssueRiskRegisterByIssueNo($no){
        $this->db->select('*');
        $this->db->from('pm_issue_risk_register');
        $this->db->where('issue_no',$no);
        $query = $this->db->get();
        $issue = $query->row();
        return $issue;
    }


    public function close($attc){
        $issueId = $this->input->post('for_issue');
        /*if(isset($attc['closing_attc'])){
            $closing_attc = $attc['closing_attc'];
            unset($attc['closing_attc']);
        }*/
        $data = array(
            'status' => 'CLOSE',
            'closing_date' => date('Y-m-d', strtotime($this->input->post('closing_date'))),
            'closing_description' => $this->input->post('closing_desc'),
            'closing_attachment' => $attc
        );
        $this->db->where('id', $issueId);
        $this->db->update('pm_issue_risk_register', $data);

        return true;
    }

    public function generateIssueId($id){
        $this->db->select('project_id');
        $this->db->from('pm_projects');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $project = $query->row();

        $next_id = $this->getMaxId();
        $issueId = "";

        $w = $next_id->issue_id+1;
        if(strlen($next_id->issue_id)==1){
            $issueId='000'.$w;
        }else if(strlen($next_id->issue_id)==2){
            $issueId='00'.$w;
        }else if(strlen($next_id->issue_id)==3){
            $issueId = "0".$w;
        }else {
            $issueId= $w;
        }


        $no_issue = $project->project_id."-01-".$issueId;

        return $no_issue;
    }


    public function getAllAttachment($id){
        $attc = array();
        $this->db->select('a.*');
        $this->db->from('pm_issue_risk_register a');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        $attachment = $query->row();

        if(!empty($attachment->file_attachment)){
            $attc[] = array(
                'date' => date('Y-m-d', strtotime($attachment->created_date)),
                'desc' => '',
                'type' => 'Issue/Risk',
                'file' => $attachment->file_attachment
            );
        }

        $this->db->select('*');
        $this->db->from('pm_issue_follow_up');
        $this->db->where('issue_id', $id);
        $this->db->where('file_attachment IS NOT NULL');
        $query = $this->db->get();
        $follow_up = $query->result();

        if(!empty($follow_up)){
            foreach ($follow_up as $key => $value) {
                $attc[] = array(
                    'date' => $value->follow_up_date,
                    'desc' => $value->follow_up_description,
                    'type' => 'Follow Up',
                    'file' => $value->file_attachment
                );
            }
        }

        if(!empty($attachment->closing_attachment)){
            $attc[] = array(
                'date' => $attachment->closing_date,
                'desc' => $attachment->closing_description,
                'type' => 'Closing',
                'file' => $attachment->closing_attachment
            );
        }

        return $attc;
    }

    public function followUpandClosing($id){
        $attc = array();
        $this->db->select('a.*');
        $this->db->from('pm_issue_risk_register a');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        $attachment = $query->row();

        if(!empty($attachment->file_attachment)){
            $attc[] = array(
                'date' => date('Y-m-d', strtotime($attachment->created_date)),
                'desc' => '',
                'type' => 'Issue/Risk',
                'file' => $attachment->file_attachment
            );
        }

        $this->db->select('*');
        $this->db->from('pm_issue_follow_up');
        $this->db->where('issue_id', $id);
        $query = $this->db->get();
        $follow_up = $query->result();

        if(!empty($follow_up)){
            foreach ($follow_up as $key => $value) {
                $attc[] = array(
                    'date' => $value->follow_up_date,
                    'desc' => $value->follow_up_description,
                    'type' => 'Follow Up',
                    'file' => $value->file_attachment
                );
            }
        }

        if(!empty($attachment->closing_attachment)){
            $attc[] = array(
                'date' => $attachment->closing_date,
                'desc' => $attachment->closing_description,
                'type' => 'Closing',
                'file' => $attachment->closing_attachment
            );
        }

        return $attc;
    }

    public function getAllHeadImplementation()
    {
        $this->db->select('*');
        $this->db->from('pm_user');
        $this->db->where('sso_id', '3621'); //rury
        $this->db->or_where('sso_id', '2414'); //adit
        $this->db->or_where('sso_id', '902'); //iwan
        $this->db->or_where('sso_id', '3358'); //laras
        $this->db->or_where('sso_id', '2880'); //darumas
        $this->db->or_where('sso_id', '3238'); //lucky
        $this->db->or_where('sso_id', '2130'); //agung r
        $this->db->or_where('sso_id', '3727'); //Marisa
        $this->db->or_where('sso_id', '1332'); //Deka
        $this->db->or_where('sso_id', '2233'); //Armen
        $this->db->or_where('sso_id', '1588'); //Bambang
        $this->db->or_where('sso_id', '3633'); //Herald
        $this->db->or_where('sso_id', '1793'); //Suhyar
        $this->db->or_where('sso_id', '2383'); //Hariawan
        $this->db->or_where('sso_id', '4055'); //Idham
        $this->db->or_where('sso_id', '2700'); //Benyamin
        $this->db->or_where('sso_id', '3'); //Lifromi
        $this->db->or_where('sso_id', '4025'); //Muharso
        $this->db->or_where('sso_id', '644'); //Edy siahaan
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllProjectManager()
    {
        $this->db->select('*');
        $this->db->from('pm_user');
        $this->db->where('sso_id', '2233');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllPersonInCharge()
    {
        $this->db->select('*');
        $this->db->from('pm_user');
        $this->db->where('sso_id', '2233');
        $this->db->or_where('sso_id', '2288');
        $this->db->or_where('sso_id', '2700');
        $this->db->or_where('sso_id', '3306');
        $this->db->or_where('sso_id', '2383');
        $this->db->or_where('sso_id', '3214');
        $this->db->or_where('sso_id', '1793');
        $this->db->or_where('sso_id', '2245');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllOpenIssueRegister()
    {
        $this->db->select('*');
        $this->db->from('pm_issue_risk_register');
        $this->db->where('status', 'OPEN');
        $query = $this->db->get();
        return $query->result();
    }

    public function countAttachment($id){
        $this->db->select('count(file_attachment) as attc');
        $this->db->from('pm_issue_follow_up');
        $this->db->where('issue_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function sendEmailOpenIssueRegister($user_id,$employee_id, $level)
    {
        //TODO: Get All Open Issue Register
        $this->db->select('a.*,b.project_name');
        $this->db->from('pm_issue_risk_register a');
        $this->db->join('pm_projects b','a.projects_id=b.id','inner');
        $this->db->where('status', 'OPEN');

        if($level=='GM'){
            //$this->db->where('status', 'OPEN');
        }

        if($level=='PM'){
            //$this->db->where('status', 'OPEN');
            $this->db->where('pm_id', $user_id);
        }

        if($level=='PIC'){
            //$this->db->where('status', 'OPEN');
            $this->db->where('pic_id', $user_id);
        }

        // For project PTT
        if($employee_id=='2880' || $employee_id=='3238' || $employee_id=='2130' || $employee_id=='3727' || $employee_id=='1332' || $employee_id=='2233' || $employee_id=='1588' || $employee_id=='3633' || $employee_id=='1793' || $employee_id=='2383' || $employee_id=='4055' || $employee_id=='2700' || $employee_id=='3' || $employee_id=='4025' || $employee_id=='644'){
            $this->db->where('projects_id', '16');
        }

        $query = $this->db->get();
        $issue_reg = $query->result();

        // Get Data API HRIS for employee
        $json1 = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employee/id/' . $employee_id);
        $obj1 = json_decode($json1);

        $emp_email = $obj1->email;
        $emp_name  = $obj1->fullname;

        $openissue = '';
        if (isset($issue_reg)) {
            $i=1;
            foreach ($issue_reg as $row) {
                $raised_date = '';
                if($row->raised_date!=''){
                    $raised_date = date('d-M-Y',strtotime($row->raised_date));
                }

                $target_to_close = '';
                if($row->target_to_close!=''){
                    $target_to_close = date('d-M-Y',strtotime($row->target_to_close));
                }

                $aging = 0;
                if($raised_date!=''){  //$raised_date!='' && $target_to_close!=''
                    $raise_date = strtotime($row->raised_date);
                    //$due_date = strtotime($row->target_to_close);
                    $now_date = strtotime("now");
                    $datediff = $now_date - $raise_date;
                    $aging =  round($datediff / (60 * 60 * 24));
                }

                //TODO: Get User PIC
                $this->db->select('*');
                $this->db->from('pm_user');
                $this->db->where('user_id', $row->pic_id);
                $query_user = $this->db->get();
                $pic = $query_user->row();

                if(isset($pic->fullname) && !empty($pic->fullname)){
                    $pic_name = $pic->fullname;
                }else{
                    $pic_name = 'N/A';
                }

                $data_pic = "";
                if($level=='PM'){
                    $data_pic = "<td align='left' style='font-size: 11px; padding: 0.3em 0.5em;'>" . $pic_name . " </td>";
                }

                $openissue .= "<tr>
                                <td align='left' style='font-size: 11px; padding: 0.3em 0.5em;'>" . $i . "</td>
                                <td align='left' style='font-size: 11px; padding: 0.3em 0.5em;'>" . $row->issue_no . "</td>
                                <td align='left' style='font-size: 11px; padding: 0.3em 0.5em;'>" . $row->project_name . "</td>
                                <td align='left' style='font-size: 11px; padding: 0.3em 0.5em;'>" . $row->project_scope . "</td>
                                <td align='left' style='font-size: 11px; padding: 0.3em 0.5em;'>" . $row->issue_risk . "</td>
                                <td align='left' style='font-size: 11px; padding: 0.3em 0.5em;'>" . $raised_date . "</td>
                                <td align='left' style='font-size: 11px; padding: 0.3em 0.5em;'>" . $target_to_close . "</td>
                                <td align='left' style='font-size: 11px; padding: 0.3em 0.5em;'>" . $aging . " Days </td>
                                <td align='left' style='font-size: 11px; padding: 0.3em 0.5em;'>" . $row->potential_impact . " </td>
                                " . $data_pic . "
                                </tr>";
                $i++;
            }
        }

        $total = $i - 1;

        $column_pic = "";
        if($level=='PM'){
            $column_pic = "<td align='left' style='background-color: #e7ebf2; color: #3b5998; font-size: 11px; font-weight: bold; padding: 0.3em 0.5em;'>PIC</td>";
        }

        if($total!=0)
        {
            //TODO: Send Email-----------------------To:Direct Supervisor Employee-----------------------------
            require_once("assets/source/PHPMailer_v5.1/class.phpmailer.php");
            $mail = new PHPMailer();

            $bodyplain = "<html>
                    <head>
                    <title></title>
                    </head>
                    <body>
                    <DIV style=\"font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px;color:#003366;\">Dear " . $emp_name . ",<br/><br/></DIV>
                    <DIV>
                    <DIV style=\"font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px;color:#003366;\">
                    Berikut ini adalah issue yang masih open dalam area Anda,<br/><br/>
                    <b>Total Open Issue : " . $total . "</b>
                    <br/><br/>
                    </DIV>
                    <table cellpadding='5' style='font-family: Verdana,sans-serif; font-size: 11px; color: rgb(55, 73, 83); width: 100%;'>
                        <tbody>
                        <tr>
                        <td align='left' style='background-color: #e7ebf2; color: #3b5998; font-size: 11px; font-weight: bold; padding: 0.3em 0.5em;'>No.</td>
                        <td align='left' style='background-color: #e7ebf2; color: #3b5998; font-size: 11px; font-weight: bold; padding: 0.3em 0.5em;'>Nomor Issue</td>
                        <td align='left' style='background-color: #e7ebf2; color: #3b5998; font-size: 11px; font-weight: bold; padding: 0.3em 0.5em;'>Project Name</td>
                        <td align='left' style='background-color: #e7ebf2; color: #3b5998; font-size: 11px; font-weight: bold; padding: 0.3em 0.5em;'>Project Scope</td>
                        <td align='left' style='background-color: #e7ebf2; color: #3b5998; font-size: 11px; font-weight: bold; padding: 0.3em 0.5em;'>Issue Description</td>
                        <td align='left' style='background-color: #e7ebf2; color: #3b5998; font-size: 11px; font-weight: bold; padding: 0.3em 0.5em;'>Raise Date</td>
                        <td align='left' style='background-color: #e7ebf2; color: #3b5998; font-size: 11px; font-weight: bold; padding: 0.3em 0.5em;'>Due Date</td>
                        <td align='left' style='background-color: #e7ebf2; color: #3b5998; font-size: 11px; font-weight: bold; padding: 0.3em 0.5em;'>Aging</td>
                        <td align='left' style='background-color: #e7ebf2; color: #3b5998; font-size: 11px; font-weight: bold; padding: 0.3em 0.5em;'>Level of Attention</td>
                        " . $column_pic . "
                        </tr>
                        " . $openissue . "
                        </tbody>
                        </table><br/><br/>

                        <DIV style=\"font-family:Verdana, Arial, Helvetica, sans-serif;font-size:11px;color:#003366;\">
                        Mohon agar melakukan follow up terhadap issue tersebut diatas. Status follow up issue register ini dapat Anda lakukan pada:<br/>
                        Application Project: <a href='http://project.apps.moratelindo.co.id/index.php/issueRisk' target='_blank'><b>http://project.apps.moratelindo.co.id/</b></a><br/>

                        <br/><br/>
                        <br/>
                        </DIV>

                        <table cellpadding='5' style='font-family: Verdana,sans-serif; font-size: 11px; color: rgb(55, 73, 83); width: 100%;'>
                                            <tbody>
                                            ";

            $bodyplain .= "	<tr>
                                <td colspan='4' align='center' style='font-size: 10px; border-top: 1px solid rgb(217, 218, 222);'>
                                    <a target='_blank' style='color: rgb(219, 52, 132); font-weight: bold; text-decoration: none;' href='http://project.apps.moratelindo.co.id'></a> Reported by <a target='_blank' style='text-decoration: none; color: rgb(55, 73, 83);' href='http://project.apps.moratelindo.co.id'><b>Project Management Application</b>.</a>
                                </td>
                            </tr>
                            </tbody></table>";

            $bodyplain .= "\r\n" . "\r\n";
            $bodyplain .= "\r\n" . "\r\n";
            $bodyplain .= "\r\n" . "\r\n";


            $mail->IsSMTP();
            $mail->Host = "relay.moratelindo.co.id";  // sets the SMTP server
            $mail->Port = "587";                      // set the SMTP port for the  server 465 or 587

            $mail->SetFrom('issue@moratelindo.co.id', "Project Management Application");
            $mail->AddAddress($emp_email, $emp_name); // to Emmployee
            //$mail->AddAddress('rury.amsar@moratelindo.co.id', 'Rury Amsar');
            //$mail->AddAddress('braputra.aditya@moratelindo.co.id', 'Braputra Aditya');
            //$mail->AddCC($emp_email, $obj->fullname); // to Emmployee
            //$mail->AddAttachment("assets/Form Pengalaman Diri_AC MTI.doc");

            $body = $bodyplain;
            $bodytext = $bodyplain;

            $mail->Subject = "Open Issue Register";

            $mail->IsHTML(true);
            $mail->Body = $body;
            $mail->AltBody = $bodytext;

            if (!$mail->Send()) {
                echo "Message could not be sent. ";
                echo "Mailer Error: " . $mail->ErrorInfo;
                exit;
            } else {
                echo "Sent  ";
            }

            $mail->ClearAddresses();
            $mail->Body = "";
            $mail->AltBody = "";

            sleep(0.1);
        }

        return true;
    }

    public function getSmsInboxIssueRegister()
    {
        //TODO: Load database oxygen
        $DBSMSOXYGEN = $this->load->database('smsoxygen', TRUE);

        $query = $DBSMSOXYGEN->query("SELECT * FROM inbox WHERE RecipientID='' AND (TextDecoded LIKE 'INPUT%' OR TextDecoded LIKE 'UPDATE%' OR TextDecoded LIKE 'CLOSE%') ORDER BY UpdatedInDB DESC");
        return $query->result();
    }

    public function saveSmsIssueRisk($UpdatedInDB,$ReceivingDateTime,$SenderNumber,$TextDecoded,$ID)
    {
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        //sms: INPUT P1#SC2#CAT3#ISSUE-Dihadang warga tidak bisa masuk#PM9#PIC7#IMPACT-Pekerjaan terhambat.
        //sms: UPDATE 170401-01-0096#FOLLOWUP-Warga Sepakat memberikan akses setelah negosiasi.
        //sms: CLOSE 170401-01-0096#CLOSE-Warga Sepakat memberikan akses setelah negosiasi.
        $sms_text = explode('#', $TextDecoded);

        $action = strtoupper(substr($TextDecoded, 0, 5));
        if($action=='INPUT')
        {
            $project_id = ltrim(strtoupper($sms_text[0]),'INPUT P');
            $project_scope = ltrim(strtoupper($sms_text[1]),'SC');
            $category = ltrim(strtoupper($sms_text[2]),'CAT');
            $issue_risk = $sms_text[3];
            $pm = ltrim(strtoupper($sms_text[4]),'PM');
            $pic = ltrim(strtoupper($sms_text[5]),'PIC');
            $potential_impact = $sms_text[6];

            // issue no
            $issue_no = $this->generateIssueId($project_id);

            // category
            $cat = $this->getIssueCategoryById($category);
            $type_of_issue_risk = $cat->issue_category;

            // project scope
            $scope = $this->getProjectScopeById($project_scope);
            $project_scope = $scope->project_scope;

            // save issue risk register
            $data = array(
                'projects_id' => $project_id,
                'issue_no' => $issue_no,
                'issue_risk' => $issue_risk,
                'type_of_issue_risk' => $type_of_issue_risk,
                'raised_date' => date('Y-m-d', strtotime($ReceivingDateTime)),
                'project_scope' => $project_scope,
                'pm_id' => $pm,
                'pic_id' => $pic,
                'target_to_close' => null,
                'status' => 'OPEN',
                'potential_impact' => $potential_impact,
                'issue_or_risk' => 'issue',
                'issue_only' => '',
                'risk_only_probability' => '',
                'risk_only_impact' => '',
                'risk_only_significance' => '',
                'current_response' => '',
                'current_response_date' => null,
                'further_action' => '',
                'further_action_date' => null,
                'file_attachment' => '',
                'remark' => 'sms from: ' . $SenderNumber,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => $pic,
            );

            $this->db->insert('pm_issue_risk_register', $data);


            //TODO: Load database sms oxygen
            $DBSMSOXYGEN = $this->load->database('smsoxygen', TRUE);

            //TODO: Update to SMS inbox table
            $data_sms_inbox = array(
                'RecipientID' => 'project'
            );

            $DBSMSOXYGEN->where('ID', $ID);
            $DBSMSOXYGEN->update('inbox', $data_sms_inbox);


            //TODO: Save to SMS outbox table
            $data_sms_reply = array(
                'DestinationNumber' => $SenderNumber,
                'TextDecoded' => 'Input Issue Register Anda telah berhasil tersimpan dengan Nomor Issue: ' . $issue_no,
                'CreatorID' => 'IssueRegister'
            );

            $DBSMSOXYGEN->insert('outbox', $data_sms_reply);

        }
        elseif($action=='UPDAT')
        {
            $issue_no = ltrim(strtoupper($sms_text[0]),'UPDATE ');
            $followup = ltrim($sms_text[1],'');

            // issue no
            $issue = $this->getIssueRiskRegisterByIssueNo($issue_no);
            $issue_id = $issue->id;

            // save issue follow up
            $data = array(
                'issue_id' => $issue_id,
                'follow_up_date' => date('Y-m-d', strtotime($ReceivingDateTime)),
                'follow_up_description' => $followup,
                'file_attachment' => null,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => null,
            );

            $this->db->insert('pm_issue_follow_up', $data);


            //TODO: Load database sms oxygen
            $DBSMSOXYGEN = $this->load->database('smsoxygen', TRUE);

            //TODO: Update to SMS inbox table
            $data_sms_inbox = array(
                'RecipientID' => 'project'
            );

            $DBSMSOXYGEN->where('ID', $ID);
            $DBSMSOXYGEN->update('inbox', $data_sms_inbox);


            //TODO: Save to SMS outbox table
            $data_sms_reply = array(
                'DestinationNumber' => $SenderNumber,
                'TextDecoded' => 'Update Issue Register: ' . $issue_no . ' Anda telah berhasil tersimpan.',
                'CreatorID' => 'IssueRegister'
            );

            $DBSMSOXYGEN->insert('outbox', $data_sms_reply);
        }
        else
        {
            $issue_no = ltrim(strtoupper($sms_text[0]),'CLOSE ');
            $closing_desc = ltrim($sms_text[1],'');

            // issue no
            $issue = $this->getIssueRiskRegisterByIssueNo($issue_no);
            $issue_id = $issue->id;

            // save issue follow up
            $data = array(
                'status' => 'CLOSE',
                'closing_date' => date('Y-m-d', strtotime($ReceivingDateTime)),
                'closing_description' => $closing_desc,
            );

            $this->db->where('id', $issue_id);
            $this->db->update('pm_issue_risk_register', $data);


            //TODO: Load database sms oxygen
            $DBSMSOXYGEN = $this->load->database('smsoxygen', TRUE);

            //TODO: Update to SMS inbox table
            $data_sms_inbox = array(
                'RecipientID' => 'project'
            );

            $DBSMSOXYGEN->where('ID', $ID);
            $DBSMSOXYGEN->update('inbox', $data_sms_inbox);


            //TODO: Save to SMS outbox table
            $data_sms_reply = array(
                'DestinationNumber' => $SenderNumber,
                'TextDecoded' => 'Issue Register: ' . $issue_no . ' telah berhasil Anda closing.',
                'CreatorID' => 'IssueRegister'
            );

            $DBSMSOXYGEN->insert('outbox', $data_sms_reply);
        }

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }

        return true;
    }

    private function _get_datatable_issue_categories_query()
    {
        $column_select = array("id","issue_category");
        $column_search = array("id","issue_category");
        $column_order = array("id","issue_category");
        $this->db->select($column_select);
        $this->db->from('pm_issue_categories a');
        $i = 0;
        foreach ($column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
            }
            $i++;
        }

        // if(isset($_POST['order'])) // here order processing
        // {
        //     $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        // }

        // $this->db->order_by('user_id','ASC');

    }

    function get_datatable_issue_categories()
    {
        $this->_get_datatable_issue_categories_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_issue_categories()
    {
        $this->_get_datatable_issue_categories_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_issue_categories()
    {
        $this->db->from("pm_issue_categories");
        return $this->db->count_all_results();
    }



    private function _get_datatable_project_scopes_query()
    {
        $column_select = array("id","project_scope");
        $column_search = array("id","project_scope");
        $column_order = array("id","project_scope");
        $this->db->select($column_select);
        $this->db->from('pm_project_scope');
        $i = 0;
        foreach ($column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }

        // $this->db->order_by('user_id','ASC');

    }

    function get_datatable_project_scopes()
    {
        $this->_get_datatable_project_scopes_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_project_scopes()
    {
        $this->_get_datatable_project_scopes_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_project_scopes()
    {
        $this->db->from("pm_project_scope");
        return $this->db->count_all_results();
    }

}