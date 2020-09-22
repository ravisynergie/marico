<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

    /*
     * Vendor Page for this controller.
     *
     * Manage Vendor (Add, Edit and Delete)

     */
    var $sessionData;


    public function __construct()
    {
        parent::__construct();
        $this->load->model('globalmodel');
        $this->load->model('villagemodel');
        $this->load->model('blockmodel');
        $this->load->model('districtmodel');
        $this->load->model('globalmodel');
        $this->load->model('assessmentmodel');
        $this->load->model('trainingmodel');
        $this->load->model('reportmodel');
        $this->load->model('usermodel');
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


    public function AssessmentReport()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;
        $UserGroupId = $SessionData['UserGroupId'];


        $AssessmentData=$this->reportmodel->UserAssessmentData($SessionData,$_GET);
		
//        echo '<pre>';
//        print_r($SessionData);
//        echo '</pre>';
        //die;
        $data['AssessmentData'] = $AssessmentData;
        $TrainerData = $this->usermodel->GetTrainerData();
        $data['TrainerData'] = $TrainerData;

        $this->load->innerTemplate('report/AssessmentReport',$data);
    }


    public function AttendanceReport()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;
        $UserGroupId = $SessionData['UserGroupId'];


        $AttendanceData=$this->reportmodel->UserAttendanceData($SessionData,$_GET);

//        echo '<pre>';
//        print_r($AttendanceData);
//        echo '</pre>';
//        die;
        $data['AttendanceData'] = $AttendanceData;

        $TrainerData = $this->usermodel->GetTrainerData();
        $data['TrainerData'] = $TrainerData;


        $this->load->innerTemplate('report/AttendanceReport',$data);
    }


    public function OnlineAssessmentReport()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;
        $UserGroupId = $SessionData['UserGroupId'];


        $OnlineAssessmentData=$this->reportmodel->UserOnlineAssessmentData($SessionData,$_GET);

//        echo '<pre>';
//        print_r($SessionData);
//        echo '</pre>';
        //die;
        $data['OnlineAssessmentData'] = $OnlineAssessmentData;
        $TrainerData = $this->usermodel->GetTrainerData();
        $data['TrainerData'] = $TrainerData;

        $this->load->innerTemplate('report/OnlineAssessmentReport',$data);
    }


    public function OnlineAssessmentTwoReport()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;
        $UserGroupId = $SessionData['UserGroupId'];


        $OnlineAssessmentTwoData=$this->reportmodel->UserOnlineAssessmentTwoData($SessionData,$_GET);

//        echo '<pre>';
//        print_r($SessionData);
//        echo '</pre>';
        //die;
        $data['OnlineAssessmentTwoData'] = $OnlineAssessmentTwoData;
        $TrainerData = $this->usermodel->GetTrainerData();
        $data['TrainerData'] = $TrainerData;

        $this->load->innerTemplate('report/OnlineAssessmentTwoReport',$data);
    }




    public function OnlineTraining()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;
        $UserGroupId = $SessionData['UserGroupId'];

        if($_GET['UserName']){
            $SchoolData = $this->reportmodel->GetSchoolData($_GET['UserName']);
        }
        else {
            $SchoolData = $this->reportmodel->GetSchoolData($UserId);
        }

        $OnlineTrainingData=$this->reportmodel->OnlineTrainingReport($SchoolData,$SessionData,$_GET);
        $data['OnlineTrainingData'] = $OnlineTrainingData;
        $TrainerData = $this->usermodel->GetTrainerData();
        $data['TrainerData'] = $TrainerData;


        $this->load->innerTemplate('report/OnlineTraining',$data);
    }

    public function OnlineTrainingDateWise()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;
        $UserGroupId = $SessionData['UserGroupId'];

        if($_GET['FilterDate'] == ''){
            $FilterDate = date('Y-m-d');
        }
        else {
            $FilterDate = date('Y-m-d', strtotime($_GET['FilterDate']));
        }

        if($_GET['UserName']){
            $UserId = $_GET['UserName'];
        }
        else{
            $UserId = '';
        }

        $OnlineTrainingCompleteData=$this->reportmodel->CompletedTrainingDateWiseTrainingTwo(100,$FilterDate,$UserId);
        $data['OnlineTrainingCompleteData'] = $OnlineTrainingCompleteData;

        $OnlineTrainingCompleteDataTrainingTwo=$this->reportmodel->CompletedTrainingDateWiseTrainingTwo(150,$FilterDate,$UserId);
        $data['OnlineTrainingCompleteDataTrainingTwo'] = $OnlineTrainingCompleteDataTrainingTwo;

        $OnlineTrainingCompleteDataTrainingThree=$this->reportmodel->CompletedTrainingDateWiseTrainingTwo(200,$FilterDate,$UserId);
        $data['OnlineTrainingCompleteDataTrainingThree'] = $OnlineTrainingCompleteDataTrainingThree;

//        echo '<pre>';
//        print_r($OnlineTrainingCompleteData);
//        echo '</pre>';
		//die;
        $TrainerData = $this->usermodel->GetTrainerData();
        $data['TrainerData'] = $TrainerData;

		$this->load->innerTemplate('report/OnlineTrainingDateWise',$data);
    }


    public function StudentReportCard()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;
        $UserGroupId = $SessionData['UserGroupId'];
        

        $StudentData = $this->reportmodel->StudentReportCard($_GET);
		$data['StudentData'] = $StudentData;
//        echo '<pre>';
  //      print_r($StudentData);
    //    echo '</pre>';
        $this->load->innerTemplate('report/StudentReportCard',$data);
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */