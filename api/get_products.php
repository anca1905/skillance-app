<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Data produk (Nanti bisa dipindahkan ke tabel MySQL 'products' jika diperlukan)
$products = [
    [
        "id" => 1,
        "name" => "S-OS (Skillance Office)",
        "description" => "Sistem manajemen internal lengkap untuk agensi/perusahaan. Meliputi pencatatan keuangan, manajemen proyek, dan auto-invoice.",
        "icon" => "fa-building-shield",
        "color_class" => "navy",
        "features" => ["Keuangan & Tagihan", "Progress Proyek", "Auto-Generate Laporan PDF"],
        "wa_text" => "Halo Skillance, saya tertarik dengan produk S-OS"
    ],
    [
        "id" => 2,
        "name" => "E-PPDB Terpadu",
        "description" => "Sistem Penerimaan Peserta Didik Baru (PPDB). Memudahkan calon siswa mendaftar online, upload berkas, hingga pengumuman kelulusan.",
        "icon" => "fa-graduation-cap",
        "color_class" => "success", // Warna Hijau
        "features" => ["Formulir Pendaftaran Online", "Verifikasi Berkas Admin", "Export Data ke Excel"],
        "wa_text" => "Halo Skillance, saya tertarik dengan produk PPDB Online"
    ],
    [
        "id" => 3,
        "name" => "E-Absensi & Jurnal",
        "description" => "Sistem absensi guru dan siswa menggunakan Scan Barcode/QR Code. Dilengkapi notifikasi kehadiran otomatis ke WhatsApp orang tua.",
        "icon" => "fa-qrcode",
        "color_class" => "info", // Warna Biru Muda
        "features" => ["Scan QR Code / Barcode", "Notifikasi WA Real-time", "Rekap Absensi Bulanan"],
        "wa_text" => "Halo Skillance, saya tertarik dengan produk Sistem Absensi"
    ],
    [
        "id" => 4,
        "name" => "Skillance POS Kasir",
        "description" => "Aplikasi Point of Sales (Kasir) berbasis Cloud yang cocok untuk Cafe, Resto, dan Toko Retail. Pantau stok barang dan omzet harian dari mana saja.",
        "icon" => "fa-cash-register",
        "color_class" => "gold",
        "features" => ["Cetak Struk Bluetooth", "Manajemen Stok", "Analisis Penjualan"],
        "wa_text" => "Halo Skillance, saya tertarik dengan produk POS Kasir"
    ]
];

echo json_encode(["status" => "success", "data" => $products]);
?>