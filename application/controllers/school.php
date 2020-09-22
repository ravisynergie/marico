<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School extends CI_Controller {

	/*
	 * Vendor Page for this controller.
	 *
	 * Manage Vendor (Add, Edit and Delete)
	 
	 */
	var $sessionData;
	
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('schoolmodel');
		$this->load->model('globalmodel');
		$this->load->model('villagemodel');
        $this->load->model('blockmodel');
        $this->load->model('districtmodel');
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
	
	
	public function SchoolList()
	{
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;
        /*
		$DistrictData=$this->districtmodel->DistrictListData($UserId);
        $data['DistrictData']=$DistrictData;

        $BlockData=$this->blockmodel->BlockListData($UserId);
        $data['BlockData']=$BlockData;

        $VillageData=$this->villagemodel->VillageListData($UserId);
        $data['VillageData']=$VillageData;
		*/
        if($SessionData['UserGroupId']==5)
        {
            $DistrictData=$this->globalmodel->UserDistrictList($UserId);
            $BlockData=$this->globalmodel->UserBlockList($UserId);
            $VillageData=$this->globalmodel->UserVillageList($UserId);
        }
        else
        {
            $DistrictData=$this->districtmodel->DistrictListData($UserId);
            $BlockData=$this->blockmodel->BlockListData($UserId);
            $VillageData=$this->villagemodel->VillageListData($UserId);
        }

		$data['UserGroupId']=$SessionData['UserGroupId'];
		//$DistrictData=$this->globalmodel->UserDistrictList($UserId);
		$data['DistrictData']=$DistrictData;
		
        //$BlockData=$this->globalmodel->UserBlockList($UserId);
        $data['BlockData']=$BlockData;

		//$VillageData=$this->globalmodel->UserVillageList($UserId);
        $data['VillageData']=$VillageData;

        $data['TrainerData']=$this->usermodel->GetTrainerData($UserId);

		$this->load->innerTemplate('school/SchoolList',$data);
	}
	
	public function SchoolListData()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		if($SessionData['UserGroupId']==5)
		{
			$DistrictData=$this->globalmodel->UserSchoolList($UserId,$_GET);
		}
		else
		{
			$FilterData=array();
			$FilterData['OrderById']=1;
			$DistrictData=$this->schoolmodel->SchoolManagerListDashboardData($FilterData,$_GET);
		}
		echo json_encode($DistrictData);		
	}
	
	public function AddNewSchool()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;
		
		if(count($_POST))
		{
			$SaveData=$_POST;
			$SaveData['UserId']=$UserId;
			$SaveData['DateCreated']=date('Y-m-d h:i:s');
			$this->schoolmodel->CreateNewSchool($SaveData);
			$this->session->set_flashdata('msg', 'School has been added.');
            if($_GET['ProjectView']){
                redirect(base_url() . 'dashboard/ProjectView#Schools', 'refresh');
            }
            else {
                redirect(base_url().'school/SchoolList', 'refresh');
            }

			die;
			
			echo "<pre>";
			print_r($SaveData);
			echo "</pre>";
		}
        if($_GET['ProjectView']){
            $VillageData = $this->villagemodel->VillageListData($UserId);
            $data['VillageData'] = $VillageData;
        }
        else {
            //$VillageData = $this->globalmodel->UserDistrictVillageList($UserId);
            //$data['VillageData'] = $VillageData;
            $VillageData=$this->villagemodel->VillageListData($UserId);
            $data['VillageData']=$VillageData;


        }

        $VillageData=$this->villagemodel->VillageListData($UserId);
        $data['VillageData']=$VillageData;
		
		$this->load->innerTemplate('school/AddNewSchool', $data);
	}
	
	public function UpdateSchool($Id)
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		if(count($_POST))
		{
			$SaveData=$_POST;
			$this->schoolmodel->UpdateSchool($Id,$SaveData);
			$this->session->set_flashdata('msg', 'School has been updated.');
			redirect(base_url().'school/SchoolList', 'refresh');
			die;
			
			echo "<pre>";
			print_r($SaveData);
			echo "</pre>";
		}
		
		$SchoolData=$this->schoolmodel->GetSchoolData($Id);
		$data['SchoolData']=$SchoolData;

//        $VillageData=$this->globalmodel->UserVillageList($UserId);
//        $data['VillageData']=$VillageData;
        $VillageData=$this->villagemodel->VillageListData($UserId);
        $data['VillageData']=$VillageData;
        
		$this->load->innerTemplate('school/UpdateSchool',$data);
	}
	
	public function DeleteSchool()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		$this->schoolmodel->DeleteSchool($_POST['Id']);
	}


    public function SearchSchool(){


        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        //echo '<pre>';
        //print_r($this->schoolmodel->SchoolSearchListData($UserId,$_GET['DistrictId'],$_GET['BlockId'],$_GET['VillageId'],$_GET['Name']));
        //echo '</pre>';

        echo json_encode($this->schoolmodel->SchoolSearchListData($UserId,$_GET['DistrictId'],$_GET['BlockId'],$_GET['VillageId'],$_GET['Name']));

    }
	
	
	

	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */