<?php
/**
 * Silabus Lengkap Tutorial PHP & MySQL - Skillance Academy Indonesia
 * Semua Materi & Contoh Kode Menggunakan Sintaks Murni PHP 8.2 & Modern Best Practices
 */

return json_decode(<<<'JSON_DATA'
{
  "categories": {
    "PHP Tutorial": {
      "php_home": {
        "title": "PHP HOME",
        "summary": "Selamat Datang di Tutorial PHP Skillance Academy. PHP adalah bahasa pemrograman server-side paling banyak digunakan di dunia.",
        "content": "<p class=\"lead\">Selamat datang di <strong>Tutorial PHP & MySQL Lengkap</strong> Skillance Academy resmi dari Skillance Academy Indonesia. PHP (Hypertext Preprocessor) adalah bahasa scripting sisi server yang menjadi tulang punggung lebih dari 75% website di internet, termasuk WordPress, Wikipedia, dan Facebook.</p>\n    <div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n        <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-brands fa-php text-primary me-2\"></i>Keunggulan Belajar PHP di Skillance Academy:</h6>\n        <ul class=\"mb-0 ps-3 small\" style=\"line-height: 1.8;\">\n            <li><strong>Mudah Dipelajari</strong>: Sintaks ramah pemula namun sangat bertenaga untuk aplikasi skala enterprise.</li>\n            <li><strong>Integrasi Database Alami</strong>: Dukungan bawaan terbaik untuk MySQL, PostgreSQL, SQLite, dan SQL Server.</li>\n            <li><strong>Fondasi Framework Modern</strong>: Menguasai PHP murni (Native) adalah syarat utama sebelum melangkah ke Laravel 11.</li>\n        </ul>\n    </div>",
        "example_title": "Contoh Kode PHP HOME",
        "example_code": "<?php\n\n        echo \"Selamat Datang di Skillance Academy PHP Tutorial! 🐘\";\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_intro": {
        "title": "PHP Intro",
        "summary": "Pengenalan dasar PHP: Apa itu PHP, bagaimana cara kerjanya di server, dan mengapa PHP sangat populer.",
        "content": "<p class=\"lead\">PHP adalah bahasa skrip server-side open-source. File PHP dapat berisi teks, tag HTML, CSS, JavaScript, dan kode PHP. Kode PHP dieksekusi di server web dan hasilnya dikirimkan ke peramban dalam bentuk HTML murni.</p>",
        "example_title": "Contoh Kode PHP Intro",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 25px; line-height: 1.6;\">\n    <h2>Bagaimana PHP Bekerja?</h2>\n    <ol>\n        <li>Klien (Browser) meminta halaman <code>index.php</code> ke web server.</li>\n        <li>Web server memproses kode PHP di server dan mengambil data dari database MySQL.</li>\n        <li>Server mengirimkan halaman HTML yang sudah jadi ke pengguna.</li>\n    </ol>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_install": {
        "title": "PHP Install",
        "summary": "Menyiapkan lingkungan server lokal PHP menggunakan Laragon, XAMPP, atau PHP CLI bawaan.",
        "content": "<p class=\"lead\">Untuk menjalankan PHP di komputer lokal, Anda membutuhkan Web Server (Apache/Nginx), PHP runtime, dan Database MySQL. Paket Laragon atau XAMPP menyediakan ketiga komponen ini secara instan dalam satu instalasi.</p>",
        "example_title": "Contoh Kode PHP Install",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #1e293b; color: #38bdf8;\">\n    <h3>// Mengecek Versi PHP di Terminal / Command Prompt</h3>\n    <p>$ php -v<br>\n    PHP 8.2.12 (cli) (built: Sep 26 2023 20:30:34) (NTS Visual C++ 2019 x64)<br>\n    Copyright (c) The PHP Group<br>\n    Zend Engine v4.2.12, Copyright (c) Zend Technologies</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_syntax": {
        "title": "PHP Syntax",
        "summary": "Sintaks dasar PHP: Tag pembuka <?php, tag penutup ?>, titik koma (;), dan aturan case sensitivity.",
        "content": "<p class=\"lead\">Perintah PHP wajib diakhiri dengan tanda titik koma (<code>;</code>). Di PHP, nama fungsi dan kata kunci (if, else, echo) tidak case-sensitive, tetapi <strong>nama variabel bersifat Case-Sensitive</strong> (<code>$warna</code> berbeda dengan <code>$WARNA</code>).</p>",
        "example_title": "Contoh Kode PHP Syntax",
        "example_code": "<?php\n\n        $pesan = \"Halo Dunia!\";\n\n        echo $pesan;\n\n        ?>\n    \n    Hasil: Halo Dunia!",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_comments": {
        "title": "PHP Comments",
        "summary": "Penulisan komentar di PHP: Komentar satu baris (// dan #) serta komentar banyak baris (/* ... */).",
        "content": "<p class=\"lead\">Komentar adalah baris catatan kode yang diabaikan oleh mesin PHP saat eksekusi. Sangat berguna untuk dokumentasi logika program.</p>",
        "example_title": "Contoh Kode PHP Comments",
        "example_code": "<?php\n\n    // Ini komentar satu baris\n\n    # Ini juga komentar satu baris\n\n    /* Ini adalah komentar\n\n       banyak baris untuk dokumentasi fungsi */\n\n    echo \"Komentar tidak ditampilkan di browser!\";\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_variables": {
        "title": "PHP Variables",
        "summary": "Mendeklarasikan variabel dengan awalan $, aturan penamaan variabel, dan ruang lingkup variabel (Scope).",
        "content": "<p class=\"lead\">Variabel PHP dimulai dengan tanda <code>$</code> diikuti nama variabel. Nama variabel harus dimulai dengan huruf atau garis bawah (_), dan tidak boleh diawali dengan angka.</p>",
        "example_title": "Contoh Kode PHP Variables",
        "example_code": "<?php\n\n        $nama = \"Faisal\";\n\n        $umur = 21;\n\n        echo \"Nama: \" . $nama . \", Usia: \" . $umur . \" tahun\";\n\n        ?>\n    \n    Output: Nama: Faisal, Usia: 21 tahun",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_echo_print": {
        "title": "PHP Echo / Print",
        "summary": "Perbedaan antara pernyataan echo dan print untuk mencetak teks atau HTML ke browser.",
        "content": "<p class=\"lead\"><code>echo</code> dan <code>print</code> kurang lebih sama untuk mencetak output, namun <code>echo</code> tidak memiliki nilai kembali (void) dan sedikit lebih cepat serta dapat menerima banyak parameter argumen sekaligus.</p>",
        "example_title": "Contoh Kode PHP Echo / Print",
        "example_code": "<?php echo \"<h3 style='color:#0d2e5c;'>Dicetak dengan Echo</h3>\"; ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_datatypes": {
        "title": "PHP Data Types",
        "summary": "Tipe data bawaan PHP: String, Integer, Float, Boolean, Array, Object, NULL, dan Resource.",
        "content": "<p class=\"lead\">Gunakan fungsi <code>var_dump()</code> untuk memeriksa tipe data dan nilai yang dikandung oleh suatu variabel secara mendalam.</p>",
        "example_title": "Contoh Kode PHP Data Types",
        "example_code": "<?php\n\n    $x = 5985;\n\n    var_dump($x); // int(5985)\n\n\n    $y = 10.365;\n\n    var_dump($y); // float(10.365)\n\n\n    $z = true;\n\n    var_dump($z); // bool(true)\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_strings": {
        "title": "PHP Strings",
        "summary": "Manipulasi teks string: strlen(), str_word_count(), strrev(), strpos(), str_replace(), dan penggabungan titik (.).",
        "content": "<p class=\"lead\">Teks string di PHP digabungkan menggunakan operator titik (<code>.</code>). String yang diapit petik ganda <code>\"...\"</code> akan mengevaluasi variabel di dalamnya, sedangkan petik tunggal <code>'...'</code> dicetak secara harfiah.</p>",
        "example_title": "Contoh Kode PHP Strings",
        "example_code": "<?php\n\n        $teks = \"Skillance Academy Indonesia\";\n\n        echo \"Panjang karakter: \" . strlen($teks) . \"<br>\";\n\n        echo \"Jumlah kata: \" . str_word_count($teks) . \"<br>\";\n\n        echo \"Ganti kata: \" . str_replace(\"Indonesia\", \"Digital\", $teks);\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_numbers": {
        "title": "PHP Numbers",
        "summary": "Bekerja dengan angka: Integer, Float, is_int(), is_numeric(), dan batasan PHP_INT_MAX.",
        "content": "<p class=\"lead\">PHP secara otomatis mengonversi tipe angka sesuai konteks operasinya (type juggling). Fungsi <code>is_numeric()</code> memeriksa apakah nilai string merupakan angka yang sah.</p>",
        "example_title": "Contoh Kode PHP Numbers",
        "example_code": "<?php\n\n    $harga = \"50000\";\n\n    echo is_numeric($harga) ? \"Angka valid\" : \"Bukan angka\";\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_casting": {
        "title": "PHP Casting",
        "summary": "Mengubah tipe data variabel secara eksplisit: (string), (int), (float), (bool), (array).",
        "content": "<p class=\"lead\">Type Casting memaksa konversi suatu variabel ke tipe data tertentu, misalnya mengubah string <code>\"25\"</code> menjadi integer dengan <code>(int)$str</code>.</p>",
        "example_title": "Contoh Kode PHP Casting",
        "example_code": "<?php\n\n    $a = 5;\n\n    $b = 5.34;\n\n    $c = \"25 kilometer\";\n\n\n    $a = (string) $a; // berubah jadi \"5\"\n\n    $b = (int) $b;    // berubah jadi 5 (desimal dibuang)\n\n    $c = (int) $c;    // berubah jadi 25\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_math": {
        "title": "PHP Math",
        "summary": "Fungsi matematika bawaan: pi(), min(), max(), abs(), sqrt(), round(), dan rand().",
        "content": "<p class=\"lead\">PHP menyediakan fungsi matematis lengkap seperti <code>rand(10, 100)</code> untuk menghasilkan angka acak antara 10 sampai 100.</p>",
        "example_title": "Contoh Kode PHP Math",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Fungsi Matematika PHP</h2>\n    <ul>\n        <li><code>min(0, 150, 30, 20, -8, -200)</code> -> <strong>-200</strong></li>\n        <li><code>sqrt(64)</code> -> <strong>8</strong></li>\n        <li><code>round(0.60)</code> -> <strong>1</strong></li>\n        <li><code>rand(1, 6)</code> -> <strong>Acak Angka Dadu</strong></li>\n    </ul>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_constants": {
        "title": "PHP Constants",
        "summary": "Mendefinisikan konstanta global yang tidak dapat diubah nilainya menggunakan define() atau const.",
        "content": "<p class=\"lead\">Konstanta otomatis bersifat global dan dapat diakses di seluruh skrip tanpa perlu deklarasi <code>global</code>. Secara konvensi ditulis dengan huruf kapital.</p>",
        "example_title": "Contoh Kode PHP Constants",
        "example_code": "<?php\n\n        define(\"NAMA_PORTAL\", \"Skillance Academy\");\n\n        const VERSI_APP = \"2.0\";\n\n        echo NAMA_PORTAL . \" Versi \" . VERSI_APP;\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_magic_constants": {
        "title": "PHP Magic Constants",
        "summary": "Konstanta ajaib bawaan PHP yang nilainya berubah sesuai konteks tempat ia dipanggil: __DIR__, __FILE__, __LINE__, __FUNCTION__, __CLASS__.",
        "content": "<p class=\"lead\">Konstanta ajaib seperti <code>__DIR__</code> sangat penting saat menyertakan file (include/require) dengan path absolut yang aman.</p>",
        "example_title": "Contoh Kode PHP Magic Constants",
        "example_code": "<?php\n\n    echo \"Folder saat ini: \" . __DIR__ . \"<br>\";\n\n    echo \"File saat ini: \" . __FILE__ . \"<br>\";\n\n    echo \"Baris kode saat ini: \" . __LINE__;\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_operators": {
        "title": "PHP Operators",
        "summary": "Operator di PHP: Aritmatika, Penugasan, Perbandingan (==, ===, <=> Spaceship), Logika, String, dan Null Coalescing (??).",
        "content": "<p class=\"lead\">Operator Spaceship <code>$a <=> $b</code> mengembalikan -1 jika a &lt; b, 0 jika a == b, dan 1 jika a &gt; b. Operator Null Coalescing <code>$x ?? 'default'</code> mencegah notice undefined variable.</p>",
        "example_title": "Contoh Kode PHP Operators",
        "example_code": "<?php\n\n    $user = $_GET['user'] ?? 'Tamu Mahasiswa';\n\n    echo \"Halo, \" . $user;\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_if_else": {
        "title": "PHP If...Else...Elseif",
        "summary": "Percabangan logika kondisional untuk mengambil alur eksekusi berdasarkan evaluasi boolean.",
        "content": "<p class=\"lead\">Pernyataan <code>if</code> mengeksekusi blok kode jika kondisi benar. Gunakan <code>elseif</code> untuk menguji beberapa kondisi bertingkat.</p>",
        "example_title": "Contoh Kode PHP If...Else...Elseif",
        "example_code": "<?php\n\n    $skor = 85;\n\n    if ($skor >= 80) {\n\n      echo \"Predikat: A (Lulus Memuaskan)\";\n\n    } else {\n\n      echo \"Predikat: B\";\n\n    }\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_switch": {
        "title": "PHP Switch",
        "summary": "Struktur pemilihan banyak blok kode alternatif berdasarkan kesamaan satu nilai variabel.",
        "content": "<p class=\"lead\">Pernyataan <code>switch</code> mengevaluasi ekspresi satu kali dan membandingkan nilainya dengan setiap klausa <code>case</code>. Gunakan <code>break</code> untuk mencegah fallthrough.</p>",
        "example_title": "Contoh Kode PHP Switch",
        "example_code": "<?php\n\n        $role = \"admin\";\n\n        switch ($role) {\n\n          case \"admin\": echo \"Akses penuh sistem\"; break;\n\n          case \"member\": echo \"Akses belajar\"; break;\n\n          default: echo \"Akses tamu\";\n\n        }\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_match": {
        "title": "PHP Match",
        "summary": "Ekspresi modern pencocokan nilai di PHP 8+ yang lebih ringkas dan menggunakan perbandingan ketat (===).",
        "content": "<p class=\"lead\">Ekspresi <code>match</code> diperkenalkan pada PHP 8.0 sebagai alternatif modern dari switch. Match mengembalikan nilai, tidak memerlukan break, dan mengevaluasi kesetaraan tipe secara ketat.</p>",
        "example_title": "Contoh Kode PHP Match",
        "example_code": "<?php\n\n        $status = 200;\n\n        $pesan = match ($status) {\n\n          200 => 'OK Berhasil',\n\n          404 => 'Halaman Tidak Ditemukan',\n\n          500 => 'Server Error',\n\n          default => 'Status Tidak Dikenal'\n\n        };\n\n        echo $pesan;\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_loops": {
        "title": "PHP Loops",
        "summary": "Perulangan di PHP: while, do...while, for, dan foreach untuk mengiterasi elemen array.",
        "content": "<p class=\"lead\">Perulangan <code>foreach</code> dirancang khusus dan paling efisien untuk menelusuri array di PHP, baik array terindeks maupun array asosiatif (key => value).</p>",
        "example_title": "Contoh Kode PHP Loops",
        "example_code": "<?php\n\n        $modul = [\"HTML\" => 90, \"CSS\" => 125, \"JavaScript\" => 49];\n\n        foreach ($modul as $nama => $jumlah) {\n\n          echo \"$nama: $jumlah topik<br>\";\n\n        }\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_functions": {
        "title": "PHP Functions",
        "summary": "Mendeklarasikan fungsi, argumen parameter, nilai default parameter, type hinting, dan return type.",
        "content": "<p class=\"lead\">PHP 7 dan 8 mendukung deklarasi tipe ketat (Type Declarations) pada parameter fungsi dan nilai kembali untuk mencegah bug logika.</p>",
        "example_title": "Contoh Kode PHP Functions",
        "example_code": "<?php\n\n        function hitungTotal(int $harga, int $jumlah): int {\n\n          return $harga * $jumlah;\n\n        }\n\n        echo \"Total: Rp \" . number_format(hitungTotal(50000, 3), 0, ',', '.');\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_arrays": {
        "title": "PHP Arrays",
        "summary": "Struktur data array: Indexed Arrays, Associative Arrays, Multidimensional Arrays, dan fungsi array (count, array_push, in_array, array_merge).",
        "content": "<p class=\"lead\">Array asosiatif menggunakan kunci bernama (string) untuk mengakses nilainya, sangat sering digunakan untuk memodelkan data record pengguna atau produk.</p>",
        "example_title": "Contoh Kode PHP Arrays",
        "example_code": "<?php\n\n        $kursus = [\n\n          [\"judul\" => \"HTML\", \"level\" => \"Dasar\"],\n\n          [\"judul\" => \"Laravel\", \"level\" => \"Mahir\"]\n\n        ];\n\n        echo $kursus[0][\"judul\"] . \" - Level: \" . $kursus[0][\"level\"];\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_superglobals": {
        "title": "PHP Superglobals",
        "summary": "Variabel global bawaan yang selalu dapat diakses di seluruh cakupan skrip: $GLOBALS, $_SERVER, $_GET, $_POST, $_FILES, $_COOKIE, $_SESSION.",
        "content": "<p class=\"lead\">Superglobals adalah variabel khusus yang disediakan oleh PHP untuk membaca informasi server (<code>$_SERVER</code>), input formulir (<code>$_GET</code>, <code>$_POST</code>), dan data sesi autentikasi (<code>$_SESSION</code>).</p>",
        "example_title": "Contoh Kode PHP Superglobals",
        "example_code": "<?php\n\n    echo \"Metode Request: \" . $_SERVER['REQUEST_METHOD'] . \"<br>\";\n\n    echo \"Nama Server Host: \" . $_SERVER['SERVER_NAME'] . \"<br>\";\n\n    echo \"Browser Agen: \" . $_SERVER['HTTP_USER_AGENT'];\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_regex": {
        "title": "PHP RegEx",
        "summary": "Pengenalan sintaks Regular Expressions (PCRE) di PHP: Karakter pembatas, metakarakter, quantifier, dan modifier (i, m).",
        "content": "<p class=\"lead\">RegEx di PHP menggunakan standar PCRE (Perl Compatible Regular Expressions) yang diapit oleh karakter pembatas seperti garis miring <code>/pola/i</code>.</p>",
        "example_title": "Contoh Kode PHP RegEx",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Pola RegEx PCRE di PHP</h2>\n    <p><code>/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$/</code> (Pola validasi format alamat email standar).</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_regex_functions": {
        "title": "PHP RegEx Functions",
        "summary": "Fungsi ekspresi reguler bawaan: preg_match(), preg_match_all(), preg_replace(), dan preg_split().",
        "content": "<p class=\"lead\">Fungsi <code>preg_match()</code> memeriksa apakah suatu pola cocok di dalam string, sedangkan <code>preg_replace()</code> mengganti teks yang cocok dengan string baru.</p>",
        "example_title": "Contoh Kode PHP RegEx Functions",
        "example_code": "<?php\n\n        $teks = \"Kunjungi Skillance Academy\";\n\n        $pola = \"/skillance/i\"; // i = case-insensitive\n\n        if (preg_match($pola, $teks)) {\n\n          echo \"Pencocokan pola kata berhasil ditemukan!\";\n\n        }\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      }
    },
    "PHP Forms": {
      "php_forms": {
        "title": "PHP Form Handling",
        "summary": "Menangani pengiriman data formulir HTML dengan metode GET vs POST di PHP.",
        "content": "<p class=\"lead\">Data formulir sensitif (seperti password atau data registrasi) wajib dikirimkan dengan metode <code>POST</code> agar tidak terlihat di bilah alamat URL peramban.</p>",
        "example_title": "Contoh Kode PHP Form Handling",
        "example_code": "<?php $nama = $_POST['nama'] ?? ''; echo \"Halo, \" . htmlspecialchars($nama); ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_form_validation": {
        "title": "PHP Form Validation",
        "summary": "Membersihkan data input pengguna dari celah XSS (Cross-Site Scripting) dengan htmlspecialchars() dan trim().",
        "content": "<p class=\"lead\">Aturan keamanan utama: <strong>Jangan pernah mempercayai input pengguna!</strong> Selalu bersihkan dengan <code>trim()</code>, <code>stripslashes()</code>, dan <code>htmlspecialchars()</code>.</p>",
        "example_title": "Contoh Kode PHP Form Validation",
        "example_code": "<?php\n\n    function bersihkanInput($data) {\n\n      $data = trim($data);\n\n      $data = stripslashes($data);\n\n      $data = htmlspecialchars($data);\n\n      return $data;\n\n    }\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_form_required": {
        "title": "PHP Form Required",
        "summary": "Memvalidasi kolom input yang wajib diisi dan menampilkan pesan error peringatan berwarna merah.",
        "content": "<p class=\"lead\">Gunakan fungsi <code>empty()</code> untuk memeriksa apakah pengguna mengosongkan kolom input yang wajib diisi.</p>",
        "example_title": "Contoh Kode PHP Form Required",
        "example_code": "<?php if (empty($_POST['email'])) echo \"Kolom Email wajib diisi!\"; ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_form_url_email": {
        "title": "PHP Form URL/E-mail",
        "summary": "Memvalidasi format URL dan Email yang sah menggunakan filter bawaan filter_var().",
        "content": "<p class=\"lead\">Gunakan <code>filter_var($email, FILTER_VALIDATE_EMAIL)</code> untuk memverifikasi keabsahan struktur alamat email secara otomatis.</p>",
        "example_title": "Contoh Kode PHP Form URL/E-mail",
        "example_code": "<?php\n\n        $email = \"halo@skillance.cloud\";\n\n        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {\n\n          echo \"Format email tidak valid!\";\n\n        } else {\n\n          echo \"Email terverifikasi sah!\";\n\n        }\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_form_complete": {
        "title": "PHP Form Complete",
        "summary": "Membangun formulir pendaftaran lengkap dengan validasi komprehensif dan mempertahankan nilai input saat ada error.",
        "content": "<p class=\"lead\">Formulir lengkap yang baik mempertahankan nilai yang telah diketik pengguna (sticky form) sehingga mereka tidak perlu mengulang ketik dari awal jika terjadi kesalahan validasi.</p>",
        "example_title": "Contoh Kode PHP Form Complete",
        "example_code": "Menampilkan nilai lama dengan value=\"<?php echo $nama; ?>\".",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      }
    },
    "PHP Advanced": {
      "php_date": {
        "title": "PHP Date and Time",
        "summary": "Mengatur zona waktu (date_default_timezone_set) dan format tanggal/waktu dengan date() serta strtotime().",
        "content": "<p class=\"lead\">Selalu atur zona waktu dengan <code>date_default_timezone_set('Asia/Makassar')</code> atau <code>'Asia/Jakarta'</code> agar jam transaksi server presisi.</p>",
        "example_title": "Contoh Kode PHP Date and Time",
        "example_code": "<?php\n\n        date_default_timezone_set(\"Asia/Jakarta\");\n\n        echo date(\"d F Y, H:i:s\") . \" WIB\";\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_includes": {
        "title": "PHP Include",
        "summary": "Modularitas file dengan include, require, include_once, dan require_once.",
        "content": "<p class=\"lead\">Perbedaan utama: <code>require</code> akan menghasilkan Fatal Error dan menghentikan seluruh eksekusi program jika file tidak ditemukan, sedangkan <code>include</code> hanya memunculkan Warning dan program tetap berjalan.</p>",
        "example_title": "Contoh Kode PHP Include",
        "example_code": "<?php\nrequire_once __DIR__ . '/config/database.php';\ninclude __DIR__ . '/components/navbar.php';\n?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_file": {
        "title": "PHP File Handling",
        "summary": "Membaca seluruh isi file teks server dengan readfile() dan file_get_contents().",
        "content": "<p class=\"lead\">Fungsi <code>file_get_contents()</code> adalah cara tercepat membaca seluruh isi file teks atau respons endpoint API ke dalam variabel string.</p>",
        "example_title": "Contoh Kode PHP File Handling",
        "example_code": "<?php\n\n    echo readfile(\"catatan.txt\");\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_file_open": {
        "title": "PHP File Open/Read",
        "summary": "Membuka file dengan fopen(), membaca per baris dengan fgets(), dan feof().",
        "content": "<p class=\"lead\">Untuk file log berukuran besar (ratusan megabyte), gunakan <code>fopen()</code> dan <code>fgets()</code> agar memori RAM server tetap hemat.</p>",
        "example_title": "Contoh Kode PHP File Open/Read",
        "example_code": "<?php\n\n    $file = fopen(\"log.txt\", \"r\") or die(\"Gagal membuka file!\");\n\n    while(!feof($file)) {\n\n      echo fgets($file) . \"<br>\";\n\n    }\n\n    fclose($file);\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_file_create": {
        "title": "PHP File Create/Write",
        "summary": "Membuat file baru dan menulis data teks dengan fwrite() mode 'w' (overwrite) atau 'a' (append).",
        "content": "<p class=\"lead\">Mode <code>'a'</code> (append) menambahkan teks di baris paling akhir file tanpa menghapus isi yang sudah ada sebelumnya.</p>",
        "example_title": "Contoh Kode PHP File Create/Write",
        "example_code": "<?php\n\n    $f = fopen(\"aktivitas.log\", \"a\");\n\n    fwrite($f, \"[\" . date(\"Y-m-d H:i:s\") . \"] User login berhasil\n\");\n\n    fclose($f);\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_file_upload": {
        "title": "PHP File Upload",
        "summary": "Menangani upload file dokumen dan foto via $_FILES, enctype multipart/form-data, dan move_uploaded_file().",
        "content": "<p class=\"lead\">Validasi tipe MIME, ekstensi file, dan batasan ukuran byte sangat wajib sebelum memindahkan file sementara ke folder tujuan penyimpanan.</p>",
        "example_title": "Contoh Kode PHP File Upload",
        "example_code": "<!DOCTYPE html>\n<html>\n<body>\n\n<form action=\"\" method=\"post\" enctype=\"multipart/form-data\">\n        Pilih File: <input type=\"file\" name=\"foto\"><br><br>\n        <button type=\"button\">Unggah Foto</button>\n    </form>\n\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_cookies": {
        "title": "PHP Cookies",
        "summary": "Membuat dan membaca cookie di browser klien dengan setcookie() dan $_COOKIE.",
        "content": "<p class=\"lead\">Cookie disimpan di browser pengguna dan sering digunakan untuk mengingat preferensi tema (dark mode) atau token remember-me.</p>",
        "example_title": "Contoh Kode PHP Cookies",
        "example_code": "<?php\n\n        setcookie(\"tema_web\", \"dark\", time() + (86400 * 30), \"/\");\n\n        echo \"Cookie tema: \" . ($_COOKIE['tema_web'] ?? 'light');\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_sessions": {
        "title": "PHP Sessions",
        "summary": "Mengelola sesi login autentikasi pengguna secara aman di server dengan session_start() dan $_SESSION.",
        "content": "<p class=\"lead\">Berbeda dengan cookie yang disimpan di komputer klien, data session disimpan aman di server web sehingga cocok untuk data akun pengguna.</p>",
        "example_title": "Contoh Kode PHP Sessions",
        "example_code": "<?php\n\n        session_start();\n\n        $_SESSION['user_id'] = 101;\n\n        $_SESSION['user_name'] = \"Faisal\";\n\n        echo \"Selamat datang, \" . $_SESSION['user_name'];\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_filter": {
        "title": "PHP Filters",
        "summary": "Validasi dan sanitasi data dengan filter_var() dan filter_input().",
        "content": "<p class=\"lead\">Ekstensi PHP Filter dirancang untuk memudahkan validasi data formulir dari sumber luar.</p>",
        "example_title": "Contoh Kode PHP Filters",
        "example_code": "<?php\n\n    $int = 122;\n\n    echo filter_var($int, FILTER_VALIDATE_INT) ? \"Integer Sah\" : \"Bukan Integer\";\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_filter_advanced": {
        "title": "PHP Filters Advanced",
        "summary": "Validasi filter lanjutan: Memeriksa rentang angka integer (min_range & max_range) dan karakter ASCII.",
        "content": "<p class=\"lead\">Gunakan array opsi <code>options</code> untuk menetapkan batasan nilai minimum dan maksimum pada filter.</p>",
        "example_title": "Contoh Kode PHP Filters Advanced",
        "example_code": "<?php\n\n    $opsi = [\"options\" => [\"min_range\" => 1, \"max_range\" => 100]];\n\n    echo filter_var(75, FILTER_VALIDATE_INT, $opsi) ? \"Valid\" : \"Di luar rentang\";\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_callback_functions": {
        "title": "PHP Callback Functions",
        "summary": "Menggunakan fungsi sebagai argumen pada fungsi lain: array_map() dan fungsi anonim (Closures).",
        "content": "<p class=\"lead\">Callback functions di PHP dapat berupa nama fungsi dalam bentuk string, atau fungsi anonim (Anonymous Functions / Closures).</p>",
        "example_title": "Contoh Kode PHP Callback Functions",
        "example_code": "<?php\n\n        $panjangKata = array_map(fn($item) => strlen($item), [\"PHP\", \"MySQL\", \"Laravel\"]);\n\n        print_r($panjangKata); // [3, 5, 7]\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_json": {
        "title": "PHP JSON",
        "summary": "Encoding dan decoding data JSON untuk REST API dengan json_encode() dan json_decode().",
        "content": "<p class=\"lead\">Untuk mengubah array PHP menjadi string JSON REST API, gunakan <code>json_encode()</code>. Untuk membaca JSON menjadi array asosiatif, sertakan argumen <code>true</code> pada <code>json_decode($json, true)</code>.</p>",
        "example_title": "Contoh Kode PHP JSON",
        "example_code": "<?php\n\n    header('Content-Type: application/json');\n\n    $data = [\"status\" => \"success\", \"message\" => \"API Skillance Aktif\"];\n\n    echo json_encode($data);\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_exceptions": {
        "title": "PHP Exceptions",
        "summary": "Menangani eksepsi kesalahan sistem secara anggun dengan try, catch, finally, dan class Exception kustom.",
        "content": "<p class=\"lead\">Blok <code>try...catch</code> menangkap kegagalan koneksi database atau operasi file tanpa mengekspos pesan error sistem internal ke publik.</p>",
        "example_title": "Contoh Kode PHP Exceptions",
        "example_code": "<?php\n\n        try {\n\n          throw new Exception(\"Koneksi gagal\");\n\n        } catch (Exception $e) {\n\n          echo \"Tertangkap error: \" . $e->getMessage();\n\n        }\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      }
    },
    "PHP OOP": {
      "php_oop_what_is": {
        "title": "PHP What is OOP",
        "summary": "Konsep dasar Pemrograman Berorientasi Objek (OOP) vs Pemrograman Prosedural.",
        "content": "<p class=\"lead\">OOP memodelkan program menjadi objek-objek mandiri yang memiliki karakteristik (properti) dan aksi perilaku (metode), membuat kode lebih modular, mudah dipelihara, dan dapat digunakan kembali.</p>",
        "example_title": "Contoh Kode PHP What is OOP",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Prinsip Utama OOP</h2>\n    <ul>\n        <li><strong>Encapsulation</strong>: Membungkus data dan method dalam satu unit.</li>\n        <li><strong>Inheritance</strong>: Pewarisan sifat dari kelas induk ke kelas anak.</li>\n        <li><strong>Polymorphism</strong>: Kemampuan method memiliki implementasi berbeda.</li>\n    </ul>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_oop_classes_objects": {
        "title": "PHP Classes/Objects",
        "summary": "Mendefinisikan Class dan membuat instance Objek dengan kata kunci new.",
        "content": "<p class=\"lead\">Class adalah cetak biru (blueprint), sedangkan Object adalah bentuk nyata hasil cetak biru tersebut.</p>",
        "example_title": "Contoh Kode PHP Classes/Objects",
        "example_code": "<?php\n\n        class Mobil {\n\n          public $warna = \"Merah\";\n\n        }\n\n        $avanza = new Mobil();\n\n        echo \"Warna mobil: \" . $avanza->warna;\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_oop_constructor": {
        "title": "PHP Constructor",
        "summary": "Method khusus __construct() yang otomatis dipanggil saat objek pertama kali diinisialisasi.",
        "content": "<p class=\"lead\">Constructor biasanya digunakan untuk mengisi nilai properti awal objek pada saat pembuatan <code>new Kelas(...)</code>.</p>",
        "example_title": "Contoh Kode PHP Constructor",
        "example_code": "<?php\n\n        class User {\n\n          public $nama;\n\n          public function __construct($nama) {\n\n            $this->nama = $nama;\n\n          }\n\n        }\n\n        $u = new User(\"Faisal\");\n\n        echo \"Nama: \" . $u->nama;\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_oop_destructor": {
        "title": "PHP Destructor",
        "summary": "Method khusus __destruct() yang otomatis dipanggil saat objek selesai digunakan atau skrip berakhir.",
        "content": "<p class=\"lead\">Destructor berguna untuk membersihkan koneksi database atau menutup file log yang terbuka secara otomatis.</p>",
        "example_title": "Contoh Kode PHP Destructor",
        "example_code": "<?php\n\n    class FileHandler {\n\n      public function __destruct() {\n\n        echo \"Koneksi resource ditutup aman.\";\n\n      }\n\n    }\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_oop_access_modifiers": {
        "title": "PHP Access Modifiers",
        "summary": "Tingkat visibilitas properti dan method: public, protected, dan private.",
        "content": "<p class=\"lead\"><code>public</code> dapat diakses dari mana saja. <code>protected</code> hanya dapat diakses di dalam kelas dan turunan kelasnya. <code>private</code> hanya dapat diakses di dalam kelas itu sendiri.</p>",
        "example_title": "Contoh Kode PHP Access Modifiers",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Visibilitas Properti</h2>\n    <table border=\"1\" cellpadding=\"8\" style=\"border-collapse:collapse;\">\n        <tr><th>Modifier</th><th>Di Dalam Kelas</th><th>Kelas Anak</th><th>Di Luar Kelas</th></tr>\n        <tr><td>public</td><td>Ya</td><td>Ya</td><td>Ya</td></tr>\n        <tr><td>protected</td><td>Ya</td><td>Ya</td><td>Tidak</td></tr>\n        <tr><td>private</td><td>Ya</td><td>Tidak</td><td>Tidak</td></tr>\n    </table>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_oop_inheritance": {
        "title": "PHP Inheritance",
        "summary": "Pewarisan sifat dan fungsionalitas dari kelas induk ke kelas anak dengan kata kunci extends.",
        "content": "<p class=\"lead\">Inheritance menghindari duplikasi kode dengan mewariskan seluruh properti dan method berhak akses public dan protected ke kelas turunan.</p>",
        "example_title": "Contoh Kode PHP Inheritance",
        "example_code": "<?php\n\n        class Hewan { public function makan() { echo \"Sedang makan\"; } }\n\n        class Kucing extends Hewan {}\n\n        $k = new Kucing();\n\n        $k->makan(); // Mewarisi method makan\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_oop_constants": {
        "title": "PHP Constants",
        "summary": "Konstanta di dalam Class menggunakan kata kunci const dan diakses dengan scope resolution operator (::).",
        "content": "<p class=\"lead\">Konstanta kelas dialokasikan satu kali per kelas, bukan per objek instansi.</p>",
        "example_title": "Contoh Kode PHP Constants",
        "example_code": "<?php\n\n    class Konfigurasi {\n\n      const APP_NAME = \"Skillance Portal\";\n\n    }\n\n    echo Konfigurasi::APP_NAME;\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_oop_classes_abstract": {
        "title": "PHP Abstract Classes",
        "summary": "Kelas abstrak sebagai kerangka acuan yang tidak dapat diinstansiasi langsung dan wajib diimplementasikan oleh kelas anak.",
        "content": "<p class=\"lead\">Kelas abstrak berisi setidaknya satu metode abstrak yang hanya mendefinisikan nama dan parameternya saja tanpa isi implementasi.</p>",
        "example_title": "Contoh Kode PHP Abstract Classes",
        "example_code": "<?php\n\n        abstract class Pembayaran {\n\n          abstract public function prosesTransaksi(): bool;\n\n        }\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_oop_interfaces": {
        "title": "PHP Interfaces",
        "summary": "Mendefinisikan kontrak method yang harus diimplementasikan oleh kelas dengan kata kunci implements.",
        "content": "<p class=\"lead\">Sebuah kelas dapat mengimplementasikan beberapa Interface sekaligus (Multiple Implementation), mengatasi batasan single-inheritance di PHP.</p>",
        "example_title": "Contoh Kode PHP Interfaces",
        "example_code": "<?php\n\n    interface Notifikasi {\n\n      public function kirimPesan($tujuan, $isi);\n\n    }\n\n    class EmailNotif implements Notifikasi {\n\n      public function kirimPesan($tujuan, $isi) { /* kirim */ }\n\n    }\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_oop_traits": {
        "title": "PHP Traits",
        "summary": "Mekanisme penggunaan kembali method di berbagai kelas yang berdiri sendiri tanpa relasi hierarki warisan (use Trait).",
        "content": "<p class=\"lead\">Traits memecahkan batasan single-inheritance di PHP dengan menyisipkan sekumpulan method ke dalam beberapa kelas berbeda.</p>",
        "example_title": "Contoh Kode PHP Traits",
        "example_code": "<?php\n\n        trait Logger { public function catat($msg) { echo \"Log: $msg\"; } }\n\n        class Order { use Logger; }\n\n        $o = new Order();\n\n        $o->catat(\"Pesanan dibuat\");\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_oop_static_methods": {
        "title": "PHP Static Methods",
        "summary": "Method statis yang dapat dipanggil langsung dari nama kelas tanpa membuat instance objek: NamaKelas::metode().",
        "content": "<p class=\"lead\">Method statis sangat cocok untuk fungsi-fungsi utilitas kalkulator atau helper murni.</p>",
        "example_title": "Contoh Kode PHP Static Methods",
        "example_code": "<?php\n\n    class MathHelper {\n\n      public static function diskon($harga, $persen) {\n\n        return $harga - ($harga * $persen / 100);\n\n      }\n\n    }\n\n    echo MathHelper::diskon(100000, 10); // 90000\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_oop_static_properties": {
        "title": "PHP Static Properties",
        "summary": "Properti statis yang nilainya dibagikan ke seluruh objek dari kelas yang sama.",
        "content": "<p class=\"lead\">Properti statis diakses menggunakan operator resolusi lingkup ganda <code>Kelas::$properti</code>.</p>",
        "example_title": "Contoh Kode PHP Static Properties",
        "example_code": "<?php Counter::$total++; echo Counter::$total; ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_namespaces": {
        "title": "PHP Namespaces",
        "summary": "Mencegah tabrakan nama kelas dengan mengorganisasi kode ke dalam ruang nama modular (namespace App\\Models).",
        "content": "<p class=\"lead\">Namespace memecahkan masalah saat dua pustaka eksternal pihak ketiga memiliki nama kelas yang sama persis.</p>",
        "example_title": "Contoh Kode PHP Namespaces",
        "example_code": "<?php\n\n    namespace Skillance\\Academy\\Models;\n\n\n    class Mahasiswa {}\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_iterables": {
        "title": "PHP Iterables",
        "summary": "Tipe pseudo-type iterable yang dapat diulang dengan foreach (Array atau objek Iterator).",
        "content": "<p class=\"lead\">Type hint <code>iterable</code> dapat menerima array biasa maupun objek generator yang mengimplementasikan antarmuka Traversable.</p>",
        "example_title": "Contoh Kode PHP Iterables",
        "example_code": "<?php\n\n        function tampilkanDaftar(iterable $daftar) {\n\n          foreach ($daftar as $item) { echo \"$item \"; }\n\n        }\n\n        tampilkanDaftar([\"A\", \"B\", \"C\"]);\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      }
    },
    "MySQL Database": {
      "php_mysql_intro": {
        "title": "MySQL Database",
        "summary": "Pengenalan database relasional MySQL, tabel, kolom, baris data, dan peran RDBMS dalam sistem web.",
        "content": "<p class=\"lead\">MySQL adalah sistem manajemen basis data relasional (RDBMS) standar dunia web untuk menyimpan data pengguna, produk, dan transaksi bisnis secara aman dan cepat.</p>",
        "example_title": "Contoh Kode MySQL Database",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Struktur Tabel Database Relasional</h2>\n    <table border=\"1\" cellpadding=\"8\" style=\"border-collapse:collapse; width:100%; max-width:400px;\">\n        <tr style=\"background:#0d2e5c; color:white;\"><th>id</th><th>nama</th><th>email</th></tr>\n        <tr><td>1</td><td>Budi</td><td>budi@mail.com</td></tr>\n        <tr><td>2</td><td>Siti</td><td>siti@mail.com</td></tr>\n    </table>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_mysql_connect": {
        "title": "MySQL Connect",
        "summary": "Membuka koneksi PHP ke server MySQL menggunakan ekstensi modern MySQLi atau PDO (PHP Data Objects).",
        "content": "<p class=\"lead\">Skillance Academy merekomendasikan penggunaan <strong>PDO</strong> atau <strong>MySQLi Object-Oriented</strong> dengan penanganan try-catch.</p>",
        "example_title": "Contoh Kode MySQL Connect",
        "example_code": "<?php\n\n    $host = \"localhost\";\n\n    $user = \"root\";\n\n    $pass = \"\";\n\n    $db   = \"skillance_academy\";\n\n\n    $conn = new mysqli($host, $user, $pass, $db);\n\n    if ($conn->connect_error) {\n\n      die(\"Koneksi gagal: \" . $conn->connect_error);\n\n    }\n\n    echo \"Koneksi ke MySQL Berhasil!\";\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_mysql_create": {
        "title": "MySQL Create DB",
        "summary": "Membuat basis data baru melalui perintah SQL CREATE DATABASE.",
        "content": "<p class=\"lead\">Gunakan query <code>CREATE DATABASE nama_database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci</code> untuk mendukung emoji dan karakter internasional.</p>",
        "example_title": "Contoh Kode MySQL Create DB",
        "example_code": "<?php\n\n    $sql = \"CREATE DATABASE IF NOT EXISTS skillance_db\";\n\n    $conn->query($sql);\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_mysql_create_table": {
        "title": "MySQL Create Table",
        "summary": "Membangun struktur tabel dengan tipe data INT AUTO_INCREMENT, VARCHAR, DATETIME, dan PRIMARY KEY.",
        "content": "<p class=\"lead\">Perintah <code>CREATE TABLE</code> mendefinisikan nama-nama kolom, tipe data, serta aturan kendala integritas data.</p>",
        "example_title": "Contoh Kode MySQL Create Table",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #fca311;\">\n    <p>CREATE TABLE siswa (<br>\n    &nbsp;&nbsp;id INT AUTO_INCREMENT PRIMARY KEY,<br>\n    &nbsp;&nbsp;nama VARCHAR(100) NOT NULL,<br>\n    &nbsp;&nbsp;email VARCHAR(100) UNIQUE NOT NULL,<br>\n    &nbsp;&nbsp;dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP<br>\n    );</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_mysql_insert": {
        "title": "MySQL Insert Data",
        "summary": "Menambahkan baris record data baru ke dalam tabel menggunakan query INSERT INTO.",
        "content": "<p class=\"lead\">Perintah SQL <code>INSERT INTO nama_tabel (kolom1, kolom2) VALUES (nilai1, nilai2)</code> menyisipkan data baru.</p>",
        "example_title": "Contoh Kode MySQL Insert Data",
        "example_code": "<?php\n\n    $sql = \"INSERT INTO siswa (nama, email) VALUES ('Andi', 'andi@mail.com')\";\n\n    if ($conn->query($sql) === TRUE) {\n\n      echo \"Data baru berhasil disimpan!\";\n\n    }\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_mysql_insert_lastid": {
        "title": "MySQL Get Last ID",
        "summary": "Mengambil ID primary key auto_increment dari data yang baru saja disisipkan dengan $conn->insert_id.",
        "content": "<p class=\"lead\">Mengambil ID data terakhir sangat penting saat membuat transaksi bertingkat (misalnya membuat Order lalu membuat Order Item).</p>",
        "example_title": "Contoh Kode MySQL Get Last ID",
        "example_code": "<?php echo \"ID Transaksi Baru: \" . $conn->insert_id; ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_mysql_insert_multiple": {
        "title": "MySQL Insert Multiple",
        "summary": "Menyisipkan banyak baris data sekaligus dalam satu transaksi perintah untuk efisiensi performa.",
        "content": "<p class=\"lead\">Menyisipkan banyak baris dalam satu query <code>INSERT INTO tabel (k1) VALUES (v1), (v2), (v3)</code> ratusan kali lebih cepat daripada melakukan looping query terpisah.</p>",
        "example_title": "Contoh Kode MySQL Insert Multiple",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #4ade80;\">\n    <p>INSERT INTO modul (judul) VALUES<br>\n    ('HTML Dasar'),<br>\n    ('CSS Layout'),<br>\n    ('JavaScript DOM');</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_mysql_prepared_statements": {
        "title": "MySQL Prepared",
        "summary": "Teknik wajib standar keamanan industri untuk mencegah serangan berbahaya SQL Injection (Prepared Statements).",
        "content": "<p class=\"lead\"><strong>SQL Injection</strong> adalah ancaman nomor satu keamanan web. Prepared Statements memisahkan query instruksi SQL dari data parameter input pengguna sehingga injeksi kode berbahaya tidak mungkin dieksekusi.</p>",
        "example_title": "Contoh Kode MySQL Prepared",
        "example_code": "<?php\n\n    $stmt = $conn->prepare(\"SELECT id, nama, email FROM users WHERE email = ?\");\n\n    $stmt->bind_param(\"s\", $emailPengguna);\n\n    $stmt->execute();\n\n    $hasil = $stmt->get_result();\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_mysql_select": {
        "title": "MySQL Select Data",
        "summary": "Membaca dan menampilkan data tabel ke antarmuka web menggunakan SELECT dan fetch_assoc().",
        "content": "<p class=\"lead\">Gunakan <code>$hasil->fetch_assoc()</code> di dalam perulangan while untuk membaca setiap baris data menjadi array asosiatif.</p>",
        "example_title": "Contoh Kode MySQL Select Data",
        "example_code": "<?php\n\n        $res = $conn->query(\"SELECT id, nama FROM siswa\");\n\n        while($row = $res->fetch_assoc()) {\n\n          echo \"ID: \" . $row[\"id\"] . \" - Nama: \" . $row[\"nama\"] . \"<br>\";\n\n        }\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_mysql_select_where": {
        "title": "MySQL Where",
        "summary": "Menyaring record data spesifik berdasarkan kriteria kondisi klausa WHERE.",
        "content": "<p class=\"lead\">Klausa <code>WHERE</code> digunakan untuk memfilter baris data yang hanya memenuhi kriteria tertentu (contoh: <code>WHERE status = 'aktif'</code>).</p>",
        "example_title": "Contoh Kode MySQL Where",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #1e293b; color: #38bdf8;\">\n    <p>SELECT * FROM pembayaran WHERE status = 'sukses' AND total > 100000;</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_mysql_select_orderby": {
        "title": "MySQL Order By",
        "summary": "Mengurutkan baris data secara menaik (ASC) atau menurun (DESC) berdasarkan kolom tertentu.",
        "content": "<p class=\"lead\">Gunakan <code>ORDER BY tanggal_daftar DESC</code> untuk menampilkan data pendaftaran terbaru di posisi paling atas.</p>",
        "example_title": "Contoh Kode MySQL Order By",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #fca311;\">\n    <p>SELECT nama, nilai FROM ujian ORDER BY nilai DESC;</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_mysql_delete": {
        "title": "MySQL Delete Data",
        "summary": "Menghapus baris record dari tabel database dengan perintah DELETE FROM dan klausa WHERE.",
        "content": "<p class=\"lead\">Peringatan Kritis: <strong>Selalu sertakan klausa WHERE</strong> pada query DELETE! Menjalankan DELETE tanpa WHERE akan menghapus seluruh isi tabel tanpa bisa dikembalikan!</p>",
        "example_title": "Contoh Kode MySQL Delete Data",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #fee2e2; color: #991b1b; padding: 15px;\">\n    <p>DELETE FROM siswa WHERE id = 12;</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_mysql_update": {
        "title": "MySQL Update Data",
        "summary": "Memperbarui data yang sudah ada di tabel menggunakan UPDATE dan SET.",
        "content": "<p class=\"lead\">Sama seperti DELETE, perintah <code>UPDATE</code> wajib disertai klausa WHERE agar tidak mengubah seluruh baris di tabel.</p>",
        "example_title": "Contoh Kode MySQL Update Data",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #1e293b; color: #4ade80;\">\n    <p>UPDATE siswa SET email = 'baru@mail.com' WHERE id = 5;</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_mysql_select_limit": {
        "title": "MySQL Limit Data",
        "summary": "Membatasi jumlah baris data yang diambil untuk keperluan pagination halaman web dengan LIMIT dan OFFSET.",
        "content": "<p class=\"lead\">Query <code>LIMIT 10 OFFSET 20</code> mengambil 10 baris data mulai dari baris ke-21 (halaman ke-3 pada pagination berukuran 10 item per halaman).</p>",
        "example_title": "Contoh Kode MySQL Limit Data",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <p>SELECT * FROM artikel ORDER BY id DESC LIMIT 10 OFFSET 0;</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      }
    },
    "PHP XML": {
      "php_xml_parsers": {
        "title": "PHP XML Parsers",
        "summary": "Pengenalan teknologi parsing dokumen XML di PHP: Tree-based vs Event-based parsers.",
        "content": "<p class=\"lead\">XML adalah format standar penataan data terstruktur hierarkis. PHP menyediakan parser SimpleXML, DOM, dan Expat XML parser.</p>",
        "example_title": "Contoh Kode PHP XML Parsers",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Teknologi XML di PHP</h2>\n    <p>SimpleXML adalah pilihan terbaik untuk file XML sederhana karena mengubah tag XML menjadi properti objek PHP secara instan.</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_xml_simplexml_read": {
        "title": "PHP SimpleXML Parser",
        "summary": "Membaca file XML dengan simplexml_load_file() dan string XML dengan simplexml_load_string().",
        "content": "<p class=\"lead\">SimpleXML memetakan elemen XML menjadi objek yang sangat mudah diakses dengan operator tanda panah <code>$xml->judul</code>.</p>",
        "example_title": "Contoh Kode PHP SimpleXML Parser",
        "example_code": "<?php\n\n        $xmlData = \"<kursus><nama>PHP Skillance Academy</nama></kursus>\";\n\n        $xml = simplexml_load_string($xmlData);\n\n        echo \"Nama Kursus: \" . $xml->nama;\n\n        ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_xml_simplexml_get": {
        "title": "PHP SimpleXML - Get",
        "summary": "Mengambil nilai node elemen dan atribut XML menggunakan pengindeksan array dan perulangan loop.",
        "content": "<p class=\"lead\">Gunakan <code>$elemen['atribut']</code> untuk membaca nilai atribut yang menempel pada tag XML.</p>",
        "example_title": "Contoh Kode PHP SimpleXML - Get",
        "example_code": "<?php\n\n    foreach($xml->children() as $buku) {\n\n      echo $buku->judul . \" (\" . $buku['kategori'] . \")<br>\";\n\n    }\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_xml_parser_expat": {
        "title": "PHP XML Expat Parser",
        "summary": "Parser berbasis event (SAX) yang sangat hemat memori untuk membaca dokumen XML berukuran ratusan megabyte.",
        "content": "<p class=\"lead\">Expat parser memproses dokumen XML alur per alur (streaming) dan memicu fungsi handler saat tag pembuka atau penutup ditemukan.</p>",
        "example_title": "Contoh Kode PHP XML Expat Parser",
        "example_code": "<?php\n\n    $parser = xml_parser_create();\n\n    // set handler callback...\n\n    xml_parser_free($parser);\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_xml_dom": {
        "title": "PHP DOM Parser",
        "summary": "Membuat, memodifikasi, dan menavigasi dokumen XML atau HTML dengan DOMDocument.",
        "content": "<p class=\"lead\">DOMDocument memuat seluruh dokumen XML ke dalam memori sebagai pohon objek DOM yang dapat dimanipulasi secara leluasa.</p>",
        "example_title": "Contoh Kode PHP DOM Parser",
        "example_code": "<?php\n\n    $dom = new DOMDocument();\n\n    $dom->loadXML(\"<app><name>Skillance</name></app>\");\n\n    echo $dom->saveXML();\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      }
    },
    "PHP - AJAX": {
      "php_ajax_intro": {
        "title": "AJAX Intro",
        "summary": "Konsep integrasi PHP dengan AJAX untuk memperbarui bagian halaman web tanpa memuat ulang (reload).",
        "content": "<p class=\"lead\">Dengan AJAX, antarmuka browser JavaScript mengirimkan permintaan data di latar belakang ke endpoint PHP, lalu menyisipkan respons HTML atau JSON langsung ke DOM.</p>",
        "example_title": "Contoh Kode AJAX Intro",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Alur Kerja AJAX & PHP</h2>\n    <ol>\n        <li>Pengguna mengetik di input pencarian.</li>\n        <li>JavaScript mengirimkan fetch() ke <code>cari.php?q=keyword</code>.</li>\n        <li>PHP mengeksekusi query database dan mengembalikan hasil data.</li>\n        <li>JavaScript menampilkan hasil secara langsung tanpa kedipan reload!</li>\n    </ol>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ajax_php": {
        "title": "AJAX PHP",
        "summary": "Membangun endpoint skrip PHP khusus yang melayani respon data asinkron.",
        "content": "<p class=\"lead\">Endpoint AJAX di PHP hanya mengeluarkan payload data yang relevan (misalnya potongan HTML atau JSON) tanpa tag &lt;html&gt; atau header lengkap.</p>",
        "example_title": "Contoh Kode AJAX PHP",
        "example_code": "<?php\n\n    // file: get_hint.php\n\n    $q = $_GET[\"q\"] ?? \"\";\n\n    echo \"Saran kata kunci untuk: \" . htmlspecialchars($q);\n\n    ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ajax_database": {
        "title": "AJAX Database",
        "summary": "Mengambil dan memfilter data dari database MySQL melalui AJAX secara real-time.",
        "content": "<p class=\"lead\">Menggabungkan interaktivitas dropdown JavaScript dengan query database PHP dinamis.</p>",
        "example_title": "Contoh Kode AJAX Database",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Dropdown Berantai (AJAX Database)</h2>\n    <p>Memilih Provinsi secara otomatis memuat daftar Kota dari database via AJAX!</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ajax_xml": {
        "title": "AJAX XML",
        "summary": "Mengambil dan mengurai file XML dari server melalui interaksi AJAX.",
        "content": "<p class=\"lead\">JavaScript membaca node-node XML yang disediakan oleh skrip PHP di server.</p>",
        "example_title": "Contoh Kode AJAX XML",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #1e293b; color: #38bdf8;\">\n    <p>fetch('data.xml').then(res => res.text()).then(str => /* parse */);</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ajax_livesearch": {
        "title": "AJAX Live Search",
        "summary": "Membangun fitur pencarian instan (Live Search) layaknya Google saat pengguna mengetik kata kunci.",
        "content": "<p class=\"lead\">Event listener <code>input</code> pada kolom pencarian mengirim query pencarian ke skrip PHP yang mencari baris data dengan SQL <code>LIKE %keyword%</code>.</p>",
        "example_title": "Contoh Kode AJAX Live Search",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Simulasi Live Search</h2>\n    <input type=\"text\" placeholder=\"Ketik nama materi (misal: CSS)...\" oninput=\"cari(this.value)\" style=\"padding:10px; width:280px; border-radius:6px; border:1px solid #cbd5e1;\">\n    <div id=\"hasilCari\" style=\"margin-top:15px; font-weight:bold; color:#0d2e5c;\"></div>\n\n    <script>\n        function cari(val) {\n            document.getElementById('hasilCari').innerText = val ? \"Mencari data untuk: \" + val + \"...\" : \"\";\n        }\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ajax_poll": {
        "title": "AJAX Poll",
        "summary": "Membangun fitur pemungutan suara (Polling) interaktif yang memperbarui persentase grafik tanpa reload.",
        "content": "<p class=\"lead\">Pengguna memilih opsi voting, skrip PHP mencatat suara ke database, dan mengembalikan data persentase suara terbaru secara instan.</p>",
        "example_title": "Contoh Kode AJAX Poll",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h3>Polling Bahasa Pemrograman Favorit</h3>\n    <button onclick=\"alert('Pilihan Anda berhasil dicatat via AJAX!')\">Pilih PHP 🐘</button>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      }
    },
    "PHP Cert": {
      "php_exam": {
        "title": "PHP Certificate",
        "summary": "Uji kompetensi dan sertifikasi keahlian PHP & MySQL standar industri Skillance Academy.",
        "content": "<p class=\"lead\">Uji pemahaman komprehensif Anda mengenai sintaks PHP, OOP, keamanan Prepared Statements, penanganan form, dan manajemen sesi.</p>",
        "example_title": "Contoh Kode PHP Certificate",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 30px; text-align: center;\">\n    <div style=\"border:2px solid #777bb4; padding:30px; border-radius:12px; display:inline-block; max-width:400px;\">\n        <h2 style=\"color:#0d2e5c;\">Sertifikasi Resmi PHP</h2>\n        <p>Tuntaskan evaluasi 30 soal praktik backend & database.</p>\n        <button style=\"background:#777bb4; color:white; border:none; padding:12px 24px; border-radius:6px; font-weight:bold; cursor:pointer;\" onclick=\"alert('Ujian Siap Dimulai!')\">Ikuti Ujian Sekarang &raquo;</button>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      }
    },
    "PHP Examples": {
      "php_examples": {
        "title": "PHP Examples",
        "summary": "Koleksi contoh kode PHP praktis untuk menyelesaikan kasus-kasus pengembangan web sehari-hari.",
        "content": "<p class=\"lead\">Katalog referensi potongan kode cepat untuk format tanggal, manipulasi string, dan kalkulasi array.</p>",
        "example_title": "Contoh Kode PHP Examples",
        "example_code": "<?php echo \"Rp \" . number_format(1500000, 0, ',', '.'); ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_compiler": {
        "title": "PHP Compiler",
        "summary": "Editor dan runner interaktif di browser Skillance Academy untuk menguji skrip kode langsung.",
        "content": "<p class=\"lead\">Gunakan Try It Yourself Editor untuk menguji logika kode tanpa perlu konfigurasi web server lokal.</p>",
        "example_title": "Contoh Kode PHP Compiler",
        "example_code": "<?php echo \"Uji coba kode PHP Anda di Code Lab Skillance!\"; ?>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_quiz": {
        "title": "PHP Quiz",
        "summary": "Kuis interaktif pilihan ganda untuk menguji ketajaman penguasaan materi PHP Anda.",
        "content": "<p class=\"lead\">Jawab pertanyaan-pertanyaan seputar sintaks, variabel, array, dan query database.</p>",
        "example_title": "Contoh Kode PHP Quiz",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h3>Kuis: Karakter apa penanda awal variabel PHP?</h3>\n    <label><input type=\"radio\"> &</label><br>\n    <label><input type=\"radio\"> $ (Benar)</label><br>\n    <label><input type=\"radio\"> @</label>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_exercises": {
        "title": "PHP Exercises",
        "summary": "Latihan koding terstruktur melengkapi kode yang rumpang pada fungsi dan logika perulangan.",
        "content": "<p class=\"lead\">Asah reflek koding PHP Anda melalui latihan-latihan terpandu.</p>",
        "example_title": "Contoh Kode PHP Exercises",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #1e293b; color: #38bdf8;\">\n    <p>/* Lengkapi kode: */<br>\n    $txt = \"Halo\";<br>\n    echo strlen($txt);</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_practice": {
        "title": "PHP Practice Problems",
        "summary": "Kumpulan soal studi kasus pemecahan algoritma dan pengolahan data dunia nyata.",
        "content": "<p class=\"lead\">Tantangan membuat fungsi validasi nomor telepon Indonesia (+62/08), generator slug URL, dan perhitungan pajak PPN 11%.</p>",
        "example_title": "Contoh Kode PHP Practice Problems",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h3>Studi Kasus: Generator Slug URL</h3>\n    <p>\"Belajar PHP & MySQL 2026\" &rarr; <code>belajar-php-mysql-2026</code></p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_server": {
        "title": "PHP Server",
        "summary": "Menjalankan PHP Built-in Web Server bawaan tanpa install Apache: php -S localhost:8000.",
        "content": "<p class=\"lead\">PHP memiliki web server bawaan untuk pengujian cepat development lokal hanya dengan satu perintah terminal.</p>",
        "example_title": "Contoh Kode PHP Server",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #4ade80;\">\n    <p>$ cd /path/to/project<br>\n    $ php -S localhost:8000<br>\n    [Thu Nov  5 12:00:00 2026] PHP 8.2.12 Development Server started at http://localhost:8000</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_syllabus": {
        "title": "PHP Syllabus",
        "summary": "Silabus jalur belajar komprehensif kurikulum PHP dari nol hingga siap kerja.",
        "content": "<p class=\"lead\">Kurikulum terstruktur: Dasar Sintaks &rarr; Penanganan Form &rarr; Keamanan Prepared Statements &rarr; OOP &rarr; REST API.</p>",
        "example_title": "Contoh Kode PHP Syllabus",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <ol>\n        <li>Sintaks, Variabel & Tipe Data</li>\n        <li>Percabangan & Perulangan</li>\n        <li>Penanganan Form & Validasi Keamanan</li>\n        <li>Koneksi MySQL & Prepared Statements</li>\n        <li>Object-Oriented Programming (OOP)</li>\n    </ol>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_study_plan": {
        "title": "PHP Study Plan",
        "summary": "Rencana target belajar intensif 21 hari menguasai backend PHP dan MySQL.",
        "content": "<p class=\"lead\">Jadwal belajar harian yang terarah untuk mencapai kompetensi backend developer.</p>",
        "example_title": "Contoh Kode PHP Study Plan",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h3>Rencana 21 Hari Backend PHP</h3>\n    <p>Minggu 1: Sintaks Dasar & Logika<br>\n    Minggu 2: Form, Keamanan & Database CRUD<br>\n    Minggu 3: OOP, REST API & Proyek Web</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      }
    },
    "PHP Reference": {
      "php_ref_overview": {
        "title": "PHP Overview",
        "summary": "Gambaran komprehensif modul dan ekstensi bawaan PHP standar.",
        "content": "<p class=\"lead\">Gambaran komprehensif modul dan ekstensi bawaan PHP standar.</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Overview",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Overview</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_array": {
        "title": "PHP Array",
        "summary": "Referensi lengkap fungsi manipulasi array: sort, ksort, array_push, array_filter, array_map.",
        "content": "<p class=\"lead\">Referensi lengkap fungsi manipulasi array: sort, ksort, array_push, array_filter, array_map.</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Array",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Array</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_calendar": {
        "title": "PHP Calendar",
        "summary": "Fungsi kalkulasi kalender Julian dan Gregorian: cal_days_in_month, jdtojewish.",
        "content": "<p class=\"lead\">Fungsi kalkulasi kalender Julian dan Gregorian: cal_days_in_month, jdtojewish.</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Calendar",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Calendar</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_date": {
        "title": "PHP Date",
        "summary": "Referensi format karakter date(), strtotime(), date_diff(), dan microtime().",
        "content": "<p class=\"lead\">Referensi format karakter date(), strtotime(), date_diff(), dan microtime().</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Date",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Date</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_directory": {
        "title": "PHP Directory",
        "summary": "Navigasi folder direktori: chdir(), getcwd(), scandir(), opendir(), closedir().",
        "content": "<p class=\"lead\">Navigasi folder direktori: chdir(), getcwd(), scandir(), opendir(), closedir().</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Directory",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Directory</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_error": {
        "title": "PHP Error",
        "summary": "Penanganan galat sistem: error_reporting(), set_error_handler(), trigger_error().",
        "content": "<p class=\"lead\">Penanganan galat sistem: error_reporting(), set_error_handler(), trigger_error().</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Error",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Error</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_exception": {
        "title": "PHP Exception",
        "summary": "Metode objek Exception: getMessage(), getCode(), getFile(), getLine(), getTrace().",
        "content": "<p class=\"lead\">Metode objek Exception: getMessage(), getCode(), getFile(), getLine(), getTrace().</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Exception",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Exception</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_filesystem": {
        "title": "PHP Filesystem",
        "summary": "Operasi berkas: copy(), unlink(), file_exists(), filesize(), is_readable(), mkdir().",
        "content": "<p class=\"lead\">Operasi berkas: copy(), unlink(), file_exists(), filesize(), is_readable(), mkdir().</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Filesystem",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Filesystem</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_filter": {
        "title": "PHP Filter",
        "summary": "Daftar lengkap filter sanitasi dan validasi filter_var: FILTER_VALIDATE_IP, FILTER_SANITIZE_EMAIL.",
        "content": "<p class=\"lead\">Daftar lengkap filter sanitasi dan validasi filter_var: FILTER_VALIDATE_IP, FILTER_SANITIZE_EMAIL.</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Filter",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Filter</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_ftp": {
        "title": "PHP FTP",
        "summary": "Fungsi transmisi file via protokol FTP/SFTP: ftp_connect(), ftp_login(), ftp_put(), ftp_get().",
        "content": "<p class=\"lead\">Fungsi transmisi file via protokol FTP/SFTP: ftp_connect(), ftp_login(), ftp_put(), ftp_get().</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP FTP",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP FTP</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_json": {
        "title": "PHP JSON",
        "summary": "Kamus referensi json_encode, json_decode, dan konstanta JSON_PRETTY_PRINT.",
        "content": "<p class=\"lead\">Kamus referensi json_encode, json_decode, dan konstanta JSON_PRETTY_PRINT.</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP JSON",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP JSON</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_keywords": {
        "title": "PHP Keywords",
        "summary": "Daftar kata kunci terdaftar yang tidak boleh dijadikan nama variabel atau fungsi.",
        "content": "<p class=\"lead\">Daftar kata kunci terdaftar yang tidak boleh dijadikan nama variabel atau fungsi.</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Keywords",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Keywords</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_libxml": {
        "title": "PHP Libxml",
        "summary": "Fungsi pendukung parser XML libxml_use_internal_errors(), libxml_get_errors().",
        "content": "<p class=\"lead\">Fungsi pendukung parser XML libxml_use_internal_errors(), libxml_get_errors().</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Libxml",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Libxml</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_mail": {
        "title": "PHP Mail",
        "summary": "Mengirimkan email dari skrip PHP dengan mail() atau library PHPMailer / SMTP.",
        "content": "<p class=\"lead\">Mengirimkan email dari skrip PHP dengan mail() atau library PHPMailer / SMTP.</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Mail",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Mail</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_math": {
        "title": "PHP Math",
        "summary": "Referensi fungsi matematika lengkap: ceil, floor, round, abs, sin, cos, tan, pow, sqrt.",
        "content": "<p class=\"lead\">Referensi fungsi matematika lengkap: ceil, floor, round, abs, sin, cos, tan, pow, sqrt.</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Math",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Math</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_misc": {
        "title": "PHP Misc",
        "summary": "Fungsi serbaguna: die(), exit(), sleep(), usleep(), uniqid(), eval().",
        "content": "<p class=\"lead\">Fungsi serbaguna: die(), exit(), sleep(), usleep(), uniqid(), eval().</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Misc",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Misc</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_mysqli": {
        "title": "PHP MySQLi",
        "summary": "Referensi lengkap method dan properti driver MySQL Improved (mysqli).",
        "content": "<p class=\"lead\">Referensi lengkap method dan properti driver MySQL Improved (mysqli).</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP MySQLi",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP MySQLi</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_network": {
        "title": "PHP Network",
        "summary": "Fungsi jaringan internet: gethostbyname(), header(), setcookie(), ip2long().",
        "content": "<p class=\"lead\">Fungsi jaringan internet: gethostbyname(), header(), setcookie(), ip2long().</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Network",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Network</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_output_control": {
        "title": "PHP Output Control",
        "summary": "Output buffering: ob_start(), ob_get_clean(), ob_end_flush().",
        "content": "<p class=\"lead\">Output buffering: ob_start(), ob_get_clean(), ob_end_flush().</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Output Control",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Output Control</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_regex": {
        "title": "PHP RegEx",
        "summary": "Referensi pola karakter PCRE: \\d, \\w, \\s, [a-z], quantifiers +, *, ?, {n,m}.",
        "content": "<p class=\"lead\">Referensi pola karakter PCRE: \\d, \\w, \\s, [a-z], quantifiers +, *, ?, {n,m}.</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP RegEx",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP RegEx</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_simplexml": {
        "title": "PHP SimpleXML",
        "summary": "Referensi method objek SimpleXMLElement: asXML(), attributes(), children(), xpath().",
        "content": "<p class=\"lead\">Referensi method objek SimpleXMLElement: asXML(), attributes(), children(), xpath().</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP SimpleXML",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP SimpleXML</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_stream": {
        "title": "PHP Stream",
        "summary": "Operasi abstraksi stream I/O jaringan dan berkas di level kernel PHP.",
        "content": "<p class=\"lead\">Operasi abstraksi stream I/O jaringan dan berkas di level kernel PHP.</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Stream",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Stream</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_string": {
        "title": "PHP String",
        "summary": "Kamus lengkap fungsi string: strtolower, strtoupper, ucfirst, ucwords, trim, substr.",
        "content": "<p class=\"lead\">Kamus lengkap fungsi string: strtolower, strtoupper, ucfirst, ucwords, trim, substr.</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP String",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP String</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_variable_handling": {
        "title": "PHP Variable Handling",
        "summary": "Fungsi tipe variabel: isset(), empty(), is_null(), is_array(), serialize().",
        "content": "<p class=\"lead\">Fungsi tipe variabel: isset(), empty(), is_null(), is_array(), serialize().</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Variable Handling",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Variable Handling</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_xml": {
        "title": "PHP XML Parser",
        "summary": "Fungsi bawaan Expat XML parser: xml_parse(), xml_parser_create().",
        "content": "<p class=\"lead\">Fungsi bawaan Expat XML parser: xml_parse(), xml_parser_create().</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP XML Parser",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP XML Parser</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_zip": {
        "title": "PHP Zip",
        "summary": "Mengekstrak dan membuat arsip berkas zip terkompresi dengan kelas ZipArchive.",
        "content": "<p class=\"lead\">Mengekstrak dan membuat arsip berkas zip terkompresi dengan kelas ZipArchive.</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Zip",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Zip</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      },
      "php_ref_timezones": {
        "title": "PHP Timezones",
        "summary": "Daftar nama zona waktu resmi IANA per benua dan negara (Asia/Makassar, Asia/Jakarta).",
        "content": "<p class=\"lead\">Daftar nama zona waktu resmi IANA per benua dan negara (Asia/Makassar, Asia/Jakarta).</p><p>Gunakan referensi ini sebagai panduan cepat saat memprogram aplikasi backend skala industri di Skillance Academy.</p>",
        "example_title": "Contoh Kode PHP Timezones",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi PHP Timezones</h3>\n    <p>PHP Documentation Standard Index 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode PHP dan amati simulasi output server pada panel pratinjau di atas.</p>"
      }
    }
  }
}
JSON_DATA, true);
