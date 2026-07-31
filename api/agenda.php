<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");

require_once '../config/config.php';

$method = $_SERVER['REQUEST_METHOD'];

// Handle POST request (Create, Update Status, Delete)
if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) $data = $_POST;

    $action = $conn->real_escape_string($data['action'] ?? 'add');

    if ($action === 'add') {
        $title = $conn->real_escape_string($data['title']);
        $date = $conn->real_escape_string($data['date']);
        $time = $conn->real_escape_string($data['time']);
        $location = $conn->real_escape_string($data['location']);
        $priority = $conn->real_escape_string($data['priority']);

        $sql = "INSERT INTO agendas (title, date, time, location, priority) VALUES ('$title', '$date', '$time', '$location', '$priority')";
        if ($conn->query($sql)) {
            echo json_encode(["status" => "success", "message" => "Agenda berhasil ditambahkan"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal: " . $conn->error]);
        }
    } else if ($action === 'complete') {
        $id = (int)$data['id'];
        if ($conn->query("UPDATE agendas SET status='completed' WHERE id=$id")) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal"]);
        }
    } else if ($action === 'delete') {
        $id = (int)$data['id'];
        if ($conn->query("DELETE FROM agendas WHERE id=$id")) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal"]);
        }
    }
    exit();
}

echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan"]);
