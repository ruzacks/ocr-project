<?php include('page-protection.php') ?>

<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>OCR - Data Input</title>
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

      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
      <link href="https://cdn.jsdelivr.net/gh/tapmodo/Jcrop@0.9.12/css/jquery.Jcrop.min.css" rel="stylesheet" />
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
                 <div class="col-sm-12 col-lg-6 order-2 order-lg-1">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">Upload Data</h4>
                        </div>
                     </div>
                     <div class="iq-card-body">
                        <form id="dataForm">
                           <div class="form-group">
                              <label for="phone">No Handpone</label>
                              <input type="text" class="form-control" id="phone" name="phone">
                           </div>
                           <div class="form-group">
                              <label for="nik">NIK</label>
                              <input type="text" class="form-control" id="nik" name="nik" required>
                           </div>
                           <div class="form-group">
                              <label for="nama">NAMA</label>
                              <input type="text" class="form-control" id="nama" name="nama" required>
                           </div>
                           <div class="form-group">
                              <label for="birth_place">Tempat Lahir</label>
                              <input type="text" class="form-control" id="birth_place" name="birth_place" required>
                           </div>
                           <div class="form-group">
                              <label for="birth_date">Tanggal Lahir</label>
                              <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                           </div>
                           <div class="form-group">
                              <label for="gender">Jenis Kelamin</label>
                              <div class="form-check">
                                 <input type="radio" class="form-check-input" id="gender-laki" name="gender" value="laki-laki" required>
                                 <label class="form-check-label" for="gender-laki">Laki-laki</label>
                              </div>
                              <div class="form-check">
                                 <input type="radio" class="form-check-input" id="gender-perempuan" name="gender" value="perempuan" required>
                                 <label class="form-check-label" for="gender-perempuan">Perempuan</label>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="address">Alamat</label>
                              <input type="text" class="form-control" id="address" name="address" required>
                           </div>
                           <div class="form-group">
                              <label for="address_rt">RT</label>
                              <input type="text" class="form-control" id="address_rt" name="address_rt" required>
                           </div>
                           <div class="form-group">
                              <label for="address_rw">RW</label>
                              <input type="text" class="form-control" id="address_rw" name="address_rw" required>
                           </div>
                           <div class="form-group">
                              <label for="address_kel_des">Kel/Desa</label>
                              <input type="text" class="form-control" id="address_kel_des" name="address_kel_des" required>
                           </div>
                           <div class="form-group">
                              <label for="address_kec">Kecamatan</label>
                              <input type="text" class="form-control" id="address_kec" name="address_kec" required>
                           </div>
                           <div class="form-group">
                              <label for="religion">Agama</label>
                              <input type="text" class="form-control" id="religion" name="religion" required>
                           </div>
                           <div class="form-group">
                              <label for="married_status">Status Perkawinan</label>
                              <input type="text" class="form-control" id="married_status" name="married_status" required>
                           </div>
                           <div class="form-group">
                              <label for="job">Pekerjaan</label>
                              <input type="text" class="form-control" id="job" name="job" required>
                           </div>
                           <div class="form-group">
                              <label for="national">Kewarganegaraan</label>
                              <input type="text" class="form-control" id="national" name="national" required>
                           </div>
                           <textarea name="" id="responseText" hidden></textarea>
                           <button type="submit" class="btn btn-primary">Upload</button>
                           <button type="button" class="btn iq-bg-danger" id="resetButton">Reset</button>
                     </form>
                     </div>
                  </div>
               </div>
               <div class="col-sm-12 col-lg-6 order-1 order-lg-2 sticky-card">
                  <div class="iq-card">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title">E-KTP</h4>
                        </div>
                        <span class="table-add float-right">
                        <a type="button" class="btn iq-bg-primary btn-rounded btn-sm my-0" onclick="document.getElementById('imageInput').click();">Take A Photo</a>
                        <input type="file" id="imageInput" hidden accept="image/*" capture>
                        </span>
                     </div>
                     <div class="iq-card-body">
                        <div class="row mt-4">
                           <div class="col-lg-12 col-md-6 text-center canvas-container">
                              <p class="iq-bg-secondary pt-5 pb-5 text-center rounded font-size-18" id="frame-template" onclick="document.getElementById('imageInput').click();" style="cursor:pointer">Take A Photo</p>
                              <img id="imagePreview" src="" style="display: none; width: 100%; height: auto;">
                              <img id="imagePreview2" src="" hidden>
                              <img id="imagePreview3" src="" hidden>
                              <!-- <button id="cropButton">Crop</button> -->
                              <a type="button" class="btn iq-bg-success btn-rounded btn-sm my-0" id="scan-button" style="display: none;" onclick="uploadAndProcessImage()">Scan</a>

                              
                           </div>
                        </div>
                        <div class="form-group" id="add_1" style="display: none;">
                           <label for="file_b1" style="text-align: start;">Upload foto tambahan 1</label>
                           <input type="file" class="form-control-file" id="file_b1">
                        </div>

                        <div class="form-group" id="add_2" style="display: none;">
                           <label for="file_additional">Foto Tambahan 2</label>
                           <input type="file" class="form-control-file" id="file_additional">
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

      <!-- Jcrop -->
      <script src="https://cdn.jsdelivr.net/gh/tapmodo/Jcrop@0.9.12/js/jquery.Jcrop.min.js"></script>
      <!-- SweetAlert -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      
      <script>
         $(document).ready(function() {

            var coorDinates = null;

            //RESET FORM
            $('#resetButton').on('click', function() {
                resetForm();
            });

            function resetForm(){
               $('#dataForm')[0].reset();
                $('#file_b1').val('');
                // $('#file_additional').val('');
                $('#imageInput').val('');
                $('#add_1').hide();
                $('#add_2').hide();

                $('#frame-template').show();
                $('#scan-button').hide();
                $('#imageCanvas').hide();
                $('#imagePreview').attr('src', '').hide();
                $('#imagePreview2').attr('src', '').hide();
                $('#imagePreview3').attr('src', '').hide();
            }

            // Function to get the image data from the canvas
            function getCanvasImage() {
                const canvas = document.getElementById('imageCanvas');
                return canvas.toDataURL('image/png');
            }

            function dataURItoBlob(dataURI) {
               const byteString = atob(dataURI.split(',')[1]);
               const mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
               const ab = new ArrayBuffer(byteString.length);
               const ia = new Uint8Array(ab);
               for (let i = 0; i < byteString.length; i++) {
                  ia[i] = byteString.charCodeAt(i);
               }
               return new Blob([ab], { type: mimeString });
            }

            function getImageDataFromImgTag(imageTagId) {
               const imageElement = $(`#${imageTagId}`)[0];
               const dataURI = imageElement.src;
               // Convert data URI to Blob
               const blob = dataURItoBlob(dataURI);
               return blob;
            }

            //SUBMIT FORM
            // Form submission with AJAX
            $('#dataForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                const formData = new FormData(this); // Use FormData to handle file uploads

                // Get image data from #imagePreview
                if ($('#imagePreview1').attr('src') === '') {
                   swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: 'Mohon upload KTP.',
                     });
                     return; // Exit the function if imageData1 is null
                  }
                  const imageData1 = getImageDataFromImgTag('imagePreview');
               formData.append('e_ktp', imageData1, 'e_ktp.jpg');

               if ($('#imagePreview2').attr('src') === '') {
                  swal.fire({
                     icon: 'error',
                     title: 'Error',
                     text: 'Mohon upload file b1.',
                  });
                  return; // Exit the function if imageData2 is null
               }
               const imageData2 = getImageDataFromImgTag('imagePreview2');
               formData.append('file_b1', imageData2, 'file_b1.jpg');

               // if ($('#imagePreview3').attr('src') === '') {
               //    swal.fire({
               //       icon: 'error',
               //       title: 'Error',
               //       text: 'Mohon upload file tambahan.',
               //    });
               //    return; // Exit the function if imageData3 is null
               // }
               // const imageData3 = getImageDataFromImgTag('imagePreview3');
               // formData.append('additional_file', imageData3, 'additional_file.jpg');

                $.ajax({
                    url: 'upload.php', // Endpoint to send the form data
                    type: 'POST',
                    data: formData,
                    contentType: false, // Required for FormData
                    processData: false, // Required for FormData
                    success: function(response) {
                        // Handle success response
                       Swal.fire({
                           icon: response.status,
                           title: response.message,
                           timer: 1500
                       });
                       if(response.status == "success"){
                           resetForm();
                       }
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        Swal.fire({
                           icon: "error",
                           title: response.message,
                           // timer: 1000
                       });
                    }
                });
            });

            $('#imageInput').on('change', function(event) {
               const file = event.target.files[0];

               if (!file) return;

               // Hide the frame template and show the other elements
               $('#frame-template').hide();
               $('#scan-button').show();
               $('#add_1').show();
               $('#add_2').show();

               const reader = new FileReader();
               reader.onload = function(event) {
                  const img = new Image();
                  img.onload = function() {
                        // Create an off-screen canvas
                        const canvas = document.createElement('canvas');
                        const context = canvas.getContext('2d');

                        // Define the desired dimensions for the image
                        const maxWidth = 800;  // Maximum width
                        const maxHeight = 800; // Maximum height

                        // Calculate the aspect ratio
                        const aspectRatio = img.width / img.height;
                        
                        // Calculate the new dimensions maintaining the aspect ratio
                        let newWidth = img.width;
                        let newHeight = img.height;

                        if (newWidth > maxWidth || newHeight > maxHeight) {
                           if (newWidth / maxWidth > newHeight / maxHeight) {
                              newWidth = maxWidth;
                              newHeight = maxWidth / aspectRatio;
                           } else {
                              newHeight = maxHeight;
                              newWidth = maxHeight * aspectRatio;
                           }
                        }

                        // Set canvas dimensions to the new dimensions
                        canvas.width = newWidth;
                        canvas.height = newHeight;

                        // Draw the image on the canvas with the new dimensions
                        context.drawImage(img, 0, 0, newWidth, newHeight);

                        // Convert the canvas content to a data URL and set it as the source of the img element
                        const resizedDataUrl = canvas.toDataURL('image/jpeg');
                        $('#imagePreview').attr('src', resizedDataUrl).show();
                  };
                  img.src = event.target.result;
               };
               reader.readAsDataURL(file);
            });

            $('#file_b1').on('change', function(event) {
               const file = event.target.files[0];

               if (!file) return;

               const reader = new FileReader();
               reader.onload = function(event) {
                  const img = new Image();
                  img.onload = function() {
                        // Create an off-screen canvas
                        const canvas = document.createElement('canvas');
                        const context = canvas.getContext('2d');

                        // Define the desired dimensions for the image
                        const maxWidth = 800;  // Maximum width
                        const maxHeight = 800; // Maximum height

                        // Calculate the aspect ratio
                        const aspectRatio = img.width / img.height;
                        
                        // Calculate the new dimensions maintaining the aspect ratio
                        let newWidth = img.width;
                        let newHeight = img.height;

                        if (newWidth > maxWidth || newHeight > maxHeight) {
                           if (newWidth / maxWidth > newHeight / maxHeight) {
                              newWidth = maxWidth;
                              newHeight = maxWidth / aspectRatio;
                           } else {
                              newHeight = maxHeight;
                              newWidth = maxHeight * aspectRatio;
                           }
                        }

                        // Set canvas dimensions to the new dimensions
                        canvas.width = newWidth;
                        canvas.height = newHeight;

                        // Draw the image on the canvas with the new dimensions
                        context.drawImage(img, 0, 0, newWidth, newHeight);

                        // Convert the canvas content to a data URL and set it as the source of the img element
                        const resizedDataUrl = canvas.toDataURL('image/jpeg');
                        $('#imagePreview2').attr('src', resizedDataUrl).show();
                  };
                  img.src = event.target.result;
               };
               reader.readAsDataURL(file);
            });

            $('#file_additional').on('change', function(event) {
               const file = event.target.files[0];

               if (!file) return;

               const reader = new FileReader();
               reader.onload = function(event) {
                  const img = new Image();
                  img.onload = function() {
                        // Create an off-screen canvas
                        const canvas = document.createElement('canvas');
                        const context = canvas.getContext('2d');

                        // Define the desired dimensions for the image
                        const maxWidth = 800;  // Maximum width
                        const maxHeight = 800; // Maximum height

                        // Calculate the aspect ratio
                        const aspectRatio = img.width / img.height;
                        
                        // Calculate the new dimensions maintaining the aspect ratio
                        let newWidth = img.width;
                        let newHeight = img.height;

                        if (newWidth > maxWidth || newHeight > maxHeight) {
                           if (newWidth / maxWidth > newHeight / maxHeight) {
                              newWidth = maxWidth;
                              newHeight = maxWidth / aspectRatio;
                           } else {
                              newHeight = maxHeight;
                              newWidth = maxHeight * aspectRatio;
                           }
                        }

                        // Set canvas dimensions to the new dimensions
                        canvas.width = newWidth;
                        canvas.height = newHeight;

                        // Draw the image on the canvas with the new dimensions
                        context.drawImage(img, 0, 0, newWidth, newHeight);

                        // Convert the canvas content to a data URL and set it as the source of the img element
                        const resizedDataUrl = canvas.toDataURL('image/jpeg');
                        $('#imagePreview3').attr('src', resizedDataUrl).show();
                  };
                  img.src = event.target.result;
               };
               reader.readAsDataURL(file);
            });

             // Button click event handler for cropping
             $('#cropButton').on('click', function() {
            // Get the canvas and image
            const canvas = $('#imageCanvas')[0];
            const context = canvas.getContext('2d');
            const img = new Image();
            img.onload = function() {
                // Get the JCrop API
               //  const jcropAPI = $.Jcrop('#imageCanvas').data('Jcrop');

               $('#imageCanvas').Jcrop({
                  onSelect: function(c) {
                     console.log('Selected coordinates:', c);
                     coorDinates = c;
                  },
               });
                
                // Get the selected area coordinates
                const cropCoords = coorDinates;
                console.log('Crop coordinates:', cropCoords);

                // Create a temporary canvas to hold the cropped image
                const tempCanvas = document.createElement('canvas');
                const tempCtx = tempCanvas.getContext('2d');

                // Set the size of the temporary canvas
                tempCanvas.width = cropCoords.w;
                tempCanvas.height = cropCoords.h;

                // Draw the cropped image onto the temporary canvas
                tempCtx.drawImage(img, cropCoords.x, cropCoords.y, cropCoords.w, cropCoords.h, 0, 0, cropCoords.w, cropCoords.h);

                // Clear the main canvas
                context.clearRect(0, 0, canvas.width, canvas.height);

                // Resize the main canvas to fit the cropped image
                canvas.width = cropCoords.w;
                canvas.height = cropCoords.h;

                // Draw the cropped image onto the main canvas
                context.drawImage(tempCanvas, 0, 0);

                // Optionally, convert the cropped image to data URL or upload to server
                const croppedDataURL = canvas.toDataURL();
                console.log('Cropped image data URL:', croppedDataURL);

                $('#imageCanvas').Jcrop({
                   setSelect: [0, 0, 0, 0],
                });
               };
               img.src = canvas.toDataURL(); // Use the canvas image data as source
        });


        });

        async function uploadAndProcessImage() {
            const imageElement = $('#imagePreview')[0];
            const imageSrc = imageElement.src;

            if (!imageSrc) {
               alert('Please select an image and ensure it is displayed.');
               return;
            }

            // Display SweetAlert loading
            Swal.fire({
               title: 'Processing Image',
               html: 'Please wait...',
               allowOutsideClick: false,
               showConfirmButton: false,
               didOpen: () => {
                     Swal.showLoading();
               }
            });

            // Extract the base64-encoded image data from the src attribute
            const base64Image = imageSrc.split(',')[1];

            const apiKey = 'AIzaSyARoypNpxR2lJ17m5zXesdCtizrdpO_66M';
            const visionApiUrl = `https://vision.googleapis.com/v1/images:annotate?key=${apiKey}`;

            const requestPayload = {
               requests: [
                     {
                        image: {
                           content: base64Image
                        },
                        features: [
                           {
                                 type: 'TEXT_DETECTION'
                           }
                        ]
                     }
               ]
            };

            try {
               const response = await $.ajax({
                     url: visionApiUrl,
                     type: 'POST',
                     contentType: 'application/json',
                     data: JSON.stringify(requestPayload)
               });

               const data = response;
               

               // Assuming data.textAnnotations is the array you want to process
               const textAnnotations = data.responses[0].textAnnotations;

               // Remove the first element
               const arrayText = textAnnotations.slice(1);

               // Helper function to calculate the median y coordinate
               const calculateMedianY = vertices => {
                     const ys = vertices.map(vertex => vertex.y).sort((a, b) => a - b);
                     const middle = Math.floor(ys.length / 2);
                     return ys.length % 2 !== 0 ? ys[middle] : (ys[middle - 1] + ys[middle]) / 2;
               };

               const newArrayTxt = arrayText.map(annotation => ({
                     description: annotation.description,
                     x: annotation.boundingPoly.vertices[0].x,
                     medianY: calculateMedianY(annotation.boundingPoly.vertices)
               }));

               // Sort the newArrayTxt by medianY and then by x
               newArrayTxt.sort((a, b) => {
                     if (a.medianY === b.medianY) {
                        return a.x - b.x;
                     } else {
                        return a.medianY - b.medianY;
                     }
               });

               // Group elements by medianY value difference within 10 pixels
               const groupedLines = [];
               let currentLine = [];

               // Group elements by medianY value difference within 10 pixels
               const jobTitles = [
                     "Belum / Tidak Bekerja", "Mengurus Rumah Tangga", "Pelajar / Mahasiswa", "Pensiunan", "Pegawai Swasta",
                     "Pegawai Negeri Sipil", "Tentara Nasional Indonesia", "Kepolisian RI", "Perdagangan",
                     "Petani / Pekebun", "Peternak", "Nelayan / Perikanan", "Industri", "Konstruksi", "Transportasi",
                     "Karyawan Swasta", "Karyawan BUMN", "Karyawan BUMD", "Karyawan Honorer", "Buruh Harian Lepas",
                     "Buruh Tani / Perkebunan", "Buruh Nelayan / Perikanan", "Buruh Peternakan", "Pembantu Rumah Tangga",
                     "Tukang Cukur", "Tukang Listrik", "Tukang Batu", "Tukang Kayu", "Tukang Sol Sepatu", "Tukang Las / Pandai Besi",
                     "Tukang Jahit", "Penata Rambut", "Penata Rias", "Penata Busana", "Mekanik", "Tukang Gigi", "Seniman", "Tabib",
                     "Paraji", "Perancang Busana", "Penerjemah", "Imam Masjid", "Pendeta", "Pastur", "Wartawan", "Ustadz / Mubaligh",
                     "Juru Masak", "Promotor Acara", "Anggota DPR-RI", "Anggota DPD", "Anggota BPK", "Presiden", "Wakil Presiden",
                     "Anggota Mahkamah Konstitusi", "Anggota Kabinet / Kementerian", "Duta Besar", "Gubernur", "Wakil Gubernur",
                     "Bupati", "Wakil Bupati", "Walikota", "Wakil Walikota", "Anggota DPRD Provinsi", "Anggota DPRD Kabupaten", "Dosen",
                     "Guru", "Pilot", "Pengacara", "Notaris", "Arsitek", "Akuntan", "Konsultan", "Dokter", "Bidan", "Perawat",
                     "Apoteker", "Psikiater / Psikolog", "Penyiar Televisi", "Penyiar Radio", "Pelaut", "Peneliti", "Sopir", "Pialang",
                     "Paranormal", "Pedagang", "Perangkat Desa", "Kepala Desa", "Biarawati", "Wiraswasta", "Anggota Lembaga Tinggi",
                     "Artis", "Atlit", "Chef", "Manajer", "Tenaga Tata Usaha", "Operator", "Pekerja Pengolahan, Kerajinan", "Teknisi",
                     "Asisten Ahli", "Lainnya"
               ];

               newArrayTxt.forEach((item, index) => {
                     if (index === 0) {
                        currentLine.push(item);
                     } else {
                        const prevItem = newArrayTxt[index - 1];
                        if (Math.abs(item.medianY - prevItem.medianY) < 5) {
                           currentLine.push(item);
                        } else {
                           currentLine.sort((a, b) => a.x - b.x);
                           groupedLines.push(currentLine);
                           currentLine = [item];
                        }
                     }
               });

               if (currentLine.length > 0) {
                     currentLine.sort((a, b) => a.x - b.x);
                     groupedLines.push(currentLine);
               }

               var textresponse = '';

               groupedLines.forEach((line, index) => {
                     var sentence = line.map(item => item.description).join(' ').replace(/:/g, '');

                     textresponse = textresponse + ' $$$ ' + sentence;

                     // NIK
                     const regexNIK = /(?:\bNIK\b|\b\d{16}\b)/g;
                     const match = sentence.match(regexNIK);
                     if (match) {
                        const nik = match.find(m => /\d{16}/.test(m));
                        if (nik) {
                           $('#nik').val(nik);
                        }
                     }

                     // NAMA
                     if (sentence.match(/^\s*(?:Nama|Name|Neme|Namd)/)) {
                        sentence = sentence.replace(/\b(?:Nama|Name|Neme|Namd)\b/g, '').trim();
                        $('#nama').val(sentence);
                     }

                     // TEMPAT DAN TANGGAL LAHIR
                     if (sentence.match(/(?:\bTempat\b|\bTgl\b|\bLahir\b)/i) && sentence.includes('/')) {
                        sentence = sentence.replace(/\b(?:Tempat|Tgl|Lahir)\b|\/|:/gi, '').trim();
                        const words = sentence.split(',');
                        $('#birth_place').val(words[0].trim());

                        const datePattern = /\b(\d{2})-(\d{2})-(\d{4})\b/;
                        const dateMatch = sentence.match(datePattern);

                        if (dateMatch) {
                           const dateParts = dateMatch[0].split('-');
                           const formattedDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;
                           $('#birth_date').val(formattedDate);
                        }
                     }

                     // GENDER
                     if (sentence.match(/\b(?:Jenis|elamin|kelamin)\b/i)) {
                        if (sentence.match(/\bLAK\S*\b/i)) {
                           $('#gender-laki').prop('checked', true);
                        } else if (sentence.match(/\bPEREM\b|\bPEREMPUAN\b|\bPUAN\b/i)) {
                           $('#gender-perempuan').prop('checked', true);
                        }
                     }
                     // ALAMAT
                     if (sentence.match(/\bAlamat\b/i)) {
                        let nextSentence = '';
                        if (index < groupedLines.length - 1) {
                           nextSentence = groupedLines[index + 1].map(item => item.description).join(' ').replace(/:/g, '');
                        }

                        sentence = sentence.replace(/\bAlamat\b/g, '').trim();

                        if (!nextSentence.match(/\bRT\b|\bRW\b/i)) {
                           sentence += ' ' + nextSentence;
                        }

                        $('#address').val(sentence);
                     }

                     // RTRW
                     const regexRTRW = /\b(\d{3})\/(\d{3})\b/g;
                     const matchRTRW = sentence.match(regexRTRW);
                     if (matchRTRW) {
                        const [rt, rw] = matchRTRW[0].split('/');
                        $('#address_rt').val(rt);
                        $('#address_rw').val(rw);
                     }

                     // KEL / DES
                     const regexKeVDesa = /\b(Kel\s*\/\s*Des[a]?|KeV\s*\/\s*Des[a]?|KelDes|KelDesa|Kel\s*\/\s*Dese)\b/i;
                     if (sentence.match(regexKeVDesa)) {
                        // Replace matched variations with an empty string and trim the result
                        sentence = sentence.replace(regexKeVDesa, '').trim();
                        // Set the value to the address_kel_des field
                        $('#address_kel_des').val(sentence);
                     }

                     // KECAMATAN
                     if (sentence.match(/\bKecamatan\b/i)) {
                        sentence = sentence.replace(/\bKecamatan\b/g, '').trim();
                        $('#address_kec').val(sentence);
                     }

                     // AGAMA
                     if (sentence.match(/\b(?:ISLAM|PROTESTAN|KRISTEN|KATOLIK|KATHOLIK|BUDHA|HINDU|KHONGHUCU)\b/i)) {
                        const religion = sentence.match(/\b(?:ISLAM|PROTESTAN|KRISTEN|KATOLIK|KATHOLIK|BUDHA|HINDU|KHONGHUCU)\b/i)[0];
                        $('#religion').val(religion);
                     }

                     // MARRIED STATUS
                     if (sentence.match(/\b(?:Status|kawinan)\b/i)) {
                        if (sentence.match(/\bBELUM\b/i)) {
                           $('#married_status').val('BELUM KAWIN');
                        } else if (sentence.match(/\bCERAI\b/i)) {
                           $('#married_status').val('CERAI');
                        } else {
                           $('#married_status').val('KAWIN');
                        }
                     }

                     // PEKERJAAN
                     let job = '';
                     const upperSentence = sentence.toUpperCase();
                     jobTitles.some(title => {
                        if (upperSentence.includes(title.toUpperCase())) {
                           job = title;
                           $('#job').val(job.toUpperCase());
                        }
                     });

                     // KEWARGANEGARAAN
                     if (sentence.match(/\bWNI\b/i)) {
                        $('#national').val('WNI');
                     }
                     console.log(sentence);

                     $('#responseText').val(textresponse);
               });
               Swal.close();
            } catch (error) {
               console.error('Error:', error);
               Swal.close();
            }
         }

      </script>
   </body>
</html>