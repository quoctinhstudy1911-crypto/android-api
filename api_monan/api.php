<?php
header("Content-Type: application/json; charset=UTF-8");


// =====================================
// KẾT NỐI POSTGRESQL
// =====================================
try {

    $dsn = "pgsql:host=dpg-d58r106uk2gs73dggclg-a.singapore-postgres.render.com;port=5432;dbname=monan_db";
    $user = "monan_user";
    $pass = "YOUR_PASSWORD_HERE";

    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET NAMES 'UTF8'");

} catch(Exception $e) {
    echo json_encode(["message" => "error_db"]);
    exit;
}



// =====================================
// ========= 1️⃣  XỬ LÝ GET  ============
// =====================================
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    if(!isset($_GET["action"]) || !isset($_GET["mssv"])) {
        echo json_encode(["message" => "error_param"]);
        exit;
    }

    $action = $_GET["action"];
    $mssv   = $_GET["mssv"];

    // GET ALL
    if($action == "getallmonan") {

        $stmt = $conn->prepare("SELECT * FROM monan WHERE mssv = :mssv");
        $stmt->execute(["mssv" => $mssv]);

        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    else {
        echo json_encode(["message" => "unknown_action"]);
    }

    exit;
}






// =====================================
// ========= 2️⃣  XỬ LÝ POST ============
// =====================================
if ($_SERVER["REQUEST_METHOD"] === "POST") {



    // Lấy body POST
    $action = $_POST["action"] ?? null;
    $mssv   = $_POST["mssv"] ?? null;

    if(!$action || !$mssv){
        echo json_encode(["message"=>"error_param"]);
        exit;
    }


    // ================= ADD =================
    if($action == "addsinglemon") {

        if(!isset($_POST["tenmon"])) {
            echo json_encode(["message"=>"0"]);
            exit;
        }

        $ten = $_POST["tenmon"];

        $stmt = $conn->prepare(
            "INSERT INTO monan(ten, mssv) VALUES(:ten, :mssv)"
        );

        if($stmt->execute(["ten"=>$ten,"mssv"=>$mssv])) {
            $id = $conn->lastInsertId("monan_ma_seq");
            echo json_encode(["message"=>$id]);
        }
        else echo json_encode(["message"=>"0"]);
    }



    // ================= DELETE =================
    else if($action == "delete") {

        if(!isset($_POST["idmonan"])) {
            echo json_encode(["message"=>"0"]);
            exit;
        }

        $id = $_POST["idmonan"];

        $stmt = $conn->prepare(
            "DELETE FROM monan 
             WHERE ma = :id 
             AND mssv = :mssv"
        );

        $stmt->execute(["id"=>$id,"mssv"=>$mssv]);

        echo json_encode(["message"=>$stmt->rowCount()]);
    }

    // ================= UPDATE =================
else if($action == "update") {

    if(!isset($_POST["idmonan"]) || !isset($_POST["tenmon"])) {
        echo json_encode(["message"=>"0"]);
        exit;
    }

    $id  = $_POST["idmonan"];
    $ten = $_POST["tenmon"];

    $stmt = $conn->prepare(
        "UPDATE monan 
         SET ten = :ten 
         WHERE ma = :id 
         AND mssv = :mssv"
    );

    $stmt->execute([
        "ten"  => $ten,
        "id"   => $id,
        "mssv" => $mssv
    ]);

    echo json_encode(["message"=>$stmt->rowCount()]);
}



    else echo json_encode(["message"=>"unknown_action"]);

    exit;
}



// =====================================
// Nếu không phải GET hoặc POST
// =====================================
echo json_encode(["message"=>"method_not_allowed"]);

?>
