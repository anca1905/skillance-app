<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once '../config/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    echo json_encode(["status" => "error", "message" => "ID Artikel tidak valid."]);
    exit();
}

$stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $blog = $result->fetch_assoc();
    
    // Format tanggal
    $dateObj = new DateTime($blog['date']);
    $bulanIndo = [
        1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
        7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
    ];
    $blog['date'] = $dateObj->format('d') . ' ' . $bulanIndo[(int)$dateObj->format('n')] . ' ' . $dateObj->format('Y');
    
    echo json_encode(["status" => "success", "data" => $blog]);
} else {
    echo json_encode(["status" => "error", "message" => "Artikel tidak ditemukan."]);
}
?>
