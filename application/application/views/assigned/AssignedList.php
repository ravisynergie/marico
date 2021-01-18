<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?php
       // echo '<pre>';
        //print_r($UserMappedData);
        //echo '</pre>';

          //echo '<pre>';
          //print_r($SchoolData);
          //echo '</pre>';
      ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assigned School List</h1>
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
<!--              	<a href="--><?php //echo base_url(); ?><!--village/AddNewVillage"> <button type="button" class="btn btn-primary btn-block btn-flat no-border">Add new village</button></a>-->
              </div>  
            </div>
            
            
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>School</th>
                  <th>Village Name</th>
                  <th>Gram Panchayat</th>
                  <th>Block Name</th>
                  <th>District</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($SchoolData as $key=>$tmpData) {

                    foreach($UserMappedData as $mapTmp) {

                        if ($tmpData['Id'] == $mapTmp['SchoolId']) {

//                echo '<pre>';
//                print_r($tmpData['Id']);
//                echo '</pre>';

//                echo '<pre>';
//                print_r('Mapped-'.$mapTmp['SchoolId']);
//                echo '</pre>';

                            ?>


                            <tr>

                                <td><?php echo ucfirst($tmpData['Name']);?></td>
                                <td><?php echo ucfirst($tmpData['VillageName']);?></td>
                                <td><?php echo ucfirst($tmpData['GramPanchayat']);?></td>
                                <td><?php echo ucfirst($tmpData['BlockName']);?></td>
                                <td><?php echo ucfirst($tmpData['DistrictName']);?></td>

                            </tr>


                        <?php }}} ?>
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


<script src="<?php echo base_url(); ?>assets/js/assigned.js" type="text/javascript"></script>

