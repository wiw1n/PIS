<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Pluto - Responsive Bootstrap Admin Panel Templates</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- site icon -->
      <link rel="icon" href="<?php echo base_url('assets/New/')?>images/logo/logo_icon.png" type="image/png" />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="<?php echo base_url('assets/New/')?>css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="<?php echo base_url('assets/New/')?>style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="<?php echo base_url('assets/New/')?>css/responsive.css" />
      <!-- color css -->
      <!-- <link rel="stylesheet" href="<?php echo base_url('assets/New/')?>css/colors.css" /> -->
      <!-- select bootstrap -->
      <!-- <link rel="stylesheet" href="<?php echo base_url('assets/New/')?>css/bootstrap-select.css" /> -->
      <!-- scrollbar css -->
      <!-- <link rel="stylesheet" href="<?php echo base_url('assets/New/')?>css/perfect-scrollbar.css" /> -->
      <!-- custom css -->
      <!-- <link rel="stylesheet" href="<?php echo base_url('assets/New/')?>css/custom.css" /> -->
      <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.dataTables.css')?>" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="dashboard dashboard_1">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
            <nav id="sidebar">
               <div class="sidebar_blog_1">
                  <div class="sidebar-header">
                     <div class="logo_section">
                        <a href="index.html"><img class="logo_icon img-responsive" src="<?php echo base_url('assets/New/')?>images/logo/logo_icon.png" alt="#" /></a>
                     </div>
                  </div>
                  <div class="sidebar_user_info">
                     <div class="icon_setting"></div>
                     <div class="user_profle_side">
                        <div class="user_img"><img class="img-responsive" src="<?php echo base_url('assets/New/')?>images/layout_img/user_img.jpg" alt="#" /></div>
                        <div class="user_info">
                           <h6><?php echo $this->session->userdata('name')?></h6>
                           <p><span class="online_animation"></span> Online</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sidebar_blog_2">
                  <h4>General</h4>                  
                  <ul class="list-unstyled components">
							<li><a href="<?php echo base_url('main/dashboard')?>"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a></li> 
                     <li><a href="<?php echo base_url('main/listOfEquipment')?>"><i class="fa fa-desktop red_color"></i> <span>List of Equipment</span></a></li>                                         
							<?php if ($this->session->userdata('role') == 0): ?>                        
                        <li><a href="<?php echo base_url('main/IPAdressesAllocation')?>"><i class="fa fa-wifi blue1_color"></i> <span>IP Management</span></a></li>                     
                        <li><a href="<?php echo base_url('main/registeredUsers')?>"><i class="fa fa-users purple_color"></i> <span>Users</span></a></li>                    
                        <li><a href="<?php echo base_url('main/listOfOffices')?>"><i class="fa fa-institution yellow_color"></i> <span>Offices</span></a></li>                    
                        <li><a href="<?php echo base_url('main/ppeAccountGroup')?>"><i class="fa fa-square green_color"></i> <span>PPE Account Group</span></a></li>                    
                     <?php endif; ?>
                  </ul>
               </div>
            </nav>
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
               <div class="topbar">
                  <nav class="navbar navbar-expand-lg navbar-light">
                     <div class="full">
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                        <div class="logo_section">
                           <a href="<?php echo base_url('main/dashboard')?>"><img class="img-responsive" src="<?php echo base_url('assets/New/')?>images/logo/logo.png" alt="#" /></a>
                        </div>
                        <div class="right_topbar">
                           <div class="icon_info">
                              <!-- <ul>
                                 <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge">2</span></a></li>
                                 <li><a href="#"><i class="fa fa-question-circle"></i></a></li>
                                 <li><a href="#"><i class="fa fa-envelope-o"></i><span class="badge">3</span></a></li>
                              </ul> -->
                              <ul class="user_profile_dd">
                                 <li>
                                    <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="<?php echo base_url('assets/New/')?>images/layout_img/user_img.jpg" alt="#" /><span class="name_user"><?php echo $this->session->userdata('name')?></span></a>
                                    <div class="dropdown-menu">
                                       <!-- <a class="dropdown-item" href="profile.html">My Profile</a>
                                       <a class="dropdown-item" href="settings.html">Settings</a>
                                       <a class="dropdown-item" href="help.html">Help</a> -->
                                       <a class="dropdown-item" href="<?php echo base_url("user/logout")?>"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </nav>
               </div>
               <!-- end topbar -->