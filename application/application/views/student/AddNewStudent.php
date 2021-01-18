<!-- Content Wrapper. Contains page content -->
<?php
//echo '<pre>';
//print_r($SchoolData);
//echo '</pre>';
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Student</h1>
          </div>
          <div class="col-sm-6">
              <?php if($SessionData['UserGroupId'] == '2'){?>
                  <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>dashboard/ProjectView">ProjectView</a> > AddNewStudent</span>
              <?php } else {?>
                  <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>student/StudentList">StudentList</a> > AddNewStudent</span>
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
                <h3 class="card-title">Student Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">
                
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
                    <label for="exampleInputEmail1">Student's Name</label>
                    <input class="form-control" id="Name" name="Name" placeholder="Enter student name" type="text" required>
                  </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Class</label>
                        <input class="form-control" id="Class" name="Class" placeholder="Enter Class" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Gender</label>
                        <select class="form-control" id="Gender" name="Gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Age</label>
                        <input class="form-control" id="Age" name="Age" placeholder="Enter Age" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Roll no.</label>
                        <input class="form-control" id="RollNo" name="RollNo" placeholder="Enter Roll No" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Guardian's name</label>
                        <input class="form-control" id="GuardianName" name="GuardianName" placeholder="Enter Guardian Name" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Relationship with student</label>
                        <select class="form-control" id="RelationshipWithStudent" name="RelationshipWithStudent" required>
                            <option value="">Select Relationship</option>
                            <option value="Father">Father</option>
                            <option value="Mother">Mother</option>
                            <option value="Brother">Brother</option>
                            <option value="Sister">Sister</option>
                            <option value="Uncle">Uncle</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone no.</label>
                        <input class="form-control" id="PhoneNo" name="PhoneNo" placeholder="Enter Phone No" type="text">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Report card distributed</label>

                        <select class="form-control" id="ReportCardDistributed" name="ReportCardDistributed" required>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                            

                        </select>
                    </div>



                </div>  
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
  <script src="<?php echo base_url(); ?>assets/js/student.js" type="text/javascript"></script>