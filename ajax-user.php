<?php

use PhpOffice\PhpSpreadsheet\Worksheet\Validations;

include('connection.php');

session_start();

if (isset($_GET['func']) || isset($_POST['func'])) {
    // Get the value of the 'func' parameter
    if (isset($_GET['func'])) {
        $functionName = $_GET['func'];
    } else if (isset($_POST['func'])) {
        $functionName = $_POST['func'];
    }

    // Call the corresponding function based on the 'func' parameter
    if ($functionName === 'getAllUser') {
        getAllUser();
    } else if ($functionName === 'addUser') {
        addUser();
    } else if ($functionName === 'editUser') {
        editUser();
    } else if ($functionName === 'changePassword') {
        changePassword();
    } else if ($functionName === 'changeUserStatus') {
        changeUserStatus();
    }
}

function getAllUser(){
    $conn = getConn();

    $sql = "SELECT username, password_string, phone, address, role, status FROM users";

    $result = mysqli_query($conn, $sql);

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

function addUser(){
    // Assuming you're handling POST data securely, like through validation and sanitization
    $conn = getConn();

    if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['phone']) || empty($_POST['address']) || empty($_POST['role'])) {
        header("Location: {$_SERVER['HTTP_REFERER']}?error=Please fill in all required fields.");
        exit();
    }

    // Fetch POST data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $password = password_hash($pass, PASSWORD_DEFAULT); // Hash the password securely

    // Check if the username already exists
    $check_username_sql = "SELECT COUNT(*) as count FROM users WHERE username = '$username'";
    $check_username_result = mysqli_query($conn, $check_username_sql);
    $row = mysqli_fetch_assoc($check_username_result);
    if ($row['count'] > 0) {
        // Username already exists
        $error_message = urlencode("Username is already taken. Please choose a different one.");

        header("Location: {$_SERVER['HTTP_REFERER']}?error=$error_message");
        exit(); // Stop further execution
    }

    // Insert the user into the database
    $sql = "INSERT INTO users (username, phone, address, role, password, password_string) VALUES ('$username', '$phone', '$address', '$role', '$password', $pass)";
    if (mysqli_query($conn, $sql)) {
        // User added successfully
        header("Location: user-list.php?success=User created successfully.");
        exit();
    } else {
        // Error in adding user
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

function editUser(){
    // Assuming you're handling POST data securely, like through validation and sanitization
    $conn = getConn();

    if(empty($_POST['username']) || empty($_POST['phone']) || empty($_POST['address']) || empty($_POST['role'])) {
        header("Location: {$_SERVER['HTTP_REFERER']}?error=Please fill in all required fields.");
        exit();
    }

    // Fetch POST data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Insert the user into the database
    $sql = "UPDATE users SET phone = '$phone', address = '$address', role = '$role' WHERE username = '$username'";

    if (mysqli_query($conn, $sql)) {
        // User added successfully
        $username = $_SESSION['username'];
        header("Location: user-edit.php?username=$username&success=User data updated.");
        exit();
    } else {
        // Error in adding user
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

function changeUserStatus(){
    $conn = getConn();

    $username = mysqli_escape_string($conn, $_POST['username']);
    $status = mysqli_escape_string($conn, $_POST['status']);

    $sql = "UPDATE users set status='$status' WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

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

function changePassword(){
    // Assuming you're handling POST data securely, like through validation and sanitization
    $conn = getConn();
    $username = $_POST['username'];
    $role = $_SESSION['role'];

    if(empty($_POST['npass']) || empty($_POST['vpass'])) {
        header("Location: {$_SERVER['HTTP_REFERER']}?error=Please fill in all required fields.");
        exit();
    }

    // Fetch POST data
    $currentPassword= mysqli_real_escape_string($conn, $_POST['cpass']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['npass']);
    $verifyPassword = mysqli_real_escape_string($conn, $_POST['vpass']);

    //Validate VALUE
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (($user && password_verify($currentPassword, $user['password'])) || $role == 'administrator') {
        if ($newPassword == $verifyPassword){
            $password =  password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = '$password', password_string = '$newPassword'  WHERE username = '$username'";

            if (mysqli_query($conn, $sql)) {
                // User added successfully
                header("Location: user-edit.php?username=$username&success=User password updated.");
                exit();
            } else {
                // Error in adding user
                header("Location: user-edit.php?username=$username&error=User password update failed.");
                exit();
            }
        } else {
            header("Location: user-edit.php?username=$username&error=User password not macth.");
            exit();
        }
    } else {
        header("Location: user-edit.php?username=$username&error=User password not macth.");
        exit();
    }


    // Insert the user into the database

    mysqli_close($conn);
}


?>