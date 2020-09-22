<?php
class loginmodel extends CI_Model
{
	public function __construct() 
	{
		parent::__construct();
	} 
	
	public function validate($data)
	{
		$query = $this->db->query("select Id,FirstName,LastName,Email,UserGroupId from Users where UserName='".$data['userName']."' and Password='".md5($data['password'])."'");
		if($query->num_rows())
		{
			$dataRow=$query->result_array();
			$dataRow=$dataRow['0'];
			$dataRow['MenuItem']='All';
			$dataRow['Status']='1';
			return $dataRow;
		}
		else
		{
			return "Invalid";	
		}
	}

    public function validateAuth($data)
    {
        $TodayDate = date('Y-m-d');
        $query = $this->db->query("select * from Authentication where Code='".$data['auth']."' and Date='".$TodayDate."' and Status=0");
        if($query->num_rows())
        {
            $UserId = $query->result_array()[0]['UserId'];
            $this->db->query("update Authentication set Status = 1 where Code='".$data['auth']."' and Date='".$TodayDate."' and Status=0");
            $query2 = $this->db->query("select Id,FirstName,LastName,Email,UserGroupId from Users where Id='".$UserId."'");
            $dataRow=$query2->result_array();
            $dataRow=$dataRow['0'];
            $dataRow['MenuItem']='All';
            $dataRow['Status']='1';
            return $dataRow;
        }
        else
        {
            return "Invalid";
        }
    }

    public function SaveAuth($SaveData)
    {
        $this->db->insert('Authentication',$SaveData);
        return $this->db->insert_id();
    }

    public function CheckTodatAuth($UserId){
	    $TodayDate = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('Authentication');
        $this->db->where('UserId',$UserId);
        $this->db->where('Status',1);
        $this->db->like('Date',$TodayDate);
        $query = $this->db->get();
        return $query->result_array();
    }
		
}
?>