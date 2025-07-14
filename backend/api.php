<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Database connection details
$host = 'mysql-service';     // Kubernetes service name
$db   = 'ci';        // Database name (created in MySQL deployment)
$user = 'root';              // MySQL root user (from MYSQL_ROOT_PASSWORD)
$pass = 'root';              // MySQL root password (set in deployment env)
$charset = 'utf8mb4';
``
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // Connect to database
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Query latest message
    $stmt = $pdo->query("SELECT content FROM messages ORDER BY id DESC LIMIT 1");
    $row = $stmt->fetch();

    echo json_encode([
        "status" => "successful",
        "message" => $row['content'],
        "timestamp" => date("Y-m-d H:i:s")
    ]);
} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . $e->getMessage()
    ]);
}
// Close the connection
$pdo = null;    
?>




