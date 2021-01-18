<?php
class assessmentmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function AssessmentListData($UserId)
    {
        $this->db->select('*');
        $this->db->from('Assessment');
        $this->db->where('Status',1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function Assessment2ListData($UserId)
    {
        $this->db->select('*');
        $this->db->from('Assessment');
        $this->db->where('Status',0);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function AssessmentDashboardData($Parameters)
	{
        $this->db->select('*');
        $this->db->from('Assessment');
        //$this->db->where('Status',1);
        $query = $this->db->get();
        $AssessmentData=array();
        foreach ($query->result_array() as $data)
		{
			$this->db->select('AssessmentData.*,Student.Name as StudentName, Student.Class as StudentClass, Student.Gender as StudentGender,Student.Age as StudentAge,District.Id as DistrictId');
            $this->db->from('AssessmentData')->join('Student', 'AssessmentData.StudentId = Student.Id')->join('School', 'Student.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId');
            $this->db->where('AssessmentData.AssessmentId',$data['Id']);
			
			if($Parameters['FilterTrainerId'])
			{
				$this->db->where('AssessmentData.UserId',$Parameters['FilterTrainerId']);
			}
			if($Parameters['DistrictId'])
			{
				$this->db->where('District.Id',$Parameters['DistrictId']);
			}
			
            $query = $this->db->get();
            $tmpData=$query->result_array();
            $AssessmentData[$data['Name']]=$tmpData;
        }
		return $AssessmentData;
    }

    public function OnlineAssessmentDashboardData($Parameters)
    {
        $this->db->select('*');
        $this->db->from('Assessment');
        $this->db->where('Status',0);
        $query = $this->db->get();
        $OnlineAssessmentData=array();
        foreach ($query->result_array() as $data)
        {
            $this->db->select('OnlineAssessmentData.*,Student.Name as StudentName, Student.Class as StudentClass, Student.Gender as StudentGender,Student.Age as StudentAge,District.Id as DistrictId');
            $this->db->from('OnlineAssessmentData')->join('Student', 'OnlineAssessmentData.StudentId = Student.Id')->join('School', 'Student.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId');
            $this->db->where('OnlineAssessmentData.AssessmentId',$data['Id']);

            if($Parameters['FilterTrainerId'])
            {
                $this->db->where('OnlineAssessmentData.UserId',$Parameters['FilterTrainerId']);
            }
            if($Parameters['DistrictId'])
            {
                $this->db->where('District.Id',$Parameters['DistrictId']);
            }

            $query = $this->db->get();
            $tmpData=$query->result_array();
            $OnlineAssessmentData[$data['Name']]=$tmpData;
        }
        return $OnlineAssessmentData;
    }

    public function StudentScoringDashboardData($Parameters)
    {

            //$this->db->select('StudentsScoring.*,Student.Name as StudentName, Student.Class as StudentClass, Student.Gender as StudentGender,Student.Age as StudentAge,District.Id as DistrictId, Users.UserName as UserName, School.Name as SchoolName, Village.Name as VillageName, District.Name as DistrictName');
            //$this->db->from('StudentsScoring')->join('Student', 'StudentsScoring.StudentId = Student.Id')->join('School', 'StudentsScoring.SchoolId = School.Id')->join('Village', 'StudentsScoring.VillageId = Village.Id')->join('District', 'District.Id = StudentsScoring.DistrictId')->join('Users', 'Users.Id = StudentsScoring.UserId');
            //$this->db->where('StudentsScoring.Id',$data['Id']);
        $this->db->select('*');
        $this->db->from('StudentsScoring');
            if($Parameters['FilterTrainerId'])
            {
                $this->db->where('UserId',$Parameters['FilterTrainerId']);
            }
            if($Parameters['DistrictId'])
            {
                $this->db->where('DistrictId',$Parameters['DistrictId']);
            }

            $query = $this->db->get();
            $AssessmentData=$query->result_array();


        return $AssessmentData;
    }

    public function OnlineStudentScoringDashboardData($Parameters)
    {

        $this->db->select('*');
        $this->db->from('OnlineStudentsScoring');
		$this->db->where('ModuleNumber',200);
        if($Parameters['FilterTrainerId'])
        {
            $this->db->where('UserId',$Parameters['FilterTrainerId']);
        }
        if($Parameters['DistrictId'])
        {
            $this->db->where('DistrictId',$Parameters['DistrictId']);
        }

        $query = $this->db->get();
        $AssessmentData=$query->result_array();


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

    public function OnlineStudentScoringProgressBarData($Id)
    {
        $this->db->select('*');
        $this->db->from('OnlineStudentsScoring');
        $this->db->where('ModuleNumber',200);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetMappedQuestion($Id)
    {
        $this->db->select('*');
        $this->db->from('Assessment');
        $this->db->where('Id',$Id);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function UpdateAssessment($Id,$Village)
    {
        $this->db->where('Id',$Id);
        $this->db->update('Assessment',$Village);
    }

    public function CreateNewAssessment($SaveData)
    {
        $this->db->insert('Assessment',$SaveData);
        return $this->db->insert_id();
    }

    public function SaveAssessmentData($SaveData)
    {
        $this->db->insert('AssessmentData',$SaveData);
        return $this->db->insert_id();
    }

//    public function DeleteAssessment($Id)
//    {
//        $this->db->where('Id', $Id);
//        $this->db->delete('Assessment');
//    }

    public function GetSchoolName($Id)
    {
        $this->db->select('Student.*,School.Name as LocationName');
        $this->db->from('Student')->join('School', 'Student.SchoolId = School.Id');
        $this->db->where('Student.Id',$Id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetStudentName($Id)
    {
        $this->db->select('*');
        $this->db->from('Student');
        $this->db->where('Id',$Id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetAssessmentData($Assessmentid,$Studentid,$Trainingid)
    {
        $this->db->select('*');
        $this->db->from('AssessmentData');
        $this->db->where('StudentId',$Studentid);
        $this->db->where('AssessmentId',$Assessmentid);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function DeleteAssessment($Assessmentid,$Studentid,$Trainingid)
    {
//        $this->db->where('TrainingId',$Trainingid);
        $this->db->where('StudentId',$Studentid);
        $this->db->where('AssessmentId',$Assessmentid);
        $this->db->delete('AssessmentData');
    }

}
?>