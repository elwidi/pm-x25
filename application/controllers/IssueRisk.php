<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include dirname(__FILE__).DIRECTORY_SEPARATOR.'SsoClient/ClientAPI.php';

class IssueRisk extends CI_Controller {

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
        $this->load->model('IssueRisk_model', 'm_risk');
        $this->load->model('Planning_model', 'm_plan');
        $this->load->model('Resource_model', 'm_resource');

        //TODO: create an object and call a class method
        $ClientApi = new ClientAPI();
        $ClientApi->doCurl();
    }

    public function index()
    {
        // Get Apps Config
        $data = $this->apps->info();
        $data['page_title'] = '<span class="text-semibold">Issue & Risk</span>';
        $data['project'] = $this->m_plan->getProjects();
        $data['scope'] = $this->m_plan->getAllProjectScope();
        $data['resource'] = $this->m_resource->getAllResource();
        $data['cat'] = $this->m_risk->allCategory();

        /*if(!empty($_POST)){
            var_dump($this->input->post(null, true)); exit();
        }*/

        if($this->input->post('submit_form')){
            $issue_id = $this->input->post('issue_id');
            if(!empty($issue_id)){
                if(!empty($_FILES['attach_doc']['name'])){
                    $upload = $this->uploadFile('attach_doc');
                    if(isset($upload['upload_data'])){
                        $attc = $upload['upload_data']['file_name'];
                        if($this->m_risk->updateIssueRisk($attc)){
                            $this->session->set_flashdata('message', 'Data has been saved');
                            redirect('issueRisk/');
                        }
                    }
                } else {
                    if($this->m_risk->updateIssueRisk($attc)){
                        $this->session->set_flashdata('message', 'Data has been saved');
                        redirect('issueRisk/');
                    }
                }
            } else {
                if(!empty($_FILES['attach_doc']['name'])){
                    $upload = $this->uploadFile('attach_doc');
                    if(isset($upload['upload_data'])){
                        $attc = $upload['upload_data']['file_name'];
                        if($this->m_risk->saveNewIssueRisk($attc)){
                            $this->session->set_flashdata('message', 'Data has been saved');
                            redirect('issueRisk/');
                        }
                    }
                } else {
                    if($this->m_risk->saveNewIssueRisk($attc)){
                        $this->session->set_flashdata('message', 'Data has been saved');
                        redirect('issueRisk/');
                    }
                }
            }

        }

        $this->load->view('issue_risk/list_issue_risk_register', $data);
    }

    public function updateFollowUp(){
        $ind ='attachment'.$this->input->post('idx');
        $attachment = array();
        if($this->input->post('submit_followup')){
            if(!empty($_FILES[$ind]['name'])){
                foreach($_FILES as $key => $value){
                    $upload = $this->uploadFile($key);
                    if(isset($upload['upload_data'])){
                        $attc = $upload['upload_data']['file_name'];
                        $idx = str_replace("attachment", "", $key);
                        $attachment[$idx] = $attc;
                    }
                }

                if($this->m_risk->saveFollowUp($attachment)){
                    $this->session->set_flashdata('message', 'Data has been saved');
                    redirect('issueRisk/');
                }
            } else {
                if($this->m_risk->saveFollowUp()){
                    $this->session->set_flashdata('message', 'Data has been saved');
                    redirect('issueRisk/');
                }
            }
        } else {
            if(!empty($_FILES['closing_attc']['name'])){
                $upload = $this->uploadFile('closing_attc');
                if(isset($upload['upload_data'])){
                    $attc = $upload['upload_data']['file_name'];
                    $attachment = $attc;
                }
                if($this->m_risk->close($attachment)){
                    $this->session->set_flashdata('message', 'Data has been saved');
                    redirect('issueRisk/');
                }
            } else {
                if($this->m_risk->close()){
                    $this->session->set_flashdata('message', 'Data has been saved');
                    redirect('issueRisk/');
                }
            }
        }
    }

    public function detail($id)
    {
        $issueRisk = $this->m_risk->getIssueRiskDetail($id);
        if (!empty($issueRisk)) {
            $issueRisk->created_date = date('d-m-Y', strtotime($issueRisk->created_date));
            $issueRisk->raised_date = date('d-m-Y', strtotime($issueRisk->raised_date));
            $data = array('status' => 'Success', 'data' => $issueRisk);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function create()
    {
        // var_dump($_FILES); exit;
        if ($this->m_risk->saveNewIssueRisk()) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }


    public function update()
    {
        if ($this->m_risk->updateIssueRisk()) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

    public function followUp($id){
        $followUp = $this->m_risk->getFollowUp($id);
        foreach ($followUp as $key => $value) {
            $followUp[$key]->follow_up_date = date('d-m-Y',strtotime($value->follow_up_date));
        }
        if (!empty($followUp)) {
            $data = array('status' => 'Success', 'data' => $followUp);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function datatableIssueRisk()
    {
        $list = $this->m_risk->get_datatable_issueRisk();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $mta) {
            $no++;
            $row = array();
            $jumlah_attc = $this->m_risk->countAttachment($mta->id);
            $row['attc'] = $jumlah_attc[0]->attc;
            $row['no'] = $no;
            $row['closable'] = 0;
            if(!empty($mta->target_to_close)){
                $a = round((strtotime(date('Y-m-d')) - strtotime($mta->target_to_close)) / (60 * 60 * 24));
                if($a > 0){
                    $row['over'] = "1";
                } else {
                    $row['over'] = "0";
                }
            } else {
                $row['over'] = "0";
            }
            // $row['today'] = date('Y-m-d H:i:s');
            $follow_up = $this->m_risk->getFollowUp($mta->id);
            if(!empty($follow_up)){
                $row['closable'] = 1;
            }
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
            "recordsTotal" => $this->m_risk->count_filtered_issueRisk(),
            "recordsFiltered" => $this->m_risk->count_all_issueRisk(),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }

    public function delete()
    {
        $issueId = $this->input->post('id');
        if ($this->m_risk->deleteIssueRisk($issueId)) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

    public function close()
    {
        /*$issueId = $this->input->post('issue');
        if ($this->m_risk->close($issueId)) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();*/

        if(!empty($_FILES['closing_attc']['name'])){
            $upload = $this->uploadFile('closing_attc');
            if(isset($upload['upload_data'])){
                $attc = $upload['upload_data']['file_name'];
                $attachment = $attc;
            }
            if($this->m_risk->close($attachment)){
                $this->session->set_flashdata('message', 'Data has been saved');
                redirect('issueRisk/');
            }
        } else {
            if($this->m_risk->close()){
                $this->session->set_flashdata('message', 'Data has been saved');
                redirect('issueRisk/');
            }
        }
    }

    public function uploadFile($input){
        // $config['upload_path'] = '/var/www/project.apps.moratelindo.co.id/public_html/assets/file/issue_risk/';
        $config['upload_path'] = 'assets/file/issue_risk/';

        $config['allowed_types'] = '*';

        //not overwrite if same file name exist, add index instead.
        $config['overwrite'] = false;

        //max size file
        $config['max_size'] = 5*1024;

        //call upload lib
        $this->load->library('upload', $config);

        //do upload action
        if (!$this->upload->do_upload($input)){
            $returns = array('error' => $this->upload->display_errors());
        }else{
            $returns = array('upload_data' => $this->upload->data());
        }
        return $returns;
    }

    public function generateId(){
        $id = $this->input->post('project_id');
        $issueNo = $this->m_risk->generateIssueId($id);

        if (!empty($issueNo)) {
            $data = array('status' => 'Success', 'data' => $issueNo);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function attachment()
    {
        $id = $this->input->post('issue_id');
        $attachment = $this->m_risk->getAllAttachment($id);
        if (!empty($attachment)) {
            $data = array('status' => 'Success', 'data' => $attachment);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function actions()
    {
        $id = $this->input->post('issue_id');
        $attachment = $this->m_risk->followUpandClosing($id);
        if (!empty($attachment)) {
            $data = array('status' => 'Success', 'data' => $attachment);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function tesmail()
    {
        $this->m_risk->sendEmailOpenIssueRegister();
    }

    public function expExcel(){
        require_once("assets/source/Excel_Reader/PHPExcel.php");
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue('B1', 'Report Issue Register')
                                    ->setCellValue('C1', date('d M Y'));

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'No');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', 'Date');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', 'No Issue Register');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', 'Project');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', 'Project Scope');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', 'Category');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', 'Issue Risk Desc');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H3', 'Project Manager');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I3', 'PIC');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J3', 'Raised by');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K3', 'Raised Date');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L3', 'Target to Close');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M3', 'Potential Impact');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N3', 'Issue or Risk');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O3', 'Level Of Attention');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P3', 'Status');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q3', 'Current Response');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R3', 'Current Response Date');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S3', 'Further Action');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T3', 'Further Action Date');

        $data = $this->m_risk->issueRiskExcel();

        $row = 4;
        $no = 1;

        foreach ($data as $key => $value) {
            $raised_date = '';
            if($value->raised_date!=''){
                $raised_date = date('d-M-Y',strtotime($value->raised_date));
            }

            $target_to_close = '';
            if($value->target_to_close!=''){
                $target_to_close = date('d-M-Y',strtotime($value->target_to_close));
            }
            $target_to_close = '';
            if($value->target_to_close!=''){
                $target_to_close = date('d-M-Y',strtotime($value->target_to_close));
            }

            $aging = 0;
            if($raised_date!='' && $target_to_close!=''){
                $raise_date = strtotime($value->raised_date);
                $due_date = strtotime($value->target_to_close);
                $datediff = $due_date - $raise_date;
                $aging =  round($datediff / (60 * 60 * 24));
            }

            $created_date = date('d-M-Y', strtotime($value->created_date));

            $current_response_date = '';
            if($value->current_response_date!=''){
                $current_response_date = date('d-M-Y',strtotime($value->current_response_date));
            }

            $further_action_date = '';
            if($value->further_action_date!=''){
                $further_action_date = date('d-M-Y',strtotime($value->further_action_date));
            }

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'. $row, $no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'. $row, $created_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'. $row, $value->issue_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'. $row, $value->project_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'. $row, $value->project_scope);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'. $row, $value->type_of_issue_risk);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'. $row, $value->issue_risk);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'. $row, $value->pm_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'. $row, $value->pic_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'. $row, $value->raised_by);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'. $row, $raised_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'. $row, $target_to_close);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'. $row, $value->potential_impact);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'. $row, $value->issue_or_risk);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'. $row, $value->issue_only);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'. $row, $value->status);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'. $row, $value->current_response);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'. $row, $current_response_date);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'. $row, $value->further_action);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'. $row, $further_action_date);

            $row++;
            $no++;

           /* $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'. $row, $no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'. $row, $value->issue_no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'. $row, $value->issue_risk);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'. $row, $value->project_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'. $row, $value->type_of_issue_risk);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'. $row, date('d-M-Y', strtotime($value->raised_date)));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'. $row, $value->status);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'. $row, $target_to_close);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'. $row, $aging." days");
            $row++;
            $no++;*/
        }

        foreach(range('A','T') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=" Report Issue Register '.date('d M Y').'.xlsx"');
        ob_get_clean();
        $objWriter->save("php://output");
    }


    public function issueCategories(){
        $data = $this->apps->info();
        $data['page_title'] = '<span class="text-semibold">Issue Category</span> - List';
        $this->load->view('issue_risk/list_issue_categories', $data);
    }

    public function datatableIssueCategories()
    {
        $list = $this->m_risk->get_datatable_issue_categories();
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
            "recordsTotal" => $this->m_risk->count_all_issue_categories(),
            "recordsFiltered" => $this->m_risk->count_filtered_issue_categories(),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }

    public function projectScope(){
        $data = $this->apps->info();
        $data['page_title'] = '<span class="text-semibold">Project Scope</span> - List';
        $this->load->view('issue_risk/list_project_scopes', $data);
    }


    public function datatableProjectScope()
    {
        $list = $this->m_risk->get_datatable_project_scopes();
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
            "recordsTotal" => $this->m_risk->count_all_issue_categories(),
            "recordsFiltered" => $this->m_risk->count_filtered_issue_categories(),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }



}
