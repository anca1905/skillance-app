<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/config.php';

$response = [
    "status" => "success",
    "total_omzet" => 0,
    "active_projects" => 0,
    "recent_projects" => [],
    "agendas" => [],
    "chart_data" => [
        "labels" => [],
        "data_omzet" => []
    ]
];

// 0. Ambil Data Chart 7 Hari Terakhir
$days_id = [
    'Sunday' => 'Minggu',
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu'
];

for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $day_name = date('l', strtotime($date));

    $response['chart_data']['labels'][] = $days_id[$day_name];

    $response['chart_data']['labels'][] = $days_id[$day_name];

    // Income
    $q_income = $conn->query("SELECT SUM(amount) as total FROM finances WHERE type='income' AND date='$date'");
    $row_income = $q_income->fetch_assoc();
    $response['chart_data']['data_omzet'][] = (float)($row_income['total'] ?? 0);

    // Expense
    $q_expense = $conn->query("SELECT SUM(amount) as total FROM finances WHERE type='expense' AND date='$date'");
    $row_expense = $q_expense->fetch_assoc();
    $response['chart_data']['data_pengeluaran'][] = (float)($row_expense['total'] ?? 0);
}


// 1. Total Omzet dari `finances` (Hanya Pemasukan)
$q_omzet = $conn->query("SELECT SUM(amount) as total FROM finances WHERE type='income'");
if ($q_omzet && $row = $q_omzet->fetch_assoc()) {
    $response['total_omzet'] = (float)$row['total'];
}

// 2. Project Aktif (Tidak sama dengan 'Selesai')
$q_active = $conn->query("SELECT COUNT(*) as total FROM projects WHERE status != 'Selesai'");
if ($q_active && $row = $q_active->fetch_assoc()) {
    $response['active_projects'] = (int)$row['total'];
}

// 3. Project Terbaru (Max 5)
$q_recent = $conn->query("SELECT name, client_name, deadline, status FROM projects ORDER BY created_at DESC LIMIT 5");
if ($q_recent) {
    while ($row = $q_recent->fetch_assoc()) {
        $dateObj = date_create($row['deadline']);
        $deadline_fmt = $dateObj ? date_format($dateObj, "d M") : "-";

        $response['recent_projects'][] = [
            "name" => $row['name'],
            "client_name" => $row['client_name'],
            "deadline_formatted" => $deadline_fmt,
            "status" => $row['status']
        ];
    }
}

// 4. Daftar Agenda Mendesak (Pending, urut tanggal & waktu terdekat)
$q_agenda = $conn->query("SELECT * FROM agendas WHERE status='pending' ORDER BY date ASC, time ASC LIMIT 6");
if ($q_agenda) {
    while ($row = $q_agenda->fetch_assoc()) {
        $dateObj = date_create($row['date']);
        $today = date("Y-m-d");
        $tomorrow = date('Y-m-d', strtotime('+1 day'));

        $date_fmt = $dateObj ? date_format($dateObj, "d M Y") : "-";
        if ($row['date'] == $today) $date_fmt = "Hari Ini";
        else if ($row['date'] == $tomorrow) $date_fmt = "Besok";

        $timeObj = date_create($row['time']);
        $time_fmt = $timeObj ? date_format($timeObj, "H:i") : "-";

        $response['agendas'][] = [
            "id" => $row['id'],
            "title" => $row['title'],
            "date_formatted" => $date_fmt,
            "time" => $time_fmt,
            "location" => $row['location'],
            "priority" => $row['priority']
        ];
    }
}

echo json_encode($response);
