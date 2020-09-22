<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapping extends CI_Controller {

    /*
     * Vendor Page for this controller.
     *
     * Manage Vendor (Add, Edit and Delete)

     */
    var $sessionData;


    public function __construct()
    {
        parent::__construct();
        $this->load->model('villagemodel');
        $this->load->model('blockmodel');
        $this->load->model('districtmodel');
        $this->load->model('schoolmodel');
//        $this->load->model('mappingmodel');
        if($this->session->userdata("loginUserData"))
        {
            $this->sessionData = $this->session->userdata("loginUserData");
        }
        else
        {
            redirect(base_url(), 'refresh');
            die;
        }
    }


    public function MappingList()
    {

        $this->load->innerTemplate('mapping/MappingList');
    }

    public function MappingListData()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        $mappeddata = $this->districtmodel->MappingListData();

        $UserMappedData = array();
        $tmpArray = array();
        foreach ($mappeddata as $key=>$mapData){
            $tmpArray['Id'] = $mapData['Id'];
            $tmpArray['Sr'] = $key+1;
            $tmpArray['Name'] = $mapData['FirstName'].' '.$mapData['LastName'];
            $tmpArray['Phone'] = $mapData['Phone'];
            $tmpArray['NoSchool'] = count($mapData['SchoolData']);
            $UserMappedData[] = $tmpArray;

        }

        echo json_encode($UserMappedData);
    }

    public function UserSchoolMapping($Id)
    {
        //print_r($Id);
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData']=$SessionData;

        if(count($_POST)) {
            $SaveData = $_POST;

           // $this->districtmodel->DeleteMappedUser($Id);
            foreach ($SaveData['SchoolId'] as $key => $data) {
//                $SendData['UserId'] = $SaveData['UserId'];
                $SendData['UserId'] = $Id;
                $SendData['DistrictId'] = $SaveData['DistrictId'];
                $SendData['SchoolId'] = $key;
                $this->districtmodel->CreateNewMapping($SendData);
            }
            $this->session->set_flashdata('msg', 'Mapping has been added.');
            redirect(base_url() . 'mapping/MappingList', 'refresh');
            die;


            echo "<pre>";
            print_r($Id);
            echo "</pre>";
            die();
        }

        $UsersData=$this->districtmodel->GetUsersData($UserId);
        $data['UsersData']=$UsersData;

        $DistrictData=$this->districtmodel->DistrictListData($UserId);
        $data['DistrictData']=$DistrictData;
        $data['UserId']=$Id;

        $this->load->innerTemplate('mapping/UserSchoolMapping',$data);
    }


    public function GetDistrictSchool($Id){

        //echo 'deepak kumar';
        $UserMappedData = "";
        if($_POST['UserId']){

            $UserMappedData = $this->districtmodel->GetMappedUser($_POST['UserId']);
        }

        $disId = $_POST['Id'];
        $SchoolData=$this->districtmodel->GetDistrictSchool($disId);


//        print_r($_POST['Id']);
        $this->PrintSchool($SchoolData,$UserMappedData);
        //print_r($UserMappedData);
    }


    public function UpdateVillage($Id)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        if(count($_POST))
        {
            $SaveData=$_POST;
            $this->villagemodel->UpdateVillage($Id,$SaveData);
            $this->session->set_flashdata('msg', 'Village has been updated.');
            redirect(base_url().'village/VillageList', 'refresh');
            die;

            echo "<pre>";
            print_r($SaveData);
            echo "</pre>";
        }

        $BlockData=$this->blockmodel->BlockListData($UserId);
        $data['BlockData']=$BlockData;

        $DistrictData=$this->districtmodel->DistrictListData($UserId);
        $data['DistrictData']=$DistrictData;


        $VillageData=$this->villagemodel->GetVillageData($Id);
        $data['VillageData']=$VillageData;
        $this->load->innerTemplate('village/UpdateVillage',$data);
    }





    public function PrintSchool($SchoolData,$MappedData)
    {
//        echo '<pre>';
//        print_r($SchoolData);
//        echo '</pre>';
//        die();

        ?>
        <label for="exampleInputEmail1">SchoolS</label><br>

        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="SelectAll" id="SelectAll">
            <label class="custom-control-label" for="SelectAll">Select All</label>
        </div>

        <table id="MaricoTableData" class="table table-bordered">
        <thead>
        <tr>
            <th class="linkClick">Select</th>
            <th class="linkClick">School</th>
            <th class="linkClick">Village Name</th>
            <th class="linkClick">Gram Panchayat</th>
            <th class="linkClick">Block Name</th>



        </tr>
        </thead>
        <tbody>
            <?php foreach ($SchoolData as $key=>$tmpData) {


                ?>


        <tr>

            <td>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input checkBoxClass" name="SchoolId[<?php echo $tmpData['Id'];?>]" id="<?php echo $tmpData['Id'];?>"
                        <?php
                        foreach($MappedData as $mapTmp) {

                            if ($tmpData['Id'] == $mapTmp['SchoolId']) {
                                echo 'checked';
                            }
                        }

                        ?> >
                    <label class="custom-control-label" for="<?php echo ($tmpData['Id']);?>"></label>
                </div>
            </td>
            <td><?php echo ucfirst($tmpData['Name']);?></td>
            <td><?php echo ucfirst($tmpData['VillageName']);?></td>
            <td><?php echo ucfirst($tmpData['GramPanchayat']);?></td>
            <td><?php echo ucfirst($tmpData['BlockName']);?></td>



        </tr>


            <?php } ?>

        <script>
            $(document).ready(function () {
                $("#SelectAll").click(function () {
                   // alert('deepak');
                    if($(".checkBoxClass").prop('checked')){
                        $(".checkBoxClass").prop('checked', false);
                    }
                    else{
                        $(".checkBoxClass").prop('checked', true);
                    }
                });
            });
        </script>



        <?php
    }


    public function MappedDataPopup($Id){

        //echo 'deepak kumar';
        $UserMappedData = "";
        if($_POST['UserId']){

            $UserMappedData = $this->districtmodel->GetMappedUser($_POST['UserId']);
        }

        $disId = $_POST['Id'];
        //$SchoolData=$this->districtmodel->GetDistrictSchool($disId);
        $SchoolData=$this->schoolmodel->SchoolListDashboardData();


//        print_r($_POST['Id']);
        $this->PrintMappedUserSchool($SchoolData,$UserMappedData);
        //print_r($UserMappedData);
    }

    public function PrintMappedUserSchool($SchoolData,$MappedData)
    {
//        echo '<pre>';
//        print_r($MappedData);
//        echo '</pre>';


//        echo '<pre>';
//        print_r($SchoolData);
//        echo '</pre>';
        //die();

        ?>

        <table id="MaricoTableData" class="table table-bordered">
        <thead>
        <tr>

            <th class="">School</th>
            <th class="">Village Name</th>
            <th class="">Gram Panchayat</th>
            <th class="">Block Name</th>
            <th class="">District</th>
            <th width="120">Action</th>



        </tr>
        </thead>
        <tbody>
        <?php foreach ($SchoolData as $key=>$tmpData) {

            foreach($MappedData as $mapTmp) {

            if ($tmpData['Id'] == $mapTmp['SchoolId']) {

//                echo '<pre>';
//                print_r($tmpData['Id']);
//                echo '</pre>';
//
//                echo '<pre>';
//                print_r('Mapped-'.$mapTmp['SchoolId']);
//                echo '</pre>';

        ?>


        <tr id="school_<?php echo $mapTmp['SchoolId']?>">

            <td><?php echo ucfirst($tmpData['Name']);?></td>
            <td><?php echo ucfirst($tmpData['VillageName']);?></td>
            <td><?php echo ucfirst($tmpData['GramPanchayat']);?></td>
            <td><?php echo ucfirst($tmpData['BlockName']);?></td>
            <td><?php echo ucfirst($tmpData['DistrictName']);?></td>
            <td>

                <a class="fa fa-trash" onclick="DeleteMappingSchool('<?php echo $mapTmp['UserId'] ?>','<?php echo $mapTmp['SchoolId'] ?>')" href="javaScript:void(0)"></a>
            </td>

        </tr>


    <?php }}} ?>

        <script>
            $(document).ready(function () {
                $("#SelectAll").click(function () {
                    // alert('deepak');
                    $(".checkBoxClass").prop('checked', true);
                });
            });
        </script>



        <?php
    }

    public function DeleteMappingSchool(){

        $this->db->where('UserId', $_POST['UserId']);
        $this->db->where('SchoolId', $_POST['SchoolId']);
        $this->db->delete('Mapping');

    }


}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */