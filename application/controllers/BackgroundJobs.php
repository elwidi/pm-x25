<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

ini_set('date.timezone', 'Asia/Jakarta');

class BackgroundJobs extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('IssueRisk_model', 'm_risk');
    }

    public function cronJobOpenIssueRegister()
    {
        //TODO: Get Head Implementation
        $head = $this->m_risk->getAllHeadImplementation();

        if (isset($head)) {
            foreach ($head as $row) {
                //TODO: Process
                $user_id = $row->user_id;
                $sso_id = $row->sso_id;
                $this->m_risk->sendEmailOpenIssueRegister($user_id,$sso_id,'HEAD');
                echo $row->sso_id;
                echo "\n";
            }
        }

        //TODO: Get PM
        $pm = $this->m_risk->getAllProjectManager();

        if (isset($pm)) {
            foreach ($pm as $row) {
                //TODO: Process
                $user_id = $row->user_id;
                $sso_id = $row->sso_id;
                $this->m_risk->sendEmailOpenIssueRegister($user_id,$sso_id,'PM');
                echo $row->sso_id;
                echo "\n";
            }
        }

        //TODO: Get PIC
        $pic = $this->m_risk->getAllPersonInCharge();

        if (isset($pic)) {
            foreach ($pic as $row) {
                //TODO: Process
                $user_id = $row->user_id;
                $sso_id = $row->sso_id;
                $this->m_risk->sendEmailOpenIssueRegister($user_id,$sso_id,'PIC');
                echo $row->sso_id;
                echo "\n";
            }
        }

    }

    public function cronJobReadInboxSmsIssueRegister()
    {
        //TODO: Get SMS Inbox Issue Register
        $sms_inbox = $this->m_risk->getSmsInboxIssueRegister();

        if (isset($sms_inbox)) {
            foreach ($sms_inbox as $row) {
                //TODO: Process
                $UpdatedInDB = $row->UpdatedInDB;
                $ReceivingDateTime = $row->ReceivingDateTime;
                $SenderNumber = $row->SenderNumber;
                $TextDecoded = $row->TextDecoded;
                $ID = $row->ID;

                $this->m_risk->saveSmsIssueRisk($UpdatedInDB,$ReceivingDateTime,$SenderNumber,$TextDecoded,$ID);
                echo $row->TextDecoded;
                echo "\n";
            }
        }

    }


}

/* End of file BackgroundJobs.php */
/* Location: ./application/controllers/BackgroundJobs.php */