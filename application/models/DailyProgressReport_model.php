<?php

class Report_model extends CI_Model {

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

    public function getProjectDetailById($id)
    {
        $this->db->select('*');
        $this->db->from('pm_projects');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getUserId($ssoId)
    {
        $this->db->select('*');
        $this->db->from('pm_user');
        $this->db->where('sso_id',$ssoId);
        $query = $this->db->get();
        return $query->row();
    }

    public function getAllProject()
    {
        /*$this->db->select('*');
        $this->db->from('pm_projects');
        $this->db->order_by('-project_id','desc');
        $query = $this->db->get();
        return $query->result();*/
        $data = $this->db->query("SELECT * FROM pm_projects ORDER BY -project_id DESC");
        $res  = $data->result();
        return $res;
    }

    public function getAllProjectByUser()
    {
        $user = $this->getUserId($this->setUserId());
        $user_id = $user->user_id;
        $this->db->select('b.id, project_name, created_date');
        $this->db->from('pm_resource_allocation a');
        $this->db->join('pm_projects b','a.project_id = b.id');
        $this->db->where('a.user_id',$user_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getProjects()
    {
        $query = $this->db->query('SELECT * FROM pm_projects ORDER BY -project_id DESC');
        return $query->result();
    }

    public function getTaskByProjectId($id)
    {
        $this->db->select('*');
        $this->db->from('pm_tasks');
        $this->db->where('projects_id', $id);
        $this->db->where('parent_id', NULL);
        $this->db->order_by('task_list_id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

//    public function getTaskByProjectId($id)
//    {
//        $this->db->select('*');
//        $this->db->from('pm_tasks');
//        $this->db->where('projects_id', $id);
//        $query = $this->db->get();
//        return $query->result();
//    }

    public function getAllChildren($id){
        $this->db->select('*');
        $this->db->from('pm_tasks');
        $this->db->where('parent_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getTaskDetail($id){
        $this->db->select('*');
        $this->db->from('pm_tasks');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function deleteTask($id){
        $this->db->delete('pm_tasks', array('id' => $id));
        return true;
    }

    public function getAllSubtask($taskId){
        $allSubTask = array();

        $this->db->select('*');
        $this->db->from('pm_tasks');
        $this->db->where('parent_id', $taskId);
        $query = $this->db->get();
        $sub_task =  $query->result();
        $g = array();
        if(!empty($sub_task)){
            foreach($sub_task as $key => $value){
                $parent_id = $value->id;
                $s = array();
                $s['id'] = $value->id;
                $s['title'] = $value->tasks_name;
                $s['key'] = $key+1;
                $subtask2 = $this->getAllSubtask($parent_id);
                if(!empty($subtask2)){
                    $s['expanded'] = true;
                    foreach ($subtask2 as $index => $f) {
                        $item['id'] = $f['id'];
                        $item['title'] = $f['title'];
                        $item['key'] = $key+1;
                        if(isset($f['children'])){
                            $item['children'] = $f['children'];
                        }
                        $s['children'][] = $item;
                    }
                }
                $g[] = $s;
            }
            $allSubTask = $g;
        }
        return $allSubTask;
    }

    public function searchTaskByProjectId($id)
    {
        $this->db->select('*');
        $this->db->from('pm_tasks a');
        $this->db->join('pm_tasklists b', 'a.task_list_id = b.id','left');
        $this->db->where('projects_id', $id);
        if(isset($_POST['searchvalue']) && !empty($_POST['searchvalue'])){
            $this->db->like('tasks_name',$_POST['searchvalue']);
            $this->db->not_like('task_list_name', $_POST['searchvalue']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function searchTaskAndParent($id)
    {
        $this->db->select('*');
        $this->db->from('pm_tasks a');
        $this->db->where('projects_id', $id);

    }

    public function getTaskByProjectTaskListId($id)
    {
        $this->db->select('a.*, b.fullname as assignee');
        $this->db->from('pm_tasks a');
        $this->db->join('pm_user b', 'a.assigned_to = b.user_id', 'left');
        $this->db->where('task_list_id', $id);
        $this->db->where('parent_id', NULL);
        $query = $this->db->get();
        return $query->result();
    }

    public function getTaskInGeneral($id)
    {
        $this->db->select('*');
        $this->db->from('pm_tasks');
        $this->db->where('projects_id', $id);
        $this->db->where('task_list_id', NULL);
        if(isset($_POST['searchvalue']) && !empty($_POST['searchvalue'])){
            $this->db->like('tasks_name',$_POST['searchvalue']);
        } else {
            $this->db->where('parent_id', NULL);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getTasklistByProjectId($id)
    {
        $this->db->select('*');
        $this->db->from('pm_tasklists');
        $this->db->where('project_id', $id);
        if(isset($_POST['page'])){
            $this->db->limit(10,$_POST['page']);
        } else {
            $this->db->limit(10);
        }
        if(isset($_POST['searchvalue']) && !empty($_POST['searchvalue'])){
            $this->db->like('task_list_name',$_POST['searchvalue']);
        }

        $this->db->order_by('task_list_name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllUser()
    {
        $this->db->select('*');
        $this->db->from('pm_users');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllCompany()
    {
        $this->db->select('*');
        $this->db->from('pm_company');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllProjectScope()
    {
        $this->db->select('*');
        $this->db->from('pm_project_scope');
        $this->db->where('is_active', '1');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllResource()
    {
        $this->db->select('*');
        $this->db->from('pm_resources a');
        $this->db->join('pm_user b', 'a.user_id=b.user_id', 'inner');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllTaskList($project_id)
    {
        $this->db->select('*');
        $this->db->from('pm_tasklists');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getUserByProject($project_id)
    {
        $this->db->select('*');
        $this->db->from('pm_people_project a');
        $this->db->join('pm_user b', 'a.user_id = b.user_id', 'inner');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getMilestoneByProject($project_id)
    {
        $this->db->select('*');
        $this->db->from('pm_milestones');
        $this->db->where('projects_id', $project_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getPeopleOutsideProject($project_id){
        $this->db->select('a.*');
        $this->db->from('pm_users a');
        $this->db->join('pm_people_project b', 'a.id = b.user_id', 'left');
        $this->db->where('b.project_id <>', $project_id);
        $this->db->or_where('b.id', NULL);
        $query = $this->db->get();
        return $query->result();
    }

    public function getPeopleInProject($project_id){
        $this->db->select('a.*');
        $this->db->from('pm_user a');
        $this->db->join('pm_people_project b', 'a.user_id = b.user_id', 'left');
        $this->db->where('b.project_id', $project_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getProjectCompletion($project_id){
        $this->db->select('id, progress');
        $this->db->from('pm_tasks');
        $this->db->where('projects_id', $project_id);
        $query = $this->db->get();
        $task = $query->result();
        if(!empty($task)){
            $total_completion = 0;
            $count = 0;
            foreach($task as $key => $value){
                $total_completion += $value->progress;
                $count++;
            }

            $progress = number_format($total_completion/$count, 2, '.', '');
        } else {
            $progress = 0;
        }

        return $progress;
    }

    public function attachTaskList(){
        $tasklist_id = $this->input->post('task_list_id');
        $data = array(
            'milestone_id' => $this->input->post('milestone_id'),
            'last_updated_date' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $tasklist_id);
        $this->db->update('pm_tasklists', $data);

        return true;
    }

    public function updateAssignee(){
        $task_id = $this->input->post('task_id');
        $data = array(
            'assigned_to' => $this->input->post('user_id'),
            'last_updated_date' => date('Y-m-d H:i:s')
        );

        $this->db->where('id', $task_id);
        $this->db->update('pm_tasks', $data);

        return true;
    }

    public function saveProject()
    {
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        /*(!empty($this->input->post('project_start_date'))? $start_date = date('Y-m-d H:i:s', strtotime($this->input->post('project_start_date'))) : $start_date = null);
        (!empty($this->input->post('project_end_date'))? $end_date = date('Y-m-d H:i:s', strtotime($this->input->post('project_end_date'))) : $end_date = null);*/

        if(!($this->input->post('project_start_date'))) {
            $start_date = date('Y-m-d H:i:s', strtotime($this->input->post('project_start_date')));
        } else {
            $start_date = null;
        }

        if(!($this->input->post('project_end_date'))) {
            $end_date = date('Y-m-d H:i:s', strtotime($this->input->post('project_end_date')));
        } else {
            $end_date = null;
        }

        $scope = implode(",", $this->input->post('scope'));

        $data = array(
            'project_id' => $this->input->post('project_id'),
            'project_name' => $this->input->post('project_name'),
            'description' => $this->input->post('project_description'),
            'company' => $this->input->post('project_company'),
            'customer' => $this->input->post('customer'),
            // 'scope' => $this->input->post('scope'),
            'scope' => $scope,
            'completion' => '0.00',
            /*'start_date' => $start_date,
            'end_date' => $end_date,*/
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->setUserId()
        );

        $this->db->insert('pm_projects', $data);
        $project_id = $this->db->insert_id();

        $team = $this->input->post('team');
        if(!empty($team)){
            foreach ($this->input->post('team') as $key => $value) {
                $team = array(
                    'project_id' => $project_id,
                    'user_id' => $value,
                    'created_date' => date('Y-m-d H:i:s')
                );

                $this->db->insert('pm_people_project', $team);
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

    public function saveEditProject()
    {
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $data = array(
            'project_name' => $this->input->post('project_name'),
            'customer' => $this->input->post('customer'),
            'scope' => $this->input->post('scope'),
            'completion' => $this->input->post('completion'),
            'description' => $this->input->post('project_description'),
            'company' => $this->input->post('project_company'),
            'start_date' => $this->input->post('project_start_date'),
            'end_date' => $this->input->post('project_end_date'),
            'last_updated_date' => date('Y-m-d H:i:s'),
            'last_updated_by' => $this->setUserId()
        );

        $this->db->where('id', $this->input->post('project_id'));
        $this->db->update('pm_projects', $data);

        $this->db->delete('pm_resource_allocation', array('project_id' => $this->input->post('project_id')));
        $resource = $this->input->post('team');
        if(!empty($resource)){
            foreach($resource as $value){
                $data = array(
                    'user_id' => $value,
                    'project_id' => $this->input->post('project_id'),
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

    public function saveMilestone(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        if($this->input->post('asignee')== 'anyone'){
            $asignee = null;
        } else {
            $asignee = $this->input->post('asignee') ;
        }

        $data = array(
            'projects_id' => $this->input->post('project_id'),
            'description' => $this->input->post('description'),
            'milestone_name' => $this->input->post('milestone'),
            'responsible_to' => $asignee,
            'due_date' => date('Y-m-d', strtotime($this->input->post('milestone_due_date'))),
            'created_date' => date('Y-m-d H:i:s')

        );
        $this->db->insert('pm_milestones', $data);


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

    public function saveEditMilestone(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        if($this->input->post('asignee')== 'anyone'){
            $asignee = null;
        } else {
            $asignee = $this->input->post('asignee') ;
        }

        $milestone_id = $this->input->post('milestone_id');

        $data = array(
            'description' => $this->input->post('description'),
            'milestone_name.' => $this->input->post('milestone'),
            'responsible_to' => $asignee,
            'due_date' => date('Y-m-d', strtotime($this->input->post('milestone_due_date'))),
            'created_date' => date('Y-m-d H:i:s')

        );
        $this->db->where('id', $milestone_id);
        $this->db->update('pm_milestones', $data);
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

    public function saveTask(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        /*if ($this->input->post('asignee') == 'anyone') {
            $asignee = null;
        } else {
            $asignee = $this->input->post('asignee');
        };*/
        $start_date = $this->input->post('start_date');
        if(!empty($start_date)) {
            $start_date = date('Y-m-d', strtotime($this->input->post('start_date')));
        } else {
            $start_date = null;
        }

        $end_date = $this->input->post('due_date');
        if(!empty($end_date)){
            $end_date = date('Y-m-d', strtotime($this->input->post('due_date')));
        }  else {
            $end_date = null;
        }

        $data = array(
            'projects_id' => $this->input->post('project_id'),
            'tasks_name' => $this->input->post('task_name'),
//            'assigned_to' => $asignee,
//            'description' => $this->input->post('description'),
            'task_list_id' => $this->input->post('tasklist'),
//            'priority' => $this->input->post('priority'),
            // 'responsible_to' => $asignee,
            'start_date' => $start_date,
            'due_date' => $end_date,
            'created_date' => date('Y-m-d H:i:s'),
            'created_by' => $this->setUserId()
        );

        $this->db->insert('pm_tasks', $data);

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

    public function saveEditTask(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $start_date = $this->input->post('start_date');
        if(!empty($start_date)) {
            $start_date = date('Y-m-d', strtotime($this->input->post('start_date')));
        } else {
            $start_date = null;
        }

        $end_date = $this->input->post('due_date');
        if(!empty($end_date)){
            $end_date = date('Y-m-d', strtotime($this->input->post('due_date')));
        }  else {
            $end_date = null;
        }


        $data = array(
            'tasks_name' => $this->input->post('task_name'),
            'task_list_id' => $this->input->post('tasklist'),
            'start_date' => $start_date,
            'due_date' => $end_date,
            'progress' => $this->input->post('progress'),
            'last_updated_date' => date('Y-m-d H:i:s')

        );
        $this->db->where('id',$this->input->post('task_id'));
        $this->db->update('pm_tasks', $data);

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

    public function saveTaskList(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();
        // var_dump($this->input->post(null, true)); exit();
        // $employee_id = $this->setUserId();

        $data = array(
            'project_id' => $this->input->post('project_id'),
            'task_list_name' => $this->input->post('task_list_name'),
            'notes' => $this->input->post('notes'),
            'milestone_id' => $this->input->post('milestone_id'),
            'created_date' => date('Y-m-d H:i:s')

        );
        $this->db->insert('pm_tasklists', $data);

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

    public function saveUser()
    {
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();
        $project_id = $this->input->post('project_id');
        foreach ($this->input->post('team') as $key => $value) {
            $team = array(
                'project_id' => $project_id,
                'user_id' => $value,
                'created_date' => date('Y-m-d H:i:s')
            );

            $this->db->insert('pm_people_project', $team);
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

    public function getTasklistByProjectId2($id)
    {
        $this->db->select('task_list_name');
        $this->db->from('pm_tasklists');
        $this->db->where('project_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getProjectById($id)
    {
        $this->db->select('*');
        $this->db->from('pm_projects');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getMilestoneById($id)
    {
        $this->db->select('*');
        $this->db->from('pm_milestones');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function saveEditPoject(){
        $id = $this->input->post('project_id');
        $start = null; $end = null;
        $a = $this->input->post('project_start_date');
        $b = $this->input->post('project_end_date');
        if(!empty($a)){
            $start = date('Y-m-d', strtotime($this->input->post('project_start_date')));
        }
        if(!empty($b)){
            $end = date('Y-m-d', strtotime($this->input->post('project_end_date')));
        }

        $data = array(
            'project_name' => $this->input->post('project_name'),
            'description' => $this->input->post('project_description'),
            'start_date' => $start,
            'end_date' => $end,
            'company' => $this->input->post('project_company'),
            'last_updated_date' =>date('Y-m-d H:i:s')
        );
        $this->db->where('id', $id);
        $this->db->update('pm_projects', $data);

        return true;
    }

    public function saveProgress(){
        $task_id = $this->input->post('task_id');
        $data = array(
            'progress' => $this->input->post('progress'),
        );
        $this->db->where('id', $task_id);
        $this->db->update('pm_tasks', $data);

        return true;
    }

    private function _get_datatable_project_query()
    {
        $roles = $this->apps->info();
        $role = $roles['userRole'][0];


        $column_select = array("a.*");
        $column_search = array("project_name", "customer","scope");
//        $column_order = array("b.fullname", "a.title","a.join_date","a.work_location");
        $this->db->select($column_select);
        $this->db->from('pm_projects a');
        if ($role == 1){
        } else {
            $projectIds = "";
            foreach ($roles['projects'] as $i => $v){
                $projectIds .= $v->id.",";
            }
            $projectIds = "id IN (".substr($projectIds,0,-1).")";
            $this->db->where($projectIds);
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

        /*if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }*/

    }

    function get_datatable_project()
    {
        $this->_get_datatable_project_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_project()
    {
        $this->_get_datatable_project_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_project()
    {
        $this->db->from("pm_projects");
        return $this->db->count_all_results();
    }

    private function _get_datatable_customer_query()
    {
        /*$column_search = array("tools_id", "description", "pr_number", "po_number");
        $column_order = array("tools_id", "description", "pr_number", "pr_date", "po_number", "po_date");*/
        $this->db->select('*');
        $this->db->from('pm_customer');

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

    function get_datatable_customer()
    {
        $this->_get_datatable_customer_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_customer()
    {
        $this->_get_datatable_customer_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_customer()
    {
        $this->db->from("pm_customer");
        return $this->db->count_all_results();
    }

    public function saveNewCustomer(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $data = array(
            'customer_name' => $this->input->post('customer_name'),
            'customer_address' => $this->input->post('customer_address'),
            'customer_email' => $this->input->post('customer_email'),
            'customer_phone' => $this->input->post('customer_phone'),
            'other_customer_details' => $this->input->post('other_customer_detail'),
            'created_by' => $this->setUserId(),
            'created_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert('pm_customer', $data);

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

    public function getCustomerDetail($id){
        $this->db->select('*');
        $this->db->from('pm_customer');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $customer = $query->row();
        return $customer;
    }

    public function updateCustomer(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();
        $customerId = $this->input->post('customer_id');
        $data = array(
            'customer_name' => $this->input->post('customer_name'),
            'customer_address' => $this->input->post('customer_address'),
            'customer_email' => $this->input->post('customer_email'),
            'customer_phone' => $this->input->post('customer_phone'),
            'other_customer_details' => $this->input->post('other_customer_detail'),
            'created_by' => $this->setUserId(),
            'created_date' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $customerId);
        $this->db->update('pm_customer', $data);

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

    public function deleteCustomer($id)
    {
        $this->db->delete('pm_customer', array('id' => $id)); 
        return true;
    }

    public function getAllCustomer(){
        $this->db->select('*');
        $this->db->from('pm_customer');
        $query = $this->db->get();
        $customer = $query->result();
        return $customer;
    }

    public function generateProjectId(){
        $ty = "project_id LIKE '".date('y')."%'";
        $this->db->select('id','project');
        $this->db->from('pm_projects');
        $this->db->where($ty);
        $this->db->limit('1');
        $this->db->order_by('id','desc');
        $query = $this->db->get();
        $lastItem = $query->row();

        // var_dump($lastItem); exit();

        $next_item = $lastItem->id + 1;

        $no_project = date('y').$next_item."01";

        return $no_project;
    }

    public function checkExistingProjectId($projectId){
        $this->db->select('*');
        $this->db->from('pm_projects');
        $this->db->where('project_id', $projectId);
        $query = $this->db->get();
        $existing = $query->num_rows();
        return $existing;
    }

    public function milestoneGrup(){
        $this->db->select('a.*');
        $this->db->from('pm_milestone_group a');
        $query = $this->db->get();
        return $query->result();
    }

    public function milestones(){
        // $this->db->select('a.*');
        $this->db->from('pm_milestone_definition');
        $query = $this->db->get();
        $ret = $query->result();
        $g = array();
        foreach ($ret as $key => $value) {
            if(!isset($g[$value->ms_group_id])){
                $g[$value->ms_group_id][] = $value;
            } else {
                $g[$value->ms_group_id][] = $value;
            }
        }

        return $g;
    }

    public function saveMilstones(){
        $milestones = $this->input->post('milestone');
        $uom = $this->input->post('uom');
        foreach ($milestones as $key => $value) {
            $data = array(
                'project_id' => $this->input->post('project_id'),
                'milestone_grup_id' => $this->input->post('milestone_grup'),
                'uom' => $uom[$value],
                'milestone_id' => $value
            );

            $this->db->insert('pm_project_milestone', $data);
        }

        return true;

    }

    public function getMileStoneGrup($id){
        $this->db->from('pm_project_milestone a');
        $this->db->join('pm_milestone_group b','a.milestone_grup_id = b.id');
        $this->db->where('project_id',$id);
        $this->db->group_by('b.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function getMileStone($id){
        // $this->db->select('');
        $this->db->from('pm_project_milestone a');
        $this->db->join('pm_milestone_definition b','a.milestone_id = b.id');
        $this->db->where('project_id',$id);
        $query = $this->db->get();
        $ret = $query->result();

        $c = $this->getMileStoneGrup($id);
        $a = array();

        foreach ($ret as $key => $value) {
            foreach ($c as $k => $v) {
                if($value->milestone_grup_id == $v->id){
                    $c[$k]->mil[] = $value;
                }
            }
        }

        return $c;
    }

    
    public function getMilestoneProject($id){
        $this->db->select("milestone_id, uom");
        $this->db->from('pm_project_milestone');
        $this->db->where('project_id',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function milestone_uom(){
        $this->db->select("uom_name");
        $this->db->from('pm_milestone_uom');
        $query = $this->db->get();
        return $query->result();
    }
}