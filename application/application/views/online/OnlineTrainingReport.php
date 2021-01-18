<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Online Training Report</h1>
                </div>
                <div class="col-sm-6">
                    <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>dashboard/index">Dashboard</a> > MappingList</span>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
	
    <?php
	foreach($TrainingScheduled as $key=>$tmpData) 
	{
		if(count($tmpData['Modules'])==0)
		{
			unset($TrainingScheduled[$key]);
		}
		
	}
	
	//echo count($TrainingScheduled);
	//echo "<pre>";
	//print_r($TrainingScheduled);
	//echo "</pre>";
	//die;
	$CSVData=array();
	$tmpCSV=array();
	?>
    <style>
	td,th
	{
		font-size:13px;
		min-width:120px;
	}
	</style>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">    
				<div class="card">
                    <?php
                    if($SessionData['UserGroupId'] != 5)
                    {
                    ?>
                	<div class="card-body">
                        <form action="" method="get">
                            <div class="row">                               
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Traineer</label>
                                        <select class="form-control" id="TrainerId" name="TrainerId">
                                            <option value="">Select Traineer</option>
                                            <?php foreach($TrainerData as $data) { ?>
                                                <option <?php if($_GET['TrainerId']==$data['Id']) { echo "selected"; } ?> value="<?php echo $data['Id'];?>"><?php echo ucfirst($data['FirstName']).' '.ucfirst($data['LastName']);?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
								
                                <div class="col-1">
                                    <label for="exampleInputEmail1">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block btn-flat no-border">Search</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                    <?php } ?>
					<!-- /.card-header -->
                    <div class="card-body" style="overflow:auto; height:80vh;">
                        <b>Total Record Count :</b> <?php echo count($TrainingScheduled);?>, 
                        <a href="<?php echo base_url();?>download.php?filename=assets/ReportData/OnlineTrainingReport.csv">Download CSV</a>
                        <table id="MaricoTableData" class="table table-bordered">
                            <thead>
                            <tr>
                            	<th colspan="13">&nbsp;</th>
                                <th colspan="5" style="text-align:center;">Weekly Assessment 1 score </th>
                                <th colspan="5" style="text-align:center;">Weekly Assessment 2 score </th>
                                <th colspan="5" style="text-align:center;">Weekly Assessment 3 score </th>
                            </tr>
                            
                            <tr>
                            	<th><?php echo $tmpCSV[]='Student';?></th>
                                <th><?php echo $tmpCSV[]='Contact No.';?></th>
                                <th><?php echo $tmpCSV[]='Alternate No.';?></th>
                                <th><?php echo $tmpCSV[]='Student UID';?></th>
                                <th><?php echo $tmpCSV[]='School';?></th>
                                <th><?php echo $tmpCSV[]='District';?></th>
                                
                                <th><?php echo $tmpCSV[]='Trainer Name';?></th>
                                <th><?php echo $tmpCSV[]='Date of 1st Training';?></th>
                                <th><?php echo $tmpCSV[]='Training Time';?></th>
                                <th><?php echo $tmpCSV[]='Mode of Training';?></th>
                                <th><?php echo $tmpCSV[]='Assessment By';?></th>
                                <th><?php echo $tmpCSV[]='Assessment Date';?></th>
                                <th><?php echo $tmpCSV[]='Duration in minutes';?></th>
                                
                                <th><?php echo $tmpCSV[]='Date of 2st Training';?></th>
                                <th><?php echo $tmpCSV[]='Training Time';?></th>
                                <th><?php echo $tmpCSV[]='Mode of Training';?></th>
                                <th><?php echo $tmpCSV[]='Duration in minutes';?></th>
                                
                                <th><?php echo $tmpCSV[]='Date of 3rd Training';?></th>
                                <th><?php echo $tmpCSV[]='Training Time';?></th>
                                <th><?php echo $tmpCSV[]='Mode of Training';?></th>
                                <th><?php echo $tmpCSV[]='Duration in minutes';?></th>
                                
                                <th><?php echo $tmpCSV[]='Total training time';?></th>
                                <th><?php echo $tmpCSV[]='Total number of modules covered';?></th>
                                
                                <th><?php echo $tmpCSV[]='Assessment 1 Date';?></th>
                                <th><?php echo $tmpCSV[]='A1';?></th>
                                <th><?php echo $tmpCSV[]='LO+SI';?></th>
                                <th><?php echo $tmpCSV[]='LO+50%SI';?></th>
                                <th><?php echo $tmpCSV[]='LO';?></th>
                                
                                <th><?php echo $tmpCSV[]='Assessment 2 Date';?></th>
                                <th><?php echo $tmpCSV[]='A1';?></th>
                                <th><?php echo $tmpCSV[]='LO+SI';?></th>
                                <th><?php echo $tmpCSV[]='LO+50%SI';?></th>
                                <th><?php echo $tmpCSV[]='LO';?></th>
                                
                                <th><?php echo $tmpCSV[]='Assessment 3 Date';?></th>
                                <th><?php echo $tmpCSV[]='A1';?></th>
                                <th><?php echo $tmpCSV[]='LO+SI';?></th>
                                <th><?php echo $tmpCSV[]='LO+50%SI';?></th>
                                <th><?php echo $tmpCSV[]='LO';?></th>                                
                                
                            </tr>
                            </thead>
                            
                            <tbody> 
                            
                            <?php 
							$CSVData[]=$tmpCSV;
							foreach($TrainingScheduled as $tmpData) 
							{ 
								$tmpCSV=array();
								$TotalTrainingTime=0;
								$TotalTrainingModule=0;
								if(count($tmpData['Modules']))
								{
									?>
                                    <tr>
                                        <td><?php echo $tmpCSV[]=$tmpData['StudentName']?></td>
                                        <td><?php echo $tmpCSV[]=$tmpData['PhoneNo']?></td>
                                        <td><?php echo $tmpCSV[]=$tmpData['PhoneNumber']?></td>
                                        <td><?php echo $tmpCSV[]=$tmpData['StudentId']?></td>
                                        <td><?php echo $tmpCSV[]=$tmpData['SchoolName']?></td>
                                        <td><?php echo $tmpCSV[]=$tmpData['DistrictName']?></td>
                                        
                                        <td><?php if($tmpData['UserName']) echo $tmpCSV[]=$tmpData['UserName']; else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Modules']['100']['TraingDate']) echo $tmpCSV[]=date('d M, Y',strtotime($tmpData['Modules']['100']['TraingDate'])); else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Modules']['100']['TrainingTime']) echo $tmpCSV[]=$tmpData['Modules']['100']['TrainingTime']; else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Modules']['100']['WhatsAppCall']) echo $tmpCSV[]=$tmpData['Modules']['100']['WhatsAppCall']; else $tmpCSV[]='';?></td>
                                        
                                        <td><?php if($tmpData['Assessment']['100']['FirstName']) echo $tmpCSV[]=$tmpData['Assessment']['100']['FirstName'].' '.$tmpData['Assessment']['100']['LastName']; else $tmpCSV[]='';?></td>
                                       <td><?php if($tmpData['Assessment']['100']['DateCreated']) echo $tmpCSV[]=date('d M, Y',strtotime($tmpData['Assessment']['100']['DateCreated'])); else $tmpCSV[]='';?></td>
                                        
                                        <td><?php if($tmpData['Modules']['100']['TraingDate']) { echo $tmpCSV[]='60 min'; $TotalTrainingTime+=60; $TotalTrainingModule+=50; }  else $tmpCSV[]=''; ?></td>
                                        
                                        <td><?php if($tmpData['Modules']['150']['TraingDate']) echo $tmpCSV[]=date('d M, Y',strtotime($tmpData['Modules']['150']['TraingDate'])); else $tmpCSV[]='';?></td>
                                         <td><?php if($tmpData['Modules']['150']['TrainingTime']) echo $tmpCSV[]=$tmpData['Modules']['150']['TrainingTime']; else $tmpCSV[]='';?></td>
                                         <td><?php if($tmpData['Modules']['150']['WhatsAppCall']) echo $tmpCSV[]=$tmpData['Modules']['150']['WhatsAppCall']; else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Modules']['150']['TraingDate']) { echo $tmpCSV[]='60 min'; $TotalTrainingTime+=60; $TotalTrainingModule+=50; } else $tmpCSV[]=''; ?></td>
                                        
                                        <td><?php if($tmpData['Modules']['200']['TraingDate']) echo $tmpCSV[]=date('d M, Y',strtotime($tmpData['Modules']['200']['TraingDate'])); else $tmpCSV[]='';?></td>
                                         <td><?php if($tmpData['Modules']['200']['TrainingTime']) echo $tmpCSV[]=$tmpData['Modules']['200']['TrainingTime']; else $tmpCSV[]='';?></td>
                                         <td><?php if($tmpData['Modules']['200']['WhatsAppCall']) echo $tmpCSV[]=$tmpData['Modules']['200']['WhatsAppCall']; else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Modules']['200']['TraingDate']) { echo $tmpCSV[]='60 min'; $TotalTrainingTime+=60; $TotalTrainingModule+=50; } else $tmpCSV[]=''; ?></td>
                                        
                                        <td><?php if($TotalTrainingTime) echo $tmpCSV[]=$TotalTrainingTime.' min'; else $tmpCSV[]='';?> </td>
                                        <td><?php if($TotalTrainingModule) echo $tmpCSV[]=$TotalTrainingModule; else $tmpCSV[]='';?></td>
                                        
                                        <td><?php if($tmpData['Assessment']['100']['DateCreated']) echo $tmpCSV[]=date('d M, Y',strtotime($tmpData['Assessment']['100']['DateCreated'])); else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Assessment']['100']['A1']) echo $tmpCSV[]="Yes"; else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Assessment']['100']['B1']) echo $tmpCSV[]="Yes"; else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Assessment']['100']['C1']) echo $tmpCSV[]="Yes"; else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Assessment']['100']['D1']) echo $tmpCSV[]="Yes"; else $tmpCSV[]='';?></td>
                                        
                                        
                                        <td><?php if($tmpData['Assessment']['150']['DateCreated']) echo date('d M, Y',strtotime($tmpData['Assessment']['150']['DateCreated'])); else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Assessment']['150']['A1']) echo $tmpCSV[]="Yes"; else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Assessment']['150']['B1']) echo $tmpCSV[]="Yes"; else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Assessment']['150']['C1']) echo $tmpCSV[]="Yes"; else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Assessment']['150']['D1']) echo $tmpCSV[]="Yes"; else $tmpCSV[]='';?></td>
                                        
                                        
                                        <td>
										<?php if($tmpData['Assessment']['200']['DateCreated']) echo $tmpCSV[]=date('d M, Y',strtotime($tmpData['Assessment']['200']['DateCreated'])); else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Assessment']['200']['A1']) echo $tmpCSV[]="Yes"; else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Assessment']['200']['B1']) echo $tmpCSV[]="Yes"; else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Assessment']['200']['C1']) echo $tmpCSV[]="Yes"; else $tmpCSV[]='';?></td>
                                        <td><?php if($tmpData['Assessment']['200']['D1']) echo $tmpCSV[]="Yes"; else $tmpCSV[]='';?></td>                                
                                                                    
                                        
                                    </tr>
                                    <?php 
									$CSVData[]=$tmpCSV;
								}
							}
							
							$fp = fopen('assets/ReportData/OnlineTrainingReport.csv', 'w');
							foreach ($CSVData as $fields) 
							{
								fputcsv($fp, $fields);
							}
				
							fclose($fp);
							
							
							//echo "<pre>";
							//print_r($CSVData);
							//echo "</pre>";
							?>
                            
                                                       	
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
<script src="<?php echo base_url(); ?>assets/js/mapping.js" type="text/javascript"></script>