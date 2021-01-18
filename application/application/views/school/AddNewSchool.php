<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New School</h1>
          </div>
          <div class="col-sm-6">
              <?php if($SessionData['UserGroupId'] == '2'){?>
                  <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>dashboard/ProjectView">ProjectView</a> > AddNewSchool</span>
              <?php } else {?>
                  <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>school/SchoolList">SchoolList</a> > AddNewSchool</span>
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
                <h3 class="card-title">School Details</h3>
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
                    <label for="exampleInputEmail1">School Name</label>
                    <input class="form-control" id="Name" name="Name" placeholder="Enter school name" type="text" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Model School</label>
                    <select class="form-control" id="ModelSchool" name="ModelSchool" required>
                       <option value="No">No</option>
                       <option value="Yes">Yes</option>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Principal Name</label>
                    <input class="form-control" id="PrincipalName" name="PrincipalName" placeholder="Enter principal name" type="text" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Principal Contact Number</label>
                    <input class="form-control" id="PrincipalContactNo" name="PrincipalContactNo" placeholder="Enter principal contact no" type="text" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Number of Teachers in school</label>
                    <input class="form-control" id="NoTeachersSchool" name="NoTeachersSchool" placeholder="Enter no teachers school" type="text" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">SPOC name</label>
                    <input class="form-control" id="SpocName" name="SpocName" placeholder="Enter spoc name" type="text" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">SPOC designation</label>
                    <input class="form-control" id="SpocDesignation" name="SpocDesignation" placeholder="Enter spoc designation" type="text" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">SPOC Contact number</label>
                    <input class="form-control" id="SpocContactNo" name="SpocContactNo" placeholder="Enter spoc contact no" type="text" required>
                  </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Resources Available in School</label>
                        <input class="form-control" id="ResourcesAvailableSchool" name="ResourcesAvailableSchool" placeholder="Enter Resources Available" type="text">
                        
                    
                    </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">SMC Active</label>
                    <select class="form-control" id="SmcActive" name="SmcActive" required>
                       <option value="Yes">Yes</option>
                       <option value="No">No</option>                       
                    </select>
                    
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">SMC representative Name 1</label>
                    <input class="form-control" id="SmcRepresentativeName1" name="SmcRepresentativeName1" placeholder="Enter smc representative name 1" type="text">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">SMC representative Contact 1</label>
                    <input class="form-control" id="SmcRepresentativeContact1" name="SmcRepresentativeContact1" placeholder="Enter Smc representative contact 1" type="text">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">SMC representative Name 2</label>
                    <input class="form-control" id="SmcRepresentativeName2" name="SmcRepresentativeName2" placeholder="Enter Smc representative name 2" type="text">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">SMC representative Contact 2</label>
                    <input class="form-control" id="SmcRepresentativeContact2" name="SmcRepresentativeContact2" placeholder="Enter smc representative contact 2" type="text">
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
  <script src="<?php echo base_url(); ?>assets/js/school.js" type="text/javascript"></script>