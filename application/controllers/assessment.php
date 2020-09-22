<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assessment extends CI_Controller {

    /*
     * Vendor Page for this controller.
     *
     * Manage Vendor (Add, Edit and Delete)

     */
    var $sessionData;


    public function __construct()
    {
        parent::__construct();
        $this->load->model('globalmodel');
        $this->load->model('villagemodel');
        $this->load->model('blockmodel');
        $this->load->model('districtmodel');
        $this->load->model('globalmodel');
        $this->load->model('assessmentmodel');
        $this->load->model('trainingmodel');
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


    public function AssessmentList()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;

        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $AssessmentData=$this->assessmentmodel->AssessmentListData($UserId);

        $data['AssessmentData'] = $AssessmentData;
        $data['UserGroupId']=$SessionData['UserGroupId'];

        $this->load->innerTemplate('assessment/AssessmentList',$data);
    }

    public function AssessmentListData()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $AssessmentData=$this->assessmentmodel->AssessmentListData($UserId);
        $AssessmentListData=array();

        $tmpArray = array();
        foreach($AssessmentData as $key=>$assessment){
            $tmpArray['Sno'] = $key+1;
            $tmpArray['Id'] = $assessment['Id'];
            $tmpArray['Name'] = $assessment['Name'];
            $tmpArray['QuestionCount'] = count(json_decode($assessment['Question']));
            $AssessmentListData[]=$tmpArray;
        }

        echo json_encode($AssessmentListData);
    }

    public function AddNewAssessment()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;

        if(count($_POST))
        {
            $SaveData=$_POST;

            $SaveData['UserId']=$UserId;
            $SaveData['Question'] = json_encode($_POST['Question']);
            $SaveData['DateCreated']=date('Y-m-d h:i:s');
            $SaveData['LastUpdated']=date('Y-m-d h:i:s');


//            echo "<pre>";
//            print_r($SaveData);
//            echo "</pre>";
//            die();

            $this->assessmentmodel->CreateNewAssessment($SaveData);
            $this->session->set_flashdata('msg', 'Assessment has been added.');
            redirect(base_url().'assessment/AssessmentList', 'refresh');

            die;

            echo "<pre>";
            print_r($SaveData);
            echo "</pre>";
        }



        $this->load->innerTemplate('assessment/AddNewAssessment',$data);
    }

    public function UpdateAssessment($Id)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        if(count($_POST))
        {
            $SaveData=$_POST;
            $SaveData['StakeholdersName'] = json_encode($_POST['StakeholdersName']);
            $SaveData['StakeholdersDesignation'] = json_encode($_POST['StakeholdersDesignation']);
            $SaveData['OtherDesignationName'] = json_encode($_POST['OtherDesignationName']);
            $SaveData['StakeholdersContact'] = json_encode($_POST['StakeholdersContact']);
//            echo "<pre>";
//            print_r($SaveData);
//            echo "</pre>";
//            die;

            $this->villagemodel->UpdateVillage($Id,$SaveData);
            $this->session->set_flashdata('msg', 'Village has been updated.');
            redirect(base_url().'village/VillageList', 'refresh');
            die;

            echo "<pre>";
            print_r($SaveData);
            echo "</pre>";
        }

        $DistrictData=$this->globalmodel->UserDistrictList($UserId);
        $data['DistrictData']=$DistrictData;

        $BlockData=$this->globalmodel->UserBlockList($UserId);
        $data['BlockData']=$BlockData;


        $VillageData=$this->villagemodel->GetVillageData($Id);
        $data['VillageData']=$VillageData;
        $this->load->innerTemplate('village/UpdateVillage',$data);
    }

    public function DeleteAssessment()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        $this->villagemodel->DeleteVillage($_POST['Id']);
    }


    public function AddQuestion($num)
    {
        ?>

        <div class="row" id="Q<?php echo $_POST['num']; ?>">
            <div class="col-1" style="margin-right: -25px">
                <label for="exampleInputEmail1">Question<?php echo $_POST['num']; ?></label>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <input class="form-control" id="Question" name="Question[]" placeholder="Enter Question" type="text">
                </div>
            </div>

            <div class="col-1">
                <div Class="circleplus" style="margin-top: 5px; border: solid 2px #c71b26;padding-left: 10px;" onclick="removeQuestion('<?php echo $_POST['num']; ?>')">-</div>

            </div>


        </div>
        <script>
            function removeQuestion(id) {
                $('#Q'+id).remove();
                otherTime = otherTime-1;
            }
        </script>

        <?php
    }



    public function QuestionDataPopup($Id){

        //echo 'deepak kumar';
        $QuestionMappedData = "";
        if($_POST['Id']){

            $QuestionMappedData = $this->assessmentmodel->GetMappedQuestion($_POST['Id']);
            $this->PrintMappedQuestionPopCount($QuestionMappedData);
        }



    }

    public function AssessQuestionDataPopup(){

        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

//        print_r($_POST['Assessmentid']);
//        print_r($_POST['Studentid']);
//        print_r($_POST['Trainingid']);


           $QuestionData = $this->assessmentmodel->GetMappedQuestion($_POST['Assessmentid']);
        $SchoolData = $this->assessmentmodel->GetSchoolName($_POST['Studentid']);
        $StudentData = $this->assessmentmodel->GetStudentName($_POST['Studentid']);
        $DistrictData = $this->trainingmodel->GetAttendanceDistrict($_POST['Trainingid']);

        $AssesmentData =$this->assessmentmodel->GetAssessmentData($_POST['Assessmentid'],$_POST['Studentid'],$_POST['Trainingid']);
//            $data['QuestionData'] = $QuestionData;
//
//            $SaveData=$_POST;
//
//            $SaveData['UserId']=$UserId;
//            $SaveData['Answer'] = json_encode($_POST['Answer']);
//            $SaveData['DateCreated']=date('Y-m-d h:i:s');
//            $SaveData['LastUpdated']=date('Y-m-d h:i:s');


//            echo "<pre>";
//            print_r($SaveData);
//            echo "</pre>";
//            die();

//            $this->assessmentmodel->CreateNewAssessment($SaveData);
//            $this->session->set_flashdata('msg', 'Assessment has been added.');
//            redirect(base_url().'assessment/AssessmentList', 'refresh');




        $this->PrintMappedQuestion($QuestionData,$StudentData,$_POST['Trainingid'],$SchoolData,$DistrictData,$AssesmentData);
    }





    public function PrintMappedQuestion($QuestionData,$StudentData,$Trainingid,$SchoolData,$DistrictData,$AssesmentData)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        $Questions = json_decode($QuestionData[0]['Question']);
        $AssesmentMarks = json_decode($AssesmentData[0]['AssessmentStudentData']);
        //echo 'Assessment Marks';
       // print_r($AssesmentMarks);
       // echo 'Studentid';
        //print_r($StudentData[0]['Name']);
