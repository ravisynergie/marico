<?php
class testimonialmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function TestimonialListData($UserId, $Type='')
    {
        $this->db->select('*');
        $this->db->from('Testimonial');
        $this->db->where('UserId',$UserId);
        if($Type != '') {
            if ($Type == 'All') {

            } else {
                $this->db->where('Type', $Type);

            }
        }
        $query = $this->db->get();
        $TestimonialData = $query->result_array();

        return $TestimonialData;


    }

    public function TestimonialManagerListData($UserId)
    {
        $this->db->select('*');
        $this->db->from('Testimonial');
        //$this->db->where('UserId',$UserId);
        $this->db->order_by('Id', 'random');
        $this->db->limit(40);
        $query = $this->db->get();
        $TestimonialData = $query->result_array();
        return $TestimonialData;


    }

    public function TestimonialSingleData($UserId){

        $this->db->select('*');
        $this->db->from('Testimonial');
        //$this->db->where('UserId',$UserId);
        $this->db->order_by('Id', 'random');
        $this->db->limit(1);
        $query = $this->db->get();
        $TestimonialData = $query->result_array();
        return $TestimonialData;
    }

    public function TestimonialPopUp($TestiId)
    {
        $this->db->select('*');
        $this->db->from('Testimonial');
        $this->db->where('Id',$TestiId);
        $query = $this->db->get();
        $TestimonialData = $query->result_array();
        return $TestimonialData;


    }

    public function InsertTestimonial($Data)
    {
        $this->db->Insert('Testimonial',$Data);
        return $this->db->insert_id();
    }


    public function ImageDelete($Id)
    {
        $this->db->where('Id', $Id);
        $this->db->delete('Testimonial');
    }

}
?>