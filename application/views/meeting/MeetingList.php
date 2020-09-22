<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

              <h1 class="ng-cloak">Meeting List - {{ MeetingData.length }}</h1>
          </div>
          <div class="col-sm-6">
              <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > MeetingList</span>
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
              	<a href="<?php echo base_url(); ?>meeting/AddNewMeeting"> <button type="button" class="btn btn-primary btn-block btn-flat no-border">Add new Meeting</button></a>
              </div>  
            </div>
            
            
            <!-- /.card-header -->
            <div class="card-body" data-ng-init="MeetingList()">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>School Name</th>
                  <th>MeetingDate</th>
                  <th>InTime</th>
                  <th>OutTime</th>
                  <th width="120">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr class="ng-cloak" ng-repeat="data in MeetingData" id="{{ data.Id }}">
          		<td>{{ data.SchoolName }}</td>
          		<td>{{ data.MeetingDate }}</td>
          		<td>{{ data.InTime }}</td>
          		<td>{{ data.OutTime }}</td>

           		<td align="center">
                <a class="fa fa-edit" href="<?php echo base_url(); ?>meeting/UpdateMeeting/{{ data.Id }} "></a>

<!--                    &nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-trash" ng-click="DeleteTraining(data.Id)" href="javaScript:void(0)"></a>-->
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
  <script src="<?php echo base_url(); ?>assets/js/meeting.js" type="text/javascript"></script>