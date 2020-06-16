-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 16, 2020 at 04:01 PM
-- Server version: 5.7.25
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `energibangsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `foto` varchar(100) DEFAULT '',
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_telepon` varchar(20) DEFAULT '',
  `alamat` varchar(255) DEFAULT '',
  `jenis_kelamin` varchar(10) DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `ijasah` varchar(255) DEFAULT '',
  `ktp` varchar(255) DEFAULT '',
  `cv` varchar(255) DEFAULT '',
  `sertifikat` varchar(255) DEFAULT '',
  `nilai` float DEFAULT '0',
  `status` varchar(10) NOT NULL DEFAULT 'Non Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `foto`, `nama`, `email`, `nomor_telepon`, `alamat`, `jenis_kelamin`, `password`, `ijasah`, `ktp`, `cv`, `sertifikat`, `nilai`, `status`) VALUES
(1, 'uploads/event1.jpg', 'Niwang', 'niwang@email.com', '08123456789', 'Semarang', 'laki-laki', 'e10adc3949ba59abbe56e057f20f883e', 'uploads/file/API Document Wappin V 1.7.pdf', 'uploads/file/Quotation - APQA 2020 Apps V1.pdf', 'uploads/file/API Document Wappin V 1.7.pdf', '', 1, 'Aktif'),
(2, 'uploads/LogoTamanMedia.png', 'Hisom Mukhlisin', 'hisom.mukhlas@gmail.com', '08987654321', 'Jepara', 'laki-laki', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', 0.7, 'Aktif'),
(3, 'uploads/LogoTOI.png', 'Anisha Tiarasani Ashianto', 'nanang@email.com', '0899883366123', 'Semarang', 'laki-laki', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', 0.75, 'Aktif'),
(4, 'uploads/BankMandiri.jpg', 'Dyahayu Puspitaningsih', 'dyah@email.com', '089988776655', 'Semarang', 'perempuan', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', 0.8, 'Aktif'),
(6, '', 'ARIF NIWANG DJATI', 'niwang@crocodic.com', '08123456789', 'Semarang', 'laki-laki', 'e10adc3949ba59abbe56e057f20f883e', 'uploads/file/6. User Requirement Sistem Integrasi Data - Rev 3 080520.pdf', 'uploads/file/6. User Requirement Sistem Integrasi Data - Rev 3 080520.pdf', 'uploads/file/6. User Requirement Sistem Integrasi Data - Rev 3 080520.pdf', '', 0.9625, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kriteria` varchar(50) NOT NULL,
  `cost_benefit` varchar(10) NOT NULL,
  `tipe` varchar(10) NOT NULL DEFAULT 'Option',
  `limit` tinyint(1) NOT NULL,
  `bobot` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `cost_benefit`, `tipe`, `limit`, `bobot`) VALUES
(1, 'Pendidikan', 'benefit', 'Option', 0, 0.2),
(2, 'Usia', 'benefit', 'Numeric', 0, 0.15),
(3, 'Pengalaman Kerja', 'benefit', 'Option', 0, 0.25),
(4, 'Tinggi Badan', 'benefit', 'Numeric', 0, 0.15),
(5, 'Inisiatif [1-100]', 'benefit', 'Numeric', 1, 0.25);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_sub_kriteria` int(11) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `bobot` float DEFAULT NULL,
  `bobot_sub` float DEFAULT NULL,
  `nilai` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_karyawan`, `id_kriteria`, `id_sub_kriteria`, `value`, `bobot`, `bobot_sub`, `nilai`) VALUES
(1, 1, 1, 4, 'S1-S2', 0.2, 1, 0.2),
(2, 1, 2, 6, '22', 0.15, 1, 0.15),
(3, 1, 3, 14, '> 19 Bulan', 0.25, 1, 0.25),
(4, 1, 4, 19, '177', 0.15, 1, 0.15),
(5, 1, 5, 24, '100', 0.25, 1, 0.25),
(6, 2, 1, 2, 'SMA/SMK', 0.2, 0.5, 0.1),
(7, 2, 2, 7, '23', 0.15, 0.75, 0.1125),
(8, 2, 3, 12, '7 - 12 Bulan', 0.25, 0.5, 0.125),
(9, 2, 4, 18, '170', 0.15, 0.75, 0.1125),
(10, 2, 5, 24, '100', 0.25, 1, 0.25),
(11, 3, 1, 3, 'D1-D3', 0.2, 0.75, 0.15),
(12, 3, 2, 7, '24', 0.15, 0.75, 0.1125),
(13, 3, 3, 13, '13 - 18 Bulan', 0.25, 0.75, 0.1875),
(14, 3, 4, 18, '168', 0.15, 0.75, 0.1125),
(15, 3, 5, 23, '85', 0.25, 0.75, 0.1875),
(16, 4, 1, 3, 'D1-D3', 0.2, 0.75, 0.15),
(17, 4, 2, 7, '24', 0.15, 0.75, 0.1125),
(18, 4, 3, 14, '> 19 Bulan', 0.25, 1, 0.25),
(19, 4, 4, 16, '155', 0.15, 0.25, 0.0375),
(20, 4, 5, 24, '100', 0.25, 1, 0.25),
(26, 6, 1, 4, 'S1-S2', 0.2, 1, 0.2),
(27, 6, 2, 6, '22', 0.15, 1, 0.15),
(28, 6, 3, 14, '> 19 Bulan', 0.25, 1, 0.25),
(29, 6, 4, 18, '175', 0.15, 0.75, 0.1125),
(30, 6, 5, 24, '100', 0.25, 1, 0.25);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `sub_kriteria` varchar(255) NOT NULL,
  `bobot` float NOT NULL,
  `min` int(11) DEFAULT NULL,
  `max` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `sub_kriteria`, `bobot`, `min`, `max`) VALUES
(1, 1, 'SMP', 0.25, NULL, NULL),
(2, 1, 'SMA/SMK', 0.5, NULL, NULL),
(3, 1, 'D1-D3', 0.75, NULL, NULL),
(4, 1, 'S1-S2', 1, NULL, NULL),
(5, 2, '<18 atau >30', 0, 0, 0),
(6, 2, '18 - 22', 1, 18, 22),
(7, 2, '23 - 25', 0.75, 23, 25),
(8, 2, '26 - 28', 0.5, 26, 28),
(9, 2, '29 - 30', 0.25, 29, 30),
(10, 3, '0 Bulan', 0, NULL, NULL),
(11, 3, '1 - 6 Bulan', 0.25, NULL, NULL),
(12, 3, '7 - 12 Bulan', 0.5, NULL, NULL),
(13, 3, '13 - 18 Bulan', 0.75, NULL, NULL),
(14, 3, '> 19 Bulan', 1, NULL, NULL),
(15, 4, '< 150 cm atau > 185 cm', 0, 0, 0),
(16, 4, '150 cm - 160 cm', 0.25, 150, 160),
(17, 4, '161 cm - 165 cm', 0.5, 161, 165),
(18, 4, '166 cm - 175 cm', 0.75, 166, 175),
(19, 4, '176 cm - 185 cm', 1, 176, 185),
(20, 5, '0 - 40', 0, 0, 0),
(21, 5, '41 - 45', 0.25, 41, 55),
(22, 5, '56 - 70', 0.5, 56, 70),
(23, 5, '71 - 85', 0.75, 71, 85),
(24, 5, '86 - 100', 1, 86, 100);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `level` varchar(25) NOT NULL,
  `since` date NOT NULL,
  `foto` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `pass`, `level`, `since`, `foto`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2018-10-04', 'uploads/avatar5.png'),
(2, 'testing', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '2020-06-04', 'uploads/teamwork.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
