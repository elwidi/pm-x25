
<?php

class Implementation_model extends CI_Model {

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

    public function userId(){
        $sso_id = $this->setUserId();
        $this->db->select('user_id');
        $this->db->from('pm_user');
        $this->db->where('sso_id', $sso_id);
        $query = $this->db->get();
        $q = $query->row();
        return $q->user_id;
    }

    public function projectMilestone($id_project){
        $userId2 = $this->userId();
        $userId = "|".$this->userId()."|";
        $this->db->select('a.*, b.milestone_name, c.group_name, d.baseline, d.completion, d.id as pr_id');
        $this->db->from('pm_project_milestone a');
        $this->db->join('pm_milestone_definition b','a.milestone_id = b.id');
        $this->db->join('pm_milestone_group c', 'a.milestone_grup_id = c.id');
        $this->db->join('pm_projects d', 'a.project_id = d.id');
        $this->db->where('a.project_id', $id_project);
        // $this->db->where('d.pic_id', $userId);
        $this->db->like('d.pic_id', $userId2);
        $query = $this->db->get();
        return $query->result();
    }


    public function milestoneByGroup(){
        $id_project = $this->input->post('project');
        $pic = $this->setUserId();
        $milestones = $this->projectMilestone($id_project);
        $byGroup = array();
        foreach ($milestones as $key => $value) {
            $value->qty = number_format($value->qty);
            $value->daily_baseline = number_format($value->daily_baseline);
            $value->ms_value = $this->getMsVal($value->id);
            if(!isset($byGroup[$value->group_name])){
                $byGroup[$value->group_name][] = $value;
            } else {
                $byGroup[$value->group_name][] = $value;
            }
        }
        return $byGroup;
    }

    public function getMsVal($ms_id){
        $pic_id = $this->userId();
        $this->db->select('complete_qty, complete_percent, remark');
        $this->db->from('pm_daily_progress');
        $this->db->where('project_milestone_id', $ms_id);
        // $this->db->where('pic_id', $pic_id);
        // $this->db->where('pic_id', $pic_id);
        $this->db->order_by('id','desc');
        $this->db->limit('1');
        $query = $this->db->get();
        return $query->row();
    }

    public function getChartValue(){
        $project_id = $this->input->post('project_id');
        $this->db->select('id,plan, actual, DATE_FORMAT(date, "%d-%m-%Y") AS added_date');
        $this->db->from('pm_project_chart');
        $this->db->where('project_id', $project_id);
        // $this->db->order_by('id','desc');
        // $this->db->limit('1');
        $query = $this->db->get();
        return $query->result();
    }

    public function getPlanId($id){
        $this->db->select('id');
        $this->db->from('pm_project_chart');
        $this->db->where('project_id', $this->input->post('project_id'));
        $this->db->where('month', date('M'));
        $this->db->where('year', date('Y'));
        $query = $this->db->get();
        return $query->row();
    }

