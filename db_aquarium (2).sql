-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2023 pada 17.33
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aquarium`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` int(11) NOT NULL,
  `image` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `about`
--

INSERT INTO `about` (`id`, `nama`, `nim`, `image`, `deskripsi`) VALUES
(2, 'Lorem Ipsum', 20202020, 'd3b96f9a1181f56bacc37d12341f6c97.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi minus maxime itaque quisquam tempore dolor delectus, hic et! Debitis iure nisi voluptas vero qui quaerat repudiandae in ipsa nihil. Ex!'),
(3, 'Lorem Ipsum', 18909890, '886554c6bffa44c15bf98e651774482a.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi minus maxime itaque quisquam tempore dolor delectus, hic et! Debitis iure nisi voluptas vero qui quaerat repudiandae in ipsa nihil. Ex!');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sensor`
--

CREATE TABLE `sensor` (
  `id` int(11) NOT NULL,
  `kekeruhan` float NOT NULL,
  `tinggiAir` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `status_pompa` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sensor`
--

INSERT INTO `sensor` (`id`, `kekeruhan`, `tinggiAir`, `status`, `status_pompa`, `created_at`) VALUES
(1, 10, 0, 'KERUH', '', '2023-06-13 12:32:04'),
(2, 4, 0, 'JERNIH', '', '2023-06-13 12:32:09'),
(3, 16.5, 0, 'KERUH', '', '2023-06-13 13:08:35'),
(4, 14.45, 0, 'KERUH', '', '2023-06-13 13:08:42'),
(5, 13.77, 0, 'KERUH', '', '2023-06-13 13:08:45'),
(6, 13.87, 0, 'KERUH', '', '2023-06-13 13:08:48'),
(7, 16.31, 0, 'KERUH', '', '2023-06-13 13:08:54'),
(8, 24.61, 0, 'KERUH', '', '2023-06-13 13:08:59'),
(9, 13.96, 0, 'KERUH', '', '2023-06-13 13:09:04'),
(10, 13.77, 0, 'KERUH', '', '2023-06-13 13:09:08'),
(11, 24.41, 0, 'KERUH', '', '2023-06-13 13:09:11'),
(12, 13.67, 0, 'KERUH', '', '2023-06-13 13:09:15'),
(13, 13.96, 0, 'KERUH', '', '2023-06-13 13:09:19'),
(14, 13.77, 0, 'KERUH', '', '2023-06-13 13:09:22'),
(15, 13.96, 0, 'KERUH', '', '2023-06-13 13:09:41'),
(16, 14.26, 0, 'KERUH', '', '2023-06-13 13:09:45'),
(17, 13.67, 0, 'KERUH', '', '2023-06-13 13:09:49'),
(18, 13.96, 0, 'KERUH', '', '2023-06-13 13:09:52'),
(19, 13.87, 0, 'KERUH', '', '2023-06-13 13:10:03'),
(22, 14.26, 0, 'KERUH', '', '2023-06-13 13:10:14'),
(23, 14.36, 0, 'KERUH', '', '2023-06-13 13:10:17'),
(24, 17.09, 0, 'KERUH', '', '2023-06-13 13:10:23'),
(25, 14.16, 0, 'KERUH', '', '2023-06-13 13:10:27'),
(26, 24.51, 0, 'KERUH', '', '2023-06-13 13:10:35'),
(27, 17.09, 0, 'KERUH', '', '2023-06-13 13:10:39'),
(28, 8, 0, 'KERUH', 'SELESAI KURAS', '2023-06-18 01:18:35'),
(29, 5, 0, 'JERNIH', 'SELESAI KURAS', '2023-06-18 01:19:13'),
(30, 8, 0, 'KERUH', 'KURAS', '2023-06-18 01:19:33'),
(31, 15, 0, 'KERUH', 'KURAS', '2023-06-18 01:46:36'),
(32, 5, 0, 'JERNIH', 'SELESAI KURAS', '2023-06-18 01:47:00'),
(33, 24.02, 7, 'KERUH', 'KURAS', '2023-06-26 13:29:51'),
(34, 18.16, 8, 'KERUH', 'KURAS', '2023-06-26 13:31:05'),
(35, 18.46, 7, 'KERUH', 'KURAS', '2023-06-26 13:31:08'),
(36, 0, 6, 'JERNIH', 'SELESAI KURAS', '2023-06-26 13:54:17'),
(37, 13.48, 7, 'KERUH', 'KURAS', '2023-06-26 13:56:38'),
(38, 14.26, 8, 'KERUH', 'KURAS', '2023-06-26 14:15:27'),
(39, 19.63, 7, 'KERUH', 'KURAS', '2023-06-26 14:15:30'),
(40, 14.36, 8, 'KERUH', 'KURAS', '2023-06-26 14:15:32'),
(41, 16.21, 7, 'KERUH', 'KURAS', '2023-06-26 14:15:36'),
(42, 15.53, 6, 'KERUH', 'KURAS', '2023-06-26 14:15:39'),
(43, 22.56, 7, 'KERUH', 'KURAS', '2023-06-26 14:15:41'),
(44, 17.97, 8, 'KERUH', 'KURAS', '2023-06-26 14:16:34'),
(45, 17.87, 7, 'KERUH', 'KURAS', '2023-06-26 14:16:37'),
(46, 18.75, 8, 'KERUH', 'KURAS', '2023-06-26 14:16:48'),
(47, 18.85, 7, 'KERUH', 'KURAS', '2023-06-26 14:16:52'),
(48, 18.75, 8, 'KERUH', 'KURAS', '2023-06-26 14:16:59'),
(49, 18.65, 7, 'KERUH', 'KURAS', '2023-06-26 14:17:01'),
(50, 20.61, 8, 'KERUH', 'KURAS', '2023-06-26 14:17:12'),
(51, 19.92, 7, 'KERUH', 'KURAS', '2023-06-26 14:17:13'),
(52, 19.73, 8, 'KERUH', 'KURAS', '2023-06-26 14:17:32'),
(53, 25.59, 7, 'KERUH', 'KURAS', '2023-06-26 14:17:34'),
(54, 25.29, 8, 'KERUH', 'KURAS', '2023-06-26 14:17:35'),
(55, 24.22, 7, 'KERUH', 'KURAS', '2023-06-26 14:17:37'),
(56, 32.23, 6, 'KERUH', 'KURAS', '2023-06-26 14:17:53'),
(57, 30.27, 7, 'KERUH', 'KURAS', '2023-06-26 14:17:55'),
(58, 27.25, 8, 'KERUH', 'KURAS', '2023-06-26 14:18:15'),
(59, 27.73, 7, 'KERUH', 'KURAS', '2023-06-26 14:18:17'),
(60, 25.98, 8, 'KERUH', 'KURAS', '2023-06-26 14:18:31'),
(61, 27.54, 7, 'KERUH', 'KURAS', '2023-06-26 14:18:34'),
(62, 17.97, 8, 'KERUH', 'KURAS', '2023-06-26 14:19:07'),
(63, 13.77, 7, 'KERUH', 'KURAS', '2023-06-26 14:19:09'),
(64, 18.16, 8, 'KERUH', 'KURAS', '2023-06-26 14:19:22'),
(65, 17.97, 7, 'KERUH', 'KURAS', '2023-06-26 14:19:40'),
(66, 18.26, 8, 'KERUH', 'KURAS', '2023-06-26 14:19:42'),
(67, 18.16, 7, 'KERUH', 'KURAS', '2023-06-26 14:19:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `jadwal1` varchar(6) NOT NULL,
  `jadwal2` varchar(6) NOT NULL,
  `jadwal3` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id`, `jadwal1`, `jadwal2`, `jadwal3`) VALUES
(1, '20:36', '20:38', '21:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `image` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `image`, `password`, `created_at`, `updated_at`) VALUES
(1, 'yfhfjfyufh', 'admin', '3d6be0365368e33af3a95327284e5e3a.jpeg', '$2y$10$aEWBDhaAGsyx9vHfoZenFe4WPOgHEie0Lddie2NzeWhoDnLB8kZ6u', '2023-04-06 16:22:18', '2023-06-24 15:20:15');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sensor`
--
ALTER TABLE `sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
