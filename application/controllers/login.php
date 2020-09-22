<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/*
	 * Login Page for this controller.
	 *
	 * Verify user credential to access application.
	
	 */
	 
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('loginmodel');
		$this->load->helper('app_function');
	}
	
	public function logout()
	{
		$this->session->unset_userdata('loginUserData');
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
		die;
	}
	
	public function index()
	{
		if($this->session->userdata("loginUserData"))
		{
			redirect(base_url().'dashboard/index', 'refresh');
			die;
		}
		$this->load->loginTemplate('login/login');
	}
	
	public function validate()
	{
		$userData=$this->loginmodel->validate($_POST);		
		if($userData=='Invalid')
		{
			echo "Invalid";	
		}
		else
		{
			$UserId=$userData['Id'];			
			if($UserId == 1) 
			{
				$this->session->set_userdata("loginUserData",$userData);
				$SessionData=$this->session->userdata("loginUserData");
			}
			else
			{
                $TodayAuth = $this->loginmodel->CheckTodatAuth($UserId);
				if(count($TodayAuth))
				{
					$this->session->set_userdata("loginUserData",$userData);
					$SessionData=$this->session->userdata("loginUserData");
                }
                else 
				{
                    $EmailId = $userData['Email'];
                    $Code = rand(6543546, 879136546);
                    $Code = substr($Code, 0, 4);
                    $SaveData = array();
                    $SaveData['UserId'] = $UserId;
                    $SaveData['Code'] = $Code;
                    $SaveData['Date'] = date('Y-m-d');
                    $SaveData['DateCreated'] = date('Y-m-d h:i:s');
                    $this->loginmodel->SaveAuth($SaveData);
                    $to = $EmailId;
                    $subject = "Your 4 digit login code";
                    $txt = "Your marico login code is " . $Code;
                    $headers = "From: Synergie<info@synergie.in>" . "\r\n";
                    mail($to, $subject, $txt, $headers);
					echo "Auth";	
					die;
                }
            }
			redirect(base_url(), 'refresh');  
		}
	}


    public function auth()
    {
        $this->load->loginTemplate('login/auth');
    }

    public function validateAuth()
    {
        $userData=$this->loginmodel->validateAuth($_POST);
        if($userData=='Invalid')
        {
            echo "InvalidAuth";
        }
        else
        {
            $this->session->set_userdata("loginUserData",$userData);
             echo "Success";
        }
    }
	
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */