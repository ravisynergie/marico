<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<div class="content-wrapper">
    <?php
        //echo '<pre>';
        //print_r($EventData);
        //echo '</pre>';
    $StakeholdersDesignation = json_decode($EventData[0]['StakeholdersDesignation']);
    $OtherDesignationName = json_decode($EventData[0]['OtherDesignationName']);
    $StakeholdersContact = json_decode($EventData[0]['StakeholdersContact']);
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Event</h1>
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

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Event Details</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="">


                        <div class="card-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Village</label>
                                <select class="form-control" id="VillageId" name="VillageId" required>
                                    <option value="">Select Village</option>
                                    <?php foreach($VillageData as $vildata) {
                                        if(empty($vildata['Name'])){}
                                        else{
                                            ?>
                                            <option value="<?php echo $vildata['Id'];?>" <?php if($vildata['Id']==$EventData[0]['VillageId']) { ?> selected <?php } ?>><?php echo ucfirst($vildata['Name']);?></option>
                                        <?php } } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Ocassion</label>
                                <input class="form-control" id="Ocassion" name="Ocassion" value="<?php echo $EventData[0]['Ocassion'];?>" placeholder="Enter Ocassion" type="text" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Event Date</label>
                                <!--                    <input class="form-control" id="Name" name="Name" placeholder="Enter student name" type="text" required>-->
                                <input type="text" class="form-control" placeholder="Event Date" name="EventDate" id="datepicker" value='<?php echo date('m/d/Y',strtotime($EventData[0]['EventDate']))?>' autocomplete="off" required>
                            </div>

                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">In Time</label>
                                        <!--                        <input class="form-control" id="Class" name="Class" placeholder="Enter Class" type="text" required>-->
                                        <input class="timepicker timepicker-with-dropdown form-control" readonly name="InTime" placeholder="In Time" value='<?php echo date('h:i A',strtotime($EventData[0]['InTime']))?>' autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Out Time</label>
                                        <!--                        <input class="form-control" id="Class" name="Class" placeholder="Enter Class" type="text" required>-->
                                        <input class="timepicker timepicker-with-dropdown form-control" readonly name="OutTime" placeholder="Out Time" value='<?php echo date('h:i A',strtotime($EventData[0]['OutTime']))?>' autocomplete="off" required>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Training Status</label>
                                <select class="form-control" id="EventStatus" name="EventStatus" onchange="GetSelectedTextValue(this)" required>
                                    <option value="">Select Status</option>
                                    <option value="Scheduled" <?php if($EventData[0]['EventStatus'] == 'Scheduled'){echo 'selected'; }?>>Scheduled</option>
                                    <option value="Cancelled" <?php if($EventData[0]['EventStatus'] == 'Cancelled'){echo 'selected'; }?>>Cancelled</option>
                                    <option value="Postponed" <?php if($EventData[0]['EventStatus'] == 'Postponed'){echo 'selected'; }?>>Postponed</option>
                                    <option value="Completed" <?php if($EventData[0]['EventStatus'] == 'Completed'){echo 'selected'; }?>>Completed</option>

                                </select>
                            </div>

                            <div class="form-group reasonText" id="reasonText" <?php if($TrainingData[0]['EventStatus'] == 'Cancelled'){ echo 'style="display: block"'; }else {echo 'style="display: none"';} ?>>
                                <label for="exampleInputEmail1">Reason</label>
                                <input class="form-control" id="CancelReason" name="CancelReason" placeholder="Enter Reason" type="text" value="<?php echo $EventData[0]['CancelReason'];?>" >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Theme</label>
                                <input class="form-control" id="Theme" name="Theme" value="<?php echo $EventData[0]['Theme'];?>" placeholder="Enter Theme" type="text" required>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Event Type</label>
                                <select class="form-control" id="EventType" name="EventType" required>
                                    <option value="BaLAPainting" <?php if($EventData[0]['EventType']=='BaLAPainting') { ?> selected <?php } ?>>BaLA Painting</option>
                                    <option value="StreetPlay" <?php if($EventData[0]['EventType']=='StreetPlay') { ?> selected <?php } ?>>Street Play</option>
                                    <option value="PuppetShow" <?php if($EventData[0]['EventType']=='PuppetShow') { ?> selected <?php } ?>>Puppet show</option>
                                    <option value="MovieScreening" <?php if($EventData[0]['EventType']=='MovieScreening') { ?> selected <?php } ?>>Movie screening</option>
                                    <option value="Chaupal" <?php if($EventData[0]['EventType']=='Chaupal') { ?> selected <?php } ?>>Chaupal</option>
                                    <option value="Other" <?php if($EventData[0]['EventType']=='Other') { ?> selected <?php } ?>>Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Detail</label>
                                <input class="form-control" id="Detail" name="Detail" value="<?php echo $EventData[0]['Detail'];?>" placeholder="Enter Detail" type="text" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Location of event</label>
                                <select class="form-control" id="LocationEvent" name="LocationEvent" required>
                                    <option value="School" <?php if($EventData[0]['LocationEvent']=='School') { ?> selected <?php } ?>>School</option>
                                    <option value="Community" <?php if($EventData[0]['LocationEvent']=='Community') { ?> selected <?php } ?>>Community</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">No. of Participants</label>
                                <input class="form-control" id="NumberParticipants" name="NumberParticipants" value="<?php echo $EventData[0]['NumberParticipants'];?>" placeholder="Enter Number of Participants" type="text" required>
                            </div>

                            <?php if(json_decode($EventData[0]['StakeholdersName']) == ''){ ?>

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
                            <?php } ?>
                            <?php foreach (json_decode($EventData[0]['StakeholdersName'])as $key=>$tmpStake) { ?>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Stakeholders Name</label>
                                            <input class="form-control" id="StakeholdersName" name="StakeholdersName[]" value="<?php echo $tmpStake; ?>" placeholder="Enter stakeholders name" type="text">
                                        </div>


                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Stakeholders Designation</label>
                                            <select class="form-control" id="StakeholdersDesignation" name="StakeholdersDesignation[]" onChange="ChkOtherDesignation(this.value)">
                                                <option value="">Stakeholders Designation</option>
                                                <option <?php if('Pradhan'==$StakeholdersDesignation[$key]) { ?> selected <?php } ?>>Pradhan</option>
                                                <option <?php if('Govt. Official'==$StakeholdersDesignation[$key]) { ?> selected <?php } ?>>Govt. Official</option>
                                                <option <?php if('Educated Youth'==$StakeholdersDesignation[$key]) { ?> selected <?php } ?>>Educated Youth</option>
                                                <option <?php if('opinion Leader'==$StakeholdersDesignation[$key]) { ?> selected <?php } ?>>opinion Leader</option>
                                                <option <?php if('Ngo Worker'==$StakeholdersDesignation[$key]) { ?> selected <?php } ?>>Ngo Worker</option>
                                                <option <?php if('DM'==$StakeholdersDesignation[$key]) { ?> selected <?php } ?>>DM</option>
                                                <option <?php if('DIOS'==$StakeholdersDesignation[$key]) { ?> selected <?php } ?>>DIOS</option>
                                                <option <?php if('BSA'==$StakeholdersDesignation[$key]) { ?> selected <?php } ?>>BSA</option>
                                                <option <?php if('CDO'==$StakeholdersDesignation[$key]) { ?> selected <?php } ?>>CDO</option>
                                                <option <?php if('AWW'==$StakeholdersDesignation[$key]) { ?> selected <?php } ?>>AWW</option>
                                                <option <?php if('ASHA'==$StakeholdersDesignation[$key]) { ?> selected <?php } ?>>ASHA</option>
                                                <option <?php if('SHG Member'==$StakeholdersDesignation[$key]) { ?> selected <?php } ?>>SHG Member</option>
                                                <option <?php if('Other'==$StakeholdersDesignation[$key]) { ?> selected <?php } ?>>Other</option>

                                            </select>
                                        </div>



                                    </div>

                                    <div class="col-3 OtherDesignationName" style="display: <?php if($StakeholdersDesignation[$key] == 'Other'){ echo 'block';} else{ echo 'none'; }?>">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Other Designation Name</label>
                                            <input class="form-control" id="OtherDesignationName" name="OtherDesignationName[]" value="<?php echo $OtherDesignationName[$key]; ?>" placeholder="Enter other designation name" type="text">
                                        </div>

                                    </div>

                                    <div class="col-2">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Stakeholders Contact</label>
                                            <input class="form-control" id="StakeholdersContact" name="StakeholdersContact[]" value="<?php echo $StakeholdersContact[$key]; ?>" placeholder="Enter stakeholders contact" type="text">
                                        </div>
                                    </div>
                                    <?php if($key == 0){ ?>
                                        <div class="col-1">
                                            <label for="exampleInputEmail1"></label><br>
                                            <div Class="circleplus" onclick="addStakholder()">+</div>

                                        </div>
                                    <?php } ?>
                                    <!--                         <div class="col-1">-->
                                    <!--                             <label for="exampleInputEmail1"></label><br>-->
                                    <!--                             <div Class="circleplus" onclick="addStakholder()">+</div>-->
                                    <!---->
                                    <!--                         </div>-->
                                </div>
                            <? } ?>

                            <div class="addstakeholder" id="addstakeholder"></div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Collaboration Organization</label>
                                <input class="form-control" id="CollaborationOrganization" name="CollaborationOrganization" value="<?php echo $EventData[0]['CollaborationOrganization'];?>" placeholder="Enter Collaboration Organization" type="text" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Collaboration Detail</label>
                                <input class="form-control" id="CollaborationDetail" name="CollaborationDetail" value="<?php echo $EventData[0]['CollaborationDetail'];?>" placeholder="Enter Collaboration Detail" type="text" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Collaboration SPOC</label>
                                <input class="form-control" id="CollaborationSPOC" name="CollaborationSPOC" value="<?php echo $EventData[0]['CollaborationSPOC'];?>" placeholder="Enter Collaboration SPOC" type="text" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Collaboration Contact</label>
                                <input class="form-control" id="CollaborationContact" name="CollaborationContact" value="<?php echo $EventData[0]['CollaborationContact'];?>" placeholder="Enter Collaboration Contact" type="text" required>
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
                                                        foreach(json_decode($EventData[0]['Volunteers']) as $mapTmp) {

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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $( document ).ready(function() {
        console.log( "ready!" );

    });

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

    function GetSelectedTextValue(EventStatus) {
        //alert(EventStatus);
        var selectedText = EventStatus.options[EventStatus.selectedIndex].innerHTML;
        var selectedValue = EventStatus.value;
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
</script>