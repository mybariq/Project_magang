-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2025 at 03:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diskominfp`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggotas`
--

CREATE TABLE `anggotas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `kategori` enum('Aplikasi','Jaringan','Persandian') DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anggotas`
--

INSERT INTO `anggotas` (`id`, `nama`, `username`, `password`, `kategori`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Anggota Aplikasi 1', 'anggota_aplikasi_1', '$2y$10$n6W3GFD1WZrOdKBZJlsi4uvSUZM.cWgktz/2yuUHAc3TogoqbQ2Yy', 'Aplikasi', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01'),
(2, 'Anggota Aplikasi 2', 'anggota_aplikasi_2', '$2y$10$n6W3GFD1WZrOdKBZJlsi4uvSUZM.cWgktz/2yuUHAc3TogoqbQ2Yy', 'Aplikasi', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01'),
(3, 'Anggota Aplikasi 3', 'anggota_aplikasi_3', '$2y$10$n6W3GFD1WZrOdKBZJlsi4uvSUZM.cWgktz/2yuUHAc3TogoqbQ2Yy', 'Aplikasi', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01'),
(4, 'Anggota Jaringan 1', 'anggota_jaringan_1', '$2y$10$n6W3GFD1WZrOdKBZJlsi4uvSUZM.cWgktz/2yuUHAc3TogoqbQ2Yy', 'Jaringan', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01'),
(5, 'Anggota Jaringan 2', 'anggota_jaringan_2', '$2y$10$n6W3GFD1WZrOdKBZJlsi4uvSUZM.cWgktz/2yuUHAc3TogoqbQ2Yy', 'Jaringan', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01'),
(6, 'Anggota Jaringan 3', 'anggota_jaringan_3', '$2y$10$n6W3GFD1WZrOdKBZJlsi4uvSUZM.cWgktz/2yuUHAc3TogoqbQ2Yy', 'Jaringan', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01'),
(7, 'Anggota Persandian 1', 'anggota_persandian_1', '$2y$10$n6W3GFD1WZrOdKBZJlsi4uvSUZM.cWgktz/2yuUHAc3TogoqbQ2Yy', 'Persandian', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01'),
(8, 'Anggota Persandian 2', 'anggota_persandian_2', '$2y$10$n6W3GFD1WZrOdKBZJlsi4uvSUZM.cWgktz/2yuUHAc3TogoqbQ2Yy', 'Persandian', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01'),
(9, 'Anggota Persandian 3', 'anggota_persandian_3', '$2y$10$n6W3GFD1WZrOdKBZJlsi4uvSUZM.cWgktz/2yuUHAc3TogoqbQ2Yy', 'Persandian', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `ketuas`
--

CREATE TABLE `ketuas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `kategori` enum('Aplikasi','Jaringan','Persandian') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ketuas`
--

INSERT INTO `ketuas` (`id`, `nama`, `username`, `password`, `kategori`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ketua Aplikasi', 'ketua_aplikasi', '$2y$10$n6W3GFD1WZrOdKBZJlsi4uvSUZM.cWgktz/2yuUHAc3TogoqbQ2Yy', 'Aplikasi', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01'),
(2, 'Ketua Jaringan', 'ketua_jaringan', '$2y$10$n6W3GFD1WZrOdKBZJlsi4uvSUZM.cWgktz/2yuUHAc3TogoqbQ2Yy', 'Jaringan', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01'),
(3, 'Ketua Persandian', 'ketua_persandian', '$2y$10$n6W3GFD1WZrOdKBZJlsi4uvSUZM.cWgktz/2yuUHAc3TogoqbQ2Yy', 'Persandian', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaduans`
--

CREATE TABLE `pengaduans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(30) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `bukti_foto` varchar(255) DEFAULT NULL,
  `perlu_perhatian` tinyint(1) NOT NULL DEFAULT 0,
  `catatan_perhatian` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'baru',
  `ketua_id` bigint(20) UNSIGNED DEFAULT NULL,
  `anggota_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ketua` varchar(255) DEFAULT NULL,
  `anggota` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaduans`
--

INSERT INTO `pengaduans` (`id`, `nama`, `email`, `no_hp`, `kategori`, `judul`, `isi`, `bukti_foto`, `perlu_perhatian`, `catatan_perhatian`, `status`, `ketua_id`, `anggota_id`, `ketua`, `anggota`, `created_at`, `updated_at`) VALUES
(1, 'Budi', 'budi@example.com', '085600000001', 'Aplikasi', 'Aplikasi tidak bisa login', 'Saat mencoba login muncul error 500. Mohon ditindaklanjuti.', NULL, 0, NULL, 'baru', 1, NULL, 'Ketua Aplikasi', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01'),
(2, 'Siti', 'siti@example.com', '085600000002', 'Jaringan', 'Internet sering putus', 'Koneksi sering terputus sejak kemarin sore.', NULL, 0, NULL, 'baru', 2, NULL, 'Ketua Jaringan', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01'),
(3, 'Agus', 'agus@example.com', '085600000003', 'Persandian', 'Permintaan akses sandi', 'Butuh akses ke layanan sandi internal, mohon proses.', NULL, 0, NULL, 'baru', 3, NULL, 'Ketua Persandian', NULL, '2025-12-30 02:13:01', '2025-12-30 02:13:01'),
(4, 'sistri', 'sistri@example.com', '087840007522', 'Persandian', 'Tukar Kata Sandi', 'Ada Penyalahgunaan menyebabkan rahasia perusahaan terbongkar', 'bukti/EempDBa4KvHjadIpgsxJX5C5TptI9qeZ8NsfWGYq.png', 0, NULL, 'selesai', 3, 7, 'Ketua Persandian', 'Anggota Persandian 1', '2025-12-30 02:16:44', '2025-12-30 02:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `perhatian_notifications`
--

CREATE TABLE `perhatian_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengaduan_id` bigint(20) UNSIGNED NOT NULL,
  `ketua_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perhatian_notifications`
--

INSERT INTO `perhatian_notifications` (`id`, `pengaduan_id`, `ketua_id`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Mohon tinjau pengaduan ini, dampak luas.', 0, '2025-12-30 02:13:01', '2025-12-30 02:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggotas`
--
ALTER TABLE `anggotas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `anggotas_username_unique` (`username`);

--
-- Indexes for table `ketuas`
--
ALTER TABLE `ketuas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ketuas_username_unique` (`username`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengaduans`
--
ALTER TABLE `pengaduans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengaduans_ketua_id_foreign` (`ketua_id`),
  ADD KEY `pengaduans_anggota_id_foreign` (`anggota_id`);

--
-- Indexes for table `perhatian_notifications`
--
ALTER TABLE `perhatian_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perhatian_pengaduan_id_idx` (`pengaduan_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggotas`
--
ALTER TABLE `anggotas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ketuas`
--
ALTER TABLE `ketuas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengaduans`
--
ALTER TABLE `pengaduans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `perhatian_notifications`
--
ALTER TABLE `perhatian_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengaduans`
--
ALTER TABLE `pengaduans`
  ADD CONSTRAINT `pengaduans_anggota_id_foreign` FOREIGN KEY (`anggota_id`) REFERENCES `anggotas` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengaduans_ketua_id_foreign` FOREIGN KEY (`ketua_id`) REFERENCES `ketuas` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `perhatian_notifications`
--
ALTER TABLE `perhatian_notifications`
  ADD CONSTRAINT `perhatian_pengaduan_fk` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
