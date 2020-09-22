<?php
class trainingmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('globalmodel');
    }

    public function TrainingListData($UserId)
    {
        $this->db->select('Training.*,School.Name as LocationName');
        $this->db->from('Training')->join('School', 'Training.SchoolId = School.Id');
        $this->db->where('Training.UserId',$UserId);
        $this->db->order_by('Training.TrainingDate','DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function TrainingManagerListData($Parameters)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
		if($SessionData['UserGroupId']==5)
		{
			return $this->globalmodel->UserTrainingList($UserId,$_GET);
		}
		
		if($Parameters['FilterTrainerId'])
		{
			return $this->globalmodel->UserTrainingList($Parameters['FilterTrainerId']);
		}

        if($Parameters['UserName'])
        {
            $SchoolData=$this->globalmodel->UserMappedSchoolList($Parameters['UserName']);
            $SchoolData=array_unique($SchoolData);

            $VillageData=array();
            $this->db->select('*');
            $this->db->from('Training');
            $this->db->where("SchoolId IN (".implode(',',$SchoolData).")");


            $query = $this->db->get();
            foreach($query->result_array() as $tmpVillage)
            {
                $this->db->select('*');
                $this->db->from('School');
                $this->db->where('Id',$tmpVillage['SchoolId']);

                $query = $this->db->get();
                foreach($query->result_array() as $tmpVill)
                {
                    $tmpVillage['SchoolName']=$tmpVill['Name'];
                    $tmpVillage['ModelSchool']=$tmpVill['ModelSchool'];

                    $this->db->select('*');
                    $this->db->from('Village');
                    $this->db->where('Id',$tmpVill['VillageId']);

                    $query = $this->db->get();
                    $tmpVData=$query->result_array();
                    $tmpVillage['VillageName']=$tmpVData['0']['Name'];

                    if($tmpVData['0']['Name'])
                    {
                        $this->db->select('*');
                        $this->db->from('Block');
                        $this->db->where('Id',$tmpVData['0']['BlockId']);
                        $query = $this->db->get();
                        $tmpData=$query->result_array();
                        $tmpVillage['BlockName']=$tmpData['0']['Name'];

                        $this->db->select('*');
                        $this->db->from('District');
                        $this->db->where('Id',$tmpVData['0']['DistrictId']);
                        $query = $this->db->get();
                        $tmpData=$query->result_array();
                        $tmpVillage['DistrictName']=$tmpData['0']['Name'];


                        $VillageData[]=$tmpVillage;
                    }
                }

            }

            return $VillageData;

        }


		$this->db->select('Training.*,School.Name as LocationName,School.Name as SchoolName,District.Name as DistrictName,District.Id as DistrictId,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat, Users.FirstName as FirstName');
        $this->db->from('Training')->join('School', 'Training.SchoolId = School.Id','Left')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left')->join('Users', 'Training.UserId = Users.Id','Left');
		
		if($Parameters['DistrictId'])
		{
			$this->db->where('District.Id',$Parameters['DistrictId']);
		}
		if($Parameters['BlockId'])
		{
			$this->db->where('Block.Id',$Parameters['BlockId']);
		}
        if($Parameters['VillageId'])
        {
            $this->db->where('Village.Id',$Parameters['VillageId']);
        }
		if($Parameters['SchoolId'])
		{
			$this->db->where('Training.SchoolId',$Parameters['SchoolId']);
		}
		if($Parameters['TrainingStatus'])
		{
			$this->db->where('Training.TrainingStatus',$Parameters['TrainingStatus']);
		}
		$this->db->order_by('Training.TrainingDate');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function TrainingListDashboardData($UserId)
    {
        $this->db->select('Training.*,School.Name as LocationName');
        $this->db->from('Training')->join('School', 'Training.SchoolId = School.Id');
        //$this->db->where('Training.UserId',$UserId);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetAttendanceData($Id)
    {
        $this->db->select('*');
        $this->db->from('AttendanceData');
        $this->db->where('TrainingId',$Id);
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function GetTrainingData($Id)
    {
        $this->db->select('*');
        $this->db->from('Training');
        $this->db->where('Id',$Id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetIVRData()
    {
        $this->db->select('*');
        $this->db->from('StudentIVRData');
       // $this->db->where('Id',$Id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetIVRDataDashboard($Parameters)
    {
        $this->db->select('*');
        $this->db->from('StudentIVRData');
        if($Parameters['FilterTrainerId'])
        {
            $this->db->where('UserId',$Parameters['FilterTrainerId']);
        }
        if($Parameters['DistrictId'])
        {
            $this->db->where('DistrictId',$Parameters['DistrictId']);
        }
        // $this->db->where('Id',$Id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetVolunteerData()
    {
        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where('UserGroupId',7);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function UpdateTraining($Id,$Student)
    {
        $this->db->where('Id',$Id);
        $this->db->update('Training',$Student);
    }

    public function CreateNewTraining($SaveData)
    {
        $this->db->insert('Training',$SaveData);
        return $this->db->insert_id();
    }
	
	public function SaveAttendanceData($SaveData)
    {
        $this->db->insert('AttendanceData',$SaveData);
        return $this->db->insert_id();
    }
	
	public function DeleteAttendance($Id)
    {
        $this->db->where('TrainingId', $Id);
        $this->db->delete('AttendanceData');
    }

    public function DeleteTraining($Id)
    {
        $this->db->where('Id', $Id);
        $this->db->delete('Training');
    }

    public function VolunteeringHourData($Parameters)
    {
        $this->db->select('Training.*,School.Name as LocationName,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
        $this->db->from('Training')->join('School', 'Training.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left');
        $this->db->where("Training.Volunteers !=","");
		if($Parameters['DistrictId'])
		{
			$this->db->where('Village.DistrictId',$Parameters['DistrictId']);
		}
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function TrainingHourData($Parameters)
    {
        $this->db->select('Training.*,School.Name as LocationName,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
        $this->db->from('Training')->join('School', 'Training.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left');
        if($Parameters['DistrictId'])
		{
			$this->db->where('Village.DistrictId',$Parameters['DistrictId']);
		}
		$query = $this->db->get();
		return $query->result_array();
    }

    public function TouchpointData($Parameters)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
		if($SessionData['UserGroupId']==5)
		{
			$SchoolData=$this->globalmodel->UserSchoolList($UserId);
		}
		else{
            $SchoolData=$this->schoolmodel->SchoolListData($UserId);
        }

		if($Parameters['FilterTrainerId'])
		{
			$SchoolData=$this->globalmodel->UserSchoolList($Parameters['FilterTrainerId']);
		}
		
		if(count($SchoolData))
		{
			$this->db->select('Training.*,School.Name as LocationName,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat,COUNT(*) as count, Users.FirstName as TrainerName');
			$this->db->from('Training')->join('School', 'Training.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left')->join('Users', 'Users.Id = Training.UserId','Left');
		   $this->db->group_by('Training.SchoolId');
			if($Parameters['DistrictId'])
			{
				$this->db->where('Village.DistrictId',$Parameters['DistrictId']);
			}
			
			if($SessionData['UserGroupId']==5 || $Parameters['FilterTrainerId'])
			{
				$tmpArray=array();
				foreach($SchoolData as $tmpData)
				{
					$tmpArray[]=$tmpData['Id'];
				}
				$this->db->where("Training.SchoolId IN (".implode(',',$tmpArray).")");
			}
			
			$this->db->order_by('Training.TrainingDate','ASC');
			$query = $this->db->get();
			return $query->result_array();
		}
		else
		{
			return array();
		}
    }
	
	public function TrainerProgressPopData($FilterData)
	{
		$this->db->select('Id,FirstName,LastName,Email,Phone,UserGroupId');
        $this->db->from('Users');
        $this->db->where('UserGroupId',5);
        $query = $this->db->get();

		$ReportData=array();
        foreach($query->result_array() as $tmpUser)
		{
			$DistrictData=$this->globalmodel->UserDistrictList($tmpUser['Id']);



			$tmpDis=array();
			foreach($DistrictData as $tmpSchool)
			{
				$tmpDis[]=$tmpSchool['Name'];
			}
			$tmpUser['District']=implode(', ',$tmpDis);

			$SchoolData=$this->globalmodel->UserSchoolList($tmpUser['Id']);

//            echo '<pre>';
//            print_r($SchoolData);
//            echo '</pre>';

			$tmpUser['SchoolCount']=count($SchoolData);
			$tmpUser['ModernSchoolCount']=0;
			foreach($SchoolData as $tmpSchool)
			{
				if($tmpSchool['ModelSchool']=='Yes')
				{
					$tmpUser['ModernSchoolCount']+=1;
				}
			}

			$StudentData=$this->globalmodel->UserStudentList($tmpUser['Id'],$_GET);
			$tmpUser['StudentCount']=count($StudentData);
			$tmpUser['ModernStudentCount']=0;
			foreach($StudentData as $tmpSchool)
			{
				if($tmpSchool['ModelSchool']=='Yes')
				{
					$tmpUser['ModernStudentCount']+=1;
				}
			}

			$TrainingData=$this->globalmodel->UserTrainingList($tmpUser['Id'],$_GET);
			$tmpUser['AvgModernTraining']=0;
			$tmpUser['AvgOtherTraining']=0;
			foreach($TrainingData as $tmpSchool)
			{
				if($tmpSchool['ModelSchool']=='Yes')
				{
					$tmpUser['AvgModernTraining']+=1;
				}
				else
				{
					$tmpUser['AvgOtherTraining']+=1;
				}
			}
			if($tmpUser['AvgModernTraining']>0)
			{
				$tmpUser['AvgModernTraining']=round($tmpUser['AvgModernTraining']/$tmpUser['ModernSchoolCount']);
			}

			if($tmpUser['AvgOtherTraining']>0)
			{
				$tmpUser['AvgOtherTraining']=round($tmpUser['AvgOtherTraining']/($tmpUser['SchoolCount']-$tmpUser['ModernSchoolCount']));
			}
			$ReportData[]=$tmpUser;

		}
		
		$SaveData=array('JsonData'=>json_encode($ReportData));
		$this->db->where('Id',1);
        $this->db->update('TrainnerProgress',$SaveData);
		
		return $ReportData;
	}
	
	public function TrainerProgressJsonData()
	{
		$this->db->select('*');
        $this->db->from('TrainnerProgress');
		$this->db->where('Id',1);
        $query = $this->db->get();
		$ReportData=array();
        return $query->result_array();
	}

    public function TrainingProgressTableData($FilterData)
    {
        $this->db->select('*');
        $this->db->from('TrainingProgress');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function TrainnerProgressTableData($FilterData)
    {
        $this->db->select('*');
        $this->db->from('TrainnerProgress');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	
	public function TrainingProgressPopData($FilterData)
	{
		$this->db->select('*');
        $this->db->from('District');
        $query = $this->db->get();
		$ReportData=array();
        foreach($query->result_array() as $tmpUser)
		{
			$FilterData=array();
			$FilterData['DistrictId']=$tmpUser['Id'];
			
			$SchoolData=$this->schoolmodel->SchoolManagerListDashboardData($FilterData);
			$tmpUser['SchoolCount']=count($SchoolData);
			$tmpUser['ModernSchoolCount']=0;
			foreach($SchoolData as $tmpSchool)
			{
				if($tmpSchool['ModelSchool']=='Yes')
				{
					$tmpUser['ModernSchoolCount']+=1;
				}
			}
			
			$StudentData=$this->studentmodel->StudentManagerListData($FilterData);
			$tmpUser['StudentCount']=count($StudentData);
			$tmpUser['ModernStudentCount']=0;
			foreach($StudentData as $tmpSchool)
			{
				if($tmpSchool['ModelSchool']=='Yes')
				{
					$tmpUser['ModernStudentCount']+=1;
				}
			}
			
			$TrainingData=$this->trainingmodel->TrainingManagerListData($FilterData);
			$tmpUser['AvgModernTraining']=0;
			$tmpUser['AvgOtherTraining']=0;
			foreach($TrainingData as $tmpSchool)
			{
				if($tmpSchool['ModelSchool']=='Yes')
				{
					$tmpUser['AvgModernTraining']+=1;
				}
				else
				{
					$tmpUser['AvgOtherTraining']+=1;
				}
			}
			if($tmpUser['AvgModernTraining']>0)
			{
				$tmpUser['AvgModernTraining']=round($tmpUser['AvgModernTraining']/$tmpUser['ModernSchoolCount']);
			}
			
			if($tmpUser['AvgOtherTraining']>0)
			{
				$tmpUser['AvgOtherTraining']=round($tmpUser['AvgOtherTraining']/($tmpUser['SchoolCount']-$tmpUser['ModernSchoolCount']));
			}
			
			$ReportData[]=$tmpUser;
		}
		return $ReportData;
	}
	
	public function IVRStudentData($Parameters)
    {
        $this->db->select('*');
        $this->db->from('AttendanceData');
        if($Parameters['FilterTrainerId']) {
            $this->db->where('UserId', $Parameters['FilterTrainerId']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function AllIVRStudentData()
    {
        $this->db->select('*');
        $this->db->from('AttendanceData');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetAttendanceDistrict($Id)
    {
        $this->db->select('*');
        $this->db->from('Training');
        $this->db->where('Id',$Id);
        $query = $this->db->get();
       // return $query->result_array();

        $VillageData = array();
        foreach ($query->result_array() as $schId){

            $this->db->select('*');
            $this->db->from('School');
            $this->db->where('Id',$schId['SchoolId']);
            $query = $this->db->get();
            $VillageData = $query->result_array();

        }

        $DistrictData = array();
        foreach ($VillageData as $vilId){
            $this->db->select('*');
            $this->db->from('Village');
            $this->db->where('Id',$vilId['VillageId']);
            $query = $this->db->get();
            return $DistrictData = $query->result_array();

        }

    }

}
?>