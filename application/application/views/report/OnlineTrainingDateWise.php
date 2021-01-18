<!-- Content Wrapper. Contains page content -->
<?php
//echo '<pre>';
//print_r($SchoolName);
//echo '</pre>';
$CSVData=array();
$tmpCSV=array();
$tmpCSV1=array();
$tmpCSV2=array();
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<style>
    .table th, .table td {
        padding: 6px;
        vertical-align: middle;
    }
    #MaricoModal .modal-dialog
    {
        max-width: 580px;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $SchoolName['Name'];?></h1>
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

                <div class="card">

                    <div class="card-body">
                        <form action="" method="get">

                            <div class="row">
                                <?php
                                //if($SessionData['UserGroupId'] == '3' || $SessionData['UserGroupId'] == '2'){
                                if($SessionData['UserGroupId'] == '3'){
                                    ?>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Date</label>
                                            <input type="text" class="form-control" placeholder="Date" name="FilterDate" id="datepicker" autocomplete="off" value="<?php if($_GET['FilterDate']){ echo date('m/d/Y',strtotime($_GET['FilterDate'])); }?>">
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Traineer</label>
                                            <select class="form-control" id="UserName" name="UserName">
                                                <option value="">Select Traineer</option>
                                                <option value="28">Vivek Kumar</option>
                                                <?php foreach($TrainerData as $data) { ?>
                                                    <option <?php if($_GET['UserName']==$data['Id']) { echo "selected"; } ?> value="<?php echo $data['Id'];?>"><?php echo $data['FirstName'].' '.$data['LastName'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <label for="exampleInputEmail1">&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-block btn-flat no-border">Search</button>
                                    </div>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
					
                    <?php if(count($OnlineTrainingCompleteData)) {
                        $tmpCSVHeader1[] = 'Module Number: 100';
                        $CSVData[] = $tmpCSVHeader1;
                        ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-10">
                                <h3>Module Number: 100</h3>
                            </div>
                            <div class="col-sm-2">
                                <a class="pull-right" href="<?php echo base_url();?>download.php?filename=assets/ReportData/OnlineTrainingReportDateWise.csv">Download CSV</a>
                            </div>
                        </div>
                        <table  class="table table-bordered">
                            <thead >
                            <tr>

                                <th><?php echo $tmpCSV[] = 'Trainner Name';?></th>
                                <th><?php echo $tmpCSV[] = 'Scheduled Training';?></th>
                                <th><?php echo $tmpCSV[] = 'Complete Training';?></th>


                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $CSVData[]=$tmpCSV;
                            foreach($OnlineTrainingCompleteData as $key=>$data)
                            {
                                $tmpCSV=array();
                                $CompleteTraining=0;
                                foreach ($data as $tmpData) {
                                   if (count($tmpData['UploadDoc'])>0) {
                                        $CompleteTraining++;
                                    }
                                }
                                ?>
                                <tr <?php if(count($data)!=$CompleteTraining) { echo "style='background:#FFFFE0;'";} ?>>
                                    <td><?php echo $tmpCSV[] = $key;?></td>
                                    <td><?php echo $tmpCSV[] = count($data);?></td>
                                    <td><?php echo $tmpCSV[] = $CompleteTraining; ?></td>

                                </tr>
                            <?php
                                $CSVData[]=$tmpCSV;
                            }



                            ?>
                            </tbody>

                        </table>

                    </div>
					<?php } else { ?>
                        <div class="card-body">
                            <h3>Module Number: 100</h3>
                            <table  class="table table-bordered">
                                <thead >
                                <tr>

                                    <th>Trainner Name</th>
                                    <th>Scheduled Training</th>
                                    <th>Complete Training</th>


                                </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>
                    <?php } ?>

                     <?php if(count($OnlineTrainingCompleteDataTrainingTwo)) {
                         $tmpCSVBlank1[] = '';
                         $tmpCSVHeader2[] = 'Module Number: 150';
                         $CSVData[] = $tmpCSVBlank1;
                         $CSVData[] = $tmpCSVHeader2;
                         ?>
                     <div class="card-body">
                        <h3>Module Number: 150</h3>
                        <table  class="table table-bordered">
                            <thead >
                            <tr>

                                <th><?php echo $tmpCSV1[] = 'Trainner Name';?></th>
                                <th><?php echo $tmpCSV1[] = 'Scheduled Training';?></th>
                                <th><?php echo $tmpCSV1[] = 'Complete Training';?></th>


                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $CSVData[]=$tmpCSV1;
                            foreach($OnlineTrainingCompleteDataTrainingTwo as $key=>$data)
                            {
                                $tmpCSV1=array();
                                $CompleteTrainingTrainingTwo=0;
                                foreach ($data as $tmpData) {
                                    if (count($tmpData['UploadDoc'])>0) {
                                        $CompleteTrainingTrainingTwo++;
                                    }
                                }
                                ?>
                                <tr <?php if(count($data)!=$CompleteTrainingTrainingTwo) { echo "style='background:#FFFFE0;'";} ?>>
                                    <td><?php echo $tmpCSV1[] = $key;?></td>
                                    <td><?php echo $tmpCSV1[] = count($data);?></td>
                                    <td><?php echo $tmpCSV1[] = $CompleteTrainingTrainingTwo; ?></td>

                                </tr>
                            <?php
                                $CSVData[]=$tmpCSV1;
                            } ?>
                            </tbody>

                        </table>

                    </div>
                     <?php } else { ?>
                         <div class="card-body">
                             <h3>Module Number: 150</h3>
                             <table  class="table table-bordered">
                                 <thead >
                                 <tr>

                                     <th>Trainner Name</th>
                                     <th>Scheduled Training</th>
                                     <th>Complete Training</th>


                                 </tr>
                                 </thead>
                                 <tbody>

                                 <tr>
                                     <td>0</td>
                                     <td>0</td>
                                     <td>0</td>

                                 </tr>

                                 </tbody>

                             </table>

                         </div>
                     <?php } ?>


                    <?php if(count($OnlineTrainingCompleteDataTrainingThree)) {
                        $tmpCSVBlank2[] = '';
                        $tmpCSVHeader3[] = 'Module Number: 200';
                        $CSVData[] = $tmpCSVBlank2;
                        $CSVData[] = $tmpCSVHeader3;
                        ?>
                        <div class="card-body">
                            <h3>Module Number: 200</h3>
                            <table  class="table table-bordered">
                                <thead >
                                <tr>

                                    <th><?php echo $tmpCSV2[] = 'Trainner Name';?></th>
                                    <th><?php echo $tmpCSV2[] = 'Scheduled Training';?></th>
                                    <th><?php echo $tmpCSV2[] = 'Complete Training';?></th>


                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $CSVData[]=$tmpCSV2;
                                foreach($OnlineTrainingCompleteDataTrainingThree as $key=>$data)
                                {
                                    $tmpCSV2=array();
                                    $CompleteTrainingTrainingThree=0;
                                    foreach ($data as $tmpData) {
                                        if (count($tmpData['UploadDoc'])>0) {
                                            $CompleteTrainingTrainingThree++;
                                        }
                                    }
                                    ?>
                                    <tr <?php if(count($data)!=$CompleteTrainingTrainingThree) { echo "style='background:#FFFFE0;'";} ?>>
                                        <td><?php echo $tmpCSV2[] = $key;?></td>
                                        <td><?php echo $tmpCSV2[] = count($data);?></td>
                                        <td><?php echo $tmpCSV2[] = $CompleteTrainingTrainingThree; ?></td>

                                    </tr>
                                <?php $CSVData[]=$tmpCSV2;
                                }
                                ?>
                                </tbody>

                            </table>

                        </div>
                    <?php } else { ?>
                        <div class="card-body">
                            <h3>Module Number: 200</h3>
                            <table  class="table table-bordered">
                                <thead >
                                <tr>

                                    <th>Trainner Name</th>
                                    <th>Scheduled Training</th>
                                    <th>Complete Training</th>


                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>

                                </tr>

                                </tbody>

                            </table>

                        </div>
                    <?php }
                    $fp = fopen('assets/ReportData/OnlineTrainingReportDateWise.csv', 'w');
                    foreach ($CSVData as $fields)
                    {
                        fputcsv($fp, $fields);
                    }

                    fclose($fp);
                    ?>
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
<!--<script src="--><?php //echo base_url(); ?><!--assets/js/event.js" type="text/javascript"></script>-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>

    $( function() {
        $( "#datepicker" ).datepicker();
    } );
</script>