<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="ng-cloak">School List - {{ SchoolData.length }}</h1>
          </div>
          <div class="col-sm-6">
              <?php if($UserGroupId == '2'){?>
                  <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>dashboard/ProjectView">ProjectView</a> > SchoolList</span>
              <?php } else {?>
                  <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > SchoolList</span>
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
                            <?php
                            //if($SessionData['UserGroupId'] == '3' || $SessionData['UserGroupId'] == '2'){
                            if($SessionData['UserGroupId'] == '3'){
                                ?>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Traineer</label>
                                        <select class="form-control" id="UserName" name="UserName">
                                            <option value="">Select Traineer</option>
                                            <?php foreach($TrainerData as $data) { ?>
                                                <option <?php if($_GET['UserName']==$data['Id']) { echo "selected"; } ?> value="<?php echo $data['Id'];?>"><?php echo $data['UserName'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
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

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Village</label>
                                    <select class="form-control" id="VillageId" name="VillageId">
                                        <option value="">Select Village</option>
                                        <?php foreach($VillageData as $vildata) {
                                            if(empty($vildata['Name'])){}
                                            else{
                                                ?>
                                                <option <?php if($_GET['VillageId']==$vildata['Id']) { echo "selected"; } ?> value="<?php echo $vildata['Id'];?>"><?php echo ucfirst($vildata['Name']);?></option>
                                            <?php } } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">School Name</label>
                                    <input class="form-control" value="<?php echo $_GET['SchoolName'];?>" id="SchoolName" name="SchoolName" placeholder="Enter School name" type="text">
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
              	<a href="<?php echo base_url(); ?>school/AddNewSchool"> <button type="button" class="btn btn-primary btn-block btn-flat no-border">Add new school</button></a>
              </div>  
            </div>
            
            
            <!-- /.card-header -->
            <div class="card-body" data-ng-init="SchoolList()">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>SPOC</th>
                  <th>Designation</th>
                  <th>Contact Number</th>
                  <th>Village</th>
                  <th>Gram Panchayat</th>
                  <th>Block</th>
                  <th>District</th>
                  <th width="120">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr class="ng-cloak" ng-repeat="data in SchoolData" id="{{ data.Id }}">

          		<td>{{ data.Name }}</td>
          		<td>{{ data.SpocName }}</td>
          		<td>{{ data.SpocDesignation }}</td>
          		<td>{{ data.PrincipalContactNo }}</td>
          		<td>{{ data.VillageName }}</td>
          		<td>{{ data.GramPanchayat }}</td>
          		<td>{{ data.BlockName }}</td>
          		<td>{{ data.DistrictName }}</td>
           		<td align="center">
                <a class="fa fa-edit" href="<?php echo base_url(); ?>school/UpdateSchool/{{ data.Id }} "></a>
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
  <script src="<?php echo base_url(); ?>assets/js/school.js" type="text/javascript"></script>