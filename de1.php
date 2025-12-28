<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

$data = [
    "DS_XE_CU" => [
        [
            "BIEN_SO" => "51F-12345",
            "TEN_XE" => "Toyota Vios 2018",
            "GIA_BAN" => "400.5"
        ],
        [
            "BIEN_SO" => "30E-367.89",
            "TEN_XE" => "Honda City 2020",
            "GIA_BAN" => "450.35"
        ]
    ]
];

echo json_encode($data);
?>
