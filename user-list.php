<?php include('page-protection.php') ?>

<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>OCR - User List</title>
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
                           <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                             <thead>
                                 <tr>
                                    <th>Username</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <!-- <tr>
                                    <td>Anna Sthesia</td>
                                    <td>(760) 756 7568</td>
                                    <td>Bandung</td>
                                    <td><span class="badge iq-bg-primary">Active</span></td>
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                                 </tr>  -->
                             </tbody>
                           </table>
                        </div>
                           <div class="row justify-content-between mt-3">
                              <div id="user-list-page-info" class="col-md-6">
                                 <!-- <span>Showing 1 to 5 of 5 entries</span> -->
                              </div>
                              <div class="col-md-6">
                                 <!-- <nav aria-label="Page navigation example">
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
                                 </nav> -->
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

      <script>
         getAllUser();

         function getAllUser() {
            $.ajax({
               url: "ajax-user.php",
               type: "GET",
               data: { func: 'getAllUser' },
               success: function(response) {
                     // Clear existing table rows
                     $('#user-list-table tbody').empty();
                     
                     // Loop through each user data and create a row
                     response.forEach(function(user) {
                        var row = createUserRow(user);
                        $('#user-list-table tbody').append(row);
                     });
               },
               error: function(xhr, status, error) {
                     console.error("Error: " + error);
               }
            });
         }

         function createUserRow(userData) {
            var row = document.createElement('tr');
            
            var usernameCell = document.createElement('td');
            usernameCell.textContent = userData.username;
            row.appendChild(usernameCell);
            
            var phoneCell = document.createElement('td');
            phoneCell.textContent = userData.phone;
            row.appendChild(phoneCell);
            
            var addressCell = document.createElement('td');
            addressCell.textContent = userData.address;
            row.appendChild(addressCell);

            var roleCell = document.createElement('td');
            roleCell.textContent = userData.role;
            row.appendChild(roleCell);
            
            var statusCell = document.createElement('td');
            var statusDiv = document.createElement('div');
            statusDiv.className = 'custom-control custom-switch custom-control-inline';

            var statusInput = document.createElement('input');
            statusInput.type = 'checkbox';
            statusInput.className = 'custom-control-input';
            statusInput.id = 'customSwitch' + userData.username; // Assuming userData.id is unique for each user
            statusInput.checked = userData.status === 'active';

            var statusLabel = document.createElement('label');
            statusLabel.className = 'custom-control-label';
            statusLabel.setAttribute('for', statusInput.id);
            statusLabel.textContent = userData.status === 'active' ? 'Active' : 'Inactive';
            statusInput.onchange = function() {
               handleStatusChange(userData.username, this.checked, statusLabel);
            };

            statusDiv.appendChild(statusInput);
            statusDiv.appendChild(statusLabel);
            statusCell.appendChild(statusDiv);
            row.appendChild(statusCell);
            
            var actionCell = document.createElement('td');
            var actionDiv = document.createElement('div');
            actionDiv.className = 'flex align-items-center list-user-action';
            var editLink = document.createElement('a');
            editLink.setAttribute('href', 'user-edit.php?username=' + userData.username);
            editLink.setAttribute('data-toggle', 'tooltip');
            editLink.setAttribute('data-placement', 'top');
            editLink.setAttribute('title', 'Edit');
            editLink.innerHTML = '<i class="ri-pencil-line"></i>';
            var deleteLink = document.createElement('a');
            deleteLink.setAttribute('href', '#');
            deleteLink.setAttribute('data-toggle', 'tooltip');
            deleteLink.setAttribute('data-placement', 'top');
            deleteLink.setAttribute('title', 'Delete');
            deleteLink.innerHTML = '<i class="ri-delete-bin-line"></i>';
            actionDiv.appendChild(editLink);
            actionDiv.appendChild(deleteLink);
            actionCell.appendChild(actionDiv);
            row.appendChild(actionCell);
            
            return row;
         }

         function handleStatusChange(username, isChecked, statusLabel) {
         var newStatus = isChecked ? 'active' : 'inactive';

         $.ajax({
            type: 'POST',
            url: 'ajax-user.php',
            data: { func:'changeUserStatus', username: username, status: newStatus },
            success: function(response) {
                  var result = JSON.parse(response);
                  if (result.status === 'success') {
                     statusLabel.textContent = newStatus === 'active' ? 'Active' : 'Inactive';
                  } else {
                     alert('Failed to update status');
                     $(`#customSwitch${username}`).prop('checked', !isChecked); // Revert the checkbox state
                  }
            },
            error: function() {
                  alert('Failed to update status');
                  $(`#customSwitch${username}`).prop('checked', !isChecked); // Revert the checkbox state
            }
         });
      }

      </script>
</body>
</html>