    public function saveDailyProgress(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();
        $milestones = $this->input->post('milestone');
        $charts = $this->input->post('chart');

        $project_id = $this->input->post('project_id');

        $plan_id = $this->getPlanId($this->input->post('project_id'));

        foreach ($milestones as $key => $value) {
            if(empty($value['percent'])){
                if(!isset($value['prev_percent'])) $value['prev_percent'] = 0;
                $value['percent'] = $value['prev_percent'];
            }

            if(empty($value['qty'])){
                if(!isset($value['prev_qty'])) $value['prev_qty'] = 0;
                $value['qty'] = $value['prev_qty'];
            }
            $data = array(
                'pic_id' => $this->userId(),
                'project_milestone_id' => $value['id'],
                'complete_qty' => $value['qty'],
                'complete_percent' => $value['percent'],
                'remark' => $this->input->post('remark'),
                'created_date' => date('Y:m:d H:i:s'),
                'created_by' => $this->setUserId()
            );

            $this->db->insert('pm_daily_progress', $data);
        }

        /*foreach ($charts as $k => $v) {
            if(!empty($v['plan']) && !empty($v['actual'])){
                if(isset($v['id'])){
                    if(empty($v['plan'])){
                        $v['plan'] = $v['prev_plan'];
                    }
                    if(empty($v['actual'])){
                        $v['actual'] = $v['prev_actual'];
                    }
                    $d = array(
                        'plan' => $v['plan'],
                        'actual' => $v['actual']
                    );

                    $this->db->where('id', $v['id']);
                    $this->db->update('pm_project_chart', $d);
                } else{
                    $d = array(
                        'project_id' => $this->input->post('project_id'),
                        'date' => date('Y-m-d',strtotime($v['date'])),
                        'plan' => $v['plan'],
                        'actual' => $v['actual'],
                        'created_date' => date('Y-m-d H:i:s')
                    );

                    $this->db->insert('pm_project_chart', $d);
                }  
            }
            
        }*/

        $d = array(
            'baseline' => $this->input->post('baseline'),
            'completion' => $this->input->post('completion')
        );

        $this->db->where('id', $this->input->post('project_id'));
        $this->db->update('pm_projects', $d);


        $actual = array(
            'actual' => $this->input->post('completion')
        );

        $this->db->where('project_id', $this->input->post('project_id'));
        $this->db->where('month', date('M'));
        $this->db->where('year', date('Y'));
        $this->db->update('pm_project_chart', $actual);

        $actual_detail = array(
            'project_id' => $this->input->post('project_id'),
            'actual' => $this->input->post('completion'),
            'date' => date('Y-m-d'),
            'created_date' => date('Y-m-d H:i:s')
        );
        if(empty($plan_id)){
            $this->db->where('project_id', $project_id);
        } else {
            $actual_detail['plan_id'] = $plan_id->id;
            $this->db->where('plan_id', $plan_id->id);
        }
        $this->db->where('date', date('Y-m-d'));
        $this->db->update('pm_project_chart_detail', $actual_detail);
        $affected_row = $this->db->affected_rows();
        if($affected_row == 0){
            $this->db->insert('pm_project_chart_detail', $actual_detail);
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

    public function saveDailyProgress2(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();
        $milestones = $this->input->post('milestone');
        $charts = $this->input->post('chart');

        $plan_id = $this->getPlanId($this->input->post('project_id'));

        foreach ($milestones as $key => $value) {
            if(empty($value['percent'])){
                if(!isset($value['prev_percent'])) $value['prev_percent'] = 0;
                $value['percent'] = $value['prev_percent'];
            }

            if(empty($value['qty'])){
                if(!isset($value['prev_qty'])) $value['prev_qty'] = 0;
                $value['qty'] = $value['prev_qty'];
            }
            $data = array(
                'pic_id' => $this->userId(),
                'project_milestone_id' => $value['id'],
                'complete_qty' => $value['qty'],
                'complete_percent' => $value['percent'],
                'remark' => $this->input->post('remark'),
                'created_date' => date('Y:m:d H:i:s'),
                'created_by' => $this->setUserId()
            );

            $this->db->insert('pm_daily_progress', $data);
        }

        /*foreach ($charts as $k => $v) {
            if(!empty($v['plan']) && !empty($v['actual'])){
                if(isset($v['id'])){
                    if(empty($v['plan'])){
                        $v['plan'] = $v['prev_plan'];
                    }
                    if(empty($v['actual'])){
                        $v['actual'] = $v['prev_actual'];
                    }
                    $d = array(
                        'plan' => $v['plan'],
                        'actual' => $v['actual']
                    );

                    $this->db->where('id', $v['id']);
                    $this->db->update('pm_project_chart', $d);
                } else{
                    $d = array(
                        'project_id' => $this->input->post('project_id'),
                        'date' => date('Y-m-d',strtotime($v['date'])),
                        'plan' => $v['plan'],
                        'actual' => $v['actual'],
                        'created_date' => date('Y-m-d H:i:s')
                    );

                    $this->db->insert('pm_project_chart', $d);
                }  
            }
            
        }*/

        $d = array(
            'baseline' => $this->input->post('baseline'),
            'completion' => $this->input->post('completion')
        );

        $this->db->where('id', $this->input->post('project_id'));
        $this->db->update('pm_projects', $d);


        $actual = array(
            'actual' => $this->input->post('completion')
        );

        $this->db->where('project_id', $this->input->post('project_id'));
        $this->db->where('month', date('M'));
        $this->db->where('year', date('Y'));
        $this->db->update('pm_project_chart', $actual);

        $actual_detail = array(
            'plan_id' => $plan_id->id,
            'actual' => $this->input->post('completion'),
            'date' => date('Y-m-d'),
            'created_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('pm_project_chart_detail', $actual_detail);

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


    private function _get_datatable_rules_query()
    {
        $column_search = $column_order = array("role_name", "name", "description", "point");
        $this->db->select('*');
        $this->db->from('pm_daily_activity_role_info');

        $i = 0;
        foreach ($column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }

    }

    function get_datatable_rules()
    {
        $this->_get_datatable_rules_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_rules()
    {
        $this->_get_datatable_rules_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_rules()
    {
        $this->db->from("pm_daily_activity_role_info");
        return $this->db->count_all_results();
    }

    public function getRuleDetail($id){
        $this->db->select('*');
        $this->db->from('pm_daily_activity_role_info');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }


    public function saveRule(){
        // var_dump($this->input->post()); exit();
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $data = array(
            'role_name' => $this->input->post('rule_code'),
            'name' => $this->input->post('rule_name'),
            'description' =>$this->input->post('rule_description'),
            'point' => $this->input->post('rule_point')
        );

        $this->db->where('id', $this->input->post('rule_id'));
        $this->db->update('pm_daily_activity_role_info', $data);

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

    private function _get_datatable_progress_tracking_query()
    {
        $roles = $this->apps->info();
        $role = $roles['userRole'][0];

        $column_select = array("a.*", "GROUP_CONCAT(c.fullname, '') AS pm_name");
        $column_search = array("project_name", "customer","scope");
        // $column_order = array("b.fullname", "a.title","a.join_date","a.work_location");
        $this->db->select($column_select);
        $this->db->from('pm_projects a');
        $this->db->join('pm_resource_allocation b', 'a.id = b.project_id AND b.position_id = 3','left');
        $this->db->join('pm_user c','b.user_id = c.user_id','left');

        if ($role !== 1) {
            if($roles['allProject'] == 'false'){
                $projectIds = "";
                if(!empty($roles['projects'])){
                     foreach ($roles['projects'] as $i => $v){
                        $projectIds .= $v->id.",";
                    }
                    $projectIds = "a.id IN (".substr($projectIds,0,-1).")";
                    $this->db->where($projectIds);
                } else {
                    $this->db->like('a.pic_id', "|".$roles['userRole'][2]."|");
                }
               
            }
        }
        $i = 0;
        $condition = '(';
        if($_POST['columns'][6]['search']['value']){
            $status = $_POST['columns'][6]['search']['value'];
            if($status == 'On Progress'){
                $this->db->where('a.status', 'On Progress');
            }

            if($status == 'Complete'){
                $this->db->where('a.status', 'Completed');
            }

            if($status == 'Cancel'){
                $this->db->where('a.status', 'Cancel');
            }

            if($status == 'Early Stage'){
                $this->db->where('a.status', 'Early Stage');
            }
        }


        $i = 0;
        foreach ($column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
            }
            $i++;
        }

        $this->db->group_by('a.project_id');

        $this->db->order_by('project_id', 'DESC');
        $this->db->order_by('status', 'DESC');

        /*if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }*/

    }

    function get_datatable_progress_tracking()
    {
        $this->_get_datatable_progress_tracking_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_progress_tracking()
    {
        $this->_get_datatable_progress_tracking_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_progress_tracking()
    {
        $this->db->from("pm_projects");
        return $this->db->count_all_results();
    }
} 
