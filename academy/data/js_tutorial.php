<?php
/**
 * Silabus Lengkap Tutorial JavaScript - Skillance Academy Indonesia
 * Semua Materi & Contoh Kode Menggunakan Sintaks Modern ECMAScript (ES6+) & Web APIs
 */

return json_decode(<<<'JSON_DATA'
{
  "categories": {
    "JS Tutorial": {
      "js_home": {
        "title": "JS Home",
        "summary": "Selamat Datang di Tutorial JavaScript Skillance Academy. JavaScript adalah bahasa pemrograman paling populer di dunia untuk membuat web interaktif.",
        "content": "<p class=\"lead\">Selamat datang di <strong>Tutorial JavaScript Lengkap</strong> Skillance Academy resmi dari Skillance Academy Indonesia. JavaScript adalah bahasa pemrograman resmi web yang memberikan kehidupan, interaksi, logika perhitungan, dan animasi pada halaman HTML.</p>\n    <div class=\"card bg-light border-0 p-3 mb-4 rounded-3\">\n        <h6 class=\"fw-bold text-navy mb-2\"><i class=\"fa-solid fa-code text-warning me-2\"></i>Peran Utama JavaScript dalam Web Modern:</h6>\n        <ul class=\"mb-0 ps-3 small\" style=\"line-height: 1.8;\">\n            <li><strong>Manipulasi Konten</strong>: Mengubah teks, gambar, dan elemen HTML secara langsung saat pengguna mengklik atau mengetik.</li>\n            <li><strong>Styling Dinamis</strong>: Mengubah warna, ukuran, dan animasi CSS saat ada interaksi pengguna.</li>\n            <li><strong>Komunikasi Server</strong>: Mengambil dan mengirim data ke server di latar belakang (Fetch API / AJAX) tanpa perlu memuat ulang seluruh halaman web.</li>\n        </ul>\n    </div>",
        "example_title": "Contoh Kode JS Home",
        "example_code": "<!DOCTYPE html>\n<html>\n\n<body>\n    <h2 id=\"demo\">Apa yang Bisa Dilakukan JavaScript?</h2>\n        <p>JavaScript dapat memanipulasi konten HTML secara instan!</p>\n        <button onclick=\"ubahTeks()\">Klik Saya &raquo;</button><script>\n        function ubahTeks() {\n            document.getElementById('demo').innerHTML = \"Halo dari JavaScript Skillance Academy! 🚀\";\n            document.getElementById('demo').style.color = \"#04AA6D\";\n        }\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_intro": {
        "title": "JS Introduction",
        "summary": "Pengenalan kapabilitas JavaScript: mengubah konten HTML, nilai atribut, style CSS, dan menyembunyikan/menampilkan elemen.",
        "content": "<p class=\"lead\">JavaScript dapat mengubah nilai atribut HTML seperti <code>src</code> pada gambar, mengubah nilai style seperti <code>display: none</code>, serta memvalidasi data formulir input pengguna.</p>",
        "example_title": "Contoh Kode JS Introduction",
        "example_code": "<!DOCTYPE html>\n<html>\n\n<body>\n    <h2>JavaScript Mengubah Status Elemen</h2>\n    <div id=\"ikonLampu\" class=\"lampu\">💡</div>\n    <button onclick=\"matikanLampu()\">Matikan Lampu</button>\n    <button onclick=\"nyalakanLampu()\">Nyalakan Lampu</button>\n\n    <script>\n        function matikanLampu() {\n            document.getElementById('ikonLampu').style.opacity = \"0.2\";\n            document.getElementById('ikonLampu').style.filter = \"grayscale(100%)\";\n        }\n        function nyalakanLampu() {\n            document.getElementById('ikonLampu').style.opacity = \"1\";\n            document.getElementById('ikonLampu').style.filter = \"none\";\n        }\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_whereto": {
        "title": "JS Where To",
        "summary": "Lokasi penempatan kode JavaScript: di dalam tag <head>, di akhir tag <body>, atau di file eksternal .js.",
        "content": "<p class=\"lead\">Praktik standar industri yang paling disarankan adalah menempatkan skrip JavaScript di bagian bawah sebelum penutup <code>&lt;/body&gt;</code> atau menghubungkan file eksternal <code>&lt;script src=\"app.js\"&gt;&lt;/script&gt;</code> agar render visual halaman tidak terhambat.</p>",
        "example_title": "Contoh Kode JS Where To",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <title>Penempatan JavaScript</title>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h3>Menghubungkan JavaScript Eksternal</h3>\n    <p id=\"hasilLokasi\">Menunggu JavaScript dieksekusi...</p>\n\n    <!-- Skrip di akhir body -->\n    <script>\n        document.getElementById('hasilLokasi').innerText = \"Skrip dieksekusi tepat sebelum penutup tag </body>!\";\n        document.getElementById('hasilLokasi').style.color = \"#04AA6D\";\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_output": {
        "title": "JS Output",
        "summary": "Empat cara menampilkan output di JavaScript: innerHTML, document.write(), window.alert(), dan console.log().",
        "content": "<p class=\"lead\">Untuk berinteraksi dengan antarmuka pengguna, gunakan <code>innerHTML</code> atau <code>textContent</code>. Untuk pengujian internal developer saat debugging, gunakan <code>console.log()</code>.</p>",
        "example_title": "Contoh Kode JS Output",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Metode Output JavaScript</h2>\n    <div id=\"outputArea\" style=\"background:#f1f5f9; padding:15px; border-radius:8px; margin-bottom:15px;\">\n        Area innerHTML\n    </div>\n    <button onclick=\"cetakOutput()\">Jalankan Output</button>\n\n    <script>\n        function cetakOutput() {\n            // 1. innerHTML\n            document.getElementById('outputArea').innerHTML = \"<strong>Output via innerHTML berhasil!</strong>\";\n            // 2. console.log\n            console.log(\"Pesan ini dicetak ke console browser (F12)!\");\n            // 3. window.alert\n            alert(\"Notifikasi alert dari Skillance Academy!\");\n        }\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_syntax": {
        "title": "JS Syntax",
        "summary": "Sintaks dasar JavaScript: literal, variabel (let, const, var), operator aritmatika, ekspresi, dan case sensitivity.",
        "content": "<p class=\"lead\">JavaScript bersifat <strong>Case Sensitive</strong> (huruf besar dan kecil dibedakan). Gunakan <code>const</code> untuk nilai konstan yang tidak berubah dan <code>let</code> untuk variabel yang nilainya akan diperbarui.</p>",
        "example_title": "Contoh Kode JS Syntax",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Sintaks Variabel Modern (let & const)</h2>\n    <p id=\"infoGaji\"></p>\n\n    <script>\n        const nama = \"Faisal\";\n        const ratePerJam = 150000;\n        let jamKerja = 8;\n        let totalFee = ratePerJam * jamKerja;\n\n        document.getElementById('infoGaji').innerHTML = \n            \"Freelancer: <strong>\" + nama + \"</strong><br>\" +\n            \"Total Fee (\" + jamKerja + \" jam): <strong>Rp \" + totalFee.toLocaleString('id-ID') + \"</strong>\";\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_operators": {
        "title": "JS Operators",
        "summary": "Operator JavaScript: Aritmatika (+, -, *, /, %), Penugasan (=, +=), Perbandingan (===, !==, >, <), dan Logika (&&, ||, !).",
        "content": "<p class=\"lead\">Selalu prioritaskan operator kesetaraan ketat <code>===</code> daripada <code>==</code> agar tipe data dan nilai sama-sama dicocokkan secara aman tanpa konversi tipe otomatis yang tidak terduga.</p>",
        "example_title": "Contoh Kode JS Operators",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Operator Aritmatika & Perbandingan</h2>\n    <p id=\"hasilOperator\"></p>\n\n    <script>\n        let harga = 250000;\n        let diskon = 50000;\n        let bayar = harga - diskon;\n        let isDiskonBesar = diskon >= 50000;\n\n        document.getElementById('hasilOperator').innerHTML = \n            \"Harga Akhir: Rp \" + bayar + \"<br>\" +\n            \"Apakah diskon >= Rp 50.000? <strong>\" + (isDiskonBesar ? \"Ya (True)\" : \"Tidak (False)\") + \"</strong>\";\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_if": {
        "title": "JS If Conditions",
        "summary": "Struktur kendali percabangan logika: if, else if, else, switch case, dan operator ternary.",
        "content": "<p class=\"lead\">Percabangan logika memungkinkan program mengambil keputusan berbeda berdasarkan kondisi kebenaran (boolean truthy/falsy).</p>",
        "example_title": "Contoh Kode JS If Conditions",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Penentuan Nilai Mahasiswa</h2>\n    <input type=\"number\" id=\"inputNilai\" placeholder=\"Masukkan nilai (0-100)\" value=\"85\" style=\"padding:8px; width:180px;\">\n    <button onclick=\"cekKelulusan()\" style=\"padding:8px 15px; cursor:pointer;\">Evaluasi</button>\n    <div id=\"hasilEvaluasi\" style=\"margin-top:15px; font-weight:bold;\"><script>\n        function cekKelulusan() {\n            let nilai = parseInt(document.getElementById('inputNilai').value);\n            let grade = \"\";\n            let warna = \"\";\n\n            if (nilai >= 85) {\n                grade = \"A (Sangat Memuaskan)\";\n                warna = \"#04AA6D\";\n            } else if (nilai >= 70) {\n                grade = \"B (Baik)\";\n                warna = \"#0d2e5c\";\n            } else if (nilai >= 55) {\n                grade = \"C (Cukup)\";\n                warna = \"#fca311\";\n            } else {\n                grade = \"D (Mengulang)\";\n                warna = \"#e34f26\";\n            }\n\n            let box = document.getElementById('hasilEvaluasi');\n            box.innerText = \"Hasil Predikat: \" + grade;\n            box.style.color = warna;\n        }\n        cekKelulusan();\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_loops": {
        "title": "JS Loops",
        "summary": "Perulangan kode secara efisien: for, while, do...while, for...in, dan for...of.",
        "content": "<p class=\"lead\">Perulangan mengeksekusi blok kode berulang kali selama kondisi tertentu masih bernilai benar (true).</p>",
        "example_title": "Contoh Kode JS Loops",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Daftar Bahasa Pemrograman (Looping For)</h2>\n    <ul id=\"daftarBahasa\"></ul>\n\n    <script>\n        const bahasa = [\"HTML5\", \"CSS3\", \"JavaScript\", \"PHP & MySQL\", \"Dart (Flutter)\"];\n        let listHtml = \"\";\n\n        for (let i = 0; i < bahasa.length; i++) {\n            listHtml += \"<li>Modul \" + (i + 1) + \": <strong>\" + bahasa[i] + \"</strong></li>\";\n        }\n\n        document.getElementById('daftarBahasa').innerHTML = listHtml;\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_strings": {
        "title": "JS Strings",
        "summary": "Manipulasi teks string: length, slice(), toUpperCase(), replace(), trim(), dan Template Literals (`${...}`).",
        "content": "<p class=\"lead\">Template Literals (menggunakan tanda backtick <code>`</code>) memungkinkan interpolasi variabel langsung <code>${variabel}</code> dan penulisan teks multi-baris tanpa concatenation <code>+</code> yang berantakan.</p>",
        "example_title": "Contoh Kode JS Strings",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Template Literals & String Methods</h2>\n    <p id=\"hasilString\"></p>\n\n    <script>\n        const namaKursus = \"Fullstack Web Developer\";\n        const instruktur = \"Tim Ahli Skillance\";\n        const durasiMinggu = 8;\n\n        // Template Literals modern ES6\n        const kartu = `\n            Kursus: <strong>${namaKursus.toUpperCase()}</strong><br>\n            Instruktur: ${instruktur}<br>\n            Durasi Belajar: ${durasiMinggu} Minggu<br>\n            Jumlah Karakter Judul: ${namaKursus.length} huruf\n        `;\n\n        document.getElementById('hasilString').innerHTML = kartu;\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_numbers": {
        "title": "JS Numbers",
        "summary": "Bekerja dengan angka numerik, desimal floating point, parseInt(), toFixed(), dan nilai NaN.",
        "content": "<p class=\"lead\">Gunakan <code>toFixed(2)</code> untuk membatasi angka desimal mata uang dan <code>Number()</code> atau <code>parseInt()</code> untuk mengonversi string menjadi angka.</p>",
        "example_title": "Contoh Kode JS Numbers",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Operasi Angka Numerik</h2>\n    <p id=\"hasilAngka\"></p>\n\n    <script>\n        let hargaAwal = 199.995;\n        let kursUSD = 16200;\n        let totalRupiah = hargaAwal * kursUSD;\n\n        document.getElementById('hasilAngka').innerHTML = \n            \"Harga USD: $\" + hargaAwal.toFixed(2) + \"<br>\" +\n            \"Total Konversi: Rp \" + Math.round(totalRupiah).toLocaleString('id-ID');\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_functions": {
        "title": "JS Functions",
        "summary": "Mendeklarasikan fungsi dapat digunakan kembali, parameter, return value, dan Arrow Functions (() => {}).",
        "content": "<p class=\"lead\">Fungsi adalah blok kode terorganisir yang dirancang untuk melakukan tugas tertentu dan dapat dipanggil berulang kali dari bagian mana saja.</p>",
        "example_title": "Contoh Kode JS Functions",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Arrow Functions & Parameter</h2>\n    <p id=\"hasilFungsi\"></p>\n\n    <script>\n        // Deklarasi Arrow Function modern\n        const hitungDiskon = (harga, persenDiskon) => {\n            const potong = harga * (persenDiskon / 100);\n            return harga - potong;\n        };\n\n        const hargaBersih = hitungDiskon(500000, 20);\n\n        document.getElementById('hasilFungsi').innerHTML = \n            \"Harga Rp 500.000 Diskon 20% = <strong>Rp \" + hargaBersih.toLocaleString('id-ID') + \"</strong>\";\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_timers": {
        "title": "JS Timers",
        "summary": "Penjadwalan eksekusi kode dengan setTimeout() dan interval berulang setInterval().",
        "content": "<p class=\"lead\">Fungsi <code>setTimeout()</code> menunda eksekusi kode satu kali setelah durasi milidetik tertentu, sedangkan <code>setInterval()</code> menjalankannya berulang kali.</p>",
        "example_title": "Contoh Kode JS Timers",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px; text-align: center;\">\n    <h2>Jam Digital Realtime</h2>\n    <div id=\"jam\" style=\"font-size: 32px; font-weight: bold; color: #0d2e5c; padding: 15px; background: #e0f2fe; border-radius: 8px; display: inline-block;\">00:00:00<script>\n        function perbaruiJam() {\n            const d = new Date();\n            document.getElementById('jam').innerText = d.toLocaleTimeString('id-ID');\n        }\n        // Jalankan setiap 1 detik (1000ms)\n        setInterval(perbaruiJam, 1000);\n        perbaruiJam();\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_objects": {
        "title": "JS Objects",
        "summary": "Menyimpan sekumpulan data terstruktur dalam pasangan properti key-value dan fungsi method.",
        "content": "<p class=\"lead\">Objek JavaScript adalah entitas nyata yang memiliki properti (ciri/data) dan method (kemampuan/fungsi aksi).</p>",
        "example_title": "Contoh Kode JS Objects",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Objek Profil Pengguna</h2>\n    <div id=\"profilPengguna\"><script>\n        const mahasiswa = {\n            nama: \"Andi Saputra\",\n            nim: \"210401050\",\n            jurusan: \"Teknik Informatika\",\n            kampus: \"USN Kolaka\",\n            getStatus: function() {\n                return this.nama + \" (\" + this.nim + \") - \" + this.jurusan;\n            }\n        };\n\n        document.getElementById('profilPengguna').innerHTML = \n            \"Mahasiswa: <strong>\" + mahasiswa.getStatus() + \"</strong><br>\" +\n            \"Perguruan Tinggi: \" + mahasiswa.kampus;\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_scope": {
        "title": "JS Scope",
        "summary": "Memahami ruang lingkup variabel: Global Scope, Function Scope, dan Block Scope (let/const).",
        "content": "<p class=\"lead\">Variabel yang dideklarasikan dengan <code>let</code> atau <code>const</code> di dalam kurung kurawal <code>{}</code> bersifat Block Scope dan tidak dapat diakses dari luar kurung tersebut.</p>",
        "example_title": "Contoh Kode JS Scope",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Demonstrasi Block Scope</h2>\n    <p id=\"hasilScope\"></p>\n\n    <script>\n        let pesanGlobal = \"Saya variabel global!\";\n\n        {\n            let pesanBlok = \"Saya hanya hidup di dalam blok kurung kurawal ini!\";\n            // pesanBlok dapat diakses di sini\n        }\n\n        // pesanBlok tidak dapat diakses di luar sini (akan error jika dipanggil)\n        document.getElementById('hasilScope').innerText = pesanGlobal;\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_dates": {
        "title": "JS Dates",
        "summary": "Manipulasi objek tanggal dan waktu: new Date(), getFullYear(), getMonth(), dan format lokal Indonesia.",
        "content": "<p class=\"lead\">Objek <code>Date</code> menangani perhitungan tanggal, tahun kabisat, zona waktu UTC, dan penanggalan internasional.</p>",
        "example_title": "Contoh Kode JS Dates",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Format Tanggal Bahasa Indonesia</h2>\n    <p id=\"tglSekarang\" style=\"font-size: 18px; font-weight: bold; color: #0d2e5c;\"></p>\n\n    <script>\n        const sekarang = new Date();\n        const opsi = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };\n        document.getElementById('tglSekarang').innerText = sekarang.toLocaleDateString('id-ID', opsi);\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_arrays": {
        "title": "JS Arrays",
        "summary": "Menyimpan kumpulan item berurutan: push(), pop(), shift(), unshift(), slice(), splice(), dan pengindeksan array.",
        "content": "<p class=\"lead\">Array adalah variabel khusus yang dapat menampung lebih dari satu nilai sekaligus di bawah satu nama variabel tunggal.</p>",
        "example_title": "Contoh Kode JS Arrays",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Operasi Manipulasi Array</h2>\n    <p id=\"isiArray\"></p>\n\n    <script>\n        let materi = [\"HTML\", \"CSS\"];\n        materi.push(\"JavaScript\"); // Menambah di akhir\n        materi.push(\"PHP & MySQL\");\n\n        document.getElementById('isiArray').innerHTML = \n            \"Total Materi: <strong>\" + materi.length + \"</strong><br>\" +\n            \"Daftar: \" + materi.join(\" &bull; \");\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_sets": {
        "title": "JS Sets",
        "summary": "Koleksi nilai unik tanpa duplikasi: Set, add(), has(), delete(), dan size.",
        "content": "<p class=\"lead\">Objek <code>Set</code> adalah kumpulan nilai di mana setiap elemen hanya boleh muncul satu kali (secara otomatis membuang duplikat).</p>",
        "example_title": "Contoh Kode JS Sets",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Membersihkan Nilai Duplikat dengan Set</h2>\n    <p id=\"hasilSet\"></p>\n\n    <script>\n        const daftarKota = [\"Kolaka\", \"Kendari\", \"Kolaka\", \"Makassar\", \"Kendari\"];\n        const kotaUnik = new Set(daftarKota);\n\n        document.getElementById('hasilSet').innerHTML = \n            \"Array Asli (5 item): \" + daftarKota.join(\", \") + \"<br>\" +\n            \"Set Unik (\" + kotaUnik.size + \" item): <strong>\" + Array.from(kotaUnik).join(\", \") + \"</strong>\";\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_maps": {
        "title": "JS Maps",
        "summary": "Struktur data berpasangan key-value yang mempertahankan urutan penyisipan: Map, set(), get(), has().",
        "content": "<p class=\"lead\">Tidak seperti Objek biasa di mana key harus berupa string, <code>Map</code> dapat menggunakan objek, fungsi, atau tipe data apa pun sebagai kunci (key).</p>",
        "example_title": "Contoh Kode JS Maps",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Penggunaan JavaScript Map</h2>\n    <p id=\"hasilMap\"></p>\n\n    <script>\n        const kursus = new Map();\n        kursus.set(\"html\", { nama: \"HTML Dasar\", modul: 90 });\n        kursus.set(\"css\", { nama: \"CSS Lengkap\", modul: 125 });\n\n        const info = kursus.get(\"css\");\n        document.getElementById('hasilMap').innerHTML = \n            \"Modul: <strong>\" + info.nama + \"</strong> (\" + info.modul + \" topik)\";\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_looping": {
        "title": "JS Iterations",
        "summary": "Metode iterasi array modern berparadigma fungsional: forEach(), map(), filter(), dan reduce().",
        "content": "<p class=\"lead\">Metode <code>map()</code> membuat array baru dengan mentransformasi setiap elemen, sedangkan <code>filter()</code> menyaring data berdasarkan kondisi tertentu.</p>",
        "example_title": "Contoh Kode JS Iterations",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Menyaring Data dengan filter() & map()</h2>\n    <ul id=\"daftarLulus\"></ul>\n\n    <script>\n        const nilaiSiswa = [\n            { nama: \"Budi\", skor: 85 },\n            { nama: \"Siti\", skor: 60 },\n            { nama: \"Rian\", skor: 90 },\n            { nama: \"Dewi\", skor: 65 }\n        ];\n\n        // Saring yang memiliki skor >= 70\n        const yangLulus = nilaiSiswa.filter(s => s.skor >= 70);\n\n        let html = \"\";\n        yangLulus.forEach(s => {\n            html += \"<li>\" + s.nama + \" - Skor: <strong>\" + s.skor + \"</strong> (LULUS)</li>\";\n        });\n\n        document.getElementById('daftarLulus').innerHTML = html;\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_math": {
        "title": "JS Math",
        "summary": "Objek matematika bawaan: Math.round(), Math.floor(), Math.ceil(), Math.random(), Math.max(), dan Math.min().",
        "content": "<p class=\"lead\">Objek <code>Math</code> menyediakan konstanta dan fungsi perhitungan matematis tanpa perlu diinisialisasi dengan kata kunci new.</p>",
        "example_title": "Contoh Kode JS Math",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Generator Angka Acak (Random Number)</h2>\n    <button onclick=\"acakAngka()\" style=\"padding:10px 20px; font-weight:bold; cursor:pointer;\">Acak Dadu (1-6)</button>\n    <div id=\"angkaDadu\" style=\"font-size:36px; font-weight:bold; color:#0d2e5c; margin-top:15px;\">?<script>\n        function acakAngka() {\n            // Menghasilkan bilangan bulat acak antara 1 sampai 6\n            const dadu = Math.floor(Math.random() * 6) + 1;\n            document.getElementById('angkaDadu').innerText = \"🎲 \" + dadu;\n        }\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_regexp": {
        "title": "JS RegExp",
        "summary": "Pencocokan pola ekspresi reguler (Regular Expressions) untuk validasi format email, nomor HP, dan penggantian teks.",
        "content": "<p class=\"lead\">RegExp digunakan untuk memvalidasi apakah input pengguna cocok dengan pola tertentu, misalnya format alamat email yang sah.</p>",
        "example_title": "Contoh Kode JS RegExp",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Validasi Format Email Sederhana</h2>\n    <input type=\"text\" id=\"emailInput\" value=\"user@skillance.cloud\" style=\"padding:8px; width:220px;\">\n    <button onclick=\"validasi()\" style=\"padding:8px 15px; cursor:pointer;\">Validasi</button>\n    <p id=\"hasilValidasi\"></p>\n\n    <script>\n        function validasi() {\n            const email = document.getElementById('emailInput').value;\n            // Pola regex sederhana: karakter + @ + domain + .ekstensi\n            const polaEmail = /^[^\\s@]+@[^\\s@]+\\.[^\\s@]+$/;\n            const valid = polaEmail.test(email);\n\n            const out = document.getElementById('hasilValidasi');\n            out.innerHTML = valid ? \"<span style='color:green;'>Format Email Valid!</span>\" : \"<span style='color:red;'>Format Email Tidak Sah!</span>\";\n        }\n        validasi();\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_datatypes": {
        "title": "JS Data Types",
        "summary": "Tipe data primitif (String, Number, BigInt, Boolean, Undefined, Null, Symbol) dan tipe data kompleks (Object, Array).",
        "content": "<p class=\"lead\">Gunakan operator <code>typeof</code> untuk memeriksa jenis tipe data dari variabel mana saja secara instan.</p>",
        "example_title": "Contoh Kode JS Data Types",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Pemeriksaan Tipe Data (typeof)</h2>\n    <pre id=\"hasilTypeof\" style=\"background:#1e293b; color:#38bdf8; padding:15px; border-radius:8px;\"></pre>\n\n    <script>\n        const teks = typeof \"Halo\";\n        const angka = typeof 12345;\n        const boolean = typeof true;\n        const objek = typeof { id: 1 };\n        const takTerdefinisi = typeof belumDiisi;\n\n        document.getElementById('hasilTypeof').innerText = \n            'typeof \"Halo\"       -> ' + teks + '\n' +\n            'typeof 12345        -> ' + angka + '\n' +\n            'typeof true         -> ' + boolean + '\n' +\n            'typeof { id: 1 }    -> ' + objek + '\n' +\n            'typeof takTerdefinisi -> ' + takTerdefinisi;\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_errors_intro": {
        "title": "JS Errors",
        "summary": "Penanganan kesalahan runtime secara aman menggunakan blok try, catch, finally, dan throw.",
        "content": "<p class=\"lead\">Blok <code>try...catch</code> mencegah aplikasi website Anda crash atau berhenti berjalan secara mendadak saat terjadi error pada proses pembacaan data.</p>",
        "example_title": "Contoh Kode JS Errors",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Penanganan Kesalahan (try...catch)</h2>\n    <p id=\"pesanError\"></p>\n\n    <script>\n        try {\n            // Mencoba memanggil fungsi yang sengaja tidak didefinisikan\n            fungsiYangTidakAda();\n        } catch (err) {\n            document.getElementById('pesanError').innerHTML = \n                \"<span style='color:#e34f26;'><strong>Tertangkap Error Aman:</strong> \" + err.message + \"</span><br><small>Aplikasi tetap berjalan normal tanpa crash!</small>\";\n        }\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_debugging": {
        "title": "JS Debugging",
        "summary": "Teknik melacak dan memperbaiki bug kode dengan Developer Tools (F12) dan kata kunci debugger.",
        "content": "<p class=\"lead\">Menaruh kata kunci <code>debugger;</code> di dalam skrip akan menghentikan eksekusi kode di breakpoint tersebut saat DevTools dibuka untuk memeriksa nilai variabel saat itu juga.</p>",
        "example_title": "Contoh Kode JS Debugging",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Debugging dengan console.table()</h2>\n    <p>Buka Console DevTools (F12) untuk melihat data tersusun rapi dalam bentuk tabel!</p>\n\n    <script>\n        const anggota = [\n            { id: 1, nama: \"Ahmad\", peran: \"Frontend\" },\n            { id: 2, nama: \"Nurul\", peran: \"Backend\" },\n            { id: 3, nama: \"Fikri\", peran: \"Mobile Dev\" }\n        ];\n        console.table(anggota);\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_conventions": {
        "title": "JS Style Guide",
        "summary": "Standar konvensi penulisan kode JavaScript bersih: camelCase, const/let, indentasi 2 spasi, dan penamaan variabel.",
        "content": "<p class=\"lead\">Gunakan standar penamaan camelCase untuk variabel/fungsi (contoh: <code>hitungTotalHarga</code>) dan PascalCase untuk kelas (contoh: <code>UserAccount</code>).</p>",
        "example_title": "Contoh Kode JS Style Guide",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Pedoman Kode Bersih (Clean Code)</h2>\n    <p id=\"infoPedoman\"></p>\n\n    <script>\n        // Contoh kode yang mematuhi Clean Code Guide\n        const MAKS_PERCOBAAN = 3;\n        let hitunganSaatIni = 1;\n\n        function periksaBatasLogin(percobaan) {\n            return percobaan <= MAKS_PERCOBAAN;\n        }\n\n        document.getElementById('infoPedoman').innerText = \n            \"Boleh lanjut login? \" + (periksaBatasLogin(hitunganSaatIni) ? \"Ya, kuota masih ada.\" : \"Terkunci!\");\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_alphabetic_reference": {
        "title": "JS Reference",
        "summary": "Referensi alfabetis lengkap seluruh objek bawaan, fungsi global, dan properti JavaScript.",
        "content": "<p class=\"lead\">Kamus referensi cepat seluruh method dan properti standar ECMAScript modern.</p>",
        "example_title": "Contoh Kode JS Reference",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h3>Daftar Objek Global Inti</h3>\n    <p><code>Array</code>, <code>Object</code>, <code>String</code>, <code>Number</code>, <code>Boolean</code>, <code>Date</code>, <code>Math</code>, <code>JSON</code>, <code>Promise</code>.</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_project_counter": {
        "title": "JS Projects New",
        "summary": "Membangun proyek interaktif mini: Penghitung Angka (Interactive Click Counter).",
        "content": "<p class=\"lead\">Proyek praktis untuk mengasah pemahaman state variabel, event listener klik, dan pembaruan DOM secara real-time.</p>",
        "example_title": "Contoh Kode JS Projects New",
        "example_code": "<!DOCTYPE html>\n<html>\n\n<body>\n    <div class=\"counter-card\">\n        <h3>Proyek: Interactive Counter</h3>\n        <div id=\"nilaiHitung\" class=\"angka\">0</div>\n        <div>\n            <button class=\"btn btn-minus\" onclick=\"ubah(-1)\">- Kurang</button>\n            <button class=\"btn btn-reset\" onclick=\"reset()\">Reset</button>\n            <button class=\"btn btn-plus\" onclick=\"ubah(1)\">+ Tambah</button>\n        </div><script>\n        let counter = 0;\n        function ubah(delta) {\n            counter += delta;\n            document.getElementById('nilaiHitung').innerText = counter;\n        }\n        function reset() {\n            counter = 0;\n            document.getElementById('nilaiHitung').innerText = counter;\n        }\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_2027": {
        "title": "JS Versions",
        "summary": "Evolusi standar ECMAScript dari ES6 (2015) hingga fitur-fitur mutakhir JavaScript modern saat ini.",
        "content": "<p class=\"lead\">ECMAScript merilis spesifikasi standar baru setiap tahun, memperkenalkan fitur seperti Optional Chaining (<code>?.</code>), Nullish Coalescing (<code>??</code>), dan BigInt.</p>",
        "example_title": "Contoh Kode JS Versions",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Fitur Modern: Optional Chaining (?.)</h2>\n    <p id=\"hasilFitur\"></p>\n\n    <script>\n        const profil = {\n            nama: \"Fajar\",\n            kontak: {\n                email: \"fajar@skillance.cloud\"\n            }\n        };\n\n        // Mengakses properti bersarang tanpa takut error \"Cannot read property of undefined\"\n        const telepon = profil.kontak?.telepon ?? \"Nomor HP Belum Diisi\";\n\n        document.getElementById('hasilFitur').innerHTML = \n            \"Nama: \" + profil.nama + \"<br>\" +\n            \"Telepon: <strong>\" + telepon + \"</strong>\";\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_htmldom": {
        "title": "JS HTML DOM",
        "summary": "Memahami Document Object Model (DOM) untuk membaca dan memanipulasi elemen HTML sebagai pohon objek.",
        "content": "<p class=\"lead\">Saat halaman web dimuat, browser membuat Document Object Model (DOM). Dengan metode seperti <code>querySelector()</code> dan <code>getElementById()</code>, kita dapat memprogram elemen apa pun.</p>",
        "example_title": "Contoh Kode JS HTML DOM",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2 class=\"target-judul\">Memanipulasi Elemen via DOM</h2>\n    <p class=\"deskripsi\">Teks ini akan diubah oleh JavaScript menggunakan querySelector.</p>\n    <button onclick=\"manipulasiDOM()\" style=\"padding:10px 15px; cursor:pointer;\">Ubah Sekarang</button>\n\n    <script>\n        function manipulasiDOM() {\n            const judul = document.querySelector('.target-judul');\n            const p = document.querySelector('.deskripsi');\n\n            judul.innerText = \"DOM Berhasil Diubah!\";\n            judul.style.color = \"#04AA6D\";\n            p.innerText = \"Kelas CSS dan style warna telah dimodifikasi secara dinamis!\";\n        }\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_events": {
        "title": "JS HTML Events",
        "summary": "Menangani interaksi pengguna: click, change, submit, keyup, mouseover, dan addEventListener().",
        "content": "<p class=\"lead\">Metode <code>addEventListener()</code> memungkinkan Anda menyematkan fungsi pendengar aksi pengguna tanpa mencemari kode HTML dengan atribut onclick.</p>",
        "example_title": "Contoh Kode JS HTML Events",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Deteksi Ketikan Real-Time (Event keyup)</h2>\n    <input type=\"text\" id=\"kotakKetik\" placeholder=\"Ketik sesuatu di sini...\" style=\"padding:10px; width:280px; border-radius:6px; border:1px solid #cbd5e1;\">\n    <p>Hasil ketikan Anda: <strong id=\"tampilanKetik\" style=\"color:#0d2e5c;\"></strong></p>\n\n    <script>\n        const input = document.getElementById('kotakKetik');\n        const view = document.getElementById('tampilanKetik');\n\n        input.addEventListener('input', function(e) {\n            view.innerText = e.target.value;\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_htmlfirst": {
        "title": "JS HTML First",
        "summary": "Filosofi HTML-First: Membangun struktur semantik HTML yang kuat dan kokoh sebelum menambahkan lapisan interaktivitas JavaScript.",
        "content": "<p class=\"lead\">Pendekatan HTML-First memastikan halaman website tetap dapat diakses, cepat dimuat, ramah SEO, dan berfungsi dengan baik sebelum skrip JavaScript selesai diunduh.</p>",
        "example_title": "Contoh Kode JS HTML First",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h3>Formulir Semantik HTML-First</h3>\n    <form onsubmit=\"event.preventDefault(); alert('Formulir berhasil diproses secara aman!');\">\n        <label for=\"username\">Nama Pengguna (Wajib):</label><br>\n        <input type=\"text\" id=\"username\" required style=\"padding:8px; margin:8px 0; width:220px;\"><br>\n        <button type=\"submit\" style=\"padding:8px 16px; background:#0d2e5c; color:white; border:none; border-radius:4px; cursor:pointer;\">Kirim Formulir</button>\n    </form>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      }
    },
    "JS Web API": {
      "js_window": {
        "title": "JS Window API",
        "summary": "Bekerja dengan objek global Window, lokasi URL (window.location), dan ukuran layar (window.innerWidth).",
        "content": "<p class=\"lead\">Objek <code>window</code> merepresentasikan jendela browser terbuka tempat seluruh variabel global dan fungsi JavaScript hidup.</p>",
        "example_title": "Contoh Kode JS Window API",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Informasi Jendela Browser</h2>\n    <p id=\"infoLayar\"></p>\n\n    <script>\n        document.getElementById('infoLayar').innerHTML = \n            \"Lebar Layar Browser: <strong>\" + window.innerWidth + \" px</strong><br>\" +\n            \"Tinggi Layar Browser: <strong>\" + window.innerHeight + \" px</strong><br>\" +\n            \"Alamat URL Saat Ini: <small>\" + window.location.href + \"</small>\";\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_api_fetch": {
        "title": "JS Fetch API",
        "summary": "Mengambil dan mengirim data JSON dari server API secara asinkron tanpa reload menggunakan fetch().",
        "content": "<p class=\"lead\">Fetch API modern menggunakan struktur <code>Promise</code> atau <code>async/await</code> untuk komunikasi data jaringan yang bersih dan elegan.</p>",
        "example_title": "Contoh Kode JS Fetch API",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Mengambil Data API Publik</h2>\n    <button onclick=\"ambilData()\" style=\"padding:10px 18px; font-weight:bold; cursor:pointer;\">Tarik Data Pengguna &raquo;</button>\n    <div id=\"hasilFetch\" style=\"margin-top:15px; background:#f8fafc; padding:15px; border-radius:8px; border:1px solid #e2e8f0;\">Menunggu tombol diklik...<script>\n        async function ambilData() {\n            const out = document.getElementById('hasilFetch');\n            out.innerText = \"Memuat data dari server...\";\n            try {\n                const respon = await fetch('https://jsonplaceholder.typicode.com/users/1');\n                const user = await respon.json();\n                out.innerHTML = \n                    \"Nama: <strong>\" + user.name + \"</strong><br>\" +\n                    \"Email: \" + user.email + \"<br>\" +\n                    \"Kota: \" + user.address.city;\n            } catch (err) {\n                out.innerText = \"Gagal memuat API: \" + err.message;\n            }\n        }\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_json": {
        "title": "JS JSON",
        "summary": "Format pertukaran data JSON (JavaScript Object Notation): JSON.stringify() dan JSON.parse().",
        "content": "<p class=\"lead\">JSON adalah format teks universal pertukaran data antar bahasa pemrograman (seperti PHP dan JavaScript). Gunakan <code>JSON.parse()</code> untuk mengubah teks JSON menjadi Objek JS, dan <code>JSON.stringify()</code> untuk sebaliknya.</p>",
        "example_title": "Contoh Kode JS JSON",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Serialisasi JSON</h2>\n    <p id=\"hasilJson\"></p>\n\n    <script>\n        // Objek JS\n        const dataKelas = { judul: \"Belajar JavaScript Skillance Academy\", modul: 49, aktif: true };\n\n        // Ubah menjadi teks string JSON\n        const jsonTeks = JSON.stringify(dataKelas);\n\n        // Ubah kembali string menjadi Objek JS\n        const dataHasil = JSON.parse(jsonTeks);\n\n        document.getElementById('hasilJson').innerHTML = \n            \"String JSON Mentah: <code>\" + jsonTeks + \"</code><br><br>\" +\n            \"Dibaca Kembali Sebagai Objek: <strong>\" + dataHasil.judul + \"</strong>\";\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_api_intro": {
        "title": "JS Web API",
        "summary": "Pengenalan ekosistem Web APIs peramban: Geolocation, Web Storage (localStorage), dan Clipboard API.",
        "content": "<p class=\"lead\">Web APIs adalah kemampuan bawaan peramban yang memperluas fungsionalitas JavaScript standar untuk mengakses hardware, lokasi GPS, dan penyimpanan data lokal.</p>",
        "example_title": "Contoh Kode JS Web API",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Penyimpanan Data Lokal (localStorage)</h2>\n    <input type=\"text\" id=\"inputCatatan\" placeholder=\"Tulis catatan...\" style=\"padding:8px; width:200px;\">\n    <button onclick=\"simpanCatatan()\" style=\"padding:8px 12px; cursor:pointer;\">Simpan</button>\n    <p>Catatan tersimpan: <strong id=\"catatanTersimpan\" style=\"color:#04AA6D;\"></strong></p>\n\n    <script>\n        function simpanCatatan() {\n            const isi = document.getElementById('inputCatatan').value;\n            localStorage.setItem('skillance_note', isi);\n            muatCatatan();\n        }\n        function muatCatatan() {\n            const data = localStorage.getItem('skillance_note') || \"(Belum ada catatan)\";\n            document.getElementById('catatanTersimpan').innerText = data;\n        }\n        muatCatatan();\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      }
    },
    "JS Advanced": {
      "js_temporal": {
        "title": "JS Temporal New",
        "summary": "Pengenalan API Temporal baru untuk penanganan tanggal dan waktu modern yang kebal bug zona waktu.",
        "content": "<p class=\"lead\">Temporal API adalah pengganti modern objek <code>Date</code> lawas di JavaScript yang memperbaiki kelemahan penanganan zona waktu, kalender, dan operasi durasi waktu.</p>",
        "example_title": "Contoh Kode JS Temporal New",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Temporal API (Standar Baru Waktu)</h2>\n    <p>Temporal menyediakan manipulasi waktu yang aman dari bug zona waktu DST (Daylight Saving Time).</p>\n    <div style=\"background:#e0f2fe; padding:15px; border-radius:8px;\">\n        Contoh sintaks Temporal:<br>\n        <code>const sekarang = Temporal.Now.instant();</code>\n    </div>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_function_advanced": {
        "title": "JS Functions Advanced",
        "summary": "Konsep fungsi tingkat lanjut: Closures, Callback Functions, Rest Parameters (...args), dan Rekursi.",
        "content": "<p class=\"lead\">Closure adalah fungsi yang mampu 'mengingat' dan mengakses variabel dari lingkungan lingkup leksikal induknya meskipun fungsi induk tersebut telah selesai dieksekusi.</p>",
        "example_title": "Contoh Kode JS Functions Advanced",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Mekanisme Closure</h2>\n    <button onclick=\"tambahHitungan()\" style=\"padding:10px 15px; cursor:pointer;\">Klik Tambah State</button>\n    <p>Nilai state di dalam closure: <strong id=\"outClosure\">0</strong></p>\n\n    <script>\n        // Membuat fungsi pencacah dengan Closure\n        const buatPenghitung = () => {\n            let count = 0; // Variabel privat\n            return () => {\n                count++;\n                return count;\n            };\n        };\n\n        const counterPrivat = buatPenghitung();\n\n        function tambahHitungan() {\n            document.getElementById('outClosure').innerText = counterPrivat();\n        }\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_object_advanced": {
        "title": "JS Objects Advanced",
        "summary": "Konsep objek tingkat lanjut: Object Destructuring, Spread Operator ({...obj}), dan Prototype Inheritance.",
        "content": "<p class=\"lead\">Destructuring memungkinkan pembongkaran nilai dari properti objek menjadi variabel yang berbeda secara ringkas dan rapi.</p>",
        "example_title": "Contoh Kode JS Objects Advanced",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Object Destructuring & Spread Operator</h2>\n    <p id=\"hasilDestruct\"></p>\n\n    <script>\n        const mentor = { id: 101, nama: \"Budi Santoso\", spesialis: \"Backend Node.js\" };\n\n        // Destructuring\n        const { nama, spesialis } = mentor;\n\n        // Spread operator menggabungkan objek\n        const profilLengkap = { ...mentor, lokasi: \"Sulawesi Tenggara\", status: \"Aktif\" };\n\n        document.getElementById('hasilDestruct').innerHTML = \n            \"Nama Mentor: <strong>\" + nama + \"</strong><br>\" +\n            \"Keahlian: \" + spesialis + \"<br>\" +\n            \"Lokasi: \" + profilLengkap.lokasi;\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_classes": {
        "title": "JS Classes",
        "summary": "Pemrograman Berorientasi Objek (OOP) dengan Class: constructor(), inheritance extends, dan method statis.",
        "content": "<p class=\"lead\">Class di JavaScript menyediakan sintaks berorientasi objek yang bersih untuk membuat cetak biru (blueprint) pembuatan banyak instance objek serupa.</p>",
        "example_title": "Contoh Kode JS Classes",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>OOP dengan JavaScript Class</h2>\n    <p id=\"hasilClass\"></p>\n\n    <script>\n        class Kursus {\n            constructor(nama, kategori) {\n                this.nama = nama;\n                this.kategori = kategori;\n            }\n            getDeskripsi() {\n                return `Kursus ${this.nama} (Kategori: ${this.kategori})`;\n            }\n        }\n\n        const kelasJs = new Kursus(\"JavaScript Interaktif\", \"Web Development\");\n        document.getElementById('hasilClass').innerText = kelasJs.getDeskripsi();\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_asynchronous": {
        "title": "JS Asynchronous",
        "summary": "Pemrograman Asinkron: Memahami Promises, async/await, dan Event Loop dalam penanganan operasi I/O.",
        "content": "<p class=\"lead\">Struktur <code>async/await</code> memungkinkan kita menulis kode asinkron yang tampak dan mudah dibaca layaknya kode sinkron prosedural.</p>",
        "example_title": "Contoh Kode JS Asynchronous",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Asinkron dengan async/await</h2>\n    <p id=\"statusAsync\">Menunggu simulasi unduh data...</p>\n\n    <script>\n        const jedaWaktu = (ms) => new Promise(resolve => setTimeout(resolve, ms));\n\n        async function jalankanProses() {\n            await jedaWaktu(1500); // Simulasi request 1.5 detik\n            document.getElementById('statusAsync').innerHTML = \n                \"<span style='color:#04AA6D; font-weight:bold;'>Data Selesai Dimuat Melalui Promise!</span>\";\n        }\n\n        jalankanProses();\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_modules": {
        "title": "JS Modules",
        "summary": "Modularitas kode terpisah menggunakan pernyataan export dan import (ES Modules).",
        "content": "<p class=\"lead\">ES Modules memungkinkan Anda membagi kode JavaScript yang besar menjadi file-file kecil yang terpisah dan rapi, lalu mengimpor fungsionalitas yang diperlukan saja.</p>",
        "example_title": "Contoh Kode JS Modules",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Struktur Modul ES6 (export & import)</h2>\n    <pre style=\"background:#1e293b; color:#38bdf8; padding:15px; border-radius:8px;\">\n// file: matematika.js\nexport const pi = 3.14159;\nexport function tambah(a, b) { return a + b; }\n\n// file: main.js\nimport { pi, tambah } from './matematika.js';\nconsole.log(tambah(5, 10)); // 15\n    </pre>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_meta_programming": {
        "title": "JS Meta & Proxy",
        "summary": "Meta-programming dengan Objek Proxy dan Reflect untuk mencegat serta mengkustomisasi perilaku objek dasar.",
        "content": "<p class=\"lead\">Objek <code>Proxy</code> digunakan untuk membungkus objek target dan mencegat operasi dasar seperti pembacaan properti (get) dan pengisian nilai (set) untuk validasi otomatis.</p>",
        "example_title": "Contoh Kode JS Meta & Proxy",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Pencegatan Properti dengan Proxy</h2>\n    <p id=\"hasilProxy\"></p>\n\n    <script>\n        const penggunaAsli = { nama: \"Rizky\", usia: 20 };\n\n        // Proxy handler\n        const pengawas = {\n            get: function(target, properti) {\n                return properti in target ? target[properti] : \"(Data Tidak Tersedia)\";\n            }\n        };\n\n        const userTerlindungi = new Proxy(penggunaAsli, pengawas);\n\n        document.getElementById('hasilProxy').innerHTML = \n            \"Nama: \" + userTerlindungi.nama + \"<br>\" +\n            \"Alamat: \" + userTerlindungi.alamat; // Dicegat oleh proxy\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_typed_arrays": {
        "title": "JS Typed Arrays",
        "summary": "Mengelola data biner mentah dalam memori performa tinggi: Int8Array, Uint8Array, Float64Array.",
        "content": "<p class=\"lead\">Typed Arrays menyediakan cara efisien membaca dan memanipulasi buffer biner mentah, sangat vital untuk pemrosesan grafik WebGL, Web Audio, dan WebAssembly.</p>",
        "example_title": "Contoh Kode JS Typed Arrays",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Bekerja dengan Uint8Array</h2>\n    <p id=\"hasilTypedArray\"></p>\n\n    <script>\n        // Array byte ukuran 4 elemen\n        const bufferBiner = new Uint8Array([255, 128, 64, 32]);\n\n        document.getElementById('hasilTypedArray').innerText = \n            \"Byte Data Biner Mentah: \" + bufferBiner.join(\" - \");\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_htmldom_navigation": {
        "title": "JS DOM Navigation",
        "summary": "Menavigasi silsilah pohon elemen DOM: parentNode, children, firstElementChild, nextElementSibling.",
        "content": "<p class=\"lead\">Navigasi DOM memungkinkan penelusuran hubungan antar elemen HTML seperti elemen induk (parent), elemen anak (children), dan saudara kandung (siblings).</p>",
        "example_title": "Contoh Kode JS DOM Navigation",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Navigasi Anak Elemen (children)</h2>\n    <div id=\"indukKotak\" style=\"background:#f1f5f9; padding:15px; border-radius:8px;\">\n        <p>Paragraf Pertama</p>\n        <p>Paragraf Kedua</p>\n    </div>\n    <button onclick=\"sorotAnakPertama()\" style=\"margin-top:10px; padding:8px 15px; cursor:pointer;\">Sorot Anak Pertama</button>\n\n    <script>\n        function sorotAnakPertama() {\n            const induk = document.getElementById('indukKotak');\n            induk.firstElementChild.style.color = \"#04AA6D\";\n            induk.firstElementChild.style.fontWeight = \"bold\";\n        }\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_graphics": {
        "title": "JS Graphics",
        "summary": "Menggambar grafik interaktif 2D dan kurva vektor dengan HTML5 Canvas API.",
        "content": "<p class=\"lead\">Elemen <code>&lt;canvas&gt;</code> dikendalikan oleh JavaScript untuk merender bentuk geometris, diagram grafik garis, atau animasi game sederhana.</p>",
        "example_title": "Contoh Kode JS Graphics",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Menggambar dengan Canvas 2D</h2>\n    <canvas id=\"papanGambar\" width=\"300\" height=\"150\" style=\"border:1px solid #cbd5e1; border-radius:8px;\"></canvas>\n\n    <script>\n        const canvas = document.getElementById('papanGambar');\n        const ctx = canvas.getContext('2d');\n\n        // Menggambar Kotak Navy\n        ctx.fillStyle = '#0d2e5c';\n        ctx.fillRect(20, 20, 100, 100);\n\n        // Menggambar Lingkaran Emas\n        ctx.beginPath();\n        ctx.arc(200, 70, 45, 0, 2 * Math.PI);\n        ctx.fillStyle = '#fca311';\n        ctx.fill();\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      }
    },
    "Old Technologies": {
      "js_ajax_intro": {
        "title": "JS AJAX",
        "summary": "Asynchronous JavaScript And XML klasik menggunakan objek XMLHttpRequest (XHR).",
        "content": "<p class=\"lead\">AJAX adalah teknologi pelopor web modern yang pertama kali memungkinkan pembaruan data halaman web tanpa perlu reload browser secara menyeluruh.</p>",
        "example_title": "Contoh Kode JS AJAX",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Metode Klasik XMLHttpRequest</h2>\n    <p>Sebelum adanya Fetch API modern, pengembang menggunakan XMLHttpRequest:</p>\n    <pre style=\"background:#1e293b; color:#38bdf8; padding:15px; border-radius:8px;\">\nconst xhr = new XMLHttpRequest();\nxhr.open(\"GET\", \"https://api.example.com/data\", true);\nxhr.onload = function() {\n    if (xhr.status === 200) {\n        console.log(xhr.responseText);\n    }\n};\nxhr.send();\n    </pre>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_jquery_selectors": {
        "title": "JS jQuery",
        "summary": "Mengenal library legendaris jQuery yang menyederhanakan penyeleksian elemen DOM dengan simbol $().",
        "content": "<p class=\"lead\">jQuery adalah pustaka JavaScript yang sangat populer di era 2010-an untuk menyederhanakan manipulasi HTML dan animasi lintas browser.</p>",
        "example_title": "Contoh Kode JS jQuery",
        "example_code": "<!DOCTYPE html>\n<html>\n<head>\n    <script src=\"https://code.jquery.com/jquery-3.6.0.min.js\"></script>\n</head>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Sintaks jQuery $()</h2>\n    <p id=\"teksJquery\">Klik tombol untuk menyembunyikan teks ini!</p>\n    <button id=\"btnJquery\" style=\"padding:8px 15px; cursor:pointer;\">Sembunyikan</button>\n\n    <script>\n        $('#btnJquery').click(function() {\n            $('#teksJquery').fadeOut(500);\n        });\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      },
      "js_json_jsonp": {
        "title": "JS JSONP",
        "summary": "JSON with Padding: Teknik lama mengatasi pembatasan Same-Origin Policy (CORS) sebelum era standar modern.",
        "content": "<p class=\"lead\">JSONP adalah teknik lampau untuk meminta data lintas domain (cross-domain) dengan memuat payload data di dalam tag &lt;script&gt; pemanggil callback.</p>",
        "example_title": "Contoh Kode JS JSONP",
        "example_code": "<!DOCTYPE html>\n<html>\n<body style=\"font-family: sans-serif; padding: 20px;\">\n    <h2>Konsep JSON with Padding (JSONP)</h2>\n    <p>Di era web modern, JSONP telah sepenuhnya digantikan oleh standar resmi <strong>CORS (Cross-Origin Resource Sharing)</strong>.</p>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      }
    },
    "JS Examples": {
      "js_examples": {
        "title": "JS Examples",
        "summary": "Koleksi contoh praktis JavaScript: Jam digital, kalkulator, validasi form, dan to-do list.",
        "content": "<p class=\"lead\">Katalog contoh praktis penerapan JavaScript untuk kebutuhan nyata dalam aplikasi web sehari-hari.</p>",
        "example_title": "Contoh Kode JS Examples",
        "example_code": "<!DOCTYPE html>\n<html>\n\n<body>\n    <h3>Contoh Aplikasi: Daftar Tugas Mini (To-Do)</h3>\n    <input type=\"text\" id=\"tugasBaru\" placeholder=\"Tugas baru...\" style=\"padding:8px; width:200px;\">\n    <button onclick=\"tambahTugas()\" style=\"padding:8px 15px; cursor:pointer;\">Tambah</button>\n    <div id=\"listTugas\" style=\"max-width:320px; margin-top:15px;\"><script>\n        function tambahTugas() {\n            const input = document.getElementById('tugasBaru');\n            if (!input.value.trim()) return;\n\n            const list = document.getElementById('listTugas');\n            const div = document.createElement('div');\n            div.className = 'todo-item';\n            div.innerHTML = '<span>' + input.value + '</span> <button onclick=\"this.parentElement.remove()\" style=\"color:red; border:none; background:none; cursor:pointer;\">&times;</button>';\n            list.appendChild(div);\n            input.value = '';\n        }\n    </script>\n</body>\n</html>",
        "explanation": "<p>Uji kode JavaScript di atas dengan menekan tombol atau mengamati perubahan nilai pada elemen HTML.</p>"
      }
    }
  }
}
JSON_DATA, true);
