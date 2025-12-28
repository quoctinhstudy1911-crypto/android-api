<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

// lấy dữ liệu từ client gửi POST lên
$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

// kiểm tra
if($username === "admin" && $password === "123"){
    echo json_encode(["SUCCESS" => "TRUE"]);
} else {
    echo json_encode(["SUCCESS" => "FALSE"]);
}
?>
