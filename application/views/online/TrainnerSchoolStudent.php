<!-- Content Wrapper. Contains page content -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="<?php echo base_url(); ?>assets/js/mapping.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<style>
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    text-indent: 1px;
    text-overflow: '';
}
.table-bordered th, .table-bordered td {
    border: 1px solid rgb(222, 226, 230);
    margin: 0;
    padding: 3px;
    vertical-align: middle;
}
.minwidth150
{
	min-width:150px;
}

.regexcel select 
{
	margin: 0;
    padding: 0;
}


#MaricoModal .modal-dialog
{
	width:40%;
	max-width:480px;
}

</style>


<div class="internet-disconnect" id="internetmessage"></div>
<Br/>                                            
<div class="content-wrapper" style="margin: 0px !important; float:left;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
               
                <div class="col-sm-4">
                    <button type="button" class="btn btn-primary" onClick="SaveOnlineTraingData()">Save</button>
                </div>
                
                <div class="col-sm-6">
                <span style="float: right"><a class="linkblack" href="<?php echo base_url(); ?>online/TrainnerSchool">Back to online training</a></span>
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
                        <div class="row mb-2">

						<?php if($_GET['SearchField']=='' && count($PageTrainnerSchoolStudentData)>1) { ?>
                        <nav aria-label="Page navigation example">
                          <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="<?php echo base_url();?>online/TrainnerSchoolStudent/<?php echo $SchoolId;?>/<?php echo $ModuleNumber;?>?view=no&PageNumber=<?php echo $PrevPageNumber;?>">Previous</a></li>
                            <?php foreach($PageTrainnerSchoolStudentData as $PageNumber=>$tmpData) { ?>
                            <li class="page-item <?php if($CurrentPage==$PageNumber)  {  echo "active"; } ?>">
                            <a class="page-link" href="<?php echo base_url();?>online/TrainnerSchoolStudent/<?php echo $SchoolId;?>/<?php echo $ModuleNumber;?>?view=no&PageNumber=<?php echo $PageNumber;?>"><?php echo  $PageNumber+1;?></a>
                            </li>
                            <?php } ?>
                            <li class="page-item"><a class="page-link" href="<?php echo base_url();?>online/TrainnerSchoolStudent/<?php echo $SchoolId;?>/<?php echo $ModuleNumber;?>?view=no&PageNumber=<?php echo $NextPageNumber;?>">Next</a></li>
                          </ul>
                        </nav> 
                        <?php } ?>
   
              
                        <div class="col-12 text-center internettext" id="savecounter">
                            Your data will save in (secs) <span>60</span>
                        </div>
                        </div>
                    </div>


                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="" method="get">
                            
                            <div class="row mb-2">
                                <div class="col-4">
                                    <label>School Name: &nbsp;</label><?php echo $TrainnerSchoolStudentData[0]['SchoolName']?>
                                </div>

                                <div class="col-1">
                                    <div class="form-group">
                                        <select class="form-control minwidth150" id="Status" name="Status" >
                                            <option value="">Call Status</option>
                                            <option value="Not Reachable" <?php if($_GET['Status']=='Not Reachable') { echo "selected"; } ?>>Not Reachable</option>
                                            <option value="Switched Off" <?php if($_GET['Status']=='Switched Off') { echo "selected"; } ?>>Switched Off</option>
                                            <option value="Busy" <?php if($_GET['Status']=='Busy') { echo "selected"; } ?>>Busy</option>
                                            <option value="Not Picked" <?php if($_GET['Status']=='Not Picked') { echo "selected"; } ?>>Not Picked</option>
                                            <option value="Connected" <?php if($_GET['Status']=='Connected') { echo "selected"; } ?>>Connected</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <input class="form-control" id="view" name="view" type="hidden" value="no">
                                            <input class="form-control" id="SearchField" name="SearchField"  placeholder="Search" type="text">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat no-border">Search</button>
                                    </div>
                        
                                <div class="col-1">
                                    <a href="<?php echo base_url(); ?>online/TrainnerSchoolStudent/<?php echo $SchoolId;?>?view=no" class="btn btn-primary btn-block btn-flat no-border">Reset</a>
                                </div>
							</form>
                            </div>
                            
                            
                            

                        <form method="post" action="" id="SchoolStudentOnlineForm">
                        <table class="table table-bordered OnlineStudent" style="font-size:14px;">
                            <thead>
                            <tr>
                                <th style="min-width:100px">Student Name</th>
                                <th style="min-width:100px">Guardian Name</th>
                                <th style="min-width:80px">Class</th>
                                <th style="min-width:50px">Age</th>
                                <th style="min-width:50px">Phone No.</th>
                                <th style="min-width:100px">Owner</th>
                                <th style="min-width:100px">MobileType</th>
                                <th style="min-width:100px">WhatsAPP?</th>
                                <th style="min-width:100px">Email</th>
                                <th style="min-width:100px">Phone</th>
                                <th style="min-width:100px">Status</th>
                                <th style="min-width:100px">Date</th>
                                <th style="min-width:100px">Training Time</th>
                                <th style="min-width:100px">Remarks</th>
							</tr>
                            </thead>
                            <tbody class="regexcel">
                            <?php

                            $i=0;
                            foreach($TrainnerSchoolStudentData as $data) 
							{
                                $i++;
								if($data['TraingDate']=='0000-00-00')
								{
									 $data['TraingDate']='';
								}
								
								$backgroundColor='';
								if($data['TraingDate'])
								{
									$backgroundColor='style="background-color:#90EE90"';
								}
								
								if($data['PhoneNumber']=='')
								{
									$data['PhoneNumber']=$data['PhoneNo'];
								}
                                ?>


                                <tr id="trcolordata-<?php echo $data['Id']?>" <?php echo $backgroundColor;?>>
                                    <td class="minwidth150">
                                    	<input class="form-control" name="StudentId[]" value="<?php echo $data['Id']?>" type="hidden"/>
                                        <a href="javaScript:void(0)" data-toggle="modal" onclick="StudentPopupData('<?php echo $data['Id']; ?>')"><?php echo ucfirst($data['Name']);?></a>
                                    </td>
                                    <td align="center"><?php echo ucfirst($data['GuardianName']);?></td>
                                    <td align="center"><?php echo ucfirst($data['Class']);?></td>
                                    <td align="center"><?php echo ucfirst($data['Age']);?></td>
                                    <td><a href="tel:<?php echo $data['PhoneNo']?>"><?php echo $data['PhoneNo'];?></a></td>
                                    <td><select class="form-control minwidth150" id="OwnerMobile-<?php echo $data['Id']?>" name="OwnerMobile[<?php echo $data['Id']?>]" onChange="SaveFieldData('<?php echo $data['Id']?>','OwnerMobile',this.value)">
                                            <option value="">Owner</option>
                                            <option value="Father" <?php if($data['OwnerMobile']=='Father') { echo "selected"; } ?>>Father</option>
                                            <option value="Mother" <?php if($data['OwnerMobile']=='Mother') { echo "selected"; } ?>>Mother</option>
                                            <option value="Sister" <?php if($data['OwnerMobile']=='Sister') { echo "selected"; } ?>>Sister</option>
                                            <option value="Other" <?php if($data['OwnerMobile']=='Other') { echo "selected"; } ?>>Other</option>
                                        </select></td>
                                    <td><select class="form-control minwidth150" id="MobileType-<?php echo $data['Id']?>" name="MobileType[<?php echo $data['Id']?>]" onChange="SaveFieldData('<?php echo $data['Id']?>','MobileType',this.value)">
                                            <option value="">MobileType</option>
                                            <option value="SmartPhone" <?php if($data['MobileType']=='SmartPhone') { echo "selected"; } ?>>Smart phone</option>
                                            <option value="NotSmartPhone" <?php if($data['MobileType']=='NotSmartPhone') { echo "selected"; } ?>>Not smart phone</option>
                                        </select></td>
                                    <td><select class="form-control minwidth150" id="WhatsUpAvailable-<?php echo $data['Id']?>" name="WhatsUpAvailable[<?php echo $data['Id']?>]" onChange="SaveFieldData('<?php echo $data['Id']?>','WhatsUpAvailable',this.value)">
                                            <option value="">WhatsAPP</option>
                                            <option value="Yes" <?php if($data['WhatsUpAvailable']=='Yes') { echo "selected"; } ?>>Yes</option>
                                            <option value="No" <?php if($data['WhatsUpAvailable']=='No') { echo "selected"; } ?>>No</option>
                                        </select></td>
                                    
                                    <td><input class="form-control minwidth150" id="EmailFamilyMember-<?php echo $data['Id']?>" name="EmailFamilyMember[<?php echo $data['Id']?>]" value="<?php echo $data['EmailFamilyMember']; ?>" placeholder="Email" type="text" onBlur="SaveFieldData('<?php echo $data['Id']?>','EmailFamilyMember',this.value)"></td>
                                    <td><input class="form-control minwidth150" id="PhoneNumber-<?php echo $data['Id']?>" name="PhoneNumber[<?php echo $data['Id']?>]" value="<?php echo $data['PhoneNumber']; ?>" placeholder="Phone" type="text" onBlur="SaveFieldData('<?php echo $data['Id']?>','PhoneNumber',this.value)"></td>
                                    
                                    <td>
                                    	<select class="form-control minwidth150" id="StatusCalling-<?php echo $data['Id']?>" name="StatusCalling[<?php echo $data['Id']?>]" onChange="SaveFieldData('<?php echo $data['Id']?>','StatusCalling',this.value)">
                                            <option value="">Call Status</option>
                                            <option value="Not Reachable" <?php if($data['StatusCalling']=='Not Reachable') { echo "selected"; } ?>>Not Reachable</option>
                                            <option value="Switched Off" <?php if($data['StatusCalling']=='Switched Off') { echo "selected"; } ?>>Switched Off</option>
                                            <option value="Busy" <?php if($data['StatusCalling']=='Busy') { echo "selected"; } ?>>Busy</option>
                                            <option value="Not Picked" <?php if($data['StatusCalling']=='Not Picked') { echo "selected"; } ?>>Not Picked</option>
                                            <option value="Connected" <?php if($data['StatusCalling']=='Connected') { echo "selected"; } ?>>Connected</option>
                                        </select>
                                    
                                    </td>
                                    
                                    
                                    <td>
                                    <input type="text" class="form-control minwidth150" readonly placeholder="Traing Date" value="<?php echo $data['TraingDate']; ?>" name="TraingDate[<?php echo $data['Id']?>]" id="TraingDate-<?php echo $data['Id']?>" autocomplete="off">
                                    <script>
									$( function() 
									{
										$("#TraingDate-<?php echo $data['Id']?>").datepicker({ 
											dateFormat: 'yy-mm-dd',
											onSelect: function(date) {
												if(date)
												{
													SaveFieldData('<?php echo $data['Id']?>','TraingDate',date);
												}
											  }
										});
									  
									});							
									
									</script>
                                    </td>
                                    <td>
                                    	<select class="form-control minwidth150" id="TrainingTime-<?php echo $data['Id']?>" name="TrainingTime[<?php echo $data['Id']?>]" onChange="SaveFieldData('<?php echo $data['Id']?>','TrainingTime',this.value)">
                                            <option value="">Training Time</option>
                                            <option value="08:00 AM - 09:00 AM" <?php if($data['TrainingTime']=='08:00 AM - 09:00 AM') { echo "selected"; } ?>>08:00 AM - 09:00 AM</option>
                                            <option value="09:00 AM - 10:00 AM" <?php if($data['TrainingTime']=='09:00 AM - 10:00 AM') { echo "selected"; } ?>>09:00 AM - 10:00 AM</option>
                                            <option value="10:00 AM - 11:00 AM" <?php if($data['TrainingTime']=='10:00 AM - 11:00 AM') { echo "selected"; } ?>>10:00 AM - 11:00 AM</option>
                                            <option value="11:00 AM - 12:00 PM" <?php if($data['TrainingTime']=='11:00 AM - 12:00 PM') { echo "selected"; } ?>>11:00 AM - 12:00 PM</option>
                                            <option value="12:00 PM - 01:00 PM" <?php if($data['TrainingTime']=='12:00 PM - 01:00 PM') { echo "selected"; } ?>>12:00 PM - 01:00 PM</option>
                                            <option value="01:00 PM - 02:00 PM" <?php if($data['TrainingTime']=='01:00 PM - 02:00 PM') { echo "selected"; } ?>>01:00 PM - 02:00 PM</option>
                                            <option value="02:00 PM - 03:00 PM" <?php if($data['TrainingTime']=='02:00 PM - 03:00 PM') { echo "selected"; } ?>>02:00 PM - 03:00 PM</option>
                                            <option value="03:00 PM - 04:00 PM" <?php if($data['TrainingTime']=='03:00 PM - 04:00 PM') { echo "selected"; } ?>>03:00 PM - 04:00 PM</option>
                                            <option value="04:00 PM - 05:00 PM" <?php if($data['TrainingTime']=='04:00 PM - 05:00 PM') { echo "selected"; } ?>>04:00 PM - 05:00 PM</option>
                                            <option value="05:00 PM - 06:00 PM" <?php if($data['TrainingTime']=='05:00 PM - 06:00 PM') { echo "selected"; } ?>>05:00 PM - 06:00 PM</option>
                                            <option value="06:00 PM - 07:00 PM" <?php if($data['TrainingTime']=='06:00 PM - 07:00 PM') { echo "selected"; } ?>>06:00 PM - 07:00 PM</option>
                                            <option value="07:00 PM - 08:00 PM" <?php if($data['TrainingTime']=='07:00 PM - 08:00 PM') { echo "selected"; } ?>>07:00 PM - 08:00 PM</option>
                                        </select>                                        
                                    </td>
                                    
                                    <td><input class="form-control minwidth150" id="Remarks-<?php echo $data['Id']?>" value="<?php echo $data['Remarks']; ?>" name="Remarks[<?php echo $data['Id']?>]" placeholder="Remarks" type="text" onBlur="SaveFieldData('<?php echo $data['Id']?>','Remarks',this.value)"></td>

                                </tr>
                            <?php  } ?>
                            </tbody>

                        </table>

                        </form>
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

<div id="MaricoModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content modalcontentborder">
            <div class="modal-header modalheader">
                <button type="button" class="close modalclosebutton" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modalheaderfont" id="ModalLightTitle">Training</h4>
            </div>
            <div class="modal-body" id="ModalLightBody">
				Please wait...
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<script>

function StudentPopupData(StudentId)
{
	jQuery('#MaricoModal').modal('show'); 
	jQuery('#internetmessage').html('Data saving now...');
	var URL='<?php echo base_url();?>online/TrainnerStudentPopup/';
	jQuery.ajax({
		url : URL,
		type: "POST",
		data : {StudentId:StudentId,ModuleNumber:<?php echo $ModuleNumber;?>},
		success: function(data)
		{
		  	jQuery('#ModalLightBody').html(data); 
		}
	});	
		
	
}

function SaveFieldDataPopup(StudentId,FieldName,FieldValue)
{
	jQuery('#'+FieldName+'-'+StudentId).val(FieldValue);
	SaveFieldData(StudentId,FieldName,FieldValue);   	
}


function SaveFieldData(StudentId,FieldName,FieldValue)
{
   if(FieldValue)
   {
	   if('TraingDate'==FieldName)
	   {
		   jQuery('#trcolordata-'+StudentId).css('background-color','#90EE90')
	   }
	   
		jQuery('#internetmessage').html('Data saving now...');
		var URL='<?php echo base_url();?>online/TrainnerSchoolStudentField/';
		var formData = $("#SchoolStudentOnlineForm").serializeArray();
		jQuery.ajax({
			url : URL,
			type: "POST",
			data : {StudentId:StudentId,FieldName:FieldName,FieldValue:FieldValue,ModuleNumber:<?php echo $ModuleNumber;?>},
			success: function(data)
			{
			   
			}
		});	
   }
   return false;	
}

