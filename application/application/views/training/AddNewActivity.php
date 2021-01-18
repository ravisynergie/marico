<!-- Content Wrapper. Contains page content -->
<?php
//echo '<pre>';
//print_r($SchoolData);
//echo '</pre>';
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Activity</h1>
          </div>
          <div class="col-sm-6">
              <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>training/TrainingList">ActivityList</a> > AddNewActivity</span>
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
                <h3 class="card-title">Activity Type</h3><br><br>


              <div class="form-group">
<!--                  <label for="exampleInputEmail1">Activity Type</label>-->
                  <select class="form-control" id="ActivityType" name="ActivityType" onchange="GetActivityType(this)" required>
                      <option value="">Select Type</option>
                      <option value="Training">Training</option>
                      <option value="Assessment">Assessment</option>
                      <option value="Meeting">Community Meeting</option>
                      <option value="Event">Event</option>

                  </select>
              </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
<!--              //--------------------------------------------------training start------------------------------->
              <div id="TrainingForm" style="display: none">
                  <form method="post" action="">
                      <input class="form-control" id="TrainingActivity" name="Activity" type="hidden" value="Training">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">School</label>
                            <select class="form-control" id="SchoolId" name="SchoolId" required>
                                <option value="">Select School</option>
                                <?php foreach($SchoolData as $schdata) {
                                    if(empty($schdata['Name'])){}
                                    else {
                                    ?>
                                    <option value="<?php echo $schdata['Id'];?>"><?php echo ucfirst($schdata['Name']);?></option>
                                <?php } } ?>
                            </select>
                        </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Training Date</label>
    <!--                    <input class="form-control" id="Name" name="Name" placeholder="Enter student name" type="text" required>-->
                          <input type="text" class="form-control" placeholder="Training Date" name="TrainingDate" id="datepicker" autocomplete="off" required>
                      </div>

                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">In Time</label>
            <!--                        <input class="form-control" id="Class" name="Class" placeholder="Enter Class" type="text" required>-->
                                    <input class="timepicker timepicker-with-dropdown form-control" readonly name="InTime" placeholder="In Time" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Out Time</label>
            <!--                        <input class="form-control" id="Class" name="Class" placeholder="Enter Class" type="text" required>-->
                                    <input class="timepicker timepicker-with-dropdown form-control" readonly name="OutTime" placeholder="Out Time" autocomplete="off" required>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Training Status</label>
                            <select class="form-control" id="TrainingStatus" name="TrainingStatus" onchange="GetSelectedTextValue(this)" required>
                                <option value="">Select Status</option>
                                <option value="Scheduled">Scheduled</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Postponed">Postponed</option>
                                <option value="Completed">Completed</option>

                            </select>
                        </div>


                        <div class="form-group reasonText" style="display: none" id="reasonText">
                            <label for="exampleInputEmail1">Reason</label>
                            <input class="form-control" id="CancelReason" name="CancelReason" placeholder="Enter Reason" type="text">
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </form>
              </div>
<!--              //-------------------------------------------------------------training end---------------------------->



<!--              //-----------------------------------------------meeting start----------------------------------------->


              <div id="MeetingForm" style="display: none">

                  <form method="post" action="">
                      <input class="form-control" id="Activity" name="Activity" type="hidden" value="Meeting">
                      <div class="card-body">

                          <div class="form-group">
                              <label for="exampleInputEmail1">Type</label>
                              <select class="form-control" id="Type" name="Type" onchange="GetSchoolVillage(this)" required>
                                  <option value="">Select Type</option>
                                  <option value="School">School</option>
                                  <option value="Village">Village</option>
                              </select>
                          </div>


                          <div class="col-sm-12" id="VillageId" style="display: none">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Village</label>
                              <select class="form-control" id="VillageId" name="VillageId" >
                                  <option value="">Select Village</option>
                                  <?php foreach($AllVillageData as $vildata) {
                                      if(empty($vildata['Name'])){}
                                      else{
                                          ?>
                                          <option value="<?php echo $vildata['Id'];?>"><?php echo ucfirst($vildata['Name']);?></option>
                                      <?php } } ?>
                              </select>
                          </div>
                          </div>

                          <div class="col-sm-12" id="SchoolIdM" style="display: none">
                          <div class="form-group">
                              <label for="exampleInputEmail1">School</label>
                              <select class="form-control" id="SchoolId" name="SchoolId" >
                                  <option value="">Select School</option>
                                  <?php foreach($AllSchoolData as $schdata) {
                                      if(empty($schdata['Name'])){}
                                      else {
                                          ?>
                                          <option value="<?php echo $schdata['Id'];?>"><?php echo ucfirst($schdata['Name']);?></option>
                                      <?php } } ?>
                              </select>
                          </div>
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Meeting Date</label>
                              <!--                    <input class="form-control" id="Name" name="Name" placeholder="Enter student name" type="text" required>-->
                              <input type="text" class="form-control" placeholder="Meeting Date" name="MeetingDate" id="datepicker1" autocomplete="off" >
                          </div>

                          <div class="row mb-2">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">In Time</label>
                                      <!--                        <input class="form-control" id="Class" name="Class" placeholder="Enter Class" type="text" required>-->
                                      <input class="timepicker timepicker-with-dropdown form-control" readonly name="InTime" placeholder="In Time" autocomplete="off" required>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Out Time</label>
                                      <!--                        <input class="form-control" id="Class" name="Class" placeholder="Enter Class" type="text" required>-->
                                      <input class="timepicker timepicker-with-dropdown form-control" readonly name="OutTime" placeholder="Out Time" autocomplete="off" required>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Meeting Status</label>
                              <select class="form-control" id="MeetingStatus" name="MeetingStatus" onchange="GetSelectedTextValue1(this)" required>
                                  <option value="">Select Status</option>
                                  <option value="Scheduled">Scheduled</option>
                                  <option value="Cancelled">Cancelled</option>
                                  <option value="Postponed">Postponed</option>
                                  <option value="Completed">Completed</option>

                              </select>
                          </div>


                          <div class="form-group reasonText" style="display: none" id="reasonText1">
                              <label for="exampleInputEmail1">Reason</label>
                              <input class="form-control" id="CancelReason1" name="CancelReason" placeholder="Enter Reason" type="text">
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Participants</label>
                              <input class="form-control" id="Participants" name="Participants" placeholder="Enter Participants" type="text">
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Description</label>
                              <input class="form-control" id="Description" name="Description" placeholder="Enter Description" type="text">
                          </div>

                      </div>
                      <!-- /.card-body -->

                      <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                  </form>


              </div>

<!--              //--------------------------------------meeting end------------------------------------>


<!--              //-------------------------------event start---------------------------------->

              <div id="EventForm" style="display: none">

                  <form method="post" action="">
                      <input class="form-control" id="Activity" name="Activity" type="hidden" value="Event">

                      <div class="card-body">

                          <div class="form-group">
                              <label for="exampleInputEmail1">Village</label>
                              <select class="form-control" id="VillageId" name="VillageId" >
                                  <option value="">Select Village</option>
                                  <?php foreach($AllVillageData as $vildata) {
                                      if(empty($vildata['Name'])){}
                                      else{
                                          ?>
                                          <option value="<?php echo $vildata['Id'];?>"><?php echo ucfirst($vildata['Name']);?></option>
                                      <?php } } ?>
                              </select>
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Ocassion</label>
                              <input class="form-control" id="Ocassion" name="Ocassion" placeholder="Enter Ocassion" type="text" required>
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Event Date</label>
                              <!--                    <input class="form-control" id="Name" name="Name" placeholder="Enter student name" type="text" required>-->
                              <input type="text" class="form-control" placeholder="Event Date" name="EventDate" id="datepicker2" autocomplete="off" >
                          </div>

                          <div class="row mb-2">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">In Time</label>
                                      <!--                        <input class="form-control" id="Class" name="Class" placeholder="Enter Class" type="text" required>-->
                                      <input class="timepicker timepicker-with-dropdown form-control" readonly name="InTime" placeholder="In Time" autocomplete="off" required>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Out Time</label>
                                      <!--                        <input class="form-control" id="Class" name="Class" placeholder="Enter Class" type="text" required>-->
                                      <input class="timepicker timepicker-with-dropdown form-control" readonly name="OutTime" placeholder="Out Time" autocomplete="off" required>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Event Status</label>
                              <select class="form-control" id="EventStatus" name="EventStatus" onchange="GetSelectedTextValue2(this)" required>
                                  <option value="">Select Status</option>
                                  <option value="Scheduled">Scheduled</option>
                                  <option value="Cancelled">Cancelled</option>
                                  <option value="Postponed">Postponed</option>
                                  <option value="Completed">Completed</option>

                              </select>
                          </div>


                          <div class="form-group reasonText" style="display: none" id="reasonText2">
                              <label for="exampleInputEmail1">Reason</label>
                              <input class="form-control" id="CancelReason2" name="CancelReason" placeholder="Enter Reason" type="text">
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Theme</label>
                              <input class="form-control" id="Theme" name="Theme" placeholder="Enter Theme" type="text" required>

                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Event Type</label>
                              <select class="form-control" id="EventType" name="EventType" required>
                                  <option value="BaLAPainting">BaLA Painting</option>
                                  <option value="StreetPlay">Street Play</option>
                                  <option value="PuppetShow">Puppet show</option>
                                  <option value="MovieScreening">Movie screening</option>
                                  <option value="Chaupal">Chaupal</option>
                                  <option value="Other">Other</option>
                              </select>
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Detail</label>
                              <input class="form-control" id="Detail" name="Detail" placeholder="Enter Detail" type="text" required>
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Location of event</label>
                              <select class="form-control" id="LocationEvent" name="LocationEvent" required>
                                  <option value="School">School</option>
                                  <option value="Community">Community</option>
                              </select>
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">No. of Participants</label>
                              <input class="form-control" id="NumberParticipants" name="NumberParticipants" placeholder="Enter Number of Participants" type="text" required>
                          </div>

                          <div class="row">
                              <div class="col-3">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Stakeholders Name</label>
                                      <input class="form-control" id="StakeholdersName" name="StakeholdersName[]" placeholder="Enter stakeholders name" type="text">
                                  </div>


                              </div>

                              <div class="col-3">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Stakeholders Designation</label>
                                      <select class="form-control" id="StakeholdersDesignation" name="StakeholdersDesignation[]" onChange="ChkOtherDesignation(this.value)">
                                          <option value="">Stakeholders Designation</option>
                                          <option>Pradhan</option>
                                          <option>Govt. Official</option>
                                          <option>Educated Youth</option>
                                          <option>opinion Leader</option>
                                          <option>Ngo Worker</option>
                                          <option>DM</option>
                                          <option>DIOS</option>
                                          <option>BSA</option>
                                          <option>CDO</option>
                                          <option>AWW</option>
                                          <option>ASHA</option>
                                          <option>SHG Member</option>
                                          <option>Other</option>

                                      </select>
                                  </div>



                              </div>

                              <div class="col-3 OtherDesignationName">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Other Designation Name</label>
                                      <input class="form-control" id="OtherDesignationName" name="OtherDesignationName[]" placeholder="Enter other designation name" type="text">
                                  </div>

                              </div>

                              <div class="col-2">

                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Stakeholders Contact</label>
                                      <input class="form-control" id="StakeholdersContact" name="StakeholdersContact[]" placeholder="Enter stakeholders contact" type="text">
                                  </div>
                              </div>

                              <div class="col-1">
                                  <label for="exampleInputEmail1"></label><br>
                                  <div Class="circleplus" onclick="addStakholder()">+</div>

                              </div>
                          </div>

                          <div class="addstakeholder" id="addstakeholder"></div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Collaboration Organization</label>
                              <input class="form-control" id="CollaborationOrganization" name="CollaborationOrganization" placeholder="Enter Collaboration Organization" type="text" required>
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Collaboration Detail</label>
                              <input class="form-control" id="CollaborationDetail" name="CollaborationDetail" placeholder="Enter Collaboration Detail" type="text" required>
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Collaboration SPOC</label>
                              <input class="form-control" id="CollaborationSPOC" name="CollaborationSPOC" placeholder="Enter Collaboration SPOC" type="text" required>
                          </div>

                          <div class="form-group">
                              <label for="exampleInputEmail1">Collaboration Contact</label>
                              <input class="form-control" id="CollaborationContact" name="CollaborationContact" placeholder="Enter Collaboration Contact" type="text" required>
                          </div>

                          <!--                    <div class="form-group">-->
                          <!--                        <label for="exampleInputEmail1">Volunteer</label>-->
                          <!--                        <input class="form-control" id="Volunteer" name="Volunteer" placeholder="Enter Volunteer" type="text" required>-->
                          <!--                    </div>-->

                          <div class="group" id="">

                              <label for="exampleInputEmail1">Volunteers</label><br>



                              <table id="MaricoTableData" class="table table-bordered">
                                  <thead>
                                  <tr>
                                      <th class="linkClick">Select</th>
                                      <th class="linkClick">FirstName</th>
                                      <th class="linkClick">LastName</th>
                                      <th class="linkClick">Email</th>
                                      <th class="linkClick">Phone</th>

                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php foreach ($VolunteerData as $key=>$tmpData) {
                                      ?>
                                      <tr>
                                          <td>
                                              <div class="custom-control custom-checkbox">
                                                  <input type="checkbox" class="custom-control-input checkBoxClass" name="Volunteers[<?php echo $tmpData['Id'];?>]" id="<?php echo $tmpData['Id'];?>"
                                                      <?php
                                                      foreach(json_decode($TrainingData[0]['Volunteers']) as $mapTmp) {

                                                          if ($tmpData['Id'] == $mapTmp) {
                                                              echo 'checked';
                                                          }
                                                      }

                                                      ?> >

                                                  <label class="custom-control-label" for="<?php echo ($tmpData['Id']);?>"></label>
                                              </div>
                                          </td>
                                          <td><?php echo ucfirst($tmpData['FirstName']);?></td>
                                          <td><?php echo ucfirst($tmpData['LastName']);?></td>
                                          <td><?php echo ucfirst($tmpData['Email']);?></td>
                                          <td><?php echo ucfirst($tmpData['Phone']);?></td>

                                      </tr>
                                  <?php } ?>
                                  </tbody></table>

                          </div>

                      </div>
                      <!-- /.card-body -->

                      <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Save</button>
                          <!--                    <a href="https://www.latlong.net/" class="btn btn-primary" target="_blank">Search Lat/Long</a>-->
                      </div>
                  </form>
              </div>

<!--                //---------------------------------------Event end-------------------------------->

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
  <script src="<?php echo base_url(); ?>assets/js/student.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $(document).ready(function(){
        $('input.timepicker').timepicker({
            'minTime': '6:00am',
            'maxTime': '8:00pm',
            'interval': '5'

        });
    });
    $( function() {
        $( "#datepicker" ).datepicker();
        $( "#datepicker1" ).datepicker();
        $( "#datepicker2" ).datepicker();
    } );

    function GetSelectedTextValue(TrainingStatus) {
        //alert(TrainingStatus);
        var selectedText = TrainingStatus.options[TrainingStatus.selectedIndex].innerHTML;
        var selectedValue = TrainingStatus.value;
        //alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue == 'Cancelled'){
            var x = document.getElementById("reasonText");
            x.style.display = "block";
        }
        else if(selectedValue == 'Postponed'){
            var x = document.getElementById("reasonText");
            x.style.display = "block";
        }
        else{
            var x = document.getElementById("reasonText");
            x.style.display = "none";
        }
    }

    function GetSelectedTextValue1(TrainingStatus) {
        //alert(TrainingStatus);
        var selectedText = TrainingStatus.options[TrainingStatus.selectedIndex].innerHTML;
        var selectedValue = TrainingStatus.value;
        //alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue == 'Cancelled'){
            var x = document.getElementById("reasonText1");
            x.style.display = "block";
        }
        else if(selectedValue == 'Postponed'){
            var x = document.getElementById("reasonText1");
            x.style.display = "block";
        }
        else{
            var x = document.getElementById("reasonText1");
            x.style.display = "none";
        }
    }

    function GetSelectedTextValue2(TrainingStatus) {
        //alert(TrainingStatus);
        var selectedText = TrainingStatus.options[TrainingStatus.selectedIndex].innerHTML;
        var selectedValue = TrainingStatus.value;
        //alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue == 'Cancelled'){
            var x = document.getElementById("reasonText2");
            x.style.display = "block";
        }
        else if(selectedValue == 'Postponed'){
            var x = document.getElementById("reasonText2");
            x.style.display = "block";
        }
        else{
            var x = document.getElementById("reasonText2");
            x.style.display = "none";
        }
    }

    function GetActivityType(ActivityType){

       // alert('dee');
        var selectedText = ActivityType.options[ActivityType.selectedIndex].innerHTML;
        var selectedValue = ActivityType.value;
       // alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue == 'Training' || selectedValue == 'Assessment' ){
            var x = document.getElementById("TrainingForm");
            x.style.display = "block";

            var y = document.getElementById("MeetingForm");
            y.style.display = "none";

            var z = document.getElementById("EventForm");
            z.style.display = "none";

            jQuery('#TrainingActivity').val(selectedValue);
        }
        if(selectedValue == 'Meeting'){
            var x = document.getElementById("MeetingForm");
            x.style.display = "block";

            var y = document.getElementById("TrainingForm");
            y.style.display = "none";

            var z = document.getElementById("EventForm");
            z.style.display = "none";
        }
        if(selectedValue == 'Event'){
            var x = document.getElementById("EventForm");
            x.style.display = "block";

            var y = document.getElementById("TrainingForm");
            y.style.display = "none";

            var z = document.getElementById("MeetingForm");
            z.style.display = "none";
        }


    }

    function addStakholder() {
        // alert('deepak');
        var otherTime = 1;
        otherTime++;
        var URL = "<?php echo base_url(); ?>village/AddStakeholders?id="+Math.random();
        var Id = this.value;
        jQuery.ajax({
            url : URL,
            type: "POST",
            data : {otherTime:otherTime},
            success: function(data)
            {
                jQuery('#addstakeholder').append(data);
                //jQuery('#'+Id).remove();
            }
        });

    }

    function GetSchoolVillage(selectedvalue){

        var selectedText = selectedvalue.options[selectedvalue.selectedIndex].innerHTML;
        var selectedValue = selectedvalue.value;
        //alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue == 'Village'){
            var x = document.getElementById("VillageId");
            x.style.display = "block";

            var y = document.getElementById("SchoolIdM");
            y.style.display = "none";
        }
        if(selectedValue == 'School'){
            //alert('deepak');
            var z = document.getElementById("SchoolIdM");
            z.style.display = "block";

            var k = document.getElementById("VillageId");
            k.style.display = "none";
        }
        if(selectedValue == ''){
            var x = document.getElementById("VillageId");
            x.style.display = "none";

            var y = document.getElementById("SchoolIdM");
            y.style.display = "none";
        }

    }

</script>
