<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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
                                <option value="<?php echo $vildata['Id'];?>"><?php echo ucfirst($vildata['Name']);?></option>
                            <?php } } ?>
                        </select>
                    </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ocassion</label>
                    <input class="form-control" id="Ocassion" name="Ocassion" placeholder="Enter Ocassion" type="text" required>
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

<script>
    $( document ).ready(function() {
        console.log( "ready!" );

    });

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