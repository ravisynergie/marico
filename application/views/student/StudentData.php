<script src='<?php echo base_url(); ?>assets/js/dirPagination.js'></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="ng-cloak">Student List - </h1>
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

                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped" border="1">
                            <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>District</th>
                                <th>Name of the Trainer	</th>
                                <th>Name of School</th>
                                <th>Name of Student</th>
                                <th>Date of the training session attended</th>
                                <th>Training session attended Yes/No</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i=1;
                            foreach ($StudentData as $data){

                            ?>
                                <tr >
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo  $data['DistrictName']; ?></td>
                                    <td><?php echo  $data['TrainerName']; ?></td>
                                    <td><?php echo $data['SchoolName']; ?></td>
                                    <td><?php echo $data['Name']; ?></td>
                                    <td><?php echo $data['TrainingDate']; ?></td>
                                    <td>&nbsp;</td>

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
</div>
<!-- /.content-wrapper -->
<script>


</script>
