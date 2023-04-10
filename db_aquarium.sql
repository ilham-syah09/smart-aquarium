-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Apr 2023 pada 03.56
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
-- Struktur dari tabel `sensor`
--

CREATE TABLE `sensor` (
  `id` int(11) NOT NULL,
  `kekeruhan` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sensor`
--

INSERT INTO `sensor` (`id`, `kekeruhan`, `created_at`) VALUES
(1, 13.18, '2023-04-07 03:50:11'),
(2, 9.96, '2023-04-07 03:50:15'),
(3, 10.06, '2023-04-07 03:50:19'),
(4, 9.96, '2023-04-07 03:50:22'),
(5, 10.06, '2023-04-07 03:50:25'),
(6, 12.79, '2023-04-07 03:50:33'),
(7, 10.16, '2023-04-07 03:50:38'),
(8, 10.06, '2023-04-07 03:50:41'),
(9, 12.89, '2023-04-07 03:50:48'),
(10, 13.09, '2023-04-07 03:50:50'),
(11, 10.06, '2023-04-07 03:50:55'),
(12, 12.99, '2023-04-07 03:51:07'),
(13, 10.25, '2023-04-07 03:51:10'),
(14, 10.16, '2023-04-07 03:51:13'),
(15, 10.06, '2023-04-07 03:51:16'),
(16, 10.25, '2023-04-07 03:51:24'),
(17, 11.91, '2023-04-07 03:51:30'),
(18, 13.09, '2023-04-07 03:51:37'),
(19, 11.62, '2023-04-07 03:51:45'),
(21, 10.25, '2023-04-07 03:51:53'),
(22, 15.92, '2023-04-07 04:05:32'),
(23, 10.06, '2023-04-07 04:05:37'),
(24, 10.25, '2023-04-07 04:05:40'),
(25, 10.06, '2023-04-07 04:05:43'),
(26, 10.64, '2023-04-07 04:05:47'),
(27, 10.06, '2023-04-07 04:05:57'),
(28, 13.18, '2023-04-07 04:06:00'),
(29, 11.62, '2023-04-07 04:06:03'),
(30, 13.09, '2023-04-07 04:06:07'),
(31, 13.18, '2023-04-07 04:06:10'),
(32, 10.25, '2023-04-07 04:06:15'),
(33, 13.09, '2023-04-07 04:06:18'),
(34, 10.16, '2023-04-07 04:06:21'),
(35, 12.89, '2023-04-07 04:06:24'),
(36, 10.06, '2023-04-07 04:06:27'),
(37, 13.09, '2023-04-07 04:06:30'),
(38, 10.25, '2023-04-07 04:06:32'),
(39, 13.09, '2023-04-07 04:06:35'),
(40, 10.64, '2023-04-07 04:06:39'),
(41, 10.25, '2023-04-07 04:06:42'),
(42, 10.35, '2023-04-07 04:06:49'),
(43, 9.96, '2023-04-07 04:06:58'),
(44, 10.35, '2023-04-07 04:07:02'),
(45, 13.28, '2023-04-07 04:07:09'),
(46, 13.18, '2023-04-07 04:07:12'),
(47, 10.55, '2023-04-07 04:07:16'),
(48, 10.35, '2023-04-07 04:07:21'),
(49, 10.84, '2023-04-07 04:07:30'),
(50, 10.55, '2023-04-07 04:07:34'),
(51, 10.35, '2023-04-07 04:07:37'),
(52, 10.84, '2023-04-07 04:07:40'),
(53, 10.35, '2023-04-07 04:07:45'),
(54, 13.18, '2023-04-07 04:07:56'),
(55, 10.25, '2023-04-07 04:07:59'),
(56, 0, '2023-04-07 04:08:07'),
(57, 16.21, '2023-04-07 04:08:10'),
(58, 10.25, '2023-04-07 04:08:13'),
(59, 10.35, '2023-04-07 04:08:16'),
(60, 10.25, '2023-04-07 04:08:21'),
(61, 13.18, '2023-04-07 04:08:24'),
(62, 10.25, '2023-04-07 04:08:28'),
(63, 10.35, '2023-04-07 04:08:31'),
(64, 10.25, '2023-04-07 04:08:36'),
(65, 13.18, '2023-04-07 04:08:39'),
(66, 11.23, '2023-04-07 04:08:45'),
(67, 10.25, '2023-04-07 04:08:48'),
(70, 99.8, '2023-04-09 04:45:54'),
(71, 99.22, '2023-04-09 04:46:01'),
(72, 99.8, '2023-04-09 04:46:14'),
(73, 99.22, '2023-04-09 04:46:17'),
(74, 99.8, '2023-04-09 04:46:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `jadwalPakan` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id`, `jadwalPakan`) VALUES
(1, '11:06');

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
(1, 'administrator', 'admin', '139de558e4e18f2d7111da1e36fd5e95.png', '$2y$10$d7q7oE/ydNg/Fgxl5XgCAe.IXpz3Q9CrdvNOD4rzm5nAqfj7M6UFi', '2023-04-06 16:22:18', '2023-04-07 03:43:53');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT untuk tabel `sensor`
--
ALTER TABLE `sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

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
