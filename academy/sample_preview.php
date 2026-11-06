<?php
require_once __DIR__ . '/config/config.php';

$productId = trim($_GET['pid'] ?? 'sidesa-laravel');
$leadId = (int)($_GET['lead'] ?? 0);

$leadName = 'Calon Developer Hebat';
if ($leadId > 0 && $conn) {
    $stmt = $conn->prepare("SELECT `full_name` FROM `academy_leads` WHERE `id` = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param('i', $leadId);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res && $row = $res->fetch_assoc()) {
            $leadName = htmlspecialchars($row['full_name']);
        }
        $stmt->close();
    }
}

// Sample Data Book Catalogs
$samples = [
    'sidesa-laravel' => [
        'id' => 'sidesa-laravel',
        'title' => 'Sistem Informasi Desa Mandiri & Layanan Surat Warga (SIDESA)',
        'subtitle' => 'Panduan Komprehensif Membangun Portal Layanan Surat Online Warga, Statistik APBDes Interaktif, dan Notifikasi WhatsApp Berbasis Laravel 11, Inertia.js & Vue.js 3',
        'edition' => 'Edisi Pertama - Cetakan 2026 (Standar Industri & Skripsi)',
        'author' => 'Tim Perekayasa Perangkat Lunak Skillance Digital Indonesia',
        'pages_total' => '185 Halaman PDF',
        'price_old' => 'Rp 199.000',
        'price_now' => 'Rp 79.000',
        'tech_stack' => ['Laravel 11', 'Inertia.js', 'Vue.js 3', 'Tailwind CSS', 'MySQL 8', 'Fpdf / DomPDF', 'Fonnte WA Gateway'],
        'chapters_toc' => [
            ['no' => 1, 'title' => 'Analisis Kebutuhan Sistem Informasi Desa & Skema Relasi Database (ERD)', 'pages' => 'Hal. 1 - 28', 'status' => 'sample'],
            ['no' => 2, 'title' => 'Setup Laravel 11, Inertia.js, Vue.js 3, dan Tailwind CSS dari Nol', 'pages' => 'Hal. 29 - 52', 'status' => 'full'],
            ['no' => 3, 'title' => 'Pembuatan Sistem Otentikasi Bertingkat (Admin Desa, Petugas, dan Warga)', 'pages' => 'Hal. 53 - 74', 'status' => 'full'],
            ['no' => 4, 'title' => 'Modul Manajemen Kependudukan, Kartu Keluarga, dan Mutasi Penduduk', 'pages' => 'Hal. 75 - 104', 'status' => 'full'],
            ['no' => 5, 'title' => 'Pembangunan Layanan Permohonan Surat Mandiri & Otomasi Generator PDF Ber-QR Code', 'pages' => 'Hal. 105 - 132', 'status' => 'full'],
            ['no' => 6, 'title' => 'Visualisasi Infografis Transparansi APBDes Interaktif dengan Chart.js', 'pages' => 'Hal. 133 - 150', 'status' => 'full'],
            ['no' => 7, 'title' => 'Integrasi WhatsApp Gateway untuk Notifikasi Realtime Status Pengajuan Surat', 'pages' => 'Hal. 151 - 168', 'status' => 'full'],
            ['no' => 8, 'title' => 'Deployment ke VPS Ubuntu Server, Konfigurasi Nginx, SSL Gratis, dan Optimasi Production', 'pages' => 'Hal. 169 - 185', 'status' => 'full']
        ],
        'ch1_title' => 'Bab 1: Analisis Kebutuhan Sistem Informasi Desa (SIDESA) & Perancangan Relasi Database (ERD)',
        'sections' => [
            [
                'title' => '1.1 Latar Belakang & Masalah Tata Kelola Pelayanan Desa',
                'content' => <<<HTML
<p>Dalam era keterbukaan informasi dan digitalisasi administrasi publik, kantor pemerintahan desa dituntut untuk memberikan pelayanan yang cepat, transparan, dan akuntabel. Namun, realita di lapangan sering kali menghadapi berbagai hambatan birokrasi konvensional:</p>
<ul>
    <li><strong>Antrean Panjang Pengurusan Surat:</strong> Warga harus meluangkan waktu datang ke kantor desa pada jam kerja hanya untuk meminta surat keterangan pengantar (SKCK, Domisili, Usaha, Keterangan Tidak Mampu/SKTM).</li>
    <li><strong>Pengarsipan Manual yang Rentan Hilang:</strong> Berkas permohonan surat dicatat dalam buku register fisik yang rawan rusak, tercecer, atau sulit ditelusuri riwayatnya beberapa tahun kemudian.</li>
    <li><strong>Ketidaksinkronan Data Kependudukan:</strong> Mutasi penduduk (kelahiran, kematian, pindah domisili) sering kali terlambat diperbarui karena tidak ada sistem terpusat yang saling terhubung antara buku mutasi dan basis data utama.</li>
    <li><strong>Rendahnya Transparansi Penggunaan APBDes:</strong> Publikasi anggaran desa kerap hanya berupa baliho di pinggir jalan yang kurang informatif dan tidak menyajikan rincian persentase serapan secara realtime.</li>
</ul>
<p>Sistem Informasi Desa Mandiri (<strong>SIDESA</strong>) hadir sebagai solusi digital komprehensif. Sistem ini memadukan kemudahan portal warga berbasis mobile dengan dasbor administrasi yang kokoh untuk perangkat desa.</p>
HTML
            ],
            [
                'title' => '1.2 Analisis Kebutuhan Fungsional & Skenario Aktor Pengguna',
                'content' => <<<HTML
<p>Sistem dirancang dengan 3 (tiga) peran aktor utama yang memiliki hak akses dan alur kerja berbeda:</p>
<div class="table-responsive">
<table class="table table-bordered table-sm align-middle my-3">
    <thead class="table-light">
        <tr>
            <th style="width: 25%;">Peran (Role)</th>
            <th style="width: 35%;">Hak Akses & Fitur Utama</th>
            <th style="width: 40%;">Tujuan Bisnis / Pelayanan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><strong class="text-primary">Warga (Masyarakat)</strong></td>
            <td>Login mandiri via NIK & PIN, mengajukan surat keterangan online, melacak progress disposisi, dan mengunduh surat PDF yang telah ditandatangani.</td>
            <td>Efisiensi waktu warga tanpa perlu bolak-balik ke kantor desa. Layanan buka 24 jam.</td>
        </tr>
        <tr>
            <td><strong class="text-success">Operator / Kasi Pelayanan</strong></td>
            <td>Verifikasi kelengkapan berkas warga, validasi NIK terdaftar, approve/reject permohonan, dan menerbitkan surat resmi dengan penomoran otomatis.</td>
            <td>Menghilangkan penumpukan berkas manual dan mencegah kesalahan nomor surat duplikat.</td>
        </tr>
        <tr>
            <td><strong class="text-dark">Kepala Desa (Admin Utama)</strong></td>
            <td>Dashboard eksekutif, rekapitulasi data demografi, persetujuan tanda tangan digital (QR Code), dan input realisasi anggaran APBDes.</td>
            <td>Monitoring kinerja pelayanan desa dan pelaporan pertanggungjawaban publik secara transparan.</td>
        </tr>
    </tbody>
</table>
</div>
HTML
            ],
            [
                'title' => '1.3 Perancangan Skema Database Relasional (Entity Relationship Diagram)',
                'content' => <<<HTML
<p>Keberhasilan sistem yang tangguh terletak pada rancangan skema database yang ternormalisasi (minimal 3NF). Di bawah ini adalah rancangan tabel inti yang akan kita bangun di Laravel 11:</p>
<div class="bg-light p-3 rounded-3 border mb-3">
    <h6 class="fw-bold text-navy mb-2"><i class="fa-solid fa-database text-warning me-1"></i> Struktur Skema Tabel Utama SIDESA:</h6>
    <ol class="small mb-0" style="line-height: 1.8;">
        <li><code>kartu_keluarga</code>: Menyimpan nomor KK, nama kepala keluarga, alamat, RT/RW, dan tanggal terbit.</li>
        <li><code>penduduk</code>: Tabel master warga dengan kolom <code>nik</code> (Primary Key), <code>no_kk</code> (Foreign Key), nama, tempat_lahir, tgl_lahir, jenis_kelamin, agama, status_kawin, pekerjaan, dan foto_ktp.</li>
        <li><code>jenis_surat</code>: Master template surat (SKCK, Keterangan Usaha, Kematian, Domisili, SKTM, dll.) beserta kode penomoran.</li>
        <li><code>pengajuan_surat</code>: Tabel transaksi permohonan surat berisi <code>kode_unik</code>, <code>nik</code>, <code>jenis_surat_id</code>, <code>keperluan</code>, <code>status</code> (menunggu, diproses, selesai, ditolak), <code>file_surat_pdf</code>, dan <code>qr_code_hash</code>.</li>
        <li><code>apbdes_anggaran</code>: Menyimpan data pos pendapatan dan belanja desa per tahun anggaran beserta persentase realisasi.</li>
    </ol>
</div>
<p>Berikut adalah potongan migration resmi Laravel 11 untuk tabel <code>pengajuan_surat</code> yang dilengkapi Foreign Key dan Indexing performa tinggi:</p>
<pre class="bg-dark text-white p-3 rounded-3 small"><code>// database/migrations/2026_01_01_000003_create_pengajuan_surat_table.php
Schema::create('pengajuan_surat', function (Blueprint \$table) {
    \$table->id();
    \$table->string('kode_unik', 20)->unique()->index();
    \$table->string('nik', 16)->index();
    \$table->foreignId('jenis_surat_id')->constrained('jenis_surat')->onDelete('cascade');
    \$table->text('keperluan');
    \$table->json('data_tambahan')->nullable(); // Menampung field dinamis per jenis surat
    \$table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu')->index();
    \$table->text('catatan_petugas')->nullable();
    \$table->string('file_pdf', 255)->nullable();
    \$table->string('qr_code_hash', 64)->nullable()->index();
    \$table->timestamp('disetujui_pada')->nullable();
    \$table->foreignId('diproses_oleh')->nullable()->constrained('users');
    \$table->timestamps();

    \$table->foreign('nik')->references('nik')->on('penduduk')->onDelete('cascade');
});</code></pre>
HTML
            ],
            [
                'title' => '1.4 Prasyarat Lingkungan Pengembangan (Development Environment)',
                'content' => <<<HTML
<p>Sebelum melangkah ke Bab 2 (Instalasi dan Konfigurasi Laravel 11 + Inertia Vue 3), pastikan komputer kerja Anda telah memenuhi spesifikasi berikut:</p>
<ul>
    <li><strong>PHP 8.2 atau 8.3+:</strong> Pastikan ekstensi <code>pdo_mysql</code>, <code>mbstring</code>, <code>openssl</code>, <code>gd</code>, dan <code>zip</code> aktif.</li>
    <li><strong>Composer 2.7+:</strong> Manajemen paket dependensi PHP.</li>
    <li><strong>Node.js 20 LTS & NPM 10+:</strong> Kompilasi aset Vite, Vue 3, dan Tailwind CSS.</li>
    <li><strong>MySQL 8.0+ atau MariaDB 10.4+:</strong> RDBMS penyimpanan data.</li>
    <li><strong>Code Editor:</strong> Visual Studio Code atau PHPStorm dengan ekstensi Vue - Official (Volar) dan Tailwind CSS IntelliSense.</li>
</ul>
<div class="alert alert-info border-0 shadow-sm small">
    <strong><i class="fa-solid fa-circle-check text-info me-1"></i> Catatan Siap Pakai:</strong> Di versi Full Source Code yang Anda beli, seluruh skema database di atas sudah dilengkapi dengan <em>Database Seeder</em> yang langsung menghasilkan 100+ data penduduk acak realistis, 15 jenis surat siap cetak, dan template APBDes lengkap sehingga Anda tidak perlu menginput data satu per satu dari awal!
</div>
HTML
            ]
        ]
    ],
    'pos-kasir' => [
        'id' => 'pos-kasir',
        'title' => 'Sistem Kasir Pintar (Point of Sale) & Cetak Struk Bluetooth Thermal',
        'subtitle' => 'Panduan Membangun Aplikasi Kasir Kilat Modern untuk Toko Retail & Cafe dengan Scanner Barcode, Direct Thermal Printing ESC/POS via Web Bluetooth, dan Laporan Laba Rugi',
        'edition' => 'Edisi Pertama - Cetakan 2026 (UMKM & Freelance Pro)',
        'author' => 'Tim Perekayasa Perangkat Lunak Skillance Digital Indonesia',
        'pages_total' => '150 Halaman PDF',
        'price_old' => 'Rp 179.000',
        'price_now' => 'Rp 69.000',
        'tech_stack' => ['PHP 8.3', 'Laravel 11', 'MySQL 8', 'Alpine.js', 'Tailwind CSS', 'Web Bluetooth API', 'ESC/POS Commands'],
        'chapters_toc' => [
            ['no' => 1, 'title' => 'Konsep Arsitektur Aplikasi Kasir (POS) & Manajemen Transaksi Cepat', 'pages' => 'Hal. 1 - 24', 'status' => 'sample'],
            ['no' => 2, 'title' => 'Skema Database Relasional: Produk, Varian, Transaksi, dan Detail Penjualan', 'pages' => 'Hal. 25 - 46', 'status' => 'full'],
            ['no' => 3, 'title' => 'Implementasi Frontend Kasir Cepat dengan Alpine.js & Tailwind CSS', 'pages' => 'Hal. 47 - 72', 'status' => 'full'],
            ['no' => 4, 'title' => 'Integrasi Barcode Scanner Hardware USB & Kamera Web Browser', 'pages' => 'Hal. 73 - 94', 'status' => 'full'],
            ['no' => 5, 'title' => 'Pemrograman Direct Printing Thermal Printer (ESC/POS & Web Bluetooth)', 'pages' => 'Hal. 95 - 118', 'status' => 'full'],
            ['no' => 6, 'title' => 'Modul Manajemen Stok, Laporan Margin Laba, dan Export Excel/PDF', 'pages' => 'Hal. 119 - 138', 'status' => 'full'],
            ['no' => 7, 'title' => 'Pengujian Transaksi Stres-Test dan Deployment Kasir Lokal/Cloud', 'pages' => 'Hal. 139 - 150', 'status' => 'full']
        ],
        'ch1_title' => 'Bab 1: Konsep Arsitektur Aplikasi Kasir (POS) & Manajemen Transaksi Cepat',
        'sections' => [
            [
                'title' => '1.1 Tantangan Transaksi Kasir Retail & UMKM di Era Digital',
                'content' => <<<HTML
<p>Kecepatan dan akurasi adalah dua faktor penentu dalam bisnis retail, minimarket, dan kedai kopi. Ketika antrean pembeli sedang memuncak pada jam sibuk (<em>peak hours</em>), kelambatan sistem kasir sebesar 5 detik saja dapat menimbulkan ketidaknyamanan pelanggan dan risiko kebocoran kas.</p>
<p>Kelemahan sistem kasir konvensional berbasis web klasik antara lain:</p>
<ul>
    <li><strong>Page Reload Berulang:</strong> Setiap penambahan item produk atau perubahan quantity menuntut refresh halaman web, yang membuang waktu dan bandwidth.</li>
    <li><strong>Dialog Print yang Lambat:</strong> Mencetak struk melalui dialog bawaan browser (Ctrl+P) mengharuskan kasir memilih printer secara manual dan mengklik "Print" setiap kali transaksi, sangat tidak praktis untuk toko yang sibuk.</li>
    <li><strong>Ketergantungan Internet Penuh:</strong> Jika koneksi internet terputus sesaat, proses checkout terhenti total.</li>
</ul>
<p>Dalam buku ini, kita akan membangun arsitektur kasir yang <strong>kilat dan reaktif</strong> memanfaatkan kombinasi <strong>Laravel 11 REST API</strong> di sisi server dan <strong>Alpine.js</strong> di sisi client, serta direct silent printing ke printer thermal bluetooth tanpa memunculkan print dialog browser.</p>
HTML
            ],
            [
                'title' => '1.2 Arsitektur Alur Transaksi Kasir (Single Screen Checkout)',
                'content' => <<<HTML
<p>Seluruh interaksi kasir didesain berjalan dalam satu layar tunggal (<em>Single Screen Interface</em>) dengan dukungan shortcut keyboard:</p>
<ul>
    <li><code>F1</code>: Fokus kursor instan ke kolom Barcode / Pencarian Produk.</li>
    <li><code>F2</code>: Buka modal diskon / voucher transaksi.</li>
    <li><code>F4</code>: Ganti mode pembayaran (Tunai / QRIS / Kartu Debit).</li>
    <li><code>Space</code> / <code>Enter</code>: Selesaikan transaksi & cetak struk otomatis.</li>
</ul>
<p>Dengan arsitektur ini, kasir tidak perlu menyentuh mouse sama sekali, melipatgandakan kecepatan transaksi per menit.</p>
HTML
            ],
            [
                'title' => '1.3 Mengenal Protokol ESC/POS & Web Bluetooth API',
                'content' => <<<HTML
<p>Printer thermal mini (ukuran 58mm atau 80mm) yang umum digunakan kasir berkomunikasi menggunakan perintah heksadesimal standar <strong>ESC/POS</strong> (Epson Standard Code for Point of Sale). Melalui Web Bluetooth API pada browser modern (Google Chrome / Edge), JavaScript dapat langsung mengirimkan byte perintah cetak ke modul Bluetooth printer tanpa memerlukan driver pihak ketiga.</p>
<pre class="bg-dark text-white p-3 rounded-3 small"><code>// Contoh perintah dasar ESC/POS dalam JavaScript:
const ESC = '\\x1B';
const GS = '\\x1D';

// Inisialisasi printer
const CMD_INIT = ESC + '@';
// Perataan teks tengah (Center)
const CMD_ALIGN_CENTER = ESC + 'a' + '\\x01';
// Ukuran font tebal & besar
const CMD_BOLD_ON = ESC + 'E' + '\\x01';
// Perintah potong kertas (Cut Paper)
const CMD_CUT = GS + 'V' + '\\x41' + '\\x00';</code></pre>
<p>Mekanisme lengkap pengiriman raw binary stream ini akan dibahas tuntas step-by-step beserta implementasi kode siap pakai di Bab 5.</p>
HTML
            ]
        ]
    ],
    'sarpras-kampus' => [
        'id' => 'sarpras-kampus',
        'title' => 'Sistem Peminjaman Sarana Prasarana & Booking Ruangan Kampus',
        'subtitle' => 'Panduan Membangun Aplikasi Booking Ruangan dan Perlengkapan Kampus dengan Kalender Interaktif, Deteksi Bentrok Otomatis, dan Alur Persetujuan Bertingkat',
        'edition' => 'Edisi Pertama - Cetakan 2026 (Standar Tugas Akhir & Skripsi)',
        'author' => 'Tim Perekayasa Perangkat Lunak Skillance Digital Indonesia',
        'pages_total' => '140 Halaman PDF',
        'price_old' => 'Rp 149.000',
        'price_now' => 'Rp 59.000',
        'tech_stack' => ['Laravel 11', 'Bootstrap 5', 'MySQL 8', 'FullCalendar.js', 'DomPDF', 'Diagram UML'],
        'chapters_toc' => [
            ['no' => 1, 'title' => 'Analisis Kebutuhan Sistem Akademik & Standar Skripsi Informatika', 'pages' => 'Hal. 1 - 22', 'status' => 'sample'],
            ['no' => 2, 'title' => 'Desain Diagram UML (Use Case, Activity, Sequence) & ERD Lengkap', 'pages' => 'Hal. 23 - 48', 'status' => 'full'],
            ['no' => 3, 'title' => 'Setup Project Laravel & Autentikasi Multi-Role (Mahasiswa, Dosen, Sarpras)', 'pages' => 'Hal. 49 - 70', 'status' => 'full'],
            ['no' => 4, 'title' => 'Integrasi FullCalendar.js untuk Visualisasi Jadwal Ruangan Realtime', 'pages' => 'Hal. 71 - 92', 'status' => 'full'],
            ['no' => 5, 'title' => 'Logika Algoritma Pengecekan Bentrok Waktu Peminjaman (Collision Check)', 'pages' => 'Hal. 93 - 110', 'status' => 'full'],
            ['no' => 6, 'title' => 'Sistem Workflow Approval Bertingkat & Notifikasi Status', 'pages' => 'Hal. 111 - 128', 'status' => 'full'],
            ['no' => 7, 'title' => 'Generator Surat Izin Peminjaman Format PDF Resmi Ber-QR Code', 'pages' => 'Hal. 129 - 140', 'status' => 'full']
        ],
        'ch1_title' => 'Bab 1: Analisis Kebutuhan Sistem Akademik & Standar Skripsi Informatika',
        'sections' => [
            [
                'title' => '1.1 Masalah Pengelolaan Peminjaman Ruangan & Fasilitas Kampus',
                'content' => <<<HTML
<p>Topik peminjaman sarana prasarana merupakan salah satu studi kasus paling populer dan sering disetujui oleh dosen pembimbing skripsi di jurusan Teknik Informatika, Sistem Informasi, dan Manajemen Informatika. Hal ini dikarenakan permasalahan yang diangkat sangat nyata di kehidupan kampus:</p>
<ul>
    <li><strong>Sering Terjadi Bentrok Pemakaian Aula / Laboratorium:</strong> Dua organisasi mahasiswa mengajukan peminjaman ruangan yang sama di hari yang sama tanpa saling mengetahui.</li>
    <li><strong>Birokrasi Persetujuan yang Berbelit:</strong> Mahasiswa harus membawa lembaran proposal fisik meminta tanda tangan pembina ormawa, ketua jurusan, hingga bagian sarpras universitas.</li>
    <li><strong>Surat Izin Fisik Mudah Hilang:</strong> Keamanan kampus kesulitan memvalidasi keaslian izin pemakaian fasilitas pada akhir pekan.</li>
</ul>
HTML
            ],
            [
                'title' => '1.2 Logika Matematika Pendeteksian Jadwal Bentrok (Interval Collision)',
                'content' => <<<HTML
<p>Inti algoritma sistem ini terletak pada validasi overlap interval waktu. Dua rentang peminjaman dinyatakan bentrok jika dan hanya jika:</p>
<div class="bg-light p-3 rounded-3 border my-3">
    <code>(\$startBaru &lt; \$endEksisting) AND (\$endBaru &gt; \$startEksisting)</code>
</div>
<p>Implementasi query Eloquent Laravel untuk mencegah bentrok ruangan:</p>
<pre class="bg-dark text-white p-3 rounded-3 small"><code>\$isBentrok = Peminjaman::where('ruangan_id', \$ruanganId)
    ->where('status', 'approved')
    ->where(function (\$query) use (\$mulai, \$selesai) {
        \$query->where('waktu_mulai', '&lt;', \$selesai)
              ->where('waktu_selesai', '&gt;', \$mulai);
    })->exists();

if (\$isBentrok) {
    return back()->withErrors(['msg' => 'Ruangan telah dibooking oleh agenda lain pada jam tersebut!']);
}</code></pre>
HTML
            ]
        ]
    ],
    'ecommerce-payment' => [
        'id' => 'ecommerce-payment',
        'title' => 'Toko Online UMKM Terintegrasi Payment Gateway (Midtrans Snap) & RajaOngkir',
        'subtitle' => 'Panduan Membangun Platform E-Commerce Modern dengan Otomasi Checkout QRIS, Virtual Account, Kurir Otomatis se-Indonesia, dan Verifikasi Webhook',
        'edition' => 'Edisi Pertama - Cetakan 2026 (Standar Industri & Startup)',
        'author' => 'Tim Perekayasa Perangkat Lunak Skillance Digital Indonesia',
        'pages_total' => '165 Halaman PDF',
        'price_old' => 'Rp 229.000',
        'price_now' => 'Rp 89.000',
        'tech_stack' => ['Laravel 11', 'Vue.js 3', 'Midtrans Snap API', 'RajaOngkir API', 'Webhook Asynchronous', 'Pinia Store'],
        'chapters_toc' => [
            ['no' => 1, 'title' => 'Fondasi Arsitektur E-Commerce Modern & Siklus Pembayaran Digital', 'pages' => 'Hal. 1 - 26', 'status' => 'sample'],
            ['no' => 2, 'title' => 'Setup Database Produk, Kategori, Order, dan Payment Log', 'pages' => 'Hal. 27 - 50', 'status' => 'full'],
            ['no' => 3, 'title' => 'Pembuatan Keranjang Belanja Interaktif dengan Vue.js 3 & Pinia', 'pages' => 'Hal. 51 - 78', 'status' => 'full'],
            ['no' => 4, 'title' => 'Integrasi RajaOngkir API untuk Cek Ongkir Otomatis Antar Kota', 'pages' => 'Hal. 79 - 102', 'status' => 'full'],
            ['no' => 5, 'title' => 'Implementasi Midtrans Snap API (QRIS, VA BCA, Mandiri, BRI)', 'pages' => 'Hal. 103 - 128', 'status' => 'full'],
            ['no' => 6, 'title' => 'Pengolahan Webhook Notification & Pembaruan Status Pesanan Otomatis', 'pages' => 'Hal. 129 - 148', 'status' => 'full'],
            ['no' => 7, 'title' => 'Manajemen Pesanan Admin, Input Resi, dan Notifikasi Email', 'pages' => 'Hal. 149 - 165', 'status' => 'full']
        ],
        'ch1_title' => 'Bab 1: Fondasi Arsitektur E-Commerce Modern & Siklus Pembayaran Digital',
        'sections' => [
            [
                'title' => '1.1 Siklus Transaksi Checkout, Payment Gateway, dan Asynchronous Webhook',
                'content' => <<<HTML
<p>Salah satu keterampilan yang paling dicari oleh perusahaan software house dan startup adalah kemampuan mengintegrasikan sistem pembayaran digital (Payment Gateway) secara aman. Mengandalkan transfer bank manual dengan bukti struk transfer memiliki banyak kelemahan: rawan bukti transfer palsu (hasil manipulasi Photoshop), memerlukan verifikasi manual oleh admin, dan pesanan terlambat diproses.</p>
<p>Dengan integrasi <strong>Midtrans Snap</strong>, siklus transaksi berlangsung secara otomatis tanpa campur tangan manusia:</p>
<ol>
    <li>Pelanggan memilih produk dan menghitung ongkos kirim ke kota tujuan via <strong>RajaOngkir API</strong>.</li>
    <li>Backend Laravel membuat pesanan dengan status <code>pending</code> dan memanggil API Midtrans untuk mendapatkan <code>snap_token</code>.</li>
    <li>Frontend memunculkan pop-up pembayaran Snap yang mendukung QRIS, Virtual Account bank, dan e-Wallet.</li>
    <li>Setelah pelanggan membayar, server Midtrans mengirimkan HTTP POST asynchronous (<strong>Webhook Notification</strong>) ke endpoint server Laravel kita.</li>
    <li>Backend memvalidasi <code>signature_key</code> SHA512 untuk mencegah manipulasi, lalu memperbarui status pesanan menjadi <code>paid</code> dan mengurangi stok secara otomatis.</li>
</ol>
HTML
            ],
            [
                'title' => '1.2 Konsep Keamanan Signature Key SHA512',
                'content' => <<<HTML
<p>Banyak developer pemula melakukan kesalahan fatal dengan mempercayai notifikasi webhook tanpa validasi tanda tangan digital. Midtrans menyertakan <code>signature_key</code> pada setiap panggilan webhook:</p>
<div class="bg-light p-3 rounded-3 border my-3">
    <code>\$expectedSignature = hash("sha512", \$orderId . \$statusCode . \$grossAmount . \$serverKey);</code>
</div>
<p>Jika hash yang dihitung oleh server kita tidak cocok dengan signature dari Midtrans, request tersebut harus ditolak (HTTP 403 Forbidden) karena berpotensi merupakan serangan spoofing.</p>
HTML
            ]
        ]
    ]
];

$book = $samples[$productId] ?? $samples['sidesa-laravel'];
$adminWa = "6282291700778";
$waOrderMsg = urlencode("Halo Admin Skillance Academy, saya sudah membaca sampel Bab 1 & Daftar Isi e-book *{$book['title']}* atas nama *{$leadName}*. Saya berminat memesan Full Source Code & E-Book Lengkapnya!");
$waUrl = "https://wa.me/{$adminWa}?text={$waOrderMsg}";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sampel Bab 1 & Daftar Isi: <?= htmlspecialchars($book['title']) ?> - Skillance Academy</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cinzel:wght@700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #071a35;
            --gold: #fca311;
            --w3-green: #04AA6D;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        code, pre {
            font-family: 'Fira Code', monospace;
        }

        /* Top Sticky Toolbar */
        .preview-toolbar {
            position: sticky;
            top: 0;
            z-index: 1020;
            background: #ffffff;
            border-bottom: 2px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        }

        /* Paper Document Layout */
        .pdf-page-container {
            max-width: 900px;
            margin: 30px auto;
            background: #ffffff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .pdf-inner-content {
            padding: 60px 70px;
        }

        @media (max-width: 768px) {
            .pdf-inner-content {
                padding: 30px 20px;
            }
        }

        /* Cover Design */
        .book-cover {
            background: linear-gradient(145deg, #071a35 0%, #0d2e5c 60%, #1e3a8a 100%);
            color: #ffffff;
            padding: 70px 50px;
            border-bottom: 6px solid var(--gold);
            position: relative;
        }

        .watermark-banner {
            background-color: #fef3c7;
            border-bottom: 1px dashed #f59e0b;
            padding: 10px 15px;
            font-size: 0.82rem;
            color: #92400e;
            text-align: center;
            font-weight: 600;
        }

        /* Section Styling */
        .chapter-heading {
            border-bottom: 2px solid #0d2e5c;
            padding-bottom: 12px;
            margin-bottom: 25px;
            font-weight: 800;
            color: #0d2e5c;
        }

        .section-title {
            font-size: 1.18rem;
            font-weight: 700;
            color: #0f172a;
            margin-top: 35px;
            margin-bottom: 14px;
        }

        .sample-toc-item {
            padding: 10px 14px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.92rem;
        }
        .sample-toc-item:last-child {
            border-bottom: none;
        }

        /* Print styles */
        @media print {
            .preview-toolbar, .no-print {
                display: none !important;
            }
            body {
                background: #ffffff !important;
            }
            .pdf-page-container {
                box-shadow: none !important;
                border: none !important;
                margin: 0 !important;
                max-width: 100% !important;
            }
            .pdf-inner-content {
                padding: 20px !important;
            }
            .page-break {
                page-break-after: always;
                break-after: page;
            }
        }
    </style>
</head>
<body>

    <!-- TOP FLOATING TOOLBAR -->
    <header class="preview-toolbar py-2 px-3 no-print">
        <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div class="d-flex align-items-center gap-2">
                <a href="projects.php" class="btn btn-outline-secondary btn-sm rounded-pill">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Katalog
                </a>
                <span class="badge bg-danger text-white rounded-pill px-3 py-1 fw-bold small">
                    <i class="fa-solid fa-file-pdf me-1"></i> FREE PREVIEW BAB 1 (<?= $book['pages_total'] ?>)
                </span>
            </div>

            <div class="d-flex align-items-center gap-2 ms-auto">
                <button onclick="window.print()" class="btn btn-outline-navy btn-sm rounded-pill fw-bold px-3" style="border-color: #0d2e5c; color: #0d2e5c;">
                    <i class="fa-solid fa-print me-1"></i> Cetak / Simpan PDF
                </button>
                <a href="<?= $waUrl ?>" target="_blank" class="btn btn-success btn-sm rounded-pill fw-bold px-4 shadow-sm">
                    <i class="fa-brands fa-whatsapp fs-6 me-1"></i> Beli Full Kit (<?= $book['price_now'] ?>) &raquo;
                </a>
            </div>
        </div>
    </header>

    <!-- DOCUMENT CONTAINER -->
    <main class="pdf-page-container">
        
        <!-- WATERMARK BANNER -->
        <div class="watermark-banner">
            <i class="fa-solid fa-shield-halved me-1 text-warning"></i>
            DOKUMEN SAMPEL RESMI SKILLANCE ACADEMY &bull; Diterbitkan untuk <strong><?= $leadName ?></strong> &bull; Dilarang memperbanyak tanpa izin tertulis.
        </div>

        <!-- COVER PAGE -->
        <div class="book-cover page-break">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-warning text-dark fw-bold px-3 py-1 rounded-pill">E-BOOK STUDI KASUS RIIL</span>
                    <span class="badge bg-light text-dark fw-semibold px-2 py-1 rounded-pill small">SAMPEL GRATIS</span>
                </div>
                <div class="small text-white-50">
                    <i class="fa-solid fa-book-bookmark text-warning me-1"></i> Skillance Digital Developer Kit
                </div>
            </div>

            <h1 class="display-6 fw-bold mb-3 text-white" style="line-height: 1.3;">
                <?= htmlspecialchars($book['title']) ?>
            </h1>

            <p class="lead text-white-50 mb-4" style="font-size: 1.05rem; line-height: 1.7;">
                <?= htmlspecialchars($book['subtitle']) ?>
            </p>

            <div class="d-flex flex-wrap gap-2 mb-5">
                <?php foreach ($book['tech_stack'] as $tech): ?>
                    <span class="badge bg-white bg-opacity-20 text-white border border-white border-opacity-25 rounded-pill px-3 py-1">
                        <?= htmlspecialchars($tech) ?>
                    </span>
                <?php endforeach; ?>
            </div>

            <div class="pt-4 border-top border-white border-opacity-25 d-flex flex-wrap justify-content-between align-items-end gap-3 text-white-50 small">
                <div>
                    <div><strong>Penulis:</strong> <?= htmlspecialchars($book['author']) ?></div>
                    <div><strong>Penerbit:</strong> Skillance Digital Indonesia &bull; <?= htmlspecialchars($book['edition']) ?></div>
                </div>
                <div class="text-md-end">
                    <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill fs-6">
                        Harga Full Kit: <?= $book['price_now'] ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- INNER CONTENT -->
        <div class="pdf-inner-content">

            <!-- TABLE OF CONTENTS -->
            <section class="mb-5 page-break">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold text-navy font-heading mb-0">Daftar Isi Lengkap E-Book</h3>
                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1">Total: <?= $book['pages_total'] ?></span>
                </div>
                <p class="text-muted small mb-4">
                    Sampel ini menyajikan isi penuh <strong>Bab 1</strong> untuk melihat gaya penyampaian, kedalaman teknis, dan rancangan arsitektur sebelum Anda memutuskan membeli paket lengkap (Full Source Code + E-Book + Database Seeder).
                </p>

                <div class="border rounded-3 overflow-hidden shadow-sm">
                    <?php foreach ($book['chapters_toc'] as $ch): ?>
                        <div class="sample-toc-item <?= $ch['status'] === 'sample' ? 'bg-success bg-opacity-10' : '' ?>">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge <?= $ch['status'] === 'sample' ? 'bg-success text-white' : 'bg-light text-muted border' ?> rounded-circle" style="width: 26px; height: 26px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.78rem;">
                                    <?= $ch['no'] ?>
                                </span>
                                <span class="<?= $ch['status'] === 'sample' ? 'fw-bold text-navy' : 'text-secondary' ?>">
                                    Bab <?= $ch['no'] ?>: <?= htmlspecialchars($ch['title']) ?>
                                </span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="small text-muted"><?= $ch['pages'] ?></span>
                                <?php if ($ch['status'] === 'sample'): ?>
                                    <span class="badge bg-success text-white rounded-pill px-2 py-1" style="font-size: 0.7rem;">TERSEDIA DI SAMPEL INI</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill px-2 py-1" style="font-size: 0.7rem;">VERSI FULL</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <hr class="my-5">

            <!-- CHAPTER 1 BODY -->
            <article class="chapter-content">
                <div class="mb-4">
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill fw-bold mb-2">BAB PERDANA</span>
                    <h2 class="chapter-heading"><?= htmlspecialchars($book['ch1_title']) ?></h2>
                </div>

                <?php foreach ($book['sections'] as $sec): ?>
                    <section class="mb-5">
                        <h4 class="section-title"><?= htmlspecialchars($sec['title']) ?></h4>
                        <div class="section-body text-secondary" style="line-height: 1.85; font-size: 0.96rem;">
                            <?= $sec['content'] ?>
                        </div>
                    </section>
                <?php endforeach; ?>

            </article>

            <!-- CALL TO ACTION BOX AT BOTTOM OF SAMPLE -->
            <div class="p-4 p-md-5 rounded-4 text-white mt-5 shadow position-relative overflow-hidden no-print" style="background: linear-gradient(135deg, #071a35 0%, #0d2e5c 70%, #04AA6D 100%);">
                <div class="row align-items-center">
                    <div class="col-lg-8 mb-3 mb-lg-0">
                        <span class="badge bg-gold text-navy fw-bold px-3 py-1 rounded-pill mb-2">DISKON KHUSUS PEMBACA SAMPEL</span>
                        <h3 class="fw-bold font-heading mb-2 text-white">Lanjutkan Membaca Bab 2 s/d Bab Selesai & Dapatkan Full Source Code</h3>
                        <p class="text-white-50 small mb-0" style="line-height: 1.7;">
                            Dapatkan seluruh <strong>Full Source Code Project Siap Pakai</strong>, Database Seeder lengkap, E-Book PDF <?= $book['pages_total'] ?>, dan Lisensi Komersial tanpa batas untuk skripsi atau proyek freelance!
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <div class="mb-2">
                            <span class="text-decoration-line-through text-white-50 me-2 small"><?= $book['price_old'] ?></span>
                            <span class="fs-3 fw-bold text-gold font-heading"><?= $book['price_now'] ?></span>
                        </div>
                        <a href="<?= $waUrl ?>" target="_blank" class="btn btn-warning btn-lg fw-bold px-4 py-2 rounded-pill text-navy shadow w-100">
                            <i class="fa-brands fa-whatsapp fs-5 me-1"></i> Beli Sekarang via WA &raquo;
                        </a>
                        <small class="d-block text-white-50 mt-1" style="font-size: 0.72rem;">*Bonus Konsultasi Instalasi Lokal</small>
                    </div>
                </div>
            </div>

            <!-- FOOTER NOTICE -->
            <footer class="mt-5 pt-4 border-top text-center text-muted small">
                <p class="mb-1">&copy; 2026 Skillance Academy &bull; Skillance Digital Indonesia. Hak Cipta Dilindungi Undang-Undang.</p>
                <p class="mb-0">Dokumen pratinjau ini diterbitkan secara eksklusif untuk pembelajaran calon profesional pengembang perangkat lunak.</p>
            </footer>

        </div>
    </main>

</body>
</html>
