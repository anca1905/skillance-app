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

if (empty($initialCode)) {
    $initialCode = '<!DOCTYPE html>
<html>
<head>
    <title>Skillance Tryit Editor</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 40px; background: #f0fdf4; color: #166534; }
        .box { background: white; padding: 30px; border-radius: 16px; border: 2px solid #86efac; max-width: 400px; margin: auto; box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
        h1 { margin-top: 0; color: #15803d; }
        .btn { background: #16a34a; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>

    <div class="box">
        <h1>🌱 Halo Dunia Koding!</h1>
        <p>Ubah kode di editor sebelah kiri, lalu klik tombol hijau <strong>Jalankan &raquo;</strong> di atas!</p>
        <button class="btn" onclick="alert(\'Hebat! Skrip Anda berjalan dengan lancar.\')">Klik Saya</button>
    </div>

</body>
</html>';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tryit Editor v1.0 - Skillance Academy</title>
    
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
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
        }

        /* Top Header */
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

        /* Workspace Grid */
        .tryit-workspace {
            display: flex;
            height: calc(100vh - 54px);
            width: 100%;
        }

        /* Left Pane: Code Editor */
        .tryit-pane-left {
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
            border-right: 2px solid #cbd5e1;
            background-color: #ffffff;
        }

        /* Right Pane: Result Preview */
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

        @media (max-width: 768px) {
            .tryit-workspace {
                flex-direction: column;
            }
            .tryit-pane-left, .tryit-pane-right {
                width: 100%;
                height: 50%;
            }
        }
    </style>
</head>
<body>

    <!-- TOP HEADER -->
    <header class="tryit-header">
        <div class="d-flex align-items-center gap-2">
            <a href="<?= htmlspecialchars($backUrl) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold" style="font-size: 0.8rem;">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Materi
            </a>
            <span class="d-none d-md-inline text-navy fw-bold ms-2" style="font-size: 0.95rem;">
                <i class="fa-solid fa-graduation-cap text-gold me-1"></i> Skillance Code Lab
            </span>
        </div>

        <div class="d-flex align-items-center gap-2">
            <button class="btn-run" onclick="runCode()" title="Jalankan Kode (Ctrl + Enter)">
                <i class="fa-solid fa-play"></i> Jalankan &raquo;
            </button>
        </div>

        <div>
            <span class="badge bg-navy-subtle text-navy px-3 py-2 rounded-pill small fw-bold">
                <i class="fa-solid fa-laptop-code me-1 text-gold"></i> Skillance Code Lab Editor
            </span>
        </div>
    </header>

    <!-- WORKSPACE -->
    <main class="tryit-workspace">
        <!-- LEFT: CODE EDITOR -->
        <section class="tryit-pane-left">
            <div class="pane-bar">
                <span><i class="fa-solid fa-file-code me-1 text-primary"></i> Editor Kode Sumber</span>
                <span class="small text-muted">Tekan <code>Ctrl + Enter</code> untuk Menjalankan</span>
            </div>
            <textarea id="codeEditor" class="code-textarea" spellcheck="false"><?= htmlspecialchars($initialCode) ?></textarea>
        </section>

        <!-- RIGHT: LIVE RESULT PREVIEW -->
        <section class="tryit-pane-right">
            <div class="pane-bar">
                <span><i class="fa-solid fa-display me-1 text-success"></i> Hasil Tampilan (Browser Preview)</span>
                <button class="btn btn-sm btn-link text-decoration-none text-muted p-0" onclick="runCode()">
                    <i class="fa-solid fa-rotate-right me-1"></i> Muat Ulang
                </button>
            </div>
            <iframe id="codePreview" class="preview-iframe" sandbox="allow-scripts allow-modals allow-same-origin"></iframe>
        </section>
    </main>

    <script>
        function runCode() {
            const code = document.getElementById('codeEditor').value;
            const iframe = document.getElementById('codePreview');
            const doc = iframe.contentDocument || iframe.contentWindow.document;
            doc.open();
            doc.write(code);
            doc.close();
        }

        // Keyboard Shortcut: Ctrl + Enter / Cmd + Enter to Run
        document.getElementById('codeEditor').addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                e.preventDefault();
                runCode();
            }
            // Tab key support
            if (e.key === 'Tab') {
                e.preventDefault();
                const start = this.selectionStart;
                const end = this.selectionEnd;
                this.value = this.value.substring(0, start) + "    " + this.value.substring(end);
                this.selectionStart = this.selectionEnd = start + 4;
            }
        });

        // Run initially on load
        window.addEventListener('DOMContentLoaded', runCode);
    </script>
</body>
</html>
