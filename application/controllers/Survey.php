<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include dirname(__FILE__).DIRECTORY_SEPARATOR.'SsoClient/ClientAPI.php';

class Survey extends CI_Controller {

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
		$this->load->model('Survey_model', 'm_survey');

		//TODO: create an object and call a class method
		$ClientApi = new ClientAPI();
		$ClientApi->doCurl();
	}

	public function index()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Survey</span>';

		$this->load->view('survey/survey_view', $data);
	}


	/*
	public function all()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Projects</span> - List';

		$this->load->view('projects/list_projects_view', $data);
	}

	public function id($id)
	{
		// Get Apps Config
		$data = $this->apps->info();

		// Get project detail
		$project = $this->m_proj->getProjectDetailById($id);
		$data['project'] = $project;

		$data['page_title'] = '<span class="text-semibold"></span>' . $project->project_name . ' <small>' . $project->company . '</small>';

		$this->load->view('projects/projects_detail_view', $data);
	}

	public function dataTableProjectList()
	{
		$this->load->library('Datatable', array('model' => 'Project_list_dt', 'rowIdCol' => 'id'));

		$jsonArray = $this->datatable->datatableJson(array(
			//'a.delivery_date' => 'date',
			//'a.unit_price' => 'currency'
		));

		$this->output->set_header("Pragma: no-cache");
		$this->output->set_header("Cache-Control: no-store, no-cache");
		$this->output->set_content_type('application/json')->set_output(json_encode($jsonArray));
	}
	*/


}
