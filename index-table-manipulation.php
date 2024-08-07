<script>
    
    function getActivePageNumber() {
        var pageItems = document.querySelectorAll('.page-item');
        
        for (var i = 0; i < pageItems.length; i++) {
            if (pageItems[i].classList.contains('active')) {
                var pageNumber = pageItems[i].querySelector('a').textContent;
                return parseInt(pageNumber); // Convert to integer if needed
            }
        }
        return null;
    }

    function setupPagination(totalItems, itemsPerPage) {
        const pagination = $("#pagination");
        pagination.empty();

        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const maxPagesToShow = 10; // Number of page links to show

        // Previous button
        const prev = $('<li class="page-item"><a class="page-link">Previous</a></li>');
        if (currentPage === 1) {
            prev.addClass("disabled");
        } else {
            prev.click(function() {
                currentPage--;
                displayPage(currentPage);
                setupPagination(totalItems, itemsPerPage); // Re-setup pagination after page change
            });
        }
        pagination.append(prev);

        // First page button
        if (currentPage > 1) {
            const firstPage = $('<li class="page-item"><a class="page-link">First</a></li>');
            firstPage.click(function() {
                currentPage = 1;
                displayPage(currentPage);
                setupPagination(totalItems, itemsPerPage); // Re-setup pagination after page change
            });
            pagination.append(firstPage);
        }

        // Calculate start and end page numbers
        let startPage = Math.max(currentPage - Math.floor(maxPagesToShow / 2), 1);
        let endPage = Math.min(startPage + maxPagesToShow - 1, totalPages);

        // Adjust start and end if they exceed the total pages
        if (endPage - startPage + 1 < maxPagesToShow) {
            startPage = Math.max(endPage - maxPagesToShow + 1, 1);
        }

        // Ellipsis before start page
        if (startPage > 1) {
            const ellipsisBefore = $('<li class="page-item disabled"><a class="page-link">...</a></li>');
            pagination.append(ellipsisBefore);
        }

        // Page numbers
        for (let i = startPage; i <= endPage; i++) {
            const page = $(`<li class="page-item"><a class="page-link">${i}</a></li>`);
            if (i === currentPage) {
                page.addClass("active");
            }
            page.click(function() {
                currentPage = i;
                displayPage(currentPage);
                setupPagination(totalItems, itemsPerPage); // Re-setup pagination after page change
            });
            pagination.append(page);
        }

        // Ellipsis after end page
        if (endPage < totalPages) {
            const ellipsisAfter = $('<li class="page-item disabled"><a class="page-link">...</a></li>');
            pagination.append(ellipsisAfter);
        }

        // Last page button
        if (currentPage < totalPages) {
            const lastPage = $('<li class="page-item"><a class="page-link">Last</a></li>');
            lastPage.click(function() {
                currentPage = totalPages;
                displayPage(currentPage);
                setupPagination(totalItems, itemsPerPage); // Re-setup pagination after page change
            });
            pagination.append(lastPage);
        }

        // Next button
        const next = $('<li class="page-item"><a class="page-link">Next</a></li>');
        if (currentPage === totalPages) {
            next.addClass("disabled");
        } else {
            next.click(function() {
                currentPage++;
                displayPage(currentPage);
                setupPagination(totalItems, itemsPerPage); // Re-setup pagination after page change
            });
        }
        pagination.append(next);
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
        if (data.old_data == 1) {
            tr.classList.add('blue-font');
        }        

        var tdNik = document.createElement('td');
        if (data.file_exist === "no") {
            tdNik.classList.add('red-font');
        }

        // Create checkbox
        if(data.file_exist === 'yes'){
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.addEventListener('change', updateCounter);
            // Append checkbox before the text content of tdNik
            tdNik.appendChild(checkbox);
        }

        
        // Add a space between checkbox and nik
        tdNik.appendChild(document.createTextNode(' ' + data.nik));

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

        const tdUploadDate = document.createElement('td');
        const lineBreak = document.createElement('br');
        const uploadByText = document.createTextNode(data.upload_by);

        tdUploadDate.textContent = formatDate(data.upload_date);
        tdUploadDate.appendChild(lineBreak);
        tdUploadDate.appendChild(uploadByText);
        tr.appendChild(tdUploadDate);

        const tdStatus = document.createElement('td');
        const statusBadge = document.createElement('div');
        statusBadge.className = 'badge badge-pill';
        if (data.status === 'downloaded') {
            statusBadge.classList.add('badge-success');
            statusBadge.textContent = 'Downloaded';
        } else if (data.status === 'rejected') {
            statusBadge.classList.add('badge-danger');
            statusBadge.textContent = 'Rejected';
        } else {
            statusBadge.classList.add('badge-primary');
            statusBadge.textContent = 'Uploaded';
        }
        tdStatus.appendChild(statusBadge);
        tr.appendChild(tdStatus);

        const tdAction = document.createElement('td');

        if(data.file_exist == 'yes'){
            const downloadButton = document.createElement('button');
            downloadButton.type = 'button';
            downloadButton.className = 'btn btn-success mb-3 ';
            downloadButton.innerHTML = '<i class="ri-download-fill pr-0"></i>';
            downloadButton.onclick = function() { downloadSelected(data.nik); };
            tdAction.appendChild(downloadButton);
        }

        if(data.old_data == 0){
            const rejectButton = document.createElement('button');
            rejectButton.type = 'button';
            rejectButton.className = 'btn btn-danger mb-3 mx-1';
            rejectButton.innerHTML = '<i class="ri-forbid-fill pr-0"></i>';
            rejectButton.onclick = function() {rejectSelected(data.nik); };
            tdAction.appendChild(rejectButton);
    
            const deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.className = 'btn btn-warning mb-3';
            deleteButton.innerHTML = '<i class="ri-delete-bin-2-fill pr-0"></i>';
            deleteButton.onclick = function() {deleteSelected(data.nik); };
            tdAction.appendChild(deleteButton);
        }

        tr.appendChild(tdAction);

        return tr;
    }

    function changeStatus(nik, newStatus) {
        for (var i = 0; i < dataCache.length; i++) {
            if (dataCache[i].nik === nik) {
                // Update the nama property if nik matches
                dataCache[i].status = newStatus;
                // Optionally, break the loop if you only want to update the first matching object
                // break;
            }
        }
    }

    function downloadSelection(){
        var collectedData = getNikList();
        if (collectedData === null || collectedData.length === 0) {
            // Display SweetAlert error if collectedData is null or empty
            Swal.fire({
                icon: 'error',
                title: 'No Data',
                text: 'Please select NIK',
            });
            return;
        }
        console.log(collectedData);
        
       downloadMenu(collectedData);
    }

    function downloadMenu(collectedData){
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'ajax.php'; // Replace with your server endpoint URL
        // form.target = 'blank';

        const funcInput = document.createElement('input');
        funcInput.type = 'hidden';
        funcInput.name = 'func';
        funcInput.value = 'downloadExcelAndData';
        form.appendChild(funcInput);

        const payloadInput = document.createElement('input');
        payloadInput.type = 'hidden';
        payloadInput.name = 'payload';
        payloadInput.value = JSON.stringify(collectedData);
        form.appendChild(payloadInput);

        document.body.appendChild(form);
        form.submit();

        collectedData.forEach(function(rowData) {
            changeStatus(rowData.nik, "downloaded");
        });

        reloadPageState();

    }

    function downloadSelected(nik){
        var collectedData = [];

        const rowData = {
            nik : nik,
        };

        collectedData.push(rowData);

        downloadMenu(collectedData);
    }

    function rejectSelected(nik){
        var collectedData = [];

        const rowData = {
            nik : nik,
        };

        collectedData.push(rowData);
        changeStatusMenu(collectedData, 'rejected')
    }

    function changeStatusMenu(collectedData, status){
        $.ajax({
            url: 'ajax.php',
            type: "POST",
            data: {func: 'changeStatus', status:status, payload: JSON.stringify(collectedData)},
            dataType: 'json',
            success: function(response) {
                Swal.fire({
                    icon: response.status,
                    text: response.message
                });
                if(response.status == "success"){
                    collectedData.forEach(function(rowData) {
                        changeStatus(rowData.nik, status);
                    });

                    reloadPageState();
                }
            }
        });
    }

    function deleteSelected(nik){
        var collectedData = [];

        const rowData = {
            nik: nik,
        };

        collectedData.push(rowData);

        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to delete this NIK?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteMenu(collectedData);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Your data is safe ',
                    'error'
                );
            }
        });
    }

    function deleteMenu(collectedData){
        $.ajax({
            url: 'ajax.php',
            type: "POST",
            data: {func: 'deleteNik', payload: JSON.stringify(collectedData)},
            dataType: 'json',
            success: function(response) {
                Swal.fire({
                    icon: response.status,
                    text: response.message
                });
                if(response.status == "success"){
                    collectedData.forEach(function(rowData) {
                        deleteFromCache(function(obj) {
                            return obj.nik === rowData.nik;
                        });
                    });

                    reloadPageState();
                }
            }
        });

    }

    function deleteFromCache(condition) {
        for (var i = dataCache.length - 1; i >= 0; i--) {
            if (condition(dataCache[i])) {
                // Remove the object at index i using splice
                dataCache.splice(i, 1);
            }
        }
    }

    function reloadPageState(){
        const activePage = getActivePageNumber();
        displayPage(activePage);
    }

    async function reloadNumberofPage(){
        itemsPerPage = parseInt($('#itemPerPageInput').val());

        if(itemsPerPage == 0 || itemsPerPage == null){
            itemsPerPage = 10;
        }

        let nik = $('#filter-nik').val().toLowerCase();
        let nama = $('#filter-nama').val().toLowerCase();
        let kelurahan = $('#filter-kelurahan').val().toLowerCase();
        let kecamatan = $('#filter-kecamatan').val().toLowerCase();
        let uploadDate = $('#filter-upload-date').val().toLowerCase();
        let status = $('#filter-status').val().toLowerCase();
        let withOldData = $('#withOldData').is(':checked');

    if (nik || nama || kelurahan || kecamatan || uploadDate || status || withOldData) {
       await getFilteredData();
    } else {
       await getAllData();
    }
    
    displayPage(1);

    }




</script>