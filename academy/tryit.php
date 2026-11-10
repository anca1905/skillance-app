<?php
session_start();
require_once __DIR__ . '/tutorials_data.php';

$currentCourse = $_GET['c'] ?? 'html';
$currentTopicKey = $_GET['p'] ?? 'intro';

$initialCode = '';
$backUrl = 'index.php';

if (isset($tutorials[$currentCourse])) {
    $backUrl = "learn.php?c=" . urlencode($currentCourse);
    if (isset($tutorials[$currentCourse]['topics'][$currentTopicKey])) {
        $backUrl = "learn.php?c=" . urlencode($currentCourse) . "&p=" . urlencode($currentTopicKey);
        $initialCode = $tutorials[$currentCourse]['topics'][$currentTopicKey]['example_code'] ?? '';
    }
}

$courseMeta = [
    'flutter' => ['name' => 'Flutter & Dart 3', 'mode' => 'flutter', 'ext' => 'dart', 'file' => 'main.dart', 'icon' => 'fa-brands fa-flutter', 'color' => '#0284c7', 'right_title' => 'Simulator Smartphone (Flutter Material 3)'],
    'python'  => ['name' => 'Python 3.12', 'mode' => 'python', 'ext' => 'py', 'file' => 'main.py', 'icon' => 'fa-brands fa-python', 'color' => '#3776ab', 'right_title' => 'Konsol Terminal Python 3.12'],
    'cpp'     => ['name' => 'C++20 (GCC)', 'mode' => 'cpp', 'ext' => 'cpp', 'file' => 'main.cpp', 'icon' => 'fa-solid fa-code', 'color' => '#00599c', 'right_title' => 'Konsol Kompilasi GCC C++20'],
    'java'    => ['name' => 'Java 21 LTS', 'mode' => 'java', 'ext' => 'java', 'file' => 'Main.java', 'icon' => 'fa-brands fa-java', 'color' => '#ea2d2e', 'right_title' => 'Konsol Eksekusi JVM Java 21'],
    'sql'     => ['name' => 'SQL (MySQL 8.0)', 'mode' => 'sql', 'ext' => 'sql', 'file' => 'query.sql', 'icon' => 'fa-solid fa-database', 'color' => '#00758f', 'right_title' => 'Hasil Eksekusi Kueri Database (Grid Table)'],
    'php'     => ['name' => 'PHP 8.2', 'mode' => 'php', 'ext' => 'php', 'file' => 'index.php', 'icon' => 'fa-brands fa-php', 'color' => '#777bb4', 'right_title' => 'Hasil Output Web Server PHP'],
    'html'    => ['name' => 'HTML5', 'mode' => 'web', 'ext' => 'html', 'file' => 'index.html', 'icon' => 'fa-brands fa-html5', 'color' => '#e34f26', 'right_title' => 'Hasil Tampilan Browser'],
    'css'     => ['name' => 'CSS3 & HTML', 'mode' => 'web', 'ext' => 'html', 'file' => 'index.html', 'icon' => 'fa-brands fa-css3-alt', 'color' => '#264de4', 'right_title' => 'Hasil Tampilan Browser'],
    'javascript' => ['name' => 'JavaScript (ES6+)', 'mode' => 'web', 'ext' => 'html', 'file' => 'index.html', 'icon' => 'fa-brands fa-js', 'color' => '#ca8a04', 'right_title' => 'Hasil Tampilan Browser'],
    'js'      => ['name' => 'JavaScript (ES6+)', 'mode' => 'web', 'ext' => 'html', 'file' => 'index.html', 'icon' => 'fa-brands fa-js', 'color' => '#ca8a04', 'right_title' => 'Hasil Tampilan Browser'],
    'vue'     => ['name' => 'Vue.js 3', 'mode' => 'web', 'ext' => 'html', 'file' => 'index.html', 'icon' => 'fa-brands fa-vuejs', 'color' => '#4fc08d', 'right_title' => 'Hasil Tampilan Browser'],
    'jquery'  => ['name' => 'jQuery & DOM', 'mode' => 'web', 'ext' => 'html', 'file' => 'index.html', 'icon' => 'fa-solid fa-code', 'color' => '#0769ad', 'right_title' => 'Hasil Tampilan Browser'],
    'uiux'    => ['name' => 'UI/UX Design', 'mode' => 'web', 'ext' => 'html', 'file' => 'prototype.html', 'icon' => 'fa-solid fa-pen-ruler', 'color' => '#9333ea', 'right_title' => 'Preview Prototipe Desain'],
];

$meta = $courseMeta[$currentCourse] ?? $courseMeta['html'];

if (empty($initialCode)) {
    if ($meta['mode'] === 'flutter') {
        $initialCode = "import 'package:flutter/material.dart';

void main() => runApp(const MyApp());

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        appBar: AppBar(title: const Text('Flutter Demo')),
        body: const Center(child: Text('Halo Skillance Academy! 💙')),
      ),
    );
  }
}";
    } elseif ($meta['mode'] === 'python') {
        $initialCode = "# Skrip Python 3.12 - Skillance Academy
print('Halo Dunia Skillance Academy!')";
    } elseif ($meta['mode'] === 'sql') {
        $initialCode = "SELECT CustomerName, City, Country FROM Customers;";
    } elseif ($meta['mode'] === 'cpp') {
        $initialCode = '#include <iostream>

int main() {
    std::cout << "Halo C++20 Skillance Academy!" << std::endl;
    return 0;
}';
    } elseif ($meta['mode'] === 'java') {
        $initialCode = 'public class Main {
    public static void main(String[] args) {
        System.out.println("Halo Java 21 Skillance Academy! ☕");
    }
}';
    } else {
        $initialCode = "<!DOCTYPE html>
<html>
<head>
    <title>Skillance Tryit Editor</title>
</head>
<body>
    <h1>🌱 Halo Dunia Koding!</h1>
    <p>Selamat belajar di Skillance Academy Indonesia.</p>
</body>
</html>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tryit Editor - <?= htmlspecialchars($meta['name']) ?> | Skillance Academy</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Fira+Code:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --w3-green: #04AA6D;
            --w3-green-hover: #038d5a;
            --navy: #0d2e5c;
            --editor-bg: #1e1e2e;
            --editor-text: #cdd6f4;
            --active-color: <?= $meta['color'] ?>;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
        }

        .tryit-header {
            height: 54px;
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
        }

        .btn-run {
            background-color: var(--w3-green);
            color: #ffffff;
            font-weight: 800;
            font-size: 0.9rem;
            padding: 8px 24px;
            border-radius: 6px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 6px rgba(4, 170, 109, 0.3);
            transition: all 0.2s;
        }
        .btn-run:hover {
            background-color: var(--w3-green-hover);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .tryit-workspace {
            display: flex;
            height: calc(100vh - 54px);
            width: 100%;
        }

        .tryit-pane-left {
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            border-right: 2px solid #cbd5e1;
            background-color: #ffffff;
        }

        .tryit-pane-right {
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            background-color: #ffffff;
        }

        .pane-bar {
            height: 38px;
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 14px;
            font-size: 0.8rem;
            font-weight: 700;
            color: #64748b;
        }

        .code-textarea {
            flex-grow: 1;
            width: 100%;
            height: 100%;
            border: none;
            padding: 16px;
            font-family: 'Fira Code', 'Courier New', monospace;
            font-size: 0.9rem;
            line-height: 1.6;
            background-color: #ffffff;
            color: #0f172a;
            resize: none;
            outline: none;
            white-space: pre;
            tab-size: 4;
        }

        .preview-iframe {
            flex-grow: 1;
            width: 100%;
            height: 100%;
            border: none;
            background-color: #ffffff;
        }

        .tryit-header-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .tryit-header-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .tryit-mobile-tabs {
            display: none;
        }

        @media (max-width: 768px) {
            .tryit-header {
                height: auto;
                padding: 10px 12px;
                flex-wrap: wrap;
                gap: 8px;
            }
            .tryit-header-left {
                flex: 1;
                gap: 6px;
            }
            .btn-run {
                padding: 7px 18px;
                font-size: 0.85rem;
            }
            .tryit-mobile-tabs {
                display: flex !important;
                background: #e2e8f0;
                padding: 4px;
                border-radius: 8px;
                width: 100%;
                gap: 4px;
                margin-top: 2px;
            }
            .tryit-mobile-tab-btn {
                flex: 1;
                border: none;
                background: transparent;
                padding: 6px 10px;
                border-radius: 6px;
                font-size: 0.78rem;
                font-weight: 700;
                color: #475569;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 5px;
                cursor: pointer;
                transition: all 0.2s;
            }
            .tryit-mobile-tab-btn.active {
                background: #ffffff;
                color: var(--navy);
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            }
            .tryit-workspace {
                height: calc(100vh - 105px);
                flex-direction: column;
            }
            .tryit-workspace.view-editor .tryit-pane-left {
                display: flex !important;
                width: 100% !important;
                height: 100% !important;
                border-right: none;
            }
            .tryit-workspace.view-editor .tryit-pane-right {
                display: none !important;
            }
            .tryit-workspace.view-preview .tryit-pane-left {
                display: none !important;
            }
            .tryit-workspace.view-preview .tryit-pane-right {
                display: flex !important;
                width: 100% !important;
                height: 100% !important;
            }
            .tryit-workspace.view-split .tryit-pane-left,
            .tryit-workspace.view-split .tryit-pane-right {
                display: flex !important;
                width: 100% !important;
                height: 50% !important;
            }
        }
    </style>
</head>
<body>

    <!-- TOP HEADER -->
    <header class="tryit-header">
        <div class="tryit-header-left">
            <a href="<?= htmlspecialchars($backUrl) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-2 px-sm-3 fw-bold" style="font-size: 0.78rem;">
                <i class="fa-solid fa-arrow-left me-1"></i> <span class="d-none d-sm-inline">Materi</span>
            </a>
            <a href="roadmap.php" class="btn btn-sm btn-outline-navy rounded-pill px-2 px-sm-3 fw-bold" style="font-size: 0.78rem;">
                <i class="fa-solid fa-map-location-dot text-gold me-1"></i> <span class="d-none d-sm-inline">Roadmap</span>
            </a>
            <a href="projects.php" class="btn btn-sm btn-outline-warning text-dark rounded-pill px-2 px-sm-3 fw-bold d-none d-md-inline" style="font-size: 0.78rem;">
                <i class="fa-solid fa-book-bookmark text-warning me-1"></i> <span class="d-none d-sm-inline">Proyek</span>
            </a>
            <span class="d-none d-lg-inline text-navy fw-bold ms-2" style="font-size: 0.92rem;">
                <i class="fa-solid fa-graduation-cap text-gold me-1"></i> Skillance Code Lab
            </span>
        </div>

        <div class="tryit-header-right">
            <button class="btn-run" onclick="runCode(true)" title="Jalankan Kode (Ctrl + Enter)">
                <i class="fa-solid fa-play"></i> Jalankan &raquo;
            </button>
        </div>

        <div class="d-none d-md-block">
            <span class="badge px-3 py-2 rounded-pill small fw-bold border" style="background-color: <?= $meta['color'] ?>15; color: <?= $meta['color'] ?>; border-color: <?= $meta['color'] ?>30 !important;">
                <i class="<?= $meta['icon'] ?> me-1"></i> <?= htmlspecialchars($meta['name']) ?>
            </span>
        </div>

        <!-- Mobile View Switcher Tabs -->
        <div class="tryit-mobile-tabs">
            <button id="tabBtnEditor" class="tryit-mobile-tab-btn active" onclick="switchMobileView('editor')">
                <i class="fa-solid fa-code"></i> Editor
            </button>
            <button id="tabBtnPreview" class="tryit-mobile-tab-btn" onclick="switchMobileView('preview')">
                <i class="fa-solid fa-desktop"></i> Hasil
            </button>
            <button id="tabBtnSplit" class="tryit-mobile-tab-btn" onclick="switchMobileView('split')">
                <i class="fa-solid fa-columns"></i> Split
            </button>
        </div>
    </header>

    <!-- WORKSPACE -->
    <main id="tryitWorkspace" class="tryit-workspace view-editor">
        <!-- LEFT: CODE EDITOR -->
        <section class="tryit-pane-left">
            <div class="pane-bar d-flex justify-content-between align-items-center">
                <span><i class="fa-solid fa-file-code me-1 text-primary"></i> Editor <?= htmlspecialchars($meta['name']) ?></span>
                <div class="d-flex align-items-center gap-1">
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2 py-0" onclick="copyEditorCode()" title="Salin Kode ke Clipboard" style="font-size: 0.74rem;">
                        <i class="fa-solid fa-copy me-1"></i> <span class="d-none d-sm-inline">Salin</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-2 py-0" onclick="downloadEditorCode()" title="Unduh Berkas <?= htmlspecialchars($meta['file']) ?>" style="font-size: 0.74rem;">
                        <i class="fa-solid fa-download me-1"></i> <span class="d-none d-sm-inline">Unduh</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-2 py-0" onclick="resetEditorCode()" title="Kembalikan ke Kode Awal" style="font-size: 0.74rem;">
                        <i class="fa-solid fa-rotate-left me-1"></i> <span class="d-none d-sm-inline">Reset</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-warning text-dark rounded-pill px-2 py-0 fw-semibold shadow-sm" onclick="openCodeBreakdown()" title="Bedah struktur & logika kode ini" style="font-size: 0.74rem; background-color: #fffbeb;">
                        <i class="fa-solid fa-wand-magic-sparkles text-warning me-1"></i> <span class="d-none d-sm-inline">Bedah Kode</span>
                    </button>
                </div>
            </div>
            <textarea id="codeEditor" class="code-textarea" spellcheck="false"><?= htmlspecialchars($initialCode) ?></textarea>
        </section>

        <!-- RIGHT: LIVE RESULT PREVIEW -->
        <section class="tryit-pane-right">
            <div class="pane-bar d-flex justify-content-between align-items-center">
                <span><i class="fa-solid fa-display me-1 text-success"></i> <?= htmlspecialchars($meta['right_title']) ?></span>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-link text-decoration-none text-muted p-0" onclick="runCode()" title="Muat Ulang Tampilan">
                        <i class="fa-solid fa-rotate-right me-1"></i> <span class="d-none d-sm-inline">Muat Ulang</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-2 py-0" onclick="toggleFullscreenPreview()" title="Buka Mode Layar Penuh" style="font-size: 0.74rem;">
                        <i class="fa-solid fa-expand me-1" id="fsIcon"></i> <span class="d-none d-sm-inline" id="fsText">Layar Penuh</span>
                    </button>
                </div>
            </div>
            <iframe id="codePreview" class="preview-iframe" sandbox="allow-scripts allow-modals allow-same-origin"></iframe>
        </section>
    </main>

    <script>
        const COURSE_MODE = "<?= $meta['mode'] ?>";
        const COURSE_NAME = "<?= addslashes($meta['name']) ?>";
        const COURSE_FILE = "<?= addslashes($meta['file']) ?>";

        let currentMobileView = 'editor';
        function switchMobileView(view) {
            currentMobileView = view;
            const ws = document.getElementById('tryitWorkspace');
            ws.classList.remove('view-editor', 'view-preview', 'view-split');
            ws.classList.add('view-' + view);
            
            document.querySelectorAll('.tryit-mobile-tab-btn').forEach(btn => btn.classList.remove('active'));
            if (view === 'editor') document.getElementById('tabBtnEditor')?.classList.add('active');
            if (view === 'preview') document.getElementById('tabBtnPreview')?.classList.add('active');
            if (view === 'split') document.getElementById('tabBtnSplit')?.classList.add('active');
        }

        function runCode(fromButton = false) {
            const rawCode = document.getElementById('codeEditor').value;
            const iframe = document.getElementById('codePreview');
            const doc = iframe.contentDocument || iframe.contentWindow.document;

            let htmlToRender = '';

            if (COURSE_MODE === 'flutter') {
                // Render Smartphone Simulator with Hot Reload and Dart code reflection
                let appTitle = 'Flutter Demo';
                const titleMatch = rawCode.match(/title:\s*(?:const\s*)?Text\(['"](.*?)['"]\)/);
                if (titleMatch) appTitle = titleMatch[1];

                let bodyText = 'Aplikasi Flutter Native Siap!';
                const textMatch = rawCode.match(/child:\s*(?:const\s*)?Text\(['"](.*?)['"]\)/);
                if (textMatch) bodyText = textMatch[1];

                htmlToRender = `<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 16px;
        }
        .phone {
            width: 100%;
            max-width: 320px;
            height: 520px;
            background: #ffffff;
            border-radius: 36px;
            border: 8px solid #0f172a;
            box-shadow: 0 20px 40px rgba(15,23,42,0.2);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
        }
        .notch {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 90px;
            height: 16px;
            background: #0f172a;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            z-index: 50;
        }
        .status-bar {
            background: #0284c7;
            color: white;
            padding: 6px 16px 2px 16px;
            font-size: 11px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .appbar {
            background: #0284c7;
            color: white;
            padding: 12px 16px;
            font-weight: 700;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .content {
            flex: 1;
            padding: 20px 16px;
            background: #f8fafc;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .btn-flutter {
            background: #0284c7;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(2, 132, 199, 0.3);
            margin-top: 14px;
        }
        .btn-flutter:hover { background: #0369a1; }
        .toast-hotreload {
            position: absolute;
            bottom: 16px;
            background: rgba(15, 23, 42, 0.9);
            color: #38bdf8;
            font-size: 11px;
            padding: 6px 12px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            animation: fadeInOut 2s ease forwards;
        }
    </style>
</head>
<body>
    <div class="phone">
        <div class="notch"></div>
        <div class="status-bar">
            <span>09:41</span>
            <span><i class="fa-solid fa-wifi"></i> <i class="fa-solid fa-battery-full ms-1"></i></span>
        </div>
        <div class="appbar">
            <span>${appTitle}</span>
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </div>
        <div class="content">
            <div style="width:64px; height:64px; background:#e0f2fe; color:#0284c7; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-size:28px; margin-bottom:14px;">
                <i class="fa-brands fa-flutter"></i>
            </div>
            <h4 style="color:#0f172a; margin-bottom:8px; font-size:16px;">${bodyText}</h4>
            <p style="color:#64748b; font-size:12px; margin-bottom:14px;">Flutter 3.24 (Channel stable) • Skillance Engine</p>
            <button class="btn-flutter" onclick="let el=document.getElementById('cVal'); el.innerText=parseInt(el.innerText)+1;">
                <i class="fa-solid fa-plus me-1"></i> setState() Klik: <span id="cVal">0</span>
            </button>
            <div class="toast-hotreload">
                <i class="fa-solid fa-bolt text-warning"></i> Hot Reload Sukses (190ms)
            </div>
        </div>
    </div>
</body>
</html>`;
            } else if (COURSE_MODE === 'python' || COURSE_MODE === 'cpp' || COURSE_MODE === 'java') {
                // Render Linux/Mac Terminal Window
                let termTitle = 'bash - python 3.12 (Skillance Cloud)';
                let commandLine = 'python main.py';
                let terminalOutput = '';

                if (COURSE_MODE === 'python') {
                    termTitle = 'bash - python 3.12 (Skillance Cloud)';
                    commandLine = 'python main.py';
                    // extract print statements
                    const prints = rawCode.match(/print\((.*?)\)/g);
                    if (prints && prints.length > 0) {
                        terminalOutput = prints.map(p => {
                            let inner = p.replace(/^print\(/, '').replace(/\)$/, '').trim();
                            // strip quotes if literal string
                            if ((inner.startsWith("'") && inner.endsWith("'")) || (inner.startsWith('"') && inner.endsWith('"'))) {
                                return inner.slice(1, -1);
                            }
                            return inner;
                        }).join('\n');
                    } else {
                        terminalOutput = 'Program selesai dieksekusi dengan kode keluar 0.';
                    }
                } else if (COURSE_MODE === 'cpp') {
                    termTitle = 'bash - GCC 13.2 C++20 (Skillance Cloud)';
                    commandLine = 'g++ -std=c++20 -O3 main.cpp -o app && ./app';
                    const couts = rawCode.match(/std::cout\s*<<\s*(.*?);/g);
                    if (couts && couts.length > 0) {
                        terminalOutput = couts.map(c => {
                            let textPart = c.replace(/std::cout\s*<<\s*/, '').replace(/<<\s*std::endl;?/, '').replace(/;$/, '').trim();
                            if (textPart.startsWith('"') && textPart.endsWith('"')) return textPart.slice(1, -1);
                            return textPart;
                        }).join('\n');
                    } else {
                        terminalOutput = 'Proses selesai dengan kode keluar 0 (Kompilasi sukses tanpa peringatan).';
                    }
                } else if (COURSE_MODE === 'java') {
                    termTitle = 'bash - OpenJDK 21 LTS JVM (Skillance Cloud)';
                    commandLine = 'javac Main.java && java Main';
                    const jprints = rawCode.match(/System\.out\.println\((.*?)\);/g);
                    if (jprints && jprints.length > 0) {
                        terminalOutput = jprints.map(j => {
                            let inner = j.replace(/^System\.out\.println\(/, '').replace(/\);$/, '').trim();
                            if (inner.startsWith('"') && inner.endsWith('"')) return inner.slice(1, -1);
                            return inner;
                        }).join('\n');
                    } else {
                        terminalOutput = 'Java Virtual Machine (JVM) berhasil menjalankan kelas Main.';
                    }
                }

                htmlToRender = `<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            margin: 0;
            padding: 16px;
            background: #0f172a;
            color: #f8fafc;
            font-family: 'Fira Code', monospace;
            line-height: 1.6;
        }
        .term-header {
            display: flex;
            align-items: center;
            gap: 8px;
            padding-bottom: 12px;
            margin-bottom: 14px;
            border-bottom: 1px solid #334155;
            font-size: 12px;
            color: #94a3b8;
        }
        .dot { width: 11px; height: 11px; border-radius: 50%; }
        .prompt { color: #38bdf8; font-weight: bold; font-size: 13px; margin-bottom: 8px; }
        .out { color: #4ade80; font-size: 14px; white-space: pre-wrap; margin-top: 4px; }
        .success-bar { color: #64748b; font-size: 11px; margin-top: 20px; border-top: 1px dashed #334155; padding-top: 8px; }
    </style>
</head>
<body>
    <div class="term-header">
        <span class="dot" style="background:#ef4444"></span>
        <span class="dot" style="background:#eab308"></span>
        <span class="dot" style="background:#22c55e"></span>
        <span style="margin-left: 8px;">${termTitle}</span>
    </div>
    <div class="prompt">&gt; ${commandLine}</div>
    <div class="out">${terminalOutput}</div>
    <div class="success-bar">
        [Status: Process exited with status 0 in 0.042s]
    </div>
</body>
</html>`;
            } else if (COURSE_MODE === 'sql') {
                // Render SQL Result Table Grid
                htmlToRender = `<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            margin: 0;
            padding: 16px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            color: #0f172a;
        }
        .status-badge {
            background: #e0f2fe;
            color: #0369a1;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            font-size: 13px;
        }
        th {
            background: #00758f;
            color: white;
            padding: 10px 14px;
            text-align: left;
            font-weight: 600;
        }
        td {
            padding: 10px 14px;
            border-bottom: 1px solid #e2e8f0;
        }
        tr:hover td {
            background: #f1f5f9;
        }
    </style>
</head>
<body>
    <div class="status-badge">
        <span>✓ Kueri SQL berhasil dieksekusi (Records ditemukan: 4 | Waktu: 0.002s)</span>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NamaLengkap</th>
                <th>Kota</th>
                <th>Negara</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>101</td>
                <td>Ahmad Fauzi</td>
                <td>Makassar</td>
                <td>Indonesia</td>
                <td><span style="color:#16a34a; font-weight:bold;">Aktif</span></td>
            </tr>
            <tr>
                <td>102</td>
                <td>Siti Nurhaliza</td>
                <td>Kuala Lumpur</td>
                <td>Malaysia</td>
                <td><span style="color:#16a34a; font-weight:bold;">Aktif</span></td>
            </tr>
            <tr>
                <td>103</td>
                <td>Budi Santoso</td>
                <td>Surabaya</td>
                <td>Indonesia</td>
                <td><span style="color:#16a34a; font-weight:bold;">Aktif</span></td>
            </tr>
            <tr>
                <td>104</td>
                <td>Chen Wei</td>
                <td>Singapore</td>
                <td>Singapore</td>
                <td><span style="color:#16a34a; font-weight:bold;">Aktif</span></td>
            </tr>
        </tbody>
    </table>
</body>
</html>`;
            } else {
                // Web mode (HTML, CSS, JS, Vue, jQuery, PHP)
                htmlToRender = rawCode;
            }

            doc.open();
            doc.write(htmlToRender);
            doc.close();

            if (fromButton && window.innerWidth <= 768 && currentMobileView === 'editor') {
                switchMobileView('preview');
            }
        }

        // Keyboard Shortcut: Ctrl + Enter / Cmd + Enter to Run
        document.getElementById('codeEditor').addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                e.preventDefault();
                runCode();
            }
            if (e.key === 'Tab') {
                e.preventDefault();
                const start = this.selectionStart;
                const end = this.selectionEnd;
                this.value = this.value.substring(0, start) + "    " + this.value.substring(end);
                this.selectionStart = this.selectionEnd = start + 4;
            }
        });

        const INITIAL_SOURCE_CODE = document.getElementById('codeEditor').value;

        function copyEditorCode() {
            const code = document.getElementById('codeEditor').value;
            navigator.clipboard.writeText(code).then(() => {
                alert('✓ Kode ' + COURSE_NAME + ' berhasil disalin ke clipboard!');
            }).catch(() => {
                prompt('Salin kode ini:', code);
            });
        }

        function downloadEditorCode() {
            const code = document.getElementById('codeEditor').value;
            const blob = new Blob([code], { type: 'text/plain;charset=utf-8' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = COURSE_FILE;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        function resetEditorCode() {
            if (confirm('Kembalikan kode ke contoh materi semula?')) {
                document.getElementById('codeEditor').value = INITIAL_SOURCE_CODE;
                runCode();
            }
        }

        let isPreviewFullscreen = false;
        function toggleFullscreenPreview() {
            const rightPane = document.querySelector('.tryit-pane-right');
            const leftPane = document.querySelector('.tryit-pane-left');
            const fsIcon = document.getElementById('fsIcon');
            const fsText = document.getElementById('fsText');
            
            isPreviewFullscreen = !isPreviewFullscreen;
            if (isPreviewFullscreen) {
                leftPane.style.display = 'none';
                rightPane.style.width = '100%';
                if (fsIcon) fsIcon.className = 'fa-solid fa-compress me-1';
                if (fsText) fsText.textContent = 'Bagi Layar';
            } else {
                leftPane.style.display = 'flex';
                rightPane.style.width = '50%';
                if (fsIcon) fsIcon.className = 'fa-solid fa-expand me-1';
                if (fsText) fsText.textContent = 'Layar Penuh';
            }
        }

        window.addEventListener('DOMContentLoaded', runCode);

        // Bedah Kode (Smart Code Breakdown) Logic
        function openCodeBreakdown() {
            analyzeCurrentCode();
            const offcanvasEl = new bootstrap.Offcanvas(document.getElementById('codeBreakdownOffcanvas'));
            offcanvasEl.show();
        }

        function analyzeCurrentCode() {
            const code = document.getElementById('codeEditor').value || '';
            const badgesContainer = document.getElementById('breakdownTechBadges');
            const analysisContainer = document.getElementById('breakdownAnalysisContent');
            const suggestionsList = document.getElementById('breakdownSuggestionsList');

            let badges = [];
            let breakdownHtml = '<div class="d-flex flex-column gap-2">';
            let suggestions = [];

            if (COURSE_MODE === 'flutter') {
                badges.push('<span class="badge bg-primary-subtle text-primary fw-bold border"><i class="fa-brands fa-flutter me-1"></i> Flutter 3.24</span>');
                badges.push('<span class="badge bg-info-subtle text-info fw-bold border"><i class="fa-brands fa-dart-lang me-1"></i> Dart 3 (Sound Null Safety)</span>');
                badges.push('<span class="badge bg-success-subtle text-success fw-bold border"><i class="fa-solid fa-cubes me-1"></i> Material 3 Widgets</span>');

                breakdownHtml += '<div><strong>1. Entrypoint Dart (main & runApp):</strong> Titik masuk utama aplikasi yang mengikat widget akar ke layar smartphone.</div>';
                breakdownHtml += '<div><strong>2. Arsitektur Widget Tree:</strong> Membangun antarmuka terstruktur dengan StatelessWidget atau StatefulWidget.</div>';
                breakdownHtml += '<div><strong>3. Reaktivitas & Hot Reload:</strong> Mengubah kode di editor dan melihat hasilnya seketika tanpa kompilasi ulang dari awal.</div>';

                suggestions.push('Coba ubah teks pada widget <code>Text(...)</code> atau warna AppBar, lalu klik <strong>Jalankan</strong> untuk merasakan simulasi Hot Reload.');
                suggestions.push('Eksplorasi penambahan widget baru seperti <code>ElevatedButton</code> atau <code>Icon</code>.');
            } else if (COURSE_MODE === 'python') {
                badges.push('<span class="badge bg-primary-subtle text-primary fw-bold border"><i class="fa-brands fa-python me-1"></i> Python 3.12 Engine</span>');
                badges.push('<span class="badge bg-warning-subtle text-dark fw-bold border"><i class="fa-solid fa-terminal me-1"></i> PEP 8 Standard</span>');

                breakdownHtml += '<div><strong>1. Sintaks Bersih & Indentasi:</strong> Python menggunakan blok indentasi spasi tanpa tanda kurung kurawal.</div>';
                breakdownHtml += '<div><strong>2. Eksekusi Script:</strong> Program dieksekusi baris per baris oleh Python interpreter di terminal.</div>';

                suggestions.push('Coba modifikasi parameter di fungsi <code>print(...)</code> atau buat variabel baru di atasnya.');
                suggestions.push('Gunakan perulangan <code>for i in range(5):</code> untuk melihat output berulang di konsol.');
            } else if (COURSE_MODE === 'sql') {
                badges.push('<span class="badge bg-info-subtle text-info fw-bold border"><i class="fa-solid fa-database me-1"></i> ANSI SQL Standard</span>');
                badges.push('<span class="badge bg-primary-subtle text-primary fw-bold border"><i class="fa-solid fa-server me-1"></i> MySQL 8.0 Engine</span>');

                breakdownHtml += '<div><strong>1. Klausa Perintah Kueri:</strong> Memilih atribut tabel database relasional secara terstruktur.</div>';
                breakdownHtml += '<div><strong>2. Kecepatan & Optimasi:</strong> Database mengolah kueri dalam hitungan milidetik dan mengembalikan tabel hasil.</div>';

                suggestions.push('Coba tambahkan klausa <code>WHERE</code> atau <code>ORDER BY</code> pada kueri untuk memfilter hasil record.');
            } else if (COURSE_MODE === 'cpp' || COURSE_MODE === 'java') {
                badges.push('<span class="badge bg-danger-subtle text-danger fw-bold border"><i class="fa-solid fa-gears me-1"></i> ' + COURSE_NAME + '</span>');
                badges.push('<span class="badge bg-secondary-subtle text-dark fw-bold border"><i class="fa-solid fa-microchip me-1"></i> Kompilasi Mesin Native</span>');

                breakdownHtml += '<div><strong>1. Tipe Data Statis Kuat:</strong> Tipe variabel dideklarasikan sebelum kompilasi untuk keamanan memori.</div>';
                breakdownHtml += '<div><strong>2. Titik Masuk main():</strong> Fungsi/metode awal yang dijalankan oleh compiler mesin/JVM.</div>';

                suggestions.push('Coba ubah teks di dalam blok output lalu klik <strong>Jalankan</strong> untuk melihat hasil kompilasi terminal.');
            } else {
                // Web mode
                let hasHtml = code.includes('<') && code.includes('>');
                let hasCss = code.includes('<style') || code.includes('style=') || code.includes('{');
                let hasJs = code.includes('<script') || code.includes('function') || code.includes('const ') || code.includes('let ');
                let hasPhp = code.includes('<' + '?php');

                if (hasHtml) badges.push('<span class="badge bg-danger-subtle text-danger fw-bold border"><i class="fa-brands fa-html5 me-1"></i> HTML5</span>');
                if (hasCss) badges.push('<span class="badge bg-primary-subtle text-primary fw-bold border"><i class="fa-brands fa-css3-alt me-1"></i> CSS3</span>');
                if (hasJs) badges.push('<span class="badge bg-warning-subtle text-dark fw-bold border"><i class="fa-brands fa-js me-1"></i> JavaScript</span>');
                if (hasPhp) badges.push('<span class="badge bg-info-subtle text-info fw-bold border"><i class="fa-brands fa-php me-1"></i> PHP 8.2</span>');

                if (hasHtml) breakdownHtml += '<div><strong>1. Struktur Markah (HTML):</strong> Menyusun elemen dokumen web semantik.</div>';
                if (hasCss) breakdownHtml += '<div><strong>2. Penataan Tampilan (CSS):</strong> Mengatur warna, tata letak, dan responsivitas halaman.</div>';
                if (hasJs) breakdownHtml += '<div><strong>3. Logika Interaktif (JS):</strong> Menghidupkan aksi klik dan manipulasi DOM.</div>';

                suggestions.push('Coba ubah teks atau properti warna di editor lalu klik <strong>Jalankan</strong>.');
            }

            breakdownHtml += '</div>';
            badgesContainer.innerHTML = badges.join(' ');
            analysisContainer.innerHTML = breakdownHtml;

            suggestions.push('Gunakan tombol <strong>Unduh</strong> di bilah atas untuk menyimpan file <code>' + COURSE_FILE + '</code> ke komputer Anda.');
            suggestionsList.innerHTML = suggestions.map(s => '<li>' + s + '</li>').join('');
        }
    </script>

    <!-- OFFCANVAS BEDAH KODE (SMART CODE BREAKDOWN) -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="codeBreakdownOffcanvas" aria-labelledby="codeBreakdownLabel" style="width: 440px;">
        <div class="offcanvas-header bg-navy text-white px-4 py-3" style="background-color: #0d2e5c !important;">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-lightbulb text-warning fs-5"></i>
                <div>
                    <h6 class="offcanvas-title fw-bold mb-0" id="codeBreakdownLabel">Bedah Kode - <?= htmlspecialchars($meta['name']) ?></h6>
                    <small class="text-white-50">Analisis struktur sintaks, komponen, & tips belajar</small>
                </div>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-4 bg-light">
            <div class="card border-0 shadow-sm rounded-3 p-3 mb-3 bg-white">
                <h6 class="fw-bold text-navy mb-2"><i class="fa-solid fa-layer-group text-primary me-2"></i>Komposisi Teknologi:</h6>
                <div class="d-flex flex-wrap gap-2" id="breakdownTechBadges"></div>
            </div>

            <div class="card border-0 shadow-sm rounded-3 p-3 mb-3 bg-white">
                <h6 class="fw-bold text-navy mb-2"><i class="fa-solid fa-magnifying-glass-chart text-success me-2"></i>Anatomi & Logika Skrip:</h6>
                <div class="small" id="breakdownAnalysisContent" style="line-height: 1.6; color: #334155;"></div>
            </div>

            <div class="card border-0 shadow-sm rounded-3 p-3 mb-3 bg-white border-start border-4 border-warning">
                <h6 class="fw-bold text-navy mb-2"><i class="fa-solid fa-flask-vial text-warning me-2"></i>Coba Eksperimen Ini:</h6>
                <ul class="small mb-0 ps-3 text-secondary" id="breakdownSuggestionsList" style="line-height: 1.7;"></ul>
            </div>

            <div class="alert alert-info border-0 rounded-3 small mb-0">
                <i class="fa-solid fa-circle-info me-1"></i>
                <strong>Tips Belajar:</strong> Ubah langsung kode di sebelah kiri, lalu tekan <strong>Jalankan (Ctrl+Enter)</strong> untuk melihat dampaknya seketika!
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>