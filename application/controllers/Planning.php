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


    /*public function generate(){
    	$r = $this->m_planning->generateProjectId();
    	var_dump($r); exit;
    }*/

}
