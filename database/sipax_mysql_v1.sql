-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 10.1.2.110:3306
-- Waktu pembuatan: 25 Jul 2019 pada 08.32
-- Versi server: 10.2.24-MariaDB
-- Versi PHP: 7.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u529167637_sipax`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aturan`
--

CREATE TABLE `aturan` (
  `id_aturan` int(11) NOT NULL,
  `kode_gejala` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ya` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tidak` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `aturan`
--

INSERT INTO `aturan` (`id_aturan`, `kode_gejala`, `ya`, `tidak`) VALUES
(5, 'G001', 'G002', 'G021'),
(6, 'G002', 'G003', 'G020'),
(7, 'G003', 'G004', 'D004'),
(8, 'G004', 'G005', ''),
(9, 'G005', 'G006', ''),
(10, 'G006', 'G007', 'G009'),
(11, 'G007', 'G008', ''),
(12, 'G008', 'D001', ''),
(13, 'G009', 'G010', 'G008'),
(14, 'G010', 'G011', ''),
(15, 'G011', 'G012', ''),
(16, 'G012', 'G013', ''),
(17, 'G013', 'G014', ''),
(18, 'G014', 'G015', ''),
(19, 'G015', 'G016', ''),
(20, 'G016', 'G017', ''),
(21, 'G017', 'G018', ''),
(22, 'G018', 'G019', ''),
(23, 'G019', 'D002', ''),
(24, 'G021', 'G002', ''),
(25, 'G020', 'D003', ''),
(28, 'G016', 'G017', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diagnosa`
--

CREATE TABLE `diagnosa` (
  `kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `solusi` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `diagnosa`
--

INSERT INTO `diagnosa` (`kode`, `nama`, `solusi`) VALUES
('D001', 'Per Akut', ''),
('D002', 'Akut', ''),
('D003', 'Sub Akut', ''),
('D004', 'Kronis', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`kode`, `nama`) VALUES
('G001', 'Sesak nafas'),
('G002', 'Lemas'),
('G003', 'Demam'),
('G004', 'Tubuh gemetaran'),
('G005', 'Nafsu makan berkurang'),
('G006', 'Malas bergerak'),
('G007', 'Rebah'),
('G008', 'Radang otak'),
('G009', 'Malas bergerak'),
('G010', 'Detak jantung gelisah'),
('G011', 'Ruminasi berhenti'),
('G012', 'Ternak bunting keguguran'),
('G013', 'Dijumpai ekskreta berdarah pada lubang kumlah'),
('G014', 'Menggigil kedinginan'),
('G015', 'Menderita kolik berat'),
('G016', 'Terjadi depresi hebat'),
('G017', 'Terjadi diare berdarah'),
('G018', 'Bengkak di daerah leher, dada, perut bagian bawah dan alat kelamin luar'),
('G019', 'Kejang'),
('G020', 'Pembengkakan mendadak pada tenggorokan'),
('G021', 'Pada kelenjar limfe servikal dan tonsil terdapat bakteri anthraks');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_konsultasi`
--

CREATE TABLE `hasil_konsultasi` (
  `id_hasil_konsultasi` int(11) NOT NULL,
  `id_konsultasi` int(11) NOT NULL,
  `id_aturan` int(11) NOT NULL,
  `jawaban` tinyint(1) NOT NULL,
  `cf_user` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `hasil_konsultasi`
--

INSERT INTO `hasil_konsultasi` (`id_hasil_konsultasi`, `id_konsultasi`, `id_aturan`, `jawaban`, `cf_user`) VALUES
(1, 1, 5, 0, 0),
(2, 1, 5, 1, 0.7),
(3, 1, 6, 0, 0),
(4, 1, 6, 0, 0),
(5, 1, 6, 0, 0),
(6, 1, 25, 1, 1),
(7, 2, 5, 0, 0),
(8, 2, 24, 1, 0.7),
(9, 2, 6, 0, 0),
(10, 2, 25, 1, 0.7),
(11, 3, 5, 0, 0),
(12, 3, 24, 0, 0),
(13, 4, 5, 1, 0.3),
(14, 4, 6, 1, 0.3),
(15, 4, 7, 1, 0.3),
(16, 4, 8, 1, 0.3),
(17, 4, 9, 1, 0.3),
(18, 4, 10, 1, 0.3),
(19, 4, 11, 1, 0.3),
(20, 4, 12, 1, 0.3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` int(11) NOT NULL,
  `nama_penderita` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_penderita` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_diagnosa` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasil_cf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_user` int(11) NOT NULL,
  `usia_penderita` int(11) NOT NULL,
  `alamat_penderita` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `nama_penderita`, `jenis_penderita`, `kode_diagnosa`, `hasil_cf`, `tanggal`, `id_user`, `usia_penderita`, `alamat_penderita`) VALUES
(1, 'Pak Suyit', 'Sapi', 'D003', '1.00', '2019-07-25 08:15:56', 2, 13, 'Tirtomartani'),
(2, 'Sapi Mas Hanan', 'Sapi', 'D003', '0.74', '2019-07-25 08:18:29', 2, 33, 'Depok'),
(3, 'Sapi Pak Agus', 'Sapi', NULL, NULL, '2019-07-25 08:18:57', 2, 12, 'Kaliurang'),
(4, 'Kambing Tian', 'Kambing', 'D001', '0.82', '2019-07-25 08:23:51', 2, 7, 'Wates');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pakar`
--

CREATE TABLE `pakar` (
  `id_pakar` int(11) NOT NULL,
  `kode_diagnosa` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_gejala` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mb` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `md` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `pakar`
--

INSERT INTO `pakar` (`id_pakar`, `kode_diagnosa`, `kode_gejala`, `mb`, `md`) VALUES
(1, 'D001', 'G001', '0.6', '0.1'),
(2, 'D001', 'G002', '0.6', '0.1'),
(3, 'D001', 'G003', '0.8', '0'),
(4, 'D001', 'G004', '0.6', '0.1'),
(5, 'D001', 'G005', '0.5', '0.1'),
(6, 'D001', 'G006', '0.9', '0.1'),
(7, 'D001', 'G007', '0.8', '0.2'),
(8, 'D001', 'G008', '1', '0'),
(9, 'D002', 'G001', '0.6', '0.2'),
(10, 'D002', 'G002', '0.6', '0.1'),
(11, 'D002', 'G003', '0.8', '0.2'),
(12, 'D002', 'G004', '0.6', '0.2'),
(13, 'D002', 'G005', '0.5', '0.1'),
(14, 'D002', 'G009', '0.9', '0.1'),
(15, 'D002', 'G010', '0.6', '0.2'),
(16, 'D002', 'G011', '0.6', '0.2'),
(17, 'D002', 'G012', '0.3', '0.2'),
(18, 'D002', 'G013', '0.6', '0.1'),
(19, 'D002', 'G014', '0.9', '0'),
(20, 'D002', 'G015', '0.9', '0.1'),
(21, 'D002', 'G016', '0.6', '0.1'),
(22, 'D002', 'G017', '0.3', '0.2'),
(23, 'D002', 'G018', '1', '0'),
(24, 'D002', 'G019', '0.6', '0.2'),
(25, 'D003', 'G001', '0.3', '0.1'),
(26, 'D003', 'G020', '1', '0'),
(27, 'D004', 'G002', '0.5', '0.3'),
(28, 'D004', 'G021', '1', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `status`, `email`) VALUES
(1, 'pakar', 'pakar', 'pakar', 1, 'bbvetwates@pertanian.go.id'),
(2, 'petugas', 'petugas', 'petugas', 1, 'petugas@sipax.co');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_list_aturan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_list_aturan` (
`kode` varchar(10)
,`nama` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_list_aturan`
--
DROP TABLE IF EXISTS `v_list_aturan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`u529167637_sipax`@`10.1.2.19` SQL SECURITY DEFINER VIEW `v_list_aturan`  AS  select `gejala`.`kode` AS `kode`,`gejala`.`nama` AS `nama` from `gejala` union select `diagnosa`.`kode` AS `kode`,`diagnosa`.`nama` AS `nama` from `diagnosa` order by 1 ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id_aturan`) USING BTREE;

--
-- Indeks untuk tabel `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD PRIMARY KEY (`kode`) USING BTREE;

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`kode`) USING BTREE;

--
-- Indeks untuk tabel `hasil_konsultasi`
--
ALTER TABLE `hasil_konsultasi`
  ADD PRIMARY KEY (`id_hasil_konsultasi`) USING BTREE;

--
-- Indeks untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`) USING BTREE;

--
-- Indeks untuk tabel `pakar`
--
ALTER TABLE `pakar`
  ADD PRIMARY KEY (`id_pakar`) USING BTREE;

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hasil_konsultasi`
--
ALTER TABLE `hasil_konsultasi`
  MODIFY `id_hasil_konsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pakar`
--
ALTER TABLE `pakar`
  MODIFY `id_pakar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
