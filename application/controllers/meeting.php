<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meeting extends CI_Controller {

    /*
     * Vendor Page for this controller.
     *
     * Manage Vendor (Add, Edit and Delete)

     */
    var $sessionData;


    public function __construct()
    {
        parent::__construct();
        $this->load->model('studentmodel');
        $this->load->model('schoolmodel');
        $this->load->model('meetingmodel');
        $this->load->model('globalmodel');
        $this->load->model('villagemodel');
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


    public function MeetingList()
    {

        $this->load->innerTemplate('meeting/MeetingList');
    }

    public function MeetingListData()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        if($SessionData['UserGroupId']==5)
        {
            $MeetingData=$this->globalmodel->UserMeetingList($UserId,$_GET);
        }
        else
        {
            $MeetingData=$this->trainingmodel->TrainingManagerListData($_GET);
        }

        echo json_encode($MeetingData);
//        echo json_encode($this->meetingmodel->MeetingListData($UserId));
    }

    public function MeetingListDataActivity()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        if($SessionData['UserGroupId']==5)
        {
            $MeetingData=$this->globalmodel->UserMeetingListActivity($UserId,$_GET);
        }
        else
        {
            $MeetingData=$this->trainingmodel->TrainingManagerListData($_GET);
        }
        
        echo json_encode($MeetingData);
//        echo json_encode($this->meetingmodel->MeetingListData($UserId));
    }

    public function AddNewMeeting()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        if(count($_POST))
        {
            $SaveData=$_POST;
            $SaveData['UserId']=$UserId;
            $SaveData['MeetingDate']=date('Y-m-d', strtotime($_POST['MeetingDate']));;
            $SaveData['DateCreated']=date('Y-m-d h:i:s');
            $this->meetingmodel->CreateNewMeeting($SaveData);
            $this->session->set_flashdata('msg', 'Meeting has been added.');
            redirect(base_url().'meeting/MeetingList', 'refresh');
            die;

//            echo "<pre>";
//            print_r($SaveData);
//            echo "</pre>";
            //die();
        }
//        $SchoolData=$this->globalmodel->UserSchoolList($UserId);
//        $data['SchoolData']=$SchoolData;
//        $VillageData=$this->globalmodel->UserVillageList($UserId);
//        $data['VillageData']=$VillageData;


        $SchoolData=$this->schoolmodel->SchoolListData($UserId);
        $data['SchoolData']=$SchoolData;

        $VillageData=$this->villagemodel->VillageListData($UserId);
        $data['VillageData']=$VillageData;


        $this->load->innerTemplate('meeting/AddNewMeeting', $data);
    }

   
    public function UpdateMeeting($Id)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        if(count($_POST))
        {
            $SaveData=$_POST;

            $SaveData['UserId']=$UserId;
            $SaveData['MeetingDate']=date('Y-m-d', strtotime($_POST['MeetingDate']));
            $SaveData['DateCreated']=date('Y-m-d h:i:s');

            if($SaveData['Type'] == 'School'){
                //unset($SaveData['VillageId']);
                $SaveData['VillageId'] = 'NULL';
            }
            if($SaveData['Type'] == 'Village'){
//                unset($SaveData['SchoolId']);
                $SaveData['SchoolId'] = 'NULL';
            }
//            echo "<pre>";
//            print_r($SaveData);
//            echo "</pre>";
//            die();

            $this->meetingmodel->UpdateMeeting($Id,$SaveData);
            $this->session->set_flashdata('msg', 'Meeting has been updated.');
            redirect(base_url().'activity/ActivityList?Type=Meeting', 'refresh');
            die;

            echo "<pre>";
            print_r($SaveData);
            echo "</pre>";
        }

        $MeetingData=$this->meetingmodel->GetMeetingData($Id);
        $data['MeetingData']=$MeetingData;

        //$SchoolData=$this->schoolmodel->SchoolListData($UserId);
        //$data['SchoolData']=$SchoolData;
//        $SchoolData=$this->globalmodel->UserSchoolList($UserId);
//        $data['SchoolData']=$SchoolData;
//
//        $VillageData=$this->globalmodel->UserVillageList($UserId);
//        $data['VillageData']=$VillageData;

        $SchoolData=$this->schoolmodel->SchoolListData($UserId);
        $data['SchoolData']=$SchoolData;

        $VillageData=$this->villagemodel->VillageListData($UserId);
        $data['VillageData']=$VillageData;



        $this->load->innerTemplate('meeting/UpdateMeeting',$data);
    }

    public function DeleteMeeting()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        $this->trainingmodel->DeleteTraining($_POST['Id']);
    }




}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */