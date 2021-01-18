<!-- Content Wrapper. Contains page content -->


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Block Data</h1>
                </div>
                <div class="col-sm-6">
                    <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>dashboard/ProjectView">ProjectView</a> BlockData</span>
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


                <div class="card" id="Block">
                    <div class="card-header">
                        <h2></h2>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="BlockTableData" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Block Name</th>
                                <th>District Name</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($BlockData as $tmpData) { ?>
                                <tr id="TR<?php echo $tmpData['Id'];?>">
                                    <td><?php echo $tmpData['Name'];?></td>
                                    <td><?php echo $tmpData['DistrictName'];?></td>

                                </tr>
                            <?php } ?>
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


</div>
<!-- /.content-wrapper -->

<script src="<?php echo base_url(); ?>assets/js/projectview.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {

        $('#BlockTableData').DataTable();

    });


</script>

