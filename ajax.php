<?php

include('connection.php');

session_start();

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;


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
    $query = "SELECT nik, nama, address_kel_des, address_kec, upload_date,status FROM ektps";

    // Add the limit of 1000 records
    $query .= " LIMIT 1000";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    $query = "SELECT nik, nama, address_kel_des, address_kec, upload_date,status FROM ektps";

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

    // If there are any WHERE clauses, concatenate them with AND
    if (!empty($whereClauses)) {
        $query .= " WHERE " . implode(" AND ", $whereClauses);
    }

    // Add the limit of 1000 records
    $query .= " LIMIT 1000";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        $error = array("status" => "error", "message" => mysqli_error($conn));
        header('Content-Type: application/json');
        echo json_encode($error);
    }

    mysqli_close($conn);

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
        $sheet->setCellValue('A1', 'NIK');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Kelurahan');
        $sheet->setCellValue('D1', 'Kecamatan');
        $sheet->setCellValue('E1', 'Upload Date');
        $sheet->setCellValue('F1', 'Status');
        // Add more headers as needed

        // Populate data from the database query
        $row = 2;
        while ($row_data = $result->fetch_assoc()) {
            $sheet->setCellValueExplicit('A' . $row, $row_data['nik'], DataType::TYPE_STRING);
            $sheet->setCellValue('B' . $row, $row_data['nama']); // Adjust according to your database schema
            $sheet->setCellValue('C' . $row, $row_data['address_kel_des']); // Adjust according to your database schema
            $sheet->setCellValue('D' . $row, $row_data['address_kec']); // Adjust according to your database schema
            $sheet->setCellValue('E' . $row, $row_data['upload_date']); // Adjust according to your database schema
            $sheet->setCellValue('F' . $row, $row_data['status']); // Adjust according to your database schema
            $row++;
        }

        // Create a temporary directory to store the Excel file and the PDF files
        $tempDir = sys_get_temp_dir() . '/data_' . uniqid();
        mkdir($tempDir);

        // Save the Excel file to the temporary directory
        $excelFilePath = $tempDir . '/data.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($excelFilePath);

        // Create directories for each NIK and copy the corresponding PDF files
        $pdfDir = $tempDir . '/pdf' ;
        mkdir($pdfDir);
        foreach ($niks as $nik) {

            // Assuming PDF files are named exactly as the NIK and located in the 'pdfs' directory
            $pdfPath = 'pdfs/' . $nik . '.pdf';
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
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($tempDir), RecursiveIteratorIterator::LEAVES_ONLY);
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

        //update status
        $sqlUpdate = "UPDATE ektps SET status = 'downloaded' WHERE nik IN ($niksString)";
        $result = $conn->query($sqlUpdate);

        if(strlen($niksString) <= 20){
            $fileName = preg_replace('/\D/', '', $niksString);
        } else {
            $fileName = "data";
        }

        // Set headers for download
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment;filename="'.$fileName.'.zip"');
        header('Cache-Control: max-age=0');

        // Send the ZIP file to the client
        readfile($zipFilePath);

        // Clean up
        array_map('unlink', glob("$tempDir/*.*"));
        rmdir($tempDir);
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


    $sqlUpdate = "UPDATE ektps SET status = '$status' WHERE nik IN ($niksString)";
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

    $sqlDelete = "DELETE from ektps WHERE nik IN ($niksString)";
    $result = $conn->query($sqlDelete);

    $response = [];
    if ($result) {

        foreach ($niks as $nik) {
            $filePath = __DIR__ . "/pdfs/$nik.pdf";
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $response['status'] = "success";
        $response['message'] = "Data Deleted";
    } else {
        $response['status'] = "error";
        $response['message'] = "Failed to delete";
    }

    echo json_encode($response);
}

function getCountData() {
    $conn = getConn();
    $username = $_SESSION['username'];
    $isChecker = $_SESSION['role'] == 'checker';

    // Uploaded count query
    if ($isChecker) {
        $sqlUploaded = "SELECT COUNT(*) as count FROM ektps WHERE upload_by = '$username'";
    } else {
        $sqlUploaded = "SELECT COUNT(*) as count FROM ektps";
    }

    $resultUploaded = $conn->query($sqlUploaded);
    $countUploaded = mysqli_fetch_assoc($resultUploaded)['count'];

    // Downloaded count query
    if ($isChecker) {
        $sqlDownloaded = "SELECT COUNT(*) as count FROM ektps WHERE status = 'downloaded' AND upload_by = '$username'";
    } else {
        $sqlDownloaded = "SELECT COUNT(*) as count FROM ektps WHERE status = 'downloaded'";
    }

    $resultDownloaded = $conn->query($sqlDownloaded);
    $countDownloaded = mysqli_fetch_assoc($resultDownloaded)['count'];

    // Return counts in JSON
    echo json_encode([
        'countUploaded' => $countUploaded,
        'countDownloaded' => $countDownloaded
    ]);
}



?>