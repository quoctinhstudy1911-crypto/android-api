<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";
} 
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $username = $_GET['username'] ?? "";
    $password = $_GET['password'] ?? "";
} 
else {
    echo json_encode(["SUCCESS" => "FALSE", "MESSAGE" => "Unsupported method"]);
    exit;
}

// ==== XỬ LÝ LOGIN ====
if($username === "admin" && $password === "123"){
    echo json_encode(["SUCCESS" => "TRUE"]);
}
else {
    echo json_encode(["SUCCESS" => "FALSE"]);
}
?>
