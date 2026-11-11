<?php
// Bank Soal Ujian Sertifikasi Kompetensi Resmi - Skillance Academy Indonesia
// Mode SoloLearn: Sertifikat Resmi Per Materi Belajar (HTML, CSS, JS, PHP, SQL, Python, dll) & Jalur Spesialisasi Karir

return [
    // =========================================================================
    // 1. SERTIFIKAT MODUL MATERI BELAJAR INDIVIDUAL (SOLOLEARN-STYLE - RP 19.000)
    // =========================================================================

    'html' => [
        'title' => 'Sertifikat Kompetensi HTML5 & Modern Semantic Web',
        'code' => 'HTML',
        'course_id' => 'html',
        'type' => 'course',
        'price' => 19000,
        'original_price' => 49000,
        'duration_minutes' => 15,
        'passing_score' => 70,
        'competencies' => 'HTML5 Semantic Elements, Document Object Structure, Web Forms & Validation, Accessibility (a11y) & ARIA, SEO & Meta Viewport, Audio & Video Elements',
        'questions' => [
            [
                'q' => 'Elemen HTML5 semantik manakah yang paling tepat digunakan untuk membungkus blok navigasi utama situs web?',
                'options' => ['<menu>', '<nav>', '<header>', '<section>'],
                'ans' => 1,
                'exp' => '<nav> dirancang khusus untuk menandai kelompok tautan navigasi utama pada halaman web.'
            ],
            [
                'q' => 'Apa perbedaan utama antara atribut `defer` dan `async` pada tag <script src="...">?',
                'options' => [
                    'defer mengunduh skrip secara asinkron tetapi menunda eksekusi sampai parsing HTML selesai secara urut, sedangkan async mengeksekusi skrip segera setelah selesai diunduh',
                    'async hanya dapat digunakan pada skrip inline, sedangkan defer untuk skrip eksternal',
                    'defer memblokir rendering halaman, sedangkan async tidak',
                    'Kedua atribut tersebut memiliki fungsi yang persis sama di semua browser modern'
                ],
                'ans' => 0,
                'exp' => 'Atribut defer mengeksekusi skrip setelah seluruh dokumen HTML selesai di-parse dengan tetap mempertahankan urutan script, sedangkan async langsung mengeksekusi script seketika unduhan selesai tanpa menjamin urutan.'
            ],
            [
                'q' => 'Atribut wajib manakah pada elemen <img> yang sangat krusial bagi pembaca layar (screen reader) tunanetra dan optimasi SEO?',
                'options' => ['title', 'alt', 'caption', 'desc'],
                'ans' => 1,
                'exp' => 'Atribut alt (alternative text) menyediakan deskripsi tekstual gambar untuk teknologi asistif (a11y) serta mesin pencari web.'
            ],
            [
                'q' => 'Elemen HTML5 manakah yang digunakan untuk memutar video secara native di peramban tanpa plugin pihak ketiga?',
                'options' => ['<media>', '<movie>', '<video>', '<embed>'],
                'ans' => 2,
                'exp' => 'Elemen <video> adalah standar HTML5 native untuk menyematkan konten video lengkap dengan kontrol play, pause, dan volume.'
            ],
            [
                'q' => 'Manakah pasangan elemen formulir yang tepat untuk mengelompokkan beberapa opsi radio/checkbox terkait beserta judul kelompoknya?',
                'options' => [
                    '<fieldset> dan <legend>',
                    '<group> dan <label>',
                    '<form-group> dan <title>',
                    '<div> dan <caption>'
                ],
                'ans' => 0,
                'exp' => '<fieldset> digunakan untuk membungkus kontrol formulir terkait secara semantik, dan <legend> menyediakan judul keterangan grup tersebut.'
            ],
            [
                'q' => 'Tag semantic HTML5 manakah yang paling sesuai untuk konten sampingan seperti artikel terkait, iklan, atau sidebar profil penulis?',
                'options' => ['<aside>', '<sidebar>', '<section>', '<div>'],
                'ans' => 0,
                'exp' => '<aside> merepresentasikan porsi dokumen yang kontennya berhubungan secara tidak langsung dengan konten utama di sekitarnya.'
            ],
            [
                'q' => 'Apa tujuan penulisan deklarasi `<!DOCTYPE html>` di baris paling pertama dokumen HTML?',
                'options' => [
                    'Mengaktifkan fitur kompilasi JavaScript otomatis',
                    'Menginstruksikan browser agar me-render halaman dalam standar mode modern (Standard Mode), bukan Quirks Mode',
                    'Menyambungkan dokumen secara langsung ke server CDN W3C',
                    'Menentukan jenis enkripsi file dokumen'
                ],
                'ans' => 1,
                'exp' => '<!DOCTYPE html> memberi tahu peramban untuk menggunakan spesifikasi HTML5 standar modern tanpa beralih ke quirks mode.'
            ],
            [
                'q' => 'Atribut keamanan `rel` apakah yang wajib dipasangkan saat menggunakan tautan `<a target="_blank">` untuk mencegah eksploitasi tabnabbing?',
                'options' => [
                    'rel="noopener noreferrer"',
                    'rel="secure external"',
                    'rel="nofollow hidden"',
                    'rel="safe newtab"'
                ],
                'ans' => 0,
                'exp' => 'Atribut rel="noopener noreferrer" mencegah tab baru mengakses objek window.opener tab asal sehingga aman dari pembajakan halaman.'
            ],
            [
                'q' => 'Tag meta apakah yang wajib disertakan di bagian <head> untuk memastikan halaman web dapat menyesuaikan skala tampilan secara responsif di ponsel mobile?',
                'options' => [
                    '<meta name="responsive" content="true">',
                    '<meta name="viewport" content="width=device-width, initial-scale=1.0">',
                    '<meta screen="mobile-first">',
                    '<meta device="smartphone">'
                ],
                'ans' => 1,
                'exp' => 'Meta viewport mengontrol dimensi dan penskalaan area pandang peramban terhadap lebar fisik perangkat.'
            ],
            [
                'q' => 'Tipe input HTML5 manakah yang secara otomatis menyediakan validasi format alamat surel pada browser sebelum formulir dikirim?',
                'options' => ['<input type="text" check="email">', '<input type="email">', '<input type="mail">', '<input type="address">'],
                'ans' => 1,
                'exp' => 'Input dengan type="email" memvalidasi pola alamat email secara otomatis sesuai spesifikasi RFC sebelum form disubmit.'
            ]
        ]
    ],

    'css' => [
        'title' => 'Sertifikat Kompetensi CSS3 Styling & Responsive Layout',
        'code' => 'CSS',
        'course_id' => 'css',
        'type' => 'course',
        'price' => 19000,
        'original_price' => 49000,
        'duration_minutes' => 15,
        'passing_score' => 70,
        'competencies' => 'CSS3 Box Model, Flexbox Architecture, CSS Grid 2D, Responsive Breakpoints, Transitions & Keyframe Animations, Specificity & Custom Properties (Variables)',
        'questions' => [
            [
                'q' => 'Model kotak CSS (Box Model) secara berurutan dari lapisan paling dalam ke luar terdiri dari komponen apa saja?',
                'options' => [
                    'Content -> Padding -> Border -> Margin',
                    'Content -> Border -> Padding -> Margin',
                    'Margin -> Border -> Padding -> Content',
                    'Content -> Margin -> Border -> Padding'
                ],
                'ans' => 0,
                'exp' => 'Box model tersusun dari: Content (isi teks/gambar) -> Padding (ruang dalam) -> Border (garis tepi) -> Margin (ruang luar).'
            ],
            [
                'q' => 'Apa keuntungan utama menerapkan `box-sizing: border-box;` pada seluruh elemen web?',
                'options' => [
                    'Mengubah elemen inline menjadi block secara otomatis',
                    'Nilai lebar (width) dan tinggi (height) elemen sudah mencakup padding dan border, sehingga ukuran total tidak bertambah besar saat padding ditambahkan',
                    'Menghapus margin bawaan browser pada elemen body',
                    'Membuat border menjadi berbentuk rounded tanpa border-radius'
                ],
                'ans' => 1,
                'exp' => 'Dengan border-box, padding dan border dihitung di dalam nilai width/height yang ditentukan, memudahkan perancangan layout presisi.'
            ],
            [
                'q' => 'Properti CSS Flexbox manakah yang digunakan untuk mengatur perataan elemen anak (items) di sepanjang sumbu silang (cross-axis)?',
                'options' => ['justify-content', 'align-items', 'flex-direction', 'align-content'],
                'ans' => 1,
                'exp' => 'align-items mengatur posisi item di sepanjang cross axis, sementara justify-content mengatur perataan di sepanjang main axis.'
            ],
            [
                'q' => 'Bagaimanakah perilaku elemen yang diberi deklarasi `position: absolute;`?',
                'options' => [
                    'Elemen selalu diposisikan relatif terhadap jendela browser (viewport)',
                    'Elemen keluar dari alur dokumen normal dan diposisikan relatif terhadap elemen induk terdekat yang memiliki position bukan static',
                    'Elemen tidak dapat digeser menggunakan properti top, right, bottom, left',
                    'Elemen tetap menempati ruang aslinya di layout dokumen'
                ],
                'ans' => 1,
                'exp' => 'Elemen absolute mencari leluhur terdekat dengan position selain static (seperti relative/absolute/fixed) sebagai titik acuan koordinatnya.'
            ],
            [
                'q' => 'Sintaks media query CSS manakah yang paling tepat untuk menargetkan perangkat dengan lebar layar maksimal 768px (tablet dan ponsel)?',
                'options' => [
                    '@media (max-width: 768px) { ... }',
                    '@media screen and (min-width: 768px) { ... }',
                    '@screen (device-width: 768px) { ... }',
                    '@query (width <= 768) { ... }'
                ],
                'ans' => 0,
                'exp' => '@media (max-width: 768px) menerapkan gaya CSS hanya jika lebar area pandang layar sama dengan atau lebih kecil dari 768 piksel.'
            ],
            [
                'q' => 'Urutan spesifisitas selektor CSS dari yang paling tinggi ke terendah adalah:',
                'options' => [
                    'Inline style > ID selector > Class/Attribute/Pseudo-class > Tag/Element selector',
                    'ID selector > Inline style > Tag selector > Class selector',
                    'Class selector > ID selector > Inline style > Universal (*)',
                    'Inline style > Tag selector > Class selector > ID selector'
                ],
                'ans' => 0,
                'exp' => 'Tingkat kekuatan spesifisitas: Inline Style (1000) > ID (100) > Class/Attribute/Pseudo-class (10) > Elemen/Pseudo-element (1).'
            ],
            [
                'q' => 'Dalam CSS Grid, perintah singkat manakah yang membuat tata letak 3 kolom dengan proporsi lebar yang sama rata?',
                'options' => [
                    'grid-template-columns: repeat(3, 1fr);',
                    'grid-columns: 3 auto;',
                    'grid-template-rows: 3 equal;',
                    'columns: 3fr 3fr 3fr;'
                ],
                'ans' => 0,
                'exp' => 'repeat(3, 1fr) menginstruksikan kontainer CSS Grid untuk membagi ruang menjadi 3 kolom berukuran 1 fraction sama besar.'
            ],
            [
                'q' => 'Deklarasi transisi CSS manakah yang mengubah warna latar (background-color) dengan durasi 0.3 detik menggunakan percepatan halus?',
                'options' => [
                    'transition: background-color 0.3s ease;',
                    'animate: background 300ms smooth;',
                    'transform: background-color in 0.3s;',
                    'change: bg-color 0.3s;'
                ],
                'ans' => 0,
                'exp' => 'Properti shorthand transition menerima nama properti, durasi transisi, dan timing-function (misalnya ease atau linear).'
            ],
            [
                'q' => 'Syarat utama agar properti `z-index` dapat berfungsi mengatur tumpukan lapisan elemen adalah:',
                'options' => [
                    'Elemen harus memiliki float: left',
                    'Elemen harus memiliki nilai position selain `static` (misal relative, absolute, fixed, atau sticky)',
                    'Elemen harus berada di dalam tag <nav>',
                    'Elemen harus memiliki display: flex'
                ],
                'ans' => 1,
                'exp' => 'z-index hanya efektif pada elemen yang posisinya diposisikan (positioned element) dengan nilai position bukan static.'
            ],
            [
                'q' => 'Kombinasi tiga properti CSS manakah yang digunakan untuk memotong teks satu baris yang terlalu panjang dan menggantinya dengan titik-titik elipsis (...)?',
                'options' => [
                    'white-space: nowrap; overflow: hidden; text-overflow: ellipsis;',
                    'text-wrap: none; display: hidden; ellipsis: true;',
                    'word-break: break-all; max-lines: 1; text-clip: dots;',
                    'overflow: scroll; text-overflow: clip; nowrap: active;'
                ],
                'ans' => 0,
                'exp' => 'Trik standar CSS untuk ellipsis 1 baris membutuhkan white-space: nowrap (mencegah wrap), overflow: hidden (sembunyikan luapan), dan text-overflow: ellipsis.'
            ]
        ]
    ],

    'javascript' => [
        'title' => 'Sertifikat Kompetensi Modern JavaScript ES6+ & DOM',
        'code' => 'JS',
        'course_id' => 'javascript',
        'type' => 'course',
        'price' => 19000,
        'original_price' => 49000,
        'duration_minutes' => 15,
        'passing_score' => 70,
        'competencies' => 'JavaScript ES6+ Syntax, Block Scoping & Immutability, DOM Manipulation & Event Handling, Array Higher-Order Functions, Async/Await & Promises, LocalStorage API',
        'questions' => [
            [
                'q' => 'Perbedaan mendasar antara deklarasi variabel menggunakan `const` dan `let` dalam JavaScript modern adalah:',
                'options' => [
                    'const memiliki function scope sedangkan let memiliki block scope',
                    'const tidak dapat di-reassign nilai referensinya setelah dideklarasikan, sedangkan let nilainya dapat diubah kembali',
                    'let tidak dapat digunakan di dalam loop for',
                    'const hanya dapat menyimpan nilai berupa angka integer'
                ],
                'ans' => 1,
                'exp' => 'Keduanya memiliki block scope, tetapi variabel const tidak dapat di-reassign ke referensi nilai baru setelah inisialisasi.'
            ],
            [
                'q' => 'Mengapa operator kesetaraan ketat `===` lebih disarankan dibanding operator kesetaraan longgar `==`?',
                'options' => [
                    '=== melakukan konversi tipe data implisit (type coercion) otomatis',
                    '=== membandingkan baik nilai maupun tipe data operan tanpa melakukan type coercion yang berisiko',
                    '== hanya bekerja untuk membandingkan objek',
                    '=== bekerja lebih lambat di browser lama'
                ],
                'ans' => 1,
                'exp' => 'Operator === membandingkan kesetaraan nilai dan tipe data sekaligus tanpa type juggling tersembunyi sehingga mencegah bug logika.'
            ],
            [
                'q' => 'Metode Array manakah yang mengembalikan array baru hasil transformasi setiap elemen tanpa mengubah isi array asli?',
                'options' => ['map()', 'forEach()', 'push()', 'splice()'],
                'ans' => 0,
                'exp' => 'map() mengiterasi seluruh elemen array dan mengembalikan array baru berisi hasil eksekusi fungsi callback pada masing-masing elemen.'
            ],
            [
                'q' => 'Apa yang dimaksud dengan konsep Closure dalam bahasa JavaScript?',
                'options' => [
                    'Proses penutupan peramban saat tab ditutup',
                    'Sebuah fungsi yang mempertahankan akses ke variabel-variabel di lingkup lexical scope induknya, bahkan setelah fungsi induk selesai dieksekusi',
                    'Metode untuk menghapus variabel dari memori browser',
                    'Cara membungkus kode JavaScript dalam file minifikasi'
                ],
                'ans' => 1,
                'exp' => 'Closure memberikan fungsi dalam kemampuan mengingat dan mengakses variabel dari lexical environment tempat fungsi tersebut didefinisikan.'
            ],
            [
                'q' => 'Keyword `await` hanya dapat digunakan di dalam blok fungsi yang memiliki kata kunci apa?',
                'options' => ['sync', 'defer', 'async', 'promise'],
                'ans' => 2,
                'exp' => 'await hanya dapat disematkan di dalam fungsi yang diawali dengan deklarasi async.'
            ],
            [
                'q' => 'Teknik mendengarkan event pada satu elemen induk untuk menangani event dari banyak elemen anak yang dibuat secara dinamis disebut:',
                'options' => ['Event Bubbling', 'Event Delegation', 'Event Hijacking', 'Event Polling'],
                'ans' => 1,
                'exp' => 'Event Delegation memanfaatkan bubbling dengan memasang listener tunggal pada elemen parent lalu memeriksa event.target.'
            ],
            [
                'q' => 'Manakah sifat khusus dari Arrow Function `() => {}` terkait nilai `this`?',
                'options' => [
                    'Arrow function tidak memiliki konteks `this` sendiri, melainkan mewarisi (lexically bound) `this` dari scope luar tempat ia dibuat',
                    'Arrow function selalu membuat binding `this` ke window global',
                    'Arrow function dapat digunakan sebagai constructor fungsi dengan kata kunci `new`',
                    'Arrow function tidak dapat menerima parameter fungsi'
                ],
                'ans' => 0,
                'exp' => 'Arrow function tidak memiliki binding this sendiri, melainkan mengadopsi nilai this dari lexical enclosing environment.'
            ],
            [
                'q' => 'Metode manakah yang paling tepat untuk mengubah sebuah objek JavaScript menjadi string JSON yang valid?',
                'options' => ['JSON.parse()', 'JSON.stringify()', 'JSON.toString()', 'Object.toJSON()'],
                'ans' => 1,
                'exp' => 'JSON.stringify() mengonversi objek atau nilai JavaScript menjadi string representasi JSON standar.'
            ],
            [
                'q' => 'Bagaimanakah cara menyimpan pasangan data key-value di peramban yang tetap tersimpan meskipun peramban ditutup dan dibuka kembali?',
                'options' => [
                    'sessionStorage.setItem("key", "value")',
                    'localStorage.setItem("key", "value")',
                    'window.cookieStore("key", "value")',
                    'document.saveItem("key", "value")'
                ],
                'ans' => 1,
                'exp' => 'localStorage menyimpan data tanpa batas waktu kedaluwarsa (persistent), sedangkan sessionStorage terhapus ketika tab peramban ditutup.'
            ],
            [
                'q' => 'Metode DOM modern manakah yang memilih seluruh elemen di halaman yang cocok dengan selektor CSS tertentu dalam bentuk NodeList?',
                'options' => ['document.querySelectorAll()', 'document.getElementBySelector()', 'document.find()', 'document.all()'],
                'ans' => 0,
                'exp' => 'document.querySelectorAll() menerima string selektor CSS apapun dan mengembalikan seluruh elemen yang cocok sebagai static NodeList.'
            ]
        ]
    ],

    'php' => [
        'title' => 'Sertifikat Kompetensi Backend PHP 8 & Web Application',
        'code' => 'PHP',
        'course_id' => 'php',
        'type' => 'course',
        'price' => 19000,
        'original_price' => 49000,
        'duration_minutes' => 15,
        'passing_score' => 70,
        'competencies' => 'PHP 8 Modern Syntax, Array Manipulation, Secure Database PDO / MySQLi Prepared Statements, Session & Cookie Management, Object-Oriented PHP, Error Handling',
        'questions' => [
            [
                'q' => 'Bagaimanakah sintaks yang valid untuk mendeklarasikan array asosiatif di PHP 8 modern?',
                'options' => [
                    '$user = ["nama" => "Faisal", "role" => "Admin"];',
                    '$user = {"nama": "Faisal", "role": "Admin"};',
                    '$user = array["nama" = "Faisal"];',
                    '$user = ("nama" -> "Faisal");'
                ],
                'ans' => 0,
                'exp' => 'Di PHP, short array syntax menggunakan tanda kurung siku `["kunci" => "nilai"]` dengan operator fat-arrow =>.'
            ],
            [
                'q' => 'Apa perbedaan utama antara perintah `require` dan `include` saat memuat file eksternal yang tidak ditemukan?',
                'options' => [
                    'include menghentikan script dengan Fatal Error, require hanya memunculkan Warning',
                    'require memunculkan Fatal Error (E_COMPILE_ERROR) dan langsung menghentikan eksekusi script, sedangkan include hanya memunculkan Warning (E_WARNING) dan script tetap berlanjut',
                    'require hanya memuat file berekstensi .inc',
                    'Tidak ada perbedaan antara keduanya di PHP 8'
                ],
                'ans' => 1,
                'exp' => 'require bersifat wajib (fatal error jika file hilang), sedangkan include bersifat opsional (peringatan warning saja).'
            ],
            [
                'q' => 'Metode terbaik dan paling standar dalam PHP untuk mencegah serangan kerentanan SQL Injection pada query database adalah:',
                'options' => [
                    'Menggunakan fungsi addslashes() pada setiap string input',
                    'Menggunakan Prepared Statements dengan parameter binding (PDO atau MySQLi)',
                    'Mengubah tanda kutip tunggal menjadi tanda kutip ganda',
                    'Menggunakan fungsi strip_tags()'
                ],
                'ans' => 1,
                'exp' => 'Prepared statements memisahkan struktur query SQL dari data masukan pengguna sehingga karakter berbahaya tidak dieksekusi sebagai perintah SQL.'
            ],
            [
                'q' => 'Variabel superglobal manakah di PHP yang digunakan untuk menangkap data formulir HTTP yang dikirim dengan metode POST?',
                'options' => ['$_GET', '$_POST', '$_REQUEST_DATA', '$_SERVER_POST'],
                'ans' => 1,
                'exp' => '$_POST adalah array asosiatif yang menyimpan parameter yang dikirim melalui HTTP POST method.'
            ],
            [
                'q' => 'Di dalam Object-Oriented Programming (OOP) PHP, properti dengan visibilitas `protected` dapat diakses oleh siapa saja?',
                'options' => [
                    'Hanya oleh class itu sendiri',
                    'Oleh class itu sendiri dan seluruh class turunannya (subclass/inheritance)',
                    'Oleh semua kode di luar class secara bebas',
                    'Hanya oleh interface yang bersangkutan'
                ],
                'ans' => 1,
                'exp' => 'Modifier protected mengizinkan akses dari dalam kelas pendefinisi serta kelas-kelas yang mewarisinya (children classes).'
            ],
            [
                'q' => 'Syarat utama pemanggilan fungsi `session_start()` di PHP agar tidak memicu error "Headers already sent" adalah:',
                'options' => [
                    'Harus dipanggil setelah seluruh tag HTML selesai ditulis',
                    'Harus dipanggil sebelum ada output data apapun (spasi, teks, atau tag HTML) yang dikirim ke peramban',
                    'Harus dipanggil di dalam method constructor class',
                    'Hanya boleh dipanggil di file footer.php'
                ],
                'ans' => 1,
                'exp' => 'session_start() mengirim cookie session melalui HTTP header, sehingga harus dieksekusi sebelum ada konten output ke browser.'
            ],
            [
                'q' => 'Fungsi bawaan PHP 8 manakah yang paling aman dan disarankan untuk mengenkripsi kata sandi (password hashing)?',
                'options' => ['md5()', 'sha1()', 'password_hash()', 'base64_encode()'],
                'ans' => 2,
                'exp' => 'password_hash() menggunakan algoritma bcrypt/argon2 yang sangat aman dan mengelola salt secara otomatis.'
            ],
            [
                'q' => 'Apa hasil dari operator null coalescing `$name = $username ?? "Tamu";` jika variabel `$username` bernilai `null` atau belum didefinisikan?',
                'options' => [
                    'Akan menghasilkan PHP Fatal Error',
                    'Variabel $name akan berisi string "Tamu"',
                    'Variabel $name akan bernilai false',
                    'Variabel $name akan bernilai kosong (empty string)'
                ],
                'ans' => 1,
                'exp' => 'Operator ?? mengembalikan operan kanan jika operan kiri berstatus null atau tidak terdefinisi (isset).'
            ],
            [
                'q' => 'Bagaimanakah penanganan pengecualian (Exception Handling) yang benar di PHP modern?',
                'options' => [
                    'try { // kode berisiko } catch (Throwable $e) { // penanganan error }',
                    'test { // kode } onError { // tangkap }',
                    'if (error) { catch(); }',
                    'guard { // kode } handle (Exception $e)'
                ],
                'ans' => 0,
                'exp' => 'Blok try...catch digunakan dengan menangkap instance Throwable atau Exception untuk penanganan error terkendali.'
            ],
            [
                'q' => 'Operator apakah yang digunakan untuk mengakses properti atau method non-static dari sebuah objek di PHP?',
                'options' => ['.', '->', '::', '=>'],
                'ans' => 1,
                'exp' => 'Operator panah `->` digunakan untuk mengakses properti dan method instance objek di PHP.'
            ]
        ]
    ],

    'sql' => [
        'title' => 'Sertifikat Kompetensi Database SQL & Relational Architecture',
        'code' => 'SQL',
        'course_id' => 'sql',
        'type' => 'course',
        'price' => 19000,
        'original_price' => 49000,
        'duration_minutes' => 15,
        'passing_score' => 70,
        'competencies' => 'ANSI SQL Queries, Relational Joins (INNER, LEFT, RIGHT), Aggregate Functions & Grouping (HAVING), Data Integrity & Constraints, Database Indexing, ACID Transactions',
        'questions' => [
            [
                'q' => 'Klausa SQL manakah yang digunakan untuk menyaring data agregat yang dihasilkan setelah pengelompokan `GROUP BY`?',
                'options' => ['WHERE', 'HAVING', 'FILTER', 'ORDER BY'],
                'ans' => 1,
                'exp' => 'WHERE menyaring baris individual sebelum diagregasi, sedangkan HAVING menyaring kelompok data hasil fungsi agregasi setelah GROUP BY.'
            ],
            [
                'q' => 'Perbedaan hasil antara `INNER JOIN` dan `LEFT JOIN` adalah:',
                'options' => [
                    'INNER JOIN menampilkan semua baris dari tabel kiri terlepas ada kecocokan atau tidak',
                    'INNER JOIN hanya menampilkan baris yang memiliki nilai cocok di kedua tabel, sedangkan LEFT JOIN menampilkan semua baris tabel kiri dan mengisi NULL pada tabel kanan jika tidak cocok',
                    'LEFT JOIN menghapus baris duplikat secara otomatis',
                    'INNER JOIN hanya dapat digunakan pada primary key bertipe integer'
                ],
                'ans' => 1,
                'exp' => 'LEFT JOIN mempertahankan seluruh data dari tabel sebelah kiri dan memadankan nilai tabel kanan atau mengembalikan NULL jika tiada relasi.'
            ],
            [
                'q' => 'Perintah DDL manakah yang digunakan untuk menghapus seluruh isi data sebuah tabel secara cepat dan mengulang nilai auto-increment ke angka 1?',
                'options' => ['DELETE FROM table_name;', 'TRUNCATE TABLE table_name;', 'DROP TABLE table_name;', 'REMOVE TABLE table_name;'],
                'ans' => 1,
                'exp' => 'TRUNCATE TABLE mengosongkan seluruh baris tabel secara cepat tanpa pencatatan logging per-baris dan me-reset sequence/auto-increment.'
            ],
            [
                'q' => 'Fungsi agregasi SQL manakah yang menghitung total jumlah baris data yang ada pada sebuah query?',
                'options' => ['SUM()', 'COUNT()', 'TOTAL()', 'ROWS()'],
                'ans' => 1,
                'exp' => 'COUNT() mengembalikan jumlah record atau nilai non-null yang sesuai kriteria query.'
            ],
            [
                'q' => 'Dalam pencarian dengan operator `LIKE`, karakter wildcard manakah yang mewakili nol atau lebih karakter sembarang?',
                'options' => ['_', '%', '*', '?'],
                'ans' => 1,
                'exp' => 'Simbol persen (%) mewakili deretan nol, satu, atau banyak karakter bebas, sedangkan garis bawah (_) mewakili tepat satu karakter tunggal.'
            ],
            [
                'q' => 'Apa keuntungan dan potensi kerugian penggunaan Index pada kolom tabel database relasional?',
                'options' => [
                    'Mempercepat query SELECT secara signifikan, namun dapat memperlambat proses INSERT/UPDATE/DELETE dan memakan ruang disk tambahan',
                    'Mengurangi ukuran memori database hingga 50%',
                    'Menghapus kebutuhan normalisasi database',
                    'Membuat data tabel terenkripsi secara otomatis'
                ],
                'ans' => 0,
                'exp' => 'Index membuat struktur B-Tree yang mempercepat pencarian (SELECT), tetapi memerlukan overhead pemeliharaan saat data dimodifikasi (CUD).'
            ],
            [
                'q' => 'Manakah perbedaan utama antara constraint `PRIMARY KEY` dan `UNIQUE KEY`?',
                'options' => [
                    'Tabel dapat memiliki banyak PRIMARY KEY tetapi hanya satu UNIQUE KEY',
                    'PRIMARY KEY tidak memperbolehkan nilai NULL sama sekali, sedangkan UNIQUE KEY memperbolehkan nilai NULL (tergantung DBMS)',
                    'UNIQUE KEY tidak dapat dihubungkan sebagai Foreign Key',
                    'PRIMARY KEY hanya berlaku untuk kolom tipe teks'
                ],
                'ans' => 1,
                'exp' => 'Sebuah tabel hanya memiliki satu PRIMARY KEY dan kolomnya wajib NOT NULL, sedangkan UNIQUE KEY menjamin keunikan dan dapat mengizinkan nilai NULL.'
            ],
            [
                'q' => 'Klausa SQL manakah di MySQL/PostgreSQL yang digunakan untuk membatasi jumlah data yang diambil ke peramban (misalnya hanya 10 data teratas)?',
                'options' => ['TOP 10', 'LIMIT 10', 'ROWNUM <= 10', 'FETCH 10 ONLY'],
                'ans' => 1,
                'exp' => 'LIMIT digunakan dalam dialek MySQL, SQLite, dan PostgreSQL untuk membatasi jumlah record output.'
            ],
            [
                'q' => 'Dalam mekanisme Transaksi Database (ACID), perintah apakah yang digunakan untuk membatalkan seluruh operasi query jika terjadi kegagalan sistem sebelum tersimpan permanen?',
                'options' => ['COMMIT', 'ROLLBACK', 'REVERT', 'CANCEL'],
                'ans' => 1,
                'exp' => 'ROLLBACK mengembalikan status database ke posisi awal sebelum transaksi dimulai jika ada query yang gagal.'
            ],
            [
                'q' => 'Bentuk Normal Pertama (1NF) dalam normalisasi database relasional mensyaratkan bahwa:',
                'options' => [
                    'Setiap kolom harus memiliki nilai tunggal yang atomik (tidak boleh ada multivalue/array) dan setiap baris harus unik',
                    'Seluruh kolom non-key harus bergantung secara fungsional penuh pada primary key',
                    'Tidak boleh ada dependensi transitif antar kolom',
                    'Tabel harus memiliki minimal 3 relasi foreign key'
                ],
                'ans' => 0,
                'exp' => '1NF mensyaratkan setiap sel data bersifat atomik (tidak dapat dibagi lagi) dan tidak memiliki repeating groups.'
            ]
        ]
    ],

    'flutter' => [
        'title' => 'Sertifikat Kompetensi Mobile Apps Flutter & Dart',
        'code' => 'FLT',
        'course_id' => 'flutter',
        'type' => 'course',
        'price' => 19000,
        'original_price' => 49000,
        'duration_minutes' => 15,
        'passing_score' => 70,
        'competencies' => 'Dart 3 OOP & Null Safety, Flutter Widget Architecture (Stateless vs Stateful), Reactive UI & setState(), Material Design & Scaffold, Navigation & Routing, HTTP API Integration with FutureBuilder',
        'questions' => [
            [
                'q' => 'Perbedaan paling mendasar antara StatelessWidget dan StatefulWidget dalam arsitektur Flutter adalah:',
                'options' => [
                    'StatelessWidget hanya untuk teks, sedangkan StatefulWidget untuk gambar',
                    'StatelessWidget bersifat statis dan datanya tidak dapat berubah saat runtime setelah dibangun, sedangkan StatefulWidget memiliki State internal yang dapat berubah secara dinamis merespons interaksi pengguna',
                    'StatefulWidget tidak dapat dirender di platform iOS',
                    'StatelessWidget membutuhkan izin root perangkat'
                ],
                'ans' => 1,
                'exp' => 'StatelessWidget adalah widget immutable tanpa state internal dinamis, sedangkan StatefulWidget mempertahankan state yang dapat dimutasi sepanjang siklus hidupnya.'
            ],
            [
                'q' => 'Metode manakah yang wajib dipanggil di dalam State sebuah StatefulWidget untuk memberitahu framework Flutter agar merender ulang (rebuild) antarmuka UI?',
                'options' => ['notifyListeners()', 'setState(() { ... })', 'rebuildUI()', 'updateState()'],
                'ans' => 1,
                'exp' => 'setState memberitahu framework Flutter bahwa kondisi internal widget telah berubah, memicu eksekusi ulang method build() untuk memperbarui tampilan layar.'
            ],
            [
                'q' => 'File konfigurasi manakah pada proyek Flutter yang digunakan untuk mengatur dependensi pustaka pihak ketiga, aset gambar, dan versi aplikasi?',
                'options' => ['config.xml', 'pubspec.yaml', 'flutter.json', 'build.gradle'],
                'ans' => 1,
                'exp' => 'pubspec.yaml adalah file manifest utama proyek Flutter dan Dart untuk mengelola packages, fonts, dan assets.'
            ],
            [
                'q' => 'Widget layout dasar manakah di Flutter yang menyusun elemen-elemen anaknya secara berurutan dari atas ke bawah (vertikal)?',
                'options' => ['Row', 'Column', 'Stack', 'Wrap'],
                'ans' => 1,
                'exp' => 'Column menyusun daftar widget anak di sepanjang sumbu vertikal, sedangkan Row menyusunnya secara horizontal.'
            ],
            [
                'q' => 'Widget standar Material Design apakah yang menyediakan kerangka visual dasar seperti AppBar, Drawer, FloatingActionButton, dan Body?',
                'options' => ['Container', 'Scaffold', 'Card', 'MaterialApp'],
                'ans' => 1,
                'exp' => 'Scaffold mengimplementasikan struktur layout visual Material Design dasar yang menyediakan slot AppBar, Body, BottomNavigationBar, dan FAB.'
            ],
            [
                'q' => 'Perintah manakah yang digunakan untuk berpindah ke rute halaman baru di Flutter dengan menumpuk halaman tersebut di atas navigation stack?',
                'options' => [
                    'Navigator.push(context, MaterialPageRoute(builder: (context) => DetailPage()))',
                    'Navigator.go(context, DetailPage())',
                    'Route.open(DetailPage())',
                    'context.navigate(DetailPage())'
                ],
                'ans' => 0,
                'exp' => 'Navigator.push menambahkan rute baru ke atas tumpukan navigasi yang dikelola oleh Navigator.'
            ],
            [
                'q' => 'Widget manakah yang paling direkomendasikan dan efisien untuk menampilkan daftar ribuan data secara dinamis tanpa membebani memori smartphone?',
                'options' => ['SingleChildScrollView + Column', 'ListView.builder', 'Table', 'Wrap.builder'],
                'ans' => 1,
                'exp' => 'ListView.builder membuat widget anak hanya saat item tersebut mendekati layar yang terlihat (lazy loading / on-demand recycling).'
            ],
            [
                'q' => 'Widget manakah yang secara khusus dirancang untuk menangani pembangunan antarmuka berdasarkan status asinkron dari sebuah objek Future (seperti response HTTP REST API)?',
                'options' => ['StreamBuilder', 'FutureBuilder', 'AsyncView', 'PromiseBuilder'],
                'ans' => 1,
                'exp' => 'FutureBuilder mengamati proses objek Future dan membangun UI berdasarkan ConnectionState (waiting, done, atau error).'
            ],
            [
                'q' => 'Dalam fitur Sound Null Safety bahasa Dart, simbol tanda tanya (?) setelah nama tipe data (misal: `String? name`) mengindikasikan bahwa:',
                'options' => [
                    'Variabel tersebut bertipe boolean',
                    'Variabel tersebut dapat menerima nilai null (nullable)',
                    'Variabel tersebut bersifat konstan',
                    'Variabel tersebut belum dikompilasi'
                ],
                'ans' => 1,
                'exp' => 'Tanda tanya (?) menandai tipe nullable yang mengizinkan variabel tersebut memiliki kemungkinan bernilai null secara eksplisit.'
            ],
            [
                'q' => 'Filosofi desain utama dalam pengembangan aplikasi dengan Flutter yang membedakannya dari framework lain adalah:',
                'options' => [
                    'Everything is a Widget (Segala elemen antarmuka, layout, hingga padding adalah widget deklaratif)',
                    'Kompilasi kode hanya dilakukan via JavaScript Web View',
                    'Tidak memerlukan bahasa pemrograman khusus',
                    'Harus menulis dua basis kode terpisah untuk iOS dan Android'
                ],
                'ans' => 0,
                'exp' => 'Flutter menerapkan prinsip "Everything is a widget", di mana struktur, gaya visual, animasi, dan perataan tersusun dari komposisi widget deklaratif.'
            ]
        ]
    ],

    'java' => [
        'title' => 'Sertifikat Kompetensi Pemrograman Java 21 LTS & Enterprise OOP',
        'code' => 'JAVA',
        'course_id' => 'java',
        'type' => 'course',
        'price' => 19000,
        'original_price' => 49000,
        'duration_minutes' => 15,
        'passing_score' => 70,
        'competencies' => 'Java 21 Syntax & Virtual Threads, 4 Pillars of OOP, Collections Framework (List, Map, Set), Exception Handling & Generics, JVM Memory Management, Multithreading',
        'questions' => [
            [
                'q' => 'Empat pilar utama dalam konsep Pemrograman Berorientasi Objek (OOP) di Java adalah:',
                'options' => [
                    'Compilation, Interpretation, Garbage Collection, Execution',
                    'Encapsulation, Inheritance, Polymorphism, Abstraction',
                    'Public, Private, Protected, Default',
                    'Class, Object, Method, Attribute'
                ],
                'ans' => 1,
                'exp' => 'Empat pilar dasar OOP adalah Enkapsulasi (pembungkusan data), Pewarisan (Inheritance), Polimorfisme (banyak bentuk), dan Abstraksi.'
            ],
            [
                'q' => 'Apa arti kata kunci `static` pada sebuah method atau variabel di Java?',
                'options' => [
                    'Method atau variabel tersebut tidak dapat diubah nilainya',
                    'Method atau variabel tersebut milik kelas itu sendiri dan dapat diakses langsung tanpa harus membuat objek instance terlebih dahulu',
                    'Method tersebut hanya dapat dipanggil di dalam package yang sama',
                    'Variabel tersebut dialokasikan di dalam memori Heap secara dinamis'
                ],
                'ans' => 1,
                'exp' => 'Member static terikat ke class level, bukan instance level, sehingga dapat dipanggil langsung melalui ClassName.methodName().'
            ],
            [
                'q' => 'Mengapa kelas `String` di Java disebut bersifat `immutable`?',
                'options' => [
                    'Karena String tidak dapat dicetak ke layar',
                    'Karena sekali objek String dibuat di memori String Pool, isi karakternya tidak dapat diubah; setiap modifikasi akan menghasilkan objek String baru',
                    'Karena String tidak mendukung karakter Unicode',
                    'Karena String hanya dapat menampung maksimal 255 karakter'
                ],
                'ans' => 1,
                'exp' => 'Immutability berarti nilai objek String tidak dapat dimodifikasi di tempat; operasi penggabungan membuat objek baru di memori.'
            ],
            [
                'q' => 'Manakah perbedaan utama antara `abstract class` dan `interface` di Java modern?',
                'options' => [
                    'Interface dapat memiliki method konstruktor, sedangkan abstract class tidak',
                    'Sebuah class hanya dapat meng-extend satu abstract class (single inheritance), tetapi dapat mengimplementasikan banyak interface (multiple inheritance)',
                    'Interface tidak dapat memiliki konstanta',
                    'Abstract class tidak boleh memiliki method konkret yang memiliki implementasi body'
                ],
                'ans' => 1,
                'exp' => 'Java mendukung multiple inheritance melalui implementasi multi-interface, namun hanya mendukung single class inheritance via extends.'
            ],
            [
                'q' => 'Dalam Java Collections Framework, struktur data manakah yang tidak memperbolehkan adanya elemen duplikat dan tidak menjamin urutan indeks?',
                'options' => ['ArrayList', 'HashSet', 'LinkedList', 'Vector'],
                'ans' => 1,
                'exp' => 'Set (seperti HashSet) menerapkan koleksi elemen unik tanpa duplikasi berdasarkan perbandingan hashCode() dan equals().'
            ],
            [
                'q' => 'Komponen runtime manakah di dalam Java Virtual Machine (JVM) yang bertugas membersihkan memori heap dari objek-objek yang sudah tidak lagi memiliki referensi aktif?',
                'options' => ['Class Loader', 'Garbage Collector (GC)', 'JIT Compiler', 'Bytecode Verifier'],
                'ans' => 1,
                'exp' => 'Garbage Collector secara otomatis mengidentifikasi dan membebaskan memori objek yang sudah tidak terjangkau (unreachable).'
            ],
            [
                'q' => 'Kata kunci `final` jika diterapkan pada sebuah deklarasi class memiliki efek apa?',
                'options' => [
                    'Class tersebut tidak dapat diinstansiasi',
                    'Class tersebut tidak dapat diwarisi (cannot be subclassed/extended)',
                    'Semua method di dalamnya wajib static',
                    'Class tersebut menjadi thread-safe secara otomatis'
                ],
                'ans' => 1,
                'exp' => 'Sebuah final class dicegah dari proses pewarisan/subclassing (contohnya kelas java.lang.String).'
            ],
            [
                'q' => 'Dalam penanganan blok exception `try-catch-finally`, kapan blok `finally` akan dieksekusi?',
                'options' => [
                    'Hanya jika terjadi error/exception di blok try',
                    'Hanya jika tidak ada error sama sekali',
                    'Selalu dieksekusi terlepas apakah exception terjadi atau tidak, sangat cocok untuk menutup resource (koneksi/file stream)',
                    'Hanya dieksekusi jika dipanggil oleh System.exit()'
                ],
                'ans' => 2,
                'exp' => 'Blok finally dijamin selalu berjalan baik saat alur program normal maupun ketika terjadi exception, ideal untuk cleanup resource.'
            ],
            [
                'q' => 'Signature method manakah yang merupakan titik awal eksekusi (entry point) aplikasi Java standar?',
                'options' => [
                    'public void main(String args)',
                    'public static void main(String[] args)',
                    'private static int main(String[] args)',
                    'public abstract void start(String[] args)'
                ],
                'ans' => 1,
                'exp' => 'JVM mencari method tepat dengan tanda public static void main(String[] args) sebagai titik masuk program.'
            ],
            [
                'q' => 'Apa manfaat utama penggunaan fitur Generics (misalnya `List<String>`) dalam bahasa Java?',
                'options' => [
                    'Meningkatkan keamanan tipe data saat waktu kompilasi (compile-time type safety) dan menghilangkan kebutuhan type casting eksplisit',
                    'Mempercepat proses kompilasi javac sebesar 80%',
                    'Mengubah tipe data primitif menjadi pointer memori C',
                    'Membuat kode Java dapat berjalan di browser tanpa JVM'
                ],
                'ans' => 0,
                'exp' => 'Generics memungkinkan programmer menentukan tipe data yang valid sehingga kesalahan tipe terdeteksi saat compile time, bukan runtime ClassCastException.'
            ]
        ]
    ],

    'cpp' => [
        'title' => 'Sertifikat Kompetensi Pemrograman C++20 & STL High Performance',
        'code' => 'CPP',
        'course_id' => 'cpp',
        'type' => 'course',
        'price' => 19000,
        'original_price' => 49000,
        'duration_minutes' => 15,
        'passing_score' => 70,
        'competencies' => 'C++20 Core & Syntax, Memory Pointers & References, Dynamic Memory Allocation (new/delete), RAII & Smart Pointers, STL Containers (vector, map), OOP & Virtual Polymorphism',
        'questions' => [
            [
                'q' => 'Perbedaan fundamental antara Pointer (`int* ptr`) dan Reference (`int& ref`) dalam C++ adalah:',
                'options' => [
                    'Pointer tidak dapat bernilai NULL, sedangkan reference dapat bernilai NULL',
                    'Pointer menyimpan alamat memori dan dapat di-reassign menunjuk ke variabel lain atau bernilai nullptr, sedangkan reference adalah alias konstan yang wajib diinisialisasi saat dibuat dan tidak dapat dipindah rujukannya',
                    'Reference memakan alokasi memori heap sebesar 16 byte',
                    'Tidak ada perbedaan antara keduanya di standar C++20'
                ],
                'ans' => 1,
                'exp' => 'Reference bertindak sebagai alias tetap bagi variabel asli dan tidak bisa null, sedangkan pointer menyimpan alamat memori independen yang fleksibel dimanipulasi.'
            ],
            [
                'q' => 'Pasangan operator manakah yang digunakan untuk mengalokasikan dan mendealokasikan memori dinamis di heap dalam C++?',
                'options' => ['malloc() dan free()', 'new dan delete', 'alloc dan dealloc', 'create dan destroy'],
                'ans' => 1,
                'exp' => 'Operator new mengalokasikan memori dan memanggil constructor objek, sedangkan delete memanggil destructor dan membebaskan memori heap.'
            ],
            [
                'q' => 'Simbol apakah yang digunakan untuk mendeklarasikan fungsi Destructor pada sebuah class C++?',
                'options' => ['!ClassName()', '~ClassName()', '#ClassName()', '^ClassName()'],
                'ans' => 1,
                'exp' => 'Destructor dideklarasikan dengan menambahkan karakter tilde (~) di depan nama class dan dipanggil otomatis saat objek keluar dari scope.'
            ],
            [
                'q' => 'Kontainer standar dari Standard Template Library (STL) C++ manakah yang menyimpan elemen secara berurutan dalam memori contiguous dan ukurannya dapat bertambah secara dinamis?',
                'options' => ['std::list', 'std::vector', 'std::map', 'std::set'],
                'ans' => 1,
                'exp' => 'std::vector mengimplementasikan dynamic array berkinerja tinggi dengan memori kontigu serta akses acak instan O(1).'
            ],
            [
                'q' => 'Kata kunci apakah yang wajib dipasangkan pada deklarasi method kelas dasar (base class) untuk mengaktifkan mekanisme Runtime Polymorphism (Late Binding) di C++?',
                'options' => ['override', 'virtual', 'dynamic', 'polymorphic'],
                'ans' => 1,
                'exp' => 'Kata kunci virtual memastikan bahwa pemanggilan fungsi melalui pointer/referensi kelas dasar merujuk ke implementasi fungsi di kelas turunan via virtual table (vtable).'
            ],
            [
                'q' => 'Jenis Smart Pointer modern dalam C++ standar yang memiliki kepemilikan eksklusif (tidak dapat disalin/copy, hanya dapat dipindah/move) terhadap objek heap adalah:',
                'options' => ['std::shared_ptr', 'std::unique_ptr', 'std::weak_ptr', 'std::auto_ptr'],
                'ans' => 1,
                'exp' => 'std::unique_ptr menerapkan filosofi kepemilikan tunggal eksklusif; objek dihancurkan otomatis saat unique_ptr keluar dari scope.'
            ],
            [
                'q' => 'Perintah standar I/O C++ manakah yang digunakan untuk mencetak teks output ke layar konsol dengan aman?',
                'options' => ['std::cin >> ...', 'std::cout << ...', 'printf_s(...)', 'System.out.print(...)'],
                'ans' => 1,
                'exp' => 'std::cout dipadukan dengan stream insertion operator (<<) adalah standar output stream di C++.'
            ],
            [
                'q' => 'Fitur apakah di C++ yang memungkinkan penulisan fungsi atau class generik yang dapat bekerja dengan tipe data apapun tanpa menduplikasi kode?',
                'options' => ['Preprocessor Macros', 'Templates (`template <typename T>`)', 'Inheritance', 'Lambdas'],
                'ans' => 1,
                'exp' => 'Templates menyediakan generic programming di C++ yang diinstansiasi menjadi kode konkret oleh kompiler saat compile time.'
            ],
            [
                'q' => 'Mengapa parameter fungsi bertipe objek besar disarankan dilewatkan dengan `const ClassName& param` daripada `ClassName param` (pass-by-value)?',
                'options' => [
                    'Mencegah terjadinya proses copy overhead yang mahal pada memori sekaligus melindungi objek agar tidak diubah secara tidak sengaja di dalam fungsi',
                    'Mengubah objek menjadi bertipe pointer',
                    'Membuat fungsi tersebut dapat diakses secara multi-thread',
                    'Menghemat penggunaan CPU cache level 1'
                ],
                'ans' => 0,
                'exp' => 'Pass-by-const-reference menghindari biaya pembuatan salinan objek (copy constructor) yang lambat tanpa mengorbankan keamanan data.'
            ],
            [
                'q' => 'Namespace standar tempat seluruh fungsi, kelas, dan variabel library bawaan C++ didefinisikan adalah:',
                'options' => ['core', 'sys', 'std', 'cpp'],
                'ans' => 2,
                'exp' => 'Pustaka standar C++ diisolasi di dalam namespace `std` (misalnya std::string, std::cout, std::vector).'
            ]
        ]
    ],

    'vue' => [
        'title' => 'Sertifikat Kompetensi Vue.js 3 Reaktif SPA & Komponen',
        'code' => 'VUE',
        'course_id' => 'vue',
        'type' => 'course',
        'price' => 19000,
        'original_price' => 49000,
        'duration_minutes' => 15,
        'passing_score' => 70,
        'competencies' => 'Vue 3 Composition API (<script setup>), Reactivity System (ref vs reactive), Two-way Data Binding (v-model), Conditional & List Rendering (v-if, v-for), Component Props & Emits, Computed Properties',
        'questions' => [
            [
                'q' => 'Dalam Vue.js 3 Composition API, fungsi reaktif manakah yang paling ideal digunakan untuk membuat variabel state reaktif dari tipe data primitif seperti string, number, atau boolean?',
                'options' => ['reactive()', 'ref()', 'state()', 'computed()'],
                'ans' => 1,
                'exp' => 'ref() membungkus nilai primitif ke dalam objek reaktif yang nilainya diakses melalui properti `.value` di bagian script dan langsung diakses tanpa .value di template.'
            ],
            [
                'q' => 'Perbedaan perilaku teknis antara direktif `v-if` dan `v-show` pada elemen antarmuka Vue adalah:',
                'options' => [
                    'v-if hanya bekerja pada teks, v-show untuk gambar',
                    'v-if merender atau menghancurkan elemen secara fisik dari DOM dokumen, sedangkan v-show selalu merender elemen di DOM dan hanya melakukan toggle gaya CSS `display: none`',
                    'v-show memiliki biaya inisialisasi yang lebih berat dibanding v-if',
                    'Tidak ada perbedaan keduanya di Vue 3'
                ],
                'ans' => 1,
                'exp' => 'v-if adalah kondisional render sejati (memasang/melepas elemen dari DOM), sedangkan v-show hanya mengubah style CSS display.'
            ],
            [
                'q' => 'Direktif bawaan Vue.js manakah yang digunakan untuk mewujudkan two-way data binding (pengikatan dua arah) pada input formulir?',
                'options' => ['v-bind', 'v-model', 'v-on', 'v-slot'],
                'ans' => 1,
                'exp' => 'v-model menyederhanakan sinkronisasi dua arah antara nilai input formulir pengguna dengan variabel reaktif state.'
            ],
            [
                'q' => 'Lifecycle hook manakah di Vue 3 Composition API yang dieksekusi tepat setelah komponen selesai dipasang (mounted) ke struktur DOM halaman?',
                'options' => ['onCreated()', 'onMounted()', 'onBeforeMount()', 'onUpdated()'],
                'ans' => 1,
                'exp' => 'onMounted() dijalankan saat komponen sudah terpasang di DOM, waktu yang ideal untuk memanggil API HTTP atau inisialisasi library pihak ketiga.'
            ],
            [
                'q' => 'Cara standar di Vue 3 `<script setup>` untuk menerima data properti yang dikirimkan oleh komponen induk (parent) adalah menggunakan compiler macro:',
                'options' => ['defineProps()', 'receiveProps()', 'inject()', 'useProps()'],
                'ans' => 0,
                'exp' => 'defineProps() adalah compiler macro bawaan dalam <script setup> untuk mendefinisikan prop yang diterima tanpa perlu di-import eksplisit.'
            ],
            [
                'q' => 'Bagaimanakah cara komponen anak (child component) mengirimkan event kustom beserta payload data kembali ke komponen induk?',
                'options' => ['defineEmits() / emit()', 'broadcast()', 'parent.send()', 'dispatch()'],
                'ans' => 0,
                'exp' => 'defineEmits() mendeklarasikan event kustom yang dapat dipancarkan komponen anak ke komponen induknya.'
            ],
            [
                'q' => 'Keunggulan utama penggunaan fungsi `computed()` dibanding memanggil method fungsi biasa di template Vue adalah:',
                'options' => [
                    'Computed properties memiliki fitur caching otomatis dan hanya dievaluasi ulang jika dependensi reaktifnya mengalami perubahan nilai',
                    'Computed properties berjalan di thread Web Worker terpisah',
                    'Computed properties tidak memerlukan return value',
                    'Computed properties dapat mengubah state secara langsung'
                ],
                'ans' => 0,
                'exp' => 'Computed property meng-cache hasilnya dan hanya melakukan kalkulasi ulang jika state yang menjadi dependensinya mengalami mutasi.'
            ],
            [
                'q' => 'Saat merender daftar elemen berulang menggunakan `v-for`, mengapa atribut `:key` yang unik wajib disertakan?',
                'options' => [
                    'Untuk memberikan nomor urut pada daftar',
                    'Membantu algoritma Virtual DOM Vue melacak identitas masing-masing node secara efisien saat terjadi mutasi susunan atau penghapusan item',
                    'Agar elemen tersebut memiliki style CSS unik',
                    'Sebagai syarat validasi HTML W3C'
                ],
                'ans' => 1,
                'exp' => 'Key unik bertindak sebagai petunjuk bagi Virtual DOM untuk mengidentifikasi node mana yang berubah tanpa merender ulang seluruh list.'
            ],
            [
                'q' => 'Tiga blok tag utama yang menyusun sebuah file Single File Component (SFC) berekstensi `.vue` adalah:',
                'options' => [
                    '<template>, <script>, dan <style>',
                    '<html>, <body>, dan <head>',
                    '<view>, <model>, dan <controller>',
                    '<layout>, <logic>, dan <css>'
                ],
                'ans' => 0,
                'exp' => 'File SFC Vue (.vue) merangkum logika (<script>), tampilan (<template>), dan styling (<style>) dalam satu file modular.'
            ],
            [
                'q' => 'Library perutean resmi (official routing) yang digunakan untuk membangun navigasi Single Page Application (SPA) pada ekosistem Vue adalah:',
                'options' => ['Vuex', 'Pinia', 'Vue Router', 'Vue Navigation'],
                'ans' => 2,
                'exp' => 'Vue Router adalah router resmi untuk Vue.js yang menyinkronkan URL browser dengan komponen tampilan tanpa reload halaman.'
            ]
        ]
    ],

    'jquery' => [
        'title' => 'Sertifikat Kompetensi jQuery DOM & AJAX Manipulation',
        'code' => 'JQR',
        'course_id' => 'jquery',
        'type' => 'course',
        'price' => 19000,
        'original_price' => 49000,
        'duration_minutes' => 15,
        'passing_score' => 70,
        'competencies' => 'jQuery Core Selectors, Document Ready Event, DOM Manipulation & Traversal, Event Listeners, CSS & Class Modifications, Asynchronous AJAX Requests',
        'questions' => [
            [
                'q' => 'Sintaks selektor jQuery manakah yang digunakan untuk memilih elemen HTML dengan atribut `id="btnSubmit"`?',
                'options' => ["$('.btnSubmit')", "$('#btnSubmit')", "$('btnSubmit')", "$('@btnSubmit')"],
                'ans' => 1,
                'exp' => 'Tanda pagar (#) digunakan sebagai selektor id di jQuery, persis seperti selektor CSS.'
            ],
            [
                'q' => 'Metode manakah di jQuery yang memastikan seluruh kode JavaScript baru dijalankan setelah struktur pohon DOM selesai dimuat sempurna?',
                'options' => [
                    '$(window).on("load", fn)',
                    '$(document).ready(function() { ... })',
                    '$(document).start(fn)',
                    '$.init(fn)'
                ],
                'ans' => 1,
                'exp' => '$(document).ready() mengeksekusi fungsi callback segera setelah struktur DOM dokumen siap tanpa menunggu file gambar selesai diunduh.'
            ],
            [
                'q' => 'Metode singkat bawaan jQuery manakah yang digunakan untuk mengirim permintaan data HTTP GET secara asinkron (AJAX)?',
                'options' => ['$.get()', '$.fetch()', '$.read()', '$.httpGet()'],
                'ans' => 0,
                'exp' => '$.get() adalah fungsi shorthand AJAX di jQuery untuk mengambil data dari server menggunakan HTTP GET request.'
            ],
            [
                'q' => 'Perbedaan antara metode `.html()` dan `.text()` pada manipulasi konten elemen di jQuery adalah:',
                'options' => [
                    '.html() hanya mengubah atribut tag, .text() mengubah warna tulisan',
                    '.html() mengatur atau mengambil konten beserta tag elemen HTML di dalamnya, sedangkan .text() hanya memproses string teks murni dengan melakukan escape pada tag HTML',
                    '.text() hanya bekerja pada elemen input',
                    'Tidak ada perbedaan antara keduanya'
                ],
                'ans' => 1,
                'exp' => '.html() mengolah markup HTML termasuk tag, sedangkan .text() memproses teks murni sehingga aman dari injeksi HTML.'
            ],
            [
                'q' => 'Metode jQuery manakah yang menambahkan class CSS baru ke elemen yang dipilih tanpa menghapus class yang sudah ada sebelumnya?',
                'options' => ['.setClass()', '.addClass()', '.appendClass()', '.insertClass()'],
                'ans' => 1,
                'exp' => '.addClass("nama-kelas") menambahkan satu atau lebih class ke sekumpulan elemen yang cocok.'
            ],
            [
                'q' => 'Metode manakah di jQuery yang digunakan untuk mengambil atau menetapkan nilai (value) dari elemen input form seperti textbox atau dropdown?',
                'options' => ['.val()', '.value()', '.getVal()', '.text()'],
                'ans' => 0,
                'exp' => '.val() digunakan khusus untuk membaca atau mengatur properti value pada elemen formulir.'
            ],
            [
                'q' => 'Cara modern dan paling direkomendasikan untuk memasang event handler klik pada elemen menggunakan jQuery adalah:',
                'options' => [
                    '$("button").on("click", function() { ... });',
                    '$("button").bindClick(function() { ... });',
                    '$("button").listen("click", fn);',
                    '$("button").clickEvent(fn);'
                ],
                'ans' => 0,
                'exp' => 'Metode .on("event", handler) adalah standar modern di jQuery untuk event handling, mendukung event delegation dengan sangat fleksibel.'
            ],
            [
                'q' => 'Mengapa teknik Method Chaining (seperti `$("#box").fadeIn().css("color", "red").slideUp();`) dapat berjalan di jQuery?',
                'options' => [
                    'Karena browser modern mengizinkan chaining secara otomatis',
                    'Karena sebagian besar metode manipulasi jQuery selalu mengembalikan objek jQuery itu sendiri (this)',
                    'Karena jQuery ditulis dalam bahasa WebAssembly',
                    'Karena jQuery menggunakan thread asynchronous tersembunyi'
                ],
                'ans' => 1,
                'exp' => 'Metode jQuery mengembalikan referensi objek jQuery yang sedang diproses sehingga metode lain dapat langsung disambung.'
            ],
            [
                'q' => 'Metode manakah yang menampilkan elemen HTML yang tersembunyi dengan efek animasi transisi memudar (fade)?',
                'options' => ['.slideDown()', '.fadeIn()', '.showFast()', '.display()'],
                'ans' => 1,
                'exp' => '.fadeIn() menganimasikan opacity elemen dari 0 hingga terlihat penuh.'
            ],
            [
                'q' => 'Di dalam sebuah event handler jQuery, perintah apakah yang digunakan untuk mencegah aksi bawaan peramban (misalnya mencegah submit form otomatis atau reload halaman saat klik link)?',
                'options' => ['event.stopPropagation()', 'event.preventDefault()', 'event.stop()', 'return true'],
                'ans' => 1,
                'exp' => 'event.preventDefault() membatalkan tindakan default bawaan browser yang dipicu oleh event tersebut.'
            ]
        ]
    ],

    'python' => [
        'title' => 'Sertifikat Kompetensi Pemrograman Python 3 & Otomasi',
        'code' => 'PY',
        'course_id' => 'python',
        'type' => 'course',
        'price' => 19000,
        'original_price' => 49000,
        'duration_minutes' => 15,
        'passing_score' => 70,
        'competencies' => 'Python 3.12 Core Syntax, Data Structures (Lists, Dictionaries, Tuples, Sets), List Comprehensions, Functions & Lambdas, OOP & Dunder Methods, Exception Handling & File I/O',
        'questions' => [
            [
                'q' => 'Manakah struktur data bawaan Python yang bersifat ordered, mutable, dan mengizinkan adanya elemen duplikat?',
                'options' => ['Tuple', 'List', 'Set', 'Dictionary Keys'],
                'ans' => 1,
                'exp' => 'List (dibuat dengan kurung siku `[]`) bersifat terurut (ordered), dapat diubah isinya (mutable), dan mengizinkan duplikat.'
            ],
            [
                'q' => 'Apa output dari sintaks list comprehension `[x * 2 for x in range(4) if x % 2 == 0]` di Python?',
                'options' => ['[0, 4]', '[0, 2, 4, 6]', '[2, 4]', '[0, 2]'],
                'ans' => 0,
                'exp' => 'range(4) menghasilkan 0, 1, 2, 3. Nilai genap adalah 0 dan 2. Dikalikan 2 menghasilkan [0, 4].'
            ],
            [
                'q' => 'Dalam konsep Object-Oriented Programming Python, parameter pertama dari setiap method instansiasi di dalam class secara konvensi dinamakan apa?',
                'options' => ['this', 'self', 'cls', 'obj'],
                'ans' => 1,
                'exp' => 'self mewakili instance objek yang sedang diproses dan wajib disertakan sebagai argumen pertama method.'
            ],
            [
                'q' => 'Blok penanganan error apakah yang digunakan di Python untuk menangkap kesalahan saat runtime?',
                'options' => [
                    'try ... catch ... finally',
                    'try ... except ... finally',
                    'test ... onError ... done',
                    'guard ... rescue ... ensure'
                ],
                'ans' => 1,
                'exp' => 'Python menggunakan pasangan kata kunci try ... except untuk penanganan exception.'
            ],
            [
                'q' => 'Pernyataan `with open("data.txt", "r") as f:` sangat disarankan saat membaca file karena:',
                'options' => [
                    'Otomatis mengenkripsi isi file teks',
                    'Secara otomatis menutup file stream (context management) bahkan jika terjadi error di tengah pembacaan',
                    'Membaca file dengan kecepatan dua kali lipat',
                    'Mengubah file menjadi format JSON secara instan'
                ],
                'ans' => 1,
                'exp' => 'Context manager with memastikan resource file ditutup dengan aman dan otomatis setelah blok with selesai.'
            ],
            [
                'q' => 'Fungsi anonim satu baris (inline anonymous function) di Python dideklarasikan menggunakan kata kunci:',
                'options' => ['def', 'lambda', 'func', 'inline'],
                'ans' => 1,
                'exp' => 'lambda arguments: expression digunakan untuk membuat fungsi anonim kecil satu baris.'
            ],
            [
                'q' => 'Perbedaan fundamental antara Tuple dan List di Python adalah:',
                'options' => [
                    'Tuple bersifat immutable (tidak dapat diubah setelah dibuat), sedangkan List bersifat mutable',
                    'Tuple hanya dapat menyimpan angka',
                    'List tidak memiliki indeks urutan',
                    'Tuple dibuat dengan kurung kurawal `{}`'
                ],
                'ans' => 0,
                'exp' => 'Tuple ditulis dengan tanda kurung biasa `()` dan bersifat immutable (isi nilainya tidak dapat ditambah/diubah/dihapus).'
            ],
            [
                'q' => 'Metode dictionary manakah yang mengembalikan nilai dari kunci tertentu dan tidak memicu error KeyError jika kunci tersebut tidak ada?',
                'options' => ['dict.get(key, default)', 'dict[key]', 'dict.fetch(key)', 'dict.find(key)'],
                'ans' => 0,
                'exp' => 'metode .get() mengembalikan nilai default (atau None) jika kunci tidak ditemukan tanpa memicu KeyError crash.'
            ],
            [
                'q' => 'Panduan gaya penulisan kode resmi (style guide) standar yang diakui secara global untuk bahasa Python adalah:',
                'options' => ['ISO-9001', 'PEP 8', 'RFC-2616', 'Python Standard Guidelines 2026'],
                'ans' => 1,
                'exp' => 'PEP 8 (Python Enhancement Proposal 8) adalah panduan gaya penulisan kode Python yang menjadi acuan standar industri.'
            ],
            [
                'q' => 'Fungsi bawaan manakah yang mengembalikan panjang jumlah item dalam sebuah koleksi (string, list, tuple, dict)?',
                'options' => ['count()', 'size()', 'len()', 'length()'],
                'ans' => 2,
                'exp' => 'len() adalah built-in function Python untuk menghitung jumlah elemen dalam objek kontainer.'
            ]
        ]
    ],

    'uiux' => [
        'title' => 'Sertifikat Kompetensi Desain UI/UX & Prototyping Figma',
        'code' => 'UIUX',
        'course_id' => 'uiux',
        'type' => 'course',
        'price' => 19000,
        'original_price' => 49000,
        'duration_minutes' => 15,
        'passing_score' => 70,
        'competencies' => 'Design Thinking Process, Figma Auto-Layout & Constraints, Design Systems & Component Variants, Information Architecture, Heuristic Usability Evaluation, Interactive Prototyping',
        'questions' => [
            [
                'q' => 'Lima tahapan utama dalam metodologi Design Thinking yang berpusat pada pengguna (User-Centered) secara berurutan adalah:',
                'options' => [
                    'Empathize -> Define -> Ideate -> Prototype -> Test',
                    'Ideate -> Design -> Code -> Test -> Deploy',
                    'Research -> Wireframe -> Visual -> Launch -> Maintain',
                    'Define -> Sketch -> Prototype -> Feedback -> Finalize'
                ],
                'ans' => 0,
                'exp' => 'Model Design Thinking standar d.school Stanford: Empathize (Memahami) -> Define (Merumuskan) -> Ideate (Menggagas ide) -> Prototype (Membuat purwarupa) -> Test (Uji coba pengguna).'
            ],
            [
                'q' => 'Fitur apakah di Figma yang memungkinkan tata letak tombol atau card bertambah atau menyusut secara otomatis menyesuaikan ukuran konten teks di dalamnya?',
                'options' => ['Smart Animate', 'Auto Layout', 'Component Sets', 'Vector Networks'],
                'ans' => 1,
                'exp' => 'Auto Layout di Figma (serupa dengan CSS Flexbox) memungkinkan frame secara dinamis menyesuaikan ukuran kontennya lengkap dengan padding dan spacing.'
            ],
            [
                'q' => 'Representasi fiktif terperinci mengenai calon pengguna ideal yang dibuat berdasarkan riset kualitatif dan kuantitatif disebut:',
                'options' => ['User Persona', 'Wireframe', 'Customer Journey Map', 'Moodboard'],
                'ans' => 0,
                'exp' => 'User Persona adalah profil representatif pengguna yang mencakup demografi, motivasi, pain points, dan tujuan penggunaan produk.'
            ],
            [
                'q' => 'Perbedaan utama antara Wireframe (Low-Fidelity) dan Mockup (High-Fidelity) adalah:',
                'options' => [
                    'Wireframe fokus pada hierarki informasi dan struktur tata letak tanpa warna atau aset visual detail, sedangkan Mockup menyajikan visualisasi realistis dengan palet warna, tipografi, dan aset grafis final',
                    'Wireframe dibuat setelah aplikasi selesai di-coding',
                    'Mockup hanya berupa sketsa pensil di kertas',
                    'Tidak ada perbedaan antara keduanya dalam desain produk'
                ],
                'ans' => 0,
                'exp' => 'Wireframe mengutamakan fungsi dan struktur dasar arsitektur informasi, sedangkan Mockup fokus pada estetika visual mendalam.'
            ],
            [
                'q' => 'Tujuan pembuatan Design System (Komponen, Typography, Color Palette, Token) dalam tim produk digital adalah:',
                'options' => [
                    'Mengurangi ukuran file figma menjadi nol kilobyte',
                    'Menjaga konsistensi visual di seluruh modul produk serta mempercepat kolaborasi antara desainer UI dan tim engineer/developer',
                    'Menggantikan peran pengujian usability testing',
                    'Menghindari penggunaan software selain Figma'
                ],
                'ans' => 1,
                'exp' => 'Design System menciptakan satu sumber kebenaran (single source of truth) yang menjamin konsistensi visual dan efisiensi kerja tim.'
            ],
            [
                'q' => 'Prinsip Heuristik Nielsen manakah yang menyatakan bahwa sistem harus selalu memberi tahu pengguna mengenai apa yang sedang terjadi melalui umpan balik tepat waktu (misal progress bar saat loading)?',
                'options' => [
                    'Visibility of System Status',
                    'Match Between System and Real World',
                    'User Control and Freedom',
                    'Error Prevention'
                ],
                'ans' => 0,
                'exp' => 'Visibility of System Status memastikan pengguna selalu mendapat feedback instan mengenai status operasi sistem (seperti status loading atau berhasil disimpan).'
            ],
            [
                'q' => 'Dalam fitur Component Figma, apa fungsi dari `Variants`?',
                'options' => [
                    'Menghapus layer yang tidak terpakai',
                    'Mengelompokkan berbagai variasi status dari komponen yang sama (misal Button: Default, Hover, Active, Disabled) ke dalam satu wadah terpadu',
                    'Mengekspor aset langsung ke format APK',
                    'Membuat salinan file proyek baru'
                ],
                'ans' => 1,
                'exp' => 'Variants menyatukan berbagai variasi state, ukuran, dan tema dari satu komponen ke dalam satu kesatuan teratur.'
            ],
            [
                'q' => 'Standar rasio kontras warna teks terhadap latar belakang minimal menurut pedoman aksesibilitas WCAG 2.1 level AA untuk teks normal adalah:',
                'options' => ['2:1', '3:1', '4.5:1', '7:1'],
                'ans' => 2,
                'exp' => 'WCAG level AA menetapkan rasio kontras minimal 4.5:1 untuk teks biasa dan 3:1 untuk teks berukuran besar agar nyaman dibaca semua kalangan.'
            ],
            [
                'q' => 'Metode pengujian interaksi antarmuka kepada pengguna nyata untuk mengukur kemudahan, kecepatan, dan hambatan pengguna dalam menyelesaikan tugas tertentu disebut:',
                'options' => ['A/B Testing', 'Usability Testing', 'Card Sorting', 'Heuristic Evaluation'],
                'ans' => 1,
                'exp' => 'Usability Testing melibatkan observasi langsung terhadap user saat berinteraksi dengan purwarupa untuk menemukan friksi desain.'
            ],
            [
                'q' => 'Transisi animasi di Figma Prototype yang secara cerdas mendeteksi layer dengan nama yang sama untuk menghasilkan pergerakan transisi halus antar-frame disebut:',
                'options' => ['Dissolve', 'Smart Animate', 'Move In', 'Push'],
                'ans' => 1,
                'exp' => 'Smart Animate mencocokkan layer identik antar-frame dan menginterpolasi perubahan posisi, rotasi, ukuran, dan opacity secara mulus.'
            ]
        ]
    ],

    // =========================================================================
    // 2. JALUR SPESIALISASI KARIR UTAMA (CAREER TRACKS - 25 SOAL KOMPREHENSIF)
    // =========================================================================

    'frontend' => [
        'title' => 'Jalur Frontend Web Developer Modern',
        'code' => 'FE',
        'type' => 'career',
        'price' => 29000,
        'original_price' => 79000,
        'duration_minutes' => 30,
        'passing_score' => 80,
        'competencies' => 'HTML5 Semantics, CSS3 Flexbox & Grid, JavaScript ES6+, DOM Manipulation, Bootstrap 5, Vue.js 3 SPA Component Architecture',
        'questions' => [
            [
                'q' => 'Elemen HTML5 semantik manakah yang paling tepat digunakan untuk membungkus konten mandiri seperti artikel blog atau berita yang dapat didistribusikan secara independen?',
                'options' => ['<section>', '<article>', '<main>', '<aside>'],
                'ans' => 1,
                'exp' => '<article> dirancang khusus untuk konten mandiri yang dapat didistribusikan atau digunakan kembali secara independen.'
            ],
            [
                'q' => 'Properti CSS manakah yang digunakan dalam CSS Flexbox untuk mengatur perataan elemen anak (flex items) di sepanjang sumbu utama (main axis)?',
                'options' => ['align-items', 'justify-content', 'align-content', 'flex-direction'],
                'ans' => 1,
                'exp' => 'justify-content mengatur perataan di sepanjang main axis, sedangkan align-items mengatur di sepanjang cross axis.'
            ],
            [
                'q' => 'Manakah perbedaan utama antara deklarasi variabel menggunakan `const` dan `let` dalam JavaScript ES6?',
                'options' => [
                    'const memiliki function scope, sedangkan let memiliki block scope',
                    'const tidak dapat dideklarasikan ulang atau di-reassign nilai referensinya, sedangkan let nilainya dapat diubah',
                    'let tidak mengalami hoisting sedangkan const mengalami hoisting penuh',
                    'const hanya dapat menyimpan tipe data primitif seperti angka dan string'
                ],
                'ans' => 1,
                'exp' => 'Variabel dengan const memiliki block scope dan referensi nilainya tidak dapat di-reassign setelah inisialisasi awal.'
            ],
            [
                'q' => 'Dalam JavaScript modern, metode Array manakah yang mengembalikan array baru berisi elemen-elemen yang memenuhi kondisi pengujian tertentu tanpa mengubah array asli?',
                'options' => ['forEach()', 'filter()', 'map()', 'reduce()'],
                'ans' => 1,
                'exp' => 'Metode filter() membuat shallow copy array baru yang hanya berisi elemen yang mengembalikan nilai true pada fungsi callback.'
            ],
            [
                'q' => 'Bagaimanakah urutan prioritas (spesifisitas) CSS dari yang terendah hingga tertinggi?',
                'options' => [
                    'Inline style < ID selector < Class selector < Element selector',
                    'Element selector < Class/Attribute selector < ID selector < Inline style',
                    'Class selector < Element selector < ID selector < Inline style',
                    'ID selector < Class selector < Element selector < Universal selector'
                ],
                'ans' => 1,
                'exp' => 'Spesifisitas berurutan dari terendah ke tertinggi: Universal (*) -> Elemen/Tag -> Class/Pseudo-class -> ID -> Inline style.'
            ],
            [
                'q' => 'Di Vue.js 3 (Composition API), fungsi manakah yang digunakan untuk membuat state reaktif dari tipe data primitif seperti string atau number?',
                'options' => ['reactive()', 'ref()', 'computed()', 'watch()'],
                'ans' => 1,
                'exp' => 'ref() mengambil argumen nilai primitif dan mengembalikan objek reaktif yang dapat diakses melalui properti .value di script.'
            ],
            [
                'q' => 'Direktif Vue.js manakah yang melakukan two-way data binding dua arah pada elemen formulir seperti <input> atau <select>?',
                'options' => ['v-bind', 'v-model', 'v-on', 'v-slot'],
                'ans' => 1,
                'exp' => 'v-model digunakan untuk two-way data binding (mengikat nilai input form ke reaktif state secara timbal balik).'
            ],
            [
                'q' => 'Dalam JavaScript Asinkron, keyword `await` hanya dapat digunakan di dalam fungsi yang diawali dengan keyword apa?',
                'options' => ['defer', 'async', 'promise', 'sync'],
                'ans' => 1,
                'exp' => 'Keyword await hanya valid jika digunakan di dalam fungsi yang dideklarasikan dengan kata kunci async.'
            ],
            [
                'q' => 'Dalam CSS Grid, nilai unit `1fr` merepresentasikan apa?',
                'options' => [
                    'Satu fixed row dalam kontainer grid',
                    'Satu bagian proporsional (fraction) dari ruang kosong yang tersedia dalam kontainer grid',
                    'Satu pixel relatif terhadap lebar viewport browser',
                    'Ukuran font root saat ini'
                ],
                'ans' => 1,
                'exp' => 'Unit fr (fraction) mewakili satu bagian pecahan dari ruang kosong yang tersisa di dalam kontainer grid.'
            ],
            [
                'q' => 'Metode JavaScript DOM manakah yang paling efisien dan modern untuk memilih satu elemen pertama yang cocok dengan selektor CSS tertentu?',
                'options' => ['document.getElementById()', 'document.querySelector()', 'document.getElementsByClassName()', 'document.querySelectorAll()'],
                'ans' => 1,
                'exp' => 'document.querySelector() menerima selektor CSS apapun dan mengembalikan elemen pertama yang cocok di dokumen.'
            ],
            [
                'q' => 'Apa kegunaan utama atribut `alt` pada tag elemen HTML <img>?',
                'options' => [
                    'Memberikan tooltip teks melayang saat mouse berada di atas gambar',
                    'Menyediakan teks alternatif untuk pembaca layar (screen reader) dan fallback jika gambar gagal dimuat',
                    'Mengatur rasio aspek gambar secara otomatis',
                    'Mengubah format gambar menjadi WebP'
                ],
                'ans' => 1,
                'exp' => 'Atribut alt sangat vital untuk aksesibilitas (screen reader bagi tunanetra) dan SEO serta fallback ketika file gambar rusak/gagal diunduh.'
            ],
            [
                'q' => 'Dalam CSS, apa perbedaan perilaku `display: none` dan `visibility: hidden`?',
                'options' => [
                    'display: none menyembunyikan elemen tetapi tetap menyisakan ruang fisiknya di layout, sedangkan visibility: hidden menghapus ruangnya',
                    'display: none menghapus elemen sepenuhnya dari alur layout tanpa menyisakan ruang, sedangkan visibility: hidden menyembunyikan visual tetapi ruang fisiknya tetap dipertahankan',
                    'Keduanya menghasilkan perilaku yang persis sama',
                    'visibility: hidden hanya bekerja pada elemen link <a>'
                ],
                'ans' => 1,
                'exp' => 'display: none me-remove elemen dari alur layout rendering, sedangkan visibility: hidden tetap memakan ruang dimensi yang ada.'
            ],
            [
                'q' => 'Apa output dari ekspresi JavaScript `typeof NaN`?',
                'options' => ['"undefined"', '"number"', '"NaN"', '"null"'],
                'ans' => 1,
                'exp' => 'Dalam spesifikasi ECMAScript standar, tipe data dari NaN (Not-a-Number) adalah "number".'
            ],
            [
                'q' => 'Dalam Bootstrap 5, class grid manakah yang digunakan untuk membuat kolom yang menghabiskan 6 dari 12 kolom pada layar medium ke atas (>=768px)?',
                'options' => ['col-sm-6', 'col-md-6', 'col-lg-6', 'col-6-md'],
                'ans' => 1,
                'exp' => 'col-md-6 membagi grid menjadi 6 kolom pada breakpoint medium (>= 768px).'
            ],
            [
                'q' => 'Fitur modern JavaScript ES6 manakah yang digunakan untuk mengekstrak properti objek ke dalam variabel tersendiri secara ringkas?',
                'options' => ['Object Clustering', 'Destructuring Assignment', 'Spread Operator', 'Rest Parameters'],
                'ans' => 1,
                'exp' => 'Destructuring assignment (misal const { name, age } = user) mengekstrak nilai properti dari objek langsung ke variabel lokal.'
            ],
            [
                'q' => 'Bagaimanakah cara mencegah perilaku bawaan (default behavior) dari sebuah event, misalnya mencegah form melakukan reload halaman saat tombol submit diklik?',
                'options' => ['event.stopPropagation()', 'event.preventDefault()', 'event.cancelBubble()', 'return false;'],
                'ans' => 1,
                'exp' => 'event.preventDefault() membatalkan aksi default peramban untuk event yang sedang berlangsung.'
            ],
            [
                'q' => 'Di Vue.js 3, lifecycle hook manakah yang dieksekusi tepat setelah komponen selesai dirender dan dipasang ke DOM?',
                'options' => ['onCreated', 'onMounted', 'onBeforeMount', 'onUpdated'],
                'ans' => 1,
                'exp' => 'onMounted dieksekusi saat komponen sudah terpasang secara fisik di DOM peramban.'
            ],
            [
                'q' => 'Properti CSS `position: sticky;` berperilaku seperti apa?',
                'options' => [
                    'Selalu menempel di layar seperti position: fixed sejak awal',
                    'Diperlakukan seperti position: relative hingga mencapai ambang batas offset tertentu saat di-scroll, lalu menjadi seperti fixed di dalam elemen induknya',
                    'Hanya menempel jika browser diperkecil',
                    'Sama persis dengan position: absolute'
                ],
                'ans' => 1,
                'exp' => 'position: sticky beralih antara relative dan fixed tergantung posisi scroll pengguna terhadap scroll parent-nya.'
            ],
            [
                'q' => 'Dalam JavaScript, apa perbedaan antara `==` (loose equality) dan `===` (strict equality)?',
                'options' => [
                    '== memeriksa tipe dan nilai tanpa konversi, sedangkan === melakukan konversi tipe',
                    '=== memeriksa kesamaan nilai dan kesamaan tipe data tanpa type coercion, sedangkan == melakukan konversi tipe implisit sebelum membandingkan',
                    '=== hanya dapat digunakan untuk objek',
                    '== lebih cepat dibanding ==='
                ],
                'ans' => 1,
                'exp' => '=== membandingkan nilai dan tipe secara ketat tanpa pemaksaan tipe (coercion).'
            ],
            [
                'q' => 'Elemen HTML5 manakah yang tepat untuk menampilkan konten teks yang diformat sebelumnya dengan spasi dan line break tetap utuh?',
                'options' => ['<code>', '<pre>', '<samp>', '<blockquote>'],
                'ans' => 1,
                'exp' => 'Tag <pre> menampilkan teks dengan font monospace dan mempertahankan spasi ganda serta perpindahan baris.'
            ],
            [
                'q' => 'Dalam CSS Flexbox, bagaimana cara termudah untuk membuat suatu item fleksibel menempati sisa ruang yang tersedia di kontainer?',
                'options' => ['flex-grow: 1;', 'flex-shrink: 0;', 'align-self: stretch;', 'width: 100%;'],
                'ans' => 0,
                'exp' => 'flex-grow: 1 memberikan kemampuan pada flex item untuk tumbuh mengisi seluruh ruang kosong yang tersisa.'
            ],
            [
                'q' => 'Bagaimanakah cara mengimpor modul JavaScript yang diekspor sebagai default export?',
                'options' => [
                    'import { Component } from "./Component.js";',
                    'import Component from "./Component.js";',
                    'require("./Component.js").default;',
                    'include Component from "./Component.js";'
                ],
                'ans' => 1,
                'exp' => 'Default export diimpor tanpa tanda kurung kurawal kurawal (curly braces).'
            ],
            [
                'q' => 'Di peramban modern, di manakah kita dapat menyimpan data teks secara persisten di sisi klien tanpa batasan masa kedaluwarsa sesi?',
                'options' => ['sessionStorage', 'localStorage', 'cookies tanpa max-age', 'cacheStorage memory only'],
                'ans' => 1,
                'exp' => 'localStorage menyimpan data key-value di browser tanpa batas kadaluwarsa (tetap tersimpan meski browser ditutup).'
            ],
            [
                'q' => 'Dalam Bootstrap 5, class utilitas manakah yang digunakan untuk membuat sudut elemen menjadi bulat melingkar sempurna (lingkaran/pill)?',
                'options' => ['rounded-circle', 'rounded-full', 'border-radius-100', 'circle-box'],
                'ans' => 0,
                'exp' => 'Bootstrap 5 menyediakan rounded-circle untuk lingkaran sempurna dan rounded-pill untuk bentuk kapsul.'
            ],
            [
                'q' => 'Apa keuntungan utama penggunaan CSS Custom Properties (CSS Variables) dibanding nilai statis?',
                'options' => [
                    'Meningkatkan kecepatan render browser sebesar 10x lipat',
                    'Dapat diwarisi dalam cascading tree dan nilainya dapat dimanipulasi secara dinamis saat runtime melalui JavaScript',
                    'Menghilangkan kebutuhan file CSS eksternal',
                    'Mengubah CSS menjadi bahasa kompilasi'
                ],
                'ans' => 1,
                'exp' => 'CSS variables (misal --primary-color) mendukung inheritance CSS cascading dan dapat diubah secara dinamis saat runtime dengan JS.'
            ]
        ]
    ],

    'backend' => [
        'title' => 'Jalur Backend & Database API Developer',
        'code' => 'BE',
        'type' => 'career',
        'price' => 29000,
        'original_price' => 79000,
        'duration_minutes' => 30,
        'passing_score' => 80,
        'competencies' => 'PHP 8 OOP & PDO, MySQL Relational Database, RESTful API Architecture, JWT Authentication, Security (SQLi & XSS Prevention), MVC Framework Patterns',
        'questions' => [
            [
                'q' => 'Klausul SQL manakah yang digunakan untuk menyaring data agregasi setelah pengelompokan menggunakan `GROUP BY`?',
                'options' => ['WHERE', 'HAVING', 'FILTER', 'ORDER BY'],
                'ans' => 1,
                'exp' => 'HAVING digunakan untuk memfilter baris agregat setelah GROUP BY, sedangkan WHERE menyaring baris sebelum agregasi dilakukan.'
            ],
            [
                'q' => 'Dalam arsitektur RESTful API, HTTP method manakah yang bersifat idempoten dan digunakan untuk memperbarui seluruh representasi sumber daya (resource)?',
                'options' => ['POST', 'PUT', 'PATCH', 'CONNECT'],
                'ans' => 1,
                'exp' => 'PUT bersifat idempoten dan digunakan untuk menggantikan atau memperbarui seluruh representasi resource target.'
            ],
            [
                'q' => 'Metode manakah di PHP PDO / MySQLi yang paling tepat digunakan untuk mengamankan query dari kerentanan SQL Injection?',
                'options' => [
                    'Menggunakan fungsi addslashes()',
                    'Menggunakan Prepared Statements dengan parameter binding',
                    'Melakukan escape string manual dengan htmlspecialchars()',
                    'Mengenkripsi query menggunakan md5()'
                ],
                'ans' => 1,
                'exp' => 'Prepared statements memisahkan query SQL dari data masukan sehingga karakter berbahaya tidak dieksekusi sebagai perintah SQL.'
            ],
            [
                'q' => 'Apa perbedaan utama antara status kode HTTP `401 Unauthorized` dan `403 Forbidden`?',
                'options' => [
                    '401 berarti server sedang sibuk, 403 berarti URL tidak ada',
                    '401 menandakan permintaan membutuhkan autentikasi identitas yang valid, sedangkan 403 berarti klien telah diautentikasi tetapi tidak memiliki hak akses/izin (permission) ke sumber daya tersebut',
                    '403 hanya untuk request mobile, 401 untuk desktop',
                    'Keduanya dapat digunakan bergantian tanpa perbedaan'
                ],
                'ans' => 1,
                'exp' => '401 Unauthorized berarti "siapa Anda tidak diketahui / belum login", 403 Forbidden berarti "identitas Anda diketahui, tetapi Anda dilarang mengakses".'
            ],
            [
                'q' => 'Struktur token JWT (JSON Web Token) terdiri dari tiga bagian yang dipisahkan oleh tanda titik (.), yaitu:',
                'options' => [
                    'Header.Payload.Signature',
                    'Metadata.Body.Hash',
                    'Header.Data.Encryption',
                    'Claim.Identity.Key'
                ],
                'ans' => 0,
                'exp' => 'JWT tersusun dari tiga segmen base64url: Header (algoritma), Payload (klaim/data), dan Signature (verifikasi tanda tangan kriptografi).'
            ],
            [
                'q' => 'Dalam normalisasi database relasional, apa syarat utama sebuah tabel memenuhi Bentuk Normal Kedua (2NF)?',
                'options' => [
                    'Harus sudah memenuhi 1NF dan tidak memiliki ketergantungan parsial (seluruh atribut non-kunci bergantung penuh pada Primary Key)',
                    'Harus memiliki minimal 5 kolom bertipe foreign key',
                    'Harus sudah memenuhi 3NF terlebih dahulu',
                    'Semua kolom bertipe varchar harus memiliki panjang sama'
                ],
                'ans' => 0,
                'exp' => '2NF mensyaratkan 1NF terpenuhi dan menghapus ketergantungan parsial di mana setiap kolom non-key harus bergantung fungsional penuh pada primary key komposit.'
            ],
            [
                'q' => 'Dalam PHP 8, fungsi hashing bawaan manakah yang paling aman dan direkomendasikan untuk menyimpan kata sandi pengguna ke database?',
                'options' => ['md5()', 'sha1()', 'password_hash()', 'crypt()'],
                'ans' => 2,
                'exp' => 'password_hash() menggunakan algoritma bcrypt atau argon2 yang kuat dan secara otomatis mengelola salt kriptografi yang aman.'
            ],
            [
                'q' => 'Perintah SQL manakah yang menghapus seluruh data di dalam tabel secara cepat dan mereset nilai auto-increment, tanpa mencatat logging per-baris?',
                'options' => ['DELETE FROM table_name;', 'TRUNCATE TABLE table_name;', 'DROP TABLE table_name;', 'REMOVE TABLE table_name;'],
                'ans' => 1,
                'exp' => 'TRUNCATE TABLE mengosongkan isi tabel secara instan (DDL) dan me-reset nilai urutan auto-increment.'
            ],
            [
                'q' => 'Apa fungsi dari middleware dalam kerangka kerja backend web modern?',
                'options' => [
                    'Merender file CSS di sisi server',
                    'Menjembatani dan memproses permintaan HTTP masuk (inbound) sebelum mencapai handler controller utama (misalnya untuk verifikasi auth, logging, atau CORS)',
                    'Menggantikan fungsi web server seperti Nginx',
                    'Mempercepat kompilasi bahasa C++'
                ],
                'ans' => 1,
                'exp' => 'Middleware bertindak sebagai filter perantara yang mencegat HTTP request untuk validasi token, rate limiting, logging, atau modifikasi response.'
            ],
            [
                'q' => 'Dalam database relasional MySQL, tipe relasi antar tabel manakah yang memerlukan sebuah "Junction Table" (Pivot Table)?',
                'options' => ['One-to-One (1:1)', 'One-to-Many (1:N)', 'Many-to-Many (N:M)', 'Self-Referencing'],
                'ans' => 2,
                'exp' => 'Relasi Many-to-Many diselesaikan dengan memecahnya menjadi tabel perantara (pivot table) yang menyimpan foreign key dari kedua tabel.'
            ],
            [
                'q' => 'Prinsip ACID dalam transaksi database adalah singkatan dari:',
                'options' => [
                    'Atomicity, Consistency, Isolation, Durability',
                    'Accuracy, Concurrency, Integrity, Dependability',
                    'Authentication, Cryptography, Identity, Data',
                    'Authorization, Compression, Indexing, Delivery'
                ],
                'ans' => 0,
                'exp' => 'ACID menjamin keandalan transaksi database: Atomicity (semua atau tidak sama sekali), Consistency, Isolation, dan Durability (permanen).'
            ],
            [
                'q' => 'Header HTTP manakah yang dikirim oleh server untuk mengizinkan aplikasi frontend dari domain lain melakukan request API (CORS)?',
                'options' => [
                    'Access-Control-Allow-Origin',
                    'Allow-Cross-Domain-Access',
                    'X-Frame-Options: SAMEORIGIN',
                    'Content-Security-Origin'
                ],
                'ans' => 0,
                'exp' => 'Header Access-Control-Allow-Origin memberitahu browser domain mana saja yang diizinkan mengakses sumber daya API tersebut.'
            ],
            [
                'q' => 'Perbedaan utama antara `JOIN` tipe `INNER JOIN` dan `LEFT JOIN` pada SQL adalah:',
                'options' => [
                    'INNER JOIN hanya menghasilkan baris yang memiliki pasangan cocok di kedua tabel, sedangkan LEFT JOIN menghasilkan seluruh baris dari tabel kiri terlepas apakah ada pasangannya di tabel kanan',
                    'LEFT JOIN menghapus baris duplikat otomatis',
                    'INNER JOIN hanya bisa memadankan kolom integer',
                    'LEFT JOIN menghasilkan data lebih sedikit dibanding INNER JOIN'
                ],
                'ans' => 0,
                'exp' => 'LEFT JOIN mempertahankan semua data tabel kiri, dan memberi nilai NULL pada kolom tabel kanan jika tidak ditemukan kecocokan relasi.'
            ],
            [
                'q' => 'Apa keuntungan utama menggunakan pola desain MVC (Model-View-Controller) dalam rekayasa perangkat lunak backend?',
                'options' => [
                    'Membuat kode tidak dapat didekompilasi',
                    'Memisahkan pemisahan tanggung jawab (Separation of Concerns) antara logika bisnis data (Model), antarmuka presentasi (View), dan kontrol alur routing (Controller)',
                    'Menghilangkan kebutuhan konfigurasi basis data',
                    'Menjadikan aplikasi otomatis berjalan di arsitektur microservices'
                ],
                'ans' => 1,
                'exp' => 'MVC memisahkan logika aplikasi secara rapi sehingga pemeliharaan, pengujian, dan pengembangan fitur baru menjadi modular.'
            ],
            [
                'q' => 'Bagaimanakah cara kerja mekanisme connection pooling pada koneksi database backend?',
                'options' => [
                    'Menyimpan query dalam format zip di memori',
                    'Memelihara sejumlah koneksi database yang sudah terbuka sebelumnya untuk digunakan kembali oleh berbagai request tanpa overhead membuka/menutup koneksi TCP berulang kali',
                    'Membuat replikasi database baru setiap menit',
                    'Menghubungkan database ke cloud storage secara otomatis'
                ],
                'ans' => 1,
                'exp' => 'Connection pooling mendaur ulang koneksi database aktif sehingga menghemat latensi dan beban server akibat handshake koneksi baru yang berulang.'
            ],
            [
                'q' => 'Dalam keamanan web, serangan manakah yang mengeksploitasi kepercayaan situs web terhadap peramban pengguna yang telah login untuk mengeksekusi aksi yang tidak sah?',
                'options' => ['Cross-Site Scripting (XSS)', 'Cross-Site Request Forgery (CSRF)', 'SQL Injection', 'Man-in-the-Middle (MITM)'],
                'ans' => 1,
                'exp' => 'CSRF memaksa peramban pengguna mengirimkan perintah HTTP yang tidak diinginkan ke aplikasi web yang dipercaya saat sesi login sedang aktif.'
            ],
            [
                'q' => 'Jenis indeks database manakah yang paling umum digunakan pada kolom bertipe data berurutan (B-Tree Index)?',
                'options' => ['Hash Index', 'B-Tree Index', 'Spatial Index', 'Fulltext Index'],
                'ans' => 1,
                'exp' => 'B-Tree Index adalah struktur indeks default di MySQL InnoDB yang sangat efisien untuk pencarian exact match maupun range search (<, >, BETWEEN).'
            ],
            [
                'q' => 'Dalam PHP, apa fungsi dari magic method `__construct()`?',
                'options' => [
                    'Method yang dipanggil secara otomatis saat sebuah instance objek baru dari class tersebut dibuat',
                    'Method untuk menghapus objek dari memori',
                    'Method untuk mengubah objek menjadi string JSON',
                    'Method untuk menggandakan class'
                ],
                'ans' => 0,
                'exp' => '__construct() adalah constructor method yang dieksekusi saat pembuatan objek baru (new ClassName()).'
            ],
            [
                'q' => 'Apa kegunaan dari HTTP status code `204 No Content`?',
                'options' => [
                    'Server gagal menemukan konten yang dicari',
                    'Permintaan berhasil diproses oleh server, tetapi sengaja tidak mengembalikan konten apapun dalam response body (misalnya setelah operasi DELETE sukses)',
                    'Koneksi internet klien terputus',
                    'Data di database telah terhapus otomatis oleh server'
                ],
                'ans' => 1,
                'exp' => '204 No Content menunjukkan request berhasil tetapi response body sengaja dikosongkan.'
            ],
            [
                'q' => 'Perintah CLI git manakah yang memadukan perubahan dari cabang lain ke dalam cabang yang sedang aktif?',
                'options' => ['git push', 'git merge', 'git branch -c', 'git fetch --all'],
                'ans' => 1,
                'exp' => 'git merge menggabungkan commit histories dari branch target ke branch yang saat ini aktif.'
            ],
            [
                'q' => 'Karakteristik database bertipe NoSQL Dokumen (seperti MongoDB) dibanding Relational SQL adalah:',
                'options' => [
                    'Menyimpan data dalam struktur dokumen berformat fleksibel (BSON/JSON) tanpa memerlukan skema tabel statis yang kaku',
                    'Tidak mendukung pembacaan data secara paralel',
                    'Hanya dapat dijalankan pada sistem operasi Linux',
                    'Wajib menggunakan query bahasa SQL standar'
                ],
                'ans' => 0,
                'exp' => 'NoSQL Document Store menyimpan record sebagai dokumen JSON/BSON fleksibel tanpa skema tabel yang baku.'
            ],
            [
                'q' => 'Bagaimanakah penanganan concurrency race condition yang efektif pada pengurangan stok barang di database backend?',
                'options' => [
                    'Menggunakan locking transaksi (misal: SELECT ... FOR UPDATE) atau atomic update query (UPDATE produk SET stok = stok - 1 WHERE id = 1 AND stok >= 1)',
                    'Menjalankan query di sisi frontend browser',
                    'Menghapus indeks pada tabel produk',
                    'Menonaktifkan transaksi database'
                ],
                'ans' => 0,
                'exp' => 'Atomic update query atau pessimistic locking (FOR UPDATE) mencegah race conditions saat banyak request masuk bersamaan.'
            ],
            [
                'q' => 'Dalam arsitektur microservices, pola komunikasi asinkron antar layanan sering memanfaatkan Message Broker seperti:',
                'options' => ['RabbitMQ / Apache Kafka', 'Apache Tomcat', 'SQLite', 'Postman'],
                'ans' => 0,
                'exp' => 'RabbitMQ dan Kafka adalah message broker terkemuka untuk asynchronous decoupled messaging antar microservices.'
            ],
            [
                'q' => 'Format kompresi response HTTP manakah yang paling banyak digunakan server untuk mempercepat transmisi data ke klien?',
                'options' => ['Gzip / Brotli', 'TAR.GZ', '7z', 'RAR'],
                'ans' => 0,
                'exp' => 'Kompresi Gzip dan Brotli secara signifikan mengecilkan ukuran transfer HTTP payload sebelum dikirimkan ke client.'
            ],
            [
                'q' => 'Apa tujuan penggunaan variabel lingkungan (Environment Variables, misalnya file `.env`) dalam proyek backend?',
                'options' => [
                    'Menyimpan konfigurasi sensitif (kredensial database, API keys, JWT secret) di luar basis kode agar tidak terekspos ke repositori git publik',
                    'Menambah kecepatan kompilasi PHP',
                    'Membuat server kebal terhadap serangan virus',
                    'Menyediakan tampilan antarmuka administrasi otomatis'
                ],
                'ans' => 0,
                'exp' => 'File .env memisahkan credential sensitif dari source code, mendukung prinsip Twelve-Factor App.'
            ]
        ]
    ],

    'fullstack' => [
        'title' => 'Jalur Fullstack Web Developer',
        'code' => 'FS',
        'type' => 'career',
        'price' => 35000,
        'original_price' => 99000,
        'duration_minutes' => 30,
        'passing_score' => 80,
        'competencies' => 'Fullstack Architecture, SPA & API Integration, Database Performance & Indexing, Web Security (OWASP Top 10), CI/CD & Cloud Deployment, Server Side & Client Side State Management',
        'questions' => [
            [
                'q' => 'Dalam arsitektur Single Page Application (SPA) modern yang berkomunikasi dengan REST API, di manakah penyimpanan JWT access token yang paling aman dari ancaman XSS?',
                'options' => [
                    'Di localStorage browser',
                    'Di sessionStorage browser',
                    'Di cookie dengan flag HttpOnly, Secure, dan SameSite=Strict',
                    'Di atribut data-* elemen HTML'
                ],
                'ans' => 2,
                'exp' => 'Cookie HttpOnly tidak dapat diakses atau dicuri oleh skrip JavaScript di browser, sehingga aman dari pencurian token lewat serangan XSS.'
            ],
            [
                'q' => 'Perbedaan utama antara Server-Side Rendering (SSR) dan Client-Side Rendering (CSR) adalah:',
                'options' => [
                    'SSR hanya bisa dijalankan di server Windows, CSR di Linux',
                    'Pada SSR, server menghasilkan HTML lengkap beserta konten data sebelum dikirim ke peramban (baik untuk SEO dan initial load), sedangkan CSR mengirim shell HTML minimal lalu peramban mengunduh JS untuk merender konten',
                    'CSR selalu lebih aman dibanding SSR',
                    'SSR tidak mendukung interaktivitas pengguna'
                ],
                'ans' => 1,
                'exp' => 'SSR mengompilasi HTML siap tampil di server demi SEO dan kecepatan visual pertama, sedangkan CSR mengandalkan browser untuk merender DOM via JS.'
            ],
            [
                'q' => 'Kerentanan OWASP Top 10 manakah yang terjadi ketika aplikasi menerima data yang disediakan pengguna tanpa validasi memadai lalu mengeksekusinya sebagai bagian dari perintah sistem atau query database?',
                'options' => ['Injection (SQLi / Command Injection)', 'Cryptographic Failures', 'Security Misconfiguration', 'Software and Data Integrity Failures'],
                'ans' => 0,
                'exp' => 'Injection terjadi ketika input tidak terpercaya dikirimkan ke interpreter sebagai bagian dari perintah atau query.'
            ],
            [
                'q' => 'Fitur HTTP/2 manakah yang memungkinkan server mengirimkan sumber daya (seperti CSS dan JS) ke peramban sebelum peramban secara eksplisit memintanya?',
                'options' => ['Server Push', 'Multiplexing', 'Header Compression', 'Stream Prioritization'],
                'ans' => 0,
                'exp' => 'HTTP/2 Server Push mengizinkan server mengirimkan asset kritis ke cache browser sebelum diminta oleh dokumen HTML.'
            ],
            [
                'q' => 'Metode HTTP caching manakah yang menggunakan nilai hash representasi konten untuk memvalidasi apakah sumber daya di browser masih up-to-date?',
                'options' => ['ETag (Entity Tag)', 'Expires header', 'Cache-Control: public', 'Last-Modified saja'],
                'ans' => 0,
                'exp' => 'ETag adalah token identifier unik (biasanya checksum hash) yang digunakan untuk validasi cache kondisional (If-None-Match: 304 Not Modified).'
            ],
            [
                'q' => 'Dalam konteks CI/CD (Continuous Integration / Continuous Deployment), apa tujuan tahap "Integration"?',
                'options' => [
                    'Menagih pembayaran otomatis kepada klien',
                    'Menggabungkan perubahan kode dari berbagai developer ke repository pusat secara berkala yang diverifikasi oleh automated build dan unit/integration testing',
                    'Mengubah bahasa pemrograman secara otomatis',
                    'Menghapus cabang git yang tidak aktif'
                ],
                'ans' => 1,
                'exp' => 'CI memastikan penggabungan kode secara teratur yang diverifikasi oleh uji otomatis agar bug terdeteksi sedini mungkin.'
            ],
            [
                'q' => 'Strategi caching di memory tingkat tinggi (in-memory caching) untuk mengurangi beban query database berulang biasanya menggunakan:',
                'options' => ['Redis atau Memcached', 'SQLite file memory', 'IndexedDB browser', 'Apache Lucene'],
                'ans' => 0,
                'exp' => 'Redis adalah in-memory key-value data store berkecepatan sub-milidetik yang sangat populer untuk caching server-side.'
            ],
            [
                'q' => 'Teknologi komunikasi full-duplex dua arah secara realtime persisten antara browser dan server tanpa overhead polling berulang adalah:',
                'options' => ['WebSockets', 'HTTP Long Polling', 'Server-Sent Events (SSE)', 'AJAX GET interval'],
                'ans' => 0,
                'exp' => 'WebSockets menyediakan saluran komunikasi dua arah (bidirectional) terus menerus melalui satu koneksi TCP tunggal.'
            ],
            [
                'q' => 'Apa keuntungan penerapan prinsip Micro-Frontend dalam skala aplikasi web besar?',
                'options' => [
                    'Mengizinkan berbagai tim independen membangun, menguji, dan men-deploy modul UI frontend tersendiri menggunakan teknologi berbeda tanpa saling memblokir',
                    'Menghapus kode JavaScript dari aplikasi',
                    'Mempercepat instalasi Node.js',
                    'Membuat CSS dapat berjalan di server'
                ],
                'ans' => 0,
                'exp' => 'Micro-Frontend memecah monolit frontend menjadi aplikasi-aplikasi mikro yang dikelola tim independen secara otonom.'
            ],
            [
                'q' => 'Bagaimanakah penanganan serangan Cross-Site Scripting (XSS) tipe Reflected atau Stored pada output web?',
                'options' => [
                    'Melakukan context-aware output encoding (escaping) terhadap seluruh data tak terpercaya sebelum dirender ke HTML, serta menerapkan Content Security Policy (CSP)',
                    'Hanya menggunakan metode POST untuk semua link',
                    'Menonaktifkan cookie peramban',
                    'Menggunakan firewall hardware saja'
                ],
                'ans' => 0,
                'exp' => 'Output encoding dan CSP (Content Security Policy) mencegah injeksi dan eksekusi skrip berbahaya di konteks peramban korban.'
            ],
            [
                'q' => 'Dalam protokol SSL/TLS HTTPS, apa peran dari Certificate Authority (CA) pihak ketiga yang terpercaya (misal Let\'s Encrypt)?',
                'options' => [
                    'Memverifikasi kepemilikan domain dan menandatangani sertifikat digital publik untuk membuktikan keaslian identitas server ke browser',
                    'Menyimpan seluruh basis data pengguna secara terenkripsi',
                    'Mempercepat bandwidth jaringan internet pelanggan',
                    'Menghapus log akses web server'
                ],
                'ans' => 0,
                'exp' => 'CA bertindak sebagai entitas tepercaya yang memvalidasi identitas pemilik website dan menerbitkan sertifikat digital terotentikasi.'
            ],
            [
                'q' => 'Dalam arsitektur basis data, apa yang dimaksud dengan teknik "Database Sharding"?',
                'options' => [
                    'Pemisahan horizontal baris-baris data besar ke dalam beberapa mesin server database independen untuk mendistribusikan beban penyimpanan dan komputasi',
                    'Pembuatan backup data ke CD-ROM',
                    'Penggabungan dua database MySQL menjadi satu',
                    'Penghapusan indeks yang sudah usang'
                ],
                'ans' => 0,
                'exp' => 'Sharding adalah partisi horizontal data ke beberapa instance server terpisah untuk mendukung horizontal scaling skala raksasa.'
            ],
            [
                'q' => 'Karakteristik dari GraphQL dibanding REST API adalah:',
                'options' => [
                    'Klien dapat menentukan secara persis data spesifik apa saja yang dibutuhkannya dalam satu request query, mencegah over-fetching dan under-fetching',
                    'Hanya mendukung pertukaran data dalam format XML',
                    'Tidak menggunakan protokol HTTP',
                    'Tidak memerlukan validasi autentikasi'
                ],
                'ans' => 0,
                'exp' => 'GraphQL memberikan kemampuan query deklaratif di mana client meminta data spesifik yang diperlukan tanpa data berlebih (over-fetching).'
            ],
            [
                'q' => 'Alat orkestrasi kontainer open-source yang paling populer untuk mengotomatisasi deployment, scaling, dan manajemen aplikasi terkontainerisasi di cloud adalah:',
                'options' => ['Kubernetes (K8s)', 'Docker Swarm legacy', 'Vagrant', 'VirtualBox'],
                'ans' => 0,
                'exp' => 'Kubernetes adalah platform standar industri untuk orkestrasi dan skalabilitas kluster kontainer aplikasi modern.'
            ],
            [
                'q' => 'Dalam web performance optimization, apa arti metrik Core Web Vitals "LCP" (Largest Contentful Paint)?',
                'options' => [
                    'Waktu yang dibutuhkan untuk merender elemen konten visual terbesar (misal banner gambar atau blok teks utama) yang terlihat di viewport pengguna',
                    'Total jumlah file gambar yang diunduh',
                    'Ukuran file CSS dalam kilobyte',
                    'Kecepatan koneksi internet server'
                ],
                'ans' => 0,
                'exp' => 'LCP mengukur waktu render elemen visual utama terbesar di layar; skor baik adalah di bawah 2.5 detik.'
            ],
            [
                'q' => 'Apa keuntungan utama penggunaan Docker container dibanding Virtual Machine tradisional?',
                'options' => [
                    'Kontainer berbagi kernel host OS yang sama dan lebih ringan (lightweight) dengan startup instan serta penggunaan memori yang jauh lebih efisien',
                    'Kontainer selalu memiliki ukuran 10x lebih besar dari VM',
                    'Kontainer tidak dapat dijalankan di cloud',
                    'Kontainer tidak mendukung jaringan TCP/IP'
                ],
                'ans' => 0,
                'exp' => 'Container mengisolasi aplikasi di tingkat user-space menggunakan kernel host tanpa overhead emulasi hardware OS lengkap seperti VM.'
            ],
            [
                'q' => 'Pola arsitektur Event-Driven Architecture (EDA) sangat cocok diterapkan ketika:',
                'options' => [
                    'Sistem membutuhkan kopling longgar (loose coupling) antar layanan dengan pemrosesan kejadian bisnis secara asynchronous realtime berkecepatan tinggi',
                    'Aplikasi hanya memiliki satu tabel database',
                    'Semua operasi harus dieksekusi secara synchronous blocking',
                    'Aplikasi tidak membutuhkan jaringan internet'
                ],
                'ans' => 0,
                'exp' => 'EDA memungkinkan produser dan konsumen event beroperasi secara mandiri tanpa saling bergantung langsung (loosely coupled).'
            ],
            [
                'q' => 'Header keamanan HTTP manakah yang menginstruksikan peramban agar hanya berkomunikasi dengan server melalui koneksi aman HTTPS?',
                'options' => ['Strict-Transport-Security (HSTS)', 'X-Content-Type-Options: nosniff', 'Content-Security-Policy', 'X-XSS-Protection'],
                'ans' => 0,
                'exp' => 'HSTS memaksa browser hanya menggunakan koneksi terenkripsi HTTPS untuk melindungi terhadap serangan SSL-stripping.'
            ],
            [
                'q' => 'Dalam perancangan REST API yang baik, kode status HTTP manakah yang paling tepat dikembalikan saat sumber daya berhasil dibuat (misalnya registrasi user baru)?',
                'options' => ['200 OK', '201 Created', '202 Accepted', '204 No Content'],
                'ans' => 1,
                'exp' => '201 Created mengindikasikan bahwa request telah berhasil dan menghasilkan satu atau lebih resource baru di server.'
            ],
            [
                'q' => 'Fungsi utama dari reverse proxy seperti Nginx dalam arsitektur produksi web skala besar adalah:',
                'options' => [
                    'Bertindak sebagai pintu gerbang lalu lintas untuk load balancing, terminasi SSL/TLS, kompresi Gzip/Brotli, dan melayani file statis berkecepatan tinggi',
                    'Menggantikan kebutuhan sistem database',
                    'Menulis kode JavaScript otomatis',
                    'Mendeteksi pengguna tunanetra'
                ],
                'ans' => 0,
                'exp' => 'Nginx sangat efisien sebagai reverse proxy penyeimbang beban (load balancer) dan melayani aset statis secara asynchronous event-driven.'
            ],
            [
                'q' => 'Metodologi Git branching manakah yang memisahkan branch `main` untuk produksi stabil, `develop` untuk integrasi fitur, dan branch `feature/*` untuk pengerjaan per-fitur?',
                'options' => ['Git Flow', 'Trunk-Based Development', 'GitHub Flow murni', 'Linear History Flow'],
                'ans' => 0,
                'exp' => 'Git Flow adalah model percabangan terstruktur dengan rilis terjadwal yang membagi lifecycle pengembangan ke berbagai branch khusus.'
            ],
            [
                'q' => 'Tujuan utama dari teknik "Tree Shaking" pada JavaScript bundler modern (seperti Vite atau Webpack) adalah:',
                'options' => [
                    'Menghapus kode JavaScript yang tidak terpakai (dead code) dari hasil bundel akhir untuk memperkecil ukuran file unduhan aplikasi',
                    'Mengubah file JS menjadi bahasa Python',
                    'Mengacak variabel kode agar tidak bisa dibaca orang',
                    'Menyusun file CSS berdasarkan abjad'
                ],
                'ans' => 0,
                'exp' => 'Tree shaking mengeliminasi kode tak terpakai (dead-code elimination) dengan memanfaatkan analisis statis ES6 module imports/exports.'
            ],
            [
                'q' => 'Dalam arsitektur basis data, apa perbedaan teknik Read Replica dibanding Multi-Master replication?',
                'options' => [
                    'Read replica hanya melayani query pembacaan (SELECT) untuk meringankan beban master, sedangkan operasi penulisan data (INSERT/UPDATE/DELETE) tetap diarahkan ke database master utama',
                    'Read replica dapat menulis data lebih cepat dari master',
                    'Multi-master tidak dapat menggunakan transaksi ACID',
                    'Read replica mematikan master saat traffic tinggi'
                ],
                'ans' => 0,
                'exp' => 'Read replica menduplikasi data dari primary server untuk menangani lonjakan query pembacaan baca (read-heavy workload).'
            ],
            [
                'q' => 'Untuk mencegah serangan DoS (Denial of Service) dan penyalahgunaan endpoint API publik, mekanisme pembatasan frekuensi request yang umum diterapkan adalah:',
                'options' => ['Rate Limiting / Throttling', 'Data Sanitization', 'SQL Parameterization', 'Minification'],
                'ans' => 0,
                'exp' => 'Rate limiting membatasi jumlah request per IP/klien dalam rentang waktu tertentu (misal algoritma Token Bucket atau Leaky Bucket).'
            ],
            [
                'q' => 'Sifat Stateless pada protokol REST API mewajibkan bahwa:',
                'options' => [
                    'Setiap HTTP request dari klien harus memuat seluruh konteks dan informasi yang diperlukan oleh server untuk memprosesnya, tanpa server menyimpan status sesi klien di memori server antar request',
                    'Server tidak boleh menggunakan database',
                    'Klien tidak diperkenankan menggunakan cookie',
                    'API tidak boleh mengembalikan data JSON'
                ],
                'ans' => 0,
                'exp' => 'Statelessness mewajibkan seluruh informasi autentikasi dan konteks dikirim lengkap pada setiap request terpisah.'
            ]
        ]
    ],

    'mobile' => [
        'title' => 'Jalur Mobile Developer (Flutter & Dart Cross-Platform)',
        'code' => 'MOB',
        'type' => 'career',
        'price' => 29000,
        'original_price' => 79000,
        'duration_minutes' => 30,
        'passing_score' => 80,
        'competencies' => 'Dart 3.x OOP & Sound Null Safety, Flutter Widget Architecture (Stateless vs Stateful), State Management (Provider, Bloc, Riverpod), RESTful API Integration & JSON Serialization, Local Storage (Hive / SQLite), App Lifecycle & Native Permissions',
        'questions' => [
            [
                'q' => 'Perbedaan fundamental antara `StatelessWidget` dan `StatefulWidget` dalam arsitektur Flutter adalah:',
                'options' => [
                    'StatelessWidget hanya untuk teks, sedangkan StatefulWidget untuk gambar',
                    'StatelessWidget bersifat statis dan konfigurasinya tidak dapat berubah setelah dibangun, sedangkan StatefulWidget mempertahankan State internal dinamis yang dapat berubah sepanjang siklus hidup widget',
                    'StatefulWidget tidak dapat dirender di platform Android',
                    'StatelessWidget membutuhkan izin root perangkat'
                ],
                'ans' => 1,
                'exp' => 'StatelessWidget adalah widget immutable tanpa mutable state, sedangkan StatefulWidget memiliki objek State terpisah yang dapat dimutasi.'
            ],
            [
                'q' => 'Metode manakah yang wajib dipanggil di dalam State sebuah StatefulWidget untuk memberitahu framework Flutter agar merender ulang (rebuild) antarmuka UI?',
                'options' => ['notifyListeners()', 'setState(() { ... })', 'rebuildUI()', 'updateState()'],
                'ans' => 1,
                'exp' => 'setState memberitahu framework Flutter bahwa kondisi internal widget telah berubah, memicu eksekusi ulang method build() untuk memperbarui tampilan layar.'
            ],
            [
                'q' => 'File konfigurasi manakah pada proyek Flutter yang digunakan untuk mengatur dependensi pustaka pihak ketiga, aset gambar, dan versi aplikasi?',
                'options' => ['config.xml', 'pubspec.yaml', 'flutter.json', 'build.gradle'],
                'ans' => 1,
                'exp' => 'pubspec.yaml adalah file manifest utama proyek Flutter dan Dart untuk mengelola packages, fonts, dan assets.'
            ],
            [
                'q' => 'Widget layout dasar manakah di Flutter yang menyusun elemen-elemen anaknya secara berurutan dari atas ke bawah (vertikal)?',
                'options' => ['Row', 'Column', 'Stack', 'Wrap'],
                'ans' => 1,
                'exp' => 'Column menyusun daftar widget anak di sepanjang sumbu vertikal, sedangkan Row menyusunnya secara horizontal.'
            ],
            [
                'q' => 'Widget standar Material Design apakah yang menyediakan kerangka visual dasar seperti AppBar, Drawer, FloatingActionButton, dan Body?',
                'options' => ['Container', 'Scaffold', 'Card', 'MaterialApp'],
                'ans' => 1,
                'exp' => 'Scaffold mengimplementasikan struktur layout visual Material Design dasar yang menyediakan slot AppBar, Body, BottomNavigationBar, dan FAB.'
            ],
            [
                'q' => 'Perintah manakah yang digunakan untuk berpindah ke rute halaman baru di Flutter dengan menumpuk halaman tersebut di atas navigation stack?',
                'options' => [
                    'Navigator.push(context, MaterialPageRoute(builder: (context) => DetailPage()))',
                    'Navigator.go(context, DetailPage())',
                    'Route.open(DetailPage())',
                    'context.navigate(DetailPage())'
                ],
                'ans' => 0,
                'exp' => 'Navigator.push menambahkan rute baru ke atas tumpukan navigasi yang dikelola oleh Navigator.'
            ],
            [
                'q' => 'Widget manakah yang paling direkomendasikan dan efisien untuk menampilkan daftar ribuan data secara dinamis tanpa membebani memori smartphone?',
                'options' => ['SingleChildScrollView + Column', 'ListView.builder', 'Table', 'Wrap.builder'],
                'ans' => 1,
                'exp' => 'ListView.builder membuat widget anak hanya saat item tersebut mendekati layar yang terlihat (lazy loading / on-demand recycling).'
            ],
            [
                'q' => 'Widget manakah yang secara khusus dirancang untuk menangani pembangunan antarmuka berdasarkan status asinkron dari sebuah objek Future (seperti response HTTP REST API)?',
                'options' => ['StreamBuilder', 'FutureBuilder', 'AsyncView', 'PromiseBuilder'],
                'ans' => 1,
                'exp' => 'FutureBuilder mengamati proses objek Future dan membangun UI berdasarkan ConnectionState (waiting, done, atau error).'
            ],
            [
                'q' => 'Dalam fitur Sound Null Safety bahasa Dart, simbol tanda tanya (?) setelah nama tipe data (misal: `String? name`) mengindikasikan bahwa:',
                'options' => [
                    'Variabel tersebut bertipe boolean',
                    'Variabel tersebut dapat menerima nilai null (nullable)',
                    'Variabel tersebut bersifat konstan',
                    'Variabel tersebut belum dikompilasi'
                ],
                'ans' => 1,
                'exp' => 'Tanda tanya (?) menandai tipe nullable yang mengizinkan variabel tersebut memiliki kemungkinan bernilai null secara eksplisit.'
            ],
            [
                'q' => 'Filosofi desain utama dalam pengembangan aplikasi dengan Flutter yang membedakannya dari framework lain adalah:',
                'options' => [
                    'Everything is a Widget (Segala elemen antarmuka, layout, hingga padding adalah widget deklaratif)',
                    'Kompilasi kode hanya dilakukan via JavaScript Web View',
                    'Tidak memerlukan bahasa pemrograman khusus',
                    'Harus menulis dua basis kode terpisah untuk iOS dan Android'
                ],
                'ans' => 0,
                'exp' => 'Flutter menerapkan prinsip "Everything is a widget", di mana struktur, gaya visual, animasi, dan perataan tersusun dari komposisi widget deklaratif.'
            ],
            [
                'q' => 'Dalam arsitektur state management BLoC (Business Logic Component), dua komponen utama yang saling berinteraksi dengan Bloc adalah:',
                'options' => ['Events (Input) dan States (Output)', 'Actions dan Reducers saja', 'Models dan Views', 'Listeners dan Notifiers'],
                'ans' => 0,
                'exp' => 'BLoC menerima Events dari UI sebagai masukan, memproses logika bisnis, dan memancarkan States sebagai keluaran reaktif.'
            ],
            [
                'q' => 'Widget manakah yang digunakan untuk menumpuk elemen-elemen anak di atas satu sama lain dalam lapisan sumbu z (overlap layout)?',
                'options' => ['Stack (bersama Positioned)', 'Layer', 'OverlayBox', 'Group'],
                'ans' => 0,
                'exp' => 'Stack menumpuk widget anaknya di lapisan z-axis dan mengizinkan pemosisian mutlak melalui Positioned widget.'
            ],
            [
                'q' => 'Manakah metode siklus hidup (lifecycle) pada State Flutter yang hanya dipanggil satu kali saat widget pertama kali dimasukkan ke dalam widget tree?',
                'options' => ['initState()', 'build()', 'didUpdateWidget()', 'dispose()'],
                'ans' => 0,
                'exp' => 'initState() dijalankan tepat satu kali pada saat inisialisasi awal objek State sebelum method build().'
            ],
            [
                'q' => 'Pustaka basis data lokal NoSQL key-value yang sangat cepat dan ditulis murni dalam bahasa Dart adalah:',
                'options' => ['Hive', 'Room', 'CoreData', 'Realm C++'],
                'ans' => 0,
                'exp' => 'Hive adalah embedded key-value database murni Dart berkinerja sangat tinggi tanpa dependensi library native C++.'
            ],
            [
                'q' => 'Widget manakah yang digunakan untuk mendeteksi gestur interaksi pengguna (seperti tap, double-tap, long-press, atau drag) pada widget non-interaktif?',
                'options' => ['GestureDetector / InkWell', 'TouchListener', 'ClickBox', 'PointerEvent'],
                'ans' => 0,
                'exp' => 'GestureDetector mengenali aneka gestur pengguna, dan InkWell menambahkan efek visual ripple sentuhan Material Design.'
            ],
            [
                'q' => 'Di Dart, apa fungsi dari keyword `late` pada deklarasi variabel non-nullable?',
                'options' => [
                    'Memberitahu compiler bahwa variabel tersebut akan diinisialisasi sebelum digunakan pada saat runtime, meskipun nilainya tidak diisi saat deklarasi awal',
                    'Menunda eksekusi aplikasi selama 5 detik',
                    'Menjadikan variabel tersebut bertipe dinamis',
                    'Mengubah variabel menjadi stream data'
                ],
                'ans' => 0,
                'exp' => 'Keyword late menjamin lazy initialization pada variabel non-null sebelum dibaca pertama kali.'
            ],
            [
                'q' => 'Widget layout manakah yang memotong anak-anaknya agar memiliki sudut membulat atau bentuk kurva tertentu?',
                'options' => ['ClipRRect', 'RoundedBox', 'CornerCutter', 'BorderRadiusWidget'],
                'ans' => 0,
                'exp' => 'ClipRRect (Clip Rounded Rectangle) memotong widget anaknya dengan sudut kurva border radius tertentu.'
            ],
            [
                'q' => 'Bagaimanakah cara mengoptimalkan performa Flutter list agar widget item yang statis tidak di-rebuild berulang kali secara sia-sia?',
                'options' => [
                    'Menggunakan keyword `const` pada widget constructor yang parameter nilainya bersifat konstan',
                    'Menghapus seluruh animasi aplikasi',
                    'Mengurangi resolusi layar ponsel',
                    'Menonaktifkan garbage collection'
                ],
                'ans' => 0,
                'exp' => 'Menggunakan const constructor mencegah instansiasi dan rebuild ulang widget pohon yang identik.'
            ],
            [
                'q' => 'Dalam penanganan jaringan HTTP di Flutter/Dart, package resmi atau standar yang paling populer untuk melakukan request REST API adalah:',
                'options' => ['http / dio', 'axios', 'fetch-dart', 'requests'],
                'ans' => 0,
                'exp' => 'Package `http` dan `dio` adalah client HTTP paling andal untuk Flutter dengan fitur interceptor, file upload, dan timeout.'
            ],
            [
                'q' => 'Perintah CLI manakah yang digunakan untuk menganalisis kode Flutter dan memeriksa apakah ada potensi bug, warning, atau pelanggaran linter?',
                'options' => ['flutter analyze', 'flutter check', 'flutter doctor --code', 'dart verify'],
                'ans' => 0,
                'exp' => 'flutter analyze menjalankan Dart static analysis engine terhadap seluruh codebase proyek.'
            ],
            [
                'q' => 'Widget manakah yang digunakan untuk menyematkan animasi Loading indikator berputar khas Material Design?',
                'options' => ['CircularProgressIndicator', 'LinearProgressIndicator', 'LoadingSpinner', 'ActivityIndicatorIOS'],
                'ans' => 0,
                'exp' => 'CircularProgressIndicator adalah widget Material standar untuk indikator kemajuan proses melingkar.'
            ],
            [
                'q' => 'Dalam arsitektur Flutter, apa yang dimaksud dengan "RenderTree"?',
                'options' => [
                    'Pohon objek visual (RenderObject) tingkat rendah yang menangani kalkulasi layout geometri, ukuran, dan lukisan (painting) langsung ke layar',
                    'Pohon widget deklaratif',
                    'Struktur data basis data lokal',
                    'Skema JSON dari server API'
                ],
                'ans' => 0,
                'exp' => 'Flutter memiliki tiga pohon: WidgetTree (konfigurasi), ElementTree (lifecycle), dan RenderTree (tata letak geometris & rendering nyata).'
            ],
            [
                'q' => 'Metode manakah pada objek State yang dipanggil saat widget akan dibersihkan dan dihapus secara permanen dari memori (misal untuk menutup controller/stream)?',
                'options' => ['dispose()', 'deactivate()', 'destroy()', 'unmount()'],
                'ans' => 0,
                'exp' => 'dispose() adalah callback pembersihan akhir untuk melepas controller teks, timer, atau stream listener agar tidak terjadi kebocoran memori (memory leak).'
            ],
            [
                'q' => 'Untuk mengizinkan aplikasi Flutter mengakses kamera atau lokasi GPS pada platform Android, perizinan (permission) harus didaftarkan pada file:',
                'options' => ['AndroidManifest.xml', 'build.gradle', 'Info.plist saja', 'settings.gradle'],
                'ans' => 0,
                'exp' => 'Izin akses perangkat pada platform Android wajib didaftarkan di dalam file AndroidManifest.xml.'
            ],
            [
                'q' => 'Fitur Flutter manakah yang memungkinkan developer melihat perubahan kode UI di emulator/perangkat fisik dalam hitungan sub-detik tanpa kehilangan state aplikasi?',
                'options' => ['Stateful Hot Reload', 'Hot Restart', 'Full Recompile', 'Live Debugging'],
                'ans' => 0,
                'exp' => 'Stateful Hot Reload menyuntikkan kode Dart baru ke Dart VM yang sedang berjalan secara instan tanpa me-reset state aplikasi.'
            ]
        ]
    ]
];
