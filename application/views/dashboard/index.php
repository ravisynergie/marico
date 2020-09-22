<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper" style="background: #E2E2E2">
<?php
//echo '<pre>';
//print_r($TrainerData);
//echo '</pre>';
?>
    <!-- Content Header (Page header) -->
    <section class="content-header mp0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                <?php if($this->session->flashdata('msg')): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                <?php endif; ?>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-12 banner-container"> <img src="<?php echo base_url();?>/strip.jpg" class="banner-img"> </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
            	<?php if($UserGroupId!=5) { ?>
                <div class="card-body mp0">
                    <div class="form-group">
                        <div class="col-sm-8">
                        </div>

                        <div class="col-sm-2 mp0 float-right">
                            <select class="form-control" style="width:200px; float:right;" onChange="FilterData(this.value)">
                                <option value="">District</option>
                                <option value="">All</option>
                                <?php foreach($DistrictAllData as $tmpData) { ?>
                                    <option <?php if($FilterDistrictId==$tmpData['Id']) { echo "selected"; } ?> value="<?php echo $tmpData['Id'];?>"><?php echo ucfirst($tmpData['Name']);?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-2 mp0 float-right">
                            <select class="form-control" style="width:200px; float:right;" onChange="FilterDataByTrainer(this.value)">
                                <option value="">Trainer</option>
                                <option value="">All</option>
                                <?php foreach($TrainerData as $tmpData) { ?>
                                    <option <?php if($FilterTrainerId==$tmpData['Id']) { echo "selected"; } ?> value="<?php echo $tmpData['Id'];?>"><?php echo ucfirst($tmpData['FirstName']);?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php
				}
                $DistrictParameter=array('CallType'=>'DistrictData','PageTitle'=>'DISTRICTS','FilterTrainerId'=>$FilterTrainerId);
                $VillagesParameter=array('CallType'=>'VillagesData','PageTitle'=>'VILLAGES','FilterTrainerId'=>$FilterTrainerId);
                $SchoolParameter=array('CallType'=>'SchoolData','PageTitle'=>'SCHOOLS','FilterTrainerId'=>$FilterTrainerId);
                $StudentParameter=array('CallType'=>'StudentData','PageTitle'=>'STUDENTS&nbsp;ON&nbsp;BOARD');
                $TrainingHourParameter=array('CallType'=>'TrainingHourData','PageTitle'=>'TRAINING&nbsp;HOURS','FilterTrainerId'=>$FilterTrainerId);
                $TouchPointParameter=array('CallType'=>'TouchPointData','PageTitle'=>'TOUCHPOINTS','FilterTrainerId'=>$FilterTrainerId);
				$VolunteeringHourParameter=array('CallType'=>'VolunteeringHourData','PageTitle'=>'VOLUNTEERING&nbsp;HOURS','FilterTrainerId'=>$FilterTrainerId);
				$TrainerProgressParameter=array('CallType'=>'TrainerProgressPop','PageTitle'=>'Trainer&nbsp;Progress','FilterTrainerId'=>$FilterTrainerId);
				$TrainingProgressParameter=array('CallType'=>'TrainingProgressPop','PageTitle'=>'Training&nbsp;Progress','FilterTrainerId'=>$FilterTrainerId);
                $EventsParameter=array('CallType'=>'EventsPop','PageTitle'=>'EVENTS','FilterTrainerId'=>$FilterTrainerId);

				if($FilterDistrictId)
				{
					$StudentParameter=$StudentParameter=array('CallType'=>'DistrictStudentData','PageTitle'=>'Students','DistrctId'=>$FilterDistrictId);
					
					$DistrictParameter['DistrictId']=$FilterDistrictId;
					$VillagesParameter['DistrictId']=$FilterDistrictId;
					$SchoolParameter['DistrictId']=$FilterDistrictId;
					$TrainingHourParameter['DistrictId']=$FilterDistrictId;
					$TouchPointParameter['DistrictId']=$FilterDistrictId;
					$VolunteeringHourParameter['DistrictId']=$FilterDistrictId;
					
				}
				
				?>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mrt-40 mp0">
                            <div class="greenPatti"></div>
                            <div class="creamPatti"></div>
                            <div class="our-specification mrt-16 row">
                                <div class="col-sm-3 mb8">
                                    <div class="district-color" onClick=OpenMaricoDashboard('<?php echo json_encode($DistrictParameter);?>')>
                                        <p class="profile-text">Districts<br>
                                            <?php echo count($DistrictData);?></p>
                                    </div>
                                </div>
                                <div class="col-sm-3 mb8">
                                    <div class="village-color" onClick=OpenMaricoDashboard('<?php echo json_encode($VillagesParameter);?>')>
                                        <p class="profile-text">Villages<br>
                                            <?php echo count($VillageData);?></p>
                                    </div>
                                </div>
                                <div class="col-sm-3 mb8">
                                    <div class="school-color" onClick=OpenMaricoDashboard('<?php echo json_encode($SchoolParameter);?>')>
                                        <p class="profile-text"`>Schools<br>
                                            <?php echo count($SchoolData);?></p>
                                    </div>
                                </div>
                                
                                <div class="col-sm-3 mb8">
                                    <div class="students-color" onClick=OpenMaricoDashboard('<?php echo json_encode($StudentParameter);?>')>
                                        <p class="profile-text">Students on Board<br>
                                            <?php echo count($StudentData);?></p>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="our-specification mrt-16 row">
                                <div class="col-sm-3 mb8">
                                    <div class="training-color" onClick=OpenMaricoDashboard('<?php echo json_encode($TrainingHourParameter);?>')>
                                        <p class="profile-text">Training Hours<br>
                                            <?php echo $TrainingHourData;?></p>
                                    </div>
                                </div>
                                <div class="col-sm-3 mb8">
                                    <div class="volunteering-color" onClick=OpenMaricoDashboard('<?php echo json_encode($VolunteeringHourParameter);?>')>
                                        <p class="profile-text">Volunteering Hours<br>
                                            <?php echo $TotalVolunteeringHours;?></p>
                                    </div>
                                </div>
                                <div class="col-sm-3 mb8">
                                    <div class="events-color" onClick=OpenMaricoDashboard('<?php echo json_encode($EventsParameter);?>')>
                                        <p class="profile-text"`>Events<br>
                                            <?php echo count($EventData);?></p>
                                    </div>
                                </div>
                                <div class="col-sm-3 mb8">
                                    <div class="touchpoints-color" onClick=OpenMaricoDashboard('<?php echo json_encode($TouchPointParameter);?>')>
                                        <p class="profile-text">Touchpoints<br>
                                            <?php 
											$TotalTouchpointData=0;	
											foreach ($TouchpointData as $tmpData) 
											{
												$TotalTouchpointData+=$tmpData['count'];	
											}
											echo $TotalTouchpointData;
											?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="card-body">
                    <div class="row white-profile">
                        <div class="col-md-12 mrt-40 mp0">
                            <div class="green-header">
                                <p class="green-header-text">District Profile</p>
                            </div>
                            <div class="row">
                                <div class="col-sm-1 handimg" onClick=OpenMaricoDashboard('<?php echo json_encode($TrainingProgressParameter);?>')> <img src="<?php echo base_url(); ?>assets/img/Hand.png"/> </div>
                                <div class="col-sm-11">
                                    <div class="row">
                                        <?php
                                        foreach($DistrictData as $tmpData)
                                        {
                                            $DistrictParameter=array('DistrictId'=>$tmpData['Id'],'CallType'=>'DistrictProfile','PageTitle'=>str_replace(' ','&nbsp;',strtoupper($tmpData['Name'])));
                                            ?>
                                            <div class="col-sm-3 district-profile-background">
                                                <div class="district-profile-text" onClick=OpenMaricoDashboard('<?php echo json_encode($DistrictParameter);?>')><?php echo $tmpData['Name'];?></div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="card-body">
                    <div class="row white-profile">
                        <div class="col-md-12 mrt-40 mp0">
                            <div class="green-header">

                                  <div class="row">
                                  	<div class="col-md-8"><p class="green-header-text">TOUCHPOINT PROGRESS MAP</p></div>
                                 	<div class="col-md-4 float-right">
                                        <?php if($SessionData['UserGroupId'] != 5 && $SessionData['UserGroupId'] != 2) {?>
                                    <p class="green-header-text trainingmpage" onClick=OpenMaricoDashboard('<?php echo json_encode($TrainerProgressParameter);?>')>
                                    <img src="<?php echo base_url(); ?>assets/img/Hand2.png"/> TRAINER PROGRESS
                                    </p>
                                        <?php } ?>
                                    </div>
                                  </div>
                                   	
                                
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="graphmargin">
                                    <canvas id="barChart1" class="chartjs-render-monitor" style="height: 378px;width: 640px;"></canvas>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="graphmargin">
                                        <canvas id="barLine1" class="chartjs-render-monitor" style="display: block;height: 378px;width: 640px;"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row white-profile">
                        <div class="col-md-12 mrt-40 mp0">
                            <div class="green-header">
                                <div class="row">
                                  	<div class="col-md-8"><p class="green-header-text">PROGRESS</p></div>
                                 	<div class="col-md-4 float-right">
                                    <p class="green-header-text trainingmpage" onClick=OpenMaricoDashboard('<?php echo json_encode($TrainingProgressParameter);?>')>
                                    <img src="<?php echo base_url(); ?>assets/img/Hand2.png"/> TRAINING PROGRESS
                                    </p>
                                    </div>
                                  </div>
                                  
                                  
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="graphmargin">
                                        <canvas id="barLine2" class="chartjs-render-monitor" style="display: block;height: 378px;width: 640px;"></canvas>
                                    </div>

                                </div>
                                <hr class="verti">
                                <div class="col-sm-6">
                                    <div class="graphmargin" >
                                        <canvas id="barChart5" class="chartjs-render-monitor" style="height: 378px;width: 640px;"></canvas>
                                    </div>
                                </div>
                            </div>

                            <hr class="Hori">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="graphmargin">
                                        <canvas id="barChart2" class="chartjs-render-monitor" style="display: block;height: 378px;width: 640px;"></canvas>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>







                <div class="card-body" id="Assessment1">
                    <div class="row white-profile">
                        <div class="col-md-12 mrt-40 mp0">
                            <div class="green-header">
                                <div class="row">
                                    <div class="col-md-8"><p class="green-header-text">IMPACT ACHIEVED</p></div>
                                    <div class="col-md-4 float-right">
                                        <p class="green-header-text trainingmpage" onClick=OpenAssessment('assessment2')>
                                            <img src="<?php echo base_url(); ?>assets/img/Hand2.png"/> Assessment 2
                                        </p>
                                    </div>
                                </div>
                            </div>

							<?php
							$A1CountData=0;
							foreach ($AssessmentData['Section3'] as $key=>$AssessData)
							{
								if($AssessData['TotalMarks']>5)
								{
									$A1CountData++;
								}
							}
							$A1Percent=(int)round(($A1Achieved*100)/10000);
							?>
                            <div class="progressmargin">
                                <label>ACHIEVED A1 LEVEL</label>

                                <div class="row">
                                    <div class="col-11">
                                        <div class="progress">
                                            <span style="margin-left:-37px;" class="dot adult-dis-cir"><?php echo $A1Percent;?>%</span>
                                            <div class="progress-bar progress-bar-font" role="progressbar" style="width:<?php echo $A1Percent;?>%" aria-valuenow="<?php echo $A1Percent;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $A1Achieved; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <?php echo '10000'; ?>
                                    </div>
                                </div>
                            </div>
							
                            <?php
							$A1CountData=0;
							foreach ($AssessmentData['Section2'] as $key=>$AssessData)
							{
								if($AssessData['TotalMarks']>2)
								{
									$A1CountData++;
								}
							}
							$A1Percent=(int)round(($B1Achieved*100)/5000);
							?>
                            <div class="progressmargin">
                                <label>ACHIEVED LISTENING & SPOKEN INTERACTION OBJECTIVES</label>
                                <div class="row">
                                    <div class="col-11">
                                        <div class="progress">
                                            <span style="margin-left:-37px;" class="dot adult-dis-cir"><?php echo $A1Percent;?>%</span>
                                            <div class="progress-bar progress-bar-font" role="progressbar" style="width:<?php echo $A1Percent;?>%" aria-valuenow="<?php echo $A1Percent;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $B1Achieved; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <?php echo '5000'; ?>
                                    </div>
                                </div>
                            </div>
							
                            <?php
							$A1CountData=0;
							foreach ($AssessmentData['Section2'] as $key=>$AssessData)
							{
								if($AssessData['TotalMarks']>3)
								{
									$A1CountData++;
								}
							}
							$A1Percent=(int)round(($C1Achieved*100)/7500);
							?>
                            <div class="progressmargin">
                                <label>ACHIEVED LISTENING OBJECTIVES AND 50% OF SPOKEN INTERACTION OBJECTIVES</label>
                                <div class="row">
                                    <div class="col-11">
                                        <div class="progress">
                                            <span style="margin-left:-37px;" class="dot adult-dis-cir"><?php echo $A1Percent;?>%</span>
                                            <div class="progress-bar progress-bar-font" role="progressbar" style="width:<?php echo $A1Percent;?>%" aria-valuenow="<?php echo $A1Percent;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $C1Achieved; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <?php echo '7500'; ?>
                                    </div>
                                </div>
                            </div>
							
                            <?php
							$A1CountData=0;
							foreach ($AssessmentData['Section1'] as $key=>$AssessData)
							{
								if($AssessData['TotalMarks']>3)
								{
									$A1CountData++;
								}
							}
							$A1Percent=(int)round(($D1Achieved*100)/20000);
							?>
                            <div class="progressmargin">
                                <label>ACHIEVED LISTENING OBJECTIVES</label>
                                <div class="row">
                                    <div class="col-11">
                                        <div class="progress">
                                            <span style="margin-left:-37px;" class="dot adult-dis-cir"><?php echo $A1Percent;?>%</span>
                                            <div class="progress-bar progress-bar-font" role="progressbar" style="width:<?php echo $A1Percent;?>%" aria-valuenow="<?php echo $A1Percent;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $D1Achieved; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <?php echo '20000'; ?>
                                    </div>
                                </div>
                            </div>


                        </div>


                        <div class="row" style="margin-top: 40px;">
                            <div class="col-sm-6">
                                <div class="graphmargin">
                                    <canvas id="barChart3" class="chartjs-render-monitor" style="display: block;height: 378px;width: 640px;"></canvas>
                                </div>
                            </div>
                            <hr class="verti">
                            <div class="col-sm-6">
                                <div class="graphmargin">
                                    <canvas id="barChart4" class="chartjs-render-monitor" style="display: block;height: 378px;width: 640px;"></canvas>
                                </div>
                            </div>

                            <div class="progressmargin">
                                <label>A1 - ACHIEVED A1 LEVEL</label><br>
                                <label>B1 - ACHIEVED LISTENING & SPOKEN INTERACTION OBJECTIVES</label><br>
                                <label>C1 - ACHIEVED LISTENING OBJECTIVES AND 50% OF SPOKEN INTERACTION OBJECTIVES</label><br>
                                <label>D1 - ACHIEVED LISTENING OBJECTIVES</label>
                            </div>



                        </div>


                    </div>

                </div>




                    <div class="card-body" id="Assessment2" style="display: none">
                        <div class="row white-profile">
                            <div class="col-md-12 mrt-40 mp0">
                                <div class="green-header">
                                    <div class="row">
                                        <div class="col-md-8"><p class="green-header-text">ONLINE IMPACT ACHIEVED</p></div>
                                        <div class="col-md-4 float-right">
                                            <p class="green-header-text trainingmpage" onClick=OpenAssessment('assessment1')>
                                                <img src="<?php echo base_url(); ?>assets/img/Hand2.png"/> Assessment 1
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $A1CountData=0;
                                foreach ($OnlineAssessmentData['Section6'] as $key=>$AssessData)
                                {
                                    if($AssessData['TotalMarks']>5)
                                    {
                                        $A1CountData++;
                                    }
                                }
                                $OnlineA1Percent=(int)round(($OnlineA1Achieved*100)/10000);
                                ?>
                                <div class="progressmargin">
                                    <label>ACHIEVED A1 LEVEL</label>

                                    <div class="row">
                                        <div class="col-11">
                                            <div class="progress">
                                                <span style="margin-left:-37px;" class="dot adult-dis-cir"><?php echo $OnlineA1Percent;?>%</span>
                                                <div class="progress-bar progress-bar-font" role="progressbar" style="width:<?php echo $OnlineA1Percent;?>%" aria-valuenow="<?php echo $OnlineA1Percent;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $OnlineA1Achieved; ?></div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <?php echo '10000'; ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $A1CountData=0;
                                foreach ($OnlineAssessmentData['Section5'] as $key=>$AssessData)
                                {
                                    if($AssessData['TotalMarks']>2)
                                    {
                                        $A1CountData++;
                                    }
                                }
                                $OnlineB1Percent=(int)round(($OnlineB1Achieved*100)/5000);
                                ?>
                                <div class="progressmargin">
                                    <label>ACHIEVED LISTENING & SPOKEN INTERACTION OBJECTIVES</label>
                                    <div class="row">
                                        <div class="col-11">
                                            <div class="progress">
                                                <span style="margin-left:-37px;" class="dot adult-dis-cir"><?php echo $OnlineB1Percent;?>%</span>
                                                <div class="progress-bar progress-bar-font" role="progressbar" style="width:<?php echo $OnlineB1Percent;?>%" aria-valuenow="<?php echo $OnlineB1Percent;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $OnlineB1Achieved; ?></div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <?php echo '5000'; ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $A1CountData=0;
                                foreach ($OnlineAssessmentData['Section5'] as $key=>$AssessData)
                                {
                                    if($AssessData['TotalMarks']>3)
                                    {
                                        $A1CountData++;
                                    }
                                }
                                $OnlineC1Percent=(int)round(($OnlineC1Achieved*100)/7500);
                                ?>
                                <div class="progressmargin">
                                    <label>ACHIEVED LISTENING OBJECTIVES AND 50% OF SPOKEN INTERACTION OBJECTIVES</label>
                                    <div class="row">
                                        <div class="col-11">
                                            <div class="progress">
                                                <span style="margin-left:-37px;" class="dot adult-dis-cir"><?php echo $OnlineC1Percent;?>%</span>
                                                <div class="progress-bar progress-bar-font" role="progressbar" style="width:<?php echo $OnlineC1Percent;?>%" aria-valuenow="<?php echo $OnlineC1Percent;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $OnlineC1Achieved; ?></div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <?php echo '7500'; ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $A1CountData=0;
                                foreach ($OnlineAssessmentData['Section4'] as $key=>$AssessData)
                                {
                                    if($AssessData['TotalMarks']>3)
                                    {
                                        $A1CountData++;
                                    }
                                }
                                $OnlineD1Percent=(int)round(($D1Achieved*100)/20000);
                                ?>
                                <div class="progressmargin">
                                    <label>ACHIEVED LISTENING OBJECTIVES</label>
                                    <div class="row">
                                        <div class="col-11">
                                            <div class="progress">
                                                <span style="margin-left:-37px;" class="dot adult-dis-cir"><?php echo $OnlineD1Percent;?>%</span>
                                                <div class="progress-bar progress-bar-font" role="progressbar" style="width:<?php echo $OnlineD1Percent;?>%" aria-valuenow="<?php echo $OnlineD1Percent;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $OnlineD1Achieved; ?></div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <?php echo '20000'; ?>
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <div class="row" style="margin-top: 40px;">
                                <div class="col-sm-6">
                                    <div class="graphmargin">
                                        <canvas id="barChart8" class="chartjs-render-monitor" style="display: block;height: 378px;width: 640px;"></canvas>
                                    </div>
                                </div>
                                <hr class="verti">
                                <div class="col-sm-6">
                                    <div class="graphmargin">
                                        <canvas id="barChart9" class="chartjs-render-monitor" style="display: block;height: 378px;width: 640px;"></canvas>
                                    </div>
                                </div>

                                <div class="progressmargin">
                                    <label>A1 - ACHIEVED A1 LEVEL</label><br>
                                    <label>B1 - ACHIEVED LISTENING & SPOKEN INTERACTION OBJECTIVES</label><br>
                                    <label>C1 - ACHIEVED LISTENING OBJECTIVES AND 50% OF SPOKEN INTERACTION OBJECTIVES</label><br>
                                    <label>D1 - ACHIEVED LISTENING OBJECTIVES</label>
                                </div>



                            </div>


                        </div>

                    </div>





                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="white-profile">
                                <div class="green-header">
                                    <p class="green-header-text">Testimonials</p>
                                </div>
                                <div class="col-md-12">
                                    <?php include('MaricoTestimonial.php');?>
                                </div>
                            </div>
                        </div>



                    <div class="col-md-6" id='Schedule'>
                        <div class="white-profile">
                            <div class="green-header">
                                <div class="row">
                                    <div class="col-md-8">
                                     <p class="green-header-text">SCHEDULE</p>
                                    </div>
                                    <div class="col-md-4 float-right">
                                        <form method="post" action="">

                                                <div class="form-group green-header-text" style="padding-top: 7px; padding-right: 14px;">
                                                    <!--                                                      <label for="exampleInputEmail1">Activity Type</label>-->
                                                    <select class="form-control" id="ActivityType" name="ActivityType" onchange="GetActivityType(this)" required>
                                                        <option value="">Select Type</option>
                                                        <option value="All">All Up</option>
                                                        <option value="Training" <?php if($_GET['Type'] == 'Training') { echo 'selected'; }?>>Training</option>
                                                        <option value="Meeting" <?php if($_GET['Type'] == 'Meeting') { echo 'selected'; }?>>Community Meeting</option>
                                                        <option value="Event" <?php if($_GET['Type'] == 'Event') { echo 'selected'; }?>>Event</option>

                                                    </select>
                                                </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="col-md-12">
                                <!--                <img style="width: 90%; " src="--><?php //echo base_url(); ?><!--assets/img/map5.png"/>-->
                                <a name="calendar"></a>
                                <div id='calendar' style="height:307px; overflow-y: hidden"></div>
                                <img src="https://synergieinsights.com/calender-legend.png" style="width:400px; margin:20px;"/>
                            </div>
                        </div>
                    </div>




                </div>
            </div>






            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="white-profile">
                            <div class="green-header">
                                <p class="green-header-text">Gallery</p>
                            </div>
                            <div class="col-md-12">
                                <?php
//                                echo '<pre>';
//                                print_r($GalleryData);
//                                echo '</pre>';
                                ?>
                                <?php include('MaricoSlider.php');?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.card-body -->
            </div>


           <!-- <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mrt-40 mp0"> <img style="width:100%" src="<?php echo base_url(); ?>assets/img/map7.png"/> </div>
                </div>
            </div>
-->






            <!-- /.card -->
        </div>
        <!-- /.row -->
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<style>
    .table th, .table td {
        padding: 5px;
    }
</style>
<div id="MaricoModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%">

        <!-- Modal content-->
        <div class="modal-content modalcontentborder">
            <div class="modal-header modalheader">
                <button type="button" class="close modalclosebutton" data-dismiss="modal" >&times;</button>
                <h4 class="modal-title modalheaderfont" id="ModalLightTitle">Modal Header</h4>
            </div>
            <div class="modal-body" id="ModalLightBody">Loading...</div>
        </div>
    </div>
</div>
<link href='<?php echo base_url(); ?>assets/js/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='<?php echo base_url(); ?>assets/js/fullcalendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />

<script src='<?php echo base_url(); ?>assets/js/fullcalendar/lib/moment.min.js'></script>
<!--<script src='--><?php //echo base_url(); ?><!--assets/js/fullcalendar/lib/jquery.min.js'></script>-->
<script src='<?php echo base_url(); ?>assets/js/fullcalendar/fullcalendar.min.js'></script>


<!------------------------for Chart------------------------------------------------------>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<link href='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css' rel='stylesheet' media='print' />
<link href='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css' rel='stylesheet' media='print' />

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script src="https://emn178.github.io/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
<!------------------------for Chart End------------------------------------------------------>


<script>

    $(document).ready(function() {
$('#slide-navs').hide();
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'listDay,listWeek'
            },
            views: {
                listDay: { buttonText: 'list day' },
                listWeek: { buttonText: 'list week' }
            },

            defaultView: 'listWeek',
            defaultDate: '<?php echo date("Y-m-d");?>',
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: <?php echo json_encode($TrainingDataReport);?>,

            eventClick: function(calEvent, jsEvent, view) {

                if(calEvent.CancelReason)
                {
                    alert('Cancelled Reason: ' + calEvent.CancelReason);
                }

            }
        });

    });

