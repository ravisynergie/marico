<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<style>

    .tooltip {
        display:none;
        position:absolute;
        border:1px solid #333;
        background-color:#161616;
        border-radius:5px;
        padding:10px;
        color:#fff;
        font-size:12px Arial;
    }
</style>
<div class="content-wrapper">
    <?php

        $SIVRData = array();
        foreach ($StudentIVRData as $key=>$IVR){
            $SIVRData[$IVR['StudentId']] = $IVR['IVRCompleted'];
        }


    $IVRDataArray=json_decode($AttendanceData['NumberOfIVRCompleted'],true);
    $TotalIVRCompleted='';
    foreach ($IVRDataArray as $key=>$tmpData)
    {
        $TotalIVRCompleted += $tmpData;
    }

    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attendance</h1>
                </div>
                <div class="col-sm-6">
                    <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>training/TrainingList">TrainingList</a> > AttendanceTraining</span>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Attendance Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="">

                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Activities</label>
                                <select class="form-control" id="Activities" name="Activities" required>
                                    <option value="">Select Activities</option>
                                     <option value="Training" <?php if($AttendanceData['Activities']=='Training') { echo "selected"; } ?>>Training</option>
                                     <option value="DemoCall" <?php if($AttendanceData['Activities']=='DemoCall') { echo "selected"; } ?>>Demo Call</option>
                                     <option value="Game" <?php if($AttendanceData['Activities']=='Game') { echo "selected"; } ?>>Game</option>
                                     <option value="ReportCardReview" <?php if($AttendanceData['Activities']=='ReportCardReview') { echo "selected"; } ?>>Report Card review</option>
                                     <option value="Assessment" <?php if($AttendanceData['Activities']=='Assessment') { echo "selected"; } ?>>Assessment</option>
                                     <option value="Event" <?php if($AttendanceData['Activities']=='Event') { echo "selected"; } ?>>Event</option>

                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Report Card Review</label>
                                <select class="form-control" id="Review" name="Review" required>
                                    <option value="">Select Review</option>
                                    <option value="Review1" <?php if($AttendanceData['ReportCardReview']=='Review1') { echo "selected"; } ?>>Review 1</option>
                                    <option value="Review2" <?php if($AttendanceData['ReportCardReview']=='Review2') { echo "selected"; } ?>>Review 2</option>
                                    <option value="Review3" <?php if($AttendanceData['ReportCardReview']=='Review3') { echo "selected"; } ?>>Review 3</option>
                                    <option value="Review4" <?php if($AttendanceData['ReportCardReview']=='Review4') { echo "selected"; } ?>>Review 4</option>
                                    <option value="Review5" <?php if($AttendanceData['ReportCardReview']=='Review5') { echo "selected"; } ?>>Review 5</option>
                                    <option value="Review6" <?php if($AttendanceData['ReportCardReview']=='Review6') { echo "selected"; } ?>>Review 6</option>

                                </select>
                            </div>



                            <div class="form-group">
                                <label for="exampleInputEmail1">Review Date</label>
