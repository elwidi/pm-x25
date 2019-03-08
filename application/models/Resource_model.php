
<?php

class Resource_model extends CI_Model {

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

    public function getResourceDetail($id){
        $this->db->select('a.*, b.fullname');
        $this->db->from('pm_resources a');
        $this->db->join('pm_user b','a.user_id = b.user_id');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        $user = $query->row();
        return $user;
    }

    public function getAllResource()
    {
        $this->db->select('a.*');
        $this->db->from('pm_user a');
        // $this->db->join('pm_user b','a.user_id = b.user_id');
        $query = $this->db->get();
        $user = $query->result();
        return $user;
    }

    public function getAllResource2()
    {
        $this->db->select('a.*, b.fullname');
        $this->db->from('pm_resources a');
        $this->db->join('pm_user b','a.user_id = b.user_id');
        $query = $this->db->get();
        $user = $query->result();
        return $user;
    }

    public function saveNewResource(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $projectIds = $this->input->post('project');


        $data = array(
            'user_id' => $this->input->post('name'),
            'title' => $this->input->post('title'),
            'join_date' => date("Y-m-d",strtotime($this->input->post('join_date'))),
            'work_location' => $this->input->post('work_location'),
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->setUserId()
        );
        $this->db->insert('pm_resources', $data);
        $resource_id = $this->db->insert_id();

        foreach($projectIds as $value){
            $data = array(
                'user_id' => $this->input->post('name'),
                'resource_id' => $resource_id,
                'project_id' => $value,
            );
            $this->db->insert('pm_resource_allocation', $data);
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

    public function saveAllocateResource(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();
        // var_dump($this->input->post(null, true)); exit();
        // $employee_id = $this->setUserId();

        $data = array(
            'resource_id' => $this->input->post('resource_id'),
            'project_id' => $this->input->post('project_id')
        );
        $this->db->insert('pm_resource_allocation', $data);

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

    public function updateResource($id){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();
        // var_dump($this->input->post(null, true)); exit();
        // $employee_id = $this->setUserId();

        $data = array(
            'user_id' => $this->input->post('user_id'),
            'title' => $this->input->post('title'),
            'join_date' => date("Y-m-d",strtotime($this->input->post('join_date'))),
            'work_location' => $this->input->post('work_location'),
        );
        $this->db->where('id', $id);
        $this->db->update('pm_resources', $data);

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

    private function _get_datatable_resource_query()
    {
        $column_select = array("a.*", "b.fullname", "c.position_title");
        $column_search = array("b.fullname", "c.position_title", "a.work_location");
        $column_order = array("b.fullname", "c.position_title", "a.work_location");
        $this->db->select($column_select);
        $this->db->from('pm_resources a');
        $this->db->join('pm_user b', 'a.user_id = b.user_id');
        $this->db->join('pm_resource_position c', 'c.id = a.res_position_id');

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

    function get_datatable_resource()
    {
        $this->_get_datatable_resource_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_resource()
    {
        $this->_get_datatable_resource_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_resource()
    {
        $this->db->from("pm_resources");
        return $this->db->count_all_results();
    }


    private function _get_datatable_resource_allocate_query()
    {
        $column_select = array("a.*", "c.fullname","e.project_name");
//        $column_search = array("b.fullname", "a.title","a.work_location");
//        $column_order = array("b.fullname", "a.title","a.join_date","a.work_location");
        $this->db->select($column_select);
        $this->db->from('pm_resource_allocation a');
        $this->db->join('pm_resources b', 'b.id = a.resource_id');
        $this->db->join('pm_user c', 'b.user_id = c.user_id');
        $this->db->join('pm_projects e', 'e.id = a.project_id');

        $i = 0;
        /*foreach ($column_search as $item) // loop column
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
        }*/

    }

    function get_datatable_resource_allocate()
    {
        $this->_get_datatable_resource_allocate_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_resource_allocate()
    {
        $this->_get_datatable_resource_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_resource_allocate()
    {
        $this->db->from("pm_resources");
        return $this->db->count_all_results();
    }


    function getResourceProject($id) {
        $this->db->select('a.*, b.*');
        $this->db->from('pm_resource_allocation a');
        $this->db->join('pm_projects b','a.project_id = b.id');
        $this->db->where('a.user_id', $id);
        $query = $this->db->get();
        $project = $query->result();
        $res['project'] = $project;
        $res['count'] = count($project);
        $completion_total = 0;

        foreach ($project as $key => $data){
            $completion_total += $data->completion;
        }
        if($res['count'] == 0){
            $res['availbility'] =  0;
        } else {
            $res['availbility'] = $completion_total/$res['count'];
        }
        $res['os_work'] = number_format(100-$res['availbility'], 2, ',', ' ');
        return $res;
    }

    public function getPositionResource(){
        $this->db->select('id, role_name');
        $this->db->from('pm_role');
        $this->db->where('id <> 1');
        $query = $this->db->get();
        $role = $query->result();

        $max_project = 0;
        foreach ($role as $key => $r){
            $role_code = str_replace(" ","_",strtolower($r->role_name));
            $role[$key]->code = $role_code;
            $this->db->select('user_id, fullname');
            $this->db->from('pm_user');
            $this->db->where('role_id <>1');
            $this->db->where('role_id', $r->id);

            $query = $this->db->get();
            $resource = $query->result();
            foreach($resource as $i => $res) {
                $completion_total = 0;
                $this->db->select('b.project_name, b.completion, b.id');
                $this->db->from('pm_resource_allocation a');
                $this->db->join('pm_projects b','a.project_id = b.id');
                $this->db->where('user_id', $res->user_id);
                $query = $this->db->get();
                $project = $query->result();

                foreach ($project as $c => $p){
                    $completion_total += $p->completion;
                }
                $count = count($project);
                if ($i == 0){
                    $max_project = $count;
                } else {
                    if($max_project < $count){
                        $max_project = $count;
                    } else {
                        $max_project = $max_project;
                    }
                }
                if($count == 0){
                    $resource[$i]->availbility = round($completion_total/1,2);
                } else {
                    $resource[$i]->availbility = round($completion_total/$count,2);
                }
                $resource[$i]->os_work = round(100-$resource[$i]->availbility,2);
                $resource[$i]->total_project = $count;
                $resource[$i]->project = $project;
            }

            $role[$key]->max_project = $max_project;
            $role[$key]->resource = $resource;
        }
        return $role;
    }

    public function getResAllocation($user_id)
    {
        $this->db->select('project_id');
        $this->db->from('pm_resource_allocation a');
        $this->db->where('a.user_id',$user_id);
        $query = $this->db->get();
        $a = array();
        foreach ($query->result() as $key => $value) {
            $a[] = $value->project_id;
        }
        return $a;
    }

    public function saveResource2(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $ex = $this->getProjectPosition($this->input->post('project_id'), $this->input->post('position_id'));
        $userIds = $this->input->post('user_id');
        $exIds = array();
        if(!empty($ex)){
            foreach ($ex as $key => $value) {
                $exIds[] = $value->user_id;
            }

            $added = array_diff($userIds, $exIds);
            $deleted = array_diff($exIds, $userIds);

            $area = $this->input->post('area');
            if(!empty($area)){
                $area = implode(",", $area);
            }

            if(!empty($added)){
                foreach ($added as $k => $v) {
                    $data = array(
                        'user_id' => $v,
                        'project_id' => $this->input->post('project_id'),
                        'position_id' => $this->input->post('position_id'),
                        'area_id' => $area,
                        'join_date_to_project' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('pm_resource_allocation', $data);
                }

            }

            if(!empty($deleted)){
                foreach ($deleted as $i => $d) {
                    $data = array('inactive_date' => date('Y-m-d'));
                    $this->db->where('project_id', $this->input->post('project_id'));
                    $this->db->where('position_id', $this->input->post('position_id'));
                    $this->db->where('user_id', $d);
                    $this->db->update('pm_resource_allocation',$data);
                }
            }
        } else {
            foreach ($userIds as $key => $value) {
                $data = array(
                    'user_id' => $value,
                    'project_id' => $this->input->post('project_id'),
                    'position_id' => $this->input->post('position_id'),
                    'area' => $this->input->post('area'),
                    'join_date_to_project' => date('Y-m-d H:i:s')
                );
                $this->db->insert('pm_resource_allocation', $data); 
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

    public function saveResource(){

        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();
        $area = $this->input->post('area');
        $users = $this->input->post('user_id');

        foreach ($users as $key => $value) {
            $data = array(
                'user_id' => $value,
                'project_id' => $this->input->post('project_id'),
                'position_id' => $this->input->post('position_id'),
                'area_id' => $area_id,
                'area' => $area_name,
                'join_date_to_project' => date('Y-m-d')
            );

            $this->db->insert('pm_resource_allocation', $data);
            $allocation_id = $this->db->insert_id();


            if(!empty($area)){
                foreach ($area as $key => $value) {
                    $data = array(
                        'resource_allocation_id' => $allocation_id,
                        'area_id' => $value
                    );
                    $this->db->insert('pm_resource_location', $data);
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

    public function getProjectPosition($project_id, $position_id){
        $this->db->select('*');
        $this->db->from('pm_resource_allocation');
        $this->db->where('project_id', $project_id);
        $this->db->where('position_id', $position_id);
        $this->db->where('inactive_date is null');
        $query = $this->db->get();
        return $query->result();
    }

    private function _get_datatable_resource_allocation_query($id)
    {
        $column_select = array("a.*", "c.position_title", "b.fullname", "GROUP_CONCAT(e.location, '') AS loc");
        $column_search = array("b.fullname","c.position_title");
        $column_order = array("b.fullname", "c.position_title", "a.join_date_to_project");
        $this->db->select($column_select);
        $this->db->from('pm_resource_allocation a');
        $this->db->join('pm_user b', 'a.user_id = b.user_id');
        $this->db->join('pm_resource_position c', 'a.position_id = c.id');
        $this->db->join('pm_resource_location d', 'd.resource_allocation_id = a.id','left');
        $this->db->join('pm_work_location e', 'e.location_id = d.area_id','left');
        $this->db->where('project_id', $id);
        $this->db->where('inactive_date is null');
        $i = 0;
        $condition = '(';
        foreach ($column_search as $item) // loop column
        {
            if($_POST['search']['value']) {
                if($i===0) // first loop
                {
                    $condition .= $item." LIKE '%".$_POST['search']['value']."%' ESCAPE '!'";
                }
                else
                {
                    $condition .= " OR ".$item." LIKE '%".$_POST['search']['value']."%' ESCAPE '!'";
                }
                $i++;
            
            }
        }

        if($_POST['search']['value']){
            $condition .= " OR loc LIKE '%".$_POST['search']['value']."%' ESCAPE '!'";
            $condition .= ")";
            $this->db->having($condition);
        }

        $this->db->group_by('a.id');

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }

    }
    function get_datatable_resource_allocation($id)
    {
        $this->_get_datatable_resource_allocation_query($id);
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_resource_allocation($id)
    {
        $this->_get_datatable_resource_allocation_query($id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_resource_allocation($id)
    {
        $this->db->from("pm_resource_allocation");
        $this->db->where('project_id', $id);
        $this->db->where('inactive_date is null');
        return $this->db->count_all_results();
    }

    public function resource_allocate_detail($id){
        $this->db->select("a.*, b.*, GROUP_CONCAT(c.area_id, '') AS loc");
        $this->db->from('pm_resource_allocation a');
        $this->db->join('pm_user b','a.user_id = b.user_id');
        $this->db->join('pm_resource_location c', 'a.id = c.resource_allocation_id');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_person_position($role){
        $this->db->select('*');
        $this->db->from('pm_user');
        $this->db->where('role_id',$role);
        $query = $this->db->get();

        return $query->result();
    }

    public function getResLoc($id){
        $this->db->select('*');
        $this->db->from('pm_resource_location');
        $this->db->where('resource_allocation_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function updateAllocation(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $resource_id = $this->input->post('resource_id');
        $area = $this->input->post('resource_area');

        $data = array(
            'position_id' => $this->input->post('resource_position'),
            'join_date_to_project' => date('Y-m-d', strtotime($this->input->post('resource_join_date')))
        );

        $ex = $this->getResLoc($this->input->post('project_id'), $this->input->post('position_id'));
        $userIds = $this->input->post('user_id');
        $exIds = array();
        if(!empty($ex)){
            foreach ($ex as $key => $value) {
                $exIds[] = $value->user_id;
            }

            $added = array_diff($userIds, $exIds);
            $deleted = array_diff($exIds, $userIds);

            $area = $this->input->post('area');
            if(!empty($area)){
                $area = implode(",", $area);
            }

            if(!empty($added)){
                foreach ($added as $k => $v) {
                    $data = array(
                        'user_id' => $v,
                        'project_id' => $this->input->post('project_id'),
                        'position_id' => $this->input->post('position_id'),
                        'area_id' => $area,
                        'join_date_to_project' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('pm_resource_allocation', $data);
                }

            }

            if(!empty($deleted)){
                foreach ($deleted as $i => $d) {
                    $data = array('inactive_date' => date('Y-m-d'));
                    $this->db->where('project_id', $this->input->post('project_id'));
                    $this->db->where('position_id', $this->input->post('position_id'));
                    $this->db->where('user_id', $d);
                    $this->db->update('pm_resource_allocation',$data);
                }
            }
        } else {
            foreach ($userIds as $key => $value) {
                $data = array(
                    'user_id' => $value,
                    'project_id' => $this->input->post('project_id'),
                    'position_id' => $this->input->post('position_id'),
                    'area' => $this->input->post('area'),
                    'join_date_to_project' => date('Y-m-d H:i:s')
                );
                $this->db->insert('pm_resource_allocation', $data); 
            }
        }


        $this->db->where('id', $resource_id);
        $this->db->update('pm_resource_allocation',$data);


        foreach ($ex as $key => $value) {
                $exIds[] = $value->user_id;
            }

            $added = array_diff($userIds, $exIds);
            $deleted = array_diff($exIds, $userIds);

            $area = $this->input->post('area');
            if(!empty($area)){
                $area = implode(",", $area);
            }

            if(!empty($added)){
                foreach ($added as $k => $v) {
                    $data = array(
                        'user_id' => $v,
                        'project_id' => $this->input->post('project_id'),
                        'position_id' => $this->input->post('position_id'),
                        'area_id' => $area,
                        'join_date_to_project' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('pm_resource_allocation', $data);
                }

            }

            if(!empty($deleted)){
                foreach ($deleted as $i => $d) {
                    $data = array('inactive_date' => date('Y-m-d'));
                    $this->db->where('project_id', $this->input->post('project_id'));
                    $this->db->where('position_id', $this->input->post('position_id'));
                    $this->db->where('user_id', $d);
                    $this->db->update('pm_resource_allocation',$data);
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

    public function deactiveResource($id){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $data = array(
            'inactive_date' => date('Y-m-d')
        );

        $this->db->where('id', $id);
        $this->db->update('pm_resource_allocation',$data);

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