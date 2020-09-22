<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class District extends CI_Controller {

	/*
	 * Vendor Page for this controller.
	 *
	 * Manage Vendor (Add, Edit and Delete)
	 
	 */
	var $sessionData;
	
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('districtmodel');
		$this->load->model('gallerymodel');
		$this->load->model('schoolmodel');
		$this->load->model('villagemodel');
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
		//phpinfo();
	}
	
	
	public function Dashboard()
	{
		$this->load->innerTemplate('district/Dashboard');
	}
	
	public function DistrictList()
	{
		$this->load->innerTemplate('district/DistrictList');
	}
	
	public function GalleryList()
	{
		$SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['UserGroupId']=$SessionData['UserGroupId'];
        $data['SessionData'] = $SessionData;

        if($_POST['Type'])
        {
//            echo '<pre>';
//            print_r($_POST);
//            echo '</pre>';

            $SaveData=array();

            if($_POST['Type'] == 'School')
            {
                $NewFileName='assets/marico_gallery/school/'.$_FILES['fileToUpload']['name'];
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$NewFileName);
                $SaveData['ParentId']=$_POST['SchoolId'];
            }
            if($_POST['Type'] == 'Village')
            {
                $NewFileName='assets/marico_gallery/village/'.$_FILES['fileToUpload']['name'];
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$NewFileName);
                $SaveData['ParentId']=$_POST['VillageId'];
            }

            $SaveData['UserId']=$UserId;
            $SaveData['Type']=$_POST['Type'];
            $SaveData['ImagePath']=$NewFileName;
            $SaveData['Caption']=$_POST['imageCaption'];
            $SaveData['DateCreated']=date('Y-m-d h:i:s');
            //$SaveData['UploadDate']=date("Y-m-d", strtotime($_POST['UploadDate']));
            $this->gallerymodel->InsertImage($SaveData);
            redirect(base_url().'district/GalleryList/', '');
            die;

            //die();
        }

		
        $data['GalleryData']=$this->gallerymodel->GalleryListData($UserId);

        $VillageData=$this->globalmodel->UserVillageList($UserId);
        $data['VillageData']=$VillageData;

        $SchoolData=$this->globalmodel->UserSchoolList($UserId);
        $data['SchoolData']=$SchoolData;
        $data['TrainerData']=$this->usermodel->GetTrainerData($UserId);
//        $SchoolData=$this->schoolmodel->SchoolListData($UserId);
//        $data['SchoolData']=$SchoolData;
//
//        $VillageData=$this->villagemodel->VillageListData($UserId);
//        $data['VillageData']=$VillageData;

        if($_POST['TypeFIlter'])
        {
            $data['GalleryData']=$this->gallerymodel->GalleryListData($UserId, $_POST['TypeFIlter']);
        }
        if($_POST['UserName'])
        {
            $data['GalleryData']=$this->gallerymodel->GalleryListTrainerData($_POST['UserName']);
        }

        if($_POST['DowmloadImage'])
        {
            $folder_path = "assets/marico_gallery/AllImages";
            $files = glob($folder_path.'/*');
            foreach($files as $file) {
                if(is_file($file))
                    unlink($file);
            }

            foreach ($data['GalleryData'] as $datum){
                $imagePath=explode("/",$datum['ImagePath']);
                $srcfile = $datum['ImagePath'];
                $destfile = 'assets/marico_gallery/AllImages/'.$imagePath[3];
                copy($srcfile, $destfile);

            }

            $pathdir = 'assets/marico_gallery/AllImages/';
            $zip = new ZipArchive;
            $tmp_file = "images.zip";
            if ($zip->open($tmp_file,  ZipArchive::CREATE)) {
                    if ($dh = opendir($pathdir)){
                        while (($file = readdir($dh)) !== false){
                            $content = file_get_contents($file);
                            $zip->addFromString(pathinfo ( $file, PATHINFO_BASENAME), $content);
                        }
                    }
                $zip->close();
            }

            $zipBaseName = basename($tmp_file);
            header("Content-Type: application/zip");
            header("Content-Disposition: attachment; filename=$zipBaseName");
            header("Content-Length: " . filesize($tmp_file));
            readfile(base_url().$tmp_file);


            die;

        }
		$this->load->innerTemplate('district/GalleryList',$data);
	}

    public function UpdateGallery($Id)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        if(count($_POST))
        {

            //$SaveData=$_POST;
//            $SaveData['UserId']=$UserId;
//            $SaveData['DateCreated']=date('Y-m-d h:i:s');
            $SaveData = array();
            if($_POST['Type'] == 'School')
            {

                $SaveData['ParentId']=$_POST['SchoolId'];
            }
            if($_POST['Type'] == 'Village')
            {

                $SaveData['ParentId']=$_POST['VillageId'];
            }
            $SaveData['Type']=$_POST['Type'];
            $SaveData['Caption']=$_POST['imageCaption'];



            $this->gallerymodel->UpdateGallery($Id,$SaveData);
            $this->session->set_flashdata('msg', 'Gallery has been updated.');
            redirect(base_url().'district/GalleryList', 'refresh');
            die;

            echo "<pre>";
            print_r($SaveData);
            echo "</pre>";
        }

        $VillageData=$this->globalmodel->UserVillageList($UserId);
        $data['VillageData']=$VillageData;

        $SchoolData=$this->globalmodel->UserSchoolList($UserId);
        $data['SchoolData']=$SchoolData;

        $GalleryData=$this->gallerymodel->GalleryUpdateData($Id);
        $data['GalleryData']=$GalleryData;

//        echo "<pre>";
//        print_r($GalleryData);
//        echo "</pre>";
        //die;


        $this->load->innerTemplate('district/UpdateGallery',$data);
    }

	
	public function DistrictListData()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		$FilterData=array();
		$FilterData['OrderById']=1;
		echo json_encode($this->districtmodel->DistrictManagerListData($FilterData));		
	}
	
	public function AddNewDistrict()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		$data['SessionData'] = $SessionData;
		
		if(count($_POST))
		{
			$SaveData=$_POST;
			$SaveData['UserId']=$UserId;
			$SaveData['DateCreated']=date('Y-m-d h:i:s');
			$this->districtmodel->CreateNewDistrict($SaveData);
			$this->session->set_flashdata('msg', 'District has been added.');
			if($_GET['ProjectView']){
                redirect(base_url() . 'dashboard/ProjectView', 'refresh');
            }
			else {
                redirect(base_url() . 'district/DistrictList', 'refresh');
            }
			die;
			
			echo "<pre>";
			print_r($SaveData);
			echo "</pre>";
		}
		
		$this->load->innerTemplate('district/AddNewDistrict',$data);
	}
	
	public function UpdateDistrict($Id)
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		if(count($_POST))
		{
			$SaveData=$_POST;
			$this->districtmodel->UpdateDistrict($Id,$SaveData);
			$this->session->set_flashdata('msg', 'District has been updated.');
			redirect(base_url().'district/DistrictList', 'refresh');
			die;
			
			echo "<pre>";
			print_r($SaveData);
			echo "</pre>";
		}
		
		$DistrictData=$this->districtmodel->GetDistrictData($Id);
		$data['DistrictData']=$DistrictData;
		$this->load->innerTemplate('district/UpdateDistrict',$data);
	}
	
	public function DeleteDistrict()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		$this->districtmodel->DeleteDistrict($_POST['Id']);
	}



    public function createZip($zip,$dir){
        if (is_dir($dir)){

            if ($dh = opendir($dir)){
                while (($file = readdir($dh)) !== false){

                    // If file
                    if (is_file($dir.$file)) {
                        if($file != '' && $file != '.' && $file != '..'){

                            $zip->addFile($dir.$file);
                        }
                    }else{
                        // If directory
                        if(is_dir($dir.$file) ){

                            if($file != '' && $file != '.' && $file != '..'){

                                // Add empty directory
                                $zip->addEmptyDir($dir.$file);

                                $folder = $dir.$file.'/';

                                // Read data of the folder
                                createZip($zip,$folder);
                            }
                        }

                    }

                }
                closedir($dh);
            }
        }
    }





	
	
	
	
	
	
	public function CompletedFDList()
	{
		$this->load->innerTemplate('eriden/CompletedFDList');
	}
	
	public function CompletedFDListData()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		echo json_encode($this->eridenmodel->CompletedFDListData($UserId));		
	}
	
	public function SaveFDData()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		if($_POST['FDId'])
		{
			$FDId=$_POST['FDId'];
			unset($_POST['FDId']);
			$this->eridenmodel->UpdateFDData($_POST,$FDId);	
		}
		else
		{
			unset($_POST['FDId']);
			$_POST['DateCreated']=date('Y-m-d H:i:s');
			$_POST['UserId']=$UserId;
			$this->eridenmodel->SaveFDData($_POST);	
		}
	}
	
	public function FDUpdate($FDId)
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		echo json_encode($this->eridenmodel->FDUpdate($FDId,$UserId));
	}
	
	public function FDDelete()
	{
		$SessionData=$this->session->userdata("loginUserData");
		$UserId=$SessionData['Id'];
		
		$this->eridenmodel->FDDelete($_POST['FDId'],$UserId);
	}


		
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */