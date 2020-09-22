<!-- Content Wrapper. Contains page content -->


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Testimonial List</h1>
          </div>
          <div class="col-sm-6">
              <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > TestimonialList</span>
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
                      <a href="" data-toggle="modal" data-target="#addTestimonialModal" class="btn btn-primary btn-block btn-flat no-border"> <i class="zmdi zmdi-plus"></i><span>Upload Testimonial</span></a>
                  </div>
              </div>
              <div class="card-body">
                  <form method="post" action="" enctype="multipart/form-data">
                      <div class="col-sm-12">
                          <div class="row">
                      <div class="col-sm-3">
                          <div class="form-group">

                              <select class="form-control" id="TypeFIlter" name="TypeFIlter" required>
                                  <option value="">Select Type</option>
                                  <option value="All" <?php if($_POST['TypeFIlter'] == 'All'){ echo 'selected';}?> >All</option>
                                  <option value="Image" <?php if($_POST['TypeFIlter'] == 'Image'){ echo 'selected';}?> >Image</option>
                                  <option value="Audio" <?php if($_POST['TypeFIlter'] == 'Audio'){ echo 'selected';}?>>Audio</option>
                                  <option value="Video" <?php if($_POST['TypeFIlter'] == 'Video'){ echo 'selected';}?>>Video</option>
                              </select>
                          </div>

                      </div>
                      <div class="col-sm-3">

                              <button type="submit" class="btn btn-primary">Submit</button>
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
                  <th>Title</th>
                  <th>Type</th>
                  <th>File</th>
                  <th>Thumb</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($TestimonialData as $tmpData) { ?>
                <tr id="TR<?php echo $tmpData['Id'];?>">
                  <td><?php echo $tmpData['Title'];?></td>
                  <td><?php echo $tmpData['Type'];?></td>
                    <?php if($tmpData['Type'] == 'Image'){?>
                        <td><img src="<?php echo  base_url().$tmpData['FileUpload'] ?>" width="200px;"/></td>
                    <?php } ?>
                    <?php if($tmpData['Type'] == 'Audio'){?>
                        <td><audio controls>
                                <source src="<?php echo  base_url().$tmpData['FileUpload'] ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio></td>
                    <?php } ?>
                    <?php if($tmpData['Type'] == 'Video'){?>
                        <td><video width="320" height="240" controls>
                                <source src="<?php echo  base_url().$tmpData['FileUpload'] ?>" type="video/mp4">
                            </video></td>
                    <?php } ?>
                  <td><img src="<?php echo  base_url().$tmpData['ThumbImage'] ?>"/></td>
                    <td><?php echo $tmpData['Description'];?></td>
                  <td>
                      <a href="javaScript:DeleteImage('<?php echo $tmpData['Id'];?>')" > <i class="fa fa-trash" style="color:red;"></i></a>
                      <a href="<?php echo  base_url().$tmpData['FileUpload'] ?>" > <i class="fa fa-download" style="color:#49BD52;"></i></a>
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

      <div id="addTestimonialModal" class="modal fade" role="dialog">
          <div class="modal-dialog" style="width:40%">
              <form method="post" action="" enctype="multipart/form-data">
              <!-- Modal content-->
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title" id="ModalLightTitle">Testimonial</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>

                      </div>
                      <div class="modal-body" id="ModalLightBody">

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Title</label>
                                  <input class="form-control" id="Title" name="Title" placeholder="Enter Title" type="text" required>
                              </div>
                          </div>

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Type</label>
                                  <select class="form-control" id="Type" name="Type" onchange="GetSelectedTextValue(this)" required>
                                      <option value="">Select Type</option>
                                      <option value="Image">Image</option>
                                      <option value="Audio">Audio</option>
                                      <option value="Video">Video</option>
                                  </select>
                              </div>
                          </div>



                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Upload a File </label>
                                  <input required class="form-control" type="file" name="fileToUpload" style="border:0px;"/>
                              </div>
                          </div>

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Upload a Thumb Image</label>
                                  <input required class="form-control" type="file" name="thumbToUpload" style="border:0px;"/>
                              </div>
                          </div>

                          <div class="col-sm-12">
                              <div class="form-group">
                                  <label>Description </label>
                                  <textarea rows="4" id="Description" name='Description' class="form-control"></textarea>
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

  <script src="<?php echo base_url(); ?>assets/js/testimonial.js" type="text/javascript"></script>

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
            var URL = "<?php echo base_url(); ?>testimonial/ImageDelete"+"?id="+Math.random();
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