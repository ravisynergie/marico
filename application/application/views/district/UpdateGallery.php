<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php
//    echo '<pre>';
//        print_r($GalleryData);
//    echo '</pre>';
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Data</h1>
                </div>
                <div class="col-sm-6">
                    <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>village/VillageList">VillageList</a> > UpdateVillage</span>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Village </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="">

                        <?php foreach($GalleryData as $data) { ?>
                            <div class="card-body">



                                <div class="form-group">
                                    <label for="exampleInputEmail1">Type</label>
                                    <select class="form-control" id="Type" name="Type" onchange="GetSelectedTextValue(this)" required>
                                        <option value="">Select Type</option>
                                        <option value="School" <?php if($data['Type'] == 'School') { ?> selected <?php } ?>>School</option>
                                        <option value="Village" <?php if($data['Type'] == 'Village') { ?> selected <?php } ?>>Village</option>
                                    </select>
                                </div>

                                <div class="col-sm-12" id="VillageId" <?php if($data['Type'] == 'Village'){ echo 'style="display: block"'; } else { echo 'style="display: none"';}?>>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Village</label>
                                        <select class="form-control" id="ParentId" name="VillageId" required>
                                            <option value="0">Select Village</option>
                                            <?php foreach($VillageData as $vildata) {
                                                if(empty($vildata['Name'])){}
                                                else{
                                                    ?>
                                                    <option value="<?php echo $vildata['Id'];?>" <?php if($vildata['Id']==$data['ParentId']) { ?> selected <?php } ?>><?php echo ucfirst($vildata['Name']);?></option>
                                                <?php } } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12" id="SchoolId" <?php if($data['Type'] == 'School'){ echo 'style="display: block"'; } else { echo 'style="display: none"';}?>>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">School</label>
                                        <select class="form-control" id="ParentId" name="SchoolId" required>
                                            <option value="0">Select School</option>
                                            <?php foreach($SchoolData as $schdata) {
                                                if(empty($schdata['Name'])){}
                                                else {
                                                    ?>
                                                    <option value="<?php echo $schdata['Id'];?>" <?php if($schdata['Id']==$data['ParentId']) { ?> selected <?php } ?>><?php echo ucfirst($schdata['Name']);?></option>
                                                <?php } } ?>
                                        </select>
                                    </div>
                                </div>

                                    <div class="form-group">
                                        <label>Caption </label>
                                        <textarea rows="4" id="imageCaption" name='imageCaption' class="form-control"><?php echo $data['Caption']; ?></textarea>
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
<script src="<?php echo base_url(); ?>assets/js/village.js" type="text/javascript"></script>

<script>
    $( document ).ready(function() {
        console.log( "ready!" );

    });

    function GetSelectedTextValue(selectedvalue) {
        var selectedText = selectedvalue.options[selectedvalue.selectedIndex].innerHTML;
        var selectedValue = selectedvalue.value;
        //alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue == 'Village'){
            var x = document.getElementById("VillageId");
            x.style.display = "block";

            var y = document.getElementById("SchoolId");
            y.style.display = "none";
        }
        if(selectedValue == 'School'){
            var x = document.getElementById("SchoolId");
            x.style.display = "block";

            var y = document.getElementById("VillageId");
            y.style.display = "none";
        }
        if(selectedValue == ''){
            var x = document.getElementById("SchoolId");
            x.style.display = "none";

            var y = document.getElementById("VillageId");
            y.style.display = "none";
        }


    }


</script>