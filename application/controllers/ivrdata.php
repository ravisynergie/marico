<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ivrdata extends CI_Controller {

    /*
     * Vendor Page for this controller.
     *
     * Manage Vendor (Add, Edit and Delete)

     */
    var $sessionData;


    public function __construct()
    {
        parent::__construct();
        $this->load->model('blockmodel');
        $this->load->model('districtmodel');
        $this->load->model('loginmodel');
        $this->load->model('villagemodel');
        $this->load->model('schoolmodel');
        $this->load->model('studentmodel');
        $this->load->model('ivrmodel');
    }

    public function CronIVRUpdate()
    {
        //$StudentIVRData=$this->ivrmodel->StudentIvrData();

//        echo '<pre>';
//        print_r($StudentIVRData);
//        echo '</pre>';

    }


}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */