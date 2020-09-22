<!-- Content Wrapper. Contains page content -->
<?php
//echo '<pre>';
//print_r($SchoolData);
//echo '</pre>';
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Training</h1>
          </div>
          <div class="col-sm-6">
              <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>training/TrainingList">TrainingList</a> > AddNewTraining</span>
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
                <h3 class="card-title">Training Details</h3>
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
                    <label for="exampleInputEmail1">Training Date</label>
<!--                    <input class="form-control" id="Name" name="Name" placeholder="Enter student name" type="text" required>-->
                      <input type="text" class="form-control" placeholder="Training Date" name="TrainingDate" id="datepicker" autocomplete="off" required>
                  </div>

                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">In Time</label>
        <!--                        <input class="form-control" id="Class" name="Class" placeholder="Enter Class" type="text" required>-->
                                <input class="timepicker timepicker-with-dropdown form-control" readonly name="InTime" placeholder="In Time" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Out Time</label>
        <!--                        <input class="form-control" id="Class" name="Class" placeholder="Enter Class" type="text" required>-->
                                <input class="timepicker timepicker-with-dropdown form-control" readonly name="OutTime" placeholder="Out Time" autocomplete="off" required>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Training Status</label>
                        <select class="form-control" id="TrainingStatus" name="TrainingStatus" onchange="GetSelectedTextValue(this)" required>
                            <option value="">Select Status</option>
                            <option value="Scheduled">Scheduled</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Postponed">Postponed</option>
                            <option value="Completed">Completed</option>

                        </select>
                    </div>


                    <div class="form-group reasonText" style="display: none" id="reasonText">
                        <label for="exampleInputEmail1">Reason</label>
                        <input class="form-control" id="CancelReason" name="CancelReason" placeholder="Enter Reason" type="text">
                    </div>


<!--                    <div class="row reasonText" style="display: none" id="reasonText">-->
<!--                        <div class="col-sm-12">-->
<!--                            <div class="form-group required-inputs">-->
<!--                                <label class="control-label mb-5 text-left" for="zone">Reason</label>-->
<!--                                <div class="input text">-->
<!--                                    <input type="text" name="CancelReason" class="form-control" id="CancelReason">-->
<!--                                </div>-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->


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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $(document).ready(function(){
        $('input.timepicker').timepicker({
            'minTime': '6:00am',
            'maxTime': '8:00pm',
            'interval': '5'

        });
    });
    $( function() {
        $( "#datepicker" ).datepicker();
    } );

    function GetSelectedTextValue(TrainingStatus) {
        //alert(TrainingStatus);
        var selectedText = TrainingStatus.options[TrainingStatus.selectedIndex].innerHTML;
        var selectedValue = TrainingStatus.value;
        //alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue == 'Cancelled'){
            var x = document.getElementById("reasonText");
            x.style.display = "block";
        }
        else if(selectedValue == 'Postponed'){
            var x = document.getElementById("reasonText");
            x.style.display = "block";
        }
        else{
            var x = document.getElementById("reasonText");
            x.style.display = "none";
        }
    }

</script>
