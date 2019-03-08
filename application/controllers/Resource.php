<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include dirname(__FILE__).DIRECTORY_SEPARATOR.'SsoClient/ClientAPI.php';

class Resource extends CI_Controller {

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
        $this->load->model('Resource_model', 'm_resource');
        $this->load->model('Planning_model', 'm_planning');

        //TODO: create an object and call a class method
        $ClientApi = new ClientAPI();
        $ClientApi->doCurl();
    }

    public function index()
    {
        $data = $this->apps->info();
        $data['activeUser'] = $this->m_admin->getActiveUser();
        $data['roles'] = $this->m_admin->getRoles();
        $data['project'] = $this->m_planning->getProjects();
        $data['page_title'] = '<span class="text-semibold">Resources</span> - List';
        $this->load->view('resource/list_resource', $data);
    }

    public function allocation()
    {
        $data = $this->apps->info();
        $data['resource'] = $this->m_resource->getAllResource();
        $data['projects'] = $this->m_planning->getAllProject();
        $data['page_title'] = '<span class="text-semibold">Resources</span> - List';
        $this->load->view('resource/resource_allocation', $data);
    }

    public function details($id)
    {
        $data = $this->apps->info();
        $data['resource'] =  $this->m_resource->getResourceDetail($id);
        $project =  $this->m_resource->getResourceProject($id);
        $data['total'] = $project['count'];
        $data['project'] = $project['project'];
        $data['avail'] = $project['availbility'];
        $data['os_work'] = $project['os_work'];
        $data['page_title'] = '<span class="text-semibold">Resources</span> - List';
        $this->load->view('resource/resource_detail', $data);
    }

    public function addResource()
    {
        if ($this->m_resource->saveNewResource()) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

    public function saveAllocate()
    {
        if ($this->m_resource->saveAllocateResource()) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

    public function editResource($id)
    {
        if ($this->m_resource->updateResource($id)) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

    public function datatableResource()
    {
        $list = $this->m_resource->get_datatable_resource();
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
            "recordsTotal" => $this->m_resource->count_filtered_resource(),
            "recordsFiltered" => $this->m_resource->count_all_resource(),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }

    public function datatableAllocateResource()
    {
        $list = $this->m_resource->get_datatable_resource_allocate();
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
            "recordsTotal" => $this->m_resource->count_filtered_resource(),
            "recordsFiltered" => $this->m_resource->count_all_resource(),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }

    public function datatable_resourceAllocation($id)
    {
        $list = $this->m_resource->get_datatable_resource_allocation($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $dt) {
            $no++;
            $row = array();
            $row['no'] = $no;
            foreach ($dt as $key => $value) {
                if (empty($value)){
                    $value = "";
                }
                $row[$key] = $value;

            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_resource->count_all_resource_allocation($id),
            "recordsFiltered" => $this->m_resource->count_filtered_resource_allocation($id),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }

    public function detail($id)
    {
        $resource = $this->m_resource->getResourceDetail($id);
        if (!empty($resource)) {
            $data = array('status' => 'Success', 'data' => $resource);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }

        echo json_encode($data);
        exit();
    }

    public function availability(){
        $data = $this->apps->info();
        $data['roles'] = $this->m_admin->getRoles();
        $data['resource'] = $this->m_resource->getPositionResource();
        $data['role'] = $this->m_resource->getPositionResource();
        $data['page_title'] = '<span class="text-semibold">Resource</span> - Resources Avaibility';

        $this->load->view('resource/resource_availability', $data);
    }

    public function all_resource()
    {
        $resource = $this->m_resource->getAllResource();
        if (!empty($resource)) {
            $data = array('status' => 'Success', 'data' => $resource);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function saveRes(){
        $id = $this->input->post('project_id');
        if($this->m_resource->saveResource()){
            $link = 'planning/id/'.$id."?tab=team";
            redirect($link);
        }
    }

    public function position_project(){
        $project_id = $this->input->post('project_id');
        $position_id = $this->input->post('position_id');
        $resources = $this->m_resource->getProjectPosition($project_id, $position_id);
        if(!empty($resources)){
            $data = array('status' => 'success', 'data' => $resources);
        } else {
            $data = array('status' => 'failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function resource_allocate_detail(){
        $ra_id = $this->input->post('resource');
        $allocate = $this->m_resource->resource_allocate_detail($ra_id);
        if(!empty($allocate)){
            $data = array('status' => 'success', 'data' => $allocate);
        } else {
            $data = array('status' => 'failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function update_allocation(){
        if($this->m_resource->updateAllocation()){
            $data = array('status' => 'success');
        } else {
            $data = array('status' => 'failed');
        }

        echo json_encode($data);
        exit();
    }

    public function deactive_resource(){
        $id = $this->input->post('resource');
        if($this->m_resource->deactiveResource($id)){
            $data = array('status' => 'success');
        } else {
            $data = array('status' => 'failed');
        }

        echo json_encode($data);
        exit();
    }

    public function position_person(){
        $position = $this->input->post('position');
        $people = $this->m_resource->get_person_position($position);

        if(!empty($people)){
            $data = array('status' => 'success', 'data' => $people);
        } else {
            $data = array('status' => 'failed');
        }

        echo json_encode($data);
        exit();
    }
}
