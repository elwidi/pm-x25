<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include dirname(__FILE__).DIRECTORY_SEPARATOR.'SsoClient/ClientAPI.php';

ini_set('max_input_vars', 3000);

class Timesheet extends CI_Controller {

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
		$this->load->model('Timesheet_model', 'm_timesheet');

		//TODO: create an object and call a class method
		$ClientApi = new ClientAPI();
		$ClientApi->doCurl();
	}

	public function weeklyWorkPlan()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Weekly Work Plan</span>';

		$this->load->view('timesheet/weekly_work_plan_view', $data);
	}

	public function weeklyActivity()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Weekly Work Activity</span>';
		$data['projects'] = $this->m_planning->getAllProject();
		$data['coordinator'] = $this->m_admin->usersInRole(5);
		$data['work_location'] = $this->m_admin->getWorkLocation();

		$this->load->view('timesheet/weekly_activity_view', $data);
	}

	public function formWeeklyPlan()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Weekly Work Plan</span>';
		$data['projects'] = $this->m_planning->getAllProject();
		$data['users'] = $this->m_admin->getActiveUser();
		$data['coordinator'] = $this->m_admin->usersInRole(5);
		$data['work_location'] = $this->m_admin->getWorkLocation();
		$data['parameters'] = $this->m_timesheet->getParameter();

		$this->load->view('timesheet/form_weekly_plan_view', $data);
	}


	public function dailyWeeklyPlan()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Weekly Work Plan</span>';
		$data['projects'] = $this->m_planning->getAllProject();
		$data['users'] = $this->m_admin->getActiveUser();
		$data['coordinator'] = $this->m_admin->usersInRole(5);
		$data['work_location'] = $this->m_admin->getWorkLocation();
		$data['parameters'] = $this->m_timesheet->getParameter();

		$this->load->view('timesheet/form_weekly_plan_view3', $data);
	}

	public function tempat_test(){
		$parameters = $this->m_timesheet->getParameter();
		foreach ($parameters as $key => $value) {
			var_dump($value);
		}

		exit();
		var_dump($data['parameters']); exit();
	}

	public function formWeeklyPlan2()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Weekly Work Plan</span>';
		$data['projects'] = $this->m_planning->getAllProject();
		$data['users'] = $this->m_admin->getActiveUser();
		$data['coordinator'] = $this->m_admin->usersInRole(5);
		$data['work_location'] = $this->m_admin->getWorkLocation();

		$this->load->view('timesheet/form_weekly_plan_view2', $data);
	}

	public function dateRange(){
		$start = $this->input->post('start');
		$end = $this->input->post('end');

		$d_start = date_create(date('Y-m-d', strtotime($start)));
		$d_end = date_create(date('Y-m-d', strtotime($end)));
		$diff = date_diff($d_start,$d_end);

		$rangeDate = array(date('l, d M Y', strtotime($start)));

		for ($i=0; $i < $diff->days; $i++) { 
			$last = end($rangeDate);
			$rangeDate[] = date('l, d M Y', strtotime("+1 day", strtotime($last)));
		}
		echo json_encode($rangeDate);
		exit();
	}

	public function getFieldInspector(){
		// $pc_id = $this->input->post('pc_id');
		$fi = $this->m_timesheet->userChildArea();
		if(empty($fi)){
			$data = array("status" => "failed");
		} else {
			$data = array("status" => "success", "data" => $fi);
		}

		echo json_encode($data);
		exit();
	}

	public function addWeeklyPlan(){
		if($this->m_timesheet->savePlan()){
			redirect('timesheet/weeklyActivity');
		}
	}

	public function save_plan(){
		if($this->m_timesheet->save_plan()){
			redirect('timesheet/weeklyActivity');
		}
	}

	public function getPlanAct(){
		$plan_act = $this->m_timesheet->getPlan();
		if(empty($plan_act)){
			$data = array("status" => "failed");
		} else {
			$data = array("status" => "success", "data" => $plan_act);
		}
		echo json_encode($data);
		exit();
	}

	public function getPersonPlan(){
		$plan_act = $this->m_timesheet->userChildArea();
		if(empty($plan_act)){
			$data = array("status" => "failed");
		} else {
			$data = array("status" => "success", "data" => $plan_act);
		}
		echo json_encode($data);
		exit();
	}

	public function load_daily_plan(){
		$plan_act = $this->m_timesheet->user_team_area();
		if(empty($plan_act)){
			$data = array("status" => "failed");
		} else {
			$data = array("status" => "success", "data" => $plan_act);
		}
		echo json_encode($data);
		exit();
	}

	public function getFieldInspectorByArea(){
		$pc_id = $this->input->post('pc_id');
		$area = $this->input->post('area');
		$fi = $this->m_timesheet->userChildByArea($pc_id, $area);
		if(empty($fi)){
			$data = array("status" => "failed");
		} else {
			$data = array("status" => "success", "data" => $fi);
		}

		echo json_encode($data);
		exit();
	}
}
 	