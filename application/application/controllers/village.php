<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Village extends CI_Controller {

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
	
	
	public function VillageList()
	{
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;

		if($SessionData['UserGroupId']==5)
		{
			$DistrictData=$this->globalmodel->UserDistrictList($UserId);
			$BlockData=$this->globalmodel->UserBlockList($UserId);
		}
		else
		{
			$DistrictData=$this->districtmodel->DistrictListData($UserId);
			$BlockData=$this->blockmodel->BlockListData($UserId);
		}
        $data['TrainerData']=$this->usermodel->GetTrainerData($UserId);
		$data['DistrictData']=$DistrictData;
		$data['BlockData']=$BlockData;
		$data['UserGroupId']=$SessionData['UserGroupId'];



		$this->load->innerTemplate('village/VillageList',$data);
	}
	
	public function VillageListData()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		//echo "<pre>";
		//print_r($_GET);
		//echo "</pre>";
		
		if($SessionData['UserGroupId']==5)
		{
			$DistrictData=$this->globalmodel->UserVillageList($UserId,$_GET);
		}
		else
		{

			$DistrictData=$this->villagemodel->VillageListData($UserId,$_GET);
		}

        //$DistrictData=$this->villagemodel->VillageListData($UserId);
		//echo "<pre>";
		//print_r($DistrictData);
		//echo "</pre>";
		
		echo json_encode($DistrictData);		
	}
	
	public function AddNewVillage()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;
        
		if(count($_POST))
		{
			$SaveData=$_POST;

			$SaveData['UserId']=$UserId;
			$SaveData['DateCreated']=date('Y-m-d h:i:s');
            $SaveData['StakeholdersName'] = json_encode($_POST['StakeholdersName']);
            $SaveData['StakeholdersDesignation'] = json_encode($_POST['StakeholdersDesignation']);
            $SaveData['OtherDesignationName'] = json_encode($_POST['OtherDesignationName']);
            $SaveData['StakeholdersContact'] = json_encode($_POST['StakeholdersContact']);

//            echo "<pre>";
//            print_r($SaveData);
//            echo "</pre>";
//            die();

			$this->villagemodel->CreateNewVillage($SaveData);
			$this->session->set_flashdata('msg', 'Village has been added.');
            if($_GET['ProjectView']){
                redirect(base_url() . 'dashboard/ProjectView#Village', 'refresh');
            }
            else {
                redirect(base_url().'village/VillageList', 'refresh');
            }

			die;
			
			echo "<pre>";
			print_r($SaveData);
			echo "</pre>";
		}

        if($_GET['ProjectView']){
            $DistrictData = $this->districtmodel->DistrictListData($UserId);
            $data['DistrictData'] = $DistrictData;

            $BlockData = $this->blockmodel->BlockListData($UserId);
            $data['BlockData'] = $BlockData;
        }
        else {
            //$DistrictData = $this->globalmodel->UserDistrictList($UserId);
            //$data['DistrictData'] = $DistrictData;

//            $BlockData = $this->globalmodel->UserBlockList($UserId);
//            $data['BlockData'] = $BlockData;

            $DistrictData = $this->districtmodel->DistrictListData($UserId);
            $data['DistrictData'] = $DistrictData;

            $BlockData = $this->blockmodel->BlockListData($UserId);
            $data['BlockData'] = $BlockData;
        }
		
		$this->load->innerTemplate('village/AddNewVillage',$data);
	}
	
	public function UpdateVillage($Id)
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		if(count($_POST))
		{
			$SaveData=$_POST;
            $SaveData['StakeholdersName'] = json_encode($_POST['StakeholdersName']);
            $SaveData['StakeholdersDesignation'] = json_encode($_POST['StakeholdersDesignation']);
            $SaveData['OtherDesignationName'] = json_encode($_POST['OtherDesignationName']);
            $SaveData['StakeholdersContact'] = json_encode($_POST['StakeholdersContact']);
//            echo "<pre>";
//            print_r($SaveData);
//            echo "</pre>";
//            die;

			$this->villagemodel->UpdateVillage($Id,$SaveData);
			$this->session->set_flashdata('msg', 'Village has been updated.');
			redirect(base_url().'village/VillageList', 'refresh');
			die;
			
			echo "<pre>";
			print_r($SaveData);
			echo "</pre>";
		}

        $DistrictData=$this->globalmodel->UserDistrictList($UserId);
        $data['DistrictData']=$DistrictData;

//        $BlockData=$this->globalmodel->UserBlockList($UserId);
//        $data['BlockData']=$BlockData;

        $BlockData = $this->blockmodel->BlockListData($UserId);
        $data['BlockData'] = $BlockData;
        
		
		$VillageData=$this->villagemodel->GetVillageData($Id);
		$data['VillageData']=$VillageData;
		$this->load->innerTemplate('village/UpdateVillage',$data);
	}
	
	public function DeleteVillage()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		$this->villagemodel->DeleteVillage($_POST['Id']);
	}


    public function AddStakeholders()
    {
        ?>

        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="exampleInputEmail1">Stakeholders Name</label>
                    <input class="form-control" id="StakeholdersName" name="StakeholdersName[]" placeholder="Enter stakeholders name" type="text">
                </div>


            </div>

            <div class="col-3">
                <div class="form-group">
                    <label for="exampleInputEmail1">Stakeholders Designation</label>
                    <select class="form-control" id="StakeholdersDesignation" name="StakeholdersDesignation[]" onChange="">
                        <option value="">Stakeholders Designation</option>
                        <option>Pradhan</option>
                        <option>Govt. Official</option>
                        <option>Educated Youth</option>
                        <option>opinion Leader</option>
                        <option>Ngo Worker</option>
                        <option>DM</option>
                        <option>DIOS</option>
                        <option>BSA</option>
                        <option>CDO</option>
                        <option>AWW</option>
                        <option>ASHA</option>
                        <option>SHG Member</option>
<!--                        <option>Other</option>-->

                    </select>
                </div>



            </div>

<!--            <div class="col-3 OtherDesignationName--><?php //echo $_POST['otherTime']?><!--">-->
<!--                <div class="form-group">-->
<!--                    <label for="exampleInputEmail1">Other Designation Name</label>-->
<!--                    <input class="form-control" id="OtherDesignationName" name="OtherDesignationName[]" placeholder="Enter other designation name" type="text">-->
<!--                </div>-->
<!---->
<!--            </div>-->

            <div class="col-2">

                <div class="form-group">
                    <label for="exampleInputEmail1">Stakeholders Contact</label>
                    <input class="form-control" id="StakeholdersContact" name="StakeholdersContact[]" placeholder="Enter stakeholders contact" type="text">
                </div>
            </div>

        </div>

        <?php
    }



    public function SearchVillage(){


        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        echo json_encode($this->villagemodel->VillageSearchListData($UserId,$_GET['DistrictId'],$_GET['BlockId'],$_GET['Name']));

    }










	


	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */