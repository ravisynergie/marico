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
              <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>school/SchoolList">SchoolList</a> > UpdateSchool</span>
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
                <h3 class="card-title">Update School </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">
                
                <?php foreach($SchoolData as $data) { ?>
                <div class="card-body">


                    <div class="form-group">
                        <label for="exampleInputEmail1">Village</label>
                        <select class="form-control" id="VillageId" name="VillageId" required>
                            <option value="">Select Village</option>
                            <?php foreach($VillageData as $vildata) {
                                if(empty($vildata['Name'])){}
                                else{
                                    ?>
                                    <option value="<?php echo $vildata['Id'];?>" <?php if($vildata['Id'] == $data['VillageId']) { echo 'selected'; } ?>><?php echo ucfirst($vildata['Name']);?></option>
                                <?php } } ?>
                        </select>
                    </div>



                  <div class="form-group">
                    <label for="exampleInputEmail1">School Name</label>
                    <input class="form-control" id="Name" name="Name" value="<?php echo $data['Name'];?>" placeholder="Enter school name" type="text" required>
                  </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Model School</label>
                        <input class="form-control" id="ModelSchool" name="ModelSchool" value="<?php echo $data['ModelSchool'];?>" placeholder="Enter school name" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Principal Name</label>
                        <input class="form-control" id="PrincipalName" name="PrincipalName" value="<?php echo $data['PrincipalName'];?>" placeholder="Enter principal name" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Principal Contact No</label>
                        <input class="form-control" id="PrincipalContactNo" name="PrincipalContactNo" value="<?php echo $data['PrincipalContactNo'];?>" placeholder="Enter principal contact no" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">No Teachers School</label>
                        <input class="form-control" id="NoTeachersSchool" name="NoTeachersSchool" value="<?php echo $data['NoTeachersSchool'];?>" placeholder="Enter no teachers school" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Spoc Name</label>
                        <input class="form-control" id="SpocName" name="SpocName" value="<?php echo $data['SpocName'];?>" placeholder="Enter spoc name" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Spoc Designation</label>
                        <input class="form-control" id="SpocDesignation" name="SpocDesignation" value="<?php echo $data['SpocDesignation'];?>" placeholder="Enter spoc designation" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Spoc Contact No</label>
                        <input class="form-control" id="SpocContactNo" name="SpocContactNo" value="<?php echo $data['SpocContactNo'];?>" placeholder="Enter spoc contact no" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Resources Available in School</label>
                        <input class="form-control" id="ResourcesAvailableSchool" name="ResourcesAvailableSchool" value="<?php echo $data['ResourcesAvailableSchool'];?>" placeholder="Enter Resources Available" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Smc Active</label>
                        <input class="form-control" id="SmcActive" name="SmcActive" value="<?php echo $data['SmcActive'];?>" placeholder="Enter smc active" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Smc Representative Name 1</label>
                        <input class="form-control" id="SmcRepresentativeName1" name="SmcRepresentativeName1" value="<?php echo $data['SmcRepresentativeName1'];?>" placeholder="Enter smc representative name 1" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Smc Representative Contact 1</label>
                        <input class="form-control" id="SmcRepresentativeContact1" name="SmcRepresentativeContact1" value="<?php echo $data['SmcRepresentativeContact1'];?>" placeholder="Enter Smc representative contact 1" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Smc Representative Name 2</label>
                        <input class="form-control" id="SmcRepresentativeName2" name="SmcRepresentativeName2" value="<?php echo $data['SmcRepresentativeName2'];?>" placeholder="Enter Smc representative name 2" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Smc Representative Contact 2</label>
                        <input class="form-control" id="SmcRepresentativeContact2" name="SmcRepresentativeContact2" value="<?php echo $data['SmcRepresentativeContact2'];?>" placeholder="Enter smc representative contact 2" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Latitude</label>
                        <input class="form-control" id="Latitude" name="Latitude" value="<?php echo $data['Latitude'];?>" placeholder="Enter Latitude" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Longitude</label>
                        <input class="form-control" id="Longitude" name="Longitude" value="<?php echo $data['Longitude'];?>" placeholder="Enter Longitude" type="text" required>
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
  <script src="<?php echo base_url(); ?>assets/js/school.js" type="text/javascript"></script>