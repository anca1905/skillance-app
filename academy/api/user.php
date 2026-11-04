<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

if (!empty($_SESSION['user_id'])) {
    echo json_encode([
        'logged_in' => true,
        'user' => [
            'id'    => $_SESSION['user_id'],
            'name'  => $_SESSION['user_name'] ?? 'User',
            'email' => $_SESSION['user_email'] ?? '',
            'photo' => $_SESSION['user_photo'] ?? null,
            'role'  => $_SESSION['user_role'] ?? 'freelancer',
            'type'  => $_SESSION['user_type'] ?? 'umum'
        ]
    ]);
} else {
    echo json_encode([
        'logged_in' => false
    ]);
}
