<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Assessment</h1>
          </div>
          <div class="col-sm-6">
              <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>assessment/AssessmentList">AssessmentList</a> > AddNewAssessment</span>

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
                <h3 class="card-title">Assessment Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">
                
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Assessment Name</label>
                    <input class="form-control" id="Name" name="Name" placeholder="Enter Assessment name" type="text" required>
                  </div>
                  



                    <div class="row" id="1">
                        <div class="col-1" style="margin-right: -25px">
                           <label for="exampleInputEmail1">Question1</label>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <input class="form-control" id="Question" name="Question[]" placeholder="Enter Question" type="text">
                            </div>
                        </div>



                        <div class="col-1">
                            <div id="Q1" Class="circleplus" style="margin-top: 5px" onclick="addQuestion()">+</div>

                        </div>
                    </div>

                    <div class="addQuestion" id="addQuestion"></div>


                  
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
  <script src="<?php echo base_url(); ?>assets/js/Assessment.js" type="text/javascript"></script>
<script>
    $( document ).ready(function() {
        console.log( "ready!" );
        //var otherTime = 1;
    });
    var otherTime = 1;
    function addQuestion() {
        //alert(otherTime);

        otherTime = otherTime+1;
        var URL = "<?php echo base_url(); ?>assessment/AddQuestion?id="+Math.random();
        var Id = this.value;
        jQuery.ajax({
            url : URL,
            type: "POST",
            data : {num:otherTime},
            success: function(data)
            {
                jQuery('#addQuestion').append(data);
                //jQuery('#'+Id).remove();
            }
        });

    }
</script>