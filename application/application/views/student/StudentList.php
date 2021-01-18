<script src='<?php echo base_url(); ?>assets/js/dirPagination.js'></script>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <?php

//      echo "<pre>";
//      print_r($StudentData);
//      echo "</pre>";
//
//      echo "<pre>";
//      print_r($IVRData);
//      echo "</pre>";

      ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="ng-cloak">Student List - {{ StudentData.length }}</h1>
          </div>
          <div class="col-sm-6">
              <?php if($UserGroupId == '2'){?>
                  <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>dashboard/ProjectView">ProjectView</a> > StudentList</span>
              <?php } else {?>
                  <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > StudentList</span>
              <?php } ?>

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
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">District Name</label>
                                    <select class="form-control" id="DistrictId" name="DistrictId">
                                        <option value="">Select District</option>
                                        <?php foreach($DistrictData as $data) { ?>
                                            <option <?php if($_GET['DistrictId']==$data['Id']) { echo "selected"; } ?> value="<?php echo $data['Id'];?>"><?php echo $data['Name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Block</label>
                                    <select class="form-control" id="BlockId" name="BlockId">
                                        <option value="">Select Block</option>
                                        <?php foreach($BlockData as $blcdata) { ?>
                                            <option <?php if($_GET['BlockId']==$blcdata['Id']) { echo "selected"; } ?> value="<?php echo $blcdata['Id'];?>"><?php echo $blcdata['Name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">School</label>
                                    <select class="form-control" id="SchoolId" name="SchoolId">
                                        <option value="">Select School</option>
                                        <?php foreach($SchoolData as $schdata) {
                                            if(empty($schdata['Name'])){}
                                            else {
                                                ?>
                                                <option <?php if($_GET['SchoolId']==$schdata['Id']) { echo "selected"; } ?> value="<?php echo $schdata['Id'];?>"><?php echo ucfirst($schdata['Name']);?></option>
                                            <?php } } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Student Name</label>
                                    <input class="form-control" id="StudentName" value="<?php echo $_GET['StudentName'];?>" name="StudentName" placeholder="Enter Student name" type="text">
                                </div>
                            </div>
                            <div class="col-1">
                                <label for="exampleInputEmail1">&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block btn-flat no-border">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        
          <div class="card">
            <div class="card-header">
              <div class="col-2 pull-right">
              	<a href="<?php echo base_url(); ?>student/AddNewStudent"> <button type="button" class="btn btn-primary btn-block btn-flat no-border">Add new student</button></a>
              </div>  
            </div>
            
            
            <!-- /.card-header -->
            <div class="card-body" data-ng-init="StudentList()">
            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Age</th>
                  <th>Class</th>
                  <th>Guardian Name</th>
                  <th>School</th>
                  <th>Village</th>
                  <th>Gram Panchayat</th>
                  <th>Block</th>
                  <th>District</th>
                  <th>No. of IVR Modules Completed</th>
                  <th>Learning Status</th>
                  <th width="120">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr class="ng-cloak" dir-paginate="data in StudentData | itemsPerPage:25" id="{{ data.Id }}" bodypro-repeat-directive>	
          		<td>{{ data.Name }}</td>
          		<td>{{ data.Gender }}</td>
          		<td>{{ data.Age }}</td>
          		<td>{{ data.Class }}</td>
          		<td>{{ data.GuardianName }}</td>
          		<td>{{ data.SchoolName }}</td>
          		<td>{{ data.VillageName }}</td>
          		<td>{{ data.GramPanchayat }}</td>
          		<td>{{ data.BlockName }}</td>
          		<td>{{ data.DistrictName }}</td>
          		<td>{{ data.IVR }}</td>
          		<td></td>
           		<td align="center">
                <a class="fa fa-edit" href="<?php echo base_url(); ?>student/UpdateStudent/{{ data.Id }} "></a>
                    &nbsp;&nbsp;&nbsp;
<!--                    <a class="fa fa-trash" ng-click="DeleteStudent(data.Id)" href="javaScript:void(0)"></a>                    -->
                </td>
          </tr>
          
          
                </tbody>
                
              </table>
              
              
              <div class="col-xs-12 pull-right text-right">
                <div class="form-group tex-right">
                  <dir-pagination-controls max-size="5" direction-links="true" boundary-links="true" ></dir-pagination-controls>
                </div>
            </div>
            
            <style>
			.pagination {
    border-radius: 4px;
    display: inline-block;
    margin: 20px 0;
    padding-left: 0;
}
ol, ul {
    margin-bottom: 10px;
    margin-top: 0;
}

.pagination > li {
    display: inline;
}

.pagination > li:first-child > a, .pagination > li:first-child > span {
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    margin-left: 0;
}

.pagination > li > a, .pagination > li > span {
    background-color: #fff;
    border: 1px solid #ddd;
    color: #337ab7;
    float: left;
    line-height: 1.42857;
    margin-left: -1px;
    padding: 6px 12px;
    position: relative;
    text-decoration: none;
}
</style>
            
            
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
  <script src="<?php echo base_url(); ?>assets/js/student.js" type="text/javascript"></script>
  