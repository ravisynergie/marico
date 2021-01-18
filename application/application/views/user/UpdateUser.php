<!-- Content Wrapper. Contains page content -->
<?php
//echo "<pre>";
//print_r($UsersData);
//echo "</pre>";
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update User</h1>
          </div>
          <div class="col-sm-6">
              <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>user/UserList">UserList</a> > UpdateUser</span>
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
                <h3 class="card-title">Update User </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="">

                  <?php foreach($UsersData as $data) { ?>
                  <div class="card-body">
                      <div class="form-group">
                          <label for="exampleInputEmail1">First Name</label>
                          <input class="form-control" id="FirstName" name="FirstName" value="<?php echo $data['FirstName'];?>" placeholder="Enter First Name" type="text" required>
                      </div>

                      <div class="form-group">
                          <label for="exampleInputEmail1">Last Name</label>
                          <input class="form-control" id="LastName" name="LastName" value="<?php echo $data['LastName'];?>" placeholder="Enter Last Name" type="text" >
                      </div>

                      <div class="form-group">
                          <label for="exampleInputEmail1">Designation</label>
                          <select class="form-control" id="UserGroupId" name="UserGroupId" onchange="GetSelectedTextValue(this)" required>
                              <option value="">Select Designation</option>
                              <?php foreach($DesignationData as $desidata) {
                                  if(empty($desidata['Name'])){}
                                  else {
                                      ?>
                                      <option value="<?php echo $desidata['Id'];?>" <?php if($desidata['Id'] == $data['UserGroupId']) { echo 'selected'; } ?>><?php echo ucfirst($desidata['Name']);?></option>
                                  <?php } } ?>
                          </select>
                      </div>

<!--                      <div class="form-group" id="UserNameDiv">-->
<!--                          <label for="exampleInputEmail1">Username</label>-->
<!--                          <input class="form-control" id="UserName" name="UserName" value="--><?php //echo $data['UserName'];?><!--" placeholder="Enter Username" type="text" required>-->
<!--                      </div>-->
<!---->
<!--                      <div class="form-group" id="PasswordDiv">-->
<!--                          <label for="exampleInputEmail1">Password</label>-->
<!--                          <input class="form-control" id="Password" name="Password" value="" placeholder="Enter Password" type="text" required>-->
<!--                      </div>-->

                      <div class="form-group">
                          <label for="exampleInputEmail1">Email</label>
                          <input class="form-control" id="Email" name="Email" value="<?php echo $data['Email'];?>" placeholder="Enter Email" type="text" >
                      </div>


                      <div class="form-group">
                          <label for="exampleInputEmail1">Phone no.</label>
                          <input class="form-control" id="Phone" name="Phone" value="<?php echo $data['Phone'];?>" placeholder="Enter Phone No" type="text" required>
                      </div>

                      <div class="form-group">
                          <label for="exampleInputEmail1">Joining Date</label>
                          <!--                    <input class="form-control" id="Name" name="Name" placeholder="Enter student name" type="text" required>-->
                          <input type="text" class="form-control" value="<?php echo date('m/d/Y',strtotime($data['JoiningDate']))?>" placeholder="Joining Date" name="JoiningDate" id="datepicker" autocomplete="off" required>
                      </div>

                      <div class="form-group">
                          <label for="exampleInputEmail1">Total Student Target</label>
                          <input class="form-control" id="StudentTarget" name="StudentTarget" value="<?php echo $data['StudentTarget'];?>" placeholder="Enter Student Target" type="text" required>
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
<script src="<?php echo base_url(); ?>assets/js/user.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $( document ).ready(function() {


        var UserGroupId = $("#UserGroupId").val();
        //alert(UserGroupId);
        if (UserGroupId == '7') {
            //alert(UserGroupId);
        
            // var x = document.getElementById("UserNameDiv");
            // x.style.display = "none";
            //
            // var y = document.getElementById("PasswordDiv");
            // y.style.display = "none";
            //
            // $("#UserName").prop('required', false);
            // $("#Password").prop('required', false);
    }
    });
    $( function() {
        $( "#datepicker" ).datepicker();
    } );

    function GetSelectedTextValue(DesignationStatus) {
        //alert(DesignationStatus);
        var selectedText = DesignationStatus.options[DesignationStatus.selectedIndex].innerHTML;
        var selectedValue = DesignationStatus.value;
        //alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue == '7'){
            // var x = document.getElementById("UserNameDiv");
            // x.style.display = "none";
            //
            // var y = document.getElementById("PasswordDiv");
            // y.style.display = "none";
            //
            // $("#UserName").prop('required',false);
            // $("#Password").prop('required',false);
        }
        else{

            // var x = document.getElementById("UserNameDiv");
            // x.style.display = "block";
            //
            // var y = document.getElementById("PasswordDiv");
            // y.style.display = "block";
            //
            // $("#UserName").prop('required',true);
            // $("#Password").prop('required',true);
        }

    }

</script>