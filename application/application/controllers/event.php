<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {

    /*
     * Vendor Page for this controller.
     *
     * Manage Vendor (Add, Edit and Delete)

     */
    var $sessionData;


    public function __construct()
    {
        parent::__construct();
        $this->load->model('eventmodel');
        $this->load->model('villagemodel');
        $this->load->model('globalmodel');
        $this->load->model('trainingmodel');
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


    public function EventList()
    {
        $this->load->innerTemplate('event/EventList');
    }

    

    public function EventListData()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        echo json_encode($this->eventmodel->EventListData($UserId));
    }

    public function AddNewEvent()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        if(count($_POST))
        {
            $SaveData=$_POST;
            $SaveData['UserId']=$UserId;
            $SaveData['DateCreated']=date('Y-m-d h:i:s');
            $SaveData['StakeholdersName'] = json_encode($_POST['StakeholdersName']);
            $SaveData['StakeholdersDesignation'] = json_encode($_POST['StakeholdersDesignation']);
            $SaveData['OtherDesignationName'] = json_encode($_POST['OtherDesignationName']);
            $SaveData['StakeholdersContact'] = json_encode($_POST['StakeholdersContact']);
            $SaveData['Volunteers']=json_encode(array_keys($_POST['Volunteers']));
            $this->eventmodel->CreateNewEvent($SaveData);
            $this->session->set_flashdata('msg', 'Event has been added.');
            redirect(base_url().'event/EventList', 'refresh');
            die;

            echo "<pre>";
            print_r($SaveData);
            echo "</pre>";
        }
        $VillageData=$this->villagemodel->VillageListData($UserId);
        $data['VillageData']=$VillageData;

       // $VillageData=$this->globalmodel->UserVillageList($UserId);
        //$data['VillageData']=$VillageData;

        $VolunteerData=$this->trainingmodel->GetVolunteerData();
        $data['VolunteerData']=$VolunteerData;

        $this->load->innerTemplate('event/AddNewEvent', $data);
    }

    public function UpdateEvent($Id)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        if(count($_POST))
        {
            //die();
            $SaveData=$_POST;
            $SaveData['EventDate']=date('Y-m-d', strtotime($_POST['EventDate']));;
            $SaveData['StakeholdersName'] = json_encode($_POST['StakeholdersName']);
            $SaveData['StakeholdersDesignation'] = json_encode($_POST['StakeholdersDesignation']);
            $SaveData['OtherDesignationName'] = json_encode($_POST['OtherDesignationName']);
            $SaveData['StakeholdersContact'] = json_encode($_POST['StakeholdersContact']);
            $SaveData['Volunteers']=json_encode(array_keys($_POST['Volunteers']));
            $this->eventmodel->UpdateEvent($Id,$SaveData);
            $this->session->set_flashdata('msg', 'School has been updated.');
            redirect(base_url().'activity/ActivityList?Type=Event', 'refresh');
            die;

            echo "<pre>";
            print_r($SaveData);
            echo "</pre>";
        }

        $EventData=$this->eventmodel->GetEventData($Id);
        $data['EventData']=$EventData;

        //$VillageData=$this->globalmodel->UserVillageList($UserId);
        //$data['VillageData']=$VillageData;

        $VillageData=$this->villagemodel->VillageListData($UserId);
        $data['VillageData']=$VillageData;

        $VolunteerData=$this->trainingmodel->GetVolunteerData();
        $data['VolunteerData']=$VolunteerData;

        $this->load->innerTemplate('event/UpdateEvent',$data);
    }

    public function DeleteEvent()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        $this->eventmodel->DeleteEvent($_POST['Id']);
    }







}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */