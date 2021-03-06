
<?php

class Survey_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getProjectDetailById($id)
    {
        $this->db->select('*');
        $this->db->from('pm_projects');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getAllProject()
    {
        $this->db->select('id, project_name, created_date');
        $this->db->from('pm_projects');
        $query = $this->db->get();
        return $query->result();
    }

    public function getTaskByProjectId($id)
    {
        $this->db->select('*');
        $this->db->from('pm_tasks');
        $this->db->where('projects_id', $id);
        $this->db->where('parent_id', NULL);
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
        $this->db->select('a.*, b.name as assignee');
        $this->db->from('pm_tasks a');
        $this->db->join('pm_users b', 'a.assigned_to = b.id', 'left');
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
        $this->db->join('pm_users b', 'a.user_id = b.id', 'inner');
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
        $this->db->from('pm_users a');
        $this->db->join('pm_people_project b', 'a.id = b.user_id', 'left');
        $this->db->where('b.project_id', $project_id);
        $query = $this->db->get();
        return $query->result();
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

        $data = array(
            'project_name' => $this->input->post('project_name'),
            'description' => $this->input->post('project_description'),
            'company' => $this->input->post('project_company'),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'created_date' => date('Y-m-d H:i:s')
        );

        $this->db->insert('pm_projects', $data);
        $project_id = $this->db->insert_id();

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

        if ($this->input->post('asignee') == 'anyone') {
            $asignee = null;
        } else {
            $asignee = $this->input->post('asignee');
        };
        if(!($this->input->post('start_date'))) {
            $start_date = date('Y-m-d', strtotime($this->input->post('task_start_date')));
        } else {
            $start_date = null;
        }
        if(!($this->input->post('end_date'))){
            $end_date = date('Y-m-d', strtotime($this->input->post('task_start_date')));
        }  else {
            $end_date = null;
        }

        $data = array(
            'projects_id' => $this->input->post('project_id'),
            'tasks_name' => $this->input->post('task_name'),
            'assigned_to' => $asignee,
            'description' => $this->input->post('description'),
            'task_list_id' => $this->input->post('task_list'),
            'priority' => $this->input->post('priority'),
            // 'responsible_to' => $asignee,
            'start_date' => $start_date,
            'due_date' => $end_date,
            'created_date' => date('Y-m-d H:i:s')

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
        if(!($this->input->post('project_start_date'))){
            $start = date('Y-m-d', strtotime($this->input->post('project_start_date')));
        }
        if(!($this->input->post('project_end_date'))){
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









} 