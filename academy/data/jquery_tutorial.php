<?php
/**
 * Silabus Lengkap Tutorial jQuery - Skillance Academy Indonesia
 * Terbagi ke dalam 9 Kategori Utama dengan 46 Topik Lengkap
 */

return json_decode(<<<'JSON_DATA'
{
  "categories": {
    "jQuery Tutorial": {
      "jq_home": {
        "title": "jQuery HOME",
        "summary": "Selamat Datang di Tutorial jQuery Skillance Academy. jQuery adalah pustaka JavaScript ringkas berprinsip 'Write Less, Do More'.",
        "content": "<p class=\"lead\">Selamat datang di <strong>Tutorial jQuery Lengkap</strong> Skillance Academy. jQuery adalah pustaka JavaScript yang cepat, kecil, dan kaya fitur. Pustaka ini mempermudah manipulasi dokumen HTML, penanganan event klik, animasi efek visual, dan interaksi AJAX.</p>\n    <div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n        <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-bolt text-primary me-2\"></i>Keunggulan Utama jQuery di Skillance Academy:</h6>\n        <ul class=\"mb-0 ps-3 small\" style=\"line-height: 1.8;\">\n            <li><strong>Sintaks Bersih</strong>: Memilih elemen semudah selektor CSS dengan fungsi <code>$('selector')</code>.</li>\n            <li><strong>Kompatibilitas Lintas Browser</strong>: Menangani perbedaan DOM di berbagai versi browser secara otomatis.</li>\n            <li><strong>Animasi Bawaan</strong>: Efek fade, slide, dan animate siap pakai hanya dalam 1 baris kode.</li>\n        </ul>\n    </div>",
        "example_title": "Contoh Kode jQuery jQuery HOME",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n    <style>\n        body { font-family: sans-serif; text-align: center; padding: 30px; background: #f8fafc; }\n        .kotak { background: #0d2e5c; color: white; padding: 25px; border-radius: 12px; max-width: 380px; margin: auto; }\n        button { background: #fca311; color: #0d2e5c; border: none; padding: 10px 20px; font-weight: bold; border-radius: 6px; cursor: pointer; margin-top: 15px; }\n    </style>\n</head>\n<body>\n    <div class=\"kotak\">\n        <h3 id=\"pesan\">Halo dari jQuery Skillance! ⚡</h3>\n        <p>Klik tombol di bawah untuk mengubah tampilan teks secara instan!</p>\n        <button id=\"btnAksi\">Ubah Teks & Warna</button>\n    </div>\n\n    <script>\n        $(document).ready(function() {\n            $('#btnAksi').click(function() {\n                $('#pesan').text(\"Berhasil dimanipulasi dengan jQuery! 🚀\").css('color', '#4ade80');\n            });\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_intro": {
        "title": "jQuery Intro",
        "summary": "Pengenalan pustaka jQuery: Mengapa jutaan website menggunakannya dan bagaimana jQuery menyederhanakan kode JavaScript mentah.",
        "content": "<p class=\"lead\">Tujuan utama jQuery adalah menyederhanakan penggunaan JavaScript pada website Anda. Tugas-tugas umum yang memerlukan puluhan baris kode JavaScript mentah dapat diselesaikan hanya dengan 1 baris fungsi jQuery.</p>",
        "example_title": "Contoh Kode jQuery jQuery Intro",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Perbandingan JavaScript Murni vs jQuery</h2>\n    <p>JavaScript Murni: <code>document.getElementById(\"demo\").style.display = \"none\";</code><br>\n    Dengan jQuery: <code>$(\"#demo\").hide();</code></p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_get_started": {
        "title": "jQuery Get Started",
        "summary": "Cara memasukkan pustaka jQuery ke dalam halaman HTML: Menggunakan CDN resmi atau mengunduh file lokal.",
        "content": "<p class=\"lead\">Cara termudah dan paling cepat adalah memuat jQuery melalui CDN (Content Delivery Network) resmi seperti Google CDN, cdnjs, atau Code jQuery.</p>",
        "example_title": "Contoh Kode jQuery jQuery Get Started",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <!-- Memuat jQuery via CDN resmi -->\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <p>&lt;script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"&gt;&lt;/script&gt;</p>\n    <p style=\"color:#4ade80;\">// jQuery siap digunakan di seluruh halaman website!</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_syntax": {
        "title": "jQuery Syntax",
        "summary": "Struktur sintaks dasar jQuery: $(selector).action() dan event $(document).ready().",
        "content": "<p class=\"lead\">Sintaks jQuery disesuaikan khusus untuk memilih elemen HTML dan melakukan aksi terhadapnya: <code>$(selector).action()</code>. Tanda dollar <code>$</code> adalah alias pendek untuk memanggil fungsi jQuery.</p>",
        "example_title": "Contoh Kode jQuery jQuery Syntax",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>$(document).ready() Event</h2>\n    <p>Menunggu seluruh elemen DOM HTML selesai dimuat sebelum skrip dieksekusi agar terhindar dari bug elemen null.</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_selectors": {
        "title": "jQuery Selectors",
        "summary": "Menyeleksi elemen HTML berdasarkan nama tag, ID (#), kelas (.), atribut ([attr]), atau pseudoclass (:first, :last).",
        "content": "<p class=\"lead\">Selektor jQuery meminjam aturan penargetan CSS sehingga sangat mudah dipelajari: <code>$('#id')</code>, <code>$('.class')</code>, <code>$('p')</code>, <code>$('ul li:first')</code>.</p>",
        "example_title": "Contoh Kode jQuery jQuery Selectors",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n    <style>body { font-family: sans-serif; padding: 20px; }</style>\n</head>\n<body>\n    <p class=\"target\">Paragraf dengan Kelas .target</p>\n    <p>Paragraf Biasa</p>\n    <button id=\"btnSorot\">Sorot Kelas .target</button>\n\n    <script>\n        $('#btnSorot').click(function() {\n            $('.target').css({'background-color': '#fca311', 'font-weight': 'bold', 'padding': '5px'});\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_events": {
        "title": "jQuery Events",
        "summary": "Menangani aksi pengguna: click, dblclick, mouseenter, mouseleave, hover, focus, blur, dan on().",
        "content": "<p class=\"lead\">Method <code>on()</code> adalah cara modern terbaik di jQuery untuk mengikat satu atau beberapa event handler sekaligus pada elemen yang dipilih.</p>",
        "example_title": "Contoh Kode jQuery jQuery Events",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Event Hover (mouseenter & mouseleave)</h2>\n    <div id=\"kotakHover\" style=\"width:200px; padding:20px; background:#e0f2fe; text-align:center; border-radius:8px; cursor:pointer;\">\n        Arahkan Kursor ke Sini!\n    </div>\n\n    <script>\n        $('#kotakHover').on({\n            mouseenter: function() { $(this).css('background-color', '#4ade80'); },\n            mouseleave: function() { $(this).css('background-color', '#e0f2fe'); }\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      }
    },
    "jQuery Effects": {
      "jq_hide_show": {
        "title": "jQuery Hide/Show",
        "summary": "Menyembunyikan dan menampilkan elemen dengan efek transisi: hide(), show(), dan toggle().",
        "content": "<p class=\"lead\">Fungsi <code>toggle()</code> secara cerdas beralih antara menampilkan atau menyembunyikan elemen secara bergantian setiap kali tombol diklik.</p>",
        "example_title": "Contoh Kode jQuery jQuery Hide/Show",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <button id=\"btnToggle\" style=\"padding:8px 16px; cursor:pointer;\">Buka / Tutup Panel</button>\n    <div id=\"panel\" style=\"background:#0d2e5c; color:white; padding:20px; border-radius:8px; margin-top:10px; max-width:300px;\">\n        Ini adalah isi konten panel yang bisa disembunyikan dan ditampilkan secara mulus!\n    </div>\n\n    <script>\n        $('#btnToggle').click(function() {\n            $('#panel').toggle(300);\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_fade": {
        "title": "jQuery Fade",
        "summary": "Efek memudarkan transparansi elemen: fadeIn(), fadeOut(), fadeToggle(), dan fadeTo().",
        "content": "<p class=\"lead\">Efek fading mengubah nilai opasitas secara bertahap untuk menghasilkan transisi visual yang anggun dan elegan.</p>",
        "example_title": "Contoh Kode jQuery jQuery Fade",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <button id=\"btnFade\" style=\"padding:8px 16px; cursor:pointer;\">Fade Out Box</button>\n    <div id=\"kotakFade\" style=\"width:120px; height:120px; background:#fca311; margin-top:15px; border-radius:8px;\"></div>\n\n    <script>\n        $('#btnFade').click(function() {\n            $('#kotakFade').fadeToggle('slow');\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_slide": {
        "title": "jQuery Slide",
        "summary": "Efek menggeser naik turun (Accordion): slideDown(), slideUp(), dan slideToggle().",
        "content": "<p class=\"lead\">Efek sliding sangat populer untuk membuat menu navigasi dropdown mobile dan komponen tanya-jawab (FAQ Accordion).</p>",
        "example_title": "Contoh Kode jQuery jQuery Slide",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n    <style>\n        .accordion-header { background: #0d2e5c; color: white; padding: 12px; cursor: pointer; border-radius: 6px; }\n        .accordion-content { background: #f1f5f9; padding: 15px; display: none; border-radius: 0 0 6px 6px; }\n    </style>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <div class=\"accordion-header\">Klik untuk Menampilkan Jawaban Pertanyaan &raquo;</div>\n    <div class=\"accordion-content\">Jawaban: jQuery memudahkan manipulasi DOM hanya dalam satu baris kode!</div>\n\n    <script>\n        $('.accordion-header').click(function() {\n            $('.accordion-content').slideToggle();\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_animate": {
        "title": "jQuery Animate",
        "summary": "Menciptakan animasi properti CSS kustom: animate({params}, speed, callback).",
        "content": "<p class=\"lead\">Method <code>animate()</code> memungkinkan Anda menganimasikan nilai numerik CSS seperti width, height, margin, padding, dan left/top.</p>",
        "example_title": "Contoh Kode jQuery jQuery Animate",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <button id=\"btnAnimasi\" style=\"padding:8px 16px; cursor:pointer;\">Mulai Animasi Kotak</button>\n    <div id=\"kotakAnim\" style=\"background:#00758f; width:80px; height:80px; position:relative; margin-top:15px; border-radius:8px;\"></div>\n\n    <script>\n        $('#btnAnimasi').click(function() {\n            $('#kotakAnim').animate({\n                left: '200px',\n                width: '140px',\n                height: '140px',\n                opacity: 0.7\n            }, 800);\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_stop": {
        "title": "jQuery stop()",
        "summary": "Menghentikan animasi yang sedang berjalan sebelum animasi tersebut selesai.",
        "content": "<p class=\"lead\">Method <code>stop()</code> menghentikan antrean efek atau animasi yang sedang diproses pada elemen yang dipilih.</p>",
        "example_title": "Contoh Kode jQuery jQuery stop()",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <button id=\"btnMulai\">Mulai Slide</button>\n    <button id=\"btnStop\" style=\"color:red;\">Hentikan (Stop)</button>\n    <div id=\"panelStop\" style=\"background:#0d2e5c; color:white; height:120px; padding:20px; margin-top:10px; display:none;\">Panel Animasi</div>\n\n    <script>\n        $('#btnMulai').click(function() { $('#panelStop').slideDown(5000); });\n        $('#btnStop').click(function() { $('#panelStop').stop(); });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_callback": {
        "title": "jQuery Callback",
        "summary": "Fungsi Callback yang dieksekusi tepat setelah suatu animasi selesai 100%.",
        "content": "<p class=\"lead\">Karena efek animasi berjalan secara asinkron, fungsi callback menjamin bahwa baris kode berikutnya baru dijalankan setelah animasi benar-benar tuntas.</p>",
        "example_title": "Contoh Kode jQuery jQuery Callback",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <button id=\"btnCb\">Sembunyikan dengan Callback</button>\n    <p id=\"teksCb\">Teks ini akan hilang perlahan.</p>\n\n    <script>\n        $('#btnCb').click(function() {\n            $('#teksCb').hide('slow', function() {\n                alert('Animasi hide telah selesai 100%!');\n            });\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_chaining": {
        "title": "jQuery Chaining",
        "summary": "Menjalankan beberapa aksi beruntun pada elemen yang sama dalam satu pernyataan tunggal.",
        "content": "<p class=\"lead\">Chaining menghemat pemanggilan DOM berkali-kali: <code>$('#p1').css('color', 'red').slideUp(1000).slideDown(1000);</code>.</p>",
        "example_title": "Contoh Kode jQuery jQuery Chaining",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <button id=\"btnChain\">Jalankan Chaining</button>\n    <p id=\"teksChain\" style=\"color:#0d2e5c; font-weight:bold;\">Teks Berantai Efek</p>\n\n    <script>\n        $('#btnChain').click(function() {\n            $('#teksChain').css('color', '#fca311').slideUp(500).slideDown(500);\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      }
    },
    "jQuery HTML": {
      "jq_dom_get": {
        "title": "jQuery Get",
        "summary": "Mengambil konten teks (text()), markup HTML (html()), dan nilai input form (val()).",
        "content": "<p class=\"lead\">Tiga metode inti untuk membaca konten DOM: <code>text()</code> untuk teks murni, <code>html()</code> termasuk tag HTML, dan <code>val()</code> untuk elemen formulir.</p>",
        "example_title": "Contoh Kode jQuery jQuery Get",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <input type=\"text\" id=\"namaInput\" value=\"Faisal Skillance\">\n    <button id=\"btnBaca\">Baca Nilai Input</button>\n\n    <script>\n        $('#btnBaca').click(function() {\n            alert(\"Nilai Input: \" + $('#namaInput').val());\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_dom_set": {
        "title": "jQuery Set",
        "summary": "Mengatur atau memperbarui konten teks, kode HTML, dan nilai formulir input.",
        "content": "<p class=\"lead\">Dengan meneruskan parameter nilai ke dalam <code>text('baru')</code> atau <code>val('baru')</code>, konten elemen langsung diperbarui.</p>",
        "example_title": "Contoh Kode jQuery jQuery Set",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h3 id=\"targetSet\">Teks Lama</h3>\n    <button id=\"btnUbah\">Ubah Jadi HTML Baru</button>\n\n    <script>\n        $('#btnUbah').click(function() {\n            $('#targetSet').html('<span style=\"color:#4ade80;\">Teks Berhasil Diperbarui!</span>');\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_dom_add": {
        "title": "jQuery Add",
        "summary": "Menambahkan elemen HTML baru: append() (di akhir), prepend() (di awal), after(), dan before().",
        "content": "<p class=\"lead\"><code>append()</code> menyisipkan konten di dalam elemen target pada urutan paling akhir, sedangkan <code>prepend()</code> pada urutan paling awal.</p>",
        "example_title": "Contoh Kode jQuery jQuery Add",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <ol id=\"daftarMateri\">\n        <li>HTML5</li>\n        <li>CSS3</li>\n    </ol>\n    <button id=\"btnTambah\">Tambah Item Materi</button>\n\n    <script>\n        $('#btnTambah').click(function() {\n            $('#daftarMateri').append('<li>JavaScript & jQuery</li>');\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_dom_remove": {
        "title": "jQuery Remove",
        "summary": "Menghapus elemen dari dokumen HTML: remove() (menghapus elemen beserta anaknya) dan empty() (mengosongkan anak saja).",
        "content": "<p class=\"lead\">Gunakan <code>empty()</code> jika Anda hanya ingin membersihkan isi kontainer tanpa menghapus kotak kontainer itu sendiri.</p>",
        "example_title": "Contoh Kode jQuery jQuery Remove",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <div id=\"kotakHapus\" style=\"border:1px solid #cbd5e1; padding:15px; margin-bottom:10px;\">\n        <p>Paragraf 1</p>\n        <p>Paragraf 2</p>\n    </div>\n    <button id=\"btnKosongkan\">Kosongkan Isi (empty)</button>\n\n    <script>\n        $('#btnKosongkan').click(function() {\n            $('#kotakHapus').empty();\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_css_classes": {
        "title": "jQuery CSS Classes",
        "summary": "Manipulasi kelas CSS secara dinamis: addClass(), removeClass(), toggleClass(), dan hasClass().",
        "content": "<p class=\"lead\">Memanipulasi kelas CSS jauh lebih rapi daripada mengubah inline-style, menjaga pemisahan yang bersih antara desain dan logika.</p>",
        "example_title": "Contoh Kode jQuery jQuery CSS Classes",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n    <style>\n        .sorot-emas { background-color: #fca311; color: #0d2e5c; padding: 10px; border-radius: 6px; font-weight: bold; }\n    </style>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <p id=\"teksKelas\">Klik tombol untuk menyematkan kelas styling warna emas.</p>\n    <button id=\"btnKelas\">Toggle Class</button>\n\n    <script>\n        $('#btnKelas').click(function() {\n            $('#teksKelas').toggleClass('sorot-emas');\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_css": {
        "title": "jQuery css()",
        "summary": "Membaca atau menetapkan properti CSS langsung pada elemen terpilih.",
        "content": "<p class=\"lead\">Anda dapat menetapkan beberapa properti CSS sekaligus menggunakan sintaks objek JSON: <code>css({'color': 'red', 'font-size': '20px'})</code>.</p>",
        "example_title": "Contoh Kode jQuery jQuery css()",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h3 id=\"judulCss\">Kustomisasi CSS Instan</h3>\n    <button id=\"btnUbahCss\">Ubah Gaya CSS</button>\n\n    <script>\n        $('#btnUbahCss').click(function() {\n            $('#judulCss').css({\n                'color': '#00758f',\n                'font-size': '28px',\n                'border-bottom': '2px solid #00758f'\n            });\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_dimensions": {
        "title": "jQuery Dimensions",
        "summary": "Mengukur dan mengatur dimensi elemen: width(), height(), innerWidth(), outerWidth(), outerHeight(true).",
        "content": "<p class=\"lead\">Memahami perbedaan antara ukuran murni (width), ukuran + padding (innerWidth), dan ukuran + padding + border (outerWidth).</p>",
        "example_title": "Contoh Kode jQuery jQuery Dimensions",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <div id=\"kotakDimensi\" style=\"width:200px; padding:15px; border:5px solid #0d2e5c; background:#e0f2fe;\">\n        Kotak Dimensi\n    </div>\n    <button id=\"btnUkur\" style=\"margin-top:10px;\">Ukur Lebar Elemen</button>\n\n    <script>\n        $('#btnUkur').click(function() {\n            alert(\"Lebar Konten murni: \" + $('#kotakDimensi').width() + \"px\n\" +\n                  \"Lebar Total (outerWidth): \" + $('#kotakDimensi').outerWidth() + \"px\");\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      }
    },
    "jQuery Traversing": {
      "jq_traversing": {
        "title": "jQuery Traversing",
        "summary": "Konsep navigasi penelusuran hierarki pohon DOM: bergerak ke atas, ke bawah, dan ke samping antarelemen.",
        "content": "<p class=\"lead\">Traversing adalah proses berpindah menelusuri elemen HTML berdasarkan relasinya dengan elemen lain dalam silsilah DOM.</p>",
        "example_title": "Contoh Kode jQuery jQuery Traversing",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Pohon DOM Traversing</h2>\n    <p>Hubungan antarelemen: Leluhur (Ancestors), Keturunan (Descendants), dan Saudara Kandung (Siblings).</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_traversing_ancestors": {
        "title": "jQuery Ancestors",
        "summary": "Menelusuri elemen ke atas silsilah hierarki: parent(), parents(), dan parentsUntil().",
        "content": "<p class=\"lead\"><code>parent()</code> mengembalikan satu tingkat elemen induk langsung, sedangkan <code>parents()</code> mengembalikan seluruh silsilah leluhur hingga ke tag &lt;html&gt;.</p>",
        "example_title": "Contoh Kode jQuery jQuery Ancestors",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <div class=\"wadah\" style=\"border:2px solid #cbd5e1; padding:15px;\">\n        <span id=\"anakTeks\">Saya elemen anak di dalam wadah</span>\n    </div>\n    <button id=\"btnParent\" style=\"margin-top:10px;\">Beri Border Merah pada Parent</button>\n\n    <script>\n        $('#btnParent').click(function() {\n            $('#anakTeks').parent().css('border-color', '#ef4444');\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_traversing_descendants": {
        "title": "jQuery Descendants",
        "summary": "Menelusuri elemen ke bawah silsilah: children() dan find().",
        "content": "<p class=\"lead\"><code>children()</code> hanya memeriksa satu tingkat anak langsung, sedangkan <code>find('*')</code> mencari ke seluruh kedalaman keturunan.</p>",
        "example_title": "Contoh Kode jQuery jQuery Descendants",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <ul id=\"menuNav\">\n        <li><span>Beranda</span></li>\n        <li><span>Tutorial</span></li>\n    </ul>\n    <button id=\"btnFind\">Cari Semua Span di Menu</button>\n\n    <script>\n        $('#btnFind').click(function() {\n            $('#menuNav').find('span').css('color', '#00758f');\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_traversing_siblings": {
        "title": "jQuery Siblings",
        "summary": "Menelusuri elemen saudara setingkat: siblings(), next(), nextAll(), prev(), prevAll().",
        "content": "<p class=\"lead\">Elemen saudara kandung (siblings) berbagi elemen induk yang sama pada level hierarki yang setara.</p>",
        "example_title": "Contoh Kode jQuery jQuery Siblings",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <ul>\n        <li>Item 1</li>\n        <li id=\"itemAktif\" style=\"color:blue;\">Item 2 (Aktif)</li>\n        <li>Item 3</li>\n    </ul>\n    <button id=\"btnNext\">Sorot Saudara Berikutnya (next)</button>\n\n    <script>\n        $('#btnNext').click(function() {\n            $('#itemAktif').next().css('font-weight', 'bold');\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_traversing_filtering": {
        "title": "jQuery Filtering",
        "summary": "Menyaring elemen berdasarkan posisi indeks: first(), last(), eq(index), filter(), dan not().",
        "content": "<p class=\"lead\">Method <code>eq(1)</code> memilih elemen pada indeks ke-1 (elemen kedua pada array berbasis nol).</p>",
        "example_title": "Contoh Kode jQuery jQuery Filtering",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <p class=\"intro\">Paragraf 0</p>\n    <p class=\"intro\">Paragraf 1</p>\n    <p class=\"intro\">Paragraf 2</p>\n    <button id=\"btnFilter\">Pilih Paragraf Pertama (first)</button>\n\n    <script>\n        $('#btnFilter').click(function() {\n            $('p.intro').first().css('background-color', '#fca311');\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      }
    },
    "jQuery AJAX": {
      "jq_ajax_intro": {
        "title": "jQuery AJAX Intro",
        "summary": "Pengenalan AJAX di jQuery: Memuat dan memperbarui data dari server di latar belakang tanpa reload.",
        "content": "<p class=\"lead\">jQuery menyediakan rangkaian method AJAX yang kuat dan sangat ringkas untuk mengambil data dari server web.</p>",
        "example_title": "Contoh Kode jQuery jQuery AJAX Intro",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Metode AJAX di jQuery</h2>\n    <p><code>load()</code>, <code>$.get()</code>, <code>$.post()</code>, dan <code>$.ajax()</code>.</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_ajax_load": {
        "title": "jQuery Load",
        "summary": "Memuat data teks atau fragmen HTML dari server dan menempatkannya langsung ke dalam elemen: $(selector).load(URL, data, callback).",
        "content": "<p class=\"lead\">Method <code>load()</code> adalah cara paling sederhana mengambil konten HTML eksternal dari server ke dalam div target.</p>",
        "example_title": "Contoh Kode jQuery jQuery Load",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #4ade80;\">\n    <p>$('#kontenDiv').load('fragmen_berita.html');</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_ajax_get_post": {
        "title": "jQuery Get/Post",
        "summary": "Mengirim permintaan HTTP GET dan POST ke server: $.get(URL, callback) dan $.post(URL, data, callback).",
        "content": "<p class=\"lead\">Method <code>$.post()</code> mengirim data formulir ke endpoint server PHP dan mengeksekusi fungsi balikan setelah server merespons.</p>",
        "example_title": "Contoh Kode jQuery jQuery Get/Post",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: monospace; padding: 20px; background: #1e293b; color: #38bdf8;\">\n    <p>$.post(\"simpan_nilai.php\", { nilai: 95 }, function(data) {<br>\n    &nbsp;&nbsp;alert(\"Respons server: \" + data);<br>\n    });</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      }
    },
    "jQuery Misc": {
      "jq_noconflict": {
        "title": "jQuery noConflict()",
        "summary": "Mencegah konflik simbol tanda dollar ($) saat jQuery digunakan bersama library lain seperti Prototype atau MooTools.",
        "content": "<p class=\"lead\">Method <code>$.noConflict()</code> melepaskan kendali simbol $ sehingga library JavaScript lain dapat menggunakannya tanpa error bentrok.</p>",
        "example_title": "Contoh Kode jQuery jQuery noConflict()",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #fca311;\">\n    <p>const jq = $.noConflict();<br>\n    jq(document).ready(function() {<br>\n    &nbsp;&nbsp;jq(\"#demo\").text(\"Menggunakan alias jq tanpa bentrok $!\");<br>\n    });</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_filters": {
        "title": "jQuery Filters",
        "summary": "Selektor filter semu khusus jQuery: :input, :button, :enabled, :disabled, :checked, :selected.",
        "content": "<p class=\"lead\">Selektor filter jQuery mempermudah inspeksi status elemen interaktif form formulir.</p>",
        "example_title": "Contoh Kode jQuery jQuery Filters",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.7.1.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Filter Status :checked</h2>\n    <p><code>$('input:checked').length</code> menghitung berapa banyak checkbox yang dicentang pengguna.</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      }
    },
    "jQuery Cert": {
      "jq_exam": {
        "title": "jQuery Certificate",
        "summary": "Uji kompetensi dan sertifikasi resmi manipulasi DOM jQuery Skillance Academy.",
        "content": "<p class=\"lead\">Uji pemahaman Anda seputar selektor jQuery, penanganan event klik, animasi efek slide/fade, dan operasi AJAX.</p>",
        "example_title": "Contoh Kode jQuery jQuery Certificate",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 30px; text-align: center;\">\n    <div style=\"border:2px solid #0769ad; padding:30px; border-radius:12px; display:inline-block; max-width:400px;\">\n        <h2 style=\"color:#0d2e5c;\">Ujian Sertifikasi jQuery</h2>\n        <p>Evaluasi 25 soal praktik manipulasi DOM & animasi antarmuka.</p>\n        <button style=\"background:#0769ad; color:white; border:none; padding:12px 24px; border-radius:6px; font-weight:bold; cursor:pointer;\" onclick=\"alert('Ujian Siap Dimulai!')\">Mulai Ujian &raquo;</button>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      }
    },
    "jQuery Examples": {
      "jq_examples": {
        "title": "jQuery Examples",
        "summary": "Koleksi puluhan contoh manipulasi elemen antarmuka siap pakai.",
        "content": "<p class=\"lead\">Koleksi puluhan contoh manipulasi elemen antarmuka siap pakai.</p><p>Pelajari contoh nyata dan latih pemahaman Anda untuk mempercepat pembuatan website interaktif modern.</p>",
        "example_title": "Contoh Kode jQuery jQuery Examples",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>jQuery Examples</h2>\n    <p>Koleksi puluhan contoh manipulasi elemen antarmuka siap pakai.</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_editor": {
        "title": "jQuery Editor",
        "summary": "Code Lab interaktif Skillance Academy untuk menguji skrip animasi jQuery secara langsung.",
        "content": "<p class=\"lead\">Code Lab interaktif Skillance Academy untuk menguji skrip animasi jQuery secara langsung.</p><p>Pelajari contoh nyata dan latih pemahaman Anda untuk mempercepat pembuatan website interaktif modern.</p>",
        "example_title": "Contoh Kode jQuery jQuery Editor",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>jQuery Editor</h2>\n    <p>Code Lab interaktif Skillance Academy untuk menguji skrip animasi jQuery secara langsung.</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_quiz": {
        "title": "jQuery Quiz",
        "summary": "Kuis interaktif pilihan ganda menguji ketangkasan selektor dan method jQuery.",
        "content": "<p class=\"lead\">Kuis interaktif pilihan ganda menguji ketangkasan selektor dan method jQuery.</p><p>Pelajari contoh nyata dan latih pemahaman Anda untuk mempercepat pembuatan website interaktif modern.</p>",
        "example_title": "Contoh Kode jQuery jQuery Quiz",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>jQuery Quiz</h2>\n    <p>Kuis interaktif pilihan ganda menguji ketangkasan selektor dan method jQuery.</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_exercises": {
        "title": "jQuery Exercises",
        "summary": "Latihan terpandu mengisi kode yang hilang pada operasi DOM.",
        "content": "<p class=\"lead\">Latihan terpandu mengisi kode yang hilang pada operasi DOM.</p><p>Pelajari contoh nyata dan latih pemahaman Anda untuk mempercepat pembuatan website interaktif modern.</p>",
        "example_title": "Contoh Kode jQuery jQuery Exercises",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>jQuery Exercises</h2>\n    <p>Latihan terpandu mengisi kode yang hilang pada operasi DOM.</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_syllabus": {
        "title": "jQuery Syllabus",
        "summary": "Silabus kurikulum interaktivitas antarmuka dari pemula hingga profesional.",
        "content": "<p class=\"lead\">Silabus kurikulum interaktivitas antarmuka dari pemula hingga profesional.</p><p>Pelajari contoh nyata dan latih pemahaman Anda untuk mempercepat pembuatan website interaktif modern.</p>",
        "example_title": "Contoh Kode jQuery jQuery Syllabus",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>jQuery Syllabus</h2>\n    <p>Silabus kurikulum interaktivitas antarmuka dari pemula hingga profesional.</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_study_plan": {
        "title": "jQuery Study Plan",
        "summary": "Rencana belajar intensif 7 hari menguasai jQuery dan integrasi API.",
        "content": "<p class=\"lead\">Rencana belajar intensif 7 hari menguasai jQuery dan integrasi API.</p><p>Pelajari contoh nyata dan latih pemahaman Anda untuk mempercepat pembuatan website interaktif modern.</p>",
        "example_title": "Contoh Kode jQuery jQuery Study Plan",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>jQuery Study Plan</h2>\n    <p>Rencana belajar intensif 7 hari menguasai jQuery dan integrasi API.</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      }
    },
    "jQuery References": {
      "jq_ref_overview": {
        "title": "jQuery Overview",
        "summary": "Gambaran komprehensif seluruh arsitektur modul pustaka jQuery.",
        "content": "<p class=\"lead\">Gambaran komprehensif seluruh arsitektur modul pustaka jQuery.</p><p>Gunakan indeks ini sebagai buku saku referensi cepat saat merancang kode JavaScript di Skillance Academy.</p>",
        "example_title": "Contoh Kode jQuery jQuery Overview",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi jQuery Overview</h3>\n    <p>Skillance Academy jQuery Standard 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_ref_selectors": {
        "title": "jQuery Selectors",
        "summary": "Kamus referensi lengkap seluruh selektor elemen, atribut, dan posisi hierarki.",
        "content": "<p class=\"lead\">Kamus referensi lengkap seluruh selektor elemen, atribut, dan posisi hierarki.</p><p>Gunakan indeks ini sebagai buku saku referensi cepat saat merancang kode JavaScript di Skillance Academy.</p>",
        "example_title": "Contoh Kode jQuery jQuery Selectors",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi jQuery Selectors</h3>\n    <p>Skillance Academy jQuery Standard 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_ref_events": {
        "title": "jQuery Events",
        "summary": "Daftar lengkap seluruh method pendengar event aksi mouse, keyboard, dan form.",
        "content": "<p class=\"lead\">Daftar lengkap seluruh method pendengar event aksi mouse, keyboard, dan form.</p><p>Gunakan indeks ini sebagai buku saku referensi cepat saat merancang kode JavaScript di Skillance Academy.</p>",
        "example_title": "Contoh Kode jQuery jQuery Events",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi jQuery Events</h3>\n    <p>Skillance Academy jQuery Standard 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_ref_effects": {
        "title": "jQuery Effects",
        "summary": "Referensi method efek transisi visual: show, hide, toggle, fadeIn, slideDown, animate.",
        "content": "<p class=\"lead\">Referensi method efek transisi visual: show, hide, toggle, fadeIn, slideDown, animate.</p><p>Gunakan indeks ini sebagai buku saku referensi cepat saat merancang kode JavaScript di Skillance Academy.</p>",
        "example_title": "Contoh Kode jQuery jQuery Effects",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi jQuery Effects</h3>\n    <p>Skillance Academy jQuery Standard 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_ref_html": {
        "title": "jQuery HTML/CSS",
        "summary": "Method manipulasi DOM teks, atribut HTML, kelas CSS, dan dimensi kotak.",
        "content": "<p class=\"lead\">Method manipulasi DOM teks, atribut HTML, kelas CSS, dan dimensi kotak.</p><p>Gunakan indeks ini sebagai buku saku referensi cepat saat merancang kode JavaScript di Skillance Academy.</p>",
        "example_title": "Contoh Kode jQuery jQuery HTML/CSS",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi jQuery HTML/CSS</h3>\n    <p>Skillance Academy jQuery Standard 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_ref_traversing": {
        "title": "jQuery Traversing",
        "summary": "Kamus method navigasi pohon hierarki: parent, find, siblings, filter, eq.",
        "content": "<p class=\"lead\">Kamus method navigasi pohon hierarki: parent, find, siblings, filter, eq.</p><p>Gunakan indeks ini sebagai buku saku referensi cepat saat merancang kode JavaScript di Skillance Academy.</p>",
        "example_title": "Contoh Kode jQuery jQuery Traversing",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi jQuery Traversing</h3>\n    <p>Skillance Academy jQuery Standard 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_ref_ajax": {
        "title": "jQuery AJAX",
        "summary": "Referensi lengkap API AJAX: $.ajax(), $.getJSON(), $.getScript(), $.param().",
        "content": "<p class=\"lead\">Referensi lengkap API AJAX: $.ajax(), $.getJSON(), $.getScript(), $.param().</p><p>Gunakan indeks ini sebagai buku saku referensi cepat saat merancang kode JavaScript di Skillance Academy.</p>",
        "example_title": "Contoh Kode jQuery jQuery AJAX",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi jQuery AJAX</h3>\n    <p>Skillance Academy jQuery Standard 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_ref_misc": {
        "title": "jQuery Misc",
        "summary": "Method utilitas bawaan: $.each(), $.extend(), $.trim(), noConflict().",
        "content": "<p class=\"lead\">Method utilitas bawaan: $.each(), $.extend(), $.trim(), noConflict().</p><p>Gunakan indeks ini sebagai buku saku referensi cepat saat merancang kode JavaScript di Skillance Academy.</p>",
        "example_title": "Contoh Kode jQuery jQuery Misc",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi jQuery Misc</h3>\n    <p>Skillance Academy jQuery Standard 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      },
      "jq_ref_prop": {
        "title": "jQuery Properties",
        "summary": "Properti internal jQuery: $.support, $.isReady, $.fx.off.",
        "content": "<p class=\"lead\">Properti internal jQuery: $.support, $.isReady, $.fx.off.</p><p>Gunakan indeks ini sebagai buku saku referensi cepat saat merancang kode JavaScript di Skillance Academy.</p>",
        "example_title": "Contoh Kode jQuery jQuery Properties",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8;\">\n    <h3>// Referensi Resmi jQuery Properties</h3>\n    <p>Skillance Academy jQuery Standard 2026</p>\n</body>\n</html>",
        "explanation": "<p>Uji interaksi jQuery di atas dan amati animasi efek DOM secara langsung.</p>"
      }
    }
  }
}
JSON_DATA
, true);
