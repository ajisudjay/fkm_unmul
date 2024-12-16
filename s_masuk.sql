-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2024 pada 04.51
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fkmunmul`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `s_masuk`
--

CREATE TABLE `s_masuk` (
  `id` int(11) NOT NULL,
  `no` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `s_masuk`
--

INSERT INTO `s_masuk` (`id`, `no`, `perihal`, `file`, `tanggal`, `timestamp`) VALUES
(4, '115/UN17/2024', 'Surat Masuk Keempat', '1734220110_4845bf059781b2db3180.pdf', NULL, '2024-12-14 23:48:30'),
(5, '116/UN17/2024', 'Surat Masuk Kelima Edited 3', '1734221010_cd091efd74f6a8e4c897.pdf', '2024-12-16', '2024-12-14 23:50:38');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `s_masuk`
--
ALTER TABLE `s_masuk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `s_masuk`
--
ALTER TABLE `s_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
