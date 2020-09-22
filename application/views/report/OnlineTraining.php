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

                            <div class="card-body">

                                <table  class="table table-bordered">
                                    <thead >
                                    <tr>

                                        <th>Student Id</th>
                                        <th>Student Name</th>
                                        <th>School Name</th>
                                        <th>Class</th>
                                        <th>Age</th>
                                        <th>Phone Number</th>
                                        <th>Training One Date</th>
                                        <th>Training Time</th>
                                        <th>Training Two Date</th>
                                        <th>Training Time</th>
                                        <th>Training Three Date</th>
                                        <th>Training Time</th>


                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    foreach($OnlineTrainingData as $data)
                                    {

                                    ?>
                                        <tr >
                                            <td><?php echo $data[0]['Id'];?></td>
                                            <td><?php echo $data[0]['StudentName'];?></td>
                                            <td><?php echo $data[0]['SchoolName'];?></td>
                                            <td><?php echo $data[0]['StudentClass'];?></td>
                                            <td><?php echo $data[0]['StudentAge'];?></td>
                                            <td><?php echo $data[0]['PhoneNumber'];?></td>
                                            <td><?php echo $data[0]['TrainingOne'][0]['TraingDate'];?></td>
                                            <td><?php echo $data[0]['TrainingOne'][0]['TrainingTime'];?></td>
                                            <td><?php echo $data[0]['TrainingTwo'][0]['TraingDate'];?></td>
                                            <td><?php echo $data[0]['TrainingTwo'][0]['TrainingTime'];?></td>
                                            <td><?php echo $data[0]['TrainingThree'][0]['TraingDate'];?></td>
                                            <td><?php echo $data[0]['TrainingThree'][0]['TrainingTime'];?></td>


                                        </tr>
                                    <?php } ?>
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