<?php
session_start(); // Tambahkan session_start di awal file untuk proteksi backend

// Header wajib untuk API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

// 1. Panggil Koneksi Database
require_once '../config/config.php';

// 2. Terima data JSON dari Frontend
$data = json_decode(file_get_contents("php://input"));

// 3. Cek kelengkapan data
if(!empty($data->email) && !empty($data->password)) {

    $email = $data->email;
    $password = $data->password;

    // 4. Query ke Database (Pakai Prepared Statement biar aman dari SQL Injection)
    $stmt = $conn->prepare("SELECT id, name, email, password, role, photo FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); // 's' artinya string
    $stmt->execute();
    $result = $stmt->get_result();

    // Delay 1 detik untuk memitigasi serangan brute-force
    sleep(1);

    // 5. Cek apakah user ditemukan
    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // 6. Verifikasi Password menggunakan Bcrypt
        if(password_verify($password, $user['password'])) {
            
            // Simpan Session di Server (Sangat Krusial)
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_name'] = $user['name'];

            // Login Sukses
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "message" => "Login berhasil!",
                "user" => [
                    "id" => $user['id'],
                    "name" => $user['name'],
                    "email" => $user['email'],
                    "role" => $user['role']
                ]
            ]);

        } else {
            // Password Salah (Pesan Generik untuk keamanan)
            http_response_code(401);
            echo json_encode([
                "status" => "error",
                "message" => "Email atau password yang Anda masukkan salah."
            ]);
        }

    } else {
        // Email Tidak Ditemukan (Pesan Generik untuk keamanan)
        http_response_code(401);
        echo json_encode([
            "status" => "error",
            "message" => "Email atau password yang Anda masukkan salah."
        ]);
    }

    $stmt->close();

} else {
    // Data Kosong
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Mohon isi email dan password."
    ]);
}

$conn->close();
?>