<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Mapping List</h1>
          </div>
          <div class="col-sm-6">
              <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > MappingList</span>
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
            <div class="card-body" data-ng-init="MappingList()">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S. No.</th>
                  <th>Name</th>
                  <th>Phone No.</th>
                  <th>No. of School</th>
                  <th width="120">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr class="ng-cloak" ng-repeat="data in MappingData" id="{{ data.Id }}">
          		<td>{{ data.Sr }}</td>
                <td>{{ data.Name }}</td>
                <td>{{ data.Phone }}</td>
                <td><a class="linkClick" href="javaScript:void(0)" ng-click="OpenMappingData(data.Id)">{{ data.NoSchool }}</a></td>

           		<td align="center">
                <a class="fa fa-edit" href="<?php echo base_url(); ?>mapping/UserSchoolMapping/{{ data.Id }} ">Manage</a>
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
                <h4 class="modal-title modalheaderfont" id="ModalLightTitle">Assigned Schools</h4>
            </div>
            <div class="modal-body" id="ModalLightBody">Loading...</div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/mapping.js" type="text/javascript"></script>

<script>
   function DeleteMappingSchool(UserId,SchoolId) {
       if(confirm('Do you want to delete?'))
       {
           var URL = jQuery('#WebAppURL').val()+'mapping/DeleteMappingSchool'+"?id="+Math.random();
           jQuery.ajax({
               url : URL,
               type: "POST",
               data : {UserId:UserId,SchoolId:SchoolId},
               success: function(data)
               {
                   // alert(Id);
                   jQuery('#school_'+SchoolId).remove();
               }
           });
       }
   }
</script>
