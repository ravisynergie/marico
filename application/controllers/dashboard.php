<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$this->load->model('globalmodel');
		$this->load->model('districtmodel');
		$this->load->model('loginmodel');
		$this->load->model('villagemodel');
		$this->load->model('schoolmodel');
		$this->load->model('studentmodel');
		$this->load->model('gallerymodel');
		$this->load->model('trainingmodel');
		$this->load->model('eventmodel');
		$this->load->model('testimonialmodel');
		$this->load->model('usermodel');
		$this->load->model('assessmentmodel');
		$this->load->model('meetingmodel');

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

    public function index()
    {

        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;



        $data['UserGroupId']=$SessionData['UserGroupId'];
        $data['DistrictAllData']=$this->districtmodel->DistrictListData($UserId);
        $FilterData=array();
        if($_GET['DistrictId'])
        {
            $FilterData['DistrictId']=$_GET['DistrictId'];
            $data['FilterDistrictId']=$_GET['DistrictId'];
        }

        if($_GET['TrainerId'])
        {
            $FilterData['FilterTrainerId']=$_GET['TrainerId'];
            $data['FilterTrainerId']=$_GET['TrainerId'];
        }

        $data['DistrictData']=$this->districtmodel->DistrictManagerListData($FilterData);
        $data['VillageData']=$this->villagemodel->VillageManagerListboardData($FilterData);
        $data['SchoolData']=$this->schoolmodel->SchoolManagerListDashboardData($FilterData);
        $data['StudentData']=$this->studentmodel->StudentManagerListData($FilterData);
        $data['TrainingData']=$this->trainingmodel->TrainingManagerListData($FilterData);
        $data['GalleryData']=$this->gallerymodel->GallerySingleData($FilterData);
        $data['IVRStudentData']=$this->trainingmodel->IVRStudentData($FilterData);
        $data['EventData']=$this->eventmodel->EventListData($FilterData);
        $data['TestimonialData']=$this->testimonialmodel->TestimonialSingleData($FilterData);
        $data['TrainerData']=$this->usermodel->GetTrainerData($FilterData);
        $data['AssessmentData']=$this->assessmentmodel->AssessmentDashboardData($FilterData);
        $data['OnlineAssessmentData']=$this->assessmentmodel->OnlineAssessmentDashboardData($FilterData);
        $data['StudentScoringData']=$this->assessmentmodel->StudentScoringDashboardData($FilterData);
        $data['OnlineStudentScoringData']=$this->assessmentmodel->OnlineStudentScoringDashboardData($FilterData);
        $data['StudentScoringProgressBarData']=$this->assessmentmodel->StudentScoringProgressBarData($UserId);
        $data['OnlineStudentScoringProgressBarData']=$this->assessmentmodel->OnlineStudentScoringProgressBarData($UserId);
        $data['MeetingData']=$this->meetingmodel->MeetingManagerListData($FilterData);

        $StudentIVRData=$this->trainingmodel->GetIVRDataDashboard($FilterData);
        $data['StudentIVRData']=$StudentIVRData;

        if($_GET['debug'] == 1) {
//            echo "<pre>";
//            print_r($data['OnlineAssessmentData']);
//            echo "</pre>";
        }
        //$StudentScoring=$data['StudentScoringData'];
        $StudentScoring=$data['StudentScoringProgressBarData'];

        $A1Achieved=0;
        $B1Achieved=0;
        $C1Achieved=0;
        $D1Achieved=0;

        foreach ($StudentScoring as $StudScor){
            if($StudScor['A1'] == 1){
                $A1Achieved++;
            }

            if($StudScor['B1'] == 1){
                $B1Achieved++;
            }

            if($StudScor['C1'] == 1){
                $C1Achieved++;
            }

            if($StudScor['D1'] == 1){
                $D1Achieved++;
            }
        }

        // }
        //die;


        $data['A1Achieved'] = $A1Achieved;
        $data['B1Achieved'] = $B1Achieved;
        $data['C1Achieved'] = $C1Achieved;
        $data['D1Achieved'] = $D1Achieved;

        $OnlineStudentScoring=$data['OnlineStudentScoringProgressBarData'];

        $OnlineA1Achieved=0;
        $OnlineB1Achieved=0;
        $OnlineC1Achieved=0;
        $OnlineD1Achieved=0;

        foreach ($OnlineStudentScoring as $StudScor)
		{
            if($StudScor['A1'] == 1)
			{
                $OnlineA1Achieved++;
            }

            if($StudScor['B1'] == 1)
			{
                $OnlineB1Achieved++;
            }

            if($StudScor['C1'] == 1)
			{
                $OnlineC1Achieved++;
            }

            if($StudScor['D1'] == 1)
			{
                $OnlineD1Achieved++;
            }
        }

        // }
        //die;


        $data['OnlineA1Achieved'] = $OnlineA1Achieved;
        $data['OnlineB1Achieved'] = $OnlineB1Achieved;
        $data['OnlineC1Achieved'] = $OnlineC1Achieved;
        $data['OnlineD1Achieved'] = $OnlineD1Achieved;


        $tableData=$this->trainingmodel->TrainingManagerListData($FilterData);
        $TotalTraingHours=0;
        foreach ($tableData as $tmpData)
        {
            $time1 = strtotime($tmpData['InTime']);
            $time2 = strtotime($tmpData['OutTime']);
            $TotalTraingHours+=round(abs($time2 - $time1) / 3600,2);
        }
        $data['TrainingHourData']=$TotalTraingHours;

        $tableData=$this->trainingmodel->TrainingManagerListData($FilterData);
        $TotalVolunteeringHours=0;
        $TotalVol='';
        foreach ($tableData as $tmpData)
        {
            if($tmpData['Volunteers'])
            {
                //print_r(count(json_decode($tmpData['Volunteers'])));
                $TotalVol = count(json_decode($tmpData['Volunteers']));

                $array1 = explode(':',date('H:i:s',strtotime($tmpData['InTime'])));
                $array2 = explode(':',date('H:i:s',strtotime($tmpData['OutTime'])));

                $minutes1 = ($array1[0] * 60.0 + $array1[1]);
                $minutes2 = ($array2[0] * 60.0 + $array2[1]);
                $diff =abs(number_format(($minutes2 - $minutes1)/60, 2, '.', ''));

                $TotalVolunteeringHours += $diff ;
                $time1 = strtotime($tmpData['InTime']);
                $time2 = strtotime($tmpData['OutTime']);
                //$TotalVolunteeringHours+=round(abs($time2 - $time1) / 3600,2)*$TotalVol;
            }
        }
        //print_r($TotalVolunteeringHours);
        $data['TotalVolunteeringHours']=$TotalVolunteeringHours;


        $tableData=$this->trainingmodel->TouchpointData($FilterData);



        $data['TouchpointData']=$tableData;

        $TrainingDataReport=array();


        if($_GET['Type']) {
            if($_GET['Type'] == 'Training'){
                foreach($data['TrainingData'] as $Trdata)
                {
                    $Status='Completed';
                    $ColorCode='#00D948';
                    if($Trdata['TrainingStatus']=='Scheduled')
                    {
                        $Status='Scheduled';
                        $ColorCode='#FFA400';
                    }

                    if($Trdata['TrainingStatus']=='Cancelled')
                    {
                        $Status='Cancelled';
                        $ColorCode='red';
                    }

                    if($Trdata['TrainingStatus']=='Postponed')
                    {
                        $Status='Postponed';
                        $ColorCode='#009AF8';
                    }

                    if($Trdata['TrainingStatus']=='TBC')
                    {
                        $Status='TBC';
                        $ColorCode='green';
                    }

                    $tmpData=array();
                    $tmpData['title']='Training '.$Trdata['TrainingStatus'].'-'.$Trdata['LocationName'].' - '.date('h:i',strtotime(trim($Trdata['InTime']))).' to '.date('h:i',strtotime(trim($Trdata['OutTime'])));//.' by '.$data['Name'];
                    $tmpData['start']=$Trdata['TrainingDate'].'T'.date('H:i',strtotime(trim($Trdata['InTime'])));
                    $tmpData['color']=$ColorCode;
                    $tmpData['CancelReason']=$Trdata['CancelReason'];
                    $TrainingDataReport[]=$tmpData;
                }
            }

            if($_GET['Type'] == 'Meeting'){
                foreach($data['MeetingData'] as $Trdata)
                {
                    $Status='Completed';
                    $ColorCode='#00D948';
                    if($Trdata['MeetingStatus']=='Scheduled')
                    {
                        $Status='Scheduled';
                        $ColorCode='#FFA400';
                    }

                    if($Trdata['MeetingStatus']=='Cancelled')
                    {
                        $Status='Cancelled';
                        $ColorCode='red';
                    }

                    if($Trdata['MeetingStatus']=='Postponed')
                    {
                        $Status='Postponed';
                        $ColorCode='#009AF8';
                    }

                    if($Trdata['MeetingStatus']=='TBC')
                    {
                        $Status='TBC';
                        $ColorCode='green';
                    }

                    $tmpData=array();
                    $tmpData['title']='Meeting '.$Trdata['MeetingStatus'].'-'.$Trdata['LocationName'].' - '.date('h:i',strtotime(trim($Trdata['InTime']))).' to '.date('h:i',strtotime(trim($Trdata['OutTime'])));//.' by '.$data['Name'];
                    $tmpData['start']=$Trdata['MeetingDate'].'T'.date('H:i',strtotime(trim($Trdata['InTime'])));
                    $tmpData['color']=$ColorCode;
                    $tmpData['CancelReason']=$Trdata['CancelReason'];
                    $TrainingDataReport[]=$tmpData;
                }
            }

        }

        if($_GET['Type'] == '') {
            foreach ($data['TrainingData'] as $Trdata) {
                $Status = 'Completed';
                $ColorCode = '#00D948';
                if ($Trdata['TrainingStatus'] == 'Scheduled') {
                    $Status = 'Scheduled';
                    $ColorCode = '#FFA400';
                }

                if ($Trdata['TrainingStatus'] == 'Cancelled') {
                    $Status = 'Cancelled';
                    $ColorCode = 'red';
                }

                if ($Trdata['TrainingStatus'] == 'Postponed') {
                    $Status = 'Postponed';
                    $ColorCode = '#009AF8';
                }

                if ($Trdata['TrainingStatus'] == 'TBC') {
                    $Status = 'TBC';
                    $ColorCode = 'green';
                }

                $tmpData = array();
                $tmpData['title'] = 'Training ' . $Trdata['TrainingStatus'] . '-' . $Trdata['LocationName'] . ' - ' . date('h:i', strtotime(trim($Trdata['InTime']))) . ' to ' . date('h:i', strtotime(trim($Trdata['OutTime'])));//.' by '.$data['Name'];
                $tmpData['start'] = $Trdata['TrainingDate'] . 'T' . date('H:i', strtotime(trim($Trdata['InTime'])));
                $tmpData['color'] = $ColorCode;
                $tmpData['CancelReason'] = $Trdata['CancelReason'];
                $TrainingDataReport[] = $tmpData;
            }

            foreach ($data['MeetingData'] as $Trdata) {
                $Status = 'Completed';
                $ColorCode = '#00D948';
                if ($Trdata['MeetingStatus'] == 'Scheduled') {
                    $Status = 'Scheduled';
                    $ColorCode = '#FFA400';
                }

                if ($Trdata['MeetingStatus'] == 'Cancelled') {
                    $Status = 'Cancelled';
                    $ColorCode = 'red';
                }

                if ($Trdata['MeetingStatus'] == 'Postponed') {
                    $Status = 'Postponed';
                    $ColorCode = '#009AF8';
                }

                if ($Trdata['MeetingStatus'] == 'TBC') {
                    $Status = 'TBC';
                    $ColorCode = 'green';
                }

                $tmpData = array();
                $tmpData['title'] = 'Meeting ' . $Trdata['MeetingStatus'] . '-' . $Trdata['LocationName'] . ' - ' . date('h:i', strtotime(trim($Trdata['InTime']))) . ' to ' . date('h:i', strtotime(trim($Trdata['OutTime'])));//.' by '.$data['Name'];
                $tmpData['start'] = $Trdata['MeetingDate'] . 'T' . date('H:i', strtotime(trim($Trdata['InTime'])));
                $tmpData['color'] = $ColorCode;
                $tmpData['CancelReason'] = $Trdata['CancelReason'];
                $TrainingDataReport[] = $tmpData;
            }

        }

        $data['TrainingDataReport'] = $TrainingDataReport;

        $this->load->innerTemplate('dashboard/index',$data);
    }



    public function index3()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;
		
		$data['UserGroupId']=$SessionData['UserGroupId'];
		$data['DistrictAllData']=$this->districtmodel->DistrictListData($UserId);
        $FilterData=array();
		if($_GET['DistrictId'])
		{
			$FilterData['DistrictId']=$_GET['DistrictId'];
			$data['FilterDistrictId']=$_GET['DistrictId'];
		}
		
		if($_GET['TrainerId'])
		{
			$FilterData['FilterTrainerId']=$_GET['TrainerId'];
			$data['FilterTrainerId']=$_GET['TrainerId'];
		}
		
		$data['DistrictData']=$this->districtmodel->DistrictManagerListData($FilterData);
		$data['VillageData']=$this->villagemodel->VillageManagerListboardData($FilterData);
		$data['SchoolData']=$this->schoolmodel->SchoolManagerListDashboardData($FilterData);
		$data['StudentData']=$this->studentmodel->StudentManagerListData($FilterData);
		$data['TrainingData']=$this->trainingmodel->TrainingManagerListData($FilterData);
        $data['GalleryData']=$this->gallerymodel->GallerySingleData($FilterData);
		$data['IVRStudentData']=$this->trainingmodel->IVRStudentData($FilterData);
        $data['EventData']=$this->eventmodel->EventListData($FilterData);
        $data['TestimonialData']=$this->testimonialmodel->TestimonialSingleData($FilterData);
        $data['TrainerData']=$this->usermodel->GetTrainerData($FilterData);
        $data['AssessmentData']=$this->assessmentmodel->AssessmentDashboardData($FilterData);
        $data['StudentScoringData']=$this->assessmentmodel->StudentScoringDashboardData($FilterData);

        $StudentIVRData=$this->trainingmodel->GetIVRDataDashboard($FilterData);
        $data['StudentIVRData']=$StudentIVRData;

        if($_GET['debug'] == 1) {
//            echo '<pre>';
//            print_r($data['StudentScoringData']);
//            echo '</pre>';
	   }
            $StudentScoring=$data['StudentScoringData'];

            $A1Achieved=0;
            $B1Achieved=0;
            $C1Achieved=0;
            $D1Achieved=0;

            foreach ($StudentScoring as $StudScor){
                if($StudScor['A1'] == 1){
                    $A1Achieved++;
                }

                if($StudScor['B1'] == 1){
                    $B1Achieved++;
                }

                if($StudScor['C1'] == 1){
                    $C1Achieved++;
                }

                if($StudScor['D1'] == 1){
                    $D1Achieved++;
                }
            }
            
       // }
		//die;


        $data['A1Achieved'] = $A1Achieved;
        $data['B1Achieved'] = $B1Achieved;
        $data['C1Achieved'] = $C1Achieved;
        $data['D1Achieved'] = $D1Achieved;


		$tableData=$this->trainingmodel->TrainingManagerListData($FilterData);
		$TotalTraingHours=0;
		foreach ($tableData as $tmpData) 
		{
			$time1 = strtotime($tmpData['InTime']);
			$time2 = strtotime($tmpData['OutTime']);
			$TotalTraingHours+=round(abs($time2 - $time1) / 3600,2);
		}       
		$data['TrainingHourData']=$TotalTraingHours;
		
		$tableData=$this->trainingmodel->TrainingManagerListData($FilterData);
		$TotalVolunteeringHours=0;
		$TotalVol='';
		foreach ($tableData as $tmpData) 
		{
			if($tmpData['Volunteers'])
			{
			    //print_r(count(json_decode($tmpData['Volunteers'])));
                $TotalVol = count(json_decode($tmpData['Volunteers']));

                $array1 = explode(':',date('H:i:s',strtotime($tmpData['InTime'])));
                $array2 = explode(':',date('H:i:s',strtotime($tmpData['OutTime'])));

                $minutes1 = ($array1[0] * 60.0 + $array1[1]);
                $minutes2 = ($array2[0] * 60.0 + $array2[1]);
                $diff =abs(number_format(($minutes2 - $minutes1)/60, 2, '.', ''));

                $TotalVolunteeringHours += $diff ;
				$time1 = strtotime($tmpData['InTime']);
				$time2 = strtotime($tmpData['OutTime']);
				//$TotalVolunteeringHours+=round(abs($time2 - $time1) / 3600,2)*$TotalVol;
			}
		}
		//print_r($TotalVolunteeringHours);
		$data['TotalVolunteeringHours']=$TotalVolunteeringHours;
		
		
		$tableData=$this->trainingmodel->TouchpointData($FilterData);
		//echo "<pre>";
		//print_r($tableData);
		//echo "</pre>";
		
		$data['TouchpointData']=$tableData;
		
        $TrainingDataReport=array();
        foreach($data['TrainingData'] as $Trdata)
        {
            $Status='Completed';
            $ColorCode='#00D948';
            if($Trdata['TrainingStatus']=='Scheduled')
            {
                $Status='Scheduled';
                $ColorCode='#FFA400';
            }

            if($Trdata['TrainingStatus']=='Cancelled')
            {
                $Status='Cancelled';
                $ColorCode='red';
            }

            if($Trdata['TrainingStatus']=='Postponed')
            {
                $Status='Postponed';
                $ColorCode='#009AF8';
            }

            if($Trdata['TrainingStatus']=='TBC')
            {
                $Status='TBC';
                $ColorCode='green';
            }

            $tmpData=array();
            $tmpData['title']=$Trdata['TrainingStatus'].'-'.$Trdata['LocationName'].' - '.date('h:i',strtotime(trim($Trdata['InTime']))).' to '.date('h:i',strtotime(trim($Trdata['OutTime'])));//.' by '.$data['Name'];
            $tmpData['start']=$Trdata['TrainingDate'].'T'.date('H:i',strtotime(trim($Trdata['InTime'])));
            $tmpData['color']=$ColorCode;
            $tmpData['CancelReason']=$Trdata['CancelReason'];
            $TrainingDataReport[]=$tmpData;
        }
        $data['TrainingDataReport'] = $TrainingDataReport;

		$this->load->innerTemplate('dashboard/index3',$data);
    }

    public function ChangePassword()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $UserData = $this->usermodel->GetUserData($UserId);

        if(count($_POST))
        {
            $PasswordMatch = $this->usermodel->MatchPassword($UserId,$_POST['OldPassword']);
//            echo "<pre>";
//            print_r($_POST);
//            echo "</pre>";
//            print_r($PasswordMatch);
            if($PasswordMatch){
               // $SaveData=$_POST;
                //$SaveData['UserId']=$UserId;
                $SaveData['Password']=md5($_POST['NewPassword']);

//                echo "<pre>";
//                print_r($SaveData);
//                echo "</pre>";
//                die;
                $this->usermodel->UpdatePassword($UserId,$SaveData);
                $this->session->set_flashdata('msg', 'Password has changes.');
                redirect(base_url().'dashboard/index', 'refresh');
            }
            else{
                $this->session->set_flashdata('msg', ' Old password is incorrect.');
                redirect(base_url().'dashboard/ChangePassword', 'refresh');
            }


            die;


        }


        $data['UserData'] = $UserData;
