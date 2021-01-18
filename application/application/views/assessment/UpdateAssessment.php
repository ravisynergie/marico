<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?php
      echo '<pre>';
      //print_r($VillageData[0]['StakeholdersName']);
      //print_r($VillageData[0]['StakeholdersDesignation']);
      //print_r($VillageData[0]['OtherDesignationName']);
      //print_r($VillageData[0]['StakeholdersContact']);
      $StakeholdersDesignation = json_decode($VillageData[0]['StakeholdersDesignation']);
      $OtherDesignationName = json_decode($VillageData[0]['OtherDesignationName']);
      $StakeholdersContact = json_decode($VillageData[0]['StakeholdersContact']);
      echo '</pre>';
      ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Data</h1>
          </div>
          <div class="col-sm-6">
              <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>village/VillageList">VillageList</a> > UpdateVillage</span>
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
                <h3 class="card-title">Update Village </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">
                
                <?php foreach($VillageData as $data) { ?>
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Village Name</label>
                    <input class="form-control" id="Name" name="Name" value="<?php echo $data['Name'];?>" placeholder="Enter village name" type="text" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Gram Panchayat</label>
                    <input class="form-control" id="GramPanchayat" name="GramPanchayat" value="<?php echo $data['GramPanchayat'];?>" placeholder="Enter gram panchayat" type="text" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">District</label>
                    <select class="form-control" id="DistrictId" name="DistrictId" required>
                      <option value="">Select District</option>
                      <?php foreach($DistrictData as $disdata) { ?>
                      <option value="<?php echo $disdata['Id'];?>" <?php if($disdata['Id']==$data['DistrictId']) { ?> selected <?php } ?>><?php echo $disdata['Name'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Block</label>
                    <select class="form-control" id="BlockId" name="BlockId" required>
                      <option value="">Select Block</option>
                      <?php foreach($BlockData as $disdata) { ?>
                      <option value="<?php echo $disdata['Id'];?>" <?php if($disdata['Id']==$data['BlockId']) { ?> selected <?php } ?>><?php echo $disdata['Name'];?></option>
                      <?php } ?>
                    </select>
                  </div>


                    <?php if(json_decode($data['StakeholdersName']) == ''){ ?>

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
                 <?php foreach (json_decode($data['StakeholdersName'])as $key=>$tmpStake) { ?>
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
                    <label for="exampleInputEmail1">Community Resources</label>
                    <input class="form-control" id="CommunityResources" name="CommunityResources" value="<?php echo $data['CommunityResources'];?>" placeholder="Enter community resources" type="text" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Village Population</label>
                    <input class="form-control" id="VillagePopulation" name="VillagePopulation" value="<?php echo $data['VillagePopulation'];?>" placeholder="Enter village population" type="text" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">No. Households</label>
                    <input class="form-control" id="NoHouseholds" name="NoHouseholds" value="<?php echo $data['NoHouseholds'];?>" placeholder="Enter no. households" type="text" required>
                  </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Latitude</label>
                        <input class="form-control" id="Latitude" name="Latitude" placeholder="Enter Latitude" type="text" value="<?php echo $data['Latitude'];?>" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Longitude</label>
                        <input class="form-control" id="Longitude" name="Longitude" placeholder="Enter Longitude" type="text" value="<?php echo $data['Longitude'];?>" required>
                    </div>
                  
                  
                </div>
                <?php } ?>  
                <!-- /.card-body -->
				
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
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