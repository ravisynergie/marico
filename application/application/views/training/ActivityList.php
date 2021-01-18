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

          </div>
          <div class="col-sm-6">

              <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > ActivityList</span>

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

              <div class="card-header">
                  <div class="row mb-2">
                      <div class="col-sm-6">
                          <h3 class="card-title">Activity Type</h3><br><br>
                          <div class="form-group">
                              <!--                  <label for="exampleInputEmail1">Activity Type</label>-->
                              <select class="form-control" id="ActivityType" name="ActivityType" onchange="GetActivityType(this)" required>
                                  <option value="">Select Type</option>
                                  <option value="Training" <?php if($_GET['Type'] == 'Training') { echo 'selected'; }?>>Training</option>
                                  <option value="Meeting" <?php if($_GET['Type'] == 'Meeting') { echo 'selected'; }?>>Community Meeting</option>
                                  <option value="Event" <?php if($_GET['Type'] == 'Event') { echo 'selected'; }?>>Event</option>

                              </select>
                          </div>
                      </div>
                      <div class="col-sm-6 ">
                          <h3 class="card-title">&nbsp;</h3><br><br>
                              <?php
                              if($SessionData['UserGroupId'] != '3'){
                                  ?>
                                  <a href="<?php echo base_url(); ?>activity/AddNewActivity"> <button type="button" class="btn btn-primary btn-block btn-flat no-border pull-right" style="width: 200px;">Add new Activity</button></a>
                              <?php } ?>
                      </div>
              </div>
                <hr>

<!--              //-----------------------------Training List--------------------------->
              <div id="TrainingList" <?php if($_GET['Type'] == 'Training') { echo 'style="display: block"'; } else { echo 'style="display: none"'; }?>>
                <div class="card-body">
                    <form action="" method="get">
                        <input class="form-control" id="Type" name="Type" type="hidden" value="Training">
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

                            <div class="col-2">
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

            	

            
            <!-- /.card-header -->
                  <h4>Training List - <?php echo count($TrainingData)?></h4>
            <div class="card-body">
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
                <?php foreach ($TrainingData as $data) {?>
                <tr >
          		<td><?php echo $data['SchoolName']; ?></td>
          		<td><?php echo $data['VillageName']; ?></td>
                <td><?php echo $data['BlockName']; ?></td>
                <td><?php echo $data['DistrictName']; ?></td>
          		<td><?php echo $data['TrainingDate']; ?></td>
          		<td><?php echo $data['InTime']; ?></td>
                    <td><?php echo $data['OutTime']; ?></td>
          		<td><?php echo $data['TrainingStatus']; ?></td>
                    <?php
                    if($SessionData['UserGroupId'] == '3'){
                    ?>
          		        <td><?php echo $data['FirstName']; ?>{{ data.FirstName }}</td>
                    <?php } ?>
           		<td align="center">
                <a class="fa fa-edit" style="font-size:12px;" href="<?php echo base_url(); ?>training/UpdateTraining/<?php echo $data['Id']; ?> "></a>
                 | 
                <a style="font-size:12px;" href="<?php echo base_url(); ?>training/AttendanceTraining/<?php echo $data['Id']; ?>">Attendance</a>
<!--                    &nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-trash" ng-click="DeleteTraining(data.Id)" href="javaScript:void(0)"></a>-->
                </td>
          </tr>
                <?php } ?>
                </tbody>
                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          </div>



