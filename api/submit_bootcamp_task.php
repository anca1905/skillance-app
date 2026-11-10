<?php
/**
 * Skillance Bootcamp Submission API
 * Handles student task/project submissions for online code reviews.
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/../config/config.php';

// If GET request, return sample submissions or query by email/whatsapp
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET') {
    $search = $_GET['q'] ?? '';
    $submissions = [];

    if ($conn && $conn instanceof mysqli && !$conn->connect_error) {
        $conn->query("
            CREATE TABLE IF NOT EXISTS academy_bootcamp_submissions (
                id BIGINT AUTO_INCREMENT PRIMARY KEY,
                submission_code VARCHAR(30) UNIQUE NOT NULL,
                nama_siswa VARCHAR(150) NOT NULL,
                email VARCHAR(150) NOT NULL,
                whatsapp VARCHAR(25) NOT NULL,
                kelas_bootcamp VARCHAR(100) NOT NULL,
                judul_proyek VARCHAR(200) NOT NULL,
                github_url VARCHAR(255) NOT NULL,
                demo_url VARCHAR(255) NULL,
                catatan TEXT NULL,
                status VARCHAR(30) NOT NULL DEFAULT 'reviewing',
                reviewer_notes TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");

        if (!empty($search)) {
            $sSafe = $conn->real_escape_string($search);
            $q = $conn->query("SELECT * FROM academy_bootcamp_submissions WHERE submission_code = '$sSafe' OR email = '$sSafe' OR whatsapp = '$sSafe' ORDER BY id DESC LIMIT 10");
        } else {
            $q = $conn->query("SELECT * FROM academy_bootcamp_submissions ORDER BY id DESC LIMIT 10");
        }

        if ($q && $q->num_rows > 0) {
            while ($row = $q->fetch_assoc()) {
                $submissions[] = $row;
            }
        }
    }

    echo json_encode([
        'status' => 'success',
        'data' => $submissions
    ]);
    exit;
}

// Handle POST Submission
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    $input = $_POST;
}

$nama = trim($input['nama'] ?? '');
$email = trim($input['email'] ?? '');
$whatsapp = trim($input['whatsapp'] ?? '');
$kelas = trim($input['kelas'] ?? '');
$judul = trim($input['judul'] ?? '');
$github = trim($input['github'] ?? '');
$demo = trim($input['demo'] ?? '');
$catatan = trim($input['catatan'] ?? '');

if (empty($nama) || empty($email) || empty($whatsapp) || empty($kelas) || empty($judul) || empty($github)) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Mohon lengkapi seluruh formulir yang bertanda bintang (*), termasuk link GitHub proyek Anda.'
    ]);
    exit;
}

$subCode = 'SUB-' . date('Y') . '-' . rand(1000, 9999);

if ($conn && $conn instanceof mysqli && !$conn->connect_error) {
    try {
        $conn->query("
            CREATE TABLE IF NOT EXISTS academy_bootcamp_submissions (
                id BIGINT AUTO_INCREMENT PRIMARY KEY,
                submission_code VARCHAR(30) UNIQUE NOT NULL,
                nama_siswa VARCHAR(150) NOT NULL,
                email VARCHAR(150) NOT NULL,
                whatsapp VARCHAR(25) NOT NULL,
                kelas_bootcamp VARCHAR(100) NOT NULL,
                judul_proyek VARCHAR(200) NOT NULL,
                github_url VARCHAR(255) NOT NULL,
                demo_url VARCHAR(255) NULL,
                catatan TEXT NULL,
                status VARCHAR(30) NOT NULL DEFAULT 'reviewing',
                reviewer_notes TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ");

        $stmt = $conn->prepare("INSERT INTO academy_bootcamp_submissions (submission_code, nama_siswa, email, whatsapp, kelas_bootcamp, judul_proyek, github_url, demo_url, catatan, status, reviewer_notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'reviewing', 'Tugas submission Anda sedang dalam antrean review oleh Tim Software Engineer Skillance. Estimasi evaluasi 1x24 jam kerja.')");
        if ($stmt) {
            $stmt->bind_param("sssssssss", $subCode, $nama, $email, $whatsapp, $kelas, $judul, $github, $demo, $catatan);
            $stmt->execute();
            $stmt->close();
        }
    } catch (Throwable $e) {
        // Fallback silently if DB error
    }
}

echo json_encode([
    'status' => 'success',
    'message' => 'Tugas proyek Anda berhasil disubmit! Tim reviewer akan segera memeriksa kode Anda.',
    'data' => [
        'submission_code' => $subCode,
        'nama_siswa' => $nama,
        'kelas_bootcamp' => $kelas,
        'status' => 'reviewing',
        'status_label' => 'Sedang Direview Tim Ahli',
        'submitted_at' => date('d M Y, H:i') . ' WITA'
    ]
]);
