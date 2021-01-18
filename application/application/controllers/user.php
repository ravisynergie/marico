<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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


    public function UserList()
    {
//        $UsersData = $this->usermodel->UserListData();
//        echo "<pre>";
//        print_r($UsersData);
//        echo "</pre>";
        $this->load->innerTemplate('user/UserList');
    }

    public function UserListData()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        echo json_encode($this->usermodel->UserListData());
    }

    public function AddNewUser()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        if(count($_POST))
        {
            $SaveData=$_POST;
            $SaveData['Password']=md5($_POST['Password']);
            $SaveData['JoiningDate']=date('Y-m-d', strtotime($_POST['JoiningDate']));
            $SaveData['DateCreated']=date('Y-m-d h:i:s');
//            echo "<pre>";
//            print_r($SaveData);
//            echo "</pre>";
//            die();

            $this->usermodel->CreateNewUser($SaveData);
            $this->session->set_flashdata('msg', 'User has been added.');
            redirect(base_url().'user/UserList', 'refresh');
            die;


        }
        $DesignationData=$this->usermodel->DesignationData();
        $data['DesignationData']=$DesignationData;

        $this->load->innerTemplate('user/AddNewUser', $data);
    }

    public function UpdateUser($Id)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        if(count($_POST))
        {
            $SaveData=$_POST;
            if($_POST['Password']) {
                $SaveData['Password'] = md5($_POST['Password']);
            }
            $SaveData['JoiningDate']=date('Y-m-d', strtotime($_POST['JoiningDate']));

            $this->usermodel->UpdateUser($Id,$SaveData);
            $this->session->set_flashdata('msg', 'User has been updated.');
            redirect(base_url().'user/UserList', 'refresh');
            die;

            echo "<pre>";
            print_r($SaveData);
            echo "</pre>";
        }

        $UsersData=$this->usermodel->GetUserData($Id);
        $data['UsersData']=$UsersData;

        $DesignationData=$this->usermodel->DesignationData();
        $data['DesignationData']=$DesignationData;

        $this->load->innerTemplate('user/UpdateUser',$data);
    }

    public function DeleteUser()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        $this->usermodel->DeleteUser($_POST['Id']);
    }






}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */