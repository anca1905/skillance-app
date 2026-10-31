<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once '../config/config.php';

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->email) && !empty($data->password)) {

    $email = trim($data->email);
    $password = $data->password;

    $stmt = $conn->prepare("SELECT id, name, email, password, role, photo, user_type FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    sleep(1);

    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if(!empty($user['password']) && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_photo'] = $user['photo'];
            $_SESSION['user_type'] = $user['user_type'] ?? 'umum';

            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "message" => "Login berhasil!",
                "user" => [
                    "id" => $user['id'],
                    "name" => $user['name'],
                    "email" => $user['email'],
                    "role" => $user['role'],
                    "photo" => $user['photo'],
                    "user_type" => $user['user_type'] ?? 'umum'
                ]
            ]);

        } else {
            http_response_code(401);
            echo json_encode([
                "status" => "error",
                "message" => "Email atau password yang Anda masukkan salah."
            ]);
        }

    } else {
        http_response_code(401);
        echo json_encode([
            "status" => "error",
            "message" => "Email atau password yang Anda masukkan salah."
        ]);
    }

    $stmt->close();

} else {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Mohon isi email dan password."
    ]);
}

$conn->close();
?>
