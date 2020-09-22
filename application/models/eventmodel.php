<?php
class eventmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function EventListData($UserId)
    {
        $this->db->select('Event.*,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
        $this->db->from('Event')->join('Village', 'Event.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId');
        //$this->db->where('Event.UserId',$UserId);
        $this->db->group_by('Event.Id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function EventManagerListDashboardData($Parameters)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        if($SessionData['UserGroupId']==5)
        {
            return $this->eventmodel->EventListData($UserId);
        }

        $this->db->select('Event.*,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
        $this->db->from('Event')->join('Village', 'Event.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left');
        if($Parameters['DistrictId'])
        {
            $this->db->where('Village.DistrictId',$Parameters['DistrictId']);
        }
        if($Parameters['OrderById']==1)
        {
            $this->db->order_by('Event.Id','DESC');
        }
        else
        {
            $this->db->order_by('Event.Ocassion');
        }
        if($Parameters['Limit'])
        {
            $this->db->limit($Parameters['Limit']);
        }
        $this->db->group_by('Event.Id');
        $this->db->order_by('Event.Ocassion');
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

    public function GetEventData($Id)
    {
        $this->db->select('*');
        $this->db->from('Event');
        $this->db->where('Id',$Id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function UpdateEvent($Id,$Event)
    {
        $this->db->where('Id',$Id);
        $this->db->update('Event',$Event);
    }

    public function CreateNewEvent($SaveData)
    {
        $this->db->insert('Event',$SaveData);
        return $this->db->insert_id();
    }

    public function DeleteSchool($Id)
    {
        $this->db->where('Id', $Id);
        $this->db->delete('School');
    }

}
?>