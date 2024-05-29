<?php
// Create connection
function getConn(){

$servername = "localhost"; // Database server
$username = "root"; // Database username
$password = "dbadmin"; // Database password
$dbname = "e_ktp_ocr"; // Database name

    $conn = new mysqli($servername, $username, $password, $dbname);
    return $conn;
}

?>