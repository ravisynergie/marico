<!-- Content Wrapper. Contains page content -->
<?php
//echo '<pre>';
//print_r($SchoolName);
//echo '</pre>';
?>
<style>
.table th, .table td {
    padding: 6px;
    vertical-align: middle;
}
#MaricoModal .modal-dialog
{
	max-width: 580px;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $SchoolName['Name'];?></h1>
                </div>
                <div class="col-sm-6">

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">

                
				<?php
				
				//echo "<pre>";
				//print_r($TrainingScheduled);
				//echo "</pre>";
				
                $i=0;
                foreach($TrainingScheduled as $Date=>$ModuleData) 
				{  
					foreach($ModuleData as $ModuleNumber=>$tmpData)
					{
						$ModuleLabel='';
						if($ModuleNumber==100) $ModuleLabel='51-100';
						if($ModuleNumber==150) $ModuleLabel='101-150';
						if($ModuleNumber==200) $ModuleLabel='151-200';
						if($ModuleNumber==50) $ModuleLabel='1-50';
						?>
						<div class="card">
		
							<div class="card-body">
								<div class="row">
									<div class="col-sm-6">
										<h5 class="card-title" style="min-width: 520px">Training Date  : <?php echo $Date;?>, Module Number : <?php echo $ModuleLabel;?>, Total Student : <?php echo count($tmpData);?></h5>
									</div>
                                    <div class="col-sm-6 text-right">
										<a href="javaScript:void(0)" style="width:180px; float:right;" onclick="TrainingModule('<?php echo $SchoolName['Id'];?>','<?php echo $Date;?>','<?php echo $ModuleNumber;?>')" class="btn btn-primary btn-block btn-flat no-border">Upload Document</a>
									</div>
								</div>
		
								
								<table  class="table table-bordered">
									<thead >
									<tr>
		
										<th>Student Name</th>
										<th>Class</th>
										<th>Age</th>
										<th>Phone Number</th>
										<th>Module Number</th>
										<th>Training Date</th>
										<th>Training Time</th>
                                        <th>Attachment</th>
										<th>Assessment 1</th>
                                    <?php if($ModuleNumber==200) { ?>
                                        <th>Assessment 2</th>
                                    <?php } ?>


									</tr>
									</thead>
									<tbody>
									<?php
		
									foreach($tmpData as $data) 
									{
										$i++;
										$tmpTitle=array();
										$tmpTitle2=array();
										$VivekFlag=0;
										if($data['SectionOne']['UserId']==28)
										{
											$VivekFlag=1;
										}
										
										
										if($data['SectionOne'])
										{
											$tmpTitle[]='Section1: Completed';
										}
										if($data['SectionTwo'])
										{
											$tmpTitle[]='Section2: Completed';
										}
										if($data['SectionThree'])
										{
											$tmpTitle[]='Section3: Completed';
										}
		
										if(count($tmpTitle)==0)
										{
											$tmpTitle[]='Not started yet';
										}

                                        if($data['SectionFour'])
                                        {
                                            $tmpTitle2[]='Section4: Completed';
                                        }
                                        if($data['SectionFive'])
                                        {
                                            $tmpTitle2[]='Section5: Completed';
                                        }
                                        if($data['SectionSix'])
                                        {
                                            $tmpTitle2[]='Section6: Completed';
                                        }

                                        if(count($tmpTitle2)==0)
                                        {
                                            $tmpTitle2[]='Not started yet';
                                        }
										
										$WhatsAppCall='No';
										if($UploadedDocument[$ModuleNumber][$data['TraingDate']][$data['TrainingTime']]['WhatsAppCall']=='WhatsAPP')
										{
											$WhatsAppCall='Yes';
										}
										
										?>
										<tr <?php if($WhatsAppCall=='Yes') { ?> style="background-color:#90EEDD;" <?php } ?>>
											<td <?php if($VivekFlag==1) { echo "style=color:red;"; } ?>><?php echo $data['StudentName'];?></td>
											<td><?php echo $data['StudentClass'];?></td>
											<td><?php echo $data['StudentAge'];?></td>
											<td><?php echo $data['PhoneNumber'];?></td>
											<td><?php echo $ModuleLabel;?></td>
											<td><?php echo $data['TraingDate'];?></td>
											<td><?php echo $data['TrainingTime'];?> </td>
                                            <td align="center">
                                            	
												<?php if($UploadedDocument[$ModuleNumber][$data['TraingDate']][$data['TrainingTime']]) { ?>
                                                
                                                <?php if($UploadedDocument[$ModuleNumber][$data['TraingDate']][$data['TrainingTime']]['ImageOnePath']) { ?>
                                                <a href="<?php echo base_url();?>download.php?filename=<?php echo $UploadedDocument[$ModuleNumber][$data['TraingDate']][$data['TrainingTime']]['ImageOnePath'];?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                <?php } ?>
                                                
                                                <?php if($UploadedDocument[$ModuleNumber][$data['TraingDate']][$data['TrainingTime']]['ImageTwoPath']) { ?>
                                                 &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
                                                <a href="<?php echo base_url();?>download.php?filename=<?php echo $UploadedDocument[$ModuleNumber][$data['TraingDate']][$data['TrainingTime']]['ImageTwoPath'];?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                <?php } ?>
                                                <?php } else { echo "Not uploaded"; } ?>
                                            </td>
											<td width="150" align="center">
                                            <?php if(count($tmpTitle)==3) {
                                                if($data['AssessmentDocument']){
                                                ?>

                                                <a href="<?php echo base_url();?>download.php?filename=<?php echo $data['AssessmentDocument']?>" style="width:180px;" ><i class="fa fa-download" aria-hidden="true"></i></a>
                                                <?php } else { ?>
                                                <a href="javaScript:void(0)" style="width:180px;" onclick="UploadAssessmentDoc('<?php echo $data['StudentId']?>','<?php echo $SchoolName['Id'];?>','<?php echo $Date;?>','<?php echo $ModuleNumber;?>')"><i class="fa fa-upload" aria-hidden="true"></i></a>
                                            <?php } } else { ?>
                                                
                                                <?php if($UploadedDocument[$ModuleNumber][$data['TraingDate']][$data['TrainingTime']]) { ?>
                                                <select class="form-control" onchange="AssessmentQuestionPop(this.value,'<?php echo ($data['StudentId']);?>','<?php echo $ModuleNumber?>')">
                                                    <option value="">Assessment</option>
                                                    <?php foreach ($AssessmentData as $assess) { ?>
                                                        <option value="<?php echo $assess['Id']; ?>"><?php echo $assess['Name']; ?></option>
                                                    <?php } ?>



                                                </select>
                                                <?php } else { echo "-"; } ?>
                                                
                                            <?php } ?>
											</td>

                                            <?php if($ModuleNumber==200) { ?>
                                            <td width="150" align="center">

                                                <?php if(count($tmpTitle2)==3) {

                                                    if($data['AssessmentDocument']){
                                                        ?>

                                                        <a href="<?php echo base_url();?>download.php?filename=<?php echo $data['AssessmentDocument']?>" style="width:180px;" ><i class="fa fa-download" aria-hidden="true"></i></a>
                                                    <?php } else { ?>
                                                        <a href="javaScript:void(0)" style="width:180px;" onclick="UploadAssessmentDoc('<?php echo $data['StudentId']?>','<?php echo $SchoolName['Id'];?>','<?php echo $Date;?>','<?php echo $ModuleNumber;?>')"><i class="fa fa-upload" aria-hidden="true"></i></a>
                                                    <?php } } else { ?>

                                                    <?php if($UploadedDocument[$ModuleNumber][$data['TraingDate']][$data['TrainingTime']]) { ?>
                                                        <select class="form-control" onchange="AssessmentQuestionPop(this.value,'<?php echo ($data['StudentId']);?>','<?php echo $ModuleNumber?>')">
                                                            <option value="">Assessment</option>
                                                            <?php
                                                                foreach ($Assessment2Data as $assess) { ?>
                                                                    <option value="<?php echo $assess['Id']; ?>"><?php echo $assess['Name']; ?></option>
                                                                <?php } ?>

                                                        </select>
                                                    <?php } else { echo "-"; } ?>

                                                <?php }  ?>
                                            </td>
                                            <?php }  ?>
										</tr>
									<?php } ?>
									</tbody>
		
								</table>
								
		
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
						<?php 
					}
				} 
				?>
                
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<div id="MaricoModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 80%;">

        <!-- Modal content-->
        <div class="modal-content modalcontentborder">
            <div class="modal-header modalheader">
                <button type="button" class="close modalclosebutton" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modalheaderfont" id="ModalLightTitle">Training</h4>
            </div>
            <div class="modal-body" id="ModalLightBody">
                Please wait...
            </div>
        </div>
    </div>
</div>

<!-- /.content-wrapper -->
<!--<script src="--><?php //echo base_url(); ?><!--assets/js/event.js" type="text/javascript"></script>-->

<script>
    function TrainingModule(SchoolId,TrainingDate,ModuleNumber)
    {
        jQuery('#MaricoModal').modal('show');
		jQuery('#ModalLightTitle').html('Upload Document');
        var URL='<?php echo base_url();?>online/TrainingModule/';
        jQuery.ajax({
            url : URL,
            type: "POST",
            data : {SchoolId:SchoolId,TrainingDate:TrainingDate,ModuleNumber:ModuleNumber},
            success: function(data)
            {
                jQuery('#ModalLightBody').html(data);
            }
        });


    }

    function AssessmentQuestionPop(assessmentid,studentid,ModuleNumber) {
        //alert(ModuleNumber);

        if(assessmentid == ''){

        }
        else {

            var PageURL = '/marico/online/AssessQuestionDataPopup';

            //alert(Id);
            jQuery('#MaricoModal #ModalLightBody').html('<div class="load-more">Loading...</div>');
            jQuery("#MaricoModal").modal('show');
            //jQuery('#ModalLightTitle').html(jsObj.PageTitle);
            jQuery.ajax({
                url: PageURL,
                type: "POST",
                data: {Assessmentid: assessmentid, Studentid: studentid, ModuleNumber:ModuleNumber},
                success: function (response) {
                    jQuery('#MaricoModal .modal-dialog').css('width', '80%');
                    jQuery('#MaricoModal #ModalLightBody').html(response);

                }
            });
        }
    }

    function SaveStudentAssessmentData()
    {
        jQuery("#MaricoModal").modal('hide');
        var formData = $("#SaveStudentAssessmentData").serializeArray();
        var URL = '<?php echo base_url();?>online/TrainingScheduled'+"?id="+Math.random();
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

   function UploadAssessmentDoc(StudentId,SchoolId,TrainingDate,ModuleNumber){

        //alert(StudentId);
        //alert(SchoolId);
        //alert(TrainingDate);
        //alert(ModuleNumber);

       jQuery('#MaricoModal').modal('show');
       jQuery('#ModalLightTitle').html('Upload Assessment Document');
       var URL='<?php echo base_url();?>online/UploadAssessmentDoc/';
       jQuery.ajax({
           url : URL,
           type: "POST",
           data : {StudentId:StudentId,SchoolId:SchoolId,TrainingDate:TrainingDate,ModuleNumber:ModuleNumber},
           success: function(data)
           {
               jQuery('#ModalLightBody').html(data);
           }
       });

    }

</script>