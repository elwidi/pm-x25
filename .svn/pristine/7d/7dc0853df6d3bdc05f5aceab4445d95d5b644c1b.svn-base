<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package        CodeIgniter
 * @subpackage    Rest Server
 * @category    Controller
 * @author        Phil Sturgeon
 * @link        http://philsturgeon.co.uk/code/
 */

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require_once APPPATH . '/libraries/REST_Controller.php';

class ApiRestserver extends REST_Controller
{
    function progressTask_get()
    {
        ob_clean();

        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }

        $id = $this->get('id');

        $this->load->model('Planning_model', 'm_planning');

        $task = $this->m_planning->getTaskByProjectId($this->get('id'));
        $taskList = $this->m_planning->getAllTaskList($this->get('id'));
        $data = array();
        $pid = 10;
        $parent_id = 10;
        $in = 0;
        foreach ($task as $d => $r){
                if($d==0){
                    $data[] = array(
                        'task' => array(
                            'pID' => $pid,
                            'pName' => $taskList[$d]->task_list_name,
                            'pStart' => '',
                            'pEnd' => '',
                            'pClass' => 'ggroupblack',
                            'pLink' => '',
                            'pMile' => '0',
                            'pRes' => '',
                            'pComp' => '',
                            'pGroup' => '1',
                            'pParent' => '0',
                            'pOpen' => '1',
                            'pDepend' => '',
                            'pCaption' => 'Iwan',
                            'pNotes' => 'This text is only available in tool tips'));
                    $in++;
                    $parent_id = $pid;
                    $pid+=10;
                } else {
                    if($in <= count($taskList)-1) {
                        if($r->task_list_id != $task[$d-1]->task_list_id){
                            $data[] = array(
                                'task' => array(
                                    'pID' => $pid,
                                    'pName' => $taskList[$in]->task_list_name,
                                    'pStart' => '',
                                    'pEnd' => '',
                                    'pClass' => 'ggroupblack',
                                    'pLink' => '',
                                    'pMile' => '0',
                                    'pRes' => '',
                                    'pComp' => '',
                                    'pGroup' => '1',
                                    'pParent' => '0',
                                    'pOpen' => '1',
                                    'pDepend' => '',
                                    'pCaption' => 'Iwan',
                                    'pNotes' => 'This text is only available in tool tips'));
                            $in++;
                            $parent_id = $pid;
                            $pid+=10;
                        }
                    }
                }
                $data[] = array(
                'task' => array(
                    'pID' => $pid,
                    'pName' => $r->tasks_name,
                    'pStart' => $r->start_date,
                    'pEnd' => $r->due_date,
                    'pClass' => 'gtaskblue',
                    'pLink' => '',
                    'pMile' => '0',
                    'pRes' => '',
                    'pComp' => $r->progress,
                    'pGroup' => '0',
                    'pParent' => $parent_id,
                    'pOpen' => '1',
                    'pDepend' => '',
                    'pCaption' => 'Iwan',
                    'pNotes' => 'This text is only available in tool tips'));
            $pid+=10;
        }

        /*
        //TODO: Load model
        $this->load->model('employeeModel', 'm_emp');

        //TODO: Get employee detail by id
        $emp = $this->m_emp->getEmployeeDetailsById($id)->row();

        //TODO: Get employment detail by id
        $employment = $this->m_emp->getEmploymentDetailsById($id)->row();

        //TODO: Get position by id
        $pos = $this->m_emp->getLastPositionByEmpId($id);

        //TODO: Get organization by id
        $org = $this->m_emp->getLastOrganizationUnitByEmpId($id);

        if (!empty($emp->photo)) {
            $photo = 'http://morahrd.moratelindo.co.id/karyawan/files/photos/thumbnails/' . $emp->photo;
        } else {
            $photo = 'http://morahrd.moratelindo.co.id/karyawan/files/photos/thumbnails/n_a.gif';
        }

        //TODO: Get Supervisor Employee
        if($emp->supervisor_id!=0 || !empty($emp->supervisor_id)) {
            $emp_spv = $this->m_emp->getEmployeeDetailsById($emp->supervisor_id)->row();
            $supervisor_id = $emp_spv->employee_id;
            $supervisor_name = $emp_spv->fullname;
        }else{
            $supervisor_id = 'N/A';
            $supervisor_name = 'N/A';
        }
        */

        /*$data = array(
            'task' => array(
            'pID' => '20',
            'pName' => 'Move to WCF from remoting',
            'pStart' => '2017-05-11 09:00',
            'pEnd' => '2017-05-15',
            'pClass' => 'gtaskblue',
            'pLink' => '',
            'pMile' => '0',
            'pRes' => 'Iwan',
            'pComp' => '10',
            'pGroup' => '0',
            'pParent' => '10',
            'pOpen' => '1',
            'pDepend' => '',
            'pCaption' => 'Iwan',
            'pNotes' => 'This text is only available in tool tips'));*/

        if ($data) {
            $this->response($data, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Employee could not be found'), 404);
        }
    }

    public function send_post()
    {
        var_dump($this->request->body);
    }

    public function send_put()
    {
        var_dump($this->put('foo'));
    }

}