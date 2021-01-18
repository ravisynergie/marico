<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Training extends CI_Controller {

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
		$this->load->model('studentmodel');
		$this->load->model('blockmodel');
		$this->load->model('districtmodel');
        $this->load->model('schoolmodel');
        $this->load->model('trainingmodel');
        $this->load->model('globalmodel');
        $this->load->model('assessmentmodel');
        $this->load->model('usermodel');
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


    public function TrainingList()
    {
		$SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;
		
		if($SessionData['UserGroupId']==5)
		{
			$DistrictData=$this->globalmodel->UserDistrictList($UserId);
			$data['DistrictData']=$DistrictData;
			
			$BlockData=$this->globalmodel->UserBlockList($UserId);
			$data['BlockData']=$BlockData;
	
			$SchoolData=$this->globalmodel->UserSchoolList($UserId);
			$data['SchoolData']=$SchoolData;

            $VillageData=$this->globalmodel->UserVillageList($UserId);
            $data['VillageData']=$VillageData;
		}
		else
		{
			$DistrictData=$this->districtmodel->DistrictListData($UserId);
			$data['DistrictData']=$DistrictData;
	
			$BlockData=$this->blockmodel->BlockListData($UserId);
			$data['BlockData']=$BlockData;
	
			$SchoolData=$this->schoolmodel->SchoolListData($UserId);
			$data['SchoolData']=$SchoolData;

            $VillageData=$this->villagemodel->VillageListData($UserId);
            $data['VillageData']=$VillageData;


		}
        $data['TrainerData']=$this->usermodel->GetTrainerData($UserId);
        $this->load->innerTemplate('training/TrainingList',$data);
    }

    public function TrainingListData()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
		
		if($SessionData['UserGroupId']==5)
		{
			$TrainingData=$this->globalmodel->UserTrainingList($UserId,$_GET);
		}
		else
		{
			$TrainingData=$this->trainingmodel->TrainingManagerListData($_GET);
		}
		echo json_encode($TrainingData);
    }

    public function AddNewTraining()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        if(count($_POST))
        {
            $SaveData=$_POST;
            $SaveData['UserId']=$UserId;
            $SaveData['TrainingDate']=date('Y-m-d', strtotime($_POST['TrainingDate']));;
            $SaveData['DateCreated']=date('Y-m-d h:i:s');
            $this->trainingmodel->CreateNewTraining($SaveData);
            $this->session->set_flashdata('msg', 'Training has been added.');
            redirect(base_url().'training/TrainingList', 'refresh');
            die;

//            echo "<pre>";
//            print_r($SaveData);
//            echo "</pre>";
            //die();
        }
        //$SchoolData=$this->schoolmodel->SchoolListData($UserId);
        //$data['SchoolData']=$SchoolData;

        $SchoolData=$this->globalmodel->UserSchoolList($UserId);
        $data['SchoolData']=$SchoolData;

        $this->load->innerTemplate('training/AddNewTraining', $data);
    }

    public function AttendanceTraining($TrainingId)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
		
		$TraingData=$this->trainingmodel->GetTrainingData($TrainingId);
		$TraingData=$TraingData['0'];
		//echo "<pre>";
		//print_r($TraingData);
		//echo "</pre>";
        if($_POST['Marks']){

            $MarksObtained = $_POST['Marks'];
            $TotalMarks=0;
            foreach ($MarksObtained as $mark){
                $TotalMarks=$TotalMarks+$mark;
            }

            $this->assessmentmodel->DeleteAssessment($_POST['AssessmentId'],$_POST['StudentId'],$_POST['TrainingId']);
            $SaveData=array();
            $SaveData['TrainingId']=$_POST['TrainingId'];
            $SaveData['StudentId']=$_POST['StudentId'];
            $SaveData['AssessmentId']=$_POST['AssessmentId'];
            $SaveData['DistrictId']=$_POST['DistrictId'];
            $SaveData['UserId']=$UserId;
            $SaveData['AssessmentStudentData']=json_encode($_POST['Marks']);
            $SaveData['TotalMarks']=$TotalMarks;
            $SaveData['DateCreated']=date('Y-m-d h:i');
//            echo "<pre>";
//            print_r($SaveData);
//            echo "</pre>";
//            die();
            $this->assessmentmodel->SaveAssessmentData($SaveData);
            $this->session->set_flashdata('msg', 'Assessment data has been recorded.');
            //redirect(base_url().'training/AttendanceTraining/'.$_POST['TrainingId'].'#'.$_POST['StudentId']);
            die();
        }
		
        if(count($_POST))
        {
            $DistrictId = $this->trainingmodel->GetAttendanceDistrict($TraingData['Id']);

//            echo "<pre>";
//            print_r($DistrictId[0]['DistrictId']);
//            echo "</pre>";

            //die();

            $this->trainingmodel->DeleteAttendance($TraingData['Id']);
			$SaveData=array();
			$SaveData['TrainingId']=$TraingData['Id'];
			$SaveData['DistrictId']=$DistrictId[0]['DistrictId'];
			$SaveData['UserId']=$UserId;
			$SaveData['Activities']=$_POST['Activities'];
			$SaveData['ReportCardReview']=$_POST['Review'];
            $SaveData['ModuleNumber']=$_POST['ModuleNumber'];
			$SaveData['ReviewDate']=date('Y-m-d',strtotime($_POST['ReviewDate']));
			$SaveData['NumberOfIVRCompleted']=json_encode($_POST['IVRNumber']);
			$SaveData['StudentData']=json_encode($_POST['Students']);
			$SaveData['StudentDataOnline']=json_encode($_POST['StudentsOnline']);
			$SaveData['DateCreated']=date('Y-m-d h:i');
			$this->trainingmodel->SaveAttendanceData($SaveData);
            $tmpArr = array();
            $tmpArr['NumberOfIVRCompleted'] = $_POST['IVRNumber'];
            $SaveIVRData=array();
            foreach ($tmpArr['NumberOfIVRCompleted'] as $studentId=>$IVRData){
                if($IVRData) {
                    $SaveIVRData['DistrictId']=$DistrictId[0]['DistrictId'];
                    $SaveIVRData['UserId']=$UserId;
                    $SaveIVRData['Activities']=$_POST['Activities'];
                    $SaveIVRData['ReportCardReview']=$_POST['Review'];
                    $SaveIVRData['ReviewDate']=date('Y-m-d',strtotime($_POST['ReviewDate']));
                    $SaveIVRData['IVRCompleted']=$IVRData;
                    $SaveIVRData['StudentId']=$studentId;
                    $SaveIVRData['DateCreated']=date('Y-m-d');

                    $this->globalmodel->UpdateIVRFromAttendance($studentId,$SaveIVRData);

                }
            }
            $this->session->set_flashdata('msg', 'Attendance has been recorded.');
            redirect(base_url().'activity/ActivityList?Type=Training', 'refresh');
            die;
        }
		
        $StudentSchoolWise=$this->studentmodel->StudentSchoolWiseData($TraingData['SchoolId']);
		
		foreach($StudentSchoolWise as $Key=>$tmpAssess)
		{
			$StudentId=$tmpAssess['Id'];
			$StudentSchoolWise[$Key]['SectionOne']=count($this->schoolmodel->StudentSectionOne($StudentId));
			$StudentSchoolWise[$Key]['SectionTwo']=count($this->schoolmodel->StudentSectionTwo($StudentId));
			$StudentSchoolWise[$Key]['SectionThree']=count($this->schoolmodel->StudentSectionThree($StudentId));
		}
		$data['StudentSchoolWise']=$StudentSchoolWise;
		
		$StudentSchoolWise=$this->trainingmodel->GetAttendanceData($TraingData['Id']);
        $data['AttendanceData']=$StudentSchoolWise['0'];

        $AssessmentData=$this->assessmentmodel->AssessmentListData($UserId);
        $data['AssessmentData'] = $AssessmentData;

        $data['TrainingId'] = $TrainingId;

        $StudentIVRData=$this->trainingmodel->GetIVRData();
        $data['StudentIVRData']=$StudentIVRData;

        $this->load->innerTemplate('training/AttendanceTraining', $data);
    }

    

    public function UpdateTraining($Id)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        if(count($_POST))
        {
            $SaveData=$_POST;

            $SaveData['UserId']=$UserId;
            $SaveData['TrainingDate']=date('Y-m-d', strtotime($_POST['TrainingDate']));
            $SaveData['Volunteers']=json_encode(array_keys($_POST['Volunteers']));
            $SaveData['DateCreated']=date('Y-m-d h:i:s');

//            echo "<pre>";
//            print_r($SaveData);
//            echo "</pre>";
//            die();

            $this->trainingmodel->UpdateTraining($Id,$SaveData);
            $this->session->set_flashdata('msg', 'Training has been updated.');
            redirect(base_url().'activity/ActivityList?Type=Training', 'refresh');
            die;

            echo "<pre>";
            print_r($SaveData);
            echo "</pre>";
        }

        $TrainingData=$this->trainingmodel->GetTrainingData($Id);
        $data['TrainingData']=$TrainingData;

        $VolunteerData=$this->trainingmodel->GetVolunteerData();
        $data['VolunteerData']=$VolunteerData;

        if($SessionData['UserGroupId'] == '3'){
            $SchoolData = $this->schoolmodel->SchoolListData($UserId);
            $data['SchoolData'] = $SchoolData;
        }
        else {
            $SchoolData = $this->globalmodel->UserSchoolList($UserId);
            $data['SchoolData'] = $SchoolData;
        }



        $this->load->innerTemplate('training/UpdateTraining',$data);
    }

    public function DeleteTraining()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        $this->trainingmodel->DeleteTraining($_POST['Id']);
    }




}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */