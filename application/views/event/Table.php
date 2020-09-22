<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Event Table</h1>
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

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="MaricoTableData" class="table table-bordered">
                            <thead>
                            <tr>
                                <th rowspan="2">Trainer</th>
                                <th rowspan="2">District</th>
                                <th colspan="2">Schools</th>
                                <th colspan="2">Students</th>
                                <th colspan="2">Average number of touchpoints (T+S series)</th>
                                <th colspan="2">Average number of IVR modules completed per student</th>
                                <th colspan="4">Number of students completed IVR Modules</th>
                                <th colspan="3">Students achieved Listening Objectives</th>
                                <th colspan="3">Students achieved Spoken Production </th>
                                <th colspan="3">Students achieved Spoken Intercation-A1 </th>

                            </tr>
                            <tr>
                                <th>Total</th>
                                <th>Model Schools</th>
                                <th>Total</th>
                                <th>Model Schools</th>
                                <th>Model School</th>
                                <th>Other School</th>
                                <th>Model School</th>
                                <th>Other School</th>
                                <th><30</th>
                                <th>31-100</th>
                                <th>100-150</th>
                                <th>150-200</th>
                                <th>Number</th>
                                <th>% of total</th>
                                <th>% number from Model Schools </th>
                                <th>Number</th>
                                <th>% of total</th>
                                <th>% number from Model Schools </th>
                                <th>Number</th>
                                <th>% of total</th>
                                <th>% number from Model Schools </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tboby>

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