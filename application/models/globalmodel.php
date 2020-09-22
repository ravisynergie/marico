<?php
class globalmodel extends CI_Model
{
	public function __construct() 
	{
		parent::__construct();
	}
	
	
	
	public function UserMappedSchoolList($UserId)
	{
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
	
	public function StudentIvrInsert($SaveData)
	{
		$this->db->select('*');
        $this->db->from('StudentIVRData');
        $this->db->where('StudentId',$SaveData['StudentId']);
        $query = $this->db->get();
        if(count($query->result_array())==0)
        {
			$this->db->insert('StudentIVRData',$SaveData);
			return $this->db->insert_id();
		}
		else
		{
			$this->db->where('StudentId',$SaveData['StudentId']);
            $this->db->update('StudentIVRData',array('IVRCompleted'=>$SaveData['IVRCompleted']));
		}
	}

	public function AttendanceToIVRDelete(){

	    $this->db->empty_table('StudentIVRData');
    }

    public function UpdateIVRFromAttendance($studentId,$SaveIVRData)
    {
        $this->db->select('*');
        $this->db->from('StudentIVRData');
        $this->db->where('StudentId',$studentId);
        $query = $this->db->get();

        if(count($query->result_array())==0)
        {
            $this->db->insert('StudentIVRData',$SaveIVRData);
            return $this->db->insert_id();
        }

        if(count($query->result_array())==1)
        {
            $this->db->where('StudentId',$studentId);
            $this->db->update('StudentIVRData',$SaveIVRData);
        }
    }
	
	public function UserTrainingList($UserId,$SearchString)
	{
		$SchoolData=$this->UserMappedSchoolList($UserId);
		$SchoolData=array_unique($SchoolData);
		
		if($SearchString['SchoolId'])
		{
			$SchoolData=array($SearchString['SchoolId']);
		}
				
		$VillageData=array();
		$this->db->select('*');
        $this->db->from('Training');
		$this->db->where("SchoolId IN (".implode(',',$SchoolData).")");
		
		if($SearchString['TrainingStatus'])
		{
			$this->db->where('TrainingStatus',$SearchString['TrainingStatus']);
		}
		
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
				
				if($SearchString['DistrictId'])
				{
					$this->db->where('DistrictId',$SearchString['DistrictId']);
				}
				if($SearchString['BlockId'])
				{
					$this->db->where('BlockId',$SearchString['BlockId']);
				}
			
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
		
		echo "<pre>";
		print_r($SearchString);
		echo "</pre>";
		
		echo "<pre>";
		print_r($SchoolData);
		echo "</pre>";
		
		echo "<pre>";
		print_r($VillageData);
		echo "</pre>";
		
		
	}

    public function UserMeetingList($UserId,$SearchString)
    {
        $SchoolData=$this->UserMappedSchoolList($UserId);
        $SchoolData=array_unique($SchoolData);

        if($SearchString['SchoolId'])
        {
            $SchoolData=array($SearchString['SchoolId']);
        }

        $VillageData=array();
        $this->db->select('*');
        $this->db->from('Meeting');
        $this->db->where("SchoolId IN (".implode(',',$SchoolData).")");

        if($SearchString['MeetingStatus'])
        {
            $this->db->where('MeetingStatus',$SearchString['MeetingStatus']);
        }

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

                if($SearchString['DistrictId'])
                {
                    $this->db->where('DistrictId',$SearchString['DistrictId']);
                }
                if($SearchString['BlockId'])
                {
                    $this->db->where('BlockId',$SearchString['BlockId']);
                }

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

        echo "<pre>";
        print_r($SearchString);
        echo "</pre>";

        echo "<pre>";
        print_r($SchoolData);
        echo "</pre>";

        echo "<pre>";
        print_r($VillageData);
        echo "</pre>";


    }

    public function userMeetingData($UserId,$SearchString){
        $this->db->select('Meeting.*,Village.Name as LocationName');
        $this->db->from('Meeting')->join('Village', 'Meeting.VillageId = Village.Id');
        $this->db->where('Meeting.Type','Village');
        $this->db->where('Meeting.UserId',$UserId);
        if($SearchString['MeetingStatus']){
            $this->db->where('Meeting.MeetingStatus',$SearchString['MeetingStatus']);
        }
        if($SearchString['VillageId']){
            $this->db->where('Meeting.VillageId',$SearchString['VillageId']);
        }
        $this->db->order_by('Meeting.DateCreated',DESC);
        $query = $this->db->get();

        $MeetingData=array();
        foreach($query->result_array() as $tmpData)
        {
            $MeetingData[]=	$tmpData;
        }

        $this->db->select('Meeting.*,School.Name as LocationName');
        $this->db->from('Meeting')->join('School', 'Meeting.SchoolId = School.Id');
        $this->db->where('Meeting.Type','School');
        $this->db->where('Meeting.UserId',$UserId);
        if($SearchString['MeetingStatus']){
            $this->db->where('Meeting.MeetingStatus',$SearchString['MeetingStatus']);
        }
        if($SearchString['SchoolId']){
            $this->db->where('Meeting.SchoolId',$SearchString['SchoolId']);
        }
        $this->db->order_by('Meeting.DateCreated',DESC);
        $query = $this->db->get();
        foreach($query->result_array() as $tmpData)
        {
            $MeetingData[]=	$tmpData;
        }
        return $MeetingData;
    }
    public function UserMeetingListActivity($UserId,$SearchString)
    {
        $SchoolData=$this->UserMappedSchoolList($UserId);
        $SchoolData=array_unique($SchoolData);

        $this->db->select('VillageId');
        $this->db->from('School');
        $this->db->where("Id IN (".implode(',',$SchoolData).")");
        $this->db->group_by("VillageId");
        $query = $this->db->get();
        $VillData = $query->result_array();


        foreach ($VillData as $tmpV){
            $vId[]=$tmpV['VillageId'];
        }
        //print_r($vId);
        //return $vId;
//        if($SearchString['SchoolId'])
//        {
//            $SchoolData=array($SearchString['SchoolId']);
//        }
//        if($SearchString['VillageId'])
//        {
//            $VillData=array($SearchString['VillageId']);
//        }

        $VillageData=array();
        $this->db->select('Meeting.*,School.Name as SchoolName');
        $this->db->from('Meeting')->join('School', 'Meeting.SchoolId = School.Id');
        $this->db->where("Meeting.SchoolId IN (".implode(',',$SchoolData).")");
        $this->db->where('Meeting.Type', 'School');
        if($SearchString['MeetingStatus'])
        {
            $this->db->where('Meeting.MeetingStatus',$SearchString['MeetingStatus']);
        }
        if($SearchString['SchoolId'])
        {
            $this->db->where('Meeting.SchoolId',$SearchString['SchoolId']);
        }
        $query = $this->db->get();

        $MeetingData=array();
        foreach($query->result_array() as $tmpData)
        {
            $MeetingData[]=	$tmpData;
        }


        $this->db->select('Meeting.*,Village.Name as VillageName');
        $this->db->from('Meeting')->join('Village', 'Meeting.VillageId = Village.Id');
        $this->db->where_in('Meeting.VillageId' , $vId);
        $this->db->where('Meeting.Type', 'Village');
        if($SearchString['MeetingStatus'])
        {
            $this->db->where('Meeting.MeetingStatus',$SearchString['MeetingStatus']);
        }
        if($SearchString['VillageId'])
        {
            $this->db->where('Meeting.VillageId',$SearchString['VillageId']);
        }
        $query = $this->db->get();
        foreach($query->result_array() as $tmpData)
        {
            $MeetingData[]=	$tmpData;
        }



        return $MeetingData;
        foreach($MeetingData as $tmpVillage)
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

                if($SearchString['DistrictId'])
                {
                    $this->db->where('DistrictId',$SearchString['DistrictId']);
                }
                if($SearchString['BlockId'])
                {
                    $this->db->where('BlockId',$SearchString['BlockId']);
                }

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

        echo "<pre>";
        print_r($SearchString);
        echo "</pre>";

        echo "<pre>";
        print_r($SchoolData);
        echo "</pre>";

        echo "<pre>";
        print_r($VillageData);
        echo "</pre>";


    }
	
	
	
	public function UserStudentList($UserId,$SearchString)
	{
		$SchoolData=$this->UserMappedSchoolList($UserId);
		$SchoolData=array_unique($SchoolData);

//        $this->db->select('*');
//        $this->db->from('AttendanceData');
//        $Ivrquery = $this->db->get();
//        $AllIVR = $Ivrquery->result_array();
//
//        $IVR = array();
//        foreach ($AllIVR as $ivr){
//            $IVR[]=json_decode($ivr['NumberOfIVRCompleted'], true);
//        }
		
		if($SearchString['SchoolId'])
		{
			$SchoolData=array($SearchString['SchoolId']);
		}
				
		$VillageData=array();
		$this->db->select('*');
        $this->db->from('Student');
		$this->db->where("SchoolId IN (".implode(',',$SchoolData).")");
		
		if($SearchString['StudentName'])
		{
			$this->db->where("Name LIKE '%".$SearchString['StudentName']."%'");
		}
		
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
				if($SearchString['DistrictId'])
				{
					$this->db->where('DistrictId',$SearchString['DistrictId']);
				}
				if($SearchString['BlockId'])
				{
					$this->db->where('BlockId',$SearchString['BlockId']);
				}
			
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
					
					

				}
			}

//            foreach ($IVR as $StudentIVR) {
//                foreach ($StudentIVR as $key=>$sivr){
//                    if ($tmpVillage['Id'] == $key) {
//                        $tmpVillage['IVR'] = $sivr;
//                       // $VillageData[] = $tmpVillage;
//                    }
//                }
//            }

