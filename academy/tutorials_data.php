<?php
// Skillance Academy - Data Materi Tutorial Skillance Academy Indonesia

$htmlData = require __DIR__ . '/data/html_tutorial.php';
$htmlCategories = $htmlData['categories'] ?? [];
$htmlFlattenedTopics = [];
foreach ($htmlCategories as $catName => $catTopics) {
    foreach ($catTopics as $tKey => $tData) {
        $htmlFlattenedTopics[$tKey] = $tData;
    }
}

$cssData = require __DIR__ . '/data/css_tutorial.php';
$cssCategories = $cssData['categories'] ?? [];
$cssFlattenedTopics = [];
foreach ($cssCategories as $catName => $catTopics) {
    foreach ($catTopics as $tKey => $tData) {
        $cssFlattenedTopics[$tKey] = $tData;
    }
}

$jsData = require __DIR__ . '/data/js_tutorial.php';
$jsCategories = $jsData['categories'] ?? [];
$jsFlattenedTopics = [];
foreach ($jsCategories as $catName => $catTopics) {
    foreach ($catTopics as $tKey => $tData) {
        $jsFlattenedTopics[$tKey] = $tData;
    }
}

$phpData = require __DIR__ . '/data/php_tutorial.php';
$phpCategories = $phpData['categories'] ?? [];
$phpFlattenedTopics = [];
foreach ($phpCategories as $catName => $catTopics) {
    foreach ($catTopics as $tKey => $tData) {
        $phpFlattenedTopics[$tKey] = $tData;
    }
}

$sqlData = require __DIR__ . '/data/sql_tutorial.php';
$sqlCategories = $sqlData['categories'] ?? [];
$sqlFlattenedTopics = [];
foreach ($sqlCategories as $catName => $catTopics) {
    foreach ($catTopics as $tKey => $tData) {
        $sqlFlattenedTopics[$tKey] = $tData;
    }
}

$jqueryData = require __DIR__ . '/data/jquery_tutorial.php';
$jqueryCategories = $jqueryData['categories'] ?? [];
$jqueryFlattenedTopics = [];
foreach ($jqueryCategories as $catName => $catTopics) {
    foreach ($catTopics as $tKey => $tData) {
        $jqueryFlattenedTopics[$tKey] = $tData;
    }
}

$tutorials = [
    'html' => [
        'name' => 'HTML Tutorial',
        'short_name' => 'HTML',
        'badge' => 'Pemula ke Mahir',
        'icon' => 'fa-brands fa-html5',
        'color' => '#e34f26',
        'desc' => 'HTML adalah bahasa standar untuk membuat dan menstrukturkan halaman web.',
        'categories' => $htmlCategories,
        'topics' => $htmlFlattenedTopics
    ],
    'css' => [
        'name' => 'CSS Tutorial',
        'short_name' => 'CSS',
        'badge' => 'Pemula ke Mahir',
        'icon' => 'fa-brands fa-css3-alt',
        'color' => '#264de4',
        'desc' => 'CSS adalah bahasa yang digunakan untuk menata tampilan, warna, tipografi, dan tata letak halaman web.',
        'categories' => $cssCategories,
        'topics' => $cssFlattenedTopics
    ],
    'javascript' => [
        'name' => 'JavaScript Tutorial',
        'short_name' => 'JavaScript',
        'badge' => 'Pemula ke Mahir',
        'icon' => 'fa-brands fa-js',
        'color' => '#ca8a04',
        'desc' => 'JavaScript adalah bahasa pemrograman resmi web yang membuat halaman interaktif, dinamis, dan hidup.',
        'categories' => $jsCategories,
        'topics' => $jsFlattenedTopics
    ],
    'php' => [
        'name' => 'PHP & MySQL Tutorial',
        'short_name' => 'PHP & MySQL',
        'badge' => 'Pemula ke Mahir',
        'icon' => 'fa-brands fa-php',
        'color' => '#777bb4',
        'desc' => 'PHP adalah bahasa pemrograman server-side dan database MySQL yang menjadi fondasi 75%+ website di internet.',
        'categories' => $phpCategories,
        'topics' => $phpFlattenedTopics
    ],
    'sql' => [
        'name' => 'SQL Database Tutorial',
        'short_name' => 'SQL',
        'badge' => 'Pemula ke Mahir',
        'icon' => 'fa-solid fa-database',
        'color' => '#00758f',
        'desc' => 'SQL adalah bahasa standar internasional untuk mengakses, merancang, dan mengelola database relasional.',
        'categories' => $sqlCategories,
        'topics' => $sqlFlattenedTopics
    ],
    'jquery' => [
        'name' => 'jQuery Tutorial',
        'short_name' => 'jQuery',
        'badge' => 'Pemula ke Mahir',
        'icon' => 'fa-solid fa-bolt',
        'color' => '#0769ad',
        'desc' => 'jQuery adalah pustaka JavaScript ringkas yang menyederhanakan manipulasi HTML, event, animasi, dan penanganan AJAX.',
        'categories' => $jqueryCategories,
        'topics' => $jqueryFlattenedTopics
    ],
    'flutter' => [
        'name' => 'Flutter Mobile Tutorial',
        'short_name' => 'Flutter',
        'badge' => 'Multiplatform App',
        'icon' => 'fa-solid fa-mobile-screen-button',
        'color' => '#0284c7',
        'desc' => 'Flutter adalah toolkit UI dari Google untuk membangun aplikasi mobile native Android & iOS dari satu basis kode.',
        'topics' => [
            'intro' => [
                'title' => 'Flutter Pengenalan & Bahasa Dart',
                'summary' => 'Memahami ekosistem Flutter, keunggulan single codebase Android & iOS, dan dasar bahasa Dart.',
                'content' => '
                    <p class="lead">Flutter dikembangkan oleh Google untuk memungkinkan programmer membuat aplikasi Android, iOS, web, dan desktop hanya dengan satu basis kode (single codebase) menggunakan bahasa pemrograman <strong>Dart</strong>.</p>

                    <h4>Keunggulan Utama Flutter:</h4>
                    <ul>
                        <li><strong>Hot Reload</strong>: Perubahan kode langsung tampil di layar emulator/HP dalam hitungan milidetik tanpa merestart aplikasi.</li>
                        <li><strong>Performa Native</strong>: Flutter dikompilasi langsung ke kode mesin ARM native melalui engine grafis Skia / Impeller.</li>
                        <li><strong>Sound Null Safety</strong>: Mencegah error crash null pointer exception saat aplikasi dijalankan.</li>
                    </ul>
                ',
                'example_title' => 'Simulasi Tampilan Widget Flutter',
                'example_code' => '<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 250px; background: #e0f2fe; margin: 0; }
        .phone { width: 220px; height: 260px; background: white; border-radius: 24px; border: 4px solid #0284c7; box-shadow: 0 10px 20px rgba(0,0,0,0.1); display: flex; flex-direction: column; overflow: hidden; }
        .appbar { background: #0284c7; color: white; padding: 12px; font-weight: bold; text-align: center; font-size: 0.8rem; }
        .body { flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 10px; }
        .btn-fab { background: #0284c7; color: white; border: none; width: 36px; height: 36px; border-radius: 50%; font-size: 20px; cursor: pointer; margin-top: 10px; }
    </style>
</head>
<body>

    <div class="phone">
        <div class="appbar">Aplikasi Flutter Pertama</div>
        <div class="body">
            <span style="font-size:0.75rem; color:#64748b;">Tombol Ditekan:</span>
            <h2 id="angkaCounter" style="margin:5px 0; color:#0284c7;">0</h2>
            <button class="btn-fab" onclick="let el=document.getElementById(\'angkaCounter\'); el.innerText=parseInt(el.innerText)+1;">+</button>
        </div>
    </div>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Konsep "Everything is a Widget":</h5>
                    <p>Di Flutter, hampir seluruh elemen tampilan adalah Widget: teks adalah Text widget, tombol adalah ElevatedButton, tata letak adalah Row atau Column, dan layar dasar adalah Scaffold.</p>
                ',
                'quiz' => [
                    'q' => 'Bahasa pemrograman apa yang digunakan untuk membuat aplikasi mobile dengan framework Flutter?',
                    'options' => ['Java', 'Kotlin', 'Dart', 'Swift'],
                    'answer' => 2,
                    'explanation' => 'Flutter menggunakan bahasa pemrograman Dart yang dikembangkan oleh Google.'
                ]
            ]
        ]
    ],
    'uiux' => [
        'name' => 'UI/UX Design Tutorial',
        'short_name' => 'UI/UX',
        'badge' => 'Desain Produk',
        'icon' => 'fa-solid fa-bezier-curve',
        'color' => '#d946ef',
        'desc' => 'Desain pengalaman pengguna (UX) dan antarmuka visual (UI) modern menggunakan prinsip Design Thinking dan Figma.',
        'topics' => [
            'intro' => [
                'title' => 'UI/UX Pengenalan & Design Thinking',
                'summary' => 'Perbedaan UI vs UX, 5 tahapan Design Thinking, dan bagaimana merancang produk digital yang disukai pengguna.',
                'content' => '
                    <p class="lead"><strong>UI (User Interface)</strong> berfokus pada keindahan visual, warna, tipografi, dan tata letak layar. Sedangkan <strong>UX (User Experience)</strong> berfokus pada kemudahan alur, navigasi, dan kenyamanan pengguna dalam menyelesaikan tujuannya.</p>

                    <h4>5 Tahapan Standar Design Thinking:</h4>
                    <ol class="ps-3">
                        <li><strong>Empathize</strong>: Memahami kebutuhan dan keluhan pengguna melalui riset atau wawancara.</li>
                        <li><strong>Define</strong>: Merumuskan masalah spesifik yang dihadapi pengguna (Problem Statement).</li>
                        <li><strong>Ideate</strong>: Melakukan brainstorming beragam alternatif solusi kreatif.</li>
                        <li><strong>Prototype</strong>: Membuat rancangan interaktif (wireframe & mockup di Figma).</li>
                        <li><strong>Test</strong>: Menguji coba prototipe ke calon pengguna untuk mendapatkan feedback nyata.</li>
                    </ol>
                ',
                'example_title' => 'Contoh Komponen UI Responsif (Figma Auto-Layout)',
                'example_code' => '<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 200px; background: #fdf4ff; }
        .pill-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #a21caf;
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: bold;
            font-size: 0.85rem;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(162, 28, 175, 0.2);
            border: none;
            transition: transform 0.2s;
        }
        .pill-btn:hover {
            transform: scale(1.05);
            background: #86198f;
        }
    </style>
</head>
<body>

    <button class="pill-btn" onclick="alert(\'Tombol UI/UX dirancang dengan prinsip Auto-Layout & Feedback Hover!\')">
        <span>✨</span>
        <span>Tombol Auto-Layout Figma</span>
    </button>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Kolaborasi UI/UX dan Developer:</h5>
                    <p>Desain yang baik selalu memperhitungkan kemampuan implementasi kode CSS. Figma Auto Layout memudahkan developer menerjemahkan desain ke dalam kode Flexbox secara presisi.</p>
                ',
                'quiz' => [
                    'q' => 'Manakah tahapan pertama dalam proses Design Thinking yang berfokus pada memahami pengguna secara mendalam?',
                    'options' => ['Ideate', 'Empathize', 'Prototype', 'Define'],
                    'answer' => 1,
                    'explanation' => 'Empathize adalah langkah awal di mana desainer mengamati dan berempati dengan kebutuhan pengguna.'
                ]
            ]
        ]
    ]
];
