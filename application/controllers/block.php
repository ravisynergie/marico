<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Block extends CI_Controller {

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
	
	
	public function BlockList()
	{
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $DistrictData=$this->districtmodel->DistrictListData($UserId);
        $data['DistrictData']=$DistrictData;
		$this->load->innerTemplate('block/BlockList', $data);
	}
	
	public function BlockListData()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		$FilterData=array();
		$FilterData['OrderById']=1;
		echo json_encode($this->blockmodel->BlockManagerListboardData($FilterData));		
	}
	
	public function AddNewBlock()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;
		
		if(count($_POST))
		{
			$SaveData=$_POST;
			$SaveData['UserId']=$UserId;
			$SaveData['DateCreated']=date('Y-m-d h:i:s');
			$this->blockmodel->CreateNewBlock($SaveData);
			$this->session->set_flashdata('msg', 'Block has been added.');
            if($_GET['ProjectView']){
                redirect(base_url() . 'dashboard/ProjectView#Block', 'refresh');
            }
            else {
                redirect(base_url().'block/BlockList', 'refresh');
            }

			die;
			
			echo "<pre>";
			print_r($SaveData);
			echo "</pre>";
		}
		$DistrictData=$this->districtmodel->DistrictListData($UserId);
		
		$data['DistrictData']=$DistrictData;
		$this->load->innerTemplate('block/AddNewBlock',$data);
	}
	
	public function UpdateBlock($Id)
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		if(count($_POST))
		{
			$SaveData=$_POST;
			$this->blockmodel->UpdateBlock($Id,$SaveData);
			$this->session->set_flashdata('msg', 'Block has been updated.');
			redirect(base_url().'block/BlockList', 'refresh');
			die;
			
			echo "<pre>";
			print_r($SaveData);
			echo "</pre>";
		}
		
		$BlockData=$this->blockmodel->GetBlockData($Id);
		$data['BlockData']=$BlockData;
		
		$DistrictData=$this->districtmodel->DistrictListData($UserId);
		$data['DistrictData']=$DistrictData;
		
		$this->load->innerTemplate('block/UpdateBlock',$data);
	}
	
	public function DeleteBlock()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		$this->blockmodel->DeleteBlock($_POST['Id']);
	}

	public function SearchBlock(){


        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        echo json_encode($this->blockmodel->BlockSearchListData($UserId,$_GET['DistrictId'],$_GET['Name']));

    }
		
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */