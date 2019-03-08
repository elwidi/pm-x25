
<?php

class Administration_model extends CI_Model
{

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

    public function getAllRole(){
        $this->db->select('*');
        $this->db->from('pm_role');
        $query = $this->db->get();
        $role = $query->result();
        return $role;
    }

    public function getWorkLocation(){
        $this->db->select('*');
        $this->db->from('pm_work_location');
        $query = $this->db->get();
        $role = $query->result();
        return $role;
    }

    public function getRoleName($roleId){
        $this->db->select('*');
        $this->db->from('pm_role');
        $this->db->where('id', $roleId);
        $query = $this->db->get();
        $role = $query->row();
        return $role;
    }

    public function allDept(){
        $this->db->select('*');
        $this->db->from('pm_department');
        $query = $this->db->get();
        $role = $query->result();
        return $role;
    }

    public function getPermissionbyRole($roleId){
        $this->db->select('id, permission_id, role_id, name');
        $this->db->from('pm_role_permission a');
        $this->db->join('pm_permission b', 'a.permission_id = b.id_permission');
        $this->db->where('role_id', $roleId);
        $query = $this->db->get();
        $result = $query->result();
        $permission = array();
        foreach($result as $key => $value){
            $permission[$value->name] = 1;
        }
        return $permission;
    }

    public function getPermissionbyRole2($roleId){
        $this->db->select('id, permission_id, role_id, name');
        $this->db->from('pm_role_permission a');
        $this->db->join('pm_permission b', 'a.permission_id = b.id_permission');
        $this->db->where('role_id', $roleId);
        $query = $this->db->get();
        $result = $query->result();
        $permission = array();
        foreach($result as $key => $value){
            $permission[] = $value->permission_id;
        }
        return $permission;
    }

    public function getUserRole($userId){
        $this->db->select('a.user_id, role_id, role_name');
        $this->db->from('pm_user a');
        $this->db->join('pm_role b', 'a.role_id = b.id');
        $this->db->where('sso_id', $userId);
        $query = $this->db->get();
        $role = $query->row();
        if(!empty($role)){
            $r = array($role->role_id, $role->role_name,$role->user_id);
        } else {
            $r = array();
        }
        return $r;
    }

    public function getRoles()
    {
        $this->db->select('*');
        $this->db->from('pm_role');
        $this->db->where('id <> 1');
        $query = $this->db->get();
        return $query->result();
    }

    /*public function getAccessRight()
    {
        $roleId = $this->getUserRole($this->setUserId());
        $this->db->select('user_id, role_id');
        $this->db->from('pm_role_permission');
        $this->db->where('role_id', $roleId);
        $this->db->where('p', $userId);
        $query = $this->db->get();
        $role = $query->row();
        return $role->role_id;
    }*/

    public function getPermissionByMenu($menu_id)
    {
        $this->db->from('pm_permission');
        $this->db->where('menu_id', $menu_id);
        $query = $this->db->get();
        $permission = $query->result();
        return $permission;
    }

    public function getMenuWithPermission($roleId){
        $this->db->select('id_menu, parent_id, name');
        $this->db->from('pm_menu');
        $this->db->where('parent_id',0);
        $query = $this->db->get();
        $role = $query->result();
        foreach($role as $key => $parent){
            $this->db->select('id_menu, parent_id, name');
            $this->db->from('pm_menu');
            $this->db->where('parent_id',$parent->id_menu);
            $query = $this->db->get();
            $menus = $query->result();
            foreach($menus as $i => $m){
                $permission = $this->getPermissionByMenu($m->id_menu);
                foreach($permission as $k => $p){
                    $rolePermission = $this->getPermissionbyRole($roleId);
                    $permission[$k]->havePermission = 0;
                    if(isset($rolePermission[$p->name])){
                        $permission[$k]->havePermission = 1;
                    }
                }

                $m->permission = $permission;

                $role[$key]->submenu[] = $m;
            }
        }
        return $role;
    }

    public function getAllPermission(){
        $this->db->select('id_menu, parent_id, name');
        $this->db->from('pm_menu');
        $this->db->where('parent_id',0);
        $query = $this->db->get();
        $role = $query->result();
        foreach($role as $key => $parent){
            $this->db->select('id_menu, parent_id, name');
            $this->db->from('pm_menu');
            $this->db->where('parent_id',$parent->id_menu);
            $query = $this->db->get();
            $menus = $query->result();
            foreach($menus as $i => $m){
                $permission = $this->getPermissionByMenu($m->id_menu);
                $m->permission = $permission;

                $role[$key]->submenu[] = $m;
            }
        }
        return $role;
    }

    public function getActiveUser(){
        $this->db->select('*');
        $this->db->from('pm_user a');
        /*$this->db->join('pm_resources b','a.user_id = b.user_id','left');
        $this->db->where('b.id IS NULL');*/
        $this->db->where('active', 1);
        $query = $this->db->get();
        $user = $query->result();
        return $user;
    }

    public function getActiveUser2(){
        $this->db->select('*');
        $this->db->from('pm_user a');
        /*$this->db->join('pm_resources b','a.user_id = b.user_id','left');
        $this->db->where('b.id IS NULL');*/
        $this->db->where('active', 1);
        $query = $this->db->get();
        $user = $query->result();
        $arr = array();
        foreach ($user as $key => $value) {
            $arr[$value->sso_id] = 1;
            $arr[$value->fullname] = 1;
        } 

        return $arr;
        // var_dump($arr); exit();
    }

    public function getUserDetail($id){
        $this->db->select('a.*, b.role_name');
        $this->db->from('pm_user a');
        $this->db->join('pm_role b','a.role_id = b.id');
        // $this->db->where('active', 1);
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        $user = $query->row();
        return $user;
    }


    public function savePermission(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $data = array(
            'menu_id' => $this->input->post('menu'),
            'name' => $this->input->post('permission_name'),
            'description' => $this->input->post('description'),
            'created_by' => '3358',
            'created_at' => date("Y-m-d H:i:s")
        );

        $this->db->insert('pm_permission', $data);
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

    public function getAllMenu(){
        $this->db->from('pm_menu');
        $this->db->where('status', 'active');
        $query = $this->db->get();
        return $query->result();
    }

    private function _get_datatable_role_query()
    {
//        $column_select = array("a.*", "b.name as menu_name");
        /*        $column_search = array("A.judul", "A.sales", "A.type_proposal");
                $column_order = array("A.id_proposal","A.judul", "A.sales", "A.type_proposal","A.create_date");*/
//        $this->db->select($column_select);
        $this->db->from('pm_role');
//        $this->db->join('pm_menu b', 'a.menu_id = b.id_menu', 'left');

        $i = 0;

        /*foreach ($column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                if(strtolower($_POST['search']['value']) == 'close' || strtolower($_POST['search']['value']) == 'closed'){
                    $this->db->where("B.proposal", 1);
                } elseif(strtolower($_POST['search']['value']) == 'progress' || strtolower($_POST['search']['value']) == 'progre'){
                    $this->db->where("B.proposal", 0);
                } else{
                    if($i===0) // first loop
                    {
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
                }


            }
            $i++;
        }*/

        /*$this->db->order_by("A.NAME_SALES", "asc");
        $this->db->order_by("A.TGL_INPUT", "desc");*/

        /*if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }*/

    }

    function get_datatable_role()
    {
        $this->_get_datatable_role_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
//      var_dump($query->result()); exit;
    }

    function count_filtered_role()
    {
        $this->_get_datatable_role_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_role()
    {
        $this->db->from("pm_role");
        return $this->db->count_all_results();
    }

    public function saveUser(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */

        $this->db->trans_begin();

        // var_dump($this->input->post()); exit();

        $user = $this->input->post('fullname');
        $user = explode('-',$user);

        $data = array(
            'sso_id' => $this->input->post('emp_id'),
            'email' => $this->input->post('email'),
            'fullname' => $this->input->post('emp_fullname'),
            'role_id' => $this->input->post('role'),
            'work_location' => $this->input->post('area_assigned'),
            'department' => $this->input->post('department'),
            'active' => 1
        );
        $this->db->insert('pm_user', $data);
        $user_id = $this->db->insert_id();

        $project = $this->input->post('project');
        $all_projects = $this->input->post('all_project');

        if(empty($project)){
            if($all_projects == 1){
                $project = array('0');
            }
        }

        $permission_role = $this->getPermissionbyRole2($this->input->post('role'));

        $permission = $this->input->post('permission');
        if(!empty($permission)){
            $deleted_permission = array_diff($permission_role, $permission);
            $added_permission = array_diff($permission, $permission_role);
        }
        
        /*var_dump("permission yang diinput:");
        var_dump($permission);
        var_dump("permission default:");
        var_dump($permission_role);
        var_dump("permission yang dihapus:");
        var_dump($diff); 
        var_dump("permission yang ditambahkan:");
        var_dump($diff2); exit();*/

        foreach($project as $key => $value){
            $data = array(
                'user_id' => $user_id,
                'project_id' => $value,
                'position_id' => $this->input->post('role'),
                'join_date_to_project' => date('Y-m-d')
            );
            $this->db->insert('pm_resource_allocation', $data);
        }

        if(isset($deleted_permission)){
            foreach($deleted_permission as $value){
                $data = array(
                    'user_id' => $user_id,
                    'permission_id' => $value,
                    'note' => '-'
                );
                $this->db->insert('pm_user_permission', $data);
            }
        }

        if(isset($added_permission)){
           foreach($added_permission as $value){
                $data = array(
                    'user_id' => $user_id,
                    'permission_id' => $value,
                    'note' => '+'
                );
                $this->db->insert('pm_user_permission', $data);
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

    function saveEditUser(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        // var_dump($this->input->post()); exit();
        $this->db->trans_begin();

        $user = $this->input->post('email');
        $user = explode('-',$user);

        $all_project = $this->input->post('all_project');

        $userId = $this->input->post('user_id');

        $data = array(
            'sso_id' => $this->input->post('emp_id'),
            'email' => $this->input->post('email'),
            'fullname' => $this->input->post('emp_fullname'),
            'role_id' => $this->input->post('role'),
            'work_location' => $this->input->post('area_assigned'),
            'department' => $this->input->post('department'),
            'active' => 1
        );
        // var_dump($data); exit();
        $this->db->where('user_id', $userId);
        $this->db->update('pm_user', $data);
        // var_dump($all_project); exit();
        if($all_project != 1){
            $this->db->select('project_id');
            $this->db->from('pm_resource_allocation a');
            $this->db->where('a.user_id',$userId);
            $query = $this->db->get();
            $existing_project = array();
            foreach ($query->result() as $key => $value) {
                $existing_project[] = $value->project_id;
            }

            $new_project = $this->input->post('project');

            $deleted_project = array_diff($existing_project, $new_project);
            $added_project = array_diff($new_project, $existing_project);

            foreach($deleted_project as $value){
                $this->db->delete('pm_resource_allocation', array('project_id' => $value,'user_id' => $userId));
            }

            foreach($added_project as $value){
                $data = array(
                    'user_id' => $userId,
                    'project_id' => $value,
                    'position_id' => $this->input->post('role'),
                    'join_date_to_project' => date('Y-m-d')
                );
                $this->db->insert('pm_resource_allocation', $data);
            }
        } else {
            $this->db->where('user_id', $userId);
            $this->db->where('project_id', '0');
            $this->db->delete('pm_resource_allocation');
            $data = array(
                'user_id' => $userId,
                'project_id' => 0
            );

            $this->db->insert('pm_resource_allocation', $data);
        }

        
        $permission_role = $this->getPermissionbyRole2($this->input->post('role'));

        $permission = $this->input->post('permission');

        $deleted_permission = array_diff($permission_role, $permission);
        $added_permission = array_diff($permission, $permission_role);

        if(!empty($deleted_permission)){
            foreach($deleted_permission as $value){
                $this->db->delete('pm_user_permission', array('permission_id' => $value,'user_id' => $userId));
            }
        }

        if(!empty($added_permission)){
            foreach($added_permission as $value){
                $data = array(
                    'user_id' => $userId,
                    'permission_id' => $value,
                    'note' => '+'
                );
                $this->db->insert('pm_user_permission', $data);
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

    private function _get_datatable_user_query()
    {
        $column_select = array("a.*", "b.role_name","c.department_name");
        $column_search = array("a.email", "a.fullname", "b.role_name","c.department_name","a.active");
        $column_order = array("a.email", "a.fullname", "b.role_name","c.department_name","a.active");
        $this->db->select($column_select);
        $this->db->from('pm_user a');
        $this->db->join('pm_role b', 'a.role_id = b.id');
        $this->db->join('pm_department c', 'a.department = c.id','left');
        $i = 0;
        foreach ($column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {   
                if($_POST['search']['value']== 'act' || $_POST['search']['value']== 'acti' || $_POST['search']['value']== 'active'){
                     $this->db->where("a.active", '1');
                } elseif($_POST['search']['value']== 'inact' || $_POST['search']['value']== 'inactive'){
                     $this->db->where("a.active", '0');
                } else {
                    if($i===0) // first loop
                    {
                        $this->db->like($item, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
                }
                
            }
            $i++;
        }

        // if(isset($_POST['order'])) // here order processing
        // {
        //     $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        // }

        $this->db->order_by('user_id','ASC');

    }

    function get_datatable_user_permission()
    {
        $this->_get_datatable_user_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_user_permission()
    {
        $this->_get_datatable_user_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_user_permission()
    {
        $this->db->from("pm_user");
        return $this->db->count_all_results();
    }

    public function saveRolePermission(){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $roleId = $this->input->post('role_id');

        $this->db->where('role_id', $roleId);
        $this->db->delete('pm_role_permission');

        $permission = $this->input->post(null, true);
        $permission = array_slice($permission,1);

        foreach($permission as $i => $k){
            $i = substr($i,1);
            $data = array(
                'role_id' => $roleId,
                'permission_id' => $i,
            );

            $this->db->insert('pm_role_permission', $data);
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


    public function getUserPermission($userId, $roleId){
        /*var_dump($userId);
        var_dump($roleId);
        exit();*/
        $permission = $this->getPermissionbyRole2($roleId);

        $this->db->from('pm_user_permission');
        $this->db->where('user_id', $userId);
        $query = $this->db->get();
        $user_permission = $query->result();

        $removed = array();
        $added = array();


        foreach ($user_permission as $key => $value) {
            if($value->note == '-') {
                $removed[] = $value->permission_id;                
            }

            if($value->note == '+'){
                $permission[] = $value->permission_id;
            }
        }
        

        $permission = array_diff($permission, $removed);

        return $permission;
    }


    public function getUserPermissionIndex($userId, $roleId){
        /*var_dump($userId);
        var_dump($roleId);
        exit();*/
        $permission = $this->getPermissionbyRole2($roleId);

        $this->db->from('pm_user_permission');
        $this->db->where('user_id', $userId);
        $query = $this->db->get();
        $user_permission = $query->result();

        $removed = array();
        $added = array();


        foreach ($user_permission as $key => $value) {
            if($value->note == '-') {
                $removed[] = $value->permission_id;                
            }

            if($value->note == '+'){
                $permission[] = $value->permission_id;
            }
        }
        

        $permission = array_diff($permission, $removed);

        $this->db->from('pm_permission');
        $this->db->where_in('id_permission', $permission);
        $query = $this->db->get();
        $userPermission = $query->result();
        $up = array();

        foreach ($userPermission as $key => $value) {
            $up[$value->name] = '1';
        }

        return $up;
    }

    public function allProjectAccess($user_id){
        // $this->db->select('*');
        $this->db->from('pm_resource_allocation');
        $this->db->where('user_id', $user_id);
        $this->db->where('project_id', '0');
        $query = $this->db->get();
        $user = $query->row();
        if(!empty($user)){
            $status = "true";
        } else {
            $status = "false";
        }

        return $status;
    }

    public function usersInRole($roleId){
        $this->db->from('pm_user');
        $this->db->where('role_id',$roleId);
        $query = $this->db->get();
        $users = $query->result();

        return $users;
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

    public function userChildArea($userId){
        $users = $this->userChild($userId);

        $usersArea = array();
        
        foreach ($users as $key => $value) {
            if(!isset($usersArea[$value->work_location][$value->user_id])){
                $usersArea[$value->work_location][] = $value;
            } else {
                $usersArea[$value->work_location][] = $value;
            }
        }
        return $usersArea;
    }

    public function userChildbyArea($userId, $area){
        $this->db->select('*');
        $this->db->from('pm_user_approval a');
        $this->db->join('pm_user b','a.user_id = b.user_id');
        $this->db->where('parent_id', $userId);
        $this->db->like('work_location', $area);
        $query = $this->db->get();
        $users = $query->result();
        return $users;
    }

    public function getLeadersbyProject($project_id){
        $this->db->select('leader_id');
        $this->db->from('pm_projects');
        $this->db->where('id', $project_id);
        $query = $this->db->get();

        $leaders = $query->row();
        $ldrs = array();
        $e = "";
        if(!empty($leaders->leader_id)){
          $ldrs = explode(",", $leaders->leader_id);

            foreach ($ldrs as $key => $value) {
                $leader_id = str_replace("|", "", $value);
                $a = $this->getUserDetail($leader_id);
                $ldrs[$key] = $a->fullname;
            }

            $e = implode(",", $ldrs);

        }
        

        return $e;
    }


    public function saveParent(){
         /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        $parent_id = $this->input->post('pcid');
        $ex = $this->userChildbyArea($parent_id, $this->input->post('areaid'));
        $fi = $this->input->post('fi_id');
        $a = array();
        if (!empty($ex)){
            foreach ($ex as $key => $value) {
               $a[] = $value->user_id;
            }
            $added = array_diff($fi, $a);
            $removed = array_diff($a, $fi);

            if(!empty($added)){
                foreach ($added as $key => $value) {
                    $data = array(
                        'user_id' => $value,
                        'parent_id' => $parent_id
                    );
                    $this->db->insert('pm_user_approval',$data);
                }

            }

            if(!empty($removed)){
                foreach ($removed as $key => $value) {
                    $this->db->where('user_id', $value);
                    $this->db->where('parent_id', $parent_id);
                    $this->db->delete('pm_user_approval');
                }

            }
        } else {
            foreach ($fi as $key => $value) {
                $data = array(
                    'user_id' => $value,
                    'parent_id' => $parent_id
                );
                $this->db->insert('pm_user_approval',$data);
            }
        }

        foreach ($fi as $key => $value) {
            $data = array(
                'work_location' => ucfirst($this->input->post('areaid'))
            );
            $this->db->where('user_id',$value);
            $this->db->update('pm_user',$data);
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

    public function update_status($status, $id){
        /**
         * ===================================================
         * Transactions with databases
         * ===================================================
         */
        $this->db->trans_begin();

        if($status == "inactive"){
            $action = array(
                'active' => 1
            );
        } else {
            $action = array(
                'active' => 0
            );
        }

        $this->db->where('user_id', $id);
        $this->db->update('pm_user', $action);


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
?>