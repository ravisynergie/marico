<?php
class studentmodel extends CI_Model
{
	public function __construct() 
	{
		parent::__construct();
	}

	public function DistrictStudentData($UserId)
	{
		$this->db->select('*');
		$this->db->from('District');
		$query = $this->db->get();
		
		$DistrctData=array();
		foreach($query->result_array() as $tmpDis)
		{
			$tmpData=array('DistrctName'=>$tmpDis['Name'],'DistrctId'=>$tmpDis['Id']);
			
			$this->db->select('School.*');
			$this->db->from('School')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left');
			$this->db->where('Village.DistrictId',$tmpDis['Id']);
			$query = $this->db->get();
			$tmpData['SchoolCount']=count($query->result_array());
			
			$this->db->select('Student.*');
			$this->db->from('Student')->join('School', 'Student.SchoolId = School.Id','Left')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left');
			$this->db->where('Village.DistrictId',$tmpDis['Id']);
			$this->db->group_by('Student.Id');
			$query = $this->db->get();
			$tmpData['StudentCount']=count($query->result_array());
		
		
			$DistrctData[]=$tmpData;
		}
		return $DistrctData;
	}
	
	public function DistrctStudentListData($Parameters)
	{
		$this->db->select('*');
		$this->db->from('District');
		$this->db->where('Id',$Parameters['DistrctId']);
		$query = $this->db->get();
		$DistrctData=array();
		//echo $this->db->last_query();
		foreach($query->result_array() as $tmpDis)
		{
			$this->db->select('Student.Id,Student.UserId,Student.Name,Student.Id,Student.Class,Student.Gender,School.Name as SchoolName,School.Id as SchoolId,District.Name as DistrictName,District.Id as DistrictId,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
			$this->db->from('Student')->join('School', 'Student.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId');
			$this->db->group_by('Student.Id');
			$this->db->where('Village.DistrictId',$tmpDis['Id']);
			$query = $this->db->get();
			foreach($query->result_array() as $tmpData)
			{
				$DistrctData[]=$tmpData;
			}
		}
		return $DistrctData;
	}

    public function DistrctSchoolListData($Parameters)
    {
        $this->db->select('*');
        $this->db->from('District');
        $this->db->where('Id',$Parameters['DistrctId']);
        $query = $this->db->get();
        $DistrctData=array();
        //echo $this->db->last_query();
        foreach($query->result_array() as $tmpDis)
        {
            $this->db->select('School.*,District.Name as DistrictName,District.Id as DistrictId,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
            $this->db->from('School')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left');
            $this->db->group_by('School.Id');
            $this->db->where('Village.DistrictId',$tmpDis['Id']);
            $query = $this->db->get();
            foreach($query->result_array() as $tmpData)
            {
                $DistrctData[]=$tmpData;
            }
        }
        return $DistrctData;
    }
	
	
	public function StudentListData($UserId)
	{
        $this->db->select('*');
		$this->db->from('District');
		$query = $this->db->get();
		
		$DistrctData=array();
		foreach($query->result_array() as $tmpDis)
		{
			$this->db->select('Student.*,School.Name as SchoolName,School.Id as SchoolId,District.Name as DistrictName,District.Id as DistrictId,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
			$this->db->from('Student')->join('School', 'Student.SchoolId = School.Id','Left')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left');
			$this->db->group_by('Student.Id');
			$this->db->where('Village.DistrictId',$tmpDis['Id']);
			$query = $this->db->get();
			//$this->db->limit(100);
			foreach($query->result_array() as $tmpData)
			{
				$DistrctData[]=$tmpData;
			}
		}
		
		return $DistrctData;
				
	}
	
	
	public function StudentManagerListData($Parameters,$SearchString)
	{
       
		$SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

//        $this->db->select('*');
//        $this->db->from('AttendanceData');
//        $Ivrquery = $this->db->get();
//        $AllIVR = $Ivrquery->result_array();
//
//        $IVR = array();
//        foreach ($AllIVR as $ivr){
//            $IVR[]=json_decode($ivr['NumberOfIVRCompleted'], true);
//        }

		if($SessionData['UserGroupId']==5)
		{
			return $this->globalmodel->UserStudentList($UserId);
		}
		
		if($Parameters['FilterTrainerId'])
		{
			return $this->globalmodel->UserStudentList($Parameters['FilterTrainerId']);
		}
		
		$this->db->select('*');
		$this->db->from('District');
		
		if($Parameters['DistrictId'])
		{
			$this->db->where('Id',$Parameters['DistrictId']);
		}



		$query = $this->db->get();
		$DistrctData=array();
		foreach($query->result_array() as $tmpDis)
		{
			$this->db->select('Student.*,School.Name as SchoolName,School.Id as SchoolId,District.Name as DistrictName,District.Id as DistrictId,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
			$this->db->from('Student')->join('School', 'Student.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId');
			$this->db->group_by('Student.Id');
			$this->db->where('Village.DistrictId',$tmpDis['Id']);
            $this->db->order_by('Student.Id','ASC');

            if($SearchString['DistrictId'])
            {
                $this->db->where('Village.DistrictId',$SearchString['DistrictId']);
            }
            if($SearchString['BlockId'])
            {
                $this->db->where('Village.BlockId',$SearchString['BlockId']);
            }
            if($SearchString['SchoolId'])
            {
                $this->db->where('Student.SchoolId',$SearchString['SchoolId']);
            }
            if($SearchString['StudentName'])
            {
                $this->db->where("Student.Name LIKE '%".$SearchString['StudentName']."%'");
            }

			$query = $this->db->get();

			foreach($query->result_array() as $tmpData)
			{
//                foreach ($IVR as $StudentIVR) {
//                    foreach ($StudentIVR as $key => $sivr) {
//                        if ($tmpData['Id'] == $key) {
//                            $tmpData['IVR'] = $sivr;
//                           break;
//                        }
//                    }
//                }
				$DistrctData[]=$tmpData;

			}


		}
		
		if($Parameters['Limit'])
		{
			$DistrctData=array_chunk($DistrctData,$Parameters['Limit']);
			$DistrctData=$DistrctData['0'];
		}



//        foreach ($DistrctData as $key=>$DisData) {
//            foreach ($IVR as $StudentIVR) {
//                foreach ($StudentIVR as $key => $sivr) {
//                    if ($DisData['Id'] == $key) {
//                        $DistrctData['IVR'] = $sivr;
//                        // $VillageData[] = $tmpVillage;
//                    }
//                }
//            }
//            //$DistrctData[$key]['IVR']=$tmpStudent;
//        }

//        echo "<pre>";
//        print_r($DistrctData);
//        echo "</pre>";

//        die;
		return $DistrctData;

        echo "<pre>";
        print_r($DistrctData);
        echo "</pre>";
        die;
				
	}
	

    public function StudentSearchListData($UserId,$DistId,$BlockId,$VillageId,$SchoolId,$StudentName)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserGroupId=$SessionData['UserGroupId'];
        $this->db->select('Student.*,School.Name as SchoolName,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
        $this->db->from('Student')->join('School', 'Student.SchoolId = School.Id','Left')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left');

        $this->db->where('District.Id',$DistId);
        $this->db->where('Block.Id',$BlockId);
        $this->db->where('Village.Id',$VillageId);
        $this->db->where('Student.SchoolId',$SchoolId);
        $this->db->like('Student.Name', $StudentName, 'both');

        $this->db->group_by('Student.Id');
        $query = $this->db->get();
        return $query->result_array();
    }

	public function GetStudentData($Id)
	{
		$this->db->select('*');
		$this->db->from('Student');
		$this->db->where('Id',$Id);
		$query = $this->db->get();
		return $query->result_array();
	}

    public function StudentSchoolWiseData($SchoolId)
    {
        $this->db->select('Student.*,School.Name as LocationName');
        $this->db->from('Student')->join('School', 'Student.SchoolId = School.Id');
        $this->db->where('Student.SchoolId',$SchoolId);
        $query = $this->db->get();
        return $query->result_array();
    }

	public function UpdateStudent($Id,$Student)
	{
		$this->db->where('Id',$Id);
		$this->db->update('Student',$Student);
	}

	public function CreateNewStudent($SaveData)
	{
		$this->db->insert('Student',$SaveData);
		return $this->db->insert_id();
	}
	
	public function DeleteStudent($Id)
	{
		$this->db->where('Id', $Id);
		$this->db->delete('Student');
	}



    public function StudentTrainingWiseData(){

        $this->db->select('Student.*,School.Name as SchoolName,School.Id as SchoolId,District.Name as DistrictName,District.Id as DistrictId,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
        $this->db->from('Student')->join('School', 'Student.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId');
        $this->db->group_by('Student.Id');
        //$this->db->limit(500);
        $query = $this->db->get();
       $StudentData=array();
	   
	   foreach($query->result_array() as $tmpData)
	   {
			$this->db->select('AttendanceData.*,Training.TrainingDate as TrainingDate,Users.FirstName,Users.LastName');
        	$this->db->from('AttendanceData')->join('Training', 'Training.Id = AttendanceData.TrainingId')->join('Users', 'Users.Id = Training.UserId');
			$this->db->where('(AttendanceData.StudentData LIKE "%'.$tmpData['Id'].'%")');
        	$query2 = $this->db->get();
			//echo "<br/><br/>".$this->db->last_query();
			$TrainDates=array();
			$TrainerName=array();
			foreach ($query2->result_array() as $TraingTmpData)
			{
				$JsonStudentData=json_decode($TraingTmpData['StudentData'],true);
				if(in_array($tmpData['Id'],$JsonStudentData))
				{
					$TrainDates[]=$TraingTmpData['TrainingDate'];
					$TrainerName[]=	$TraingTmpData['FirstName'].' '.$TraingTmpData['LastName'];;
				}
				
			}
			$tmpData['TrainingDate']=implode(',',$TrainDates);	
			$tmpData['TrainerName']=implode(',',$TrainerName);
			$StudentData[]=$tmpData;   
	   }
	   return $StudentData;
		
    }

    public function AttendenceStudentData(){

        $this->db->select('AttendanceData.*,Training.TrainingDate as TrainingDate');
        $this->db->from('AttendanceData')->join('Training', 'Training.Id = AttendanceData.TrainingId','Left');
        $query = $this->db->get();
        //return $query->result_array();

        $AttendanceData=array();
        foreach ($query->result_array() as $key=>$data){
            if(json_decode($data['StudentData']) != '') {
                $AttendanceData[$key]['student'] = json_decode($data['StudentData'], true);
               // $AttendanceData['trainingid'][] = $data['TrainingId'];
                $AttendanceData[$key]['trainingDate'] = $data['TrainingDate'];

            }
        }
        return $AttendanceData;

    }

    public function GetAllStudentData(){
        $this->db->select('Student.*,School.Name as SchoolName,School.Id as SchoolId,School.SpocName as SpocName, School.SpocContactNo as SpocContact, District.Name as DistrictName,District.Id as DistrictId,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
        $this->db->from('Student')->join('School', 'Student.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId');
        $this->db->group_by('Student.Id');
//        $this->db->limit(5000);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function GetIVRData($StudentId){
        $this->db->select('*');
        $this->db->from('StudentIVRData');
        $this->db->where('StudentId',$StudentId);
        $query = $this->db->get();
        return $query->result_array()[0]['IVRCompleted'];
    }

    public function GetAssessmentOne($StudentId){
        $this->db->select('*');
        $this->db->from('AssessmentData');
        $this->db->where('AssessmentId',4);
        $this->db->where('StudentId',$StudentId);
        $query = $this->db->get();

        if(count($query->result_array())==1){
            return 'Yes';
        }
        else{
            return 'No';
        }
    }

    public function GetAssessmentTwo($StudentId){
        $this->db->select('*');
        $this->db->from('AssessmentData');
        $this->db->where('AssessmentId',5);
        $this->db->where('StudentId',$StudentId);
        $query = $this->db->get();

        if(count($query->result_array())==1){
            return 'Yes';
        }
        else{
            return 'No';
        }
    }

    public function GetAssessmentThree($StudentId){
        $this->db->select('*');
        $this->db->from('AssessmentData');
        $this->db->where('AssessmentId',6);
        $this->db->where('StudentId',$StudentId);
        $query = $this->db->get();

        if(count($query->result_array())==1){
            return 'Yes';
        }
        else{
            return 'No';
        }
    }

    public function GetTrainerName($UserId){
        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where('Id',$UserId);
        $query = $this->db->get();
        return $query->result_array()[0]['FirstName'].' '.$query->result_array()[0]['LastName'];
    }

    public function GetA1Student(){
        $this->db->select('StudentsScoring.*,Student.Id as StudentId, Student.Name as StudentName, Student.Class as StudentClass, Student.Gender as StudentGender, Student.Age as StudentAge, Student.GuardianName as StudentGuardianName, Student.PhoneNo as StudentPhoneNo,  School.Name as SchoolName,School.Id as SchoolId,School.SpocName as SpocName, School.SpocContactNo as SpocContact, District.Name as DistrictName,District.Id as DistrictId,Village.Name as VillageName,Village.GramPanchayat');
        $this->db->from('StudentsScoring')->join('Student', 'StudentsScoring.StudentId = Student.Id')->join('School', 'StudentsScoring.SchoolId = School.Id')->join('Village', 'StudentsScoring.VillageId = Village.Id')->join('District', 'District.Id = StudentsScoring.DistrictId');
        $this->db->where('A1',1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetWrongIVR(){
        $this->db->select('StudentIVRData.*,Student.Name as StudentName,District.Name as DistrictName,Users.FirstName as TrainerFirstName,Users.LastName as TrainerLastName, School.Name as SchoolName');
        $this->db->from('StudentIVRData')->join('Student', 'StudentIVRData.StudentId = Student.Id')->join('School', 'Student.SchoolId = School.Id')->join('District', 'District.Id = StudentIVRData.DistrictId')->join('Users', 'Users.Id = StudentIVRData.UserId');
        $this->db->order_by('StudentIVRData.IVRCompleted','DESC');
        $this->db->limit(15);
        $query = $this->db->get();
        return $query->result_array();
    }

}
?>