</script>
<script>

    function GetActivityType(ActivityType){

        // alert('dee');
        var selectedText = ActivityType.options[ActivityType.selectedIndex].innerHTML;
        var selectedValue = ActivityType.value;
        // alert("Selected Text: " + selectedText + " Value: " + selectedValue);
        if(selectedValue == 'Training'){
            window.location.href='<?php echo base_url();?>dashboard/index?Type=Training#calendar';
        }
        if(selectedValue == 'Meeting'){
            window.location.href='<?php echo base_url();?>dashboard/index?Type=Meeting#calendar';
        }
        if(selectedValue == 'Event'){
            window.location.href='<?php echo base_url();?>dashboard/index?Type=Event#calendar';
        }

        if(selectedValue == 'All'){
            window.location.href='<?php echo base_url();?>dashboard/index#calendar';
        }


    }

function FilterData(DistrictId)
{
	window.location.href='<?php echo base_url();?>dashboard/index?DistrictId='+DistrictId;
}

function FilterDataByTrainer(TrainerId)
{
	window.location.href='<?php echo base_url();?>dashboard/index?TrainerId='+TrainerId;
}



function OpenMaricoDashboard(FunArgument)
{
   // alert(FunArgument);
	var PageURL='<?php base_url();?>/marico/dashboard/HandlePopup';
	var jsObj = JSON.parse(FunArgument);
	//alert(jsObj.PageTitle);
	jQuery('#MaricoModal #ModalLightBody').html('<div class="load-more">Loading...</div>');
	jQuery("#MaricoModal").modal('show');
	jQuery('#ModalLightTitle').html(jsObj.PageTitle);
	jQuery.ajax({
		url : PageURL,
		type: "POST",
		data : {jsObject:FunArgument},
		success: function(response)
		{
			jQuery('#MaricoModal #ModalLightBody').html(response);
			if(jsObj.PageTitle=='Districts')
			{
				jQuery('#MaricoModal .modal-dialog').css('width','40%');
			}
			else if(jsObj.PageTitle=='Picutre&nbsp;Gallery')
			{
				jQuery('#MaricoModal .modal-body').css('height','400px');
                jQuery('#MaricoModal .modal-dialog').css('width','60%');
			}
            else if(jsObj.PageTitle=='Testimonial')
            {
                jQuery('#MaricoModal .modal-body').css('height','400px');
                jQuery('#MaricoModal .modal-dialog').css('width','60%');
            }
			else
			{
				jQuery('#MaricoModal .modal-dialog').css('width','90%');
                jQuery('#MaricoModal .modal-body').css('height','');
			}
			
		}
	});
}

