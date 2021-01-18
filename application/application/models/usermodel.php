<?php
class usermodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function UserListData()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserGroupId=$SessionData['UserGroupId'];
        $this->db->select('Users.*,UserGroup.Name as Designation');
        $this->db->from('Users')->join('UserGroup', 'Users.UserGroupId = UserGroup.Id','Left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function DesignationData()
    {
        $this->db->select('*');
        $this->db->from('UserGroup');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetUserData($Id)
    {
        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where('Id',$Id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetTrainerData($Id)
    {
        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where('UserGroupId',5);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function UpdateUser($Id,$Users)
    {
        $this->db->where('Id',$Id);
        $this->db->update('Users',$Users);
    }
    public function UpdatePassword($Id,$Data){
        $this->db->where('Id',$Id);
        $this->db->update('Users',$Data);
    }

    public function CreateNewUser($SaveData)
    {
        $this->db->insert('Users',$SaveData);
        return $this->db->insert_id();
    }

    public function DeleteUser($Id)
    {
        $this->db->where('Id', $Id);
        $this->db->delete('Users');
    }

    public function MatchPassword($UserId,$Password){
        $this->db->select('*');
        $this->db->from('Users');
        $this->db->where('Id',$UserId);
        $this->db->where('Password',md5($Password));
        $query = $this->db->get();
        return $query->result_array();
    }

}
?>