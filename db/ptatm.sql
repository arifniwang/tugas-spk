-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2018 at 05:43 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ptatm`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `id_karyawan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `alamat`, `jenis_kelamin`, `jabatan`) VALUES
(1, 'Hanan', 'Jl. Sendiri Bersamamu 13A RT02/RW07', 'laki-laki', 'cleaning service'),
(2, 'Ipang', 'Jln. Domba No.12 Makassar 90142', 'laki-laki', 'Satpam'),
(3, 'Mira', 'Jl Ayo Sehat 38C', 'perempuan', 'kasir'),
(4, 'Sinta', 'Tempel Rt 042/Rw 012', 'perempuan', 'marketing'),
(9, 'Desi', 'Gondang Rawe Rt 013/ Rw 002', 'perempuan', 'sekretaris');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria` varchar(50) NOT NULL,
  `bobot` float NOT NULL,
  `cost_benefit` varchar(10) NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `bobot`, `cost_benefit`) VALUES
(1, 'Kualitas Kerja', 0.3, 'benefit'),
(2, 'Ketelitian Kerja', 0.2, 'benefit'),
(3, 'Tanggung Jawab', 0.2, 'benefit'),
(4, 'Profesionalisme', 0.1, 'benefit'),
(5, 'Inisiatif', 0.1, 'benefit'),
(6, 'Perilaku', 0.1, 'benefit');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `k1` int(11) NOT NULL,
  `k2` int(11) NOT NULL,
  `k3` int(11) NOT NULL,
  `k4` int(11) NOT NULL,
  `k5` int(11) NOT NULL,
  `k6` int(11) NOT NULL,
  PRIMARY KEY (`id_nilai`),
  UNIQUE KEY `id_karyawan` (`id_karyawan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_karyawan`, `k1`, `k2`, `k3`, `k4`, `k5`, `k6`) VALUES
(1, 1, 69, 77, 87, 97, 67, 32),
(2, 2, 40, 78, 55, 89, 98, 78),
(3, 3, 87, 58, 91, 86, 79, 84),
(8, 4, 88, 67, 85, 92, 90, 58),
(11, 9, 69, 90, 66, 44, 44, 76);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `level` varchar(25) NOT NULL,
  `since` date NOT NULL,
  `foto` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `pass`, `level`, `since`, `foto`) VALUES
(1, 'admin', '0d9c19ec3c6044545f05c3458fe390c5', 'admin', '2018-10-04', 'avatar5.png'),
(2, 'desi', '817c4941a50fb05d379a7fb0689aa134', 'karyawan', '2018-10-05', 'avatar.jpg'),
(3, 'mira', 'cc3ec32a426e29535d6494c247b48cda', 'karyawan', '2018-10-01', '24.JPG'),
(4, 'ipang', '555de8e294e8e5cf71b5afb9063fe18e', 'karyawan', '2018-10-02', 'ipangdwi.png'),
(5, 'hanan', 'b23da4fa97aa5b3249d4e80dee0e20b4', 'karyawan', '2018-10-06', 'avatar04.png'),
(6, 'sinta', '380a4ea8ef908894c66d940d892e200f', 'karyawan', '2018-10-06', '44.JPG');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
