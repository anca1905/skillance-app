<?php
// Bank Soal Ujian Sertifikasi Kompetensi Resmi - Skillance Academy Indonesia

return [
    'frontend' => [
        'title' => 'Jalur Frontend Web Developer Modern',
        'code' => 'FE',
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
                    'Keduanya bekerja secara identik tanpa ada perbedaan performa',
                    'visibility: hidden hanya bekerja pada elemen SVG'
                ],
                'ans' => 1,
                'exp' => 'display: none membuat elemen tidak memakan tempat fisik sama sekali, sedangkan visibility: hidden elemen menjadi transparan namun tempatnya tetap dipertahankan.'
            ],
            [
                'q' => 'Dalam Vue.js 3, apa fungsi dari lifecycle hook `onMounted()`?',
                'options' => [
                    'Dijalankan sebelum template DOM dikompilasi',
                    'Dijalankan setelah komponen selesai dirender dan disisipkan ke dalam DOM nyata di browser',
                    'Dijalankan ketika komponen hendak dihancurkan (unmounted)',
                    'Dijalankan setiap kali ada perubahan data prop dari parent'
                ],
                'ans' => 1,
                'exp' => 'onMounted() dieksekusi setelah komponen selesai dipasang ke DOM, cocok untuk fetch data awal API atau inisialisasi plugin pihak ketiga.'
            ],
            [
                'q' => 'Di Bootstrap 5, class utility manakah yang digunakan untuk membuat teks berada tepat di tengah secara horizontal?',
                'options' => ['text-center', 'align-center', 'justify-center', 'content-center'],
                'ans' => 0,
                'exp' => 'Class text-center di Bootstrap digunakan untuk membuat text alignment berada di tengah.'
            ],
            [
                'q' => 'Metode JSON manakah yang digunakan untuk mengubah objek JavaScript menjadi format string JSON?',
                'options' => ['JSON.parse()', 'JSON.stringify()', 'JSON.encode()', 'JSON.toString()'],
                'ans' => 1,
                'exp' => 'JSON.stringify() mengubah objek atau nilai JavaScript menjadi string teks JSON.'
            ],
            [
                'q' => 'Dalam JavaScript modern, operator `??` (Nullish Coalescing) akan mengembalikan operand di sisi kanan hanya jika operand di sisi kiri bernilai apa?',
                'options' => [
                    'Falsy (false, 0, "", null, undefined, NaN)',
                    'null atau undefined saja',
                    'Nilai angka 0 saja',
                    'Tipe data boolean false'
                ],
                'ans' => 1,
                'exp' => 'Nullish Coalescing (??) hanya memeriksa nilai null atau undefined, sehingga angka 0 atau string kosong "" tetap dianggap valid di sisi kiri.'
            ],
            [
                'q' => 'Dalam HTML5, atribut manakah pada tag <input> yang membuat inputan wajib diisi sebelum form dapat disubmit?',
                'options' => ['validate', 'required', 'mandatory', 'not-null'],
                'ans' => 1,
                'exp' => 'Atribut required menandai bahwa kolom input tersebut tidak boleh dibiarkan kosong saat form disubmit.'
            ],
            [
                'q' => 'Dalam CSS Box Model, urutan layer dari bagian paling dalam ke paling luar adalah?',
                'options' => [
                    'Content -> Padding -> Border -> Margin',
                    'Content -> Border -> Padding -> Margin',
                    'Content -> Margin -> Padding -> Border',
                    'Padding -> Content -> Border -> Margin'
                ],
                'ans' => 0,
                'exp' => 'Box Model terdiri dari: Content (isi) -> Padding (jarak dalam) -> Border (garis tepi) -> Margin (jarak luar).'
            ],
            [
                'q' => 'Dalam JavaScript, apa output dari ekspresi: `typeof NaN`?',
                'options' => ['"undefined"', '"number"', '"nan"', '"object"'],
                'ans' => 1,
                'exp' => 'Di JavaScript, NaN (Not a Number) secara teknis bertipe data "number" (numerik tidak valid).'
            ],
            [
                'q' => 'Bagaimanakah cara menghentikan aksi bawaan browser (misalnya reload halaman saat submit form) menggunakan JavaScript Event Listener?',
                'options' => ['event.stopPropagation()', 'event.preventDefault()', 'event.stopImmediatePropagation()', 'return true'],
                'ans' => 1,
                'exp' => 'event.preventDefault() membatalkan aksi bawaan (default action) browser tanpa menghentikan penyebaran event.'
            ],
            [
                'q' => 'Properti CSS manakah yang digunakan untuk membuat bayangan halus di sekeliling kotak kontainer elemen?',
                'options' => ['text-shadow', 'box-shadow', 'drop-shadow', 'outline-shadow'],
                'ans' => 1,
                'exp' => 'box-shadow digunakan untuk menambahkan efek bayangan pada kotak elemen HTML.'
            ],
            [
                'q' => 'Dalam CSS Flexbox, properti manakah yang memungkinkan flex items berpindah ke baris baru ketika ruang kontainer tidak mencukupi?',
                'options' => ['flex-wrap: wrap', 'flex-flow: row', 'flex-break: true', 'flex-direction: column'],
                'ans' => 0,
                'exp' => 'flex-wrap: wrap memungkinkan elemen anak membungkus ke baris berikutnya jika ruang tidak cukup.'
            ],
            [
                'q' => 'Di Vue.js 3, apa perbedaan antara `v-if` dan `v-show`?',
                'options' => [
                    'v-if hanya menyembunyikan dengan CSS display:none, sedangkan v-show merender ulang DOM',
                    'v-if menambah atau menghapus elemen sesungguhnya dari DOM, sedangkan v-show selalu merender elemen namun mengontrol visibilitasnya melalui CSS display:none',
                    'v-show tidak mendukung ekspresi kondisi boolean',
                    'Keduanya memiliki mekanisme kerja yang identik'
                ],
                'ans' => 1,
                'exp' => 'v-if adalah "real" conditional rendering yang menyisipkan/menghapus node dari DOM, sedangkan v-show hanya melakukan toggle CSS display: none.'
            ],
            [
                'q' => 'Manakah sintaks yang benar untuk destructuring assignment objek di JavaScript ES6?',
                'options' => [
                    'const [name, age] = user;',
                    'const {name, age} = user;',
                    'const (name, age) = user;',
                    'const {name: age} <- user;'
                ],
                'ans' => 1,
                'exp' => 'Sintaks destructuring objek menggunakan kurung kurawal const { name, age } = user;.'
            ],
            [
                'q' => 'Metode JavaScript manakah yang digunakan untuk mengirimkan HTTP request asinkron modern berbasis Promise?',
                'options' => ['fetch()', 'XMLHttpRequest()', 'http.request()', 'ajax()'],
                'ans' => 0,
                'exp' => 'Fetch API (fetch()) adalah antarmuka modern bawaan browser untuk melakukan HTTP request asinkron berbasis Promise.'
            ]
        ]
    ],

    'backend' => [
        'title' => 'Jalur Backend & Database API Developer',
        'code' => 'BE',
        'competencies' => 'PHP 8.3 OOP, MySQL Relational Database, SQL Indexing, Prepared Statements, RESTful API Architecture, JWT/Session Security',
        'questions' => [
            [
                'q' => 'Dalam PHP dan MySQLi/PDO, teknik manakah yang paling efektif dan wajib digunakan untuk mencegah serangan SQL Injection?',
                'options' => [
                    'Menggunakan fungsi addslashes()',
                    'Menggunakan Prepared Statements dengan parameter binding terpisah',
                    'Melakukan enkripsi MD5 pada setiap input query',
                    'Mengubah semua input menjadi huruf kapital'
                ],
                'ans' => 1,
                'exp' => 'Prepared Statements memisahkan instruksi SQL dari parameter data pengguna, sehingga parameter tidak akan pernah dieksekusi sebagai perintah SQL.'
            ],
            [
                'q' => 'HTTP Status Code manakah yang paling tepat dikembalikan oleh RESTful API ketika data sumber daya baru berhasil dibuat di database?',
                'options' => ['200 OK', '201 Created', '204 No Content', '302 Found'],
                'ans' => 1,
                'exp' => 'Status 201 Created adalah kode standar HTTP yang menandakan bahwa request berhasil dan sumber daya baru telah berhasil dibuat di server.'
            ],
            [
                'q' => 'Klausul SQL manakah yang digunakan untuk memfilter baris data hasil pengelompokan fungsi agregasi (seperti COUNT, SUM, AVG) yang menggunakan GROUP BY?',
                'options' => ['WHERE', 'HAVING', 'ORDER BY', 'LIMIT'],
                'ans' => 1,
                'exp' => 'HAVING digunakan untuk memfilter kondisi hasil agregasi GROUP BY, sedangkan WHERE memfilter baris sebelum pengelompokan.'
            ],
            [
                'q' => 'Fungsi PHP bawaan manakah yang digunakan untuk melakukan hashing password secara aman menggunakan algoritma kuat seperti Bcrypt atau Argon2?',
                'options' => ['md5()', 'sha1()', 'password_hash()', 'crypt()'],
                'ans' => 2,
                'exp' => 'password_hash() secara otomatis menghasilkan salt acak dan menggunakan algoritma enkripsi modern (Bcrypt/Argon2) yang aman terhadap serangan brute force.'
            ],
            [
                'q' => 'Perintah JOIN SQL manakah yang mengembalikan semua baris dari tabel kiri, serta baris yang cocok dari tabel kanan (atau NULL jika tidak ada kecocokan)?',
                'options' => ['INNER JOIN', 'LEFT JOIN', 'RIGHT JOIN', 'CROSS JOIN'],
                'ans' => 1,
                'exp' => 'LEFT JOIN (atau LEFT OUTER JOIN) mengembalikan seluruh baris dari tabel kiri dan baris yang cocok dari tabel kanan.'
            ],
            [
                'q' => 'Dalam arsitektur REST API, HTTP Method manakah yang paling tepat digunakan untuk memperbarui sebagian (partial update) data pada suatu sumber daya?',
                'options' => ['GET', 'POST', 'PATCH', 'DELETE'],
                'ans' => 2,
                'exp' => 'PATCH digunakan untuk partial update (memperbarui sebagian atribut), sedangkan PUT biasanya digunakan untuk replace data seutuhnya.'
            ],
            [
                'q' => 'Dalam pemrograman berorientasi objek (OOP) di PHP, hak akses `protected` pada properti atau metode class berarti apa?',
                'options' => [
                    'Hanya dapat diakses dari dalam class itu sendiri',
                    'Dapat diakses dari dalam class itu sendiri dan class turunannya (subclass/inheritance)',
                    'Dapat diakses secara bebas dari luar class manapun',
                    'Tidak dapat diubah sama sekali nilainya'
                ],
                'ans' => 1,
                'exp' => 'Hak akses protected mengizinkan akses dari dalam class pendefinisi serta class anak yang mewarisinya (inheritance).'
            ],
            [
                'q' => 'Karakteristik ACID dalam sistem basis data relasional (RDBMS) yang memastikan bahwa sebuah transaksi harus selesai secara utuh atau dibatalkan sama sekali (all-or-nothing) disebut?',
                'options' => ['Atomicity', 'Consistency', 'Isolation', 'Durability'],
                'ans' => 0,
                'exp' => 'Atomicity menjamin prinsip all-or-nothing: seluruh rangkaian operasi dalam satu transaksi harus sukses semua, atau jika ada satu yang gagal, seluruhnya di-rollback.'
            ],
            [
                'q' => 'Header HTTP response manakah yang wajib dikirimkan oleh backend API agar browser mengetahui bahwa respon berisi data berformat JSON dengan encoding UTF-8?',
                'options' => [
                    'Content-Type: text/html; charset=utf-8',
                    'Content-Type: application/json; charset=utf-8',
                    'Accept: application/json',
                    'Content-Encoding: json'
                ],
                'ans' => 1,
                'exp' => 'Content-Type: application/json; charset=utf-8 memberi tahu client/browser bahwa payload response bertipe JSON.'
            ],
            [
                'q' => 'Dalam PHP 8+, operator `?->` (Nullsafe operator) memiliki kegunaan untuk apa?',
                'options' => [
                    'Menghapus properti objek jika bernilai null',
                    'Mengakses properti atau method objek tanpa memicu error fatal jika objek tersebut bernilai null',
                    'Memaksa tipe data menjadi null',
                    'Melakukan cloning objek secara mendalam'
                ],
                'ans' => 1,
                'exp' => 'Nullsafe operator (?->) memungkinkan pemanggilan chain method/property objek; jika salah satu bernilai null, eksekusi berhenti dan mengembalikan null tanpa error.'
            ],
            [
                'q' => 'Dalam SQL, tipe constraint manakah yang menjamin bahwa nilai dalam suatu kolom tidak boleh ada yang kembar/duplikat dan secara otomatis mengindeks kolom tersebut?',
                'options' => ['NOT NULL', 'UNIQUE', 'DEFAULT', 'CHECK'],
                'ans' => 1,
                'exp' => 'Constraint UNIQUE memastikan seluruh nilai dalam kolom tersebut berbeda satu sama lain dalam satu tabel.'
            ],
            [
                'q' => 'Dalam arsitektur basis data, apa fungsi utama dari pembuatan Index (B-Tree Index) pada kolom tabel yang sering dijadikan parameter WHERE?',
                'options' => [
                    'Mengurangi ukuran file database di harddisk',
                    'Mempercepat proses pencarian dan pengambilan data dengan menghindari Full Table Scan',
                    'Melakukan enkripsi data otomatis pada kolom tersebut',
                    'Mencegah data dari query DELETE'
                ],
                'ans' => 1,
                'exp' => 'Index membuat struktur data penunjuk (pointer) terurut yang mempercepat eksekusi pencarian query secara drastis dibanding full table scan.'
            ],
            [
                'q' => 'Fungsi superglobal di PHP yang digunakan untuk membaca payload data raw JSON yang dikirimkan melalui metode POST/PUT pada RESTful API adalah?',
                'options' => ['$_POST', 'file_get_contents("php://input")', '$_REQUEST', '$_SERVER["RAW_DATA"]'],
                'ans' => 1,
                'exp' => 'Untuk membaca raw JSON body pada request API di PHP, digunakan file_get_contents("php://input") kemudian didecode dengan json_decode().'
            ],
            [
                'q' => 'Dalam keamanan autentikasi web, token JWT (JSON Web Token) terdiri dari 3 bagian yang dipisahkan oleh tanda titik (.), yaitu?',
                'options' => [
                    'Header.Payload.Signature',
                    'Key.Data.Hash',
                    'Algorithm.Claim.Cert',
                    'Username.Role.Expiry'
                ],
                'ans' => 0,
                'exp' => 'Struktur JWT adalah Header (tipe dan algoritma), Payload (klaim/data), dan Signature (tanda tangan kriptografi verifikasi).'
            ],
            [
                'q' => 'Perintah SQL manakah yang digunakan untuk menghapus semua data dalam tabel secara cepat serta mereset nilai auto_increment kembali ke 1?',
                'options' => ['DELETE FROM table_name', 'TRUNCATE TABLE table_name', 'DROP TABLE table_name', 'RESET table_name'],
                'ans' => 1,
                'exp' => 'TRUNCATE TABLE mengosongkan seluruh data tabel secara efisien dan mereset counter AUTO_INCREMENT kembali ke nilai awal.'
            ],
            [
                'q' => 'Di PHP, magic method manakah yang otomatis dieksekusi saat sebuah objek baru dibuat dari suatu class (instansiasi)?',
                'options' => ['__destruct()', '__construct()', '__init()', '__invoke()'],
                'ans' => 1,
                'exp' => '__construct() adalah metode konstruktor yang otomatis dijalankan saat instansiasi objek (new ClassName).'
            ],
            [
                'q' => 'HTTP Status Code manakah yang menandakan bahwa client belum terautentikasi (belum login atau token tidak valid)?',
                'options' => ['400 Bad Request', '401 Unauthorized', '403 Forbidden', '404 Not Found'],
                'ans' => 1,
                'exp' => '401 Unauthorized berarti request membutuhkan autentikasi pengguna, sedangkan 403 Forbidden berarti client terautentikasi namun tidak memiliki hak akses.'
            ],
            [
                'q' => 'Dalam MySQL, jenis relasi tabel di mana satu mahasiswa dapat mengambil banyak mata kuliah, dan satu mata kuliah dapat diambil oleh banyak mahasiswa diimplementasikan melalui?',
                'options' => [
                    'Foreign Key langsung di tabel Mahasiswa',
                    'Tabel Pivot / Junction (tabel perantara berisi dua Foreign Key)',
                    'Menyimpan deretan ID mata kuliah dalam satu kolom string teks',
                    'Self-referencing Foreign Key'
                ],
                'ans' => 1,
                'exp' => 'Relasi Many-to-Many diimplementasikan menggunakan tabel perantara (pivot table) yang menampung relasi foreign key dari kedua tabel.'
            ],
            [
                'q' => 'Manakah fungsi bawaan PHP yang digunakan untuk mengecek apakah sebuah variabel telah didefinisikan dan nilainya bukan NULL?',
                'options' => ['empty()', 'isset()', 'is_null()', 'defined()'],
                'ans' => 1,
                'exp' => 'isset() memeriksa apakah variabel sudah dideklarasikan dan nilainya tidak sama dengan NULL.'
            ],
            [
                'q' => 'Dalam mekanisme Session PHP, di manakah data sesi pengguna secara default disimpan secara fisik?',
                'options' => [
                    'Di browser pengguna dalam bentuk cookie terenkripsi',
                    'Di file penyimpanan server lokal (server-side storage)',
                    'Di dalam database cloud secara otomatis',
                    'Di dalam memori RAM browser'
                ],
                'ans' => 1,
                'exp' => 'Data session PHP disimpan di sisi server (biasanya di direktori temporary server), sementara browser hanya menyimpan Session ID (PHPSESSID) di cookie.'
            ],
            [
                'q' => 'Perintah SQL manakah yang digunakan untuk memodifikasi struktur tabel yang sudah ada (misal menambah kolom baru)?',
                'options' => ['UPDATE TABLE', 'ALTER TABLE', 'MODIFY TABLE', 'CHANGE TABLE'],
                'ans' => 1,
                'exp' => 'ALTER TABLE digunakan untuk mengubah skema atau struktur tabel (menambah, mengubah, atau menghapus kolom/indeks).'
            ],
            [
                'q' => 'Dalam PHP, teknik menangani runtime error atau kegagalan query secara elegan tanpa menghentikan aplikasi menggunakan konstruksi apa?',
                'options' => ['if...else statement', 'try...catch...finally block', 'switch...case statement', 'guard statement'],
                'ans' => 1,
                'exp' => 'Blok try...catch digunakan untuk exception handling (menangkap dan menangani kesalahan runtime secara terkendali).'
            ],
            [
                'q' => 'Mekanisme keamanan HTTP Header `Access-Control-Allow-Origin` berhubungan dengan kebijakan browser apa?',
                'options' => ['Content Security Policy (CSP)', 'Cross-Origin Resource Sharing (CORS)', 'Strict-Transport-Security (HSTS)', 'X-Frame-Options'],
                'ans' => 1,
                'exp' => 'CORS (Cross-Origin Resource Sharing) mengontrol domain asal mana saja yang diizinkan memanggil API dari domain yang berbeda.'
            ],
            [
                'q' => 'Di PHP, fungsi manakah yang digunakan untuk memeriksa kecocokan password plaintext dengan hash yang tersimpan di database?',
                'options' => ['password_verify()', 'password_check()', 'password_match()', 'hash_equals()'],
                'ans' => 0,
                'exp' => 'password_verify($password, $hash) memvalidasi apakah password teks biasa cocok dengan hash Bcrypt/Argon2 yang tersimpan.'
            ],
            [
                'q' => 'Dalam SQL, klausa manakah yang digunakan untuk mengurutkan hasil query dari nilai terbesar ke terkecil?',
                'options' => ['ORDER BY column ASC', 'ORDER BY column DESC', 'SORT BY column MAX', 'GROUP BY column DESC'],
                'ans' => 1,
                'exp' => 'ORDER BY column DESC mengurutkan data secara descending (menurun: dari terbesar ke terkecil atau Z ke A).'
            ]
        ]
    ],

    'fullstack' => [
        'title' => 'Jalur Fullstack Web Developer',
        'code' => 'FS',
        'competencies' => 'Fullstack Architecture, PHP/Laravel, Vue.js Frontend, MySQL Database, RESTful API Integration, Git Version Control, Cloud Deployment',
        'questions' => [
            [
                'q' => 'Dalam pola arsitektur MVC (Model-View-Controller), komponen manakah yang bertanggung jawab mengelola logika interaksi data basis data dan aturan bisnis?',
                'options' => ['View', 'Controller', 'Model', 'Router'],
                'ans' => 2,
                'exp' => 'Model bertanggung jawab mengelola data, relasi basis data, validasi model, dan logika bisnis inti aplikasi.'
            ],
            [
                'q' => 'Apa keuntungan utama arsitektur Single Page Application (SPA) dibanding aplikasi web multi-halaman tradisional (MPA)?',
                'options' => [
                    'SPA tidak memerlukan server web sama sekali untuk berjalan',
                    'Transisi halaman berlangsung instan tanpa reload penuh seluruh browser karena hanya data (JSON) yang dimuat ulang',
                    'SPA secara default memiliki optimasi SEO yang lebih mudah dibanding web statis',
                    'SPA tidak menggunakan kode JavaScript sama sekali di browser'
                ],
                'ans' => 1,
                'exp' => 'SPA hanya memuat halaman HTML sekali; pergantian tampilan berikutnya dilakukan secara reaktif via JavaScript tanpa reload halaman utuh.'
            ],
            [
                'q' => 'Dalam manajemen versi Git, perintah manakah yang digunakan untuk menggabungkan perubahan dari branch lain ke branch yang sedang aktif saat ini?',
                'options' => ['git pull', 'git merge', 'git push', 'git checkout'],
                'ans' => 1,
                'exp' => 'git merge [branch-name] menggabungkan commit riwayat dari cabang target ke dalam cabang aktif saat ini.'
            ],
            [
                'q' => 'Di Laravel / framework PHP modern, apa fungsi dari file `.env`?',
                'options' => [
                    'Menyimpan file cache template blade',
                    'Menyimpan konfigurasi variabel lingkungan yang spesifik per environment (seperti kredensial database dan API key) yang tidak boleh di-commit ke Git',
                    'Menyimpan daftar rute URL publik',
                    'Menyimpan seluruh tabel database lokal'
                ],
                'ans' => 1,
                'exp' => 'File .env menyimpan konfigurasi sensitif (koneksi DB, secret key, environment) yang berbeda di lokal vs server produksi.'
            ],
            [
                'q' => 'Teknik komunikasi data dua arah realtime antara browser dan server dengan koneksi persisten berlatensi rendah disebut?',
                'options' => ['Polling HTTP', 'WebSockets', 'Server-Sent Events (SSE)', 'REST GET Request'],
                'ans' => 1,
                'exp' => 'WebSocket menyediakan saluran komunikasi dua arah (full-duplex) yang persisten melalui satu koneksi TCP.'
            ],
            [
                'q' => 'Serangan keamanan web di mana penyerang menyisipkan skrip berbahaya (biasanya JavaScript) ke halaman web yang kemudian dieksekusi di browser korban disebut?',
                'options' => ['SQL Injection', 'Cross-Site Scripting (XSS)', 'Cross-Site Request Forgery (CSRF)', 'DDoS Attack'],
                'ans' => 1,
                'exp' => 'XSS (Cross-Site Scripting) terjadi ketika aplikasi memasukkan data yang tidak divalidasi/diescape ke dalam output halaman web.'
            ],
            [
                'q' => 'Mekanisme token rahasia yang disisipkan pada formulir HTML untuk memastikan bahwa permintaan formulir benar-benar berasal dari pengguna yang sah dan bukan dari situs pihak ketiga disebut token apa?',
                'options' => ['XSS Token', 'CSRF Token', 'JWT Token', 'CORS Token'],
                'ans' => 1,
                'exp' => 'CSRF Token mencegah serangan Cross-Site Request Forgery dengan memvalidasi bahwa permintaan POST/PUT berasal dari domain aplikasi yang sah.'
            ],
            [
                'q' => 'Dalam pengembangan Fullstack, apa fungsi utama dari Web Server (seperti Nginx atau Apache) dalam arsitektur produksi?',
                'options' => [
                    'Mengeksekusi query database MySQL',
                    'Menerima request HTTP masuk, menyajikan file statis (HTML/CSS/JS/Gambar), dan meneruskan request dinamis ke PHP-FPM / aplikasi backend (Reverse Proxy)',
                    'Menggantikan fungsi sistem operasi Linux',
                    'Mengompilasi source code JavaScript ke bytecode'
                ],
                'ans' => 1,
                'exp' => 'Nginx/Apache bertindak sebagai web server dan reverse proxy yang menyajikan asset statis dengan cepat dan mem-proxy request dinamis ke runtime PHP.'
            ],
            [
                'q' => 'Dalam Git, perintah manakah yang digunakan untuk membatalkan modifikasi yang belum di-stage pada suatu file dan mengembalikannya ke versi commit terakhir?',
                'options' => ['git commit --amend', 'git restore <file>', 'git rm <file>', 'git branch -d <file>'],
                'ans' => 1,
                'exp' => 'git restore <file> mengembalikan file yang belum di-stage ke kondisi commit terakhir di repository.'
            ],
            [
                'q' => 'Pada arsitektur API modern, apa fungsi dari layer Middleware?',
                'options' => [
                    'Menggantikan fungsi database server',
                    'Menjembatani dan menyaring request HTTP sebelum mencapai controller (misal: cek login, cek role, log akses, atau CORS)',
                    'Membuat antarmuka visual grafik di browser',
                    'Menghapus session pengguna secara acak'
                ],
                'ans' => 1,
                'exp' => 'Middleware bertindak sebagai filter/lapisan perantara yang memeriksa dan memproses request sebelum sampai ke controller utama.'
            ],
            [
                'q' => 'Sertifikat SSL/TLS (HTTPS) mengenkripsi komunikasi data antara client dan server pada layer jaringan mana?',
                'options' => ['Physical Layer', 'Transport Layer Security', 'Data Link Layer', 'Network Layer IP'],
                'ans' => 1,
                'exp' => 'TLS/SSL mengenkripsi data di antara Transport Layer (TCP) dan Application Layer (HTTP), menjamin kerahasiaan dan integritas data.'
            ],
            [
                'q' => 'Dalam database relasional, prinsip Normalisasi Database bertujuan utama untuk apa?',
                'options' => [
                    'Memperbanyak jumlah tabel secara acak',
                    'Mengurangi redundansi (duplikasi data) dan menjaga integritas konsistensi data',
                    'Mengubah format database menjadi NoSQL',
                    'Menonaktifkan batasan Primary Key'
                ],
                'ans' => 1,
                'exp' => 'Normalisasi data mengorganisir kolom dan tabel untuk meminimalkan duplikasi data dan anomali saat insert, update, atau delete.'
            ],
            [
                'q' => 'Metode HTTP caching yang menggunakan validator berupa hash konten unik yang dikirimkan server melalui header disebut?',
                'options' => ['Expires', 'ETag', 'Cache-Control', 'Pragma'],
                'ans' => 1,
                'exp' => 'ETag (Entity Tag) adalah penanda unik (hash) dari versi spesifik suatu sumber daya yang digunakan browser untuk validasi cache.'
            ],
            [
                'q' => 'Dalam ekosistem Node.js/Vite untuk frontend, apa fungsi file `package.json`?',
                'options' => [
                    'Menyimpan konfigurasi database MySQL',
                    'Mendefinisikan metadata proyek, daftar dependensi library (dependencies), dan script build yang dapat dijalankan',
                    'Menyimpan password server',
                    'Menyimpan log error aplikasi'
                ],
                'ans' => 1,
                'exp' => 'package.json adalah file manifest proyek JavaScript/Node.js yang mencatat dependencies, devDependencies, versi, dan script.'
            ],
            [
                'q' => 'Di arsitektur database, apa fungsi dari Database Migration (seperti di Laravel atau Prisma)?',
                'options' => [
                    'Memindahkan server database ke hosting lain',
                    'Manajemen versi untuk skema database (version control for database schema) yang dapat dijalankan secara konsisten oleh seluruh tim pengembang',
                    'Mengompresi data SQL menjadi format ZIP',
                    'Menghapus seluruh relasi foreign key'
                ],
                'ans' => 1,
                'exp' => 'Migration memungkinkan tim mendefinisikan dan memodifikasi skema basis data menggunakan kode terstruktur yang dapat di-rollback dan dilacak riwayatnya.'
            ],
            [
                'q' => 'Dalam REST API, jika client meminta sumber daya yang tidak ditemukan di server, status kode HTTP yang harus dikembalikan adalah?',
                'options' => ['400 Bad Request', '403 Forbidden', '404 Not Found', '500 Internal Server Error'],
                'ans' => 2,
                'exp' => '404 Not Found adalah kode standar HTTP jika sumber daya/endpoint yang diminta tidak ditemukan di server.'
            ],
            [
                'q' => 'Apa keuntungan menggunakan ORM (Object-Relational Mapping) seperti Eloquent atau Hibernate dibanding raw query SQL?',
                'options' => [
                    'Meniadakan kebutuhan database sama sekali',
                    'Memungkinkan manipulasi data database menggunakan objek dan method pemrograman berorientasi objek yang lebih ekspresif dan aman',
                    'Pasti selalu lebih cepat 100 kali lipat dibanding query SQL murni',
                    'Mengubah semua database menjadi MongoDB'
                ],
                'ans' => 1,
                'exp' => 'ORM memetakan tabel database ke class model OOP, memudahkan penulisan query, relasi data, dan mengurangi risiko kesalahan sintaks.'
            ],
            [
                'q' => 'Di Git, perintah apa yang digunakan untuk membuat branch baru sekaligus berpindah ke branch tersebut?',
                'options' => ['git branch new-branch', 'git checkout -b new-branch (atau git switch -c new-branch)', 'git merge new-branch', 'git push new-branch'],
                'ans' => 1,
                'exp' => 'git checkout -b <name> atau git switch -c <name> membuat cabang baru dan langsung berpindah ke cabang tersebut.'
            ],
            [
                'q' => 'Format pertukaran data standar yang paling umum digunakan dalam integrasi RESTful API modern adalah?',
                'options' => ['CSV', 'XML', 'JSON', 'YAML'],
                'ans' => 2,
                'exp' => 'JSON (JavaScript Object Notation) adalah format pertukaran data yang ringan, mudah dibaca manusia, dan didukung oleh hampir semua bahasa pemrograman.'
            ],
            [
                'q' => 'Dalam keamanan web, praktik "Sanitasi Input" dan "Output Encoding" sangat penting untuk mencegah serangan apa?',
                'options' => ['DDoS', 'XSS dan Injection', 'Phishing email', 'DNS spoofing'],
                'ans' => 1,
                'exp' => 'Sanitasi input dan output encoding memastikan data berbahaya dinetralkan sehingga tidak dapat dieksekusi sebagai perintah jahat di server maupun browser.'
            ],
            [
                'q' => 'Perbedaan utama antara penyimpanan LocalStorage dan SessionStorage di browser web adalah?',
                'options' => [
                    'LocalStorage hanya menyimpan 1 KB, sedangkan SessionStorage 5 MB',
                    'LocalStorage datanya bertahan permanen sampai dihapus manual/oleh skrip, sedangkan SessionStorage datanya terhapus otomatis saat tab/jendela browser ditutup',
                    'SessionStorage otomatis dikirimkan ke server pada setiap request HTTP',
                    'LocalStorage tidak dapat dibaca oleh JavaScript'
                ],
                'ans' => 1,
                'exp' => 'LocalStorage bertahan melintasi sesi browser (tidak terhapus saat tab ditutup), sedangkan SessionStorage hanya bertahan selama tab tersebut aktif.'
            ],
            [
                'q' => 'Apa tujuan dari proses "Minifikasi" (Minification) pada file CSS dan JavaScript saat proses build produksi?',
                'options' => [
                    'Mengubah bahasa pemrograman menjadi C++',
                    'Menghapus spasi kosong, komentar, dan memperpendek nama variabel untuk memperkecil ukuran file dan mempercepat waktu unduh di browser',
                    'Menyisipkan enkripsi antivirus ke dalam file',
                    'Memperbesar ukuran gambar'
                ],
                'ans' => 1,
                'exp' => 'Minifikasi memadatkan ukuran berkas asset dengan menghilangkan whitespace dan karakter yang tidak perlu demi efisiensi transfer jaringan.'
            ],
            [
                'q' => 'Dalam sistem arsitektur berbasis API, konsep "Stateless" pada REST berarti apa?',
                'options' => [
                    'Server menyimpan state setiap pengguna di file lokal server',
                    'Setiap request dari client ke server harus berisi seluruh informasi yang diperlukan untuk memahami dan mengeksekusi request tersebut tanpa bergantung pada sesi yang disimpan di server',
                    'Aplikasi tidak boleh menggunakan database',
                    'Data di database tidak pernah berubah'
                ],
                'ans' => 1,
                'exp' => 'Stateless berarti server tidak menyimpan konteks sesi client di antara request; setiap request membawa informasi autentikasi sendiri (misal bearer token).'
            ],
            [
                'q' => 'Dalam Git, file manakah yang digunakan untuk memberi tahu Git file atau folder apa saja yang tidak boleh dilacak (untracked)?',
                'options' => ['.gitkeep', '.gitignore', '.gitconfig', 'README.md'],
                'ans' => 1,
                'exp' => '.gitignore memuat daftar pola file atau direktori (seperti node_modules, .env, vendor) yang diabaikan oleh Git.'
            ],
            [
                'q' => 'Perintah HTTP POST biasanya bersifat "Non-Idempotent". Apa arti istilah tersebut?',
                'options' => [
                    'Request dapat dijalankan berkali-kali tanpa menghasilkan perubahan apapun di server',
                    'Mengirimkan request yang sama berulang kali dapat menghasilkan efek samping tambahan (misal: membuat data transaksi baru ganda setiap kali dikirim)',
                    'Request tidak memerlukan parameter body',
                    'Request hanya boleh dijalankan di localhost'
                ],
                'ans' => 1,
                'exp' => 'Non-idempotent berarti pemanggilan berulang kali dengan parameter sama dapat menghasilkan perubahan status tambahan di server (misal duplikasi order).'
            ]
        ]
    ],

    'python' => [
        'title' => 'Jalur Python, Data Science & AI Developer',
        'code' => 'PY',
        'competencies' => 'Python 3.12 Core, OOP, Data Structures & Algorithms, Pandas, NumPy, Matplotlib, Machine Learning Fundamentals',
        'questions' => [
            [
                'q' => 'Struktur data bawaan Python manakah yang bersifat terurut (ordered), dapat diubah nilainya (mutable), dan mengizinkan elemen duplikat?',
                'options' => ['Tuple', 'List', 'Set', 'Dictionary'],
                'ans' => 1,
                'exp' => 'List dalam Python bersifat ordered, mutable (dapat dimodifikasi), dan mengizinkan item bernilai duplikat.'
            ],
            [
                'q' => 'Apa perbedaan mendasar antara Tuple dan List dalam bahasa Python?',
                'options' => [
                    'Tuple mutable sedangkan List immutable',
                    'Tuple immutable (tidak dapat diubah setelah dibuat) sedangkan List mutable',
                    'Tuple hanya dapat menyimpan angka',
                    'List tidak mendukung operasi indexing'
                ],
                'ans' => 1,
                'exp' => 'Tuple bersifat immutable (elemennya tidak dapat ditambah, dihapus, atau diubah setelah inisialisasi).'
            ],
            [
                'q' => 'Dalam Python, apa output dari potongan kode berikut: `[x**2 for x in range(4)]`?',
                'options' => ['[1, 4, 9, 16]', '[0, 1, 4, 9]', '[0, 2, 4, 6]', '[1, 2, 3, 4]'],
                'ans' => 1,
                'exp' => 'range(4) menghasilkan 0, 1, 2, 3. Kuadrat masing-masing adalah 0**2=0, 1**2=1, 2**2=4, 3**2=9. Sehingga hasilnya [0, 1, 4, 9].'
            ],
            [
                'q' => 'Fungsi atau keyword manakah di Python yang digunakan untuk mendefinisikan anonymous function (fungsi satu baris tanpa nama)?',
                'options' => ['def', 'lambda', 'func', 'inline'],
                'ans' => 1,
                'exp' => 'lambda digunakan untuk membuat fungsi anonim ringkas satu baris (contoh: lambda x: x * 2).'
            ],
            [
                'q' => 'Dalam class OOP Python, parameter pertama yang wajib didefinisikan pada setiap instance method untuk mereferensikan objek instans saat ini secara konvensi dinamakan?',
                'options' => ['this', 'self', 'cls', 'instance'],
                'ans' => 1,
                'exp' => 'Konvensi resmi Python menggunakan self sebagai parameter pertama setiap instance method untuk mengakses atribut dan method objek.'
            ],
            [
                'q' => 'Di Python, konstruksi `with open("file.txt", "r") as f:` sangat dianjurkan karena alasan apa?',
                'options' => [
                    'Mempercepat kecepatan baca file 10 kali lipat',
                    'Menggunakan Context Manager yang secara otomatis menutup file (f.close()) bahkan jika terjadi runtime exception',
                    'Mengenkripsi file secara otomatis',
                    'Menghapus file setelah dibaca'
                ],
                'ans' => 1,
                'exp' => 'Pernyataan with menggunakan protokol context manager yang menjamin berkas akan ditutup secara aman saat keluar dari blok with.'
            ],
            [
                'q' => 'Library Python manakah yang menjadi standar industri untuk manipulasi data tabular (DataFrames) dan analisis data?',
                'options' => ['Flask', 'Pandas', 'Pygame', 'Requests'],
                'ans' => 1,
                'exp' => 'Pandas adalah library utama untuk manipulasi, pembersihan, dan analisis data berstruktur tabel (DataFrame/Series).'
            ],
            [
                'q' => 'Dalam modul NumPy, apa keunggulan utama `numpy.ndarray` dibanding list bawaan Python dalam pemrosesan data numerik?',
                'options' => [
                    'Mengonsumsi memori lebih hemat dan mengeksekusi operasi vektor/matriks secara teroptimasi pada level bahasa C (vectorization)',
                    'Dapat menyimpan elemen HTML secara langsung',
                    'Tidak memerlukan instalasi pip',
                    'Dapat dijalankan tanpa RAM'
                ],
                'ans' => 0,
                'exp' => 'NumPy array menyimpan data secara kontigu di memori dengan tipe homogen sehingga kalkulasi numerik berjalan jauh lebih cepat (vectorized operations).'
            ],
            [
                'q' => 'Apa hasil dari ekspresi boolean Python: `bool([])`?',
                'options' => ['True', 'False', 'None', 'Error'],
                'ans' => 1,
                'exp' => 'Di Python, koleksi kosong (list kosong [], string kosong "", dict kosong {}) dievaluasi sebagai nilai Falsy (False).'
            ],
            [
                'q' => 'Di Python, dekorator (decorator) ditandai dengan simbol apa di atas definisi fungsi?',
                'options' => ['#', '@', '$', '&'],
                'ans' => 1,
                'exp' => 'Dekorator diawali dengan simbol @ (contoh: @staticmethod, @property, @app.route).'
            ],
            [
                'q' => 'Dalam penanganan error di Python, blok kode manakah yang akan selalu dieksekusi terlepas dari apakah terjadi exception atau tidak?',
                'options' => ['try', 'except', 'else', 'finally'],
                'ans' => 3,
                'exp' => 'Blok finally selalu dijalankan di akhir blok try-except, sangat cocok untuk proses clean-up resources.'
            ],
            [
                'q' => 'Metode Dictionary manakah yang digunakan untuk mengambil nilai kunci tertentu dengan aman tanpa memicu `KeyError` jika kunci tidak ada?',
                'options' => ['dict[key]', 'dict.get(key, default)', 'dict.find(key)', 'dict.search(key)'],
                'ans' => 1,
                'exp' => 'dict.get(key, default) mengembalikan nilai jika kunci ditemukan atau nilai default (None) jika kunci tidak ada tanpa melempar KeyError.'
            ],
            [
                'q' => 'Dalam algoritma Machine Learning, teknik pembelajaran yang menggunakan data berlabel (features dan target ground truth) disebut?',
                'options' => ['Supervised Learning', 'Unsupervised Learning', 'Reinforcement Learning', 'Zero-shot Learning'],
                'ans' => 0,
                'exp' => 'Supervised Learning melatih model menggunakan pasangan input data dan label jawaban yang sudah diketahui (misal: klasifikasi dan regresi).'
            ],
            [
                'q' => 'Di Python 3, apa fungsi dari keyword `yield` di dalam sebuah fungsi?',
                'options' => [
                    'Menghentikan eksekusi program seketika',
                    'Mengubah fungsi menjadi sebuah Generator yang menghasilkan nilai secara bertahap (lazy evaluation)',
                    'Mengimpor package dari cloud',
                    'Mengubah tipe data variabel menjadi integer'
                ],
                'ans' => 1,
                'exp' => 'yield menghasilkan iterator generator yang mengembalikan nilai satu per satu saat diminta, menghemat memori untuk dataset besar.'
            ],
            [
                'q' => 'Fungsi bawaan Python manakah yang menggabungkan dua atau lebih iterable menjadi pasangan tuple?',
                'options' => ['enumerate()', 'zip()', 'map()', 'concat()'],
                'ans' => 1,
                'exp' => 'zip(*iterables) menggabungkan elemen dari masing-masing iterable berdasarkan indeks posisinya menjadi kumpulan tuple.'
            ],
            [
                'q' => 'Dalam modul Scikit-Learn, metode manakah yang digunakan untuk melatih (training) model machine learning terhadap data latih?',
                'options' => ['model.predict(X, y)', 'model.fit(X, y)', 'model.train(X, y)', 'model.execute(X, y)'],
                'ans' => 1,
                'exp' => 'Metode fit(X, y) adalah API standar di Scikit-Learn untuk melatih parameter model terhadap data input X dan target y.'
            ],
            [
                'q' => 'Operator perbandingan manakah di Python yang digunakan untuk menguji apakah dua variabel mereferensikan objek yang persis sama di memori (identity comparison)?',
                'options' => ['==', 'is', 'in', 'equals'],
                'ans' => 1,
                'exp' => 'is menguji identitas objek (apakah berada di alamat memori id() yang sama), sedangkan == menguji kesetaraan nilai konten.'
            ],
            [
                'q' => 'Metode string Python manakah yang membagi teks string menjadi list berdasarkan tanda pemisah (delimiter)?',
                'options' => ['join()', 'split()', 'slice()', 'divide()'],
                'ans' => 1,
                'exp' => 'string.split(delimiter) memecah teks menjadi potongan list string.'
            ],
            [
                'q' => 'Di Python, keyword manakah yang digunakan untuk membuat blok placeholder kosong tanpa aksi agar tidak memicu IndentationError?',
                'options' => ['void', 'pass', 'null', 'skip'],
                'ans' => 1,
                'exp' => 'pass adalah pernyataan null operation yang digunakan sebagai placeholder sintaks pada fungsi atau loop yang belum diimplementasikan.'
            ],
            [
                'q' => 'Struktur data Set di Python secara otomatis menjamin sifat apa?',
                'options' => [
                    'Seluruh elemen terurut dari A ke Z',
                    'Seluruh elemen unik tanpa ada duplikasi',
                    'Seluruh elemen harus bertipe integer',
                    'Dapat diakses menggunakan indeks angka'
                ],
                'ans' => 1,
                'exp' => 'Set adalah kumpulan elemen tidak terurut yang secara matematis tidak mengizinkan adanya elemen duplikat.'
            ],
            [
                'q' => 'Di modul Matplotlib, fungsi manakah yang digunakan untuk menampilkan jendela grafik visualisasi ke layar?',
                'options' => ['plt.render()', 'plt.show()', 'plt.display()', 'plt.plot()'],
                'ans' => 1,
                'exp' => 'plt.show() menampilkan seluruh figur grafik yang telah dikonfigurasi ke layar.'
            ],
            [
                'q' => 'Dalam Python OOP, method khusus `__str__()` berfungsi untuk apa?',
                'options' => [
                    'Mengonversi angka menjadi float',
                    'Mengembalikan representasi teks string yang ramah dibaca manusia ketika objek dicetak dengan fungsi print()',
                    'Menghapus objek dari memori',
                    'Menyimpan objek ke harddisk'
                ],
                'ans' => 1,
                'exp' => '__str__ mendefinisikan representasi string informal yang mudah dibaca saat objek di-print atau di-str().'
            ],
            [
                'q' => 'Apa output dari ekspresi: `type(3 / 2)` di Python 3?',
                'options' => ['<class "int">', '<class "float">', '<class "double">', '<class "number">'],
                'ans' => 1,
                'exp' => 'Di Python 3, pembagian tunggal (/) selalu menghasilkan tipe data float (3 / 2 = 1.5). Pembagian integer menggunakan (//).'
            ],
            [
                'q' => 'Fungsi bawaan Python manakah yang mengembalikan pasangan (indeks, elemen) saat melakukan iterasi dalam perulangan loop?',
                'options' => ['range()', 'enumerate()', 'index()', 'counter()'],
                'ans' => 1,
                'exp' => 'enumerate(iterable) menghasilkan pasangan counter indeks dan nilai item selama iterasi perulangan.'
            ],
            [
                'q' => 'Di Python, library standar manakah yang digunakan untuk bekerja dengan ekspresi reguler (Regular Expressions)?',
                'options' => ['regex_lib', 're', 'pattern', 'matcher'],
                'ans' => 1,
                'exp' => 'Modul re adalah modul bawaan standar Python untuk pemrosesan regular expression (re.search, re.findall, dll).'
            ]
        ]
    ],

    'mobile' => [
        'title' => 'Jalur Mobile Developer (Flutter & Dart Cross-Platform)',
        'code' => 'MOB',
        'competencies' => 'Dart 3 Sound Null Safety, Flutter Widget Tree Architecture, Material 3 Design, GoRouter Navigation, BLoC/Riverpod State Management, REST API & Offline SQLite, Impeller Engine, Google Play AAB Deployment',
        'questions' => [
            [
                'q' => 'Fitur bahasa Dart apa yang menjamin variabel tidak dapat bernilai null kecuali secara eksplisit dideklarasikan dengan tanda tanya (?)?',
                'options' => ['Dynamic Typing', 'Sound Null Safety', 'Late Initialization', 'Nullable Inference'],
                'ans' => 1,
                'exp' => 'Sound Null Safety mencegah runtime NullPointerExceptions dengan mewajibkan tanda tanya (?) untuk tipe yang boleh bernilai null.'
            ],
            [
                'q' => 'Fungsi apakah yang bertugas mengikat Widget akar aplikasi Flutter ke jendela tampilan perangkat fisik?',
                'options' => ['main()', 'startFlutter()', 'runApp()', 'renderWidget()'],
                'ans' => 2,
                'exp' => 'runApp() menginstansiasi widget akar dan menempelkannya ke layar perangkat.'
            ],
            [
                'q' => 'Apa perbedaan utama antara StatelessWidget dan StatefulWidget di Flutter?',
                'options' => ['StatelessWidget lebih lambat', 'StatefulWidget memiliki objek State internal yang dapat berubah selama runtime via setState()', 'StatelessWidget hanya untuk teks', 'StatefulWidget tidak dapat menerima parameter'],
                'ans' => 1,
                'exp' => 'StatefulWidget mengelola state yang dapat bermutasi dan memicu rebuild UI saat setState() dipanggil.'
            ],
            [
                'q' => 'Widget apa yang menyediakan struktur dasar visual layar aplikasi seperti AppBar, FloatingActionButton, dan Drawer?',
                'options' => ['MaterialApp', 'Scaffold', 'Container', 'Card'],
                'ans' => 1,
                'exp' => 'Scaffold mengimplementasikan layout dasar visual arsitektur Material Design.'
            ],
            [
                'q' => 'Bagaimanakah bunyi 3 aturan emas penentuan tata letak (constraints) pada Flutter?',
                'options' => ['Widgets go left, sizes go right, parent sets color', 'Constraints go down, sizes go up, parents set position', 'Sizes go down, constraints go up, screen sets position', 'Layout goes deep, children set constraints, root renders'],
                'ans' => 1,
                'exp' => 'Aturan resmi Flutter: Constraints go down, sizes go up, parents set position.'
            ],
            [
                'q' => 'Widget apakah yang digunakan di dalam Row atau Column untuk mengambil seluruh sisa ruang kosong yang tersedia?',
                'options' => ['SizedBox', 'Padding', 'Expanded', 'SpacerBox'],
                'ans' => 2,
                'exp' => 'Expanded membagi dan mengisi seluruh sisa ruang kosong pada sumbu utama flex.'
            ],
            [
                'q' => 'Error garis loreng kuning-hitam pada Flutter (RenderFlex overflowed by X pixels) biasanya diatasi dengan membungkus anak Row/Column dengan widget?',
                'options' => ['Expanded atau SingleChildScrollView', 'Material', 'Card', 'Center'],
                'ans' => 0,
                'exp' => 'Expanded membatasi ukuran anak pada sumbu flex, atau SingleChildScrollView memungkinkan konten digulir jika melampaui layar.'
            ],
            [
                'q' => 'Widget apa yang digunakan untuk menumpuk elemen visual secara berlapis di atas sumbu Z (seperti meletakkan badge di atas foto)?',
                'options' => ['Column', 'Row', 'Stack', 'Wrap'],
                'ans' => 2,
                'exp' => 'Stack menumpuk elemen secara bertingkat di atas sumbu kedalaman Z menggunakan Positioned.'
            ],
            [
                'q' => 'Properti apa pada MaterialApp yang wajib diatur bernilai true untuk mengaktifkan spesifikasi Material Design 3 terbaru?',
                'options' => ['materialDesign: 3', 'useMaterial3: true', 'enableM3: true', 'version: 3'],
                'ans' => 1,
                'exp' => 'useMaterial3: true mengaktifkan spesifikasi desain Material 3 terbaru.'
            ],
            [
                'q' => 'Metode apa di dalam State yang digunakan untuk memberi tahu framework bahwa data telah berubah dan UI perlu di-render ulang?',
                'options' => ['update()', 'notify()', 'setState()', 'rebuild()'],
                'ans' => 2,
                'exp' => 'setState() menandai elemen kotor dan menjadwalkan metode build() untuk dieksekusi ulang.'
            ],
            [
                'q' => 'Apa perbedaan utama antara GestureDetector dan InkWell?',
                'options' => ['GestureDetector lebih cepat', 'InkWell memberikan efek riak air (splash ripple effect) khas Material Design saat disentuh', 'InkWell hanya untuk teks', 'GestureDetector tidak mendukung sentuhan'],
                'ans' => 1,
                'exp' => 'InkWell membungkus aksi sentuhan dengan animasi riak visual (ripple).'
            ],
            [
                'q' => 'Berkas konfigurasi apakah pada proyek Flutter yang digunakan untuk mendaftarkan aset gambar, file font, dan paket dependensi eksternal?',
                'options' => ['build.gradle', 'AndroidManifest.xml', 'pubspec.yaml', 'flutter.json'],
                'ans' => 2,
                'exp' => 'pubspec.yaml adalah berkas konfigurasi utama proyek Flutter dan Dart.'
            ],
            [
                'q' => 'Package routing resmi yang sangat direkomendasikan untuk navigasi deklaratif dan dukungan deep linking di Flutter adalah?',
                'options' => ['go_router', 'flutter_route', 'easy_nav', 'router_kit'],
                'ans' => 0,
                'exp' => 'go_router adalah solusi routing deklaratif standar industri yang didukung resmi oleh tim Flutter.'
            ],
            [
                'q' => 'Widget animasi implisit apa yang dapat menganimasikan transisi ukuran, warna, dan border radius secara otomatis hanya dengan mengubah nilainya?',
                'options' => ['SmoothContainer', 'AnimatedContainer', 'DynamicBox', 'MorphCard'],
                'ans' => 1,
                'exp' => 'AnimatedContainer secara otomatis menginterpolasi properti geometris dan visualnya selama durasi tertentu.'
            ],
            [
                'q' => 'Widget apa yang digunakan untuk menyediakan label verbal dan informasi ramah aksesibilitas bagi aplikasi pembaca layar (TalkBack / VoiceOver)?',
                'options' => ['Accessible', 'ScreenReader', 'Semantics', 'VoiceTag'],
                'ans' => 2,
                'exp' => 'Semantics membungkus elemen dan memberikan informasi deskriptif untuk Screen Reader.'
            ],
            [
                'q' => 'Format berkas standar lokalisasi multi-bahasa resmi yang digunakan pada Flutter adalah?',
                'options' => ['.json', '.arb', '.xml', '.po'],
                'ans' => 1,
                'exp' => '.arb (Application Resource Bundle) adalah format JSON standar Google untuk lokalisasi Flutter.'
            ],
            [
                'q' => 'Package HTTP client di Dart yang sangat populer dan mendukung fitur canggih seperti Interceptors, Global Configuration, dan FormData adalah?',
                'options' => ['dio', 'axios_dart', 'fetch', 'network_io'],
                'ans' => 0,
                'exp' => 'Dio adalah HTTP client tingkat lanjut yang sangat kuat di Dart.'
            ],
            [
                'q' => 'Pola State Management apa yang memisahkan logika bisnis menggunakan konsep Events dan States berbasis Reactive Streams?',
                'options' => ['BLoC (Business Logic Component)', 'MVC Murni', 'SharedPreferences', 'Singleton Pattern'],
                'ans' => 0,
                'exp' => 'BLoC menerima Event dari UI dan memancarkan State baru secara reaktif.'
            ],
            [
                'q' => 'Mekanisme apa di Flutter yang digunakan untuk berkomunikasi dua arah antara kode Dart dan kode native Android (Kotlin) / iOS (Swift)?',
                'options' => ['Platform Channels (MethodChannel)', 'JNI Bridge', 'WebSocket Local', 'Bluetooth Channel'],
                'ans' => 0,
                'exp' => 'MethodChannel memfasilitasi pertukaran pesan dan pemanggilan metode antara Dart dan kode native host.'
            ],
            [
                'q' => 'Plugin resmi apa yang digunakan untuk mengimplementasikan otentikasi biometrik sidik jari (Fingerprint) dan Face ID di Flutter?',
                'options' => ['local_auth', 'fingerprint_scanner', 'biometric_flutter', 'device_security'],
                'ans' => 0,
                'exp' => 'local_auth adalah plugin resmi Flutter untuk autentikasi biometrik lokal di Android dan iOS.'
            ],
            [
                'q' => 'Jenis pengujian otomatis di Flutter yang memverifikasi antarmuka visual dan respons simulasi klik tombol secara terisolasi tanpa emulator fisik disebut?',
                'options' => ['Unit Test', 'Widget Test', 'Integration Test', 'Stress Test'],
                'ans' => 1,
                'exp' => 'Widget Test menguji komponen UI secara terisolasi dengan kecepatan tinggi menggunakan WidgetTester.'
            ],
            [
                'q' => 'Nama rendering engine grafis generasi baru di Flutter 3.x yang membasmi shader compilation jank adalah?',
                'options' => ['Impeller', 'Skia', 'VulkanCore', 'DirectFlutter'],
                'ans' => 0,
                'exp' => 'Impeller adalah mesin rendering grafis generasi terbaru di Flutter yang menggantikan Skia.'
            ],
            [
                'q' => 'Format biner rilis apakah yang diwajibkan oleh Google Play Store saat mempublikasikan aplikasi Android produksi?',
                'options' => ['APK Debug', 'AAB (Android App Bundle)', 'JAR', 'DEX'],
                'ans' => 1,
                'exp' => 'Google Play mewajibkan format Android App Bundle (AAB) untuk pengiriman unduhan aplikasi teroptimasi.'
            ],
            [
                'q' => 'Arsitektur apakah yang memungkinkan modul Flutter ditanamkan ke dalam aplikasi native Android/iOS yang sudah ada di perusahaan?',
                'options' => ['Add-to-App', 'Flutter Plugin', 'Hybrid Webview', 'Micro-Frontend'],
                'ans' => 0,
                'exp' => 'Add-to-App adalah fitur resmi untuk menanamkan modul Flutter ke dalam host native app yang telah berjalan.'
            ],
            [
                'q' => 'Pohon manakah pada arsitektur internal Flutter yang bertanggung jawab langsung menghitung tata letak geometris dan menggambar piksel ke layar?',
                'options' => ['Widget Tree', 'Element Tree', 'RenderObject Tree', 'State Tree'],
                'ans' => 2,
                'exp' => 'RenderObject Tree bertugas menghitung ukuran dan menggambar piksel langsung ke GPU perangkat.'
            ]
        ]
    ],
];