            $VillageData[]=$tmpVillage;
		}
        return $VillageData;
        echo "<pre>";
        print_r($IVR);
        echo "</pre>";


        echo "<pre>";
        print_r($VillageData);
        echo "</pre>";

        die;
		

		
//		echo "<pre>";
//		print_r($SearchString);
//		echo "</pre>";
//
//		echo "<pre>";
//		print_r($SchoolData);
//		echo "</pre>";
		

	}
	
	public function UserSchoolList($UserId,$SearchString)
	{
		$SchoolData=$this->UserMappedSchoolList($UserId);
		$SchoolData=array_unique($SchoolData);
		
		$VillageData=array();
		
		$this->db->select('*');
        $this->db->from('School');
		$this->db->where("Id IN (".implode(',',$SchoolData).")");
		if($SearchString['SchoolName'])
		{
			$this->db->where("Name LIKE '%".$SearchString['SchoolName']."%'");
		}
		if($SearchString['VillageId'])
		{
			$this->db->where('VillageId',$SearchString['VillageId']);
		}
		$query = $this->db->get();
        foreach($query->result_array() as $tmpVillage)
		{
			$this->db->select('*');
			$this->db->from('Village');
			$this->db->where('Id',$tmpVillage['VillageId']);
			
			if($SearchString['DistrictId'])
			{
				$this->db->where('DistrictId',$SearchString['DistrictId']);
			}
			if($SearchString['BlockId'])
			{
				$this->db->where('BlockId',$SearchString['BlockId']);
			}
			$query = $this->db->get();
			//echo $this->db->last_query();
			foreach($query->result_array() as $tmpVill)
			{
				$tmpVillage['VillageName']=$tmpVill['Name'];
				$tmpVillage['GramPanchayat']=$tmpVill['GramPanchayat'];

				$this->db->select('*');
				$this->db->from('Block');
				$this->db->where('Id',$tmpVill['BlockId']);
				$query = $this->db->get();
				$tmpData=$query->result_array();
				$tmpVillage['BlockName']=$tmpData['0']['Name'];
				
				$this->db->select('*');
				$this->db->from('District');
				$this->db->where('Id',$tmpVill['DistrictId']);
				$query = $this->db->get();
				$tmpData=$query->result_array();
				$tmpVillage['DistrictName']=$tmpData['0']['Name'];
				
				
				$VillageData[]=$tmpVillage;
			}
			
		}
		
		return $VillageData;
		echo "<pre>";
		print_r($SchoolData);
		echo "</pre>";
		
		echo "<pre>";
		print_r($VillageData);
		echo "</pre>";
		
		
	}
	
	
	public function UserVillageList($UserId,$SearchString)
	{
		$SchoolData=$this->UserMappedSchoolList($UserId);
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
			
			if($SearchString['DistrictId'])
			{
				$this->db->where('DistrictId',$SearchString['DistrictId']);
			}
			if($SearchString['BlockId'])
			{
				$this->db->where('BlockId',$SearchString['BlockId']);
			}
			if($SearchString['VillageName'])
			{
				$this->db->where("Name LIKE '%".$SearchString['VillageName']."%'");
			}
			
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
		
		return $VillageData;
		echo "<pre>";
		print_r($SchoolData);
		echo "</pre>";
		
		echo "<pre>";
		print_r($VillageData);
		echo "</pre>";
		
		
	}
	
	
	public function UserDistrictList($UserId)
	{
		//echo "<br/><br/>User Id : ".$UserId;
		
		$SchoolData=$this->UserMappedSchoolList($UserId);
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
			//$this->db->group_by("DistrictId");
			foreach($query->result_array() as $tmpVill)
			{
				$this->db->select('*');
				$this->db->from('District');
				$this->db->where('Id',$tmpVill['DistrictId']);
				$query = $this->db->get();
				$tmpData=$query->result_array();				
				$VillageData[$tmpData['0']['Id']]=$tmpData['0'];
			}
			
		}
		
		return $VillageData;
		
		echo "<pre>";
		print_r($SchoolData);
		echo "</pre>";
		
		echo "<pre>";
		print_r($VillageData);
		echo "</pre>";
		
		
	}
	
	
	public function UserBlockList($UserId)
	{
		//echo "<br/><br/>User Id : ".$UserId;
		
		$SchoolData=$this->UserMappedSchoolList($UserId);
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
			//$this->db->group_by("DistrictId");
			foreach($query->result_array() as $tmpVill)
			{
				$this->db->select('*');
				$this->db->from('Block');
				$this->db->where('Id',$tmpVill['BlockId']);
				$query = $this->db->get();
				$tmpData=$query->result_array();				
				$VillageData[$tmpData['0']['Id']]=$tmpData['0'];
			}
			
		}
		
		return $VillageData;
		
		echo "<pre>";
		print_r($SchoolData);
		echo "</pre>";
		
		echo "<pre>";
		print_r($VillageData);
		echo "</pre>";
		
		
	}
	
	
	public function UserDistrictVillageList($UserId)
	{
		//echo "<br/><br/>User Id : ".$UserId;
		
		$SchoolData=$this->UserMappedSchoolList($UserId);
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
			//$this->db->group_by("DistrictId");
			foreach($query->result_array() as $tmpVill)
			{
				$this->db->select('*');
				$this->db->from('District');
				$this->db->where('Id',$tmpVill['DistrictId']);
				$query = $this->db->get();
				$tmpData=$query->result_array();				
				$VillageData[$tmpData['0']['Id']]=$tmpData['0'];
			}
			
		}
		
		$VillData=array();
		foreach($VillageData as $DistrictId=>$tmpDis)
		{
			$this->db->select('*');
			$this->db->from('Village');
			$this->db->where('DistrictId',$DistrictId);
			$query = $this->db->get();
			//echo $this->db->last_query();
			foreach($query->result_array() as $tmpData)
			{
				$VillData[$tmpData['Id']]=$tmpData;
			}
					
		}
		return $VillData;
		
		echo "<pre>";
		print_r($VillData);
		echo "</pre>";
		
		echo "<pre>";
		print_r($VillageData);
		echo "</pre>";
		
		
	}
	
	public function DistrictSchoolData($DistrictId)
	{
		$this->db->select('School.*');
		$this->db->from('School')->join('Village','Village.Id=School.VillageId');
		$this->db->where('Village.DistrictId',$DistrictId);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function DistrictSchoolStudentData($SchoolId)
	{
		$this->db->select('Student.*');
		$this->db->from('Student');
		$this->db->where('Student.SchoolId',$SchoolId);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function DistrictSchoolTouchPointData($SchoolId)
	{
		$this->db->select('Training.*');
		$this->db->from('Training');
		$this->db->where('Training.SchoolId',$SchoolId);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function AttendanceToIVR()
	{
		$this->db->select('AttendanceData.*');
		$this->db->from('AttendanceData');
		$this->db->order_by('Id','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function DistrictIvrCompletedData($DistrictId)
	{
		$this->db->select('StudentIVRData.*,School.ModelSchool');
		$this->db->from('StudentIVRData')->join('Student','Student.Id=StudentIVRData.StudentId')->join('School','School.Id=Student.SchoolId');
		$this->db->where('StudentIVRData.DistrictId',$DistrictId);
        $this->db->group_by("StudentIVRData.StudentId");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function DistrictA1Data($DistrictId)
	{
		$this->db->select('StudentsScoring.*,School.ModelSchool');
		$this->db->from('StudentsScoring')->join('Student','Student.Id=StudentsScoring.StudentId')->join('School','School.Id=Student.SchoolId');
		$this->db->where('StudentsScoring.DistrictId',$DistrictId);
		$this->db->where('StudentsScoring.A1',1);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function DistrictB1Data($DistrictId)
	{
		$this->db->select('StudentsScoring.*,School.ModelSchool');
		$this->db->from('StudentsScoring')->join('Student','Student.Id=StudentsScoring.StudentId')->join('School','School.Id=Student.SchoolId');
		$this->db->where('StudentsScoring.DistrictId',$DistrictId);
		$this->db->where('StudentsScoring.B1',1);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function DistrictC1Data($DistrictId)
	{
		$this->db->select('StudentsScoring.*,School.ModelSchool');
		$this->db->from('StudentsScoring')->join('Student','Student.Id=StudentsScoring.StudentId')->join('School','School.Id=Student.SchoolId');
		$this->db->where('StudentsScoring.DistrictId',$DistrictId);
		$this->db->where('StudentsScoring.C1',1);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function DistrictD1Data($DistrictId)
	{
		$this->db->select('StudentsScoring.*,School.ModelSchool');
		$this->db->from('StudentsScoring')->join('Student','Student.Id=StudentsScoring.StudentId')->join('School','School.Id=Student.SchoolId');
		$this->db->where('StudentsScoring.DistrictId',$DistrictId);
		$this->db->where('StudentsScoring.D1',1);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function TrancateTrainingProgress()
	{
		$this->db->empty_table('TrainingProgress');
	}
	
	public function InsertTrainingProgress($SaveData)
	{
		$this->db->insert('TrainingProgress',$SaveData);
        return $this->db->insert_id();
	}
	
	
}
?>