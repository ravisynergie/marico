<?php
class villagemodel extends CI_Model
{
	public function __construct() 
	{
		parent::__construct();
        $this->load->model('globalmodel');
	}
	
	public function VillageListData($UserId,$SearchString)
	{
        if($SearchString['UserName'])
        {
            //print_r($SearchString['UserName']);

            $SchoolData=$this->globalmodel->UserMappedSchoolList($SearchString['UserName']);
            $SchoolData=array_unique($SchoolData);

            $this->db->select('VillageId');
            $this->db->from('School');
            $this->db->where("Id IN (".implode(',',$SchoolData).")");
            $this->db->group_by("VillageId");
            $query = $this->db->get();

            $VillageData=array();
            foreach($query->result_array() as $tmpVillage)
            {
                $this->db->select('*');
                $this->db->from('Village');
                $this->db->where('Id',$tmpVillage['VillageId']);


                $query = $this->db->get();
                //echo $this->db->last_query();
                foreach($query->result_array() as $tmpVill)
                {
                    $this->db->select('*');
                    $this->db->from('Block');
                    $this->db->where('Id',$tmpVill['BlockId']);
                    $query = $this->db->get();
                    $tmpData=$query->result_array();
                    $tmpVill['BlockName']=$tmpData['0']['Name'];

                    $this->db->select('*');
                    $this->db->from('District');
                    $this->db->where('Id',$tmpVill['DistrictId']);
                    $query = $this->db->get();
                    $tmpData=$query->result_array();
                    $tmpVill['DistrictName']=$tmpData['0']['Name'];

                    $VillageData[]=$tmpVill;
                }

            }
//            echo "<pre>";
//            print_r($VillageData);
//            echo "</pre>";
            //die;

            return $VillageData;

        }

		$this->db->select('Village.*,District.Name as DistrictName,Block.Name as BlockName');
		$this->db->from('Village')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId');
		
		if($SearchString['DistrictId'])
		{
			$this->db->where('Village.DistrictId',$SearchString['DistrictId']);
		}
		if($SearchString['BlockId'])
		{
			$this->db->where('Village.BlockId',$SearchString['BlockId']);
		}
		if($SearchString['VillageName'])
		{
			$this->db->where("Village.Name LIKE '%".$SearchString['VillageName']."%'");
		}

			
		$query = $this->db->get();
		return $query->result_array();	
	}

    public function VillageSearchListData($UserId,$DistId,$BlockId,$VillageName)
    {
        $this->db->select('Village.*,District.Name as DistrictName,Block.Name as BlockName');
        $this->db->from('Village')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId');
//        $this->db->where('Village.UserId',$UserId);
        $this->db->where('Village.DistrictId',$DistId);
        $this->db->where('Village.BlockId',$BlockId);
        $this->db->like('Village.Name', $VillageName, 'both');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function VillageListboardData($UserId)
    {
        $this->db->select('Village.*,District.Name as DistrictName,Block.Name as BlockName');
        $this->db->from('Village')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId');
//        ?$this->db->where('Village.UserId',$UserId);
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function VillageManagerListboardData($Parameters)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
		if($SessionData['UserGroupId']==5)
		{
			return $this->globalmodel->UserVillageList($UserId);
		}
		
		if($Parameters['FilterTrainerId'])
		{
			return $this->globalmodel->UserVillageList($Parameters['FilterTrainerId']);
		}
		
		$this->db->select('Village.*,District.Name as DistrictName,Block.Name as BlockName');
        $this->db->from('Village')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId');
		if($Parameters['DistrictId'])
		{
			$this->db->where('District.Id',$Parameters['DistrictId']);
		}
		if($Parameters['OrderById']==1)
		{
			$this->db->order_by('Village.Id','DESC');
		}
		else
		{
			$this->db->order_by('Village.Name');
		}
        if($Parameters['Limit'])
		{
			$this->db->limit($Parameters['Limit']);
		}
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetVillageData($Id)
	{
		$this->db->select('*');
		$this->db->from('Village');
		$this->db->where('Id',$Id);
		$query = $this->db->get();
		return $query->result_array();	
	}

    public function GetDuplicateEntry($Name,$DistrictId,$BlockId)
    {
        $this->db->select('Name');
        $this->db->from('Village');
        $this->db->where(array('Name' => $Name, 'DistrictId' => $DistrictId, 'BlockId' => $BlockId));
        //$this->db->where('Name',$Name);
        $this->result = $this->db->get();
        $RowsNumber = $this->result->num_rows();
        return $RowsNumber;
    }

	
	public function UpdateVillage($Id,$Village)
	{
		$this->db->where('Id',$Id);
		$this->db->update('Village',$Village);		
	}
	
	public function CreateNewVillage($SaveData)
	{
		$this->db->insert('Village',$SaveData);
		return $this->db->insert_id();
	}
	
	public function DeleteVillage($Id)
	{
		$this->db->where('Id', $Id);
		$this->db->delete('Village');
	}
	
}
?>