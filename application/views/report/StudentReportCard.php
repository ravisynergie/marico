<!-- Content Wrapper. Contains page content -->
<?php
//echo '<pre>';
//print_r($StudentData);
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

                <div class="card">


                    <div class="card-body" style="overflow:auto; height:80vh;">

                        <form action="" method="get">

                            <div class="row mb-2">
                                <div class="col-8">

                                </div>


                                <div class="col-2">
                                    <div class="form-group">

                                        <input class="form-control" id="SearchField" name="SearchField"  placeholder="Search" type="text">
                                    </div>
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat no-border">Search</button>
                                </div>

                                <div class="col-1">
                                    <a href="<?php echo base_url(); ?>report/StudentReportCard" class="btn btn-primary btn-block btn-flat no-border">Reset</a>
                                </div>
                            </div>
                        </form>
                        <a href="<?php echo base_url();?>download.php?filename=assets/ReportData/AllStudentReportCard.csv&id=<?php echo rand(654654,654654);?>">Download CSV</a>
                        <table  class="table table-bordered">
                            <thead >
                            <tr>

                                <th>Sr. No.</th>
                                <th>District Name</th>
                                <th>School Name</th>
                                <th>Trainer Name</th>
                                <th>Student Name</th>
                                <th>Student Id</th>
                                <th>Contact</th>
                                <th>Alternative Contact</th>
                                <th>Module -I</th>
                                <th>Field Assessment Date </th>
                                <th>Grade of Assessment</th>
                                <th>Date Training Module-II</th>
                                <th>Date Training Module-III</th>
                                <th>Date Training Modlule IV</th>
                                <th>Date Assessment-1</th>
                                <th>Grade Assessment-1</th>
                                <th>Date Assessment-2</th>
                                <th>Grade Assessment-2</th>
                                <th>Date Assessment-3</th>
                                <th>Grade Assessment-3</th>
                                <th>Call Status</th>
                                <th>Response</th>
                                <th>Who Answered</th>


                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            foreach($StudentData as $tmpData)
                            {
                                $data=json_decode($tmpData['ReportData'],true);
								//echo '<pre>';
								//print_r($data);
								//echo '</pre>';

								if($data){
                                ?>
                                <tr >
                                    <td><?php echo $i++;?></td>
                                    <td><?php echo $data['DistrictName'];?></td>
                                    <td><?php echo $data['SchoolName'];?></td>
                                    <td><?php echo $data['TrainerName'];?></td>
                                    <td><?php echo $data['Name'];?></td>
                                    <td><?php echo $data['Id'];?></td>
                                    <td><?php echo $data['PhoneNo'];?></td>
                                    <td><?php echo $data['AltContactNumber'];?></td>
                                    <td><?php echo $data['ModuleOneCount']; ?></td>
                                    <td><?php echo $data['FieldAssessmentDate']?></td>
                                    <td><?php echo $data['GradeOfAssessment'];?></td>
                                    <td><?php if($data['DateTrainingModuleII'] == '30 Nov, -0001'){echo '';}else {echo $data['DateTrainingModuleII'];}?></td>
                                    <td><?php if($data['DateTrainingModuleIII'] == '30 Nov, -0001'){echo '';}else {echo $data['DateTrainingModuleIII'];}?></td>
                                    <td><?php if($data['DateTrainingModuleIV'] == '30 Nov, -0001'){echo '';}else {echo $data['DateTrainingModuleIV'];}?></td>
                                    <td><?php echo $data['DateAssessment1'];?></td>
                                    <td><?php echo $data['GradeAssessment1'];?></td>
                                    <td><?php echo $data['DateAssessment2'];?></td>
                                    <td><?php echo $data['GradeAssessment2'];?></td>
                                    <td><?php echo $data['DateAssessment3'];?></td>
                                    <td><?php echo $data['GradeAssessment3'];?></td>
                                    <td><?php echo $data['CallStatus'];?></td>
                                    <td><?php echo $data['Response'];?></td>
                                    <td><?php echo $data['WhoAnswered'];?></td>


                                </tr>
                                <?php
								if($i==10000)
								{
									break;
								}
								?>
                                
								<?php }} ?>
                            </tbody>

                        </table>


                    </div>
                    <!-- /.card-body -->
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


</script>