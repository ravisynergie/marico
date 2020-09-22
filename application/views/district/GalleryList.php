<!-- Content Wrapper. Contains page content -->


  <div class="content-wrapper">
<?php //print_r($UserGroupId);?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gallery List</h1>
          </div>
          <div class="col-sm-6">
              <?php if($UserGroupId == '2'){?>
                  <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>dashboard/ProjectView">ProjectView</a> > GalleryList</span>
              <?php } else {?>
                  <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > GalleryList</span>
              <?php } ?>

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
                  <form method="post" action="" enctype="multipart/form-data">
                      <div class="col-2 pull-right">
                          <input class="form-control" id="" name="DowmloadImage" value="1" type="hidden">
                          <button type="submit" class="btn btn-primary">Download All Images</button>
                      </div>
                  </form>
                  <div class="col-2 pull-right">
                      <a href="" data-toggle="modal" data-target="#addGalleryModal" class="btn btn-primary btn-block btn-flat no-border"> <i class="zmdi zmdi-plus"></i><span>Upload Gallery</span></a>
                  </div>
              </div>
              <div class="card-body">
                  <form method="post" action="" enctype="multipart/form-data">
                      <div class="col-sm-12">
                          <div class="row">
                              <?php
                              //if($SessionData['UserGroupId'] == '3' || $SessionData['UserGroupId'] == '2'){
                              if($SessionData['UserGroupId'] == '3' || $SessionData['UserGroupId'] == '4'){
                                  ?>
                                  <div class="col-2">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Traineer</label>
                                          <select class="form-control" id="UserName" name="UserName">
                                              <option value="">Select Traineer</option>
                                              <?php foreach($TrainerData as $data) { ?>
                                                  <option <?php if($_POST['UserName']==$data['Id']) { echo "selected"; } ?> value="<?php echo $data['Id'];?>"><?php echo $data['UserName'];?></option>
                                              <?php } ?>
                                          </select>
                                      </div>
                                  </div>
                              <?php } ?>
                      <div class="col-sm-3">
                          <div class="form-group">
                              <label for="exampleInputEmail1">Type</label>
                              <select class="form-control" id="TypeFIlter" name="TypeFIlter" >
                                  <option value="">Select Type</option>
                                  <option value="All" <?php if($_POST['TypeFIlter'] == 'All'){ echo 'selected';}?> >All</option>
                                  <option value="School" <?php if($_POST['TypeFIlter'] == 'School'){ echo 'selected';}?> >School</option>
                                  <option value="Village" <?php if($_POST['TypeFIlter'] == 'Village'){ echo 'selected';}?>>Village</option>
                              </select>
                          </div>

                      </div>

                              <div class="col-1">
                                  <label for="exampleInputEmail1">&nbsp;</label>
                                  <button type="submit" class="btn btn-primary btn-block btn-flat no-border">Search</button>
                              </div>
                      </div>
                      </div>
                  </form>

              </div>
            <!-- /.card-header -->
            <div class="card-body" data-ng-init="DistrictList()">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Type</th>
                  <th>Name</th>
                  <th>Caption</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($GalleryData as $tmpData) { ?>
                <tr id="TR<?php echo $tmpData['Id'];?>">
                  <td><?php echo $tmpData['Type'];?></td>
                  <td><?php echo $tmpData['LocationName'];?></td>
                  <td><?php echo $tmpData['Caption'];?></td>
                  <td><img src="<?php echo  base_url().$tmpData['ImagePath'] ?>" width="200px;"/></td>
                  <td>
                      <?php if($UserGroupId != '2'){?>
                      <a href="javaScript:DeleteImage('<?php echo $tmpData['Id'];?>')" > <i class="fa fa-trash" style="color:red;"></i></a>
                      <?php } ?>
                      <a href="<?php echo  base_url().$tmpData['ImagePath'] ?>" > <i class="fa fa-download" style="color:#49BD52;"></i></a>
                      <a class="fa fa-edit" href="<?php echo base_url(); ?>district/UpdateGallery/<?php echo $tmpData['Id'];?>"></a>
                  </td>
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

      <div id="addGalleryModal" class="modal fade" role="dialog">
          <div class="modal-dialog" style="width:40%">
              <form method="post" action="" enctype="multipart/form-data">
              <!-- Modal content-->
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title" id="ModalLightTitle">Modal Header</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>

                      </div>
                      <div class="modal-body" id="ModalLightBody">
                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Type</label>
                                  <select class="form-control" id="Type" name="Type" onchange="GetSelectedTextValue(this)" required>
                                      <option value="">Select Type</option>
                                      <option value="School">School</option>
                                      <option value="Village">Village</option>
                                  </select>
                              </div>
                          </div>

                          <div class="col-sm-12" id="VillageId" style="display: none">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Village</label>
                                  <select class="form-control" id="ParentId" name="VillageId" required>
                                      <option value="0">Select Village</option>
                                      <?php foreach($VillageData as $vildata) {
                                          if(empty($vildata['Name'])){}
                                          else{
                                              ?>
                                              <option value="<?php echo $vildata['Id'];?>"><?php echo ucfirst($vildata['Name']);?></option>
                                          <?php } } ?>
                                  </select>
                              </div>
                          </div>

                          <div class="col-sm-12" id="SchoolId" style="display: none">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">School</label>
                                  <select class="form-control" id="ParentId" name="SchoolId" required>
                                      <option value="0">Select School</option>
                                      <?php foreach($SchoolData as $schdata) {
                                          if(empty($schdata['Name'])){}
                                          else {
                                              ?>
                                              <option value="<?php echo $schdata['Id'];?>"><?php echo ucfirst($schdata['Name']);?></option>
                                          <?php } } ?>
                                  </select>
                              </div>
                          </div>

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Caption </label>
                                  <textarea rows="4" id="imageCaption" name='imageCaption' class="form-control"></textarea>
                              </div>
                          </div>

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Upload a File </label>
                                  <input required class="form-control" type="file" name="fileToUpload" style="border:0px;"/>
                              </div>
                          </div>

                      </div>

                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>

  </div>
  <!-- /.content-wrapper -->

  <script src="<?php echo base_url(); ?>assets/js/district.js" type="text/javascript"></script>

<script type="text/javascript">
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


    function GetSelectedFilter(selectedvalue){
        var selectedText = selectedvalue.options[selectedvalue.selectedIndex].innerHTML;
        var selectedValue = selectedvalue.value;
        //alert("Value: " + selectedValue);

        var URL = "<?php echo base_url(); ?>district/GalleryList"+"?id="+Math.random();
        jQuery.ajax({
            url : URL,
            type: "POST",
            data : {TypeFIlter:selectedValue},
            success: function(data)
            {
               alert(data);
               // jQuery('#TR'+id).remove();
            }
        });

    }
</script>

<script>

    function DeleteImage(id)
    {
        if(confirm('Do you want to delete?'))
        {
            //var URL = $("#MemberList").attr("deleteUrl")+"?id="+Math.random();
            var URL = "<?php echo base_url(); ?>gallery/ImageDelete"+"?id="+Math.random();
            jQuery.ajax({
                url : URL,
                type: "POST",
                data : {id:id},
                success: function(data)
                {
                    //alert('deepak');
                    jQuery('#TR'+id).remove();
                }
            });
        }

    }
</script>