<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Marico - CSR</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/marico.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<!--    <link href="https://synergieinsights.com/csr/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />-->

  <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <script src= "<?php echo base_url(); ?>assets/externalJS/angular.min.js"></script>
  
  <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
  
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<?php
$SessionData=$this->session->userdata("loginUserData");
?>
<!-- Site wrapper -->
<div class="wrapper" ng-app="CsrModel" ng-controller="CsrController">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" <?php if($_GET['view'] == 'no'){ echo 'style="display: none;"';}?>>
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javaScript:void(0)">
          <i class="far fa-user"></i> Welcome <?php echo ucfirst($SessionData['FirstName']);?>!
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <i class="far fa-user"></i> My Profile
          </a>
          <div class="dropdown-divider"></div>
            <a href="<?php echo base_url(); ?>dashboard/ChangePassword" class="dropdown-item">
                <i class="fas fa-lock"></i> Change Password
            </a>
            <div class="dropdown-divider"></div>
          
          <a href="<?php echo base_url(); ?>login/logout" class="dropdown-item">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
          
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" <?php if($_GET['view'] == 'no'){ echo 'style="display: none;"';}?>>
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>dashboard/index" class="brand-link">
      <img src="<?php echo base_url(); ?>assets/img/logo-2.jpg"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Marico</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
         
          
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard/index" class="nav-link">
                  <i class="fas fa-home"></i>  
                  <p>Dashboard</p>
                </a>
              </li>

            <?php
            //print_r($SessionData);
            if($SessionData['UserGroupId'] == 4) {
                ?>
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>mapping/MappingList" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <p>Mapping</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>testimonial/TestimonialList" class="nav-link">
                        <i class="fa fa-star"></i>
                        <p>Testimonial</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>district/GalleryList" class="nav-link">
                        <i class="fas fa-images"></i>
                        <p>Gallery</p>
                    </a>
                </li>

            <?php } ?>

            <?php
            //print_r($SessionData);
            if($SessionData['UserGroupId'] == 2) {
            ?>
                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>dashboard/ProjectView" class="nav-link">
                        <i class="fas fa-project-diagram"></i>
                        <p>Project Setup</p>
                    </a>
                </li>

            <?php } ?>


            <?php
            //print_r($SessionData);
            if($SessionData['UserGroupId'] == 3){
            ?>


                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>dashboard/ProjectView" class="nav-link">
                        <i class="fas fa-project-diagram"></i>
                        <p>Project View</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>district/DistrictList" class="nav-link">
                        <i class="fas fa-network-wired"></i>
                        <p>District</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>block/BlockList" class="nav-link">
                        <i class="fas fa-th-large"></i>
                        <p>Block</p>
                    </a>
                </li>
                
            <li class="nav-item">
                <a href="<?php echo base_url(); ?>mapping/MappingList" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <p>Mapping</p>
                </a>
            </li>

                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>activity/ActivityList?Type=Training" class="nav-link">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Activity</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>online/TrainnerSchool" class="nav-link">
                        <i class="fas fa-chalkboard"></i>
                        <p>Online Training</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>event/EventList" class="nav-link">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>Event</p>
                    </a>
                </li>
            

                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>user/UserList" class="nav-link">
                        <i class="fas fa-user"></i>
                        <p>User</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href='javaScript:void(0)' class="nav-link ">
                        <i class="fas fa-chart-bar"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="display: none;">

                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>report/AssessmentReport" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Assessment Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>report/OnlineAssessmentReport" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Online Assessment Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>report/OnlineAssessmentTwoReport" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Online Assessment2 Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>report/AttendanceReport" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Attendance Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>online/OnlineTrainingReport" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Online Training Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>report/OnlineTrainingDateWise" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Online Training Report Date wise</p>
                            </a>
                        </li>

                            <li class="nav-item">
                                <a href="<?php echo base_url(); ?>report/StudentReportCard" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Student Report Card</p>
                                </a>
                            </li>

                    </ul>
                </li>

            <?php } ?>

            <?php
            $SessionData=$this->session->userdata("loginUserData");
            //print_r($SessionData);
            if($SessionData['UserGroupId'] == 5){
            ?>
              

              <li class="nav-item">
                <a href="<?php echo base_url(); ?>village/VillageList" class="nav-link">
                  <i class="fas fa-home"></i>
                  <p>Villages</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>school/SchoolList" class="nav-link">
                  <i class="fas fa-school"></i>
                  <p>Schools</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>student/StudentList" class="nav-link">
                  <i class="fas fa-user-graduate"></i>
                  <p>Students</p>
                </a>
              </li>

            <li class="nav-item">
                <a href="<?php echo base_url(); ?>activity/ActivityList?Type=Training" class="nav-link">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <p>Activity</p>
                </a>
            </li>


                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>online/TrainnerSchool" class="nav-link">
                        <i class="fas fa-chalkboard"></i>
                        <p>Online Training</p>
                    </a>
                </li>


                <li class="nav-item">
                <a href="<?php echo base_url(); ?>district/GalleryList" class="nav-link">
                    <i class="fas fa-images"></i>
                    <p>Gallery</p>
                </a>
            </li>

<!--                <li class="nav-item">-->
<!--                    <a href="--><?php //echo base_url(); ?><!--meeting/MeetingList" class="nav-link">-->
<!--                        <i class="fas fa-handshake"></i>-->
<!--                        <p>Meeting</p>-->
<!--                    </a>-->
<!--                </li>-->

                <li class="nav-item">
                    <a href="<?php echo base_url(); ?>testimonial/TestimonialList" class="nav-link">
                        <i class="fa fa-star"></i>
                        <p>Testimonial</p>
                    </a>
                </li>



                <li class="nav-item has-treeview">
                    <a href="javaScript:void(0)" class="nav-link ">
                        <i class="fas fa-chart-bar"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview" style="display: none;">

                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>report/AssessmentReport" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Assessment Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>report/OnlineAssessmentReport" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Online Assessment Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>report/AttendanceReport" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Attendance Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url(); ?>online/OnlineTrainingReport" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Online Training Report</p>
                            </a>
                        </li>

                    </ul>
                </li>

               <!-- <li class="nav-item">
                    <a href="<?php echo base_url(); ?>assigned/AssignedList" class="nav-link">
                        <i class="fas fa-sitemap"></i>
                        <p>Assigned School</p>
                    </a>
                </li>-->
              
              
            <?php } ?>
          
          
          
          
          
         
         
        
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>





  