<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimonial extends CI_Controller {

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
        $this->load->model('testimonialmodel');
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



    public function TestimonialList()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];


        if($_POST['Type'])
        {
//            echo '<pre>';
//            print_r($_POST);
//            echo '</pre>';

            $SaveData=array();

            if($_POST['Type'] == 'Image')
            {
                $FileName='assets/testimonial/image/'.$_FILES['fileToUpload']['name'];
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$FileName);

                $ThumbName='assets/testimonial/image/thumb/'.$_FILES['thumbToUpload']['name'];
                move_uploaded_file($_FILES["thumbToUpload"]["tmp_name"],$ThumbName);

            }
            if($_POST['Type'] == 'Audio')
            {
                $FileName='assets/testimonial/audio/'.$_FILES['fileToUpload']['name'];
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$FileName);

                $ThumbName='assets/testimonial/audio/thumb/'.$_FILES['thumbToUpload']['name'];
                move_uploaded_file($_FILES["thumbToUpload"]["tmp_name"],$ThumbName);

            }
            if($_POST['Type'] == 'Video')
            {
                $FileName='assets/testimonial/video/'.$_FILES['fileToUpload']['name'];
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$FileName);

                $ThumbName='assets/testimonial/video/thumb/'.$_FILES['thumbToUpload']['name'];
                move_uploaded_file($_FILES["thumbToUpload"]["tmp_name"],$ThumbName);

            }




            $SaveData['UserId']=$UserId;
            $SaveData['Title']=$_POST['Title'];
            $SaveData['Type']=$_POST['Type'];
            $SaveData['FileUpload']=$FileName;
            $SaveData['ThumbImage']=$ThumbName;
            $SaveData['Description']=$_POST['Description'];
            $SaveData['DateCreated']=date('Y-m-d h:i:s');
            //$SaveData['UploadDate']=date("Y-m-d", strtotime($_POST['UploadDate']));
            echo '<pre>';
            print_r($SaveData);
            echo '</pre>';
            //die();
            $this->testimonialmodel->InsertTestimonial($SaveData);
            redirect(base_url().'testimonial/TestimonialList/', '');
            die;

            //die();
        }


        $TestimonialData=$this->testimonialmodel->TestimonialListData($UserId);
        $data['TestimonialData'] = $TestimonialData;


        $VillageData=$this->globalmodel->UserVillageList($UserId);
        $data['VillageData']=$VillageData;

        $SchoolData=$this->globalmodel->UserSchoolList($UserId);
        $data['SchoolData']=$SchoolData;

//        $SchoolData=$this->schoolmodel->SchoolListData($UserId);
//        $data['SchoolData']=$SchoolData;
//
//        $VillageData=$this->villagemodel->VillageListData($UserId);
//        $data['VillageData']=$VillageData;

        if($_POST['TypeFIlter'])
        {

            //print_r($_POST['TypeFIlter']);

            $TestimonialData=$this->testimonialmodel->TestimonialListData($UserId, $_POST['TypeFIlter']);
            $data['TestimonialData'] = $TestimonialData;


        }

//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
//         die;
        $this->load->innerTemplate('testimonial/TestimonialList',$data);
    }


    public function ImageDelete($id)
    {
        $this->testimonialmodel->ImageDelete($_POST['id']);
    }




}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */