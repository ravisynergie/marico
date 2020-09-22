<!-- Content Wrapper. Contains page content -->
<?php
//echo '<pre>';
//print_r($VolunteerData);
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
                    <h1>Update Meeting</h1>
                </div>
                <div class="col-sm-6">
                    <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>meeting/MeetingList">MeetingList</a> > UpdateMeeting</span>
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
                        <h3 class="card-title">Meeting Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="">

                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Type</label>
                                <select class="form-control" id="Type" name="Type" onchange="GetSchoolVillage(this)" required>
                                    <option value="">Select Type</option>
                                    <option value="School" <?php if($MeetingData[0]['Type'] == 'School'){echo 'selected'; }?>>School</option>
                                    <option value="Village" <?php if($MeetingData[0]['Type'] == 'Village'){echo 'selected'; }?>>Village</option>
                                </select>
                            </div>

                            <div class="col-sm-12" id="VillageId" <?php if($MeetingData[0]['Type'] == 'Village'){echo 'style="display: block"'; } else {echo 'style="display: none"';}?>>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Village</label>
                                    <select class="form-control" id="VillageId" name="VillageId" >
                                        <option value="">Select Village</option>
                                        <?php foreach($VillageData as $vildata) {
                                            if(empty($vildata['Name'])){}
                                            else{
                                                ?>
                                                <option value="<?php echo $vildata['Id'];?>" <?php if($vildata['Id'] == $MeetingData[0]['VillageId']){echo 'selected'; }?>><?php echo ucfirst($vildata['Name']);?></option>
                                            <?php } } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12" id="SchoolId" <?php if($MeetingData[0]['Type'] == 'School'){echo 'style="display: block"'; } else {echo 'style="display: none"';}?>>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">School</label>
                                    <select class="form-control" id="SchoolId" name="SchoolId" >
                                        <option value="">Select School</option>
                                        <?php foreach($SchoolData as $schdata) {
                                            if(empty($schdata['Name'])){}
                                            else {
                                                ?>
                                                <option value="<?php echo $schdata['Id'];?>" <?php if($schdata['Id'] == $MeetingData[0]['SchoolId']){echo 'selected'; }?>><?php echo ucfirst($schdata['Name']);?></option>
                                            <?php } } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Meeting Date</label>
                                <!--                    <input class="form-control" id="Name" name="Name" placeholder="Enter student name" type="text" required>-->
                                <input type="text" class="form-control" placeholder="Training Date" name="MeetingDate" id="datepicker" value='<?php echo date('m/d/Y',strtotime($MeetingData[0]['MeetingDate']))?>' autocomplete="off" required>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">In Time</label>
                                        <!--                        <input class="form-control" id="Class" name="Class" placeholder="Enter Class" type="text" required>-->
                                        <input class="timepicker timepicker-with-dropdown form-control" readonly name="InTime" placeholder="In Time" value='<?php echo date('h:i A',strtotime($MeetingData[0]['InTime']))?>' autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Out Time</label>
                                        <!--                        <input class="form-control" id="Class" name="Class" placeholder="Enter Class" type="text" required>-->
                                        <input class="timepicker timepicker-with-dropdown form-control" readonly name="OutTime" placeholder="Out Time" value='<?php echo date('h:i A',strtotime($MeetingData[0]['OutTime']))?>' autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Training Status</label>
                                <select class="form-control" id="MeetingStatus" name="MeetingStatus" onchange="GetSelectedTextValue(this)" required>
                                    <option value="">Select Status</option>
                                    <option value="Scheduled" <?php if($MeetingData[0]['MeetingStatus'] == 'Scheduled'){echo 'selected'; }?>>Scheduled</option>
                                    <option value="Cancelled" <?php if($MeetingData[0]['MeetingStatus'] == 'Cancelled'){echo 'selected'; }?>>Cancelled</option>
                                    <option value="Postponed" <?php if($MeetingData[0]['MeetingStatus'] == 'Postponed'){echo 'selected'; }?>>Postponed</option>
                                    <option value="Completed" <?php if($MeetingData[0]['MeetingStatus'] == 'Completed'){echo 'selected'; }?>>Completed</option>

                                </select>
                            </div>

                            <div class="form-group reasonText" id="reasonText" <?php if($MeetingData[0]['MeetingStatus'] == 'Cancelled'){ echo 'style="display: block"'; }else {echo 'style="display: none"';} ?>>
                                <label for="exampleInputEmail1">Reason</label>
                                <input class="form-control" id="CancelReason" name="CancelReason" placeholder="Enter Reason" type="text" value="<?php echo $MeetingData[0]['CancelReason'];?>" >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Participants</label>
                                <input class="form-control" id="Participants" name="Participants" placeholder="Enter Participants" type="text" value='<?php echo $MeetingData[0]['Participants'] ?>'>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <input class="form-control" id="Description" name="Description" placeholder="Enter Description" type="text" value='<?php echo $MeetingData[0]['Description'] ?>'>
                            </div>


                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
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
<!-- /.content-wrapper -->
<script src="<?php echo base_url(); ?>assets/js/meeting.js" type="text/javascript"></script>
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
    } );

    function GetSelectedTextValue(MeetingStatus) {
        //alert(TrainingStatus);
        var selectedText = MeetingStatus.options[MeetingStatus.selectedIndex].innerHTML;
        var selectedValue = MeetingStatus.value;
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

    function GetSchoolVillage(selectedvalue){

        var selectedText = selectedvalue.options[selectedvalue.selectedIndex].innerHTML;
        var selectedValue = selectedvalue.value;
        //alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue == 'Village'){
            var x = document.getElementById("VillageId");
            x.style.display = "block";

            var y = document.getElementById("SchoolId");
            y.style.display = "none";
        }
        if(selectedValue == 'School'){
            //alert('deepak');
            var z = document.getElementById("SchoolId");
            z.style.display = "block";

            var k = document.getElementById("VillageId");
            k.style.display = "none";
        }
        if(selectedValue == ''){
            var x = document.getElementById("VillageId");
            x.style.display = "none";

            var y = document.getElementById("SchoolId");
            y.style.display = "none";
        }

    }

</script>
