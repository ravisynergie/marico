<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Event List</h1>
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
         
         <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success" role="alert">
              <?php echo $this->session->flashdata('msg'); ?>
         </div>
         <?php endif; ?>


          <div class="card">
            <div class="card-header">
              <div class="col-2 pull-right">
              	<a href="<?php echo base_url(); ?>event/AddNewEvent"> <button type="button" class="btn btn-primary btn-block btn-flat no-border">Add new event</button></a>
              </div>  
            </div>

              <div class="form-group">
                  <!--                  <label for="exampleInputEmail1">Activity Type</label>-->
                  <select class="form-control" id="ActivityType" name="ActivityType" onchange="GetActivityType(this)" required>
                      <option value="">Select Type</option>
                      <option value="Training">Training</option>
                      <option value="Meeting">Community Meeting</option>
                      <option value="Event">Event</option>

                  </select>
              </div>
            
            
            <!-- /.card-header -->
            <div class="card-body" data-ng-init="EventList()">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>

                  <th>Ocassion</th>
                  <th>Theme</th>
                  <th>EventType</th>
                  <th>Detail</th>
                  <th>Location of event</th>
                  <th>Village</th>
                  <th>District</th>
                  <th width="120">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="data in EventData" id="{{ data.Id }}">


          		<td>{{ data.Ocassion }}</td>
          		<td>{{ data.Theme }}</td>
          		<td>{{ data.EventType }}</td>
          		<td>{{ data.Detail }}</td>
          		<td>{{ data.LocationEvent }}</td>
          		<td>{{ data.VillageName }}</td>
          		<td>{{ data.DistrictName }}</td>
           		<td align="center">
                <a class="fa fa-edit" href="<?php echo base_url(); ?>event/UpdateEvent/{{ data.Id }} "></a>
                    &nbsp;&nbsp;&nbsp;
<!--                    <a class="fa fa-trash" ng-click="DeleteSchool(data.Id)" href="javaScript:void(0)"></a>                    -->
                </td>
          </tr>
                </tbody>
                
              </table>
            </div>
            <!-- /.card-body -->
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
  <script src="<?php echo base_url(); ?>assets/js/event.js" type="text/javascript"></script>

<script>

    function GetActivityType(ActivityType){

        // alert('dee');
        var selectedText = ActivityType.options[ActivityType.selectedIndex].innerHTML;
        var selectedValue = ActivityType.value;
        //alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue == 'Training'){
            window.location.href='<?php echo base_url();?>activity/ActivityList?ActivityType=Training';
        }
        if(selectedValue == 'Meeting'){
            window.location.href='<?php echo base_url();?>activity/ActivityList?ActivityType=Meeting';
        }
        if(selectedValue == 'Event'){
            //alert('deepak');
            /*var x = document.getElementById("EventForm");
            x.style.display = "block";

            var y = document.getElementById("TrainingForm");
            y.style.display = "none";

            var z = document.getElementById("MeetingForm");
            z.style.display = "none";*/
            window.location.href='<?php echo base_url();?>event/EventList';
        }


    }

</script>