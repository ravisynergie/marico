<?php
class onlinemodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function TrainnerSchoolData($UserId,$SessionData,$FilterData)
    {
        if($SessionData['UserGroupId'] == 5) 
		{
            $this->db->select('Mapping.*,School.Name as SchoolName,Village.Name as VillageName,District.Name as DistrictName');
            $this->db->from('Mapping')->join('School', 'Mapping.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId');
            $this->db->where('Mapping.UserId', $UserId);
            $query = $this->db->get();
            //return $query->result_array();
            $TrainerSchool = array();
            foreach ($query->result_array() as $tmpData) 
			{
                $tmpData['StudentCount'] = $this->StudentCount($tmpData['SchoolId']);
                $tmpData['TrainingSchedule'] = $this->TrainingScheduleOnline($tmpData['SchoolId']);
                $tmpData['TrainingSchedule50'] = $this->TrainingScheduleOnline50($tmpData['SchoolId']);
                $tmpData['TrainingSchedule100'] = $this->TrainingScheduleOnline100($tmpData['SchoolId']);
                $tmpData['TrainingSchedule150'] = $this->TrainingScheduleOnline150($tmpData['SchoolId']);
                $tmpData['TrainingSchedule200'] = $this->TrainingScheduleOnline200($tmpData['SchoolId']);
                $tmpData['TrainingCompleted'] = $this->TrainingCompletedOnline($tmpData['SchoolId']);
                $TrainerSchool[] = $tmpData;
            }
            return $TrainerSchool;
        }
		
		if($SessionData['UserGroupId'] == 3) 
		{
            $this->db->select('School.*,Village.Name as VillageName,District.Name as DistrictName');
            $this->db->from('School')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Mapping', 'Mapping.SchoolId = School.Id');
            if($FilterData['UserName']) 
			{
                 $this->db->where('Mapping.UserId', $FilterData['UserName']);
            }
            $query = $this->db->get();
            $TrainerSchool = array();
            foreach ($query->result_array() as $tmpData) 
			{
                $tmpData['StudentCount'] = $this->StudentCount($tmpData['Id']);
                $tmpData['TrainingSchedule'] = $this->TrainingScheduleOnline($tmpData['Id']);
                $tmpData['TrainingSchedule50'] = $this->TrainingScheduleOnline50($tmpData['Id']);
                $tmpData['TrainingSchedule100'] = $this->TrainingScheduleOnline100($tmpData['Id']);
                $tmpData['TrainingSchedule150'] = $this->TrainingScheduleOnline150($tmpData['Id']);
                $tmpData['TrainingSchedule200'] = $this->TrainingScheduleOnline200($tmpData['Id']);
                $tmpData['TrainingCompleted'] = $this->TrainingCompletedOnline($tmpData['Id']);
                $TrainerSchool[] = $tmpData;
            }
            return $TrainerSchool;
        }

    }

    public function StudentCount($SchoolId){
        $this->db->select('*');
        $this->db->from('Student');
        $this->db->where('SchoolId',$SchoolId);
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function TrainingCompletedOnline($SchoolId){
        $this->db->select('*');
        $this->db->from('ModuleTraining');
        $this->db->where('SchoolId',$SchoolId);
        $this->db->like('TrainingDate','20');
        $query = $this->db->get();
        $UploadedDocument=array();
        foreach($query->result_array() as $tmpData)
        {
            if($tmpData['TrainingTime'])
            {
                $UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TrainingDate']][$tmpData['TrainingTime']]['ImageOnePath']=$tmpData['ImageOnePath'];
                $UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TrainingDate']][$tmpData['TrainingTime']]['ImageTwoPath']=$tmpData['ImageTwoPath'];
//                $UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TrainingDate']][$tmpData['TrainingTime']]['UserName']=$tmpData['FirstName'].' '.$tmpData['LastName'];
                $UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TrainingDate']][$tmpData['TrainingTime']]['WhatsAppCall']=$tmpData['WhatsAppCall'];
            }
        }
        //return $UploadedDocument;

        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('SchoolId',$SchoolId);
        $this->db->like('TraingDate','20');
        $query = $this->db->get();
        //echo $this->db->last_query();

        $OnlineTrainingComplete=array();
        foreach($query->result_array() as $tmpData)
        {
            if($UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TraingDate']][$tmpData['TrainingTime']])
            {
                $tmpData['UploadDoc']=$UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TraingDate']][$tmpData['TrainingTime']];
            }
            $OnlineTrainingComplete[]=$tmpData;
        }

        return $OnlineTrainingComplete;
    }

    public function TrainingScheduleOnline($SchoolId){
        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('SchoolId',$SchoolId);
        $this->db->like('TraingDate','20');
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function TrainingScheduleOnline50($SchoolId){
        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('SchoolId',$SchoolId);
        $this->db->where('ModuleNumber',50);
        $this->db->like('TraingDate','20');
        $query = $this->db->get();
        return count($query->result_array());
    }
    
    public function TrainingScheduleOnline100($SchoolId){
        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('SchoolId',$SchoolId);
        $this->db->where('ModuleNumber',100);
        $this->db->like('TraingDate','20');
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function TrainingScheduleOnline150($SchoolId){
        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('SchoolId',$SchoolId);
        $this->db->where('ModuleNumber',150);
        $this->db->like('TraingDate','20');
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function TrainingScheduleOnline200($SchoolId){
        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('SchoolId',$SchoolId);
        $this->db->where('ModuleNumber',200);
        $this->db->like('TraingDate','20');
        $query = $this->db->get();
        return count($query->result_array());
    }

    public function TrainnerSchoolOnlyStudentData($SchoolId)
    {
        $this->db->select('Student.*,School.Name as SchoolName');
        $this->db->from('Student')->join('School','Student.SchoolId = School.Id');
        $this->db->where('Student.SchoolId',$SchoolId);
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function TrainnerSchoolStudentData($SchoolId,$FilterData,$ModuleNumber)
    {
        $this->db->select('Student.*,School.Name as SchoolName,OnlineTrainings.PhoneNumber,OnlineTrainings.StudentId,OnlineTrainings.OwnerMobile,OnlineTrainings.MobileType,OnlineTrainings.WhatsUpAvailable,OnlineTrainings.EmailFamilyMember,OnlineTrainings.StatusCalling,OnlineTrainings.TraingDate,OnlineTrainings.TrainingTime,OnlineTrainings.Remarks,OnlineTrainings.ModuleNumber');
        $this->db->from('Student')->join('School','Student.SchoolId = School.Id')->join('OnlineTrainings','OnlineTrainings.StudentId = Student.Id');
        $this->db->where('Student.SchoolId',$SchoolId);
        if($FilterData['SearchField']) $this->db->like('Student.Name',$FilterData['SearchField']);
        if($FilterData['Status']) $this->db->where('OnlineTrainings.StatusCalling',$FilterData['Status']);
		$this->db->where('OnlineTrainings.ModuleNumber',$ModuleNumber);
		$this->db->order_by('Student.Class','ASC');
        //echo $this->db->last_query();
        $query = $this->db->get();

        return $query->result_array();
    }

    public function TrainnerSchoolStudentDataTraining2($SchoolId,$FilterData,$ModuleNumber)
    {
        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('SchoolId',$SchoolId);
        $this->db->where('ModuleNumber',100);
        $this->db->like('TraingDate','20');
        $query = $this->db->get();
       // return $query->result_array();

        $StudentData=array();
        foreach ($query->result_array() as $data){
            $this->db->select('Student.*,School.Name as SchoolName,OnlineTrainings.PhoneNumber,OnlineTrainings.StudentId,OnlineTrainings.OwnerMobile,OnlineTrainings.MobileType,OnlineTrainings.WhatsUpAvailable,OnlineTrainings.EmailFamilyMember,OnlineTrainings.StatusCalling,OnlineTrainings.TraingDate,OnlineTrainings.TrainingTime,OnlineTrainings.Remarks');
            $this->db->from('Student')->join('School','Student.SchoolId = School.Id')->join('OnlineTrainings','OnlineTrainings.StudentId = Student.Id');
            $this->db->where('Student.SchoolId',$SchoolId);
            $this->db->where('Student.Id',$data['StudentId']);
            if($FilterData['SearchField']) $this->db->like('Student.Name',$FilterData['SearchField']);
            if($FilterData['Status']) $this->db->where('OnlineTrainings.StatusCalling',$FilterData['Status']);
            $this->db->like('OnlineTrainings.ModuleNumber',$ModuleNumber);
            $this->db->order_by('Student.Class','ASC');
            $query = $this->db->get();
            $StudentData[] = $query->result_array()[0];
        }
        return $StudentData;

    }

    public function TrainnerSchoolStudentDataTraining3($SchoolId,$FilterData,$ModuleNumber)
    {
        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('SchoolId',$SchoolId);
        $this->db->where('ModuleNumber',150);
        $this->db->like('TraingDate','20');
        $query = $this->db->get();
        // return $query->result_array();

        $StudentData=array();
        foreach ($query->result_array() as $data){
            $this->db->select('Student.*,School.Name as SchoolName,OnlineTrainings.PhoneNumber,OnlineTrainings.StudentId,OnlineTrainings.OwnerMobile,OnlineTrainings.MobileType,OnlineTrainings.WhatsUpAvailable,OnlineTrainings.EmailFamilyMember,OnlineTrainings.StatusCalling,OnlineTrainings.TraingDate,OnlineTrainings.TrainingTime,OnlineTrainings.Remarks');
            $this->db->from('Student')->join('School','Student.SchoolId = School.Id')->join('OnlineTrainings','OnlineTrainings.StudentId = Student.Id');
            $this->db->where('Student.SchoolId',$SchoolId);
            $this->db->where('Student.Id',$data['StudentId']);
            if($FilterData['SearchField']) $this->db->like('Student.Name',$FilterData['SearchField']);
            if($FilterData['Status']) $this->db->where('OnlineTrainings.StatusCalling',$FilterData['Status']);
            $this->db->like('OnlineTrainings.ModuleNumber',$ModuleNumber);
            $this->db->order_by('Student.Class','ASC');
            $query = $this->db->get();
            $StudentData[] = $query->result_array()[0];
        }
        return $StudentData;

    }
	
	public function TrainnerSchoolStudentDataById($StudentId,$ModuleNumber)
    {
        $this->db->select('Student.*,School.Name as SchoolName,OnlineTrainings.PhoneNumber,OnlineTrainings.StudentId,OnlineTrainings.OwnerMobile,OnlineTrainings.MobileType,OnlineTrainings.WhatsUpAvailable,OnlineTrainings.EmailFamilyMember,OnlineTrainings.StatusCalling,OnlineTrainings.TraingDate,OnlineTrainings.TrainingTime,OnlineTrainings.Remarks');
        $this->db->from('Student')->join('School','Student.SchoolId = School.Id')->join('OnlineTrainings','OnlineTrainings.StudentId = Student.Id');
        $this->db->where('Student.Id',$StudentId);
		$this->db->like('OnlineTrainings.ModuleNumber',$ModuleNumber);
		$this->db->order_by('Student.Name','ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	
	public function OnlineDataTraingData($StudentId,$ModuleNumber)
	{
		$this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('StudentId',$StudentId);
		$this->db->where('ModuleNumber',$ModuleNumber);
        $query = $this->db->get();
        return $query->result_array();
	}
	
	public function UpdateOnlineData($StudentId,$ModuleNumber,$InsertData)
	{
		$this->db->where('StudentId',$StudentId);
		$this->db->where('ModuleNumber',$ModuleNumber);
		$this->db->update('OnlineTrainings',$InsertData);	
	}

    public function UpdateOnlineAssessmentData($StudentId,$SchoolId,$TrainingDate,$ModuleNumber,$InsertData)
    {
        $this->db->where('SchoolId',$SchoolId);
        $this->db->where('StudentId',$StudentId);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $this->db->where('TraingDate',$TrainingDate);
        $this->db->update('OnlineTrainings',$InsertData);
    }
	
    public function InsertOnlineData($studentId,$ModuleNumber,$InsertData){

        $this->db->select('*');
        $this->db->from('OnlineTrainings');
		$this->db->where('ModuleNumber',$ModuleNumber);
        $this->db->where('StudentId',$studentId);
        $query = $this->db->get();
        if(count($query->result_array())==0)
        {
            $this->db->insert('OnlineTrainings',$InsertData);
            return $this->db->insert_id();
        }

    }

    public function InsertImage($SaveData){
        $this->db->insert('ModuleTraining',$SaveData);
        return $this->db->insert_id();
    }
	
	public function CreateOnlineTrainingLog($InsertData)
	{
		$this->db->insert('OnlineTrainingDailyLog',$InsertData);
        return $this->db->insert_id();
	}

    public function SaveAssessmentData($SaveData){
        $this->db->insert('OnlineAssessmentData',$SaveData);
        return $this->db->insert_id();
    }

    public function DeleteAssessment($Assessmentid,$Studentid,$ModuleNumber)
    {
//        $this->db->where('TrainingId',$Trainingid);
        $this->db->where('StudentId',$Studentid);
        $this->db->where('AssessmentId',$Assessmentid);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $this->db->delete('OnlineAssessmentData');
    }

    public function GetAssessmentData($Assessmentid,$Studentid,$ModuleNumber)
    {
        $this->db->select('*');
        $this->db->from('OnlineAssessmentData');
        $this->db->where('StudentId',$Studentid);
        $this->db->where('AssessmentId',$Assessmentid);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function ModuleTrainingData($SchoolId,$TrainingDate){
        $this->db->select('*');
        $this->db->from('ModuleTraining');
        $this->db->where('SchoolId',$SchoolId);
        $this->db->where('TrainingDate',$TrainingDate);
        $query = $this->db->get();
        return $query->result_array()[0];
    }
	
	public function TrainingUploadedDocument($SchoolId)
	{
		$this->db->select('*');
        $this->db->from('ModuleTraining');
        $this->db->where('SchoolId',$SchoolId);
        $query = $this->db->get();
        
		$UploadedDocument=array();
		foreach($query->result_array() as $tmpData)
		{
			$UploadedDocument[$tmpData['ModuleNumber']][$tmpData['TrainingDate']][$tmpData['TrainingTime']]['ImageOnePath']=$tmpData['ImageOnePath'];
			$UploadedDocument[$tmpData['ModuleNumber']][$tmpData['TrainingDate']][$tmpData['TrainingTime']]['ImageTwoPath']=$tmpData['ImageTwoPath'];
			$UploadedDocument[$tmpData['ModuleNumber']][$tmpData['TrainingDate']][$tmpData['TrainingTime']]['WhatsAppCall']=$tmpData['WhatsAppCall'];
		}
		return $UploadedDocument;
	}
	
	
    public function TrainingScheduledDataById($SchoolId)
	{

        $this->db->select('OnlineTrainings.*,Student.Name as StudentName,Student.Class as StudentClass, Student.Age as StudentAge');
        $this->db->from('OnlineTrainings')->join('Student', 'OnlineTrainings.StudentId = Student.Id');
        $this->db->where('OnlineTrainings.SchoolId',$SchoolId);
        $this->db->where('OnlineTrainings.TraingDate !=','0000-00-00');
        $this->db->order_by('OnlineTrainings.ModuleNumber');
		$this->db->order_by('OnlineTrainings.TraingDate', 'DESC');
		$this->db->order_by('OnlineTrainings.TrainingTime', 'ASC');
        $query = $this->db->get();
       
        $TrainingScheduled = array();
        foreach ($query->result_array() as $tmpData) 
		{
			$tmpData['SectionOne'] = $this->StudentSectionOne($tmpData['StudentId'],$tmpData['ModuleNumber']);
			$tmpData['SectionTwo'] = $this->StudentSectionTwo($tmpData['StudentId'],$tmpData['ModuleNumber']);
			$tmpData['SectionThree'] = $this->StudentSectionThree($tmpData['StudentId'],$tmpData['ModuleNumber']);
			$tmpData['SectionFour'] = $this->StudentSectionFour($tmpData['StudentId'],$tmpData['ModuleNumber']);
			$tmpData['SectionFive'] = $this->StudentSectionFive($tmpData['StudentId'],$tmpData['ModuleNumber']);
			$tmpData['SectionSix'] = $this->StudentSectionSix($tmpData['StudentId'],$tmpData['ModuleNumber']);
			$TrainingScheduled[$tmpData['TraingDate']][$tmpData['ModuleNumber']][] = $tmpData;
        }
        return $TrainingScheduled;
    }
	
	
	public function OnlineTrainingReport($SchoolId,$FilterSearch,$SessionData)
	{
		$this->db->select('ModuleTraining.*');
        $this->db->from('ModuleTraining');
        //$this->db->where('SchoolId',$SchoolId);
        $query = $this->db->get();
        $UploadedDocument=array();
		foreach($query->result_array() as $tmpData)
		{
			if($tmpData['TrainingTime'])
			{
				$UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TrainingDate']][$tmpData['TrainingTime']]['ImageOnePath']=$tmpData['ImageOnePath'];
				$UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TrainingDate']][$tmpData['TrainingTime']]['ImageTwoPath']=$tmpData['ImageTwoPath'];
				$UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TrainingDate']][$tmpData['TrainingTime']]['WhatsAppCall']=$tmpData['WhatsAppCall'];
			}
		}
		
		//echo "<pre>";
		//print_r($UploadedDocument);
		//echo "</pre>";


        $this->db->select('OnlineTrainings.*,Student.PhoneNo,Student.Name as StudentName,Student.Class as StudentClass, Student.Age as StudentAge,School.Name as SchoolName,District.Name as DistrictName,Users.Id as UserId,Users.FirstName,Users.LastName');

        if($SessionData['UserGroupId'] == 5)
        {
            $this->db->from('OnlineTrainings')->join('Student', 'OnlineTrainings.StudentId = Student.Id')->join('School', 'School.Id = Student.SchoolId')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Mapping', 'Mapping.SchoolId = School.Id')->join('Users', 'Mapping.UserId = Users.Id');
            $this->db->where('Mapping.UserId',$SessionData['Id']);
        }
        else {
            if ($FilterSearch['TrainerId']) {
                $this->db->from('OnlineTrainings')->join('Student', 'OnlineTrainings.StudentId = Student.Id')->join('School', 'School.Id = Student.SchoolId')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Mapping', 'Mapping.SchoolId = School.Id')->join('Users', 'Mapping.UserId = Users.Id');
                $this->db->where('Mapping.UserId', $FilterSearch['TrainerId']);
            } else {
                $this->db->from('OnlineTrainings')->join('Student', 'OnlineTrainings.StudentId = Student.Id')->join('School', 'School.Id = Student.SchoolId')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Mapping', 'Mapping.SchoolId = School.Id')->join('Users', 'Mapping.UserId = Users.Id');
            }
        }


        //$this->db->where('OnlineTrainings.SchoolId',$SchoolId);
        $this->db->where('OnlineTrainings.TraingDate !=','0000-00-00');
		//$this->db->where('OnlineTrainings.AssessmentDocument !=','');
        $this->db->order_by('District.Name');
        $query = $this->db->get();
       
        $TrainingScheduled = array();
        foreach ($query->result_array() as $tmpData) 
		{
			if(count($TrainingScheduled[$tmpData['StudentId']])==0)
			{
				$tmpData['UserName']=$tmpData['FirstName'].' '.$tmpData['LastName'];
				$TrainingScheduled[$tmpData['StudentId']]=$tmpData;
			}
			$tmpModule=array();
			$tmpModule['TraingDate']=$tmpData['TraingDate'];
			$tmpModule['TrainingTime']=$tmpData['TrainingTime'];
			$tmpModule['ModuleNumber']=$tmpData['ModuleNumber'];
			$tmpModule['UserName']=$UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TraingDate']][$tmpData['TrainingTime']]['UserName'];
			$tmpModule['WhatsAppCall']=$UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TraingDate']][$tmpData['TrainingTime']]['WhatsAppCall'];
			
			if($UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TraingDate']][$tmpData['TrainingTime']])
			{
				$TrainingScheduled[$tmpData['StudentId']]['Modules'][$tmpData['ModuleNumber']]=$tmpModule;
				//$TrainingScheduled[$tmpData['StudentId']]['UserId']=$UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TraingDate']][$tmpData['TrainingTime']]['UserId'];
			}
			
        }
        return $TrainingScheduled;
    }
	
	
	public function OnlineTrainingAssessmentReport($StudentId,$ModuleNumber)
	{
		$this->db->select('OnlineStudentsScoring.A1,OnlineStudentsScoring.B1,OnlineStudentsScoring.C1,OnlineStudentsScoring.D1,OnlineStudentsScoring.DateCreated,,Users.FirstName,Users.LastName');
        $this->db->from('OnlineStudentsScoring')->join('Users', 'OnlineStudentsScoring.UserId = Users.Id');;
        $this->db->where('StudentIdModuleNumber',$StudentId.$ModuleNumber);
        $query = $this->db->get();	
		return $query->result_array();
	}
	
	

    public function GetSchoolName($SchoolId){
        $this->db->select('*');
        $this->db->from('School');
        $this->db->where('Id',$SchoolId);
        $query = $this->db->get();
        return $query->result_array()[0];
    }

    public function TrainingScheduleData($FilterData){
        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('SchoolId',$FilterData['SchoolId']);
        $this->db->where('TraingDate',$FilterData['TrainingDate']);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function StudentSectionOne($StudentId,$ModuleNumber)
    {
        $this->db->select('*');
        $this->db->from('OnlineAssessmentData');
        $this->db->where('StudentId',$StudentId);
        $this->db->where('AssessmentId',4);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $query = $this->db->get();
        $SectionOne=$query->result_array();
        return $SectionOne['0'];
    }

    public function StudentSectionTwo($StudentId,$ModuleNumber)
    {
        $this->db->select('*');
        $this->db->from('OnlineAssessmentData');
        $this->db->where('StudentId',$StudentId);
        $this->db->where('AssessmentId',5);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $query = $this->db->get();
        $SectionOne=$query->result_array();
        return $SectionOne['0'];
    }

    public function StudentSectionThree($StudentId,$ModuleNumber)
    {
        $this->db->select('*');
        $this->db->from('OnlineAssessmentData');
        $this->db->where('StudentId',$StudentId);
        $this->db->where('AssessmentId',6);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $query = $this->db->get();
        $SectionOne=$query->result_array();
        return $SectionOne['0'];
    }

    public function StudentSectionFour($StudentId,$ModuleNumber)
    {
        $this->db->select('*');
        $this->db->from('OnlineAssessmentData');
        $this->db->where('StudentId',$StudentId);
        $this->db->where('AssessmentId',7);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $query = $this->db->get();
        $SectionOne=$query->result_array();
        return $SectionOne['0'];
    }

    public function StudentSectionFive($StudentId,$ModuleNumber)
    {
        $this->db->select('*');
        $this->db->from('OnlineAssessmentData');
        $this->db->where('StudentId',$StudentId);
        $this->db->where('AssessmentId',8);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $query = $this->db->get();
        $SectionOne=$query->result_array();
        return $SectionOne['0'];
    }

    public function StudentSectionSix($StudentId,$ModuleNumber)
    {
        $this->db->select('*');
        $this->db->from('OnlineAssessmentData');
        $this->db->where('StudentId',$StudentId);
        $this->db->where('AssessmentId',9);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $query = $this->db->get();
        $SectionOne=$query->result_array();
        return $SectionOne['0'];
    }




    public function TraingOneData($StudentId,$SchoolId,$ModuleNumber){
        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->like('TraingDate','20');
        $this->db->where('StudentId',$StudentId);
        $this->db->where('SchoolId',$SchoolId);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $this->db->group_by('StudentId');
        $query = $this->db->get();
       return $query->result_array();
    }
    public function TraingTwoData($StudentId,$SchoolId,$ModuleNumber){
        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->like('TraingDate','20');
        $this->db->where('StudentId',$StudentId);
        $this->db->where('SchoolId',$SchoolId);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $this->db->group_by('StudentId');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function TraingThreeData($StudentId,$SchoolId,$ModuleNumber){
        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->like('TraingDate','20');
        $this->db->where('StudentId',$StudentId);
        $this->db->where('SchoolId',$SchoolId);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $this->db->group_by('StudentId');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetTrainingTime($SchoolId,$TrainingDate,$ModuleNumber)
    {

        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('SchoolId', $SchoolId);
        $this->db->where('TraingDate', $TrainingDate);
        $this->db->where('ModuleNumber', $ModuleNumber);
        $query = $this->db->get();
        return $query->result_array();
       }

    public function StudentReport1(){

        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->like('TraingDate','20');
        $this->db->group_by('ModuleNumber');
        $query = $this->db->get();

        $StudentReport = array();
        foreach ($query->result_array() as $tmpData) {
            $this->db->select('OnlineTrainings.*,Student.Name as StudentName,Student.Class as StudentClass, Student.Age as StudentAge,School.Name as SchoolName,Village.Name as VillageName,District.Name as DistrictName');
            $this->db->from('OnlineTrainings')->join('Student', 'OnlineTrainings.StudentId = Student.Id')->join('School', 'Student.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId');
            $this->db->like('OnlineTrainings.TraingDate', '20');
            $this->db->where('OnlineTrainings.ModuleNumber', $tmpData['ModuleNumber']);
            $queryT = $this->db->get();
            $tmpArray = $queryT->result_array() ;
            $StudentReport[$tmpData['ModuleNumber']] = $tmpArray;
        }
        return $StudentReport;

    }

    public function StudentReport(){

        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('TraingDate !=','0000-00-00');
        $this->db->group_by('StudentId');
        $query = $this->db->get();
        //return $query->result_array();
        $StudentReport = array();
        foreach ($query->result_array() as $tmpData) {
            $this->db->select('OnlineTrainings.*,Student.Name as StudentName,Student.Class as StudentClass, Student.Age as StudentAge,School.Name as SchoolName,Village.Name as VillageName,District.Name as DistrictName');
            $this->db->from('OnlineTrainings')->join('Student', 'OnlineTrainings.StudentId = Student.Id')->join('School', 'Student.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId');
            $this->db->where('OnlineTrainings.TraingDate !=','0000-00-00');
            $this->db->where('OnlineTrainings.StudentId', $tmpData['StudentId']);
            $this->db->group_by('StudentId');
            $queryT = $this->db->get();
            //$tmpArray = $queryT->result_array() ;

            $tmpArray=array();
            foreach ($queryT->result_array() as $data){

                $data['TrainingOne'] = $this->TraingOneData($data['StudentId'],$data['SchoolId'],'100');
                $data['TrainingTwo'] = $this->TraingTwoData($data['StudentId'],$data['SchoolId'],'150');
                $data['TrainingThree'] = $this->TraingThreeData($data['StudentId'],$data['SchoolId'],'200');
                $data['TotalTrainingTime'] = (count($data['TrainingOne'])*60) + (count($data['TrainingTwo'])*60) + (count($data['TrainingThree'])*60);

                $data['AssessmentOne'] = $this->AssessmentOne($data['StudentId'],'100');
                $data['AssessmentTwo'] = $this->AssessmentOne($data['StudentId'],'150');
                $data['AssessmentThree'] = $this->AssessmentOne($data['StudentId'],'200');

                $tmpArray[]=$data;
            }

            $StudentReport[] = $tmpArray;
        }
        return $StudentReport;

    }

    public function AssessmentOne($StudentId,$ModuleNumber){
        $this->db->select('*');
        $this->db->from('StudentsScoringTwo');
        $this->db->where('StudentId',$StudentId);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $query = $this->db->get();
        //$query->result_array();
        $AssessmentOne = array();
        if($query->result_array()[0]['DateCreated']) {
            $AssessmentOne['Date'] = date('d-m-Y', strtotime($query->result_array()[0]['DateCreated']));
        }
        else{
            $AssessmentOne['Date']='';
        }

        if($query->result_array()[0]['A1'] == 1){
            $AssessmentOne['A1'] = 'Yes';
        }
        else{
            $AssessmentOne['A1'] = 'No';
        }

        if($query->result_array()[0]['B1'] == 1){
            $AssessmentOne['B1'] = 'Yes';
        }
        else{
            $AssessmentOne['B1'] = 'No';
        }

        if($query->result_array()[0]['C1'] == 1){
            $AssessmentOne['C1'] = 'Yes';
        }
        else{
            $AssessmentOne['C1'] = 'No';
        }

        if($query->result_array()[0]['D1'] == 1){
            $AssessmentOne['D1'] = 'Yes';
        }
        else{
            $AssessmentOne['D1'] = 'No';
        }
        return $AssessmentOne;
    }

    public function AssessmentTwo($StudentId,$ModuleNumber){
        $this->db->select('*');
        $this->db->from('StudentsScoringTwo');
        $this->db->where('StudentId',$StudentId);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $query = $this->db->get();
        //return $query->result_array();

        $AssessmentTwo = array();
        if($query->result_array()[0]['DateCreated']) {
            $AssessmentTwo['Date'] = date('d-m-Y', strtotime($query->result_array()[0]['DateCreated']));
        }
        else{
            $AssessmentTwo['Date']='';
        }

        if($query->result_array()[0]['A1'] == 1){
            $AssessmentTwo['A1'] = 'Yes';
        }
        else{
            $AssessmentTwo['A1'] = 'No';
        }

        if($query->result_array()[0]['B1'] == 1){
            $AssessmentTwo['B1'] = 'Yes';
        }
        else{
            $AssessmentTwo['B1'] = 'No';
        }

        if($query->result_array()[0]['C1'] == 1){
            $AssessmentTwo['C1'] = 'Yes';
        }
        else{
            $AssessmentTwo['C1'] = 'No';
        }

        if($query->result_array()[0]['D1'] == 1){
            $AssessmentTwo['D1'] = 'Yes';
        }
        else{
            $AssessmentTwo['D1'] = 'No';
        }
        return $AssessmentTwo;

    }

    public function AssessmentThree($StudentId,$ModuleNumber){
        $this->db->select('*');
        $this->db->from('StudentsScoringTwo');
        $this->db->where('StudentId',$StudentId);
        $this->db->where('ModuleNumber',$ModuleNumber);
        $query = $this->db->get();
        //return $query->result_array();

        $AssessmentThree = array();
        if($query->result_array()[0]['DateCreated']) {
            $AssessmentThree['Date'] = date('d-m-Y', strtotime($query->result_array()[0]['DateCreated']));
        }
        else{
            $AssessmentThree['Date']='';
        }

        if($query->result_array()[0]['A1'] == 1){
            $AssessmentThree['A1'] = 'Yes';
        }
        else{
            $AssessmentThree['A1'] = 'No';
        }

        if($query->result_array()[0]['B1'] == 1){
            $AssessmentThree['B1'] = 'Yes';
        }
        else{
            $AssessmentThree['B1'] = 'No';
        }

        if($query->result_array()[0]['C1'] == 1){
            $AssessmentThree['C1'] = 'Yes';
        }
        else{
            $AssessmentThree['C1'] = 'No';
        }

        if($query->result_array()[0]['D1'] == 1){
            $AssessmentThree['D1'] = 'Yes';
        }
        else{
            $AssessmentThree['D1'] = 'No';
        }
        return $AssessmentThree;
    }


    public function ManageStudentsScoringTwo()
    {
        $this->db->select('OnlineAssessmentData.*,School.Id as SchoolId,Village.Id as VillageId,Student.Gender,Student.Class,District.Id as DistrictId');
        $this->db->from('OnlineAssessmentData')->join('Student', 'Student.Id = OnlineAssessmentData.StudentId')->join('School', 'School.Id = Student.SchoolId')->join('Village', 'School.VillageId = Village.Id')->join('District', 'Village.DistrictId = District.Id');
        $this->db->where('IsSynced',0);
        $this->db->group_by('StudentId');
        //$this->db->group_by('ModuleNumber');
        $query = $this->db->get();
        //return $query->result_array();
        $AssessmentData=array();
        foreach($query->result_array() as $tmpData)
        {
            $this->db->select('*');
            $this->db->from('OnlineAssessmentData');
            $this->db->where('StudentId',$tmpData['StudentId']);
            $this->db->where('ModuleNumber','100');
            $this->db->where('AssessmentId',4);
            $query = $this->db->get();
            $Module100['SectionOne']=$query->result_array();
            $Module100['SectionOne']=$Module100['SectionOne'][0];

            $this->db->select('*');
            $this->db->from('OnlineAssessmentData');
            $this->db->where('StudentId',$tmpData['StudentId']);
            $this->db->where('ModuleNumber','100');
            $this->db->where('AssessmentId',5);
            $query = $this->db->get();
            $Module100['SectionTwo']=$query->result_array();
            $Module100['SectionTwo']=$Module100['SectionTwo'][0];

            $this->db->select('*');
            $this->db->from('OnlineAssessmentData');
            $this->db->where('StudentId',$tmpData['StudentId']);
            $this->db->where('ModuleNumber','100');
            $this->db->where('AssessmentId',6);
            $query = $this->db->get();
            $Module100['SectionThree']=$query->result_array();
            $Module100['SectionThree']=$Module100['SectionThree'][0];

            $this->db->select('*');
            $this->db->from('OnlineAssessmentData');
            $this->db->where('StudentId',$tmpData['StudentId']);
            $this->db->where('ModuleNumber','150');
            $this->db->where('AssessmentId',4);
            $query = $this->db->get();
            $Module150['SectionOne']=$query->result_array();
            $Module150['SectionOne']=$Module150['SectionOne'][0];

            $this->db->select('*');
            $this->db->from('OnlineAssessmentData');
            $this->db->where('StudentId',$tmpData['StudentId']);
            $this->db->where('ModuleNumber','150');
            $this->db->where('AssessmentId',5);
            $query = $this->db->get();
            $Module150['SectionTwo']=$query->result_array();
            $Module150['SectionTwo']=$Module150['SectionTwo'][0];

            $this->db->select('*');
            $this->db->from('OnlineAssessmentData');
            $this->db->where('StudentId',$tmpData['StudentId']);
            $this->db->where('ModuleNumber','150');
            $this->db->where('AssessmentId',6);
            $query = $this->db->get();
            $Module150['SectionThree']=$query->result_array();
            $Module150['SectionThree']=$Module150['SectionThree'][0];

            $this->db->select('*');
            $this->db->from('OnlineAssessmentData');
            $this->db->where('StudentId',$tmpData['StudentId']);
            $this->db->where('ModuleNumber','200');
            $this->db->where('AssessmentId',4);
            $query = $this->db->get();
            $Module200['SectionOne']=$query->result_array();
            $Module200['SectionOne']=$Module200['SectionOne'][0];

            $this->db->select('*');
            $this->db->from('OnlineAssessmentData');
            $this->db->where('StudentId',$tmpData['StudentId']);
            $this->db->where('ModuleNumber','200');
            $this->db->where('AssessmentId',5);
            $query = $this->db->get();
            $Module200['SectionTwo']=$query->result_array();
            $Module200['SectionTwo']=$Module200['SectionTwo'][0];

            $this->db->select('*');
            $this->db->from('OnlineAssessmentData');
            $this->db->where('StudentId',$tmpData['StudentId']);
            $this->db->where('ModuleNumber','200');
            $this->db->where('AssessmentId',6);
            $query = $this->db->get();
            $Module200['SectionThree']=$query->result_array();
            $Module200['SectionThree']=$Module200['SectionThree'][0];


            if(count($Module100['SectionOne']) && count($Module100['SectionTwo']) && count($Module100['SectionThree']) && count($Module150['SectionOne']) && count($Module150['SectionTwo']) && count($Module150['SectionThree']) && count($Module200['SectionOne']) && count($Module200['SectionTwo']) && count($Module200['SectionThree']) )
            {
                $AssessmentData[$tmpData['StudentId']]['StudentData']=$tmpData;
                $AssessmentData[$tmpData['StudentId']]['Module100']=$Module100;
                $AssessmentData[$tmpData['StudentId']]['Module150']=$Module150;
                $AssessmentData[$tmpData['StudentId']]['Module200']=$Module200;
            }
        }
        return $AssessmentData;
    }

    public function StudentsScoringTwo($SaveData)
    {
        $this->db->where('StudentId',$SaveData['StudentId']);
        $this->db->where('ModuleNumber',$SaveData['ModuleNumber']);
        $this->db->delete('StudentsScoringTwo');

        $this->db->insert('StudentsScoringTwo',$SaveData);
        $this->db->insert_id();

        $this->db->where('StudentId',$SaveData['StudentId']);
        $this->db->where('ModuleNumber',$SaveData['ModuleNumber']);
        $this->db->update('OnlineAssessmentData',array('IsSynced'=>1));
    }

    public function CompletedModule1Data(){

        $this->db->select('OnlineTrainings.*,ModuleTraining.ImageOnePath as Uploadfile1,ModuleTraining.ImageTwoPath as Uploadfile2');
        $this->db->from('OnlineTrainings')->join('ModuleTraining', 'ModuleTraining.TrainingDate = OnlineTrainings.TraingDate');
        $this->db->where('ModuleTraining.ImageOnePath !=','');
        $this->db->where('ModuleTraining.SchoolId = OnlineTrainings.SchoolId');
        $this->db->where('OnlineTrainings.ModuleNumber',100);
        $this->db->where('OnlineTrainings.IsTransfered',0);
        $this->db->where('ModuleTraining.ModuleNumber',100);
        $this->db->where('OnlineTrainings.TraingDate !=','0000-00-00');
        $this->db->group_by('OnlineTrainings.StudentId');
        $query = $this->db->get();
       // echo $this->db->last_query();

        return $query->result_array();


    }

    public function InsertOnlineDataTraining2($Id,$InsertData){

        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('IsTransfered',$Id);
        $query = $this->db->get();
        if(count($query->result_array())==0) 
		{
            $this->db->insert('OnlineTrainings',$InsertData);
            return $this->db->insert_id();
        }
    }

    public function InsertOnlineDataTraining3($Id,$InsertData){

        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('IsTransferedTwo',$Id);
        $query = $this->db->get();
        if(count($query->result_array())==0)
        {
            $this->db->insert('OnlineTrainings',$InsertData);
            return $this->db->insert_id();
        }
    }


    public function CompletedModuleTwoData(){

        $this->db->select('OnlineTrainings.*,ModuleTraining.ImageOnePath as Uploadfile1,ModuleTraining.ImageTwoPath as Uploadfile2');
        $this->db->from('OnlineTrainings')->join('ModuleTraining', 'ModuleTraining.TrainingDate = OnlineTrainings.TraingDate');
        $this->db->where('ModuleTraining.ImageOnePath !=','');
        $this->db->where('ModuleTraining.SchoolId = OnlineTrainings.SchoolId');
        $this->db->where('OnlineTrainings.ModuleNumber',150);
        $this->db->where('OnlineTrainings.IsTransferedTwo',0);
        $this->db->where('ModuleTraining.ModuleNumber',150);
        $this->db->where('OnlineTrainings.TraingDate !=','0000-00-00');
        $this->db->group_by('OnlineTrainings.StudentId');
        $query = $this->db->get();
        return $query->result_array();


    }

}
?>