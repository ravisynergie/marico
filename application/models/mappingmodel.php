<?php
class mappingmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function MappingListData($UserId)
    {
        $this->db->select('*');
        $this->db->from('Users');
        //$this->db->where('UserId',$UserId);
        $query = $this->db->get();
        return $query->result_array();
    }


}
?>