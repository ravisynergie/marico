<?php
class reportmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function StudentScoringDashboardData()
    {
        $this->db->select('*');
        $this->db->from('StudentsScoring');

        $query = $this->db->get();
        $AssessmentData = $query->result_array();


        return $AssessmentData;
    }

    public function StudentScoringProgressBarData($Id)
    {
        $this->db->select('*');
        $this->db->from('StudentsScoring');
        // $this->db->where('UserId',$Id);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function UserAssessmentData($SessionData,$Filter)
    {
        $this->db->select('*');
        $this->db->from('AssessmentData');
        $this->db->group_by('DateCreated');
        $this->db->order_by('DateCreated', 'DESC');
        $query = $this->db->get();

        $AssessmentData = array();
        foreach ($query->result_array() as $tmpData) {
            $this->db->select('*');
            $this->db->from('AssessmentData');
            $this->db->where('DateCreated', $tmpData['DateCreated']);
            if($Filter['UserName']){
                $this->db->where('AssessmentData.UserId', $Filter['UserName']);
            }
            if ($SessionData['UserGroupId'] == '5') {
                $this->db->where('UserId', $SessionData['Id']);
            }
            $this->db->group_by('UserId');
            $queryT = $this->db->get();
            foreach ($queryT->result_array() as $tmpUserData) {
                $tmpArray = array();

                $this->db->select('*');
                $this->db->from('Users');
                $this->db->where('Id', $tmpUserData['UserId']);
                $queryTmp = $this->db->get();
                $UserData = $queryTmp->result_array();
                $tmpArray['UserName'] = $UserData['0']['FirstName'] . ' ' . $UserData['0']['LastName'];


                $this->db->select('*');
                $this->db->from('AssessmentData');
                $this->db->where('DateCreated', $tmpData['DateCreated']);
                $this->db->where('UserId', $tmpUserData['UserId']);
                $this->db->where('AssessmentId', 4);
                $queryTmp = $this->db->get();
                $tmpArray['Assessment1Completed'] = count($queryTmp->result_array());

                $this->db->select('*');
                $this->db->from('AssessmentData');
                $this->db->where('DateCreated', $tmpData['DateCreated']);
                $this->db->where('UserId', $tmpUserData['UserId']);
                $this->db->where('AssessmentId', 5);
                $queryTmp = $this->db->get();
                $tmpArray['Assessment2Completed'] = count($queryTmp->result_array());

                $this->db->select('*');
                $this->db->from('AssessmentData');
                $this->db->where('DateCreated', $tmpData['DateCreated']);
                $this->db->where('UserId', $tmpUserData['UserId']);
                $this->db->where('AssessmentId', 6);
                $queryTmp = $this->db->get();
                $tmpArray['Assessment3Completed'] = count($queryTmp->result_array());


                $this->db->select('*');
                $this->db->from('AssessmentData');
                $this->db->where('DateCreated', $tmpData['DateCreated']);
                $this->db->where('UserId', $tmpUserData['UserId']);
                $this->db->where('AssessmentId', 4);
                $queryTmp = $this->db->get();
                foreach ($queryTmp->result_array() as $tmpStudentData) {
                    $this->db->select('*');
                    $this->db->from('AssessmentData');
                    $this->db->where('DateCreated', $tmpData['DateCreated']);
                    $this->db->where('UserId', $tmpUserData['UserId']);
                    $this->db->where('StudentId', $tmpStudentData['StudentId']);
                    $this->db->where('AssessmentId', 5);
                    $queryTmp = $this->db->get();

                    if (count($queryTmp->result_array())) {
                        $this->db->select('*');
                        $this->db->from('AssessmentData');
                        $this->db->where('DateCreated', $tmpData['DateCreated']);
                        $this->db->where('UserId', $tmpUserData['UserId']);
                        $this->db->where('StudentId', $tmpStudentData['StudentId']);
                        $this->db->where('AssessmentId', 6);
                        $queryTmp = $this->db->get();
                        if (count($queryTmp->result_array())) {
                            $tmpArray['AssessmentAllCompleted'] += 1;
                        }
                    }
                }


                $AssessmentData[$tmpData['DateCreated']][$tmpUserData['UserId']] = $tmpArray;

            }
        }
        return $AssessmentData;
    }

    public function UserOnlineAssessmentData($SessionData,$Filter)
    {
        $this->db->query("UPDATE OnlineAssessmentData OAD, OnlineTrainings OT SET OAD.DocumentPath=OT.AssessmentDocument WHERE OAD.StudentId = OT.StudentId and OAD.ModuleNumber=OT.ModuleNumber");
		
		
		$this->db->select('*');
        $this->db->from('OnlineAssessmentData');
        $this->db->group_by('DateCreated');
        $this->db->order_by('DateCreated', 'DESC');
        $query = $this->db->get();

        $AssessmentData = array();
        foreach ($query->result_array() as $tmpData) 
		{
            $this->db->select('*');
            $this->db->from('OnlineAssessmentData');
            $this->db->where('DateCreated', $tmpData['DateCreated']);
            if($Filter['UserName']){
                $this->db->where('OnlineAssessmentData.UserId', $Filter['UserName']);
            }
            if ($SessionData['UserGroupId'] == '5') {
                $this->db->where('UserId', $SessionData['Id']);
            }
            $this->db->group_by('UserId');
            $queryT = $this->db->get();
            foreach ($queryT->result_array() as $tmpUserData) {
                $tmpArray = array();

                $this->db->select('*');
                $this->db->from('Users');
                $this->db->where('Id', $tmpUserData['UserId']);
                $queryTmp = $this->db->get();
                $UserData = $queryTmp->result_array();
                $tmpArray['UserName'] = $UserData['0']['FirstName'] . ' ' . $UserData['0']['LastName'];


                $this->db->select('*');
                $this->db->from('OnlineAssessmentData');
                $this->db->where('DateCreated', $tmpData['DateCreated']);
                $this->db->where('UserId', $tmpUserData['UserId']);
                $this->db->where('AssessmentId', 4);
				$this->db->where('DocumentPath !=','');
                $queryTmp = $this->db->get();
                $tmpArray['Assessment1Completed'] = count($queryTmp->result_array());

                $this->db->select('*');
                $this->db->from('OnlineAssessmentData');
                $this->db->where('DateCreated', $tmpData['DateCreated']);
                $this->db->where('UserId', $tmpUserData['UserId']);
                $this->db->where('AssessmentId', 5);
				$this->db->where('DocumentPath !=','');
                $queryTmp = $this->db->get();
                $tmpArray['Assessment2Completed'] = count($queryTmp->result_array());

                $this->db->select('*');
                $this->db->from('OnlineAssessmentData');
                $this->db->where('DateCreated', $tmpData['DateCreated']);
                $this->db->where('UserId', $tmpUserData['UserId']);
                $this->db->where('AssessmentId', 6);
				$this->db->where('DocumentPath !=','');
                $queryTmp = $this->db->get();
                $tmpArray['Assessment3Completed'] = count($queryTmp->result_array());


                $this->db->select('*');
                $this->db->from('OnlineAssessmentData');
                $this->db->where('DateCreated', $tmpData['DateCreated']);
                $this->db->where('UserId', $tmpUserData['UserId']);
                $this->db->where('AssessmentId', 4);
				$this->db->where('DocumentPath !=','');
                $queryTmp = $this->db->get();
                foreach ($queryTmp->result_array() as $tmpStudentData) {
                    $this->db->select('*');
                    $this->db->from('OnlineAssessmentData');
                    $this->db->where('DateCreated', $tmpData['DateCreated']);
                    $this->db->where('UserId', $tmpUserData['UserId']);
                    $this->db->where('StudentId', $tmpStudentData['StudentId']);
					$this->db->where('DocumentPath !=','');
                    $this->db->where('AssessmentId', 5);
                    $queryTmp = $this->db->get();

                    if (count($queryTmp->result_array())) {
                        $this->db->select('*');
                        $this->db->from('OnlineAssessmentData');
                        $this->db->where('DateCreated', $tmpData['DateCreated']);
                        $this->db->where('UserId', $tmpUserData['UserId']);
                        $this->db->where('StudentId', $tmpStudentData['StudentId']);
                        $this->db->where('AssessmentId', 6);
						$this->db->where('DocumentPath !=','');
                        $queryTmp = $this->db->get();
                        if (count($queryTmp->result_array())) {
                            $tmpArray['AssessmentAllCompleted'] += 1;
                        }
                    }
                }


                $AssessmentData[$tmpData['DateCreated']][$tmpUserData['UserId']] = $tmpArray;

            }
        }
        return $AssessmentData;
    }


    public function UserOnlineAssessmentTwoData($SessionData,$Filter)
    {
        $this->db->query("UPDATE OnlineAssessmentData OAD, OnlineTrainings OT SET OAD.DocumentPath=OT.AssessmentDocument WHERE OAD.StudentId = OT.StudentId and OAD.ModuleNumber=OT.ModuleNumber");


        $this->db->select('*');
        $this->db->from('OnlineAssessmentData');
        $this->db->group_by('DateCreated');
        $this->db->order_by('DateCreated', 'DESC');
        $query = $this->db->get();

        $AssessmentData = array();
        foreach ($query->result_array() as $tmpData)
        {
            $this->db->select('*');
            $this->db->from('OnlineAssessmentData');
            $this->db->where('DateCreated', $tmpData['DateCreated']);
            if($Filter['UserName']){
                $this->db->where('OnlineAssessmentData.UserId', $Filter['UserName']);
            }
            if ($SessionData['UserGroupId'] == '5') {
                $this->db->where('UserId', $SessionData['Id']);
            }
            $this->db->group_by('UserId');
            $queryT = $this->db->get();
            foreach ($queryT->result_array() as $tmpUserData) {
                $tmpArray = array();

                $this->db->select('*');
                $this->db->from('Users');
                $this->db->where('Id', $tmpUserData['UserId']);
                $queryTmp = $this->db->get();
                $UserData = $queryTmp->result_array();
                $tmpArray['UserName'] = $UserData['0']['FirstName'] . ' ' . $UserData['0']['LastName'];


                $this->db->select('*');
                $this->db->from('OnlineAssessmentData');
                $this->db->where('DateCreated', $tmpData['DateCreated']);
                $this->db->where('UserId', $tmpUserData['UserId']);
                $this->db->where('AssessmentId', 7);
                $this->db->where('DocumentPath !=','');
                $queryTmp = $this->db->get();
                $tmpArray['Assessment1Completed'] = count($queryTmp->result_array());

                $this->db->select('*');
                $this->db->from('OnlineAssessmentData');
                $this->db->where('DateCreated', $tmpData['DateCreated']);
                $this->db->where('UserId', $tmpUserData['UserId']);
                $this->db->where('AssessmentId', 8);
                $this->db->where('DocumentPath !=','');
                $queryTmp = $this->db->get();
                $tmpArray['Assessment2Completed'] = count($queryTmp->result_array());

                $this->db->select('*');
                $this->db->from('OnlineAssessmentData');
                $this->db->where('DateCreated', $tmpData['DateCreated']);
                $this->db->where('UserId', $tmpUserData['UserId']);
                $this->db->where('AssessmentId', 9);
                $this->db->where('DocumentPath !=','');
                $queryTmp = $this->db->get();
                $tmpArray['Assessment3Completed'] = count($queryTmp->result_array());


                $this->db->select('*');
                $this->db->from('OnlineAssessmentData');
                $this->db->where('DateCreated', $tmpData['DateCreated']);
                $this->db->where('UserId', $tmpUserData['UserId']);
                $this->db->where('AssessmentId', 7);
                $this->db->where('DocumentPath !=','');
                $queryTmp = $this->db->get();
                foreach ($queryTmp->result_array() as $tmpStudentData) {
                    $this->db->select('*');
                    $this->db->from('OnlineAssessmentData');
                    $this->db->where('DateCreated', $tmpData['DateCreated']);
                    $this->db->where('UserId', $tmpUserData['UserId']);
                    $this->db->where('StudentId', $tmpStudentData['StudentId']);
                    $this->db->where('DocumentPath !=','');
                    $this->db->where('AssessmentId', 8);
                    $queryTmp = $this->db->get();

                    if (count($queryTmp->result_array())) {
                        $this->db->select('*');
                        $this->db->from('OnlineAssessmentData');
                        $this->db->where('DateCreated', $tmpData['DateCreated']);
                        $this->db->where('UserId', $tmpUserData['UserId']);
                        $this->db->where('StudentId', $tmpStudentData['StudentId']);
                        $this->db->where('AssessmentId', 9);
                        $this->db->where('DocumentPath !=','');
                        $queryTmp = $this->db->get();
                        if (count($queryTmp->result_array())) {
                            $tmpArray['AssessmentAllCompleted'] += 1;
                        }
                    }
                }


                $AssessmentData[$tmpData['DateCreated']][$tmpUserData['UserId']] = $tmpArray;

            }
        }
        return $AssessmentData;
    }


    public function UserAttendanceData($SessionData,$Filter)
    {
        $this->db->select('*');
        $this->db->from('AttendanceData');
        $this->db->group_by('DateCreated');
        $this->db->order_by('DateCreated', 'DESC');
        $query = $this->db->get();
//        return $query->result_array();

        $AttendanceData = array();
        foreach ($query->result_array() as $tmpData) {
            $this->db->select('AttendanceData.*,Users.FirstName as FirstName,Users.LastName as LastName,Training.TrainingDate as TrainingDate,Training.InTime as InTime,Training.OutTime as OutTime,School.Name as SchoolName');
            $this->db->from('AttendanceData')->join('Users', 'AttendanceData.UserId = Users.Id')->join('Training', 'AttendanceData.TrainingId = Training.Id')->join('School', 'Training.SchoolId = School.Id');
            $this->db->order_by('AttendanceData.DateCreated', 'DESC');
            $this->db->where('AttendanceData.DateCreated', $tmpData['DateCreated']);
            if($Filter['UserName']){
                $this->db->where('AttendanceData.UserId', $Filter['UserName']);
            }
            if ($SessionData['UserGroupId'] == '5') {
                $this->db->where('AttendanceData.UserId', $SessionData['Id']);
            }
            //$this->db->group_by('UserId');
            $queryT = $this->db->get();
            $tmpArray = $queryT->result_array() ;
            $AttendanceData[$tmpData['DateCreated']] = $tmpArray;
        }
        return $AttendanceData;
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

    public function OnlineTrainingReport($SchoolData,$SessionData,$FilterData){

        $this->db->select('*');
        $this->db->from('OnlineTrainings');
        $this->db->where('TraingDate !=','0000-00-00');
        if($SessionData['UserGroupId'] == 5) {
            $this->db->where("SchoolId IN (" . implode(',', $SchoolData) . ")");
        }
        if($FilterData['UserName']){
            $this->db->where("SchoolId IN (" . implode(',', $SchoolData) . ")");
        }
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


                $tmpArray[]=$data;
            }

            $StudentReport[] = $tmpArray;
        }
        return $StudentReport;

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

    public function TrainingScheduledDataById($SchoolData,$SessionData,$FilterData)
    {

        $this->db->select('OnlineTrainings.*,Student.Name as StudentName,Student.Class as StudentClass, Student.Age as StudentAge');
        $this->db->from('OnlineTrainings')->join('Student', 'OnlineTrainings.StudentId = Student.Id');
        $this->db->where("OnlineTrainings.SchoolId IN (".implode(',',$SchoolData).")");
        $this->db->where('OnlineTrainings.TraingDate !=','0000-00-00');
        $this->db->order_by('OnlineTrainings.ModuleNumber');
        $this->db->order_by('OnlineTrainings.TraingDate', 'DESC');
        $query = $this->db->get();
        //return $query->result_array();
        $TrainingScheduled = array();
        foreach ($query->result_array() as $tmpData)
        {
            $TrainingScheduled[$tmpData['TraingDate']][$tmpData['ModuleNumber']][] = $tmpData;
        }
        return $TrainingScheduled;
    }

    public function GetSchoolData($UserId){

        $this->db->select('*');
        $this->db->from('Mapping');
        $this->db->where('UserId',$UserId);
        $query = $this->db->get();
        $MappingData=$query->result_array();

        $SchoolData=array('0');
        foreach($MappingData as $tmpData)
        {
            $SchoolData[$tmpData['SchoolId']]=$tmpData['SchoolId'];
        }
        return $SchoolData;
    }

    
    public function CompletedTrainingDateWiseTrainingTwo($ModuleNumber,$Filter,$UserId)
    {
        $this->db->select('ModuleTraining.*,Users.FirstName,Users.LastName');
        $this->db->from('ModuleTraining')->join('Users', 'ModuleTraining.UserId = Users.Id');
        $this->db->where('TrainingDate',$Filter);
        $query = $this->db->get();
        $UploadedDocument=array();
		foreach($query->result_array() as $tmpData)
		{
			if($tmpData['TrainingTime'])
			{
				$UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TrainingDate']][$tmpData['TrainingTime']]['ImageOnePath']=$tmpData['ImageOnePath'];
				$UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TrainingDate']][$tmpData['TrainingTime']]['ImageTwoPath']=$tmpData['ImageTwoPath'];
				$UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TrainingDate']][$tmpData['TrainingTime']]['UserName']=$tmpData['FirstName'].' '.$tmpData['LastName'];
				$UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TrainingDate']][$tmpData['TrainingTime']]['WhatsAppCall']=$tmpData['WhatsAppCall'];
			}
		}
		
		$this->db->select('OnlineTrainings.*,Users.FirstName as FirstName,Users.LastName as LastName');
        $this->db->from('OnlineTrainings')->join('Mapping', 'Mapping.SchoolId = OnlineTrainings.SchoolId')->join('Users', 'Mapping.UserId = Users.Id');
        $this->db->where('OnlineTrainings.ModuleNumber',$ModuleNumber);
        $this->db->where('OnlineTrainings.TraingDate',$Filter);
        if($UserId) {
            $this->db->where('Users.Id', $UserId);
        }
        //$this->db->group_by('OnlineTrainings.StudentId');
        $query = $this->db->get();
        //echo $this->db->last_query();

        $OnlineTrainingDateWise=array();
        foreach($query->result_array() as $tmpData)
        {
			if($UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TraingDate']][$tmpData['TrainingTime']])
			{
				$tmpData['UploadDoc']=$UploadedDocument[$tmpData['SchoolId']][$tmpData['ModuleNumber']][$tmpData['TraingDate']][$tmpData['TrainingTime']];
			}			
			$OnlineTrainingDateWise[$tmpData['FirstName'].' '.$tmpData['LastName']][]=$tmpData;
        }

        return $OnlineTrainingDateWise;

    }


    public function GetAllStudentData($FilterData)
	{
        $this->db->select('*');
		$this->db->from('StudentReportCard');
		$this->db->where('DateCreated <',date('Y-m-d'));
//		$this->db->where('StudentId',216);
        if($FilterData['SearchField']) { $this->db->like('StudentName',$FilterData['SearchField']); }
		$this->db->limit(10000);
		$queryCard = $this->db->get();
		
		$StudentData=array();
		foreach($queryCard->result_array() as $tmpCard)
		{
			$this->db->select('District.Name as DistrictName,School.Name as SchoolName,Student.*,School.Id as SchoolId,District.Id as DistrictId, Mapping.UserId as TrainerId');
			$this->db->from('Student')->join('School', 'Student.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId')->join('Mapping', 'School.Id = Mapping.SchoolId');
			$this->db->where('Student.Id',$tmpCard['StudentId']);
			$this->db->group_by('Student.Id');
			
			$query = $this->db->get();
			
			
			foreach ($query->result_array() as $tmpData)
			{

                $this->db->select('*');
                $this->db->from('Users');
                $this->db->where('Id',$tmpData['TrainerId']);
                $queryTrainer = $this->db->get();
                $TrainerName=$queryTrainer->result_array();
                $tmpData['TrainerName']=$TrainerName['0']['FirstName'].' '.$TrainerName['0']['LastName'];


                $this->db->select('*');
                $this->db->from('OnlineTrainings');
                $this->db->where('StudentId',$tmpData['Id']);
                $this->db->where('ModuleNumber','50');
                $queryTraining50 = $this->db->get();
                $OnlineTraining50=$queryTraining50->result_array();
                $OnlineTraining50=$OnlineTraining50['0'];


                $this->db->select('*');
                $this->db->from('ModuleTraining');
                $this->db->where('SchoolId',$OnlineTraining50['SchoolId']);
                $this->db->where('ModuleNumber','50');
                $this->db->where('TrainingDate',$OnlineTraining50['TraingDate']);
                $this->db->where('TrainingTime',$OnlineTraining50['TrainingTime']);
                $queryTrainingUpload50 = $this->db->get();
                $OnlineTrainingUpload50=$queryTrainingUpload50->result_array();
                $OnlineTrainingUpload50=$OnlineTrainingUpload50['0'];


				$this->db->select('*');
				$this->db->from('OnlineTrainings');
				$this->db->where('StudentId',$tmpData['Id']);
				$this->db->where('ModuleNumber','100');
				$queryTraining1 = $this->db->get();
				$OnlineTrainingOne=$queryTraining1->result_array();
				$OnlineTrainingOne=$OnlineTrainingOne['0'];


                $this->db->select('*');
                $this->db->from('ModuleTraining');
                $this->db->where('SchoolId',$OnlineTrainingOne['SchoolId']);
                $this->db->where('ModuleNumber','100');
                $this->db->where('TrainingDate',$OnlineTrainingOne['TraingDate']);
                $this->db->where('TrainingTime',$OnlineTrainingOne['TrainingTime']);
                $queryTrainingUpload1 = $this->db->get();
                $OnlineTrainingUploadOne=$queryTrainingUpload1->result_array();
                $OnlineTrainingUploadOne=$OnlineTrainingUploadOne['0'];


				$this->db->select('*');
				$this->db->from('OnlineTrainings');
				$this->db->where('StudentId',$tmpData['Id']);
				$this->db->where('ModuleNumber','150');
				$queryTraining2 = $this->db->get();
				$OnlineTrainingTwo=$queryTraining2->result_array();
				$OnlineTrainingTwo=$OnlineTrainingTwo['0'];

                $this->db->select('*');
                $this->db->from('ModuleTraining');
                $this->db->where('SchoolId',$OnlineTrainingTwo['SchoolId']);
                $this->db->where('ModuleNumber','150');
                $this->db->where('TrainingDate',$OnlineTrainingTwo['TraingDate']);
                $this->db->where('TrainingTime',$OnlineTrainingTwo['TrainingTime']);
                $queryTrainingUpload2 = $this->db->get();
                $OnlineTrainingUploadTwo=$queryTrainingUpload2->result_array();
                $OnlineTrainingUploadTwo=$OnlineTrainingUploadTwo['0'];
			   
	
				$this->db->select('*');
				$this->db->from('OnlineTrainings');
				$this->db->where('StudentId',$tmpData['Id']);
				$this->db->where('ModuleNumber','200');
				$queryTraining3 = $this->db->get();
				$OnlineTrainingThree=$queryTraining3->result_array();
				$OnlineTrainingThree=$OnlineTrainingThree['0'];

                $this->db->select('*');
                $this->db->from('ModuleTraining');
                $this->db->where('SchoolId',$OnlineTrainingThree['SchoolId']);
                $this->db->where('ModuleNumber','200');
                $this->db->where('TrainingDate',$OnlineTrainingThree['TraingDate']);
                $this->db->where('TrainingTime',$OnlineTrainingThree['TrainingTime']);
                $queryTrainingUpload3 = $this->db->get();
                $OnlineTrainingUploadThree=$queryTrainingUpload3->result_array();
                $OnlineTrainingUploadThree=$OnlineTrainingUploadThree['0'];
				
				$tmpData['AltContactNumber']='';
				if($OnlineTrainingOne['PhoneNumber'])
				{
					$tmpData['AltContactNumber']=$OnlineTrainingOne['PhoneNumber'];
				}
				elseif($OnlineTrainingTwo['PhoneNumber'])
				{
					$tmpData['AltContactNumber']=$OnlineTrainingTwo['PhoneNumber'];
				}
				elseif($OnlineTrainingThree['PhoneNumber'])
				{
					$tmpData['AltContactNumber']=$OnlineTrainingThree['PhoneNumber'];
				}
				
				$this->db->select('count(*) as AttendanceCount');
				$this->db->from('AttendanceData');
				$this->db->like('StudentData','"'.$tmpData['Id'].'":"'.$tmpData['Id'].'"','both');
				$queryAtten = $this->db->get();
				//echo $this->db->last_query();
				$tmpArry=$queryAtten->result_array();
				$tmpData['ModuleOneCount'] =$tmpArry['0']['AttendanceCount'];
				
				$this->db->select('*');
				$this->db->from('StudentsScoring');
				$this->db->where('StudentId',$tmpData['Id']);
				$queryS = $this->db->get();
				$AssessmentOne = $queryS->result_array();
				$AssessmentOne=$AssessmentOne['0'];
				$tmpData['FieldAssessmentDate']=date('d M, Y',strtotime($AssessmentOne['DateCreated']));
				
				$tmpData['GradeOfAssessment']='';
				$tmpGrade=array('D1','C1','B1','A1');
				foreach($tmpGrade as $Grade)
				{
					if($AssessmentOne[$Grade])
					{
						$tmpData['GradeOfAssessment']=$Grade;
					}
				}
				
				//$OnlineTrainingOne['DateTrainingModuleII']='';
				//$OnlineTrainingTwo['DateTrainingModuleIII']='';
				//$OnlineTrainingThree['DateTrainingModuleIV']='';
                if($OnlineTrainingUpload50['ImageOnePath']) {
                    $tmpData['DateTrainingModule50'] = date('d M, Y', strtotime($OnlineTraining50['TraingDate']));
                }
				if($OnlineTrainingUploadOne['ImageOnePath']) {
                    $tmpData['DateTrainingModuleII'] = date('d M, Y', strtotime($OnlineTrainingOne['TraingDate']));
                }
				if($OnlineTrainingUploadTwo['ImageOnePath']) {
                    $tmpData['DateTrainingModuleIII'] = date('d M, Y', strtotime($OnlineTrainingTwo['TraingDate']));
                }
				if($OnlineTrainingUploadThree['ImageOnePath']) {
                    $tmpData['DateTrainingModuleIV'] = date('d M, Y', strtotime($OnlineTrainingThree['TraingDate']));
                }
				
				$this->db->select('*');
				$this->db->from('OnlineStudentsScoring');
				$this->db->where('StudentId',$tmpData['Id']);
				$this->db->where('ModuleNumber','100');
				$queryOSTwo = $this->db->get();
				$OnlineAssessmentOne = $queryOSTwo->result_array();
				$OnlineAssessmentOne=$OnlineAssessmentOne['0'];
				$tmpData['DateAssessment1']=date('d M, Y',strtotime($OnlineAssessmentOne['DateCreated']));
				
				$tmpData['GradeAssessment1']='';
				$tmpGrade=array('D1','C1','B1','A1');
				foreach($tmpGrade as $Grade)
				{
					if($OnlineAssessmentOne[$Grade])
					{
						$tmpData['GradeAssessment1']=$Grade;
					}
				}
				
				$this->db->select('*');
				$this->db->from('OnlineStudentsScoring');
				$this->db->where('StudentId',$tmpData['Id']);
				$this->db->where('ModuleNumber','150');
				$queryOSTwo = $this->db->get();
				$OnlineAssessmentTwo = $queryOSTwo->result_array();
				$OnlineAssessmentTwo=$OnlineAssessmentTwo['0'];
				$tmpData['DateAssessment2']=date('d M, Y',strtotime($OnlineAssessmentTwo['DateCreated']));
				$tmpData['GradeAssessment2']='';
				$tmpGrade=array('D1','C1','B1','A1');
				foreach($tmpGrade as $Grade)
				{
					if($OnlineAssessmentTwo[$Grade])
					{
						$tmpData['GradeAssessment2']=$Grade;
					}
				}
	
				$this->db->select('*');
				$this->db->from('OnlineStudentsScoring');
				$this->db->where('StudentId',$tmpData['Id']);
				$this->db->where('ModuleNumber','200');
				$queryOSThree = $this->db->get();
				$OnlineAssessmentThree = $queryOSThree->result_array();
				$OnlineAssessmentThree=$OnlineAssessmentThree['0'];
				$tmpData['DateAssessment3']=date('d M, Y',strtotime($OnlineAssessmentThree['DateCreated']));
				$tmpData['GradeAssessment3']='';
				$tmpGrade=array('D1','C1','B1','A1');
				foreach($tmpGrade as $Grade)
				{
					if($OnlineAssessmentThree[$Grade])
					{
						$tmpData['GradeAssessment3']=$Grade;
					}
				}
				
				$this->db->select('*');
                $this->db->from('CallStatus');
                $this->db->where('StudentId',$tmpData['Id']);
                $queryCallStatus = $this->db->get();
                $CallStatus=$queryCallStatus->result_array();
				$CallStatus= $CallStatus['0'];
				
				if(count($CallStatus))
				{
					$tmpData['CallStatus']=$CallStatus['CallStatus'];
					$tmpData['Response']=$CallStatus['Response'];
					$tmpData['WhoAnswered']=$CallStatus['WhoAnswered'];
				}
				
				if(strtotime($tmpData['FieldAssessmentDate'])<strtotime('2019-01-01')) $tmpData['FieldAssessmentDate']='';
				if(strtotime($tmpData['DateTrainingModuleII'])<strtotime('2019-01-01')) $tmpData['DateTrainingModuleII']='';
				if(strtotime($tmpData['DateTrainingModuleIII'])<strtotime('2019-01-01')) $tmpData['DateTrainingModuleIII']='';
				if(strtotime($tmpData['DateTrainingModuleIV'])<strtotime('2019-01-01')) $tmpData['DateTrainingModuleIV']='';
				if(strtotime($tmpData['DateAssessment1'])<strtotime('2019-01-01')) $tmpData['DateAssessment1']='';
				if(strtotime($tmpData['DateAssessment2'])<strtotime('2019-01-01')) $tmpData['DateAssessment2']='';
				if(strtotime($tmpData['DateAssessment3'])<strtotime('2019-01-01')) $tmpData['DateAssessment3']='';
				
				$StudentData[$tmpData['Id']]=$tmpData;
			}
		}
        return $StudentData;

    }
	
	
	
	public function StudentReportCard($FilterData)
	{
        $this->db->select('*');
		$this->db->from('StudentReportCard');
		$this->db->where('DateCreated <=',date('Y-m-d'));
        if($FilterData['SearchField']) { $this->db->like('StudentName',$FilterData['SearchField']); }
		$this->db->limit(50000);
		$queryCard = $this->db->get();
		return $queryCard->result_array();

    }
	
	public function SaveStudentReportCard($StudentId,$SaveData)
	{
		$this->db->where('StudentId',$StudentId);
		$this->db->update('StudentReportCard',$SaveData);		
	}

    public function GetAllStudentAttendanceData()
	{
		$this->db->select('*');
        $this->db->from('AttendanceData');
        $queryS = $this->db->get();
        return $queryS->result_array();
	}
	
	
	public function GenerateReportCardCSV()
	{
		$this->db->select('*');
        $this->db->from('StudentReportCard');
		$this->db->where('ReportData !=','');
		$queryS = $this->db->get();
        return $queryS->result_array();
	}
}
?>