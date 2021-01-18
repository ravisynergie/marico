<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {

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
		$this->load->model('schoolmodel');
        $this->load->model('villagemodel');
        $this->load->model('blockmodel');
        $this->load->model('districtmodel');
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
	
	
	public function StudentList()
	{
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        /*
		$DistrictData=$this->districtmodel->DistrictListData($UserId);
        $data['DistrictData']=$DistrictData;

        $BlockData=$this->blockmodel->BlockListData($UserId);
        $data['BlockData']=$BlockData;

        $VillageData=$this->villagemodel->VillageListData($UserId);
        $data['VillageData']=$VillageData;

        $SchoolData=$this->schoolmodel->SchoolListData($UserId);
        $data['SchoolData']=$SchoolData;
		*/

        if($SessionData['UserGroupId']==5)
        {
            $DistrictData=$this->globalmodel->UserDistrictList($UserId);
            $BlockData=$this->globalmodel->UserBlockList($UserId);
            $VillageData=$this->globalmodel->UserVillageList($UserId);
            $SchoolData=$this->globalmodel->UserSchoolList($UserId);
        }
        else
        {
            $DistrictData=$this->districtmodel->DistrictListData($UserId);
            $BlockData=$this->blockmodel->BlockListData($UserId);
            $VillageData=$this->villagemodel->VillageListData($UserId);
            $SchoolData=$this->schoolmodel->SchoolListData($UserId);
        }
		
		$data['UserGroupId']=$SessionData['UserGroupId'];
		//$DistrictData=$this->globalmodel->UserDistrictList($UserId);
		$data['DistrictData']=$DistrictData;
		
        //$BlockData=$this->globalmodel->UserBlockList($UserId);
        $data['BlockData']=$BlockData;

		//$VillageData=$this->globalmodel->UserVillageList($UserId);
        $data['VillageData']=$VillageData;
		
		//$SchoolData=$this->globalmodel->UserSchoolList($UserId);
        $data['SchoolData']=$SchoolData;

//        $StudentData=$this->globalmodel->UserStudentList($UserId,$_GET);
//        $data['StudentData']=$StudentData;
//
//        $IVRData=$this->trainingmodel->AllIVRStudentData();
//        $data['IVRData']=$IVRData;

		$this->load->innerTemplate('student/StudentList',$data);
	}
	
	public function StudentListData()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		if($SessionData['UserGroupId']==5)
		{
			$StudentData=$this->globalmodel->UserStudentList($UserId,$_GET);

		}
		else
		{
			$FilterData=array();
			$FilterData['OrderById']=1;
			//$FilterData['Limit']=100;

			$StudentData=$this->studentmodel->StudentManagerListData($FilterData,$_GET);
		}
		echo json_encode($StudentData);
	}
	
	public function AddNewStudent()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;
		
		if(count($_POST))
		{
			$SaveData=$_POST;
			$SaveData['UserId']=$UserId;
			$SaveData['DateCreated']=date('Y-m-d h:i:s');
			$this->studentmodel->CreateNewStudent($SaveData);
			$this->session->set_flashdata('msg', 'Student has been added.');
			redirect(base_url().'student/StudentList', 'refresh');
			die;
			
			echo "<pre>";
			print_r($SaveData);
			echo "</pre>";
		}
        if($_GET['ProjectView']){
            $SchoolData = $this->schoolmodel->SchoolListData($UserId);
            $data['SchoolData'] = $SchoolData;
        }
        else {
            $SchoolData = $this->globalmodel->UserSchoolList($UserId);
            $data['SchoolData'] = $SchoolData;
        }
		$this->load->innerTemplate('student/AddNewStudent', $data);
	}
	
	public function UpdateStudent($Id)
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		if(count($_POST))
		{
			$SaveData=$_POST;
			$this->studentmodel->UpdateStudent($Id,$SaveData);
			$this->session->set_flashdata('msg', 'Student has been updated.');
			redirect(base_url().'student/StudentList', 'refresh');
			die;
			
			echo "<pre>";
			print_r($SaveData);
			echo "</pre>";
		}
		
		$StudentData=$this->studentmodel->GetStudentData($Id);
		$data['StudentData']=$StudentData;

        $SchoolData=$this->globalmodel->UserSchoolList($UserId);
        $data['SchoolData']=$SchoolData;
        
		$this->load->innerTemplate('student/UpdateStudent',$data);
	}
	
	public function DeleteStudent()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		$this->studentmodel->DeleteStudent($_POST['Id']);
	}



    public function SearchStudent(){


        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        //echo '<pre>';
        //print_r($this->schoolmodel->SchoolSearchListData($UserId,$_GET['DistrictId'],$_GET['BlockId'],$_GET['VillageId'],$_GET['Name']));
        //echo '</pre>';

        echo json_encode($this->studentmodel->StudentSearchListData($UserId,$_GET['DistrictId'],$_GET['BlockId'],$_GET['VillageId'],$_GET['SchoolId'],$_GET['Name']));

    }



    public function StudentData()
    {
        $StudentData=$this->studentmodel->StudentTrainingWiseData();
        $data['StudentData']=$StudentData;

        //$AttendanceData=$this->studentmodel->AttendenceStudentData();
        //$data['AttendanceData']=$AttendanceData;


//        echo '<pre>';
//        print_r($StudentData);
//        echo '</pre>';
			
		$this->load->view('student/StudentData',$data);
    }

		
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */