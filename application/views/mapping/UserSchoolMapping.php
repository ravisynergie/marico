<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?php
      //echo 'deepak';
     // print_r($UserId);
      ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mapping</h1>
          </div>
          <div class="col-sm-6">
              <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>mapping/MappingList">MappingList</a> > UserSchoolMapping</span>
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
                <h3 class="card-title">Mapping Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">
                
                <div class="card-body">

<!--                    <div class="form-group">-->
<!--                        <label for="exampleInputEmail1">Users</label>-->
<!--                        <select class="form-control" id="UserId" name="UserId" required>-->
<!--                            <option value="">Select User</option>-->
<!--                            --><?php //foreach($UsersData as $usdata) { ?>
<!--                                <option value="--><?php //echo $usdata['Id'];?><!--">--><?php //echo $usdata['UserName'];?><!--</option>-->
<!--                            --><?php //} ?>
<!--                        </select>-->
<!--                    </div>-->
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">District</label>
                    <select class="form-control" id="DistrictId" name="DistrictId" >
                      <option value="">Select District</option>
                      <?php foreach($DistrictData as $disdata) { ?>
                      <option value="<?php echo $disdata['Id'];?>"><?php echo $disdata['Name'];?></option>
                      <?php } ?>
                    </select>
                  </div>

<!--                    <div class="custom-control custom-checkbox">-->
<!--                        <input type="checkbox" class="custom-control-input" name="SelectAll" id="SelectAll">-->
<!--                        <label class="custom-control-label" for="SelectAll">Select All</label>-->
<!--                    </div>-->

                  <div class="AllSchool" id="AllSchool">
                      <label for="exampleInputEmail1">School</label>

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
  <script src="<?php echo base_url(); ?>assets/js/mapping.js" type="text/javascript"></script>


<script type="text/javascript">

    $('#DistrictId').change(function () {

        //var UserId = jQuery('#UserId option:selected').val();
        var UserId = '<?php echo $UserId; ?>';
        //alert(UserId);
        var Id = this.value;
        var URL = "<?php echo base_url(); ?>mapping/GetDistrictSchool?id="+Math.random();
        //alert(URL);
        jQuery.ajax({
            url : URL,
            type: "POST",
            data : {Id:Id, UserId:UserId},
            success: function(data)
            {
                jQuery('#AllSchool').html(data);
                //jQuery('#'+Id).remove();
            }
        });
    });

</script>