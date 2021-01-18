<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>School List</h1>
                </div>
                <div class="col-sm-6">
                    <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > MappingList</span>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">

                <?php if($this->session->flashdata('msg')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                <?php endif; ?>


                <div class="card">


                    <div class="card-body">
                        <form action="" method="get">

                            <div class="row">
                                <?php
                                //if($SessionData['UserGroupId'] == '3' || $SessionData['UserGroupId'] == '2'){
                                if($SessionData['UserGroupId'] == '3'){
                                    ?>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Traineer</label>
                                            <select class="form-control" id="UserName" name="UserName">
                                                <option value="">Select Traineer</option>
                                                <?php foreach($TrainerData as $data) { ?>
                                                    <option <?php if($_GET['UserName']==$data['Id']) { echo "selected"; } ?> value="<?php echo $data['Id'];?>"><?php echo $data['FirstName'].' '.$data['LastName'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>





                                    <div class="col-1">
                                        <label for="exampleInputEmail1">&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-block btn-flat no-border">Search</button>
                                    </div>
                                <?php } ?>
                            </div>
                        </form>
                    </div>


                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="MaricoTableData" class="table table-bordered">
                            <thead>
                            <tr>

                                <th class="">Sr.No</th>
                                <th class="">Id</th>
                                <th class="">School</th>
                                <th class="">District</th>
                                <th width="140" class="">Student Count</th>
                                <th width="130" class="">Module 1</th>
                                <th width="130" class="">Module 2</th>
                                <th width="130" class="">Module 3</th>
                                <th width="130" class="">Module 4</th>
                                <th width="220" class="">Total Training Scheduled</th>
                                <th width="180" class="">Training Completed</th>



                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $Total=0;
							$TotalTrainingModule50=0;
                            $TotalTrainingOne=0;
                            $TotalTrainingTwo=0;
                            $TotalTrainingThree=0;
                            $num=0;
                            $TotalCompleteTraining=0;
                            foreach($TrainnerSchoolData as $data) {

                                $Total += $data['TrainingSchedule'];
								$TotalTrainingModule50 += $data['TrainingSchedule50'];
                                $TotalTrainingOne += $data['TrainingSchedule100'];
                                $TotalTrainingTwo += $data['TrainingSchedule150'];
                                $TotalTrainingThree += $data['TrainingSchedule200'];
                                $num++;
                                $CompleteTraining=0;
                                foreach($data['TrainingCompleted'] as $complete){
                                    if (count($complete['UploadDoc'])>0) {
                                        $CompleteTraining++;
                                    }
                                }
                                $TotalCompleteTraining += $CompleteTraining;
                            ?>


                            <tr>
                                <td><?php echo $num; ?></td>
                                <?php if($SessionData['UserGroupId'] == 3) {?>
                                    <td><?php echo $data['Id'];?></td>
                                    <td><?php echo ucfirst($data['Name']);?></td>
                                <?php } else{?>
                                    <td><?php echo $data['SchoolId'];?></td>
                                    <td><?php echo ucfirst($data['SchoolName']);?></td>
                                <?php } ?>
                                <td><?php echo ucfirst($data['DistrictName']);?></td>
                                <td align="center"><?php echo $data['StudentCount'];?></td>

                                <?php if($SessionData['UserGroupId'] == 3) {?>
                                    <td >
                                        <a class="linkClick" target="_blank" href="<?php echo base_url(); ?>online/TrainnerSchoolStudent/<?php echo $data['Id'];?>/50?view=no">1-50(<?php echo $data['TrainingSchedule50']?>)</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td >
                                        <a class="linkClick" target="_blank" href="<?php echo base_url(); ?>online/TrainnerSchoolStudent/<?php echo $data['Id'];?>/100?view=no">51-100(<?php echo $data['TrainingSchedule100']?>)</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td >
                                        <a class="linkClick" target="_blank" href="<?php echo base_url(); ?>online/TrainnerSchoolStudent/<?php echo $data['Id'];?>/150?view=no">101-150(<?php echo $data['TrainingSchedule150']?>)</a>&nbsp;
                                    </td>
                                    <td >
                                        <a class="linkClick" target="_blank" href="<?php echo base_url(); ?>online/TrainnerSchoolStudent/<?php echo $data['Id'];?>/200?view=no">151-200(<?php echo $data['TrainingSchedule200']?>)</a>
                                    </td>
                                <?php } else{ ?>
                                    <td >
                                        <a class="linkClick" target="_blank" href="<?php echo base_url(); ?>online/TrainnerSchoolStudent/<?php echo $data['SchoolId'];?>/50?view=no">1-50(<?php echo $data['TrainingSchedule50']?>)</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>  
                                <td >
                                    <a class="linkClick" target="_blank" href="<?php echo base_url(); ?>online/TrainnerSchoolStudent/<?php echo $data['SchoolId'];?>/100?view=no">51-100(<?php echo $data['TrainingSchedule100']?>)</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                <td >
                                    <a class="linkClick" target="_blank" href="<?php echo base_url(); ?>online/TrainnerSchoolStudent/<?php echo $data['SchoolId'];?>/150?view=no">101-150(<?php echo $data['TrainingSchedule150']?>)</a>&nbsp;
                                </td>
                                <td >
                                    <a class="linkClick" target="_blank" href="<?php echo base_url(); ?>online/TrainnerSchoolStudent/<?php echo $data['SchoolId'];?>/200?view=no">151-200(<?php echo $data['TrainingSchedule200']?>)</a>
                                </td>
                                <?php } ?>
                                <?php if($SessionData['UserGroupId'] == 3) {?>
                                <td align="center"><a href="<?php echo base_url(); ?>online/TrainingScheduled/<?php echo $data['Id']; ?>" ><?php echo $data['TrainingSchedule'];?></a></td>
                                <?php } else{ ?>
                                <td align="center"><a href="<?php echo base_url(); ?>online/TrainingScheduled/<?php echo $data['SchoolId']; ?>" ><?php echo $data['TrainingSchedule'];?></a></td>
                                <?php } ?>

                                <?php if($SessionData['UserGroupId'] == 3) {?>
                                    <td align="center"><a href="<?php echo base_url(); ?>online/TrainingScheduled/<?php echo $data['Id']; ?>" ><?php echo $CompleteTraining;?></a></td>
                                <?php } else{ ?>
                                    <td align="center"><a href="<?php echo base_url(); ?>online/TrainingScheduled/<?php echo $data['SchoolId']; ?>" ><?php echo $CompleteTraining;?></a></td>
                                <?php } ?>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="4" align="center">Total</td>
                                <td></td>
                                <td align="center"><?php echo $TotalTrainingModule50; ?></td>
                                <td align="center"><?php echo $TotalTrainingOne; ?></td>
                                <td align="center"><?php echo $TotalTrainingTwo; ?></td>
                                <td align="center"><?php echo $TotalTrainingThree; ?></td>
                                <td align="center"><?php echo $Total; ?></td>
                                <td align="center"><?php echo $TotalCompleteTraining; ?></td>
                            </tr>
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
    <div class="modal-dialog" style="width: 80%">

        <!-- Modal content-->
        <div class="modal-content modalcontentborder">
            <div class="modal-header modalheader">
                <button type="button" class="close modalclosebutton" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modalheaderfont" id="ModalLightTitle">Scheduled Training</h4>
            </div>
            <div class="modal-body" id="ModalLightBody">
                Please wait...
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->


<script src="<?php echo base_url(); ?>assets/js/mapping.js" type="text/javascript"></script>

<script>

    function SchoolPopupData(SchoolId)
    {
        jQuery('#MaricoModal').modal('show');

        var URL='<?php echo base_url();?>online/SchoolTrainingPopup/';
        jQuery.ajax({
            url : URL,
            type: "POST",
            data : {SchoolId:SchoolId},
            success: function(data)
            {
                jQuery('#ModalLightBody').html(data);
            }
        });


    }

</script>