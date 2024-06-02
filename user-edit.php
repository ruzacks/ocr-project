<?php include('page-protection.php') ?>
<?php include('connection.php') ?>
<?php
  $conn = getConn();
  $username = mysqli_escape_string($conn, $_GET['username']);

  if($_SESSION['role'] !== 'administrator'){
   if($username != $_SESSION['username']){
      header("Location: not-found.php");
      exit();
   }
  }

  $sql = "SELECT username, phone, address, role FROM users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);

  $user = mysqli_fetch_object($result);

  if(!$user){
     header("Location: not-found.php");
     exit();
  }

?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>OCR - User Edit</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css">
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
            <div class="loader">
               <div class="cube">
                  <div class="sides">
                     <div class="top"></div>
                     <div class="right"></div>
                     <div class="bottom"></div>
                     <div class="left"></div>
                     <div class="front"></div>
                     <div class="back"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         <?php include ('sidebar.php') ?>
         <!-- TOP Nav Bar -->
         <?php include ('navbar.php') ?>
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="iq-card">
                        <div class="iq-card-body p-0">
                           <div class="iq-edit-list">
                              <ul class="iq-edit-profile d-flex nav nav-pills">
                                 <li class="col-md-6 p-0">
                                    <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                       Personal Information
                                    </a>
                                 </li>
                                 <li class="col-md-6 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#chang-pwd">
                                       Change Password
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="iq-edit-list-data">
                        <div class="tab-content">
                           <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                               <div class="iq-card">
                                 <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                       <h4 class="card-title">Personal Information</h4>
                                    </div>
                                 </div>
                                 <div class="iq-card-body">
                                 <?php $error = isset($_GET['error']) ? $_GET['error'] : ''; ?>
                                 <div class="alert alert-danger" role="alert" <?php echo empty($error) ? 'hidden' : ''; ?>>
                                    <div class="iq-alert-text"><?php echo $error; ?></div>
                                 </div>
                                 <?php $succeed = isset($_GET['success']) ? $_GET['success'] : ''; ?>
                                 <div class="alert alert-success" role="alert" <?php echo empty($succeed) ? 'hidden' : ''; ?>>
                                    <div class="iq-alert-text"><?php echo $succeed; ?></div>
                                 </div>
                                 <form action="ajax-user.php" method="POST">
                                    <div class="row align-items-center">
                                       <div class="form-group col-sm-6">
                                             <label for="username">Username</label>
                                             <input type="text" class="form-control" id="username" name="username" readonly value="<?php echo $user->username; ?>">
                                       </div>
                                       <div class="form-group col-sm-6">
                                             <label for="phone">Hand Phone</label>
                                             <input type="text" class="form-control" id="phone" name="phone" required value="<?php echo $user->phone; ?>">
                                       </div>
                                       <div class="form-group col-sm-6">
                                             <label for="role">Role</label>
                                             <select class="form-control" id="role" name="role" required>
                                                <option selected="" disabled="">Select Role</option>
                                                <option value="administrator" <?= ($user->role == 'administrator') ? 'selected' : ''; ?>>Administrator</option>
                                                <option value="checker" <?= ($user->role == 'checker') ? 'selected' : ''; ?>>Checker</option>
                                                <option value="operator" <?= ($user->role == 'operator') ? 'selected' : ''; ?>>Operator</option>
                                             </select>
                                       </div>
                                       <div class="form-group col-sm-12">
                                             <label>Address:</label>
                                             <textarea class="form-control" name="address" rows="5" style="line-height: 22px;"><?php echo $user->address; ?></textarea>
                                       </div>
                                    </div>
                                    <input type="hidden" name="func" value="editUser">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="reset" class="btn iq-bg-danger">Cancel</button>
                                 </form>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="chang-pwd" role="tabpanel">
                               <div class="iq-card">
                                 <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                       <h4 class="card-title">Change Password</h4>
                                    </div>
                                 </div>
                                 <div class="iq-card-body">
                                    <form action="ajax-user.php" method="POST">
                                       <div class="form-group">
                                          <label for="cpass">Current Password:</label>
                                          <a href="javascripe:void();" class="float-right">Reset Password</a>
                                             <input type="Password" class="form-control" id="cpass" name="cpass" value="">
                                          </div>
                                       <div class="form-group">
                                          <label for="npass">New Password:</label>
                                          <input type="Password" class="form-control" id="npass" name="npass" value="">
                                       </div>
                                       <div class="form-group">
                                          <label for="vpass">Verify Password:</label>
                                             <input type="Password" class="form-control" id="vpass" name="vpass" value="">
                                       </div>
                                       <input type="hidden" name="func" value="changePassword">
                                       <input type="hidden" name="username" value="<?php echo $user->username ?>">
                                       <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                       <button type="reset" class="btn iq-bg-danger">Cancel</button>
                                    </form>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Wrapper END -->
      <!-- Footer -->
      <footer class="bg-white iq-footer">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-6">
                  <ul class="list-inline mb-0">
                     <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                     <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                  </ul>
               </div>
               <div class="col-lg-6 text-right">
                  Copyright 2020 <a href="#">Sofbox</a> All Rights Reserved.
               </div>
            </div>
         </div>
      </footer>
      <!-- Footer END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="js/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="js/smooth-scrollbar.js"></script>
      <!-- lottie JavaScript -->
      <script src="js/lottie.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>
   </body>
</html>