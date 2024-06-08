<?php
include ('connection.php');
require ('tcpdf/tcpdf.php'); // Include the TCPDF library

session_start();

$conn =  getConn();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO ektps (phone, nik, nama, birth_place, birth_date, gender, address, address_rt, address_rw, address_kel_des, address_kec, religion, married_status, job, national, upload_by, upload_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("ssssssssssssssss", $phone, $nik, $nama, $birth_place, $birth_date, $gender, $address, $address_rt, $address_rw, $address_kel_des, $address_kec, $religion, $married_status, $job, $national, $username);

$phone = $_POST['phone'];
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$birth_place = $_POST['birth_place'];
$birth_date = $_POST['birth_date'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$address_rt = $_POST['address_rt'];
$address_rw = $_POST['address_rw'];
$address_kel_des = $_POST['address_kel_des'];
$address_kec = $_POST['address_kec'];
$religion = $_POST['religion'];
$married_status = $_POST['married_status'];
$job = $_POST['job'];
$national = $_POST['national'];
$username = $_SESSION['username'];


$response = array(); // Initialize response array




function resizeImage($file) {
    list($width, $height, $type) = getimagesize($file);

    // Constants for maximum dimensions
    $maxWidthPortrait = 500; // 15 cm in mm (1 cm = 10 mm)
    $maxHeightLandscape = 500; // 15 cm in mm

    $scale = 1;

    // Check orientation and scale accordingly
    if ($height > $width) {
        // Portrait
        if ($width > $maxWidthPortrait) {
            $scale = $maxWidthPortrait / $width;
        }
    } else {
        // Landscape
        if ($height > $maxHeightLandscape) {
            $scale = $maxHeightLandscape / $height;
        }
    }

    if ($scale < 1) {
        $newWidth = $width * $scale;
        $newHeight = $height * $scale;

        // Create a new image resource with the new dimensions
        $srcImage = imagecreatefromstring(file_get_contents($file));
        $dstImage = imagecreatetruecolor($newWidth, $newHeight);

        // Resample the image
        imagecopyresampled($dstImage, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Save the resized image to a temporary file
        $resizedFile = tempnam(sys_get_temp_dir(), 'resized_') . image_type_to_extension($type);
        imagejpeg($dstImage, $resizedFile, 75); // Save as JPEG with quality reduced to 75

        // Free up memory
        imagedestroy($srcImage);
        imagedestroy($dstImage);

        return $resizedFile;
    }

    // If no resizing is needed, return the original file
    return $file;
}

function imagesToPdf($imageFiles) {
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    // $pdf->SetAuthor('Your Name');
    $pdf->SetTitle($_POST['nik']);
    // $pdf->SetSubject('Converting Images to PDF');
    // $pdf->SetKeywords('TCPDF, PDF, images');

    // Loop through each image file and add it to the PDF
    foreach ($imageFiles as $imageFile) {
        // Add a new page for each image
        $pdf->AddPage();

        $processedImageFile = resizeImage($imageFile);

        // Get image dimensions
        list($width, $height) = getimagesize($processedImageFile);

        // Convert dimensions from pixels to mm (assuming 96 dpi)
        $widthInMm = ($width / 96) * 25.4;
        $heightInMm = ($height / 96) * 25.4;

        // Center the image on the page
        $x = (210 - $widthInMm) / 2;
        $y = (297 - $heightInMm) / 2;

        $pdf->Image($processedImageFile, $x, $y, $widthInMm, $heightInMm, '', '', '', false, 300, '', false, false, 0, false, false, false);

        // Remove the temporary resized file
        if ($processedImageFile !== $imageFile) {
            unlink($processedImageFile);
        }
    }

    return $pdf;
}

// Example usage:
$imageFiles = array(
    // $_FILES['e_ktp']['tmp_name'], // Canvas image file
    $_FILES['file_b1']['tmp_name'], // Additional file
    // $_FILES['additional_file']['tmp_name'] // Image file uploaded through the form
);

$pdfFilePath = '/home/deme5438/public_html/pdfs/' . $nik . '.pdf'; // Path to save the PDF file
$pdf = imagesToPdf($imageFiles);
$pdf->Output($pdfFilePath, 'F'); // Save the PDF file

if($pdf){
    try {
        if ($stmt->execute()) {
            $response['status'] = "success";
            $response['message'] = "Data saved successfully";
        }
    } catch (mysqli_sql_exception $e) {
        unlink($pdfFilePath);
        $error_message = $e->getMessage();
        if (strpos($error_message, "Duplicate entry") !== false) {
            $response['status'] = "error";
            $response['message'] = "NIK sudah terdaftar";
        } else {
            $response['status'] = "error";
            $response['message'] = "Error: " . $error_message;
        }
    }
} else {
    $response['status'] = "error";
    $response['message'] = "Gagal Menyimpan Data";
}


$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);

?>