function SaveOnlineTraingData()
{
	jQuery('#internetmessage').css('background-color','#089de3');
	jQuery('#internetmessage').show();
	jQuery('#internetmessage').html('Data saving now...');
	var URL='<?php echo base_url();?>online/TrainnerSchoolStudent/<?php echo $SchoolId;?>/<?php echo $ModuleNumber;?>';
	var formData = $("#SchoolStudentOnlineForm").serializeArray();
	jQuery.ajax({
    	url : URL,
    	type: "POST",
    	data : formData,
	    success: function(data)
	    {
	       jQuery('#internetmessage').html('Data successfully saved...');
	    }
	});	
	return false; 
}


setInterval(function()
{ 
	var counter=parseInt(jQuery('#savecounter span').html());
	counter=counter-1;
	
	if(counter%10==0)
	{
		if(navigator.onLine)
		{
			jQuery('#internetmessage').hide();
		}
		else
		{
			jQuery('#internetmessage').show();
			jQuery('#internetmessage').css('background-color','#EF3538');
			jQuery('#internetmessage').html('Your internet is down. Please check...');
		}		
	}
	
	if(counter<0)
	{
		if(navigator.onLine)
		{
			if(jQuery('#MaricoModal').is(':visible')==false)
			{
				jQuery('#internetmessage').css('background-color','#089de3');
				jQuery('#internetmessage').show();
				SaveOnlineTraingData();
			}
		}
		else
		{
			jQuery('#internetmessage').show();
			jQuery('#internetmessage').css('background-color','#EF3538');
			jQuery('#internetmessage').html('Your internet is down. Please check...');
		}
		counter=60;
	}
	jQuery('#savecounter span').html(counter);
	
	
},1000);



</script>


