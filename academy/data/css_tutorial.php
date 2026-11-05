<?php
/**
 * Silabus Lengkap Tutorial CSS - Skillance Academy Indonesia
 * Skillance Academy Indonesia
 * Terbagi ke dalam 9 Kategori Utama dengan 125 Topik Lengkap
 */

return json_decode(<<<'JSON_DATA'
{
  "categories": {
    "CSS Tutorial": {
      "css_home": {
        "title": "CSS HOME",
        "summary": "Selamat Datang di Tutorial CSS Skillance Academy. CSS adalah bahasa yang kita gunakan untuk menata tampilan halaman HTML.",
        "content": "\n        <p class=\"lead\">Selamat datang di <strong>Tutorial CSS Lengkap</strong> Skillance Academy resmi dari Skillance Academy Indonesia. CSS (Cascading Style Sheets) digunakan untuk mengatur gaya visual, warna, font, dan tata letak seluruh elemen website.</p>\n        <p>CSS menghemat banyak waktu dan tenaga kerja pengembang web karena dapat mengontrol tata letak beberapa halaman web sekaligus dari satu file stylesheet tunggal.</p>\n        <div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n            <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-palette text-primary me-2\"></i>Mengapa Belajar CSS?</h6>\n            <ul class=\"mb-0 ps-3 small\" style=\"line-height: 1.8;\">\n                <li>Mengubah website kaku menjadi antarmuka modern yang memukau dan profesional.</li>\n                <li>Menciptakan desain responsif yang otomatis menyesuaikan layar HP, tablet, dan laptop.</li>\n                <li>Menguasai animasi halus, efek transisi interaktif, Flexbox, dan Grid modern.</li>\n            </ul>\n        </div>\n    ",
        "example_title": "Contoh Pengaruh CSS pada Dokumen HTML",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: Arial, sans-serif; background-color: #f8fafc; padding: 30px; text-align: center; }\n        h1 { color: #0d2e5c; }\n        p { color: #475569; font-size: 18px; }\n        .kotak-modern {\n            background: white;\n            padding: 25px;\n            border-radius: 16px;\n            border: 2px solid #3b82f6;\n            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);\n            max-width: 380px;\n            margin: auto;\n        }\n        .btn-modern {\n            background: #04AA6D;\n            color: white;\n            padding: 10px 20px;\n            border: none;\n            border-radius: 25px;\n            font-weight: bold;\n            cursor: pointer;\n        }\n    </style>\n</head>\n<body>\n\n    <div class=\"kotak-modern\">\n        <h1>Gaya Visual dengan CSS</h1>\n        <p>Kotak dan tombol ini dipercantik menggunakan aturan CSS.</p>\n        <button class=\"btn-modern\" onclick=\"alert('Tombol CSS Berhasil!')\">Uji Efek CSS</button>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Klik <strong>Coba Sendiri (Try it Yourself) &raquo;</strong> untuk mengubah warna background atau radius border kotak di editor!</p>",
        "quiz": {
          "q": "Apakah kepanjangan dari singkatan CSS?",
          "options": [
            "Creative Style Sheets",
            "Cascading Style Sheets",
            "Computer Style Sheets",
            "Colorful Style Sheets"
          ],
          "answer": 1,
          "explanation": "CSS adalah singkatan dari Cascading Style Sheets."
        }
      },
      "css_intro": {
        "title": "CSS Introduction",
        "summary": "Pengenalan apa itu CSS, bagaimana cara kerjanya, dan mengapa CSS memecahkan masalah besar web.",
        "content": "\n        <p class=\"lead\">CSS diciptakan oleh W3C untuk memisahkan konten (HTML) dari penyajian presentasi visual (CSS).</p>\n        <p>Pada era awal HTML, tag seperti <code>&lt;font&gt;</code> dan atribut warna harus ditulis berulang kali di setiap baris dokumen, yang membuat pengembangan website mimpi buruk bagi programmer. CSS memecahkan masalah ini dengan memusatkan seluruh aturan gaya di satu tempat.</p>\n    ",
        "example_title": "Contoh Sintaks CSS Dasar",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        h2 { color: #e11d48; text-transform: uppercase; }\n        p { line-height: 1.6; color: #334155; }\n    </style>\n</head>\n<body>\n    <h2>Pengenalan CSS</h2>\n    <p>Semua heading h2 otomatis berwarna merah dan huruf kapital tanpa perlu styling berulang!</p>\n</body>\n</html>",
        "explanation": "<p>Dengan satu aturan <code>h2 { color: #e11d48; }</code>, ribuan tag h2 di seluruh halaman otomatis berubah warna seragam.</p>",
        "quiz": {
          "q": "Apa tujuan utama diciptakannya CSS oleh konsorsium W3C?",
          "options": [
            "Menggantikan bahasa HTML",
            "Memisahkan konten struktur dari presentasi visual",
            "Membuat database di browser",
            "Menjalankan skrip backend"
          ],
          "answer": 1,
          "explanation": "CSS memisahkan konten (markup HTML) dari aturan tampilan visual (formatting CSS)."
        }
      },
      "css_syntax": {
        "title": "CSS Syntax",
        "summary": "Anatomi aturan CSS: Selector, Declaration Block, Property, dan Value.",
        "content": "\n        <p class=\"lead\">Aturan CSS terdiri dari <strong>Selector</strong> dan <strong>Declaration Block</strong>.</p>\n        <div class=\"card p-3 bg-light rounded-3 font-monospace small mb-3 text-center\">\n            <span style=\"color:#2563eb; font-weight:bold;\">h1</span> { \n            <span style=\"color:#d97706;\">color</span>: <span style=\"color:#16a34a;\">blue</span>; \n            <span style=\"color:#d97706;\">font-size</span>: <span style=\"color:#16a34a;\">12px</span>; }\n        </div>\n        <ul style=\"line-height: 1.8;\">\n            <li><strong>Selector:</strong> Menunjuk ke elemen HTML yang ingin Anda beri gaya (misal: <code>h1</code>, <code>.card</code>, <code>#btn</code>).</li>\n            <li><strong>Declaration Block:</strong> Diapit oleh tanda kurung kurawal <code>{ ... }</code> dan dapat berisi satu atau lebih deklarasi yang dipisahkan titik koma.</li>\n            <li><strong>Property:</strong> Ciri gaya yang ingin diubah (misal: <code>color</code>, <code>font-size</code>, <code>margin</code>).</li>\n            <li><strong>Value:</strong> Nilai yang diberikan untuk properti tersebut (misal: <code>blue</code>, <code>20px</code>).</li>\n        </ul>\n    ",
        "example_title": "Contoh Deklarasi Blok CSS",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        p {\n            color: #0d2e5c;\n            text-align: center;\n            font-size: 20px;\n            font-weight: bold;\n        }\n    </style>\n</head>\n<body>\n\n    <p>Paragraf ini ditata dengan 4 deklarasi CSS sekaligus!</p>\n\n</body>\n</html>",
        "explanation": "<p>Selalu akhiri setiap baris deklarasi dengan tanda titik koma (<code>;</code>).</p>",
        "quiz": {
          "q": "Tanda kurung apa yang digunakan untuk mengapit kumpulan deklarasi CSS?",
          "options": [
            "Kurung siku [ ]",
            "Kurung kurawal { }",
            "Kurung biasa ( )",
            "Kurung sudut < >"
          ],
          "answer": 1,
          "explanation": "Deklarasi CSS diapit oleh kurung kurawal { }."
        }
      },
      "css_selectors": {
        "title": "CSS Selectors",
        "summary": "Menyeleksi elemen HTML berdasarkan nama elemen, class (.nama), id (#nama), atribut, dan pengelompokan selector.",
        "content": "\n        <p class=\"lead\">CSS Selector digunakan untuk \"menemukan\" atau menyeleksi elemen HTML yang ingin Anda beri gaya.</p>\n        <h4>5 Kategori Utama Selector:</h4>\n        <ul style=\"line-height: 1.8;\">\n            <li><strong>Element Selector:</strong> Menyeleksi berdasarkan nama tag (misal: <code>p</code>, <code>h1</code>).</li>\n            <li><strong>ID Selector:</strong> Menyeleksi satu elemen unik dengan tanda pagar (misal: <code>#headerUtama</code>).</li>\n            <li><strong>Class Selector:</strong> Menyeleksi kelompok elemen dengan tanda titik (misal: <code>.sorotan</code>).</li>\n            <li><strong>Universal Selector:</strong> Menyeleksi seluruh elemen dengan tanda bintang (<code>*</code>).</li>\n            <li><strong>Grouping Selector:</strong> Mengelompokkan beberapa selector dengan koma (misal: <code>h1, h2, p { ... }</code>).</li>\n        </ul>\n    ",
        "example_title": "Contoh Penggunaan Selector Elemen, Class, dan ID",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        #judulSpesial { color: #fca311; }\n        .teks-hijau { color: #04AA6D; font-weight: bold; }\n        h3, p { font-family: sans-serif; }\n    </style>\n</head>\n<body>\n\n    <h3 id=\"judulSpesial\">Judul dengan ID Spesial (#)</h3>\n    <p class=\"teks-hijau\">Paragraf dengan Class (.teks-hijau)</p>\n    <p>Paragraf biasa yang terpengaruh selector elemen p.</p>\n\n</body>\n</html>",
        "explanation": "<p>Selector class diawali tanda titik (<code>.</code>), sedangkan selector ID diawali tanda pagar (<code>#</code>).</p>",
        "quiz": {
          "q": "Bagaimana cara menulis selector untuk elemen dengan class='menu'?",
          "options": [
            "#menu",
            ".menu",
            "menu",
            "*menu"
          ],
          "answer": 1,
          "explanation": "Selector class selalu diawali dengan tanda titik, sehingga ditulis .menu."
        }
      },
      "css_howto": {
        "title": "CSS How To",
        "summary": "3 cara menerapkan CSS: External CSS (<link>), Internal CSS (<style>), dan Inline CSS (style='').",
        "content": "\n        <p class=\"lead\">Ada tiga cara memasukkan aturan gaya CSS ke dalam dokumen HTML:</p>\n        <ol class=\"ps-3\" style=\"line-height: 1.8;\">\n            <li><strong>External CSS:</strong> Ditulis di berkas terpisah <code>.css</code> dan dimuat via <code>&lt;link rel=\"stylesheet\" href=\"mystyle.css\"&gt;</code> di dalam <code>&lt;head&gt;</code>.</li>\n            <li><strong>Internal CSS:</strong> Ditulis di dalam tag <code>&lt;style&gt;</code> di dalam bagian <code>&lt;head&gt;</code>.</li>\n            <li><strong>Inline CSS:</strong> Ditulis langsung di tag HTML melalui atribut <code>style=\"...\"</code>.</li>\n        </ol>\n        <h4>Urutan Prioritas Gaya (Cascading Order):</h4>\n        <p>Inline CSS &gt; Internal CSS &gt; External CSS &gt; Default Browser.</p>\n    ",
        "example_title": "Contoh External vs Internal",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <!-- Internal CSS -->\n    <style>\n        body { font-family: sans-serif; padding: 20px; }\n        .kotak { background: #e0f2fe; padding: 15px; border-radius: 8px; }\n    </style>\n</head>\n<body>\n\n    <div class=\"kotak\">\n        <!-- Inline CSS menimpa gaya sebelumnya -->\n        <h3 style=\"color: #0284c7; margin-top: 0;\">Judul dengan Inline CSS</h3>\n        <p>Internal CSS menata background kotak ini.</p>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Gunakan selalu External CSS untuk proyek berskala menengah hingga besar.</p>",
        "quiz": {
          "q": "Manakah cara penulisan CSS yang memiliki prioritas tertinggi (paling kuat menimpa gaya lain)?",
          "options": [
            "External CSS",
            "Internal CSS",
            "Inline CSS",
            "Browser Default"
          ],
          "answer": 2,
          "explanation": "Inline CSS yang ditulis langsung pada tag HTML memiliki prioritas tertinggi dibandingkan internal dan external."
        }
      },
      "css_comments": {
        "title": "CSS Comments",
        "summary": "Menulis catatan penjelasan di stylesheet yang diabaikan browser dengan /* komentar */.",
        "content": "\n        <p class=\"lead\">Komentar CSS digunakan untuk menjelaskan kode sumber Anda dan membantu saat mengedit kode di kemudian hari.</p>\n        <p>Komentar CSS diletakkan di dalam elemen <code>&lt;style&gt;</code>, diawali dengan <code>/*</code> dan diakhiri dengan <code>*/</code>.</p>\n    ",
        "example_title": "Contoh Komentar di CSS",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        /* Ini adalah komentar satu baris */\n        p {\n            color: #0d2e5c; /* Atur warna teks navy */\n            font-size: 18px;\n        }\n\n        /* \n        Komentar multi baris:\n        Aturan di bawah ini dinonaktifkan sementara:\n        h1 { color: red; }\n        */\n    </style>\n</head>\n<body>\n    <p>Komentar CSS tidak terlihat di halaman web.</p>\n</body>\n</html>",
        "explanation": "<p>Berbeda dengan HTML (<code>&lt;!-- --&gt;</code>), CSS menggunakan sintaks <code>/* */</code>.</p>",
        "quiz": {
          "q": "Bagaimana cara menulis komentar di dalam kode CSS?",
          "options": [
            "// Komentar",
            "<!-- Komentar -->",
            "/* Komentar */",
            "# Komentar"
          ],
          "answer": 2,
          "explanation": "Komentar CSS selalu ditulis di antara /* dan */."
        }
      },
      "css_errors": {
        "title": "CSS Errors",
        "summary": "Memahami bagaimana browser menangani kesalahan sintaks CSS tanpa mematikan seluruh halaman.",
        "content": "\n        <p class=\"lead\">CSS dirancang dengan prinsip toleransi kesalahan (error recovery). Jika browser menemukan kesalahan sintaks pada suatu deklarasi, browser akan mengabaikan deklarasi yang salah tersebut dan tetap melanjutkan membaca aturan berikutnya.</p>\n        <h4>Kesalahan yang Sering Terjadi:</h4>\n        <ul>\n            <li>Lupa tanda titik koma (<code>;</code>) penutup baris.</li>\n            <li>Typo pada nama properti (misal <code>colour: red;</code> bukan <code>color: red;</code>).</li>\n            <li>Lupa menutup kurung kurawal <code>}</code>.</li>\n        </ul>\n    ",
        "example_title": "Toleransi Kesalahan CSS di Browser",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        p {\n            colour: red; /* Salah ketik: diabaikan browser */\n            color: #04AA6D; /* Valid: diterapkan */\n            font-weight: bold;\n        }\n    </style>\n</head>\n<body>\n    <p>Teks ini tetap berwarna hijau karena browser cerdas mengabaikan baris yang salah!</p>\n</body>\n</html>",
        "explanation": "<p>Gunakan Chrome Developer Tools (F12) untuk melihat deklarasi CSS mana yang dicoret karena salah ketik.</p>",
        "quiz": {
          "q": "Apa yang dilakukan browser jika menemukan satu baris properti CSS yang salah ketik?",
          "options": [
            "Halaman langsung blank putih",
            "Mengabaikan baris yang salah dan tetap menjalankan baris lain",
            "Memunculkan popup error ke pengunjung",
            "Menutup browser otomatis"
          ],
          "answer": 1,
          "explanation": "Browser memiliki mekanisme toleransi yang mengabaikan deklarasi tidak dikenal dan melanjutkan aturan lainnya."
        }
      },
      "css_colors": {
        "title": "CSS Colors",
        "summary": "Pewarnaan elemen teks, border, dan background dengan nama warna, HEX, RGB, HSL, RGBA, dan HSLA.",
        "content": "\n        <p class=\"lead\">Warna ditentukan menggunakan nama warna yang telah ditentukan sebelumnya, atau nilai RGB, HEX, HSL, RGBA, HSLA.</p>\n        <h4>Format Nilai Warna CSS:</h4>\n        <ul>\n            <li><strong>RGB:</strong> <code>rgb(255, 99, 71)</code></li>\n            <li><strong>HEX:</strong> <code>#ff6347</code> (heksadesimal)</li>\n            <li><strong>HSL:</strong> <code>hsl(9, 100%, 64%)</code> (Hue, Saturation, Lightness)</li>\n            <li><strong>RGBA:</strong> <code>rgba(255, 99, 71, 0.5)</code> (dengan transparansi 50%)</li>\n        </ul>\n    ",
        "example_title": "Contoh Format Warna CSS Modern",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .c-hex { background: #0d2e5c; color: white; padding: 10px; margin: 5px 0; border-radius: 6px; }\n        .c-rgb { background: rgb(4, 170, 109); color: white; padding: 10px; margin: 5px 0; border-radius: 6px; }\n        .c-hsl { background: hsl(38, 97%, 53%); color: #0d2e5c; padding: 10px; margin: 5px 0; border-radius: 6px; font-weight: bold; }\n    </style>\n</head>\n<body>\n    <div class=\"c-hex\">Warna HEX: #0d2e5c (Navy)</div>\n    <div class=\"c-rgb\">Warna RGB: rgb(4, 170, 109) (Green)</div>\n    <div class=\"c-hsl\">Warna HSL: hsl(38, 97%, 53%) (Gold)</div>\n</body>\n</html>",
        "explanation": "<p>Format HEX dan RGB adalah dua format yang paling umum digunakan dalam stylesheet produksi.</p>",
        "quiz": {
          "q": "Berapa rentang nilai untuk masing-masing komponen R, G, B pada fungsi rgb()?",
          "options": [
            "0 hingga 100",
            "0 hingga 255",
            "1 hingga 10",
            "0 hingga 360"
          ],
          "answer": 1,
          "explanation": "Nilai intensitas warna merah (R), hijau (G), dan biru (B) berada pada rentang 0 s/d 255."
        }
      },
      "css_backgrounds": {
        "title": "CSS Backgrounds",
        "summary": "Mengatur latar belakang dengan background-color, background-image, repeat, attachment, dan position.",
        "content": "\n        <p class=\"lead\">Properti latar belakang CSS digunakan untuk menambahkan efek latar belakang pada elemen.</p>\n        <h4>Properti Latar Belakang:</h4>\n        <ul style=\"line-height: 1.8;\">\n            <li><code>background-color</code> : Warna latar belakang elemen.</li>\n            <li><code>background-image</code> : Gambar latar belakang (<code>url('gambar.jpg')</code>).</li>\n            <li><code>background-repeat</code> : Pengulangan gambar (<code>no-repeat</code>, <code>repeat-x</code>, <code>repeat-y</code>).</li>\n            <li><code>background-position</code> : Posisi awal gambar (<code>center</code>, <code>top right</code>).</li>\n            <li><code>background-size</code> : Ukuran gambar (<code>cover</code> agar memenuhi seluruh layar, <code>contain</code> agar pas di dalam wadah).</li>\n        </ul>\n    ",
        "example_title": "Contoh Background Cover Menawan",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .hero-box {\n            background-image: url('https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600');\n            background-size: cover;\n            background-position: center;\n            color: white;\n            padding: 50px 20px;\n            border-radius: 12px;\n            text-align: center;\n            box-shadow: inset 0 0 0 2000px rgba(13, 46, 92, 0.7);\n        }\n    </style>\n</head>\n<body>\n\n    <div class=\"hero-box\">\n        <h2 style=\"margin: 0;\">Latar Belakang Gambar Responsif</h2>\n        <p style=\"margin-bottom: 0;\">Menggunakan background-size: cover dan overlay transparan.</p>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Nilai <code>cover</code> memastikan gambar latar belakang selalu menutupi seluruh elemen tanpa distorsi.</p>",
        "quiz": {
          "q": "Nilai background-size apa yang membuat gambar meregang dan menutupi seluruh area elemen tanpa mengubah aspek rasio gambar?",
          "options": [
            "contain",
            "cover",
            "fill",
            "stretch"
          ],
          "answer": 1,
          "explanation": "background-size: cover memastikan seluruh area tertutup penuh oleh gambar."
        }
      },
      "css_borders": {
        "title": "CSS Borders",
        "summary": "Mengatur garis tepi elemen dengan border-style, border-width, border-color, dan border-radius.",
        "content": "\n        <p class=\"lead\">Properti <code>border</code> memungkinkan Anda menentukan gaya, ketebalan, dan warna garis tepi suatu elemen.</p>\n        <h4>Gaya Garis (Border Style):</h4>\n        <ul>\n            <li><code>solid</code> : Garis padat lurus biasa.</li>\n            <li><code>dashed</code> : Garis putus-putus strip.</li>\n            <li><code>dotted</code> : Garis titik-titik.</li>\n            <li><code>double</code> : Dua garis ganda sejajar.</li>\n            <li><code>none</code> : Tanpa garis tepi sama sekali.</li>\n        </ul>\n    ",
        "example_title": "Contoh Beragam Gaya Border",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .b-solid { border: 3px solid #04AA6D; padding: 10px; margin: 8px 0; border-radius: 8px; }\n        .b-dashed { border: 2px dashed #0d2e5c; padding: 10px; margin: 8px 0; border-radius: 8px; }\n        .b-rounded { border: 2px solid #fca311; border-radius: 25px; padding: 10px 20px; text-align: center; }\n    </style>\n</head>\n<body>\n    <div class=\"b-solid\">Border Solid Hijau (3px solid #04AA6D)</div>\n    <div class=\"b-dashed\">Border Dashed Navy (2px dashed #0d2e5c)</div>\n    <div class=\"b-rounded\">Border Membulat (border-radius: 25px)</div>\n</body>\n</html>",
        "explanation": "<p>Shorthand border ditulis ringkas: <code>border: [width] [style] [color];</code>.</p>",
        "quiz": {
          "q": "Properti CSS apa yang digunakan untuk membuat sudut garis tepi menjadi melengkung atau membulat?",
          "options": [
            "border-curve",
            "border-radius",
            "corner-radius",
            "border-round"
          ],
          "answer": 1,
          "explanation": "border-radius digunakan untuk membuat sudut elemen menjadi melengkung."
        }
      },
      "css_margins": {
        "title": "CSS Margins",
        "summary": "Mengatur jarak ruang kosong di sebelah LUAR garis tepi elemen, serta margin auto untuk perataan tengah.",
        "content": "\n        <p class=\"lead\">Properti CSS <code>margin</code> digunakan untuk membuat ruang kosong di sekitar elemen, di luar garis batas (border) yang ditentukan.</p>\n        <p>Margin selalu transparan dan tidak memiliki warna latar belakang.</p>\n        <h4>Margin Shorthand:</h4>\n        <ul>\n            <li><code>margin: 20px;</code> (Semua 4 sisi sama)</li>\n            <li><code>margin: 10px 20px;</code> (Atas-bawah 10px, kiri-kanan 20px)</li>\n            <li><code>margin: 0 auto;</code> (Pusatkan elemen block tepat di tengah halaman secara horizontal!)</li>\n        </ul>\n    ",
        "example_title": "Pusatkan Kotak di Tengah dengan Margin Auto",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kotak-tengah {\n            width: 280px;\n            margin: 30px auto;\n            background: #ffffff;\n            border: 2px solid #0d2e5c;\n            padding: 20px;\n            border-radius: 10px;\n            text-align: center;\n            box-shadow: 0 4px 10px rgba(0,0,0,0.08);\n        }\n    </style>\n</head>\n<body style=\"background:#f1f5f9;\">\n\n    <div class=\"kotak-tengah\">\n        <h4 style=\"margin-top:0;\">Kotak Tengah Otomatis</h4>\n        <p style=\"margin-bottom:0;\">Menggunakan <code>margin: 30px auto;</code>.</p>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Teknik <code>margin: auto;</code> adalah cara klasik paling andal untuk memusatkan elemen block yang memiliki lebar tetap.</p>",
        "quiz": {
          "q": "Nilai margin apa yang digunakan untuk memusatkan elemen block secara horizontal di tengah layar?",
          "options": [
            "margin: center;",
            "margin: 0 auto;",
            "margin: middle;",
            "margin: 50%;"
          ],
          "answer": 1,
          "explanation": "margin: 0 auto; secara otomatis membagi sisa ruang kosong sama rata di sisi kiri dan kanan."
        }
      },
      "css_padding": {
        "title": "CSS Padding",
        "summary": "Mengatur jarak ruang kosong di sebelah DALAM antara konten teks dan garis batas (border) elemen.",
        "content": "\n        <p class=\"lead\">Properti CSS <code>padding</code> digunakan untuk menghasilkan ruang kosong di sekitar konten suatu elemen, di dalam batas (border) yang ditentukan.</p>\n        <p>Berbeda dengan margin yang berada di luar border, area padding akan ikut terwarnai jika elemen memiliki warna latar belakang (background-color).</p>\n    ",
        "example_title": "Contoh Perbedaan Padding",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kotak-sempit { background: #fee2e2; border: 2px solid #ef4444; padding: 5px; margin-bottom: 10px; }\n        .kotak-lega { background: #dcfce7; border: 2px solid #22c55e; padding: 25px; }\n    </style>\n</head>\n<body>\n\n    <div class=\"kotak-sempit\">Padding 5px: Teks terasa sesak dan mepet ke garis border.</div>\n    <div class=\"kotak-lega\">Padding 25px: Teks terasa sangat lega, nyaman dibaca, dan elegan.</div>\n\n</body>\n</html>",
        "explanation": "<p>Padding yang cukup adalah rahasia membuat desain website terlihat modern dan tidak kaku.</p>",
        "quiz": {
          "q": "Di manakah posisi ruang padding pada suatu elemen?",
          "options": [
            "Di luar border elemen",
            "Di dalam border (antara konten dan border)",
            "Di belakang layar",
            "Di atas halaman"
          ],
          "answer": 1,
          "explanation": "Padding terletak di dalam garis border elemen mengelilingi konten teks/gambar."
        }
      },
      "css_height_width": {
        "title": "CSS Height / Width",
        "summary": "Mengatur dimensi tinggi dan lebar elemen dengan piksel (px), persen (%), vh, vw, serta min/max limits.",
        "content": "\n        <p class=\"lead\">Properti <code>height</code> dan <code>width</code> digunakan untuk mengatur tinggi dan lebar suatu elemen.</p>\n        <p>Properti ini tidak termasuk padding, border, atau margin elemen kecuali jika Anda menggunakan aturan <code>box-sizing: border-box;</code>.</p>\n    ",
        "example_title": "Dimensi Tinggi dan Lebar Elemen",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .banner {\n            width: 80%;\n            height: 120px;\n            background-color: #0d2e5c;\n            color: white;\n            border-radius: 8px;\n            display: flex;\n            align-items: center;\n            justify-content: center;\n            margin: auto;\n        }\n    </style>\n</head>\n<body>\n\n    <div class=\"banner\">\n        <h3>Lebar 80% & Tinggi 120px</h3>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Gunakan satuan persen (%) untuk lebar agar elemen otomatis mengecil di layar yang lebih sempit.</p>",
        "quiz": {
          "q": "Satuan ukuran apa yang membuat lebar elemen bersifat relatif terhadap ukuran elemen induknya?",
          "options": [
            "px (piksel)",
            "% (persen)",
            "pt (poin)",
            "cm (sentimeter)"
          ],
          "answer": 1,
          "explanation": "Satuan persen (%) menghitung proporsi ukuran berdasarkan wadah induknya."
        }
      },
      "css_boxmodel": {
        "title": "CSS Box Model",
        "summary": "Konsep fundamental perhitungan dimensi browser: Margin, Border, Padding, Content, dan box-sizing: border-box.",
        "content": "\n        <p class=\"lead\">Semua elemen HTML dapat dianggap sebagai kotak. Dalam CSS, istilah <strong>Box Model</strong> digunakan saat berbicara tentang desain dan tata letak.</p>\n        <p>CSS Box Model terdiri dari: Margin (terluar), Border, Padding, dan Content (konten teks/gambar paling dalam).</p>\n        <div class=\"alert alert-success py-2 small\">\n            <strong>Standar Wajib:</strong> Selalu gunakan <code>* { box-sizing: border-box; }</code> di setiap proyek agar padding dan border tidak menambah lebar total elemen!\n        </div>\n    ",
        "example_title": "Penerapan Box Model dengan Box-Sizing",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        * { box-sizing: border-box; }\n        .kotak {\n            width: 100%;\n            max-width: 300px;\n            padding: 30px;\n            border: 5px solid #04AA6D;\n            margin: 20px auto;\n            background: white;\n            text-align: center;\n            box-shadow: 0 4px 15px rgba(0,0,0,0.1);\n        }\n    </style>\n</head>\n<body style=\"background:#f8fafc; font-family:sans-serif;\">\n\n    <div class=\"kotak\">\n        <h4 style=\"margin-top:0;\">Box Model Sempurna</h4>\n        <p style=\"margin-bottom:0;\">Lebar kotak tetap tepat 300px meskipun padding diperbesar.</p>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Tanpa <code>border-box</code>, kotak di atas akan berukuran 300 + 60 (padding) + 10 (border) = 370px!</p>",
        "quiz": {
          "q": "Properti CSS apa yang memastikan padding dan border dihitung di dalam lebar total elemen?",
          "options": [
            "box-sizing: border-box;",
            "box-sizing: content-box;",
            "layout: fix;",
            "margin: inner;"
          ],
          "answer": 0,
          "explanation": "box-sizing: border-box membuat perhitungan lebar mencakup konten, padding, dan border secara terintegrasi."
        }
      },
      "css_outline": {
        "title": "CSS Outline",
        "summary": "Garis terluar di luar border yang tidak memakan ruang tata letak, sering dipakai untuk indikator fokus keyboard.",
        "content": "\n        <p class=\"lead\">Outline adalah garis yang ditarik di luar garis batas (border) elemen, untuk membuat elemen \"menonjol\" atau sebagai indikator fokus navigasi aksesibilitas.</p>\n        <p>Berbeda dengan border, outline TIDAK memakan ruang tata letak dan tidak mengubah dimensi kotak sama sekali.</p>\n    ",
        "example_title": "Contoh Garis Outline",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kotak-outline {\n            border: 2px solid #0d2e5c;\n            outline: 3px solid #fca311;\n            outline-offset: 4px;\n            padding: 15px;\n            max-width: 300px;\n            margin: 20px auto;\n            text-align: center;\n        }\n    </style>\n</head>\n<body>\n\n    <div class=\"kotak-outline\">\n        <p style=\"margin:0;\">Kotak ini memiliki border navy dan outline emas dengan offset 4px.</p>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Properti <code>outline-offset</code> memberi jarak pemisah antara garis border dan garis outline.</p>",
        "quiz": {
          "q": "Apakah garis outline CSS memakan ruang dimensi layout elemen seperti halnya border?",
          "options": [
            "Ya, sama persis",
            "Tidak, outline digambar di luar dan tidak memakan ruang layout",
            "Hanya jika diberi margin",
            "Tergantung browser"
          ],
          "answer": 1,
          "explanation": "Outline digambar melayang di luar border elemen dan sama sekali tidak mengubah lebar atau tinggi ruang dokumen."
        }
      },
      "css_text": {
        "title": "CSS Text",
        "summary": "Memformat teks: text-align, text-decoration, text-transform, letter-spacing, line-height, text-shadow.",
        "content": "\n        <p class=\"lead\">CSS memiliki banyak properti untuk memformat tampilan teks paragraf dan judul.</p>\n        <ul style=\"line-height: 1.8;\">\n            <li><code>text-align</code> : Perataan teks (left, center, right, justify).</li>\n            <li><code>text-decoration</code> : Garis hiasan (none untuk menghapus garis bawah link, underline, line-through).</li>\n            <li><code>text-transform</code> : Mengubah kapitalisasi teks (uppercase, lowercase, capitalize).</li>\n            <li><code>letter-spacing</code> : Jarak antar huruf (kerning).</li>\n            <li><code>line-height</code> : Jarak antar baris teks (sangat penting untuk kenyamanan membaca).</li>\n        </ul>\n    ",
        "example_title": "Contoh Tipografi Teks Modern",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .teks-keren {\n            text-transform: uppercase;\n            letter-spacing: 2px;\n            color: #0d2e5c;\n            text-align: center;\n            font-weight: 800;\n        }\n        .paragraf-nyaman {\n            line-height: 1.8;\n            color: #334155;\n            font-size: 16px;\n        }\n    </style>\n</head>\n<body>\n\n    <h3 class=\"teks-keren\">Tipografi Standar Industri</h3>\n    <p class=\"paragraf-nyaman\">Paragraf ini menggunakan line-height 1.8 sehingga jarak antar barisnya sangat lega dan tidak membuat mata lelah membaca artikel panjang.</p>\n\n</body>\n</html>",
        "explanation": "<p>Menghapus garis bawah pada tautan link dilakukan dengan <code>text-decoration: none;</code>.</p>",
        "quiz": {
          "q": "Properti CSS apa yang digunakan untuk mengatur jarak spasi vertikal antar baris teks?",
          "options": [
            "line-spacing",
            "line-height",
            "row-gap",
            "letter-spacing"
          ],
          "answer": 1,
          "explanation": "line-height mengatur jarak tinggi antar baris kalimat teks."
        }
      },
      "css_fonts": {
        "title": "CSS Fonts",
        "summary": "Mengatur tipografi: font-family, Web Safe Fonts, font-size (px, rem), font-weight, dan Google Fonts.",
        "content": "\n        <p class=\"lead\">Memilih jenis font yang tepat memiliki pengaruh besar terhadap persepsi pengunjung terhadap kualitas website Anda.</p>\n        <h4>Font Fallback (Font Family):</h4>\n        <p>Selalu sediakan beberapa font cadangan dengan generic font family di akhir deklarasi, contoh:<br>\n        <code>font-family: 'Plus Jakarta Sans', Arial, sans-serif;</code></p>\n        <h4>Satuan Ukuran Font:</h4>\n        <p>Gunakan satuan <code>rem</code> (Root EM) agar ukuran font otomatis menyesuaikan jika pengguna mengubah ukuran font dasar di browser mereka demi aksesibilitas.</p>\n    ",
        "example_title": "Penggunaan Font Modern Sans-Serif",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif; padding: 20px; }\n        h2 { font-weight: 800; color: #0d2e5c; }\n    </style>\n</head>\n<body>\n\n    <h2>Jenis Font Sistem Modern</h2>\n    <p>Font sistem ini dimuat secara instan tanpa perlu mengunduh file font dari server eksternal!</p>\n\n</body>\n</html>",
        "explanation": "<p>Google Fonts dapat diimpor via tag <code>&lt;link&gt;</code> di HTML atau <code>@import</code> di CSS.</p>",
        "quiz": {
          "q": "Apakah fungsi generic font family seperti 'sans-serif' di akhir deklarasi font-family?",
          "options": [
            "Sebagai font utama",
            "Sebagai font cadangan (fallback) jika font pertama tidak tersedia",
            "Untuk memberi warna font",
            "Menghapus font"
          ],
          "answer": 1,
          "explanation": "Generic font family bertindak sebagai cadangan darurat jika komputer pengguna tidak memiliki font khusus yang diminta."
        }
      },
      "css_icons": {
        "title": "CSS Icons",
        "summary": "Menambahkan ikon visual menarik menggunakan pustaka Font Awesome, Google Material Icons, dan Bootstrap Icons.",
        "content": "\n        <p class=\"lead\">Cara termudah untuk menambahkan ikon ke halaman HTML Anda adalah menggunakan pustaka ikon seperti <strong>Font Awesome</strong> atau <strong>Bootstrap Icons</strong>.</p>\n        <p>Ikon berbasis font vektor ini dapat diubah ukurannya dan diberi warna dengan mudah menggunakan properti CSS <code>font-size</code> dan <code>color</code> biasa.</p>\n    ",
        "example_title": "Contoh Penggunaan Ikon Font Awesome",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css\">\n    <style>\n        .icon-box { font-size: 28px; margin: 10px; display: inline-block; }\n    </style>\n</head>\n<body>\n\n    <div class=\"icon-box\" style=\"color:#04AA6D;\"><i class=\"fa-solid fa-circle-check\"></i> Sukses</div>\n    <div class=\"icon-box\" style=\"color:#0d2e5c;\"><i class=\"fa-solid fa-graduation-cap\"></i> Belajar</div>\n    <div class=\"icon-box\" style=\"color:#fca311;\"><i class=\"fa-solid fa-bolt\"></i> Cepat</div>\n\n</body>\n</html>",
        "explanation": "<p>Ikon vektor tidak pernah pecah atau buram di layar ponsel resolusi tinggi.</p>",
        "quiz": {
          "q": "Properti CSS apa yang digunakan untuk mengubah ukuran sebuah ikon berbasis icon-font?",
          "options": [
            "icon-size",
            "font-size",
            "width",
            "zoom"
          ],
          "answer": 1,
          "explanation": "Karena berbasis font, ukuran ikon diatur menggunakan properti standar font-size."
        }
      },
      "css_links": {
        "title": "CSS Links",
        "summary": "Menata tautan dengan pseudo-class state: a:link, a:visited, a:hover, a:active, dan membuat tombol link.",
        "content": "\n        <p class=\"lead\">Tautan dapat ditata dengan properti CSS apa pun (seperti color, font-family, background, dll).</p>\n        <h4>4 Status (State) Tautan:</h4>\n        <ul style=\"line-height: 1.8;\">\n            <li><code>a:link</code> : Tautan normal yang belum pernah dikunjungi pengguna.</li>\n            <li><code>a:visited</code> : Tautan yang sudah pernah dikunjungi pengguna.</li>\n            <li><code>a:hover</code> : Saat kursor mouse pengguna melayang di atas tautan.</li>\n            <li><code>a:active</code> : Tepat saat tautan sedang diklik mouse.</li>\n        </ul>\n        <div class=\"alert alert-warning py-2 small\">\n            <strong>Urutan Aturan Wajib (Love/Hate):</strong> <code>a:hover</code> HARUS ditulis setelah <code>a:link</code> dan <code>a:visited</code>. <code>a:active</code> HARUS ditulis setelah <code>a:hover</code>!\n        </div>\n    ",
        "example_title": "Membuat Tombol Tautan Menawan dengan Hover",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        a.btn-cta {\n            background-color: #0d2e5c;\n            color: #ffffff;\n            padding: 12px 24px;\n            text-decoration: none;\n            border-radius: 25px;\n            font-weight: bold;\n            display: inline-block;\n            transition: all 0.3s ease;\n        }\n        a.btn-cta:hover {\n            background-color: #fca311;\n            color: #0d2e5c;\n            transform: translateY(-3px);\n            box-shadow: 0 4px 12px rgba(252, 163, 17, 0.4);\n        }\n    </style>\n</head>\n<body>\n\n    <a href=\"#\" class=\"btn-cta\">Arahkan Kursor ke Tombol Ini »</a>\n\n</body>\n</html>",
        "explanation": "<p>Transisi <code>transition: all 0.3s ease;</code> membuat perubahan warna hover berlangsung mulus.</p>",
        "quiz": {
          "q": "Pseudo-class apa yang aktif ketika kursor mouse pengguna berada tepat di atas sebuah elemen tautan?",
          "options": [
            ":focus",
            ":hover",
            ":active",
            ":visited"
          ],
          "answer": 1,
          "explanation": ":hover aktif ketika kursor mouse melayang di atas elemen."
        }
      },
      "css_lists": {
        "title": "CSS Lists",
        "summary": "Menata daftar dengan list-style-type, list-style-image, dan menghapus bullet points untuk navigasi.",
        "content": "\n        <p class=\"lead\">Dalam HTML, ada dua jenis daftar utama: Unordered List (<code>&lt;ul&gt;</code>) dan Ordered List (<code>&lt;ol&gt;</code>).</p>\n        <p>Properti CSS <code>list-style-type</code> memungkinkan Anda mengganti simbol butir dengan lingkaran, kotak, huruf Romawi, atau menghapusnya sama sekali menggunakan <code>list-style-type: none;</code> (sangat sering dipakai saat membuat menu navigasi navbar).</p>\n    ",
        "example_title": "Mengubah Tag List Menjadi Menu Navigasi Horizontal",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        ul.nav-menu {\n            list-style-type: none;\n            margin: 0;\n            padding: 0;\n            background-color: #0d2e5c;\n            display: flex;\n            border-radius: 8px;\n        }\n        ul.nav-menu li a {\n            display: block;\n            color: white;\n            padding: 14px 20px;\n            text-decoration: none;\n            font-weight: bold;\n        }\n        ul.nav-menu li a:hover {\n            background-color: #04AA6D;\n        }\n    </style>\n</head>\n<body>\n\n    <ul class=\"nav-menu\">\n        <li><a href=\"#\">Beranda</a></li>\n        <li><a href=\"#\">Materi CSS</a></li>\n        <li><a href=\"#\">Tryit Editor</a></li>\n    </ul>\n\n</body>\n</html>",
        "explanation": "<p>Menghapus padding dan margin serta memberi <code>list-style-type: none;</code> adalah teknik standar membuat navbar dari tag list.</p>",
        "quiz": {
          "q": "Properti dan nilai apa yang digunakan untuk menghilangkan tanda titik hitam (bullet) pada tag <ul>?",
          "options": [
            "bullet: none;",
            "list-style-type: none;",
            "list-type: off;",
            "remove-bullet: true;"
          ],
          "answer": 1,
          "explanation": "list-style-type: none; menghapus penanda butir dari elemen list."
        }
      },
      "css_tables": {
        "title": "CSS Tables",
        "summary": "Membuat tabel rapi berstandar industri dengan border-collapse, padding sel, zebra striping, dan hover baris.",
        "content": "\n        <p class=\"lead\">Tampilan tabel HTML bawaan browser terlihat sangat tua dan kaku. Dengan CSS, tabel dapat diubah menjadi tabel data modern yang sangat rapi dan mudah dibaca.</p>\n        <h4>Teknik Tabel Modern:</h4>\n        <ul style=\"line-height: 1.8;\">\n            <li><code>border-collapse: collapse;</code> : Menggabungkan garis batas ganda menjadi satu garis tipis elegan.</li>\n            <li><code>th, td { padding: 12px; }</code> : Memberi ruang bernapas pada isi sel agar tidak mepet.</li>\n            <li><code>tr:nth-child(even)</code> : Memberikan warna belang-belang abu-abu muda bergantian (Zebra Striping).</li>\n            <li><code>tr:hover</code> : Memberikan sorotan warna saat baris diarahkan kursor.</li>\n        </ul>\n    ",
        "example_title": "Contoh Tabel Modern Zebra Striping",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        table { width: 100%; border-collapse: collapse; font-family: sans-serif; }\n        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e2e8f0; }\n        th { background-color: #0d2e5c; color: white; }\n        tr:nth-child(even) { background-color: #f8fafc; }\n        tr:hover { background-color: #e0f2fe; }\n    </style>\n</head>\n<body>\n\n    <table>\n        <tr><th>Nama Siswa</th><th>Kelas</th><th>Nilai</th></tr>\n        <tr><td>Budi Santoso</td><td>Web Frontend</td><td>95</td></tr>\n        <tr><td>Siti Rahma</td><td>CSS Specialist</td><td>98</td></tr>\n        <tr><td>Ahmad Fauzi</td><td>Backend API</td><td>92</td></tr>\n    </table>\n\n</body>\n</html>",
        "explanation": "<p>Tabel zebra striping sangat mempermudah mata manusia membaca baris data yang banyak.</p>",
        "quiz": {
          "q": "Selector pseudo-class apa yang digunakan untuk mewarnai baris tabel secara selang-seling (zebra striping)?",
          "options": [
            "tr:odd",
            "tr:nth-child(even)",
            "tr:alternate",
            "tr:stripe"
          ],
          "answer": 1,
          "explanation": "tr:nth-child(even) menyeleksi baris-baris genap untuk diberi warna latar belang."
        }
      },
      "css_display": {
        "title": "CSS Display",
        "summary": "Mengontrol perilaku rendering elemen: block, inline, inline-block, flex, grid, dan none.",
        "content": "\n        <p class=\"lead\">Properti <code>display</code> adalah properti CSS paling penting untuk mengontrol tata letak halaman web.</p>\n        <h4>Nilai-Nilai Display Utama:</h4>\n        <ul style=\"line-height: 1.8;\">\n            <li><code>block</code> : Mengambil lebar penuh dan selalu membuat baris baru (seperti <code>&lt;div&gt;</code>).</li>\n            <li><code>inline</code> : Hanya mengambil selebar konten dan tidak membuat baris baru (seperti <code>&lt;span&gt;</code>).</li>\n            <li><code>inline-block</code> : Sejajar di baris yang sama, tetapi DAPAT diatur lebar (width) dan tingginya (height).</li>\n            <li><code>flex</code> : Mengaktifkan tata letak flexbox satu dimensi.</li>\n            <li><code>none</code> : Menyembunyikan elemen sepenuhnya (elemen hilang dari alur dokumen).</li>\n        </ul>\n    ",
        "example_title": "Contoh Perbedaan Display Block vs Inline-Block",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kotak-ib {\n            display: inline-block;\n            width: 120px;\n            height: 60px;\n            background-color: #04AA6D;\n            color: white;\n            padding: 10px;\n            margin: 5px;\n            border-radius: 6px;\n            text-align: center;\n        }\n    </style>\n</head>\n<body>\n\n    <div class=\"kotak-ib\">Kotak 1</div>\n    <div class=\"kotak-ib\">Kotak 2</div>\n    <div class=\"kotak-ib\">Kotak 3</div>\n\n</body>\n</html>",
        "explanation": "<p>Dengan <code>inline-block</code>, ketiga kotak di atas berjajar ke samping secara rapi dengan ukuran lebar tetap 120px.</p>",
        "quiz": {
          "q": "Apa perbedaan antara display: none; dengan visibility: hidden;?",
          "options": [
            "Sama saja tidak ada bedanya",
            "display: none menghapus ruang elemen, sedangkan visibility: hidden menyembunyikan tetapi ruang kosongnya tetap ada",
            "visibility: none tidak valid",
            "display: none hanya untuk gambar"
          ],
          "answer": 1,
          "explanation": "display: none menghilangkan elemen dan ruang tata letaknya, sedangkan visibility: hidden menyembunyikan visual tetapi ruang kosongnya tetap dipertahankan."
        }
      },
      "css_max_width": {
        "title": "CSS Max-width",
        "summary": "Mencegah elemen meluber keluar layar browser di smartphone dengan max-width: 100%.",
        "content": "\n        <p class=\"lead\">Menggunakan <code>width: 500px;</code> membuat elemen tetap selebar 500px bahkan jika dibuka di layar smartphone yang hanya selebar 360px, sehingga memicu scrollbar horizontal yang merusak tampilan.</p>\n        <p>Solusinya adalah menggunakan <code>max-width: 500px; width: 100%;</code>. Elemen akan maksimal selebar 500px di laptop, namun otomatis mengecil menyesuaikan lebar layar ponsel!</p>\n    ",
        "example_title": "Contoh Kontainer dengan Max-Width Responsif",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .wadah-responsif {\n            max-width: 450px;\n            margin: auto;\n            background: #ffffff;\n            border: 2px solid #0d2e5c;\n            padding: 20px;\n            border-radius: 12px;\n            text-align: center;\n        }\n    </style>\n</head>\n<body style=\"background:#f1f5f9; padding:15px;\">\n\n    <div class=\"wadah-responsif\">\n        <h4 style=\"margin-top:0;\">Wadah Responsif</h4>\n        <p>Coba perkecil jendela browser Anda: kotak ini tidak akan pernah meluber keluar layar!</p>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Gunakan selalu <code>max-width</code> untuk kontainer utama, kartu, dan gambar.</p>",
        "quiz": {
          "q": "Mengapa max-width lebih disukai daripada width statis untuk kontainer kartu website?",
          "options": [
            "Karena membuat website lebih cepat",
            "Agar konten otomatis mengecil jika dibuka di layar smartphone kecil",
            "Hanya tren desain",
            "Agar warna berubah otomatis"
          ],
          "answer": 1,
          "explanation": "max-width menjamin elemen tidak meluber ke samping pada layar perangkat sempit."
        }
      },
      "css_position": {
        "title": "CSS Position",
        "summary": "Mengatur posisi elemen dengan static, relative, fixed, absolute, dan sticky.",
        "content": "\n        <p class=\"lead\">Properti <code>position</code> menentukan jenis metode pemosisian yang digunakan untuk suatu elemen.</p>\n        <h4>5 Nilai Posisi:</h4>\n        <ul style=\"line-height: 1.8;\">\n            <li><code>static</code> : (Default) Mengikuti alur normal halaman dokumen.</li>\n            <li><code>relative</code> : Diposisikan relatif terhadap posisi normalnya sendiri (menjadi titik acuan bagi absolute anak).</li>\n            <li><code>absolute</code> : Diposisikan relatif terhadap elemen induk terdekat yang memiliki posisi non-static.</li>\n            <li><code>fixed</code> : Terkunci pada viewport jendela browser (tetap di tempat saat di-scroll, misal tombol WhatsApp melayang).</li>\n            <li><code>sticky</code> : Beralih antara relative dan fixed tergantung posisi scroll pengguna (misal navbar yang menempel di atas saat di-scroll).</li>\n        </ul>\n    ",
        "example_title": "Contoh Posisi Relative dan Absolute",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .induk {\n            position: relative;\n            width: 280px;\n            height: 140px;\n            background: #e2e8f0;\n            border-radius: 8px;\n            padding: 10px;\n            margin: auto;\n        }\n        .badge-anak {\n            position: absolute;\n            top: 10px;\n            right: 10px;\n            background: #e11d48;\n            color: white;\n            padding: 4px 10px;\n            border-radius: 12px;\n            font-size: 0.75rem;\n            font-weight: bold;\n        }\n    </style>\n</head>\n<body>\n\n    <div class=\"induk\">\n        <span class=\"badge-anak\">HOT PROMO</span>\n        <h4>Kartu Produk</h4>\n        <p>Badge merah di atas menempel presisi di pojok kanan atas berkat position: absolute!</p>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Kombinasi <code>position: relative</code> pada kontainer induk dan <code>position: absolute</code> pada elemen anak adalah teknik paling populer di web.</p>",
        "quiz": {
          "q": "Nilai position apa yang membuat elemen tetap menempel di layar dan tidak bergerak saat halaman di-scroll ke bawah?",
          "options": [
            "static",
            "fixed",
            "relative",
            "inline"
          ],
          "answer": 1,
          "explanation": "position: fixed mengunci posisi elemen relatif terhadap viewport jendela browser."
        }
      },
      "css_position_offset": {
        "title": "CSS Position Offsets",
        "summary": "Mengatur jarak perpindahan posisi dengan koordinat top, right, bottom, dan left.",
        "content": "\n        <p class=\"lead\">Untuk memindahkan elemen yang memiliki posisi relative, absolute, fixed, atau sticky, kita menggunakan properti koordinat offset: <code>top</code>, <code>right</code>, <code>bottom</code>, dan <code>left</code>.</p>\n    ",
        "example_title": "Contoh Mengatur Koordinat Offset",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kotak-geser {\n            position: relative;\n            left: 30px;\n            top: 10px;\n            background: #fca311;\n            padding: 15px;\n            border-radius: 8px;\n            max-width: 250px;\n        }\n    </style>\n</head>\n<body>\n\n    <div class=\"kotak-geser\">Kotak ini digeser 30px ke kanan dan 10px ke bawah dari posisi normalnya.</div>\n\n</body>\n</html>",
        "explanation": "<p>Properti offset hanya akan berfungsi jika elemen memiliki <code>position</code> selain static.</p>"
      },
      "css_zindex": {
        "title": "CSS Z-index",
        "summary": "Mengatur urutan tumpukan lapisan elemen secara vertikal ke arah pengguna (stacking order).",
        "content": "\n        <p class=\"lead\">Ketika elemen-elemen saling bertumpukan, properti <code>z-index</code> menentukan elemen mana yang berada di lapisan paling atas (paling dekat dengan mata pengguna).</p>\n        <p>Elemen dengan nilai <code>z-index</code> yang lebih besar akan selalu menutupi elemen dengan nilai z-index yang lebih kecil. Catatan: z-index hanya berfungsi pada elemen yang memiliki posisi (relative, absolute, fixed, atau sticky).</p>\n    ",
        "example_title": "Contoh Lapisan Z-Index",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .lapisan-bawah { position: absolute; left: 20px; top: 20px; width: 120px; height: 120px; background: #0d2e5c; z-index: 1; border-radius: 8px; color: white; padding: 10px; }\n        .lapisan-atas { position: absolute; left: 60px; top: 60px; width: 120px; height: 120px; background: #04AA6D; z-index: 2; border-radius: 8px; color: white; padding: 10px; }\n    </style>\n</head>\n<body style=\"position:relative; height:200px;\">\n\n    <div class=\"lapisan-bawah\">Z-Index: 1</div>\n    <div class=\"lapisan-atas\">Z-Index: 2 (Di Depan)</div>\n\n</body>\n</html>",
        "explanation": "<p>Modal dialog dan popup biasanya diberi <code>z-index: 1050;</code> agar selalu tampil di atas seluruh konten halaman.</p>",
        "quiz": {
          "q": "Elemen dengan z-index berapa yang akan tampil di lapisan paling depan?",
          "options": [
            "z-index: 1",
            "z-index: 10",
            "z-index: 999",
            "z-index: 0"
          ],
          "answer": 2,
          "explanation": "Semakin tinggi angka z-index, semakin depan lapisan elemen tersebut ditampilkan."
        }
      },
      "css_overflow": {
        "title": "CSS Overflow",
        "summary": "Mengontrol perilaku konten yang terlalu besar untuk wadahnya: visible, hidden, scroll, auto.",
        "content": "\n        <p class=\"lead\">Properti <code>overflow</code> mengontrol apa yang terjadi pada konten yang terlalu besar untuk muat di dalam kotak dengan ukuran tetap.</p>\n        <ul>\n            <li><code>visible</code> : (Default) Konten meluber keluar dari batas kotak.</li>\n            <li><code>hidden</code> : Konten yang meluber dipotong rapi dan disembunyikan.</li>\n            <li><code>scroll</code> : Memunculkan scrollbar horizontal & vertikal secara permanen.</li>\n            <li><code>auto</code> : Otomatis memunculkan scrollbar hanya jika konten benar-benar meluber.</li>\n        </ul>\n    ",
        "example_title": "Contoh Kotak dengan Overflow Auto",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kotak-scroll {\n            width: 250px;\n            height: 100px;\n            background: #ffffff;\n            border: 2px solid #cbd5e1;\n            padding: 12px;\n            overflow: auto;\n            border-radius: 8px;\n            font-size: 0.85rem;\n        }\n    </style>\n</head>\n<body>\n\n    <div class=\"kotak-scroll\">\n        Paragraf yang sangat panjang ini memiliki banyak teks di dalamnya. Karena tinggi kotaknya dibatasi hanya 100px, browser secara otomatis memunculkan scrollbar di samping kanan sehingga pengunjung tetap dapat menggulir dan membaca seluruh isi pesan tanpa merusak tata letak di sekitarnya.\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Gunakan <code>overflow: hidden;</code> jika Anda ingin memotong gambar yang berukuran lebih besar dari kartu wadahnya.</p>",
        "quiz": {
          "q": "Nilai overflow apa yang memunculkan scrollbar secara otomatis hanya ketika konten melebihi kapasitas wadahnya?",
          "options": [
            "visible",
            "hidden",
            "scroll",
            "auto"
          ],
          "answer": 3,
          "explanation": "overflow: auto memunculkan scrollbar secara dinamis jika diperlukan."
        }
      },
      "css_float": {
        "title": "CSS Float",
        "summary": "Mengalirkan gambar ke kiri atau kanan teks dengan float dan membersihkan aliran dengan clear atau clearfix.",
        "content": "\n        <p class=\"lead\">Properti <code>float</code> digunakan untuk memposisikan dan memformat konten, misalnya membiarkan gambar melayang ke kiri atau ke kanan dan teks mengalir mengelilinginya (seperti koran).</p>\n        <p>Meskipun untuk tata letak halaman kini menggunakan Flexbox/Grid, float tetap sangat berguna untuk menyisipkan gambar di tengah-tengah artikel teks panjang.</p>\n    ",
        "example_title": "Contoh Gambar Mengalir di Samping Paragraf",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .img-float {\n            float: left;\n            margin: 0 15px 10px 0;\n            border-radius: 8px;\n        }\n    </style>\n</head>\n<body>\n\n    <img src=\"https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=150\" class=\"img-float\" alt=\"Laptop\">\n    <p>Teks paragraf ini otomatis mengalir mengelilingi gambar di sebelah kiri secara alami. Saat paragraf berlanjut lebih panjang ke bawah, teks akan mengalir di bawah gambar dengan rapi.</p>\n\n</body>\n</html>",
        "explanation": "<p>Gunakan <code>clear: both;</code> pada elemen setelahnya untuk menghentikan efek aliran float.</p>"
      },
      "css_inline_block": {
        "title": "CSS Inline-block",
        "summary": "Membuat elemen sejajar ke samping seperti teks inline tetapi tetap dapat diatur lebar dan tingginya.",
        "content": "\n        <p class=\"lead\">Dibandingkan dengan <code>display: inline</code>, perbedaan utamanya adalah bahwa <code>inline-block</code> memungkinkan kita mengatur <code>width</code> dan <code>height</code> pada elemen.</p>\n        <p>Dibandingkan dengan <code>display: block</code>, perbedaan utamanya adalah bahwa <code>inline-block</code> tidak memulai baris baru, sehingga elemen dapat berjajar bersebelahan.</p>\n    ",
        "example_title": "Deretan Kartu dengan Inline-Block",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kartu-mini {\n            display: inline-block;\n            width: 100px;\n            padding: 10px;\n            background: #0d2e5c;\n            color: white;\n            text-align: center;\n            border-radius: 6px;\n            margin: 4px;\n        }\n    </style>\n</head>\n<body>\n\n    <div class=\"kartu-mini\">HTML</div>\n    <div class=\"kartu-mini\">CSS</div>\n    <div class=\"kartu-mini\">JS</div>\n\n</body>\n</html>",
        "explanation": "<p>Elemen inline-block menghormati nilai margin dan padding di semua 4 sisi.</p>"
      },
      "css_align": {
        "title": "CSS Align",
        "summary": "Teknik perataan elemen: text-align center, margin auto, flexbox centering, dan vertical alignment.",
        "content": "\n        <p class=\"lead\">Memusatkan elemen di tengah halaman adalah salah satu tugas yang paling sering dilakukan dalam desain web.</p>\n        <h4>3 Cara Memusatkan Elemen:</h4>\n        <ol class=\"ps-3\">\n            <li><strong>Perataan Teks:</strong> <code>text-align: center;</code> pada elemen induk untuk memusatkan teks dan gambar inline.</li>\n            <li><strong>Perataan Blok Horizontal:</strong> <code>margin: auto;</code> pada elemen block dengan lebar tetap.</li>\n            <li><strong>Perataan Tengah Vertikal & Horizontal Mutlak:</strong> Menggunakan Flexbox <code>display: flex; justify-content: center; align-items: center;</code>.</li>\n        </ol>\n    ",
        "example_title": "Memusatkan Elemen Tepat di Tengah Sempurna",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .wadah-tengah {\n            display: flex;\n            justify-content: center;\n            align-items: center;\n            height: 140px;\n            background: #0d2e5c;\n            border-radius: 12px;\n        }\n        .isi-tengah {\n            background: #fca311;\n            color: #0d2e5c;\n            padding: 12px 24px;\n            border-radius: 20px;\n            font-weight: bold;\n        }\n    </style>\n</head>\n<body>\n\n    <div class=\"wadah-tengah\">\n        <div class=\"isi-tengah\">Tepat di Tengah Sempurna!</div>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Kombinasi <code>justify-content: center; align-items: center;</code> pada container flex adalah cara paling modern dan mudah untuk memusatkan konten.</p>",
        "quiz": {
          "q": "Cara paling modern dan ringkas untuk memusatkan elemen baik secara vertikal maupun horizontal adalah menggunakan?",
          "options": [
            "Float left",
            "Display flex dengan justify-content dan align-items",
            "Banyak tag <br>",
            "Position fixed"
          ],
          "answer": 1,
          "explanation": "Flexbox memusatkan elemen secara sempurna pada kedua sumbu tanpa memerlukan perhitungan margin manual."
        }
      },
      "css_combinators": {
        "title": "CSS Combinators",
        "summary": "Menjelaskan relasi antar selector: Descendant (spasi), Child (>), Adjacent Sibling (+), General Sibling (~).",
        "content": "\n        <p class=\"lead\">CSS Combinator menjelaskan hubungan relasi antara beberapa selector.</p>\n        <h4>4 Jenis Combinator CSS:</h4>\n        <ul style=\"line-height: 1.8;\">\n            <li><code>div p</code> (Descendant): Memilih semua elemen &lt;p&gt; di dalam &lt;div&gt; (anak, cucu, cicit).</li>\n            <li><code>div &gt; p</code> (Child): Hanya memilih elemen &lt;p&gt; yang merupakan anak LANGSUNG dari &lt;div&gt;.</li>\n            <li><code>div + p</code> (Adjacent Sibling): Memilih elemen &lt;p&gt; yang terletak tepat setelah &lt;div&gt;.</li>\n            <li><code>div ~ p</code> (General Sibling): Memilih semua elemen &lt;p&gt; yang bersaudara setelah &lt;div&gt;.</li>\n        </ul>\n    ",
        "example_title": "Contoh Child Selector (>)",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        div > p {\n            background-color: #fef08a;\n            padding: 5px;\n        }\n    </style>\n</head>\n<body>\n\n    <div>\n        <p>Paragraf 1 di dalam div (Anak langsung: Terkena warna kuning).</p>\n        <section>\n            <p>Paragraf 2 di dalam section (Bukan anak langsung div: Tidak berwarna).</p>\n        </section>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Combinator <code>&gt;</code> sangat berguna untuk mencegah gaya bocor ke elemen-elemen yang bersarang lebih dalam.</p>",
        "quiz": {
          "q": "Simbol combinator apa yang memilih hanya elemen anak langsung (direct child)?",
          "options": [
            ">",
            "+",
            "~",
            "spasi kosong"
          ],
          "answer": 0,
          "explanation": "Tanda > adalah child combinator yang hanya menargetkan anak generasi pertama."
        }
      },
      "css_pseudo_classes": {
        "title": "CSS Pseudo-classes",
        "summary": "Menata status khusus suatu elemen: :hover, :focus, :active, :checked, :first-child, :nth-child().",
        "content": "\n        <p class=\"lead\">Pseudo-class digunakan untuk mendefinisikan status khusus suatu elemen.</p>\n        <p>Contoh: Memberi gaya pada elemen saat kursor melayang di atasnya (<code>:hover</code>), saat kotak input aktif menerima ketikan (<code>:focus</code>), atau memilih anak pertama (<code>:first-child</code>).</p>\n    ",
        "example_title": "Contoh Pseudo-class :focus pada Input",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        input:focus {\n            outline: none;\n            border: 2px solid #04AA6D;\n            background-color: #f0fdf4;\n            box-shadow: 0 0 8px rgba(4, 170, 109, 0.4);\n        }\n    </style>\n</head>\n<body>\n\n    <h3>Klik di dalam kotak input:</h3>\n    <input type=\"text\" placeholder=\"Ketik nama Anda...\" style=\"padding:10px; border-radius:6px; border:1px solid #ccc;\">\n\n</body>\n</html>",
        "explanation": "<p>Efek <code>:focus</code> memberi isyarat visual yang jelas kepada pengguna tentang kolom mana yang sedang aktif diisi.</p>",
        "quiz": {
          "q": "Pseudo-class apa yang dipicu saat sebuah kotak input sedang diklik atau siap menerima ketikan pengguna?",
          "options": [
            ":hover",
            ":active",
            ":focus",
            ":target"
          ],
          "answer": 2,
          "explanation": ":focus aktif saat elemen menerima fokus klik atau navigasi tab keyboard."
        }
      },
      "css_pseudo_elements": {
        "title": "CSS Pseudo-elements",
        "summary": "Menata bagian spesifik suatu elemen: ::before, ::after, ::first-letter, ::first-line, ::selection.",
        "content": "\n        <p class=\"lead\">CSS Pseudo-element digunakan untuk menata bagian tertentu dari suatu elemen.</p>\n        <p>Contohnya: Menyisipkan konten dekoratif sebelum atau sesudah konten elemen menggunakan <code>::before</code> dan <code>::after</code>, atau menata huruf pertama suatu paragraf (Drop Cap) dengan <code>::first-letter</code>.</p>\n    ",
        "example_title": "Contoh Menyisipkan Ikon dengan ::before",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .peringatan::before {\n            content: \"⚠️ \";\n            font-size: 20px;\n        }\n        .peringatan {\n            background: #fffbeb;\n            color: #b45309;\n            padding: 12px;\n            border-radius: 6px;\n            border: 1px solid #fde68a;\n            font-weight: bold;\n        }\n    </style>\n</head>\n<body>\n\n    <p class=\"peringatan\">Pemberitahuan: Harap simpan progres belajar Anda sebelum keluar!</p>\n\n</body>\n</html>",
        "explanation": "<p>Sintaks modern W3C menggunakan tanda titik dua ganda (<code>::</code>) untuk membedakan pseudo-element dari pseudo-class.</p>",
        "quiz": {
          "q": "Properti wajib apa yang harus disertakan di dalam pseudo-element ::before atau ::after?",
          "options": [
            "content: '';",
            "display: block;",
            "text: '';",
            "insert: true;"
          ],
          "answer": 0,
          "explanation": "Properti content: '' wajib ada agar browser merender pseudo-element ::before atau ::after."
        }
      },
      "css_opacity": {
        "title": "CSS Opacity",
        "summary": "Mengatur tingkat transparansi elemen dan gambar dari 0.0 (transparan total) hingga 1.0 (pekat penuh).",
        "content": "\n        <p class=\"lead\">Properti <code>opacity</code> menentukan tingkat opasitas (transparansi) suatu elemen. Nilai berkisar antara 0.0 (sepenuhnya tembus pandang) hingga 1.0 (sepenuhnya pekat).</p>\n    ",
        "example_title": "Efek Hover Transparansi Gambar",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .img-transparan {\n            opacity: 0.6;\n            transition: opacity 0.3s;\n            border-radius: 8px;\n            cursor: pointer;\n        }\n        .img-transparan:hover {\n            opacity: 1.0;\n        }\n    </style>\n</head>\n<body>\n\n    <h3>Arahkan kursor ke gambar:</h3>\n    <img src=\"https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=260\" class=\"img-transparan\" alt=\"Laptop\">\n\n</body>\n</html>",
        "explanation": "<p>Catatan: Properti opacity membuat seluruh elemen anak di dalamnya ikut menjadi transparan. Jika hanya ingin warna background-nya saja yang transparan, gunakan <code>rgba()</code>.</p>"
      },
      "css_navbar": {
        "title": "CSS Navigation Bars",
        "summary": "Membangun bilah menu navigasi horizontal dan vertikal yang menarik dan mudah digunakan.",
        "content": "\n        <p class=\"lead\">Bilah navigasi yang mudah digunakan sangat penting bagi setiap website. Dengan CSS, daftar tautan HTML standar dapat diubah menjadi navbar modern.</p>\n    ",
        "example_title": "Navbar Responsif Sederhana",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .topnav { background-color: #0d2e5c; overflow: hidden; border-radius: 8px; }\n        .topnav a { float: left; color: #f2f2f2; text-align: center; padding: 14px 18px; text-decoration: none; font-weight: bold; }\n        .topnav a:hover { background-color: #04AA6D; color: white; }\n        .topnav a.active { background-color: #fca311; color: #0d2e5c; }\n    </style>\n</head>\n<body>\n\n    <div class=\"topnav\">\n        <a class=\"active\" href=\"#\">Beranda</a>\n        <a href=\"#\">Materi CSS</a>\n        <a href=\"#\">Bursa Freelance</a>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Navbar di atas menggunakan teknik <code>float: left</code> klasik dan mudah disesuaikan.</p>"
      },
      "css_dropdowns": {
        "title": "CSS Dropdowns",
        "summary": "Membuat menu tarik-turun (dropdown menu) yang muncul saat pengguna mengarahkan mouse (hover).",
        "content": "\n        <p class=\"lead\">Menu dropdown memungkinkan Anda menyembunyikan opsi tautan tambahan hingga pengguna mengarahkan kursor ke tombol pemicunya.</p>\n    ",
        "example_title": "Menu Dropdown CSS Murni Tanpa JavaScript",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .dropdown { position: relative; display: inline-block; }\n        .dropbtn { background-color: #04AA6D; color: white; padding: 12px 20px; font-weight: bold; border: none; border-radius: 6px; cursor: pointer; }\n        .dropdown-content { display: none; position: absolute; background-color: #f9f9f9; min-width: 160px; box-shadow: 0 8px 16px rgba(0,0,0,0.15); border-radius: 6px; z-index: 1; }\n        .dropdown-content a { color: black; padding: 10px 14px; text-decoration: none; display: block; }\n        .dropdown-content a:hover { background-color: #e2e8f0; }\n        .dropdown:hover .dropdown-content { display: block; }\n    </style>\n</head>\n<body>\n\n    <div class=\"dropdown\">\n        <button class=\"dropbtn\">Pilih Modul »</button>\n        <div class=\"dropdown-content\">\n            <a href=\"#\">HTML5</a>\n            <a href=\"#\">CSS3</a>\n            <a href=\"#\">JavaScript</a>\n        </div>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Aturan kuncinya adalah: <code>.dropdown:hover .dropdown-content { display: block; }</code>.</p>"
      },
      "css_image_gallery": {
        "title": "CSS Image Gallery",
        "summary": "Membuat galeri foto grid yang responsif, berborder rapi, dan memiliki efek hover saat disorot.",
        "content": "\n        <p class=\"lead\">CSS dapat digunakan untuk membuat galeri gambar yang cantik dan tersusun rapi.</p>\n    ",
        "example_title": "Contoh Galeri Gambar Sederhana",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .gallery-grid { display: flex; gap: 10px; flex-wrap: wrap; }\n        .gallery-item { border: 1px solid #ccc; border-radius: 8px; overflow: hidden; width: 150px; transition: transform 0.2s; }\n        .gallery-item:hover { transform: scale(1.05); border-color: #04AA6D; }\n        .gallery-item img { width: 100%; height: 100px; object-fit: cover; }\n        .desc { padding: 8px; text-align: center; font-size: 0.75rem; }\n    </style>\n</head>\n<body>\n\n    <div class=\"gallery-grid\">\n        <div class=\"gallery-item\"><img src=\"https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=200\"><div class=\"desc\">Laptop Coding</div></div>\n        <div class=\"gallery-item\"><img src=\"https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=200\"><div class=\"desc\">Workspace</div></div>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Properti <code>object-fit: cover;</code> memastikan gambar tidak gepeng atau terdistorsi di dalam wadah galeri.</p>"
      },
      "css_image_sprites": {
        "title": "CSS Image Sprites",
        "summary": "Menggabungkan banyak gambar ikon kecil ke dalam satu berkas gambar tunggal untuk mempercepat muat website.",
        "content": "\n        <p class=\"lead\">Image Sprite adalah kumpulan gambar yang digabungkan menjadi satu file gambar tunggal.</p>\n        <p>Website dengan banyak gambar kecil dapat memakan waktu lama untuk memuat karena harus membuat banyak request HTTP ke server. Dengan Image Sprites, hanya 1 request HTTP yang dilakukan, lalu posisi gambar digeser menggunakan <code>background-position</code>.</p>\n    ",
        "example_title": "Konsep Image Sprite",
        "example_code": "<!DOCTYPE html>\n<html>\n<body>\n    <p>Image Sprites menghemat bandwidth dan membuat halaman web dimuat jauh lebih cepat!</p>\n</body>\n</html>",
        "explanation": "<p>Sangat ideal untuk kumpulan ikon media sosial atau bendera negara.</p>"
      },
      "css_attr_selectors": {
        "title": "CSS Attribute Selectors",
        "summary": "Menyeleksi elemen berdasarkan keberadaan atau nilai atributnya (misal: input[type='text']).",
        "content": "\n        <p class=\"lead\">Anda dapat menyeleksi elemen HTML berdasarkan atribut dan nilai atribut yang dimilikinya.</p>\n        <ul>\n            <li><code>[target]</code> : Memilih elemen yang memiliki atribut target.</li>\n            <li><code>input[type=\"text\"]</code> : Hanya memilih kotak input bertipe teks.</li>\n            <li><code>a[href^=\"https\"]</code> : Memilih tautan yang diawali dengan 'https'.</li>\n        </ul>\n    ",
        "example_title": "Menata Input Spesifik dengan Attribute Selector",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        input[type=\"text\"] { border: 2px solid #0d2e5c; padding: 6px; border-radius: 4px; }\n        input[type=\"submit\"] { background: #04AA6D; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; }\n    </style>\n</head>\n<body>\n\n    <input type=\"text\" placeholder=\"Input Teks\">\n    <input type=\"submit\" value=\"Kirim\">\n\n</body>\n</html>",
        "explanation": "<p>Attribute selector sangat berguna untuk menata formulir secara presisi tanpa perlu menambahkan class satu per satu.</p>"
      },
      "css_forms": {
        "title": "CSS Forms",
        "summary": "Mendesain formulir yang elegan, bersih, dengan efek fokus bercahaya dan tombol submit modern.",
        "content": "\n        <p class=\"lead\">Tampilan formulir HTML dapat sangat ditingkatkan dengan CSS: mengatur padding luas, border halus, bayangan fokus, dan tombol submit yang memikat.</p>\n    ",
        "example_title": "Formulir Pendaftaran Modern",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .form-card { max-width: 300px; padding: 20px; background: white; border-radius: 10px; border: 1px solid #e2e8f0; font-family: sans-serif; }\n        .form-control { width: 100%; padding: 10px; margin: 8px 0 15px; border: 1px solid #cbd5e1; border-radius: 6px; box-sizing: border-box; }\n        .form-control:focus { outline: none; border-color: #04AA6D; box-shadow: 0 0 0 3px rgba(4, 170, 109, 0.2); }\n        .btn-submit { width: 100%; background: #04AA6D; color: white; border: none; padding: 10px; border-radius: 6px; font-weight: bold; cursor: pointer; }\n    </style>\n</head>\n<body style=\"background:#f8fafc; padding:20px;\">\n\n    <div class=\"form-card\">\n        <h4 style=\"margin: 0; color: #0d2e5c;\">Masuk Akun</h4>\n        <input type=\"text\" class=\"form-control\" placeholder=\"Email Anda\">\n        <button class=\"btn-submit\">Masuk »</button>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Selalu gunakan <code>box-sizing: border-box;</code> pada input agar <code>width: 100%;</code> tidak membuat kotak melebar keluar kartu.</p>"
      },
      "css_counters": {
        "title": "CSS Counters",
        "summary": "Membuat nomor urut bab dan sub-bab otomatis pada judul dokumen menggunakan counter-reset dan counter-increment.",
        "content": "\n        <p class=\"lead\">CSS Counters mirip seperti \"variabel\" di CSS. Nilai variabel ini dapat ditambah (di-increment) oleh aturan CSS untuk melacak berapa kali elemen digunakan.</p>\n    ",
        "example_title": "Penomoran Bab Otomatis dengan CSS Counter",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { counter-reset: bab-nomor; font-family: sans-serif; }\n        h3::before {\n            counter-increment: bab-nomor;\n            content: \"Bab \" counter(bab-nomor) \": \";\n            color: #04AA6D;\n        }\n    </style>\n</head>\n<body>\n\n    <h3>Pengenalan CSS</h3>\n    <h3>Sintaks & Selector</h3>\n    <h3>Tata Letak Flexbox</h3>\n\n</body>\n</html>",
        "explanation": "<p>Browser secara otomatis memberi label 'Bab 1:', 'Bab 2:', 'Bab 3:' di depan setiap tag h3!</p>"
      },
      "css_units": {
        "title": "CSS Units",
        "summary": "Satuan ukuran absolut (px, pt, cm) vs relatif (rem, em, %, vw, vh) dan kapan harus menggunakannya.",
        "content": "\n        <p class=\"lead\">CSS memiliki beberapa satuan berbeda untuk menyatakan panjang.</p>\n        <h4>Satuan Relatif Terbaik:</h4>\n        <ul style=\"line-height: 1.8;\">\n            <li><code>rem</code> : Relatif terhadap ukuran font elemen root <code>&lt;html&gt;</code> (standar terbaik untuk font).</li>\n            <li><code>%</code> : Relatif terhadap ukuran elemen induk.</li>\n            <li><code>vw</code> & <code>vh</code> : 1vw = 1% dari lebar viewport layar; 1vh = 1% dari tinggi layar.</li>\n        </ul>\n    ",
        "example_title": "Contoh Layar Penuh dengan 100vh",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .full-screen { height: 120px; background: #0d2e5c; color: white; display: flex; align-items: center; justify-content: center; border-radius: 8px; }\n    </style>\n</head>\n<body>\n    <div class=\"full-screen\">Satuan vh & rem sangat responsif!</div>\n</body>\n</html>",
        "explanation": "<p>Gunakan <code>rem</code> untuk ukuran tipografi dan margin agar desain tetap proporsional saat pengguna memperbesar teks browser.</p>"
      },
      "css_inheritance": {
        "title": "CSS Inheritance",
        "summary": "Pewarisan sifat gaya dari elemen induk ke elemen anak (seperti font dan warna teks).",
        "content": "\n        <p class=\"lead\">Dalam CSS, properti tertentu (seperti <code>color</code> dan <code>font-family</code>) secara otomatis diwariskan dari elemen induk ke semua elemen di dalamnya.</p>\n        <p>Namun, properti seperti <code>border</code>, <code>margin</code>, dan <code>padding</code> tidak diwariskan secara otomatis. Anda dapat memaksa pewarisan menggunakan kata kunci <code>inherit</code>.</p>\n    ",
        "example_title": "Contoh Pewarisan Nilai Inherit",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .induk { color: #04AA6D; border: 2px solid #04AA6D; padding: 15px; }\n        .anak { border: inherit; padding: 10px; margin-top: 10px; }\n    </style>\n</head>\n<body>\n\n    <div class=\"induk\">\n        Teks di elemen induk (Hijau).\n        <div class=\"anak\">Elemen anak mewarisi border hijau induknya menggunakan 'border: inherit;'.</div>\n    </div>\n\n</body>\n</html>",
        "explanation": "<p>Kata kunci <code>inherit</code> menginstruksikan elemen untuk mengambil nilai yang persis sama dengan induknya.</p>"
      },
      "css_specificity": {
        "title": "CSS Specificity",
        "summary": "Aturan bobot kekuatan selector saat dua aturan CSS berbeda bersaing menata elemen yang sama.",
        "content": "\n        <p class=\"lead\">Kekhususan (Specificity) adalah algoritma yang digunakan browser untuk menentukan deklarasi CSS mana yang paling relevan bagi suatu elemen.</p>\n        <h4>Hierarki Bobot Kekhususan:</h4>\n        <ol class=\"ps-3\">\n            <li>Inline Style (Tertinggi: misal <code>style=\"color: red;\"</code>).</li>\n            <li>ID Selector (misal <code>#menu</code>).</li>\n            <li>Class, Pseudo-class, Attribute Selector (misal <code>.btn</code>, <code>:hover</code>).</li>\n            <li>Element & Pseudo-element Selector (Terendah: misal <code>p</code>, <code>h1</code>).</li>\n        </ol>\n    ",
        "example_title": "Contoh Persaingan Specificity",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        #teksKhusus { color: #fca311; } /* ID: Bobot 100 */\n        .teks-biru { color: #3b82f6; }   /* Class: Bobot 10 */\n        p { color: #334155; }            /* Element: Bobot 1 */\n    </style>\n</head>\n<body>\n\n    <p id=\"teksKhusus\" class=\"teks-biru\">Teks ini akan berwarna EMAS (#fca311) karena ID lebih kuat dari Class!</p>\n\n</body>\n</html>",
        "explanation": "<p>Selector ID selalu mengalahkan selector class, dan selector class selalu mengalahkan selector tag elemen.</p>"
      },
      "css_important": {
        "title": "CSS !important",
        "summary": "Memaksa aturan gaya menjadi prioritas tertinggi mutlak dengan kata kunci !important.",
        "content": "\n        <p class=\"lead\">Kata kunci <code>!important</code> digunakan untuk menambahkan kepentingan lebih pada suatu properti/nilai daripada yang biasanya.</p>\n        <p>Bahkan <code>!important</code> akan menimpa aturan inline style sekalipun. Gunakan dengan sangat bijak dan hemat, karena penggunaan berlebihan membuat debugging CSS menjadi rumit!</p>\n    ",
        "example_title": "Contoh Penggunaan !important",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        p {\n            color: #e11d48 !important; /* Dipaksa Merah */\n        }\n    </style>\n</head>\n<body>\n\n    <p style=\"color: blue;\">Meskipun ada inline style biru, teks ini tetap MERAH karena ada !important!</p>\n\n</body>\n</html>",
        "explanation": "<p>Gunakan <code>!important</code> hanya untuk kelas utilitas darurat atau saat menimpa framework eksternal.</p>"
      },
      "css_math": {
        "title": "CSS Math Functions",
        "summary": "Fungsi matematika bawaan CSS: calc(), max(), min(), dan clamp() untuk ukuran dinamis cerdas.",
        "content": "\n        <p class=\"lead\">CSS memiliki fungsi matematika yang memungkinkan ekspresi matematis digunakan sebagai nilai properti:</p>\n        <ul style=\"line-height: 1.8;\">\n            <li><code>calc()</code> : Melakukan perhitungan campuran (misal: <code>width: calc(100% - 40px);</code>).</li>\n            <li><code>max()</code> : Memilih nilai terbesar dari daftar parameter.</li>\n            <li><code>min()</code> : Memilih nilai terkecil dari daftar parameter.</li>\n            <li><code>clamp(min, preferred, max)</code> : Mengunci ukuran di antara batas minimum dan maksimum secara responsif.</li>\n        </ul>\n    ",
        "example_title": "Contoh Tipografi Luar Biasa dengan clamp()",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .judul-fluid {\n            /* Font minimal 18px, ideal 4vw, maksimal 36px */\n            font-size: clamp(18px, 4vw, 36px);\n            color: #0d2e5c;\n            text-align: center;\n        }\n    </style>\n</head>\n<body>\n\n    <h2 class=\"judul-fluid\">Judul Responsif Otomatis dengan clamp()</h2>\n    <p style=\"text-align:center;\">Ubah ukuran layar: font akan membesar dan mengecil secara otomatis!</p>\n\n</body>\n</html>",
        "explanation": "<p>Fungsi <code>clamp()</code> menggantikan kebutuhan puluhan media query manual untuk tipografi responsif.</p>"
      },
      "css_optimization": {
        "title": "CSS Optimization",
        "summary": "Praktik terbaik mengoptimalkan performa stylesheet: minifikasi, menghapus unused CSS, dan kompresi.",
        "content": "\n        <p class=\"lead\">Stylesheet yang dioptimalkan dengan baik mempercepat waktu muat halaman dan menghemat bandwidth pengguna.</p>\n        <h4>Tips Optimasi CSS:</h4>\n        <ul style=\"line-height: 1.8;\">\n            <li>Minifikasi berkas CSS produksi untuk menghapus spasi dan komentar (misal: <code>style.min.css</code>).</li>\n            <li>Hindari selector yang terlalu panjang dan kompleks (seperti <code>body div#main ul li a span</code>).</li>\n            <li>Gunakan properti CSS shorthand untuk menghemat ukuran berkas.</li>\n        </ul>\n    ",
        "example_title": "Contoh Shorthand vs Longhand",
        "example_code": "<!DOCTYPE html>\n<html>\n<body>\n    <p>Gunakan shorthand <code>margin: 10px 20px;</code> daripada 4 baris margin-top, margin-right, margin-bottom, margin-left!</p>\n</body>\n</html>",
        "explanation": "<p>Shorthand membuat ukuran berkas CSS 40% lebih kecil.</p>"
      },
      "css_accessibility": {
        "title": "CSS Accessibility",
        "summary": "Mendesain dengan rasio kontras warna tinggi, fokus keyboard yang jelas, dan preferensi reduced motion.",
        "content": "\n        <p class=\"lead\">Aksesibilitas CSS memastikan desain web Anda dapat dinikmati oleh semua pengguna, termasuk penyandang gangguan penglihatan atau disabilitas motorik.</p>\n        <h4>Panduan Utama:</h4>\n        <ul>\n            <li>Pastikan rasio kontras teks terhadap background minimal 4.5:1.</li>\n            <li>Jangan pernah menghapus outline fokus keyboard (<code>outline: none;</code>) tanpa menyediakan gaya fokus pengganti.</li>\n            <li>Hormati preferensi pengguna yang sensitif terhadap gerakan animasi via media query <code>@media (prefers-reduced-motion: reduce)</code>.</li>\n        </ul>\n    ",
        "example_title": "Contoh Desain Aksesibel",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .btn-a11y:focus {\n            outline: 3px solid #0d2e5c;\n            outline-offset: 2px;\n        }\n    </style>\n</head>\n<body>\n    <button class=\"btn-a11y\" style=\"background:#04AA6D; color:white; padding:10px 18px; border:none; border-radius:6px; font-weight:bold;\">\n        Fokus Keyboard Jelas\n    </button>\n</body>\n</html>",
        "explanation": "<p>Tekan tombol Tab pada keyboard Anda untuk melihat indikator fokus yang jelas pada tombol di atas.</p>"
      },
      "css_layout": {
        "title": "CSS Website Layout",
        "summary": "Merancang tata letak website lengkap: Header, Navigasi, Kolom Konten, Sidebar, dan Footer.",
        "content": "\n        <p class=\"lead\">Tata letak website modern menggabungkan seluruh teknik CSS yang telah dipelajari untuk membentuk antarmuka website utuh.</p>\n    ",
        "example_title": "Template Layout Website Lengkap",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        * { box-sizing: border-box; }\n        body { font-family: sans-serif; margin: 0; background: #f8fafc; }\n        header { background: #0d2e5c; color: white; padding: 25px; text-align: center; }\n        nav { background: #1e3a8a; padding: 10px; text-align: center; }\n        nav a { color: #fca311; text-decoration: none; margin: 0 12px; font-weight: bold; }\n        .row { display: flex; flex-wrap: wrap; padding: 20px; max-width: 900px; margin: auto; gap: 20px; }\n        .main-col { flex: 3; min-width: 280px; background: white; padding: 20px; border-radius: 8px; }\n        .side-col { flex: 1; min-width: 200px; background: #e0f2fe; padding: 20px; border-radius: 8px; }\n        footer { background: #071a35; color: #94a3b8; text-align: center; padding: 15px; margin-top: 20px; }\n    </style>\n</head>\n<body>\n\n    <header><h1>Skillance Academy Portal</h1></header>\n    <nav><a href=\"#\">Beranda</a> <a href=\"#\">Tutorial</a> <a href=\"#\">Bursa</a></nav>\n    <div class=\"row\">\n        <div class=\"main-col\">\n            <h2>Artikel Utama</h2>\n            <p>Tata letak responsif dua kolom yang dibangun dengan Flexbox modern.</p>\n        </div>\n        <div class=\"side-col\">\n            <h3>Sidebar</h3>\n            <p>Widget berita dan informasi.</p>\n        </div>\n    </div>\n    <footer>&copy; 2026 Skillance Academy Indonesia</footer>\n\n</body>\n</html>",
        "explanation": "<p>Template di atas otomatis menjadi satu kolom bertumpuk saat dibuka di layar ponsel sempit.</p>"
      }
    },
    "CSS Advanced": {
      "css3_borders": {
        "title": "CSS Rounded Corners",
        "summary": "Membuat sudut elemen menjadi melengkung atau bulat menggunakan properti border-radius.",
        "content": "<p class=\"lead\">Properti <code>border-radius</code> di CSS memungkinkan Anda membuat sudut melengkung pada elemen kotak, tombol, kartu, atau bahkan membuat lingkaran sempurna.</p>\n    <p>Anda dapat memberikan satu nilai untuk keempat sudut, atau memberikan nilai spesifik untuk sudut tertentu seperti <code>border-top-left-radius</code>.</p>",
        "example_title": "Contoh Kode CSS Rounded Corners",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kotak-lengkung {\n            background-color: #0d2e5c;\n            color: white;\n            padding: 20px;\n            width: 260px;\n            text-align: center;\n            border-radius: 20px;\n            margin-bottom: 15px;\n        }\n        .lingkaran {\n            background-color: #fca311;\n            color: #0d2e5c;\n            width: 100px;\n            height: 100px;\n            line-height: 100px;\n            text-align: center;\n            border-radius: 50%;\n            font-weight: bold;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"kotak-lengkung\">Sudut Melengkung 20px</div>\n    <div class=\"lingkaran\">Bulat 50%</div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Rounded Corners</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_border_images": {
        "title": "CSS Border Images",
        "summary": "Menggunakan gambar dekoratif sebagai border pada elemen dengan border-image.",
        "content": "<p class=\"lead\">Properti <code>border-image</code> memungkinkan Anda menetapkan gambar grafis untuk digunakan sebagai border yang mengelilingi elemen HTML.</p>",
        "example_title": "Contoh Kode CSS Border Images",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .bingkai-gambar {\n            border: 10px solid transparent;\n            padding: 15px;\n            border-image: linear-gradient(to right, #0d2e5c, #fca311) 1;\n            font-family: sans-serif;\n            text-align: center;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"bingkai-gambar\">\n        <h3>Border Gradien CSS</h3>\n        <p>Menggunakan border-image dengan gradasi linear-gradient warna modern.</p>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Border Images</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_backgrounds": {
        "title": "CSS Backgrounds Advanced",
        "summary": "Pengaturan gambar latar belakang lanjutan: background-size, background-origin, dan background-clip.",
        "content": "<p class=\"lead\">CSS menyediakan properti background tingkat lanjut seperti <code>background-size: cover</code> untuk memastikan gambar memenuhi layar tanpa terdistorsi.</p>",
        "example_title": "Contoh Kode CSS Backgrounds Advanced",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .hero-bg {\n            background-image: linear-gradient(rgba(13,46,92,0.8), rgba(13,46,92,0.8)), url('https://picsum.photos/600/300');\n            background-size: cover;\n            background-position: center;\n            color: white;\n            padding: 50px 20px;\n            text-align: center;\n            border-radius: 12px;\n            font-family: sans-serif;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"hero-bg\">\n        <h2>Hero Banner Berlatar Gambar</h2>\n        <p>Menggunakan background-size: cover dengan overlay gradasi warna navy.</p>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Backgrounds Advanced</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_colors": {
        "title": "CSS Colors",
        "summary": "Format warna modern dengan RGBA, HSLA, dan variabel transparansi warna.",
        "content": "<p class=\"lead\">Warna RGBA menambahkan saluran alpha untuk transparansi (0.0 transparan penuh hingga 1.0 pekat penuh).</p>",
        "example_title": "Contoh Kode CSS Colors",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kartu-transparan {\n            background-color: rgba(13, 46, 92, 0.15);\n            border: 2px solid rgba(13, 46, 92, 0.4);\n            color: #0d2e5c;\n            padding: 20px;\n            border-radius: 8px;\n            font-family: sans-serif;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"kartu-transparan\">\n        <h4>Warna RGBA Transparan</h4>\n        <p>rgba(13, 46, 92, 0.15) menghasilkan latar belakang biru transparan lembut.</p>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Colors</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_gradients": {
        "title": "CSS Gradients",
        "summary": "Membuat transisi halus antara dua atau lebih warna dengan linear-gradient dan radial-gradient.",
        "content": "<p class=\"lead\">Gradien CSS memungkinkan Anda menampilkan transisi warna yang kaya tanpa memerlukan file gambar bitmap berukuran besar.</p>",
        "example_title": "Contoh Kode CSS Gradients",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .gradien-linear {\n            background: linear-gradient(135deg, #0d2e5c 0%, #fca311 100%);\n            color: white;\n            padding: 30px;\n            border-radius: 12px;\n            text-align: center;\n            font-family: sans-serif;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"gradien-linear\">\n        <h2>Linear Gradient 135 Derajat</h2>\n        <p>Kombinasi elegan antara Navy (#0d2e5c) dan Gold (#fca311).</p>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Gradients</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_shadows": {
        "title": "CSS Shadows",
        "summary": "Memberikan efek bayangan kedalaman visual pada teks (text-shadow) dan kotak elemen (box-shadow).",
        "content": "<p class=\"lead\">Properti <code>box-shadow</code> memberikan ilusi ketinggian 3D (elevation) yang sangat penting dalam desain UI modern.</p>",
        "example_title": "Contoh Kode CSS Shadows",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kartu-bayangan {\n            background: white;\n            padding: 25px;\n            border-radius: 12px;\n            box-shadow: 0 10px 25px rgba(13, 46, 92, 0.15);\n            max-width: 320px;\n            font-family: sans-serif;\n            text-align: center;\n        }\n        .teks-bayangan {\n            color: #0d2e5c;\n            text-shadow: 2px 2px 4px rgba(0,0,0,0.25);\n        }\n    </style>\n</head>\n<body>\n    <div class=\"kartu-bayangan\">\n        <h3 class=\"teks-bayangan\">Kartu Berelevasi</h3>\n        <p>box-shadow: 0 10px 25px rgba(13, 46, 92, 0.15)</p>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Shadows</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_text_effects": {
        "title": "CSS Text Effects",
        "summary": "Mengontrol pemenggalan kata, efek teks terpotong elipsis (...), dan orientasi teks.",
        "content": "<p class=\"lead\">Gunakan <code>text-overflow: ellipsis; white-space: nowrap; overflow: hidden;</code> untuk memotong judul yang terlalu panjang secara rapi.</p>",
        "example_title": "Contoh Kode CSS Text Effects",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .judul-terpotong {\n            width: 250px;\n            white-space: nowrap;\n            overflow: hidden;\n            text-overflow: ellipsis;\n            border: 1px dashed #94a3b8;\n            padding: 8px;\n            font-family: sans-serif;\n            color: #0d2e5c;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"judul-terpotong\">\n        Judul Materi Sangat Panjang Sekali yang Tidak Muat Pada Satu Baris Kontainer\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Text Effects</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_fonts": {
        "title": "CSS Custom Fonts",
        "summary": "Memuat font kustom eksternal menggunakan aturan @font-face atau Google Fonts.",
        "content": "<p class=\"lead\">Aturan <code>@font-face</code> memungkinkan web desainer menggunakan font tipografi khusus di luar font standar komputer klien.</p>",
        "example_title": "Contoh Kode CSS Custom Fonts",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css2?family=Fira+Code:wght@600&display=swap\">\n    <style>\n        .font-kustom {\n            font-family: 'Fira Code', monospace;\n            font-size: 20px;\n            color: #04AA6D;\n            background: #1e293b;\n            padding: 20px;\n            border-radius: 8px;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"font-kustom\">\n        const engineer = \"Skillance Academy\";\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Custom Fonts</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_2dtransforms": {
        "title": "CSS 2D Transforms",
        "summary": "Mengubah ukuran, memutar, memiringkan, dan menggeser elemen dengan properti transform.",
        "content": "<p class=\"lead\">Metode 2D Transform mencakup <code>translate()</code>, <code>rotate()</code>, <code>scale()</code>, dan <code>skew()</code>.</p>",
        "example_title": "Contoh Kode CSS 2D Transforms",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kotak-putar {\n            width: 120px;\n            height: 120px;\n            background: #0d2e5c;\n            color: white;\n            text-align: center;\n            line-height: 120px;\n            margin: 40px auto;\n            transform: rotate(15deg) scale(1.1);\n            border-radius: 10px;\n            font-family: sans-serif;\n            transition: transform 0.3s;\n        }\n        .kotak-putar:hover {\n            transform: rotate(0deg) scale(1.2);\n            background: #fca311;\n            color: #0d2e5c;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"kotak-putar\">Sorot Saya!</div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS 2D Transforms</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_3dtransforms": {
        "title": "CSS 3D Transforms",
        "summary": "Transformasi ruang 3 dimensi dengan rotateX, rotateY, dan perspektif kedalaman.",
        "content": "<p class=\"lead\">CSS memungkinkan efek putaran 3D di sekitar sumbu X, Y, dan Z menggunakan <code>transform: rotateY()</code>.</p>",
        "example_title": "Contoh Kode CSS 3D Transforms",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .wadah-3d {\n            perspective: 800px;\n            text-align: center;\n            padding: 30px;\n        }\n        .kotak-3d {\n            width: 180px;\n            height: 100px;\n            background: #04AA6D;\n            color: white;\n            line-height: 100px;\n            margin: auto;\n            transform: rotateX(25deg) rotateY(30deg);\n            border-radius: 8px;\n            font-family: sans-serif;\n            font-weight: bold;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"wadah-3d\">\n        <div class=\"kotak-3d\">Efek 3D Transform</div>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS 3D Transforms</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_transitions": {
        "title": "CSS Transitions",
        "summary": "Menciptakan animasi perubahan nilai properti CSS secara halus tanpa JavaScript.",
        "content": "<p class=\"lead\">Properti <code>transition</code> memungkinkan Anda mengubah nilai properti secara mulus selama durasi tertentu.</p>",
        "example_title": "Contoh Kode CSS Transitions",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .tombol-animasi {\n            background-color: #0d2e5c;\n            color: white;\n            padding: 12px 24px;\n            border: none;\n            border-radius: 30px;\n            cursor: pointer;\n            font-size: 16px;\n            transition: all 0.3s ease-in-out;\n        }\n        .tombol-animasi:hover {\n            background-color: #fca311;\n            color: #0d2e5c;\n            transform: translateY(-4px);\n            box-shadow: 0 8px 16px rgba(252, 163, 17, 0.4);\n        }\n    </style>\n</head>\n<body>\n    <button class=\"tombol-animasi\">Arahkan Kursor Kemari &raquo;</button>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Transitions</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_animations": {
        "title": "CSS Animations",
        "summary": "Mendefinisikan siklus animasi dinamis berkelanjutan menggunakan aturan @keyframes.",
        "content": "<p class=\"lead\">Aturan <code>@keyframes</code> memungkinkan elemen berubah gaya secara bertahap dari satu set properti ke set lainnya dalam rentang persentase 0% hingga 100%.</p>",
        "example_title": "Contoh Kode CSS Animations",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        @keyframes denyut {\n            0% { transform: scale(1); opacity: 1; }\n            50% { transform: scale(1.15); opacity: 0.8; }\n            100% { transform: scale(1); opacity: 1; }\n        }\n        .lingkaran-denyut {\n            width: 80px;\n            height: 80px;\n            background: #e34f26;\n            border-radius: 50%;\n            margin: 40px auto;\n            animation: denyut 1.5s infinite ease-in-out;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"lingkaran-denyut\"></div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Animations</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_tooltip": {
        "title": "CSS Tooltips",
        "summary": "Membuat kotak petunjuk (tooltip) informasi melayang murni dengan pseudo-elemen CSS.",
        "content": "<p class=\"lead\">Tooltip CSS dibuat menggunakan <code>position: relative</code> pada kontainer dan <code>position: absolute</code> pada teks tooltip dengan selektor <code>:hover</code>.</p>",
        "example_title": "Contoh Kode CSS Tooltips",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .tooltip-container {\n            position: relative;\n            display: inline-block;\n            border-bottom: 2px dotted #0d2e5c;\n            font-family: sans-serif;\n            font-weight: bold;\n            color: #0d2e5c;\n            cursor: pointer;\n            margin: 40px;\n        }\n        .tooltip-text {\n            visibility: hidden;\n            width: 180px;\n            background-color: #0d2e5c;\n            color: #fff;\n            text-align: center;\n            border-radius: 6px;\n            padding: 8px;\n            position: absolute;\n            z-index: 1;\n            bottom: 125%;\n            left: 50%;\n            margin-left: -90px;\n            opacity: 0;\n            transition: opacity 0.3s;\n            font-size: 13px;\n        }\n        .tooltip-container:hover .tooltip-text {\n            visibility: visible;\n            opacity: 1;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"tooltip-container\">\n        Arahkan Kursor ke Sini\n        <span class=\"tooltip-text\">Ini adalah tooltip CSS murni yang melayang!</span>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Tooltips</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_images": {
        "title": "CSS Image Styling",
        "summary": "Teknik styling gambar responsif, sudut melengkung, bingkai polaroid, dan efek bayangan.",
        "content": "<p class=\"lead\">Format gambar modern ditata dengan border-radius, efek filter, atau bingkai kartu responsif.</p>",
        "example_title": "Contoh Kode CSS Image Styling",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .foto-lingkaran {\n            width: 120px;\n            height: 120px;\n            border-radius: 50%;\n            object-fit: cover;\n            border: 4px solid #fca311;\n            box-shadow: 0 4px 10px rgba(0,0,0,0.15);\n        }\n    </style>\n</head>\n<body>\n    <img src=\"https://picsum.photos/200\" alt=\"Foto Profil\" class=\"foto-lingkaran\">\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Image Styling</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_images_modal": {
        "title": "CSS Image Modal",
        "summary": "Membuat lightbox pratinjau gambar layar penuh ketika gambar diklik.",
        "content": "<p class=\"lead\">Modal gambar CSS menyediakan overlay layar gelap di atas halaman saat pengguna ingin memperbesar foto.</p>",
        "example_title": "Contoh Kode CSS Image Modal",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .thumbnail {\n            width: 200px;\n            border-radius: 8px;\n            cursor: pointer;\n            transition: transform 0.2s;\n        }\n        .thumbnail:hover { transform: scale(1.05); }\n    </style>\n</head>\n<body>\n    <h3>Pratinjau Foto Modal</h3>\n    <img src=\"https://picsum.photos/400/250\" class=\"thumbnail\" alt=\"Galeri\">\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Image Modal</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_image_center": {
        "title": "CSS Image Centering",
        "summary": "Cara memposisikan gambar tepat di tengah horizontal layar.",
        "content": "<p class=\"lead\">Karena elemen <code>&lt;img&gt;</code> bersifat inline secara default, cara menengahkan gambar adalah menjadikannya <code>display: block; margin: 0 auto;</code>.</p>",
        "example_title": "Contoh Kode CSS Image Centering",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .gambar-tengah {\n            display: block;\n            margin-left: auto;\n            margin-right: auto;\n            width: 50%;\n            border-radius: 12px;\n        }\n    </style>\n</head>\n<body>\n    <img src=\"https://picsum.photos/500/200\" class=\"gambar-tengah\" alt=\"Center Image\">\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Image Centering</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_image_filters": {
        "title": "CSS Image Filters",
        "summary": "Menerapkan efek visual grafis pada gambar seperti blur, grayscale, sepia, dan saturasi.",
        "content": "<p class=\"lead\">Properti <code>filter</code> memberikan efek pengolahan gambar instan tanpa memerlukan Photoshop.</p>",
        "example_title": "Contoh Kode CSS Image Filters",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .filter-demo {\n            display: flex;\n            gap: 15px;\n            flex-wrap: wrap;\n        }\n        .img-item { width: 140px; border-radius: 8px; }\n        .gray { filter: grayscale(100%); }\n        .blur-fx { filter: blur(2px); }\n        .sepia-fx { filter: sepia(80%); }\n    </style>\n</head>\n<body>\n    <div class=\"filter-demo\">\n        <div><img src=\"https://picsum.photos/140/140\" class=\"img-item gray\"><br><small>Grayscale</small></div>\n        <div><img src=\"https://picsum.photos/140/140\" class=\"img-item blur-fx\"><br><small>Blur</small></div>\n        <div><img src=\"https://picsum.photos/140/140\" class=\"img-item sepia-fx\"><br><small>Sepia</small></div>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Image Filters</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_image_shapes": {
        "title": "CSS Image Shapes",
        "summary": "Memotong bentuk geometris unik pada gambar menggunakan clip-path.",
        "content": "<p class=\"lead\">Properti <code>clip-path</code> memotong gambar menjadi poligon bintang, jajaran genjang, atau elips.</p>",
        "example_title": "Contoh Kode CSS Image Shapes",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .bentuk-poligon {\n            width: 200px;\n            height: 200px;\n            object-fit: cover;\n            clip-path: polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);\n        }\n    </style>\n</head>\n<body>\n    <img src=\"https://picsum.photos/300/300\" class=\"bentuk-poligon\" alt=\"Pentagon Image\">\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Image Shapes</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_object_fit": {
        "title": "CSS object-fit",
        "summary": "Menentukan bagaimana konten gambar atau video disesuaikan ke dalam kotak pembungkusnya.",
        "content": "<p class=\"lead\">Properti <code>object-fit: cover;</code> memotong gambar agar pas memenuhi ukuran kotak tanpa gepeng atau terdistorsi.</p>",
        "example_title": "Contoh Kode CSS object-fit",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kotak-fit {\n            width: 200px;\n            height: 150px;\n            border: 2px solid #0d2e5c;\n            object-fit: cover;\n            border-radius: 8px;\n        }\n    </style>\n</head>\n<body>\n    <p>object-fit: cover (Proporsional tidak gepeng):</p>\n    <img src=\"https://picsum.photos/500/200\" class=\"kotak-fit\">\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS object-fit</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_object_position": {
        "title": "CSS object-position",
        "summary": "Menentukan titik fokus penjajaran gambar di dalam kontainer object-fit.",
        "content": "<p class=\"lead\">Gunakan <code>object-position: top center;</code> untuk memfokuskan bagian atas gambar saat dilakukan pemotongan cover.</p>",
        "example_title": "Contoh Kode CSS object-position",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .pos-fokus {\n            width: 220px;\n            height: 120px;\n            object-fit: cover;\n            object-position: top left;\n            border-radius: 8px;\n        }\n    </style>\n</head>\n<body>\n    <img src=\"https://picsum.photos/400/300\" class=\"pos-fokus\">\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS object-position</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_masking": {
        "title": "CSS Masking",
        "summary": "Membuat efek topeng transparansi dengan mask-image untuk menampilkan sebagian elemen.",
        "content": "<p class=\"lead\">CSS Masking menyembunyikan atau memperlihatkan bagian-bagian elemen menggunakan lapisan gradien atau SVG mask.</p>",
        "example_title": "Contoh Kode CSS Masking",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .teks-gradien {\n            font-size: 32px;\n            font-weight: 800;\n            background: linear-gradient(to right, #0d2e5c, #fca311);\n            -webkit-background-clip: text;\n            -webkit-text-fill-color: transparent;\n            font-family: sans-serif;\n        }\n    </style>\n</head>\n<body>\n    <h1 class=\"teks-gradien\">Skillance Academy Modern</h1>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Masking</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_buttons": {
        "title": "CSS Buttons",
        "summary": "Mendesain tombol antarmuka modern yang memikat dengan efek bayangan dan hover.",
        "content": "<p class=\"lead\">Tombol profesional memiliki padding yang seimbang, font tebal, transisi warna, dan respon klik yang responsif.</p>",
        "example_title": "Contoh Kode CSS Buttons",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .btn-modern {\n            background: #04AA6D;\n            color: white;\n            padding: 12px 28px;\n            font-size: 15px;\n            font-weight: bold;\n            border: none;\n            border-radius: 8px;\n            cursor: pointer;\n            box-shadow: 0 4px 10px rgba(4,170,109,0.3);\n            transition: all 0.2s;\n        }\n        .btn-modern:hover {\n            background: #038d5a;\n            transform: translateY(-2px);\n            box-shadow: 0 6px 14px rgba(4,170,109,0.4);\n        }\n    </style>\n</head>\n<body>\n    <button class=\"btn-modern\">Daftar Kursus Sekarang &raquo;</button>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Buttons</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_pagination": {
        "title": "CSS Pagination",
        "summary": "Membangun navigasi penomoran halaman yang rapi dan responsif.",
        "content": "<p class=\"lead\">Pagination membagi daftar konten panjang menjadi beberapa nomor halaman yang terstruktur.</p>",
        "example_title": "Contoh Kode CSS Pagination",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .pagination { display: inline-flex; gap: 5px; font-family: sans-serif; }\n        .pagination a {\n            color: #0d2e5c;\n            padding: 8px 14px;\n            text-decoration: none;\n            border: 1px solid #cbd5e1;\n            border-radius: 6px;\n            font-weight: bold;\n        }\n        .pagination a.active {\n            background-color: #0d2e5c;\n            color: white;\n            border-color: #0d2e5c;\n        }\n        .pagination a:hover:not(.active) { background-color: #f1f5f9; }\n    </style>\n</head>\n<body>\n    <div class=\"pagination\">\n        <a href=\"#\">&laquo;</a>\n        <a href=\"#\" class=\"active\">1</a>\n        <a href=\"#\">2</a>\n        <a href=\"#\">3</a>\n        <a href=\"#\">&raquo;</a>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Pagination</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_multiple_columns": {
        "title": "CSS Multiple Columns",
        "summary": "Membagi teks paragraf menjadi beberapa kolom layaknya koran atau majalah cetak.",
        "content": "<p class=\"lead\">Properti <code>column-count</code> dan <code>column-gap</code> menyusun teks panjang ke dalam kolom majalah secara otomatis.</p>",
        "example_title": "Contoh Kode CSS Multiple Columns",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .koran {\n            column-count: 2;\n            column-gap: 30px;\n            column-rule: 1px solid #cbd5e1;\n            text-align: justify;\n            font-family: serif;\n            line-height: 1.6;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"koran\">\n        CSS Multiple Columns memungkinkan teks mengalir secara alami dari satu kolom ke kolom berikutnya seperti majalah berita ternama. Ini mempermudah pengguna membaca tulisan panjang di layar monitor lebar tanpa membuat mata lelah mengikuti baris kalimat yang terlalu panjang.\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Multiple Columns</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_user_interface": {
        "title": "CSS User Interface",
        "summary": "Mengatur kemampuan pengubahan ukuran elemen (resize) dan outline-offset pada elemen form.",
        "content": "<p class=\"lead\">Properti <code>resize: both; overflow: auto;</code> memungkinkan pengguna menarik sudut kotak untuk memperbesar ukurannya.</p>",
        "example_title": "Contoh Kode CSS User Interface",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kotak-resize {\n            border: 2px solid #0d2e5c;\n            padding: 15px;\n            width: 250px;\n            resize: both;\n            overflow: auto;\n            border-radius: 8px;\n            font-family: sans-serif;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"kotak-resize\">\n        Tarik sudut kanan bawah kotak ini untuk memperbesar ukurannya!\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS User Interface</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_variables": {
        "title": "CSS Variables",
        "summary": "Mendeklarasikan variabel CSS kustom (:root) untuk konsistensi warna dan tema seluruh website.",
        "content": "<p class=\"lead\">CSS Custom Properties (Variabel) didefinisikan dengan awalan dua strip <code>--nama-variabel: nilai;</code> dan diakses dengan <code>var(--nama-variabel)</code>.</p>",
        "example_title": "Contoh Kode CSS Variables",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        :root {\n            --warna-utama: #0d2e5c;\n            --warna-aksen: #fca311;\n            --radius-kartu: 12px;\n        }\n        .kartu-tema {\n            background-color: var(--warna-utama);\n            color: white;\n            border-bottom: 5px solid var(--warna-aksen);\n            border-radius: var(--radius-kartu);\n            padding: 20px;\n            font-family: sans-serif;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"kartu-tema\">\n        <h3>Tema dengan CSS Variables</h3>\n        <p>Mengubah warna utama di :root akan otomatis memperbarui seluruh komponen web.</p>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Variables</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_property": {
        "title": "CSS @property",
        "summary": "Mendefinisikan variabel CSS bertipe data eksplisit untuk memungkinkan animasi gradasi halus.",
        "content": "<p class=\"lead\">Aturan <code>@property</code> adalah fitur modern CSS Houdini yang memberikan tipe sintaks dan nilai awal pada custom properties.</p>",
        "example_title": "Contoh Kode CSS @property",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        @property --sudut-gradien {\n            syntax: '<angle>';\n            initial-value: 0deg;\n            inherits: false;\n        }\n        .kartu-berputar {\n            background: linear-gradient(var(--sudut-gradien), #0d2e5c, #04AA6D);\n            color: white;\n            padding: 25px;\n            border-radius: 12px;\n            font-family: sans-serif;\n            text-align: center;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"kartu-berputar\">\n        <h4>CSS @property Houdini</h4>\n        <p>Mendukung tipe data ketat di dalam stylesheet modern.</p>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS @property</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_box_sizing": {
        "title": "CSS Box Sizing",
        "summary": "Menjaga lebar elemen tetap konsisten saat ditambahkan padding dan border dengan border-box.",
        "content": "<p class=\"lead\">Menerapkan <code>box-sizing: border-box</code> secara universal adalah aturan emas web development modern.</p>",
        "example_title": "Contoh Kode CSS Box Sizing",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        * { box-sizing: border-box; }\n        .kotak-50 {\n            width: 50%;\n            padding: 20px;\n            border: 5px solid #0d2e5c;\n            float: left;\n            background: #e0f2fe;\n            text-align: center;\n            font-family: sans-serif;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"kotak-50\">Kolom Kiri 50%</div>\n    <div class=\"kotak-50\">Kolom Kanan 50%</div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Box Sizing</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_functions": {
        "title": "CSS Functions",
        "summary": "Fungsi matematika kalkulasi dinamis: calc(), min(), max(), dan clamp().",
        "content": "<p class=\"lead\">Fungsi <code>clamp(min, preferred, max)</code> memungkinkan pembuatan ukuran teks atau margin yang responsif mulus tanpa media query!</p>",
        "example_title": "Contoh Kode CSS Functions",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .judul-adaptif {\n            font-size: clamp(1.2rem, 3vw, 2.5rem);\n            color: #0d2e5c;\n            font-family: sans-serif;\n            font-weight: 800;\n        }\n    </style>\n</head>\n<body>\n    <h1 class=\"judul-adaptif\">Judul Responsif Otomatis Menggunakan clamp()</h1>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Functions</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css3_media_queries": {
        "title": "CSS Media Queries",
        "summary": "Menyesuaikan gaya tampilan website berdasarkan ukuran layar perangkat pengguna.",
        "content": "<p class=\"lead\">Aturan <code>@media</code> mengevaluasi lebar layar perangkat (viewport) dan menerapkan aturan CSS spesifik untuk HP atau Desktop.</p>",
        "example_title": "Contoh Kode CSS Media Queries",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .banner-responsif {\n            background-color: #0d2e5c;\n            color: white;\n            padding: 20px;\n            text-align: center;\n            font-family: sans-serif;\n        }\n        @media screen and (max-width: 600px) {\n            .banner-responsif {\n                background-color: #04AA6D;\n            }\n        }\n    </style>\n</head>\n<body>\n    <div class=\"banner-responsif\">\n        Layar Lebar = Navy. Layar HP (&lt; 600px) = Hijau.\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Media Queries</strong> mengubah tampilan elemen di atas.</p>"
      }
    },
    "CSS Flexbox": {
      "flexbox_intro": {
        "title": "Flexbox Intro",
        "summary": "Pengenalan Flexible Box Layout Module untuk menata elemen dalam satu baris atau satu kolom secara efisien.",
        "content": "<p class=\"lead\">Flexbox adalah model tata letak satu dimensi yang memudahkan perataan, pembagian ruang, dan pengaturan urutan elemen antarmuka.</p>",
        "example_title": "Contoh Kode Flexbox Intro",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .flex-container {\n            display: flex;\n            background-color: #0d2e5c;\n            padding: 10px;\n            gap: 10px;\n            border-radius: 8px;\n        }\n        .flex-item {\n            background-color: #fca311;\n            color: #0d2e5c;\n            font-weight: bold;\n            padding: 20px;\n            text-align: center;\n            flex: 1;\n            border-radius: 6px;\n            font-family: sans-serif;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"flex-container\">\n        <div class=\"flex-item\">Item 1</div>\n        <div class=\"flex-item\">Item 2</div>\n        <div class=\"flex-item\">Item 3</div>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>Flexbox Intro</strong> mengubah tampilan elemen di atas.</p>"
      },
      "flexbox_container": {
        "title": "Flex Container",
        "summary": "Properti kontainer induk Flexbox: flex-direction, justify-content, align-items, dan flex-wrap.",
        "content": "<p class=\"lead\">Properti <code>justify-content: space-between;</code> dan <code>align-items: center;</code> adalah kombinasi paling populer untuk membuat bilah navigasi modern.</p>",
        "example_title": "Contoh Kode Flex Container",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .nav-flex {\n            display: flex;\n            justify-content: space-between;\n            align-items: center;\n            background: #ffffff;\n            border: 1px solid #e2e8f0;\n            padding: 12px 20px;\n            border-radius: 8px;\n            font-family: sans-serif;\n        }\n        .nav-menu { display: flex; gap: 15px; }\n        .nav-menu a { text-decoration: none; color: #0d2e5c; font-weight: 600; }\n    </style>\n</head>\n<body>\n    <div class=\"nav-flex\">\n        <strong style=\"color: #0d2e5c;\">Skillance</strong>\n        <div class=\"nav-menu\">\n            <a href=\"#\">Beranda</a>\n            <a href=\"#\">Materi</a>\n            <a href=\"#\">Bursa</a>\n        </div>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>Flex Container</strong> mengubah tampilan elemen di atas.</p>"
      },
      "flexbox_items": {
        "title": "Flex Items",
        "summary": "Properti anak elemen flex: order, flex-grow, flex-shrink, flex-basis, dan align-self.",
        "content": "<p class=\"lead\">Gunakan <code>flex-grow: 1</code> untuk membuat elemen anak mengisi sisa ruang kosong yang tersedia pada kontainer.</p>",
        "example_title": "Contoh Kode Flex Items",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kontainer { display: flex; gap: 10px; background: #e2e8f0; padding: 10px; }\n        .kotak-tetap { width: 100px; background: #94a3b8; padding: 15px; text-align: center; }\n        .kotak-melar { flex-grow: 1; background: #04AA6D; color: white; padding: 15px; text-align: center; }\n    </style>\n</head>\n<body>\n    <div class=\"kontainer\">\n        <div class=\"kotak-tetap\">100px</div>\n        <div class=\"kotak-melar\">flex-grow: 1 (Otomatis Melar)</div>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>Flex Items</strong> mengubah tampilan elemen di atas.</p>"
      },
      "flexbox_responsive": {
        "title": "Flex Responsive",
        "summary": "Membangun grid kartu yang otomatis membungkus (wrap) menjadi bertumpuk di layar smartphone.",
        "content": "<p class=\"lead\">Kombinasikan <code>flex-wrap: wrap;</code> dengan <code>flex: 1 1 250px;</code> untuk tata letak kartu yang sepenuhnya responsif tanpa media query!</p>",
        "example_title": "Contoh Kode Flex Responsive",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .grid-kartu {\n            display: flex;\n            flex-wrap: wrap;\n            gap: 15px;\n            font-family: sans-serif;\n        }\n        .kartu {\n            flex: 1 1 200px;\n            background: white;\n            border: 1px solid #cbd5e1;\n            padding: 20px;\n            border-radius: 8px;\n            box-shadow: 0 2px 6px rgba(0,0,0,0.05);\n        }\n    </style>\n</head>\n<body>\n    <div class=\"grid-kartu\">\n        <div class=\"kartu\"><h4>Modul 1</h4><p>Dasar Pemrograman</p></div>\n        <div class=\"kartu\"><h4>Modul 2</h4><p>Struktur Algoritma</p></div>\n        <div class=\"kartu\"><h4>Modul 3</h4><p>Proyek Akhir</p></div>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>Flex Responsive</strong> mengubah tampilan elemen di atas.</p>"
      }
    },
    "CSS Grid": {
      "grid_intro": {
        "title": "Grid Intro",
        "summary": "Pengenalan CSS Grid Layout Module dua dimensi untuk menata baris dan kolom secara bersamaan.",
        "content": "<p class=\"lead\">CSS Grid adalah sistem tata letak 2 dimensi paling kuat di CSS, mampu mengatur kolom dan baris kompleks secara presisi.</p>",
        "example_title": "Contoh Kode Grid Intro",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .grid-wadah {\n            display: grid;\n            grid-template-columns: auto auto auto;\n            background-color: #0d2e5c;\n            padding: 10px;\n            gap: 10px;\n        }\n        .grid-item {\n            background-color: white;\n            padding: 20px;\n            text-align: center;\n            font-family: sans-serif;\n            font-weight: bold;\n            color: #0d2e5c;\n            border-radius: 4px;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"grid-wadah\">\n        <div class=\"grid-item\">1</div>\n        <div class=\"grid-item\">2</div>\n        <div class=\"grid-item\">3</div>\n        <div class=\"grid-item\">4</div>\n        <div class=\"grid-item\">5</div>\n        <div class=\"grid-item\">6</div>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>Grid Intro</strong> mengubah tampilan elemen di atas.</p>"
      },
      "grid_container": {
        "title": "Grid Container",
        "summary": "Menentukan dimensi kolom dan baris dengan grid-template-columns, fr unit, dan gap.",
        "content": "<p class=\"lead\">Unit pecahan <code>1fr</code> (fraction) membagi ruang kontainer secara proporsional. <code>repeat(3, 1fr)</code> membuat 3 kolom sama lebar.</p>",
        "example_title": "Contoh Kode Grid Container",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .grid-kolom {\n            display: grid;\n            grid-template-columns: repeat(3, 1fr);\n            gap: 15px;\n            font-family: sans-serif;\n        }\n        .kolom-item {\n            background: #e0f2fe;\n            color: #0369a1;\n            padding: 25px;\n            text-align: center;\n            border-radius: 8px;\n            font-weight: bold;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"grid-kolom\">\n        <div class=\"kolom-item\">Kolom 1 (1fr)</div>\n        <div class=\"kolom-item\">Kolom 2 (1fr)</div>\n        <div class=\"kolom-item\">Kolom 3 (1fr)</div>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>Grid Container</strong> mengubah tampilan elemen di atas.</p>"
      },
      "grid_items": {
        "title": "Grid Items",
        "summary": "Mengatur rentang kolom dan baris pada anak elemen dengan grid-column dan grid-row.",
        "content": "<p class=\"lead\">Gunakan <code>grid-column: span 2;</code> untuk membuat elemen membentang selebar 2 kolom.</p>",
        "example_title": "Contoh Kode Grid Items",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .grid-span {\n            display: grid;\n            grid-template-columns: repeat(3, 1fr);\n            gap: 10px;\n            font-family: sans-serif;\n        }\n        .item-lebar {\n            grid-column: span 2;\n            background: #0d2e5c;\n            color: white;\n            padding: 20px;\n            text-align: center;\n            border-radius: 6px;\n        }\n        .item-biasa {\n            background: #fca311;\n            color: #0d2e5c;\n            padding: 20px;\n            text-align: center;\n            border-radius: 6px;\n            font-weight: bold;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"grid-span\">\n        <div class=\"item-lebar\">Membentang 2 Kolom</div>\n        <div class=\"item-biasa\">1 Kolom</div>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>Grid Items</strong> mengubah tampilan elemen di atas.</p>"
      },
      "grid_layout": {
        "title": "Grid 12-column Layout",
        "summary": "Membangun tata letak halaman web lengkap (Header, Sidebar, Konten, Footer) dengan grid-template-areas.",
        "content": "<p class=\"lead\">Properti <code>grid-template-areas</code> memungkinkan Anda memvisualisasikan denah website layaknya gambar sketsa teks.</p>",
        "example_title": "Contoh Kode Grid 12-column Layout",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .layout-web {\n            display: grid;\n            grid-template-areas:\n                'header header'\n                'sidebar konten'\n                'footer footer';\n            grid-template-columns: 180px 1fr;\n            gap: 10px;\n            font-family: sans-serif;\n        }\n        .h { grid-area: header; background: #0d2e5c; color: white; padding: 15px; }\n        .s { grid-area: sidebar; background: #f1f5f9; padding: 15px; }\n        .k { grid-area: konten; background: #ffffff; border: 1px solid #e2e8f0; padding: 15px; }\n        .f { grid-area: footer; background: #071a35; color: #94a3b8; padding: 10px; text-align: center; }\n    </style>\n</head>\n<body>\n    <div class=\"layout-web\">\n        <div class=\"h\">Header Website</div>\n        <div class=\"s\">Sidebar Navigasi</div>\n        <div class=\"k\">Konten Artikel Utama</div>\n        <div class=\"f\">Footer &copy; 2026</div>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>Grid 12-column Layout</strong> mengubah tampilan elemen di atas.</p>"
      },
      "grid_supports": {
        "title": "CSS @supports",
        "summary": "Aturan pendeteksian fitur modern peramban (Feature Query).",
        "content": "<p class=\"lead\">Aturan <code>@supports (display: grid)</code> menguji apakah browser klien mendukung fitur tertentu sebelum menerapkan kodenya.</p>",
        "example_title": "Contoh Kode CSS @supports",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .dukungan-fitur {\n            padding: 20px;\n            background: #fee2e2;\n            color: #991b1b;\n            font-family: sans-serif;\n            border-radius: 8px;\n        }\n        @supports (display: grid) {\n            .dukungan-fitur {\n                background: #dcfce7;\n                color: #166534;\n            }\n        }\n    </style>\n</head>\n<body>\n    <div class=\"dukungan-fitur\">\n        Peramban ini sepenuhnya mendukung CSS Grid Layout!\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS @supports</strong> mengubah tampilan elemen di atas.</p>"
      }
    },
    "CSS Responsive": {
      "rwd_intro": {
        "title": "RWD Intro",
        "summary": "Pengantar Responsive Web Design agar website tampil sempurna di HP, tablet, maupun monitor desktop.",
        "content": "<p class=\"lead\">Desain web responsif bukan tentang membuat situs terpisah untuk smartphone, melainkan menggunakan HTML dan CSS fleksibel yang beradaptasi secara dinamis.</p>",
        "example_title": "Contoh Kode RWD Intro",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n    <style>\n        body { font-family: sans-serif; padding: 20px; }\n        .pesan-rwd {\n            background: #0d2e5c;\n            color: white;\n            padding: 20px;\n            border-radius: 8px;\n            text-align: center;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"pesan-rwd\">\n        <h3>Prinsip Dasar RWD</h3>\n        <p>1. Grid Fleksibel | 2. Gambar Fleksibel | 3. Media Queries</p>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>RWD Intro</strong> mengubah tampilan elemen di atas.</p>"
      },
      "rwd_viewport": {
        "title": "RWD Viewport",
        "summary": "Peran vital meta tag viewport untuk mencegah zoom-out otomatis pada browser smartphone.",
        "content": "<p class=\"lead\">Tag <code>&lt;meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"&gt;</code> mengatur rasio piksel agar sesuai layar ponsel fisik.</p>",
        "example_title": "Contoh Kode RWD Viewport",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n</head>\n<body style=\"font-family: sans-serif; line-height: 1.6;\">\n    <h3>Viewport Aktif</h3>\n    <p>Halaman ini dikonfigurasi dengan lebar viewport 1:1 terhadap perangkat.</p>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>RWD Viewport</strong> mengubah tampilan elemen di atas.</p>"
      },
      "rwd_grid": {
        "title": "RWD Grid View",
        "summary": "Membangun sistem grid kolom persentase responsif 12 kolom.",
        "content": "<p class=\"lead\">Sistem grid membagi lebar layar menjadi 12 kolom proporsional (misalnya col-6 = 50%, col-4 = 33.33%).</p>",
        "example_title": "Contoh Kode RWD Grid View",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        * { box-sizing: border-box; }\n        .col-6 { width: 50%; float: left; padding: 15px; }\n        .col-12 { width: 100%; float: left; padding: 15px; }\n        .kotak { background: #e0f2fe; padding: 20px; text-align: center; border-radius: 6px; font-family: sans-serif; }\n    </style>\n</head>\n<body>\n    <div class=\"col-6\"><div class=\"kotak\">Kolom Kiri 50%</div></div>\n    <div class=\"col-6\"><div class=\"kotak\">Kolom Kanan 50%</div></div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>RWD Grid View</strong> mengubah tampilan elemen di atas.</p>"
      },
      "rwd_media_queries": {
        "title": "RWD Media Queries",
        "summary": "Titik henti (Breakpoints) standar industri untuk ponsel (&lt;576px), tablet (&lt;768px), dan desktop.",
        "content": "<p class=\"lead\">Breakpoints mendefinisikan batas ukuran layar di mana tata letak halaman perlu beralih format.</p>",
        "example_title": "Contoh Kode RWD Media Queries",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .info-layar {\n            padding: 20px;\n            text-align: center;\n            font-family: sans-serif;\n            font-weight: bold;\n            background: #cbd5e1;\n            border-radius: 8px;\n        }\n        @media (max-width: 576px) {\n            .info-layar { background: #fca311; color: #0d2e5c; }\n        }\n        @media (min-width: 577px) and (max-width: 992px) {\n            .info-layar { background: #04AA6D; color: white; }\n        }\n        @media (min-width: 993px) {\n            .info-layar { background: #0d2e5c; color: white; }\n        }\n    </style>\n</head>\n<body>\n    <div class=\"info-layar\">Ubah Ukuran Jendela Browser Untuk Melihat Perubahan Warna!</div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>RWD Media Queries</strong> mengubah tampilan elemen di atas.</p>"
      },
      "rwd_images": {
        "title": "RWD Images",
        "summary": "Membuat gambar responsif yang tidak pernah melebihi batas kontainernya.",
        "content": "<p class=\"lead\">Gunakan <code>max-width: 100%; height: auto;</code> agar gambar otomatis mengecil saat kontainer menyempit.</p>",
        "example_title": "Contoh Kode RWD Images",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .img-responsif {\n            max-width: 100%;\n            height: auto;\n            border-radius: 8px;\n        }\n    </style>\n</head>\n<body>\n    <img src=\"https://picsum.photos/600/300\" class=\"img-responsif\" alt=\"Banner Responsif\">\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>RWD Images</strong> mengubah tampilan elemen di atas.</p>"
      },
      "rwd_videos": {
        "title": "RWD Videos",
        "summary": "Teknik menjaga rasio aspek 16:9 pada video YouTube atau HTML5 video player.",
        "content": "<p class=\"lead\">Properti modern <code>aspect-ratio: 16 / 9;</code> secara elegan menjaga proporsi video responsif tanpa pembungkus hack kuno.</p>",
        "example_title": "Contoh Kode RWD Videos",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .video-player {\n            width: 100%;\n            max-width: 500px;\n            aspect-ratio: 16 / 9;\n            background: #000;\n            border-radius: 8px;\n        }\n    </style>\n</head>\n<body>\n    <video class=\"video-player\" controls>\n        <source src=\"https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4\" type=\"video/mp4\">\n    </video>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>RWD Videos</strong> mengubah tampilan elemen di atas.</p>"
      },
      "rwd_frameworks": {
        "title": "RWD Frameworks",
        "summary": "Gambaran umum framework CSS populer seperti Bootstrap, Tailwind CSS, dan Bulma.",
        "content": "<p class=\"lead\">Framework CSS mempercepat perakitan komponen responsif dengan kelas utilitas siap pakai.</p>",
        "example_title": "Contoh Kode RWD Frameworks",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">\n</head>\n<body class=\"p-4\">\n    <div class=\"alert alert-primary fw-bold\" role=\"alert\">\n        Komponen Responsif Siap Pakai dari Bootstrap 5!\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>RWD Frameworks</strong> mengubah tampilan elemen di atas.</p>"
      },
      "rwd_templates": {
        "title": "RWD Templates",
        "summary": "Boilerplate template landing page lengkap responsif dengan HTML dan CSS murni.",
        "content": "<p class=\"lead\">Template dasar responsif siap pakai untuk portofolio atau halaman produk bisnis Anda.</p>",
        "example_title": "Contoh Kode RWD Templates",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n    <style>\n        * { box-sizing: border-box; margin: 0; padding: 0; }\n        body { font-family: sans-serif; background: #f8fafc; }\n        header { background: #0d2e5c; color: white; padding: 30px 20px; text-align: center; }\n        .konten { max-width: 800px; margin: 20px auto; padding: 20px; background: white; border-radius: 8px; }\n        footer { text-align: center; padding: 20px; color: #64748b; }\n    </style>\n</head>\n<body>\n    <header><h1>Skillance Web Responsif</h1></header>\n    <div class=\"konten\">\n        <h2>Selamat Datang</h2>\n        <p>Template bersih dan ringan yang siap disesuaikan untuk berbagai keperluan.</p>\n    </div>\n    <footer>&copy; 2026 Skillance Academy</footer>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>RWD Templates</strong> mengubah tampilan elemen di atas.</p>"
      }
    },
    "CSS Cert": {
      "css_exam": {
        "title": "CSS Certificate",
        "summary": "Uji kompetensi dan sertifikasi pemahaman CSS standar industri Skillance Academy.",
        "content": "<p class=\"lead\">Uji pemahaman Anda terhadap selektor CSS, model kotak (box model), Flexbox, CSS Grid, dan tata letak responsif modern.</p>",
        "example_title": "Contoh Kode CSS Certificate",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kartu-ujian {\n            background: #ffffff;\n            border: 2px solid #04AA6D;\n            padding: 30px;\n            border-radius: 12px;\n            text-align: center;\n            font-family: sans-serif;\n            max-width: 400px;\n            margin: auto;\n        }\n        .btn-ujian {\n            background: #04AA6D;\n            color: white;\n            padding: 12px 24px;\n            border: none;\n            border-radius: 6px;\n            font-weight: bold;\n            cursor: pointer;\n            margin-top: 15px;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"kartu-ujian\">\n        <h2>Uji Sertifikasi CSS</h2>\n        <p>Tuntaskan 25 soal evaluasi praktik styling dan tata letak modern.</p>\n        <button class=\"btn-ujian\" onclick=\"alert('Ujian Sertifikasi Siap Diikuti!')\">Mulai Ujian &raquo;</button>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Certificate</strong> mengubah tampilan elemen di atas.</p>"
      }
    },
    "CSS SASS": {
      "sass_tutorial": {
        "title": "SASS Tutorial",
        "summary": "Pengenalan preprocessor SASS / SCSS: variabel, nesting, mixins, dan inheritance.",
        "content": "<p class=\"lead\">SASS (Syntactically Awesome Style Sheets) adalah preprocessor yang memperluas CSS dengan fitur variabel, nesting hierarki, dan mixins yang dapat digunakan kembali.</p>",
        "example_title": "Contoh Kode SASS Tutorial",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        /* Hasil kompilasi SCSS ke CSS murni */\n        .kartu-sass {\n            background: #fdf2f8;\n            border: 1px solid #f472b6;\n            padding: 20px;\n            border-radius: 8px;\n            font-family: sans-serif;\n        }\n        .kartu-sass h3 { color: #db2777; margin-top: 0; }\n        .kartu-sass p { color: #475569; }\n    </style>\n</head>\n<body>\n    <div class=\"kartu-sass\">\n        <h3>SCSS Preprocessor</h3>\n        <p>Menulis kode stylesheet lebih bersih, terstruktur, dan terorganisir.</p>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>SASS Tutorial</strong> mengubah tampilan elemen di atas.</p>"
      }
    },
    "CSS Examples": {
      "css_templates": {
        "title": "CSS Templates",
        "summary": "Koleksi template komponen dan tata letak CSS murni siap pakai.",
        "content": "<p class=\"lead\">Pelajari berbagai susunan template siap pakai mulai dari kartu profil, banner promo, hingga formulir login modern.</p>",
        "example_title": "Contoh Kode CSS Templates",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kartu-profil {\n            width: 260px;\n            background: white;\n            border-radius: 12px;\n            box-shadow: 0 4px 15px rgba(0,0,0,0.08);\n            text-align: center;\n            padding: 25px;\n            font-family: sans-serif;\n            margin: auto;\n        }\n        .kartu-profil img { width: 80px; height: 80px; border-radius: 50%; }\n        .nama { font-weight: bold; color: #0d2e5c; margin-top: 10px; }\n        .posisi { color: #64748b; font-size: 13px; }\n    </style>\n</head>\n<body>\n    <div class=\"kartu-profil\">\n        <img src=\"https://picsum.photos/100\" alt=\"Avatar\">\n        <div class=\"nama\">Rian Pratama</div>\n        <div class=\"posisi\">Frontend Engineer</div>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Templates</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_examples": {
        "title": "CSS Examples",
        "summary": "Ratusan contoh visual implementasi deklarasi CSS.",
        "content": "<p class=\"lead\">Katalog referensi contoh kode CSS cepat untuk memecahkan kebutuhan desain antarmuka sehari-hari.</p>",
        "example_title": "Contoh Kode CSS Examples",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .lencana {\n            display: inline-block;\n            padding: 5px 12px;\n            font-size: 12px;\n            font-weight: bold;\n            border-radius: 20px;\n            background: #dbeafe;\n            color: #1d4ed8;\n            font-family: sans-serif;\n        }\n    </style>\n</head>\n<body>\n    <span class=\"lencana\">Contoh Badge UI</span>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Examples</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_editor": {
        "title": "CSS Editor",
        "summary": "Code Lab interaktif Skillance Academy untuk menguji kode secara real-time.",
        "content": "<p class=\"lead\">Gunakan editor langsung untuk mengubah warna, ukuran font, dan margin secara instan tanpa perlu beralih ke editor lokal.</p>",
        "example_title": "Contoh Kode CSS Editor",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        h1 { color: #04AA6D; font-family: sans-serif; }\n    </style>\n</head>\n<body>\n    <h1>Ubah kode CSS di panel kiri untuk melihat hasilnya secara langsung!</h1>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Editor</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_snippets": {
        "title": "CSS Snippets",
        "summary": "Potongan kode trik visual: Glassmorphism, Neumorphism, dan Animasi Tombol Berkilau.",
        "content": "<p class=\"lead\">Efek Glassmorphism populer menggunakan kombinasi <code>backdrop-filter: blur(10px)</code> dan warna latar transparan.</p>",
        "example_title": "Contoh Kode CSS Snippets",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body {\n            background: linear-gradient(45deg, #0d2e5c, #fca311);\n            min-height: 100vh;\n            display: flex;\n            align-items: center;\n            justify-content: center;\n            font-family: sans-serif;\n        }\n        .kartu-kaca {\n            background: rgba(255, 255, 255, 0.2);\n            backdrop-filter: blur(12px);\n            -webkit-backdrop-filter: blur(12px);\n            border: 1px solid rgba(255, 255, 255, 0.3);\n            border-radius: 16px;\n            padding: 30px;\n            color: white;\n            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);\n        }\n    </style>\n</head>\n<body>\n    <div class=\"kartu-kaca\">\n        <h3>Glassmorphism UI</h3>\n        <p>Efek kaca buram modern berstandar tren desain 2026.</p>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Snippets</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_quiz": {
        "title": "CSS Quiz",
        "summary": "Kuis interaktif pilihan ganda untuk menguji ketangkasan pemahaman CSS Anda.",
        "content": "<p class=\"lead\">Jawab pertanyaan-pertanyaan singkat seputar sintaks, properti, dan hierarki spesifisitas CSS.</p>",
        "example_title": "Contoh Kode CSS Quiz",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .kuis-box {\n            font-family: sans-serif;\n            border: 1px solid #cbd5e1;\n            padding: 20px;\n            border-radius: 8px;\n            max-width: 450px;\n        }\n        .opsi { display: block; margin: 8px 0; }\n    </style>\n</head>\n<body>\n    <div class=\"kuis-box\">\n        <h4>Pertanyaan: Manakah properti untuk mengubah warna teks?</h4>\n        <label class=\"opsi\"><input type=\"radio\" name=\"q1\"> font-color</label>\n        <label class=\"opsi\"><input type=\"radio\" name=\"q1\"> text-color</label>\n        <label class=\"opsi\"><input type=\"radio\" name=\"q1\"> color (Benar)</label>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Quiz</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_exercises": {
        "title": "CSS Exercises",
        "summary": "Latihan terpandu mengisi sintaks kode yang hilang pada potongan stylesheet.",
        "content": "<p class=\"lead\">Asah reflek koding CSS Anda melalui tantangan latihan terarah.</p>",
        "example_title": "Contoh Kode CSS Exercises",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .latihan {\n            background: #1e293b;\n            color: #f8fafc;\n            padding: 20px;\n            border-radius: 8px;\n            font-family: monospace;\n        }\n    </style>\n</head>\n<body>\n    <div class=\"latihan\">\n        /* Lengkapi kode di bawah agar teks berada di tengah: */<br>\n        p {<br>\n        &nbsp;&nbsp;text-align: center;<br>\n        }\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Exercises</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_challenges": {
        "title": "CSS Challenges",
        "summary": "Tantangan memecahkan studi kasus desain antarmuka nyata.",
        "content": "<p class=\"lead\">Selesaikan tantangan mendesain kartu harga (Pricing Table) atau kartu e-commerce responsif.</p>",
        "example_title": "Contoh Kode CSS Challenges",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .tabel-harga {\n            border: 2px solid #0d2e5c;\n            border-radius: 12px;\n            padding: 25px;\n            text-align: center;\n            font-family: sans-serif;\n            max-width: 280px;\n        }\n        .harga { font-size: 28px; font-weight: bold; color: #0d2e5c; margin: 15px 0; }\n    </style>\n</head>\n<body>\n    <div class=\"tabel-harga\">\n        <h3>Paket Pro</h3>\n        <div class=\"harga\">Rp 99.000<small>/bln</small></div>\n        <p>Akses semua modul & bursa kerja.</p>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Challenges</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_website": {
        "title": "CSS Website",
        "summary": "Membangun halaman website korporat utuh menggunakan HTML5 dan CSS3 murni.",
        "content": "<p class=\"lead\">Panduan langkah demi langkah merakit navbar, hero banner, fitur unggulan, dan footer profesional.</p>",
        "example_title": "Contoh Kode CSS Website",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: sans-serif; margin: 0; }\n        header { background: #0d2e5c; color: white; padding: 20px; text-align: center; }\n        section { padding: 40px 20px; text-align: center; }\n        footer { background: #071a35; color: #94a3b8; padding: 15px; text-align: center; }\n    </style>\n</head>\n<body>\n    <header><h2>Profil Perusahaan</h2></header>\n    <section><h3>Layanan Kami</h3><p>Pengembangan Web & Aplikasi Mobile Berstandar Global.</p></section>\n    <footer>&copy; 2026 Skillance Digital Indonesia</footer>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Website</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_syllabus": {
        "title": "CSS Syllabus",
        "summary": "Silabus pembelajaran CSS terstruktur dari tingkat dasar hingga mahir.",
        "content": "<p class=\"lead\">Jalur pembelajaran lengkap yang dirancang berurutan agar Anda menguasai fundamental styling web dengan percaya diri.</p>",
        "example_title": "Contoh Kode CSS Syllabus",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .timeline { font-family: sans-serif; border-left: 3px solid #04AA6D; padding-left: 15px; }\n        .t-step { margin-bottom: 15px; }\n        .t-step strong { color: #0d2e5c; }\n    </style>\n</head>\n<body>\n    <div class=\"timeline\">\n        <div class=\"t-step\"><strong>Tahap 1:</strong> Selektor & Sintaks Dasar</div>\n        <div class=\"t-step\"><strong>Tahap 2:</strong> Box Model, Padding & Margin</div>\n        <div class=\"t-step\"><strong>Tahap 3:</strong> Flexbox & CSS Grid Modern</div>\n        <div class=\"t-step\"><strong>Tahap 4:</strong> RWD & Media Queries</div>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Syllabus</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_study_plan": {
        "title": "CSS Study Plan",
        "summary": "Rencana belajar intensif 14 hari menguasai CSS untuk persiapan kerja.",
        "content": "<p class=\"lead\">Alokasi waktu harian untuk membaca teori dan mempraktikkan proyek koding mandiri.</p>",
        "example_title": "Contoh Kode CSS Study Plan",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; line-height: 1.8;\">\n    <h3>Target Belajar 14 Hari</h3>\n    <ul>\n        <li><strong>Hari 1-3:</strong> Pengenalan Selektor, Warna & Tipografi</li>\n        <li><strong>Hari 4-7:</strong> Box Model, Display & Flexbox Layout</li>\n        <li><strong>Hari 8-11:</strong> CSS Grid & Desain Responsif Layar HP</li>\n        <li><strong>Hari 12-14:</strong> Proyek Portofolio Web Interaktif</li>\n    </ul>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Study Plan</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_interview": {
        "title": "CSS Interview Prep",
        "summary": "Daftar pertanyaan wawancara kerja teknis paling sering ditanyakan untuk posisi Frontend Developer.",
        "content": "<p class=\"lead\">Siapkan jawaban terbaik seputar perbedaan inline vs block, spesifisitas selektor, stacking context z-index, dan Flexbox vs Grid.</p>",
        "example_title": "Contoh Kode CSS Interview Prep",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        .tanya-jawab { font-family: sans-serif; background: #f8fafc; border: 1px solid #e2e8f0; padding: 20px; border-radius: 8px; }\n        .tanya { font-weight: bold; color: #0d2e5c; }\n        .jawab { color: #334155; margin-top: 5px; }\n    </style>\n</head>\n<body>\n    <div class=\"tanya-jawab\">\n        <div class=\"tanya\">Q: Kapan sebaiknya menggunakan Flexbox vs CSS Grid?</div>\n        <div class=\"jawab\">A: Gunakan Flexbox untuk tata letak satu dimensi (baris atau kolom tunggal). Gunakan CSS Grid untuk tata letak dua dimensi yang mengatur baris dan kolom secara bersamaan.</div>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Interview Prep</strong> mengubah tampilan elemen di atas.</p>"
      }
    },
    "CSS References": {
      "css_ref": {
        "title": "CSS Reference",
        "summary": "Daftar komprehensif seluruh properti CSS modern dan fungsinya.",
        "content": "<p class=\"lead\">Gunakan indeks ini sebagai buku saku cepat saat Anda membutuhkan nama properti CSS yang tepat.</p>",
        "example_title": "Contoh Kode CSS Reference",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif;\">\n    <h3>Indeks Properti Populer</h3>\n    <p><code>color</code>, <code>background</code>, <code>font-size</code>, <code>margin</code>, <code>padding</code>, <code>display</code>, <code>flex</code>, <code>grid</code>.</p>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Reference</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_selectors": {
        "title": "CSS Selectors Reference",
        "summary": "Tabel lengkap seluruh selektor CSS: elemen, class, id, atribut, dan pseudo.",
        "content": "<p class=\"lead\">Panduan sintaks penargetan elemen secara spesifik dan efisien.</p>",
        "example_title": "Contoh Kode CSS Selectors Reference",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif;\">\n    <p><code>element</code> : tag HTML<br><code>.class</code> : nama kelas<br><code>#id</code> : ID unik<br><code>*</code> : seluruh elemen</p>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Selectors Reference</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_combinators": {
        "title": "CSS Combinators Reference",
        "summary": "Kombinator relasional antar elemen: Spasi (descendant), > (child), + (adjacent), ~ (general sibling).",
        "content": "<p class=\"lead\">Kombinator menjelaskan hubungan hierarki antara dua atau lebih selektor.</p>",
        "example_title": "Contoh Kode CSS Combinators Reference",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        div > p { color: #04AA6D; font-weight: bold; font-family: sans-serif; }\n    </style>\n</head>\n<body>\n    <div>\n        <p>Anak Langsung (div &gt; p) Berwarna Hijau</p>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Combinators Reference</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_pseudo_classes": {
        "title": "CSS Pseudo-classes Reference",
        "summary": "Daftar kelas semu status: :hover, :active, :focus, :first-child, :nth-child().",
        "content": "<p class=\"lead\">Pseudo-class digunakan untuk mendefinisikan status khusus suatu elemen HTML.</p>",
        "example_title": "Contoh Kode CSS Pseudo-classes Reference",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        li:nth-child(even) { background-color: #f1f5f9; }\n        li { padding: 8px; font-family: sans-serif; }\n    </style>\n</head>\n<body>\n    <ul>\n        <li>Baris Ganjil 1</li>\n        <li>Baris Genap 2 (:nth-child(even))</li>\n        <li>Baris Ganjil 3</li>\n    </ul>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Pseudo-classes Reference</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_pseudo_elements": {
        "title": "CSS Pseudo-elements Reference",
        "summary": "Daftar elemen semu: ::before, ::after, ::placeholder, ::selection.",
        "content": "<p class=\"lead\">Pseudo-element menyisipkan konten dekoratif atau menata bagian tertentu dari suatu elemen.</p>",
        "example_title": "Contoh Kode CSS Pseudo-elements Reference",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        ::selection { background: #fca311; color: #0d2e5c; }\n        p::first-letter { font-size: 200%; color: #0d2e5c; font-weight: bold; }\n    </style>\n</head>\n<body>\n    <p>Sorot kalimat ini untuk melihat efek kustom styling ::selection berwarna emas!</p>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Pseudo-elements Reference</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_atrules": {
        "title": "CSS At-rules Reference",
        "summary": "Panduan instruksi @rules: @import, @media, @keyframes, @font-face, @supports.",
        "content": "<p class=\"lead\">At-rule adalah pernyataan CSS yang menginstruksikan bagaimana stylesheet harus berperilaku.</p>",
        "example_title": "Contoh Kode CSS At-rules Reference",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif;\">\n    <p>Aturan <code>@media</code> mengontrol tata letak responsif, sedangkan <code>@keyframes</code> mengontrol animasi.</p>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS At-rules Reference</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_functions": {
        "title": "CSS Functions Reference",
        "summary": "Kamus fungsi bawaan CSS: calc(), rgb(), hsl(), clamp(), linear-gradient().",
        "content": "<p class=\"lead\">Fungsi CSS memanipulasi nilai parameter secara dinamis di dalam browser.</p>",
        "example_title": "Contoh Kode CSS Functions Reference",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif;\">\n    <p><code>calc(100% - 40px)</code>, <code>clamp(14px, 2vw, 24px)</code>, <code>rgb(13, 46, 92)</code>.</p>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Functions Reference</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_aural": {
        "title": "CSS Aural Reference",
        "summary": "Properti suara dan pembaca layar untuk aksesibilitas ramah tunanetra (speech synthesis).",
        "content": "<p class=\"lead\">Stylesheet aural mengontrol pembacaan teks suara dan penekanan audio untuk teknologi pembaca layar.</p>",
        "example_title": "Contoh Kode CSS Aural Reference",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif;\">\n    <p>Aksesibilitas web (a11y) memastikan website dapat diakses oleh semua kalangan pengguna.</p>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Aural Reference</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_websafe_fonts": {
        "title": "Web Safe Fonts Reference",
        "summary": "Daftar font standar yang dijamin tersedia di seluruh sistem operasi komputer (Windows, Mac, Linux).",
        "content": "<p class=\"lead\">Contoh font aman web: Arial, Verdana, Helvetica, Tahoma, Trebuchet MS, Times New Roman, Georgia, Courier New.</p>",
        "example_title": "Contoh Kode Web Safe Fonts Reference",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: Arial, sans-serif;\">\n    <p>Contoh tipografi menggunakan font web aman: Arial, sans-serif.</p>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>Web Safe Fonts Reference</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_animatable": {
        "title": "CSS Animatable Properties",
        "summary": "Daftar properti yang dapat dianimasikan secara halus dengan akselerasi perangkat keras GPU.",
        "content": "<p class=\"lead\">Properti seperti <code>opacity</code> dan <code>transform</code> sangat efisien karena dihitung langsung oleh kartu grafis (GPU).</p>",
        "example_title": "Contoh Kode CSS Animatable Properties",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif;\">\n    <p>Properti performa tinggi: <code>transform</code> dan <code>opacity</code> (60 FPS bebas lag).</p>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Animatable Properties</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_units": {
        "title": "CSS Units Reference",
        "summary": "Panduan unit mutlak (px, pt) dan unit relatif (rem, em, vw, vh, %).",
        "content": "<p class=\"lead\">Unit <code>rem</code> (root em) adalah standar modern terbaik untuk ukuran font dan spasi yang adaptif.</p>",
        "example_title": "Contoh Kode CSS Units Reference",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif;\">\n    <p>1rem = 16px (bawaan browser standard).</p>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Units Reference</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_converter": {
        "title": "PX to EM / REM Converter",
        "summary": "Rumus dan kalkulasi cepat konversi piksel ke unit rem atau em.",
        "content": "<p class=\"lead\">Rumus konversi: <code>rem = px / 16</code>. Contoh: 24px = 1.5rem, 32px = 2rem.</p>",
        "example_title": "Contoh Kode PX to EM / REM Converter",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif;\">\n    <h3>Tabel Konversi Cepat</h3>\n    <ul>\n        <li>12px = 0.75rem</li>\n        <li>16px = 1.0rem</li>\n        <li>24px = 1.5rem</li>\n        <li>32px = 2.0rem</li>\n    </ul>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>PX to EM / REM Converter</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_colors": {
        "title": "CSS Color Names",
        "summary": "Katalog 140 nama warna standar CSS resmi (Red, Blue, Orange, Navy, Gold, dll).",
        "content": "<p class=\"lead\">Peramban modern mengenali 140 nama warna bahasa Inggris bawaan seperti <code>CornflowerBlue</code> atau <code>Tomato</code>.</p>",
        "example_title": "Contoh Kode CSS Color Names",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif;\">\n    <span style=\"color: Tomato; font-weight: bold;\">Tomato</span> |\n    <span style=\"color: DodgerBlue; font-weight: bold;\">DodgerBlue</span> |\n    <span style=\"color: MediumSeaGreen; font-weight: bold;\">MediumSeaGreen</span>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Color Names</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_color_values": {
        "title": "CSS Color Values",
        "summary": "Format representasi nilai warna: Hexadecimal (#ffffff), RGB, HSL, RGBA, dan HSLA.",
        "content": "<p class=\"lead\">Penjelasan format warna digital RGB (Red, Green, Blue) dan HSL (Hue, Saturation, Lightness).</p>",
        "example_title": "Contoh Kode CSS Color Values",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif;\">\n    <p><code>#0d2e5c</code> (Hex) = <code>rgb(13, 46, 92)</code> = <code>hsl(215, 75%, 21%)</code></p>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Color Values</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_default_values": {
        "title": "CSS Default Values",
        "summary": "Nilai properti bawaan User-Agent stylesheet dari peramban per elemen HTML.",
        "content": "<p class=\"lead\">Pahami nilai standar browser untuk elemen &lt;h1&gt;, &lt;p&gt;, &lt;ul&gt;, dan &lt;body&gt; agar dapat meresetnya secara tepat.</p>",
        "example_title": "Contoh Kode CSS Default Values",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif;\">\n    <p>Nilai bawaan: <code>body { margin: 8px; }</code></p>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Default Values</strong> mengubah tampilan elemen di atas.</p>"
      },
      "css_ref_browser_support": {
        "title": "CSS Browser Support",
        "summary": "Pengecekan kompatibilitas fitur CSS modern pada Chrome, Firefox, Safari, dan Edge via CanIUse.",
        "content": "<p class=\"lead\">Selalu pastikan fitur CSS mutakhir yang Anda gunakan memiliki tingkat adopsi browser di atas 95% global.</p>",
        "example_title": "Contoh Kode CSS Browser Support",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif;\">\n    <p>Fitur Flexbox, CSS Grid, dan CSS Variables didukung 98%+ peramban aktif di seluruh dunia.</p>\n</body>\n</html>",
        "explanation": "<p>Uji dan amati bagaimana deklarasi CSS <strong>CSS Browser Support</strong> mengubah tampilan elemen di atas.</p>"
      }
    }
  }
}
JSON_DATA
, true);
