<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<?php
//echo '<pre>';
//print_r($QuestionData);
//echo '</pre>';
$Questions = json_decode($QuestionData[0]['Question']);

?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php $QuestionData['Name']; ?></h1>
                </div>
                <div class="col-sm-6">
                    <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > <a class="linkblack" href="<?php echo base_url(); ?>assessment/AssessmentList">AssessmentList</a> > AssessmentQuestion</span>

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
                        <h3 class="card-title">Assessment Question</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="">

                        <div class="card-body">
                        <?php
                        foreach($Questions as $qus){
                        ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $qus; ?></label>
                                <input class="form-control" id="Answer" name="Answer[]" placeholder="Answer" type="text" required>
                            </div>

                            <?php } ?>



                        </div>
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
<script src="<?php echo base_url(); ?>assets/js/Assessment.js" type="text/javascript"></script>
<script>
    $( document ).ready(function() {
        console.log( "ready!" );
        //var otherTime = 1;
    });
    var otherTime = 1;
    function addQuestion() {
        //alert(otherTime);

        otherTime = otherTime+1;
        var URL = "<?php echo base_url(); ?>assessment/AddQuestion?id="+Math.random();
        var Id = this.value;
        jQuery.ajax({
            url : URL,
            type: "POST",
            data : {num:otherTime},
            success: function(data)
            {
                jQuery('#addQuestion').append(data);
                //jQuery('#'+Id).remove();
            }
        });

    }
</script>