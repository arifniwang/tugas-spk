# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.25)
# Database: ptatm
# Generation Time: 2020-06-04 08:48:38 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table karyawan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `karyawan`;

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(100) NOT NULL DEFAULT '',
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_telepon` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `karyawan` WRITE;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;

INSERT INTO `karyawan` (`id_karyawan`, `foto`, `nama`, `email`, `nomor_telepon`, `alamat`, `jenis_kelamin`, `password`)
VALUES
	(1,'image/event1.jpg','ARIF NIWANG DJATI','arif.niwank1@gmail.com','08123456789','Semarang','laki-laki','123456');

/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kriteria
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kriteria`;

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria` varchar(50) NOT NULL,
  `cost_benefit` varchar(10) NOT NULL,
  `tipe` varchar(10) NOT NULL DEFAULT 'Option',
  `limit` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `kriteria` WRITE;
/*!40000 ALTER TABLE `kriteria` DISABLE KEYS */;

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `cost_benefit`, `tipe`, `limit`)
VALUES
	(1,'Pendidikan','benefit','Option',0),
	(2,'Usia','benefit','Numeric',0),
	(3,'Pengalaman Kerja','benefit','Option',0),
	(4,'Tinggi Badan','benefit','Numeric',0),
	(5,'Inisiatif','benefit','Numeric',1);

/*!40000 ALTER TABLE `kriteria` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table nilai
# ------------------------------------------------------------

DROP TABLE IF EXISTS `nilai`;

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_sub_kriteria` int(11) NOT NULL,
  `bobot` float NOT NULL,
  `value` varchar(100) NOT NULL DEFAULT '',
  `nilai` float DEFAULT '0',
  PRIMARY KEY (`id_nilai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `nilai` WRITE;
/*!40000 ALTER TABLE `nilai` DISABLE KEYS */;

INSERT INTO `nilai` (`id_nilai`, `id_karyawan`, `id_kriteria`, `id_sub_kriteria`, `bobot`, `value`, `nilai`)
VALUES
	(1,1,1,4,1,'S1-S2',100),
	(2,1,2,6,1,'22',80),
	(3,1,3,14,1,'> 19 Bulan',90),
	(4,1,4,19,1,'177',85),
	(5,1,5,24,1,'100',75);

/*!40000 ALTER TABLE `nilai` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sub_kriteria
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sub_kriteria`;

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) NOT NULL,
  `sub_kriteria` varchar(255) NOT NULL,
  `bobot` float NOT NULL,
  `min` int(11) DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sub_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `sub_kriteria` WRITE;
/*!40000 ALTER TABLE `sub_kriteria` DISABLE KEYS */;

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `sub_kriteria`, `bobot`, `min`, `max`)
VALUES
	(1,1,'SMP',0.25,NULL,NULL),
	(2,1,'SMA/SMK',0.5,NULL,NULL),
	(3,1,'D1-D3',0.75,NULL,NULL),
	(4,1,'S1-S2',1,NULL,NULL),
	(5,2,'<18 atau >30',0,0,0),
	(6,2,'18 - 22',1,18,22),
	(7,2,'23 - 25',0.75,23,25),
	(8,2,'26 - 28',0.5,26,28),
	(9,2,'29 - 30',0.25,29,30),
	(10,3,'0 Bulan',0,NULL,NULL),
	(11,3,'1 - 6 Bulan',0.25,NULL,NULL),
	(12,3,'7 - 12 Bulan',0.5,NULL,NULL),
	(13,3,'13 - 18 Bulan',0.75,NULL,NULL),
	(14,3,'> 19 Bulan',1,NULL,NULL),
	(15,4,'< 150 cm atau > 185 cm',0,0,0),
	(16,4,'150 cm - 160 cm',0.25,150,160),
	(17,4,'161 cm - 165 cm',0.5,161,165),
	(18,4,'166 cm - 175 cm',0.75,166,175),
	(19,4,'176 cm - 185 cm',1,176,185),
	(20,5,'0 - 40',0,0,0),
	(21,5,'41 - 45',0.25,41,55),
	(22,5,'56 - 70',0.5,56,70),
	(23,5,'71 - 85',0.75,71,85),
	(24,5,'86 - 100',1,86,100);

/*!40000 ALTER TABLE `sub_kriteria` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `level` varchar(25) NOT NULL,
  `since` date NOT NULL,
  `foto` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `user`, `pass`, `level`, `since`, `foto`)
VALUES
	(1,'admin','21232f297a57a5a743894a0e4a801fc3','admin','2018-10-04','uploads/avatar5.png'),
	(2,'testing','e10adc3949ba59abbe56e057f20f883e','admin','2020-06-04','image/teamwork.png');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
