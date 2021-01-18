<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assigned extends CI_Controller {

    /*
     * Vendor Page for this controller.
     *
     * Manage Vendor (Add, Edit and Delete)

     */
    var $sessionData;


    public function __construct()
    {
        parent::__construct();
        $this->load->model('villagemodel');
        $this->load->model('blockmodel');
        $this->load->model('districtmodel');
        $this->load->model('schoolmodel');
//        $this->load->model('mappingmodel');
        if($this->session->userdata("loginUserData"))
        {
            $this->sessionData = $this->session->userdata("loginUserData");
        }
        else
        {
            redirect(base_url(), 'refresh');
            die;
        }
    }


    public function AssignedList()
    {

        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $UserMappedData = $this->districtmodel->GetMappedUser($UserId);

        $SchoolData=$this->schoolmodel->SchoolListDashboardData();

        //$this->PrintMappedUserSchool($SchoolData,$UserMappedData);
        //print_r($UserMappedData);
        $data['UserMappedData']=$UserMappedData;
        $data['SchoolData']=$SchoolData;
        $this->load->innerTemplate('assigned/AssignedList', $data);
    }


}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */