<?php
// Dynamic Open Graph Image Generator for Freelance Jobs
require_once __DIR__ . '/../config/config.php';

$jobId = intval($_GET['id'] ?? 0);
$defaultImg = __DIR__ . '/../assets/img/og-preview.png';

if ($jobId <= 0) {
    if (file_exists($defaultImg)) {
        header('Content-Type: image/png');
        header('Cache-Control: public, max-age=86400');
        readfile($defaultImg);
        exit();
    }
    exit('No preview available');
}

$stmt = $conn->prepare("SELECT title, category, reward_amount, deadline, target_audience FROM freelance_jobs WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $jobId);
$stmt->execute();
$res = $stmt->get_result();
$job = $res->fetch_assoc();
$stmt->close();

if (!$job) {
    if (file_exists($defaultImg)) {
        header('Content-Type: image/png');
        readfile($defaultImg);
        exit();
    }
    exit('Job not found');
}

// Data
$title = $job['title'] ?? 'Lowongan Pekerjaan';
$category = strtoupper($job['category'] ?? 'Freelance');
$reward = 'Rp ' . number_format($job['reward_amount'], 0, ',', '.');
$target = 'Target: ' . ucfirst($job['target_audience'] ?? 'Semua');
$deadline = 'Batas: ' . date('d M Y', strtotime($job['deadline']));

// Determine font path (cross-platform Windows & Linux)
$fontPaths = [
    '/usr/share/fonts/truetype/liberation/LiberationSans-Bold.ttf',
    '/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf',
    '/usr/share/fonts/truetype/lato/Lato-Bold.ttf',
    'C:\\Windows\\Fonts\\arialbd.ttf',
    'C:\\Windows\\Fonts\\segoeui.ttf',
    __DIR__ . '/LiberationSans-Bold.ttf'
];

$fontBold = null;
foreach ($fontPaths as $fp) {
    if (file_exists($fp)) {
        $fontBold = $fp;
        break;
    }
}

// Fallback to regular Liberation / Arial
$fontRegular = $fontBold;
$fontPathsRegular = [
    '/usr/share/fonts/truetype/liberation/LiberationSans-Regular.ttf',
    '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf',
    'C:\\Windows\\Fonts\\arial.ttf'
];
foreach ($fontPathsRegular as $fp) {
    if (file_exists($fp)) {
        $fontRegular = $fp;
        break;
    }
}

// Create 1200x630 image
$width = 1200;
$height = 630;
$im = imagecreatetruecolor($width, $height);

// Colors
$cNavyDark = imagecolorallocate($im, 6, 26, 53);    # #061a35
$cNavy     = imagecolorallocate($im, 13, 46, 92);   # #0d2e5c
$cGold     = imagecolorallocate($im, 252, 163, 17); # #fca311
$cWhite    = imagecolorallocate($im, 255, 255, 255);
$cSlate    = imagecolorallocate($im, 203, 213, 225);# #cbd5e1
$cGreen    = imagecolorallocate($im, 34, 197, 94);  # #22c55e
$cCardBg   = imagecolorallocate($im, 16, 42, 82);
$cBorder   = imagecolorallocate($im, 30, 65, 120);

// Draw gradient background
for ($y = 0; $y < $height; $y++) {
    $ratio = $y / $height;
    $r = (int)(6 + (13 - 6) * $ratio);
    $g = (int)(26 + (46 - 26) * $ratio);
    $b = (int)(53 + (92 - 53) * $ratio);
    $col = imagecolorallocate($im, $r, $g, $b);
    imageline($im, 0, $y, $width, $y, $col);
}

// Top accent gold line
imagefilledrectangle($im, 0, 0, $width, 8, $cGold);

// Inner border
imagerectangle($im, 30, 30, $width - 30, $height - 30, $cBorder);

if ($fontBold) {
    // Header brand & tag
    imagettftext($im, 18, 0, 80, 85, $cGold, $fontBold, "BURSA FREELANCE  •  SKILLANCE DIGITAL INDONESIA");
    
    // Category pill
    imagefilledrectangle($im, 80, 115, 80 + (strlen($category) * 14) + 24, 155, $cCardBg);
    imagerectangle($im, 80, 115, 80 + (strlen($category) * 14) + 24, 155, $cGold);
    imagettftext($im, 14, 0, 92, 142, $cGold, $fontBold, $category);

    // Job Title (word wrap to max 42 chars per line)
    $words = explode(" ", $title);
    $lines = [];
    $currentLine = "";
    foreach ($words as $w) {
        if (strlen($currentLine . " " . $w) <= 38) {
            $currentLine .= ($currentLine === "" ? "" : " ") . $w;
        } else {
            if (!empty($currentLine)) $lines[] = $currentLine;
            $currentLine = $w;
        }
    }
    if (!empty($currentLine)) $lines[] = $currentLine;

    $titleY = 210;
    foreach (array_slice($lines, 0, 3) as $l) {
        imagettftext($im, 32, 0, 80, $titleY, $cWhite, $fontBold, $l);
        $titleY += 48;
    }

    // Fee Highlight Box
    $boxY = 360;
    imagefilledrectangle($im, 80, $boxY, $width - 80, $boxY + 140, $cCardBg);
    imagerectangle($im, 80, $boxY, $width - 80, $boxY + 140, $cBorder);
    imagefilledrectangle($im, 80, $boxY, 86, $boxY + 140, $cGold); // Gold left indicator

    imagettftext($im, 15, 0, 110, $boxY + 40, $cSlate, $fontRegular, "FEE / IMBALAN PEKERJAAN (TRANSFER MANUAL):");
    imagettftext($im, 40, 0, 110, $boxY + 105, $cGold, $fontBold, $reward);

    // Right side of highlight box: Target & Deadline
    imagettftext($im, 18, 0, 750, $boxY + 55, $cWhite, $fontBold, $target);
    imagettftext($im, 18, 0, 750, $boxY + 100, $cSlate, $fontRegular, $deadline);

    // Bottom bar
    imageline($im, 80, 545, $width - 80, 545, $cBorder);
    imagettftext($im, 16, 0, 80, 580, $cSlate, $fontRegular, "Daftar & ambil pekerjaan langsung di:");
    imagettftext($im, 18, 0, 420, 580, $cGold, $fontBold, "https://skillance.my.id/job.php?id=" . $jobId);
} else {
    // Basic fallback without TTF
    imagestring($im, 5, 80, 80, "BURSA FREELANCE - SKILLANCE", $cGold);
    imagestring($im, 5, 80, 120, $title, $cWhite);
    imagestring($im, 5, 80, 160, "FEE: " . $reward, $cGold);
}

header('Content-Type: image/png');
header('Cache-Control: public, max-age=1800');
imagepng($im);
imagedestroy($im);
