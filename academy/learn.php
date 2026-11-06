<?php
session_start();
require_once __DIR__ . '/tutorials_data.php';

$userId = $_SESSION['user_id'] ?? null;
$userName = $_SESSION['user_name'] ?? 'Tamu Mahasiswa';
$userEmail = $_SESSION['user_email'] ?? '';
$userType = $_SESSION['user_type'] ?? 'student';
$avatarUrl = $_SESSION['user_photo'] ?? ('https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=0d2e5c&color=fff');
$isLoggedIn = !empty($userId);

// Get current course & topic
$currentCourse = $_GET['c'] ?? 'html';
if (!isset($tutorials[$currentCourse])) {
    $currentCourse = 'html';
}

$courseData = $tutorials[$currentCourse];
$topics = $courseData['topics'];
$topicKeys = array_keys($topics);

$currentTopicKey = $_GET['p'] ?? $topicKeys[0];
if (!isset($topics[$currentTopicKey])) {
    $currentTopicKey = $topicKeys[0];
}

$currentTopic = $topics[$currentTopicKey];

// Determine Previous and Next topics
$currentIndex = array_search($currentTopicKey, $topicKeys);
$prevTopicKey = ($currentIndex > 0) ? $topicKeys[$currentIndex - 1] : null;
$nextTopicKey = ($currentIndex < count($topicKeys) - 1) ? $topicKeys[$currentIndex + 1] : null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($currentTopic['title']) ?> - Skillance Academy</title>
    
    <!-- Google Fonts & Bootstrap -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fira+Code:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #071a35;
            --gold: #fca311;
            --w3-green: #04AA6D;
            --w3-green-hover: #038d5a;
            --sidebar-bg: #f8fafc;
            --content-max-w: 880px;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, sans-serif;
            background-color: #ffffff;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        /* Top Bar */
        .top-hub-bar {
            background-color: var(--navy-dark);
            color: #cbd5e1;
            font-size: 0.78rem;
            padding: 6px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Modern Clean Academy Navbar */
        .academy-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .nav-menu-link {
            color: #475569;
            font-weight: 600;
            font-size: 0.88rem;
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .nav-menu-link:hover {
            color: #0d2e5c;
            background-color: #f1f5f9;
        }

        .nav-menu-link.active {
            color: #0d2e5c;
            font-weight: 700;
            background-color: #f1f5f9;
        }

        @media (max-width: 1199.98px) {
            .nav-menu-link {
                display: flex;
                padding: 10px 14px;
                border-radius: 8px;
            }
        }

        /* Course Sub-Navbar (Skillance Modern Style) */
        .course-subnav {
            background-color: var(--navy);
            overflow-x: auto;
            white-space: nowrap;
            scrollbar-width: thin;
        }
        .course-subnav::-webkit-scrollbar {
            height: 4px;
        }
        .course-subnav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
        }
        .course-nav-link {
            display: inline-block;
            padding: 10px 18px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.2s;
        }
        .course-nav-link:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .course-nav-link.active {
            color: var(--navy);
            background-color: var(--gold);
        }

        /* Layout Container */
        .learn-container {
            display: flex;
            min-height: calc(100vh - 120px);
        }

        /* Left Sidebar (Topics Menu) */
        .learn-sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            border-right: 1px solid #e2e8f0;
            flex-shrink: 0;
            height: calc(100vh - 120px);
            position: sticky;
            top: 102px;
            overflow-y: auto;
            padding: 20px 0;
        }
        .sidebar-category-heading {
            padding: 12px 20px 6px 20px;
            font-size: 0.78rem;
            font-weight: 800;
            color: var(--navy);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            background-color: #f1f5f9;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            margin-top: 10px;
            margin-bottom: 4px;
        }
        .sidebar-category-heading:first-of-type {
            border-top: none;
            margin-top: 0;
        }
        .sidebar-header {
            padding: 0 20px 12px 20px;
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--navy);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 8px;
        }
        .topic-link {
            display: block;
            padding: 8px 20px;
            color: #475569;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.15s;
            border-left: 4px solid transparent;
        }
        .topic-link:hover {
            background-color: #e2e8f0;
            color: var(--navy);
        }
        .topic-link.active {
            background-color: #e0f2fe;
            color: var(--navy);
            border-left-color: var(--w3-green);
            font-weight: 700;
        }

        /* Main Content Area */
        .learn-content {
            flex-grow: 1;
            padding: 35px 40px;
            max-width: var(--content-max-w);
        }
        /* Mobile Topic Bar & Drawer */
        .mobile-topics-bar {
            background-color: var(--navy-dark);
            padding: 10px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            position: sticky;
            top: 56px;
            z-index: 1015;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
        }
        .btn-toggle-sidebar {
            background: #0d2e5c;
            color: #ffffff;
            border: 1px solid rgba(252, 163, 17, 0.5);
            border-radius: 8px;
            padding: 7px 14px;
            font-size: 0.82rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.2s;
        }
        .btn-toggle-sidebar:hover {
            background: #1e3a8a;
            border-color: var(--gold);
        }
        .mobile-active-topic {
            color: #cbd5e1;
            font-size: 0.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .active-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #4ade80;
            flex-shrink: 0;
            display: inline-block;
        }
        .sidebar-backdrop {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(3px);
            z-index: 2040;
            display: none;
            opacity: 0;
            transition: opacity 0.25s ease;
        }
        .sidebar-backdrop.show {
            display: block;
            opacity: 1;
        }
        .sidebar-mobile-header {
            display: none;
        }

        /* Mobile & Tablet Optimizations */
        @media (max-width: 991px) {
            .course-subnav {
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }
            .course-subnav::-webkit-scrollbar {
                display: none;
            }
            .learn-sidebar {
                display: block !important;
                position: fixed !important;
                top: 0 !important;
                left: -320px !important;
                width: 300px !important;
                max-width: 85vw !important;
                height: 100vh !important;
                z-index: 2050 !important;
                background: #ffffff !important;
                box-shadow: 4px 0 25px rgba(0, 0, 0, 0.25) !important;
                transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                padding-top: 0 !important;
                overflow-y: auto !important;
            }
            .learn-sidebar.open {
                left: 0 !important;
            }
            .sidebar-mobile-header {
                display: flex !important;
                background-color: #f8fafc;
            }
            .learn-content {
                padding: 20px 16px;
                max-width: 100%;
                overflow-x: hidden;
            }
            .topic-heading {
                font-size: 1.55rem;
                line-height: 1.3;
            }
            .nav-buttons-bar {
                gap: 8px;
            }
            .btn-w3-nav {
                flex: 1;
                justify-content: center;
                padding: 10px 14px;
                font-size: 0.82rem;
            }
            .skillance-code-box {
                padding: 14px;
                border-radius: 8px;
            }
            .btn-tryit {
                width: 100%;
                justify-content: center;
                padding: 12px 18px;
            }
            .completion-bar {
                flex-direction: column;
                gap: 12px;
                align-items: stretch !important;
                text-align: center;
            }
            .completion-bar button {
                width: 100%;
                justify-content: center;
            }
        }

        /* Nav Buttons Bar */
        .nav-buttons-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0 30px 0;
        }
        .btn-w3-nav {
            background-color: var(--w3-green);
            color: white;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 8px 20px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            transition: background 0.2s;
        }
        .btn-w3-nav:hover {
            background-color: var(--w3-green-hover);
            color: white;
        }
        .btn-w3-nav.disabled {
            background-color: #cbd5e1;
            pointer-events: none;
        }

        /* Typography & Headings */
        .topic-heading {
            font-size: 2rem;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 12px;
        }
        .learn-content p {
            line-height: 1.8;
            font-size: 0.95rem;
            color: #334155;
        }
        .learn-content h4 {
            font-weight: 700;
            color: var(--navy);
            margin-top: 30px;
            margin-bottom: 15px;
            font-size: 1.25rem;
        }

        /* Skillance Code Example Box */
        .skillance-code-box {
            background-color: #f1f5f9;
            border-left: 5px solid var(--w3-green);
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 10px 10px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .skillance-code-header {
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--navy);
            margin-bottom: 12px;
        }
        .skillance-code-wrapper {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            font-family: 'Fira Code', monospace;
            font-size: 0.85rem;
            line-height: 1.6;
            margin-bottom: 15px;
            overflow-x: auto;
            color: #0f172a;
        }
        .btn-tryit {
            background-color: var(--w3-green);
            color: white;
            font-weight: 700;
            font-size: 0.88rem;
            padding: 10px 22px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 5px rgba(4, 170, 109, 0.2);
            transition: all 0.2s;
        }
        .btn-tryit:hover {
            background-color: var(--w3-green-hover);
            color: white;
            transform: translateY(-1px);
        }

        /* Quiz Box */
        .w3-quiz-box {
            background-color: #fffdf5;
            border: 1px solid #fde68a;
            border-radius: 10px;
            padding: 22px;
            margin: 30px 0;
        }
        .quiz-title {
            font-weight: 800;
            color: #78350f;
            font-size: 1rem;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Completion Bar */
        .completion-bar {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 35px 0;
        }
    </style>
</head>
<body>

    <?php
    $activeNav = 'learn';
    $showSubnav = true;
    $currentCourse = $currentCourse;
    include __DIR__ . '/includes/navbar.php';
    ?>

    <!-- MOBILE TOPIC TOGGLE BAR -->
    <div class="mobile-topics-bar d-lg-none">
        <button class="btn-toggle-sidebar" onclick="toggleSidebar(true)">
            <i class="fa-solid fa-bars me-2 text-warning"></i>
            <span>Daftar Materi (<?= count($topics) ?>)</span>
        </button>
        <div class="mobile-active-topic text-truncate">
            <span class="active-dot"></span>
            <span><?= htmlspecialchars($currentTopic['title']) ?></span>
        </div>
    </div>

    <!-- BACKDROP FOR MOBILE SIDEBAR -->
    <div id="sidebarBackdrop" class="sidebar-backdrop d-lg-none" onclick="toggleSidebar(false)"></div>

    <!-- MAIN LAYOUT -->
    <div class="learn-container">
        
        <!-- LEFT SIDEBAR: TOPIC LIST -->
        <aside id="learnSidebar" class="learn-sidebar">
            <div class="sidebar-mobile-header d-flex justify-content-between align-items-center p-3 border-bottom">
                <span class="fw-bold text-navy" style="font-size: 0.92rem;">
                    <i class="<?= $courseData['icon'] ?> me-2" style="color: <?= $courseData['color'] ?>;"></i>
                    <?= htmlspecialchars($courseData['name']) ?>
                </span>
                <button type="button" class="btn-close text-reset" onclick="toggleSidebar(false)" aria-label="Tutup"></button>
            </div>
            <div class="sidebar-header">
                <i class="<?= $courseData['icon'] ?> me-2" style="color: <?= $courseData['color'] ?>;"></i>
                <?= htmlspecialchars($courseData['name']) ?>
            </div>
            <nav>
                <?php if (!empty($courseData['categories'])): ?>
                    <?php foreach ($courseData['categories'] as $catName => $catTopics): ?>
                        <div class="sidebar-category-heading"><?= htmlspecialchars($catName) ?></div>
                        <?php foreach ($catTopics as $tKey => $top): ?>
                            <a href="learn.php?c=<?= urlencode($currentCourse) ?>&p=<?= urlencode($tKey) ?>" 
                               class="topic-link <?= ($tKey === $currentTopicKey) ? 'active' : '' ?>"
                               id="topic-link-<?= htmlspecialchars($tKey) ?>">
                                <?= htmlspecialchars($top['title']) ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php foreach ($topics as $tKey => $top): ?>
                        <a href="learn.php?c=<?= urlencode($currentCourse) ?>&p=<?= urlencode($tKey) ?>" 
                           class="topic-link <?= ($tKey === $currentTopicKey) ? 'active' : '' ?>"
                           id="topic-link-<?= htmlspecialchars($tKey) ?>">
                            <?= htmlspecialchars($top['title']) ?>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </nav>
        </aside>

        <!-- MAIN READING CONTENT -->
        <main class="learn-content">
            
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-2">
                <ol class="breadcrumb small text-muted">
                    <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted">Akademi</a></li>
                    <li class="breadcrumb-item"><a href="learn.php?c=<?= urlencode($currentCourse) ?>" class="text-decoration-none text-navy fw-semibold"><?= htmlspecialchars($courseData['name']) ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($currentTopic['title']) ?></li>
                </ol>
            </nav>

            <h1 class="topic-heading"><?= htmlspecialchars($currentTopic['title']) ?></h1>

            <!-- Top Nav Buttons -->
            <div class="nav-buttons-bar">
                <?php if ($prevTopicKey): ?>
                    <a href="learn.php?c=<?= urlencode($currentCourse) ?>&p=<?= urlencode($prevTopicKey) ?>" class="btn-w3-nav">
                        &laquo; Sebelumnya
                    </a>
                <?php else: ?>
                    <span class="btn-w3-nav disabled">&laquo; Sebelumnya</span>
                <?php endif; ?>

                <?php if ($nextTopicKey): ?>
                    <a href="learn.php?c=<?= urlencode($currentCourse) ?>&p=<?= urlencode($nextTopicKey) ?>" class="btn-w3-nav">
                        Berikutnya &raquo;
                    </a>
                <?php else: ?>
                    <span class="btn-w3-nav disabled">Berikutnya &raquo;</span>
                <?php endif; ?>
            </div>

            <hr class="text-muted my-3">

            <!-- Explanation Content -->
            <div class="article-body">
                <?= $currentTopic['content'] ?>
            </div>

            <!-- Skillance Interactive Code Example -->
            <?php if (!empty($currentTopic['example_code'])): ?>
                <div class="skillance-code-box">
                    <div class="skillance-code-header">
                        <i class="fa-solid fa-code text-success me-2"></i><?= htmlspecialchars($currentTopic['example_title']) ?>:
                    </div>
                    <div class="skillance-code-wrapper">
                        <pre class="m-0"><code><?= htmlspecialchars($currentTopic['example_code']) ?></code></pre>
                    </div>
                    <a href="tryit.php?c=<?= urlencode($currentCourse) ?>&p=<?= urlencode($currentTopicKey) ?>" target="_blank" class="btn-tryit">
                        <i class="fa-solid fa-bolt"></i> Coba Sendiri (Try it Yourself) &raquo;
                    </a>
                </div>

                <?php if (!empty($currentTopic['explanation'])): ?>
                    <div class="mt-3">
                        <?= $currentTopic['explanation'] ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Interactive Knowledge Check (Quiz) -->
            <?php if (!empty($currentTopic['quiz'])): ?>
                <div class="w3-quiz-box">
                    <div class="quiz-title">
                        <i class="fa-solid fa-circle-question text-warning fs-5"></i>
                        <span>Uji Pemahaman Singkat (Test Yourself):</span>
                    </div>
                    <p class="fw-semibold text-dark mb-3"><?= htmlspecialchars($currentTopic['quiz']['q']) ?></p>
                    
                    <div class="d-flex flex-column gap-2 mb-3" id="quizOptionGroup">
                        <?php foreach ($currentTopic['quiz']['options'] as $oIdx => $opt): ?>
                            <button type="button" class="btn btn-outline-secondary text-start p-2 rounded-2 quiz-btn" onclick="checkAnswer(<?= $oIdx ?>, <?= (int)$currentTopic['quiz']['answer'] ?>, '<?= htmlspecialchars(addslashes($currentTopic['quiz']['explanation'])) ?>', this)">
                                <strong><?= chr(65 + $oIdx) ?>.</strong> <?= htmlspecialchars($opt) ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                    <div id="quizResultMsg" class="small p-2 rounded-2" style="display:none;"></div>
                </div>
            <?php endif; ?>

            <!-- Complete Module Check Bar -->
            <div class="completion-bar">
                <div>
                    <h6 class="fw-bold text-navy mb-1"><i class="fa-solid fa-circle-check text-success me-1"></i> Selesaikan Topik Ini</h6>
                    <small class="text-muted">Tandai modul selesai untuk mencatat progres akun Anda.</small>
                </div>
                <button type="button" class="btn btn-sm btn-outline-success fw-bold px-4 py-2 rounded-pill" id="btnMarkComplete" onclick="toggleProgress()">
                    <i class="fa-regular fa-square-check me-1"></i> Tandai Selesai
                </button>
            </div>

            <!-- Bottom Nav Buttons -->
            <div class="nav-buttons-bar border-top pt-4">
                <?php if ($prevTopicKey): ?>
                    <a href="learn.php?c=<?= urlencode($currentCourse) ?>&p=<?= urlencode($prevTopicKey) ?>" class="btn-w3-nav">
                        &laquo; Sebelumnya
                    </a>
                <?php else: ?>
                    <span class="btn-w3-nav disabled">&laquo; Sebelumnya</span>
                <?php endif; ?>

                <?php if ($nextTopicKey): ?>
                    <a href="learn.php?c=<?= urlencode($currentCourse) ?>&p=<?= urlencode($nextTopicKey) ?>" class="btn-w3-nav">
                        Berikutnya &raquo;
                    </a>
                <?php else: ?>
                    <span class="btn-w3-nav disabled">Berikutnya &raquo;</span>
                <?php endif; ?>
            </div>

        </main>
    </div>

    <!-- MOBILE OFFCANVAS FOR TOPIC LIST -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel">
        <div class="offcanvas-header bg-navy text-white">
            <h5 class="offcanvas-title fw-bold" id="sidebarOffcanvasLabel"><?= htmlspecialchars($courseData['name']) ?></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0 bg-light">
            <nav class="py-2">
                <?php if (!empty($courseData['categories'])): ?>
                    <?php foreach ($courseData['categories'] as $catName => $catTopics): ?>
                        <div class="sidebar-category-heading"><?= htmlspecialchars($catName) ?></div>
                        <?php foreach ($catTopics as $tKey => $top): ?>
                            <a href="learn.php?c=<?= urlencode($currentCourse) ?>&p=<?= urlencode($tKey) ?>" 
                               class="topic-link <?= ($tKey === $currentTopicKey) ? 'active' : '' ?>">
                                <?= htmlspecialchars($top['title']) ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php foreach ($topics as $tKey => $top): ?>
                        <a href="learn.php?c=<?= urlencode($currentCourse) ?>&p=<?= urlencode($tKey) ?>" 
                           class="topic-link <?= ($tKey === $currentTopicKey) ? 'active' : '' ?>">
                            <?= htmlspecialchars($top['title']) ?>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </nav>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const COURSE_KEY = <?= json_encode($currentCourse) ?>;
        const TOPIC_KEY = <?= json_encode($currentTopicKey) ?>;
        const IS_LOGGED_IN = <?= $isLoggedIn ? 'true' : 'false' ?>;

        let isCompleted = false;

        // Check local or remote progress
        function checkProgress() {
            const storageKey = `done_${COURSE_KEY}_${TOPIC_KEY}`;
            if (localStorage.getItem(storageKey) === '1') {
                setCompletedUI(true);
            }

            if (IS_LOGGED_IN) {
                fetch('api/progress.php')
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success' && data.completed_modules) {
                            const found = data.completed_modules.some(m => m.track_id === COURSE_KEY && m.module_id === TOPIC_KEY);
                            if (found) {
                                setCompletedUI(true);
                            }
                        }
                    })
                    .catch(() => {});
            }
        }

        function setCompletedUI(completed) {
            isCompleted = completed;
            const btn = document.getElementById('btnMarkComplete');
            if (completed) {
                btn.className = 'btn btn-sm btn-success fw-bold px-4 py-2 rounded-pill shadow-sm';
                btn.innerHTML = '<i class="fa-solid fa-circle-check me-1"></i> Topik Selesai';
            } else {
                btn.className = 'btn btn-sm btn-outline-success fw-bold px-4 py-2 rounded-pill';
                btn.innerHTML = '<i class="fa-regular fa-square-check me-1"></i> Tandai Selesai';
            }
        }

        function toggleProgress() {
            const newState = !isCompleted;
            setCompletedUI(newState);
            const storageKey = `done_${COURSE_KEY}_${TOPIC_KEY}`;
            if (newState) {
                localStorage.setItem(storageKey, '1');
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Topik Diselesaikan!',
                        text: 'Hebat! Anda telah menyelesaikan materi ini. Lanjutkan ke topik berikutnya.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            } else {
                localStorage.removeItem(storageKey);
            }

            if (IS_LOGGED_IN) {
                fetch('api/progress.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        track_id: COURSE_KEY,
                        module_id: TOPIC_KEY,
                        completed: newState
                    })
                }).catch(() => {});
            }
        }

        function checkAnswer(selectedIdx, correctIdx, explanation, btnEl) {
            const allBtns = document.querySelectorAll('.quiz-btn');
            allBtns.forEach(b => b.disabled = true);

            const resultEl = document.getElementById('quizResultMsg');
            resultEl.style.display = 'block';

            if (selectedIdx === correctIdx) {
                btnEl.classList.remove('btn-outline-secondary');
                btnEl.classList.add('btn-success', 'text-white');
                resultEl.className = 'small p-2 rounded-2 bg-success-subtle text-success fw-semibold mt-2';
                resultEl.innerHTML = '<i class="fa-solid fa-circle-check me-1"></i> <strong>Benar!</strong> ' + explanation;
            } else {
                btnEl.classList.remove('btn-outline-secondary');
                btnEl.classList.add('btn-danger', 'text-white');
                if (allBtns[correctIdx]) {
                    allBtns[correctIdx].classList.remove('btn-outline-secondary');
                    allBtns[correctIdx].classList.add('btn-success', 'text-white');
                }
                resultEl.className = 'small p-2 rounded-2 bg-danger-subtle text-danger fw-semibold mt-2';
                resultEl.innerHTML = '<i class="fa-solid fa-circle-xmark me-1"></i> <strong>Kurang Tepat.</strong> ' + explanation;
            }
        }

        function toggleSidebar(open) {
            const sb = document.getElementById('learnSidebar');
            const bd = document.getElementById('sidebarBackdrop');
            if (open) {
                sb.classList.add('open');
                bd.classList.add('show');
                document.body.style.overflow = 'hidden';
                const activeLink = document.querySelector('.learn-sidebar .topic-link.active');
                if (activeLink) {
                    activeLink.scrollIntoView({ block: 'center', behavior: 'smooth' });
                }
            } else {
                sb.classList.remove('open');
                bd.classList.remove('show');
                document.body.style.overflow = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            checkProgress();
            const sidebar = document.getElementById('learnSidebar');
            const activeLink = document.querySelector('.learn-sidebar .topic-link.active');
            if (sidebar && activeLink) {
                const linkTop = activeLink.offsetTop;
                const sidebarHeight = sidebar.clientHeight;
                sidebar.scrollTop = Math.max(0, linkTop - (sidebarHeight / 2));
            }
        });
    </script>
<?php include_once __DIR__ . '/includes/spotlight_modal.php'; ?>
<script src="assets/js/spotlight.js"></script>
</body>
</html>
