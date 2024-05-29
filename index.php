<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>OCR - Pilah Data KTP</title>
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
                  <div class="col-md-6 col-lg-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                        <div class="iq-card-body pb-0">
                           <div class="rounded-circle iq-card-icon iq-bg-primary"><i class="ri-bar-chart-grouped-line"></i></div>
                           <span class="float-right line-height-6">Uploaded</span>
                           <div class="clearfix"></div>
                           <div class="text-center">
                              <h2 class="mb-0"><span class="counter">65</span><span>M</span></h2>
                           </div>
                        </div>
                        <div id="chart-1"></div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height overflow-hidden">
                        <div class="iq-card-body pb-0">
                           <div class="rounded-circle iq-card-icon iq-bg-warning"><i class="ri-bar-chart-grouped-line"></i></div>
                           <span class="float-right line-height-6">Downloaded</span>
                           <div class="clearfix"></div>
                           <div class="text-center">
                              <h2 class="mb-0"><span class="counter">45</span><span>M</span></h2>
                           </div>
                        </div>
                        <div id="chart-2"></div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Order Summary</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <div class="dropdown">
                                 <span class="dropdown-toggle text-primary" id="dropdownMenuButton5" data-toggle="dropdown">
                                 <i class="ri-more-2-fill"></i>
                                 </span>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                    <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                    <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                    <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="table-responsive">
                              <table id="table-ektp" class="table mb-0 table-borderless">
                                 <thead>
                                    <tr>
                                       <th scope="col">NIK</th>
                                       <th scope="col">Nama</th>
                                       <th scope="col">Kelurahan</th>
                                       <th scope="col">Kecamatan</th>
                                       <th scope="col">Status</th>
                                       <th scope="col">Action</th>

                                    </tr>
                                 </thead>
                                 <tbody>
                                    
                                 </tbody>
                              </table>
                           </div>
                           <nav aria-label="Page navigation example">
                              <ul class="pagination justify-content-center" id="pagination">
                                 <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                 </li>
                                 <li class="page-item"><a class="page-link" href="#">1</a></li>
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

         getAllData();

         let currentPage = 1;
         const itemsPerPage = 10;
         let dataCache = [];

         function getAllData() {

            $.ajax({
                url: "ajax.php",
                type: "GET",
                data: { func: 'getAllData' },
                success: function(response) {
                    dataCache = response;
                    setupPagination(dataCache.length, itemsPerPage);
                    displayPage(currentPage);
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
         }

         function setupPagination(totalItems, itemsPerPage) {
                const pagination = $("#pagination");
                pagination.empty();

                const totalPages = Math.ceil(totalItems / itemsPerPage);

                if (currentPage > 1) {
                    const prev = $('<li class="page-item"><a class="page-link">Previous</a></li>');
                    prev.click(function() {
                        currentPage--;
                        displayPage(currentPage);
                    });
                    pagination.append(prev);
                }

                for (let i = 1; i <= totalPages; i++) {
                    const page = $(`<li class="page-item"><a class="page-link">${i}</a></li>`);
                    if (i === currentPage) {
                        page.addClass("active");
                    }
                    page.click(function() {
                        currentPage = i;
                        displayPage(currentPage);
                    });
                    pagination.append(page);
                }

                if (currentPage < totalPages) {
                    const next = $('<li class="page-item"><a class="page-link">Next</a></li>');
                    next.click(function() {
                        currentPage++;
                        displayPage(currentPage);
                    });
                    pagination.append(next);
                }
            }

            function displayPage(page) {
                const tableBody = $("#table-ektp tbody");
                tableBody.empty();

                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const pageData = dataCache.slice(startIndex, endIndex);

                pageData.forEach(item => {
                    const row = createRow(item);
                    tableBody.append(row);
                });

                setupPagination(dataCache.length, itemsPerPage);
            }

            function createRow(data) {
                const tr = document.createElement('tr');

                const tdNik = document.createElement('td');
                tdNik.textContent = data.nik;
                tr.appendChild(tdNik);

                const tdNama = document.createElement('td');
                tdNama.textContent = data.nama;
                tr.appendChild(tdNama);

                const tdKelurahan = document.createElement('td');
                tdKelurahan.textContent = data.address_kel_des;
                tr.appendChild(tdKelurahan);

                const tdKecamatan = document.createElement('td');
                tdKecamatan.textContent = data.address_kec;
                tr.appendChild(tdKecamatan);

                const tdStatus = document.createElement('td');
                const statusBadge = document.createElement('div');
                statusBadge.className = 'badge badge-pill';
                if (data.status === 'downloaded') {
                    statusBadge.classList.add('badge-success');
                    statusBadge.textContent = 'Moving';
                } else {
                    statusBadge.classList.add('badge-primary');
                    statusBadge.textContent = 'Uploaded';
                }
                tdStatus.appendChild(statusBadge);
                tr.appendChild(tdStatus);

                const tdAction = document.createElement('td');

                const downloadBadge = document.createElement('div');
                downloadBadge.className = 'badge badge-pill badge-success';
                downloadBadge.textContent = 'Download';
                tdAction.appendChild(downloadBadge);

                const deleteBadge = document.createElement('div');
                deleteBadge.className = 'badge badge-pill badge-warning';
                deleteBadge.textContent = 'Delete';
                tdAction.appendChild(deleteBadge);

                tr.appendChild(tdAction);

                return tr;
            }

      </script>
   </body>
</html>
