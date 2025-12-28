<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

// lấy dữ liệu từ client gửi POST lên
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";
} 
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $username = $_GET['username'] ?? "";
    $password = $_GET['password'] ?? "";
} 
else {
    echo json_encode(["SUCCESS" => false, "MESSAGE" => "Unsupported method"]);
    exit;
}

?>
