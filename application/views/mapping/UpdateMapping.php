<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Data</h1>
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
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Stakeholders Name</label>
                    <input class="form-control" id="StakeholdersName" name="StakeholdersName" value="<?php echo $data['StakeholdersName'];?>" placeholder="Enter stakeholders name" type="text" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Stakeholders Designation</label>
                    <select class="form-control" id="StakeholdersDesignation" name="StakeholdersDesignation" required onChange="ChkOtherDesignation(this.value)">
                    <option value="">Stakeholders Designation</option>
                    <option <?php if('Pradhan'==$data['StakeholdersDesignation']) { ?> selected <?php } ?>>Pradhan</option>
                    <option <?php if('Govt. Official'==$data['StakeholdersDesignation']) { ?> selected <?php } ?>>Govt. Official</option>
                    <option <?php if('Educated Youth'==$data['StakeholdersDesignation']) { ?> selected <?php } ?>>Educated Youth</option>
                    <option <?php if('Opinion Leader'==$data['StakeholdersDesignation']) { ?> selected <?php } ?>>Opinion Leader</option>
                    <option <?php if('Ngo Worker'==$data['StakeholdersDesignation']) { ?> selected <?php } ?>>Ngo Worker</option>
                    <option <?php if('DM'==$data['StakeholdersDesignation']) { ?> selected <?php } ?>>DM</option>
                    <option <?php if('DIOS'==$data['StakeholdersDesignation']) { ?> selected <?php } ?>>DIOS</option>
                    <option <?php if('Pradhan'==$data['StakeholdersDesignation']) { ?> selected <?php } ?>>BSA</option>
                    <option <?php if('CDO'==$data['StakeholdersDesignation']) { ?> selected <?php } ?>>CDO</option>
                    <option <?php if('AWW'==$data['StakeholdersDesignation']) { ?> selected <?php } ?>>AWW</option>
                    <option <?php if('ASHA'==$data['StakeholdersDesignation']) { ?> selected <?php } ?>>ASHA</option>
                    <option <?php if('SHG Member'==$data['StakeholdersDesignation']) { ?> selected <?php } ?>>SHG Member</option>
                    <option <?php if('Other'==$data['StakeholdersDesignation']) { ?> selected <?php } ?>>Other</option>
                    </select>
                  </div>
                  
                  <div class="form-group <?php if('Other'!=$data['StakeholdersDesignation']) { ?> OtherDesignationName <?php } ?>">
                    <label for="exampleInputEmail1">Other Designation Name</label>
                    <input class="form-control" id="OtherDesignationName" name="OtherDesignationName" value="<?php echo $data['OtherDesignationName'];?>" placeholder="Enter other designation name" type="text">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Stakeholders Contact</label>
                    <input class="form-control" id="StakeholdersContact" name="StakeholdersContact" value="<?php echo $data['StakeholdersContact'];?>" placeholder="Enter stakeholders contact" type="text" required>
                  </div>
                  
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