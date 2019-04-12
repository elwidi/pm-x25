<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include dirname(__FILE__).DIRECTORY_SEPARATOR.'SsoClient/ClientAPI.php';

class Administration extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Administration_model', 'm_admin');
        $this->load->model('Planning_model', 'm_planning');
        $this->load->model('Resource_model', 'm_resource');

        //TODO: create an object and call a class method
        $ClientApi = new ClientAPI();
        $ClientApi->doCurl();
    }

    public function index()
    {
        // Get Apps Config
        //$data = $this->apps->info();
        //$data['menu'] = $this->apps->menu();
        $this->allUsers();
//        $this->load->view('dashboard/dashboard_view');
    }

    public function allUsers(){
        $data = $this->apps->info();
        $json = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employees');
        $obj = json_decode($json);
        $users = $this->m_admin->getActiveUser2();
        foreach ($obj as $key => $value) {
            if(isset($users[$value->employee_id]) || isset($users[$value->employee_name])){
                $obj[$key]->attr = 'disabled';
            } else {
                $obj[$key]->attr = "";
            }
        }
        // var_dump($obj); exit();
        $data["user"] = $obj;
        $data['menu'] = $this->m_admin->getAllPermission();
        $data['projects'] = $this->m_planning->getAllProject();
        $data['page_title'] = '<span class="text-semibold">Users</span> - List';
        $data['role'] = $this->m_admin->getAllRole();
        $data['dept'] = $this->m_admin->allDept();


        if($this->input->post('submit_form')){
            $user_id = $this->input->post('user_id');
            if(!empty($user_id)){
                if($this->m_admin->saveEditUser()){
                    $this->session->set_flashdata('message', 'Data has been saved');
                    redirect('administration/');
                }
            } else {
                if($this->m_admin->saveUser()){
                    $this->session->set_flashdata('message', 'Data has been saved');
                    redirect('administration/');
                }
            }

        }

        $this->load->view('administration/list_user', $data);
    }

    public function permission(){
        $data = $this->apps->info();
        $data['menu'] = $this->m_admin->getAllMenu();
        $data['page_title'] = '<span class="text-semibold">Permission</span> - List';

        $this->load->view('administration/list_permission', $data);
    }

    public function datatablePermission(){
        $list = $this->m_admin->get_datatable_permission();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $mta) {
            $no++;
            $row = array();
            $row['no'] = $no;
            foreach ($mta as $key => $value) {
                if (empty($value)){
                    $value = "";
                }
                $row[$key] = $value;

            }
            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_admin->count_filtered_permission(),
            "recordsFiltered" => $this->m_admin->count_all_permission(),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }

    public function savePermission()
    {
        $this->m_admin = new Administration_model();
        if ($this->m_admin->savePermission()) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

    public function roles(){
        $data = $this->apps->info();
        $data['page_title'] = '<span class="text-semibold">Role</span> - List';

        $this->load->view('administration/list_role', $data);
    }

    public function rolePermissions($roleId)
    {
        $data = $this->apps->info();
        $data['role'] = $this->m_admin->getRoleName($roleId);
        $data['page_title'] = '<span class="text-semibold">Role</span> - List';
        $data['menu'] = $this->m_admin->getMenuWithPermission($roleId);
        $data['dissabled'] = 'disabled="disabled"';
        if($this->apps->check('editUserRole')){
            $data['dissabled'] = '';
        }
        $this->load->view('administration/list_role_permission', $data);
    }

    public function datatableRole(){
        $list = $this->m_admin->get_datatable_role();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $mta) {
            $no++;
            $row = array();
            $row['no'] = $no;
            foreach ($mta as $key => $value) {
                if (empty($value)){
                    $value = "";
                }
                $row[$key] = $value;

            }
            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_admin->count_filtered_role(),
            "recordsFiltered" => $this->m_admin->count_all_role(),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }


    public function datatableRolePermission($roleId)
    {
        $list = $this->m_admin->get_datatable_role_permission();
        $data = array();
        $no = $_POST['start'];
        $list_role_permission = $this->m_admin->getPermissionbyRole($roleId);
        foreach ($list as $mta) {
            $id_permission = $mta->id_permission;
            $isHavingPermission = count(array_filter($list_role_permission, function($k) use ($id_permission) {
                return $k->permission_id == $id_permission;
            }));

            $no++;
            $row = array();
            $row['no'] = $no;
            $row['isHavingPermission'] = 0;
            if($isHavingPermission > 0) $row['isHavingPermission'] = 1;
            foreach ($mta as $key => $value) {
                if (empty($value)){
                    $value = "";
                }
                $row[$key] = $value;

            }
            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_admin->count_filtered_role_permission(),
            "recordsFiltered" => $this->m_admin->count_all_role_permission(),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }

    public function addUser()
    {
        if ($this->m_admin->saveUser()) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();

    }

    public function datatableUser()
    {
        $list = $this->m_admin->get_datatable_user_permission();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $mta) {
            $no++;
            $row = array();
            $row['no'] = $no;
            foreach ($mta as $key => $value) {
                if (empty($value)){
                    $value = "";
                }
                $row[$key] = $value;
                $row['editAllowed'] = $this->apps->check('editUser');
            }
            $data[] = $row;
        }


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_admin->count_all_user_permission(),
            "recordsFiltered" => $this->m_admin->count_filtered_user_permission(),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }

    public function updateRolePermission(){
        $allowed = $this->apps->check('editUserRole');
        if($allowed){
            if ($this->m_admin->saveRolePermission()){
                redirect('administration/rolePermissions/'.$this->input->post('role_id'));
            }
        } else {
            show_404();
        }
    }

    public function userDetail($userId) {
        $userDetail = $this->m_admin->getUserDetail($userId);
        $userDetail->project = $this->m_resource->getResAllocation($userId);
        if (!empty($userDetail)) {
            $data = array('status' => 'success', 'data' => $userDetail);
        } else {
            $data = array('status' => 'failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function user_info($userId) {
        $userDetail = $this->m_admin->getUserDetail($userId);
        if (!empty($userDetail)) {
            $data = array('status' => 'success', 'data' => $userDetail);
        } else {
            $data = array('status' => 'failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function getEmployee(){
        $json = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employees');
        echo $json;
        exit;
    }

    public function getRoles()
    {
        $role = $this->m_admin->getAllRole();
        if (!empty($role)) {
            $data = array('status' => 'Success', 'data' => $role);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }

        echo json_encode($data);
        exit();
    }

    public function editUser(){
        if($this->m_admin->saveEditUser()){
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Success');
        }
        echo json_encode($data);
        exit();
    }

    public function activeUser()
    {
        $activeUser = $this->m_admin->getActiveUser();
        if (!empty($activeUser)) {
            $data = array('status' => 'Success', 'data' => $activeUser);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }

        echo json_encode($data);
        exit();
    }

    public function getEmpDetail(){
        $id = $this->input->post('emp_code');
        $data = $this->apps->info();
        $json = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employee/id/'.$id);
        echo $json;
        exit();
    }

    public function role_permission(){
        $role_id = $this->input->post('role');
        $rolePermissions = $this->m_admin->getPermissionbyRole2($role_id);
        if (!empty($rolePermissions)) {
            $data = array('status' => 'Success', 'data' => $rolePermissions);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }

        echo json_encode($data);
        exit();
    }

    public function user_permission(){
        $user_id = $this->input->post('user');
        $rolePermissions = $this->m_admin->getPermissionbyRole2($role_id);
        if (!empty($rolePermissions)) {
            $data = array('status' => 'Success', 'data' => $rolePermissions);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }

        echo json_encode($data);
        exit();
    }

    public function getUserPermission(){
        $user_id = $this->input->post('user');
        $role_id = $this->input->post('role');

        $permission = $this->m_admin->getUserPermission($user_id,$role_id);

        if (!empty($permission)) {
            $data = array('status' => 'Success', 'data' => $permission);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }

        echo json_encode($data);
        exit();
    }

    public function saveParent(){
        if($this->m_admin->saveParent()){
            redirect('timesheet/formWeeklyPlan');
        }
    }

    public function save_parent(){
        if($this->m_admin->saveParent2()){
            redirect('timesheet/formWeeklyPlan');
        }
    }

    public function update_status(){
        $status = $this->input->post('status');
        $user_id = $this->input->post('user_id');
        if($this->m_admin->update_status($status, $user_id)) {
            $data = array('status' => 'success');
        } else {
            $data = array('status' => 'failed');
        }
        echo json_encode($data);
        exit();
    }

    public function all_project_access()
    {
        $user_id = $this->input->post('user_id');
        $role = $this->m_admin->allProjectAccess($user_id);
        $data = array('status' => $role);
        // if (!empty($role)) {
        //     $data = array('data' => $role);
        // } else {
        //     $data = array('data' => '');
        // }

        echo json_encode($data);
        exit();
    }

    
}
