<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include dirname(__FILE__).DIRECTORY_SEPARATOR.'SsoClient/ClientAPI.php';

class Implementation extends CI_Controller {

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
		$this->load->model('Implementation_model', 'm_implement');
		$this->load->model('Administration_model', 'm_admin');
		$this->load->model('IssueRisk_model', 'm_issue');
		$this->load->model('Planning_model', 'm_planning');

		//TODO: create an object and call a class method
		$ClientApi = new ClientAPI();
		$ClientApi->doCurl();
	}

	public function index()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Implementation</span>';

		$this->load->view('implementation/implementation_view', $data);
	}

	public function progressTracking()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Implementation</span> - Progress Tracking';

		$this->load->view('implementation/progress_tracking_view', $data);
	}

	public function progressTask()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Implementation</span> - Progress Task';

		$this->load->view('implementation/progress_task_view', $data);
	}

	public function dailyProgress()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Daily Progress Report</span>';
		$data['projects'] = $this->m_planning->getAllProject();
		$data['pic'] = $this->m_admin->getActiveUser();
		$data['work_location'] = $this->m_admin->getWorkLocation();

		$this->load->view('implementation/form_daily_progress', $data);
	}

	public function save_progress(){
		if($this->m_implement->saveDailyProgress()){
			$this->session->set_flashdata('message', 'Daily Progress has been saved');
			redirect('implementation/dailyProgress');
		}
	}

	public function save_progress2(){
		$id = $this->input->post('project_id');
		if($this->m_implement->saveDailyProgress2()){
			$this->session->set_flashdata('message', 'Data has been saved');
            $link = 'implementation/progress/'.$id."?tab=daily_progress";
            redirect($link);
			// $this->session->set_flashdata('message', 'Daily Progress has been saved');
			// redirect('implementation/dailyProgress');
		}
	}

	public function projectImplementationPlanXml()
	{
		$arr = array(
			'task' => array(
				'pID' => '10',
				'pName' => 'WCF Changes',
				'pStart' => '',
				'pEnd' => '',
				'pClass' => 'ggroupblack',
				'pLink' => '',
				'pMile' => '0',
				'pRes' => '',
				'pComp' => '0',
				'pGroup' => '1',
				'pParent' => '0',
				'pOpen' => '1',
				'pDepend' => ''
			)
		);
		$a = $this->assocArrayToXML('project',$arr);

		print $a;
	}
	public function project_milestone(){
    	$milestone = $this->m_implement->milestoneByGroup();
        if (!empty($milestone)) {
            $data = array('status' => 'Success', 'data' => $milestone);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function chart_value(){
    	$charts = $this->m_implement->getChartValue();
        if (!empty($charts)) {
            $data = array('status' => 'Success', 'data' => $charts);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

	public function assocArrayToXML($root_element_name,$ar)
	{
		$xml = new SimpleXMLElement("<?xml version=\"1.0\"?><$root_element_name></$root_element_name>");
		$f = create_function('$f,$c,$a','
            foreach($a as $k=>$v) {
                if(is_array($v)) {
                    $ch=$c->addChild($k);
                    $f($f,$ch,$v);
                } else {
                    $c->addChild($k,$v);
                }
            }');
		$f($f,$xml,$ar);
		return $xml->asXML();
	}

	public function daily_activity_rules()
	{
		// Get Apps Config
		$data = $this->apps->info();

		$data['page_title'] = '<span class="text-semibold">Implementation</span> - Daily Activity Rules and Scoring';

		$this->load->view('implementation/daily_rules_scoring', $data);
	}

	public function datatable_rules()
    {
        $list = $this->m_implement->get_datatable_rules();
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
            "recordsTotal" => $this->m_implement->count_all_rules(),
            "recordsFiltered" => $this->m_implement->count_filtered_rules(),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }

    public function rules_detail(){
    	$id = $this->input->post('id');
    	$rule_detail = $this->m_implement->getRuleDetail($id);
    	if(!empty($rule_detail)){
    		$data = array('status' => 'success', 'data' => $rule_detail);
    	} else {
    		$data = array('status' => 'failed');
    	}

    	echo json_encode($data);
    	exit();
    }

    public function save_rule(){
        if ($this->m_implement->saveRule()) {
            $data = array('status' => 'success');
        } else {
            $data = array('status' => 'failed');
        }
        echo json_encode($data);
        exit();
    }


    public function dataTableProgressTracking()
	{
		$list = $this->m_implement->get_datatable_progress_tracking();
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
			$row['cities'] = str_replace(",", ", ", $row['cities']);
			$row['pm_name'] = str_replace(",", ", ", $row['pm_name']);
			$data[] = $row;
		}

		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->m_planning->count_all_project(),
				"recordsFiltered" => $this->m_planning->count_filtered_project(),
				"data" => $data,
		);
		echo json_encode($output); exit;
	}

	public function progress($id)
	{	
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Implementation</span> - Daily Progress';

		// Get project detail
		$project = $this->m_planning->getProjectDetailById($id);
		$project->leader = $this->m_admin->getLeadersbyProject($id);


		// $data['project_gap'] = $this->months($id);

		// $data['area'] = $this->m_planning->workLocation();

		// $data['scope'] = $this->m_planning->getAllProjectScope();

		// $data['vendor'] = $this->m_planning->allVendor();

		/*$task_list = $this->m_planning->getTasklistByProjectId($id);

		foreach ($task_list as $key => $value) {
			$task = $this->m_planning->getTaskByProjectTaskListId($value->id);
			$task_list[$key]->task = $task;
		}

		$data['general_task'] = $this->m_planning->getTaskInGeneral($id);

		$data['task_list'] = $task_list;*/

		
		// $data['milestone_grup'] = $this->m_planning->milestoneGrup();

		// $data['milestone'] = $this->m_planning->milestones();

		// $data['project_milestone'] = $this->m_planning->getMileStone($id);

		// $data['milestones'] = $this->m_planning->getMileStone($id);


		// $data['uom'] = $this->m_planning->milestone_uom();

		// $data['user'] = array_chunk($this->m_planning->getUserByProject($id), 4);

		// $data['position'] = $this->m_planning->getPosition();

		// $data['resource'] = $this->m_admin->getActiveUser();

		// $data['project_coordi'] = $this->m_planning->pcOnProject($id);

		// $data['page_title'] = '<span class="text-semibold"></span>' . $project->project_name . ' <small>' . $project->company . '</small>';

		$data['project_id'] = $id;

		// //For Tab Overview
		// $data['project'] = $project;
		// $data['km_cable'] = $this->m_planning->getMileStoneDetailByProjectId($id,'10');
		// $data['scope_of_work'] = $this->m_planning->getMileStone($id);
		// $data['vendor_info'] = $this->m_planning->getAllVendorByProjectId($id);

		//For Tab Tab and Assignment
		$data['total_issue'] = $this->m_issue->getTotalIssueRiskByProjectId($id);
		$data['open_issue'] = $this->m_issue->getTotalOpenIssueRiskByProjectId($id);
		$data['close_issue'] = $this->m_issue->getTotalCloseIssueRiskByProjectId($id);

		$data['active_tab'] = "";
		if(!empty($_GET)){
			$data['active_tab'] = $_GET['tab'];
		}

		$this->load->view('implementation/progress_detail_view', $data);
	}


}
