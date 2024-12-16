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
-- Struktur dari tabel `s_keluar`
--

CREATE TABLE `s_keluar` (
  `id` int(11) NOT NULL,
  `no` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `s_keluar`
--

INSERT INTO `s_keluar` (`id`, `no`, `perihal`, `file`, `tanggal`, `timestamp`) VALUES
(1, '001/DT/2024', 'surat keluar 1 edited 2', '1734222131_dab9bc9d96ea0f0cb9df.pdf', '2024-12-15', '2024-12-15 00:21:39');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `s_keluar`
--
ALTER TABLE `s_keluar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `s_keluar`
--
ALTER TABLE `s_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