function OpenMaricoDashboardSchool(FunArgument,SchoolType)
{
    //alert(FunArgument);
    //alert(SchoolType);
    var PageURL='<?php base_url();?>/marico/dashboard/HandlePopup';
    var jsObj = JSON.parse(FunArgument);
    //alert(jsObj.PageTitle);
    jQuery('#MaricoModal #ModalLightBody').html('<div class="load-more">Loading...</div>');
    jQuery("#MaricoModal").modal('show');
    jQuery('#ModalLightTitle').html(jsObj.PageTitle);
    jQuery.ajax({
        url : PageURL,
        type: "POST",
        data : {jsObject:FunArgument,SchoolType:SchoolType},
        success: function(response)
        {
            jQuery('#MaricoModal #ModalLightBody').html(response);
            if(jsObj.PageTitle=='Districts')
            {
                jQuery('#MaricoModal .modal-dialog').css('width','40%');
            }
            if(jsObj.PageTitle=='TESTIMONIAL')
            {
                jQuery('#MaricoModal .modal-dialog').css('width','50%');
            }
            else if(jsObj.PageTitle=='Picutre&nbsp;Gallery')
            {
                //jQuery('#MaricoModal .modal-body').css('height','650px');
                jQuery('#MaricoModal .modal-body').css('height','400px');
                jQuery('#MaricoModal .modal-dialog').css('width','60%');
            }
            else
            {
                jQuery('#MaricoModal .modal-dialog').css('width','90%');
            }

        }
    });
}

