<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include dirname(__FILE__).DIRECTORY_SEPARATOR.'SsoClient/ClientAPI.php';

class Documentation extends CI_Controller {

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
        $this->load->model('Documentation_model', 'm_document');

        //TODO: create an object and call a class method
        $ClientApi = new ClientAPI();
        $ClientApi->doCurl();
    }

    public function index()
    {
        // Get Apps Config
        $data = $this->apps->info();
        $data['page_title'] = '<span class="text-semibold">Documentation</span>';

		$this->load->view('documentation/documentation_view', $data);
    }


}
