<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?php
      echo '<pre>';
      print_r();
      echo '</pre>';
      ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="ng-cloak">Assessment List - {{ AssessmentData.length }}</h1>
          </div>
          <div class="col-sm-6">

                  <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > AssessmentList</span>


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
              	<a href="<?php echo base_url(); ?>assessment/AddNewAssessment"> <button type="button" class="btn btn-primary btn-block btn-flat no-border">Add new assessment</button></a>
              </div>  
            </div>
            
            
            
            <!-- /.card-header -->
            <div class="card-body" data-ng-init="AssessmentList()">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="100">S. No.</th>
                  <th>Name</th>
                  <th>Question Count</th>

                  <th width="120">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr class="ng-cloak" ng-repeat="data in AssessmentData" id="{{ data.Id }}">
          		<td>{{ data.Sno }}</td>
                <td>{{ data.Name }}</td>
                    <td><a class="linkClick" href="javaScript:void(0)" ng-click="OpenQuestionData(data.Id)">{{ data.QuestionCount }}</a></td>
           		<td align="center">
                <a class="fa fa-edit" href="<?php echo base_url(); ?>assessment/UpdateAssessment/{{ data.Id }} "></a>
                    &nbsp;&nbsp;&nbsp;
<!--                    <a class="fa fa-trash" ng-click="DeleteVillage(data.Id)" href="javaScript:void(0)"></a>                    -->
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
<div id="MaricoModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%">

        <!-- Modal content-->
        <div class="modal-content modalcontentborder">
            <div class="modal-header modalheader">
                <button type="button" class="close modalclosebutton" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modalheaderfont" id="ModalLightTitle">Question</h4>
            </div>
            <div class="modal-body" id="ModalLightBody">Loading...</div>
        </div>
    </div>
</div>
  <script src="<?php echo base_url(); ?>assets/js/Assessment.js" type="text/javascript"></script>