<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include dirname(__FILE__).DIRECTORY_SEPARATOR.'SsoClient/ClientAPI.php';

class ProjectCommercial extends CI_Controller {

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
		$this->load->model('ProjectCommercial_model', 'm_commercial');
		$this->load->model('questionnaire_model', 'm_quest');

		//TODO: create an object and call a class method
		$ClientApi = new ClientAPI();
		$ClientApi->doCurl();
	}

	public function index()
	{
		// Get Apps Config
		$data = $this->apps->info();
		$data['page_title'] = '<span class="text-semibold">Project Commercial</span>';

		$this->load->view('project_commercial/project_commercial_view', $data);
	}


	public function genLink()
	{
		$employee_id = '244';
		$fullname = 'Eko Agung Gumilar';

		//$employee_id = '2693';
		//$fullname = '	Atri Fitrianti';

		$employee_profile = $employee_id . "#" . trim(str_replace(' ', '', ucwords(strtolower($fullname))));

		$param1 = trim(str_replace(' ', '', ucwords(strtolower($fullname))));
		//$param2 = base64_encode($employee_profile);
		$param2 = trim(str_replace('=', '', base64_encode($employee_profile)));
		echo base_url().'questionnaire/karir/'.$param1.'/'.$param2;
	}

	public function karir($param1="",$param2="")
	{
		$this->load->theme('Limitless-full');

		// Get Apps Config
		$data['page_title'] = '<span class="text-semibold">KUESIONER  KARIR - PT MORA TELEMATIKA INDONESIA</span>';
		$data['param1'] = $param1;
		$data['param2'] = $param2;

		if($param1!="" || $param2!="")
		{
			/*
			 * $param1: employee_name
			 * $param2: base64_encode(employee_id#employee_name)
			 */
			$param2 = base64_decode($param2);

			$emp  = explode('#',$param2);
			$employee_id = $emp[0];

			if($this->m_quest->checkKuesionerById($employee_id)==FALSE)
			{
				// Get Data API HRIS
				$json = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employee/id/'.$employee_id);
				$employee = json_decode($json);
				$data['employee'] = $employee;

				$data['errors'] = false;
				$data['save'] = false;

				//TODO: If Submit
				if ($this->input->post('submit_kuesioner'))
				{
					$this->form_validation->set_rules('in_kekuatan', '', 'required|trim');
					$this->form_validation->set_rules('in_kelemahan', '', 'required|trim');
					$this->form_validation->set_rules('jp_competency', '', 'required|trim');
					$this->form_validation->set_rules('jm_professional', '', 'required|trim');
					$this->form_validation->set_rules('jm_competency', '', 'required|trim');
					$this->form_validation->set_rules('jpg_professional', '', 'required|trim');
					$this->form_validation->set_rules('jpg_competency', '', 'required|trim');

					if ($this->form_validation->run() == TRUE)
					{
						//TODO: Save Feedback Form
						if ($this->m_quest->saveKuesioner($employee_id,$employee->employee_no,$employee->fullname))
						{
							$param2 = base64_encode($param2);
							redirect('questionnaire/successSendQuestionnaire/'.$param1.'/'.$param2);
						}
					} else {
						$data['errors'] = true;
					}
				}

				$this->load->view('questionnaire/kuesioner_karir', $data);

			}
			else
			{
				$param2 = base64_encode($param2);
				redirect('questionnaire/successSendQuestionnaire/'.$param1.'/'.$param2);
			}
		}
		else{
			show_404();
		}
	}

	public function successSendQuestionnaire($param1="",$param2="")
	{
		$this->load->theme('Limitless-full');

		// Get Apps Config
		$data['page_title'] = '<span class="text-semibold">KUESIONER  KARIR - PT MORA TELEMATIKA INDONESIA</span>';
		$data['param1'] = $param1;
		$data['param2'] = $param2;

		$param2 = base64_decode($param2);

		$emp  = explode('#',$param2);
		$employee_id = $emp[0];

		// Get Data API HRIS
		$json = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employee/id/'.$employee_id);
		$employee = json_decode($json);
		$data['employee'] = $employee;

		$this->load->view('questionnaire/success_send_questionnaire', $data);
	}

	public function viewKuesioner($param1="",$param2="")
	{
		$this->load->theme('Limitless-full');

		// Get Apps Config
		$data['page_title'] = '<span class="text-semibold">KUESIONER  KARIR - PT MORA TELEMATIKA INDONESIA</span>';
		$data['param1'] = $param1;
		$data['param2'] = $param2;

		if($param1!="" || $param2!="")
		{
			/*
			 * $param1: employee_name
			 * $param2: base64_encode(employee_id#employee_name)
			 */
			$param2 = base64_decode($param2);

			$emp  = explode('#',$param2);
			$employee_id = $emp[0];

			if($this->m_quest->checkKuesionerById($employee_id)==TRUE)
			{
				// Get Data API HRIS
				$json = file_get_contents('http://morahrd.moratelindo.co.id/karyawan/index.php/employeeRestserver/employee/id/'.$employee_id);
				$employee = json_decode($json);
				$data['employee'] = $employee;

				// Get Kuesioner Detail By Id
				$data['kuesioner'] = $this->m_quest->getKuesionerDetailByEmployeeId($employee_id);

				$data['errors'] = false;
				$data['save'] = false;

				//TODO: If Submit
				if ($this->input->post('submit_kuesioner'))
				{
					$this->form_validation->set_rules('in_kekuatan', '', 'required|trim');
					$this->form_validation->set_rules('in_kelemahan', '', 'required|trim');
					$this->form_validation->set_rules('jp_competency', '', 'required|trim');
					$this->form_validation->set_rules('jm_professional', '', 'required|trim');
					$this->form_validation->set_rules('jm_competency', '', 'required|trim');
					$this->form_validation->set_rules('jpg_professional', '', 'required|trim');
					$this->form_validation->set_rules('jpg_competency', '', 'required|trim');

					if ($this->form_validation->run() == TRUE)
					{
						//TODO: Save Feedback Form
						if ($this->m_quest->updateKuesioner($employee_id))
						{
							$param2 = base64_encode($param2);
							redirect('questionnaire/successSendQuestionnaire/'.$param1.'/'.$param2);
						}
					} else {
						$data['errors'] = true;
					}
				}

				$this->load->view('questionnaire/edit_kuesioner_karir', $data);

			}
			else
			{
				$param2 = base64_encode($param2);
				redirect('questionnaire/karir/'.$param1.'/'.$param2);
			}
		}
		else{
			show_404();
		}
	}






}
