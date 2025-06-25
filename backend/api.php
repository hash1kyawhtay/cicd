<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");


$data = [
    "status" => "success",
    "message" => "Hello from backend!",
    "timestamp" => date('Y-m-d H:i:s')
];

echo json_encode($data);
