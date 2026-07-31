<?php
require_once '../config/config.php';

$data = [
    'name' => 'Sistem Antrian RS',
    'platform' => 'Web App',
    'client_name' => 'RS Sejahtera',
    'deadline' => '2026-04-10',
    'status' => 'Development',
    'payment' => 'DP 50%'
];

$name = $conn->real_escape_string($data['name']);
$platform = $conn->real_escape_string($data['platform']);
$client_name = $conn->real_escape_string($data['client_name']);
$deadline = $conn->real_escape_string($data['deadline']);
$status = $conn->real_escape_string($data['status']);
$payment = $conn->real_escape_string($data['payment']);

try {
    $sql = "INSERT INTO projects (name, platform, client_name, deadline, status, payment) VALUES ('$name', '$platform', '$client_name', '$deadline', '$status', '$payment')";
    echo "SQL: $sql\n";
    if ($conn->query($sql)) {
        echo "Success\n";
    } else {
        echo "Error: " . $conn->error . "\n";
    }
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n";
}
