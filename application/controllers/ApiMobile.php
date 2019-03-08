<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class ApiMobile extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('IssueRisk_model', 'm_risk');
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

}