//        echo '<pre>';
//        print_r($UserData);
//        echo '</pre>';
//        die;


        $this->load->innerTemplate('dashboard/ChangePassword',$data);

    }
    public function ProjectView()
    {

        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;

        $data['UserGroupId']=$SessionData['UserGroupId'];
        $data['DistrictAllData']=$this->districtmodel->DistrictListData($UserId);
        $FilterData=array();

        $limit = 5;
		if($limit)
		{
			$FilterData['Limit']=$limit;
		}
		$FilterData['OrderById']=1;
        $data['DistrictData']=$this->districtmodel->DistrictManagerListData($FilterData);
		$data['BlockData']=$this->blockmodel->BlockManagerListboardData($FilterData);
        $data['VillageData']=$this->villagemodel->VillageManagerListboardData($FilterData);
        $data['SchoolData']=$this->schoolmodel->SchoolManagerListDashboardData($FilterData);
        $data['StudentData']=$this->studentmodel->StudentManagerListData($FilterData);



        $mappeddata = $this->districtmodel->MappingListData();

        $UserMappedData = array();
        $tmpArray = array();
        foreach ($mappeddata as $key=>$mapData){
            $tmpArray['Id'] = $mapData['Id'];
            $tmpArray['Sr'] = $key+1;
            $tmpArray['Name'] = $mapData['FirstName'].' '.$mapData['LastName'];
            $tmpArray['Phone'] = $mapData['Phone'];
            $tmpArray['NoSchool'] = count($mapData['SchoolData']);
            $UserMappedData[] = $tmpArray;

        }
        $data['UserMappedData'] = $UserMappedData;
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
//        die();

        $this->load->innerTemplate('dashboard/ProjectView',$data);
    }
    public function BlockData()
    {
        $FilterData=array();
        $data['BlockData']=$this->blockmodel->BlockManagerListboardData($FilterData);
        $this->load->innerTemplate('dashboard/BlockData',$data);
    }

    public function VillageData()
    {
        $FilterData=array();
        $data['VillageData']=$this->villagemodel->VillageManagerListboardData($FilterData);
        $this->load->innerTemplate('dashboard/VillageData',$data);
    }
    public function SchoolData()
    {
        $FilterData=array();
        $data['SchoolData']=$this->schoolmodel->SchoolManagerListDashboardData($FilterData);
        $this->load->innerTemplate('dashboard/SchoolData',$data);
    }

    public function StudentData()
    {
        $FilterData=array();
        $data['StudentData']=$this->studentmodel->StudentManagerListData($FilterData);
        $this->load->innerTemplate('dashboard/StudentData',$data);
    }

	public function HandlePopup()
	{
		if($_GET['CallTypeDirect'])
		{
			if($_GET['CallTypeDirect']=='TouchPointsInSchools')
			{
				if($_GET['DistrictId'])
				{
					$FilterData['DistrictId']=$_GET['DistrictId'];
				}
				$HowMuchTimes=$_GET['HowMuchTimes'];
				$TouchpointData=$this->trainingmodel->TouchpointData($FilterData);
				$tableData=array();
				foreach($TouchpointData as $tmpData)
				{
					if(	$tmpData['count']==$HowMuchTimes)
					{
						$tableData[]=$tmpData;
					}
				}
				$this->TouchPointsInSchools($tableData);
				//echo "<pre>";
				//print_r($tableData);
				//echo "</pre>";	
			}			
			die;	
		}
		
		$jsObject=json_decode($_POST['jsObject']);
		
		//echo "<pre>";
		//print_r($jsObject);
		//echo "</pre>";
		
		$FilterData=array();
		if($jsObject->DistrictId)
		{
			$FilterData['DistrictId']=$jsObject->DistrictId;
		}
		if($jsObject->DistrictId)
		{
			$FilterData['DistrictId']=$jsObject->DistrictId;
		}
		if($jsObject->TrainerDistrictId)
		{
			$FilterData['TrainerDistrictId']=$jsObject->TrainerDistrictId;
		}
		if($jsObject->FilterTrainerId)
		{
			$FilterData['FilterTrainerId']=$jsObject->FilterTrainerId;
		}
		
		
		$SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
			
		if($jsObject->CallType=='DistrictData')
		{
			$tableData=$this->districtmodel->DistrictManagerListData($FilterData);
			$this->PrintDistrict($tableData);
		}
		if($jsObject->CallType=='VillagesData')
		{
			$tableData=$this->villagemodel->VillageManagerListboardData($FilterData);
			$this->PrintVillage($tableData);
		}		
		if($jsObject->CallType=='SchoolData')
		{
			$tableData=$this->schoolmodel->SchoolManagerListDashboardData($FilterData);
            $SchoolType=$_POST['SchoolType'];
            //print_r($SchoolType);
            if($SchoolType) {

                $tmpArray=array();
                if($SchoolType == 'Model') {
                    foreach ($tableData as $tmpData) {
                        if ($tmpData['ModelSchool'] == 'Yes') {
                            $tmpArray[] = $tmpData;
                        }
                    }
                    $this->PrintSchool($tmpArray,$SchoolType);
                }

                else if ($SchoolType == 'All') {
                    foreach ($tableData as $tmpData) {
                        if ($tmpData['ModelSchool'] == 'Yes') {
                            $tmpArray[] = $tmpData;
                        }
                    }
                    $this->PrintSchool($tableData,$SchoolType);
                }
                else{
                    foreach ($tableData as $tmpData) {
                        if ($tmpData['ModelSchool'] != 'Yes') {
                            $tmpArray[] = $tmpData;
                        }
                    }
                    $this->PrintSchool($tmpArray,$SchoolType);
                }
            }

            else{
                $this->PrintSchool($tableData);
            }
		}
		if($jsObject->CallType=='StudentData')
		{
			if($SessionData['UserGroupId']==5)
			{
				$tableData=$this->globalmodel->UserStudentList($UserId);
				$this->PrintStudent($tableData);
			}
			else
			{
				$tableData=$this->studentmodel->DistrictStudentData($UserId);
				$this->PrintDistrictStudent($tableData);
			}
		}
		
		if($jsObject->CallType=='DistrictStudentData')
		{
			$tableData=$this->studentmodel->DistrctStudentListData(array('DistrctId'=>$jsObject->DistrctId));
			//echo count($tableData);
			$this->PrintStudent($tableData);
		}

        if($jsObject->CallType=='DistrictSchoolData')
        {
            $tableData=$this->studentmodel->DistrctSchoolListData(array('DistrctId'=>$jsObject->DistrctId));
            //echo count($tableData);
            $this->PrintSchoolCount($tableData);
        }
		
		if($jsObject->CallType=='DistrictProfile')
		{
			echo '<iframe class="goodleMap" src="'.base_url().'dashboard/ShowMapData/'.$jsObject->DistrictId.'" frameborder="0"></iframe>';
		}

        if($jsObject->CallType=='PicutreGallery')
        {
            $data['GalleryData']=$this->gallerymodel->GalleryListDashboardData($UserId);

            $this->load->view('dashboard/PopupGallery',$data);
//            $tableData=$this->studentmodel->StudentListData($UserId);
//            $this->PrintStudent($tableData);
        }

        if($jsObject->CallType=='PicutreTestimonial')
        {
            $data['TestimonialData']=$this->testimonialmodel->TestimonialManagerListData($UserId);
            //$data['GalleryData']=$this->gallerymodel->GalleryListDashboardData($UserId);

            $this->load->view('dashboard/PopupTestimonial',$data);
//            $tableData=$this->studentmodel->StudentListData($UserId);
//            $this->PrintStudent($tableData);
        }

        if($jsObject->CallType=='TrainingHourData')
        {

            $tableData=$this->trainingmodel->TrainingManagerListData($FilterData);
            $this->PrintTrainingHour($tableData);
        }
		
		if($jsObject->CallType=='VolunteeringHourData')
        {
			$tableData=$this->trainingmodel->TrainingManagerListData($FilterData);
			//echo "<pre>";
			//print_r($tableData);
			//echo "</pre>";
			
			$this->PrintVolunteeringHour($tableData);
        }
		

        if($jsObject->CallType=='TouchPointData')
        {

            $tableData=$this->trainingmodel->TouchpointData($FilterData);
            $this->PrintTouchpoint($tableData);
        }
		
		if($jsObject->CallType=='TrainerProgressPop')
        {
           
            //$tableData=$this->trainingmodel->TrainerProgressPopData($FilterData);
			
			//$tableData=$this->trainingmodel->TrainerProgressJsonData();
			$tableData=$this->trainingmodel->TrainnerProgressTableData();
			//$ReturnData=json_decode($tableData['0']['JsonData'],true);
			
			//echo "<pre>";
			//print_r($tableData);
			//echo "</pre>";
			
			$this->PrintTrainerProgressPop($tableData);
        }
		
		if($jsObject->CallType=='TrainingProgressPop')
        {
			//$tableData=$this->trainingmodel->TrainingProgressPopData($FilterData);
			$tableData=$this->trainingmodel->TrainingProgressTableData($FilterData);
			$this->PrintTrainingProgressPop($tableData);
        }

        if($jsObject->CallType=='EventsPop')
        {
            $tableData=$this->eventmodel->EventManagerListDashboardData($FilterData);
//            echo '<pre>';
//            print_r($tableData);
//            echo '</pre>';
            //die();
            $this->PrintEventPop($tableData);
        }

        if($jsObject->CallType=='TestimonialData')
        {
            $tableData=$this->testimonialmodel->TestimonialPopUp($jsObject->TestimonialId);
//            echo '<pre>';
//            print_r($tableData);
//            echo '</pre>';
            //die();
            $this->PrinttestimonialPop($tableData);
        }
		
	}
	
	
	public function ShowMapData($DistrictId)
	{
		$GoogleMapData=$this->districtmodel->GoogleMapData($DistrictId);
		$data['GoogleMapData']=$GoogleMapData;
		
		$DistrictInfoData=$this->districtmodel->DistrictOtherInfoCount($DistrictId);
		$data['DistrictInfo']=$DistrictInfoData;
		
		// Block, School, Modern School, student
		
		$this->load->view('dashboard/GoogleMap',$data);
	}
	
	public function PrintDistrict($tableData)
	{
		?>
        <table id="MaricoTableData" class="table table-bordered">
        <thead>
            <tr>
                <th class="">Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tableData as $tmpData) { ?>
            <?php $DistrictParameter=array('DistrictId'=>$tmpData['Id'],'CallType'=>'DistrictProfile','PageTitle'=>str_replace(' ','&nbsp;',$tmpData['Name'])); ?>
            <tr>
                <td><a class="linkClick" href="javaScript:void(0)" onClick=OpenMaricoDashboard('<?php echo json_encode($DistrictParameter);?>')><?php echo ucfirst($tmpData['Name']);?></a></td>
            </tr>
            <?php } ?>
         </tbody>
         </table>
         <script>
			$(document).ready(function() {
				$('#MaricoTableData').DataTable();
                var x = document.getElementById("MaricoTableData_length");
                x.style.display = "none";

                var y = document.getElementById("MaricoTableData_info");
                y.style.display = "none";

			});
            $('#MaricoTableData').dataTable({
                "pageLength": 100,
                "searching": false,
                "paging": false
            });
		 </script>
    <?php
	}
	
	public function PrintVillage($tableData)
	{
		?>
        <table id="MaricoTableData" class="table table-bordered">
        <thead>
            <tr>
                <th>Village Name</th>
                <th class="">Gram Panchayat</th>
                <th class="">Block</th>
                <th class="">District</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tableData as $tmpData) {
                if($tmpData['Name'] != ''){
                ?>
            <tr>
                <td><?php echo ucfirst($tmpData['Name']);?></td>
                <td><?php echo ucfirst($tmpData['GramPanchayat']);?></td>
                <td><?php echo ucfirst($tmpData['BlockName']);?></td>
                <td><?php echo ucfirst($tmpData['DistrictName']);?></td>
            </tr>
            <?php }}?>
         </tbody>
         </table>
         <script>
			$(document).ready(function() {
				$('#MaricoTableData').DataTable();
                var x = document.getElementById("MaricoTableData_length");
                x.style.display = "none";

			});
            $('#MaricoTableData').dataTable( {
                "pageLength": 100,
                "searching": false,
                "columnDefs": [
                    { "orderable": false, "targets": 0 }
                ]
            } );
		 </script>
    <?php
	}
	
	
	public function TouchPointsInSchools($tableData)
	{
		?>
        <table id="MaricoTableData" class="table table-bordered">
        <thead>
            <tr>
                <th>Training Date</th>
                <th>Trainer Name</th>
                <th>School Name</th>
                <th class="">Village</th>
                <th class="">Gram Panchayat</th>
                <th class="">Block</th>
                <th class="">District</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tableData as $tmpData) { ?>
            <tr>
                <td><?php echo ucfirst($tmpData['TrainingDate']);?></td>
                <td><?php echo ucfirst($tmpData['TrainerName']);?></td>
                <td><?php echo ucfirst($tmpData['LocationName']);?></td>
                <td><?php echo ucfirst($tmpData['VillageName']);?></td>                
                <td><?php echo ucfirst($tmpData['GramPanchayat']);?></td>
                <td><?php echo ucfirst($tmpData['BlockName']);?></td>
                <td><?php echo ucfirst($tmpData['DistrictName']);?></td>
            </tr>
            <?php } ?>
         </tbody>
         </table>
        <?php		
	}
	
	public function PrintSchool($tableData,$SchoolType)
	{

		?>
        <div class="row">
        <div class="col-sm-2" style="width: 200px">
            <div class="form-group">
    <!--            <label for="exampleInputEmail1">Village</label>-->
                <select class="form-control" id="SchoolType" name="SchoolType" onchange="getval(this)">
                    <option value="All" <?php if($SchoolType == 'All') { echo 'selected'; } ?>>All</option>
                    <option value="Model" <?php if($SchoolType == 'Model') { echo 'selected'; } ?>>Model</option>
                    <option value="NonModel" <?php if($SchoolType == 'NonModel') { echo 'selected'; } ?>>Non Model</option>

                </select>
            </div>
        </div>
            <div class="col-sm-8" style="width: 200px"></div>
        <div class="col-sm-2" style="float: right">
            <img src="<?php echo base_url(); ?>assets/img/MS2.png" style="height:45px;"/><span>Model School</span>
        </div>
        </div>
        <table id="MaricoTableData" class="table table-bordered">
        <thead>
            <tr>
                <th>School</th>
                <th>SPOC</th>
                <th>Designation</th>
                <th>Contact Number</th>
                <th class="">Village</th>
                <th class="">Gram Panchayat</th>
                <th class="">Block</th>
                <th class="">District</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tableData as $tmpData) {
                if($tmpData['Name'] != ''){
                ?>
            <tr <?php if($tmpData['ModelSchool']=='Yes') { ?> style="background-color:#FFD900;" <?php } ?>>
                <td><?php echo ucfirst($tmpData['Name']);?></td>
                <td><?php echo ucfirst($tmpData['SpocName']);?></td>
                <td><?php echo ucfirst($tmpData['SpocDesignation']);?></td>
                <td><?php echo ucfirst($tmpData['PrincipalContactNo']);?></td>
                <td><?php echo ucfirst($tmpData['VillageName']);?></td>                
                <td><?php echo ucfirst($tmpData['GramPanchayat']);?></td>
                <td><?php echo ucfirst($tmpData['BlockName']);?></td>
                <td><?php echo ucfirst($tmpData['DistrictName']);?></td>
            </tr>
            <?php }} ?>
         </tbody>
         </table>
         <script>

			$(document).ready(function() {
				$('#MaricoTableData').DataTable();
                var x = document.getElementById("MaricoTableData_length");
                x.style.display = "none";
			});
            $('#MaricoTableData').dataTable( {
                "pageLength": 100,
                "searching": false,
                "columnDefs": [
                    { "orderable": false, "targets": 0 },
                    { "orderable": false, "targets": 1 },
                    { "orderable": false, "targets": 2 },
                    { "orderable": false, "targets": 3 },
                ]
            } );
		 </script>
    <?php
	}

    public function PrintSchoolCount($tableData,$SchoolType)
    {

        ?>
        <div class="row">
            <div class="col-sm-10" style="width: 200px"></div>
            <div class="col-sm-2" style="float: right">
                <img src="<?php echo base_url(); ?>assets/img/MS2.png" style="height:45px;"/><span>Model School</span>
            </div>
        </div>
        <table id="MaricoTableData" class="table table-bordered">
            <thead>
            <tr>
                <th>School</th>
                <th>SPOC</th>
                <th>Designation</th>
                <th>Contact Number</th>
                <th class="">Village</th>
                <th class="">Gram Panchayat</th>
                <th class="">Block</th>
                <th class="">District</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tableData as $tmpData) {
                if($tmpData['Name'] != ''){
                    ?>
                    <tr <?php if($tmpData['ModelSchool']=='Yes') { ?> style="background-color:#FFD900;" <?php } ?>>
                        <td><?php echo ucfirst($tmpData['Name']);?></td>
                        <td><?php echo ucfirst($tmpData['SpocName']);?></td>
                        <td><?php echo ucfirst($tmpData['SpocDesignation']);?></td>
                        <td><?php echo ucfirst($tmpData['PrincipalContactNo']);?></td>
                        <td><?php echo ucfirst($tmpData['VillageName']);?></td>
                        <td><?php echo ucfirst($tmpData['GramPanchayat']);?></td>
                        <td><?php echo ucfirst($tmpData['BlockName']);?></td>
                        <td><?php echo ucfirst($tmpData['DistrictName']);?></td>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>
        <script>

            $(document).ready(function() {
                $('#MaricoTableData').DataTable();
                var x = document.getElementById("MaricoTableData_length");
                x.style.display = "none";
            });
            $('#MaricoTableData').dataTable( {
                "pageLength": 100,
                "searching": false,
                "columnDefs": [
                    { "orderable": false, "targets": 0 },
                    { "orderable": false, "targets": 1 },
                    { "orderable": false, "targets": 2 },
                    { "orderable": false, "targets": 3 },
                ]
            } );
        </script>
        <?php
    }
	
	public function PrintDistrictStudent($tableData)
	{
		?>
        <table id="MaricoTableData" class="table table-bordered">
        <thead>
            <tr>
                <th>Distrct Name</th>
                <th>School Count</th>
                <th>Student Count</th>
            </tr>
        </thead>
        <tbody>
            <?php
			$TotalSchool=0; 
			$TotalStudent=0; 
			foreach ($tableData as $tmpData) 
			{ 
				$TotalSchool+=$tmpData['SchoolCount'];
				$TotalStudent+=$tmpData['StudentCount'];
				$StudentParameter=array('CallType'=>'DistrictStudentData','PageTitle'=>'Students','DistrctId'=>$tmpData['DistrctId']);
				$SchoolParameter=array('CallType'=>'DistrictSchoolData','PageTitle'=>'Students','DistrctId'=>$tmpData['DistrctId']);
				?>
                <tr>
                    <td><?php echo ucfirst($tmpData['DistrctName']);?></td>
                    <td> <a class="linkClick" onClick=OpenMaricoDashboard('<?php echo json_encode($SchoolParameter);?>')><?php echo ucfirst($tmpData['SchoolCount']);?></a></td>
                    <td><a class="linkClick" onClick=OpenMaricoDashboard('<?php echo json_encode($StudentParameter);?>')><?php echo ucfirst($tmpData['StudentCount']);?></a></td>
                </tr>
            	<?php 
			}
			?>
            <tr>
                <td><b>Total</b></td>
                <td><b><?php echo $TotalSchool;?></b></td>
                <td><b><?php echo $TotalStudent;?></b></td>
            </tr>
            
         </tbody>
         </table>
         <script>
			$(document).ready(function() {
				$('#MaricoTableData').DataTable();
                var x = document.getElementById("MaricoTableData_length");
                x.style.display = "none";
			});
            $('#MaricoTableData').dataTable( {
                "pageLength": 1000,
                "searching": false,
                // "scrollY":  "500px",
                // "scrollX": true,
                // "paging": true,
                // "scrollCollapse": true,
                "columnDefs": [
                    { "orderable": false, "targets": 0 },
                    { "orderable": false, "targets": 1 },
                    { "orderable": false, "targets": 2 },
                    { "orderable": false, "targets": 3 },
                    { "orderable": false, "targets": 4 },
                    { "orderable": false, "targets": 10 },
                    { "orderable": false, "targets": 11 },
                ]
            } );
		 </script>
    	<?php
		
	}
	
	
	public function PrintStudent($tableData)
	{
		?>
        <table id="MaricoTableData" class="table table-bordered">
        <thead>
            <tr>
                <th>UID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Class</th>
                <th class="">School</th>
                <th class="">Village</th>
                <th class="">Gram Panchayat</th>
                <th class="">Block</th>
                <th class="">District</th>
                <th>Number of IVR Modules Completed</th>
                <th>Learning Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tableData as $tmpData) { ?>
            <tr>
                <td><?php echo $tmpData['Id'];?></td>
                <td><?php echo ucfirst($tmpData['Name']);?></td>
                <td><?php echo ucfirst($tmpData['Gender']);?></td>
                <td><?php echo ucfirst($tmpData['Age']);?></td>
                <td><?php echo ucfirst($tmpData['Class']);?></td>
                <td><?php echo ucfirst($tmpData['SchoolName']);?></td>
                <td><?php echo ucfirst($tmpData['VillageName']);?></td>                
                <td><?php echo ucfirst($tmpData['GramPanchayat']);?></td>
                <td><?php echo ucfirst($tmpData['BlockName']);?></td>
                <td><?php echo ucfirst($tmpData['DistrictName']);?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <?php } ?>
         </tbody>
         </table>
         <script>
			$(document).ready(function() {
				$('#MaricoTableData').DataTable();
                var x = document.getElementById("MaricoTableData_length");
                x.style.display = "none";
			});
            $('#MaricoTableData').dataTable( {
                "pageLength": 1000,
                "searching": false,
                // "scrollY":  "500px",
                // "scrollX": true,
                // "paging": true,
                // "scrollCollapse": true,
                "columnDefs": [
                    { "orderable": false, "targets": 0 },
                    { "orderable": false, "targets": 1 },
                    { "orderable": false, "targets": 2 },
                    { "orderable": false, "targets": 3 },
                    { "orderable": false, "targets": 4 },
                    { "orderable": false, "targets": 10 },
                    { "orderable": false, "targets": 11 },
                ]
            } );
		 </script>
    <?php
	}


    public function PrintTrainingHour($tableData)
    {
        
        ?>
        <table id="MaricoTableData" class="table table-bordered">
            <thead>
            <tr>
                <th class="">Training Hours</th>
                <th class="">Training Date</th>
                <th class="">In Time - Out Time</th>
                <th>School Name</th>
                <th>Village Name</th>
                <th>Gram Panchayat</th>
                <th>Block Name</th>
                <th>District Name</th>

            </tr>
            </thead>
            <tbody>
            <?php 
			foreach ($tableData as $tmpData) 
			{ 
				$time1 = strtotime($tmpData['InTime']);
				$time2 = strtotime($tmpData['OutTime']);
				$difference = round(abs($time2 - $time1) / 3600,2);
				
				$array1 = explode(':',date('H:i:s',strtotime($tmpData['InTime'])));
				$array2 = explode(':',date('H:i:s',strtotime($tmpData['OutTime'])));
			
				$minutes1 = ($array1[0] * 60.0 + $array1[1]);
				$minutes2 = ($array2[0] * 60.0 + $array2[1]);
				$diff =abs(number_format(($minutes1 - $minutes2)/60, 2, '.', '')) .' Hour(s)';
				
				?>
				<tr>

					<td><?php echo $diff;?></td>
					<td><?php echo $tmpData['TrainingDate'];?></td>
					<td><?php echo $tmpData['InTime'];?> - <?php echo $tmpData['OutTime'];?></td>
					<td><?php echo ucfirst($tmpData['LocationName']);?></td>
					<td><?php echo ucfirst($tmpData['VillageName']);?></td>
					<td><?php echo ucfirst($tmpData['GramPanchayat']);?></td>
					<td><?php echo ucfirst($tmpData['BlockName']);?></td>
					<td><?php echo ucfirst($tmpData['DistrictName']);?></td>

				</tr>
				<?php 				
			}
			?>
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#MaricoTableData').DataTable();
                var x = document.getElementById("MaricoTableData_length");
                x.style.display = "none";
            });
            $('#MaricoTableData').dataTable( {
                "pageLength": 100,
                "searching": false,
                "columnDefs": [
                    { "orderable": true, "targets": 0 },
                    { "orderable": false, "targets": 1 },
                    { "orderable": false, "targets": 2 },
                    { "orderable": false, "targets": 3 },
                    { "orderable": false, "targets": 4 },

                ]
            } );
        </script>
        <?php
    }
	
	
	public function PrintVolunteeringHour($tableData)
    {
        
        ?>
        <table id="MaricoTableData" class="table table-bordered">
            <thead>
            <tr>
                <th class="">Training Hours</th>
                <th class="">Training Date</th>
                <th class="">In Time - Out Time</th>
                <th>School Name</th>
                <th>Village Name</th>
                <th>Gram Panchayat</th>
                <th>Block Name</th>
                <th>District Name</th>

            </tr>
            </thead>
            <tbody>
            <?php 
			foreach ($tableData as $tmpData) 
			{ 
				if($tmpData['Volunteers'])
				{
                    $TotalVol = count(json_decode($tmpData['Volunteers']));
					$array1 = explode(':',date('H:i:s',strtotime($tmpData['InTime'])));
					$array2 = explode(':',date('H:i:s',strtotime($tmpData['OutTime'])));
				
					$minutes1 = ($array1[0] * 60.0 + $array1[1]);
					$minutes2 = ($array2[0] * 60.0 + $array2[1]);
					$diff =abs(number_format(($minutes2 - $minutes1)/60, 2, '.', '')) .' Hour(s)';
					
					$time1 = strtotime(date('H:i:s',strtotime($tmpData['InTime'])));
					$time2 = strtotime(date('H:i:s',strtotime($tmpData['OutTime'])));
					$difference = round(($time2 - $time1) / 3600,2)*$TotalVol;
					?>
					<tr>
	
						<td><?php echo $diff;?></td>
						<td><?php echo $tmpData['TrainingDate'];?></td>
						<td><?php echo $tmpData['InTime'];?> - <?php echo $tmpData['OutTime'];?></td>
						<td><?php echo ucfirst($tmpData['LocationName']);?></td>
						<td><?php echo ucfirst($tmpData['VillageName']);?></td>
						<td><?php echo ucfirst($tmpData['GramPanchayat']);?></td>
						<td><?php echo ucfirst($tmpData['BlockName']);?></td>
						<td><?php echo ucfirst($tmpData['DistrictName']);?></td>
	
					</tr>
					<?php 
				} 
			}
			?>
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#MaricoTableData').DataTable();
                var x = document.getElementById("MaricoTableData_length");
                x.style.display = "none";
            });
            $('#MaricoTableData').dataTable( {
                "pageLength": 100,
                "searching": false,
                "columnDefs": [
                    { "orderable": true, "targets": 0 },
                    { "orderable": false, "targets": 1 },
                    { "orderable": false, "targets": 2 },
                    { "orderable": false, "targets": 3 },
                    { "orderable": false, "targets": 4 },

                ]
            } );
        </script>
        <?php
    }



    public function PrintTouchpoint($tableData)
    {
//        echo '<pre>';
//        print_r($tableData);
//        echo '</pre>';
        //die();

        ?>
        <table id="MaricoTableData" class="table table-bordered">
            <thead>
            <tr>
                <th class="">No. of touchpoint</th>
                <th class="">School Name</th>
                <th class="">Village Name</th>
                <th class="">Gram Panchayat</th>
                <th class="">Block Name</th>
                <th class="">District Name</th>


            </tr>
            </thead>
            <tbody>
            <?php foreach ($tableData as $tmpData) { ?>
                <tr>

                    <td><?php echo ucfirst($tmpData['count']);?></td>
                    <td><?php echo ucfirst($tmpData['LocationName']);?></td>
                    <td><?php echo ucfirst($tmpData['VillageName']);?></td>
                    <td><?php echo ucfirst($tmpData['GramPanchayat']);?></td>
                    <td><?php echo ucfirst($tmpData['BlockName']);?></td>
                    <td><?php echo ucfirst($tmpData['DistrictName']);?></td>


                </tr>
            <?php } ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#MaricoTableData').DataTable();
                var x = document.getElementById("MaricoTableData_length");
                x.style.display = "none";
            });
            $('#MaricoTableData').dataTable( {
                "pageLength": 100,
                "searching": false,
                
            } );
        </script>
        <?php
    }
	
	public function PrintTrainerProgressPop($tableData)
	{

//	    echo 'deepak';
//	    echo '<pre>';
//	    print_r($tableData);
//	    echo '</pre>';

		?>
        <table id="MaricoTableData" class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2">Trainer</th>
            <th rowspan="2">District</th>
            <th colspan="2">Schools</th>
            <th colspan="2">Students</th>
            <th colspan="2">Average number of touchpoints</th>
            <th colspan="2">IVR modules completed per student</th>
            <th colspan="4">Number of students completed IVR Modules</th>
            <th colspan="2">% Student Accessed IVR</th>
            <th colspan="3">Achieved A1 Level</th>
            <th colspan="3">Achieved Listening & Spoken Interaction Objective</th>
            <th colspan="3">Achieved Listening Objectives And 50% Of Spoken Interaction Objectives</th>
            <th colspan="3">Achieved Listening Objectives</th>

        </tr>
        <tr>
            <th class="tableSubHeader">Total</th>
            <th class="tableSubHeader">Model Schools</th>
            <th class="tableSubHeader">Total</th>
            <th class="tableSubHeader">Model Schools</th>
            <th class="tableSubHeader">Model Schools</th>
            <th class="tableSubHeader">Other Schools</th>
            <th class="tableSubHeader">Model Schools</th>
            <th class="tableSubHeader">Other Schools</th>
            <th class="tableSubHeader"><30</th>
            <th class="tableSubHeader">31-100</th>
            <th class="tableSubHeader">101-150</th>
            <th class="tableSubHeader">151-200</th>
            <th class="tableSubHeader">Model Schools</th>
            <th class="tableSubHeader">Other Schools</th>
            <th class="tableSubHeader">Number</th>
            <th class="tableSubHeader">% of total</th>
            <th class="tableSubHeader">% number from Model Schools </th>
            <th class="tableSubHeader">Number</th>
            <th class="tableSubHeader">% of total</th>
            <th class="tableSubHeader">% number from Model Schools </th>
            <th class="tableSubHeader">Number</th>
            <th class="tableSubHeader">% of total</th>
            <th class="tableSubHeader">% number from Model Schools </th>
            <th class="tableSubHeader">Number</th>
            <th class="tableSubHeader">% of total</th>
            <th class="tableSubHeader">% number from Model Schools </th>
        </tr>
        </thead>
        <tbody>
        
        <?php foreach($tableData as $tmpData) { ?>
        <tr>
            <td><?php echo ucfirst($tmpData['TrainnerName']);?></td>
            <td><?php echo ucfirst($tmpData['District']);?></td>
            <td><?php echo $tmpData['SchoolsTotal'];?></td>
            <td><?php echo $tmpData['SchoolsModel'];?></td>
            <td><?php echo $tmpData['StudentsTotal'];?></td>
            <td><?php echo $tmpData['StudentsModelSchool'];?></td>
            <td><?php echo $tmpData['AverageNumberTouchpointsModel'];?></td>
            <td><?php echo $tmpData['AverageNumberTouchpointsOther'];?></td>
            <td><?php echo $tmpData['IVRModulesCompletedModel'];?></td>
            <td><?php echo $tmpData['IVRModulesCompletedOther'];?></td>
            <td><?php echo $tmpData['NumberStudentsCompletedIVR30'];?></td>
            <td><?php echo $tmpData['NumberStudentsCompletedIVR31'];?></td>
            <td><?php echo $tmpData['NumberStudentsCompletedIVR101'];?></td>
            <td><?php echo $tmpData['NumberStudentsCompletedIVR151'];?></td>
            <td><?php echo $tmpData['PercentStudentAccessedIVRModel'];?></td>
            <td><?php echo $tmpData['PercentStudentAccessedIVROther'];?></td>
            <td><?php echo $tmpData['A1Number'];?></td>
            <td><?php echo $tmpData['A1PercentOfTotal'];?></td>
            <td><?php echo $tmpData['A1PercentNumberModelSchool'];?></td>
            <td><?php echo $tmpData['B1Number'];?></td>
            <td><?php echo $tmpData['B1PercentOfTotal'];?></td>
            <td><?php echo $tmpData['B1PercentNumberModelSchool'];?></td>
            <td><?php echo $tmpData['C1Number'];?></td>
            <td><?php echo $tmpData['C1PercentOfTotal'];?></td>
            <td><?php echo $tmpData['C1PercentNumberModelSchool'];?></td>
            <td><?php echo $tmpData['D1Number'];?></td>
            <td><?php echo $tmpData['D1PercentOfTotal'];?></td>
            <td><?php echo $tmpData['D1PercentNumberModelSchool'];?></td>
        </tr> 
        <?php } ?>
           
        </tbody>
        </table>
        <?php	
			
	}
	
	public function PrintTrainingProgressPop($tableData)
	{
	    //echo '<pre>';
	    //print_r($tableData);
	    //echo '</pre>';
	    //die;
		
		$CSVData=array();
		$tmpData=array('District','Schools Total','Model Schools Total','Students Total', 'Students Model Schools','Average number of touchpoints Model Schools','Average number of touchpoints Other Schools','IVR modules completed per student Model Schools','IVR modules completed per student Other Schools','Number of students completed IVR Modules <30','Number of students completed IVR Modules 31-100','Number of students completed IVR Modules 101-150','Number of students completed IVR Modules 151-200','% Student Accessed IVR Model Schools','% Student Accessed IVR Other Schools','Achieved A1 Level Number','Achieved A1 Level % of total','Achieved A1 Level % number from Model Schools','Achieved Listening & Spoken Interaction Objective Number','Achieved Listening & Spoken Interaction Objective % of total','Achieved Listening & Spoken Interaction Objective % number from Model Schools','Achieved Listening Objectives And 50% Of Spoken Interaction Objectives Number','Achieved Listening Objectives And 50% Of Spoken Interaction Objectives % of total','Achieved Listening Objectives And 50% Of Spoken Interaction Objectives % number from Model Schools','Achieved Listening Objectives Number','Achieved Listening Objectives% of total','Achieved Listening Objectives % number from Model Schools');
		$CSVData[]=$tmpData;
		
		$CSVFileName=time().'_TrainingProgress.csv';
		?>
        <a href="<?php echo base_url();?>download.php?filename=<?php echo 'assets/ReportData/'.$CSVFileName;?>" class="pull-right"> Download CSV</a>
        <table id="MaricoTableData" class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2">District</th>
            <th colspan="2">Schools</th>
            <th colspan="2">Students</th>
            <th colspan="2">Average number of touchpoints</th>
            <th colspan="2">IVR modules completed per student</th>
            <th colspan="4">Number of students completed IVR Modules</th>
            <th colspan="2">% Student Accessed IVR</th>
            <th colspan="3">Achieved A1 Level</th>
            <th colspan="3">Achieved Listening & Spoken Interaction Objective</th>
            <th colspan="3">Achieved Listening Objectives And 50% Of Spoken Interaction Objectives</th>
            <th colspan="3">Achieved Listening Objectives</th>

        </tr>
        <tr>
            <th class="tableSubHeader">Total</th>
            <th class="tableSubHeader">Model Schools</th>
            <th class="tableSubHeader">Total</th>
            <th class="tableSubHeader">Model Schools</th>
            <th class="tableSubHeader">Model Schools</th>
            <th class="tableSubHeader">Other Schools</th>
            <th class="tableSubHeader">Model Schools</th>
            <th class="tableSubHeader">Other Schools</th>
            <th class="tableSubHeader"><30</th>
            <th class="tableSubHeader">31-100</th>
            <th class="tableSubHeader">101-150</th>
            <th class="tableSubHeader">151-200</th>
            <th class="tableSubHeader">Model Schools</th>
            <th class="tableSubHeader">Other Schools</th>
            <th class="tableSubHeader">Number</th>
            <th class="tableSubHeader">% of total</th>
            <th class="tableSubHeader">% number from Model Schools </th>
            <th class="tableSubHeader">Number</th>
            <th class="tableSubHeader">% of total</th>
            <th class="tableSubHeader">% number from Model Schools </th>
            <th class="tableSubHeader">Number</th>
            <th class="tableSubHeader">% of total</th>
            <th class="tableSubHeader">% number from Model Schools </th>
            <th class="tableSubHeader">Number</th>
            <th class="tableSubHeader">% of total</th>
            <th class="tableSubHeader">% number from Model Schools </th>
        </tr>
        </thead>
        <tbody>
        
        <?php
        $SchoolsTotal=0;$SchoolsModel=0;$StudentsTotal=0;$StudentsModelSchool=0;$AverageNumberTouchpointsModel=0;$AverageNumberTouchpointsOther=0;
        $IVRModulesCompletedModel=0;$IVRModulesCompletedOther=0;$NumberStudentsCompletedIVR30=0;$NumberStudentsCompletedIVR31=0;$NumberStudentsCompletedIVR101=0;
        $NumberStudentsCompletedIVR151=0;$PercentStudentAccessedIVRModel=0;$PercentStudentAccessedIVROther=0;
        $A1Number=0;$A1PercentOfTotal=0;$A1PercentNumberModelSchool=0;
        $B1Number=0;$B1PercentOfTotal=0;$B1PercentNumberModelSchool=0;
        $C1Number=0;$C1PercentOfTotal=0;$C1PercentNumberModelSchool=0;
        $D1Number=0;$D1PercentOfTotal=0;$D1PercentNumberModelSchool=0;
        foreach($tableData as $tmpData) 
		{
            $SchoolsTotal += $tmpData['SchoolsTotal'];
            $SchoolsModel += $tmpData['SchoolsModel'];
            $StudentsTotal += $tmpData['StudentsTotal'];
            $StudentsModelSchool += $tmpData['StudentsModelSchool'];
            $AverageNumberTouchpointsModel += $tmpData['AverageNumberTouchpointsModel'];
            $AverageNumberTouchpointsOther += $tmpData['AverageNumberTouchpointsOther'];
            $IVRModulesCompletedModel += $tmpData['IVRModulesCompletedModel'];
            $IVRModulesCompletedOther += $tmpData['IVRModulesCompletedOther'];
            $NumberStudentsCompletedIVR30 += $tmpData['NumberStudentsCompletedIVR30'];
            $NumberStudentsCompletedIVR31 += $tmpData['NumberStudentsCompletedIVR31'];
            $NumberStudentsCompletedIVR101 += $tmpData['NumberStudentsCompletedIVR101'];
            $NumberStudentsCompletedIVR151 += $tmpData['NumberStudentsCompletedIVR151'];
            $PercentStudentAccessedIVRModel += $tmpData['PercentStudentAccessedIVRModel'];
            $PercentStudentAccessedIVROther += $tmpData['PercentStudentAccessedIVROther'];
            $A1Number += $tmpData['A1Number'];
            $A1PercentOfTotal += $tmpData['A1PercentOfTotal'];
            $A1PercentNumberModelSchool += $tmpData['A1PercentNumberModelSchool'];
            $B1Number += $tmpData['B1Number'];
            $B1PercentOfTotal += $tmpData['B1PercentOfTotal'];
            $B1PercentNumberModelSchool += $tmpData['B1PercentNumberModelSchool'];
            $C1Number += $tmpData['C1Number'];
            $C1PercentOfTotal += $tmpData['C1PercentOfTotal'];
            $C1PercentNumberModelSchool += $tmpData['C1PercentNumberModelSchool'];
            $D1Number += $tmpData['D1Number'];
            $D1PercentOfTotal += $tmpData['D1PercentOfTotal'];
            $D1PercentNumberModelSchool += $tmpData['D1PercentNumberModelSchool'];
            
			$tmpArray=array();
			?>
        <tr>
            <td><?php echo $tmpArray[]=ucfirst($tmpData['District']);?></td>
            <td><?php echo $tmpArray[]=$tmpData['SchoolsTotal'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['SchoolsModel'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['StudentsTotal'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['StudentsModelSchool'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['AverageNumberTouchpointsModel'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['AverageNumberTouchpointsOther'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['IVRModulesCompletedModel'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['IVRModulesCompletedOther'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['NumberStudentsCompletedIVR30'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['NumberStudentsCompletedIVR31'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['NumberStudentsCompletedIVR101'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['NumberStudentsCompletedIVR151'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['PercentStudentAccessedIVRModel'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['PercentStudentAccessedIVROther'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['A1Number'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['A1PercentOfTotal'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['A1PercentNumberModelSchool'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['B1Number'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['B1PercentOfTotal'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['B1PercentNumberModelSchool'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['C1Number'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['C1PercentOfTotal'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['C1PercentNumberModelSchool'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['D1Number'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['D1PercentOfTotal'];?></td>
            <td><?php echo $tmpArray[]=$tmpData['D1PercentNumberModelSchool'];?></td>
        </tr>
        <?php $CSVData[]=$tmpArray; ?> 
        <?php } ?>
        
           
        </tbody>
        </table>
        <?php
		
		$fp = fopen('assets/ReportData/'.$CSVFileName, 'w');
		foreach ($CSVData as $fields) 
		{
			fputcsv($fp, $fields);
		}
		
		fclose($fp);	
			
	}


    public function PrintEventPop($tableData)
    {

        ?>

        <table id="MaricoTableData" class="table table-bordered">
            <thead>
            <tr>
                <th>Ocassion</th>
                <th>Theme</th>
                <th>EventType</th>
                <th>LocationEvent</th>
                <th class="">Village</th>
                <th class="">Gram Panchayat</th>
                <th class="">Block</th>
                <th class="">District</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tableData as $tmpData) {
//                echo '<pre>';
//                print_r($tableData);
//                echo '</pre>';
                //die();
                if($tmpData['Ocassion'] != ''){
                    ?>
                    <tr <?php if($tmpData['ModelSchool']=='Yes') { ?> style="background-color:#FFD900;" <?php } ?>>
                        <td><?php echo ucfirst($tmpData['Ocassion']);?></td>
                        <td><?php echo ucfirst($tmpData['Theme']);?></td>
                        <td><?php echo ucfirst($tmpData['EventType']);?></td>
                        <td><?php echo ucfirst($tmpData['LocationEvent']);?></td>
                        <td><?php echo ucfirst($tmpData['VillageName']);?></td>
                        <td><?php echo ucfirst($tmpData['GramPanchayat']);?></td>
                        <td><?php echo ucfirst($tmpData['BlockName']);?></td>
                        <td><?php echo ucfirst($tmpData['DistrictName']);?></td>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function() {
                $('#MaricoTableData').DataTable();
                var x = document.getElementById("MaricoTableData_length");
                x.style.display = "none";
            });
            $('#MaricoTableData').dataTable( {
                "pageLength": 100,
                "searching": false,
                "columnDefs": [
                    { "orderable": false, "targets": 0 },
                    { "orderable": false, "targets": 1 },
                    { "orderable": false, "targets": 2 },
                    { "orderable": false, "targets": 3 },
                ]
            } );
        </script>
        <?php
    }


    public function PrintTestimonialPop($tableData)
    {

        if($tableData[0]['Type'] == 'Audio'){
        ?>
            <audio id="aud" controls>
                <source src="<?php echo  base_url().$tableData[0]['FileUpload'] ?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            <?php } if($tableData[0]['Type'] == 'Video') {?>

        <video id="vid" width="720" height="500" controls autoplay>
            <source src="<?php echo  base_url().$tableData[0]['FileUpload'] ?>" type="video/mp4">
        </video>
        <?php } if($tableData[0]['Type'] == 'Image'){?>
        <img src="<?php echo  base_url().$tableData[0]['FileUpload'] ?>" width="200px;"/>
        <?php } ?>
        <?php
    }
	
	
	public function DownloadCSVReport()
	{
		$TrainerData=$this->usermodel->GetTrainerData();
		foreach($TrainerData as $key=>$data)
		{
			$CSVData=array();
		
			$tmpArray=array();
			$CSVData[]=$tmpArray;
			
			$tmpArray=array();
			$CSVData[]=$tmpArray;
			
			$FilterData=array();
			if($data['Id'])
			{
				$FilterData['FilterTrainerId']=$data['Id'];
				$data['FilterTrainerId']=$data['Id'];
			}
			
			$DistrictData=$this->districtmodel->DistrictManagerListData($FilterData);
			//$TrainerData[$key]['DistrictData']=$DistrictData;
			
			$tmpArray=array('','Trainer',$data['FirstName'].' '.$data['LastName']);
			$CSVData[]=$tmpArray;
			
			$tmpArray=array('','Date of Joining','');
			$CSVData[]=$tmpArray;
			
			$tmpDisName=array();
			foreach($DistrictData as $tmpDis)
			{
				$tmpDisName[]=$tmpDis['Name'];		
			}
			$tmpArray=array('','District',implode(', ',$tmpDisName));
			$CSVData[]=$tmpArray;
			
			
			$SchoolData=$this->schoolmodel->SchoolManagerListDashboardData($FilterData);
			$tmpArray=array('','Total no. of schools',count($SchoolData));
			$CSVData[]=$tmpArray;
			
			$tmpStudentCount=0;
			$tmpSchoolmodelCount=0;
			$tmpSchoolmodelStudentCount=0;
			foreach($SchoolData as $SKey=>$Sdata)
			{
				$SchoolData[$SKey]['StudenData']=$this->schoolmodel->GetStudenDataBySchoolId($Sdata['Id']);	
				$SchoolTraingData=$this->schoolmodel->GetTrainingsDataBySchoolId($data['Id'],$Sdata['Id']);
				
					
				$SchoolData[$SKey]['Trainings']=count($SchoolTraingData);
				$SchoolData[$SKey]['TrainingData']=$SchoolTraingData;

				$SchoolTraingData=$this->schoolmodel->GetTrainingsCompletedDataBySchoolId($data['Id'],$Sdata['Id']);
				$SchoolData[$SKey]['CompletedTrainings']=count($SchoolTraingData);
				
				$tmpStudentCount+=$SchoolData[$SKey]['StudenData'];
				
				if(strtolower($Sdata['ModelSchool'])=='yes')
				{
					$tmpSchoolmodelCount++;
					$tmpSchoolmodelStudentCount+=$SchoolData[$SKey]['StudenData'];
				}
					
			}
			echo $data['FirstName'].' '.$data['LastName'];
			$MeetingData=$this->schoolmodel->GetTrainingDataByTrainer($data['Id']);
           	$tmpTrainingData=array();
			foreach($MeetingData as $tmpMeeting)
			{
				$tmpTrainingData[date('M-Y',strtotime($tmpMeeting['TrainingDate']))][date('Y-m-d',strtotime($tmpMeeting['TrainingDate']))]=1;	
			}
			
			echo "Training<pre>";
			print_r($tmpTrainingData);
			echo "</pre>";
			
			
            $MeetingData=$this->schoolmodel->GetMeetingDataByTrainer($data['Id']);
           	$tmpMeetingData=array();
			foreach($MeetingData as $tmpMeeting)
			{
				$tmpMeetingData[date('M-Y',strtotime($tmpMeeting['MeetingDate']))][date('Y-m-d',strtotime($tmpMeeting['MeetingDate']))]=1;	
			}
			
			echo "Metting<pre>";
			print_r($tmpMeetingData);
			echo "</pre>";
			
			
			
			
			$tmpArray=array('','Total no. of students',$tmpStudentCount);
			$CSVData[]=$tmpArray;
			
			$tmpArray=array('','Total no. of model schools',$tmpSchoolmodelCount);
			$CSVData[]=$tmpArray;
			
			$tmpArray=array('','Total no. of students in model schools',$tmpSchoolmodelStudentCount);
			$CSVData[]=$tmpArray;
			
			$tmpArray=array();
			$CSVData[]=$tmpArray;
			
			$tmpArray=array();
			$CSVData[]=$tmpArray;
			
			
			$tmpArray=array('','List of Schools assigned to Trainer','Whether Model School (Y/N)','No. of students ','No. of times school visited','No. of training sessions completed','No. of training modules completed','No. of students for whom assessment completed','Dates of visit');
			$CSVData[]=$tmpArray;
			
			foreach($SchoolData as $School)
			{
				$tmpTDate=array();
				foreach($School['TrainingData'] as $tmpTraing)
				{
					$tmpTDate[]=date('d M Y',strtotime($tmpTraing['TrainingDate']));
				}
				
				$tmpArray=array('',$School['Name'],$School['ModelSchool'],$School['StudenData'],$School['Trainings'],$School['CompletedTrainings'],'','0',implode(', ',$tmpTDate));
				$CSVData[]=$tmpArray;	
			}
			
			$tmpArray=array();
			$CSVData[]=$tmpArray;
			
			$tmpArray=array();
			$CSVData[]=$tmpArray;
			
			
			
			$tmpArray=array('','Number of Unique Days Spent in the Field');
			$CSVData[]=$tmpArray;
			
			$tmpArray=array('','Month','Only Training','Only Community','Both','Total');
			$CSVData[]=$tmpArray;
			
			foreach($tmpTrainingData as $Month=>$tmpTdata)
			{
				$onlyTraining=count($tmpTdata);
				$onlyMeeting=array();
				$onlyBoth=array();
				foreach($tmpTdata as $monthYear=>$val)
				{
					if($tmpMeetingData[$Month][$monthYear]==1)
					{
						$onlyBoth[]=$monthYear;
					}
				}
				
				foreach($tmpMeetingData[$Month] as $monthYear=>$val)
				{
					if($tmpTrainingData[$Month][$monthYear]!=1)
					{
						$onlyMeeting[]=$monthYear;
					}
				}
				
				/*
				echo "<Br/> Both : ".$Month;
				echo "<pre>";
				print_r($onlyBoth);
				echo "</pre>";
				
				echo "<Br/> Meeting : ".$Month;
				echo "<pre>";
				print_r($onlyMeeting);
				echo "</pre>";
				*/
				$onlyTraining=$onlyTraining-count($onlyBoth);				
				$tmpArray=array('', $Month,$onlyTraining,count($onlyMeeting),count($onlyBoth),($onlyTraining+count($onlyMeeting)+count($onlyBoth)));
				$CSVData[]=$tmpArray;	
			}
			
			
			$TrainerData[$key]['SchoolData']=count($SchoolData);
			//die;
			//break;
			
			$fp = fopen('assets/ReportData/Report1_'.$data['Id'].'_'.$data['FirstName'].' '.$data['LastName'].'.csv', 'w');
			foreach ($CSVData as $fields) {
				fputcsv($fp, $fields);
			}
			
			fclose($fp);


		}
		
		

		
		echo "<pre>";
		print_r($TrainerData);
		echo "</pre>";
		
		
	}





    public function index2()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;

        $data['UserGroupId']=$SessionData['UserGroupId'];
        $data['DistrictAllData']=$this->districtmodel->DistrictListData($UserId);
        $FilterData=array();
        if($_GET['DistrictId'])
        {
            $FilterData['DistrictId']=$_GET['DistrictId'];
            $data['FilterDistrictId']=$_GET['DistrictId'];
        }

        if($_GET['TrainerId'])
        {
            $FilterData['FilterTrainerId']=$_GET['TrainerId'];
            $data['FilterTrainerId']=$_GET['TrainerId'];
        }

        $data['DistrictData']=$this->districtmodel->DistrictManagerListData($FilterData);
        $data['VillageData']=$this->villagemodel->VillageManagerListboardData($FilterData);
        $data['SchoolData']=$this->schoolmodel->SchoolManagerListDashboardData($FilterData);
        $data['StudentData']=$this->studentmodel->StudentManagerListData($FilterData);
        $data['TrainingData']=$this->trainingmodel->TrainingManagerListData($FilterData);
        $data['GalleryData']=$this->gallerymodel->GallerySingleData($FilterData);
        $data['IVRStudentData']=$this->trainingmodel->IVRStudentData($FilterData);
        $data['EventData']=$this->eventmodel->EventListData($FilterData);
        $data['TestimonialData']=$this->testimonialmodel->TestimonialSingleData($FilterData);
        $data['TrainerData']=$this->usermodel->GetTrainerData($FilterData);
        $data['AssessmentData']=$this->assessmentmodel->AssessmentDashboardData($FilterData);
        $data['StudentScoringData']=$this->assessmentmodel->StudentScoringDashboardData($FilterData);

        if($_GET['debug'] == 1) {
//            echo '<pre>';
//            print_r($data['StudentScoringData']);
//            echo '</pre>';
        }
        //die;



        $tableData=$this->trainingmodel->TrainingManagerListData($FilterData);
        $TotalTraingHours=0;
        foreach ($tableData as $tmpData)
        {
            $time1 = strtotime($tmpData['InTime']);
            $time2 = strtotime($tmpData['OutTime']);
            $TotalTraingHours+=round(abs($time2 - $time1) / 3600,2);


        }
        $data['TrainingHourData']=$TotalTraingHours;

        $tableData=$this->trainingmodel->TrainingManagerListData($FilterData);
        $TotalVolunteeringHours=0;
        $TotalVol='';
        foreach ($tableData as $tmpData)
        {
            if($tmpData['Volunteers'])
            {
                //print_r(count(json_decode($tmpData['Volunteers'])));
                $TotalVol = count(json_decode($tmpData['Volunteers']));

                $array1 = explode(':',date('H:i:s',strtotime($tmpData['InTime'])));
                $array2 = explode(':',date('H:i:s',strtotime($tmpData['OutTime'])));

                $minutes1 = ($array1[0] * 60.0 + $array1[1]);
                $minutes2 = ($array2[0] * 60.0 + $array2[1]);
                $diff =abs(number_format(($minutes2 - $minutes1)/60, 2, '.', ''));

                $TotalVolunteeringHours += $diff ;

                $time1 = strtotime($tmpData['InTime']);
                $time2 = strtotime($tmpData['OutTime']);
                //$TotalVolunteeringHours+=round(abs($time2 - $time1) / 3600,2)*$TotalVol;
            }
        }
        //print_r($TotalVolunteeringHours);
        $data['TotalVolunteeringHours']=$TotalVolunteeringHours;


        $tableData=$this->trainingmodel->TouchpointData($FilterData);
        //echo "<pre>";
        //print_r($tableData);
        //echo "</pre>";

        $data['TouchpointData']=$tableData;

        $TrainingDataReport=array();
        foreach($data['TrainingData'] as $Trdata)
        {
            $Status='Completed';
            $ColorCode='#00D948';
            if($Trdata['TrainingStatus']=='Scheduled')
            {
                $Status='Scheduled';
                $ColorCode='#FFA400';
            }

            if($Trdata['TrainingStatus']=='Cancelled')
            {
                $Status='Cancelled';
                $ColorCode='red';
            }

            if($Trdata['TrainingStatus']=='Postponed')
            {
                $Status='Postponed';
                $ColorCode='#009AF8';
            }

            if($Trdata['TrainingStatus']=='TBC')
            {
                $Status='TBC';
                $ColorCode='green';
            }

            $tmpData=array();
            $tmpData['title']=$Trdata['TrainingStatus'].'-'.$Trdata['LocationName'].' - '.date('h:i',strtotime(trim($Trdata['InTime']))).' to '.date('h:i',strtotime(trim($Trdata['OutTime'])));//.' by '.$data['Name'];
            $tmpData['start']=$Trdata['TrainingDate'].'T'.date('H:i',strtotime(trim($Trdata['InTime'])));
            $tmpData['color']=$ColorCode;
            $tmpData['CancelReason']=$Trdata['CancelReason'];
            $TrainingDataReport[]=$tmpData;
        }
        $data['TrainingDataReport'] = $TrainingDataReport;

        $this->load->innerTemplate('dashboard/index2',$data);
    }




}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */