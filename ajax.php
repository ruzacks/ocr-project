<?php

include('connection.php');

if (isset($_GET['func'])) {
    // Get the value of the 'func' parameter
    $functionName = $_GET['func'];

    // Call the corresponding function based on the 'func' parameter
    if ($functionName === 'getAllData') {
        getAllData();
    } else {
        // Handle the case where the function name is not recognized
        header('Content-Type: application/json');
        echo json_encode(array("status" => "error", "message" => "Function not recognized"));
    }
} else {
    // Handle the case where the 'func' parameter is not set
    header('Content-Type: application/json');
    echo json_encode(array("status" => "error", "message" => "No function specified"));
}


function getAllData() {
    $conn = getConn();
    $query = "SELECT nik, nama, address_kel_des, address_kec, status FROM ektps";
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
?>