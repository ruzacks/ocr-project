<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Sofbox - Responsive Bootstrap 4 Admin Dashboard Template</title>
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
            <div class="col-sm-12">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">User List</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <div class="row justify-content-between">
                              <div class="col-sm-12 col-md-6">
                                 <div id="user_list_datatable_info" class="dataTables_filter">
                                    <form class="mr-3 position-relative">
                                       <div class="form-group mb-0">
                                          <input type="search" class="form-control" id="exampleInputSearch" placeholder="Search" aria-controls="user-list-table">
                                       </div>
                                    </form>
                                 </div>
                              </div>
                              <div class="col-sm-12 col-md-6">
                                 <div class="user-list-files d-flex float-right">
                                    <a href="javascript:void();" class="chat-icon-phone">
                                       Print
                                     </a>
                                    <a href="javascript:void();" class="chat-icon-video">
                                       Excel
                                     </a>
                                     <a href="javascript:void();" class="chat-icon-delete">
                                       Pdf
                                     </a>
                                   </div>
                              </div>
                           </div>
                           <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                             <thead>
                                 <tr>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th>Company</th>
                                    <th>Join Date</th>
                                    <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr>
                                    <td class="text-center"><img class="rounded-circle img-fluid avatar-40" src="images/user/01.jpg" alt="profile"></td>
                                    <td>Anna Sthesia</td>
                                    <td>(760) 756 7568</td>
                                    <td>annasthesia@gmail.com</td>
                                    <td>USA</td>
                                    <td><span class="badge iq-bg-primary">Active</span></td>
                                    <td>Acme Corporation</td>
                                    <td>2019/12/01</td>
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Add" href="#"><i class="ri-user-add-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                                 </tr> 
                                 <tr>
                                    <td class="text-center"><img class="rounded-circle img-fluid avatar-40" src="images/user/02.jpg" alt="profile"></td>
                                    <td>Brock Lee</td>
                                    <td>+62 5689 458 658</td>
                                    <td>brocklee@gmail.com</td>
                                    <td>Indonesia</td>
                                    <td><span class="badge iq-bg-primary">Active</span></td>
                                    <td>Soylent Corp</td>
                                    <td>2019/12/01</td>
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Add" href="#"><i class="ri-user-add-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                                 </tr> 
                                 <tr>
                                    <td class="text-center"><img class="rounded-circle img-fluid avatar-40" src="images/user/03.jpg" alt="profile"></td>
                                    <td>Dan Druff</td>
                                    <td>+55 6523 456 856</td>
                                    <td>dandruff@gmail.com</td>
                                    <td>Brazil</td>
                                    <td><span class="badge iq-bg-warning">Pending</span></td>
                                    <td>Umbrella Corporation</td>
                                    <td>2019/12/01</td>
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Add" href="#"><i class="ri-user-add-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="text-center"><img class="rounded-circle img-fluid avatar-40" src="images/user/04.jpg" alt="profile"></td>
                                    <td>Hans Olo</td>
                                    <td>+91 2586 253 125</td>
                                    <td>hansolo@gmail.com</td>
                                    <td>India</td>
                                    <td><span class="badge iq-bg-danger">Inactive</span></td>
                                    <td>Vehement Capital</td>
                                    <td>2019/12/01</td>
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Add" href="#"><i class="ri-user-add-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                                 </tr> 
                                 <tr>
                                    <td class="text-center"><img class="rounded-circle img-fluid avatar-40" src="images/user/05.jpg" alt="profile"></td>
                                    <td>Lynn Guini</td>
                                    <td>+27 2563 456 589</td>
                                    <td>lynnguini@gmail.com</td>
                                    <td>Africa</td>
                                    <td><span class="badge iq-bg-primary">Active</span></td>
                                    <td>Massive Dynamic</td>
                                    <td>2019/12/01</td>
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Add" href="#"><i class="ri-user-add-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                                 </tr> 
                                 <tr>
                                    <td class="text-center"><img class="rounded-circle img-fluid avatar-40" src="images/user/06.jpg" alt="profile"></td>
                                    <td>Eric Shun</td>
                                    <td>+55 25685 256 589</td>
                                    <td>ericshun@gmail.com</td>
                                    <td>Brazil</td>
                                    <td><span class="badge iq-bg-warning">Pending</span></td>
                                    <td>Globex Corporation</td>
                                    <td>2019/12/01</td>
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Add" href="#"><i class="ri-user-add-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="text-center"><img class="rounded-circle img-fluid avatar-40" src="images/user/07.jpg" alt="profile"></td>
                                    <td>aaronottix</td>
                                    <td>(760) 765 2658</td>
                                    <td>budwiser@ymail.com</td>
                                    <td>USA</td>
                                    <td><span class="badge iq-bg-info">Hold</span></td>
                                    <td>Acme Corporation</td>
                                    <td>2019/12/01</td>
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Add" href="#"><i class="ri-user-add-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                                 </tr> 
                                 <tr>
                                    <td class="text-center"><img class="rounded-circle img-fluid avatar-40" src="images/user/08.jpg" alt="profile"></td>
                                    <td>Marge Arita</td>
                                    <td>+27 5625 456 589</td>
                                    <td>margearita@gmail.com</td>
                                    <td>Africa</td>
                                    <td><span class="badge iq-bg-success">Complite</span></td>
                                    <td>Vehement Capital</td>
                                    <td>2019/12/01</td>
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Add" href="#"><i class="ri-user-add-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                                 </tr> 
                                 <tr>
                                    <td class="text-center"><img class="rounded-circle img-fluid avatar-40" src="images/user/09.jpg" alt="profile"></td>
                                    <td>Bill Dabear</td>
                                    <td>+55 2563 456 589</td>
                                    <td>billdabear@gmail.com</td>
                                    <td>Brazil</td>
                                    <td><span class="badge iq-bg-primary">active</span></td>
                                    <td>Massive Dynamic</td>
                                    <td>2019/12/01</td>
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Add" href="#"><i class="ri-user-add-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                                 </tr>                               
                             </tbody>
                           </table>
                        </div>
                           <div class="row justify-content-between mt-3">
                              <div id="user-list-page-info" class="col-md-6">
                                 <span>Showing 1 to 5 of 5 entries</span>
                              </div>
                              <div class="col-md-6">
                                 <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end mb-0">
                                       <li class="page-item disabled">
                                          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                       </li>
                                       <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                       <li class="page-item"><a class="page-link" href="#">2</a></li>
                                       <li class="page-item"><a class="page-link" href="#">3</a></li>
                                       <li class="page-item">
                                          <a class="page-link" href="#">Next</a>
                                       </li>
                                    </ul>
                                 </nav>
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