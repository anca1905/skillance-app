<?php
// Skillance Academy - Data Materi Tutorial Berstandar W3Schools

$tutorials = [
    'html' => [
        'name' => 'HTML Tutorial',
        'short_name' => 'HTML',
        'badge' => 'Pemula',
        'icon' => 'fa-brands fa-html5',
        'color' => '#e34f26',
        'desc' => 'HTML adalah bahasa standar untuk membuat dan menstrukturkan halaman web.',
        'topics' => [
            'intro' => [
                'title' => 'HTML Pengenalan (Introduction)',
                'summary' => 'Pelajari apa itu HTML, bagaimana cara kerjanya, dan bagaimana browser membaca dokumen HTML.',
                'content' => '
                    <p class="lead">HTML adalah singkatan dari <strong>Hyper Text Markup Language</strong>. HTML adalah bahasa markah standar yang digunakan untuk membuat dan menyusun struktur halaman web.</p>
                    
                    <div class="card bg-light border-0 p-3 mb-4 rounded-3">
                        <h6 class="fw-bold text-navy"><i class="fa-solid fa-circle-info text-primary me-2"></i>Poin Penting tentang HTML:</h6>
                        <ul class="mb-0 ps-3">
                            <li>HTML menggambarkan struktur halaman web menggunakan elemen-elemen atau <em>tags</em>.</li>
                            <li>Elemen HTML memberi tahu browser web bagaimana cara menampilkan konten (seperti judul, paragraf, gambar, atau tautan).</li>
                            <li>HTML bukan bahasa pemrograman logika, melainkan bahasa markah (markup language) yang menyusun kerangka visual web.</li>
                        </ul>
                    </div>

                    <h4>Struktur Dokumen HTML Sederhana</h4>
                    <p>Setiap dokumen HTML memiliki kerangka dasar yang terdiri dari deklarasi tipe dokumen, elemen html, bagian head, dan bagian body.</p>
                ',
                'example_title' => 'Contoh Dokumen HTML Dasar',
                'example_code' => '<!DOCTYPE html>
<html>
<head>
    <title>Judul Halaman Saya</title>
</head>
<body>

    <h1>Judul Utama Website</h1>
    <p>Ini adalah paragraf pertama saya di Skillance Academy.</p>
    <button onclick="alert(\'Halo dari HTML!\')">Klik Tombol</button>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Penjelasan Kode di Atas:</h5>
                    <ul class="ps-3">
                        <li><code>&lt;!DOCTYPE html&gt;</code> : Mendeklarasikan bahwa dokumen ini mengikuti standar dokumen HTML5 terkini.</li>
                        <li><code>&lt;html&gt;</code> : Elemen akar (root) dari seluruh halaman HTML.</li>
                        <li><code>&lt;head&gt;</code> : Berisi informasi meta, judul dokumen, dan link ke berkas CSS/font. Konten di dalam head tidak ditampilkan langsung di halaman.</li>
                        <li><code>&lt;title&gt;</code> : Menentukan judul halaman yang tampil di tab browser.</li>
                        <li><code>&lt;body&gt;</code> : Bagian tubuh dokumen tempat seluruh konten yang terlihat oleh pengguna diletakkan (teks, gambar, tombol, dll).</li>
                        <li><code>&lt;h1&gt;</code> : Menentukan judul utama (heading tingkat pertama).</li>
                        <li><code>&lt;p&gt;</code> : Menentukan blok paragraf teks.</li>
                    </ul>
                ',
                'quiz' => [
                    'q' => 'Apakah kepanjangan dari singkatan HTML?',
                    'options' => [
                        'Hyper Text Markup Language',
                        'High Tech Modern Language',
                        'Hyperlink and Text Management Language',
                        'Home Tool Markup Language'
                    ],
                    'answer' => 0,
                    'explanation' => 'HTML merupakan singkatan dari Hyper Text Markup Language.'
                ]
            ],
            'basic' => [
                'title' => 'HTML Dokumen Dasar (Basic Examples)',
                'summary' => 'Contoh-contoh komponen dasar HTML yang paling sering digunakan dalam pembuatan website.',
                'content' => '
                    <p class="lead">Dalam topik ini, kita akan melihat contoh-contoh elemen HTML yang paling fundamental: Headings, Paragraf, Tautan (Links), Gambar (Images), dan Tombol (Buttons).</p>

                    <h4>1. HTML Headings (Judul)</h4>
                    <p>Judul HTML didefinisikan dengan tag <code>&lt;h1&gt;</code> sampai <code>&lt;h6&gt;</code>. <code>&lt;h1&gt;</code> mendefinisikan judul yang paling penting/utama, sedangkan <code>&lt;h6&gt;</code> mendefinisikan sub-judul terkecil.</p>

                    <h4>2. HTML Paragraphs (Paragraf)</h4>
                    <p>Paragraf teks didefinisikan dengan tag <code>&lt;p&gt;</code>. Browser secara otomatis menambahkan margin kosong di atas dan di bawah setiap paragraf.</p>

                    <h4>3. HTML Links (Tautan)</h4>
                    <p>Tautan web didefinisikan dengan tag <code>&lt;a&gt;</code>. Alamat tujuan tautan ditentukan melalui atribut <code>href</code>.</p>
                ',
                'example_title' => 'Contoh Komponen Dasar HTML',
                'example_code' => '<!DOCTYPE html>
<html>
<body>

    <h1>Judul Tingkat 1 (Paling Besar)</h1>
    <h2>Judul Tingkat 2</h2>
    <h3>Judul Tingkat 3</h3>

    <p>Ini adalah teks paragraf. Anda dapat membaca informasi lebih lanjut pada tautan di bawah ini.</p>

    <a href="https://skillance.my.id" target="_blank">Kunjungi Website Utama Skillance</a>

    <hr>
    <button onclick="this.innerText=\'Tombol Ditekan!\'">Tombol Interaktif</button>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Catatan Praktis:</h5>
                    <p>Tag <code>&lt;hr&gt;</code> digunakan untuk membuat garis horizontal pemisah antar konten. Atribut <code>target="_blank"</code> pada tag <code>&lt;a&gt;</code> membuat halaman tujuan terbuka di tab browser baru.</p>
                ',
                'quiz' => [
                    'q' => 'Tag HTML manakah yang menghasilkan judul (heading) dengan ukuran paling besar dan paling penting?',
                    'options' => ['<heading>', '<h6>', '<h1>', '<head>'],
                    'answer' => 2,
                    'explanation' => 'Tag <h1> adalah heading tingkat pertama yang paling besar dan paling diutamakan oleh mesin pencari.'
                ]
            ],
            'elements' => [
                'title' => 'HTML Elemen & Tag (Elements)',
                'summary' => 'Memahami anatomi sebuah elemen HTML: Tag pembuka, konten, dan tag penutup.',
                'content' => '
                    <p class="lead">Elemen HTML didefinisikan oleh tag pembuka (start tag), beberapa konten di dalamnya, dan tag penutup (end tag).</p>

                    <div class="p-3 bg-light rounded-3 mb-3 font-monospace small">
                        &lt;tagname&gt; Konten yang ditampilkan di browser... &lt;/tagname&gt;
                    </div>

                    <p>Sebagian besar elemen HTML memiliki tag penutup dengan garis miring (<code>/</code>), contohnya <code>&lt;p&gt;Halo&lt;/p&gt;</code>. Namun, ada elemen khusus yang disebut <strong>Empty Elements</strong> yang tidak memiliki konten dan tidak membutuhkan tag penutup, seperti <code>&lt;br&gt;</code> (pindah baris) dan <code>&lt;hr&gt;</code> (garis horizontal).</p>
                ',
                'example_title' => 'Contoh Elemen Bersarang (Nested Elements)',
                'example_code' => '<!DOCTYPE html>
<html>
<body>

    <div>
        <h2>Elemen di Dalam Kontainer (Div)</h2>
        <p>Teks ini berada di dalam sebuah elemen paragraf. Di dalamnya ada teks <strong>tebal (bold)</strong> dan teks <em>miring (italic)</em>.</p>
        <p>Baris pertama.<br>Baris kedua setelah tag break.</p>
    </div>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Penting untuk Pemula:</h5>
                    <p>Jangan pernah melupakan tag penutup. Meskipun beberapa browser tetap dapat menampilkan halaman saat tag penutup terlewat, hal tersebut dapat merusak tata letak dan validitas halaman web Anda.</p>
                ',
                'quiz' => [
                    'q' => 'Manakah di bawah ini yang merupakan contoh Empty Element (elemen tanpa tag penutup)?',
                    'options' => ['<p>', '<br>', '<div>', '<h1>'],
                    'answer' => 1,
                    'explanation' => 'Tag <br> (break) adalah elemen kosong yang tidak membungkus teks konten sehingga tidak memerlukan tag penutup </br>.'
                ]
            ],
            'attributes' => [
                'title' => 'HTML Atribut (Attributes)',
                'summary' => 'Memberikan informasi atau instruksi tambahan pada elemen HTML seperti link, gambar, dan styling.',
                'content' => '
                    <p class="lead">Semua elemen HTML dapat memiliki <strong>atribut</strong>. Atribut memberikan informasi tambahan tentang elemen tersebut dan selalu ditentukan pada tag pembuka (start tag).</p>

                    <p>Atribut biasanya ditulis dalam pasangan nama dan nilai: <code>nama="nilai"</code>.</p>

                    <h4>Atribut Penting yang Wajib Diketahui:</h4>
                    <ul>
                        <li><code>href</code> : Menentukan URL alamat tujuan untuk tag <code>&lt;a&gt;</code>.</li>
                        <li><code>src</code> : Menentukan path lokasi gambar untuk tag <code>&lt;img&gt;</code>.</li>
                        <li><code>alt</code> : Teks alternatif untuk gambar jika gambar gagal dimuat (sangat penting untuk aksesibilitas & SEO).</li>
                        <li><code>style</code> : Menambahkan gaya CSS langsung (inline) ke elemen.</li>
                        <li><code>class</code> & <code>id</code> : Memberikan tanda pengenal unik atau kelompok elemen untuk ditata via CSS atau dimanipulasi dengan JavaScript.</li>
                    </ul>
                ',
                'example_title' => 'Contoh Penggunaan Atribut HTML',
                'example_code' => '<!DOCTYPE html>
<html>
<body>

    <h2>Contoh Atribut Gambar & Tautan</h2>

    <!-- Gambar dengan atribut src, alt, width, dan height -->
    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=300" 
         alt="Laptop Programmer Skillance" 
         width="280" 
         style="border-radius: 12px; border: 2px solid #fca311;">

    <p>Foto di atas menggunakan atribut <code>src</code>, <code>alt</code>, dan <code>style</code>.</p>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Rekomendasi W3C:</h5>
                    <p>Selalu gunakan huruf kecil untuk nama atribut dan selalu bungkus nilai atribut dengan tanda kutip ganda (<code>"..."</code>).</p>
                ',
                'quiz' => [
                    'q' => 'Atribut apa yang wajib disertakan pada tag <img> untuk menampilkan deskripsi teks jika gambar gagal dimuat atau bagi pembaca layar tuna netra?',
                    'options' => ['title', 'alt', 'desc', 'caption'],
                    'answer' => 1,
                    'explanation' => 'Atribut alt (alternative text) adalah standar wajib W3C untuk menyediakan teks pengganti gambar.'
                ]
            ],
            'forms' => [
                'title' => 'HTML Formulir & Input (Forms)',
                'summary' => 'Membangun formulir interaktif untuk mengumpulkan data input dari pengguna.',
                'content' => '
                    <p class="lead">Formulir HTML digunakan untuk mengumpulkan input dari pengguna. Data input tersebut umumnya dikirimkan ke server untuk diproses (misalnya untuk pendaftaran, login, pencarian, dll).</p>

                    <p>Elemen <code>&lt;form&gt;</code> membungkus berbagai kontrol input seperti bidang teks (text field), kotak centang (checkbox), tombol radio (radio button), pemilih tanggal, dan tombol submit.</p>
                ',
                'example_title' => 'Contoh Formulir Pendaftaran',
                'example_code' => '<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f8fafc; }
        .form-box { background: white; padding: 20px; border-radius: 8px; max-width: 320px; border: 1px solid #e2e8f0; }
        .input-group { margin-bottom: 12px; }
        label { display: block; font-weight: bold; margin-bottom: 4px; font-size: 0.85rem; }
        input[type="text"], input[type="email"] { width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 4px; box-sizing: border-box; }
        button { background: #0d2e5c; color: white; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer; width: 100%; font-weight: bold; }
    </style>
</head>
<body>

    <div class="form-box">
        <h3 style="margin-top:0; color:#0d2e5c;">Formulir Siswa</h3>
        <form onsubmit="event.preventDefault(); alert(\'Nama: \' + document.getElementById(\'nama\').value);">
            <div class="input-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" required placeholder="Contoh: Budi Santoso">
            </div>
            <div class="input-group">
                <label for="email">Alamat Email:</label>
                <input type="email" id="email" required placeholder="budi@gmail.com">
            </div>
            <button type="submit">Kirim Data »</button>
        </form>
    </div>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Komponen Kunci Formulir:</h5>
                    <ul class="ps-3">
                        <li><code>&lt;label for="id"&gt;</code> : Menghubungkan label teks dengan elemen input agar saat teks label diklik, kursor otomatis masuk ke kotak input.</li>
                        <li><code>type="email"</code> : Otomatis memvalidasi apakah pengguna memasukkan format email yang valid (mengandung @).</li>
                        <li><code>required</code> : Mencegah pengiriman form jika bidang input masih kosong.</li>
                    </ul>
                ',
                'quiz' => [
                    'q' => 'Tipe input apa yang digunakan untuk membuat kolom input yang menyembunyikan karakter huruf (menampilkan tanda titik atau bintang)?',
                    'options' => ['type="hidden"', 'type="password"', 'type="secret"', 'type="mask"'],
                    'answer' => 1,
                    'explanation' => 'Input dengan type="password" secara otomatis menyamarkan karakter yang diketikkan pengguna untuk keamanan.'
                ]
            ],
            'semantic' => [
                'title' => 'HTML5 Elemen Semantik (Semantic Elements)',
                'summary' => 'Menggunakan tag semantik modern untuk meningkatkan struktur, SEO, dan aksesibilitas website.',
                'content' => '
                    <p class="lead">Elemen semantik adalah elemen yang memiliki arti jelas baik bagi browser maupun pengembang web (developer).</p>

                    <p>Contoh elemen <strong>non-semantik</strong>: <code>&lt;div&gt;</code> dan <code>&lt;span&gt;</code> (tidak memberitahukan apa pun tentang jenis konten di dalamnya).<br>
                    Contoh elemen <strong>semantik</strong>: <code>&lt;header&gt;</code>, <code>&lt;nav&gt;</code>, <code>&lt;main&gt;</code>, <code>&lt;article&gt;</code>, <code>&lt;section&gt;</code>, dan <code>&lt;footer&gt;</code>.</p>
                ',
                'example_title' => 'Tata Letak Halaman Web Semantik',
                'example_code' => '<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; margin: 0; background: #f1f5f9; text-align: center; }
        header { background: #0d2e5c; color: white; padding: 15px; }
        nav { background: #1e3a8a; padding: 10px; }
        nav a { color: #fca311; text-decoration: none; margin: 0 10px; font-weight: bold; }
        main { padding: 20px; background: white; margin: 15px auto; max-width: 500px; border-radius: 8px; }
        footer { background: #0f172a; color: #94a3b8; padding: 15px; font-size: 0.8rem; }
    </style>
</head>
<body>

    <header>
        <h2>Skillance Academy</h2>
    </header>

    <nav>
        <a href="#">Beranda</a>
        <a href="#">Materi HTML</a>
        <a href="#">Bursa Freelance</a>
    </nav>

    <main>
        <h3>Konten Inti Halaman</h3>
        <p>Elemen &lt;main&gt; menandai konten unik halaman ini.</p>
    </main>

    <footer>
        &copy; 2026 Skillance Academy Indonesia
    </footer>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Mengapa Harus Menggunakan Elemen Semantik?</h5>
                    <ol class="ps-3">
                        <li><strong>SEO (Search Engine Optimization)</strong>: Google bot dapat dengan mudah membedakan mana navigasi, mana konten inti, dan mana footer.</li>
                        <li><strong>Aksesibilitas</strong>: Pembaca layar bagi penyandang tunanetra dapat langsung melompat ke bagian &lt;main&gt; tanpa harus membaca ulang navigasi berulang-ulang.</li>
                        <li><strong>Kemudahan Pemeliharaan</strong>: Kode jauh lebih rapi dan mudah dibaca oleh tim developer.</li>
                    </ol>
                ',
                'quiz' => [
                    'q' => 'Elemen HTML5 semantik manakah yang digunakan untuk membungkus sekumpulan link navigasi utama sebuah website?',
                    'options' => ['<menu>', '<navigate>', '<nav>', '<links>'],
                    'answer' => 2,
                    'explanation' => 'Tag <nav> secara khusus ditujukan untuk bagian halaman yang berisi tautan navigasi utama.'
                ]
            ]
        ]
    ],
    'css' => [
        'name' => 'CSS Tutorial',
        'short_name' => 'CSS',
        'badge' => 'Pemula ke Menengah',
        'icon' => 'fa-brands fa-css3-alt',
        'color' => '#264de4',
        'desc' => 'CSS adalah bahasa yang digunakan untuk menata tampilan, warna, tipografi, dan tata letak halaman web.',
        'topics' => [
            'intro' => [
                'title' => 'CSS Pengenalan (Introduction)',
                'summary' => 'Pelajari apa itu CSS, fungsinya dalam mempercantik HTML, dan 3 cara menghubungkan CSS.',
                'content' => '
                    <p class="lead">CSS adalah singkatan dari <strong>Cascading Style Sheets</strong>. Jika HTML adalah kerangka tulang sebuah website, maka CSS adalah kulit, pakaian, dan warna yang membuatnya menarik dilihat.</p>

                    <h4>Tiga Cara Memasukkan CSS ke Dokumen HTML:</h4>
                    <ol class="ps-3">
                        <li><strong>External CSS</strong>: Ditulis di file terpisah (misal: <code>style.css</code>) dan dihubungkan via tag <code>&lt;link rel="stylesheet" href="style.css"&gt;</code> di dalam <code>&lt;head&gt;</code>. (Metode standar industri yang paling direkomendasikan).</li>
                        <li><strong>Internal CSS</strong>: Ditulis di dalam tag <code>&lt;style&gt;</code> pada bagian <code>&lt;head&gt;</code> dokumen HTML.</li>
                        <li><strong>Inline CSS</strong>: Ditulis langsung pada elemen HTML menggunakan atribut <code>style="..."</code>.</li>
                    </ol>
                ',
                'example_title' => 'Contoh Penulisan CSS Sederhana',
                'example_code' => '<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: #f8fafc;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        h1 {
            color: #0d2e5c;
        }
        p {
            color: #475569;
            font-size: 16px;
        }
        .btn-modern {
            background-color: #04AA6D;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h1>Selamat Datang di Belajar CSS</h1>
    <p>Halaman ini ditata dengan aturan gaya CSS modern.</p>
    <button class="btn-modern" onclick="alert(\'Tombol CSS Berfungsi!\')">Coba Tombol Ini</button>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Anatomi Aturan CSS (CSS Rule-set):</h5>
                    <p>Aturan CSS terdiri dari <strong>Selector</strong> (menunjuk elemen yang ingin ditata, misal <code>h1</code>) dan <strong>Declaration Block</strong> di dalam kurung kurawal <code>{ property: value; }</code>.</p>
                ',
                'quiz' => [
                    'q' => 'Di manakah tempat penulisan yang benar untuk menautkan stylesheet eksternal (External CSS) pada halaman HTML?',
                    'options' => ['Di dalam bagian <head>', 'Di dalam bagian <body>', 'Di akhir dokumen setelah </html>', 'Di dalam tag <p>'],
                    'answer' => 0,
                    'explanation' => 'Tag <link rel="stylesheet" ...> selalu diletakkan di dalam bagian <head> agar browser memuat gaya sebelum merender halaman.'
                ]
            ],
            'boxmodel' => [
                'title' => 'CSS Box Model',
                'summary' => 'Memahami bagaimana browser menghitung dimensi elemen: Margin, Border, Padding, dan Content.',
                'content' => '
                    <p class="lead">Semua elemen HTML dihitung oleh browser sebagai sebuah kotak. Dalam CSS, istilah <strong>Box Model</strong> digunakan saat berbicara tentang desain dan tata letak.</p>

                    <div class="card p-3 bg-light rounded-3 mb-3 text-center">
                        <div style="border: 2px dashed #94a3b8; padding: 15px; background:#f1f5f9;">
                            <strong>Margin</strong> (Ruang kosong di luar batas)
                            <div style="border: 2px solid #0d2e5c; padding: 15px; margin: 10px; background:#e0f2fe;">
                                <strong>Border</strong> (Garis tepi)
                                <div style="border: 2px dashed #0284c7; padding: 15px; margin: 10px; background:#f0fdf4;">
                                    <strong>Padding</strong> (Ruang antara konten dan batas)
                                    <div style="background:#ffffff; padding:10px; border:1px solid #16a34a;">
                                        <strong>Content</strong> (Teks atau Gambar Anda)
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p>Aturan <code>box-sizing: border-box;</code> sangat penting agar padding dan border tidak menambah ukuran total lebar elemen!</p>
                ',
                'example_title' => 'Penerapan CSS Box Model',
                'example_code' => '<!DOCTYPE html>
<html>
<head>
    <style>
        * { box-sizing: border-box; }
        body { font-family: sans-serif; padding: 20px; background: #faf5ff; }
        .kotak {
            background-color: white;
            width: 300px;
            padding: 25px;
            border: 4px solid #7c3aed;
            margin: 20px auto;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.15);
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="kotak">
        <h3 style="color:#6d28d9; margin-top:0;">Kotak Berisi Padding</h3>
        <p>Kotak ini memiliki <code>padding: 25px</code> dan <code>border: 4px</code>. Karena ada <code>box-sizing: border-box</code>, lebarnya tetap tepat 300px!</p>
    </div>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Perbedaan Padding vs Margin:</h5>
                    <ul class="ps-3">
                        <li><strong>Padding</strong>: Ruang di <em>dalam</em> kotak (antara teks dan garis border). Jika Anda memberi warna background, warna itu akan mewarnai area padding.</li>
                        <li><strong>Margin</strong>: Ruang di <em>luar</em> kotak (membuat jarak antar kotak yang satu dengan kotak lainnya). Margin selalu transparan.</li>
                    </ul>
                ',
                'quiz' => [
                    'q' => 'Properti CSS apa yang digunakan untuk membuat jarak ruang kosong di sebelah LUAR dari garis tepi (border) suatu elemen?',
                    'options' => ['padding', 'margin', 'spacing', 'outline'],
                    'answer' => 1,
                    'explanation' => 'Margin mengatur ruang kosong di luar border elemen, sedangkan padding mengatur ruang di dalam border.'
                ]
            ],
            'flexbox' => [
                'title' => 'CSS Flexbox (Tata Letak Responsif)',
                'summary' => 'Membuat tata letak kartu, navigasi, dan perataan elemen secara fleksibel tanpa float.',
                'content' => '
                    <p class="lead">CSS Flexbox (Flexible Box Layout) dirancang untuk mempermudah penataan elemen dalam satu dimensi (baris atau kolom), bahkan ketika ukuran layarnya berbeda-beda.</p>

                    <h4>Properti Penting Flexbox:</h4>
                    <ul>
                        <li><code>display: flex;</code> : Mengaktifkan mode flex pada kontainer induk.</li>
                        <li><code>justify-content</code> : Mengatur posisi elemen anak pada sumbu horizontal (center, space-between, space-around, flex-start, flex-end).</li>
                        <li><code>align-items</code> : Mengatur perataan vertikal elemen anak (center, stretch, flex-start, flex-end).</li>
                        <li><code>gap</code> : Memberikan jarak pemisah antar elemen anak secara otomatis.</li>
                    </ul>
                ',
                'example_title' => 'Contoh Kartu Responsif dengan Flexbox',
                'example_code' => '<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f8fafc; }
        .flex-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        .card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 20px;
            width: 140px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
            border-color: #04AA6D;
        }
    </style>
</head>
<body>

    <h3 style="text-align:center; color:#0d2e5c;">Jalur Belajar Skillance</h3>
    <div class="flex-container">
        <div class="card"><div style="font-size:28px;">💻</div><strong>Web Dev</strong></div>
        <div class="card"><div style="font-size:28px;">⚙️</div><strong>Backend</strong></div>
        <div class="card"><div style="font-size:28px;">📱</div><strong>Flutter</strong></div>
        <div class="card"><div style="font-size:28px;">🎨</div><strong>UI/UX</strong></div>
    </div>

</body>
</html>',
                'explanation' => '
                    <h5 class="fw-bold mt-3">Keunggulan Flexbox:</h5>
                    <p>Dengan <code>flex-wrap: wrap;</code>, jika layar smartphone terlalu sempit, kartu-kartu tersebut secara otomatis turun ke baris berikutnya secara rapi tanpa merusak tata letak.</p>
                ',
                'quiz' => [
                    'q' => 'Properti Flexbox manakah yang digunakan untuk memusatkan elemen anak secara horizontal pada sumbu utama?',
                    'options' => ['align-items: center;', 'justify-content: center;', 'text-align: center;', 'flex-center: true;'],
                    'answer' => 1,
                    'explanation' => 'justify-content mengatur perataan pada sumbu utama (main axis / horizontal secara default).'
                ]
            ]
        ]
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
