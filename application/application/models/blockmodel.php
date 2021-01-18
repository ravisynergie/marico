<?php
class blockmodel extends CI_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	public function BlockListData($UserId)
	{
		$this->db->select('Block.*,District.Name as DistrictName');
		$this->db->from('Block')->join('District', 'District.Id = Block.DistrictId');
		//$this->db->where('Block.UserId',$UserId);
		$this->db->order_by('Block.Name');
		$query = $this->db->get();
		return $query->result_array();	
	}

    public function BlockManagerListboardData($Parameters)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        if($SessionData['UserGroupId']==5)
        {
            return $this->globalmodel->UserBlockList($UserId);
        }
		
		if($Parameters['FilterTrainerId'])
		{
			return $this->globalmodel->UserBlockList($Parameters['FilterTrainerId']);
		}

        $this->db->select('Block.*,District.Name as DistrictName');
        $this->db->from('Block')->join('District', 'District.Id = Block.DistrictId','Left');
        if($Parameters['Limit'])
		{
			$this->db->limit($Parameters['Limit']);
		}
		if($Parameters['OrderById']==1)
		{
			$this->db->order_by('Block.Id','DESC');
		}
		else
		{
			$this->db->order_by('Block.Name');
		}
		$query = $this->db->get();
        return $query->result_array();
    }

    public function BlockSearchListData($UserId,$DistId,$BlockName)
    {
        $this->db->select('Block.*,District.Name as DistrictName');
        $this->db->from('Block')->join('District', 'District.Id = Block.DistrictId');
        //$this->db->where('Block.UserId',$UserId);
        $this->db->where('Block.DistrictId',$DistId);
        $this->db->like('Block.Name', $BlockName, 'both');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function GetBlockData($Id)
	{
		$this->db->select('*');
		$this->db->from('Block');
		$this->db->where('Id',$Id);
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	public function UpdateBlock($Id,$Block)
	{
		$this->db->where('Id',$Id);
		$this->db->update('Block',$Block);		
	}
	
	public function CreateNewBlock($SaveData)
	{
		$this->db->insert('Block',$SaveData);
		return $this->db->insert_id();
	}
	
	public function DeleteBlock($Id)
	{
		$this->db->where('Id', $Id);
		$this->db->delete('Block');
	}
	
}
?>