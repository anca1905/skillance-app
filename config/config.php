<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "if0_41035429_skillance";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Koneksi Database Gagal: " . $conn->connect_error]));
}
