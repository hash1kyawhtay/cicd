<?php
header('Content-Type: application/json');

$endpoint = $_GET['endpoint'] ?? '';

switch ($endpoint) {
    case 'data1':
        echo json_encode(['id' => 1, 'name' => 'Data One', 'value' => 100]);
        break;
    case 'data2':
        echo json_encode(['id' => 2, 'name' => 'Data Two', 'value' => 200]);
        break;
    case 'data3':
        echo json_encode(['id' => 3, 'name' => 'Data Three', 'value' => 300]);
        break;
    default:
        echo json_encode(['error' => 'Invalid endpoint']);
}
?>
