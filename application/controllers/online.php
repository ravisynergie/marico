<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Online extends CI_Controller {

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
        $this->load->model('studentmodel');
        $this->load->model('onlinemodel');
        $this->load->model('assessmentmodel');
        $this->load->model('usermodel');
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


    public function TrainnerSchool()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;

        $TrainnerSchoolData = $this->onlinemodel->TrainnerSchoolData($UserId,$SessionData,$_GET);
        $data['TrainnerSchoolData'] = $TrainnerSchoolData;

        $TrainerData = $this->usermodel->GetTrainerData();
        $data['TrainerData'] = $TrainerData;

        if ($_GET['debug'] == 1) {
            echo '<pre>';
            print_r($TrainnerSchoolData);
            echo '</pre>';
            //die;
        }
//die;
        $this->load->innerTemplate('online/TrainnerSchool',$data);
    }

    public function TrainnerSchoolStudentField()
    {
		$SessionData = $this->session->userdata("loginUserData");
        $UserId = $SessionData['Id'];
		
		if($_POST['FieldValue'])
		{
			$StudentId=$_POST['StudentId'];
			$ModuleNumber=$_POST['ModuleNumber'];
			
			if('TraingDate'==$_POST['FieldName'])
			{
				$TraingData=$this->onlinemodel->OnlineDataTraingData($StudentId,$ModuleNumber);
				$TraingData=$TraingData['0'];
				if($TraingData['TraingDate']=='0000-00-00')
				{
					$InsertData=array();
					$InsertData['UserId']=$UserId ;
					$InsertData['StudentId']=$StudentId ;
					$InsertData['ModuleNumber']=$ModuleNumber ;
					$InsertData['TrainingDate']=$_POST['FieldValue'] ;
					$InsertData['DateCreated']=date('Y-m-d h:i:s') ;
					$this->onlinemodel->CreateOnlineTrainingLog($InsertData);
				}
			}
			
			
			$InsertData=array();
			$InsertData[$_POST['FieldName']] = $_POST['FieldValue'];
			$InsertData['DateCreated'] = date('Y-m-d h:i:s');
			$this->onlinemodel->UpdateOnlineData($StudentId,$ModuleNumber,$InsertData);
		}
	}
	
	
	public function TrainnerSchoolStudent($SchoolId,$ModuleNumber)
    {

        $SessionData = $this->session->userdata("loginUserData");
        $UserId = $SessionData['Id'];

        $TrainnerSchoolStudentData = $this->onlinemodel->TrainnerSchoolOnlyStudentData($SchoolId);
        if ($ModuleNumber == '') $ModuleNumber = 100;
		
		if($ModuleNumber==100)
		{
			foreach ($TrainnerSchoolStudentData as $tmpData) 
			{
				$InsertData['SchoolId'] = $SchoolId;
				$InsertData['ModuleNumber'] = $ModuleNumber;
				$InsertData['StudentId'] = $tmpData['Id'];
				$InsertData['DateCreated'] = date('Y-m-d h:i:s');
				$this->onlinemodel->InsertOnlineData($tmpData['Id'], $ModuleNumber, $InsertData);
			}
		}


        if($ModuleNumber==50)
        {
            foreach ($TrainnerSchoolStudentData as $tmpData)
            {
                $InsertData['SchoolId'] = $SchoolId;
                $InsertData['ModuleNumber'] = $ModuleNumber;
                $InsertData['StudentId'] = $tmpData['Id'];
                $InsertData['DateCreated'] = date('Y-m-d h:i:s');
                $this->onlinemodel->InsertOnlineData($tmpData['Id'], $ModuleNumber, $InsertData);
            }
        }

//        if($ModuleNumber == 150){
//            $TrainnerSchoolStudentData = $this->onlinemodel->TrainnerSchoolStudentDataTraining2($SchoolId, $_GET, $ModuleNumber);
//        }
//        elseif($ModuleNumber == 200) {
//            $TrainnerSchoolStudentData = $this->onlinemodel->TrainnerSchoolStudentDataTraining3($SchoolId, $_GET, $ModuleNumber);
//        }
//        else{
//            $TrainnerSchoolStudentData = $this->onlinemodel->TrainnerSchoolStudentData($SchoolId, $_GET, $ModuleNumber);
//        }

        $TrainnerSchoolStudentData = $this->onlinemodel->TrainnerSchoolStudentData($SchoolId, $_GET, $ModuleNumber);
		$PageTrainnerSchoolStudentData=array_chunk($TrainnerSchoolStudentData,300);
        $data['PageTrainnerSchoolStudentData'] = $PageTrainnerSchoolStudentData;
		
		$PageNumber=0; 
		if($_GET['PageNumber'])
		{
			$PageNumber=$_GET['PageNumber'];
		}
		$PrevPageNumber=$PageNumber-1;
		if($PrevPageNumber<0)
		{
			$PrevPageNumber=0;
		}
		
		$NextPageNumber=$PageNumber+1;
		if($NextPageNumber>(count($PageTrainnerSchoolStudentData)-1))
		{
			$NextPageNumber=count($PageTrainnerSchoolStudentData)-1;
		}
		
		$data['CurrentPage'] = $PageNumber;
		$data['PrevPageNumber'] = $PrevPageNumber;
		$data['NextPageNumber'] = $NextPageNumber;
		$data['TrainnerSchoolStudentData'] = $PageTrainnerSchoolStudentData[$PageNumber];
        $data['SchoolId'] = $SchoolId;
        $data['ModuleNumber'] = $ModuleNumber;

//        if ($_GET['debug'] == 1){
//            echo "<pre>";
//            print_r($TrainnerSchoolStudentData);
//            echo "</pre>";
//         }

        if(count($_POST))
        {
			foreach ($_POST['StudentId'] as $StudentId)
			{
				$InsertData=array();
				if($_POST['OwnerMobile'][$StudentId]) $InsertData['OwnerMobile'] = $_POST['OwnerMobile'][$StudentId];
				if($_POST['MobileType'][$StudentId]) $InsertData['MobileType'] = $_POST['MobileType'][$StudentId];
				if($_POST['WhatsUpAvailable'][$StudentId]) $InsertData['WhatsUpAvailable'] = $_POST['WhatsUpAvailable'][$StudentId];
				if($_POST['EmailFamilyMember'][$StudentId]) $InsertData['EmailFamilyMember'] = $_POST['EmailFamilyMember'][$StudentId];
				if($_POST['PhoneNumber'][$StudentId]) $InsertData['PhoneNumber'] = $_POST['PhoneNumber'][$StudentId];
				if($_POST['StatusCalling'][$StudentId]) $InsertData['StatusCalling'] = $_POST['StatusCalling'][$StudentId];
				if($_POST['TraingDate'][$StudentId]) $InsertData['TraingDate'] = $_POST['TraingDate'][$StudentId];
				if($_POST['TrainingTime'][$StudentId]) $InsertData['TrainingTime'] = $_POST['TrainingTime'][$StudentId];
				if($_POST['Remarks'][$StudentId]) $InsertData['Remarks'] = $_POST['Remarks'][$StudentId];
				$this->onlinemodel->UpdateOnlineData($StudentId,$ModuleNumber,$InsertData);
            }
			die;
		}


        $this->load->innerTemplate('online/TrainnerSchoolStudent',$data);
    }


	public function TrainingScheduled($SchoolId)
	{
        //echo "<pre>";
		//print_r($_POST);
		//echo "</pre>";
		//die;
		
		$SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        $SchoolName = $this->onlinemodel->GetSchoolName($SchoolId);
        $data['SchoolName'] = $SchoolName;
        $TrainingScheduled = $this->onlinemodel->TrainingScheduledDataById($SchoolId);
        $data['TrainingScheduled'] = $TrainingScheduled;

		$UploadedDocument = $this->onlinemodel->TrainingUploadedDocument($SchoolId);
        $data['UploadedDocument'] = $UploadedDocument;
		
		
        $AssessmentData=$this->assessmentmodel->AssessmentListData($UserId);
        $data['AssessmentData'] = $AssessmentData;

        $Assessment2Data=$this->assessmentmodel->Assessment2ListData($UserId);
        $data['Assessment2Data'] = $Assessment2Data;

        if($_GET['deepak'] == 1){
//            echo "<pre>";
//            print_r($Assessment2Data);
//            echo "</pre>";
        }



        if($_POST['Marks']){

            $MarksObtained = $_POST['Marks'];
            $TotalMarks=0;
            foreach ($MarksObtained as $mark){
                $TotalMarks=$TotalMarks+$mark;
            }

            $this->onlinemodel->DeleteAssessment($_POST['AssessmentId'],$_POST['StudentId'],$_POST['ModuleNumber']);
            $SaveData=array();
            $SaveData['StudentId']=$_POST['StudentId'];
            $SaveData['ModuleNumber']=$_POST['ModuleNumber'];
            $SaveData['AssessmentId']=$_POST['AssessmentId'];
            $SaveData['UserId']=$UserId;
            $SaveData['AssessmentStudentData']=json_encode($_POST['Marks']);
            $SaveData['TotalMarks']=$TotalMarks;
            $SaveData['DateCreated']=date('Y-m-d h:i');

            $this->onlinemodel->SaveAssessmentData($SaveData);
            $this->session->set_flashdata('msg', 'Assessment data has been recorded.');
            //redirect(base_url().'online/TrainingScheduled/'.$SchoolId);
           // die();
        }

        if($_POST['AssessmentUpload'])
		{

            $SaveData=array();

            $NewFileName='assets/AssessmentDoc/'.time().'_'.$_FILES['fileToUpload']['name'];
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$NewFileName);
            $SaveData['AssessmentDocument']=$NewFileName;

            $this->onlinemodel->UpdateOnlineAssessmentData($_POST['StudentId'],$_POST['SchoolId'],$_POST['TrainingDate'],$_POST['ModuleNumber'],$SaveData);
            redirect(base_url().'online/TrainingScheduled/'.$SchoolId, '');
            die;
        }


        if($_POST){

            $SaveData=array();

			//echo "<pre>";
			//print_r($_FILES);
			//echo "</pre>";
			//die;
		
            $NewFileName1='assets/OnlineTrainingImage/'.time().'_'.$_FILES['fileToUpload1']['name'];
            move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"],$NewFileName1);
            
			if($_FILES['fileToUpload2']['name'])
			{
				$NewFileName2='assets/OnlineTrainingImage/'.time().'_'.$_FILES['fileToUpload2']['name'];
           		move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"],$NewFileName2);
			}

            $SaveData['UserId']=$UserId;
            $SaveData['SchoolId']=$_POST['SchoolId'];
			$SaveData['ModuleNumber']=$_POST['ModuleNumber'];
            $SaveData['TrainingDate']=$_POST['TrainingDate'];
            $SaveData['TrainingTime']=$_POST['TrainingTime'];
            $SaveData['GoogleDrivePath']=$_POST['GoogleDrivePath'];
			$SaveData['WhatsAppCall']=$_POST['WhatsAppCall'];
            $SaveData['ImageOnePath']=$NewFileName1;
            if($NewFileName2) $SaveData['ImageTwoPath']=$NewFileName2;
            $SaveData['DateCreated']=date('Y-m-d h:i:s');

            $this->onlinemodel->InsertImage($SaveData);
            redirect(base_url().'online/TrainingScheduled/'.$SchoolId, '');
            die;
        }
        $this->load->innerTemplate('online/TrainingScheduled',$data);

    }
	
	
	public function OnlineTrainingReport($SchoolId)
	{
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;

        $FilterSearch=array();
		if($_GET['TrainerId'])
		{
			$FilterSearch['TrainerId']=$_GET['TrainerId'];
		}
		
		$TrainingScheduled = $this->onlinemodel->OnlineTrainingReport($SchoolId,$FilterSearch,$SessionData);
		foreach($TrainingScheduled as $StudentId=>$tmpData)
		{
			foreach($tmpData['Modules']	as $ModuleNumber=>$tmpModuleNumber)
			{
				$AssessmentData=$this->onlinemodel->OnlineTrainingAssessmentReport($StudentId,$ModuleNumber);
				if(count($AssessmentData))
				{
					$TrainingScheduled[$StudentId]['Assessment'][$ModuleNumber]=$AssessmentData['0'];
				}
			}
		}
		$data['TrainingScheduled'] = $TrainingScheduled;
		
		$TrainerData = $this->usermodel->GetTrainerData();
        $data['TrainerData'] = $TrainerData;
		
		//echo "<pre>";
		//print_r($TrainingScheduled);
		//echo "</pre>";
		//die;
		$this->load->innerTemplate('online/OnlineTrainingReport',$data);		

    }
	
	
	
    public function TrainingModule(){
        $SchoolId=$_POST['SchoolId'];
        $TrainingDate=$_POST['TrainingDate'];
		$ModuleNumber=$_POST['ModuleNumber'];

        $TrainingTimeData = $this->onlinemodel->GetTrainingTime($SchoolId,$TrainingDate,$ModuleNumber);
        //$ModuleTrainingData = $this->onlinemodel->ModuleTrainingData($SchoolId,$TrainingDate);
        $trainingTime=array();
        foreach ($TrainingTimeData as $data){
            $trainingTime[]=$data['TrainingTime'];
        }
        $UniqueTrainingTime = array_unique($trainingTime);

        ?>
        <form method="post" action="" enctype="multipart/form-data">

            <input class="form-control" id="SchoolId"  name="SchoolId" value="<?php echo $SchoolId; ?>" type="hidden">
            <input class="form-control" id="TrainingDate"  name="TrainingDate" value="<?php echo $TrainingDate; ?>" type="hidden">
            <input class="form-control" id="ModuleNumber"  name="ModuleNumber" value="<?php echo $ModuleNumber; ?>" type="hidden">

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Select Training Time</label>
                    <select class="form-control minwidth150" name="TrainingTime" id="TrainingTime" required>
                        <option value="">Training Time</option>
                        <?php
                        foreach ($UniqueTrainingTime as $tmpTime){
                        ?>
                         <option value="<?php echo $tmpTime?>"><?php echo $tmpTime?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Type Of Call</label>
                    <select class="form-control minwidth150" name="WhatsAppCall" id="WhatsAppCall" required>
                        <option value="">What's APP Call</option>
                        <option value="WhatsAPP">What's APP Video Call</option>
                        <option value="Hangout">Hangout</option>   
                        <option value="ConfrenceCall">Confrence Call</option>                        
                    </select>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Google Drive File Path</label>
                    <input class="form-control" type="text" name="GoogleDrivePath" id="GoogleDrivePath" />
                </div>
            </div>
            
            
            
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Upload photo 1st </label>
                    <input required class="form-control" type="file" name="fileToUpload1" />
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label>Upload photo 2nd </label>
                    <input class="form-control" type="file" name="fileToUpload2" />
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>        
        <?php

    }

	public function TrainnerStudentPopup()
	{
		$StudentId=$_POST['StudentId'];
		$ModuleNumber=$_POST['ModuleNumber'];
		$TrainnerSchoolStudentData = $this->onlinemodel->TrainnerSchoolStudentDataById($StudentId,$ModuleNumber);
		$data=$TrainnerSchoolStudentData['0'];
		
		if($data['PhoneNumber']=='')
		{
			$data['PhoneNumber']=$data['PhoneNo'];
		}
		if($data['TraingDate']=='0000-00-00')
		{
			 $data['TraingDate']='';
		}
		?>
        <div class="form-group">
            <label for="exampleInputEmail1">Owner</label>
            <select class="form-control minwidth150" id="OwnerMobile" name="OwnerMobile[<?php echo $data['Id']?>]" onChange="SaveFieldDataPopup('<?php echo $data['Id']?>','OwnerMobile',this.value)">
                <option value="">Owner</option>
                <option value="Father" <?php if($data['OwnerMobile']=='Father') { echo "selected"; } ?>>Father</option>
                <option value="Mother" <?php if($data['OwnerMobile']=='Mother') { echo "selected"; } ?>>Mother</option>
                <option value="Sister" <?php if($data['OwnerMobile']=='Sister') { echo "selected"; } ?>>Sister</option>
                <option value="Other" <?php if($data['OwnerMobile']=='Other') { echo "selected"; } ?>>Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Mobile Type</label>
            <select class="form-control minwidth150" id="MobileType" name="MobileType[<?php echo $data['Id']?>]" onChange="SaveFieldDataPopup('<?php echo $data['Id']?>','MobileType',this.value)">
                <option value="">MobileType</option>
                <option value="SmartPhone" <?php if($data['MobileType']=='SmartPhone') { echo "selected"; } ?>>Smart phone</option>
                <option value="NotSmartPhone" <?php if($data['MobileType']=='NotSmartPhone') { echo "selected"; } ?>>Not smart phone</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">WhatsAPP?</label>
            <select class="form-control minwidth150" id="WhatsUpAvailable" name="WhatsUpAvailable[<?php echo $data['Id']?>]" onChange="SaveFieldDataPopup('<?php echo $data['Id']?>','WhatsUpAvailable',this.value)">
                <option value="">WhatsAPP</option>
                <option value="Yes" <?php if($data['WhatsUpAvailable']=='Yes') { echo "selected"; } ?>>Yes</option>
                <option value="No" <?php if($data['WhatsUpAvailable']=='No') { echo "selected"; } ?>>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input class="form-control minwidth150" id="Email[]" name="EmailFamilyMember[<?php echo $data['Id']?>]" value="<?php echo $data['EmailFamilyMember']; ?>" placeholder="Email" type="text" onBlur="SaveFieldDataPopup('<?php echo $data['Id']?>','EmailFamilyMember',this.value)">
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Phone Number</label>
            <input class="form-control minwidth150" id="PhoneNumber[]" name="PhoneNumber[<?php echo $data['Id']?>]" value="<?php echo $data['PhoneNumber']; ?>" placeholder="Phone" type="text" onBlur="SaveFieldDataPopup('<?php echo $data['Id']?>','PhoneNumber',this.value)">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Call Status</label>
            <select class="form-control minwidth150" id="StatusCalling" name="StatusCalling[<?php echo $data['Id']?>]" onChange="SaveFieldDataPopup('<?php echo $data['Id']?>','StatusCalling',this.value)">
            <option value="">Call Status</option>
            <option value="Not Reachable" <?php if($data['StatusCalling']=='Not Reachable') { echo "selected"; } ?>>Not Reachable</option>
            <option value="Switched Off" <?php if($data['StatusCalling']=='Switched Off') { echo "selected"; } ?>>Switched Off</option>
            <option value="Busy" <?php if($data['StatusCalling']=='Busy') { echo "selected"; } ?>>Busy</option>
            <option value="Not Picked" <?php if($data['StatusCalling']=='Not Picked') { echo "selected"; } ?>>Not Picked</option>
            <option value="Connected" <?php if($data['StatusCalling']=='Connected') { echo "selected"; } ?>>Connected</option>
        </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Date</label>
            <input type="text" class="form-control minwidth150" readonly placeholder="Traing Date" value="<?php echo $data['TraingDate']; ?>" name="TraingDate[<?php echo $data['Id']?>]" id="TraingDate2-<?php echo $data['Id']?>" autocomplete="off">
			<script>
            $( function() 
            {
                $("#TraingDate2-<?php echo $data['Id']?>").datepicker({ 
                    dateFormat: 'yy-mm-dd',
                    onSelect: function(date) {
                        if(date)
                        {
                            SaveFieldDataPopup('<?php echo $data['Id']?>','TraingDate',date);
                        }
                      }
                });
              
            });							
            
            </script>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Training Time</label>
            <select class="form-control minwidth150" id="TrainingTime-<?php echo $data['Id']?>" name="TrainingTime[<?php echo $data['Id']?>]" onChange="SaveFieldDataPopup('<?php echo $data['Id']?>','TrainingTime',this.value)">
                <option value="">Training Time</option>
                <option value="08:00 AM - 09:00 AM" <?php if($data['TrainingTime']=='08:00 AM - 09:00 AM') { echo "selected"; } ?>>08:00 AM - 09:00 AM</option>
                <option value="09:00 AM - 10:00 AM" <?php if($data['TrainingTime']=='09:00 AM - 10:00 AM') { echo "selected"; } ?>>09:00 AM - 10:00 AM</option>
                <option value="10:00 AM - 11:00 AM" <?php if($data['TrainingTime']=='10:00 AM - 11:00 AM') { echo "selected"; } ?>>10:00 AM - 11:00 AM</option>
                <option value="11:00 AM - 12:00 PM" <?php if($data['TrainingTime']=='11:00 AM - 12:00 PM') { echo "selected"; } ?>>11:00 AM - 12:00 PM</option>
                <option value="12:00 PM - 01:00 PM" <?php if($data['TrainingTime']=='12:00 PM - 01:00 PM') { echo "selected"; } ?>>12:00 PM - 01:00 PM</option>
                <option value="01:00 PM - 02:00 PM" <?php if($data['TrainingTime']=='01:00 PM - 02:00 PM') { echo "selected"; } ?>>01:00 PM - 02:00 PM</option>
                <option value="02:00 PM - 03:00 PM" <?php if($data['TrainingTime']=='02:00 PM - 03:00 PM') { echo "selected"; } ?>>02:00 PM - 03:00 PM</option>
                <option value="03:00 PM - 04:00 PM" <?php if($data['TrainingTime']=='03:00 PM - 04:00 PM') { echo "selected"; } ?>>03:00 PM - 04:00 PM</option>
                <option value="04:00 PM - 05:00 PM" <?php if($data['TrainingTime']=='04:00 PM - 05:00 PM') { echo "selected"; } ?>>04:00 PM - 05:00 PM</option>
                <option value="05:00 PM - 06:00 PM" <?php if($data['TrainingTime']=='05:00 PM - 06:00 PM') { echo "selected"; } ?>>05:00 PM - 06:00 PM</option>		
                <option value="06:00 PM - 07:00 PM" <?php if($data['TrainingTime']=='06:00 PM - 07:00 PM') { echo "selected"; } ?>>06:00 PM - 07:00 PM</option>
                <option value="07:00 PM - 08:00 PM" <?php if($data['TrainingTime']=='07:00 PM - 08:00 PM') { echo "selected"; } ?>>07:00 PM - 08:00 PM</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Remarks</label>
            <input class="form-control minwidth150" id="Remarks" value="<?php echo $data['Remarks']; ?>" name="Remarks[<?php echo $data['Id']?>]" placeholder="Remarks" type="text" onBlur="SaveFieldDataPopup('<?php echo $data['Id']?>','Remarks',this.value)">
        </div>

        
        <?php
		
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
        $ModuleNumber = $_POST['ModuleNumber'];


        $AssesmentData =$this->onlinemodel->GetAssessmentData($_POST['Assessmentid'],$_POST['Studentid'],$ModuleNumber);



        $this->PrintMappedQuestion($QuestionData,$StudentData,$SchoolData,$AssesmentData,$ModuleNumber);
    }





    public function PrintMappedQuestion($QuestionData,$StudentData,$SchoolData,$AssesmentData,$ModuleNumber)
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];

        $Questions = json_decode($QuestionData[0]['Question']);
        $AssesmentMarks = json_decode($AssesmentData[0]['AssessmentStudentData']);



        ?>
        <span><b>Name:</b> <?php echo $StudentData[0]['Name']; ?></span><br>
        <span><b>School:</b> <?php echo $SchoolData[0]['LocationName']; ?></span>
        <form method="post" id="SaveStudentAssessmentData" onSubmit="return SaveStudentAssessmentData()">

            <input class="form-control" id="StudentId" name="StudentId" value="<?php echo $StudentData[0]['Id']; ?>" type="hidden" required>
            <input class="form-control" id="UserId" name="UserId" value="<?php echo $UserId; ?>" type="hidden" required>
            <input class="form-control" id="AssessmentId" name="AssessmentId" value="<?php echo $QuestionData[0]['Id']; ?>" type="hidden" required>
            <input class="form-control" id="ModuleNumber" name="ModuleNumber" value="<?php echo $ModuleNumber; ?>" type="hidden" required>

            <table id="MaricoTableData" class="table table-bordered">
                <thead>
                <tr>

                    <th>Question</th>
                    <th width="150">Marks</th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ($Questions as $key=>$tmpData) {

                    ?>

                    <tr>

                        <td><?php echo ucfirst($tmpData);?></td>
                        <td><input class="form-control" id="Marks" name="Marks[<?php echo $key;?>]" value="<?php echo $AssesmentMarks[$key];?>" placeholder="Marks" type="number" min="0" max="3" step="0.5" autocomplete="off" required></td>

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


    public function UploadAssessmentDoc(){
        $SchoolId=$_POST['SchoolId'];
        $TrainingDate=$_POST['TrainingDate'];
        $ModuleNumber=$_POST['ModuleNumber'];
        $StudentId=$_POST['StudentId'];


        ?>
        <form method="post" action="" enctype="multipart/form-data">

            <input class="form-control" id="StudentId"  name="StudentId" value="<?php echo $StudentId; ?>" type="hidden">
            <input class="form-control" id="SchoolId"  name="SchoolId" value="<?php echo $SchoolId; ?>" type="hidden">
            <input class="form-control" id="TrainingDate"  name="TrainingDate" value="<?php echo $TrainingDate; ?>" type="hidden">
            <input class="form-control" id="ModuleNumber"  name="ModuleNumber" value="<?php echo $ModuleNumber; ?>" type="hidden">
            <input class="form-control" id="AssessmentUpload"  name="AssessmentUpload" value="AssessmentUpload" type="hidden">



            <div class="col-sm-12">
                <div class="form-group">
                    <label>Upload Assessment Document </label>
                    <input required class="form-control" type="file" name="fileToUpload" />
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        <?php

    }


    public function StudentReport()
    {
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;


        $StudentReport2 = $this->onlinemodel->StudentReport();

        echo '<pre>';
        print_r($StudentReport2);
        echo '</pre>';
        //die;
        $CSVData = array();
        $tmpArray = array();
        $tmpArray = array('Student Name', 'Contact No.', 'Student UID', 'School', 'District', 'Date of 1st Training', 'Duration in minutes', 'Date of 2nd Training', 'Duration in minutes','Date of 3rd Training','Duration in minutes','Total Training Time','Assessment One Date','A1','B1','C1','D1','Assessment Two Date','A1','B1','C1','D1','Assessment Three Date','A1','B1','C1','D1');
        $CSVData[] = $tmpArray;

        $num = 1;
        foreach ($StudentReport2 as $data)
        {
            $FirstTrainingMinute=0;
            $SecondTrainingMinute=0;
            $ThirdTrainingMinute=0;
            if($data[0]['TrainingOne'][0]['TraingDate']){
                $FirstTrainingMinute = '60';
            }
            if($data[0]['TrainingTwo'][0]['TraingDate']){
                $SecondTrainingMinute = '60';
            }
            if($data[0]['TrainingThree'][0]['TraingDate']){
                $ThirdTrainingMinute = '60';
            }


            $tmpArray = array($data[0]['StudentName'], $data[0]['PhoneNumber'], $data[0]['StudentId'], $data[0]['SchoolName'], $data[0]['DistrictName'], $data[0]['TrainingOne'][0]['TraingDate'], $FirstTrainingMinute, $data[0]['TrainingTwo'][0]['TraingDate'],$SecondTrainingMinute,$data[0]['TrainingThree'][0]['TraingDate'],$ThirdTrainingMinute,$data[0]['TotalTrainingTime'],$data[0]['AssessmentOne']['Date'],$data[0]['AssessmentOne']['A1'],$data[0]['AssessmentOne']['B1'],$data[0]['AssessmentOne']['C1'],$data[0]['AssessmentOne']['D1'],$data[0]['AssessmentTwo']['Date'],$data[0]['AssessmentTwo']['A1'],$data[0]['AssessmentTwo']['B1'],$data[0]['AssessmentTwo']['C1'],$data[0]['AssessmentTwo']['D1'],$data[0]['AssessmentThree']['Date'],$data[0]['AssessmentThree']['A1'],$data[0]['AssessmentThree']['B1'],$data[0]['AssessmentThree']['C1'],$data[0]['AssessmentThree']['D1']);
            $CSVData[] = $tmpArray;
        }

        $fp = fopen('assets/ReportData/OnlineTrainingReport.csv', 'w');
        foreach ($CSVData as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);

    }

    public function OnlineTrainingModuleOneToModuleTwo()
	{
        $SessionData=$this->session->userdata("loginUserData");
        $UserId=$SessionData['Id'];
        $data['SessionData'] = $SessionData;

        $CompletedModule1Data = $this->onlinemodel->CompletedModule1Data();

        $InsertData=array();
        foreach ($CompletedModule1Data as $tmpData) 
		{
            $InsertData['SchoolId'] = $tmpData['SchoolId'];
            $InsertData['ModuleNumber'] = 150;
            $InsertData['StudentId'] = $tmpData['StudentId'];
            $InsertData['OwnerMobile'] = $tmpData['OwnerMobile'];
            $InsertData['MobileType'] = $tmpData['MobileType'];
            $InsertData['WhatsUpAvailable'] = $tmpData['WhatsUpAvailable'];
            $InsertData['EmailFamilyMember'] = $tmpData['EmailFamilyMember'];
            $InsertData['PhoneNumber'] = $tmpData['PhoneNumber'];
            $InsertData['StatusCalling'] = $tmpData['StatusCalling'];
            $InsertData['IsTransfered'] = $tmpData['Id'];
            $this->onlinemodel->InsertOnlineDataTraining2($tmpData['Id'],$InsertData);
        }

        //die;

    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */