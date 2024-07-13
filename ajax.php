<?php

include('connection.php');

session_start();

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Google\Cloud\Storage\StorageClient;

putenv('GOOGLE_APPLICATION_CREDENTIALS=psyched-oxide-424402-a3-38779c1a080f.json'); // Replace with the path to your service account key

if (isset($_GET['func']) || isset($_POST['func'])) {
    // Get the value of the 'func' parameter
    if (isset($_GET['func'])) {
        $functionName = $_GET['func'];
    } else if (isset($_POST['func'])) {
        $functionName = $_POST['func'];
    }

    // Call the corresponding function based on the 'func' parameter
    if ($functionName === 'getAllData') {
        getAllData();
    } else if ($functionName === 'getFilteredData') {
        getFilteredData();
    } else if ($functionName === 'downloadExcelAndData') {
        downloadExcelAndData();
    } else if ($functionName === 'changeStatus') {
        changeStatus();
    } else if ($functionName === 'deleteNik') {
        deleteNik();
    } else if ($functionName === 'getCountData') {
        getCountData();
    }  else if ($functionName === 'deleteOldDownloadedData') {
        deleteOldDownloadedData();
    } else if ($functionName === 'deleteOldDataFiles') {
        deleteOldDataFiles();
    } else {
        // Handle the case where the function name is not recognized
        header('Content-Type: application/json');
        echo json_encode(array("status" => "error", "message" => "Function not recognized"));
    }
} else {
    // Handle the case where the 'func' parameter is not set
    header('Content-Type: application/json');
    echo json_encode(array("status" => "error", "message" => "function not found"));
}


function getAllData() {
    $conn = getConn();
    $query = "SELECT nik, nama, address_kel_des, address_kec, upload_date, status, upload_by, old_data FROM ektps WHERE old_data = 0";

    // Add the limit of 1000 records
    $query .= " LIMIT 2000";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // $bucketName = 'verfak_ktp_2';
        // $storage = new StorageClient();
        // $bucket = $storage->bucket($bucketName);

        // $objectNames = [];
        // foreach ($data as &$record) {
        //     $nik = $record['nik'];
        //     $pdfPath = "pdfs/$nik.pdf";
        // }

        // // Batch check file existence
        // $objects = $bucket->objects(['prefix' => '']); // Fetch all objects in the bucket (adjust as per your need)

        // $existingObjects = [];
        // foreach ($objects as $object) {
        //     $objectName = $object->name();
        //     if (in_array($objectName, $objectNames)) {
        //         $existingObjects[$objectName] = true;
        //     }
        // }

        // Update records with file existence information
        foreach ($data as &$record) {
            $nik = $record['nik'];
            $pdfPath = "pdfs/$nik.pdf";
            
            if (file_exists($pdfPath)) {
                $record['file_exist'] = "yes";
            } else {
                $record['file_exist'] = "no";
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        $error = array("status" => "error", "message" => mysqli_error($conn));
        header('Content-Type: application/json');
        echo json_encode($error);
    }

    mysqli_close($conn);
}


function getFilteredData(){
    $conn = getConn();
    $query = "SELECT nik, nama, address_kel_des, address_kec, upload_date,status, upload_by, old_data FROM ektps";

    $whereClauses = [];

    // Prepare WHERE clauses based on the provided filters
    if (!empty($_GET['nik'])) {
        $nik = $_GET['nik'];
        $whereClauses[] = "nik = '$nik'";
    }
    
    if (!empty($_GET['nama'])) {
        $nama = $_GET['nama'];
        $whereClauses[] = "nama LIKE '%$nama%'";
    }
    
    if (!empty($_GET['kelurahan'])) {
        $kelurahan = $_GET['kelurahan'];
        $whereClauses[] = "address_kel_des LIKE '%$kelurahan%'";
    }
    
    if (!empty($_GET['kecamatan'])) {
        $kecamatan = $_GET['kecamatan'];
        $whereClauses[] = "address_kec LIKE '%$kecamatan%'";
    }
    
    if (!empty($_GET['uploadDate'])) {
        $uploadDate = $_GET['uploadDate'];
        // Assuming $uploadDate is in the format YYYY-MM-DD
        $whereClauses[] = "DATE(upload_date) = '$uploadDate'";
    }
    
    if (!empty($_GET['status'])) {
        $status = $_GET['status'];
        $whereClauses[] = "status = '$status'";
    }

    if ($_GET['with_old_data'] == 'true'){
        $whereClauses[] = "old_data = 1";
    } else {
        $whereClauses[] = "old_data = 0";
    }

    // If there are any WHERE clauses, concatenate them with AND
    if (!empty($whereClauses)) {
        $query .= " WHERE " . implode(" AND ", $whereClauses);
    }


    // Add the limit of 1000 records
    $query .= " LIMIT 2000";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $bucketName = 'verfak_ktp_2';
        $storage = new StorageClient();
        $bucket = $storage->bucket($bucketName);

        foreach ($data as &$record) {
            $nik = $record['nik'];
            $pdfPath = "pdfs/$nik.pdf";
            
            if (file_exists($pdfPath)) {
                $record['file_exist'] = "yes";
            } else {
                $record['file_exist'] = "no";
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        $error = array("status" => "error", "message" => mysqli_error($conn));
        header('Content-Type: application/json');
        echo json_encode($error);
    }

    mysqli_close($conn);

}

function deleteOldDataFiles() {
    $tempDir = sys_get_temp_dir();
    $currentTimestamp = time();
    $thirtyMinutesAgoTimestamp = $currentTimestamp - (30 * 60); // 30 minutes in seconds

    $files = scandir($tempDir);
    $filesDeleted = 0;

    foreach ($files as $file) {
        $filePath = $tempDir . DIRECTORY_SEPARATOR . $file;
        if (strpos($file, "data_") === 0 && filectime($filePath) < $thirtyMinutesAgoTimestamp) {
            if (is_file($filePath)) {
                if (unlink($filePath)) {
                    $filesDeleted++;
                }
            } elseif (is_dir($filePath)) {
                // Attempt to delete the directory
                // Note: This will only work if the directory is empty
                if (rmdir($filePath)) {
                    $filesDeleted++;
                } else {
                    // If the directory is not empty, you need to recursively delete its contents first
                    $filesDeleted += deleteDirectory($filePath);
                }
            }
        }
    }


    if ($filesDeleted > 0) {
        echo "$filesDeleted file(s) successfully deleted.";
    } else {
        echo $files;
    }
}

function deleteDirectory($dir) {
    $itemsDeleted = 0;
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        $filePath = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($filePath)) {
            $itemsDeleted += deleteDirectory($filePath);
        } else {
            if (unlink($filePath)) {
                $itemsDeleted++;
            }
        }
    }
    if (rmdir($dir)) {
        $itemsDeleted++;
    }
    return $itemsDeleted;
}



function downloadExcelAndData() {
    $conn = getConn();
    $payload = isset($_POST['payload']) ? json_decode($_POST['payload'], true) : array();
    $niks = array_map(function($item) { return $item['nik']; }, $payload);
    $niksString = "'" . implode("','", $niks) . "'";

    $sql = "SELECT * FROM ektps WHERE nik IN ($niksString)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Create a new PhpSpreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Add headers
       // Add headers
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'NIK');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Jenis Kelamin');
        $sheet->mergeCells('D1:E1'); // Merge cells D1 and E1 for 'Jenis Kelamin'

        $sheet->setCellValue('F1', 'Tempat Lahir');
        $sheet->setCellValue('G1', 'Tgl Lahir');
        
        $sheet->setCellValue('H1', 'Status Perkawinan');
        $sheet->mergeCells('H1:I1'); // Merge cells H1 and I1 for 'Status Perkawinan'

        $sheet->setCellValue('J1', 'Pekerjaan');
        $sheet->setCellValue('K1', 'Alamat');
        $sheet->setCellValue('L1', 'RT');
        $sheet->setCellValue('M1', 'RW');
        $sheet->setCellValue('N1', 'Kelurahan / Desa');
        $sheet->setCellValue('O1', 'Kecamatan');
        $sheet->setCellValue('P1', 'Agama');
            // Add more headers as needed

        // Populate data from the database query
        $row = 2;
        while ($row_data = $result->fetch_assoc()) {
            // Set index in column A
            $sheet->setCellValue('A' . $row, $row - 1);
        
            // Set NIK as string
            $sheet->setCellValueExplicit('B' . $row, $row_data['nik'], DataType::TYPE_STRING);
        
            // Set other values
            $sheet->setCellValue('C' . $row, $row_data['nama']); // Adjust according to your database schema
            $sheet->setCellValue('D' . $row, $row_data['gender']); // Adjust according to your database schema
        
            // Conditionally set gender representation
            $genderShort = (strpos(strtolower($row_data['gender']), 'lak') !== false) ? 'L' : 'P';
            $sheet->setCellValue('E' . $row, $genderShort);
        
            // Format birth date to dd-mm-yyyy
            $sheet->setCellValue('F' . $row, $row_data['birth_place']);

            $birthDate = date('d-m-Y', strtotime($row_data['birth_date']));
            $sheet->setCellValue('G' . $row, $birthDate); // Adjust according to your database schema
        
        
            // Determine marital status
            $marriedStatus = strtolower($row_data['married_status']);
            if (strpos($marriedStatus, 'belum') !== false) {
                $marriedStatusText = 'belum menikah';
            } elseif (strpos($marriedStatus, 'cerai') !== false) {
                if ($genderShort == 'L') {
                    $marriedStatusText = 'duda';
                } else {
                    $marriedStatusText = 'janda';
                }
            } else {
                $marriedStatusText = 'sudah menikah';
            }
            $sheet->setCellValue('H' . $row, $marriedStatusText);
        
            // Set marital status short representation
            $marriedStatusShort = (strpos($marriedStatus, 'belum') !== false) ? 'B' : ((strpos($marriedStatus, 'cerai') !== false) ? 'P' : 'S');
            $sheet->setCellValue('I' . $row, $marriedStatusShort);
        
            // Set other address details
            $sheet->setCellValue('J' . $row, $row_data['job']); // Adjust according to your database schema
            $sheet->setCellValue('K' . $row, $row_data['address']);
            $sheet->setCellValue('L' . $row, $row_data['address_rt']);
            $sheet->setCellValue('M' . $row, $row_data['address_rw']);
            $sheet->setCellValue('N' . $row, $row_data['address_kel_des']); // Adjust according to your database schema
            $sheet->setCellValue('O' . $row, $row_data['address_kec']); // Adjust according to your database schema
            $sheet->setCellValue('P' . $row, $row_data['religion']); // Adjust according to your database schema
        
            // Increment row counter
            $row++;
        }

        // Create a temporary directory to store the Excel file and the PDF files
        $tempDir = sys_get_temp_dir() . '/data_' . uniqid();
        mkdir($tempDir);
'-------------------'
        // Save the Excel file to the temporary directory
        $excelFilePath = $tempDir . '/data.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($excelFilePath);

        // Create directories for each NIK and copy the corresponding PDF files
        // $bucketName = 'verfak_ktp_2';
        // $storage = new StorageClient();
        // $bucket = $storage->bucket($bucketName);
        
        // Create temporary directories
        $pdfDir = $tempDir . '/pdf';
        mkdir($pdfDir, 0777, true);
        
        foreach ($niks as $nik) {
            $pdfPath = "pdfs/$nik.pdf";
        
            if (file_exists($pdfPath)) {
                copy($pdfPath, $pdfDir . '/' . $nik . '.pdf');
            }
        }
        
        // Create a ZIP archive containing the Excel file and the PDF directories
        $zip = new ZipArchive();
        $zipFilePath = $tempDir . '.zip';
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            // Add the Excel file
            $zip->addFile($excelFilePath, 'data.xlsx');
        
            // Add the PDF directories
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($pdfDir), RecursiveIteratorIterator::LEAVES_ONLY);
            foreach ($files as $name => $file) {
                // Skip directories (they are added automatically)
                if (!$file->isDir()) {
                    // Get real and relative path for current file
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($tempDir) + 1);
        
                    // Add file to ZIP archive
                    $zip->addFile($filePath, $relativePath);
                }
            }
        
            // Close the ZIP archive
            $zip->close();
        }
        
        // Update status
        $niksString = implode(',', array_map(function($nik) { return "'$nik'"; }, $niks));
        $sqlUpdate = "UPDATE ektps SET status = 'downloaded' WHERE nik IN ($niksString)";
        $result = $conn->query($sqlUpdate);
        
        if (strlen($niksString) <= 20) {
            $fileName = preg_replace('/\D/', '', $niksString);
        } else {
            $fileName = "data";
        }
        
        // Set headers for download
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment;filename="' . $fileName . '.zip"');
        header('Cache-Control: max-age=0');
        
        // Send the ZIP file to the client
        readfile($zipFilePath);
        
        // Clean up
        array_map('unlink', glob("$pdfDir/*.*"));
        rmdir($pdfDir);
        unlink($zipFilePath);
        
        // Close the database connection
        $conn->close();
        
        // Exit to prevent further script execution
        exit();
    } else {
        echo 'No data found for the provided NIKs';
    }

    // Close the database connection
    $conn->close();
}

function changeStatus(){
    $conn = getConn();
    if ($conn === false) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Database connection failed'
        ]);
        return;
    }

    $status = $_POST['status'];

    $payload = isset($_POST['payload']) ? json_decode($_POST['payload'], true) : array();
    $niks = array_map(function($item) { return $item['nik']; }, $payload);
    $niksString = "'" . implode("','", $niks) . "'";


    $sqlUpdate = "UPDATE ektps SET status = '$status' WHERE nik IN ($niksString) AND old_data = 0";
    $result = $conn->query($sqlUpdate);

    $response = [];
    if ($result) {
        $response['status'] = "success";
        $response['message'] = "Status Changed";
    } else {
        $response['status'] = "error";
        $response['message'] = "Failed to change status";
    }

    echo json_encode($response);
}

function deleteNik(){
    $conn = getConn();
    if ($conn === false) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Database connection failed'
        ]);
        return;
    }

    $payload = isset($_POST['payload']) ? json_decode($_POST['payload'], true) : array();
    $niks = array_map(function($item) { return $item['nik']; }, $payload);
    $niksString = "'" . implode("','", $niks) . "'";

    // Retrieve and delete records with old_data = 0
    $sqlSelectDelete = "SELECT nik FROM ektps WHERE nik IN ($niksString) AND old_data = 0";
    $resultSelectDelete = $conn->query($sqlSelectDelete);

    $response = [];
    if ($resultSelectDelete) {
        $deleteNiks = [];
        while ($row = $resultSelectDelete->fetch_assoc()) {
            $deleteNiks[] = $row['nik'];
        }
        if (!empty($deleteNiks)) {
            $deleteNiksString = "'" . implode("','", $deleteNiks) . "'";
            $sqlDelete = "DELETE from ektps WHERE nik IN ($deleteNiksString)";
            $resultDelete = $conn->query($sqlDelete);

            if ($resultDelete) {
                // $bucketName = 'verfak_ktp_2';
                // $storage = new StorageClient();
                // $bucket = $storage->bucket($bucketName);

                foreach ($deleteNiks as $nik) {
                    $filePath = __DIR__ . "/pdfs/$nik.pdf";
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
                $response['status'] = "success";
                $response['message'] = "Data Deleted";
            } else {
                $response['status'] = "error";
                $response['message'] = "Failed to delete records";
            }
        } else {
            $response['status'] = "error";
            $response['message'] = "Failed to delete records";
        }

        // Handle records with old_data = 1
        $sqlSelectOld = "SELECT nik FROM ektps WHERE nik IN ($niksString) AND old_data = 1";
        $resultSelectOld = $conn->query($sqlSelectOld);
        if ($resultSelectOld) {
            $oldNiks = [];
            while ($row = $resultSelectOld->fetch_assoc()) {
                $oldNiks[] = $row['nik'];
            }
            if (!empty($oldNiks)) {
                $response['old_data'] = $oldNiks;
                $response['message'] .= ". Records lama tidak dapat di delete: " . implode(', ', $oldNiks);
            }
        }
    } else {
        $response['status'] = "error";
        $response['message'] = "Failed to retrieve records";
    }

    echo json_encode($response);
}

function deleteOldDownloadedData() {
    $conn = getConn();
    if ($conn === false) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Database connection failed'
        ]);
        return;
    }

    // Get the current time and calculate the threshold time (30 minutes ago)
    $currentTime = new DateTime();
    $thresholdTime = $currentTime->sub(new DateInterval('PT30M'))->format('Y-m-d H:i:s');

    // Query to get all downloaded data older than 30 minutes
    $sqlSelect = "SELECT nik FROM ektps WHERE reg_date < '$thresholdTime' AND status = 'downloaded'";
    $result = $conn->query($sqlSelect);

    if ($result === false) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to retrieve data'
        ]);
        return;
    }

    $niks = [];
    while ($row = $result->fetch_assoc()) {
        $niks[] = $row['nik'];
    }

    if (empty($niks)) {
        echo json_encode([
            'status' => 'success',
            'message' => 'No data to delete'
        ]);
        return;
    }

    $niksString = "'" . implode("','", $niks) . "'";

    // Delete the old records from the database
    $sqlDelete = "DELETE FROM ektps WHERE nik IN ($niksString)";
    $deleteResult = $conn->query($sqlDelete);

    if ($deleteResult) {
        foreach ($niks as $nik) {
            $filePath = __DIR__ . "/pdfs/$nik.pdf";
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        echo json_encode([
            'status' => 'success',
            'message' => 'Old data and associated files deleted'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to delete old data'
        ]);
    }
}



function getCountData() {
    $conn = getConn();
    $username = $_SESSION['username'];
    $isChecker = $_SESSION['role'] == 'operator';

    // Uploaded count query
    if ($isChecker) {
        $sqlUploaded = "SELECT COUNT(*) as count FROM ektps WHERE upload_by = '$username' AND old_data = 1";
    } else {
        $sqlUploaded = "SELECT COUNT(*) as count FROM ektps WHERE old_data = 1";
    }

    $resultUploaded = $conn->query($sqlUploaded);
    $countUploaded = mysqli_fetch_assoc($resultUploaded)['count'];

     // Uploaded count query
     if ($isChecker) {
        $sqlUploadedNew = "SELECT COUNT(*) as count FROM ektps WHERE upload_by = '$username' AND old_data = 0";
    } else {
        $sqlUploadedNew = "SELECT COUNT(*) as count FROM ektps WHERE old_data = 0";
    }

    $resultUploadedNew = $conn->query($sqlUploadedNew);
    $countUploadedNew = mysqli_fetch_assoc($resultUploadedNew)['count'];

    
    // Downloaded count query
    if ($isChecker) {
        $sqlDownloaded = "SELECT COUNT(*) as count FROM ektps WHERE status = 'downloaded' AND upload_by = '$username' AND old_data = 0";
    } else {
        $sqlDownloaded = "SELECT COUNT(*) as count FROM ektps WHERE status = 'downloaded' AND old_data = 0";
    }

    $resultDownloaded = $conn->query($sqlDownloaded);
    $countDownloaded = mysqli_fetch_assoc($resultDownloaded)['count'];

    // Return counts in JSON
    header('Content-Type: application/json');
    echo json_encode([
        'countUploaded' => $countUploaded,
        'countUploadedNew' => $countUploadedNew,
        'countDownloaded' => $countDownloaded
    ]);
}



?>