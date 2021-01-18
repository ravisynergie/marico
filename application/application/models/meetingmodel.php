<?php
class meetingmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function MeetingListData($UserId)
    {
        $this->db->select('Meeting.*,School.Name as LocationName');
        $this->db->from('Meeting')->join('School', 'Meeting.SchoolId = School.Id');
        $this->db->where('Meeting.UserId',$UserId);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function MeetingManagerListData($Parameters)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        if($SessionData['UserGroupId']==5)
        {
            return $this->globalmodel->UserMeetingList($UserId,$_GET);
        }

        if($Parameters['FilterTrainerId'])
        {
            return $this->globalmodel->UserMeetingList($Parameters['FilterTrainerId']);
        }



        $this->db->select('Meeting.*,School.Name as LocationName,School.Name as SchoolName,District.Name as DistrictName,District.Id as DistrictId,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat, Users.FirstName as FirstName');
        $this->db->from('Meeting')->join('School', 'Meeting.SchoolId = School.Id','Left')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left')->join('Users', 'Meeting.UserId = Users.Id','Left');

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
            $this->db->where('Meeting.SchoolId',$Parameters['SchoolId']);
        }
        if($Parameters['MeetingStatus'])
        {
            $this->db->where('Meeting.MeetingStatus',$Parameters['MeetingStatus']);
        }
        $this->db->order_by('Meeting.MeetingDate');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function MeetingListDashboardData($UserId)
    {
        $this->db->select('Meeting.*,School.Name as LocationName');
        $this->db->from('Meeting')->join('School', 'Meeting.SchoolId = School.Id');
        //$this->db->where('Meeting.UserId',$UserId);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetMeetingData($Id)
    {
        $this->db->select('*');
        $this->db->from('Meeting');
        $this->db->where('Id',$Id);
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

    public function UpdateMeeting($Id,$Student)
    {
        $this->db->where('Id',$Id);
        $this->db->update('Meeting',$Student);
    }

    public function CreateNewMeeting($SaveData)
    {
        $this->db->insert('Meeting',$SaveData);
        return $this->db->insert_id();
    }

    public function DeleteMeeting($Id)
    {
        $this->db->where('Id', $Id);
        $this->db->delete('Meeting');
    }

    public function MeetingHourData($UserId)
    {
        $this->db->select('Meeting.*,School.Name as LocationName,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
        $this->db->from('Meeting')->join('School', 'Meeting.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left');
//        $this->db->where('Gallery.Type','School');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function TouchpointData($UserId)
    {
        $this->db->select('Training.*,School.Name as LocationName,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat,COUNT(*) as count');
        $this->db->from('Training')->join('School', 'Training.SchoolId = School.Id')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left');
        $this->db->group_by('Training.SchoolId');
        $this->db->order_by('Training.TrainingDate','ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

}
?>