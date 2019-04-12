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

    public function getPlan2(){
        $user = $this->apps->info();
        $input = $this->input->post();
        if(!isset($input['pc_id'])){
            if($user['userRole'][2] > 3){
                $input['pc_id'] = $user['userRole'][2];
            } else {
                $input['pc_id'] = 0;
            }

        }
        $start = date('Y-m-d', strtotime($this->input->post('start')));
        $end = date('Y-m-d', strtotime($this->input->post('end')));
        $waspang = $this->get_field_inspector($input['project_id'], $input['pc_id']);
        $a = array(
            'project_id' => $this->input->post('project_id'),
            'start' => $start,
            'end' => $end
        );
        $act = array();
        #TO DO : get waspang
        foreach ($waspang as $i => $v) {
            $a['user_id'] = $v->user_id;
            #TO DO : get planning by waspang
            $ep = $this->get_planning_person($a);
            $e = array();
            if(!empty($ep)){
                foreach ($ep as $key => $value) {
                    #TO DO : get activity per planning
                    $x = $this->getActivity($value->daily_plan_id);
                    if(isset($e[$value->plan_date])){
                        $e[$value->plan_date]['plan'] = $value;
                    } else {
                        $e[$value->plan_date]['plan'] = $value;
                    }
                    #TO DO : group activity by date
                    if(!empty($x)){
                        foreach ($x as $k => $g) {
                            $e[$value->plan_date]['activity'][] = $g;
                        }  
                    }
                }
            }
            #TO DO : insert empty array for no activity date
            foreach ($e as $p => $plan) {
                if(!isset($plan['activity'])){
                    $e[$p]['activity'] = array();
                }
            }
            $waspang[$i]->progress = $e;
        }
        return $waspang;
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
        return $usersArea;
    }


    public function get_field_inspector($project_id, $pc_id){
        $this->db->select("a.*, e.fullname, GROUP_CONCAT(d.location, '') AS loc");
        $this->db->from('pm_user_approval a');
        $this->db->join('pm_resource_allocation b', 'a.user_id = b.user_id');
        $this->db->join('pm_resource_location c', 'b.id = c.resource_allocation_id','left');
        $this->db->join('pm_work_location d', 'd.location_id = c.area_id','left');
        $this->db->join('pm_user e', 'a.user_id = e.user_id','left');
        if($pc_id != 0){
            $this->db->where('parent_id', $pc_id);
        }
        $this->db->where('project_id', $project_id);
        $this->db->where('inactive_date is null');
        $this->db->group_by('b.user_id');
        $query = $this->db->get();
        return $query->result();
    }


    public function load_weekly_plan2(){
        $project_id = $this->input->post('project_id');
        $pc_id = $this->input->post('pc_id');
        $start  = date('Y-m-d', strtotime($this->input->post('start')));
        $end    = date('Y-m-d', strtotime($this->input->post('end')));
        $waspang = $this->get_field_inspector($project_id, $pc_id);
        $a = array(
            // 'user_id' => $value->user_id,
            'project_id' => $this->input->post('project_id'),
            'start' => $start,
            'end' => $end
        );

        foreach ($waspang as $i => $v) {
            $a['user_id'] = $v->user_id;
            $ep = $this->get_planning_person($a);
            $e = array();
            if(!empty($ep)){
                foreach ($ep as $key => $value) {
                    if(isset($e[$value->plan_date])){
                        $e[$value->plan_date][] = $value;
                    } else {
                        $e[$value->plan_date][] = $value;
                    }
                }
                
            }

            $waspang[$i]->existing_plan = $e;
        }

        return $waspang;
    }

    public function load_weekly_plan(){
        $project_id = $this->input->post('project_id');
        $pc_id = $this->input->post('pc_id');
        $user = $this->apps->info();
        if(empty($pc_id)){
            $pc_id = $user['userRole'][2];
        }

        // $pc_id = $this->input->post('pc_id');
        $start  = date('Y-m-d', strtotime($this->input->post('start')));
        $end    = date('Y-m-d', strtotime($this->input->post('end')));
        $waspang = $this->get_field_inspector($project_id, $pc_id);
        $a = array(
            // 'user_id' => $value->user_id,
            'project_id' => $this->input->post('project_id'),
            'start' => $start,
            'end' => $end
        );

        foreach ($waspang as $i => $v) {
            $a['user_id'] = $v->user_id;
            $ep = $this->get_planning_person2($a);
            $e = array();
            if(!empty($ep)){
                foreach ($ep as $key => $value) {
                    if(isset($e[$value->plan_date])){
                        $e[$value->plan_date][] = $value;
                    } else {
                        $e[$value->plan_date][] = $value;
                    }
                }
                
            }

            $waspang[$i]->existing_plan = $e;
        }

        return $waspang;
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
        // var_dump($plans); exit();
        return $plans;
    }

    public function get_planning_person2($param){
        $this->db->select('a.*, b.plan_date,b.work_in,b.work_out,d.segment_name, e.span_hh_start, e.span_hh_end');
        $this->db->from('pm_daily_parameter_progress a');
        $this->db->join('pm_daily_activity_plan b', 'a.plan_id = b.daily_plan_id');
        $this->db->join('pm_daily_assign_plan c', 'b.daily_plan_id = c.daily_plan_id');
        $this->db->join('pm_project_segment d', 'a.segment_id = d.id');
        $this->db->join('pm_project_segment_span e', 'a.span_id = e.id');
        $this->db->where('c.user_id', $param['user_id']);
        $this->db->where('b.project_id',$param['project_id']);
        $this->db->where('plan_date >=', $param['start']);
        $this->db->where('plan_date <=', $param['end']);
        $this->db->order_by('plan_date','asc');
        $query = $this->db->get();
        $plans = $query->result();

        return $plans;
    }

    public function get_span_and_param($id){
        $this->db->select('a.*, b.segment_name, c.span_hh_start, c.span_hh_end');
        $this->db->from('pm_daily_parameter_progress a');
        $this->db->join('pm_project_segment b', 'a.segment_id = b.id');
        $this->db->join('pm_project_segment_span c', 'a.span_id = c.id');
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

    public function getUOM(){
        $this->db->select('*');
        $this->db->from('pm_milestone_uom');
        $query = $this->db->get();
        return $query->result();
    }


    public function save_weekly_plan(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
        */
        $this->db->trans_begin();
        $param = array(
            'user_id' => $this->input->post('plan_user_id'),
            'project_id' => $this->input->post('plan_project_id'),
            'start' => date('Y-m-d', strtotime($this->input->post('plan_start_date'))),
            'end' => date('Y-m-d', strtotime($this->input->post('plan_end_date'))),
        );
        $plans = $this->input->post('plan');
        // var_dump($plans); exit();
        $existing_plan = $this->get_planning_person($param);
        $ep = array();
        if(!empty($existing_plan)){
            foreach ($existing_plan as $key => $value) {
                $ep[] = $value->daily_plan_id;
            }
        }
        $exisiting_parameter = $this->get_planning_person2($param);
        $e_param = array();
        if(!empty($exisiting_parameter)){
            foreach ($exisiting_parameter as $key => $value) {
                $e_param[] = $value->id;
            }
        }
        $params = array();
        $daily_plan_id = array();
        $plan_per_date = array();
        $parameter_ids = array();

        foreach ($plans as $k => $val) {
            $params[] = $val['parameter'];
            if(isset($val['time'])){
                $plan_per_date[$val['date']]['work_time'] = $val['time'];
            }
            if(isset($val['plan_id'])){
                $plan_per_date[$val['date']]['plan_id'] = $val['plan_id'];
            }

            if(!isset($plan_per_date[$val['date']])){
                $plan_per_date[$val['date']]['plan'][] = $val;
            } else {
                $plan_per_date[$val['date']]['plan'][] = $val;
            }
            
        }
        $param = implode(",", $params);
        foreach ($plan_per_date as $idx => $data) {
            $g = $data['work_time'];
            $g = explode("-", $g);
            $work_in = date('Y-m-d H:i:s', strtotime($g[0]));
            $work_out = date('Y-m-d H:i:s', strtotime($g[1]));
            $time1 = strtotime($work_in);
            $time2 = strtotime($work_out);
            $total_hours = round(abs($time2 - $time1) / 3600,2);

            $plan = array(
                'project_id' => $this->input->post('plan_project_id'),
                'pc_id' => $this->input->post('plan_pc_id'),
                'plan_date' => $idx,
                'area' => $this->input->post('plan_location'),
                'work_in' => $work_in,
                'work_out' => $work_out,
                'total_hours' => $total_hours,
                'parameter' => $param,
            );

            if(isset($data['plan_id'])){
                $daily_plan_id[] = $data['plan_id'];
                $plan_id = $data['plan_id'];
                $this->db->where('daily_plan_id', $data['plan_id']);
                $this->db->update('pm_daily_activity_plan', $plan);
            } else {
                $this->db->insert('pm_daily_activity_plan', $plan);
                $plan_id = $this->db->insert_id();

                $assign = array(
                    'user_id' => $this->input->post('plan_user_id'),
                    'daily_plan_id' => $plan_id
                );
                $this->db->insert('pm_daily_assign_plan', $assign);
            }

            foreach ($data['plan'] as $g => $b) {
                $prog = array(
                    'plan_id' => $plan_id,
                    'segment_id' => $b['segmen'],
                    'span_id' =>$b['span'],
                    'parameter_id' =>$b['parameter'],
                    'parameter_name' =>$b['param_name'],
                    'target' => $b['target'],
                    'uom' => $b['uom']
                );
                if(isset($b['parameter_id'])){
                    $parameter_ids[] = $b['parameter_id'];
                    $this->db->where('id', $b['parameter_id']);
                    $this->db->update('pm_daily_parameter_progress', $prog);
                } else {
                    $this->db->insert('pm_daily_parameter_progress', $prog);
                }
            }

        }

        if(!empty($parameter_ids)){
            $deleted = array_diff($e_param, $parameter_ids);
            foreach ($deleted as $key => $value) {
                $this->db->where('id', $value);
                $this->db->delete('pm_daily_parameter_progress');
            }
        }

        if(!empty($daily_plan_id)){
            $deleted = array_diff($ep, $daily_plan_id);
            foreach ($deleted as $key => $value) {
                $this->db->where('daily_plan_id', $value);
                $this->db->delete('pm_daily_activity_plan');
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

    public function get_parameter_name($id){
        $this->db->select('*');
        $this->db->from('pm_daily_parameter');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function approveActivity(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
        */
        $this->db->trans_begin();

        $p = $this->input->post('ids');
        $plan_ids = explode(",", $p);

        $activity_status = $this->input->post('status');

        foreach ($plan_ids as $key => $id) {
            $status = array(
                'status_activity' => $activity_status, 
                'activity_approval_date' => date('Y-m-d H:i:s'), 
                'reason' => $this->input->post('reason')
            );
            $this->db->where('daily_plan_id', $id);
            $this->db->update('pm_daily_activity_plan', $status);
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


}
