<?php
class ivrmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }




    public function StudentIvrData()
    {

        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        $this->db->select('*');
        $this->db->from('AttendanceData');
        $Ivrquery = $this->db->get();
        $AllIVR = $Ivrquery->result_array();

//        echo '<pre>';
//        print_r($AllIVR);
//        echo '</pre>';

        $IVR = array();
        foreach ($AllIVR as $key=>$ivr){
            $IVR[]=json_decode($ivr['NumberOfIVRCompleted'], true);

        }

        echo '<pre>';
        print_r($IVR);
        echo '</pre>';

        $tmpDataIVR=array();
        foreach ($IVR as $StudentIVR) {
            foreach ($StudentIVR as $key => $sivr) {

                    $tmpDataIVR[$key] = $sivr;
                    // break;
                }
            }
        echo '<pre>';
        print_r(count($tmpDataIVR));
        echo '</pre>';

//        echo '<pre>';
//        print_r($IVR);
//        echo '</pre>';

        //return $IVR;
       // die;

            $IVRData=array();

            $this->db->select('Student.*,School.Name as SchoolName,School.Id as SchoolId,District.Name as DistrictName,District.Id as DistrictId,Block.Name as BlockName,Village.Name as VillageName,Village.GramPanchayat');
            $this->db->from('Student')->join('School', 'Student.SchoolId = School.Id','Left')->join('Village', 'School.VillageId = Village.Id','Left')->join('District', 'District.Id = Village.DistrictId','Left')->join('Block', 'Block.Id = Village.BlockId','Left');
            $this->db->group_by('Student.Id');
            //$this->db->where('Village.DistrictId',$tmpDis['Id']);
            $this->db->order_by('Student.Id','ASC');


            $query = $this->db->get();

            foreach($query->result_array() as $tmpData)
            {

                $IVRData[]=$tmpData;

            }

//        echo '<pre>';
//        print_r($IVRData);
//        echo '</pre>';

        //return $IVR;
        die;

    }



}
?>