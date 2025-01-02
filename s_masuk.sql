-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jan 2025 pada 08.09
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

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
  `no_disposisi` varchar(255) NOT NULL,
  `tgl_sm` date DEFAULT NULL,
  `no_surat` varchar(255) NOT NULL,
  `tgl_surat` date DEFAULT NULL,
  `perihal` varchar(255) NOT NULL,
  `asal_surat` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tahun` int(255) NOT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp(),
  `admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `s_masuk`
--

INSERT INTO `s_masuk` (`id`, `no_disposisi`, `tgl_sm`, `no_surat`, `tgl_surat`, `perihal`, `asal_surat`, `status`, `file`, `keterangan`, `tahun`, `timestamp`, `admin`) VALUES
(4, '115/UN17/2024', '2024-12-16', '123', '2024-12-16', 'Surat Masuk Keempat', 'rektorat', 'selesai', '1734220110_4845bf059781b2db3180.pdf', '', 2024, '2024-12-14 23:48:30', 'ajisudjay'),
(5, '116/UN17/2024', '2024-12-16', '12332321', '2024-12-16', 'Surat Masuk Kelima Edited 5', 'ICT', 'proses', '1734221010_cd091efd74f6a8e4c897.pdf', '', 2024, '2024-12-14 23:50:38', 'ajisudjay'),
(7, '100', '2025-01-01', '100', '2025-01-01', 'Percobaan lengkap', 'Rektorat Bag. Keuangan', 'Belum Disposisi', '1735801742_e9bd5e06cb8b40838636.pdf', 'Sudah diedit gambar', 2025, '2025-01-01 19:09:02', 'ajisudjay'),
(8, '101', '2024-01-01', '101', '2024-01-01', 'jkl', 'jasdkldjaslk', 'Belum Disposisi', '1735801211_c6262dcfe5e88c79bfdf.pdf', 'jlk - ', 2024, '2025-01-01 19:00:11', 'ajisudjay');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
