<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

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
        $this->load->model('gallerymodel');
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


    public function GalleryList()
    {
        $this->load->innerTemplate('village/VillageList');
    }

    public function GalleryListData()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        echo json_encode($this->villagemodel->VillageListData($UserId));
    }

    public function ImageDelete($id)
    {
        $this->gallerymodel->ImageDelete($_POST['id']);
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */