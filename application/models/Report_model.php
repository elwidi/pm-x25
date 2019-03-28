
<?php

class Report_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getMileStone($id){
        $this->db->select('a.id as pm_id, a.milestone_grup_id, a.uom, a.qty, a.daily_baseline, b.*');
        $this->db->from('pm_project_milestone a');
        $this->db->join('pm_milestone_definition b','a.milestone_id = b.id');
        $this->db->where('project_id',$id);
        $query = $this->db->get();
        $ret = $query->result();
        $c = $this->getMileStoneGrup($id);
        $a = array();

        foreach ($ret as $key => $value) {
            // var_dump($value->pm_id); exit();
            $value->progress = $this->getProgress($value->pm_id);
            foreach ($c as $k => $v) {
                if($value->milestone_grup_id == $v->id){
                    $c[$k]->mil[] = $value;
                }
            }
        }

        return $c;
    }

    public function getMileStoneGrup($id){
        $this->db->select(' b.*');
        $this->db->from('pm_project_milestone a');
        $this->db->join('pm_milestone_group b','a.milestone_grup_id = b.id');
        $this->db->where('project_id',$id);
        $this->db->group_by('b.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function getProjects()
    {
        $query = $this->db->query('SELECT id, project_id, project_name, start_date, end_date, capacity, customer, completion, baseline FROM pm_projects WHERE status ="On Progress" ORDER BY -project_id DESC');
        $projects =  $query->result();

        foreach ($projects as $key => $value) {
            $p = $this->getMileStone($value->id);
            $projects[$key]->milestone = $p;
            $f = $this->getThisMonthPlanning($value->id);

            if(empty($f)){
                $e = array(
                    'plan' => 0,
                    'actual' => 0
                );
            } else {
                $e = array(
                    'plan' => $f->plan,
                    'actual' => $f->actual
                );
            }

            $projects[$key]->progress = $e;
        }
        // var_dump($projects);
         // exit();

        return $projects;
    }

    public function getProgress($id){
        $this->db->select('*');
        $this->db->from('pm_daily_progress');
        $this->db->where('project_milestone_id', $id);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row();

    }   

    public function project_detail($id){
        $this->db->select('*');
        $this->db->from('pm_projects');
        $this->db->where('id', $id);
        $q = $this->db->get();

        return $q->row();
    }

    public function getChartValues(){
        $project_id = $this->input->post('project_id');

        $project_detail = $this->project_detail($project_id);

        $this->db->select('*');
        $this->db->from('pm_project_chart');
        if(!empty($project_id)){
            $this->db->where('project_id', $project_id);
        }
        $this->db->where('month IS NOT NULL');
        if(!empty($project_detail->start_date)){
            $this->db->where('date >=', $project_detail->start_date);
        }
        if(!empty($project_detail->end_date)){
            $this->db->where('date <=', $project_detail->end_date);
        }
       /* $this->db->where('date >=', $project_detail->start_date);
        $this->db->where('date <=', $project_detail->end_date);*/
        $this->db->order_by('date', 'asc');
        $query = $this->db->get();
        $charts = $query->result();
        $f = array();
        foreach ($charts as $key => $value) {
            if(!isset($f[$value->project_id])){
                $f[$value->project_id][] = $value;
            } else {
                $f[$value->project_id][] = $value;
            }
        }
        $ch = array();
        foreach ($f as $key => $value) {
            $ch['plan'][] = 'Baseline';
            $ch['actual'][] = 'Actual';
            $ch['cum_baseline'][] = 'Cum. Baseline';
            $ch['cum_actual'][] = 'Cum. Actual';
            foreach ($value as $i => $d) {
                $ch['date'][] = $d->month;
                $ch['plan'][] = $d->plan;
                $ch['actual'][] = $d->actual;
                if(count($ch['cum_baseline']) == 1){
                    $ch['cum_baseline'][] = $d->plan;
                } else {
                    $ch['cum_baseline'][] = end($ch['cum_baseline'])+$d->plan;
                }

                if(count($ch['cum_actual']) == 1){
                    $ch['cum_actual'][] = $d->actual;
                } else {
                    if(!empty($d->actual)){
                        $ch['cum_actual'][] = end($ch['cum_actual'])+$d->actual;
                    }
                }
            }
            
        }

        return $ch;

    }

    public function getChartValues2(){
        $project_id = $this->input->post('project_id');
        
        
        $this->db->select('a.*');
        $this->db->from('pm_project_chart a');
        $this->db->join('pm_projects b', 'a.project_id = b.id');
        if(!empty($project_id)){
            $this->db->where('a.project_id', $project_id);
        }
        $this->db->where('a.date >= b.start_date');
        $this->db->where('a.date <= b.end_date');
        $this->db->where('month IS NOT NULL');
        $query = $this->db->get();
        $charts = $query->result();
        $f = array();
        foreach ($charts as $key => $value) {
            // var_dump($value); exit();
            if(!isset($f[$value->project_id])){
                $f[$value->project_id][] = $value;
            } else {
                $f[$value->project_id][] = $value;
            }
        }
        $ch = array();
        foreach ($f as $key => $value) {
            $ch[$key]['plan'][] = 'Baseline';
            $ch[$key]['actual'][] = 'Actual';
            // $ch[$key]['cum_baseline'][] = 'Cum. Baseline';
            // $ch[$key]['cum_actual'][] = 'Cum. Actual';
            foreach ($value as $i => $d) {
                // var_dump($value); exit();
                $ch[$key]['date'][] = $d->month;
                $ch[$key]['plan'][] = $d->plan;
                $ch[$key]['actual'][] = $d->actual;
                /*if(count($ch[$key]['cum_baseline']) == 1){
                    $ch[$key]['cum_baseline'][] = $d->plan;
                } else {
                    $ch[$key]['cum_baseline'][] = end($ch[$key]['cum_baseline'])+$d->plan;
                }

                if(count($ch[$key]['cum_actual']) == 1){
                    $ch[$key]['cum_actual'][] = $d->actual;
                } else {
                    if(!empty($d->actual)){
                        $ch['cum_actual'][] = end($ch['cum_actual'])+$d->actual;
                    }
                    // $ch[$key]['cum_actual'][] = end($ch[$key]['cum_actual'])+$d->actual;
                }*/
            }
            
        }

        return $ch;

    }

    public function daily_progress_chart(){
        $project_id = $this->input->post('project_id');
        $p_detail = $this->project_detail($project_id);

        $this->db->select('a.*');
        $this->db->from('pm_project_chart a');
        $this->db->join('pm_projects b', 'a.project_id = b.id');
        $this->db->where('a.project_id', $project_id);
        $this->db->where('a.date >= b.start_date');
        $this->db->where('a.date <= b.end_date');
       /* if(!empty($p_detail->start_date)){
            $this->db->where('date >=', $p_detail->start_date);
        }
        if(!empty($p_detail->end_date)){
            $this->db->where('date <=', $p_detail->end_date);
        }*/
        $this->db->where('month IS NOT NULL');
        $q = $this->db->get();

        $mly = $q->result();

        $ch = array();

        if(!empty($mly)){
            $ch['plan'][] = 'Baseline';
            $ch['actual'][] = 'Actual';
            $ch['d_actual'][] = 'Daily';
        }

        foreach ($mly as $i => $d) {
            $daily_actual = $this->get_daily_actual($d->id);
            $ch['date'][] = $d->date;
            $ch['plan'][] = $d->plan;
            // $ch['actual'][] = $d->actual;

            if(!empty($daily_actual)){
                foreach ($daily_actual as $k => $v) {
                    $ch['date2'][] = $v->date;
                    $ch['d_actual'][] = $v->actual;
                }
            } else {
                $ch['date2'][] = $d->date;
                $ch['d_actual'][] = $d->actual;
            }
            
        }

        return $ch;
    }

    public function get_daily_actual($plan_id){
        $this->db->select('*');
        $this->db->from('pm_project_chart_detail');
        $this->db->where('plan_id', $plan_id);
        $q = $this->db->get();

        return $q->result();
    }

    public function getCableScope($milestone_id, $project_id){
        $this->db->select('id, qty');
        $this->db->from('pm_project_milestone');
        $this->db->where('milestone_id', $milestone_id);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $cab =  $query->result();
        $s = array();
        $s['scope'] = "-";
        $s['actual'] = 0;
        foreach ($cab as $key => $value) {
            $this->db->select('complete_qty');
            $this->db->from('pm_daily_progress');
            $this->db->where('project_milestone_id', $value->id);
            $this->db->order_by('id', 'desc');
            $this->db->limit(1);
            $e = $this->db->get();
            $km =  $e->row();
            $s['scope'] = number_format($value->qty);
            if(!empty($km)){
                $s['actual'] = number_format($km->complete_qty);
            }

        }
        return $s;
    }

    public function getThisMonthPlanning($project_id){
        $this->db->select('*');
        $this->db->from('pm_project_chart');
        $this->db->where('project_id', $project_id);
        $this->db->where('month', date('M'));
        $this->db->where('year', date('Y'));

        $query = $this->db->get();

        return $query->row();
    }

    public function daily_progress_charts(){
        $this->db->select('a.*');
        $this->db->from('pm_project_chart a');
        $this->db->join('pm_projects b','a.project_id = b.id');
        $this->db->where('a.date >= b.start_date');
        $this->db->where('a.date <= b.end_date');
        $this->db->where('month IS NOT NULL');
        $q = $this->db->get();
        $projects = $q->result();

        $f = array();

        foreach ($projects as $key => $value) {
             if(!isset($f[$value->project_id])){
                $f[$value->project_id][] = $value;
            } else {
                $f[$value->project_id][] = $value;
            }
        }

        foreach ($f as $k => $v) {
            $ch[$k]['plan'][] = 'Plan';
            $ch[$k]['d_actual'][] = 'Actual';

            foreach ($v as $i => $d) {
                $daily_actual = $this->get_daily_actual($d->id);
                $ch[$k]['date'][] = $d->date;
                $ch[$k]['plan'][] = $d->plan;

                if(!empty($daily_actual)){
                    foreach ($daily_actual as $idx => $val) {
                        $ch[$k]['date2'][] = $val->date;
                        $ch[$k]['d_actual'][] = $val->actual;
                    }
                } else {
                    $ch[$k]['date2'][] = $d->date;
                    $ch[$k]['d_actual'][] = $d->actual;
                }
                
            }
        }

        return $ch;
    }

} 
