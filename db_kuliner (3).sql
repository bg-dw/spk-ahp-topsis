-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jan 2022 pada 16.22
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kuliner`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` char(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'Admin Kuliner', 'zaza', 'zaza');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_detail_lokasi`
--

CREATE TABLE `tbl_detail_lokasi` (
  `id_detail` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_detail_lokasi`
--

INSERT INTO `tbl_detail_lokasi` (`id_detail`, `id_lokasi`, `id_kriteria`, `nilai`) VALUES
(19, 1, 1, '276.67'),
(20, 1, 2, '406.00'),
(21, 1, 3, '223.08'),
(22, 1, 4, '3'),
(23, 1, 5, '100'),
(24, 1, 6, '100000000'),
(25, 8, 1, '195.46'),
(26, 8, 2, '357.25'),
(27, 8, 3, '166.83'),
(28, 8, 4, '4'),
(29, 8, 5, '200'),
(30, 8, 6, '133344555'),
(31, 9, 1, '254.46'),
(32, 9, 2, '288.66'),
(33, 9, 3, '722.95'),
(34, 9, 4, '3'),
(35, 9, 5, '100'),
(36, 9, 6, '16.000.000'),
(37, 10, 1, '109.73'),
(38, 10, 2, '88.49'),
(39, 10, 3, '259.36'),
(40, 10, 4, '4'),
(41, 10, 5, '96'),
(42, 10, 6, '32.000.000'),
(43, 11, 1, '153.67'),
(44, 11, 2, '30.88'),
(45, 11, 3, '200.82'),
(46, 11, 4, '7'),
(47, 11, 5, '200'),
(48, 11, 6, '35.000.000'),
(49, 12, 1, '97.07'),
(50, 12, 2, '30.63'),
(51, 12, 3, '79.96'),
(52, 12, 4, '3'),
(53, 12, 5, '72'),
(54, 12, 6, '35.000.000'),
(55, 13, 1, '77.65'),
(56, 13, 2, '38.78'),
(57, 13, 3, '106.75'),
(58, 13, 4, '5'),
(59, 13, 5, '64'),
(60, 13, 6, '30.000.000'),
(61, 14, 1, '57.29'),
(62, 14, 2, '99.61'),
(63, 14, 3, '234.07'),
(64, 14, 4, '6'),
(65, 14, 5, '25'),
(66, 14, 6, '32.000.000'),
(67, 15, 1, '110.53'),
(68, 15, 2, '85.52'),
(69, 15, 3, '230.65'),
(70, 15, 4, '2'),
(71, 15, 5, '45'),
(72, 15, 6, '17.000.000'),
(73, 16, 1, '66.66'),
(74, 16, 2, '27.76'),
(75, 16, 3, '538.81'),
(76, 16, 4, '3'),
(77, 16, 5, '40'),
(78, 16, 6, '25.000.000'),
(79, 17, 1, '28.32'),
(80, 17, 2, '27.48'),
(81, 17, 3, '161.37'),
(82, 17, 4, '4'),
(83, 17, 5, '90'),
(84, 17, 6, '25.000.000'),
(85, 18, 1, '58.16'),
(86, 18, 2, '21.04'),
(87, 18, 3, '1319.73'),
(88, 18, 4, '6'),
(89, 18, 5, '165'),
(90, 18, 6, '35.000.000'),
(91, 19, 1, '696.21'),
(92, 19, 2, '129.10'),
(93, 19, 3, '1347.48'),
(94, 19, 4, '4'),
(95, 19, 5, '150'),
(96, 19, 6, '28000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `tipe_kriteria` varchar(15) NOT NULL,
  `bobot_kriteria` varchar(20) NOT NULL,
  `api_map` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id_kriteria`, `nama_kriteria`, `tipe_kriteria`, `bobot_kriteria`, `api_map`) VALUES
(1, 'Jarak dari pemukiman (Meter)', 'COST', '0.17', 'Map'),
(2, 'Jarak dari sarana transportasi (Meter)', 'COST', '0.17', 'Map'),
(3, 'Jarak dari sarana pendidikan (Meter)', 'COST', '0.17', 'Map'),
(4, 'Pesaing', 'COST', '0.17', '-'),
(5, 'Luas bangunan', 'BENEFIT', '0.17', '-'),
(6, 'Harga (Rupiah)', 'COST', '0.17', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_lokasi`
--

CREATE TABLE `tbl_lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `lang` varchar(50) NOT NULL,
  `nama_lokasi` varchar(100) NOT NULL,
  `alamat_lokasi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_lokasi`
--

INSERT INTO `tbl_lokasi` (`id_lokasi`, `lat`, `lang`, `nama_lokasi`, `alamat_lokasi`) VALUES
(9, '-7.957776569337874', '112.64367712939945', 'S1', 'JL.Sunandar Priyo Sudarmo no. 31F malang'),
(10, '-7.938971445826128', '112.6077201962471', 'S2', 'Jl.MT Haryono 167 kav 14 Dinoyo Malang'),
(11, '-8.022328979119221', '112.62611825118327', 'S3', 'jl aipda satsui tubun no 25 C Gadang Kota Malang'),
(12, '-7.966612399109628', '112.63892923917818', 'S4', 'Jl. Raden Tumenggung Suryo no 10'),
(13, '-7.934295780004116', '112.6040210247463', 'S5', 'JL.raya tlogomas no. 58 malang sebelah barat kelurahan tlogomas'),
(14, '-7.93975311193548', '112.6339333736801', 'S6', 'Jl candi trowulan barat no 1 suhat malang'),
(15, '-7.983805534175349', '112.61356341824307', 'S7', 'JL Jupri 625, Mergan, Sukun, Malang'),
(16, '-7.973765739883456', '112.61624249464565', 'S8', 'Jl Terusan Kawi no 8C Malang'),
(17, '-7.9641705538851895', '112.61504665017128', 'S9', 'Jl. Terusan Surabaya no 32'),
(18, '-7.983696988430198', '112.63672998209262', 'S10', 'Jalan Gatot Subroto no. 14 dan 16 Malang'),
(19, '-7.983034830111107', '112.61548390593612', 'S11', 'Jl. I.R Rais, Malang');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tbl_detail_lokasi`
--
ALTER TABLE `tbl_detail_lokasi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_detail_lokasi`
--
ALTER TABLE `tbl_detail_lokasi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT untuk tabel `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
