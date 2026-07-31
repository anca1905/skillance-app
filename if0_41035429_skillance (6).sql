-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 31, 2026 at 06:31 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_41035429_skillance`
--

-- --------------------------------------------------------

--
-- Table structure for table `agendas`
--

CREATE TABLE `agendas` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `priority` enum('normal','high','critical') COLLATE utf8mb4_general_ci DEFAULT 'normal',
  `is_completed` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','completed') COLLATE utf8mb4_general_ci DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `author` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `excerpt` text NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `badge_class` varchar(100) DEFAULT 'bg-navy-subtle text-navy',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `category`, `author`, `date`, `excerpt`, `content`, `image`, `badge_class`, `created_at`) VALUES
(1, 'Mengapa Bisnis Anda Butuh Sistem Informasi di Tahun Ini?', 'Edukasi Bisnis', 'Arsyad', '2026-02-24', 'Di era digital, pencatatan manual di buku sangat rawan hilang dan tidak efisien. Simak alasannya di sini.', '<p>Dalam dunia bisnis yang bergerak cepat, mengandalkan kertas dan pena untuk pencatatan transaksi atau manajemen inventaris bukan lagi pilihan yang bijak. Kertas bisa hilang, basah, atau terselip.</p><p>Sistem Informasi (seperti Skillance POS atau S-OS) tidak hanya mengamankan data Anda di Cloud, tapi juga memberikan kemudahan analisis. Anda bisa tahu produk apa yang paling laris hanya dengan 1 klik.</p><p>Sudah saatnya bisnis Anda naik kelas. Jangan biarkan kompetitor mencuri *start* transformasi digital ini.</p>', 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'bg-gold-subtle text-gold', '2026-03-22 16:36:59'),
(2, 'Laskar Wonua: Wadah Tumbuh Kembang Talenta Digital Kolaka', 'Komunitas', 'Skillance Team', '2026-02-20', 'Skillance meluncurkan program CSR untuk mewadahi generasi muda yang ingin belajar Hard Skill & Soft Skill.', '<p>Kami menyadari bahwa potensi anak muda di Kolaka dan sekitarnya sangat besar. Namun, akses terhadap mentor dan proyek nyata di bidang teknologi masih terbatas.</p><p>Oleh karena itu, kami di CV Skillance Digital Indonesia meluncurkan <strong>Laskar Wonua</strong>. Ini adalah ruang belajar bagi siapa saja yang ingin mendalami *Web Development*, *Mobile Apps*, hingga *Leadership*.</p><p>Mari bergabung dan bangun ekosistem digital dari daerah kita sendiri!</p>', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80', 'bg-navy-subtle text-navy', '2026-03-22 16:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `finances`
--

CREATE TABLE `finances` (
  `id` int NOT NULL,
  `project_id` int DEFAULT NULL,
  `type` enum('income','expense') COLLATE utf8mb4_general_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'Lainnya',
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finances`
--

INSERT INTO `finances` (`id`, `project_id`, `type`, `amount`, `description`, `category`, `date`, `created_at`) VALUES
(2, NULL, 'income', '3500000.00', 'Cash Kantor', 'Lainnya', '2026-02-28', '2026-03-01 14:35:29'),
(3, NULL, 'expense', '50000.00', 'Gaji Karyawan Agus', 'Lainnya', '2026-03-01', '2026-03-01 14:35:50'),
(4, NULL, 'expense', '50000.00', 'Gaji Karyawan Caca', 'Lainnya', '2026-03-01', '2026-03-01 14:36:14'),
(7, NULL, 'expense', '50000.00', 'Gaji Elesse ', 'Lainnya', '2026-03-03', '2026-03-03 02:52:42'),
(8, 7, 'income', '750000.00', 'Pembayaran Project: SISTEM INFORMASI MANAJEMEN ANTRIAN DAN PENDAFTARAN  PASIEN PADA KLINIK GIGI BERBASIS WEB', 'Project', '2026-03-03', '2026-03-03 11:42:06'),
(9, 6, 'income', '1000000.00', 'Pembayaran Project: PERANCANGAN SISTEM INFORMASI ABSENSIKARYAWAN BERBASIS QR CODE PADA PT DAMAI JAYA LESTARI', 'Project', '2026-03-03', '2026-03-04 02:56:06'),
(14, NULL, 'expense', '500793.00', 'Investasi: Modal Investasi Darni', 'Modal Investasi', '2026-03-08', '2026-03-10 14:40:04');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int NOT NULL,
  `invoice_number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `project_id` int DEFAULT NULL,
  `client_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `client_address` text COLLATE utf8mb4_general_ci,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('UNPAID','PAID') COLLATE utf8mb4_general_ci DEFAULT 'UNPAID',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int NOT NULL,
  `invoice_id` int NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `price` decimal(15,2) NOT NULL,
  `total` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `client_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `client_contact` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `client_institution` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `platform` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Web App',
  `deadline` date NOT NULL,
  `status` enum('Development','Testing','On Hold','Selesai') COLLATE utf8mb4_general_ci DEFAULT 'Development',
  `payment_status` enum('Belum Bayar','DP (Sebagian Lunas)','Lunas') COLLATE utf8mb4_general_ci DEFAULT 'Belum Bayar',
  `price` bigint NOT NULL DEFAULT '0',
  `dp_amount` bigint NOT NULL DEFAULT '0',
  `cover_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `client_name`, `client_contact`, `client_institution`, `platform`, `deadline`, `status`, `payment_status`, `price`, `dp_amount`, `cover_image`, `created_at`) VALUES
