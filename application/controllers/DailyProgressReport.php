<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include dirname(__FILE__).DIRECTORY_SEPARATOR.'SsoClient/ClientAPI.php';

class DailyProgressReport extends CI_Controller {

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
        $this->load->model('Planning_model', 'm_plan');
		$this->load->model('Report_model', 'm_report');

		//TODO: create an object and call a class method
		$ClientApi = new ClientAPI();
		$ClientApi->doCurl();
	}

	public function summaryProgressReport()
	{
		// Get Apps Config
		$data = $this->apps->info();

		$projects = $this->m_plan->getSummaryProjectsByStatus('On Progress');
		foreach ($projects as $key => $value) {
			$projects[$key]->km = $this->m_report->getCableScope(10,$value->id);
			$projects[$key]->hdpe = $this->m_report->getCableScope(8,$value->id);
			$projects[$key]->pole = $this->m_report->getCableScope(9,$value->id);
			$projects[$key]->tower = $this->m_report->getCableScope(4,$value->id);
			$projects[$key]->dwdm = $this->m_report->getCableScope(12,$value->id);
			$projects[$key]->isp = $this->m_report->getCableScope(18,$value->id);
		}
		$data['project'] = $projects;
		$data['page_title'] = '<span class="text-semibold">Summary Progress Report</span>';

		$this->load->view('daily_progress_report/summary_progress_report_view', $data);
	}

	public function summaryProgressReport2()
	{
		// Get Apps Config
		$data = $this->apps->info();

		$projects = $this->m_plan->getSummaryProjectsByStatus('On Progress');
		foreach ($projects as $key => $value) {
			$projects[$key]->km = $this->m_report->getCableScope(10,$value->id);
			$projects[$key]->hdpe = $this->m_report->getCableScope(8,$value->id);
			$projects[$key]->pole = $this->m_report->getCableScope(9,$value->id);
			$projects[$key]->tower = $this->m_report->getCableScope(4,$value->id);
			$projects[$key]->dwdm = $this->m_report->getCableScope(12,$value->id);
			$projects[$key]->isp = $this->m_report->getCableScope(18,$value->id);
		}
		$data['project'] = $projects;
		$data['page_title'] = '<span class="text-semibold">Summary Progress Report 2</span>';

		$this->load->view('daily_progress_report/summary_progress_report_view2', $data);
	}

	public function summaryProgressReport3()
	{
		// Get Apps Config
		$data = $this->apps->info();

		$projects = $this->m_plan->getSummaryProjectsByStatus('On Progress');
		foreach ($projects as $key => $value) {
			$projects[$key]->km = $this->m_report->getCableScope(10,$value->id);
			$projects[$key]->hdpe = $this->m_report->getCableScope(8,$value->id);
			$projects[$key]->pole = $this->m_report->getCableScope(9,$value->id);
			$projects[$key]->tower = $this->m_report->getCableScope(4,$value->id);
			$projects[$key]->dwdm = $this->m_report->getCableScope(12,$value->id);
			$projects[$key]->isp = $this->m_report->getCableScope(18,$value->id);
		}
		$data['project'] = $projects;
		$data['page_title'] = '<span class="text-semibold">Summary Progress Report 2</span>';

		$this->load->view('daily_progress_report/summary_progress_report_view3', $data);
	}

	public function progressPerProject()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Progress Per Project</span>';
		$data['project'] = $this->m_report->getProjects();

		$this->load->view('daily_progress_report/progress_per_project_view', $data);
	}

	public function progressNational()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Progress National</span>';
		$data['project'] = $this->m_report->getProjects();
		
		$this->load->view('daily_progress_report/progress_national_view', $data);
	}

	public function get_charts()
    {
        $attachment = $this->m_report->getChartValues();
        if (!empty($attachment)) {
            $data = array('status' => 'Success', 'data' => $attachment);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }


    public function get_charts2()
    {
        $attachment = $this->m_report->getChartValues2();
        if (!empty($attachment)) {
            $data = array('status' => 'Success', 'data' => $attachment);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function daily_project_chart()
    {
        $attachment = $this->m_report->daily_progress_chart();
        if (!empty($attachment)) {
            $data = array('status' => 'Success', 'data' => $attachment);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }

    public function national_progress_chart()
    {
        $attachment = $this->m_report->daily_progress_charts();
        if (!empty($attachment)) {
            $data = array('status' => 'Success', 'data' => $attachment);
        } else {
            $data = array('status' => 'Failed', 'data' => '');
        }
        echo json_encode($data);
        exit();
    }
}
