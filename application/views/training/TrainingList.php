<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?php
        //echo '<pre>';
        //print_r($SessionData['UserGroupId']);
        //echo '</pre>';
      ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="ng-cloak">Training List - {{ TrainingData.length }}</h1>
          </div>
          <div class="col-sm-6">

              <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > TrainingList</span>

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
                                                <option <?php if($_GET['UserName']==$data['Id']) { echo "selected"; } ?> value="<?php echo $data['Id'];?>"><?php echo $data['UserName'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">District Name</label>
                                    <select class="form-control" id="DistrictId" name="DistrictId">
                                        <option value="">Select District</option>
                                        <?php foreach($DistrictData as $data) { ?>
                                            <option <?php if($_GET['DistrictId']==$data['Id']) { echo "selected"; } ?> value="<?php echo $data['Id'];?>"><?php echo $data['Name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Block</label>
                                    <select class="form-control" id="BlockId" name="BlockId">
                                        <option value="">Select Block</option>
                                        <?php foreach($BlockData as $blcdata) { ?>
                                            <option <?php if($_GET['BlockId']==$blcdata['Id']) { echo "selected"; } ?> value="<?php echo $blcdata['Id'];?>"><?php echo $blcdata['Name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Village</label>
                                    <select class="form-control" id="VillageId" name="VillageId">
                                        <option value="">Select Village</option>
                                        <?php foreach($VillageData as $vildata) {
                                            if(empty($vildata['Name'])){}
                                            else{
                                                ?>
                                                <option <?php if($_GET['VillageId']==$vildata['Id']) { echo "selected"; } ?> value="<?php echo $vildata['Id'];?>"><?php echo ucfirst($vildata['Name']);?></option>
                                            <?php } } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">School</label>
                                    <select class="form-control" id="SchoolId" name="SchoolId">
                                        <option value="">Select School</option>
                                        <?php foreach($SchoolData as $schdata) {
                                            if(empty($schdata['Name'])){}
                                            else {
                                                ?>
                                                <option <?php if($_GET['SchoolId']==$schdata['Id']) { echo "selected"; } ?> value="<?php echo $schdata['Id'];?>"><?php echo ucfirst($schdata['Name']);?></option>
                                            <?php } } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status</label>
                                    <select class="form-control" id="TrainingStatus" name="TrainingStatus">
                                        <option value="">Select Status</option>
                                        <option <?php if($_GET['TrainingStatus']=='Scheduled') { echo "selected"; } ?> value="Scheduled">Scheduled</option>
                            			<option <?php if($_GET['TrainingStatus']=='Cancelled') { echo "selected"; } ?> value="Cancelled">Cancelled</option>
                            			<option <?php if($_GET['TrainingStatus']=='Postponed') { echo "selected"; } ?> value="Postponed">Postponed</option>
                            			<option <?php if($_GET['TrainingStatus']=='Completed') { echo "selected"; } ?> value="Completed">Completed</option>
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="col-1">
                                <label for="exampleInputEmail1">&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block btn-flat no-border">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            
            	
          <div class="card">
            <div class="card-header">
              <div class="col-2 pull-right">
                  <?php
                  if($SessionData['UserGroupId'] != '3'){
                  ?>
              	    <a href="<?php echo base_url(); ?>training/AddNewTraining"> <button type="button" class="btn btn-primary btn-block btn-flat no-border">Add new Training</button></a>
                  <?php } ?>
              </div>  
            </div>
            
            
            <!-- /.card-header -->
            <div class="card-body" data-ng-init="TrainingList()">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>School Name</th>
                  <th>Village Name</th>
                  <th>Block Name</th>
                  <th>District Name</th>
                  <th>Training Date</th>
                  <th>In Time</th>
                  <th>Out Time</th>
                  <th>Training Status</th>
                    <?php
                    if($SessionData['UserGroupId'] == '3'){
                    ?>
                        <th>Trainer Name</th>
                    <?php } ?>
                  <th width="120">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr class="ng-cloak" ng-repeat="data in TrainingData" id="{{ data.Id }}">
          		<td>{{ data.SchoolName }}</td>
          		<td>{{ data.VillageName }}</td>
                <td>{{ data.BlockName }}</td>
                <td>{{ data.DistrictName }}</td>
          		<td>{{ data.TrainingDate }}</td>
          		<td>{{ data.InTime }}</td>
          		<td>{{ data.OutTime }}</td>
          		<td>{{ data.TrainingStatus }}</td>
                    <?php
                    if($SessionData['UserGroupId'] == '3'){
                    ?>
          		        <td>{{ data.FirstName }}</td>
                    <?php } ?>
           		<td align="center">
                <a class="fa fa-edit" style="font-size:12px;" href="<?php echo base_url(); ?>training/UpdateTraining/{{ data.Id }} "></a>
                 | 
                <a style="font-size:12px;" href="<?php echo base_url(); ?>training/AttendanceTraining/{{ data.Id }}">Attendance</a>
<!--                    &nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-trash" ng-click="DeleteTraining(data.Id)" href="javaScript:void(0)"></a>-->
                </td>
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
  <script src="<?php echo base_url(); ?>assets/js/training.js" type="text/javascript"></script>