<!--          //-------------------------------Meeting List------------------------------------------    -->

            <div id="MeetingList" <?php if($_GET['Type'] == 'Meeting') { echo 'style="display: block"'; } else { echo 'style="display: none"'; }?>>


                <div class="card-body">
                    <form action="" method="get">
                        <input class="form-control" id="Type" name="Type" type="hidden" value="Meeting">
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

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status</label>
                                    <select class="form-control" id="MeetingStatus" name="MeetingStatus">
                                        <option value="">Select Status</option>
                                        <option <?php if($_GET['MeetingStatus']=='Scheduled') { echo "selected"; } ?> value="Scheduled">Scheduled</option>
                                        <option <?php if($_GET['MeetingStatus']=='Cancelled') { echo "selected"; } ?> value="Cancelled">Cancelled</option>
                                        <option <?php if($_GET['MeetingStatus']=='Postponed') { echo "selected"; } ?> value="Postponed">Postponed</option>
                                        <option <?php if($_GET['MeetingStatus']=='Completed') { echo "selected"; } ?> value="Completed">Completed</option>
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



                <h4 style="padding-left: 20px;">Meeting List - <?php echo count($MeetingData)?></h4>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Location Name</th>
                            <th>MeetingDate</th>
                            <th>InTime</th>
                            <th>OutTime</th>
                            <th>Status</th>
                            <th width="120">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($MeetingData as $data) {?>
                        <tr >
                            <td><?php echo $data['Type']?></td>
                            <td><?php echo $data['LocationName']?></td>
                            <td><?php echo $data['MeetingDate']?></td>
                            <td><?php echo $data['InTime']?></td>
                            <td><?php echo $data['OutTime']?></td>
                            <td><?php echo $data['MeetingStatus']?></td>

                            <td align="center">
                                <a class="fa fa-edit" href="<?php echo base_url(); ?>meeting/UpdateMeeting/<?php echo $data['Id']?> "></a>

                                <!--                    &nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-trash" ng-click="DeleteTraining(data.Id)" href="javaScript:void(0)"></a>-->
                            </td>
                        </tr>
                        <?php }?>
                        </tbody>

                    </table>
                </div>

            </div>


<!--              //-----------------------------------------------Event List-------------------------------->
              <div id="EventList" <?php if($_GET['Type'] == 'Event') { echo 'style="display: block"'; } else { echo 'style="display: none"'; }?>>

                  <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>

                              <th>Ocassion</th>
                              <th>Theme</th>
                              <th>EventType</th>
                              <th>Detail</th>
                              <th>Location of event</th>
                              <th>Village</th>
                              <th>District</th>
                              <th width="120">Action</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($EventData as $data) { ?>
                          <tr>

                              <td><?php echo $data['Ocassion']?></td>
                              <td><?php echo $data['Theme']?></td>
                              <td><?php echo $data['EventType']?></td>
                              <td><?php echo $data['Detail']?></td>
                              <td><?php echo $data['LocationEvent']?></td>
                              <td><?php echo $data['VillageName']?></td>
                              <td><?php echo $data['DistrictName']?></td>
                              <td align="center">
                                  <a class="fa fa-edit" href="<?php echo base_url(); ?>event/UpdateEvent/<?php echo $data['Id']?> "></a>
                                  &nbsp;&nbsp;&nbsp;
                                  <!--                    <a class="fa fa-trash" ng-click="DeleteSchool(data.Id)" href="javaScript:void(0)"></a>                    -->
                              </td>
                          </tr>
                          <?php } ?>
                          </tbody>

                      </table>
                  </div>

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
<!--<script src="--><?php //echo base_url(); ?><!--assets/js/meeting.js" type="text/javascript"></script>-->

<script>

    function GetActivityType(ActivityType){

        // alert('dee');
        var selectedText = ActivityType.options[ActivityType.selectedIndex].innerHTML;
        var selectedValue = ActivityType.value;
         //alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue == 'Training'){
            /*var x = document.getElementById("TrainingList");
            x.style.display = "block";

            var y = document.getElementById("MeetingList");
            y.style.display = "none";

            var z = document.getElementById("EventList");
            z.style.display = "none";*/
            window.location.href='<?php echo base_url();?>activity/ActivityList?Type=Training';
        }
        if(selectedValue == 'Meeting'){
            /*var x = document.getElementById("MeetingList");
            x.style.display = "block";

            var y = document.getElementById("TrainingList");
            y.style.display = "none";

            var z = document.getElementById("EventList");
            z.style.display = "none";*/
            window.location.href='<?php echo base_url();?>activity/ActivityList?Type=Meeting';
        }
        if(selectedValue == 'Event'){
            //alert('deepak');
            /*var x = document.getElementById("EventList");
            x.style.display = "block";

            var y = document.getElementById("TrainingList");
            y.style.display = "none";

            var z = document.getElementById("MeetingList");
            z.style.display = "none";*/

            window.location.href='<?php echo base_url();?>activity/ActivityList?Type=Event';
        }


    }

</script>