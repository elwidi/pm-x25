<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include dirname(__FILE__).DIRECTORY_SEPARATOR.'SsoClient/ClientAPI.php';

class Planning extends CI_Controller {

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
		$this->load->model('Planning_model', 'm_planning');
		$this->load->model('IssueRisk_model', 'm_issue');
		$this->load->model('Administration_model', 'm_admin');

		//TODO: create an object and call a class method
		$ClientApi = new ClientAPI();
		$ClientApi->doCurl();
	}

	public function index()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Home</span> - Dashboard <small>Hello, ' . $data["obj_fullname"] .'!</small>';
		$this->load->view('planning/dashboard_view', $data);
		//$this->all();
	}

	public function allProject()
	{
		// Get Apps Config
		$data = $this->apps->info();

		$data['page_title'] = '<span class="text-semibold">Planning</span> - Project List';

		if(!empty($data['userRole'])){
			$this->load->view('planning/list_projects_view', $data);
		} else {
			$this->load->theme('Limitless-full-formal');
			$this->load->view('no_access');
		}
	}

	public function id($id)
	{
		// Get Apps Config
		$data = $this->apps->info();

		// Get project detail
		$project = $this->m_planning->getProjectDetailById($id);
		$project->leader = $this->m_admin->getLeadersbyProject($id);

		$data['project'] = $project;

		$data['project_gap'] = $this->months($id);

		$data['area'] = $this->m_planning->workLocation();

		$data['scope'] = $this->m_planning->getAllProjectScope();

		$data['vendor'] = $this->m_planning->allVendor();

		$task_list = $this->m_planning->getTasklistByProjectId($id);

		foreach ($task_list as $key => $value) {
			$task = $this->m_planning->getTaskByProjectTaskListId($value->id);
			$task_list[$key]->task = $task;
		}

		$data['general_task'] = $this->m_planning->getTaskInGeneral($id);

		$data['task_list'] = $task_list;

		
		$data['milestone_grup'] = $this->m_planning->milestoneGrup();

		$data['milestone'] = $this->m_planning->milestones();

		$data['project_milestone'] = $this->m_planning->getMileStone($id);

		$data['milestones'] = $this->m_planning->getMileStone($id);

		$data['km_cable'] = $this->m_planning->getMileStoneDetailByProjectId($id,'10');

		$data['uom'] = $this->m_planning->milestone_uom();

		$data['user'] = array_chunk($this->m_planning->getUserByProject($id), 4);

		$data['position'] = $this->m_planning->getPosition();

		$data['resource'] = $this->m_admin->getActiveUser();

		$data['page_title'] = '<span class="text-semibold"></span>' . $project->project_name . ' <small>' . $project->company . '</small>';

		$data['project_id'] = $id;

		//For Tab Overview
		$data['project'] = $project;
		$data['km_cable'] = $this->m_planning->getMileStoneDetailByProjectId($id,'10');
		$data['scope_of_work'] = $this->m_planning->getMileStone($id);
		$data['vendor_info'] = $this->m_planning->getAllVendorByProjectId($id);

		//For Tab Tab and Assignment
		$data['total_issue'] = $this->m_issue->getTotalIssueRiskByProjectId($id);
		$data['open_issue'] = $this->m_issue->getTotalOpenIssueRiskByProjectId($id);
		$data['close_issue'] = $this->m_issue->getTotalCloseIssueRiskByProjectId($id);

		$data['active_tab'] = "";
		if(!empty($_GET)){
			$data['active_tab'] = $_GET['tab'];
		}

		$this->load->view('planning/projects_detail_view', $data);
	}

	public function months($id){
		$project = $this->m_planning->getProjectDetailById($id);
		$e = date('Y-m-01', strtotime($project->start_date));
		$f = date('Y-m-01', strtotime($project->end_date));
		
		$datetime1 = date_create($e);
        $datetime2 = date_create($f);
       
        $days = date_diff($datetime1, $datetime2);
        $year = $days->format('%y');
        $months = $days->format('%m');

        if($year >= 1){
        	$months += 12 * $year;
        }
        $mths = array();
        $mths[] = array(
        	'full' => date('Y-m-d', strtotime($project->start_date)),
        	'month' => date('M', strtotime($project->start_date)),
        	'year' => date('Y', strtotime($project->start_date))
        );
        for ($i=0; $i < $months-1; $i++) { 
			$last = end($mths);
			$mth = array();
			$mth['full'] = date('Y-m-d', strtotime("+1 month", strtotime($last['full'])));
			$mth['month'] = date('M', strtotime("+1 month", strtotime($last['full'])));
			$mth['year'] = date('Y', strtotime("+1 month", strtotime($last['full'])));
			$mths[] = $mth;
		}

		if(date('M y', strtotime($project->start_date)) == date('M y', strtotime($project->end_date))){

		} else {
			$mths[] = array(
	        	'month' => date('M', strtotime($project->end_date)),
	        	'year' => date('Y', strtotime($project->end_date))
	        );

		}

		
        return $mths;
	}


	public function months_json(){
		$id = $this->input->post('id');
		$months = $this->months($id);

		echo json_encode($months);
		exit();
	}


	public function dataTableProjectList()
	{
		$list = $this->m_planning->get_datatable_project();
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
				"recordsTotal" => $this->m_planning->count_all_project(),
				"recordsFiltered" => $this->m_planning->count_filtered_project(),
				"data" => $data,
		);
		echo json_encode($output); exit;
	}

	public function dataTableMilestone()
	{
		$this->load->library('Datatable', array('model' => 'Milestone_dt', 'rowIdCol' => 'a.id'));

		$jsonArray = $this->datatable->datatableJson(array(
			//'a.delivery_date' => 'date',
			//'a.unit_price' => 'currency'
		));

		$this->output->set_header("Pragma: no-cache");
		$this->output->set_header("Cache-Control: no-store, no-cache");
		$this->output->set_content_type('application/json')->set_output(json_encode($jsonArray));
	}

	public function dataTableTaskList()
	{
		$this->load->library('Datatable', array('model' => 'Task_list_dt', 'rowIdCol' => 'a.id'));

		$jsonArray = $this->datatable->datatableJson(array(
			//'a.delivery_date' => 'date',
			//'a.unit_price' => 'currency'
		));

		$this->output->set_header("Pragma: no-cache");
		$this->output->set_header("Cache-Control: no-store, no-cache");
		$this->output->set_content_type('application/json')->set_output(json_encode($jsonArray));
	}

	public function dataTablePeople()
	{
		$this->load->library('Datatable', array('model' => 'People_dt', 'rowIdCol' => 'a.id'));

		$jsonArray = $this->datatable->datatableJson(array(
			//'a.delivery_date' => 'date',
			//'a.unit_price' => 'currency'
		));

		$this->output->set_header("Pragma: no-cache");
		$this->output->set_header("Cache-Control: no-store, no-cache");
		$this->output->set_content_type('application/json')->set_output(json_encode($jsonArray));
	}

	public function saveProject()
	{
		// var_dump($this->input->post(null,true)); exit;
		if ($this->m_planning->saveProject()) {
			$data = array('status' => 'Success');
		} else {
			$data = array('status' => 'Failed');
		}

		echo json_encode($data);
		exit();
	}

	public function getUsers()
	{
		$users = $this->m_planning->getAllUser();
		if (!empty($users)) {
			$data = array('status' => 'Success', 'data' => $users);
		} else {
			$data = array('status' => 'Failed', 'data' => '');
		}

		echo json_encode($data);
		exit();
	}

	public function getTaskList()
	{
		$project_id = $this->input->post('project_id');
		$task_list = $this->m_planning->getAllTaskList($project_id);
		if (!empty($task_list)) {
			$data = array('status' => 'Success', 'data' => $task_list);
		} else {
			$data = array('status' => 'Failed', 'data' => '');
		}

		echo json_encode($data);
		exit();
	}

	public function saveTask()
	{
		if ($this->m_planning->saveTask()) {
			$data = array('status' => 'Success');
		} else {
			$data = array('status' => 'Failed');
		}

		echo json_encode($data);
		exit();
	}

	public function saveTaskList()
	{
		// var_dump($this->input->post(null, true)); exit();
		if ($this->m_planning->saveTaskList()) {
			$data = array('status' => 'Success');
		} else {
			$data = array('status' => 'Failed');
		}

		echo json_encode($data);
		exit();
	}

	public function saveMilestone()
	{
		if ($this->m_planning->saveMilestone()) {
			$data = array('status' => 'Success');
		} else {
			$data = array('status' => 'Failed');
		}

		echo json_encode($data);
		exit();
	}

	public function editMilestone()
	{
		if ($this->m_planning->saveEditMilestone()) {
			$data = array('status' => 'Success');
		} else {
			$data = array('status' => 'Failed');
		}

		echo json_encode($data);
		exit();
	}

	public function updateTask()
	{
		if ($this->m_planning->saveEditTask()) {
			$data = array('status' => 'Success');
		} else {
			$data = array('status' => 'Failed');
		}

		echo json_encode($data);
		exit();
	}

	public function attachTaskList()
	{
		if ($this->m_planning->attachTaskList()) {
			$data = array('status' => 'Success');
		} else {
			$data = array('status' => 'Failed');
		}

		echo json_encode($data);
		exit();
	}

	public function deleteTask()
	{
		$taskId = $this->input->post('taskId');
		if ($this->m_planning->deleteTask($taskId)) {
			$data = array('status' => 'Success');
		} else {
			$data = array('status' => 'Failed');
		}

		echo json_encode($data);
		exit();
	}

	public function getPeopleNotInProject($project_id)
	{
		$users = $this->m_planning->getPeopleOutsideProject($project_id);
		if (!empty($users)) {
			$data = array('status' => 'Success', 'data' => $users);
		} else {
			$data = array('status' => 'Failed', 'data' => '');
		}

		echo json_encode($data);
		exit();
	}

	public function getPeopleInProject($project_id)
	{
		$users = $this->m_planning->getPeopleInProject($project_id);
		if (!empty($users)) {
			$data = array('status' => 'Success', 'data' => $users);
		} else {
			$data = array('status' => 'Failed', 'data' => '');
		}

		echo json_encode($data);
		exit();
	}

	public function addUser()
	{
		if ($this->m_planning->saveUser()) {
			$data = array('status' => 'Success');
		} else {
			$data = array('status' => 'Failed');
		}

		echo json_encode($data);
		exit();
	}

	public function updateAssignee()
	{
		if ($this->m_planning->updateAssignee()) {
			$data = array('status' => 'Success');
		} else {
			$data = array('status' => 'Failed');
		}

		echo json_encode($data);
		exit();
	}

	public function getCompany()
	{
		$company = $this->m_planning->getAllCompany();
		if (!empty($company)) {
			$data = array('status' => 'Success', 'data' => $company);
		} else {
			$data = array('status' => 'Failed', 'data' => '');
		}

		echo json_encode($data);
		exit();
	}

	public function getProjectScope()
	{
		$scope = $this->m_planning->getAllProjectScope();
		if (!empty($scope)) {
			$data = array('status' => 'Success', 'data' => $scope);
		} else {
			$data = array('status' => 'Failed', 'data' => '');
		}

		echo json_encode($data);
		exit();
	}

	public function getResource()
	{
		$resource = $this->m_planning->getAllResource();
		if (!empty($resource)) {
			$data = array('status' => 'Success', 'data' => $resource);
		} else {
			$data = array('status' => 'Failed', 'data' => '');
		}

		echo json_encode($data);
		exit();
	}

	public function projectTaskList($id)
	{
		$task_list = $this->m_planning->getTasklistByProjectId($id);

		$test = array();

		$u = 1;
		if(!isset($_POST['page']) || $_POST['page'] == 0){
			$general['title'] = "General Task";
			$general['key'] = $u;
			$general['due_date'] = " ";
			$general['folder'] = true;
			$general['expanded'] = true;
			$general['task_id'] = " ";
			$x['progress'] = " ";
			$general_task = $this->m_planning->getTaskInGeneral($id);
			$g_children = array();
			if(!empty($general_task)){
				foreach ($general_task as $key => $value) {
					$g['key'] = $u.".".$key;
					$g['title'] = $value->tasks_name;
					$g['id'] = $value->id;
					$g['children'] = $this->percobaan($value->id);
					$x['progress'] = $value->progress;
					$due_date = date('d-m-Y', strtotime($value->due_date));
					if(empty($value->due_date)){
						$due_date = "-";
					}
					$g['due_date'] = $due_date;
					$g_children[] = $g;
				}

				$general['children'] = $g_children;
				$test[] = $general;
			}
		}


		foreach ($task_list as $key => $value) {
			$a['title'] = $value->task_list_name;
			$a['key'] = $u+$key+1;
			$a['due_date'] = " ";
			$a['folder'] = true;
			$a['expanded'] = true;
			$a['id'] = " ";
			$a['progress'] = "";
			$task = $this->m_planning->getTaskByProjectTaskListId($value->id);

			$children = array();
			foreach ($task as $key => $value) {
				$x['key'] = $u.".".$key;
				$x['progress'] = $value->progress;
				$x['title'] = $value->tasks_name;
				$x['expanded'] = true;
				$x['id'] = $value->id;
				$due_date = date('d-m-Y', strtotime($value->due_date));
				if(empty($value->due_date)){
					$due_date = "-";
				}
				$x['due_date'] = $due_date;
				$x['children'] = $this->percobaan($value->id);
				$children[] = $x;
			}

			$a['children'] = $children;

			$test[] = $a;
		}


		if (!empty($_POST['searchvalue'])){
			$child2 = array();
			$task2 = $this->m_planning->searchTaskByProjectId($id);
			if(!empty($task2)){
				foreach ($task2 as $key => $value) {
					if(!empty($test)){
						$match = 0;
						foreach($test as $idx => $value2){
							if($value2['title'] == $value->task_list_name){
								$match += 1;
								$children2 = array();
								$d['key'] = $u.".".$key;
								$d['title'] = $value->tasks_name;
								$d['due_date'] = date('d-m-Y', strtotime($value->due_date));
								$d['id'] = $value->id;
								$d['progress'] = $value->progress;

								$test[$idx]['children'][] = $d;
							} else {
								if($match == 0){
									$s = array();
									$children2 = array();
									$s['title'] = $value->task_list_name;
									$s['key'] = $key+1;
									$s['due_date'] = " ";
									$s['folder'] = true;
									$s['expanded'] = true;
									$d['key'] = $u.".".$key;
									$d['title'] = $value->tasks_name;
									$d['id'] = $value->id;
									$d['progress'] = $value->progress;

									$due_date = date('d-m-Y', strtotime($value->due_date));
									if(empty($value->due_date)){
										$due_date = "-";
									}
									$d['due_date'] = $due_date;
									$children2[] = $d;
									$s['children'] = $children2;
									$test[] = $s;
								}
							}
						}
					} else {
						$s = array();
						$children2 = array();
						$s['title'] = $value->task_list_name;
						$s['key'] = $key+1;
						$s['due_date'] = " ";
						$s['folder'] = true;
						$s['expanded'] = true;
						$d['key'] = $u.".".$key;
						$d['title'] = $value->tasks_name;
						$d['id'] = $value->id;
						$d['progress'] = $value->progress;

						$due_date = date('d-m-Y', strtotime($value->due_date));
						if(empty($value->due_date)){
							$due_date = "-";
						}
						$d['due_date'] = $due_date;
						$children2[] = $d;
						$s['children'] = $children2;
						$test[] = $s;
					}

				}
			}
		}
		echo json_encode($test);
	}

	public function getProjectDetail($project_id)
	{
		$users = $this->m_planning->getProjectById($project_id);
		if (!empty($users)) {
			$data = array('status' => 'Success', 'data' => $users);
		} else {
			$data = array('status' => 'Failed', 'data' => '');
		}

		echo json_encode($data);
		exit();
	}

	public function taskDetail($taskId)
	{
		$task = $this->m_planning->getTaskDetail($taskId);
		if (!empty($task)) {
			$data = array('status' => 'Success', 'data' => $task);
		} else {
			$data = array('status' => 'Failed', 'data' => '');
		}

		echo json_encode($data);
		exit();
	}

	public function getMilestoneDetail($milestone_id)
	{
		$users = $this->m_planning->getMilestoneById($milestone_id);
		if (!empty($users)) {
			$data = array('status' => 'Success', 'data' => $users);
		} else {
			$data = array('status' => 'Failed', 'data' => '');
		}

		echo json_encode($data);
		exit();
	}

	public function editProject(){
		if ($this->m_planning->saveEditProject()) {
			$data = array('status' => 'Success');
		} else {
			$data = array('status' => 'Failed');
		}

		echo json_encode($data);
		exit();
	}

	public function percobaan($task_id){
		$a = $this->m_planning->getAllSubtask($task_id);
		return $a;
	}

	public function saveProgress(){
		if ($this->m_planning->saveProgress()) {
			$data = array('status' => 'Success');
		} else {
			$data = array('status' => 'Failed');
		}

		echo json_encode($data);
		exit();

	}

	public function getProjects()
    {
        $projects = $this->m_planning->getProjects();
        if (!empty($projects)) {
            $data = array('status' => 'Success', 'data' => $projects);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

	public function customer()
	{
		// Get Apps Config
		$data = $this->apps->info();

		$data['page_title'] = '<span class="text-semibold">Planning</span> - Project List';

		$this->load->view('planning/list_customer', $data);
	}

	public function datatableCustomer()
    {
        $list = $this->m_planning->get_datatable_customer();
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
            "recordsTotal" => $this->m_planning->count_filtered_customer(),
            "recordsFiltered" => $this->m_planning->count_all_customer(),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }

    public function add_customer()
    {
        if ($this->m_planning->saveNewCustomer()) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

    public function detail_customer()
    {
    	$id = $this->input->post('id');
        $customer = $this->m_planning->getCustomerDetail($id);
        if (!empty($customer)) {
            $data = array('status' => 'Success', 'data' => $customer);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function update_customer()
    {
        if ($this->m_planning->updateCustomer()) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

    public function delete_customer()
    {
    	$id = $this->input->post('id');
        if ($this->m_planning->deleteCustomer($id)) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

    public function all_customer()
    {
        $customers = $this->m_planning->getAllCustomer();
        if (!empty($customers)) {
            $data = array('status' => 'Success', 'data' => $customers);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }
    
    public function projectId()
    {
        $projectId = $this->m_planning->generateProjectId();
        if (!empty($projectId)) {
            $data = array('status' => 'Success', 'data' => $projectId);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function check_existing()
    {
    	$id = $this->input->post('project_id');
        $existing = $this->m_planning->checkExistingProjectId($id);
        if (!empty($existing)) {
            $data = array('status' => 'Success', 'data' => $existing);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function saveMils(){
    	$id = $this->input->post('project_id');
    	if($this->m_planning->saveMilstones()){
            $this->session->set_flashdata('message', 'Data has been saved');
            $link = 'planning/id/'.$id."?tab=milestone";
            redirect($link);
        }
    }

    public function milestone(){
    	$id = $this->input->post('project_id');
    	$milestone = $this->m_planning->getMilestoneProject($id);
        if (!empty($milestone)) {
            $data = array('status' => 'Success', 'data' => $milestone);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function saveMsValue(){
    	$id = $this->input->post('project_id');
    	if($this->m_planning->saveValueMils()){
            $this->session->set_flashdata('message', 'Data has been saved');
            $link = 'planning/id/'.$id."?tab=milestone";
            redirect($link);
        }
    }

    public function project_milestone(){
    	$milestone = $this->m_planning->milestoneByGroup();
        if (!empty($milestone)) {
            $data = array('status' => 'Success', 'data' => $milestone);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function get_status()
    {
        $projects = $this->m_planning->listStatus();
        if (!empty($projects)) {
            $data = array('status' => 'Success', 'data' => $projects);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function vendors()
	{
		// Get Apps Config
		$data = $this->apps->info();

		$data['page_title'] = '<span class="text-semibold">Planning</span> - Vendor List';

		$this->load->view('planning/list_vendor', $data);
	}

	public function datatable_vendor(){
        $list = $this->m_planning->get_datatable_vendor();
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
            "recordsTotal" => $this->m_planning->count_filtered_customer(),
            "recordsFiltered" => $this->m_planning->count_all_customer(),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }

    public function save_vendor(){
        if ($this->m_planning->saveVendor()) {
            $data = array('status' => 'success');
        } else {
            $data = array('status' => 'failed');
        }
        echo json_encode($data);
        exit();
    }

    public function vendor_detail()
    {	
    	$id = $this->input->post('id');
        $vendor = $this->m_planning->vendorDetail($id);
        if (!empty($vendor)) {
            $data = array('status' => 'Success', 'data' => $vendor);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function delete_vendor()
    {
    	$id = $this->input->post('id');
        if ($this->m_planning->deleteVendor($id)) {
            $data = array('status' => 'Success');
        } else {
            $data = array('status' => 'Failed');
        }

        echo json_encode($data);
        exit();
    }

    public function save_plan(){
    	$id = $this->input->post('project_id');
    	if($this->m_planning->savePlan()){
			$this->session->set_flashdata('message', 'Daily Progress has been saved');
			redirect('planning/id/'.$id."?tab=milestone");
		}
    }

    public function get_plan(){
        $id = $this->input->post('id');
        $planning = $this->m_planning->getProjectPlanning($id);
        if (!empty($planning)) {
        	$this_month = $this->m_planning->getThisMonthPlanning($id);

        	if(!empty($this_month)){
        		$month_plan = $this_month->plan;
	        	$month_actual = $this_month->actual;
	        	$data = array(
	        		'all' => $planning,
	        		'month_plan' => $month_plan,
	        		'month_actual' => $month_actual
	        	);
        	} else {
        		$data = array(
	        		'all' => $planning,
	        		'month_plan' => 0,
	        		'month_actual' => 0
	        	);
        	}
        	
            $data = array('status' => 'Success', 'data' => $data);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function delete_milestone(){
    	$id = $this->input->post('id');
        if ($this->m_planning->deleteMilestone($id)) {
            $data = array('status' => 'success');
        } else {
            $data = array('status' => 'failed');
        }
        echo json_encode($data);
        exit();
    }

    public function get_work_location(){
    	$work_location = $this->m_planning->workLocation();
    	if(!empty($work_location)){
    		$data = array('status' => 'success', 'data' => $work_location);
    	} else {
    		$data = array('status' => 'failed');
    	}

    	echo json_encode($data);
    	exit();
    }

    public function datatable_vendor_project($id){
        $list = $this->m_planning->get_datatable_project_vendor($id);
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
            "recordsTotal" => $this->m_planning->count_all_project_vendor($id),
            "recordsFiltered" => $this->m_planning->count_filtered_resource_allocation($id),
            "data" => $data,
        );
        echo json_encode($output); exit;
    }


    public function save_project_vendor(){
        if($this->m_planning->saveProjectVendor()){
            $data = array('status' => 'success');
        } else {
            $data = array('status' => 'failed');
        }

        echo json_encode($data);
        exit();
    }


    public function project_vendor_detail(){
    	$id = $this->input->post('vendor');
    	$project_vendor = $this->m_planning->projectVendorDetail($id);
    	if(!empty($project_vendor)){
    		$data = array('status' => 'success', 'data' => $project_vendor);
    	} else {
    		$data = array('status' => 'failed');
    	}

    	echo json_encode($data);
    	exit();
    }

    public function project_segmen()
	{
		$project_id = $this->input->post('project_id');
		$segmen = $this->m_planning->projectSegmen($project_id);
		if (!empty($segmen)) {
			$data = array('status' => 'Success', 'data' => $segmen);
		} else {
			$data = array('status' => 'Failed', 'data' => '');
		}

		echo json_encode($data);
		exit();
	}

	public function segmen_span()
	{
		$segmen_ids = $this->input->post('ids');
		$spans = $this->m_planning->segmenSpan($segmen_ids);
		if (!empty($spans)) {
			$data = array('status' => 'Success', 'data' => $spans);
		} else {
			$data = array('status' => 'Failed', 'data' => '');
		}

		echo json_encode($data);
		exit();
	}

	public function project_vendor()
	{
		$project_id = $this->input->post('project_id');
		$vendor = $this->m_planning->projectVendor($project_id);
		if (!empty($vendor)) {
			$data = array('status' => 200, 'data' => $vendor);
		} else {
			$data = array('status' => 400, 'data' => '');
		}

		echo json_encode($data);
		exit();
	}

    /*public function generate(){
    	$r = $this->m_planning->generateProjectId();
    	var_dump($r); exit;
	}*/
	
	// Dendy 20-03-2019
	public function setUserId()
    {
        $cookie = base64_decode($_COOKIE['SSOID']);
        $crop = explode('+', $cookie);
        return $crop[0];
	}

	// Dendy 20-03-2019	
	public function upload_project_charter(){
		$filename = explode('.', $_FILES["project_charter_file"]['name']);
		$filename_encript = str_replace('-', '_', $filename[0]);
		$filename_encript = $filename_encript.'_'.time();
		$config['file_name'] = $filename_encript;
		$config['upload_path']          = './assets/file/planning/';
		$config['allowed_types']        = 'pdf';
		// $config['max_size']             = 5120;
		
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload('project_charter_file')) {
			$data = array('status' => $this->upload->display_errors());
		} else {
			$data = array('status' => 'success');

			$upload_data = $this->upload->data();
			$file_type = explode(".", $upload_data['file_ext']);

			$save_data = array(
				'project_id' => $this->input->post('project_id'),
				'filename' => $_FILES["project_charter_file"]['name'],
				'filename_encrypt' => $upload_data['file_name'],
				'document_type' => $file_type[1],
				'path' => $upload_data['file_path'],
				'created_by' => $this->setUserId(),
				'created_date' => date('Y-m-d H:i:s')
			);

			$this->m_planning->saveUploadProjectCharter($save_data);
		}

		echo json_encode($data);
	}

	// Dendy 20-03-2019
	public function datatable_project_charter($id){
        $list = $this->m_planning->get_datatable_project_charter($id);
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
            "recordsTotal" => $this->m_planning->count_all_project_charter($id),
            "recordsFiltered" => $this->m_planning->count_filtered_project_charter($id),
            "data" => $data,
        );
        echo json_encode($output); exit;
	}

    // Dendy 21-03-2019
	public function delete_project_charter()
    {
		$id = $this->input->post('id');
		$project_charter = $this->m_planning->projectCharterDetail($id);
    	if(!empty($project_charter)){
			if ($this->m_planning->deleteProjectCharter($id) && unlink($project_charter->path.$project_charter->filename_encrypt)) {
				$data = array('status' => 'Success');
			} else {
				$data = array('status' => 'Failed');
			}
    	} else {
			$data = array('status' => 'Failed');
		}

        echo json_encode($data);
        exit();
	}
	
	// Dendy 22-03-2019
	public function expExcel(){
        require_once("assets/source/Excel_Reader/PHPExcel.php");
		$objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0)
                                    ->setCellValue('B1', 'Report Project List')
                                    ->setCellValue('C1', date('d M Y'));

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'No');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', 'Project ID');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', 'Project Name');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', 'Status');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', 'Completion');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', 'Category');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', 'Issue Risk Desc');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H3', 'Project Manager');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I3', 'PIC');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J3', 'Raised by');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K3', 'Raised Date');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L3', 'Target to Close');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M3', 'Potential Impact');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N3', 'Issue or Risk');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O3', 'Level Of Attention');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P3', 'Status');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q3', 'Current Response');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R3', 'Current Response Date');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S3', 'Further Action');
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T3', 'Further Action Date');

		$data = $this->m_planning->projectListExcel();
		// echo "<pre>";
		// print_r($data);die;

        $row = 4;
        $no = 1;

        foreach ($data as $key => $value) {
            // $raised_date = '';
            // if($value->raised_date!=''){
            //     $raised_date = date('d-M-Y',strtotime($value->raised_date));
            // }

            // $target_to_close = '';
            // if($value->target_to_close!=''){
            //     $target_to_close = date('d-M-Y',strtotime($value->target_to_close));
            // }
            // $target_to_close = '';
            // if($value->target_to_close!=''){
            //     $target_to_close = date('d-M-Y',strtotime($value->target_to_close));
            // }

            // $aging = 0;
            // if($raised_date!='' && $target_to_close!=''){
            //     $raise_date = strtotime($value->raised_date);
            //     $due_date = strtotime($value->target_to_close);
            //     $datediff = $due_date - $raise_date;
            //     $aging =  round($datediff / (60 * 60 * 24));
            // }

            // $created_date = date('d-M-Y', strtotime($value->created_date));

            // $current_response_date = '';
            // if($value->current_response_date!=''){
            //     $current_response_date = date('d-M-Y',strtotime($value->current_response_date));
            // }

            // $further_action_date = '';
            // if($value->further_action_date!=''){
            //     $further_action_date = date('d-M-Y',strtotime($value->further_action_date));
            // }

            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'. $row, $no);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'. $row, $value->project_id);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'. $row, $value->project_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'. $row, $value->status);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'. $row, $value->completion);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'. $row, $value->type_of_issue_risk);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'. $row, $value->issue_risk);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'. $row, $value->pm_name);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'. $row, $value->pic_name);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'. $row, $value->raised_by);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'. $row, $raised_date);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'. $row, $target_to_close);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'. $row, $value->potential_impact);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'. $row, $value->issue_or_risk);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'. $row, $value->issue_only);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'. $row, $value->status);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'. $row, $value->current_response);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'. $row, $current_response_date);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'. $row, $value->further_action);
            // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'. $row, $further_action_date);

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
        header('Content-Disposition: attachment;filename=" Report Project List '.date('d M Y').'.xlsx"');
        ob_get_clean();
        $objWriter->save("php://output");
    }

	// Dendy 25-03-2019
	public function delete_project_vendor()
    {
		$id = $this->input->post('id');
		$project_vendor = $this->m_planning->projectVendorDeleteDetail($id);
    	if(!empty($project_vendor)){
			if ($this->m_planning->deleteProjectVendor($id)) {
				$data = array('status' => 'Success');
			} else {
				$data = array('status' => 'Failed');
			}
    	} else {
			$data = array('status' => 'Failed');
		}

        echo json_encode($data);
        exit();
	}

	// Dendy 26-03-2019
	public function datatable_project_kmz($id){
        $list = $this->m_planning->get_datatable_project_kmz($id);
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
            "recordsTotal" => $this->m_planning->count_all_project_kmz($id),
            "recordsFiltered" => $this->m_planning->count_filtered_project_kmz($id),
            "data" => $data,
        );
        echo json_encode($output); exit;
	}

	// Dendy 26-03-2019
	public function delete_project_kmz()
    {
		$id = $this->input->post('id');
		$project_kmz = $this->m_planning->projectKMZDetail($id);
    	if(!empty($project_kmz)){
			if ($this->m_planning->deleteProjectCharter($id) && unlink($project_kmz->path.$project_kmz->filename_encrypt)) {
				$data = array('status' => 'Success');
			} else {
				$data = array('status' => 'Failed');
			}
    	} else {
			$data = array('status' => 'Failed');
		}

        echo json_encode($data);
        exit();
	}

	// Dendy 26-03-2019	
	public function upload_project_kmz(){
		$filename = explode('.', $_FILES["project_kmz_file"]['name']);
		$filename_encript = str_replace('-', '_', $filename[0]);
		$filename_encript = 'KMZ_'.$filename_encript.'_'.time();
		$config['file_name'] = $filename_encript;
		$config['upload_path']          = './assets/file/planning/';
		$config['allowed_types']        = 'kmz';
		// $config['max_size']             = 0;
		
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload('project_kmz_file')) {
			$data = array('status' => $this->upload->display_errors());
		} else {
			$data = array('status' => 'success');

			$upload_data = $this->upload->data();
			$file_type = explode(".", $upload_data['file_ext']);

			$save_data = array(
				'project_id' => $this->input->post('project_id'),
				'filename' => $_FILES["project_kmz_file"]['name'],
				'filename_encrypt' => $upload_data['file_name'],
				'document_type' => 'kmz',
				'path' => $upload_data['file_path'],
				'created_by' => $this->setUserId(),
				'created_date' => date('Y-m-d H:i:s')
			);

			$this->m_planning->saveUploadProjectCharter($save_data);
		}

		echo json_encode($data);
	}

}
