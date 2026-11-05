<?php
// Skillance Academy - Data Materi Tutorial Berstandar W3Schools

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
        'badge' => 'Menengah',
        'icon' => 'fa-brands fa-js',
        'color' => '#f7df1e',
        'desc' => 'JavaScript adalah bahasa pemrograman yang membuat halaman web menjadi interaktif dan dinamis.',
        'topics' => [
            'intro' => [
                'title' => 'JavaScript Pengenalan (Introduction)',
                'summary' => 'Apa itu JavaScript, bagaimana cara menjalankannya di browser, dan apa saja fungsinya.',
                'content' => '
                    <p class="lead">JavaScript adalah bahasa pemrograman paling populer di dunia. JavaScript membuat halaman web dapat bereaksi terhadap interaksi pengguna, mengubah konten HTML secara langsung, dan berkomunikasi dengan server di latar belakang.</p>

                    <h4>Apa yang Bisa Dilakukan JavaScript di Browser?</h4>
                    <ul>
                        <li>Mengubah konten dan teks HTML (<code>document.getElementById(...).innerHTML = ...</code>).</li>
                        <li>Mengubah atribut dan gaya CSS (misalnya menyembunyikan atau menampilkan popup).</li>
                        <li>Memvalidasi data formulir sebelum dikirim ke server.</li>
                        <li>Mengambil data terbaru tanpa harus memuat ulang seluruh halaman (Fetch API).</li>
                    </ul>
                ',
                'example_title' => 'JavaScript Mengubah Konten HTML',
                'example_code' => '<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 30px; background: #fffbeb; }
        .box { background: white; padding: 25px; border-radius: 12px; border: 2px solid #fde68a; max-width: 350px; margin: auto; }
        .btn { background: #0d2e5c; color: white; padding: 10px 18px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>

    <div class="box">
        <h3 id="demoText">Belum Ada Aksi</h3>
        <p>Klik tombol di bawah untuk melihat keajaiban JavaScript:</p>
        <button class="btn" onclick="ubahTeks()">Ubah Konten</button>
    </div>

    <script>
        function ubahTeks() {
            document.getElementById("demoText").innerText = "Halo Talenta Skillance Academy! 🚀";
            document.getElementById("demoText").style.color = "#04AA6D";
        }
    </script>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Cara Kerja Kode di Atas:</h5>
                    <p>Saat tombol diklik (event <code>onclick</code>), fungsi JavaScript bernama <code>ubahTeks()</code> dijalankan. Fungsi tersebut mencari elemen dengan id <code>demoText</code>, lalu mengganti teks dan warnanya secara langsung.</p>
                ',
                'quiz' => [
                    'q' => 'Tag HTML apa yang digunakan untuk menuliskan kode JavaScript di dalam halaman web?',
                    'options' => ['<javascript>', '<script>', '<js>', '<code-js>'],
                    'answer' => 1,
                    'explanation' => 'Kode JavaScript diletakkan di dalam tag <script>...</script>.'
                ]
            ],
            'dom' => [
                'title' => 'JavaScript DOM & Event Listener',
                'summary' => 'Memanipulasi struktur pohon dokumen (DOM) dan merespons aksi klik, ketik, dan gerakan mouse pengguna.',
                'content' => '
                    <p class="lead"><strong>DOM (Document Object Model)</strong> adalah representasi standar yang dibuat oleh browser ketika halaman web dimuat. Melalui DOM, JavaScript mendapatkan kekuatan penuh untuk membaca, mengubah, dan menghapus elemen web apa pun.</p>

                    <p>Metode modern yang paling disarankan untuk merespons interaksi pengguna adalah menggunakan <code>addEventListener()</code>.</p>
                ',
                'example_title' => 'Interaksi Counter dengan addEventListener',
                'example_code' => '<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 20px; background: #f0fdf4; }
        .card { background: white; padding: 20px; border-radius: 10px; max-width: 280px; margin: auto; border: 1px solid #86efac; }
        .angka { font-size: 42px; font-weight: bold; color: #166534; margin: 10px 0; }
        button { padding: 8px 16px; margin: 0 4px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer; }
        .btn-plus { background: #16a34a; color: white; }
        .btn-reset { background: #e2e8f0; color: #334155; }
    </style>
</head>
<body>

    <div class="card">
        <h4>Penghitung Angka (Counter)</h4>
        <div class="angka" id="counterVal">0</div>
        <button class="btn-plus" id="btnPlus">+ Tambah</button>
        <button class="btn-reset" id="btnReset">Reset</button>
    </div>

    <script>
        let count = 0;
        const valEl = document.getElementById("counterVal");

        document.getElementById("btnPlus").addEventListener("click", function() {
            count++;
            valEl.innerText = count;
        });

        document.getElementById("btnReset").addEventListener("click", function() {
            count = 0;
            valEl.innerText = count;
        });
    </script>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Mengapa Menggunakan addEventListener?</h5>
                    <p><code>addEventListener</code> memisahkan logika JavaScript dari markup HTML, memungkinkan kita memasang banyak listener pada satu elemen, dan membuat kode lebih bersih serta mudah dites.</p>
                ',
                'quiz' => [
                    'q' => 'Method JavaScript mana yang digunakan untuk memasang pendengar aksi event (misal klik) pada elemen tanpa menggunakan atribut HTML inline?',
                    'options' => ['element.attach()', 'element.addEventListener()', 'element.onClickHandler()', 'element.listen()'],
                    'answer' => 1,
                    'explanation' => 'addEventListener adalah standar web resmi untuk mendaftarkan event handler ke suatu objek event target.'
                ]
            ]
        ]
    ],
    'php' => [
        'name' => 'PHP Tutorial',
        'short_name' => 'PHP',
        'badge' => 'Backend & Server',
        'icon' => 'fa-brands fa-php',
        'color' => '#777bb4',
        'desc' => 'PHP adalah bahasa pemrograman sisi server (server-side) yang sangat populer untuk web dan database.',
        'topics' => [
            'intro' => [
                'title' => 'PHP Pengenalan & Sintaks Dasar',
                'summary' => 'Pelajari bagaimana PHP dieksekusi di server dan bagaimana kode PHP menghasilkan keluaran HTML ke browser.',
                'content' => '
                    <p class="lead">PHP adalah singkatan dari <strong>PHP: Hypertext Preprocessor</strong>. Berbeda dengan JavaScript yang berjalan di browser pengguna, PHP berjalan di server web (seperti Apache atau Nginx).</p>

                    <p>Ketika pengguna meminta halaman berekstensi <code>.php</code>, server web akan mengeksekusi kode PHP di server, lalu hanya mengirimkan hasil akhirnya (biasanya berupa HTML murni atau JSON) ke browser pengguna. Pengguna tidak dapat melihat kode sumber PHP asli Anda!</p>
                ',
                'example_title' => 'Contoh Sintaks Dasar PHP',
                'example_code' => '<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: monospace; background: #0f172a; color: #38bdf8; padding: 25px; }
        .box { background: #1e293b; padding: 20px; border-radius: 8px; border-left: 4px solid #38bdf8; }
    </style>
</head>
<body>

    <div class="box">
        <h3>// Simulasi Output Server PHP</h3>
        <p>&lt;?php<br>
        $nama = "Siswa Skillance";<br>
        $jam = date("H:i");<br>
        echo "Halo, $nama! Server time: $jam";<br>
        ?&gt;</p>
        <button style="background:#38bdf8; color:#0f172a; border:none; padding:8px 16px; border-radius:6px; font-weight:bold; cursor:pointer;" onclick="alert(\'Hasil Output Server:\nHalo, Siswa Skillance! Server time aktif.\')">Jalankan Simulasi</button>
    </div>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Aturan Dasar Sintaks PHP:</h5>
                    <ul class="ps-3">
                        <li>Skrip PHP selalu diawali dengan <code>&lt;?php</code> dan diakhiri dengan <code>?&gt;</code>.</li>
                        <li>Setiap variabel di PHP diawali dengan tanda dollar (<code>$nama_variabel</code>).</li>
                        <li>Setiap pernyataan perintah PHP harus selalu diakhiri dengan tanda titik koma (<code>;</code>).</li>
                    </ul>
                ',
                'quiz' => [
                    'q' => 'Karakter apa yang wajib diletakkan di depan nama variabel di bahasa pemrograman PHP?',
                    'options' => ['@', '#', '$', '&'],
                    'answer' => 2,
                    'explanation' => 'Di PHP, semua variabel harus diawali dengan simbol dollar ($), contohnya $nama, $umur, $total.'
                ]
            ],
            'mysql_crud' => [
                'title' => 'PHP & MySQL (Prepared Statements)',
                'summary' => 'Menghubungkan PHP ke database MySQL dan melakukan query aman terhadap celah SQL Injection.',
                'content' => '
                    <p class="lead">Kombinasi PHP dan database relasional MySQL adalah pilar utama web modern (WordPress, Wikipedia, platform e-commerce, dll). Kunci terpenting dalam menangani database adalah <strong>keamanan kueri</strong>.</p>

                    <h4>Bahaya SQL Injection</h4>
                    <p>Jangan pernah memasukkan variabel input pengguna langsung ke string SQL seperti <code>SELECT * FROM users WHERE email = \'$email\'</code>. Peretas dapat memasukkan tanda kutip untuk membobol database. Selalu gunakan <strong>Prepared Statements</strong>!</p>
                ',
                'example_title' => 'Contoh Prepared Statement PHP MySQL',
                'example_code' => '<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: monospace; background: #1e1e2e; color: #a6adc8; padding: 20px; }
        .code-snippet { background: #181825; padding: 15px; border-radius: 8px; font-size: 0.85rem; }
        .hl-key { color: #89b4fa; }
        .hl-str { color: #a6e3a1; }
    </style>
</head>
<body>

    <div class="code-snippet">
        <span style="color:#6c7086;">// Menjalankan Query Aman dengan Prepared Statement</span><br><br>
        <span class="hl-key">$stmt</span> = $conn->prepare(<span class="hl-str">"SELECT id, name FROM users WHERE email = ?"</span>);<br>
        <span class="hl-key">$stmt</span>->bind_param(<span class="hl-str">"s"</span>, $userEmail);<br>
        <span class="hl-key">$stmt</span>->execute();<br>
        <span class="hl-key">$result</span> = $stmt->get_result();<br>
        <span class="hl-key">$user</span> = $result->fetch_assoc();
    </div>
    <p style="font-size:0.85rem; color:#f38ba8; margin-top:10px;">🛡️ Data diikat terpisah melalui tanda tanya (?) sehingga aman 100% dari SQL Injection.</p>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Alur Kerja Prepared Statement:</h5>
                    <ol class="ps-3">
                        <li><strong>Prepare</strong>: Template kueri SQL dikirim ke server database untuk dikompilasi terlebih dahulu.</li>
                        <li><strong>Bind Parameters</strong>: Nilai data input pengguna diikat (bound) ke parameter placeholder (?).</li>
                        <li><strong>Execute</strong>: Server mengeksekusi query dengan aman tanpa risiko eksekusi perintah berbahaya.</li>
                    </ol>
                ',
                'quiz' => [
                    'q' => 'Metode manakah yang paling aman dan direkomendasikan untuk mencegah serangan SQL Injection di PHP?',
                    'options' => ['Menggunakan Prepared Statements dengan parameter binding', 'Menggunakan addslashes()', 'Mengabaikan input pengguna', 'Menyembunyikan database'],
                    'answer' => 0,
                    'explanation' => 'Prepared Statements adalah standar industri wajib untuk mengamankan komunikasi database dari SQL Injection.'
                ]
            ]
        ]
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
