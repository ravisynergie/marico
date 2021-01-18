<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

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
		$this->load->model('loginmodel');
		$this->load->model('villagemodel');
		$this->load->model('schoolmodel');
		$this->load->model('studentmodel');
		$this->load->model('onlinemodel');
		$this->load->model('reportmodel');
	}
	
	public function ApiWebLogin()
	{
		$ApiData=json_decode(json_encode($_REQUEST),true);
		$userData=$this->loginmodel->validate($ApiData);
		if($userData=='Invalid')
		{
			echo json_encode(array('Status'=>'0'));
		}
		else
		{
			echo json_encode($userData);
		}
		$LogFileName = fopen("assets/ApiLog/Login-".time().".txt","w");
		$CurrentLog=json_encode($_REQUEST);
		fwrite($LogFileName,$CurrentLog);
		fclose($LogFileName);
		die;

	}
	
	public function ApiSaveVillage()
	{
		$ApiData=json_decode(json_encode($_REQUEST),true);
		unset($ApiData['/api/ApiSaveVillage']);
		$ApiData['DateCreated']=date('Y-m-d h:i:s');
		$result = $this->villagemodel->CreateNewVillage($ApiData);
		if($result){
			echo json_encode(array('Status'=>'1'));
		}
		$LogFileName = fopen("assets/ApiLog/CreateVillage-".time().".txt","w");
		$CurrentLog=json_encode($_REQUEST);
		fwrite($LogFileName,$CurrentLog);
		fclose($LogFileName);
		die;

	}


    public function ApiSaveVillageTest()
    {
        $ApiData=json_decode(json_encode($_REQUEST),true);
        unset($ApiData['/api/ApiSaveVillage']);
        //$ApiData['DateCreated']=date('Y-m-d h:i:s');
        $result = $this->villagemodel->GetDuplicateEntry($ApiData['Name'],$ApiData['DistrictId'],$ApiData['BlockId']);
        if($result > 0){
            echo json_encode(array('Status'=>'0', 'Error'=>'Duplicate Entry'));
        }
        else{
            $ApiData['DateCreated']=date('Y-m-d h:i:s');
            $result = $this->villagemodel->CreateNewVillage($ApiData);
            if($result){
                echo json_encode(array('Status'=>'1'));
            }
        }


        $LogFileName = fopen("assets/ApiLog/CreateVillage-".time().".txt","w");
        $CurrentLog=json_encode($_REQUEST);
        fwrite($LogFileName,$CurrentLog);
        fclose($LogFileName);
        die;

    }
	
	public function ApiSaveSchool()
	{
		$ApiData=json_decode(json_encode($_REQUEST),true);
		unset($ApiData['/api/ApiSaveSchool']);
		$ApiData['DateCreated']=date('Y-m-d h:i:s');
		$result = $this->schoolmodel->CreateNewSchool($ApiData);
		if($result){
			echo json_encode(array('Status'=>'1'));
		}
		$LogFileName = fopen("assets/ApiLog/CreateSchool-".time().".txt","w");
		$CurrentLog=json_encode($_REQUEST);
		fwrite($LogFileName,$CurrentLog);
		fclose($LogFileName);
		die;

	}
	
	public function ApiSaveStudent()
	{
		$LogFileName = fopen("assets/ApiLog/CreateStudent-".time().".txt","w");
		$CurrentLog=json_encode($_REQUEST);
		fwrite($LogFileName,$CurrentLog);
		fclose($LogFileName);
		
		$ApiData=json_decode(json_encode($_REQUEST),true);
		unset($ApiData['/api/ApiSaveStudent']);
		$ApiData['DateCreated']=date('Y-m-d h:i:s');
		
		$result = $this->studentmodel->CreateNewStudent($ApiData);
		if($result){
			echo json_encode(array('Status'=>'1'));
		}
		
		die;

	}
	
	
	public function ApiWebDistrict()
	{
		//$UserId=$_REQUEST['UserId'];
        $UserId=1;
		$DistrictData=$this->districtmodel->DistrictListData($UserId);
		echo json_encode($DistrictData);
		die;
	}
	
	public function ApiWebBlock()
	{
		//$UserId=$_REQUEST['UserId'];
        $UserId=1;
		$DistrictData=$this->blockmodel->BlockListData($UserId);
		echo json_encode($DistrictData);
		die;
	}
	
	public function ApiWebVillage()
	{
		//$UserId=$_REQUEST['UserId'];
		$UserId=1;
		$DistrictData=$this->villagemodel->VillageListData($UserId);
		echo json_encode($DistrictData);
		die;
	}
	
	public function ApiWebSchool()
	{
		$UserId=$_REQUEST['UserId'];
//		$UserId=1;
		$DistrictData=$this->schoolmodel->SchoolListData($UserId);
		echo json_encode($DistrictData);
		die;
	}

	public function ApiUploadPhoto(){
		
		$LogFileName = fopen("assets/ApiLog/CreateGallery-".time().".txt","w");
		$CurrentLog=json_encode($_REQUEST);
		fwrite($LogFileName,$CurrentLog);
		fclose($LogFileName);

        $ApiData=json_decode(json_encode($_REQUEST),true);
        unset($ApiData['/api/ApiUploadPhoto']);

        $image = $_REQUEST['image'];
//        $imgNmame = $ApiData['Type']."_".time().".jpg";
        $imgNmame = "synergie9am".time().".jpg";
        $path = "assets/marico_gallery/synergie9am/".$imgNmame;


        file_put_contents($path,base64_decode($image));

        echo "Successfull";

	}
	
	
	public function ManageStudentsScoring()
	{
		$AssessmentData=$this->schoolmodel->ManageStudentsScoring();
		foreach($AssessmentData as $tmpAssessment)
		{
			$D1=0;
			$C1=0;
			$B1=0;
			$A1=0;
			if($tmpAssessment['SectionOne']['TotalMarks']>2)
			{
				$D1=1;	
			}
			if($D1)
			{
				if($tmpAssessment['SectionTwo']['TotalMarks']>4 && $tmpAssessment['SectionTwo']['TotalMarks']<=6)
				{
					$C1=1;	
				}
				
				if($tmpAssessment['SectionTwo']['TotalMarks']>6)
				{
					$B1=1;
					$C1=1;	
				}
				
				if($C1 || $B1)
				{
					$tmpAssessThree=array();
					foreach(json_decode($tmpAssessment['SectionThree']['AssessmentStudentData']) as $tmpNumber)
					{
						if($tmpNumber==2)
						{
							$tmpAssessThree[]=2;
						}
					}
					if($tmpAssessment['SectionThree']['TotalMarks']>5 && count($tmpAssessThree)>=2)
					{
						$A1=1;	
					}
				}
			}
			
			$SaveData=array();
			$SaveData['StudentId']=$tmpAssessment['StudentData']['StudentId'];
			$SaveData['UserId']=$tmpAssessment['StudentData']['UserId'];
			$SaveData['DistrictId']=$tmpAssessment['StudentData']['DistrictId'];
			$SaveData['VillageId']=$tmpAssessment['StudentData']['VillageId'];
			$SaveData['SchoolId']=$tmpAssessment['StudentData']['SchoolId'];
			$SaveData['Gender']=$tmpAssessment['StudentData']['Gender'];
			$SaveData['Class']=$tmpAssessment['StudentData']['Class'];
			$SaveData['A1']=$A1;
			$SaveData['B1']=$B1;
			$SaveData['C1']=$C1;
			$SaveData['D1']=$D1;
			$SaveData['DateCreated']=date('Y-m-d h:i:s');
			$this->schoolmodel->StudentsScoring($SaveData);
			
		}	
			
	}
	
	
	
	public function ManageStudentsOnlineScoring()
	{
		$AssessmentData=$this->schoolmodel->ManageStudentsOnlineScoring();
		foreach($AssessmentData as $tmpAssessment)
		{
			$D1=0;
			$C1=0;
			$B1=0;
			$A1=0;
			if($tmpAssessment['SectionOne']['TotalMarks']>2)
			{
				$D1=1;	
			}
			if($D1)
			{
				if($tmpAssessment['SectionTwo']['TotalMarks']>4 && $tmpAssessment['SectionTwo']['TotalMarks']<=6)
				{
					$C1=1;	
				}
				
				if($tmpAssessment['SectionTwo']['TotalMarks']>6)
				{
					$B1=1;
					$C1=1;	
				}
				
				if($C1 || $B1)
				{
					$tmpAssessThree=array();
					foreach(json_decode($tmpAssessment['SectionThree']['AssessmentStudentData']) as $tmpNumber)
					{
						if($tmpNumber==2)
						{
							$tmpAssessThree[]=2;
						}
					}
					if($tmpAssessment['SectionThree']['TotalMarks']>5 && count($tmpAssessThree)>=2)
					{
						$A1=1;	
					}
				}
			}
			
			$SaveData=array();
			$SaveData['StudentIdModuleNumber']=$tmpAssessment['StudentData']['StudentIdModuleNumber'];
			$SaveData['ModuleNumber']=$tmpAssessment['StudentData']['ModuleNumber'];
			$SaveData['StudentId']=$tmpAssessment['StudentData']['StudentId'];
			$SaveData['UserId']=$tmpAssessment['StudentData']['UserId'];
			$SaveData['DistrictId']=$tmpAssessment['StudentData']['DistrictId'];
			$SaveData['VillageId']=$tmpAssessment['StudentData']['VillageId'];
			$SaveData['SchoolId']=$tmpAssessment['StudentData']['SchoolId'];
			$SaveData['Gender']=$tmpAssessment['StudentData']['Gender'];
			$SaveData['Class']=$tmpAssessment['StudentData']['Class'];
			$SaveData['A1']=$A1;
			$SaveData['B1']=$B1;
			$SaveData['C1']=$C1;
			$SaveData['D1']=$D1;
			$SaveData['DateCreated']=date('Y-m-d h:i:s');
			$this->schoolmodel->StudentsOnlineScoring($SaveData);
			
		}	
			
	}
	
	
	
	
	public function ManageStudentsOnlineScoringAss2()
	{
		$AssessmentData=$this->schoolmodel->ManageStudentsOnlineScoringAss2();
		foreach($AssessmentData as $tmpAssessment)
		{
			$D1=0;
			$C1=0;
			$B1=0;
			$A1=0;
			if($tmpAssessment['SectionOne']['TotalMarks']>2)
			{
				$D1=1;	
			}
			if($D1)
			{
				if($tmpAssessment['SectionTwo']['TotalMarks']>4 && $tmpAssessment['SectionTwo']['TotalMarks']<=6)
				{
					$C1=1;	
				}
				
				if($tmpAssessment['SectionTwo']['TotalMarks']>6)
				{
					$B1=1;
					$C1=1;	
				}
				
				if($C1 || $B1)
				{
					$tmpAssessThree=array();
					foreach(json_decode($tmpAssessment['SectionThree']['AssessmentStudentData']) as $tmpNumber)
					{
						if($tmpNumber==2)
						{
							$tmpAssessThree[]=2;
						}
					}
					if($tmpAssessment['SectionThree']['TotalMarks']>5 && count($tmpAssessThree)>=2)
					{
						$A1=1;	
					}
				}
			}
			
			$SaveData=array();
			$SaveData['StudentIdModuleNumber']=$tmpAssessment['StudentData']['StudentIdModuleNumber'];
			$SaveData['ModuleNumber']=$tmpAssessment['StudentData']['ModuleNumber'];
			$SaveData['StudentId']=$tmpAssessment['StudentData']['StudentId'];
			$SaveData['UserId']=$tmpAssessment['StudentData']['UserId'];
			$SaveData['DistrictId']=$tmpAssessment['StudentData']['DistrictId'];
			$SaveData['VillageId']=$tmpAssessment['StudentData']['VillageId'];
			$SaveData['SchoolId']=$tmpAssessment['StudentData']['SchoolId'];
			$SaveData['Gender']=$tmpAssessment['StudentData']['Gender'];
			$SaveData['Class']=$tmpAssessment['StudentData']['Class'];
			$SaveData['A1']=$A1;
			$SaveData['B1']=$B1;
			$SaveData['C1']=$C1;
			$SaveData['D1']=$D1;
			$SaveData['DateCreated']=date('Y-m-d h:i:s');
			$this->schoolmodel->StudentsOnlineScoring($SaveData);
			
		}	
			
	}


	public function AttendanceToIVR()
	{
        $this->globalmodel->AttendanceToIVRDelete();
        $AttendanceData=$this->globalmodel->AttendanceToIVR();
		foreach($AttendanceData as $tmpAttendance)
		{
			$NumberOfIVRCompleted=json_decode($tmpAttendance['NumberOfIVRCompleted']);
			foreach($NumberOfIVRCompleted as $StudenId=>$IvrCompleted)
			{
				if($IvrCompleted)
				{
					$SaveData=array();
					$SaveData['DistrictId']=$tmpAttendance['DistrictId'];
					$SaveData['StudentId']=$StudenId;
					$SaveData['IVRCompleted']=$IvrCompleted;
					$SaveData['UserId']=$tmpAttendance['UserId'];
					$SaveData['Activities']=$tmpAttendance['Activities'];
					$SaveData['ReportCardReview']=$tmpAttendance['ReportCardReview'];
					$SaveData['ReviewDate']=$tmpAttendance['ReviewDate'];
					$SaveData['DateCreated']=$tmpAttendance['DateCreated'];
					$this->globalmodel->StudentIvrInsert($SaveData);
				}
			}			
		}
	}
	
	
	public function TrainingProgress()
	{
		$FilterData=array();
		$districtData=$this->districtmodel->DistrictManagerListData($FilterData);		
		$this->globalmodel->TrancateTrainingProgress();
		
		$TotalDistrict=0;
		$TotalSchoolsTotal=0;
		$TotalSchoolsModel=0;
		$TotalStudentsTotal=0;
		$TotalStudentsModelSchool=0;
		$TotalAverageNumberTouchpointsModel=0;
		$TotalAverageNumberTouchpointsOther=0;
		$TotalIVRModulesCompletedModel=0;
		$TotalIVRModulesCompletedOther=0;
		$TotalNumberStudentsCompletedIVR30=0;
		$TotalNumberStudentsCompletedIVR31=0;
		$TotalNumberStudentsCompletedIVR101=0;
		$TotalNumberStudentsCompletedIVR151=0;
		$TotalPercentStudentAccessedIVRModel=0;
		$TotalPercentStudentAccessedIVROther=0;
		$TotalA1Number=0;
		$TotalA1PercentOfTotal=0;
		$TotalA1PercentNumberModelSchool=0;
		$TotalB1Number=0;
		$TotalB1PercentOfTotal=0;
		$TotalB1PercentNumberModelSchool=0;
		$TotalC1Number=0;
		$TotalC1PercentOfTotal=0;
		$TotalC1PercentNumberModelSchool=0;
		$TotalD1Number=0;
		$TotalD1PercentOfTotal=0;
		$TotalD1PercentNumberModelSchool=0;
		foreach($districtData as $disKey=>$tmpDistrictData)
		{
			$DistrictId=$tmpDistrictData['Id'];
			$SchoolData=$this->globalmodel->DistrictSchoolData($DistrictId);
			$IvrCompleted=$this->globalmodel->DistrictIvrCompletedData($DistrictId);
			$A1Completed=$this->globalmodel->DistrictA1Data($DistrictId);
			$B1Completed=$this->globalmodel->DistrictB1Data($DistrictId);
			$C1Completed=$this->globalmodel->DistrictC1Data($DistrictId);
			$D1Completed=$this->globalmodel->DistrictD1Data($DistrictId);
			
			$districtData[$disKey]['30']=0;
			$districtData[$disKey]['100']=0;
			$districtData[$disKey]['150']=0;
			$districtData[$disKey]['200']=0;
			
			$districtData[$disKey]['IvrModelSchool']=0;	
			$districtData[$disKey]['IvrCompletedModelSchool']=0;	
			$districtData[$disKey]['IvrOtherSchool']=0;	
			$districtData[$disKey]['IvrCompletedOtherSchool']=0;	
			foreach($IvrCompleted as $tmpIvrCompleted)
			{
				if(strtolower($tmpIvrCompleted['ModelSchool'])=='yes')
				{
					$districtData[$disKey]['IvrModelSchool']+=1;	
					$districtData[$disKey]['IvrCompletedModelSchool']+=$tmpIvrCompleted['IVRCompleted'];	
				}
				else
				{
					$districtData[$disKey]['IvrOtherSchool']+=1;	
					$districtData[$disKey]['IvrCompletedOtherSchool']+=$tmpIvrCompleted['IVRCompleted'];
				}
				
				
				if($tmpIvrCompleted['IVRCompleted']<=30)
				{
					$districtData[$disKey]['30']+=1;	
				}
				elseif($tmpIvrCompleted['IVRCompleted']>30 && $tmpIvrCompleted['IVRCompleted']<=100)
				{
					$districtData[$disKey]['100']+=1;	
				}
				elseif($tmpIvrCompleted['IVRCompleted']>100 && $tmpIvrCompleted['IVRCompleted']<=150)
				{
					$districtData[$disKey]['150']+=1;	
				}
				elseif($tmpIvrCompleted['IVRCompleted']>150 && $tmpIvrCompleted['IVRCompleted']<=200)
				{
					$districtData[$disKey]['200']+=1;	
				}
			}
				
			
			$districtData[$disKey]['SchoolCount']=count($SchoolData);
			foreach($SchoolData as $tmpSchoolData)
			{
				$SchoolId=$tmpSchoolData['Id'];
				$StudentData=$this->globalmodel->DistrictSchoolStudentData($SchoolId);
				$TouchPointData=$this->globalmodel->DistrictSchoolTouchPointData($SchoolId);
				
				$districtData[$disKey]['StudentCount']+=count($StudentData);
				if(strtolower($tmpSchoolData['ModelSchool'])=='yes')
				{
					$districtData[$disKey]['ModelSchoolCount']+=1;
					$districtData[$disKey]['ModelStudentCount']+=count($StudentData);
					$districtData[$disKey]['ModelTouchPointCount']+=count($TouchPointData);
				}
				else
				{
					$districtData[$disKey]['OtherTouchPointCount']+=count($TouchPointData);
				}
			}
			$districtData[$disKey]['AvgAccessedIVROther']=$districtData[$disKey]['IvrCompletedOtherSchool'];
			$districtData[$disKey]['AvgAccessedIVRModel']=$districtData[$disKey]['IvrCompletedModelSchool'];
			
			
			
			$districtData[$disKey]['AvgAccessedIVRModel']=$districtData[$disKey]['IvrCompletedModelSchool'] != 0 ? number_format($districtData[$disKey]['IvrCompletedModelSchool']/$districtData[$disKey]['ModelStudentCount'], 2, '.', '') : 0;
			
			$districtData[$disKey]['PerAccessedIVRModel']=$districtData[$disKey]['IvrModelSchool'] != 0 ? number_format(($districtData[$disKey]['IvrModelSchool']*100)/$districtData[$disKey]['ModelStudentCount'], 2, '.', '') : 0;
			
			$TotalIVRModulesCompletedModel+=$districtData[$disKey]['IvrCompletedModelSchool'];
			$TotalPercentStudentAccessedIVRModel+=$districtData[$disKey]['IvrModelSchool'];
			
			unset($districtData[$disKey]['IvrCompletedModelSchool']);
			unset($districtData[$disKey]['IvrModelSchool']);
			
			$districtData[$disKey]['AvgAccessedIVROther']=$districtData[$disKey]['IvrCompletedOtherSchool'] != 0 ? number_format($districtData[$disKey]['IvrCompletedOtherSchool']/($districtData[$disKey]['StudentCount']-$districtData[$disKey]['ModelStudentCount']), 2, '.', '') : 0;
			
			$districtData[$disKey]['PerAccessedIVROther']=$districtData[$disKey]['IvrOtherSchool'] != 0 ? number_format(($districtData[$disKey]['IvrOtherSchool']*100)/($districtData[$disKey]['StudentCount']-$districtData[$disKey]['ModelStudentCount']), 2, '.', '') : 0;
			
			$TotalIVRModulesCompletedOther+=$districtData[$disKey]['IvrCompletedOtherSchool'];
			$TotalPercentStudentAccessedIVROther+=$districtData[$disKey]['IvrOtherSchool'];
			
			unset($districtData[$disKey]['IvrCompletedOtherSchool']);
			unset($districtData[$disKey]['IvrOtherSchool']);
			
			
			
			$TotalAverageNumberTouchpointsModel+=$districtData[$disKey]['ModelTouchPointCount'];
			$TotalAverageNumberTouchpointsOther+=$districtData[$disKey]['OtherTouchPointCount'];
			
			
			$districtData[$disKey]['OtherTouchPointCount']=number_format($districtData[$disKey]['OtherTouchPointCount']/($districtData[$disKey]['SchoolCount']-$districtData[$disKey]['ModelSchoolCount']), 2, '.', '');
			$districtData[$disKey]['ModelTouchPointCount']=number_format($districtData[$disKey]['ModelTouchPointCount']/$districtData[$disKey]['ModelSchoolCount'], 2, '.', '');
			
			
			$districtData[$disKey]['A1Completed']=count($A1Completed);	
			foreach($A1Completed as $tmpA1Completed)
			{
				if(strtolower($tmpA1Completed['ModelSchool'])=='yes')
				{
					$districtData[$disKey]['A1ModelCompleted']+=1;	
				}
			}
			$districtData[$disKey]['A1TotalPercent']=number_format(($districtData[$disKey]['A1Completed']*100)/$districtData[$disKey]['StudentCount'], 2, '.', '');
			$districtData[$disKey]['A1ModelPercent']=number_format(($districtData[$disKey]['A1ModelCompleted']*100)/$districtData[$disKey]['ModelStudentCount'], 2, '.', '');
			unset($districtData[$disKey]['A1ModelCompleted']);
			
			
			$districtData[$disKey]['B1Completed']=count($B1Completed);	
			foreach($B1Completed as $tmpA1Completed)
			{
				if(strtolower($tmpA1Completed['ModelSchool'])=='yes')
				{
					$districtData[$disKey]['B1ModelCompleted']+=1;	
				}
			}
			$districtData[$disKey]['B1TotalPercent']=number_format(($districtData[$disKey]['B1Completed']*100)/$districtData[$disKey]['StudentCount'], 2, '.', '');
			$districtData[$disKey]['B1ModelPercent']=number_format(($districtData[$disKey]['B1ModelCompleted']*100)/$districtData[$disKey]['ModelStudentCount'], 2, '.', '');
			unset($districtData[$disKey]['B1ModelCompleted']);
			
			
			$districtData[$disKey]['C1Completed']=count($C1Completed);	
			foreach($C1Completed as $tmpA1Completed)
			{
				if(strtolower($tmpA1Completed['ModelSchool'])=='yes')
				{
					$districtData[$disKey]['C1ModelCompleted']+=1;	
				}
			}
			$districtData[$disKey]['C1TotalPercent']=number_format(($districtData[$disKey]['C1Completed']*100)/$districtData[$disKey]['StudentCount'], 2, '.', '');
			$districtData[$disKey]['C1ModelPercent']=number_format(($districtData[$disKey]['C1ModelCompleted']*100)/$districtData[$disKey]['ModelStudentCount'], 2, '.', '');
			unset($districtData[$disKey]['C1ModelCompleted']);
			
			
			$districtData[$disKey]['D1Completed']=count($D1Completed);	
			foreach($D1Completed as $tmpA1Completed)
			{
				if(strtolower($tmpA1Completed['ModelSchool'])=='yes')
				{
					$districtData[$disKey]['D1ModelCompleted']+=1;	
				}
			}
			$districtData[$disKey]['D1TotalPercent']=number_format(($districtData[$disKey]['D1Completed']*100)/$districtData[$disKey]['StudentCount'], 2, '.', '');
			$districtData[$disKey]['D1ModelPercent']=number_format(($districtData[$disKey]['D1ModelCompleted']*100)/$districtData[$disKey]['ModelStudentCount'], 2, '.', '');
			unset($districtData[$disKey]['D1ModelCompleted']);
			
			
			$TotalSchoolsTotal+=$districtData[$disKey]['SchoolCount'];
			$TotalSchoolsModel+=$districtData[$disKey]['ModelSchoolCount'];
			$TotalStudentsTotal+=$districtData[$disKey]['StudentCount'];
			$TotalStudentsModelSchool+=$districtData[$disKey]['ModelStudentCount'];
			
			$TotalNumberStudentsCompletedIVR30+=$districtData[$disKey]['30'];
			$TotalNumberStudentsCompletedIVR31+=$districtData[$disKey]['100'];
			$TotalNumberStudentsCompletedIVR101+=$districtData[$disKey]['150'];
			$TotalNumberStudentsCompletedIVR151+=$districtData[$disKey]['200'];
			
			$TotalA1Number+=$districtData[$disKey]['A1Completed'];
			$TotalB1Number+=$districtData[$disKey]['B1Completed'];
			$TotalC1Number+=$districtData[$disKey]['C1Completed'];
			$TotalD1Number+=$districtData[$disKey]['D1Completed'];
			
			$SaveData=array();
			$SaveData['District']=$tmpDistrictData['Name'];;
			$SaveData['SchoolsTotal']=$districtData[$disKey]['SchoolCount'];
			$SaveData['SchoolsModel']=$districtData[$disKey]['ModelSchoolCount'];
			$SaveData['StudentsTotal']=$districtData[$disKey]['StudentCount'];
			$SaveData['StudentsModelSchool']=$districtData[$disKey]['ModelStudentCount'];
			$SaveData['AverageNumberTouchpointsModel']=$districtData[$disKey]['ModelTouchPointCount'];
			$SaveData['AverageNumberTouchpointsOther']=$districtData[$disKey]['OtherTouchPointCount'];
			$SaveData['IVRModulesCompletedModel']=$districtData[$disKey]['AvgAccessedIVRModel'];
			$SaveData['IVRModulesCompletedOther']=$districtData[$disKey]['AvgAccessedIVROther'];
			$SaveData['NumberStudentsCompletedIVR30']=$districtData[$disKey]['30'];
			$SaveData['NumberStudentsCompletedIVR31']=$districtData[$disKey]['100'];
			$SaveData['NumberStudentsCompletedIVR101']=$districtData[$disKey]['150'];
			$SaveData['NumberStudentsCompletedIVR151']=$districtData[$disKey]['200'];
			$SaveData['PercentStudentAccessedIVRModel']=$districtData[$disKey]['PerAccessedIVRModel'];
			$SaveData['PercentStudentAccessedIVROther']=$districtData[$disKey]['PerAccessedIVROther'];
			$SaveData['A1Number']=$districtData[$disKey]['A1Completed'];
			$SaveData['A1PercentOfTotal']=$districtData[$disKey]['A1TotalPercent'];
			$SaveData['A1PercentNumberModelSchool']=$districtData[$disKey]['A1ModelPercent'];
			$SaveData['B1Number']=$districtData[$disKey]['B1Completed'];
			$SaveData['B1PercentOfTotal']=$districtData[$disKey]['B1TotalPercent'];
			$SaveData['B1PercentNumberModelSchool']=$districtData[$disKey]['B1ModelPercent'];
			$SaveData['C1Number']=$districtData[$disKey]['C1Completed'];
			$SaveData['C1PercentOfTotal']=$districtData[$disKey]['C1TotalPercent'];
			$SaveData['C1PercentNumberModelSchool']=$districtData[$disKey]['C1ModelPercent'];
			$SaveData['D1Number']=$districtData[$disKey]['D1Completed'];
			$SaveData['D1PercentOfTotal']=$districtData[$disKey]['D1TotalPercent'];
			$SaveData['D1PercentNumberModelSchool']=$districtData[$disKey]['D1ModelPercent'];
			$this->globalmodel->InsertTrainingProgress($SaveData);
		}
		
		$TotalAverageNumberTouchpointsModel=number_format($TotalAverageNumberTouchpointsModel/$TotalSchoolsModel, 2, '.', '');
		$TotalAverageNumberTouchpointsOther=number_format($TotalAverageNumberTouchpointsOther/($TotalSchoolsTotal-$TotalSchoolsModel), 2, '.', '');
		
		$TotalIVRModulesCompletedModel=number_format($TotalIVRModulesCompletedModel/$TotalStudentsModelSchool, 2, '.', '');
		$TotalIVRModulesCompletedOther=number_format($TotalIVRModulesCompletedOther/($TotalStudentsTotal-$TotalStudentsModelSchool), 2, '.', '');
			
		$TotalPercentStudentAccessedIVRModel=number_format(($TotalPercentStudentAccessedIVRModel*100)/$TotalStudentsModelSchool, 2, '.', '');
		$TotalPercentStudentAccessedIVROther=number_format(($TotalPercentStudentAccessedIVROther*100)/($TotalStudentsTotal-$TotalStudentsModelSchool), 2, '.', '');
		
		$TotalA1PercentOfTotal+=number_format(($TotalA1Number*100)/$TotalStudentsTotal, 2, '.', '');
		$TotalA1PercentNumberModelSchool+=number_format(($TotalA1Number*100)/$TotalStudentsModelSchool, 2, '.', '');
		
		$TotalB1PercentOfTotal+=number_format(($TotalB1Number*100)/$TotalStudentsTotal, 2, '.', '');
		$TotalB1PercentNumberModelSchool+=number_format(($TotalB1Number*100)/$TotalStudentsModelSchool, 2, '.', '');
		
		$TotalC1PercentOfTotal+=number_format(($TotalC1Number*100)/$TotalStudentsTotal, 2, '.', '');
		$TotalC1PercentNumberModelSchool+=number_format(($TotalC1Number*100)/$TotalStudentsModelSchool, 2, '.', '');
		
		$TotalD1PercentOfTotal+=number_format(($TotalD1Number*100)/$TotalStudentsTotal, 2, '.', '');
		$TotalD1PercentNumberModelSchool+=number_format(($TotalD1Number*100)/$TotalStudentsModelSchool, 2, '.', '');
			
		$SaveData=array();
		$SaveData['District']='Total';
		$SaveData['SchoolsTotal']=$TotalSchoolsTotal;
		$SaveData['SchoolsModel']=$TotalSchoolsModel;
		$SaveData['StudentsTotal']=$TotalStudentsTotal;
		$SaveData['StudentsModelSchool']=$TotalStudentsModelSchool;
		$SaveData['AverageNumberTouchpointsModel']=$TotalAverageNumberTouchpointsModel;
		$SaveData['AverageNumberTouchpointsOther']=$TotalAverageNumberTouchpointsOther;
		$SaveData['IVRModulesCompletedModel']=$TotalIVRModulesCompletedModel;
		$SaveData['IVRModulesCompletedOther']=$TotalIVRModulesCompletedOther;
		$SaveData['NumberStudentsCompletedIVR30']=$TotalNumberStudentsCompletedIVR30;
		$SaveData['NumberStudentsCompletedIVR31']=$TotalNumberStudentsCompletedIVR31;
		$SaveData['NumberStudentsCompletedIVR101']=$TotalNumberStudentsCompletedIVR101;
		$SaveData['NumberStudentsCompletedIVR151']=$TotalNumberStudentsCompletedIVR151;
		$SaveData['PercentStudentAccessedIVRModel']=$TotalPercentStudentAccessedIVRModel;
		$SaveData['PercentStudentAccessedIVROther']=$TotalPercentStudentAccessedIVROther;
		$SaveData['A1Number']=$TotalA1Number;
		$SaveData['A1PercentOfTotal']=$TotalA1PercentOfTotal;
		$SaveData['A1PercentNumberModelSchool']=$TotalA1PercentNumberModelSchool;
		$SaveData['B1Number']=$TotalA1PercentNumberModelSchool;
		$SaveData['B1PercentOfTotal']=$TotalB1PercentOfTotal;
		$SaveData['B1PercentNumberModelSchool']=$TotalB1PercentNumberModelSchool;
		$SaveData['C1Number']=$TotalC1Number;
		$SaveData['C1PercentOfTotal']=$TotalC1PercentOfTotal;
		$SaveData['C1PercentNumberModelSchool']=$TotalC1PercentNumberModelSchool;
		$SaveData['D1Number']=$TotalD1Number;
		$SaveData['D1PercentOfTotal']=$TotalD1PercentOfTotal;
		$SaveData['D1PercentNumberModelSchool']=$TotalD1PercentNumberModelSchool;
		$this->globalmodel->InsertTrainingProgress($SaveData);
		
		echo "<pre>";
		print_r($districtData);
		echo "</pre>";
		
	}
	
	

	public function AllStudentData(){
	    $StudentData = $this->studentmodel->GetAllStudentData();
        $AllStudent=array();
	    foreach ($StudentData as $tmpData) {
            $tmpData['IVRCompleted'] = $this->studentmodel->GetIVRData($tmpData['Id']);
            $tmpData['AssessmentOne'] = $this->studentmodel->GetAssessmentOne($tmpData['Id']);
            $tmpData['AssessmentTwo'] = $this->studentmodel->GetAssessmentTwo($tmpData['Id']);
            $tmpData['AssessmentThree'] = $this->studentmodel->GetAssessmentThree($tmpData['Id']);
            $tmpData['TrainerName'] = $this->studentmodel->GetTrainerName($tmpData['UserId']);

            $AllStudent[] = $tmpData;

        }
            $CSVData = array();
            $tmpArray = array();

            $tmpArray = array('S No.', 'District', 'Trainer', 'Village/Nagar', 'Gram Panchayat', 'School Name', 'Name of SPOC', 'Contact of SPOC', 'UID NO', 'Name of student', 'Class', 'Age', 'Gender', 'Contact', 'Guardian Name', 'Uploaded IVR', 'Assesment Uploaded-1', 'Assesment Uploaded-2', 'Assesment Uploaded-3');
            $CSVData[] = $tmpArray;

            $num = 1;
            foreach ($AllStudent as $data) {
                $tmpArray = array($num++, $data['DistrictName'], $data['TrainerName'], $data['VillageName'], $data['GramPanchayat'], $data['SchoolName'], $data['SpocName'], $data['SpocContact'], $data['Id'], $data['Name'], $data['Class'], $data['Age'], $data['Gender'], $data['PhoneNo'], $data['GuardianName'], $data['IVRCompleted'], $data['AssessmentOne'], $data['AssessmentTwo'], $data['AssessmentThree']);
                $CSVData[] = $tmpArray;
            }

            $fp = fopen('assets/ReportData/AllStudentData.csv', 'w');
            foreach ($CSVData as $fields) {
                fputcsv($fp, $fields);
            }

            fclose($fp);

//	    echo '<pre>';
//	    print_r($AllStudent);
//	    echo '</pre>';
    }
	
	public function AchieveA1Level(){
	    $A1Student = $this->studentmodel->GetA1Student();

        echo '<pre>';
        print_r($A1Student);
        echo '</pre>';
    }

    public function SchoolWiseData()
	{
		$SchoolData = $this->schoolmodel->SchoolListData();

        $AllSchoolData=array();
        foreach ($SchoolData as $tmpData) 
		{
            $tmpData['TotalStudent'] = $this->schoolmodel->GetStudenDataBySchoolId($tmpData['Id']);
            $tmpData['TotalTouchpoint'] = $this->schoolmodel->GetTrainingBySchoolId($tmpData['Id']);
            $tmpData['TotalAssessment'] = $this->schoolmodel->GetTotalAssessment($tmpData['Id']);
            $tmpData['TotalA1'] = $this->schoolmodel->GetTotalAssessmentA1($tmpData['Id']);
            $tmpData['TotalB1'] = $this->schoolmodel->GetTotalAssessmentB1($tmpData['Id']);
            $tmpData['TotalTrainedStudent'] = $this->schoolmodel->GetTotalTrainedStudent($tmpData['Id']);
            $AllSchoolData[] = $tmpData;
			//die;
        }


        $CSVData = array();
        $tmpArray = array();
        $tmpArray = array('District Name', 'School Name', 'Model', 'Total Student', 'Total Touchpoint', 'TotalAssessment', 'TotalA1', 'TotalB1', 'TotalTrainedStudent');
        $CSVData[] = $tmpArray;

        $num = 1;
        foreach ($AllSchoolData as $data) 
		{
            $tmpArray = array($data['DistrictName'], $data['Name'], $data['ModelSchool'], $data['TotalStudent'], $data['TotalTouchpoint'], $data['TotalAssessment'], $data['TotalA1'], $data['TotalB1'],$data['TotalTrainedStudent']);
            $CSVData[] = $tmpArray;
        }

        $fp = fopen('assets/ReportData/AllStudentData.csv', 'w');
        foreach ($CSVData as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);


        echo '<pre>';
        print_r($AllSchoolData);
        echo '</pre>';
    }


    public function ManageStudentsScoringTwo()
    {
        $AssessmentData=$this->onlinemodel->ManageStudentsScoringTwo();

        foreach($AssessmentData as $tmpAssessment)
        {
            $D1=0;
            $C1=0;
            $B1=0;
            $A1=0;
            if($tmpAssessment['Module100']['SectionOne']['TotalMarks']>2)
            {
                $D1=1;
            }
            if($D1)
            {
                if($tmpAssessment['Module100']['SectionTwo']['TotalMarks']>4 && $tmpAssessment['Module100']['SectionTwo']['TotalMarks']<=6)
                {
                    $C1=1;
                }

                if($tmpAssessment['Module100']['SectionTwo']['TotalMarks']>6)
                {
                    $B1=1;
                    $C1=1;
                }

                if($C1 || $B1)
                {
                    $tmpAssessThree=array();
                    foreach(json_decode($tmpAssessment['Module100']['SectionThree']['AssessmentStudentData']) as $tmpNumber)
                    {
                        if($tmpNumber==2)
                        {
                            $tmpAssessThree[]=2;
                        }
                    }
                    if($tmpAssessment['Module100']['SectionThree']['TotalMarks']>5 && count($tmpAssessThree)>=2)
                    {
                        $A1=1;
                    }
                }
            }

            $SaveData100=array();
            $SaveData100['StudentId']=$tmpAssessment['StudentData']['StudentId'];
            $SaveData100['ModuleNumber']=$tmpAssessment['Module100']['SectionOne']['ModuleNumber'];
            $SaveData100['UserId']=$tmpAssessment['StudentData']['UserId'];
            $SaveData100['DistrictId']=$tmpAssessment['StudentData']['DistrictId'];
            $SaveData100['VillageId']=$tmpAssessment['StudentData']['VillageId'];
            $SaveData100['SchoolId']=$tmpAssessment['StudentData']['SchoolId'];
            $SaveData100['Gender']=$tmpAssessment['StudentData']['Gender'];
            $SaveData100['Class']=$tmpAssessment['StudentData']['Class'];
            $SaveData100['A1']=$A1;
            $SaveData100['B1']=$B1;
            $SaveData100['C1']=$C1;
            $SaveData100['D1']=$D1;
            $SaveData100['DateCreated']=date('Y-m-d h:i:s');

//            echo '<pre>';
//            print_r($SaveData100);
//            echo '</pre>';

            $this->onlinemodel->StudentsScoringTwo($SaveData100);

        }




        foreach($AssessmentData as $tmpAssessment)
        {
            $D1=0;
            $C1=0;
            $B1=0;
            $A1=0;
            if($tmpAssessment['Module150']['SectionOne']['TotalMarks']>2)
            {
                $D1=1;
            }
            if($D1)
            {
                if($tmpAssessment['Module150']['SectionTwo']['TotalMarks']>4 && $tmpAssessment['Module150']['SectionTwo']['TotalMarks']<=6)
                {
                    $C1=1;
                }

                if($tmpAssessment['Module150']['SectionTwo']['TotalMarks']>6)
                {
                    $B1=1;
                    $C1=1;
                }

                if($C1 || $B1)
                {
                    $tmpAssessThree=array();
                    foreach(json_decode($tmpAssessment['Module150']['SectionThree']['AssessmentStudentData']) as $tmpNumber)
                    {
                        if($tmpNumber==2)
                        {
                            $tmpAssessThree[]=2;
                        }
                    }
                    if($tmpAssessment['Module150']['SectionThree']['TotalMarks']>5 && count($tmpAssessThree)>=2)
                    {
                        $A1=1;
                    }
                }
            }

            $SaveData150=array();
            $SaveData150['StudentId']=$tmpAssessment['StudentData']['StudentId'];
            $SaveData150['ModuleNumber']=$tmpAssessment['Module150']['SectionOne']['ModuleNumber'];
            $SaveData150['UserId']=$tmpAssessment['StudentData']['UserId'];
            $SaveData150['DistrictId']=$tmpAssessment['StudentData']['DistrictId'];
            $SaveData150['VillageId']=$tmpAssessment['StudentData']['VillageId'];
            $SaveData150['SchoolId']=$tmpAssessment['StudentData']['SchoolId'];
            $SaveData150['Gender']=$tmpAssessment['StudentData']['Gender'];
            $SaveData150['Class']=$tmpAssessment['StudentData']['Class'];
            $SaveData150['A1']=$A1;
            $SaveData150['B1']=$B1;
            $SaveData150['C1']=$C1;
            $SaveData150['D1']=$D1;
            $SaveData150['DateCreated']=date('Y-m-d h:i:s');

//            echo '<pre>';
//            print_r($SaveData150);
//            echo '</pre>';

            $this->onlinemodel->StudentsScoringTwo($SaveData150);

        }

        foreach($AssessmentData as $tmpAssessment)
        {
            $D1=0;
            $C1=0;
            $B1=0;
            $A1=0;
            if($tmpAssessment['Module200']['SectionOne']['TotalMarks']>2)
            {
                $D1=1;
            }
            if($D1)
            {
                if($tmpAssessment['Module200']['SectionTwo']['TotalMarks']>4 && $tmpAssessment['Module200']['SectionTwo']['TotalMarks']<=6)
                {
                    $C1=1;
                }

                if($tmpAssessment['Module200']['SectionTwo']['TotalMarks']>6)
                {
                    $B1=1;
                    $C1=1;
                }

                if($C1 || $B1)
                {
                    $tmpAssessThree=array();
                    foreach(json_decode($tmpAssessment['Module200']['SectionThree']['AssessmentStudentData']) as $tmpNumber)
                    {
                        if($tmpNumber==2)
                        {
                            $tmpAssessThree[]=2;
                        }
                    }
                    if($tmpAssessment['Module200']['SectionThree']['TotalMarks']>5 && count($tmpAssessThree)>=2)
                    {
                        $A1=1;
                    }
                }
            }

            $SaveData200=array();
            $SaveData200['StudentId']=$tmpAssessment['StudentData']['StudentId'];
            $SaveData200['ModuleNumber']=$tmpAssessment['Module200']['SectionOne']['ModuleNumber'];
            $SaveData200['UserId']=$tmpAssessment['StudentData']['UserId'];
            $SaveData200['DistrictId']=$tmpAssessment['StudentData']['DistrictId'];
            $SaveData200['VillageId']=$tmpAssessment['StudentData']['VillageId'];
            $SaveData200['SchoolId']=$tmpAssessment['StudentData']['SchoolId'];
            $SaveData200['Gender']=$tmpAssessment['StudentData']['Gender'];
            $SaveData200['Class']=$tmpAssessment['StudentData']['Class'];
            $SaveData200['A1']=$A1;
            $SaveData200['B1']=$B1;
            $SaveData200['C1']=$C1;
            $SaveData200['D1']=$D1;
            $SaveData200['DateCreated']=date('Y-m-d h:i:s');

//            echo '<pre>';
//            print_r($SaveData200);
//            echo '</pre>';

            $this->onlinemodel->StudentsScoringTwo($SaveData200);

        }
    }

    public function OnlineTrainingModuleOneToModuleTwo()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;

        $CompletedModule1Data = $this->onlinemodel->CompletedModule1Data();

