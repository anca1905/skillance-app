<?php
/**
 * Kamus Istilah Koding & Glosarium Pemrograman - Skillance Academy
 */
session_start();

$activeNav = 'glossary';
$showSubnav = false;

// Master SEO Configuration
$seoTitle = 'Kamus Istilah Koding & Glosarium Pemrograman Lengkap - Skillance Academy';
$seoDesc = 'Glosarium istilah pemrograman lengkap bahasa Indonesia untuk mahasiswa dan pemula. Pahami arti REST API, OOP, MVC, JWT, Flexbox, Flutter Widget, SQL Injection, dan Git.';
$seoKeywords = 'kamus coding indonesia, glosarium pemrograman, arti rest api, istilah koding pemula, cheat sheet coding, skillance academy';
$seoOgImage = 'https://academy.skillance.cloud/assets/img/og-academy.png';
$seoCanonical = 'https://academy.skillance.cloud/glossary.php';
$seoType = 'website';
$seoBreadcrumbs = [
    ['name' => 'Beranda', 'url' => 'https://academy.skillance.cloud/index.php'],
    ['name' => 'Kamus Koding', 'url' => 'https://academy.skillance.cloud/glossary.php']
];

$glossaryTerms = [
    // FUNDAMENTAL
    [
        'term' => 'Algoritma',
        'cat' => 'fundamental',
        'cat_name' => 'Fundamental',
        'desc' => 'Urutan langkah-langkah logis dan terstruktur yang disusun secara sistematis untuk memecahkan suatu masalah atau menyelesaikan tugas komputasi tertentu.',
        'example' => '// Contoh: Algoritma Menentukan Bilangan Genap\nif (angka % 2 === 0) {\n    console.log("Bilangan Genap");\n}'
    ],
    [
        'term' => 'Variabel (Variable)',
        'cat' => 'fundamental',
        'cat_name' => 'Fundamental',
        'desc' => 'Tempat atau wadah di dalam memori komputer yang digunakan untuk menampung nilai (data) yang nilainya dapat berubah-ubah selama program dijalankan.',
        'example' => 'let namaSiswa = "Ahmad Faisal";\nconst tahunLulus = 2026;'
    ],
    [
        'term' => 'Fungsi (Function)',
        'cat' => 'fundamental',
        'cat_name' => 'Fundamental',
        'desc' => 'Blok kode yang diberi nama dan dirancang untuk melakukan tugas tertentu, yang dapat dipanggil dan digunakan berulang kali (reusable code).',
        'example' => 'function hitungLuasPersegi(sisi) {\n    return sisi * sisi;\n}'
    ],
    [
        'term' => 'Looping (Perulangan)',
        'cat' => 'fundamental',
        'cat_name' => 'Fundamental',
        'desc' => 'Struktur kontrol yang mengeksekusi satu blok instruksi secara berulang-ulang selama suatu kondisi tertentu masih terpenuhi (Bernilai TRUE).',
        'example' => 'for (let i = 1; i <= 5; i++) {\n    console.log("Langkah ke-" + i);\n}'
    ],
    [
        'term' => 'Array',
        'cat' => 'fundamental',
        'cat_name' => 'Fundamental',
        'desc' => 'Tipe data terstruktur yang mampu menyimpan sekumpulan nilai atau elemen dengan indeks bernomor terurut, biasanya dimulai dari indeks ke-0.',
        'example' => 'const bahasa = ["HTML", "CSS", "JavaScript", "PHP"];\nconsole.log(bahasa[0]); // Output: HTML'
    ],

    // FRONTEND
    [
        'term' => 'DOM (Document Object Model)',
        'cat' => 'frontend',
        'cat_name' => 'Frontend',
        'desc' => 'Antarmuka pemrograman (API) yang merepresentasikan halaman web sebagai struktur pohon objek (tree structure) sehingga elemen HTML dapat dimanipulasi dengan JavaScript.',
        'example' => 'document.getElementById("judul").innerText = "Selamat Datang di Skillance";'
    ],
    [
        'term' => 'CSS Flexbox',
        'cat' => 'frontend',
        'cat_name' => 'Frontend',
        'desc' => 'Modul tata letak (layout) CSS satu dimensi yang dirancang untuk mendistribusikan ruang antar-elemen dan mengatur perataan konten secara dinamis dan responsif.',
        'example' => '.container {\n    display: flex;\n    justify-content: space-between;\n    align-items: center;\n}'
    ],
    [
        'term' => 'CSS Grid',
        'cat' => 'frontend',
        'cat_name' => 'Frontend',
        'desc' => 'Sistem tata letak CSS dua dimensi (baris dan kolom) yang memungkinkan developer membangun antarmuka web modern yang rumit dengan struktur yang sangat teratur.',
        'example' => '.grid-box {\n    display: grid;\n    grid-template-columns: repeat(3, 1fr);\n    gap: 20px;\n}'
    ],
    [
        'term' => 'Responsive Web Design (RWD)',
        'cat' => 'frontend',
        'cat_name' => 'Frontend',
        'desc' => 'Pendekatan desain web yang membuat tampilan dan susunan halaman secara otomatis menyesuaikan ukuran layar perangkat pengguna, mulai dari ponsel hingga desktop.',
        'example' => '@media (max-width: 768px) {\n    .sidebar { display: none; }\n    .konten { width: 100%; }\n}'
    ],
    [
        'term' => 'Fetch API & AJAX',
        'cat' => 'frontend',
        'cat_name' => 'Frontend',
        'desc' => 'Mekanisme JavaScript untuk mengambil atau mengirim data ke server di latar belakang tanpa harus memuat ulang (refresh) seluruh halaman browser.',
        'example' => 'fetch("/api/data.json")\n    .then(res => res.json())\n    .then(data => console.log(data));'
    ],

    // BACKEND
    [
        'term' => 'REST API',
        'cat' => 'backend',
        'cat_name' => 'Backend',
        'desc' => 'Representational State Transfer API, standar arsitektur komunikasi data antar-aplikasi menggunakan protokol HTTP dan format pertukaran data standar (biasanya JSON).',
        'example' => 'GET /api/v1/students -> Mengambil daftar siswa\nPOST /api/v1/students -> Mendaftarkan siswa baru'
    ],
    [
        'term' => 'CRUD',
        'cat' => 'backend',
        'cat_name' => 'Backend',
        'desc' => 'Singkatan dari Create (Buat), Read (Baca), Update (Ubah), dan Delete (Hapus)—empat operasi fundamental dalam manajemen data pada sistem informasi dan database.',
        'example' => 'C: INSERT INTO siswa ...\nR: SELECT * FROM siswa\nU: UPDATE siswa SET ...\nD: DELETE FROM siswa ...'
    ],
    [
        'term' => 'Middleware',
        'cat' => 'backend',
        'cat_name' => 'Backend',
        'desc' => 'Lapisan kode perantara yang memeriksa atau memproses permintaan (request) klien sebelum sampai ke pengendali utama (controller), misal pengecekan login atau hak akses.',
        'example' => 'function authMiddleware(req, res, next) {\n    if (!req.session.userId) return res.redirect("/login");\n    next();\n}'
    ],
    [
        'term' => 'JWT (JSON Web Token)',
        'cat' => 'backend',
        'cat_name' => 'Backend',
        'desc' => 'Standar terbuka (RFC 7519) untuk mentransmisikan klaim informasi secara aman antara dua pihak dalam bentuk token terenkripsi/ditandatangani secara digital.',
        'example' => 'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...'
    ],
    [
        'term' => 'MVC (Model-View-Controller)',
        'cat' => 'backend',
        'cat_name' => 'Backend',
        'desc' => 'Pola arsitektur perangkat lunak yang memisahkan aplikasi menjadi tiga komponen utama: Model (data), View (tampilan UI), dan Controller (logika alur bisnis).',
        'example' => 'Model: Student.php\nController: StudentController.php\nView: student_list.blade.php'
    ],

    // DATABASE
    [
        'term' => 'Primary Key & Foreign Key',
        'cat' => 'database',
        'cat_name' => 'Database',
        'desc' => 'Primary Key adalah kolom unik identitas baris data pada tabel. Foreign Key adalah kolom yang menghubungkan baris data tersebut ke Primary Key tabel lain (relasi).',
        'example' => 'CREATE TABLE pesanan (\n    id INT PRIMARY KEY AUTO_INCREMENT,\n    user_id INT, -- Foreign Key ke tabel users(id)\n    FOREIGN KEY (user_id) REFERENCES users(id)\n);'
    ],
    [
        'term' => 'SQL Injection & Prepared Statements',
        'cat' => 'database',
        'cat_name' => 'Database',
        'desc' => 'SQL Injection adalah celah keamanan di mana hacker menyusupkan kode SQL berbahaya. Dicegah secara mutlak menggunakan Prepared Statements (PDO).',
        'example' => '// Aman dengan Prepared Statements PDO:\n$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");\n$stmt->execute([$email]);'
    ],
    [
        'term' => 'ORM (Object-Relational Mapping)',
        'cat' => 'database',
        'cat_name' => 'Database',
        'desc' => 'Teknik pemrograman yang memungkinkan developer berinteraksi dengan database relasional menggunakan objek bahasa pemrograman tanpa menulis query SQL mentah.',
        'example' => '// Contoh ORM Eloquent di Laravel:\n$user = User::where("status", "active")->first();'
    ],

    // MOBILE & UI/UX
    [
        'term' => 'Flutter Widget & Hot Reload',
        'cat' => 'mobile',
        'cat_name' => 'Mobile & UI/UX',
        'desc' => 'Widget adalah blok penyusun UI di Flutter. Hot Reload memungkinkan developer melihat hasil perubahan kode pada emulator secara instan (<1 detik) tanpa merestart aplikasi.',
        'example' => 'class KartuProfil extends StatelessWidget {\n  Widget build(BuildContext context) => Card(child: Text("Siswa Skillance"));\n}'
    ],
    [
        'term' => 'Wireframe vs Mockup vs Prototype',
        'cat' => 'mobile',
        'cat_name' => 'Mobile & UI/UX',
        'desc' => 'Wireframe: sketsa kerangka dasar hitam-putih. Mockup: desain visual beresolusi tinggi dengan warna & tipografi. Prototype: prototipe interaktif yang bisa diklik dan diuji alurnya.',
        'example' => 'Tahapan Desain: Sketsa Ide -> Wireframe (Lo-Fi) -> Mockup (Hi-Fi) -> Prototipe Klik (Figma)'
    ],

    // GIT & DEVOPS
    [
        'term' => 'Git Commit & Branch',
        'cat' => 'devops',
        'cat_name' => 'Git & DevOps',
        'desc' => 'Commit adalah rekam jejak (snapshot) perubahan kode yang tersimpan dengan pesan riwayat. Branch adalah cabang kerja terisolasi untuk membuat fitur baru tanpa mengganggu kode utama.',
        'example' => 'git checkout -b fitur-sertifikasi\ngit add .\ngit commit -m "feat: integrasi verifikasi qr code"'
    ],
    [
        'term' => 'CI/CD Pipeline',
        'cat' => 'devops',
        'cat_name' => 'Git & DevOps',
        'desc' => 'Continuous Integration & Continuous Deployment: otomatisasi pengujian kode dan rilis (deploy) aplikasi ke server produksi setiap kali ada update di GitHub/GitLab.',
        'example' => 'Developer Push ke Git -> Auto Test Lulus -> Auto Deploy ke VPS Nginx Linux'
    ],
    [
        'term' => 'Reverse Proxy (Nginx)',
        'cat' => 'devops',
        'cat_name' => 'Git & DevOps',
        'desc' => 'Server perantara yang menerima permintaan dari internet dan meneruskannya ke server aplikasi backend (Node, PHP-FPM, Python) sekaligus mengelola SSL/HTTPS dan caching.',
        'example' => 'location / {\n    proxy_pass http://127.0.0.1:8000;\n    proxy_set_header Host $host;\n}'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include __DIR__ . '/includes/seo_meta.php'; ?>

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
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        .glossary-hero {
            background: linear-gradient(135deg, #0d2e5c 0%, #071a35 100%);
            color: white;
            padding: 55px 0 50px 0;
            text-align: center;
        }
        .term-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 22px;
            height: 100%;
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .term-card:hover {
            transform: translateY(-3px);
            border-color: #fca311;
            box-shadow: 0 10px 25px rgba(13, 46, 92, 0.08);
        }
        .category-filter-btn {
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.82rem;
            padding: 6px 16px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
            transition: all 0.2s ease;
        }
        .category-filter-btn:hover,
        .category-filter-btn.active {
            background-color: #0d2e5c;
            color: #ffffff;
            border-color: #0d2e5c;
        }
        pre.term-code {
            background: #0f172a;
            color: #38bdf8;
            font-family: 'Fira Code', monospace;
            font-size: 0.78rem;
            padding: 10px 14px;
            border-radius: 8px;
            margin: 0;
            white-space: pre-wrap;
            word-break: break-all;
        }
    </style>
</head>
<body>

    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <!-- HERO SECTION -->
    <header class="glossary-hero">
        <div class="container">
            <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill mb-3 text-uppercase shadow-sm" style="background-color: #fca311 !important; color: #071a35 !important; font-size: 0.78rem;">
                <i class="fa-solid fa-book-bookmark me-1"></i> Developer Terms & Knowledge Base
            </span>
            <h1 class="display-6 fw-bold font-heading mb-2 text-white">Kamus Istilah Koding & Pemrograman</h1>
            <p class="lead mx-auto mb-4 text-white-50" style="max-width: 680px; font-size: 0.98rem; line-height: 1.7;">
                Pahami istilah teknis standar industri dengan penjelasan bahasa Indonesia yang ramah pemula, disertai contoh sintaks praktis.
            </p>

            <!-- SEARCH INPUT -->
            <div class="mx-auto" style="max-width: 580px;">
                <div class="input-group input-group-lg shadow-sm">
                    <span class="input-group-text bg-white border-end-0 text-muted ps-3"><i class="fa-solid fa-magnifying-glass text-warning"></i></span>
                    <input type="text" id="glossarySearchInput" class="form-control border-start-0 fs-6 fw-semibold" placeholder="Ketik istilah (contoh: REST API, JWT, Flexbox, CRUD, PDO)..." autocomplete="off">
                    <button class="btn btn-warning fw-bold px-4 text-navy" type="button" onclick="clearGlossarySearch()">Reset</button>
                </div>
            </div>
        </div>
    </header>

    <main class="container py-4">
        <!-- CATEGORY PILLS FILTER -->
        <div class="d-flex flex-wrap align-items-center justify-content-center gap-2 mb-4">
            <button type="button" class="category-filter-btn active" data-category="all" onclick="filterGlossary('all', this)">Semua (<?= count($glossaryTerms) ?>)</button>
            <button type="button" class="category-filter-btn" data-category="fundamental" onclick="filterGlossary('fundamental', this)">Fundamental</button>
            <button type="button" class="category-filter-btn" data-category="frontend" onclick="filterGlossary('frontend', this)">Frontend Web</button>
            <button type="button" class="category-filter-btn" data-category="backend" onclick="filterGlossary('backend', this)">Backend API</button>
            <button type="button" class="category-filter-btn" data-category="database" onclick="filterGlossary('database', this)">Database SQL</button>
            <button type="button" class="category-filter-btn" data-category="mobile" onclick="filterGlossary('mobile', this)">Mobile & UI/UX</button>
            <button type="button" class="category-filter-btn" data-category="devops" onclick="filterGlossary('devops', this)">Git & DevOps</button>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="small text-muted" id="resultsCount">Menampilkan <strong><?= count($glossaryTerms) ?></strong> istilah koding</span>
            <span class="small text-muted d-none d-sm-inline"><i class="fa-solid fa-lightbulb text-warning me-1"></i> Klik salin contoh kode untuk mencoba di Code Lab</span>
        </div>

        <!-- GLOSSARY CARDS GRID -->
        <div class="row g-3" id="glossaryGrid">
            <?php foreach ($glossaryTerms as $idx => $t): ?>
                <div class="col-md-6 col-lg-4 glossary-card-item" data-cat="<?= $t['cat'] ?>" data-term="<?= strtolower($t['term']) ?>" data-desc="<?= strtolower($t['desc']) ?>">
                    <div class="term-card">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="fw-bold text-navy font-heading mb-0" style="font-size: 1.05rem;"><?= htmlspecialchars($t['term']) ?></h5>
                                <span class="badge bg-light text-muted border small"><?= htmlspecialchars($t['cat_name']) ?></span>
                            </div>
                            <p class="text-secondary small mb-3" style="line-height: 1.6; font-size: 0.86rem;">
                                <?= htmlspecialchars($t['desc']) ?>
                            </p>
                        </div>
                        <?php if (!empty($t['example'])): ?>
                            <div class="mt-2">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <small class="text-muted fw-semibold" style="font-size: 0.7rem;"><i class="fa-solid fa-code me-1 text-primary"></i> Contoh Sintaks:</small>
                                    <button type="button" class="btn btn-link text-muted p-0 text-decoration-none" style="font-size: 0.68rem;" onclick="copyCodeSnippet(this, '<?= htmlspecialchars(addslashes($t['example'])) ?>')">
                                        <i class="fa-solid fa-copy me-1"></i> Salin
                                    </button>
                                </div>
                                <pre class="term-code"><code><?= htmlspecialchars($t['example']) ?></code></pre>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="noResultsMsg" class="text-center py-5" style="display: none;">
            <div class="fs-1 text-muted mb-2"><i class="fa-solid fa-magnifying-glass"></i></div>
            <h5 class="fw-bold text-navy">Istilah Tidak Ditemukan</h5>
            <p class="text-muted small">Coba cari dengan kata kunci lain seperti <em>API, Flexbox, Looping, atau SQL</em>.</p>
            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="clearGlossarySearch()">Reset Pencarian</button>
        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include_once __DIR__ . '/includes/spotlight_modal.php'; ?>
    <script src="assets/js/spotlight.js"></script>

    <script>
        let currentFilterCat = 'all';

        function filterGlossary(cat, btnEl) {
            currentFilterCat = cat;
            document.querySelectorAll('.category-filter-btn').forEach(b => b.classList.remove('active'));
            if (btnEl) btnEl.classList.add('active');
            applyFilters();
        }

        const searchInput = document.getElementById('glossarySearchInput');
        if (searchInput) {
            searchInput.addEventListener('input', applyFilters);
        }

        function clearGlossarySearch() {
            if (searchInput) searchInput.value = '';
            filterGlossary('all', document.querySelector('.category-filter-btn[data-category="all"]'));
        }

        function applyFilters() {
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const items = document.querySelectorAll('.glossary-card-item');
            let visibleCount = 0;

            items.forEach(item => {
                const itemCat = item.getAttribute('data-cat');
                const itemTerm = item.getAttribute('data-term');
                const itemDesc = item.getAttribute('data-desc');

                const catMatch = (currentFilterCat === 'all' || itemCat === currentFilterCat);
                const searchMatch = !query || itemTerm.includes(query) || itemDesc.includes(query);

                if (catMatch && searchMatch) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            const countEl = document.getElementById('resultsCount');
            if (countEl) countEl.innerHTML = `Menampilkan <strong>${visibleCount}</strong> istilah koding`;

            const noRes = document.getElementById('noResultsMsg');
            if (noRes) noRes.style.display = (visibleCount === 0) ? 'block' : 'none';
        }

        function copyCodeSnippet(btn, code) {
            navigator.clipboard.writeText(code).then(() => {
                const orig = btn.innerHTML;
                btn.innerHTML = '<i class="fa-solid fa-check text-success me-1"></i> Disalin!';
                setTimeout(() => { btn.innerHTML = orig; }, 2000);
            });
        }
    </script>
</body>
</html>
