<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Password</h1>
                </div>
                <div class="col-sm-6">
                    <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > ChangePassword</a> </span>
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

                <div class="card card-primary">
                    <div class="card-header">
<!--                        <h3 class="card-title">Update Password </h3>-->
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="">

                        <?php foreach($UserData as $data) { ?>
                            <div class="card-body">


                                <div class="form-group">
                                    <label for="exampleInputEmail1">User Name</label>
                                    <input class="form-control" id="UserName" name="UserName" value="<?php echo $data['UserName'];?>" placeholder="Enter User Name" type="text" readonly required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Old Password</label>
                                    <input class="form-control" id="OldPassword" name="OldPassword" placeholder="Enter Old Password" type="text" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">New Password</label>
                                    <input class="form-control" id="NewPassword" name="NewPassword"  placeholder="Enter New Password" type="text" required>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
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