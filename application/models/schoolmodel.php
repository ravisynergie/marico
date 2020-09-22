<?php
class schoolmodel extends CI_Model
{
	public function __construct() 
	{
		parent::__construct();
        $this->load->model('globalmodel');
	}
	
	public function SchoolListData($UserId)
	{
		$this->db->select('School.*,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
		$this->db->from('School')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left');
		//$this->db->where('School.UserId',$UserId);
		$this->db->group_by('School.Id');
		$this->db->order_by('School.Name');
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	public function SchoolManagerListDashboardData($Parameters,$SearchString)
	{
		$SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
		if($SessionData['UserGroupId']==5)
		{
			return $this->globalmodel->UserSchoolList($UserId);
		}
		
		if($Parameters['FilterTrainerId'])
		{
			return $this->globalmodel->UserSchoolList($Parameters['FilterTrainerId']);
		}

        if($SearchString['UserName'])
        {
            $SchoolData=$this->globalmodel->UserMappedSchoolList($SearchString['UserName']);
            $SchoolData=array_unique($SchoolData);
            $VillageData=array();

            $this->db->select('*');
            $this->db->from('School');
            $this->db->where("Id IN (".implode(',',$SchoolData).")");
            if($SearchString['SchoolName'])
            {
                $this->db->where("Name LIKE '%".$SearchString['SchoolName']."%'");
            }
            if($SearchString['VillageId'])
            {
                $this->db->where('VillageId',$SearchString['VillageId']);
            }
            $query = $this->db->get();
            foreach($query->result_array() as $tmpVillage)
            {
                $this->db->select('*');
                $this->db->from('Village');
                $this->db->where('Id',$tmpVillage['VillageId']);

                if($SearchString['DistrictId'])
                {
                    $this->db->where('DistrictId',$SearchString['DistrictId']);
                }
                if($SearchString['BlockId'])
                {
                    $this->db->where('BlockId',$SearchString['BlockId']);
                }
                $query = $this->db->get();
                //echo $this->db->last_query();
                foreach($query->result_array() as $tmpVill)
                {
                    $tmpVillage['VillageName']=$tmpVill['Name'];

                    $this->db->select('*');
                    $this->db->from('Block');
                    $this->db->where('Id',$tmpVill['BlockId']);
                    $query = $this->db->get();
                    $tmpData=$query->result_array();
                    $tmpVillage['BlockName']=$tmpData['0']['Name'];

                    $this->db->select('*');
                    $this->db->from('District');
                    $this->db->where('Id',$tmpVill['DistrictId']);
                    $query = $this->db->get();
                    $tmpData=$query->result_array();
                    $tmpVillage['DistrictName']=$tmpData['0']['Name'];


                    $VillageData[]=$tmpVillage;
                }

            }

            return $VillageData;
        }
		
		$this->db->select('School.*,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
		$this->db->from('School')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left');
		if($Parameters['DistrictId'])
		{
			$this->db->where('Village.DistrictId',$Parameters['DistrictId']);
		}
		if($Parameters['OrderById']==1)
		{
			$this->db->order_by('School.Id','DESC');
		}
		else
		{
			$this->db->order_by('School.Name');
		}
        if($Parameters['Limit'])
		{
			$this->db->limit($Parameters['Limit']);
		}

        if($SearchString['DistrictId'])
        {
            $this->db->where('Village.DistrictId',$SearchString['DistrictId']);
        }
        if($SearchString['BlockId'])
        {
            $this->db->where('Village.BlockId',$SearchString['BlockId']);
        }
        if($SearchString['VillageId'])
        {
            $this->db->where('School.VillageId',$SearchString['VillageId']);
        }
        if($SearchString['SchoolName'])
        {
            $this->db->where("School.Name LIKE '%".$SearchString['SchoolName']."%'");
        }

		$this->db->group_by('School.Id');
		$this->db->order_by('School.Name');
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	
	

    public function SchoolSearchListData($UserId,$DistId,$BlockId,$VillageId,$SchoolName)
    {
        $this->db->select('School.*,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
        $this->db->from('School')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId');
//        $this->db->where('School.UserId',$UserId);
        $this->db->where('District.Id',$DistId);
        $this->db->where('Block.Id',$BlockId);
        $this->db->where('School.VillageId',$VillageId);
        $this->db->like('School.Name', $SchoolName, 'both');
        $this->db->group_by('School.Id');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function SchoolListDashboardData($UserId)
    {
        $this->db->select('School.*,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
        $this->db->from('School')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId');
//        $this->db->where('School.UserId',$UserId);
        $this->db->group_by('School.Id');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function GetSchoolData($Id)
	{
		$this->db->select('*');
		$this->db->from('School');
		$this->db->where('Id',$Id);
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	
	public function GetStudenDataBySchoolId($Id)
	{
		$this->db->select('*');
		$this->db->from('Student');
		$this->db->where('SchoolId',$Id);
		$query = $this->db->get();
		return count($query->result_array());	
	}
	
	public function GetTrainingsDataBySchoolId($trainerId,$SchoolId)
	{
		$this->db->select('*');
		$this->db->from('Training');
		$this->db->where('SchoolId',$SchoolId);
		$this->db->where('UserId',$trainerId);
		$this->db->order_by('TrainingDate');
        $this->db->group_by('TrainingDate');
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	public function GetTrainingsCompletedDataBySchoolId($trainerId,$SchoolId)
	{
		$this->db->select('*');
		$this->db->from('Training');
		$this->db->where('SchoolId',$SchoolId);
		$this->db->where('UserId',$trainerId);
		$this->db->where('TrainingStatus','Completed');
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	
	public function GetTrainingDataByTrainer($trainerId)
	{
		$this->db->select('*');
		$this->db->from('Training');
		$this->db->where('UserId',$trainerId);
		$this->db->group_by('TrainingDate');
		$this->db->order_by('TrainingDate');
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	public function GetMeetingDataByTrainer($UserId)
    {
        $this->db->select('*');
        $this->db->from('Meeting');
        $this->db->where('UserId',$UserId);
		$this->db->group_by('MeetingDate');
		$this->db->order_by('MeetingDate');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	
	public function UpdateSchool($Id,$School)
	{
		$this->db->where('Id',$Id);
		$this->db->update('School',$School);		
	}
	
	public function CreateNewSchool($SaveData)
	{
		$this->db->insert('School',$SaveData);
		return $this->db->insert_id();
	}
	
	public function StudentsScoring($SaveData)
	{
		$this->db->where('StudentId',$SaveData['StudentId']);
		$this->db->delete('StudentsScoring');
		
		$this->db->insert('StudentsScoring',$SaveData);
		$this->db->insert_id();
		
		$this->db->where('StudentId',$SaveData['StudentId']);
		$this->db->update('AssessmentData',array('IsSynced'=>1));	
	}
	
	public function StudentsOnlineScoring($SaveData)
	{
		$this->db->where('StudentIdModuleNumber',$SaveData['StudentIdModuleNumber']);
		$this->db->delete('OnlineStudentsScoring');
		
		$this->db->insert('OnlineStudentsScoring',$SaveData);
		$this->db->insert_id();
		
		$this->db->where('StudentIdModuleNumber',$SaveData['StudentIdModuleNumber']);
		$this->db->update('OnlineAssessmentData',array('IsSynced'=>1));	
	}
	
	public function DeleteSchool($Id)
	{
		$this->db->where('Id', $Id);
		$this->db->delete('School');
	}
	
	public function ManageStudentsScoring()
	{
		$this->db->select('AssessmentData.*,School.Id as SchoolId,Village.Id as VillageId,Student.Gender,Student.Class');
        $this->db->from('AssessmentData')->join('Student', 'Student.Id = AssessmentData.StudentId')->join('School', 'School.Id = Student.SchoolId')->join('Village', 'School.VillageId = Village.Id');
        $this->db->where('IsSynced',0);
		$this->db->group_by('StudentId');
        $query = $this->db->get();
        $AssessmentData=array();
		foreach($query->result_array() as $tmpData)
		{
			$this->db->select('*');
			$this->db->from('AssessmentData');
			$this->db->where('StudentId',$tmpData['StudentId']);
			$this->db->where('AssessmentId',4);
			$query = $this->db->get();
			$SectionOne=$query->result_array();
			$SectionOne=$SectionOne['0'];
			
			$this->db->select('*');
			$this->db->from('AssessmentData');
			$this->db->where('StudentId',$tmpData['StudentId']);
			$this->db->where('AssessmentId',5);
			$query = $this->db->get();
			$SectionTwo=$query->result_array();
			$SectionTwo=$SectionTwo['0'];
			
			$this->db->select('*');
			$this->db->from('AssessmentData');
			$this->db->where('StudentId',$tmpData['StudentId']);
			$this->db->where('AssessmentId',6);
			$query = $this->db->get();
			$SectionThree=$query->result_array();
			$SectionThree=$SectionThree['0'];
			
			if(count($SectionThree) && count($SectionTwo) && count($SectionOne))
			{
				$AssessmentData[$tmpData['StudentId']]['StudentData']=$tmpData;
				$AssessmentData[$tmpData['StudentId']]['SectionOne']=$SectionOne;
				$AssessmentData[$tmpData['StudentId']]['SectionTwo']=$SectionTwo;
				$AssessmentData[$tmpData['StudentId']]['SectionThree']=$SectionThree;				
			}					
		}
		return $AssessmentData;
	}
	
	
	public function ManageStudentsOnlineScoring()
	{
		$this->db->query("update OnlineAssessmentData set StudentIdModuleNumber=concat(StudentId,ModuleNumber) where StudentIdModuleNumber=0");	
		
		$this->db->select('OnlineAssessmentData.*,School.Id as SchoolId,Village.Id as VillageId,Student.Gender,Student.Class');
        $this->db->from('OnlineAssessmentData')->join('Student', 'Student.Id = OnlineAssessmentData.StudentId')->join('School', 'School.Id = Student.SchoolId')->join('Village', 'School.VillageId = Village.Id');
        $this->db->where('IsSynced',0);
		 $this->db->where('ModuleNumber < ',200);
		$this->db->group_by('StudentIdModuleNumber');
        $query = $this->db->get();
        $AssessmentData=array();
		foreach($query->result_array() as $tmpData)
		{
			$this->db->select('*');
			$this->db->from('OnlineAssessmentData');
			$this->db->where('StudentId',$tmpData['StudentId']);
			$this->db->where('AssessmentId',4);
			$query = $this->db->get();
			$SectionOne=$query->result_array();
			$SectionOne=$SectionOne['0'];
			
			$this->db->select('*');
			$this->db->from('OnlineAssessmentData');
			$this->db->where('StudentId',$tmpData['StudentId']);
			$this->db->where('AssessmentId',5);
			$query = $this->db->get();
			$SectionTwo=$query->result_array();
			$SectionTwo=$SectionTwo['0'];
			
			$this->db->select('*');
			$this->db->from('OnlineAssessmentData');
			$this->db->where('StudentId',$tmpData['StudentId']);
			$this->db->where('AssessmentId',6);
			$query = $this->db->get();
			$SectionThree=$query->result_array();
			$SectionThree=$SectionThree['0'];
			
			if(count($SectionThree) && count($SectionTwo) && count($SectionOne))
			{
				$AssessmentData[$tmpData['StudentId']]['StudentData']=$tmpData;
				$AssessmentData[$tmpData['StudentId']]['SectionOne']=$SectionOne;
				$AssessmentData[$tmpData['StudentId']]['SectionTwo']=$SectionTwo;
				$AssessmentData[$tmpData['StudentId']]['SectionThree']=$SectionThree;				
			}					
		}
		return $AssessmentData;
	}
	
	
	
	public function ManageStudentsOnlineScoringAss2()
	{
		$this->db->query("update OnlineAssessmentData set StudentIdModuleNumber=concat(StudentId,ModuleNumber) where StudentIdModuleNumber=0");	
		
		$this->db->select('OnlineAssessmentData.*,School.Id as SchoolId,Village.Id as VillageId,Student.Gender,Student.Class');
        $this->db->from('OnlineAssessmentData')->join('Student', 'Student.Id = OnlineAssessmentData.StudentId')->join('School', 'School.Id = Student.SchoolId')->join('Village', 'School.VillageId = Village.Id');
        $this->db->where('IsSynced',0);
		 $this->db->where('ModuleNumber',200);
		$this->db->group_by('StudentIdModuleNumber');
        $query = $this->db->get();
        $AssessmentData=array();
		foreach($query->result_array() as $tmpData)
		{
			$this->db->select('*');
			$this->db->from('OnlineAssessmentData');
			$this->db->where('StudentId',$tmpData['StudentId']);
			$this->db->where('AssessmentId',7);
			$query = $this->db->get();
			$SectionOne=$query->result_array();
			$SectionOne=$SectionOne['0'];
			
			$this->db->select('*');
			$this->db->from('OnlineAssessmentData');
			$this->db->where('StudentId',$tmpData['StudentId']);
			$this->db->where('AssessmentId',8);
			$query = $this->db->get();
			$SectionTwo=$query->result_array();
			$SectionTwo=$SectionTwo['0'];
			
			$this->db->select('*');
			$this->db->from('OnlineAssessmentData');
			$this->db->where('StudentId',$tmpData['StudentId']);
			$this->db->where('AssessmentId',9);
			$query = $this->db->get();
			$SectionThree=$query->result_array();
			$SectionThree=$SectionThree['0'];
			
			if(count($SectionThree) && count($SectionTwo) && count($SectionOne))
			{
				$AssessmentData[$tmpData['StudentId']]['StudentData']=$tmpData;
				$AssessmentData[$tmpData['StudentId']]['SectionOne']=$SectionOne;
				$AssessmentData[$tmpData['StudentId']]['SectionTwo']=$SectionTwo;
				$AssessmentData[$tmpData['StudentId']]['SectionThree']=$SectionThree;				
			}					
		}
		return $AssessmentData;
	}
	
	
	
	public function StudentSectionOne($StudentId)
	{
		$this->db->select('*');
		$this->db->from('AssessmentData');
		$this->db->where('StudentId',$StudentId);
		$this->db->where('AssessmentId',4);
		$query = $this->db->get();
		$SectionOne=$query->result_array();
		return $SectionOne['0'];	
	}
	
	public function StudentSectionTwo($StudentId)
	{
		$this->db->select('*');
		$this->db->from('AssessmentData');
		$this->db->where('StudentId',$StudentId);
		$this->db->where('AssessmentId',5);
		$query = $this->db->get();
		$SectionOne=$query->result_array();
		return $SectionOne['0'];	
	}
	
	public function StudentSectionThree($StudentId)
	{
		$this->db->select('*');
		$this->db->from('AssessmentData');
		$this->db->where('StudentId',$StudentId);
		$this->db->where('AssessmentId',6);
		$query = $this->db->get();
		$SectionOne=$query->result_array();
		return $SectionOne['0'];	
	}

    public function GetTrainingBySchoolId($Id)
    {
        $this->db->select('*');
        $this->db->from('Training');
        $this->db->where('SchoolId',$Id);
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function GetTotalAssessment($Id){
        $this->db->select('*');
        $this->db->from('Student');
        $this->db->where('SchoolId',$Id);
        $query = $this->db->get();
        //return $query->result_array();
        $AssessmentSectionOne=array();
        foreach ($query->result_array() as $tmpData){
            $this->db->select('*');
            $this->db->from('AssessmentData');
            $this->db->where('StudentId',$tmpData['Id']);
            $this->db->where('AssessmentId',4);
            $queryT = $this->db->get();
            //count($query->result_array());
           // $tmpData['assess'][] = count($queryT->result_array());
            $AssessmentSectionOne[] = $queryT->result_array();
        }
        //return $AssessmentSectionOne;
        $assessmentcount = 0;
        foreach ($AssessmentSectionOne as $data){

            $assessmentcount+=count($data);
        }
        return $assessmentcount;

    }
    public function AssessmentCount($Id){
        $this->db->select('*');
        $this->db->from('AssessmentData');
        $this->db->where('StudentId',$Id);
        $this->db->where('AssessmentId',4);
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function GetTotalAssessmentA1($Id){
        $this->db->select('*');
        $this->db->from('StudentsScoring');
        $this->db->where('SchoolId',$Id);
        $this->db->where('A1',1);
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function GetTotalAssessmentB1($Id){
        $this->db->select('*');
        $this->db->from('StudentsScoring');
        $this->db->where('SchoolId',$Id);
        $this->db->where('B1',1);
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function GetTotalTrainedStudent($Id)
	{
        $this->db->select('*');
        $this->db->from('Training');
        $this->db->where('SchoolId',$Id);
        $this->db->where('Type','Training');
        $query = $this->db->get();
        $TrainingData=array();
        foreach ($query->result_array() as $tmpData)
		{
            $TrainingData[]=$tmpData['Id'];
		}
		
		$TraininedStudent=0;
		if(count($TrainingData))
		{
			$this->db->select('*');
			$this->db->from('Student');
			$this->db->where('SchoolId',$Id);
			$query = $this->db->get();
			foreach ($query->result_array() as $tmpData)
			{
			   $SelectQuery="select * from AttendanceData where TrainingId IN (".implode(',',$TrainingData).") and StudentData like '%\"".$tmpData['Id']."\"%'";
			   $QueryTmp=$this->db->query($SelectQuery);
			   if(count($QueryTmp->result_array()))
			   {
				   $TraininedStudent++;
				
			   }
			   
			}
		}
		return $TraininedStudent;
		//return $attendancecount;
    }
	
}
?>