(6, 'PERANCANGAN SISTEM INFORMASI ABSENSIKARYAWAN BERBASIS QR CODE PADA PT DAMAI JAYA LESTARI', 'Amanda', '+62 823-4862-4473', 'Universitas Sembilanbelas November Kolaka', 'Web App (PHP Native)', '2026-12-31', 'Testing', 'DP (Sebagian Lunas)', 1500000, 1000000, '', '2026-03-02 22:26:17'),
(7, 'SISTEM INFORMASI MANAJEMEN ANTRIAN DAN PENDAFTARAN  PASIEN PADA KLINIK GIGI BERBASIS WEB', 'Arifa', '+62 858-2377-9751', 'Universitas Sembilanbelas November Kolaka', 'Web App (PHP Native)', '2026-12-31', 'Testing', 'DP (Sebagian Lunas)', 1500000, 750000, '', '2026-03-03 00:09:30'),
(8, 'Sistem Informasi Laudry Berbasis Android dengan Status Pesanan dan Notifikasi', 'Putri', '+62 815-4321-7636', 'Universitas Sembilanbelas November Kolaka ', 'Mobile App (Android/iOS)', '2026-12-31', 'On Hold', 'Belum Bayar', 1500000, 0, '', '2026-03-03 07:22:38'),
(9, 'RANCANG BANGUN SISTEM CASE BASE REASONING  DALAM DIAGNOSIS HAMA DAN PENYAKIT KAKAO  MENGGUNAKAN METODE THEOREMA BAYES', 'Ghea', '+62 822-9029-8955', 'Universitas Sembilanbelas November ', 'Web App (PHP Native)', '2026-12-31', 'On Hold', 'Belum Bayar', 1500000, 0, '', '2026-03-05 13:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `project_addons`
--

CREATE TABLE `project_addons` (
  `id` int NOT NULL,
  `project_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_docs`
--

CREATE TABLE `project_docs` (
  `id` int NOT NULL,
  `project_id` int NOT NULL,
  `title` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `sort_order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `order_num` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `name`, `position`, `photo`, `instagram`, `linkedin`, `github`, `order_num`, `created_at`) VALUES
(1, 'N/A', 'CEO & Founder', NULL, '', '', '', 1, '2026-03-22 16:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `transaction_date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` enum('income','expense') COLLATE utf8mb4_general_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `buy_price` decimal(15,2) DEFAULT NULL,
  `sell_price` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','staff','investor') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `photo`) VALUES
(1, 'Administrator', 'admin@skillance.id', '$2a$12$Gl7QWQRSiPZI3.VX04rViOMnokW6biYeOolyGoH1Vi.WdYCX282hW', 'admin', '2026-02-16 15:24:46', NULL),
(2, 'Darniati', 'darni@investor.com', '$2y$10$h8LsAkZ23lx7uiIZqJmfTea1d8db3w2c/q0z8kB0vk43zBvR/EbZG', 'investor', '2026-03-09 17:41:59', NULL),
(3, 'Fajar', 'fajar@investor.com', '$2y$10$h8LsAkZ23lx7uiIZqJmfTea1d8db3w2c/q0z8kB0vk43zBvR/EbZG', 'investor', '2026-03-12 07:29:53', NULL),
(4, 'elesse', 'elesse@skillance.id', '$2y$10$2fHGo3WIwfN.Nim5Mck4K.F2FNpRsPaFhJHc1x9i7kRH7MEpU6HeW', 'staff', '2026-03-22 11:50:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agendas`
--
ALTER TABLE `agendas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finances`
--
ALTER TABLE `finances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_addons`
--
ALTER TABLE `project_addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_docs`
--
ALTER TABLE `project_docs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agendas`
--
ALTER TABLE `agendas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `finances`
--
ALTER TABLE `finances`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project_addons`
--
ALTER TABLE `project_addons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `project_docs`
--
ALTER TABLE `project_docs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `fk_invoice_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `fk_item_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_docs`
--
ALTER TABLE `project_docs`
  ADD CONSTRAINT `fk_docs_project` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