<!--                                <input type="text" class="form-control" placeholder="Review Date" value="--><?php //echo $AttendanceData['ReviewDate'];?><!--" name="ReviewDate" id="datepicker" autocomplete="off" required>-->
                                <input type="date" class="form-control" placeholder="Review Date" value="<?php echo $AttendanceData['ReviewDate'];?>" name="ReviewDate" id="datepicker" autocomplete="off" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Module Name</label>
                                <select class="form-control" id="ModuleNumber" name="ModuleNumber" required>
                                    <option value="">Select Module</option>
                                    <option value="50" <?php if($AttendanceData['ModuleNumber']=='50') { echo "selected"; } ?>>Module 1</option>
                                    <option value="100" <?php if($AttendanceData['ModuleNumber']=='100') { echo "selected"; } ?>>Module 2</option>
                                    <option value="150" <?php if($AttendanceData['ModuleNumber']=='150') { echo "selected"; } ?>>Module 3</option>
                                    <option value="200" <?php if($AttendanceData['ModuleNumber']=='200') { echo "selected"; } ?>>Module 4</option>


                                </select>
                            </div>

                            <div class="form-group" style="display: none;">
                                <label for="exampleInputEmail1">Total Number of IVR Completed</label>
                                <input class="form-control" id="TotalIVRNumber" name="TotalIVRNumber" value="<?php echo $TotalIVRCompleted;?>" type="text" readonly>
                            </div>


                            <div class="AllSchool" id="AllSchool">

                                <label for="exampleInputEmail1">Students List - <?php echo count($StudentSchoolWise);?></label><br>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="SelectAll" id="SelectAll">
                                    <label class="custom-control-label" for="SelectAll">Select All</label>
                                </div>

                                <table id="MaricoTableData" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="linkClick" width="90">Select</th>
                                        <th class="linkClick" width="90">Online Class</th>
                                        <th class="linkClick">No. of IVR</th>
                                        <th class="linkClick">Student Name</th>
                                        <th class="linkClick">Guardian Name</th>
                                        <th class="linkClick">Age</th>
                                        <th class="linkClick">Gender</th>
                                        <th class="linkClick">Class</th>
                                        <th class="linkClick">School Name</th>
                                        <th class="linkClick">Assessment 1</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$StudentIdArray=json_decode($AttendanceData['StudentData'],true);
									$StudentIdOnlineArray=json_decode($AttendanceData['StudentDataOnline'],true);
									foreach ($StudentSchoolWise as $key=>$tmpData)
									{
										 $tmpTitle=array();
										 if($tmpData['SectionOne'])
										 {
											 $tmpTitle[]='Section1: Completed';
										 }
										 if($tmpData['SectionTwo'])
										 {
											 $tmpTitle[]='Section2: Completed';
										 }
										 if($tmpData['SectionThree'])
										 {
											 $tmpTitle[]='Section3: Completed';
										 }
										 
										 if(count($tmpTitle)==0)
										 {
											 $tmpTitle[]='Not started yet';
										 }
										?>
                                        <tr <?php if(count($tmpTitle)==3) { ?> style="background-color:#90ee90;" <?php } ?>>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" <?php if(in_array($tmpData['Id'],$StudentIdArray)) { echo "checked"; } ?>  class="custom-control-input checkBoxClass" name="Students[<?php echo $tmpData['Id'];?>]" value="<?php echo $tmpData['Id'];?>" id="<?php echo $tmpData['Id'];?>">
                                                    <label class="custom-control-label" for="<?php echo ($tmpData['Id']);?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" <?php if(in_array($tmpData['Id'],$StudentIdOnlineArray)) { echo "checked"; } ?>  class="custom-control-input checkBoxClass" name="StudentsOnline[<?php echo $tmpData['Id'];?>]" value="<?php echo $tmpData['Id'];?>" id="StudentsOnline<?php echo $tmpData['Id'];?>">
                                                    <label class="custom-control-label" for="StudentsOnline<?php echo ($tmpData['Id']);?>"></label>
                                                </div>
                                            </td>
                                            <td width="250"><input class="form-control" id="IVRNumber" name="IVRNumber[<?php echo $tmpData['Id'];?>]" value="<?php echo $SIVRData[$tmpData['Id']]?>" placeholder="Number of IVR Completed" type="number"></td>
                                            <td><a href="javaScript:void(0)" title="<?php echo implode(', ',$tmpTitle);?>"><?php echo ucfirst($tmpData['Name']);?></a></td>
                                            <td><?php echo ucfirst($tmpData['GuardianName']);?></td>
                                            <td><?php echo ucfirst($tmpData['Age']);?></td>
                                            <td><?php echo ucfirst($tmpData['Gender']);?></td>
                                            <td><?php echo ucfirst($tmpData['Class']);?></td>
                                            <td><?php echo ucfirst($tmpData['LocationName']);?></td>
                                            
                                            <td width="220">

                                                        <div class="form-group" id="<?php echo $tmpData['Id']; ?>">

                                                            <select class="form-control" id="Assessment" name="Assessment" onchange="AssessmentQuestionPop(this.value,<?php echo ($tmpData['Id']);?>,<?php echo $TrainingId;?>)">
                                                                <option value="">Select Assessment</option>
                                                                <?php
                                                                foreach ($AssessmentData as $assess){
                                                                ?>
                                                                    <option value="<?php echo $assess['Id']; ?>"><?php echo $assess['Name']; ?></option>
                                                                <?php } ?>

                                                            </select>
                                                        </div>
<!--                                                    <a style="font-size:12px;" href="--><?php //echo base_url(); ?><!--assessment/AssessmentQuestion/--><?php //echo $assess['Id']?><!--">--><?php //echo $assess['Name']; ?><!--</a>-->

                                            </td>

                                        </tr>
                                    	<?php 
									}
									?>
                                    </tbody></table>

                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>

                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<div id="MaricoModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%">

        <!-- Modal content-->
        <div class="modal-content modalcontentborder">
            <div class="modal-header modalheader">
                <button type="button" class="close modalclosebutton" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modalheaderfont" id="ModalLightTitle">Assessment</h4>
            </div>
            <div class="modal-body" id="ModalLightBody">Loading...</div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<script src="<?php echo base_url(); ?>assets/js/mapping.js" type="text/javascript"></script>
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>-->
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>


<script>

    $(document).ready(function() {
        $('#MaricoTableData').DataTable({"paging": false});
        var x = document.getElementById("MaricoTableData_length");
        x.style.display = "none";
    });
    //
    // $('#MaricoTableData').dataTable( {
    //     "pageLength": 100,
    // } );

    //     $( function() {
    //     $( "#datepicker" ).datepicker();
    // } );


    if ( $('#datepicker')[0].type != 'date' ) $('#datepicker').datepicker();

</script>


<script type="text/javascript">

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

    function AssessmentQuestionPop(assessmentid,studentid,trainingid) {
        //alert(assessmentid);
        //alert(studentid);
        //alert(trainingid);
        if(assessmentid == ''){

        }
        else {

            var PageURL = '/marico/assessment/AssessQuestionDataPopup';

            //alert(Id);
            jQuery('#MaricoModal #ModalLightBody').html('<div class="load-more">Loading...</div>');
            jQuery("#MaricoModal").modal('show');
            //jQuery('#ModalLightTitle').html(jsObj.PageTitle);
            jQuery.ajax({
                url: PageURL,
                type: "POST",
                data: {Assessmentid: assessmentid, Studentid: studentid, Trainingid: trainingid},
                success: function (response) {
                    jQuery('#MaricoModal #ModalLightBody').html(response);

                    jQuery('#MaricoModal .modal-dialog').css('width', '80%');

                }
            });
        }
    }
	
	
	function SaveStudentAssessmentData()
	{
		jQuery("#MaricoModal").modal('hide');
		var formData = $("#SaveStudentAssessmentData").serializeArray();
		var URL = '<?php echo base_url();?>training/AttendanceTraining'+"?id="+Math.random();	
		jQuery.ajax({
			url : URL,
			type: "POST",
			data : formData,
			success: function(data)
			{
			    alert('Assessment data has been saved');
				
			}
		});		
		return false;	
	}

</script>