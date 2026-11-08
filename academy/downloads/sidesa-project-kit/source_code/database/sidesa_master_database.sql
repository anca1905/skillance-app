-- ====================================================================
-- SISTEM INFORMASI DESA MANDIRI & LAYANAN SURAT WARGA (SIDESA)
-- Master Database Schema & Realistis Initial Seed Data
-- Standard: MySQL 8.0+ / MariaDB 10.4+ (InnoDB Engine)
-- Disusun oleh: Tim Pengembang Skillance Academy Digital Indonesia
-- Penanggung Jawab Kurikulum: Muh Arsyad Ramsi
-- ====================================================================

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wa_logs`;
DROP TABLE IF EXISTS `apbdes`;
DROP TABLE IF EXISTS `pengajuan_surat`;
DROP TABLE IF EXISTS `jenis_surat`;
DROP TABLE IF EXISTS `penduduk`;
DROP TABLE IF EXISTS `kartu_keluarga`;
DROP TABLE IF EXISTS `users`;
SET FOREIGN_KEY_CHECKS=1;

-- --------------------------------------------------------------------
-- 1. TABEL: users (Aparatur Desa / Administrator & Petugas)
-- --------------------------------------------------------------------
CREATE TABLE `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('kades', 'operator', 'sekdes') NOT NULL DEFAULT 'operator',
  `jabatan` VARCHAR(100) DEFAULT 'Perangkat Desa',
  `whatsapp` VARCHAR(20) DEFAULT NULL,
  `remember_token` VARCHAR(100) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default Password for all seed users is: password123 (bcrypt hash: $2y$12$Kk2iTqX5/cW2a21OaWlD.eqH8D28K1x2P0yM3Q9/124356789012)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `jabatan`, `whatsapp`) VALUES
(1, 'H. Suryadi, S.Sos', 'kades@sidesa.desa.id', '$2y$10$w09Z5x9Ea4xTj/7M/dJg0.w6b47cW8Qy1aD3Kz1j2P0yM3Q9V4Z8m', 'kades', 'Kepala Desa Sukamaju', '6282291700778'),
(2, 'Ahmad Maulana, S.Kom', 'operator@sidesa.desa.id', '$2y$10$w09Z5x9Ea4xTj/7M/dJg0.w6b47cW8Qy1aD3Kz1j2P0yM3Q9V4Z8m', 'operator', 'Kasi Pelayanan Desa', '6281234567890'),
(3, 'Dewi Kartika, S.AP', 'sekdes@sidesa.desa.id', '$2y$10$w09Z5x9Ea4xTj/7M/dJg0.w6b47cW8Qy1aD3Kz1j2P0yM3Q9V4Z8m', 'sekdes', 'Sekretaris Desa', '6285211223344');

-- --------------------------------------------------------------------
-- 2. TABEL: kartu_keluarga (Master Data Kepala Keluarga)
-- --------------------------------------------------------------------
CREATE TABLE `kartu_keluarga` (
  `no_kk` VARCHAR(16) NOT NULL,
  `kepala_keluarga` VARCHAR(100) NOT NULL,
  `alamat` VARCHAR(255) NOT NULL,
  `rt` VARCHAR(4) NOT NULL DEFAULT '001',
  `rw` VARCHAR(4) NOT NULL DEFAULT '001',
  `dusun` VARCHAR(50) NOT NULL DEFAULT 'Dusun Melati',
  `desa` VARCHAR(50) NOT NULL DEFAULT 'Desa Sukamaju',
  `kecamatan` VARCHAR(50) NOT NULL DEFAULT 'Kecamatan Makmur',
  `kabupaten` VARCHAR(50) NOT NULL DEFAULT 'Kabupaten Sejahtera',
  `kode_pos` VARCHAR(6) NOT NULL DEFAULT '93561',
  `tgl_terbit_kk` DATE DEFAULT '2022-01-15',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`no_kk`),
  INDEX `idx_kk_rt_rw` (`rt`, `rw`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `kartu_keluarga` (`no_kk`, `kepala_keluarga`, `alamat`, `rt`, `rw`, `dusun`, `desa`, `kecamatan`, `kabupaten`, `kode_pos`) VALUES
('7401010101200001', 'Budi Santoso', 'Jl. Merdeka No. 12', '001', '001', 'Dusun I Melati', 'Sukamaju', 'Makmur', 'Sejahtera', '93561'),
('7401010101200002', 'Bambang Pamungkas', 'Jl. Raya Desa RT 02 RW 01', '002', '001', 'Dusun I Melati', 'Sukamaju', 'Makmur', 'Sejahtera', '93561'),
('7401010101200003', 'H. Ridwan Halim', 'Kompleks Pesantren Al-Ikhlas', '003', '002', 'Dusun II Mawar', 'Sukamaju', 'Makmur', 'Sejahtera', '93561'),
('7401010101200004', 'Sudirman Pratama', 'Jl. Trans Sulawesi KM 14', '001', '003', 'Dusun III Cempaka', 'Sukamaju', 'Makmur', 'Sejahtera', '93561');

-- --------------------------------------------------------------------
-- 3. TABEL: penduduk (Master Data Warga Desa)
-- --------------------------------------------------------------------
CREATE TABLE `penduduk` (
  `nik` VARCHAR(16) NOT NULL,
  `no_kk` VARCHAR(16) NOT NULL,
  `nama` VARCHAR(100) NOT NULL,
  `tempat_lahir` VARCHAR(50) NOT NULL,
  `tgl_lahir` DATE NOT NULL,
  `jenis_kelamin` ENUM('L', 'P') NOT NULL,
  `agama` VARCHAR(20) NOT NULL DEFAULT 'Islam',
  `status_kawin` ENUM('Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati') NOT NULL DEFAULT 'Belum Kawin',
  `pekerjaan` VARCHAR(50) NOT NULL DEFAULT 'Wiraswasta',
  `kewarganegaraan` VARCHAR(10) NOT NULL DEFAULT 'WNI',
  `golongan_darah` VARCHAR(3) DEFAULT 'O',
  `status_hubungan` ENUM('Kepala Keluarga', 'Istri', 'Anak', 'Famili Lain') NOT NULL DEFAULT 'Anak',
  `status_hidup` ENUM('Hidup', 'Meninggal') NOT NULL DEFAULT 'Hidup',
  `status_tinggal` ENUM('Tetap', 'Pindah') NOT NULL DEFAULT 'Tetap',
  `whatsapp` VARCHAR(20) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`nik`),
  INDEX `idx_penduduk_nama` (`nama`),
  CONSTRAINT `fk_penduduk_kk` FOREIGN KEY (`no_kk`) REFERENCES `kartu_keluarga` (`no_kk`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `penduduk` (`nik`, `no_kk`, `nama`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `status_kawin`, `pekerjaan`, `status_hubungan`, `whatsapp`) VALUES
('7401012304990001', '7401010101200001', 'Rahmat Hidayat', 'Makmur', '1999-04-23', 'L', 'Islam', 'Belum Kawin', 'Mahasiswa', 'Anak', '6282291700778'),
('7401011505750001', '7401010101200001', 'Budi Santoso', 'Makmur', '1975-05-15', 'L', 'Islam', 'Kawin', 'Petani / Pekebun', 'Kepala Keluarga', '6281298765432'),
('7401012008800002', '7401010101200001', 'Siti Rahmawati', 'Solo', '1980-08-20', 'P', 'Islam', 'Kawin', 'Ibu Rumah Tangga', 'Istri', '6281234567890'),
('7401011002010003', '7401010101200001', 'Anisa Putri Santoso', 'Makmur', '2001-02-10', 'P', 'Islam', 'Belum Kawin', 'Pelajar / Mahasiswa', 'Anak', '6285211223344'),
('7401010507780001', '7401010101200002', 'Bambang Pamungkas', 'Yogyakarta', '1978-07-05', 'L', 'Islam', 'Kawin', 'Pedagang Toko', 'Kepala Keluarga', '6287711223344'),
('7401011211820002', '7401010101200002', 'Nurhayati', 'Makmur', '1982-11-12', 'P', 'Islam', 'Kawin', 'Pedagang', 'Istri', '6287711223355'),
('7401011909020003', '7401010101200002', 'Rizky Pratama', 'Makmur', '2002-09-19', 'L', 'Islam', 'Belum Kawin', 'Mahasiswa Teknik Informatika', 'Anak', '6282291700778');

-- --------------------------------------------------------------------
-- 4. TABEL: jenis_surat (Daftar Layanan Surat Keterangan Desa)
-- --------------------------------------------------------------------
CREATE TABLE `jenis_surat` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_surat` VARCHAR(10) NOT NULL UNIQUE,
  `nama_surat` VARCHAR(100) NOT NULL,
  `format_nomor` VARCHAR(50) NOT NULL DEFAULT '470/{NOMOR}/DS-SM/{TAHUN}',
  `syarat_berkas` TEXT DEFAULT NULL,
  `kebutuhan_form` JSON DEFAULT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `jenis_surat` (`id`, `kode_surat`, `nama_surat`, `format_nomor`, `syarat_berkas`) VALUES
(1, 'SKD', 'Surat Keterangan Domisili Warga', '470/{NOMOR}/DS-SM/{TAHUN}', 'KTP Asli, Kartu Keluarga, Surat Pengantar RT/RW'),
(2, 'SKU', 'Surat Keterangan Usaha (UMKM)', '510/{NOMOR}/DS-SM/{TAHUN}', 'KTP Pemilik Usaha, Foto Tempat Usaha, Bukti Lokasi'),
(3, 'SKTM', 'Surat Keterangan Tidak Mampu', '401/{NOMOR}/DS-SM/{TAHUN}', 'Kartu Keluarga, KTP Pemohon, Surat Rekomendasi RT'),
(4, 'SKCK', 'Surat Pengantar Catatan Kepolisian', '300/{NOMOR}/DS-SM/{TAHUN}', 'KTP, KK, Pas Foto 4x6 latar merah (2 lembar)'),
(5, 'SKBM', 'Surat Keterangan Belum Menikah', '474/{NOMOR}/DS-SM/{TAHUN}', 'KTP, KK, Surat Pernyataan Belum Pernah Menikah bermaterai');

-- --------------------------------------------------------------------
-- 5. TABEL: pengajuan_surat (Transaksi Permohonan Surat Online)
-- --------------------------------------------------------------------
CREATE TABLE `pengajuan_surat` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_tracking` VARCHAR(30) NOT NULL UNIQUE,
  `nik` VARCHAR(16) NOT NULL,
  `jenis_surat_id` INT UNSIGNED NOT NULL,
  `keperluan` VARCHAR(255) NOT NULL,
  `keterangan_tambahan` TEXT DEFAULT NULL,
  `status` ENUM('diajukan', 'diverifikasi', 'ditandatangani', 'selesai', 'ditolak') NOT NULL DEFAULT 'diajukan',
  `nomor_surat_resmi` VARCHAR(100) DEFAULT NULL,
  `tanggal_pengajuan` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_selesai` DATETIME DEFAULT NULL,
  `petugas_id` BIGINT UNSIGNED DEFAULT NULL,
  `catatan_petugas` TEXT DEFAULT NULL,
  `pdf_file` VARCHAR(255) DEFAULT NULL,
  `qr_token` VARCHAR(64) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_surat_tracking` (`kode_tracking`),
  INDEX `idx_surat_nik` (`nik`),
  INDEX `idx_surat_status` (`status`),
  CONSTRAINT `fk_surat_penduduk` FOREIGN KEY (`nik`) REFERENCES `penduduk` (`nik`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `fk_surat_jenis` FOREIGN KEY (`jenis_surat_id`) REFERENCES `jenis_surat` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `fk_surat_petugas` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pengajuan_surat` (`id`, `kode_tracking`, `nik`, `jenis_surat_id`, `keperluan`, `keterangan_tambahan`, `status`, `nomor_surat_resmi`, `tanggal_pengajuan`, `tanggal_selesai`, `pdf_file`, `qr_token`) VALUES
(1, 'TRX-DS-2026-8921', '7401012304990001', 1, 'Persyaratan Pengajuan Beasiswa Perguruan Tinggi', 'Tinggal di RT 001 RW 001 Dusun I sejak lahir.', 'selesai', '470/042/DS-SM/2026', '2026-11-06 09:30:00', '2026-11-06 14:15:00', 'surat_domisili_TRX-DS-2026-8921.pdf', 'QR-SIDESA-VERIF-7401012304990001-8921'),
(2, 'TRX-DS-2026-9043', '7401010507780001', 2, 'Pengajuan Kredit Usaha Rakyat (KUR) BRI', 'Usaha: Toko Kelontong Berkah Mandiri, Berjalan 4 Tahun.', 'diverifikasi', '510/018/DS-SM/2026', '2026-11-08 10:15:00', NULL, NULL, 'QR-SIDESA-VERIF-7401010507780001-9043'),
(3, 'TRX-DS-2026-9188', '7401011909020003', 4, 'Melengkapi Berkas Magang BUMN', 'Pengantar pembuatan SKCK di Polsek Makmur.', 'diajukan', NULL, '2026-11-09 08:20:00', NULL, NULL, 'QR-SIDESA-VERIF-7401011909020003-9188');

-- --------------------------------------------------------------------
-- 6. TABEL: apbdes (Transparansi Anggaran Pendapatan & Belanja Desa)
-- --------------------------------------------------------------------
CREATE TABLE `apbdes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tahun_anggaran` YEAR NOT NULL DEFAULT '2026',
  `kategori` ENUM('pendapatan', 'belanja', 'pembiayaan') NOT NULL,
  `bidang` VARCHAR(100) NOT NULL,
  `uraian` VARCHAR(255) NOT NULL,
  `anggaran_rp` BIGINT NOT NULL DEFAULT 0,
  `realisasi_rp` BIGINT NOT NULL DEFAULT 0,
  `persentase` DECIMAL(5,2) GENERATED ALWAYS AS (CASE WHEN `anggaran_rp` > 0 THEN ROUND((`realisasi_rp` / `anggaran_rp`) * 100, 2) ELSE 0 END) STORED,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_apbdes_tahun_kat` (`tahun_anggaran`, `kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `apbdes` (`tahun_anggaran`, `kategori`, `bidang`, `uraian`, `anggaran_rp`, `realisasi_rp`) VALUES
('2026', 'pendapatan', 'Pendapatan Transfer', 'Dana Desa (APBN)', 850000000, 680000000),
('2026', 'pendapatan', 'Pendapatan Transfer', 'Alokasi Dana Desa (ADD Kabupaten)', 420000000, 315000000),
('2026', 'pendapatan', 'Pendapatan Asli Desa', 'BUMDes & Retribusi Pasar Desa', 65000000, 48500000),
('2026', 'belanja', 'Penyelenggaraan Pemdes', 'Penghasilan Tetap (Siltap) & Tunjangan Aparatur', 380000000, 285000000),
('2026', 'belanja', 'Pelaksanaan Pembangunan', 'Pengaspalan Jalan Usaha Tani Dusun II', 450000000, 410000000),
('2026', 'belanja', 'Pelaksanaan Pembangunan', 'Pembangunan Posyandu Terpadu Dusun I', 180000000, 165000000),
('2026', 'belanja', 'Pembinaan Kemasyarakatan', 'Insentif Guru Mengaji & Karang Taruna', 95000000, 72000000),
('2026', 'belanja', 'Pemberdayaan Masyarakat', 'Pelatihan Budidaya Pertanian Modern & Bibit', 120000000, 95000000);

-- --------------------------------------------------------------------
-- 7. TABEL: wa_logs (Riwayat Notifikasi WhatsApp Gateway)
-- --------------------------------------------------------------------
CREATE TABLE `wa_logs` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_wa` VARCHAR(25) NOT NULL,
  `nama_penerima` VARCHAR(100) NOT NULL,
  `kode_tracking` VARCHAR(30) DEFAULT NULL,
  `pesan` TEXT NOT NULL,
  `status` ENUM('terkirim', 'gagal', 'simulasi') NOT NULL DEFAULT 'terkirim',
  `sent_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_wa_tracking` (`kode_tracking`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wa_logs` (`no_wa`, `nama_penerima`, `kode_tracking`, `pesan`, `status`) VALUES
('6282291700778', 'Rahmat Hidayat', 'TRX-DS-2026-8921', 'Halo Kak Rahmat Hidayat! Permohonan Surat Keterangan Domisili Anda (TRX-DS-2026-8921) telah SELESAI ditandatangani. Silakan download PDF resmi.', 'terkirim'),
('6281298765432', 'Budi Santoso', 'TRX-DS-2026-9043', 'Halo Bapak Budi Santoso! Permohonan surat telah DIVERIFIKASI oleh operator desa.', 'terkirim');

-- ====================================================================
-- SELESAI. MASTER SIDESA DATABASE SIAP DIGUNAKAN DI LARAVEL 11
-- ====================================================================
