<?php

class Timesheet_model extends CI_Model {

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

    public function savePlan(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
        */
        $this->db->trans_begin();

        $parameter = $this->input->post('param');
        $user_id = $this->setUserId();


        if(!empty($parameter)){
            $str_param = implode(",", array_keys($parameter));
        } else {
            $str_param = "";
        }

        $p = $this->input->post('p');
        foreach ($p as $index => $area) {
            $index = str_replace("_", " ", $index);
            foreach ($area as $key => $pl) {
                foreach ($pl['planning'] as $key => $x) {
                    if(!empty($x['desc'])){
                        if(isset($x['id'])){
                            $plan = array(
                                'parameter' => $str_param,
                                'plan' =>$x['desc']
                            );

                            $this->db->where('daily_plan_id', $x['id']);
                            $this->db->update('pm_daily_activity_plan', $plan);
                        } else {
                            $plan = array(
                                'project_id' =>$this->input->post('project'),
                                'pc_id' => $this->input->post('coordinator_id'),
                                'plan_date' => date('Y-m-d', strtotime($x['date'])),
                                'plan' =>$x['desc'],
                                'area' => strtoupper($index),
                                'parameter' => $str_param,
                                'created_by' => $user_id,
                                'created_date' => date('Y-m-d H:i:s')
                            );

                            $this->db->insert('pm_daily_activity_plan', $plan);
                            $plan_id = $this->db->insert_id();

                            $assign = array(
                                'user_id' => $x['user_id'],
                                'daily_plan_id' => $plan_id
                            );
                            $this->db->insert('pm_daily_assign_plan', $assign);
                        }
                    }
                }
            }
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

    public function save_plan(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
        */
        $this->db->trans_begin();
        // var_dump($this->input->post()); exit();
        $parameter = $this->input->post('param');
        if(!empty($parameter)){
            $str_param = implode(",", array_keys($parameter));
        } else {
            $str_param = "";
        }
        $user_id = $this->setUserId();
        $planning = $this->input->post('p');
        foreach ($planning as $key => $value) {
            foreach ($value as $i => $p) {
                foreach ($p as $d => $f) {
                    if(!empty($f['plan'])){
                        $g = $f['work_hours'];
                        $g = explode("-", $g);
                        $work_in = date('Y-m-d H:i:s', strtotime($g[0]));
                        $work_out = date('Y-m-d H:i:s', strtotime($g[1]));

                        $time1 = strtotime($work_in);
                        $time2 = strtotime($work_out);
                        $total_hours = round(abs($time2 - $time1) / 3600,2);


                        $plan = array(
                            'project_id' =>$this->input->post('project'),
                            'pc_id' => $this->input->post('coordinator_id'),
                            'plan_date' => date('Y-m-d', strtotime($f['date'])),
                            'plan' =>$f['plan'],
                            'vendor_id' =>$f['vendor'],
                            'area' => strtoupper($key),
                            'work_in' => $work_in,
                            'work_out' => $work_out,
                            'total_hours' => $total_hours,
                            'parameter' => $str_param,
                            'created_by' => $user_id,
                            'created_date' => date('Y-m-d H:i:s')
                        );

                        // var_dump($plan); exit();
                        
                        $this->db->insert('pm_daily_activity_plan', $plan);
                        $plan_id = $this->db->insert_id();

                        $assign = array(
                            'user_id' => $f['id'],
                            'daily_plan_id' => $plan_id
                        );
                        $this->db->insert('pm_daily_assign_plan', $assign);

                        foreach ($f['prog'] as $e => $l) {
                            foreach ($l as $d => $b) {
                                if(!empty($b['target']) && !empty($b['uom'])){
                                    $prog = array(
                                        'plan_id' => $plan_id,
                                        'segment_id' => $b['segmen'],
                                        'span_id' =>$b['span'],
                                        'parameter_id' =>$b['parameter_id'],
                                        'parameter_name' =>$b['parameter_name'],
                                        'target' => $b['target'],
                                        'uom' => $b['uom']
                                    );
                                    $this->db->insert('pm_daily_parameter_progress', $prog);
                                }
                            }
                        }
                    }
                    
                }
            }
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

    public function getPlan(){
        $pc_id = $this->input->post('pc_id');
        $project_id = $this->input->post('project_id');
        $start = date('Y-m-d', strtotime($this->input->post('start')));
        $end = date('Y-m-d', strtotime($this->input->post('end')));
        $area =$this->input->post('area');

        $this->db->select('a.*, b.user_id, c.fullname as assigned');
        $this->db->from('pm_daily_activity_plan a');
        $this->db->join('pm_daily_assign_plan b', 'a.daily_plan_id = b.daily_plan_id');
        $this->db->join('pm_user c', 'b.user_id = c.user_id');
        $this->db->where('plan_date >=', $start);
        $this->db->where('plan_date <=', $end);
        if(!empty($pc_id)){
            $this->db->where('pc_id', $pc_id);
        }
        if(!empty($project_id)){
            $this->db->where('project_id', $project_id);
        }
        if(!empty($area)){
            $this->db->where_in('area', $area);
        }
        $query = $this->db->get();
        $plans = $query->result();

        $areaPlan = array();
        
        foreach ($plans as $key => $value) {
            $plans[$key]->plandate = date('d M Y', strtotime($value->plan_date));
            $plans[$key]->activity = $this->getActivity($value->daily_plan_id);
            $plans[$key]->parameter = $this->getPlanParameter($value->daily_plan_id);

            if(!isset($areaPlan[$value->area][$value->user_id])){
                $areaPlan[$value->area][$value->user_id][] = $value;
            } else {
                $areaPlan[$value->area][$value->user_id][] = $value;
            }
        }

        return $areaPlan;
    }

    public function getPlanParameter($id){
        $this->db->select('*');
        $this->db->from('pm_daily_parameter_progress');
        $this->db->where('plan_id', $id);
        $query = $this->db->get();
        $params = $query->result();
        return $params;
    }

    public function getActivity($id){
        $this->db->select('*');
        $this->db->from('pm_daily_activity');
        $this->db->where('daily_plan_id', $id);
        $query = $this->db->get();
        $acts = $query->result();
        foreach ($acts as $key => $value) {
            $acts[$key]->capture_hour = date("h:i ", strtotime($value->capture_date));
        }
        return $acts;
    }


    public function userChild($userId){
        $this->db->select('*');
        $this->db->from('pm_user_approval a');
        $this->db->join('pm_user b','a.user_id = b.user_id');
        $this->db->where('parent_id', $userId);
        $query = $this->db->get();
        $users = $query->result();
        return $users;
    }

    public function userChildbyArea($userId, $area){
        $this->db->select('*');
        $this->db->from('pm_user_approval a');
        $this->db->join('pm_user b','a.user_id = b.user_id');
        $this->db->where('parent_id', $userId);
        $this->db->where_in('work_location', $area);
        $query = $this->db->get();
        $users = $query->result();
        return $users;
    }

    public function userChildArea(){
        $userId = $this->input->post('pc_id');
        $users = $this->userChild($userId);
        $start = date('Y-m-d', strtotime($this->input->post('start')));
        $end = date('Y-m-d', strtotime($this->input->post('end')));

        $usersArea = array();
        
        foreach ($users as $key => $value) {
            if(!isset($usersArea[$value->work_location][$value->user_id])){
                $a = array(
                    'user_id' => $value->user_id,
                    'project_id' => $this->input->post('project'),
                    'start' => $start,
                    'end' => $end
                );
                $value->existing_plan = $this->getPlanning($a);
                $usersArea[$value->work_location][] = $value;
            } else {
                $usersArea[$value->work_location][] = $value;
            }
        }
        // var_dump($usersArea); exit();
        return $usersArea;
    }


    public function get_field_inspector($project_id, $pc_id){
        $this->db->select("a.*, e.fullname, GROUP_CONCAT(d.location, '') AS loc");
        $this->db->from('pm_user_approval a');
        $this->db->join('pm_resource_allocation b', 'a.user_id = b.user_id');
        $this->db->join('pm_resource_location c', 'b.id = c.resource_allocation_id','left');
        $this->db->join('pm_work_location d', 'd.location_id = c.area_id','left');
        $this->db->join('pm_user e', 'a.user_id = e.user_id','left');
        $this->db->where('parent_id', $pc_id);
        $this->db->where('project_id', $project_id);
        $this->db->where('inactive_date is null');
        $this->db->group_by('b.user_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function user_team_area(){
        $userId = $this->input->post('pc');
        $areaId = $this->input->post('area');
        $users  = $this->userChildbyArea($userId, $areaId);
        $start  = date('Y-m-d', strtotime($this->input->post('start')));
        $end    = date('Y-m-d', strtotime($this->input->post('end')));

        $usersArea = array();

        foreach ($users as $key => $value) {
            if(!isset($usersArea[$value->work_location][$value->user_id])){
                $a = array(
                    'user_id' => $value->user_id,
                    'project_id' => $this->input->post('project_id'),
                    'start' => $start,
                    'end' => $end
                );
                $value->existing_plan = $this->get_planning_person($a);
                $usersArea[$value->work_location][] = $value;
            } else {
                $usersArea[$value->work_location][] = $value;
            }
        }
        return $usersArea;
    }

    public function getPlanning($param){
        $this->db->select('a.*, b.*');
        $this->db->from('pm_daily_assign_plan a');
        $this->db->join('pm_daily_activity_plan b', 'a.daily_plan_id = b.daily_plan_id');
        $this->db->where('a.user_id', $param['user_id']);
        $this->db->where('project_id',$param['project_id']);
        $this->db->where('plan_date >=', $param['start']);
        $this->db->where('plan_date <=', $param['end']);
        $query = $this->db->get();
        $plans = $query->result();

        foreach ($plans as $key => $value) {
            $plans[$key]->parameter = explode(",", $value->parameter);
        }
        return $plans;
    }

    public function get_planning_person($param){
        $this->db->select('a.*, b.*');
        $this->db->from('pm_daily_assign_plan a');
        $this->db->join('pm_daily_activity_plan b', 'a.daily_plan_id = b.daily_plan_id');
        $this->db->where('a.user_id', $param['user_id']);
        $this->db->where('project_id',$param['project_id']);
        $this->db->where('plan_date >=', $param['start']);
        $this->db->where('plan_date <=', $param['end']);
        $query = $this->db->get();
        $plans = $query->result();

        foreach ($plans as $key => $value) {
            $plans[$key]->parameter = explode(",", $value->parameter);
            $plans[$key]->parameter_detail = $this->get_span_and_param($value->daily_plan_id);
        }
        return $plans;
    }

    public function get_span_and_param($id){
        $this->db->select('*');
        $this->db->from('pm_daily_parameter_progress');
        $this->db->where('plan_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getParameter(){
        $this->db->select('a.*, b.group_name');
        $this->db->from('pm_daily_parameter a');
        $this->db->join('pm_milestone_group b', 'a.ms_group_id = b.id', 'left');
        $query = $this->db->get();
        $p = $query->result();

        $e = array();
        foreach ($p as $key => $value) {
            if(isset($e[$value->group_name])){
                $e[$value->group_name][] = $value;
            } else {
                $e[$value->group_name][] = $value;
            }
        }

        return $e;
    }
}
