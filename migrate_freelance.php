<?php
require_once __DIR__ . '/config/config.php';

echo "=== Memulai Migrasi Database Freelance Skillance ===\n";

// 1. Perbarui kolom-kolom di tabel users
echo "1. Memperbarui tabel users...\n";

// Ubah enum role users
$alterRoleSql = "ALTER TABLE `users` MODIFY COLUMN `role` ENUM('admin','staff','investor','freelancer','client') NOT NULL DEFAULT 'freelancer'";
if ($conn->query($alterRoleSql)) {
    echo "  - Kolom 'role' berhasil diperbarui (mendukung freelancer & client).\n";
} else {
    echo "  - Warning pada alter role: " . $conn->error . "\n";
}

// Ubah password menjadi NULLABLE (karena login Google tanpa password lokal awal)
$alterPassSql = "ALTER TABLE `users` MODIFY COLUMN `password` VARCHAR(255) NULL";
if ($conn->query($alterPassSql)) {
    echo "  - Kolom 'password' berhasil diset NULLABLE.\n";
} else {
    echo "  - Warning pada alter password: " . $conn->error . "\n";
}

// Cek dan tambahkan kolom-kolom profil tambahan untuk user
$userCols = [
    'google_id' => "VARCHAR(100) NULL UNIQUE AFTER `email`",
    'user_type' => "ENUM('mahasiswa','umum') NULL DEFAULT 'umum' AFTER `role`",
    'institution' => "VARCHAR(150) NULL AFTER `user_type`",
    'major' => "VARCHAR(100) NULL AFTER `institution`",
    'nim' => "VARCHAR(50) NULL AFTER `major`",
    'skills' => "TEXT NULL AFTER `nim`",
    'bio' => "TEXT NULL AFTER `skills`",
    'portfolio_url' => "VARCHAR(255) NULL AFTER `bio`",
    'bank_name' => "VARCHAR(50) NULL AFTER `portfolio_url`",
    'bank_account_number' => "VARCHAR(50) NULL AFTER `bank_name`",
    'bank_account_name' => "VARCHAR(100) NULL AFTER `bank_account_number`"
];

// Ambil kolom yang sudah ada di users
$existingCols = [];
$res = $conn->query("SHOW COLUMNS FROM `users`");
while ($r = $res->fetch_assoc()) {
    $existingCols[] = $r['Field'];
}

foreach ($userCols as $colName => $colDef) {
    if (!in_array($colName, $existingCols)) {
        $sql = "ALTER TABLE `users` ADD COLUMN `$colName` $colDef";
        if ($conn->query($sql)) {
            echo "  - Menambahkan kolom '$colName' ke users.\n";
        } else {
            echo "  - Gagal menambah '$colName': " . $conn->error . "\n";
        }
    } else {
        echo "  - Kolom '$colName' sudah ada.\n";
    }
}

// 2. Buat tabel freelance_jobs
echo "2. Membuat tabel freelance_jobs...\n";
$sqlJobs = "
CREATE TABLE IF NOT EXISTS `freelance_jobs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `client_id` INT(11) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  `category` VARCHAR(100) NOT NULL,
  `target_audience` ENUM('semua','mahasiswa','umum') NOT NULL DEFAULT 'semua',
  `description` TEXT NOT NULL,
  `requirements` TEXT NULL,
  `reward_amount` DECIMAL(15,2) NOT NULL,
  `deadline` DATE NOT NULL,
  `status` ENUM('open','in_progress','completed','closed') NOT NULL DEFAULT 'open',
  `max_freelancers` INT(11) NOT NULL DEFAULT 1,
  `attachment` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";
if ($conn->query($sqlJobs)) {
    echo "  - Tabel freelance_jobs siap.\n";
} else {
    echo "  - Error freelance_jobs: " . $conn->error . "\n";
}

// 3. Buat tabel freelance_assignments
echo "3. Membuat tabel freelance_assignments...\n";
$sqlAssignments = "
CREATE TABLE IF NOT EXISTS `freelance_assignments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `job_id` INT(11) NOT NULL,
  `freelancer_id` INT(11) NOT NULL,
  `status` ENUM('applied','accepted','in_progress','submitted','revision','completed','cancelled') NOT NULL DEFAULT 'applied',
  `application_notes` TEXT NULL,
  `submission_notes` TEXT NULL,
  `submission_link` TEXT NULL,
  `submission_file` VARCHAR(255) NULL,
  `submitted_at` DATETIME NULL,
  `revision_feedback` TEXT NULL,
  `approved_at` DATETIME NULL,
  `rating` INT(11) NULL,
  `review` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `job_id` (`job_id`),
  KEY `freelancer_id` (`freelancer_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";
if ($conn->query($sqlAssignments)) {
    echo "  - Tabel freelance_assignments siap.\n";
} else {
    echo "  - Error freelance_assignments: " . $conn->error . "\n";
}

// 4. Buat tabel freelance_payouts
echo "4. Membuat tabel freelance_payouts...\n";
$sqlPayouts = "
CREATE TABLE IF NOT EXISTS `freelance_payouts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `assignment_id` INT(11) NOT NULL,
  `freelancer_id` INT(11) NOT NULL,
  `amount` DECIMAL(15,2) NOT NULL,
  `bank_name` VARCHAR(50) NOT NULL,
  `account_number` VARCHAR(50) NOT NULL,
  `account_name` VARCHAR(100) NOT NULL,
  `status` ENUM('pending','transferred','rejected') NOT NULL DEFAULT 'pending',
  `transfer_receipt` VARCHAR(255) NULL,
  `transfer_notes` TEXT NULL,
  `transferred_at` DATETIME NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `assignment_id` (`assignment_id`),
  KEY `freelancer_id` (`freelancer_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
";
if ($conn->query($sqlPayouts)) {
    echo "  - Tabel freelance_payouts siap.\n";
} else {
    echo "  - Error freelance_payouts: " . $conn->error . "\n";
}

// 5. Masukkan data dummy pekerjaan freelance awal jika tabel masih kosong (biar langsung kelihatan menarik saat dites)
$countJobs = $conn->query("SELECT COUNT(*) as c FROM `freelance_jobs`")->fetch_assoc()['c'];
if ($countJobs == 0) {
    echo "5. Menambahkan contoh lowongan awal untuk testing...\n";
    
    // Ambil ID admin pertama
    $adminRow = $conn->query("SELECT id FROM `users` WHERE `role` = 'admin' LIMIT 1")->fetch_assoc();
    $adminId = $adminRow ? $adminRow['id'] : 1;
    
    $sampleJobs = [
        [
            'title' => 'Desain Landing Page UI/UX Aplikasi Edukasi (Figma)',
            'category' => 'Desain & UI/UX',
            'target_audience' => 'semua',
            'description' => 'Mendesain tampilan responsif (Desktop & Mobile) untuk landing page platform edukasi mahasiswa. Menggunakan Figma, rapi dengan Auto-layout dan Style Guide sederhana.',
            'requirements' => '1. Mahasiswa atau Umum yang mahir Figma\n2. Melampirkan link file Figma\n3. Waktu pengerjaan maksimal 5 hari',
            'reward_amount' => 350000,
            'deadline' => date('Y-m-d', strtotime('+7 days'))
        ],
        [
            'title' => 'Pembuatan 3 Artikel SEO Tema Teknologi & Coding',
            'category' => 'Penulisan & Konten',
            'target_audience' => 'mahasiswa',
            'description' => 'Menulis 3 artikel orisinal seputar tips belajar web development untuk pemula dan tren AI 2026. Minimal 800 kata per artikel, lolos plagiarism check 100%.',
            'requirements' => '1. Mahasiswa aktif jurusan IT atau Umum yang gemar menulis\n2. Bahasa santai namun edukatif\n3. Penyerahan dalam format Google Docs',
            'reward_amount' => 200000,
            'deadline' => date('Y-m-d', strtotime('+4 days'))
        ],
        [
            'title' => 'Slicing HTML & CSS / Bootstrap 5 untuk Halaman Dashboard',
            'category' => 'Web & Pemrograman',
            'target_audience' => 'semua',
            'description' => 'Mengubah desain antarmuka menjadi kode HTML5/CSS3 berbasis Bootstrap 5 yang bersih, valid, dan responsive di semua ukuran layar.',
            'requirements' => '1. Menguasai HTML5, CSS3, dan Bootstrap 5\n2. Kode rapi & terstruktur\n3. Dikirim via GitHub repository atau ZIP',
            'reward_amount' => 500000,
            'deadline' => date('Y-m-d', strtotime('+10 days'))
        ]
    ];
    
    $stmt = $conn->prepare("INSERT INTO `freelance_jobs` (`client_id`, `title`, `category`, `target_audience`, `description`, `requirements`, `reward_amount`, `deadline`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'open')");
    foreach ($sampleJobs as $job) {
        $stmt->bind_param("isssssds", $adminId, $job['title'], $job['category'], $job['target_audience'], $job['description'], $job['requirements'], $job['reward_amount'], $job['deadline']);
        $stmt->execute();
    }
    echo "  - 3 contoh lowongan freelance awal berhasil ditambahkan!\n";
}

echo "=== Migrasi Selesai dengan Sukses! ===\n";
