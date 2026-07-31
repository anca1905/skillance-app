<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/config.php'; // Panggil koneksi database

// Ambil project yang statusnya 'Selesai' (Maksimal 6 terbaru)
$query = "SELECT id, name, client_name, platform, cover_image FROM projects WHERE status = 'Selesai' ORDER BY id DESC LIMIT 6";
$result = $conn->query($query);

$portfolio = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $portfolio[] = [
            "id" => $row['id'],
            "name" => $row['name'],
            "client_name" => $row['client_name'],
            "platform" => $row['platform'],
            // Jika tidak ada cover, beri gambar default
            "image" => $row['cover_image'] ? 'storage/' . $row['cover_image'] : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'
        ];
    }
}

echo json_encode(["status" => "success", "data" => $portfolio]);

$conn->close();
?>