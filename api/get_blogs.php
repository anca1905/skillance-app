<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once '../config/config.php';

// Menambahkan locale bahasa Indonesia jika tersedia di server
setlocale(LC_TIME, 'id_ID', 'id_ID.utf8', 'id');

$stmt = $conn->prepare("SELECT id, title, category, date, excerpt, image, badge_class FROM blogs ORDER BY date DESC, id DESC LIMIT 6");
$stmt->execute();
$result = $stmt->get_result();
$blogs = [];

while ($row = $result->fetch_assoc()) {
    // Format tanggal menjadi "24 Feb 2026"
    $dateObj = new DateTime($row['date']);
    $bulanIndo = [
        1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
        7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
    ];
    $row['date'] = $dateObj->format('d') . ' ' . $bulanIndo[(int)$dateObj->format('n')] . ' ' . $dateObj->format('Y');

    // Pastikan field image aman (jika format unggahan lokal, otomatis tambahkan prefix jika perlu oleh frontend)
    // Di sini kita asumsikan DB menyimpan "assets/img/blog/namafile.jpg" ATAU URL lengkap
    
    $blogs[] = $row;
}

echo json_encode(["status" => "success", "data" => $blogs]);
?>