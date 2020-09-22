<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Village</h1>
          </div>
          <div class="col-sm-6">
              <?php if($SessionData['UserGroupId'] == '2'){?>
                  <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>dashboard/ProjectView">ProjectView</a> > AddNewVillage</span>
              <?php } else {?>
                  <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>village/VillageList">VillageList</a> > AddNewVillage</span>
              <?php } ?>

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
                <h3 class="card-title">Village Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">
                
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Village Name</label>
                    <input class="form-control" id="Name" name="Name" placeholder="Enter village name" type="text" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gram Panchayat</label>
                    <input class="form-control" id="GramPanchayat" name="GramPanchayat" placeholder="Enter gram panchayat" type="text" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">District</label>
                    <select class="form-control" id="DistrictId" name="DistrictId" required>
                      <option value="">Select District</option>
                      <?php foreach($DistrictData as $disdata) { ?>
                      <option value="<?php echo $disdata['Id'];?>"><?php echo $disdata['Name'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Block</label>
                    <select class="form-control" id="BlockId" name="BlockId" required>
                      <option value="">Select Block</option>
                      <?php foreach($BlockData as $disdata) { ?>
                      <option value="<?php echo $disdata['Id'];?>"><?php echo $disdata['Name'];?></option>
                      <?php } ?>
                    </select>
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


<!--                  <div class="form-group">-->
<!--                    <label for="exampleInputEmail1">Stakeholders Name</label>-->
<!--                    <input class="form-control" id="StakeholdersName" name="StakeholdersName" placeholder="Enter stakeholders name" type="text">-->
<!--                  </div>-->
<!--                  -->
<!--                  <div class="form-group">-->
<!--                    <label for="exampleInputEmail1">Stakeholders Designation</label>-->
<!--                    <select class="form-control" id="StakeholdersDesignation" name="StakeholdersDesignation" onChange="ChkOtherDesignation(this.value)">-->
<!--                    <option value="">Stakeholders Designation</option>-->
<!--                    <option>Pradhan</option>-->
<!--                    <option>Govt. Official</option>-->
<!--                    <option>Educated Youth</option>-->
<!--                    <option>opinion Leader</option>-->
<!--                    <option>Ngo Worker</option>-->
<!--                    <option>DM</option>-->
<!--                    <option>DIOS</option>-->
<!--                    <option>BSA</option>-->
<!--                    <option>CDO</option>-->
<!--                    <option>AWW</option>-->
<!--                    <option>ASHA</option>-->
<!--                    <option>SHG Member</option>-->
<!--                    <option>Other</option>-->
<!--                    </select>-->
<!--                  </div>-->
<!--                  -->
<!--                  <div class="form-group OtherDesignationName">-->
<!--                    <label for="exampleInputEmail1">Other Designation Name</label>-->
<!--                    <input class="form-control" id="OtherDesignationName" name="OtherDesignationName" placeholder="Enter other designation name" type="text">-->
<!--                  </div>-->
<!--                  -->
<!--                  <div class="form-group">-->
<!--                    <label for="exampleInputEmail1">Stakeholders Contact</label>-->
<!--                    <input class="form-control" id="StakeholdersContact" name="StakeholdersContact" placeholder="Enter stakeholders contact" type="text">-->
<!--                  </div>-->
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Community Resources</label>
                    <input class="form-control" id="CommunityResources" name="CommunityResources" placeholder="Enter community resources" type="text">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Village Population</label>
                    <input class="form-control" id="VillagePopulation" name="VillagePopulation" placeholder="Enter village population" type="text">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">No. Households</label>
                    <input class="form-control" id="NoHouseholds" name="NoHouseholds" placeholder="Enter no. households" type="text">
                  </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Latitude</label>
                        <input class="form-control" id="Latitude" name="Latitude" placeholder="Enter Latitude" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Longitude</label>
                        <input class="form-control" id="Longitude" name="Longitude" placeholder="Enter Longitude" type="text" required>
                    </div>
                  
                  
                </div>  
                <!-- /.card-body -->
				
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="https://www.latlong.net/" class="btn btn-primary" target="_blank">Search Lat/Long</a>
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
  <script src="<?php echo base_url(); ?>assets/js/village.js" type="text/javascript"></script>
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