//        echo 'Trainingid';
//        print_r($Trainingid);

       // die();


        ?>
        <span><b>Name:</b> <?php echo $StudentData[0]['Name']; ?></span><br>
        <span><b>School:</b> <?php echo $SchoolData[0]['LocationName']; ?></span>
        <form method="post" id="SaveStudentAssessmentData" onSubmit="return SaveStudentAssessmentData()">
            <input class="form-control" id="TrainingId" name="TrainingId" value="<?php echo $Trainingid; ?>" placeholder="Marks" type="hidden" required>
            <input class="form-control" id="StudentId" name="StudentId" value="<?php echo $StudentData[0]['Id']; ?>" placeholder="Marks" type="hidden" required>
            <input class="form-control" id="UserId" name="UserId" value="<?php echo $UserId; ?>" placeholder="Marks" type="hidden" required>
            <input class="form-control" id="AssessmentId" name="AssessmentId" value="<?php echo $QuestionData[0]['Id']; ?>" placeholder="Marks" type="hidden" required>
            <input class="form-control" id="DistrictId" name="DistrictId" value="<?php echo $DistrictData[0]['DistrictId']; ?>" placeholder="Marks" type="hidden" required>
        <table id="MaricoTableData" class="table table-bordered">
        <thead>
        <tr>

            <th  class="">Question</th>
            <th width="150" class="">Marks</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($Questions as $key=>$tmpData) {

                ?>

                <tr>

                    <td><?php echo ucfirst($tmpData);?></td>
                    <td><input class="form-control" id="Marks" name="Marks[<?php echo $key;?>]" value="<?php echo $AssesmentMarks[$key];?>" placeholder="Marks" type="number" min="0" max="3" autocomplete="off" required></td>

                </tr>



            <?php } ?>

        </tbody>
        </table>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>

        </div>
        </form>
        <?php
    }

    public function PrintMappedQuestionPopCount($QuestionData)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        $Questions = json_decode($QuestionData[0]['Question']);


        ?>

            <table id="MaricoTableData" class="table table-bordered">
                <thead>
                <tr>

                    <th  class="">Question</th>


                </tr>
                </thead>
                <tbody>
                <?php foreach ($Questions as $key=>$tmpData) {

                    ?>

                    <tr>

                        <td><?php echo ucfirst($tmpData);?></td>


                    </tr>



                <?php } ?>

                </tbody>
            </table>

        <?php
    }






}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */