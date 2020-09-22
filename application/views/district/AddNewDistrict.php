<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New District</h1>
          </div>
          <div class="col-sm-6">
              <?php if($SessionData['UserGroupId'] == '2'){?>
                <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>dashboard/ProjectView">ProjectView</a> > AddNewDistrict</span>
              <?php } else {?>
                  <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>district/DistrictList">DistrictList</a> > AddNewDistrict</span>
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
                <h3 class="card-title">District Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">
                
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">District Name</label>
                    <input class="form-control" id="Name" name="Name" placeholder="Enter district name" type="text" required>
                  </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Latitude</label>
                        <input class="form-control" id="Latitude" name="Latitude" placeholder="Enter latitude" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Longitude</label>
                        <input class="form-control" id="Longitude" name="Longitude" placeholder="Enter longitude" type="text" required>
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
  <script src="<?php echo base_url(); ?>assets/js/district.js" type="text/javascript"></script>