//        echo count($CompletedModule1Data);
//        echo '<pre>';
//        print_r($CompletedModule1Data);
//        echo '</pre>';
//        die;
        $InsertData=array();
        foreach ($CompletedModule1Data as $tmpData)
        {
            $InsertData['SchoolId'] = $tmpData['SchoolId'];
            $InsertData['ModuleNumber'] = 150;
            $InsertData['StudentId'] = $tmpData['StudentId'];
            $InsertData['OwnerMobile'] = $tmpData['OwnerMobile'];
            $InsertData['MobileType'] = $tmpData['MobileType'];
            $InsertData['WhatsUpAvailable'] = $tmpData['WhatsUpAvailable'];
            $InsertData['EmailFamilyMember'] = $tmpData['EmailFamilyMember'];
            $InsertData['PhoneNumber'] = $tmpData['PhoneNumber'];
            $InsertData['StatusCalling'] = $tmpData['StatusCalling'];
            $InsertData['IsTransfered'] = $tmpData['Id'];
            $this->onlinemodel->InsertOnlineDataTraining2($tmpData['Id'],$InsertData);
        }

        //die;

    }

    public function OnlineTrainingModuleTwoToModuleThree()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;


        $CompletedModuleTwoData = $this->onlinemodel->CompletedModuleTwoData();

        $InsertData=array();
        foreach ($CompletedModuleTwoData as $tmpData)
        {
            $InsertData['SchoolId'] = $tmpData['SchoolId'];
            $InsertData['ModuleNumber'] = 200;
            $InsertData['StudentId'] = $tmpData['StudentId'];
            $InsertData['OwnerMobile'] = $tmpData['OwnerMobile'];
            $InsertData['MobileType'] = $tmpData['MobileType'];
            $InsertData['WhatsUpAvailable'] = $tmpData['WhatsUpAvailable'];
            $InsertData['EmailFamilyMember'] = $tmpData['EmailFamilyMember'];
            $InsertData['PhoneNumber'] = $tmpData['PhoneNumber'];
            $InsertData['StatusCalling'] = $tmpData['StatusCalling'];
            $InsertData['IsTransferedTwo'] = $tmpData['Id'];
            $this->onlinemodel->InsertOnlineDataTraining3($tmpData['Id'],$InsertData);
        }

        //die;

    }

    public function StudentReportCardCron()
    {
//        $SessionData=$this->session->userdata("loginUserData");
//        $UserId=$SessionData['Id'];
//        $data['SessionData'] = $SessionData;
//        $UserGroupId = $SessionData['UserGroupId'];
        $StudentData = $this->reportmodel->GetAllStudentData();
//        echo '<pre>';
//        print_r($StudentData);
//        echo '</pre>';
//        die;
        foreach($StudentData as $StudentId=>$tmpData)
        {
           	
		    $SaveData=array();
            $SaveData['StudentId']=$StudentId;
			$SaveData['CallStatus']=$tmpData['CallStatus'];
            $SaveData['StudentName']=$tmpData['Name'];
            $SaveData['Status']=1;
            $SaveData['ReportData']=json_encode($tmpData);
            $SaveData['DateCreated']=date('Y-m-d');
            $this->reportmodel->SaveStudentReportCard($StudentId,$SaveData);
        }
    }
	
	
	public function GenerateReportCardCSV()
	{
		$CSVData=array();
		$tmpCSV=array();
		
		
		$tmpCSV[]='District Name';
		$tmpCSV[]='School Name';
		$tmpCSV[]='Trainer Name';
		$tmpCSV[]='Student Name';
		$tmpCSV[]='Student Id';
		$tmpCSV[]='Contact';
		$tmpCSV[]='Alternative Contact';
		$tmpCSV[]='Module -I';
		$tmpCSV[]='Field Assessment Date';
		$tmpCSV[]='Grade of Assessment';
		$tmpCSV[]='Date Training Module 0-50';
		$tmpCSV[]='Date Training Module II';
		$tmpCSV[]='Date Training Module III';
		$tmpCSV[]='Date Training Module IV';
		$tmpCSV[]='Date Assessment-1';
		$tmpCSV[]='Grade Assessment-1';
		$tmpCSV[]='Date Assessment-2';
		$tmpCSV[]='Grade Assessment-2';
		$tmpCSV[]='Date Assessment-3';
		$tmpCSV[]='Grade Assessment-3';
		$tmpCSV[]='Call Status';
		$tmpCSV[]='Response';
		$tmpCSV[]='Who Answered';
		$CSVData[]=$tmpCSV;

		$StudentData=$this->reportmodel->GenerateReportCardCSV();
		
		foreach($StudentData as $tmpData)
		{
			$ReportData=json_decode($tmpData['ReportData'],true);
			
			if($ReportData['FieldAssessmentDate']=='30 Nov, -0001') $ReportData['FieldAssessmentDate']='';
			if($ReportData['DateTrainingModule50']=='30 Nov, -0001') $ReportData['DateTrainingModule50']='';
			if($ReportData['DateTrainingModuleII']=='30 Nov, -0001') $ReportData['DateTrainingModuleII']='';
			if($ReportData['DateTrainingModuleIII']=='30 Nov, -0001') $ReportData['DateTrainingModuleIII']='';
			if($ReportData['DateTrainingModuleIV']=='30 Nov, -0001') $ReportData['DateTrainingModuleIV']='';
			if($ReportData['DateAssessment1']=='30 Nov, -0001') $ReportData['DateAssessment1']='';
			if($ReportData['DateAssessment2']=='30 Nov, -0001') $ReportData['DateAssessment2']='';
			if($ReportData['DateAssessment3']=='30 Nov, -0001') $ReportData['DateAssessment3']='';
			
			
			$tmpCSV=array();
			$tmpCSV[]=$ReportData['DistrictName']; //'District Name';
			$tmpCSV[]=$ReportData['SchoolName']; //'School Name';
			$tmpCSV[]=$ReportData['TrainerName']; //'School Name';
			$tmpCSV[]=$ReportData['Name']; //'Student Name';
			$tmpCSV[]=$ReportData['Id']; //'Student Id';
			$tmpCSV[]=$ReportData['PhoneNo']; //'Contact';
			$tmpCSV[]=$ReportData['AltContactNumber']; //'Alternative Contact';
			$tmpCSV[]=$ReportData['ModuleOneCount']; //'Module -I';
			$tmpCSV[]=$ReportData['FieldAssessmentDate']; //'Field Assessment Date';
			$tmpCSV[]=$ReportData['GradeOfAssessment']; //'Grade of Assessment';
			$tmpCSV[]=$ReportData['DateTrainingModule50']; //'Date Training Module II';
			$tmpCSV[]=$ReportData['DateTrainingModuleII']; //'Date Training Module II';
			$tmpCSV[]=$ReportData['DateTrainingModuleIII']; //'Date Training Module III';
			$tmpCSV[]=$ReportData['DateTrainingModuleIV']; //'Date Training Module IV';
			$tmpCSV[]=$ReportData['DateAssessment1']; //'Date Assessment-1';
			$tmpCSV[]=$ReportData['GradeAssessment1']; //'Grade Assessment-1';
			$tmpCSV[]=$ReportData['DateAssessment2']; //'Date Assessment-2';
			$tmpCSV[]=$ReportData['GradeAssessment2']; //'Grade Assessment-2';
			$tmpCSV[]=$ReportData['DateAssessment3']; //'Date Assessment-3';
			$tmpCSV[]=$ReportData['GradeAssessment3']; //'Grade Assessment-3';
			$tmpCSV[]=$ReportData['CallStatus']; //'Call Status';
			$tmpCSV[]=$ReportData['Response']; //'Response';
			$tmpCSV[]=$ReportData['WhoAnswered']; //'Who Answered';
		
			$CSVData[]=$tmpCSV;
			
			
		}
		
		$fp = fopen('assets/ReportData/AllStudentReportCard.csv', 'w');
		foreach ($CSVData as $fields)
		{
			fputcsv($fp, $fields);
		}
		
		fclose($fp);


		
	}
	


}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */