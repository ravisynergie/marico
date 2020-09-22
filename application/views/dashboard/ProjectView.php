<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Project View</h1>
                </div>
                <div class="col-sm-6">
                    <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > ProjectView</span>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">

        <div class="row">
            <div class="col-12">
                <div class="btn-group" style="float: right">
                    <a href="#District" class="btn btn-primary btn-sm" title="District">District</a>
                    <a href="#Block" class="btn btn-primary btn-sm" title="Block">Block</a>
                    <a href="#Village" class="btn btn-primary btn-sm" title="Village">Village</a>
                    <a href="#Schools" class="btn btn-primary btn-sm" title="Schools">Schools</a>
                    <a href="#Students" class="btn btn-primary btn-sm" title="Students">Students</a>
                    <a href="#Training" class="btn btn-primary btn-sm" title="Trainers">Trainers</a>
                    <a href="<?php echo base_url(); ?>district/GalleryList" target="_blank" class="btn btn-primary btn-sm" title="Gallery">Gallery</a>

                </div>
            </div>
        </div>
		<div class="row">
            <div class="col-12">
            	&nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <div class="card" id="District">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <h2>District List</h2>
                            </div>
                            <div class="col-2 pull-right">
                                <a href="<?php echo base_url(); ?>district/AddNewDistrict?ProjectView=true"> <button type="button" class="btn btn-primary btn-block btn-flat no-border">Add new district</button></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="DistrictTableData" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="100">S. No.</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $key=0; foreach($DistrictData as $tmpData) { $key = $key+1;?>
                                <tr id="TR<?php echo $tmpData['Id'];?>">
                                    <td><?php echo $key;?></td>
                                    <td><?php echo $tmpData['Name'];?></td>

                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                        <a href="<?php echo base_url(); ?>district/DistrictList" class="btn btn-primary">View More</a>
                        
                    </div>
                    <!-- /.card-body -->
                </div>



                <div class="card" id="Block">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <h2>Block List</h2>
                            </div>
                            <div class="col-2 pull-right">
                                <a href="<?php echo base_url(); ?>block/AddNewBlock?ProjectView=true"> <button type="button" class="btn btn-primary btn-block btn-flat no-border">Add new block</button></a>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="BlockTableData" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="100">S. No.</th>
                                <th>Block Name</th>
                                <th>District Name</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $key=0; foreach($BlockData as $key=>$tmpData) { $key = $key+1;?>
                                <tr id="TR<?php echo $tmpData['Id'];?>">
                                    <td><?php echo $key;?></td>
                                    <td><?php echo $tmpData['Name'];?></td>
                                    <td><?php echo $tmpData['DistrictName'];?></td>

                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                        <a href="<?php echo base_url(); ?>block/BlockList" class="btn btn-primary">View More</a>
                    </div>

                    <!-- /.card-body -->
                </div>





                <div class="card" id="Village">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <h2>Village List</h2>
                            </div>
                            <div class="col-2 pull-right">
                                <a href="<?php echo base_url(); ?>village/AddNewVillage?ProjectView=true"> <button type="button" class="btn btn-primary btn-block btn-flat no-border">Add new village</button></a>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="VillageTableData" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>S. No.</th>
                                <th>Village Name</th>
                                <th>Gram Panchayat</th>
                                <th>Block Name</th>
                                <th>District Name</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $key=0; foreach($VillageData as $key=>$tmpData) {$key = $key+1; ?>
                                <tr id="TR<?php echo $tmpData['Id'];?>">
                                    <td><?php echo $key;?></td>
                                    <td><?php echo $tmpData['Name'];?></td>
                                    <td><?php echo $tmpData['GramPanchayat'];?></td>
                                    <td><?php echo $tmpData['BlockName'];?></td>
                                    <td><?php echo $tmpData['DistrictName'];?></td>

                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                        <a href="<?php echo base_url(); ?>village/VillageList" class="btn btn-primary">View More</a>
                    </div>
                    <!-- /.card-body -->
                </div>


                <div class="card" id="Schools">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <h2>School List</h2>
                            </div>
                            <div class="col-2 pull-right">
                                <a href="<?php echo base_url(); ?>school/AddNewSchool?ProjectView=true"> <button type="button" class="btn btn-primary btn-block btn-flat no-border">Add new school</button></a>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="SchoolTableData" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="100">S. No.</th>
                                <th>School Name</th>
                                <th>Model School</th>
                                <th>Village Name</th>

                                <th>Block Name</th>
                                <th>District Name</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $key=0; foreach($SchoolData as $tmpData) { $key = $key+1;?>
                                <tr id="TR<?php echo $tmpData['Id'];?>">
                                    <td><?php echo $key; ?></td>
                                    <td><?php echo $tmpData['Name'];?></td>
                                    <td><?php echo $tmpData['ModelSchool'];?></td>
                                    <td><?php echo $tmpData['VillageName'];?></td>

                                    <td><?php echo $tmpData['BlockName'];?></td>
                                    <td><?php echo $tmpData['DistrictName'];?></td>

                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                        <a href="<?php echo base_url(); ?>school/SchoolList" class="btn btn-primary">View More</a>
                    </div>
                    <!-- /.card-body -->
                </div>


                <div class="card" id="Students">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10">
                                <h2>Student List</h2>
                            </div>
                            <div class="col-2 pull-right">
                                <a href="<?php echo base_url(); ?>student/AddNewStudent?ProjectView=true"> <button type="button" class="btn btn-primary btn-block btn-flat no-border">Add new student</button></a>
                            </div>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="StudentTableData" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="25">S. No.</th>
                                <th>Student Name</th>
                                <th>School Name</th>
                                <th>Village Name</th>

                                <th>Block Name</th>
                                <th>District Name</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $key=0; foreach($StudentData as $tmpData) { $key = $key+1;?>
                                <tr id="TR<?php echo $tmpData['Id'];?>">
                                    <td><?php echo $key;?></td>
                                    <td><?php echo $tmpData['Name'];?></td>
                                    <td><?php echo $tmpData['SchoolName'];?></td>
                                    <td><?php echo $tmpData['VillageName'];?></td>

                                    <td><?php echo $tmpData['BlockName'];?></td>
                                    <td><?php echo $tmpData['DistrictName'];?></td>

                                </td>
                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                        <a href="<?php echo base_url(); ?>student/StudentList" class="btn btn-primary">View More</a>
                    </div>
                    <!-- /.card-body -->
                </div>


                <div class="card" id="Training">
                    <div class="card-header">
                        <h2>Trainer List</h2>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="UserMappedSchool" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="100">S. N0.</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Assigned School</th>


                            </tr>
                            </thead>
                            <tbody>
                            <?php $key=0; foreach($UserMappedData as $tmpData) { $key = $key+1;?>
                                <tr id="TR<?php echo $tmpData['Id'];?>">
                                    <td><?php echo $key;?></td>
                                    <td><?php echo $tmpData['Name'];?></td>
                                    <td><?php echo $tmpData['Phone'];?></td>
                                    <td><a class="linkClick" onclick="OpenMappingData(<?php echo $tmpData['Id'];?>)"><?php echo $tmpData['NoSchool'];?></a></td>

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
        $('#DistrictTableData').DataTable();
        document.getElementById("DistrictTableData_length").style.display = "none";
        document.getElementById("DistrictTableData_info").style.display = "none";
        document.getElementById("DistrictTableData_paginate").style.display = "none";
        $('#BlockTableData').DataTable();
        //var x = document.getElementById("BlockTableData_length");
        document.getElementById("BlockTableData_length").style.display = "none";
        document.getElementById("BlockTableData_info").style.display = "none";
        document.getElementById("BlockTableData_paginate").style.display = "none";

        $('#VillageTableData').DataTable();
        document.getElementById("VillageTableData_length").style.display = "none";
        document.getElementById("VillageTableData_info").style.display = "none";
        document.getElementById("VillageTableData_paginate").style.display = "none";
        $('#SchoolTableData').DataTable();
        document.getElementById("SchoolTableData_length").style.display = "none";
        document.getElementById("SchoolTableData_info").style.display = "none";
        document.getElementById("SchoolTableData_paginate").style.display = "none";
        $('#StudentTableData').DataTable();
        document.getElementById("StudentTableData_length").style.display = "none";
        document.getElementById("StudentTableData_info").style.display = "none";
        document.getElementById("StudentTableData_paginate").style.display = "none";
       // $('#UserMappedSchool').DataTable();

    });

    $('#DistrictTableData').dataTable( {
        "pageLength": 10,
        "searching": false,
    } );

    $('#BlockTableData').dataTable( {
        "pageLength": 10,
        "searching": false,
    } );
    $('#VillageTableData').dataTable( {
        "pageLength": 10,
        "searching": false,
    } );

    $('#SchoolTableData').dataTable( {
        "pageLength": 10,
        "searching": false,
    } );
    $('#StudentTableData').dataTable( {
        "pageLength": 10,
        "searching": false,
    } );


    function OpenMappingData(Id){
        var PageURL='/marico/mapping/MappedDataPopup';

        // alert(Id);
        jQuery('#MaricoModal #ModalLightBody').html('<div class="load-more">Loading...</div>');
        jQuery("#MaricoModal").modal('show');
        //jQuery('#ModalLightTitle').html(jsObj.PageTitle);
        jQuery.ajax({
            url : PageURL,
            type: "POST",
            data : {UserId:Id},
            success: function(response)
            {
                jQuery('#MaricoModal #ModalLightBody').html(response);

                jQuery('#MaricoModal .modal-dialog').css('width','80%');

            }
        });
    }
</script>

