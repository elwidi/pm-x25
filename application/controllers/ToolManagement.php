<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include dirname(__FILE__).DIRECTORY_SEPARATOR.'SsoClient/ClientAPI.php';

class ToolManagement extends CI_Controller {

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
        $this->load->model('ToolManagement_model', 'm_tool');
        $this->load->model('Planning_model', 'm_plan');
        $this->load->model('Resource_model', 'm_res');

        //TODO: create an object and call a class method
        $ClientApi = new ClientAPI();
        $ClientApi->doCurl();
    }

    public function index()
    {
        // Get Apps Config
        $data = $this->apps->info();
        $data['page_title'] = '<span class="text-semibold">Tool Management</span>';
        $data['tools'] = $this->m_tool->getTools();
        $this->load->view('tool_management/list_tool', $data);
    }

    public function transmittalDaily()
    {
        // Get Apps Config
        $data = $this->apps->info();
        $data['page_title'] = '<span class="text-semibold">Transmittal Daily Tools</span>';
        $data['tools'] = $this->m_tool->getTools();
        $data['project'] = $this->m_plan->getProjects();
        $data['pic'] = $this->m_res->getAllResource();
        $this->load->view('tool_management/transmittal_daily_tools', $data);
    }

    public function datatableTools()
    {
        $list = $this->m_tool->get_datatable_tools();
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
            "recordsTotal" => $this->m_tool->count_filtered_tools(),
            "recordsFiltered" => $this->m_tool->count_all_tools(),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }

    public function addTools()
    {
        if ($this->m_tool->saveNewTool()) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

    public function detail($id)
    {
        $tool = $this->m_tool->getToolsDetail($id);
        if (!empty($tool)) {
            $data = array('status' => 'Success', 'data' => $tool);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function detailTransmit($id)
    {
        $detail = $this->m_tool->getTransmitDetail($id);
        if (!empty($detail)) {
            $data = array('status' => 'Success', 'data' => $detail);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function update()
    {
        if ($this->m_tool->updateTool()) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

    public function delete()
    {
        $toolId = $this->input->post('id');
        if ($this->m_tool->deleteTool($toolId)) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

     public function datatableTransmittalDaily()
    {
        $list = $this->m_tool->get_datatable_transmittal_daily();
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
            "recordsTotal" => $this->m_tool->count_filtered_transmittal_daily(),
            "recordsFiltered" => $this->m_tool->count_all_transmittal_daily(),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }

    public function saveTransmit()
    {
        if ($this->m_tool->saveTransmitTool()) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

    public function all_tools(){
        $tools = $this->m_tool->getTools();
        if (!empty($tools)) {
            $data = array('status' => 'Success', 'data' => $tools);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function updateTransmit()
    {
        if ($this->m_tool->updateTransmitTool()) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

    public function details(){
        $tools = $this->m_tool->getTools();
        if (!empty($tools)) {
            $data = array('status' => 'Success', 'data' => $tools);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function delete_trans()
    {
        $id = $this->input->post('id');
        if ($this->m_tool->deleteTrans($id)) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }


}
