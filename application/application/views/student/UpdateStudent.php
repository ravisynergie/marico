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
              <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>student/StudentList">StudentList</a> > UpdateStudent</span>
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
                <h3 class="card-title">Update Student </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">
                
                <?php foreach($StudentData as $data) { ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">School</label>
                        <select class="form-control" id="SchoolId" name="SchoolId" required>
                            <option value="">Select School</option>
                            <?php foreach($SchoolData as $schdata) {
                                if(empty($schdata['Name'])){}
                                else {
                                    ?>
                                    <option value="<?php echo $schdata['Id'];?>" <?php if($schdata['Id'] == $data['SchoolId']) { echo 'selected'; } ?>><?php echo ucfirst($schdata['Name']);?></option>
                                <?php } } ?>
                        </select>
                    </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Student Name</label>
                    <input class="form-control" id="Name" name="Name" value="<?php echo $data['Name'];?>" placeholder="Enter student name" type="text" required>
                  </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Class</label>
                        <input class="form-control" id="Class" name="Class" value="<?php echo $data['Class'];?>" placeholder="Enter Class" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Gender</label>
                        <select class="form-control" id="Gender" name="Gender" required="">
                            <option value="">Select Gender</option>
                            <option value="Male" <?php if($data['Gender'] == 'Male') { echo 'selected'; } ?>>Male</option>
                            <option value="Female" <?php if($data['Gender'] == 'Female') { echo 'selected'; } ?>>Female</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Age</label>
                        <input class="form-control" id="Age" name="Age" value="<?php echo $data['Age'];?>" placeholder="Enter Age" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Roll No</label>
                        <input class="form-control" id="RollNo" value="<?php echo $data['RollNo'];?>" name="RollNo" placeholder="Enter Roll No" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Guardian Name</label>
                        <input class="form-control" id="GuardianName" value="<?php echo $data['GuardianName'];?>" name="GuardianName" placeholder="Enter Guardian Name" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Relationship With Student</label>
                        <select class="form-control" id="RelationshipWithStudent" name="RelationshipWithStudent" required="">
                            <option value="">Select Relationship</option>
                            <option value="Father" <?php if($data['RelationshipWithStudent'] == 'Father') { echo 'selected'; } ?>>Father</option>
                            <option value="Mother" <?php if($data['RelationshipWithStudent'] == 'Mother') { echo 'selected'; } ?>>Mother</option>
                            <option value="Brother" <?php if($data['RelationshipWithStudent'] == 'Brother') { echo 'selected'; } ?>>Brother</option>
                            <option value="Sister" <?php if($data['RelationshipWithStudent'] == 'Sister') { echo 'selected'; } ?>>Sister</option>
                            <option value="Uncle" <?php if($data['RelationshipWithStudent'] == 'Uncle') { echo 'selected'; } ?>>Uncle</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone No</label>
                        <input class="form-control" id="PhoneNo" value="<?php echo $data['PhoneNo'];?>" name="PhoneNo" placeholder="Enter Phone No" type="text" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Report Card Distributed</label>

                        <select class="form-control" id="ReportCardDistributed" name="ReportCardDistributed" required="">
                            <option value="">Select Report Card</option>
                            <option value="Yes" <?php if($data['ReportCardDistributed'] == 'Yes') { echo 'selected'; } ?>>Yes</option>
                            <option value="No" <?php if($data['ReportCardDistributed'] == 'No') { echo 'selected'; } ?>>No</option>

                        </select>
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
  <script src="<?php echo base_url(); ?>assets/js/student.js" type="text/javascript"></script>