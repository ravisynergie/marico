<?php
class districtmodel extends CI_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	public function DistrictListData($UserId)
	{
		$this->db->select('*');
		$this->db->from('District');
		$this->db->order_by('District.Name');
		//$this->db->where('UserId',$UserId);
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	public function DistrictManagerListData($Parameters)
	{
		$SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
		if($SessionData['UserGroupId']==5)
		{
			return $this->globalmodel->UserDistrictList($UserId);
		}
		if($Parameters['FilterTrainerId'])
		{
			return $this->globalmodel->UserDistrictList($Parameters['FilterTrainerId']);
		}
		$this->db->select('*');
		$this->db->from('District');
		if($Parameters['DistrictId'])
		{
			$this->db->where('Id',$Parameters['DistrictId']);
		}
		if($Parameters['OrderById']==1)
		{
			$this->db->order_by('District.Id','DESC');
		}
		else
		{
			$this->db->order_by('District.Name');
		}
		
		if($Parameters['Limit'])
		{
			$this->db->limit($Parameters['Limit']);
		}
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	public function GetDistrictData($Id)
	{
		$this->db->select('*');
		$this->db->from('District');
		$this->db->where('Id',$Id);
		$query = $this->db->get();
		return $query->result_array();	
	}
	
	public function UpdateDistrict($Id,$District)
	{
		$this->db->where('Id',$Id);
		$this->db->update('District',$District);		
	}
	
	public function CreateNewDistrict($SaveData)
	{
		$this->db->insert('District',$SaveData);
		return $this->db->insert_id();
	}
	
	public function DeleteDistrict($Id)
	{
		$this->db->where('Id', $Id);
		$this->db->delete('District');
	}
	
	public function GoogleMapData($DistrictId)
	{
		$this->db->select('*');
		$this->db->from('District');
		$this->db->where('Id',$DistrictId);
		$query = $this->db->get();
		
		$GoogleData=array();
		foreach($query->result_array() as $tmpData)
		{
			if($tmpData['Latitude'] && $tmpData['Longitude'])
			{
				$tmpArray=array();
				$tmpArray['placeName']=$tmpData['Name'];
				$tmpArray['AddressInfo']='';
				$tmpArray['type']='District';
				$tmpArray['LatLng'][]=array('lat'=>(float)$tmpData['Latitude'],'lng'=>(float)$tmpData['Longitude']);
				$GoogleData[]=$tmpArray;
			}
		}
		
		$this->db->select('Block.*,District.Name as DistrictName');
		$this->db->from('Block')->join('District', 'District.Id = Block.DistrictId');;
		$this->db->where('Block.DistrictId',$DistrictId);
		$query = $this->db->get();
		foreach($query->result_array() as $tmpData)
		{
			if($tmpData['Latitude'] && $tmpData['Longitude'])
			{
				$tmpArray=array();
				$tmpArray['placeName']=$tmpData['Name'];
				$tmpArray['AddressInfo']='District : '.$tmpData['DistrictName'];
				$tmpArray['type']='Block';
				$tmpArray['LatLng'][]=array('lat'=>(float)$tmpData['Latitude'],'lng'=>(float)$tmpData['Longitude']);
				
				$GoogleData[]=$tmpArray;
			}
		}
		
		$this->db->select('School.*,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
		$this->db->from('School')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId');
		$this->db->where('District.Id',$DistrictId);
		$query = $this->db->get();
		foreach($query->result_array() as $tmpData)
		{
			if($tmpData['Latitude'] && $tmpData['Longitude'])
			{
				$AddressInfo=array();
				if($tmpData['VillageName']) $AddressInfo[]='Village : '.$tmpData['VillageName'];
				if($tmpData['GramPanchayat']) $AddressInfo[]='Gram Panchayat : '.$tmpData['GramPanchayat'];
				if($tmpData['BlockName']) $AddressInfo[]='Block : '.$tmpData['BlockName'];
				if($tmpData['DistrictName']) $AddressInfo[]='District : '.$tmpData['DistrictName'];
				
				$tmpArray=array();
				$tmpArray['placeName']=$tmpData['Name'];
				$tmpArray['AddressInfo']=implode(', ',$AddressInfo);
				$tmpArray['type']='School';
				$tmpArray['LatLng'][]=array('lat'=>(float)$tmpData['Latitude'],'lng'=>(float)$tmpData['Longitude']);
				
				$GoogleData[]=$tmpArray;
			}
		}
		
		return $GoogleData;
	}
	
	public function DistrictOtherInfoCount($DistrictId)
	{
		$this->db->select('Block.*,District.Name as DistrictName');
		$this->db->from('Block')->join('District', 'District.Id = Block.DistrictId');;
		$this->db->where('Block.DistrictId',$DistrictId);
		$query = $this->db->get();
		$BlockCount=count($query->result_array());
		
		$this->db->select('School.*,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
		$this->db->from('School')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId');
		$this->db->where('District.Id',$DistrictId);
		$query = $this->db->get();
		$SchoolCount=count($query->result_array());
		
		
		$this->db->select('School.*,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
		$this->db->from('School')->join('Village', 'School.VillageId = Village.Id')->join('District', 'District.Id = Village.DistrictId')->join('Block', 'Block.Id = Village.BlockId');
		$this->db->where('District.Id',$DistrictId);
		$this->db->where('School.ModelSchool','Yes');
		$query = $this->db->get();
		$ModernSchoolCount=count($query->result_array());
		
		$this->db->select('Student.*,School.Name as SchoolName,District.Name as DistrictName,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
		$this->db->from('Student')->join('School', 'Student.SchoolId = School.Id','Left')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left');
		$this->db->where('District.Id',$DistrictId);
		$query = $this->db->get();
		$StudentCount=count($query->result_array());
		
		return array('BlockCount'=>$BlockCount,'SchoolCount'=>$SchoolCount,'ModernSchoolCount'=>$ModernSchoolCount,'StudentCount'=>$StudentCount);	
	}

    public function GetUsersData($Id)
    {
        $this->db->select('*');
        $this->db->from('Users');
        //$this->db->where('Id',$Id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetDistrictSchool($disId)
    {
//        $this->db->select('*');
//        $this->db->from('Village');
//        $this->db->where('DistrictId',$Id);
//        $query = $this->db->get();
//        return $query->result_array();


        $this->db->select('*');
        $this->db->from('Village');
        $this->db->where('DistrictId',$disId);
        $query = $this->db->get();
        $village = $query->result_array();
        foreach ($village as $vid) {
            $villageid[] = $vid['Id'];
        }

        //return $villageid;

        if(!empty($villageid)) {
            $this->db->select('School.*,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
            $this->db->from('School')->join('Village', 'School.VillageId = Village.Id')->join('Block', 'Block.Id = Village.BlockId');
            $this->db->where_in('School.VillageId', $villageid);
            $query = $this->db->get();
            $schoolData = $query->result_array();
        }
        return $schoolData;
    }

    public function CreateNewMapping($SaveData)
    {

        $this->db->select('*');
        $this->db->from('Mapping');
        $this->db->where('UserId',$SaveData['UserId']);
        $this->db->where('SchoolId',$SaveData['SchoolId']);
        $query = $this->db->get();

        if(count($query->result_array())==0)
        {
            $this->db->insert('Mapping',$SaveData);
            return $this->db->insert_id();
        }

    }

    public function GetMappedUser($uId)
    {

        $this->db->select('*');
        $this->db->from('Mapping');
        $this->db->where('UserId',$uId);
        $query = $this->db->get();
        return $query->result_array();;
    }

    public function DeleteMappedUser($uId)
    {
        $this->db->where('UserId', $uId);
        $this->db->delete('Mapping');
    }

    public function MappingListData($UserId)
    {

        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $userGroup = $SessionData['UserGroupId'];

        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where('UserGroupId',5);
        if($userGroup == 5){
            $this->db->where('Id',$UserId);
        }
        $this->db->group_by('Users.Id');
        $query = $this->db->get();
        $Trainners =  $query->result_array();

        $TrainnersData = Array();
        $TrainnersData = $Trainners;

        foreach ($TrainnersData as $key=>$trainner){
            $this->db->select('*');
            $this->db->from('Mapping');
            $this->db->where('UserId',$trainner['Id']);
            $query = $this->db->get();
            $TrainnersData[$key]['SchoolData'] =  $query->result_array();;
        }

        return $TrainnersData;

    }
}
?>