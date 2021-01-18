<!-- Content Wrapper. Contains page content -->
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
<!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">-->
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h1 class="txt-dark font-22 line_height42">Registration</h1>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ul class="breadcrumb">
                    <li><a href="https://synergieinsights.com/vendors/">Dashboard</a></li>
                    <li><a href="https://synergieinsights.com/vendors/projects/project-detail/11"><span>Activities</span></a></li>
                    <li><a href="https://synergieinsights.com/csr/registration/RegistrationList/23"><span>Registration Data</span></a></li>
                    <li><span>New Registration</span></li>
                </ul>
            </div>
        </div>
        <div class="row" data-ng-init="">
            <div class="col-sm-12">
                <div class="panel panel-default card-view project-listing">
                    <div class="panel-wrapper collapse in pt-10 pb-5">
                        <div class="panel-body">
                            <div class="table-wrap">
                                <div class="col-sm-12">
                                    <div class="table-wrap">

                                        <?php if($this->session->flashdata('RegistrationError')) { ?>
                                            <div class="alert alert-danger">
                                                <strong>ERROR!</strong> <?php echo $this->session->flashdata('RegistrationError');?>
                                            </div>
                                        <?php } ?>

                                        <form method="post" action="" id="htmld5Form">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group required-inputs">
                                                        <label class="control-label mb-10 font-14"><strong>Select Schools</strong></label>
                                                        <div class="input select">
                                                            <select name="project_site_id" class="form-control select2" required="required" id="project-site-id">
                                                                <?php
                                                                foreach ($ProjectSiteData as $ProjectSite)
                                                                {
                                                                    ?>
                                                                    <option value='<?php echo $ProjectSite['id'] ?>' <?php if($_GET['ProjectSiteId']==$ProjectSite['id']) { echo "selected"; } ?>><?php echo $ProjectSite['location_descriptor'];?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Training Date</label>
                                                        <input type="text" class="form-control" placeholder="Training Date" name="TrainingDate" id="datepicker" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive group-1 userFeedbackForm" style="padding: 5px;">
                                                <table class="table table-bordered mb-0" id="registration-data-table">
                                                    <thead>
                                                    <tr>
                                                        <th>Student Name</th>
                                                        <th width="80">Grade</th>
                                                        <th width="80">Age</th>
                                                        <th width="80">Gender</th>
                                                        <th>Guardian Name</th>
                                                        <th width="100">Guardian Gender</th>
                                                        <th>Mobile</th>
                                                        <th>Landline Number</th>
                                                        <th>License No(DL)</th>
                                                        <th>Vehicle No </th>

                                                    </tr>
                                                    </thead>
                                                    <tbody class="regexcel">
                                                    <?php
                                                    $i=0;
                                                    while($i!=10)
                                                    {
                                                        ?>
                                                        <tr>

                                                            <td><input onBlur="MakeRequiredField('<?php echo $i;?>',this.value)" type="text" name="StudentName[]" placeholder="Student Name" class="input-text-<?php echo $i;?>"/></td>

                                                            <td><input type="text" name="StudentGrade[]" placeholder="Grade" style="text-align:center" class="input-text-<?php echo $i;?>"/></td>

                                                            <td>
                                                                <select name="StudentAge[]" class="input-text-<?php echo $i;?>">
                                                                    <option value="9-14">9-14 Y</option>
                                                                </select>
                                                            </td>

                                                            <td>
                                                                <select name="StudentGender[]" class="input-text-<?php echo $i;?>">
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </td>

                                                            <td><input type="text" name="GurdianName[]" placeholder="Guardian Name" class="input-text-<?php echo $i;?>"/></td>

                                                            <td>
                                                                <select name="GurdianGender[]" class="input-text-<?php echo $i;?>">
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </td>

                                                            <td><input type="text" name="Mobile[]" maxlength="10" minlength="10" placeholder="Mobile" class="input-text-<?php echo $i;?>"/></td>
                                                            <td><input type="text" name="ContactNumber[]" placeholder="Land Line Number"/></td>

                                                            <td><input type="text" name="LicenseNo[]" placeholder="License No(DL)" class="input-text-<?php echo $i;?>"/></td>

                                                            <!--              <td><input type="text" name="VehicleNo[]" placeholder="Vehicle No" class="input-text---><?php //echo $i;?><!--"/></td>-->
                                                            <td><input type="text" name="VehicleNo[]" placeholder="Vehicle No" /></td>


                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>

                                            </div>

                                            <div class="text-right mt-15"><button class="btn btn-primary btn-sm btn-process" type="submit">Save </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>






    </div>


</div><!-- /.content-wrapper -->

<script src="<?php echo base_url(); ?>assets/js/NewRegistration.js" type="text/javascript"></script>
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>-->
<script>

    // $( function() {
    //     $( "#datepicker" ).datepicker();
    // } );
</script>


