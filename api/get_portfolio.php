<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/config.php'; // Panggil koneksi database

// Kamus metadata studi kasus portofolio nyata
$caseStudies = [
    15 => [
        "category" => "Digitalisasi Budaya & Edukasi",
        "institution" => "Komunitas Penutur Bahasa Moronene & Kab. Bombana",
        "tech_stack" => ["PHP Native", "MySQL", "Bootstrap 5", "AJAX Live Search", "Audio Pronunciation"],
        "description" => "Aplikasi kamus digital interaktif yang dirancang khusus untuk mendokumentasikan, melestarikan, dan mempermudah pembelajaran kosakata Bahasa Daerah Moronene bagi generasi muda, akademisi, dan masyarakat luas.",
        "features" => [
            "Pencarian leksikon cepat dua arah (Indonesia - Moronene & sebaliknya)",
            "Kategori kosakata tematik (percakapan harian, angka, adat & sapaan)",
            "Dukungan pelafalan fonetis penutur asli untuk akurasi pengucapan",
            "Antarmuka responsif ramah smartphone hemat kuota data"
        ],
        "image" => "https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
    ],
    14 => [
        "category" => "Sistem Informasi Manajemen Keuangan UMKM",
        "institution" => "UMKM Cahaya Tani Poleang, Kab. Bombana",
        "tech_stack" => ["PHP Native", "MySQL", "Chart.js", "DomPDF Export", "Responsive UI"],
        "description" => "Sistem manajemen keuangan dan operasional terintegrasi untuk UMKM sektor agribisnis. Membantu pengelolaan stok saprotan (sarana produksi pertanian), piutang petani mitra, hingga otomasi laporan laba-rugi periodik.",
        "features" => [
            "Pencatatan kas masuk & kas keluar harian secara real-time",
            "Manajemen persediaan pupuk/bibit dengan peringatan stok kritis",
            "Visualisasi grafik tren arus kas bulanan berbasis Chart.js",
            "Ekspor laporan keuangan format PDF dan Excel siap cetak"
        ],
        "image" => "https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
    ],
    13 => [
        "category" => "E-Government & Web GIS Publik",
        "institution" => "Dinas PU / Pemerintah Kabupaten Bombana",
        "tech_stack" => ["PHP Native", "MySQL", "Leaflet JS (OpenStreetMap)", "Geolocation GPS", "WhatsApp API"],
        "description" => "Platform pengaduan masyarakat berbasis peta digital interaktif (Web GIS) untuk melaporkan titik-titik kerusakan infrastruktur jalan di seluruh kecamatan Kabupaten Bombana secara transparan, akurat, dan terpantau.",
        "features" => [
            "Penentuan titik koordinat GPS (latitude & longitude) otomatis",
            "Unggah foto bukti fisik kerusakan jalan langsung dari kamera HP",
            "Pelacakan status penanganan terbuka (Menunggu > Ditinjau > Selesai)",
            "Notifikasi pembaruan progres pengerjaan ke nomor WhatsApp pelapor"
        ],
        "image" => "https://images.unsplash.com/photo-1515162816999-a0c47dc192f7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
    ],
    12 => [
        "category" => "Sistem Pakar Medis & Kesehatan",
        "institution" => "UPTD Puskesmas Siompu, Buton Selatan",
        "tech_stack" => ["PHP Native", "MySQL", "Algoritma Dempster-Shafer", "Bootstrap 5"],
        "description" => "Sistem pakar identifikasi dini penyakit kulit berbasis penalaran ketidakpastian (uncertainty reasoning) menggunakan metode Dempster-Shafer untuk membantu tenaga medis di fasilitas kesehatan tingkat pertama.",
        "features" => [
            "Kuesioner gejala interaktif dengan bobot kepastian medis",
            "Kalkulasi matematis otomatis nilai belief dan plausibility",
            "Rekomendasi penanganan medis awal dan resep obat umum",
            "Arsip rekam medis hasil diagnosa pasien terstruktur"
        ],
        "image" => "https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
    ],
    10 => [
        "category" => "Sistem Pakar Diagnosa Klinis",
        "institution" => "Riset Medis & Fasilitas Kesehatan",
        "tech_stack" => ["PHP Laravel/CI", "MySQL", "Forward Chaining", "Certainty Factor"],
        "description" => "Sistem pakar pendeteksi indikasi kelainan kelenjar getah bening yang menggabungkan mesin inferensi Forward Chaining untuk penelusuran aturan dan Certainty Factor untuk mengukur derajat kepastian diagnosa.",
        "features" => [
            "Mesin inferensi rule-base berbasis data klinis dokter spesialis",
            "Hasil diagnosa komprehensif dengan persentase probabilitas akurasi",
            "Panduan gejala dan saran tindak lanjut ke dokter spesialis",
            "Manajemen basis pengetahuan (knowledge-base) dinamis"
        ],
        "image" => "https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
    ],
    9 => [
        "category" => "Smart Agriculture & Perkebunan",
        "institution" => "Kelompok Tani Kakao Sulawesi Tenggara",
        "tech_stack" => ["PHP Native", "MySQL", "Case-Based Reasoning (CBR)", "Teorema Bayes"],
        "description" => "Aplikasi pendukung keputusan diagnosis serangan hama dan penyakit tanaman perkebunan kakao. Menggunakan pendekatan pencocokan kasus historis (CBR) dan probabilitas Bayes untuk penanganan tepat sasaran.",
        "features" => [
            "Deteksi dini hama penggerek buah (PBK), busuk buah, dan jamur akar",
            "Saran takaran pestisida alami dan kimiawi yang ramah lingkungan",
            "Katalog ensiklopedia penyakit kakao dengan panduan visual",
            "Konsultasi terarah ke penyuluh pertanian lapangan"
        ],
        "image" => "https://images.unsplash.com/photo-1599839575945-a9e5af0c3fa5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
    ],
    8 => [
        "category" => "Aplikasi Mobile & Usaha Jasa",
        "institution" => "Laundry Service Center",
        "tech_stack" => ["Android Mobile", "RESTful API", "Push Notification", "WhatsApp Gateway"],
        "description" => "Aplikasi mobile layanan binatu (laundry) yang menghubungkan pelanggan dengan outlet secara transparan. Pelanggan dapat memantau status pencucian dari smartphone hingga pesanan diantar ke alamat.",
        "features" => [
            "Pemesanan penjemputan (pickup) cucian via aplikasi",
            "Pelacakan status: Masuk Antrean > Dicuci > Disetrika > Siap Diantar",
            "Notifikasi otomatis via WhatsApp saat cucian selesai",
            "Manajemen kasir dan nota tagihan digital paperless"
        ],
        "image" => "https://images.unsplash.com/photo-1545173168-9f1947eebb7f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
    ]
];

// Ambil project yang statusnya 'Selesai' (Maksimal 12)
$query = "SELECT id, name, client_name, client_institution, platform, cover_image FROM projects WHERE status = 'Selesai' ORDER BY id DESC LIMIT 12";
$result = $conn->query($query);

$portfolio = [];

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = (int)$row['id'];
        $meta = $caseStudies[$id] ?? null;

        // Cover image fallback
        $img = 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
        if (!empty($row['cover_image'])) {
            $img = 'storage/' . $row['cover_image'];
        } elseif ($meta && !empty($meta['image'])) {
            $img = $meta['image'];
        }

        $institution = !empty($row['client_institution']) 
            ? $row['client_institution'] 
            : ($meta['institution'] ?? 'Kabupaten Bombana / Sulawesi Tenggara');

        $category = $meta['category'] ?? ($row['platform'] ?? 'Web Application');

        $techStack = $meta['tech_stack'] ?? [
            $row['platform'] ?: 'Web App',
            'PHP',
            'MySQL',
            'Bootstrap 5',
            'Responsive Design'
        ];

        $description = $meta['description'] ?? (
            'Sistem perangkat lunak kustom yang dirancang dan dibangun oleh tim Skillance Digital Indonesia untuk ' . 
            $row['client_name'] . '. Mengutamakan kecepatan akses, keamanan data, serta alur kerja yang intuitif.'
        );

        $features = $meta['features'] ?? [
            'Arsitektur basis data relasional terstruktur dan efisien',
            'Antarmuka modern ramah pengguna di semua ukuran layar (Mobile & Desktop)',
            'Manajemen hak akses pengguna dan pengamanan data terenkripsi',
            'Didukung garansi teknis purna jual dan pendampingan implementasi'
        ];

        $portfolio[] = [
            "id" => $id,
            "name" => $row['name'],
            "client_name" => $row['client_name'],
            "institution" => $institution,
            "category" => $category,
            "platform" => $row['platform'],
            "image" => $img,
            "tech_stack" => $techStack,
            "description" => $description,
            "features" => $features
        ];
    }
}

echo json_encode(["status" => "success", "data" => $portfolio]);

$conn->close();
?>
