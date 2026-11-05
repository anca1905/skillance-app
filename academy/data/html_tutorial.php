<?php
// Data Silabus Lengkap HTML W3Schools untuk Skillance Academy

return [
    'categories' => [
        'HTML Tutorial' => [
            'html_home' => [
                'title' => 'HTML HOME',
                'summary' => 'Selamat Datang di Tutorial HTML Skillance Academy. HTML adalah bahasa markah standar untuk membuat halaman web.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Selamat datang di <strong>Tutorial HTML Lengkap</strong> Skillance Academy berstandar W3Schools. HTML adalah bahasa markah standar yang digunakan oleh seluruh website di dunia.</p>
        <p>Dengan HTML, Anda dapat membuat website Anda sendiri dari nol. Tutorial ini dirancang sangat mudah dipahami baik untuk mahasiswa, pemula, maupun masyarakat umum yang ingin terjun ke industri teknologi.</p>
        <div class="card bg-light border-0 p-3 mb-4 rounded-3">
            <h6 class="fw-bold text-navy mb-2"><i class="fa-solid fa-graduation-cap text-gold me-2"></i>Mengapa Belajar HTML di Sini?</h6>
            <ul class="mb-0 ps-3 small" style="line-height: 1.8;">
                <li>Ratusan contoh kode praktis yang dapat langsung dicoba di browser via <strong>Try it Yourself</strong>.</li>
                <li>Uraian terstruktur dari tingkat dasar, formulir, grafis, multimedia, hingga Web API modern.</li>
                <li>Tersinkronisasi dengan akun belajar Anda untuk mencatat progres pembelajaran.</li>
            </ul>
        </div>
HTML_CONTENT,
                'example_title' => 'Contoh Halaman HTML Pertama Anda',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <title>Halaman HTML Pertama</title>
</head>
<body>

    <h1>Selamat Datang di Skillance Academy!</h1>
    <p>Ini adalah halaman web pertama yang saya buat dengan HTML.</p>
    <button onclick="alert(\'Selamat! Anda berhasil mencoba kode HTML.\')">Klik Saya »</button>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Klik tombol <strong>Coba Sendiri (Try it Yourself) &raquo;</strong> di atas untuk melihat bagaimana kode di atas dirender langsung oleh browser!</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Apakah HTML termasuk bahasa pemrograman logika atau bahasa markah (markup)?',
                    'options' => ['Bahasa Pemrograman Logika', 'Bahasa Markah (Markup Language)', 'Bahasa Database', 'Bahasa Kompiler Mesin'],
                    'answer' => 1,
                    'explanation' => 'HTML adalah singkatan dari HyperText Markup Language, yaitu bahasa markah yang menyusun struktur dokumen web.'
                ],
            ],
            'html_intro' => [
                'title' => 'HTML Introduction',
                'summary' => 'Pengenalan apa itu HTML, fungsi tag, dan bagaimana browser membaca dokumen HTML.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">HTML adalah singkatan dari <strong>Hyper Text Markup Language</strong>. HTML menggambarkan struktur halaman web menggunakan elemen-elemen atau <em>tags</em>.</p>
        <h4>Apa itu Elemen HTML?</h4>
        <p>Elemen HTML memberi tahu browser web bagaimana cara menampilkan konten. Elemen menandai bagian konten seperti "ini adalah judul", "ini adalah paragraf", "ini adalah tautan", dan lain sebagainya.</p>
        <div class="p-3 bg-light rounded-3 mb-3 font-monospace small">
            &lt;tagname&gt; Konten yang tampil di halaman... &lt;/tagname&gt;
        </div>
HTML_CONTENT,
                'example_title' => 'Contoh Anatomi Dokumen HTML5',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <title>Pengenalan HTML</title>
</head>
<body>

    <h1>Judul Tingkat Pertama</h1>
    <p>Paragraf penjelasan tentang HTML.</p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<ul class="ps-3"><li><code>&lt;!DOCTYPE html&gt;</code> mendefinisikan bahwa dokumen ini bertipe HTML5.</li><li><code>&lt;html&gt;</code> adalah elemen root dari halaman HTML.</li><li><code>&lt;head&gt;</code> berisi meta informasi tentang dokumen.</li><li><code>&lt;body&gt;</code> berisi konten yang terlihat oleh pengunjung.</li></ul>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag HTML manakah yang membungkus seluruh konten visual yang dilihat oleh pengunjung web?',
                    'options' => ['<head>', '<title>', '<body>', '<meta>'],
                    'answer' => 2,
                    'explanation' => 'Seluruh elemen visual seperti teks, gambar, video, dan tombol diletakkan di dalam tag <body>.'
                ],
            ],
            'html_editors' => [
                'title' => 'HTML Editors',
                'summary' => 'Alat editor teks untuk menulis kode HTML seperti Notepad, VS Code, dan Skillance Tryit Editor.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Halaman web HTML dapat dibuat dan dimodifikasi menggunakan text editor profesional seperti <strong>Visual Studio Code (VS Code)</strong>, Sublime Text, atau bahkan editor teks sederhana seperti Notepad (Windows) / TextEdit (Mac).</p>
        <h4>4 Langkah Menulis HTML di Komputer Anda:</h4>
        <ol class="ps-3" style="line-height: 1.8;">
            <li><strong>Langkah 1:</strong> Buka editor teks (misal: Notepad atau VS Code).</li>
            <li><strong>Langkah 2:</strong> Ketikkan struktur kode HTML dasar.</li>
            <li><strong>Langkah 3:</strong> Simpan berkas dengan ekstensi <code>.html</code> (misal: <code>index.html</code>) dengan encoding <strong>UTF-8</strong>.</li>
            <li><strong>Langkah 4:</strong> Klik dua kali berkas tersebut untuk membukanya di browser (Chrome, Edge, Firefox).</li>
        </ol>
HTML_CONTENT,
                'example_title' => 'Contoh Berkas index.html',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editor HTML Saya</title>
</head>
<body>
    <h2>Dibuat dengan Text Editor</h2>
    <p>Simpan kode ini sebagai <strong>index.html</strong> di komputer Anda.</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Gunakan selalu encoding UTF-8 saat menyimpan file HTML agar karakter khusus dan emoji dapat dibaca dengan benar.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Ekstensi berkas apa yang digunakan untuk menyimpan dokumen halaman web HTML?',
                    'options' => ['.doc', '.html atau .htm', '.txt', '.web'],
                    'answer' => 1,
                    'explanation' => 'Dokumen web disimpan dengan ekstensi .html atau .htm agar browser mengenalinya sebagai halaman web.'
                ],
            ],
            'html_basic' => [
                'title' => 'HTML Basic',
                'summary' => 'Komponen-komponen dasar HTML: Headings, Paragraf, Tautan, Gambar, dan Tombol.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Jangan khawatir jika contoh-contoh ini menggunakan tag yang belum Anda pelajari secara mendalam. Anda akan mempelajarinya di bab-bab selanjutnya.</p>
        <p>Dalam HTML, seluruh dokumen dibangun dari blok-blok dasar:</p>
        <ul>
            <li><strong>Headings:</strong> Didefinisikan dengan tag <code>&lt;h1&gt;</code> sampai <code>&lt;h6&gt;</code>.</li>
            <li><strong>Paragraf:</strong> Didefinisikan dengan tag <code>&lt;p&gt;</code>.</li>
            <li><strong>Tautan (Links):</strong> Didefinisikan dengan tag <code>&lt;a&gt;</code>.</li>
            <li><strong>Gambar (Images):</strong> Didefinisikan dengan tag <code>&lt;img&gt;</code>.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Elemen-Elemen Dasar HTML',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h1>Judul Halaman (H1)</h1>
    <p>Ini adalah teks paragraf biasa.</p>

    <a href="https://skillance.my.id" target="_blank">Kunjungi Website Skillance</a>
    <br><br>

    <button onclick="alert(\'Tombol dasar ditekan!\')">Tombol HTML</button>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Tautan web menggunakan atribut <code>href</code> untuk menentukan URL tujuan.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag apa yang digunakan untuk membuat tautan (hyperlink) ke halaman lain?',
                    'options' => ['<link>', '<a>', '<href>', '<url>'],
                    'answer' => 1,
                    'explanation' => 'Tag <a> (anchor) digunakan untuk membuat tautan dengan atribut href.'
                ],
            ],
            'html_elements' => [
                'title' => 'HTML Elements',
                'summary' => 'Anatomi elemen HTML: tag pembuka, isi konten, tag penutup, elemen bersarang, dan tag kosong.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Elemen HTML adalah segala sesuatu mulai dari tag pembuka hingga tag penutup.</p>
        <table class="table table-bordered table-sm my-3 small">
            <thead class="table-light"><tr><th>Start tag</th><th>Element content</th><th>End tag</th></tr></thead>
            <tbody>
                <tr><td><code>&lt;h1&gt;</code></td><td>Judul Utama Saya</td><td><code>&lt;/h1&gt;</code></td></tr>
                <tr><td><code>&lt;p&gt;</code></td><td>Paragraf pertama saya</td><td><code>&lt;/p&gt;</code></td></tr>
                <tr><td><code>&lt;br&gt;</code></td><td><em>tidak ada</em></td><td><em>tidak ada</em></td></tr>
            </tbody>
        </table>
        <h4>Elemen Kosong (Empty Elements)</h4>
        <p>Elemen HTML yang tidak memiliki konten disebut elemen kosong, contohnya <code>&lt;br&gt;</code> yang berfungsi membuat baris baru (line break).</p>
HTML_CONTENT,
                'example_title' => 'Contoh Elemen Bersarang (Nested Elements)',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <div>
        <h3>Elemen di dalam Div</h3>
        <p>Di dalam paragraf ada teks <strong>tebal</strong> dan <em>miring</em>.</p>
    </div>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Elemen dapat bersarang (elemen di dalam elemen lain). Selalu pastikan tag ditutup dengan urutan yang benar.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Apakah elemen <br> memerlukan tag penutup </br>?',
                    'options' => ['Ya, wajib', 'Tidak, karena merupakan Empty Element', 'Tergantung browser', 'Hanya jika di dalam tabel'],
                    'answer' => 1,
                    'explanation' => 'Tag <br> adalah Empty Element yang tidak memiliki konten sehingga tidak memerlukan tag penutup.'
                ],
            ],
            'html_attributes' => [
                'title' => 'HTML Attributes',
                'summary' => 'Atribut memberikan informasi tambahan pada elemen HTML (href, src, alt, width, height, style, id, class).',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Semua elemen HTML dapat memiliki <strong>atribut</strong>. Atribut memberikan informasi tambahan tentang elemen tersebut dan selalu ditentukan pada <em>start tag</em>.</p>
        <h4>Atribut yang Paling Sering Digunakan:</h4>
        <ul style="line-height: 1.8;">
            <li><code>href</code> : Menentukan URL alamat tujuan tautan pada tag <code>&lt;a&gt;</code>.</li>
            <li><code>src</code> : Menentukan jalur sumber berkas gambar pada tag <code>&lt;img&gt;</code>.</li>
            <li><code>width</code> & <code>height</code> : Menentukan ukuran lebar dan tinggi gambar dalam piksel.</li>
            <li><code>alt</code> : Teks alternatif untuk gambar jika gagal dimuat (sangat penting untuk aksesibilitas & SEO).</li>
            <li><code>style</code> : Menambahkan gaya CSS secara langsung ke elemen.</li>
            <li><code>lang</code> : Menentukan bahasa halaman pada tag <code>&lt;html lang="id"&gt;</code>.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Penggunaan Atribut HTML',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html lang="id">
<body>

    <h2>Contoh Atribut Gambar</h2>
    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=300" 
         alt="Laptop Programmer Skillance" 
         width="260" 
         height="170" 
         style="border-radius:10px; border: 2px solid #04AA6D;">

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Standar W3C sangat merekomendasikan penggunaan huruf kecil untuk nama atribut dan tanda kutip ganda untuk nilainya.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Atribut apa yang wajib ada pada tag <img> untuk memberikan teks deskripsi jika gambar gagal dimuat?',
                    'options' => ['title', 'alt', 'name', 'src'],
                    'answer' => 1,
                    'explanation' => 'Atribut alt (alternate text) wajib disertakan untuk aksesibilitas pembaca layar dan SEO gambar.'
                ],
            ],
            'html_headings' => [
                'title' => 'HTML Headings',
                'summary' => 'Tingkatan judul HTML dari h1 sampai h6, pentingnya heading untuk SEO dan hierarki dokumen.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Judul HTML adalah judul atau sub-judul yang ingin Anda tampilkan di halaman web. HTML menyediakan 6 tingkat heading: <code>&lt;h1&gt;</code> hingga <code>&lt;h6&gt;</code>.</p>
        <div class="alert alert-info py-2 small">
            <strong>Penting untuk SEO:</strong> Mesin pencari seperti Google menggunakan heading untuk mengindeks struktur dan konten halaman web Anda. Gunakan <code>&lt;h1&gt;</code> hanya satu kali per halaman untuk topik utama!
        </div>
HTML_CONTENT,
                'example_title' => 'Contoh 6 Tingkat Heading',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h1>Heading 1 (Utama)</h1>
    <h2>Heading 2</h2>
    <h3>Heading 3</h3>
    <h4>Heading 4</h4>
    <h5>Heading 5</h5>
    <h6>Heading 6 (Terkecil)</h6>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Setiap heading memiliki ukuran default browser, namun Anda dapat mengubah ukurannya menggunakan properti CSS <code>font-size</code>.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Berapa kali tag <h1> sebaiknya digunakan dalam satu halaman web untuk praktik SEO yang baik?',
                    'options' => ['Sebanyak mungkin', 'Tepat satu kali untuk judul utama', 'Minimal 6 kali', 'Tidak boleh digunakan'],
                    'answer' => 1,
                    'explanation' => 'Praktik terbaik SEO menyarankan menggunakan tepat satu tag <h1> sebagai judul utama halaman.'
                ],
            ],
            'html_paragraphs' => [
                'title' => 'HTML Paragraphs',
                'summary' => 'Membuat paragraf dengan tag p, pindah baris dengan br, garis pemisah dengan hr, dan teks terformat dengan pre.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Elemen <code>&lt;p&gt;</code> mendefinisikan sebuah paragraf. Browser secara otomatis menambahkan margin kosong (spasi) sebelum dan sesudah paragraf.</p>
        <h4>Tag Pendukung Paragraf:</h4>
        <ul>
            <li><code>&lt;hr&gt;</code> (Horizontal Rule): Membuat garis pemisah horizontal antar tema konten.</li>
            <li><code>&lt;br&gt;</code> (Line Break): Memaksa pindah ke baris baru tanpa memulai paragraf baru.</li>
            <li><code>&lt;pre&gt;</code> (Preformatted Text): Menampilkan teks apa adanya dengan spasi dan baris baru yang tetap dipertahankan.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Paragraf dan Preformatted Text',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <p>Ini adalah paragraf pertama.<br>Ini baris kedua di dalam paragraf yang sama.</p>
    <hr>
    <p>Ini adalah paragraf kedua setelah garis horizontal.</p>
    
    <pre>
    Teks di dalam tag pre
       mempertahankan spasi
       dan pindah baris.
    </pre>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Di dalam tag <code>&lt;p&gt;</code> biasa, browser akan memadatkan banyak spasi dan baris baru menjadi satu spasi saja. Gunakan <code>&lt;pre&gt;</code> jika ingin spasi tetap utuh.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag apa yang digunakan untuk menampilkan teks dengan spasi dan baris baru yang tetap dipertahankan seperti aslinya?',
                    'options' => ['<p>', '<pre>', '<text>', '<br>'],
                    'answer' => 1,
                    'explanation' => 'Tag <pre> (preformatted text) mempertahankan setiap spasi dan enter yang Anda ketikkan.'
                ],
            ],
            'html_styles' => [
                'title' => 'HTML Styles',
                'summary' => 'Mengatur warna teks, latar belakang, font, dan perataan teks menggunakan atribut style (Inline CSS).',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Atribut HTML <code>style</code> digunakan untuk menambahkan gaya CSS ke suatu elemen, seperti warna, font, ukuran, dan perataan teks.</p>
        <div class="p-3 bg-light rounded-3 font-monospace small mb-3">
            &lt;tagname style="property:value;"&gt;
        </div>
        <h4>Properti Gaya Umum:</h4>
        <ul>
            <li><code>background-color</code> : Mengatur warna latar belakang.</li>
            <li><code>color</code> : Mengatur warna teks.</li>
            <li><code>font-family</code> : Mengatur jenis font (misal: Arial, Courier, sans-serif).</li>
            <li><code>font-size</code> : Mengatur ukuran font (misal: 20px, 1.5rem, 150%).</li>
            <li><code>text-align</code> : Mengatur perataan teks (left, center, right, justify).</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Penggunaan Atribut Style',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body style="background-color: #f0fdf4;">

    <h1 style="color: #15803d; text-align: center;">Judul Berwarna Hijau</h1>
    <p style="color: #1e293b; font-family: Arial; font-size: 18px;">Paragraf dengan ukuran font 18px dan jenis huruf Arial.</p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Meskipun inline style mudah digunakan untuk contoh cepat, untuk website besar disarankan menggunakan file CSS eksternal.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Properti CSS apa yang digunakan untuk memusatkan teks ke tengah di dalam atribut style?',
                    'options' => ['align: center;', 'text-align: center;', 'center: true;', 'text-center: on;'],
                    'answer' => 1,
                    'explanation' => 'Properti \'text-align: center;\' digunakan untuk memusatkan teks.'
                ],
            ],
            'html_formatting' => [
                'title' => 'HTML Formatting',
                'summary' => 'Elemen pemformatan teks khusus: tebal, miring, stabilo, coret, subskrip, dan superskrip.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">HTML menyediakan elemen pemformatan khusus untuk menampilkan teks dengan makna dan tampilan tertentu tanpa memerlukan CSS tambahan.</p>
        <table class="table table-bordered table-sm small my-3">
            <thead class="table-light"><tr><th>Tag</th><th>Deskripsi</th></tr></thead>
            <tbody>
                <tr><td><code>&lt;b&gt;</code> & <code>&lt;strong&gt;</code></td><td>Teks tebal (strong memiliki arti semantik 'penting')</td></tr>
                <tr><td><code>&lt;i&gt;</code> & <code>&lt;em&gt;</code></td><td>Teks miring (em memiliki penekanan vokal)</td></tr>
                <tr><td><code>&lt;small&gt;</code></td><td>Teks ukuran lebih kecil (misal catatan kaki/hak cipta)</td></tr>
                <tr><td><code>&lt;mark&gt;</code></td><td>Teks dengan sorotan stabilo kuning (highlight)</td></tr>
                <tr><td><code>&lt;del&gt;</code> & <code>&lt;ins&gt;</code></td><td>Teks dicoret (dihapus) dan teks garis bawah (disisipkan)</td></tr>
                <tr><td><code>&lt;sub&gt;</code> & <code>&lt;sup&gt;</code></td><td>Teks subskrip (H<sub>2</sub>O) dan superskrip (x<sup>2</sup>)</td></tr>
            </tbody>
        </table>
HTML_CONTENT,
                'example_title' => 'Contoh Beragam Format Teks HTML',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <p>Ini teks <strong>sangat penting</strong> dan ini <em>ditekankan</em>.</p>
    <p>Harga lama: <del>Rp 100.000</del> Harga baru: <ins>Rp 75.000</ins>!</p>
    <p>Rumus air adalah H<sub>2</sub>O dan rumus matematika adalah X<sup>2</sup> + Y<sup>2</sup>.</p>
    <p>Kata ini diberi sorotan <mark>stabilo kuning</mark>.</p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Gunakan <code>&lt;strong&gt;</code> daripada <code>&lt;b&gt;</code> jika teks tersebut memiliki makna penting bagi pembaca dan mesin pencari.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag HTML apa yang digunakan untuk membuat efek teks stabilo kuning (highlight)?',
                    'options' => ['<highlight>', '<mark>', '<yellow>', '<color>'],
                    'answer' => 1,
                    'explanation' => 'Tag <mark> secara otomatis memberi latar belakang warna kuning pada teks.'
                ],
            ],
            'html_quotations' => [
                'title' => 'HTML Quotations',
                'summary' => 'Elemen kutipan teks: blockquote, q, abbr, address, cite, dan bdo.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">HTML memiliki beberapa elemen khusus untuk menandai bagian teks yang dikutip dari sumber lain atau informasi kontak.</p>
        <ul>
            <li><code>&lt;blockquote&gt;</code> : Menandai kutipan panjang dari sumber eksternal (browser otomatis memberi indentasi margin).</li>
            <li><code>&lt;q&gt;</code> : Menandai kutipan pendek di dalam kalimat (browser otomatis memberi tanda petik ganda).</li>
            <li><code>&lt;abbr&gt;</code> : Menandai singkatan / akronim. Atribut <code>title</code> menampilkan kepanjangan saat kursor diarahkan ke atasnya.</li>
            <li><code>&lt;address&gt;</code> : Menandai informasi kontak penulis / pemilik artikel (email, alamat, telepon).</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Tag Kutipan dan Singkatan',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <p>Kutipan pendek Albert Einstein: <q>Imajinasi lebih penting daripada pengetahuan.</q></p>

    <blockquote cite="https://skillance.my.id">
        Belajar koding praktis dari nol dengan kurikulum terstruktur dan latihan langsung di browser.
    </blockquote>

    <p>Pelajari teknologi di <abbr title="World Wide Web">WWW</abbr> hari ini.</p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Arahkan kursor Anda ke kata WWW pada contoh di atas untuk melihat tooltip kepanjangannya!</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Atribut apa yang digunakan pada tag <abbr> untuk menyimpan teks tooltip kepanjangan dari suatu singkatan?',
                    'options' => ['alt', 'title', 'tooltip', 'desc'],
                    'answer' => 1,
                    'explanation' => 'Atribut \'title\' pada tag <abbr> menampilkan teks tooltip saat kursor pengguna berada di atas singkatan tersebut.'
                ],
            ],
            'html_comments' => [
                'title' => 'HTML Comments',
                'summary' => 'Menulis catatan pengembang di kode sumber yang tidak tampil di browser dengan <!-- komentar -->.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Komentar HTML tidak ditampilkan oleh browser, tetapi sangat berguna untuk mendokumentasikan kode sumber Anda atau menonaktifkan kode sementara saat mencari bug.</p>
        <div class="p-3 bg-light rounded-3 font-monospace small mb-3">
            &lt;!-- Ini adalah komentar HTML --&gt;
        </div>
        <p>Anda dapat meletakkan komentar di mana saja di dalam dokumen HTML, baik satu baris maupun beberapa baris sekaligus.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Komentar HTML',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <!-- Ini adalah judul halaman utama -->
    <h2>Website Skillance Academy</h2>

    <p>Paragraf ini akan tampil di browser.</p>

    <!-- 
    <p>Paragraf ini disembunyikan sementara 
    karena berada di dalam tag komentar.</p> 
    -->

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Komentar membantu Anda mengingat alasan mengapa sebuah kode ditulis saat membukanya kembali di masa mendatang.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Bagaimanakah penulisan komentar HTML yang benar?',
                    'options' => ['// Komentar', '/* Komentar */', '<!-- Komentar -->', '# Komentar'],
                    'answer' => 2,
                    'explanation' => 'Komentar HTML diawali dengan <!-- dan diakhiri dengan -->.'
                ],
            ],
            'html_colors' => [
                'title' => 'HTML Colors',
                'summary' => 'Format warna web: Nama warna standar, nilai RGB, HEX, HSL, RGBA, dan HSLA.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Warna HTML dapat ditentukan menggunakan nama warna yang telah ditentukan sebelumnya, atau menggunakan nilai RGB, HEX, HSL, RGBA, dan HSLA.</p>
        <h4>Sistem Warna Web:</h4>
        <ul style="line-height: 1.8;">
            <li><strong>Color Names:</strong> HTML mendukung 140 nama warna standar (misal: <code>Tomato</code>, <code>Orange</code>, <code>DodgerBlue</code>, <code>MediumSeaGreen</code>, <code>SlateBlue</code>).</li>
            <li><strong>RGB:</strong> <code>rgb(red, green, blue)</code> dengan rentang nilai masing-masing 0 s/d 255.</li>
            <li><strong>HEX:</strong> <code>#RRGGBB</code> dalam angka heksadesimal 00 s/d FF (misal: <code>#ff6347</code> untuk tomato).</li>
            <li><strong>RGBA:</strong> Sama seperti RGB dengan tambahan alpha (transparansi) antara 0.0 (transparan total) s/d 1.0 (pekat).</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Kotak Warna Web',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <style>
        .box { padding: 15px; margin: 8px 0; color: white; font-weight: bold; border-radius: 6px; text-align: center; }
    </style>
</head>
<body>

    <div class="box" style="background-color: Tomato;">Tomato (Color Name)</div>
    <div class="box" style="background-color: #0d2e5c;">#0d2e5c (HEX Navy Skillance)</div>
    <div class="box" style="background-color: rgb(4, 170, 109);">rgb(4, 170, 109) (RGB W3Schools Green)</div>
    <div class="box" style="background-color: rgba(13, 46, 92, 0.5); color: #0d2e5c;">rgba(13, 46, 92, 0.5) (Transparan 50%)</div>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Format HEX (#0d2e5c) adalah format yang paling umum digunakan dalam desain web profesional.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Apakah fungsi huruf \'A\' pada model warna RGBA?',
                    'options' => ['Absolute', 'Alpha (Tingkat Transparansi)', 'Auto Color', 'Adjustment'],
                    'answer' => 1,
                    'explanation' => 'Alpha mengatur tingkat opasitas/transparansi warna dari 0.0 sampai 1.0.'
                ],
            ],
            'html_css' => [
                'title' => 'HTML CSS',
                'summary' => 'Memadukan CSS dengan HTML: Inline, Internal dalam tag style, dan External stylesheet link.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">CSS (Cascading Style Sheets) digunakan untuk mengatur tata letak, warna, font, dan tampilan visual halaman HTML.</p>
        <h4>3 Cara Memasukkan CSS ke HTML:</h4>
        <ol class="ps-3" style="line-height: 1.8;">
            <li><strong>Inline:</strong> Menggunakan atribut <code>style</code> langsung pada elemen HTML.</li>
            <li><strong>Internal:</strong> Menggunakan tag <code>&lt;style&gt;</code> di dalam bagian <code>&lt;head&gt;</code>.</li>
            <li><strong>External:</strong> Menggunakan tag <code>&lt;link rel="stylesheet" href="style.css"&gt;</code> untuk menghubungkan berkas CSS eksternal.</li>
        </ol>
HTML_CONTENT,
                'example_title' => 'Contoh Internal CSS di Dokumen HTML',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f8fafc; padding: 20px; }
        h1 { color: #0d2e5c; }
        .kotak-info {
            background: white;
            border-left: 4px solid #fca311;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    <h1>Judul Halaman Bergaya CSS</h1>
    <div class="kotak-info">
        <p>Kotak ini ditata rapi menggunakan aturan class CSS internal.</p>
    </div>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Metode External CSS adalah metode terbaik untuk website nyata karena satu berkas CSS dapat digunakan bersamaan oleh puluhan halaman web.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag apa yang digunakan untuk menghubungkan file CSS eksternal di dalam bagian <head>?',
                    'options' => ['<style>', '<link>', '<css>', '<script>'],
                    'answer' => 1,
                    'explanation' => 'Tag <link rel=\'stylesheet\' href=\'...\'> digunakan untuk memuat berkas CSS eksternal.'
                ],
            ],
            'html_links' => [
                'title' => 'HTML Links',
                'summary' => 'Membuat tautan dengan tag a, atribut href, target _blank, tautan gambar, email, dan bookmark internal.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Tautan (hyperlinks) memungkinkan pengguna berpindah dari satu halaman web ke halaman web lain di internet hanya dengan satu klik.</p>
        <h4>Atribut Target yang Sering Dipakai:</h4>
        <ul>
            <li><code>target="_self"</code> : (Default) Membuka halaman tujuan di jendela/tab yang sama.</li>
            <li><code>target="_blank"</code> : Membuka halaman tujuan di tab browser baru.</li>
            <li><code>target="_parent"</code> & <code>target="_top"</code> : Digunakan jika halaman berada di dalam frame/iframe.</li>
        </ul>
        <h4>Tautan Khusus:</h4>
        <p>Untuk membuat tautan kirim email, gunakan <code>href="mailto:info@skillance.my.id"</code>.<br>
        Untuk membuat tautan telepon, gunakan <code>href="tel:+62812345678"</code>.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Beragam Tautan HTML',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Tautan Halaman & Tab Baru</h3>
    <p><a href="https://skillance.my.id" target="_blank">Buka Skillance di Tab Baru &raquo;</a></p>

    <h3>Tautan Email</h3>
    <p><a href="mailto:support@skillance.my.id">Kirim Email ke Dukungan Kami</a></p>

    <h3>Tautan Tombol</h3>
    <a href="#" onclick="alert(\'Tautan tombol diklik!\')" style="background:#04AA6D; color:white; padding:8px 16px; text-decoration:none; border-radius:6px;">Tombol Link</a>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Gunakan teks link deskriptif seperti \'Buka Panduan Koding\' daripada hanya menuliskan \'Klik di sini\' demi aksesibilitas dan SEO.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Nilai atribut target apa yang membuat link terbuka di tab browser baru?',
                    'options' => ['_new', '_blank', '_tab', '_open'],
                    'answer' => 1,
                    'explanation' => 'target=\'_blank\' memerintahkan browser membuka tautan di tab atau jendela baru.'
                ],
            ],
            'html_images' => [
                'title' => 'HTML Images',
                'summary' => 'Menampilkan gambar dengan tag img, atribut src, alt, width, height, gambar responsif, dan format gambar web.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Gambar dapat meningkatkan tampilan dan konten halaman web secara signifikan. Dalam HTML, gambar didefinisikan dengan tag <code>&lt;img&gt;</code>.</p>
        <p>Tag <code>&lt;img&gt;</code> adalah elemen kosong (tidak memiliki tag penutup) dan membutuhkan dua atribut wajib:</p>
        <ul>
            <li><code>src</code> : Menentukan path lokasi gambar.</li>
            <li><code>alt</code> : Menyediakan teks alternatif jika gambar tidak dapat dimuat.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Gambar HTML dengan Border Radius',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h2>Gambar Programmer</h2>
    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=400" 
         alt="Meja Kerja Programmer" 
         style="width:100%; max-width:320px; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Gunakan CSS <code>width: 100%; max-width: ...; height: auto;</code> agar gambar otomatis responsif di layar ponsel!</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Apakah tag <img> memerlukan tag penutup </img>?',
                    'options' => ['Ya', 'Tidak, <img> adalah empty tag', 'Hanya jika gambar tidak ditemukan', 'Wajib pada HTML5'],
                    'answer' => 1,
                    'explanation' => 'Tag <img> adalah elemen kosong yang tidak membungkus konten teks, sehingga tidak memerlukan tag penutup.'
                ],
            ],
            'html_project' => [
                'title' => 'HTML Project',
                'summary' => 'Proyek mini portofolio profil biodata pribadi menggunakan elemen-elemen HTML yang telah dipelajari.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Saatnya menguji kemampuan Anda dengan membuat proyek portofolio profil biodata pribadi lengkap menggunakan kombinasi heading, gambar, paragraf, daftar keahlian, dan tautan sosial media.</p>
        <p>Proyek ini dapat Anda gunakan sebagai halaman profil awal sebelum terjun menerima pekerjaan di Bursa Freelance Skillance!</p>
HTML_CONTENT,
                'example_title' => 'Template Portofolio Mini Bio Pribadi',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; background: #0d2e5c; color: white; display: flex; justify-content: center; padding: 25px; }
        .card { background: white; color: #1e293b; max-width: 360px; padding: 25px; border-radius: 16px; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
        .avatar { width: 100px; height: 100px; border-radius: 50%; border: 3px solid #fca311; object-fit: cover; }
        .skill-list { text-align: left; background: #f8fafc; padding: 12px 20px; border-radius: 8px; margin: 15px 0; }
        .btn-hire { background: #fca311; color: #0d2e5c; padding: 10px 20px; text-decoration: none; border-radius: 25px; font-weight: bold; display: inline-block; }
    </style>
</head>
<body>

    <div class="card">
        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=200" class="avatar" alt="Foto Profil">
        <h3 style="margin: 10px 0 5px 0;">Sarah Amanda</h3>
        <p style="color: #64748b; font-size: 0.9rem; margin-top: 0;">Junior Web Developer</p>
        
        <div class="skill-list">
            <strong>Keahlian Utama:</strong>
            <ul style="margin: 5px 0 0 0; padding-left: 20px; font-size: 0.85rem;">
                <li>HTML5 Semantik & Form</li>
                <li>CSS Flexbox & Grid</li>
                <li>Dasar JavaScript DOM</li>
            </ul>
        </div>

        <a href="mailto:sarah@skillance.my.id" class="btn-hire">Hubungi Saya »</a>
    </div>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Ubah nama, foto, dan daftar keahlian di editor untuk menyesuaikan profil dengan data diri Anda sendiri!</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag daftar apa yang digunakan pada bagian keahlian profil di atas?',
                    'options' => ['<ol>', '<ul>', '<dl>', '<menu>'],
                    'answer' => 1,
                    'explanation' => 'Tag <ul> (unordered list) digunakan untuk menampilkan daftar butir (bullet points).'
                ],
            ],
            'html_favicon' => [
                'title' => 'HTML Favicon',
                'summary' => 'Memasang ikon kecil di tab browser di sebelah judul halaman menggunakan tag link rel=\'icon\'.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Favicon adalah gambar kecil yang ditampilkan di tab browser di samping judul halaman web Anda.</p>
        <p>Favicon membantu pengunjung mengenali website Anda dengan mudah ketika mereka membuka puluhan tab sekaligus. Format gambar yang paling umum adalah <code>.ico</code>, <code>.png</code>, atau <code>.svg</code> berukuran 16x16 atau 32x32 piksel.</p>
HTML_CONTENT,
                'example_title' => 'Cara Menambahkan Favicon di Bagian Head',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <title>Halaman dengan Favicon</title>
    <!-- Tag memasang Favicon -->
    <link rel="icon" type="image/x-icon" href="https://www.w3schools.com/favicon.ico">
</head>
<body>

    <h2>Halaman ini memiliki Favicon</h2>
    <p>Lihatlah ikon kecil di samping judul tab browser Anda!</p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Simpan gambar ikon Anda di folder utama website dan hubungkan dengan tag <code>&lt;link rel="icon" ...&gt;</code> di dalam <code>&lt;head&gt;</code>.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Di bagian manakah tag <link rel=\'icon\'> untuk favicon diletakkan?',
                    'options' => ['Di dalam <body>', 'Di dalam <head>', 'Di dalam <footer>', 'Di luar <html>'],
                    'answer' => 1,
                    'explanation' => 'Seluruh konfigurasi meta dokumen termasuk favicon selalu diletakkan di dalam tag <head>.'
                ],
            ],
            'html_page_title' => [
                'title' => 'HTML Page Title',
                'summary' => 'Pentingnya tag title untuk tab browser, bookmarking, dan hasil pencarian mesin pencari Google.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Tag <code>&lt;title&gt;</code> mendefinisikan judul dokumen HTML. Judul harus berupa teks murni dan diletakkan di dalam bagian <code>&lt;head&gt;</code>.</p>
        <h4>3 Fungsi Utama Tag Title:</h4>
        <ol class="ps-3">
            <li>Menampilkan judul pada tab browser pengguna.</li>
            <li>Memberikan judul untuk halaman saat pengguna menambahkan ke bookmark / favorit.</li>
            <li>Menampilkan judul utama halaman pada hasil pencarian mesin pencari (SEO Google).</li>
        </ol>
HTML_CONTENT,
                'example_title' => 'Contoh Judul Halaman yang Ramah SEO',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <title>Tutorial HTML Lengkap untuk Pemula - Skillance Academy</title>
</head>
<body>

    <h1>Judul Halaman yang Informatif</h1>
    <p>Judul di tag title akan tampil di tab browser dan hasil pencarian Google.</p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Buat judul yang ringkas, jelas, dan memuat kata kunci utama halaman Anda (antara 50-60 karakter).</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag HTML apa yang menentukan judul yang tampil pada tab browser?',
                    'options' => ['<header>', '<title>', '<h1>', '<name>'],
                    'answer' => 1,
                    'explanation' => 'Tag <title> di dalam <head> menentukan teks pada tab jendela browser.'
                ],
            ],
            'html_tables' => [
                'title' => 'HTML Tables',
                'summary' => 'Membuat tabel baris dan kolom dengan table, tr, th, td, colspan, dan rowspan.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Tabel HTML memungkinkan pengembang web menyusun data berupa baris dan kolom (seperti spreadsheet).</p>
        <h4>Tag Inti Tabel:</h4>
        <ul>
            <li><code>&lt;table&gt;</code> : Kontainer pembungkus tabel.</li>
            <li><code>&lt;tr&gt;</code> (Table Row) : Mendefinisikan baris tabel.</li>
            <li><code>&lt;th&gt;</code> (Table Header) : Mendefinisikan sel kepala tabel (teks otomatis tebal & rata tengah).</li>
            <li><code>&lt;td&gt;</code> (Table Data) : Mendefinisikan sel data tabel biasa.</li>
            <li><code>colspan</code> : Menggabungkan beberapa kolom menjadi satu sel.</li>
            <li><code>rowspan</code> : Menggabungkan beberapa baris menjadi satu sel.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Tabel Jadwal Kelas',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <style>
        table { width: 100%; border-collapse: collapse; font-family: sans-serif; font-size: 0.9rem; }
        th, td { border: 1px solid #cbd5e1; padding: 10px; text-align: left; }
        th { background-color: #0d2e5c; color: white; }
        tr:nth-child(even) { background-color: #f8fafc; }
    </style>
</head>
<body>

    <h3>Jadwal Pelatihan Skillance</h3>
    <table>
        <tr>
            <th>Hari</th>
            <th>Materi</th>
            <th>Waktu</th>
        </tr>
        <tr>
            <td>Senin</td>
            <td>HTML5 Semantik & Form</td>
            <td>09:00 - 11:00</td>
        </tr>
        <tr>
            <td>Rabu</td>
            <td>CSS Flexbox & Layout</td>
            <td>09:00 - 11:00</td>
        </tr>
        <tr>
            <td>Jumat</td>
            <td>JavaScript DOM Interaktif</td>
            <td>14:00 - 16:00</td>
        </tr>
    </table>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Gunakan CSS <code>border-collapse: collapse;</code> agar garis tabel menyatu rapi menjadi satu garis tunggal.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag apa yang digunakan untuk membuat sel kepala (header) tabel?',
                    'options' => ['<td>', '<th>', '<head>', '<tr>'],
                    'answer' => 1,
                    'explanation' => 'Tag <th> (table header) digunakan untuk membuat sel judul/kepala tabel.'
                ],
            ],
            'html_lists' => [
                'title' => 'HTML Lists',
                'summary' => 'Membuat daftar tak berurutan (ul), berurutan (ol), deskripsi (dl), dan daftar bersarang.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Daftar HTML digunakan untuk mengelompokkan sekumpulan item terkait.</p>
        <h4>3 Jenis Daftar HTML:</h4>
        <ol class="ps-3">
            <li><strong>Unordered List (<code>&lt;ul&gt;</code>):</strong> Ditandai dengan simbol butir (bullet points default lingkaran hitam).</li>
            <li><strong>Ordered List (<code>&lt;ol&gt;</code>):</strong> Ditandai dengan nomor urut (angka 1, 2, 3 atau huruf A, B, C via atribut <code>type</code>).</li>
            <li><strong>Description List (<code>&lt;dl&gt;</code>):</strong> Daftar istilah (<code>&lt;dt&gt;</code>) beserta penjelasannya (<code>&lt;dd&gt;</code>).</li>
        </ol>
HTML_CONTENT,
                'example_title' => 'Contoh Daftar Urut dan Tak Berurut',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h4>Daftar Belanja (Unordered List):</h4>
    <ul>
        <li>Kopi Robusta</li>
        <li>Susu Segar</li>
        <li>Biskuit Cokelat</li>
    </ul>

    <h4>Langkah Belajar Koding (Ordered List):</h4>
    <ol>
        <li>Kuasai Fundamental HTML5</li>
        <li>Percantik dengan CSS3</li>
        <li>Buat Dinamis dengan JavaScript</li>
    </ol>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Setiap item di dalam <code>&lt;ul&gt;</code> atau <code>&lt;ol&gt;</code> selalu dibungkus dengan tag <code>&lt;li&gt;</code> (list item).</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag apa yang digunakan untuk membuat daftar berurutan dengan penomoran angka?',
                    'options' => ['<ul>', '<ol>', '<dl>', '<list>'],
                    'answer' => 1,
                    'explanation' => 'Tag <ol> (ordered list) membuat daftar dengan urutan angka otomatis 1, 2, 3...'
                ],
            ],
            'html_blocks' => [
                'title' => 'HTML Block & Inline',
                'summary' => 'Perbedaan mendasar elemen Block-level (div, p, h1) vs Inline-level (span, a, img, strong).',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Setiap elemen HTML memiliki nilai tampilan default tergantung pada jenis elemennya. Dua nilai tampilan default yang paling penting adalah: <strong>Block</strong> dan <strong>Inline</strong>.</p>
        <h4>1. Block-Level Elements:</h4>
        <p>Elemen block selalu dimulai pada baris baru dan browser secara otomatis menambahkan margin sebelum dan sesudahnya. Elemen block mengambil lebar penuh yang tersedia (merentang ke kiri dan ke kanan sejauh mungkin). Contoh: <code>&lt;div&gt;</code>, <code>&lt;p&gt;</code>, <code>&lt;h1&gt;-&lt;h6&gt;</code>, <code>&lt;form&gt;</code>, <code>&lt;header&gt;</code>, <code>&lt;footer&gt;</code>.</p>
        <h4>2. Inline-Level Elements:</h4>
        <p>Elemen inline tidak dimulai pada baris baru dan hanya mengambil lebar sebanyak yang diperlukan oleh kontennya saja. Contoh: <code>&lt;span&gt;</code>, <code>&lt;a&gt;</code>, <code>&lt;img&gt;</code>, <code>&lt;strong&gt;</code>, <code>&lt;em&gt;</code>.</p>
HTML_CONTENT,
                'example_title' => 'Perbandingan Visual Block vs Inline',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <style>
        .block-demo { background-color: #dbeafe; border: 1px solid #3b82f6; padding: 10px; margin: 6px 0; }
        .inline-demo { background-color: #fef08a; border: 1px solid #eab308; padding: 4px 8px; }
    </style>
</head>
<body>

    <div class="block-demo">Ini elemen &lt;div&gt; (Block: Mengambil lebar penuh)</div>
    
    <p>Ini adalah paragraf dengan <span class="inline-demo">&lt;span&gt; inline 1</span> dan <span class="inline-demo">&lt;span&gt; inline 2</span> di baris yang sama.</p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Gunakan <code>&lt;div&gt;</code> untuk membungkus blok layout besar, dan gunakan <code>&lt;span&gt;</code> untuk menandai kata atau bagian kalimat kecil di dalam paragraf.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Manakah di bawah ini yang merupakan elemen Inline-level?',
                    'options' => ['<div>', '<p>', '<span>', '<h1>'],
                    'answer' => 2,
                    'explanation' => '<span> adalah elemen inline yang tidak membuat baris baru dan hanya memakan lebar sesuai teksnya.'
                ],
            ],
            'html_div' => [
                'title' => 'HTML Div',
                'summary' => 'Elemen div sebagai kontainer generik serbaguna untuk menata kelompok elemen dengan CSS.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Elemen <code>&lt;div&gt;</code> adalah elemen kontainer block-level generik yang digunakan untuk mengelompokkan elemen-elemen HTML lain agar dapat ditata menggunakan CSS atau dimanipulasi dengan JavaScript.</p>
        <p>Secara default, <code>&lt;div&gt;</code> tidak memiliki tampilan visual khusus sebelum diberi kelas CSS atau atribut gaya.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Kartu Kontainer Div',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <style>
        .kartu-produk {
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            max-width: 280px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            font-family: sans-serif;
        }
    </style>
</head>
<body>

    <div class="kartu-produk">
        <h4 style="margin-top:0; color:#0d2e5c;">Kursus Frontend Web</h4>
        <p style="color:#64748b; font-size:0.85rem;">Kuasai HTML, CSS, dan JavaScript dari nol hingga mahir.</p>
        <button style="background:#04AA6D; color:white; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;">Mulai Belajar</button>
    </div>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Div dikombinasikan dengan class CSS adalah dasar pembuatan komponen modern seperti card, navbar, dan grid.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Apakah elemen <div> secara default menghasilkan baris baru?',
                    'options' => ['Ya, karena merupakan elemen block-level', 'Tidak, sejajar seperti teks', 'Hanya jika diberi margin', 'Tergantung browser'],
                    'answer' => 0,
                    'explanation' => '<div> adalah block-level element yang selalu memulai baris baru di halaman web.'
                ],
            ],
            'html_classes' => [
                'title' => 'HTML Classes',
                'summary' => 'Menggunakan atribut class untuk menerapkan gaya CSS yang sama ke banyak elemen sekaligus.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Atribut HTML <code>class</code> digunakan untuk menentukan satu atau beberapa nama kelas untuk suatu elemen HTML.</p>
        <p>Kelas dapat digunakan oleh beberapa elemen sekaligus. Di CSS, Anda menyeleksi elemen berdasarkan kelas menggunakan tanda titik (<code>.nama-kelas</code>).</p>
HTML_CONTENT,
                'example_title' => 'Satu Class untuk Banyak Elemen',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <style>
        .kota {
            background-color: #0d2e5c;
            color: white;
            border-left: 4px solid #fca311;
            padding: 12px 20px;
            margin: 10px 0;
            border-radius: 6px;
            font-family: sans-serif;
        }
    </style>
</head>
<body>

    <div class="kota">
        <h4 style="margin:0;">Kendari</h4>
        <p style="margin:5px 0 0;">Ibu kota Sulawesi Tenggara</p>
    </div>

    <div class="kota">
        <h4 style="margin:0;">Kolaka</h4>
        <p style="margin:5px 0 0;">Pusat industri & pendidikan USN</p>
    </div>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Anda juga dapat memberikan beberapa kelas ke satu elemen dengan memisahkannya menggunakan spasi, contoh: <code>class="kota sorotan aktif"</code>.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Simbol apa yang digunakan di CSS untuk menyeleksi elemen berdasarkan nama kelasnya?',
                    'options' => ['# (tanda pagar)', '. (titik)', '@ (at)', '$ (dollar)'],
                    'answer' => 1,
                    'explanation' => 'Di CSS, penyeleksi class selalu diawali dengan tanda titik, contohnya .kota.'
                ],
            ],
            'html_id' => [
                'title' => 'HTML Id',
                'summary' => 'Atribut id yang bersifat unik untuk menamai elemen tunggal, link bookmark, dan JavaScript.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Atribut HTML <code>id</code> digunakan untuk menentukan tanda pengenal unik bagi suatu elemen HTML.</p>
        <div class="alert alert-warning py-2 small">
            <strong>Aturan Utama ID:</strong> Nilai ID harus UNIK di dalam satu halaman web. Anda tidak boleh memiliki dua elemen dengan nilai ID yang sama!
        </div>
        <h4>Perbedaan Class vs ID:</h4>
        <ul>
            <li><strong>Class (<code>.nama</code>):</strong> Dapat digunakan oleh banyak elemen yang memiliki gaya serupa.</li>
            <li><strong>ID (<code>#nama</code>):</strong> Hanya boleh dimiliki oleh tepat satu elemen spesifik.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh ID dan Tautan Bookmark Internal',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <style>
        #bagianKhusus {
            background-color: #fef3c7;
            border: 2px dashed #d97706;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <a href="#bagianKhusus">Lompat ke Bagian Khusus &darr;</a>
    <div style="height: 100px;"></div>

    <div id="bagianKhusus">
        <h4>Bagian Sasaran dengan ID Unik</h4>
        <p>Halaman otomatis melompat ke sini saat tautan bookmark diklik.</p>
    </div>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>ID juga digunakan oleh JavaScript untuk mengambil elemen spesifik menggunakan <code>document.getElementById(\'idKu\')</code>.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Berapa banyak elemen dalam satu halaman web yang boleh memiliki nilai ID yang persis sama?',
                    'options' => ['Bebas berapa saja', 'Tepat satu elemen', 'Maksimal 10 elemen', 'Hanya 2 elemen'],
                    'answer' => 1,
                    'explanation' => 'Nilai ID bersifat unik, sehingga hanya boleh dimiliki oleh tepat satu elemen dalam satu halaman.'
                ],
            ],
            'html_buttons' => [
                'title' => 'HTML Buttons',
                'summary' => 'Membuat tombol yang dapat diklik dengan tag button dan atribut onclick.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Elemen <code>&lt;button&gt;</code> mendefinisikan tombol yang dapat diklik. Di dalam tombol Anda dapat meletakkan teks, ikon, atau bahkan gambar.</p>
        <h4>Tipe Tombol:</h4>
        <ul>
            <li><code>type="button"</code> : Tombol biasa yang aksinya dijalankan oleh JavaScript via event <code>onclick</code>.</li>
            <li><code>type="submit"</code> : Tombol untuk mengirimkan data formulir ke server (default di dalam form).</li>
            <li><code>type="reset"</code> : Tombol untuk mengembalikan seluruh isi formulir ke kondisi kosong awal.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Beragam Tombol Interaktif',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <style>
        .btn { padding: 10px 18px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; margin-right: 8px; }
        .btn-green { background-color: #04AA6D; color: white; }
        .btn-navy { background-color: #0d2e5c; color: white; }
    </style>
</head>
<body>

    <button type="button" class="btn btn-green" onclick="alert(\'Tombol Berhasil!\')">Klik Sukses</button>
    <button type="button" class="btn btn-navy" onclick="this.innerText=\'Aktif!\'">Ubah Teks Saya</button>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Selalu tentukan atribut <code>type="button"</code> jika tombol berada di luar formulir untuk mencegah submit yang tidak disengaja.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Event handler JavaScript apa yang paling sering dipasang pada tag <button> untuk merespons klik mouse pengguna?',
                    'options' => ['onhover', 'onclick', 'onpress', 'onfocus'],
                    'answer' => 1,
                    'explanation' => 'Event onclick dipicu ketika tombol diklik oleh pengguna.'
                ],
            ],
            'html_iframes' => [
                'title' => 'HTML Iframes',
                'summary' => 'Menyematkan halaman web lain, peta Google Maps, atau video ke dalam dokumen dengan tag iframe.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Elemen <code>&lt;iframe&gt;</code> (Inline Frame) digunakan untuk menyematkan dokumen web lain di dalam halaman web HTML saat ini.</p>
        <p>Iframe sering digunakan untuk menampilkan peta lokasi Google Maps, pemutar video YouTube, atau pratinjau dokumen eksternal.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Sematan Dokumen dengan Iframe',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Menyematkan Konten Web dengan Iframe</h3>
    <iframe src="https://example.com" 
            title="Contoh Iframe" 
            width="100%" 
            height="200" 
            style="border:2px solid #cbd5e1; border-radius:8px;">
    </iframe>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Selalu sertakan atribut <code>title</code> pada tag <code>&lt;iframe&gt;</code> agar pembaca layar (screen reader) dapat menjelaskan konten frame kepada pengguna tuna netra.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Atribut apa yang digunakan pada tag <iframe> untuk menentukan URL halaman yang ingin disematkan?',
                    'options' => ['href', 'src', 'url', 'link'],
                    'answer' => 1,
                    'explanation' => 'Atribut \'src\' (source) digunakan untuk menentukan alamat URL konten iframe.'
                ],
            ],
            'html_javascript' => [
                'title' => 'HTML JavaScript',
                'summary' => 'Menyisipkan skrip interaktif dengan tag script dan menyediakan fallback dengan noscript.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">JavaScript membuat halaman HTML lebih dinamis dan interaktif. Kode JavaScript disisipkan menggunakan tag <code>&lt;script&gt;</code>.</p>
        <p>Jika browser pengguna menonaktifkan JavaScript, Anda dapat menampilkan pesan alternatif menggunakan tag <code>&lt;noscript&gt;</code>.</p>
HTML_CONTENT,
                'example_title' => 'Contoh JavaScript Mengubah Jam Real-time',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Jam Real-time dengan JavaScript</h3>
    <p id="waktuSekarang">Waktu akan tampil di sini...</p>
    <button onclick="perbaruiWaktu()">Perbarui Waktu</button>

    <script>
        function perbaruiWaktu() {
            document.getElementById(\'waktuSekarang\').innerText = new Date().toLocaleTimeString();
        }
        perbaruiWaktu();
    </script>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>JavaScript dapat membaca dan mengubah elemen HTML apa pun secara seketika melalui properti <code>innerHTML</code> atau <code>innerText</code>.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag apa yang digunakan untuk menampilkan pesan pengganti bagi pengguna yang mematikan JavaScript di browsernya?',
                    'options' => ['<nojs>', '<noscript>', '<script-off>', '<error>'],
                    'answer' => 1,
                    'explanation' => 'Tag <noscript> hanya akan dirender oleh browser jika eksekusi JavaScript dinonaktifkan.'
                ],
            ],
            'html_filepaths' => [
                'title' => 'HTML File Paths',
                'summary' => 'Memahami path relatif vs absolut untuk memanggil gambar, CSS, dan file lain tanpa link rusak.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Jalur berkas (File Path) mendeskripsikan lokasi suatu berkas di dalam struktur folder website Anda.</p>
        <h4>Jenis-Jenis Jalur Berkas:</h4>
        <ul style="line-height: 1.8;">
            <li><code>foto.jpg</code> : Berkas berada di folder yang sama dengan file HTML saat ini.</li>
            <li><code>images/foto.jpg</code> : Berkas berada di dalam subfolder bernama <code>images</code>.</li>
            <li><code>/images/foto.jpg</code> : Berkas berada di folder <code>images</code> di root direktori web server.</li>
            <li><code>../foto.jpg</code> : Naik satu level folder ke atas.</li>
            <li><code>https://domain.com/foto.jpg</code> : Jalur absolut lengkap ke server web di internet.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Pemanggilan Berkas Jalur Relatif',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <!-- Jalur Absolut dari Internet -->
    <img src="https://www.w3schools.com/html/img_chania.jpg" alt="Chania" width="250">

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Praktik terbaik: Selalu gunakan jalur berkas relatif (seperti <code>images/gambar.jpg</code>) agar website tetap berjalan normal saat dipindahkan antar folder atau domain.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tanda apa yang digunakan dalam file path relatif untuk naik satu tingkat ke folder di atasnya?',
                    'options' => ['./', '../', '//', '.../'],
                    'answer' => 1,
                    'explanation' => '../ (titik-titik garis miring) digunakan untuk naik satu level folder ke atas.'
                ],
            ],
            'html_head' => [
                'title' => 'HTML Head',
                'summary' => 'Elemen-elemen penting di dalam tag head: title, style, meta, link, script, dan base.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Elemen <code>&lt;head&gt;</code> adalah wadah untuk meta data (data tentang data) dan diletakkan tepat di antara tag <code>&lt;html&gt;</code> dan <code>&lt;body&gt;</code>.</p>
        <p>Elemen-elemen yang diperbolehkan di dalam <code>&lt;head&gt;</code> meliputi: <code>&lt;title&gt;</code>, <code>&lt;style&gt;</code>, <code>&lt;meta&gt;</code>, <code>&lt;link&gt;</code>, <code>&lt;script&gt;</code>, dan <code>&lt;base&gt;</code>.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Tag Head Standar Industri',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Belajar koding mandiri di Skillance Academy">
    <title>Struktur Head Lengkap</title>
</head>
<body>
    <p>Lihat kode sumber untuk melihat konfigurasi di bagian head.</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Tag <code>&lt;meta name="viewport" ...&gt;</code> wajib ada di setiap website modern agar halaman menyesuaikan ukuran layar ponsel pintar.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag meta apa yang wajib disertakan agar website dapat tampil responsif di layar ponsel pintar?',
                    'options' => ['meta charset', 'meta name=\'viewport\'', 'meta name=\'keywords\'', 'meta name=\'author\''],
                    'answer' => 1,
                    'explanation' => '<meta name=\'viewport\' content=\'width=device-width, initial-scale=1.0\'> adalah kunci responsivitas web modern.'
                ],
            ],
            'html_layout' => [
                'title' => 'HTML Layout',
                'summary' => 'Menyusun struktur tata letak web: Header, Navigation, Main, Aside, Section, dan Footer.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Website biasanya menampilkan konten dalam beberapa kolom (seperti koran atau majalah digital).</p>
        <p>HTML5 menyediakan elemen semantik khusus untuk mendefinisikan bagian-bagian tata letak halaman web: <code>&lt;header&gt;</code>, <code>&lt;nav&gt;</code>, <code>&lt;section&gt;</code>, <code>&lt;article&gt;</code>, <code>&lt;aside&gt;</code>, dan <code>&lt;footer&gt;</code>.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Tata Letak Lengkap',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; margin: 0; background: #f8fafc; }
        header, footer { background: #0d2e5c; color: white; padding: 15px; text-align: center; }
        nav { background: #1e3a8a; padding: 8px; text-align: center; }
        nav a { color: #fca311; text-decoration: none; margin: 0 10px; font-weight: bold; }
        main { display: flex; padding: 15px; gap: 15px; }
        article { flex: 3; background: white; padding: 15px; border-radius: 8px; }
        aside { flex: 1; background: #e2e8f0; padding: 15px; border-radius: 8px; }
    </style>
</head>
<body>

    <header><h2>Header Website</h2></header>
    <nav><a href="#">Beranda</a> <a href="#">Materi</a> <a href="#">Kontak</a></nav>
    <main>
        <article>
            <h3>Artikel Utama</h3>
            <p>Konten artikel yang panjang diletakkan di sini.</p>
        </article>
        <aside>
            <h4>Sidebar</h4>
            <p>Informasi sampingan atau iklan.</p>
        </aside>
    </main>
    <footer>&copy; 2026 Skillance Academy</footer>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Menggunakan elemen semantik tata letak membuat kode Anda sangat bersih dan mudah dikembangkan oleh tim developer.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Elemen apa yang paling tepat digunakan untuk membuat sidebar konten sampingan di website?',
                    'options' => ['<sidebar>', '<aside>', '<side>', '<subcontent>'],
                    'answer' => 1,
                    'explanation' => 'Elemen semantik <aside> dirancang khusus untuk memuat konten sampingan atau sidebar.'
                ],
            ],
            'html_responsive' => [
                'title' => 'HTML Responsive',
                'summary' => 'Membuat website yang tampil indah di komputer desktop, tablet, dan smartphone.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Desain Web Responsif (Responsive Web Design / RWD) bertujuan membuat halaman web terlihat bagus di semua perangkat dengan menyesuaikan lebar layar secara dinamis.</p>
        <h4>3 Pilar Desain Responsif:</h4>
        <ul>
            <li><strong>Viewport Meta Tag:</strong> Mengatur skala awal tampilan 1:1.</li>
            <li><strong>Gambar Responsif:</strong> Menggunakan <code>max-width: 100%; height: auto;</code> agar gambar tidak meluber keluar layar.</li>
            <li><strong>CSS Media Queries:</strong> Menerapkan aturan styling berbeda berdasarkan lebar layar perangkat (<code>@media screen and (max-width: 600px)</code>).</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Tata Letak Responsif dengan Media Query',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .kotak { background: #04AA6D; color: white; padding: 20px; text-align: center; font-size: 20px; font-weight: bold; border-radius: 8px; }
        /* Jika layar ponsel kurang dari 600px, warna berubah menjadi biru */
        @media screen and (max-width: 600px) {
            .kotak { background: #0d2e5c; font-size: 16px; }
        }
    </style>
</head>
<body>

    <div class="kotak">Coba ubah ukuran lebar browser Anda!</div>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Coba perkecil lebar browser Anda saat menjalankan contoh di atas: warna kotak akan otomatis berganti dari hijau menjadi biru!</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Aturan CSS apa yang digunakan untuk menerapkan gaya khusus hanya pada ukuran layar tertentu?',
                    'options' => ['@media', '@screen', '@device', '@responsive'],
                    'answer' => 0,
                    'explanation' => 'CSS @media queries digunakan untuk mendeteksi ukuran layar dan menerapkan gaya secara kondisional.'
                ],
            ],
            'html_computercode' => [
                'title' => 'HTML Computercode',
                'summary' => 'Menampilkan kode pemrograman, keyboard shortcut, dan output program dengan code, kbd, samp, dan var.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">HTML memiliki beberapa elemen khusus untuk memformat teks yang berkaitan dengan komputasi atau kode pemrograman.</p>
        <ul>
            <li><code>&lt;code&gt;</code> : Menampilkan sebaris kode program dengan font monospace.</li>
            <li><code>&lt;kbd&gt;</code> : Menandai input papan ketik (keyboard shortcut seperti Ctrl + S).</li>
            <li><code>&lt;samp&gt;</code> : Menandai keluaran sampel dari suatu program komputer.</li>
            <li><code>&lt;var&gt;</code> : Menandai variabel dalam matematika atau persamaan algoritma.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Elemen Kode Komputer',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <p>Simpan dokumen dengan menekan tombol <kbd>Ctrl</kbd> + <kbd>S</kbd>.</p>
    <p>Gunakan fungsi <code>alert(\'Halo\')</code> untuk menampilkan pesan popup.</p>
    <p>Respon dari server: <samp>200 OK - File Not Modified</samp>.</p>
    <p>Persamaan garis: <var>y</var> = <var>m</var><var>x</var> + <var>c</var>.</p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Menggunakan tag yang tepat membantu pembaca teknis membedakan antara perintah, tombol keyboard, dan nama variabel secara instan.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag apa yang digunakan untuk menampilkan tombol keyboard (seperti Ctrl atau Enter) secara semantik?',
                    'options' => ['<key>', '<kbd>', '<button>', '<input>'],
                    'answer' => 1,
                    'explanation' => 'Tag <kbd> (keyboard input) digunakan untuk menandai tombol fisik papan ketik.'
                ],
            ],
            'html_semantics' => [
                'title' => 'HTML Semantics',
                'summary' => 'Elemen semantik HTML5 yang memiliki arti jelas: header, nav, section, article, aside, footer.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Elemen semantik adalah elemen yang menyampaikan maknanya secara jelas kepada browser dan developer.</p>
        <p>Elemen non-semantik: <code>&lt;div&gt;</code> dan <code>&lt;span&gt;</code> (tidak menjelaskan isi kontennya).<br>
        Elemen semantik: <code>&lt;header&gt;</code>, <code>&lt;nav&gt;</code>, <code>&lt;main&gt;</code>, <code>&lt;section&gt;</code>, <code>&lt;article&gt;</code>, <code>&lt;figure&gt;</code>, <code>&lt;footer&gt;</code>.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Semantik Artikel Berita',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <article style="background:#f8fafc; padding:20px; border-radius:10px; border:1px solid #e2e8f0;">
        <header>
            <h2>Skillance Academy Luncurkan Materi Baru</h2>
            <p style="color:#64748b; font-size:0.85rem;">Dipublikasikan pada 5 November 2026</p>
        </header>
        <p>Seluruh materi HTML kini disusun lengkap berstandar W3Schools untuk mahasiswa.</p>
        <footer>
            <small>Kategori: Edukasi Teknologi</small>
        </footer>
    </article>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Elemen <code>&lt;article&gt;</code> cocok untuk konten mandiri yang dapat didistribusikan ulang (seperti postingan blog atau berita).</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Manakah di bawah ini yang merupakan elemen semantik HTML5?',
                    'options' => ['<div>', '<article>', '<span>', '<b>'],
                    'answer' => 1,
                    'explanation' => '<article> adalah elemen semantik resmi yang menjelaskan bahwa isinya adalah sebuah artikel mandiri.'
                ],
            ],
            'html_style_guide' => [
                'title' => 'HTML Style Guide',
                'summary' => 'Pedoman kerapian penulisan kode HTML konsisten: DOCTYPE, huruf kecil, kutip ganda, indentasi rapi.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Kode yang rapi, konsisten, dan terstruktur dengan baik sangat penting untuk dibaca oleh tim developer profesional.</p>
        <h4>Aturan Utama Panduan Gaya HTML:</h4>
        <ol class="ps-3" style="line-height: 1.8;">
            <li>Selalu deklarasikan <code>&lt;!DOCTYPE html&gt;</code> di baris pertama.</li>
            <li>Gunakan huruf kecil untuk semua nama elemen dan atribut (misal: <code>&lt;body&gt;</code> bukan <code>&lt;BODY&gt;</code>).</li>
            <li>Selalu tutup semua elemen HTML (termasuk tag penutup paragraf <code>&lt;/p&gt;</code>).</li>
            <li>Selalu bungkus nilai atribut dengan tanda kutip ganda (<code>class="menu"</code>).</li>
            <li>Selalu sertakan atribut <code>alt</code> pada setiap gambar.</li>
            <li>Gunakan indentasi 2 atau 4 spasi yang konsisten (hindari mencampur Tab dan Spasi).</li>
        </ol>
HTML_CONTENT,
                'example_title' => 'Contoh Kode Bersih Sesuai Panduan Gaya',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kode Rapi dan Bersih</title>
</head>
<body>

    <h1>Standar Kualitas Kode</h1>
    <p>Semua tag ditulis dengan huruf kecil dan ditutup dengan benar.</p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Menulis kode yang bersih akan menghemat ratusan jam waktu debugging Anda di kemudian hari!</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Manakah penulisan tag yang paling direkomendasikan menurut standar industri web?',
                    'options' => ['<SECTION CLASS=\'MAIN\'>', '<section class="main">', '<Section Class=main>', '<section class=main>'],
                    'answer' => 1,
                    'explanation' => 'Nama tag huruf kecil dan nilai atribut dibungkus kutip ganda adalah standar resmi W3C.'
                ],
            ],
            'html_entities' => [
                'title' => 'HTML Entities',
                'summary' => 'Menampilkan karakter yang dilindungi HTML seperti <, >, &, copyright, dan spasi tanpa putus (&nbsp;).',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Beberapa karakter seperti tanda kurung sudut <code>&lt;</code> dan <code>&gt;</code> dilindungi oleh browser karena digunakan sebagai tag HTML. Untuk menampilkannya sebagai teks biasa, kita menggunakan <strong>HTML Entities</strong>.</p>
        <table class="table table-bordered table-sm small my-3">
            <thead class="table-light"><tr><th>Karakter</th><th>Nama Entity</th><th>Nomor Entity</th></tr></thead>
            <tbody>
                <tr><td>&lt; (kurang dari)</td><td><code>&amp;lt;</code></td><td><code>&amp;#60;</code></td></tr>
                <tr><td>&gt; (lebih dari)</td><td><code>&amp;gt;</code></td><td><code>&amp;#62;</code></td></tr>
                <tr><td>&amp; (ampersand)</td><td><code>&amp;amp;</code></td><td><code>&amp;#38;</code></td></tr>
                <tr><td>&quot; (kutip ganda)</td><td><code>&amp;quot;</code></td><td><code>&amp;#34;</code></td></tr>
                <tr><td>&copy; (hak cipta)</td><td><code>&amp;copy;</code></td><td><code>&amp;#169;</code></td></tr>
                <tr><td>&nbsp; (spasi non-breaking)</td><td><code>&amp;nbsp;</code></td><td><code>&amp;#160;</code></td></tr>
            </tbody>
        </table>
HTML_CONTENT,
                'example_title' => 'Menampilkan Tag HTML Mentah Menggunakan Entity',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <p>Untuk membuat paragraf, gunakan tag &lt;p&gt; dan tutup dengan &lt;/p&gt;.</p>
    <p>&copy; 2026 Skillance Academy &mdash; Seluruh Hak Cipta Dilindungi.</p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Entity selalu diawali dengan tanda ampersand (<code>&amp;</code>) dan diakhiri dengan tanda titik koma (<code>;</code>).</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Entity apa yang digunakan untuk menampilkan simbol hak cipta (copyright ©)?',
                    'options' => ['&copy;', '&copyright;', '&c;', '&cpy;'],
                    'answer' => 0,
                    'explanation' => '&copy; adalah entitas HTML standar untuk simbol hak cipta.'
                ],
            ],
            'html_symbols' => [
                'title' => 'HTML Symbols',
                'summary' => 'Menampilkan simbol matematika, huruf Yunani, mata uang dunia, dan panah navigasi.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Banyak simbol matematika, teknis, dan mata uang yang tidak ada pada papan ketik standar. Simbol-simbol ini dapat ditampilkan menggunakan entitas simbol HTML.</p>
        <h4>Contoh Simbol Populer:</h4>
        <ul style="line-height: 1.8;">
            <li><code>&amp;euro;</code> = &euro; (Mata uang Euro)</li>
            <li><code>&amp;yen;</code> = &yen; (Mata uang Yen)</li>
            <li><code>&amp;sum;</code> = &sum; (Simbol Sigma Penjumlahan)</li>
            <li><code>&amp;pi;</code> = &pi; (Simbol Pi Matematika)</li>
            <li><code>&amp;radic;</code> = &radic; (Simbol Akar Kuadrat)</li>
            <li><code>&amp;larr;</code> = &larr; dan <code>&amp;rarr;</code> = &rarr; (Panah Kiri & Kanan)</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Rumus Matematika dan Simbol Mata Uang',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Simbol Matematika & Mata Uang</h3>
    <p>Nilai &pi; kira-kira sama dengan 3.14159.</p>
    <p>Panah Navigasi: &larr; Sebelumnya | Berikutnya &rarr;</p>
    <p>Harga Kursus: &euro; 0 (Gratis untuk Mahasiswa Indonesia!)</p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Anda dapat menggunakan nama entitas (misal <code>&amp;euro;</code>) atau kode nomor entitas (misal <code>&amp;#8364;</code>).</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Entity apa yang menghasilkan simbol panah ke kanan (→)?',
                    'options' => ['&rightarrow;', '&rarr;', '&arrowright;', '&right;'],
                    'answer' => 1,
                    'explanation' => '&rarr; adalah entitas untuk panah ke kanan (right arrow).'
                ],
            ],
            'html_emojis' => [
                'title' => 'HTML Emojis',
                'summary' => 'Menampilkan karakter emoji berwarna menggunakan Unicode UTF-8 di halaman web Anda.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Emoji terlihat seperti gambar atau ikon, tetapi sebenarnya adalah karakter huruf dari set karakter standar <strong>UTF-8 (Unicode)</strong>.</p>
        <p>Agar emoji dapat ditampilkan dengan sempurna di semua browser, pastikan Anda menyertakan <code>&lt;meta charset="UTF-8"&gt;</code> di dalam tag <code>&lt;head&gt;</code>.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Emoji di Halaman Web',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-size: 24px; text-align: center; padding: 20px;">

    <p>Belajar Koding Itu Menyenangkan! &#128516;</p>
    <p>Roket Skillance: &#128640; Komputer: &#128187; Bintang: &#11088;</p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Nilai desimal Unicode diawali dengan <code>&amp;#</code> dan diakhiri dengan <code>;</code>.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag meta apa yang wajib disertakan agar emoji dapat ditampilkan tanpa terjadi teks rusak (font glitch)?',
                    'options' => ['<meta charset=\'UTF-8\'>', '<meta name=\'emoji\'>', '<meta lang=\'id\'>', '<meta http-equiv=\'refresh\'>'],
                    'answer' => 0,
                    'explanation' => 'Set karakter UTF-8 mencakup ribuan simbol emoji standar universal.'
                ],
            ],
            'html_charsets' => [
                'title' => 'HTML Charsets',
                'summary' => 'Memahami set karakter: ASCII, ANSI, ISO-8859-1, dan mengapa UTF-8 menjadi standar wajib dunia.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Agar browser menampilkan halaman web dengan benar, browser harus mengetahui set karakter (character encoding) apa yang digunakan.</p>
        <p>Dahulu sistem komputer menggunakan ASCII yang hanya mendukung 128 karakter bahasa Inggris. Kini standar global adalah <strong>UTF-8</strong> yang mendukung hampir semua karakter, huruf, dan simbol dari seluruh bahasa di dunia (termasuk huruf Arab, Mandarin, Jepang, Cyrillic, dan Emoji).</p>
HTML_CONTENT,
                'example_title' => 'Deklarasi Charset UTF-8',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dukungan Multi-Bahasa</title>
</head>
<body>

    <h3>Contoh Huruf Internasional (UTF-8)</h3>
    <p>Indonesia: Selamat Datang</p>
    <p>Arab: مرحبًا بالعالم</p>
    <p>Jepang: ようこそ</p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Selalu cantumkan <code>&lt;meta charset="UTF-8"&gt;</code> sebagai tag pertama di dalam <code>&lt;head&gt;</code>.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Standar set karakter apa yang mencakup hampir semua karakter dan simbol dari seluruh bahasa di dunia?',
                    'options' => ['ASCII', 'ANSI', 'UTF-8', 'ISO-8859-1'],
                    'answer' => 2,
                    'explanation' => 'UTF-8 adalah standar universal web modern untuk seluruh bahasa dan simbol.'
                ],
            ],
            'html_urlencode' => [
                'title' => 'HTML URL Encode',
                'summary' => 'Mengonversi karakter khusus menjadi format URL yang valid menggunakan persen (%) encoding.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">URL hanya dapat dikirimkan melalui internet menggunakan set karakter ASCII standar.</p>
        <p>Jika URL berisi karakter di luar ASCII (seperti spasi atau huruf khusus), karakter tersebut harus dikonversi ke format yang valid. URL encoding mengganti karakter tidak aman dengan tanda persen (<code>%</code>) diikuti oleh dua digit heksadesimal.</p>
        <ul>
            <li>Spasi dikonversi menjadi <code>%20</code> atau tanda <code>+</code>.</li>
            <li>Tanda tanya <code>?</code> menjadi <code>%3F</code>.</li>
            <li>Tanda kutip ganda <code>"</code> menjadi <code>%22</code>.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh URL dengan Parameter Ter-encode',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Contoh URL Encode Query</h3>
    <p>Pencarian: "belajar html w3schools"</p>
    <p>URL Ter-encode:<br>
    <code>https://academy.skillance.cloud/cari.php?q=belajar%20html%20w3schools</code></p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Di JavaScript, Anda dapat mengonversi teks ke URL encode dengan fungsi <code>encodeURIComponent(teks)</code>.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Karakter spasi di dalam URL web akan diubah menjadi kode apa oleh browser?',
                    'options' => ['%space', '%20', '%00', '%99'],
                    'answer' => 1,
                    'explanation' => '%20 adalah representasi heksadesimal dari karakter spasi pada URL encoding.'
                ],
            ],
            'html_xhtml' => [
                'title' => 'HTML vs. XHTML',
                'summary' => 'Perbedaan HTML fleksibel dengan XHTML yang berbasis XML ketat, dan bagaimana HTML5 menyempurnakannya.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">XHTML adalah kependekan dari EXtensible HyperText Markup Language. XHTML adalah HTML yang didefinisikan ulang sebagai aplikasi XML dengan aturan sintaksis yang sangat ketat.</p>
        <h4>Perbedaan Aturan Penting XHTML vs HTML:</h4>
        <ul style="line-height: 1.8;">
            <li>Di XHTML, deklarasi <code>&lt;!DOCTYPE&gt;</code> adalah wajib.</li>
            <li>Di XHTML, semua nama elemen dan atribut <strong>wajib huruf kecil</strong>.</li>
            <li>Di XHTML, semua elemen harus ditutup (bahkan elemen kosong harus ditutup sendiri: <code>&lt;br /&gt;</code>, <code>&lt;img /&gt;</code>).</li>
            <li>Di XHTML, penyingkatan atribut dilarang (harus <code>disabled="disabled"</code>, bukan sekadar <code>disabled</code>).</li>
        </ul>
        <p>HTML5 modern mengadopsi kerapian XHTML tanpa mempersulit pengembang dengan parsing error yang memblokir layar.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Sintaks Rapi Sesuai Standar XHTML & HTML5',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Sintaks Ketat</title>
</head>
<body>

    <p>Semua tag ditutup secara disiplin dan presisi.</p>
    <br />

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Meskipun HTML5 mengizinkan tag tanpa penutup seperti <code>&lt;br&gt;</code>, menutupnya sebagai <code>&lt;br /&gt;</code> tetap dianggap praktik yang rapi.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Apakah XHTML mengizinkan nama tag ditulis dengan huruf besar seperti <H1>?',
                    'options' => ['Ya, bebas', 'Tidak, XHTML mewajibkan huruf kecil', 'Tergantung sistem operasi', 'Hanya untuk heading'],
                    'answer' => 1,
                    'explanation' => 'XHTML sangat ketat dan mewajibkan semua nama tag dan atribut ditulis dalam huruf kecil.'
                ],
            ],
        ],
        'HTML Forms' => [
            'html_forms' => [
                'title' => 'HTML Forms',
                'summary' => 'Membangun formulir untuk mengumpulkan input data dari pengguna dengan tag form.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Formulir HTML digunakan untuk mengumpulkan masukan (input) dari pengguna. Data formulir ini paling sering dikirimkan ke server untuk diproses.</p>
        <p>Elemen <code>&lt;form&gt;</code> berfungsi sebagai wadah untuk berbagai jenis elemen input, seperti bidang teks, kotak centang, tombol radio, tombol submit, dan sebagainya.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Formulir Input Data Sederhana',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Formulir Pendaftaran Siswa</h3>
    <form action="#" method="post" onsubmit="event.preventDefault(); alert(\'Form disubmit!\');">
        <label for="fname">Nama Depan:</label><br>
        <input type="text" id="fname" name="fname" value="Budi"><br><br>
        
        <label for="lname">Nama Belakang:</label><br>
        <input type="text" id="lname" name="lname" value="Santoso"><br><br>
        
        <input type="submit" value="Kirim Data &raquo;" style="background:#04AA6D; color:white; border:none; padding:8px 16px; border-radius:4px; cursor:pointer;">
    </form>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Elemen <code>&lt;label&gt;</code> sangat penting untuk aksesibilitas, menghubungkan label dengan input via atribut <code>for="idInput"</code>.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag apa yang membungkus semua elemen input di dalam formulir?',
                    'options' => ['<input>', '<form>', '<fieldset>', '<submit>'],
                    'answer' => 1,
                    'explanation' => 'Tag <form> adalah kontainer induk untuk seluruh kontrol input formulir.'
                ],
            ],
            'html_forms_attributes' => [
                'title' => 'HTML Form Attributes',
                'summary' => 'Atribut form: action, method (GET vs POST), target, autocomplete, dan novalidate.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Elemen <code>&lt;form&gt;</code> memiliki beberapa atribut penting yang mengontrol ke mana dan bagaimana data dikirimkan.</p>
        <h4>Atribut Utama Form:</h4>
        <ul style="line-height: 1.8;">
            <li><code>action</code> : Menentukan URL script pemroses data di server (misal: <code>proses.php</code>).</li>
            <li><code>method</code> : Menentukan metode HTTP yang digunakan (<code>GET</code> atau <code>POST</code>).</li>
            <li><code>target</code> : Menentukan di mana hasil respons form ditampilkan (<code>_blank</code>, <code>_self</code>).</li>
            <li><code>autocomplete</code> : Mengaktifkan atau mematikan fitur pelengkapan otomatis browser (<code>on</code> / <code>off</code>).</li>
        </ul>
        <div class="alert alert-info py-2 small">
            <strong>GET vs POST:</strong> Gunakan <code>GET</code> untuk pencarian data (data terlihat di URL). Gunakan <code>POST</code> untuk pengiriman data sensitif seperti password atau upload file (data dikirim via body request).
        </div>
HTML_CONTENT,
                'example_title' => 'Contoh Form dengan Method POST',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <form action="login.php" method="post" autocomplete="on">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Masuk Akun">
    </form>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Gunakan selalu method POST saat mengirimkan formulir autentikasi atau transaksi!</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Metode HTTP apa yang paling tepat digunakan untuk mengirimkan data password formulir login?',
                    'options' => ['GET', 'POST', 'PUT', 'HEAD'],
                    'answer' => 1,
                    'explanation' => 'POST mengirimkan data di dalam request body sehingga tidak terpapar secara terbuka pada URL browser.'
                ],
            ],
            'html_form_elements' => [
                'title' => 'HTML Form Elements',
                'summary' => 'Komponen formulir: input, label, select, textarea, button, fieldset, legend, datalist, output.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Selain elemen <code>&lt;input&gt;</code>, formulir HTML menyediakan beragam elemen input kaya lainnya:</p>
        <ul>
            <li><code>&lt;select&gt;</code> & <code>&lt;option&gt;</code> : Menu daftar tarik-turun (dropdown list).</li>
            <li><code>&lt;textarea&gt;</code> : Bidang input teks multi-baris (misal untuk pesan/alamat).</li>
            <li><code>&lt;fieldset&gt;</code> & <code>&lt;legend&gt;</code> : Mengelompokkan input terkait dengan garis pembatas berlabel judul.</li>
            <li><code>&lt;datalist&gt;</code> : Memberikan daftar saran otomatis saat pengguna mengetik di input text.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Elemen Select, Textarea, dan Fieldset',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <form>
        <fieldset style="border:1px solid #cbd5e1; border-radius:8px; padding:15px;">
            <legend style="font-weight:bold; color:#0d2e5c;">Pilihan Program Studi:</legend>
            
            <label for="prodi">Pilih Jurusan:</label><br>
            <select id="prodi" name="prodi" style="padding:6px; margin:8px 0;">
                <option value="ti">Teknik Informatika</option>
                <option value="si">Sistem Informasi</option>
                <option value="dkv">Desain Komunikasi Visual</option>
            </select><br><br>

            <label for="pesan">Catatan Tambahan:</label><br>
            <textarea id="pesan" rows="3" style="width:100%; max-width:300px;"></textarea>
        </fieldset>
    </form>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Elemen <code>&lt;fieldset&gt;</code> membantu pengguna memahami kelompok data dalam formulir yang panjang.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag apa yang digunakan untuk membuat input teks multi-baris (banyak baris)?',
                    'options' => ['<text>', '<input type=\'multiline\'>', '<textarea>', '<textbox>'],
                    'answer' => 2,
                    'explanation' => '<textarea> digunakan untuk bidang pengetikan teks multi-baris seperti pesan, ulasan, atau alamat.'
                ],
            ],
            'html_input_types' => [
                'title' => 'HTML Input Types',
                'summary' => 'Ragam tipe input: text, password, email, number, date, color, range, checkbox, radio, file.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Elemen <code>&lt;input&gt;</code> adalah elemen form yang paling fleksibel berkat adanya atribut <code>type</code>.</p>
        <table class="table table-bordered table-sm small my-3">
            <thead class="table-light"><tr><th>Type</th><th>Tampilan & Fungsi</th></tr></thead>
            <tbody>
                <tr><td><code>text</code></td><td>Kolom teks satu baris standar</td></tr>
                <tr><td><code>password</code></td><td>Menyamarkan karakter input</td></tr>
                <tr><td><code>email</code></td><td>Validasi format email otomatis</td></tr>
                <tr><td><code>number</code></td><td>Hanya menerima input angka (dengan min dan max)</td></tr>
                <tr><td><code>date</code></td><td>Pemilih kalender tanggal bawaan browser</td></tr>
                <tr><td><code>color</code></td><td>Pemilih palet warna visual</td></tr>
                <tr><td><code>checkbox</code></td><td>Kotak centang (pilihan banyak)</td></tr>
                <tr><td><code>radio</code></td><td>Pilihan bulat tunggal dari beberapa opsi</td></tr>
                <tr><td><code>file</code></td><td>Tombol unggah berkas dari komputer/HP</td></tr>
            </tbody>
        </table>
HTML_CONTENT,
                'example_title' => 'Contoh Ragam Tipe Input Modern',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Uji Coba Tipe Input HTML5</h3>
    <label>Pilih Warna Favorit:</label><br>
    <input type="color" value="#04AA6D"><br><br>

    <label>Pilih Tanggal Lahir:</label><br>
    <input type="date"><br><br>

    <label>Tingkat Kemahiran (Range):</label><br>
    <input type="range" min="1" max="100" value="80">

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Menggunakan tipe input HTML5 yang tepat secara otomatis memunculkan keyboard yang sesuai di ponsel pintar (misal keyboard angka untuk <code>type="number"</code>).</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tipe input apa yang digunakan untuk memilih satu opsi dari kelompok pilihan yang saling meniadakan?',
                    'options' => ['checkbox', 'radio', 'select-one', 'single'],
                    'answer' => 1,
                    'explanation' => 'Input type=\'radio\' dengan atribut name yang sama hanya memungkinkan pengguna memilih satu opsi tunggal.'
                ],
            ],
            'html_form_attributes' => [
                'title' => 'HTML Input Attributes',
                'summary' => 'Atribut pembatas input: value, readonly, disabled, size, maxlength, min, max, multiple, placeholder, required.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Atribut input mengontrol perilaku, validasi, dan nilai dari kontrol formulir.</p>
        <ul style="line-height: 1.8;">
            <li><code>value</code> : Menentukan nilai awal bidang input.</li>
            <li><code>readonly</code> : Bidang hanya dapat dibaca dan tidak dapat diubah (tetap terkirim saat submit).</li>
            <li><code>disabled</code> : Bidang nonaktif berwarna abu-abu (tidak dikirimkan saat submit).</li>
            <li><code>placeholder</code> : Teks petunjuk singkat yang menghilang saat diketik.</li>
            <li><code>required</code> : Memastikan bidang wajib diisi sebelum form dapat disubmit.</li>
            <li><code>pattern</code> : Menentukan ekspresi reguler (regex) untuk mencocokkan format data.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Input dengan Validasi Placeholder & Required',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <form onsubmit="event.preventDefault(); alert(\'Validasi sukses!\');">
        <label for="telp">Nomor WhatsApp (Wajib):</label><br>
        <input type="tel" id="telp" required placeholder="0812-xxxx-xxxx" style="padding:6px;"><br><br>

        <label for="kode">Kode Referal (Readonly):</label><br>
        <input type="text" id="kode" value="SKILLANCE2026" readonly style="background:#e2e8f0; padding:6px;"><br><br>

        <input type="submit" value="Verifikasi »" style="background:#0d2e5c; color:white; border:none; padding:8px 16px; border-radius:4px;">
    </form>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Atribut <code>required</code> memanfaatkan validasi bawaan browser tanpa perlu menuliskan kode JavaScript rumit.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Atribut apa yang menampilkan teks petunjuk abu-abu samar di dalam kotak input sebelum pengguna mengetik?',
                    'options' => ['hint', 'placeholder', 'label', 'preview'],
                    'answer' => 1,
                    'explanation' => 'Placeholder menyediakan petunjuk atau format contoh bagi pengguna di dalam kotak input.'
                ],
            ],
            'html_form_attributes_form' => [
                'title' => 'Input Form Attributes',
                'summary' => 'Atribut kontrol aksi tombol submit: formaction, formenctype, formmethod, formnovalidate, formtarget.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Atribut <strong>Form</strong> pada tombol <code>&lt;input type="submit"&gt;</code> atau <code>&lt;button type="submit"&gt;</code> memungkinkan Anda mengganti atribut form induk secara spesifik untuk tombol tersebut.</p>
        <ul>
            <li><code>formaction</code> : Mengirimkan form ke URL tujuan berbeda khusus saat tombol ini diklik.</li>
            <li><code>formmethod</code> : Mengubah metode HTTP khusus untuk tombol ini (misal ganti dari GET ke POST).</li>
            <li><code>formnovalidate</code> : Mengabaikan validasi formulir saat tombol ini diklik (sangat berguna untuk tombol 'Simpan Draf').</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Tombol Submit dengan Formaction Berbeda',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <form action="simpan.php" method="post">
        <label>Judul Artikel:</label><br>
        <input type="text" name="judul" required><br><br>

        <!-- Tombol 1: Kirim ke simpan.php -->
        <input type="submit" value="Terbitkan Sekarang">

        <!-- Tombol 2: Kirim ke draft.php tanpa validasi -->
        <input type="submit" formaction="draft.php" formnovalidate value="Simpan Draf (Tanpa Validasi)">
    </form>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Dengan <code>formnovalidate</code>, pengguna dapat menyimpan progres tulisan meskipun beberapa kolom wajib belum terisi penuh.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Atribut apa pada tombol submit yang memungkinkan pengiriman form tanpa memicu peringatan validasi \'required\'?',
                    'options' => ['novalidate', 'formnovalidate', 'skip-validation', 'force-submit'],
                    'answer' => 1,
                    'explanation' => 'Atribut formnovalidate pada tombol submit mengabaikan seluruh validasi bawaan form saat tombol ditekan.'
                ],
            ],
        ],
        'HTML Graphics' => [
            'html_canvas' => [
                'title' => 'HTML Canvas',
                'summary' => 'Menggambar grafik 2D, bentuk geometris, diagram, dan animasi secara dinamis menggunakan JavaScript.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Elemen HTML <code>&lt;canvas&gt;</code> digunakan untuk menggambar grafik secara langsung menggunakan skrip JavaScript.</p>
        <p>Canvas hanya berfungsi sebagai kanvas kosong (wadah grafis). Anda wajib menggunakan JavaScript untuk menggambar garis, lingkaran, teks grafis, atau animasi game di atasnya.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Menggambar Lingkaran di Canvas',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <canvas id="myCanvas" width="200" height="120" style="border:1px solid #cbd5e1; border-radius:8px;"></canvas>

    <script>
        const c = document.getElementById("myCanvas");
        const ctx = c.getContext("2d");
        
        // Gambar lingkaran merah
        ctx.beginPath();
        ctx.arc(100, 60, 40, 0, 2 * Math.PI);
        ctx.fillStyle = "#e11d48";
        ctx.fill();
        ctx.stroke();
    </script>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Canvas berbasis piksel (raster), sangat ideal untuk game 2D/3D dan pemrosesan manipulasi foto langsung di browser.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Bahasa apa yang digunakan untuk menggambar bentuk di dalam elemen <canvas>?',
                    'options' => ['CSS murni', 'JavaScript', 'PHP', 'SQL'],
                    'answer' => 1,
                    'explanation' => 'Elemen canvas membutuhkan kode JavaScript (Canvas 2D Context API) untuk menghasilkan grafik.'
                ],
            ],
            'html_svg' => [
                'title' => 'HTML SVG',
                'summary' => 'Grafik vektor scalable (SVG) berbasis XML yang tidak pecah saat diperbesar di layar resolusi tinggi.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">SVG adalah singkatan dari <strong>Scalable Vector Graphics</strong>. SVG digunakan untuk mendefinisikan grafik berbasis vektor untuk web.</p>
        <p>Berbeda dengan Canvas yang berbasis piksel (raster), SVG berbasis rumus matematika vektor. Artinya, gambar SVG tidak akan pernah pecah, buram, atau kehilangan kualitas meskipun diperbesar ribuan kali di layar Retina!</p>
HTML_CONTENT,
                'example_title' => 'Contoh Menggambar Ikon Bintang dengan SVG',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Bintang Vektor SVG Presisi</h3>
    <svg width="120" height="120" viewBox="0 0 24 24" fill="#fca311" stroke="#0d2e5c" stroke-width="1">
        <polygon points="12,2 15,9 22,9 17,14 19,21 12,17 5,21 7,14 2,9 9,9" />
    </svg>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Setiap elemen SVG dapat ditata dengan CSS dan dimanipulasi dengan event JavaScript persis seperti elemen HTML biasa.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Apakah keunggulan utama gambar berformat SVG dibandingkan gambar PNG/JPG biasa?',
                    'options' => ['Tidak pernah pecah saat di-zoom (vektor)', 'Ukurannya selalu lebih dari 100MB', 'Hanya bisa berwarna hitam putih', 'Tidak bisa dibuka di Chrome'],
                    'answer' => 0,
                    'explanation' => 'SVG adalah grafik vektor sehingga resolusinya tetap tajam sempurna pada ukuran layar berapa pun.'
                ],
            ],
        ],
        'HTML Media' => [
            'html_media' => [
                'title' => 'HTML Media',
                'summary' => 'Pengenalan format multimedia di web: Audio, Video, format kontainer, dan codec.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Multimedia di web hadir dalam berbagai format suara, musik, video, rekaman, dan animasi.</p>
        <p>Sebelum HTML5, memutar video membutuhkan plugin pihak ketiga seperti Flash Player. HTML5 merevolusi dunia web dengan menghadirkan tag bawaan <code>&lt;video&gt;</code> dan <code>&lt;audio&gt;</code> yang didukung langsung oleh seluruh browser modern tanpa plugin tambahan!</p>
HTML_CONTENT,
                'example_title' => 'Ringkasan Format Media Web Populer',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Format Standar Multimedia Web Modern</h3>
    <ul>
        <li><strong>Video:</strong> MP4 (H.264 + AAC) & WebM (VP9 / AV1)</li>
        <li><strong>Audio:</strong> MP3, AAC, & OGG</li>
        <li><strong>Gambar:</strong> WebP, SVG, PNG, & JPG</li>
    </ul>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Format MP4 dan MP3 memiliki kompatibilitas 100% di semua browser komputer dan ponsel pintar di seluruh dunia.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Format video manakah yang paling universal didukung oleh seluruh browser web modern?',
                    'options' => ['AVI', 'MP4', 'WMV', 'FLV'],
                    'answer' => 1,
                    'explanation' => 'Format MP4 (H.264) didukung secara universal oleh seluruh browser desktop dan mobile.'
                ],
            ],
            'html_video' => [
                'title' => 'HTML Video',
                'summary' => 'Memutar video lokal dengan tag video, atribut controls, autoplay, loop, dan muted.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Elemen <code>&lt;video&gt;</code> digunakan untuk menampilkan video di halaman web.</p>
        <h4>Atribut Penting Tag Video:</h4>
        <ul>
            <li><code>controls</code> : Menampilkan tombol putar (play), jeda (pause), volume, dan layar penuh (fullscreen).</li>
            <li><code>autoplay</code> : Memutar video secara otomatis saat halaman selesai dimuat (diwajibkan bersama atribut <code>muted</code> oleh browser).</li>
            <li><code>loop</code> : Memutar video kembali dari awal secara berulang terus menerus.</li>
            <li><code>poster</code> : Menampilkan gambar sampul (thumbnail) sebelum video diputar.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Pemutar Video HTML5',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Pemutar Video HTML5 Bawaan</h3>
    <video width="320" height="180" controls poster="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=320">
        <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
        Browser Anda tidak mendukung tag video.
    </video>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Gunakan tag <code>&lt;source&gt;</code> di dalam <code>&lt;video&gt;</code> untuk menyediakan beberapa format cadangan.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Atribut apa yang wajib disertakan agar pengguna dapat melihat tombol play, jeda, dan pengatur volume video?',
                    'options' => ['buttons', 'controls', 'toolbar', 'player'],
                    'answer' => 1,
                    'explanation' => 'Atribut \'controls\' memunculkan antarmuka kontrol pemutaran video bawaan browser.'
                ],
            ],
            'html_audio' => [
                'title' => 'HTML Audio',
                'summary' => 'Memutar suara atau musik di web dengan tag audio dan atribut controls.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Elemen HTML <code>&lt;audio&gt;</code> digunakan untuk memutar berkas audio (suara/musik) pada halaman web.</p>
        <p>Sama seperti video, atribut <code>controls</code> menambahkan kontrol audio seperti putar, jeda, dan volume.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Pemutar Suara Audio',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Pemutar Audio HTML5</h3>
    <audio controls>
        <source src="https://www.w3schools.com/html/horse.mp3" type="audio/mpeg">
        Browser Anda tidak mendukung elemen audio.
    </audio>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Teks di dalam tag <code>&lt;audio&gt;...&lt;/audio&gt;</code> hanya akan tampil jika browser pengguna sudah sangat usang dan tidak mendukung HTML5.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Format audio apa yang paling umum dan didukung oleh semua browser di tag <audio>?',
                    'options' => ['WAV', 'MP3', 'MIDI', 'FLAC'],
                    'answer' => 1,
                    'explanation' => 'MP3 adalah format audio standar dengan kompresi baik dan dukungan browser terlengkap.'
                ],
            ],
            'html_plugins' => [
                'title' => 'HTML Plug-ins',
                'summary' => 'Memahami tag object dan embed untuk menyematkan aplikasi eksternal (seperti PDF viewer).',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Plugin adalah program komputer kecil yang memperluas fungsionalitas standar browser (seperti penampil dokumen PDF).</p>
        <p>Elemen <code>&lt;object&gt;</code> dan <code>&lt;embed&gt;</code> digunakan untuk menyematkan konten eksternal multimedia atau dokumen interaktif ke dalam halaman web.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Menyematkan Dokumen dengan Object',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Sematan Dokumen HTML Mandiri</h3>
    <object data="https://example.com" width="100%" height="200" style="border:1px solid #cbd5e1; border-radius:8px;">
        <p>Browser tidak dapat menampilkan objek dokumen ini.</p>
    </object>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Untuk audio dan video, gunakan tag resmi <code>&lt;video&gt;</code> dan <code>&lt;audio&gt;</code> daripada tag object.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag apa yang digunakan untuk menyematkan dokumen atau media eksternal serbaguna?',
                    'options' => ['<object>', '<plugin>', '<app>', '<addon>'],
                    'answer' => 0,
                    'explanation' => 'Tag <object> adalah standar HTML untuk menyematkan objek dokumen multimedia eksternal.'
                ],
            ],
            'html_youtube' => [
                'title' => 'HTML YouTube',
                'summary' => 'Menyematkan video YouTube responsif ke website menggunakan tag iframe resmi.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Cara paling mudah dan hemat bandwidth server untuk menampilkan video berkualitas tinggi di website adalah dengan mengunggah video ke YouTube, lalu menyematkannya via <strong>Iframe</strong>.</p>
        <p>YouTube secara otomatis menangani transcoding kualitas video (1080p, 720p, 480p) sesuai kecepatan koneksi internet masing-masing pengunjung Anda.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Sematan Video YouTube',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Video Pembelajaran YouTube</h3>
    <iframe width="100%" 
            height="220" 
            src="https://www.youtube.com/embed/tgbNymZ7vqY" 
            title="YouTube video player" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen 
            style="border-radius:10px; max-width:400px;">
    </iframe>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Gunakan URL format <code>https://www.youtube.com/embed/VIDEO_ID</code> untuk menyematkan video ke dalam tag iframe.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Format URL YouTube apa yang harus digunakan pada atribut src di dalam iframe agar video dapat diputar langsung di halaman web?',
                    'options' => ['youtube.com/watch?v=...', 'youtube.com/embed/...', 'youtube.com/play/...', 'youtube.com/video/...'],
                    'answer' => 1,
                    'explanation' => 'URL dengan path /embed/ adalah endpoint sematan resmi YouTube untuk iframe.'
                ],
            ],
        ],
        'Web APIs' => [
            'html_api_whatis' => [
                'title' => 'Web APIs',
                'summary' => 'Pengenalan Application Programming Interfaces bawaan browser untuk memperluas fungsionalitas web.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">API adalah singkatan dari <strong>Application Programming Interface</strong>. Browser web modern dilengkapi dengan Web API bawaan yang dapat diakses melalui JavaScript.</p>
        <p>Web API memungkinkan aplikasi web membaca lokasi GPS perangkat, menyimpan data di harddisk lokal pengguna tanpa database server, menangani drag-and-drop, hingga menjalankan proses berat di background thread.</p>
HTML_CONTENT,
                'example_title' => 'Gambaran Ekosistem Web API',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Web APIs Bawaan Browser Modern</h3>
    <ul>
        <li><strong>Geolocation API:</strong> Mendeteksi garis lintang & bujur GPS perangkat.</li>
        <li><strong>Web Storage API:</strong> localStorage & sessionStorage.</li>
        <li><strong>Web Workers API:</strong> Menjalankan JavaScript di latar belakang.</li>
    </ul>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Seluruh Web API ini dapat digunakan langsung tanpa perlu menginstal pustaka eksternal!</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Apakah Web API bawaan browser memerlukan instalasi pustaka pihak ketiga?',
                    'options' => ['Ya, wajib install via npm', 'Tidak, sudah terpasang bawaan di browser', 'Hanya jika menggunakan server Linux', 'Hanya di browser Chrome'],
                    'answer' => 1,
                    'explanation' => 'Web APIs adalah antarmuka standar yang sudah tertanam langsung di dalam browser web modern.'
                ],
            ],
            'html_geolocation' => [
                'title' => 'Geolocation API',
                'summary' => 'Membaca koordinat latitude dan longitude GPS perangkat pengguna dengan izin privasi.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">HTML Geolocation API digunakan untuk mengetahui posisi geografis (lintang dan bujur) pengguna.</p>
        <p>Karena menyangkut privasi pengguna, posisi tidak akan tersedia kecuali pengguna secara eksplisit memberikan izin (klik tombol <em>Allow / Izinkan</em> pada popup browser).</p>
HTML_CONTENT,
                'example_title' => 'Contoh Mendeteksi Koordinat GPS',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Deteksi Lokasi Geografis (GPS)</h3>
    <button onclick="dapatkanLokasi()" style="background:#04AA6D; color:white; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;">Dapatkan Koordinat Saya</button>
    <p id="hasilLokasi">Koordinat akan tampil di sini...</p>

    <script>
        function dapatkanLokasi() {
            const out = document.getElementById("hasilLokasi");
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(pos => {
                    out.innerHTML = "Lintang: " + pos.coords.latitude + "<br>Bujur: " + pos.coords.longitude;
                }, err => {
                    out.innerText = "Gagal membaca lokasi: " + err.message;
                });
            } else {
                out.innerText = "Browser Anda tidak mendukung Geolocation.";
            }
        }
    </script>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Geolocation API memanfaatkan GPS ponsel pintar, sinyal menara BTS, atau alamat IP jaringan untuk menghitung koordinat posisi.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Objek JavaScript apa yang digunakan untuk mengakses fitur Geolocation API?',
                    'options' => ['window.location', 'navigator.geolocation', 'document.gps', 'browser.position'],
                    'answer' => 1,
                    'explanation' => 'navigator.geolocation adalah API standar untuk membaca posisi geografis perangkat pengguna.'
                ],
            ],
            'html_draganddrop' => [
                'title' => 'Drag and Drop API',
                'summary' => 'Memungkinkan elemen diseret (drag) dan dilepaskan (drop) ke area target di layar.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Fitur Drag and Drop (Tarik dan Lepas) adalah fitur interaktif di mana pengguna dapat mengklik dan menahan suatu elemen, lalu menyeretnya ke wadah lain.</p>
        <p>Untuk membuat suatu elemen dapat ditarik, cukup tambahkan atribut <code>draggable="true"</code> pada tag HTML tersebut.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Sederhana Elemen Draggable',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Elemen yang Dapat Ditarik</h3>
    <div draggable="true" style="width:150px; padding:15px; background:#0d2e5c; color:white; border-radius:8px; cursor:grab;">
        Tarik Saya! &#9995;
    </div>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Kombinasikan dengan event <code>ondragstart</code> dan <code>ondrop</code> untuk membuat antarmuka papan Kanban atau keranjang belanja belanjaan!</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Atribut HTML apa yang wajib dipasang agar sebuah elemen dapat diseret oleh kursor pengguna?',
                    'options' => ['movable=\'true\'', 'draggable=\'true\'', 'dropzone=\'true\'', 'clickable=\'true\''],
                    'answer' => 1,
                    'explanation' => 'Atribut draggable=\'true\' mengaktifkan kapabilitas drag pada elemen tersebut.'
                ],
            ],
            'html_popover' => [
                'title' => 'Popover API',
                'summary' => 'Menampilkan popup pesan, tooltip, atau menu mengambang modern tanpa JavaScript eksternal.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Popover API adalah fitur HTML5 modern terkini yang memungkinkan developer membuat popup, menu mengambang, atau tooltip hanya dengan atribut HTML murni tanpa pustaka modal JavaScript tambahan!</p>
        <p>Cukup gunakan atribut <code>popover</code> pada elemen target dan pasang atribut <code>popovertarget="idTarget"</code> pada tombol pemicunya.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Popover API Modern Murni',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>HTML Popover API Bawaan</h3>
    <button popovertarget="myPopover" style="background:#04AA6D; color:white; border:none; padding:10px 18px; border-radius:6px; cursor:pointer;">
        Buka Popover Pesan »
    </button>

    <div id="myPopover" popover style="padding:20px; border-radius:12px; border:2px solid #0d2e5c; background:white; box-shadow:0 10px 25px rgba(0,0,0,0.2);">
        <h4 style="margin-top:0; color:#0d2e5c;">Pesan Notifikasi Skillance</h4>
        <p>Popover ini muncul secara native di lapisan teratas (top layer) browser tanpa script tambahan!</p>
    </div>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Klik di luar popover atau tekan tombol Esc pada keyboard untuk otomatis menutup popover secara default.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Atribut apa yang dipasang pada tombol untuk menghubungkannya ke ID popover yang ingin dibuka?',
                    'options' => ['popovertarget', 'target-popover', 'data-popover', 'toggle-popover'],
                    'answer' => 0,
                    'explanation' => 'Atribut popovertarget=\'id\' menghubungkan tombol kontrol dengan elemen popover.'
                ],
            ],
            'html_webstorage' => [
                'title' => 'Web Storage API',
                'summary' => 'Menyimpan data di browser pengguna dengan localStorage (permanen) dan sessionStorage (sementara).',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Dengan HTML Web Storage, aplikasi web dapat menyimpan data secara lokal di dalam browser pengguna.</p>
        <h4>Dua Objek Utama Web Storage:</h4>
        <ul>
            <li><code>localStorage</code> : Menyimpan data tanpa batas waktu kedaluwarsa. Data tidak akan hilang saat browser ditutup dan dibuka kembali.</li>
            <li><code>sessionStorage</code> : Menyimpan data hanya untuk satu sesi tab browser. Data otomatis terhapus saat tab browser ditutup.</li>
        </ul>
        <p>Kapasitas penyimpanan Web Storage jauh lebih besar dari cookies (minimal 5MB) dan data tidak pernah dikirimkan ke server di setiap request HTTP.</p>
HTML_CONTENT,
                'example_title' => 'Menyimpan Nama di localStorage',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Simpan Data di Browser (localStorage)</h3>
    <input type="text" id="namaInput" placeholder="Ketik nama Anda..." style="padding:6px;">
    <button onclick="simpanNama()">Simpan</button>
    <p id="pesanTersimpan"></p>

    <script>
        function simpanNama() {
            const val = document.getElementById(\'namaInput\').value;
            localStorage.setItem(\'user_name\', val);
            tampilkanNama();
        }
        function tampilkanNama() {
            const saved = localStorage.getItem(\'user_name\');
            if (saved) {
                document.getElementById(\'pesanTersimpan\').innerText = "Halo, " + saved + "! (Tersimpan di browser)";
            }
        }
        tampilkanNama();
    </script>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Fitur pencatatan progres belajar mandiri di Skillance Academy memanfaatkan localStorage ini agar progres Anda tetap aman tersimpan!</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Objek Web Storage manakah yang menyimpan data secara permanen meskipun browser telah ditutup dan dibuka kembali?',
                    'options' => ['sessionStorage', 'localStorage', 'cookieStorage', 'tempStorage'],
                    'answer' => 1,
                    'explanation' => 'localStorage menyimpan data secara persisten sampai pengguna menghapus cache browser atau script menghapusnya.'
                ],
            ],
            'html_webworkers' => [
                'title' => 'Web Workers API',
                'summary' => 'Menjalankan skrip JavaScript berat di thread latar belakang tanpa membuat antarmuka halaman macet.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Saat mengeksekusi skrip di halaman HTML, halaman web bisa menjadi tidak responsif jika script menjalankan perhitungan matematis yang sangat rumit.</p>
        <p><strong>Web Worker</strong> adalah JavaScript yang berjalan di latar belakang (background thread), terpisah dari alur kerja antarmuka utama. Anda dapat terus mengklik tombol, mengetik, atau menavigasi halaman tanpa ada jeda macet (freeze).</p>
HTML_CONTENT,
                'example_title' => 'Simulasi Konsep Web Worker',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Penghitung Background Thread</h3>
    <p>Nilai Hitungan: <output id="result">0</output></p>
    <button onclick="alert(\'UI tetap responsif dan lancar!\')">Uji Responsif Tombol</button>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Web Worker dibuat menggunakan constructor <code>new Worker(\'worker.js\')</code> dan berkomunikasi melalui pengiriman pesan <code>postMessage()</code>.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Apakah Web Worker memiliki akses langsung ke DOM elemen (seperti document.getElementById)?',
                    'options' => ['Ya, bebas mengubah DOM', 'Tidak, Web Worker tidak dapat mengakses objek DOM secara langsung demi keamanan thread', 'Hanya jika diizinkan oleh CSS', 'Tergantung browser'],
                    'answer' => 1,
                    'explanation' => 'Web Worker berjalan di thread terpisah dan tidak dapat memanipulasi DOM secara langsung; mereka berkomunikasi dengan thread utama via pesan postMessage.'
                ],
            ],
            'html_serversentevents' => [
                'title' => 'Server-Sent Events API',
                'summary' => 'Menerima pembaruan data secara real-time dari server ke browser web secara otomatis (SSE).',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Server-Sent Events (SSE) memungkinkan halaman web menerima pembaruan data otomatis dari server web tanpa perlu melakukan refresh atau polling berulang-ulang.</p>
        <p>Sangat ideal untuk pembaruan skor pertandingan langsung (live score), notifikasi harga saham real-time, atau feed berita terkini.</p>
HTML_CONTENT,
                'example_title' => 'Penerima Pesan Real-time dengan EventSource',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <h3>Menerima Pembaruan Real-Time (SSE)</h3>
    <div id="notifBox" style="padding:15px; background:#f0fdf4; border:1px solid #86efac; border-radius:8px;">
        Menunggu notifikasi dari server...
    </div>

    <script>
        // Simulasi penerima SSE di browser
        if (typeof(EventSource) !== "undefined") {
            // const source = new EventSource("notifikasi.php");
            // source.onmessage = function(event) { ... };
        }
    </script>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Berbeda dengan WebSocket yang bersifat dua arah, SSE bekerja satu arah dari server ke klien sehingga jauh lebih hemat daya dan mudah diimplementasikan.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Objek JavaScript apa yang digunakan browser untuk mendengarkan Server-Sent Events?',
                    'options' => ['WebSocket', 'EventSource', 'HttpReceiver', 'StreamListener'],
                    'answer' => 1,
                    'explanation' => 'EventSource adalah API browser resmi untuk membuka koneksi aliran data Server-Sent Events.'
                ],
            ],
        ],
        'HTML Cert' => [
            'html_certificate' => [
                'title' => 'HTML Certificate',
                'summary' => 'Uji kompetensi menyeluruh untuk mengonfirmasi keahlian HTML5 Anda dan membuka sertifikat resmi.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Selesaikan seluruh modul materi dan uji pemahaman di Skillance Academy untuk memvalidasi keahlian HTML5 Anda berstandar industri.</p>
        <div class="card border-success p-4 rounded-3 text-center my-4" style="background: #f0fdf4;">
            <div style="font-size: 48px; color: #16a34a;"><i class="fa-solid fa-certificate"></i></div>
            <h3 class="fw-bold text-navy mt-2">Sertifikat Kelulusan HTML Specialist</h3>
            <p class="text-secondary small max-w-500 mx-auto">
                Setelah menyelesaikan seluruh bab materi dan mencapai progres 100%, lencana kompetensi resmi akan otomatis disematkan pada profil Skillance Anda dan siap ditautkan ke CV atau LinkedIn.
            </p>
            <a href="learn.php?c=html&p=html_home" class="btn btn-success fw-bold px-4 py-2 rounded-pill mt-2">
                Mulai Pembelajaran dari Awal &raquo;
            </a>
        </div>
HTML_CONTENT,
                'example_title' => 'Simulasi Lencana Kelulusan Digital',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <style>
        .badge-box { background: #0d2e5c; color: white; padding: 20px; border-radius: 12px; text-align: center; max-width: 300px; margin: auto; border: 2px solid #fca311; }
    </style>
</head>
<body>

    <div class="badge-box">
        <h4 style="color:#fca311; margin:0;">&#127891; Lulus Kompetensi</h4>
        <p style="font-size:0.9rem; margin:8px 0 0;">Certified HTML5 Specialist<br>Skillance Academy Indonesia</p>
    </div>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Progres belajar Anda tercatat secara otomatis pada database sistem saat Anda menekan tombol \'Tandai Selesai\' di setiap halaman modul.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Berapa persentase modul yang harus Anda selesaikan untuk meraih lencana kelulusan?',
                    'options' => ['50%', '75%', '100%', 'Tidak ada batas'],
                    'answer' => 2,
                    'explanation' => 'Lencana kelulusan diberikan secara otomatis setelah seluruh modul diselesaikan 100%.'
                ],
            ],
        ],
        'HTML Examples' => [
            'html_examples' => [
                'title' => 'HTML Examples',
                'summary' => 'Kumpulan contoh kode HTML lengkap yang siap disalin dan dijalankan untuk berbagai kebutuhan komponen web.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Di halaman ini, Anda dapat menemukan kumpulan contoh kode HTML siap pakai untuk berbagai kebutuhan: Formulir pendaftaran, tabel data, kartu produk, galeri gambar, dan tata letak responsif.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Komponen Kartu Profil Lengkap',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <style>
        .card { width: 260px; padding: 20px; background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); font-family: sans-serif; text-align: center; border: 1px solid #e2e8f0; }
        .btn { background: #04AA6D; color: white; border: none; padding: 8px 16px; border-radius: 20px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>

    <div class="card">
        <h4 style="margin: 0 0 8px 0; color: #0d2e5c;">Contoh Kartu Web</h4>
        <p style="color: #64748b; font-size: 0.85rem;">Komponen siap pakai dengan struktur HTML semantik.</p>
        <button class="btn">Klik Aksi</button>
    </div>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Klik <strong>Coba Sendiri (Try it Yourself) &raquo;</strong> untuk bereksperimen dengan contoh di atas.</p>
HTML_EXPLANATION,
            ],
            'html_editor' => [
                'title' => 'HTML Editor',
                'summary' => 'Gunakan Skillance Tryit Editor online untuk menguji dan menjalankan skrip HTML Anda secara instan.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Skillance Tryit Editor adalah editor koding langsung di browser yang memungkinkan Anda mengubah kode HTML, CSS, dan JavaScript lalu langsung melihat hasilnya tanpa harus menginstal software apa pun.</p>
        <p>Buka editor kapan saja melalui menu navigasi atas <strong>Try It Yourself</strong>.</p>
HTML_CONTENT,
                'example_title' => 'Editor Langsung di Browser',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <h2>Coba Kode Kapan Saja</h2>
    <p>Ubah teks ini dan klik tombol Jalankan &raquo; di Tryit Editor!</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Tekan tombol <code>Ctrl + Enter</code> di keyboard saat berada di Tryit Editor untuk menjalankan kode seketika.</p>
HTML_EXPLANATION,
            ],
            'html_quiz' => [
                'title' => 'HTML Quiz',
                'summary' => 'Uji pengetahuan HTML Anda dengan kuis interaktif menyeluruh.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Uji seberapa dalam pemahaman Anda tentang HTML5 dengan menjawab pertanyaan-pertanyaan kuis di bawah ini.</p>
HTML_CONTENT,
                'example_title' => 'Simulasi Tes HTML',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <h3>Pertanyaan Kuis</h3>
    <p>Uji pemahaman Anda pada kotak kuis interaktif di bawah!</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Setiap jawaban yang Anda pilih akan langsung menampilkan pembahasan ilmiah yang mendalam.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Tag manakah yang paling tepat digunakan untuk menandai konten utama dokumen web?',
                    'options' => ['<content>', '<main>', '<body>', '<section>'],
                    'answer' => 1,
                    'explanation' => 'Elemen <main> adalah standar HTML5 untuk menandai konten unik utama dari suatu halaman.'
                ],
            ],
            'html_exercises' => [
                'title' => 'HTML Exercises',
                'summary' => 'Latihan mandiri melengkapi potongan kode yang hilang (fill in the blanks).',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Latihan adalah kunci terbaik menguasai pemrograman web. Lengkapi potongan kode di bawah ini untuk menguji daya ingat Anda terhadap sintaksis tag.</p>
HTML_CONTENT,
                'example_title' => 'Latihan Menulis Tag yang Hilang',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <!-- Lengkapi tag judul h1 di bawah ini -->
    <h1>Isi Judul Lengkap</h1>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Pastikan selalu memasangkan tag pembuka dengan tag penutup yang tepat.</p>
HTML_EXPLANATION,
            ],
            'html_challenges' => [
                'title' => 'HTML Challenges',
                'summary' => 'Tantangan studi kasus nyata untuk mengasah kemampuan pemecahan masalah (problem solving).',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Tantangan 1: Bangun formulir reservasi tiket seminar yang memuat input nama, email, nomor WhatsApp, pilihan jenis tiket, dan tombol submit.</p>
HTML_CONTENT,
                'example_title' => 'Solusi Studi Kasus Tiket',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <h3>Form Reservasi Tiket</h3>
    <form action="#" onsubmit="event.preventDefault(); alert(\'Tiket Berhasil Dipesan!\');">
        <label>Nama:</label><br><input type="text" required><br><br>
        <label>Tipe Tiket:</label><br>
        <select><option>Reguler</option><option>VIP</option></select><br><br>
        <button type="submit">Pesan Tiket</button>
    </form>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Cobalah menambah bidang input tanggal dan jumlah kursi pada contoh di atas!</p>
HTML_EXPLANATION,
            ],
            'html_website' => [
                'title' => 'HTML Website',
                'summary' => 'Membangun website lengkap multi-halaman sederhana hanya dengan HTML murni.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Sebuah website utuh terdiri dari beberapa halaman (seperti Beranda, Tentang Kami, Layanan, dan Kontak) yang saling terhubung menggunakan tautan <code>&lt;a href="..."&gt;</code>.</p>
HTML_CONTENT,
                'example_title' => 'Navigasi Website Multi-Halaman',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <nav style="background:#0d2e5c; padding:10px;">
        <a href="index.html" style="color:white; margin-right:15px;">Beranda</a>
        <a href="tentang.html" style="color:white; margin-right:15px;">Tentang Kami</a>
        <a href="kontak.html" style="color:white;">Kontak</a>
    </nav>
    <h2>Selamat Datang di Beranda</h2>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Pastikan seluruh nama berkas tautan ditulis dengan huruf kecil dan tanpa spasi.</p>
HTML_EXPLANATION,
            ],
            'html_syllabus' => [
                'title' => 'HTML Syllabus',
                'summary' => 'Silabus lengkap kurikulum pembelajaran HTML dari tingkat dasar hingga standar industri.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Silabus pembelajaran HTML di Skillance Academy dirancang berdasarkan standar kurikulum W3Schools dan kebutuhan industri perangkat lunak modern.</p>
        <ol class="ps-3" style="line-height: 1.8;">
            <li><strong>Tahap 1:</strong> Fundamental HTML, Headings, Paragraf, Link, Gambar, dan Format Teks.</li>
            <li><strong>Tahap 2:</strong> Tabel Data, List, Elemen Block vs Inline, Class, dan ID.</li>
            <li><strong>Tahap 3:</strong> Struktur Semantik Modern, Layout, dan Desain Responsif.</li>
            <li><strong>Tahap 4:</strong> Formulir Interaktif & Validasi Input Lengkap.</li>
            <li><strong>Tahap 5:</strong> Grafis (Canvas & SVG) dan Multimedia (Video & Audio).</li>
            <li><strong>Tahap 6:</strong> Web APIs (Geolocation, Web Storage, Popover API).</li>
        </ol>
HTML_CONTENT,
                'example_title' => 'Roadmap Menjadi Web Developer',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <h3>Jalur Belajar Lengkap</h3>
    <p>HTML5 &rarr; CSS3 &rarr; JavaScript &rarr; Bursa Freelance</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Ikuti topik secara berurutan untuk mendapatkan pemahaman terbaik.</p>
HTML_EXPLANATION,
            ],
            'html_study_plan' => [
                'title' => 'HTML Study Plan',
                'summary' => 'Rencana belajar terarah 2 minggu untuk menguasai HTML secara konsisten.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Cukup luangkan waktu 30 hingga 45 menit setiap hari selama 2 minggu untuk menguasai seluruh materi HTML di platform ini.</p>
        <ul>
            <li><strong>Minggu 1:</strong> Menguasai HTML Tutorial (Home hingga Layout & Responsive).</li>
            <li><strong>Minggu 2:</strong> Menguasai Formulir, Grafis Canvas/SVG, Multimedia, dan Web Storage API.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Target Belajar Harian',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <p>Target: 3 Topik Per Hari + 1 Percobaan di Code Lab!</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Praktik langsung jauh lebih efektif daripada hanya sekadar membaca teori.</p>
HTML_EXPLANATION,
            ],
            'html_interview_prep' => [
                'title' => 'HTML Interview Prep',
                'summary' => 'Pertanyaan yang paling sering ditanyakan pewawancara kerja seputar HTML saat interview posisi Frontend Developer.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Persiapkan diri Anda menghadapi wawancara kerja teknis dengan mempelajari pertanyaan-pertanyaan HTML yang paling sering diajukan oleh HRD dan Tech Lead perusahaan teknologi:</p>
        <ol class="ps-3" style="line-height: 1.8;">
            <li><em>Apa perbedaan antara tag &lt;div&gt; dan &lt;span&gt;?</em> &rarr; Div adalah block-level, Span adalah inline-level.</li>
            <li><em>Mengapa atribut alt pada gambar wajib disertakan?</em> &rarr; Untuk aksesibilitas tunanetra dan SEO.</li>
            <li><em>Apa fungsi deklarasi &lt;!DOCTYPE html&gt;?</em> &rarr; Memberi tahu browser agar merender dalam mode standar HTML5.</li>
            <li><em>Jelaskan perbedaan sessionStorage dan localStorage!</em> &rarr; SessionStorage hilang saat tab ditutup, localStorage bersifat permanen.</li>
        </ol>
HTML_CONTENT,
                'example_title' => 'Contoh Jawaban Interview Teknis',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <h4>Siap Hadapi Wawancara Kerja</h4>
    <p>Kuasai fundamental semantik untuk memukau pewawancara teknis Anda.</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Pahami konsep di balik setiap tag, bukan hanya menghafal namanya.</p>
HTML_EXPLANATION,
            ],
            'html_summary' => [
                'title' => 'HTML Summary',
                'summary' => 'Rangkuman intisari seluruh materi HTML yang telah dipelajari sebagai contekan cepat (cheat sheet).',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Selamat! Anda telah mempelajari seluruh materi HTML berstandar W3Schools di Skillance Academy.</p>
        <h4>Rangkuman Singkat:</h4>
        <ul style="line-height: 1.8;">
            <li>HTML adalah kerangka struktur setiap halaman web di dunia.</li>
            <li>Gunakan selalu elemen semantik (<code>&lt;header&gt;</code>, <code>&lt;main&gt;</code>, <code>&lt;footer&gt;</code>).</li>
            <li>Bungkus input data di dalam formulir dengan tipe yang sesuai.</li>
            <li>Gunakan CSS untuk mempercantik tampilan dan JavaScript untuk interaktivitas dinamis.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Template Dokumen HTML5 Sempurna',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Sempurna</title>
</head>
<body>
    <header><h1>Skillance Academy</h1></header>
    <main><p>Selamat atas pencapaian belajar Anda!</p></main>
    <footer>&copy; 2026</footer>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Lanjutkan perjalanan belajar Anda ke materi berikutnya: <strong>CSS Tutorial</strong>!</p>
HTML_EXPLANATION,
            ],
            'html_accessibility' => [
                'title' => 'HTML Accessibility',
                'summary' => 'Membangun website yang ramah dan dapat diakses oleh penyandang disabilitas (aksesibilitas web WCAG).',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Aksesibilitas Web (dikenal sebagai <strong>a11y</strong>) adalah praktik memastikan website dapat digunakan oleh sebanyak mungkin orang, termasuk penyandang disabilitas penglihatan, pendengaran, atau motorik.</p>
        <h4>Praktik Terbaik Aksesibilitas HTML:</h4>
        <ul style="line-height: 1.8;">
            <li>Selalu pasangkan <code>&lt;label for="id"&gt;</code> pada setiap kontrol input.</li>
            <li>Selalu sertakan atribut <code>alt</code> deskriptif pada gambar.</li>
            <li>Gunakan elemen tombol <code>&lt;button&gt;</code> untuk aksi, bukan membuat <code>&lt;div onclick="..."&gt;</code> sembarangan.</li>
            <li>Pastikan rasio kontras warna teks terhadap latar belakang minimal 4.5:1.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Formulir Aksesibel (Ramah Disabilitas)',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <form>
        <label for="namaA11y">Nama Lengkap (Label ini membantu pembaca layar):</label><br>
        <input type="text" id="namaA11y" name="nama" aria-required="true">
    </form>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Website yang aksesibel disukai oleh Google dan memenuhi standar kepatuhan hukum digital internasional.</p>
HTML_EXPLANATION,
                'quiz' => [
                    'q' => 'Elemen apa yang wajib dipasangkan dengan input formulir untuk membantu pengguna pembaca layar tunanetra?',
                    'options' => ['<label>', '<span>', '<hint>', '<title>'],
                    'answer' => 0,
                    'explanation' => 'Tag <label for=\'...\'> memungkinkan screen reader membacakan fungsi kolom input kepada pengguna tuna netra.'
                ],
            ],
        ],
        'HTML References' => [
            'ref_tag_list' => [
                'title' => 'HTML Tag List',
                'summary' => 'Daftar referensi lengkap tag-tag HTML5 berurutan secara alfabetis (A-Z) beserta fungsinya.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Berikut adalah daftar referensi lengkap tag-tag HTML standar:</p>
        <table class="table table-bordered table-sm small">
            <thead class="table-light"><tr><th>Tag</th><th>Deskripsi</th></tr></thead>
            <tbody>
                <tr><td><code>&lt;!--...--&gt;</code></td><td>Mendefinisikan komentar di dalam kode</td></tr>
                <tr><td><code>&lt;!DOCTYPE&gt;</code></td><td>Mendefinisikan tipe dokumen HTML</td></tr>
                <tr><td><code>&lt;a&gt;</code></td><td>Mendefinisikan tautan hyperlink</td></tr>
                <tr><td><code>&lt;abbr&gt;</code></td><td>Mendefinisikan singkatan atau akronim</td></tr>
                <tr><td><code>&lt;article&gt;</code></td><td>Mendefinisikan artikel konten mandiri</td></tr>
                <tr><td><code>&lt;aside&gt;</code></td><td>Mendefinisikan konten sampingan (sidebar)</td></tr>
                <tr><td><code>&lt;audio&gt;</code></td><td>Menyematkan konten suara / musik</td></tr>
                <tr><td><code>&lt;b&gt;</code></td><td>Membuat teks tebal (bold)</td></tr>
                <tr><td><code>&lt;button&gt;</code></td><td>Mendefinisikan tombol yang dapat diklik</td></tr>
                <tr><td><code>&lt;canvas&gt;</code></td><td>Kanvas grafis yang digambar via JavaScript</td></tr>
                <tr><td><code>&lt;div&gt;</code></td><td>Wadah kontainer bagian blok halaman</td></tr>
                <tr><td><code>&lt;form&gt;</code></td><td>Wadah formulir masukan pengguna</td></tr>
                <tr><td><code>&lt;h1&gt; - &lt;h6&gt;</code></td><td>Judul halaman dari tingkat 1 s/d 6</td></tr>
                <tr><td><code>&lt;img&gt;</code></td><td>Menyematkan berkas gambar</td></tr>
                <tr><td><code>&lt;input&gt;</code></td><td>Kontrol masukan data formulir</td></tr>
                <tr><td><code>&lt;p&gt;</code></td><td>Mendefinisikan paragraf teks</td></tr>
                <tr><td><code>&lt;table&gt;</code></td><td>Mendefinisikan tabel data relasional</td></tr>
                <tr><td><code>&lt;ul&gt; & &lt;ol&gt;</code></td><td>Daftar butir (bullet) dan daftar nomor</td></tr>
                <tr><td><code>&lt;video&gt;</code></td><td>Menyematkan berkas video film/rekaman</td></tr>
            </tbody>
        </table>
HTML_CONTENT,
                'example_title' => 'Contoh Penggunaan Tag Referensi',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <p>Gunakan daftar referensi tag untuk menemukan tag yang tepat bagi kebutuhan konten Anda.</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Simpan halaman referensi ini sebagai contekan cepat saat menyusun proyek web Anda.</p>
HTML_EXPLANATION,
            ],
            'ref_attributes' => [
                'title' => 'HTML Attributes',
                'summary' => 'Referensi atribut elemen HTML standar: href, src, alt, style, id, class, name, type, value.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Daftar referensi atribut yang paling sering digunakan pada elemen-elemen HTML beserta pasangan tag yang mendukungnya.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Atribut Standar',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <a href="#" target="_blank" title="Tooltip Contoh">Tautan dengan atribut lengkap</a>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Atribut memodifikasi perilaku dan tampilan elemen HTML.</p>
HTML_EXPLANATION,
            ],
            'ref_global_attributes' => [
                'title' => 'HTML Global Attributes',
                'summary' => 'Atribut global yang dapat dipasang pada SEMUA elemen HTML: class, id, title, style, hidden, data-*.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Atribut global adalah atribut yang dapat digunakan pada <strong>seluruh</strong> elemen HTML tanpa terkecuali.</p>
        <ul style="line-height: 1.8;">
            <li><code>class</code> : Menentukan satu atau lebih nama kelas CSS.</li>
            <li><code>id</code> : Menentukan pengenal unik untuk elemen.</li>
            <li><code>style</code> : Menambahkan aturan inline CSS langsung.</li>
            <li><code>title</code> : Menampilkan tooltip informasi saat kursor melayang di atas elemen.</li>
            <li><code>hidden</code> : Menyembunyikan elemen dari pandangan pengguna.</li>
            <li><code>data-*</code> : Menyimpan data kustom pribadi untuk JavaScript.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Penggunaan Atribut Global',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <p title="Ini teks tooltip atribut global">Arahkan kursor Anda ke teks ini!</p>
    <p hidden>Teks ini disembunyikan menggunakan atribut hidden.</p>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Atribut <code>hidden</code> setara dengan aturan CSS <code>display: none;</code>.</p>
HTML_EXPLANATION,
            ],
            'ref_browsersupport' => [
                'title' => 'HTML Browser Support',
                'summary' => 'Tabel kompatibilitas elemen-elemen HTML5 di browser Google Chrome, Edge, Firefox, Safari, dan Opera.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Seluruh elemen HTML5 modern yang diajarkan pada tutorial ini didukung 100% oleh semua peramban (browser) modern di desktop maupun smartphone.</p>
HTML_CONTENT,
                'example_title' => 'Uji Dukungan Browser',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <p>Browser Anda mendukung HTML5 secara penuh!</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Platform Skillance Academy diuji secara berkala untuk kompatibilitas multi-browser.</p>
HTML_EXPLANATION,
            ],
            'ref_eventattributes' => [
                'title' => 'HTML Event Attributes',
                'summary' => 'Referensi atribut event interaktif: onclick, onchange, onsubmit, onkeydown, onload, onmouseover.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Atribut event memungkinkan Anda mengeksekusi kode JavaScript ketika aksi tertentu terjadi (seperti klik mouse atau ketukan keyboard).</p>
        <ul>
            <li><strong>Mouse Events:</strong> <code>onclick</code>, <code>ondblclick</code>, <code>onmouseover</code>, <code>onmouseout</code>.</li>
            <li><strong>Keyboard Events:</strong> <code>onkeydown</code>, <code>onkeyup</code>.</li>
            <li><strong>Form Events:</strong> <code>onsubmit</code>, <code>onchange</code>, <code>onfocus</code>, <code>onblur</code>.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Contoh Atribut Event Mouseover',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>

    <div onmouseover="this.style.background=\'#fca311\'" 
         onmouseout="this.style.background=\'#0d2e5c\'" 
         style="background:#0d2e5c; color:white; padding:15px; border-radius:8px; text-align:center; cursor:pointer;">
        Arahkan mouse ke kotak ini!
    </div>

</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Event membuat antarmuka terasa hidup dan responsif terhadap aksi pengguna.</p>
HTML_EXPLANATION,
            ],
            'ref_colors' => [
                'title' => 'HTML Colors',
                'summary' => 'Referensi 140 nama warna web standar lengkap dengan kode HEX dan nilai RGB resminya.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">HTML dan CSS mendukung 140 nama warna standar resmi W3C yang dapat langsung dituliskan tanpa kode hex (misal: Red, Green, Blue, Navy, Gold, Coral, Teal, Crimson).</p>
HTML_CONTENT,
                'example_title' => 'Daftar Warna Standar Populer',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <span style="color:Crimson;">&#9632; Crimson</span> | 
    <span style="color:DodgerBlue;">&#9632; DodgerBlue</span> | 
    <span style="color:MediumSeaGreen;">&#9632; MediumSeaGreen</span>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Nama warna ini mempermudah pemberian warna cepat saat membuat prototipe.</p>
HTML_EXPLANATION,
            ],
            'ref_canvas' => [
                'title' => 'HTML Canvas',
                'summary' => 'Referensi method dan properti Canvas 2D: fillRect, strokeText, beginPath, arc, lineTo.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Referensi fungsi-fungsi penting HTML5 Canvas 2D API untuk menggambar bentuk, teks, dan gradasi warna.</p>
HTML_CONTENT,
                'example_title' => 'Contoh Kotak Gradasi Canvas',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <canvas id="cv" width="200" height="80" style="border:1px solid #ccc;"></canvas>
    <script>
        const ctx = document.getElementById(\'cv\').getContext(\'2d\');
        ctx.fillStyle = \'#0d2e5c\';
        ctx.fillRect(10, 10, 180, 60);
    </script>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Gunakan method <code>fillRect(x, y, w, h)</code> untuk menggambar persegi pekat.</p>
HTML_EXPLANATION,
            ],
            'ref_av_dom' => [
                'title' => 'HTML Audio/Video',
                'summary' => 'Referensi method pemutar media JavaScript: play(), pause(), duration, currentTime, muted.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Method dan properti JavaScript untuk mengontrol pemutar video dan audio HTML5 secara terprogram.</p>
HTML_CONTENT,
                'example_title' => 'Mengontrol Video dengan JavaScript Murni',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <video id="vid" width="240" src="https://www.w3schools.com/html/mov_bbb.mp4"></video><br>
    <button onclick="document.getElementById(\'vid\').play()">Play</button>
    <button onclick="document.getElementById(\'vid\').pause()">Pause</button>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Anda dapat membuat tombol kustom Anda sendiri untuk mengontrol video!</p>
HTML_EXPLANATION,
            ],
            'ref_doctypes' => [
                'title' => 'HTML Doctypes',
                'summary' => 'Referensi deklarasi DOCTYPE dari era HTML 4.01, XHTML 1.0, hingga deklarasi modern HTML5.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Di era lama, deklarasi DOCTYPE sangat panjang dan rumit karena mengacu ke DTD eksternal. HTML5 menyederhanakannya menjadi hanya 15 karakter yang sangat mudah diingat:</p>
        <div class="p-3 bg-light rounded-3 font-monospace small mb-3">&lt;!DOCTYPE html&gt;</div>
HTML_CONTENT,
                'example_title' => 'Deklarasi Ringkas HTML5',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <p>Deklarasi HTML5 tidak membedakan huruf besar maupun huruf kecil (case-insensitive).</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Selalu letakkan deklarasi DOCTYPE tepat di baris paling pertama dokumen HTML Anda.</p>
HTML_EXPLANATION,
            ],
            'ref_charactersets' => [
                'title' => 'HTML Character Sets',
                'summary' => 'Tabel perbandingan encoding karakter komputer: ASCII (0-127), ANSI (0-255), dan UTF-8 universal.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Daftar lengkap set karakter komputer dari masa ke masa dan cara browser membaca setiap byte data menjadi karakter yang dapat dibaca manusia.</p>
HTML_CONTENT,
                'example_title' => 'Simulasi Set Karakter',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <p>UTF-8 adalah standar emas untuk seluruh web di dunia.</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Selalu gunakan UTF-8 untuk menjamin kompatibilitas global.</p>
HTML_EXPLANATION,
            ],
            'ref_urlencode' => [
                'title' => 'HTML URL Encode',
                'summary' => 'Tabel referensi kode persen ASCII URL Encoding untuk karakter simbol dan spasi.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Daftar kode heksadesimal URL encode untuk karakter yang tidak diizinkan di URL:</p>
        <table class="table table-bordered table-sm small">
            <thead class="table-light"><tr><th>Karakter</th><th>Hasil URL Encode</th></tr></thead>
            <tbody>
                <tr><td>Spasi ( )</td><td><code>%20</code> atau <code>+</code></td></tr>
                <tr><td>Tanda Seru (!)</td><td><code>%21</code></td></tr>
                <tr><td>Tanda Pagar (#)</td><td><code>%23</code></td></tr>
                <tr><td>Tanda Dolar ($)</td><td><code>%24</code></td></tr>
                <tr><td>Tanda Tanya (?)</td><td><code>%3F</code></td></tr>
            </tbody>
        </table>
HTML_CONTENT,
                'example_title' => 'Pengujian URL Encode',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <p>Karakter khusus otomatis di-encode saat formulir dengan method GET dikirimkan.</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>URL encoding memastikan URL dapat ditransmisikan secara aman melalui protokol HTTP.</p>
HTML_EXPLANATION,
            ],
            'ref_language_codes' => [
                'title' => 'HTML Language Codes',
                'summary' => 'Kode bahasa standar ISO 639-1 untuk atribut lang pada tag html: id (Indonesia), en (English), ar (Arabic).',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Atribut <code>lang</code> pada tag <code>&lt;html&gt;</code> memberitahukan bahasa utama dokumen kepada mesin pencari dan aplikasi pembaca layar.</p>
        <ul>
            <li><code>id</code> : Bahasa Indonesia (misal: <code>&lt;html lang="id"&gt;</code>)</li>
            <li><code>en</code> : Bahasa Inggris (English)</li>
            <li><code>ar</code> : Bahasa Arab (Arabic)</li>
            <li><code>ja</code> : Bahasa Jepang (Japanese)</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Penerapan Atribut Bahasa',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html lang="id">
<body>
    <p>Halaman ini dideklarasikan menggunakan Bahasa Indonesia resmi.</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Mesin pencari menggunakan atribut ini untuk menyajikan hasil pencarian yang relevan dengan bahasa pengguna.</p>
HTML_EXPLANATION,
            ],
            'ref_country_codes' => [
                'title' => 'HTML Country Codes',
                'summary' => 'Kode negara ISO 3166-1 untuk spesifikasi dialek bahasa regional: id-ID, en-US, en-GB.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Kode negara dapat ditambahkan di belakang kode bahasa untuk memperjelas dialek lokal wilayah, contohnya:</p>
        <ul>
            <li><code>id-ID</code> : Bahasa Indonesia resmi di Republik Indonesia</li>
            <li><code>en-US</code> : Bahasa Inggris dialek Amerika Serikat</li>
            <li><code>en-GB</code> : Bahasa Inggris dialek Britania Raya (UK)</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Atribut Bahasa dengan Dialek Negara',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html lang="id-ID">
<body>
    <p>Dokumen dengan deklarasi dialek resmi Indonesia (id-ID).</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Sangat berguna untuk pengucapan yang tepat pada perangkat lunak text-to-speech.</p>
HTML_EXPLANATION,
            ],
            'ref_httpmessages' => [
                'title' => 'HTTP Status Codes',
                'summary' => 'Daftar kode status respon server HTTP: 200 OK, 301 Redirect, 400 Bad Request, 404 Not Found, 500 Server Error.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Ketika browser meminta halaman ke server web, server mengembalikan kode status numerik 3 digit:</p>
        <table class="table table-bordered table-sm small">
            <thead class="table-light"><tr><th>Kode</th><th>Arti Respon</th></tr></thead>
            <tbody>
                <tr><td><code>200 OK</code></td><td>Permintaan berhasil dan halaman sukses dikirimkan</td></tr>
                <tr><td><code>201 Created</code></td><td>Data baru berhasil dibuat (biasanya dari request POST)</td></tr>
                <tr><td><code>301 Moved Permanently</code></td><td>Halaman telah dipindahkan permanen ke URL baru</td></tr>
                <tr><td><code>400 Bad Request</code></td><td>Permintaan klien tidak valid atau data rusak</td></tr>
                <tr><td><code>401 Unauthorized</code></td><td>Wajib login atau otentikasi terlebih dahulu</td></tr>
                <tr><td><code>403 Forbidden</code></td><td>Akses ditolak oleh server (tidak memiliki izin)</td></tr>
                <tr><td><code>404 Not Found</code></td><td>Halaman atau berkas tidak ditemukan di server</td></tr>
                <tr><td><code>500 Internal Error</code></td><td>Terjadi galat pada script di server backend</td></tr>
            </tbody>
        </table>
HTML_CONTENT,
                'example_title' => 'Pesan Status HTTP',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <p>Kode 200 OK berarti halaman web yang Anda lihat berhasil dimuat dengan sukses.</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Memahami HTTP Status Code adalah keahlian wajib bagi setiap calon web developer profesional.</p>
HTML_EXPLANATION,
            ],
            'ref_httpmethods' => [
                'title' => 'HTTP Request Methods',
                'summary' => 'Metode permintaan HTTP standar: GET, POST, PUT, DELETE, PATCH, OPTIONS, HEAD.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Protokol HTTP mendefinisikan sekumpulan metode request untuk menunjukkan tindakan yang diinginkan pada resource server.</p>
        <ul>
            <li><code>GET</code> : Meminta dan mengambil data dari server.</li>
            <li><code>POST</code> : Mengirimkan data baru ke server untuk disimpan.</li>
            <li><code>PUT</code> : Memperbarui resource data yang sudah ada secara menyeluruh.</li>
            <li><code>DELETE</code> : Menghapus data spesifik dari server.</li>
        </ul>
HTML_CONTENT,
                'example_title' => 'Metode HTTP RESTful',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <p>Metode GET dan POST adalah dua metode yang didukung langsung oleh tag &lt;form&gt; HTML.</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Formulir HTML standar mendukung metode GET dan POST, sedangkan API modern mendukung PUT dan DELETE via Fetch API.</p>
HTML_EXPLANATION,
            ],
            'ref_pxtoem' => [
                'title' => 'PX to EM Converter',
                'summary' => 'Panduan konversi satuan ukuran piksel (px) ke satuan relatif em dan rem untuk tipografi responsif.',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Ukuran font dasar default di sebagian besar browser adalah <strong>16px</strong>. Satuan relatif <code>em</code> dan <code>rem</code> dihitung berdasarkan ukuran font dasar ini.</p>
        <div class="card p-3 bg-light rounded-3 my-3 small">
            <strong>Rumus Konversi:</strong><br>
            <code>1em = 16px</code> | <code>0.875em = 14px</code> | <code>1.25em = 20px</code> | <code>1.5em = 24px</code> | <code>2em = 32px</code>
        </div>
HTML_CONTENT,
                'example_title' => 'Tipografi Relatif dengan EM / REM',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-size: 16px; }
        .judul { font-size: 2rem; } /* 2 x 16px = 32px */
        .sub { font-size: 0.875rem; } /* 0.875 x 16px = 14px */
    </style>
</head>
<body>
    <h2 class="judul">Judul Berukuran 2rem (32px)</h2>
    <p class="sub">Teks catatan berukuran 0.875rem (14px).</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Satuan rem sangat ramah aksesibilitas karena jika pengguna mengubah ukuran font default browsernya, seluruh teks website akan otomatis menyesuaikan diri.</p>
HTML_EXPLANATION,
            ],
            'ref_keyboardshortcuts' => [
                'title' => 'Keyboard Shortcuts',
                'summary' => 'Pintasan papan ketik penting bagi pengembang web untuk mempercepat proses koding (VS Code & Browser DevTools).',
                'content' => <<<'HTML_CONTENT'
<p class="lead">Gunakan tombol pintasan keyboard berikut untuk meningkatkan produktivitas penulisan kode Anda hingga 3x lebih cepat:</p>
        <table class="table table-bordered table-sm small">
            <thead class="table-light"><tr><th>Pintasan</th><th>Fungsi Tindakan</th></tr></thead>
            <tbody>
                <tr><td><kbd>Ctrl</kbd> + <kbd>S</kbd></td><td>Menyimpan berkas yang sedang diedit</td></tr>
                <tr><td><kbd>Ctrl</kbd> + <kbd>Enter</kbd></td><td>Menjalankan kode langsung di Skillance Tryit Editor</td></tr>
                <tr><td><kbd>F12</kbd> atau <kbd>Ctrl</kbd> + <kbd>Shift</kbd> + <kbd>I</kbd></td><td>Membuka Chrome Developer Tools (Console & Inspector)</td></tr>
                <tr><td><kbd>Ctrl</kbd> + <kbd>/</kbd></td><td>Membuat baris komentar otomatis</td></tr>
                <tr><td><kbd>Ctrl</kbd> + <kbd>Z</kbd> & <kbd>Ctrl</kbd> + <kbd>Y</kbd></td><td>Membatalkan (Undo) & Mengulangi (Redo) perubahan</td></tr>
            </tbody>
        </table>
HTML_CONTENT,
                'example_title' => 'Pintasan Keyboard untuk Developer',
                'example_code' => <<<'HTML_CODE'
<!DOCTYPE html>
<html>
<body>
    <p>Tekan <kbd>Ctrl</kbd> + <kbd>Enter</kbd> untuk menjalankan kode ini sekarang!</p>
</body>
</html>
HTML_CODE,
                'explanation' => <<<'HTML_EXPLANATION'
<p>Menghafal pintasan keyboard adalah ciri khas programmer yang efisien dan profesional.</p>
HTML_EXPLANATION,
            ],
        ],
    ]
];
