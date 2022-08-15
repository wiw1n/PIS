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
      <title>Palo Inventory System</title>
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
      <link rel="stylesheet" href="<?php echo base_url('assets/New/')?>css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="<?php echo base_url('assets/New/')?>css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="<?php echo base_url('assets/New/')?>css/custom.css" />
      <!-- calendar file css -->
      <link rel="stylesheet" href="<?php echo base_url('assets/New/')?>js/semantic.min.js" />
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body class="inner_page login">
      <div class="full_container">
         <div class="container">
            <div class="center verticle_center full_height">
               <div class="login_section">
                  <div class="logo_login">
                     <div class="center">
                        <img width="210" src="<?php echo base_url('assets/New/')?>images/logo/logo.png" alt="#" />
                     </div>
                  </div>
                  <div class="login_form">
                     <form id="formLogin">
                        <fieldset>
                           <div class="field">
                              <label class="label_field">ID Number</label>
                              <input type="text" name="username" placeholder="ID Number" required/>
                           </div>
                           <div class="field">
                              <label class="label_field">Password</label>
                              <input type="password" name="password" placeholder="Password" required/>
                           </div>
                           <!-- <div class="field">
                              <label class="label_field hidden">hidden label</label>
                              <label class="form-check-label"><input type="checkbox" class="form-check-input"> Remember Me</label>
                              <a class="forgot" href="">Forgotten Password?</a>
                           </div> -->
                           <div class="field margin_0">
                              <label class="label_field hidden">hidden label</label>
                              <input type="submit" name="submit" class="main_bt" value="Sign In"/>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <script src="<?php echo base_url('assets/')?>js/jquery.min.js"></script>
      <script src="<?php echo base_url('assets/New/')?>js/popper.min.js"></script>
      <script src="<?php echo base_url('assets/New/')?>js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="<?php echo base_url('assets/New/')?>js/animate.js"></script>
      <!-- select country -->
      <script src="<?php echo base_url('assets/New/')?>js/bootstrap-select.js"></script>
      <!-- nice scrollbar -->
      <script src="<?php echo base_url('assets/New/')?>js/perfect-scrollbar.min.js"></script>
      <!-- <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script> -->
      <!-- custom js -->
      <!-- <script src="<?php echo base_url('assets/New/')?>js/custom.js"></script> -->
      <script src="<?php echo base_url('assets/js/login.js')?>"></script>
   </body>
</html>