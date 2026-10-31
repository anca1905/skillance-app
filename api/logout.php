<?php
session_start();
session_unset();
session_destroy();

// Cek apakah request berupa AJAX / Fetch (menginginkan JSON)
$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') ||
          (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) ||
          (isset($_GET['ajax']) && $_GET['ajax'] == '1');

if ($isAjax) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode(["status" => "success", "message" => "Logout berhasil"]);
    exit();
} else {
    // Jika diklik langsung via link <a>: langsung redirect kembali ke halaman login
    header("Location: ../auth/index.php");
    exit();
}
