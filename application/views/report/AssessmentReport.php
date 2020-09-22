<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Assessment Report</h1>
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

                        
                        <?php
                        $AllTotal=0;
						foreach($AssessmentData as $Date=>$tmpData)
						{
							?> 
                            <table id="MaricoTableData" class="table table-bordered"><thead>
                            <tr><td colspan="5"><label>Report Date: <?php echo date('d/m/Y',strtotime($Date));?></label></td></tr>
                            <tr>
                                <th>Trainer Name</th>
                                <th>Section1 Completed</th>
                                <th>Section2 Completed</th>
                                <th>Section3 Completed</th>
                                <th>Assessment Completed Per Student</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $total =0;
                            foreach($tmpData as $data) {
                                $total += $data['AssessmentAllCompleted'];
                                ?>
                            <tr>
                                <td><?php echo $data['UserName'];?></td>
                                <td><?php echo $data['Assessment1Completed'];?></td>
                                <td><?php echo $data['Assessment2Completed'];?></td>
                                <td><?php echo $data['Assessment3Completed'];?></td>
                                <td><?php echo $data['AssessmentAllCompleted'];?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="4" style="text-align:center"><b>Total</b></td>
                                <td><b><?php echo $total;?></b></td>
                            </tr>
                            </tbody>
                            </table>
                            <br/>
                            <?php
                            $AllTotal += $total;
						}
						?>

                        <table id="MaricoTableData" class="table table-bordered">
                            <tbody>
                            <tr>
                                <td colspan="5" style="text-align:center"><b>All Total</b></td>
                                <td><b><?php echo $AllTotal;?></b></td>
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
<!-- /.content-wrapper -->
<script src="<?php echo base_url(); ?>assets/js/event.js" type="text/javascript"></script>