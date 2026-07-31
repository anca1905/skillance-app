<?php
// Izinkan akses dari mana saja (CORS - penting buat API)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

// 1. Terima data JSON dari JavaScript
$data = json_decode(file_get_contents("php://input"));

// 2. Cek apakah data lengkap
if(
    !empty($data->name) &&
    !empty($data->phone) &&
    !empty($data->message)
){
    // DISINI LOGIKA SIMPAN KE DATABASE (Nanti kita buat)
    // Untuk sekarang, kita pura-pura sukses dulu
    
    // Kirim balasan sukses ke Javascript
    http_response_code(200);
    echo json_encode([
        "status" => "success",
        "message" => "Terima kasih, " . $data->name . "! Pesan Anda sudah kami terima."
    ]);
} else {
    // Kirim balasan gagal
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak lengkap!"
    ]);
}
?>