function getval(sel)
{
    var str = sel.value;

    OpenMaricoDashboardSchool('<?php echo json_encode($SchoolParameter);?>',str)
}

$('#MaricoModal').on("hide.bs.modal", function() {
    //alert("clesn up!").
    if(jQuery("#vid").length) {
        var vid = document.getElementById("vid");
        vid.pause();
    }
    if(jQuery("#aud").length) {
        var aud = document.getElementById("aud");
        aud.pause();
    }
})

    function OpenAssessment(Assessment) {

        //alert(Assessment);

        if (Assessment == 'assessment2') {
            var x = document.getElementById("Assessment2");
            x.style.display = "block";

            var y = document.getElementById("Assessment1");
            y.style.display = "none";


        }

        if (Assessment == 'assessment1') {
            var x = document.getElementById("Assessment1");
            x.style.display = "block";

            var y = document.getElementById("Assessment2");
            y.style.display = "none";


        }
    }
</script>

<?php
include('graph2/touchpoint-graph.php');
include('graph2/touchpoint-monthwise-graph.php');
include('graph2/progress-students-onboard.php');
include('graph2/progress-IVR-module.php');
include('graph2/progress-comparison-gender.php');
include('graph2/progress-comparison-age.php');
include('graph2/comparison-gender-overall.php');
function randomHex() {
   $chars = 'ABCDEF0123456789';
   $color = '#';
   for ( $i = 0; $i < 6; $i++ ) {
      $color .= $chars[rand(0, strlen($chars) - 1)];
   }
   return $color;
}

?>











