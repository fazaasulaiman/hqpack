-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2017 at 09:26 PM
-- Server version: 5.6.11
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `butik`
--
CREATE DATABASE IF NOT EXISTS `butik` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `butik`;

-- --------------------------------------------------------

--
-- Table structure for table `add_gudang`
--

CREATE TABLE IF NOT EXISTS `add_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(30) NOT NULL,
  `jumlah` int(30) NOT NULL,
  `tgl` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `add_gudang`
--

INSERT INTO `add_gudang` (`id`, `id_barang`, `jumlah`, `tgl`) VALUES
(4, 2, 20, '2017-03-29'),
(5, 2, 10, '2017-03-29'),
(6, 3, 20, '2017-03-30'),
(7, 2, 5, '2017-03-30'),
(8, 6, 10, '2017-04-10'),
(9, 6, 100, '2017-04-10'),
(10, 7, 100, '2017-04-10'),
(11, 6, 50, '2017-04-10'),
(12, 5, 200, '2017-04-13'),
(13, 5, 200, '2017-04-13'),
(14, 5, 200, '2017-04-13'),
(15, 5, 200, '2017-04-13'),
(16, 5, 200, '2017-04-13'),
(17, 9, 100, '2017-04-13'),
(18, 10, 200, '2017-04-13'),
(19, 11, 300, '2017-04-13'),
(20, 12, 400, '2017-04-13'),
(21, 13, 500, '2017-04-13'),
(22, 14, 100, '2017-04-13'),
(23, 15, 200, '2017-04-13'),
(24, 16, 300, '2017-04-13'),
(25, 7, 200, '2017-04-17');

--
-- Triggers `add_gudang`
--
DROP TRIGGER IF EXISTS `masukgudang`;
DELIMITER //
CREATE TRIGGER `masukgudang` AFTER INSERT ON `add_gudang`
 FOR EACH ROW BEGIN
UPDATE gudang SET stok=stok+NEW.jumlah
WHERE id_barang=NEW.id_barang;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `produksi` int(30) NOT NULL,
  `jual` int(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode` (`kode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode`, `nama`, `produksi`, `jual`) VALUES
(3, 'py01', 'payung prufut', 400000, 450000),
(6, 'PY1', 'Payung Merah', 42500, 60000),
(7, 'PY2', 'Payung Golf Hijau', 42500, 60000),
(9, 'Bk 1', 'Buku 1', 500, 1000),
(10, 'Bk 2', 'Buku 2', 1000, 2000),
(11, 'Bk 3', 'Buku 3', 1500, 3000),
(12, 'Bk 4', 'Buku 4', 2000, 4000),
(13, 'Bk 5', 'Buku 5', 2500, 5000),
(14, 'SM 1', 'Stop Map Merah ', 75000, 100000),
(15, 'SM 2', 'Stop Map Hijai', 10000, 20000),
(16, 'SM 3', 'Stop Map Abu-abu', 15000, 25000);

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE IF NOT EXISTS `gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id`, `id_barang`, `stok`) VALUES
(1, 5, 1000),
(4, 2, 12),
(5, 3, 0),
(6, 4, 10),
(7, 6, 80),
(8, 7, 260),
(9, 8, 0),
(10, 9, 25),
(11, 10, 155),
(12, 11, 260),
(13, 12, 310),
(14, 13, 490),
(15, 14, 95),
(16, 15, 200),
(17, 16, 300);

-- --------------------------------------------------------

--
-- Table structure for table `kirim_cabang`
--

CREATE TABLE IF NOT EXISTS `kirim_cabang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `id_kpm` int(20) NOT NULL,
  `id_barang` int(20) NOT NULL,
  `tgltrima` date DEFAULT NULL,
  `ket` varchar(20) DEFAULT NULL,
  `jum_kirim` int(20) NOT NULL,
  `jum_terima` int(20) DEFAULT NULL,
  `produksi` int(20) NOT NULL,
  `jual` int(20) NOT NULL,
  `jum_selisih` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `kirim_cabang`
--

INSERT INTO `kirim_cabang` (`id`, `tgl`, `id_kpm`, `id_barang`, `tgltrima`, `ket`, `jum_kirim`, `jum_terima`, `produksi`, `jual`, `jum_selisih`) VALUES
(1, '2017-03-31', 3, 2, '2017-04-04', 'OK', 10, 10, 45000, 50000, 0),
(4, '2017-04-04', 3, 2, '2017-04-04', 'OK', 5, 5, 45000, 50000, 0),
(5, '2017-04-04', 2, 3, '2017-04-04', 'Jumlah Tidak Sesuai', 5, 3, 400000, 450000, 2),
(6, '2017-04-07', 3, 3, '2017-04-07', 'OK', 3, 3, 400000, 450000, 0),
(7, '2017-04-10', 5, 6, '2017-04-10', 'Barang Rusak', 30, 15, 42500, 60000, 15),
(8, '2017-04-10', 5, 6, '2017-04-10', 'Jumlah Tidak Sesuai', 50, 40, 42500, 60000, 10),
(9, '2017-04-10', 2, 7, '2017-04-10', 'Barang Rusak', 10, 9, 42500, 60000, 1),
(10, '2017-04-13', 6, 9, '2017-04-13', 'Jumlah Tidak Sesuai', 10, 12, 500, 1000, -2),
(11, '2017-04-13', 6, 10, '2017-04-13', 'Barang Rusak', 10, 8, 1000, 2000, 2),
(12, '2017-04-13', 6, 11, '2017-04-13', 'OK', 10, 10, 1500, 3000, 0),
(13, '2017-04-13', 6, 12, '2017-04-13', 'OK', 10, 10, 2000, 4000, 0),
(14, '2017-04-13', 6, 9, '2017-04-13', 'Jumlah Tidak Sesuai', 10, 8, 500, 1000, 2),
(15, '2017-04-13', 6, 7, '2017-04-13', 'OK', 10, 10, 42500, 60000, 0),
(16, '2017-04-17', 6, 12, '2017-04-17', 'OK', 20, 20, 2000, 4000, 0),
(17, '2017-04-17', 6, 7, '2017-04-17', 'OK', 20, 20, 42500, 60000, 0),
(18, '2017-04-17', 6, 10, '2017-04-17', 'OK', 20, 20, 1000, 2000, 0),
(19, '2017-04-17', 6, 11, '2017-04-17', 'OK', 20, 20, 1500, 3000, 0),
(20, '2017-04-17', 6, 9, '2017-04-17', 'OK', 20, 20, 500, 1000, 0),
(21, '2017-04-19', 5, 9, '2017-04-19', 'OK', 20, 20, 500, 1000, 0),
(22, '2017-04-19', 5, 10, '2017-04-19', 'OK', 15, 15, 1000, 2000, 0),
(23, '2017-04-19', 5, 11, '2017-04-19', 'OK', 10, 10, 1500, 3000, 0),
(24, '2017-04-19', 5, 12, '2017-04-19', 'OK', 10, 10, 2000, 4000, 0),
(25, '2017-04-19', 5, 13, '2017-04-19', 'OK', 10, 10, 2500, 5000, 0),
(26, '2017-04-19', 5, 9, '2017-04-19', 'OK', 10, 10, 500, 1000, 0),
(27, '2017-04-19', 5, 3, '2017-04-19', 'OK', 10, 10, 400000, 450000, 0);

--
-- Triggers `kirim_cabang`
--
DROP TRIGGER IF EXISTS `kirimpkm`;
DELIMITER //
CREATE TRIGGER `kirimpkm` AFTER INSERT ON `kirim_cabang`
 FOR EACH ROW BEGIN
UPDATE gudang SET stok=stok-NEW.jum_kirim
WHERE id_barang=NEW.id_barang;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `tambah_stock_pkm`;
DELIMITER //
CREATE TRIGGER `tambah_stock_pkm` AFTER UPDATE ON `kirim_cabang`
 FOR EACH ROW BEGIN
IF NOT EXISTS (SELECT 1 FROM stock_cabang WHERE id_kpm = NEW.id_kpm and id_barang = NEW.id_barang) THEN
       INSERT INTO stock_cabang(id_kpm,id_barang,stock) VALUES (NEW.id_kpm,NEW.id_barang,NEW.jum_terima);
   ELSE
       UPDATE stock_cabang SET stock=stock+NEW.jum_terima 
       where id_kpm=NEW.id_kpm and id_barang=NEW.id_barang;
   END IF;

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `korekgudang`
--

CREATE TABLE IF NOT EXISTS `korekgudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `id_barang` int(30) NOT NULL,
  `stokkompi` int(20) NOT NULL,
  `stoknyata` int(20) NOT NULL,
  `selisih` int(20) NOT NULL,
  `hargaselisih` int(20) NOT NULL,
  `alasan` varchar(20) NOT NULL,
  `ket` text NOT NULL,
  `produksi` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `korekgudang`
--

INSERT INTO `korekgudang` (`id`, `tgl`, `id_barang`, `stokkompi`, `stoknyata`, `selisih`, `hargaselisih`, `alasan`, `ket`, `produksi`) VALUES
(1, '2017-03-30', 2, 35, 32, 3, 135000, 'Hilang', 'hilang dicuri sama pencuri serius', 45000),
(2, '2017-03-31', 3, 20, 19, 1, 400000, 'Rusak', 'rusak dimakan tikus serius', 400000),
(3, '2017-04-13', 14, 100, 95, 5, 375000, 'Hilang', 'Hilang ketika ada di gudang', 75000),
(4, '2017-04-13', 9, 100, 98, 2, 1000, 'Rusak', 'Sampul rusak tidak dapat dijual', 500),
(5, '2017-04-13', 12, 400, 350, 50, 100000, 'Rusak', '10 Barang rusak karena kehujanan, 5 barang rusak karena pengiriman, 3 barang rusak karena dimakan tikus, 5 barang rusak basah, 10 Barang rusak karena kehujanan, 5 barang rusak karena pengiriman', 2000),
(6, '2017-04-18', 9, 58, 57, 1, 500, 'Hilang', 'hilang adalah hilang', 500),
(7, '2017-04-18', 9, 57, 56, 1, 500, 'Hilang', 'sajdljaslkdjlaskjdlkajsd', 500),
(8, '2017-04-18', 9, 56, 55, 1, 500, 'Hilang', 'asjndasdlasjdlkajsdlaslakdkald', 500),
(9, '2017-04-18', 3, 11, 10, 1, 400000, 'Hilang', 'sakdljaskldjaklsjdlkasd', 400000);

--
-- Triggers `korekgudang`
--
DROP TRIGGER IF EXISTS `korekgudang`;
DELIMITER //
CREATE TRIGGER `korekgudang` AFTER INSERT ON `korekgudang`
 FOR EACH ROW BEGIN
UPDATE gudang SET stok=stok-NEW.selisih
WHERE id_barang=NEW.id_barang;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `korekkpm`
--

CREATE TABLE IF NOT EXISTS `korekkpm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `id_barang` int(20) NOT NULL,
  `id_kpm` int(20) NOT NULL,
  `stokkompi` int(11) NOT NULL,
  `stoknyata` int(11) NOT NULL,
  `selisih` int(11) NOT NULL,
  `hargaselisih` int(11) NOT NULL,
  `alasan` varchar(30) NOT NULL,
  `ket` text NOT NULL,
  `produksi` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `korekkpm`
--

INSERT INTO `korekkpm` (`id`, `tgl`, `id_barang`, `id_kpm`, `stokkompi`, `stoknyata`, `selisih`, `hargaselisih`, `alasan`, `ket`, `produksi`) VALUES
(2, '2017-04-05', 2, 3, 15, 13, 2, 90000, 'FOC', 'foc adalah foc yang foc dan tidak foc', 45000),
(3, '2017-04-11', 2, 3, 4, 1, 3, 135000, 'Rusak', 'rusak karena rusak adalah rusak', 45000),
(4, '2017-04-11', 3, 3, 2, 1, 1, 400000, 'Hilang', 'Hilang ada hilang karena hilang mungkin hilang', 400000),
(5, '2017-04-11', 2, 3, 1, 0, 1, 45000, 'FOC', 'foc adalah foc karena foc mungkin foc', 45000),
(6, '2017-04-13', 12, 6, 9, 8, 1, 2000, 'Kembali Ke Pusat', 'Dikirim ke kantor YOG', 2000),
(7, '2017-04-17', 9, 6, 9, 10, -1, -500, 'FOC', 'FOC Pak hawari', 500),
(8, '2017-04-17', 12, 6, 19, 18, 1, 2000, 'Hilang', 'Hilang di gudang', 2000),
(9, '2017-04-17', 9, 6, 19, 17, 2, 1000, 'Rusak', 'sak karena sampul kogtor', 500),
(10, '2017-04-17', 7, 6, 18, 17, 1, 42500, 'FOC', 'Dibawa oleh agent', 42500),
(11, '2017-04-17', 7, 6, 15, 14, 1, 42500, 'FOC', 'Diambil oleh mister', 42500),
(12, '2017-04-18', 12, 6, 16, 15, 1, 2000, 'Hilang', 'aklsdklasdlkajskld', 2000),
(13, '2017-04-18', 12, 6, 15, 14, 1, 2000, 'Hilang', 'salmdaslkmdlsamd', 2000),
(14, '2017-04-18', 12, 6, 14, 13, 1, 2000, 'Hilang', 'kasndlnasdlasdl', 2000),
(15, '2017-04-18', 7, 6, 14, 13, 1, 42500, 'Hilang', 'ojiiojoijojoj', 42500),
(16, '2017-04-18', 12, 6, 13, 12, 1, 2000, 'Rusak', 'jhjkljljlkjlkjlkj', 2000),
(17, '2017-04-18', 12, 6, 12, 11, 1, 2000, 'Rusak', ';laskdaskd;kas;ldk', 2000),
(18, '2017-04-18', 7, 6, 13, 12, 1, 42500, 'Hilang', 'asl;kdask;dkas;d', 42500),
(19, '2017-04-18', 7, 6, 12, 11, 1, 42500, 'Hilang', ';laks;ldka;lskd;askd;ask', 42500),
(20, '2017-04-18', 7, 6, 11, 10, 1, 42500, 'Hilang', 'asdlkasdlknslnalnd\r\n', 42500),
(21, '2017-04-18', 7, 6, 10, 9, 1, 42500, 'FOC', 'aljsdlasjdlasjdas', 42500),
(22, '2017-04-18', 12, 6, 11, 10, 1, 2000, 'FOC', 'alskdklaskldmasklmdlasd', 2000),
(23, '2017-04-19', 7, 6, 9, 8, 1, 42500, 'Rusak', 'sdfdsf dfsfe dsfs ddf sfs', 42500),
(24, '2017-04-19', 9, 5, 21, 20, 1, 500, 'Hilang', 'Dimakan tikusssss', 500);

--
-- Triggers `korekkpm`
--
DROP TRIGGER IF EXISTS `koreksikpm`;
DELIMITER //
CREATE TRIGGER `koreksikpm` AFTER INSERT ON `korekkpm`
 FOR EACH ROW BEGIN
UPDATE stock_cabang SET stock=stock-NEW.selisih
WHERE id_barang=NEW.id_barang and id_kpm=NEW.id_kpm;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kpm`
--

CREATE TABLE IF NOT EXISTS `kpm` (
  `level` int(2) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kpm` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `kode` varchar(20) NOT NULL,
  `pass` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `kpm`
--

INSERT INTO `kpm` (`level`, `id`, `kpm`, `alamat`, `kode`, `pass`) VALUES
(1, 2, 'Yogyakarta', 'cassagradea yogja sleman jogjakarta', 'kpmYOG', 'dd13c2e2179224d119611b1eba40314d'),
(1, 3, 'purwokerto', 'jl. purwokerto  purwokerto selatan', 'kpmpwt', '4082dc484ef4b1e8e0f195fec6b495ec'),
(2, 4, 'admin', 'Jl. admin', 'admin', '4082dc484ef4b1e8e0f195fec6b495ec'),
(1, 5, 'Magelang', 'jalan magelang, jalan magelang', 'kpmMG1', 'ebba85d9d45f706f49eac37595235d18'),
(1, 6, 'Semarang', 'Semarang, Jawa tengah', 'kpmSM1', '652ddb5c4417915bf443d74f6dec2374'),
(1, 7, 'Solo', 'Solo baru, solo baru', 'kpmSL7', '263a7009c65d07e0dba3aa8f10d8636b'),
(1, 8, 'Yogyakarta', 'Yogyakarta, maguwoharjo', 'kpmYOG', 'dd13c2e2179224d119611b1eba40314d');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noreq` varchar(220) NOT NULL,
  `tgl` date NOT NULL,
  `id_barang` int(30) NOT NULL,
  `jumlah` int(30) NOT NULL,
  `id_kpm` int(20) NOT NULL,
  `status` varchar(340) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `noreq`, `tgl`, `id_barang`, `jumlah`, `id_kpm`, `status`) VALUES
(1, 'reqkpmSM11492575880', '2017-04-19', 7, 80, 6, 'request'),
(2, 'reqkpmSM11492575880', '2017-04-19', 9, 50, 6, 'request'),
(3, 'reqkpmSM11492576222', '2017-04-19', 11, 30, 6, 'request'),
(4, 'reqkpmSM11492576222', '2017-04-19', 6, 20, 6, 'request'),
(5, 'reqkpmSM11492576331', '2017-04-19', 9, 50, 6, 'request'),
(6, 'reqkpmSM11492576331', '2017-04-19', 3, 20, 6, 'dikirim'),
(7, 'reqkpmMG11492588217', '2017-04-19', 3, 10, 5, 'dikirim'),
(8, 'reqkpmMG11492588217', '2017-04-19', 7, 10, 5, 'dikirim');

-- --------------------------------------------------------

--
-- Table structure for table `stock_cabang`
--

CREATE TABLE IF NOT EXISTS `stock_cabang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kpm` int(20) NOT NULL,
  `id_barang` int(20) NOT NULL,
  `stock` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `stock_cabang`
--

INSERT INTO `stock_cabang` (`id`, `id_kpm`, `id_barang`, `stock`) VALUES
(1, 3, 2, 0),
(3, 2, 3, 3),
(4, 3, 3, 1),
(5, 5, 6, 76),
(6, 2, 7, 9),
(7, 6, 12, 10),
(8, 6, 11, 13),
(9, 6, 10, 18),
(10, 6, 9, 17),
(11, 6, 7, 8),
(12, 5, 3, 8),
(13, 5, 9, 20),
(14, 5, 13, 4),
(15, 5, 12, 3),
(16, 5, 11, 4),
(17, 5, 10, 13);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(40) NOT NULL,
  `barang` varchar(40) NOT NULL,
  `alamat` text NOT NULL,
  `hp` int(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_data`
--

CREATE TABLE IF NOT EXISTS `transaksi_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` varchar(220) NOT NULL,
  `id_barang` int(30) NOT NULL,
  `jumlah` int(30) NOT NULL,
  `harga_item` int(30) NOT NULL,
  `tot_harga` int(30) NOT NULL,
  `tipe` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Transaksi Penjualan, 0=Retur',
  `tgl` datetime NOT NULL,
  `diskon` int(20) NOT NULL,
  `produksi` int(11) NOT NULL,
  `id_kpm` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `transaksi_data`
--

INSERT INTO `transaksi_data` (`id`, `id_penjualan`, `id_barang`, `jumlah`, `harga_item`, `tot_harga`, `tipe`, `tgl`, `diskon`, `produksi`, `id_kpm`) VALUES
(1, 'outkpmpwt1491735050', 2, 1, 50000, 50000, 1, '2017-04-09 17:50:50', 0, 45000, 3),
(2, 'outkpmpwt1491735050', 3, 1, 450000, 450000, 1, '2017-04-09 17:50:51', 0, 400000, 3),
(3, 'outkpmpwt1491748980', 2, 3, 50000, 150000, 1, '2017-04-09 21:43:00', 0, 45000, 3),
(4, 'rtrkpmpwt1491751479', 2, 2, 50000, 100000, 1, '2017-04-09 22:24:39', 0, 45000, 3),
(7, 'outkpmpwt1491794076', 2, 2, 50000, 100000, 1, '2017-04-10 10:14:36', 0, 45000, 3),
(8, 'rtrkpmpwt1491794227', 2, 1, 50000, 50000, 1, '2017-04-10 10:17:07', 0, 45000, 3),
(9, 'outkpmSM 11492064804', 12, 1, 4000, 4000, 1, '2017-04-13 13:26:44', 0, 2000, 6),
(10, 'outkpmSM 11492064804', 11, 2, 3000, 6000, 1, '2017-04-13 13:26:45', 0, 1500, 6),
(11, 'outkpmSM 11492064804', 10, 2, 2000, 4000, 1, '2017-04-13 13:26:45', 0, 1000, 6),
(12, 'outkpmSM 11492065552', 12, 2, 4000, 8000, 1, '2017-04-13 13:39:12', 0, 2000, 6),
(13, 'outkpmSM 11492065552', 11, 2, 3000, 6000, 1, '2017-04-13 13:39:13', 0, 1500, 6),
(14, 'outkpmSM 11492065651', 11, 2, 3000, 6000, 1, '2017-04-13 13:40:52', 0, 1500, 6),
(15, 'outkpmSM 11492065651', 10, 3, 2000, 6000, 1, '2017-04-13 13:40:52', 0, 1000, 6),
(16, 'outkpmSM 11492065775', 10, 2, 1900, 3800, 1, '2017-04-13 13:42:55', 100, 1000, 6),
(17, 'outkpmSM11492068327', 9, 2, 1000, 2000, 1, '2017-04-13 14:25:28', 0, 500, 6),
(18, 'outkpmSM11492068454', 9, 3, 1000, 3000, 1, '2017-04-13 14:27:34', 0, 500, 6),
(19, 'outkpmSM11492068760', 7, 3, 60000, 180000, 1, '2017-04-13 14:32:40', 0, 42500, 6),
(20, 'outkpmSM11492068760', 9, 3, 1000, 3000, 1, '2017-04-13 14:32:40', 0, 500, 6),
(21, 'rtrkpmSM11492068946', 7, 1, 60000, 60000, 1, '2017-04-13 14:35:46', 0, 42500, 6),
(22, 'rtrkpmSM11492069106', 9, 1, 1000, 1000, 1, '2017-04-13 14:38:26', 0, 500, 6),
(23, 'outkpmSM11492071312', 12, 3, 4000, 12000, 1, '2017-04-13 15:15:12', 0, 2000, 6),
(24, 'outkpmSM11492072176', 12, 4, 4000, 16000, 1, '2017-04-13 15:29:36', 0, 2000, 6),
(25, 'outkpmSM11492072464', 11, 3, 3000, 9000, 1, '2017-04-13 15:34:24', 0, 1500, 6),
(26, 'outkpmSM11492072630', 11, 3, 3000, 9000, 1, '2017-04-13 15:37:10', 0, 1500, 6),
(27, 'outkpmSM11492072776', 10, 2, 2000, 4000, 1, '2017-04-13 15:39:36', 0, 1000, 6),
(28, 'outkpmSM11492072924', 7, 1, 60000, 60000, 1, '2017-04-13 15:42:04', 0, 42500, 6),
(29, 'outkpmSM11492072924', 9, 1, 1000, 1000, 1, '2017-04-13 15:42:04', 0, 500, 6),
(30, 'outkpmSM11492074096', 7, 1, 60000, 60000, 1, '2017-04-13 16:01:36', 0, 42500, 6),
(31, 'outkpmSM11492074823', 7, 5, 60000, 300000, 1, '2017-04-13 16:13:43', 0, 42500, 6),
(32, 'outkpmSM11492409668', 11, 5, 3000, 15000, 1, '2017-04-17 13:14:28', 0, 1500, 6),
(33, 'outkpmSM11492409959', 9, 11, 1000, 11000, 1, '2017-04-17 13:19:19', 0, 500, 6),
(34, 'outkpmSM11492418633', 7, 2, 60000, 120000, 1, '2017-04-17 15:43:53', 0, 42500, 6),
(35, 'outkpmSM11492418656', 12, 2, 4000, 8000, 1, '2017-04-17 15:44:16', 0, 2000, 6),
(36, 'outkpmMG11492585316', 9, 2, 1000, 2000, 1, '2017-04-19 14:01:56', 0, 500, 5),
(37, 'outkpmMG11492585340', 11, 3, 3000, 9000, 1, '2017-04-19 14:02:20', 0, 1500, 5),
(38, 'outkpmMG11492585359', 12, 5, 4000, 20000, 1, '2017-04-19 14:02:39', 0, 2000, 5),
(39, 'outkpmMG11492585381', 6, 1, 60000, 60000, 1, '2017-04-19 14:03:01', 0, 42500, 5),
(40, 'outkpmMG11492585419', 9, 1, 1000, 1000, 1, '2017-04-19 14:03:39', 0, 500, 5),
(41, 'outkpmMG11492585419', 13, 2, 5000, 10000, 1, '2017-04-19 14:03:39', 0, 2500, 5),
(42, 'outkpmMG11492585914', 9, 4, 1000, 4000, 1, '2017-04-19 14:11:54', 0, 500, 5),
(43, 'outkpmMG11492585930', 13, 3, 5000, 15000, 1, '2017-04-19 14:12:10', 0, 2500, 5),
(44, 'outkpmMG11492585997', 9, 1, 1000, 1000, 1, '2017-04-19 14:13:17', 0, 500, 5),
(45, 'outkpmMG11492585997', 12, 2, 4000, 8000, 1, '2017-04-19 14:13:17', 0, 2000, 5),
(46, 'outkpmMG11492586182', 11, 3, 3000, 9000, 1, '2017-04-19 14:16:22', 0, 1500, 5),
(47, 'outkpmMG11492586182', 10, 1, 2000, 2000, 1, '2017-04-19 14:16:22', 0, 1000, 5),
(48, 'outkpmMG11492586337', 6, 3, 60000, 180000, 1, '2017-04-19 14:18:57', 0, 42500, 5),
(49, 'outkpmMG11492586337', 3, 1, 450000, 450000, 1, '2017-04-19 14:18:57', 0, 400000, 5);

--
-- Triggers `transaksi_data`
--
DROP TRIGGER IF EXISTS `penjualan`;
DELIMITER //
CREATE TRIGGER `penjualan` AFTER INSERT ON `transaksi_data`
 FOR EACH ROW BEGIN

       UPDATE stock_cabang SET stock=stock-NEW.jumlah
       where id_kpm=NEW.id_kpm and id_barang=NEW.id_barang;


END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_dataretur`
--

CREATE TABLE IF NOT EXISTS `transaksi_dataretur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` varchar(220) NOT NULL,
  `id_retur` varchar(220) NOT NULL,
  `id_barang` int(30) NOT NULL,
  `jumlah` int(30) NOT NULL,
  `harga_item` int(30) NOT NULL,
  `tot_harga` int(30) NOT NULL,
  `tipe` tinyint(1) NOT NULL DEFAULT '1',
  `tgl` datetime NOT NULL,
  `diskon` int(20) NOT NULL,
  `produksi` int(11) NOT NULL,
  `id_kpm` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `transaksi_dataretur`
--

INSERT INTO `transaksi_dataretur` (`id`, `id_penjualan`, `id_retur`, `id_barang`, `jumlah`, `harga_item`, `tot_harga`, `tipe`, `tgl`, `diskon`, `produksi`, `id_kpm`) VALUES
(2, 'outkpmSM11492072776', 'rtrkpmSM11492072802', 10, 1, 2000, 2000, 1, '2017-04-13 15:40:02', 0, 1000, 6),
(4, 'outkpmSM11492074096', 'rtrkpmSM11492074712', 7, 1, 60000, 60000, 1, '2017-04-13 16:11:52', 0, 42500, 6),
(5, 'outkpmMG11492585419', 'rtrkpmMG11492585804', 13, 1, 5000, 5000, 1, '2017-04-19 14:10:04', 0, 2500, 5),
(6, 'outkpmMG11492585997', 'rtrkpmMG11492586073', 9, 1, 1000, 1000, 1, '2017-04-19 14:14:33', 0, 500, 5),
(7, 'outkpmMG11492586182', 'rtrkpmMG11492586406', 10, 1, 2000, 2000, 1, '2017-04-19 14:20:06', 0, 1000, 5),
(8, 'outkpmMG11492586337', 'rtrkpmMG11492586514', 3, 1, 450000, 450000, 1, '2017-04-19 14:21:54', 0, 400000, 5);

--
-- Triggers `transaksi_dataretur`
--
DROP TRIGGER IF EXISTS `returdata`;
DELIMITER //
CREATE TRIGGER `returdata` BEFORE INSERT ON `transaksi_dataretur`
 FOR EACH ROW BEGIN
UPDATE transaksi_data SET tot_harga=tot_harga-NEW.tot_harga,
jumlah=jumlah-NEW.jumlah
WHERE id_penjualan=NEW.id_penjualan and id_barang=NEW.id_barang;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualan`
--

CREATE TABLE IF NOT EXISTS `transaksi_penjualan` (
  `id` varchar(220) NOT NULL,
  `tot_item` int(30) NOT NULL,
  `tunai` int(30) NOT NULL,
  `atm` int(30) NOT NULL,
  `vocher` int(30) NOT NULL,
  `tot_harga` int(30) NOT NULL,
  `tgl` datetime NOT NULL,
  `id_kpm` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_penjualan`
--

INSERT INTO `transaksi_penjualan` (`id`, `tot_item`, `tunai`, `atm`, `vocher`, `tot_harga`, `tgl`, `id_kpm`) VALUES
('outkpmMG11492585316', 2, 1500, 0, 500, 2000, '2017-04-19 14:01:56', 5),
('outkpmMG11492585340', 3, 9000, 0, 0, 9000, '2017-04-19 14:02:20', 5),
('outkpmMG11492585359', 5, 0, 20000, 0, 20000, '2017-04-19 14:02:39', 5),
('outkpmMG11492585381', 1, 50000, 5000, 5000, 60000, '2017-04-19 14:03:01', 5),
('outkpmMG11492585419', 3, 16000, 0, 0, 11000, '2017-04-19 14:03:39', 5),
('outkpmMG11492585914', 4, 4000, 0, 0, 4000, '2017-04-19 14:11:54', 5),
('outkpmMG11492585930', 3, 15000, 0, 0, 15000, '2017-04-19 14:12:10', 5),
('outkpmMG11492585997', 3, 8000, 0, 2000, 9000, '2017-04-19 14:13:17', 5),
('outkpmMG11492586182', 4, 13000, 0, 0, 11000, '2017-04-19 14:16:22', 5),
('outkpmMG11492586337', 4, 1080000, 0, 0, 630000, '2017-04-19 14:18:57', 5),
('outkpmpwt1491735050', 2, 450000, 0, 50000, 500000, '2017-04-09 17:50:50', 3),
('outkpmpwt1491748980', 3, 150000, 0, 0, 150000, '2017-04-09 21:43:00', 3),
('outkpmpwt1491794076', 2, 80000, 0, 20000, 100000, '2017-04-10 10:14:36', 3),
('outkpmSM 11492064804', 5, 0, 0, 10000, 14000, '2017-04-13 13:26:44', 6),
('outkpmSM 11492065552', 4, 10000, 0, 4000, 14000, '2017-04-13 13:39:12', 6),
('outkpmSM 11492065651', 5, 7000, 0, 5000, 12000, '2017-04-13 13:40:51', 6),
('outkpmSM 11492065775', 2, 1800, 0, 2000, 3800, '2017-04-13 13:42:55', 6),
('outkpmSM11492068327', 2, 1000, 0, 1000, 2000, '2017-04-13 14:25:27', 6),
('outkpmSM11492068454', 3, 3000, 0, 0, 3000, '2017-04-13 14:27:34', 6),
('outkpmSM11492068760', 6, 83000, 0, 100000, 183000, '2017-04-13 14:32:40', 6),
('outkpmSM11492071312', 2, 10000, 0, 2000, 8000, '2017-04-13 15:15:12', 6),
('outkpmSM11492072176', 1, 10000, 0, 6000, 4000, '2017-04-13 15:29:36', 6),
('outkpmSM11492072464', 3, 4000, 0, 5000, 9000, '2017-04-13 15:34:24', 6),
('outkpmSM11492072630', 2, 4000, 0, 5000, 6000, '2017-04-13 15:37:10', 6),
('outkpmSM11492072776', 2, 1000, 0, 5000, 4000, '2017-04-13 15:39:36', 6),
('outkpmSM11492072924', 2, 42000, 0, 20000, 61000, '2017-04-13 15:42:04', 6),
('outkpmSM11492073468', 0, 0, 0, 0, 0, '2017-04-13 15:51:08', 6),
('outkpmSM11492073472', 0, 0, 0, 0, 0, '2017-04-13 15:51:12', 6),
('outkpmSM11492073655', 0, 0, 0, 0, 0, '2017-04-13 15:54:15', 6),
('outkpmSM11492073802', 0, -100000, 0, 100000, 0, '2017-04-13 15:56:42', 6),
('outkpmSM11492073826', 0, 0, 0, 0, 0, '2017-04-13 15:57:06', 6),
('outkpmSM11492073897', 0, 0, 0, 0, 0, '2017-04-13 15:58:17', 6),
('outkpmSM11492074096', 1, 120000, 0, 0, 60000, '2017-04-13 16:01:36', 6),
('outkpmSM11492074823', 5, 300000, 0, 0, 300000, '2017-04-13 16:13:43', 6),
('outkpmSM11492409668', 5, 15000, 0, 0, 15000, '2017-04-17 13:14:28', 6),
('outkpmSM11492409959', 11, 11000, 0, 0, 11000, '2017-04-17 13:19:19', 6),
('outkpmSM11492418633', 2, 100000, 0, 20000, 120000, '2017-04-17 15:43:53', 6),
('outkpmSM11492418656', 2, 6000, 0, 2000, 8000, '2017-04-17 15:44:16', 6);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_retur`
--

CREATE TABLE IF NOT EXISTS `transaksi_retur` (
  `id` varchar(220) NOT NULL,
  `id_penjualan` varchar(220) NOT NULL,
  `tot_harga` int(11) NOT NULL,
  `tot_item` int(11) NOT NULL,
  `is_return` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_retur`
--

INSERT INTO `transaksi_retur` (`id`, `id_penjualan`, `tot_harga`, `tot_item`, `is_return`, `date`) VALUES
('rtrkpmMG11492585804', 'outkpmMG11492585419', 5000, 1, 1, '2017-04-19 14:10:04'),
('rtrkpmMG11492586073', 'outkpmMG11492585997', 1000, 1, 1, '2017-04-19 14:14:33'),
('rtrkpmMG11492586406', 'outkpmMG11492586182', 2000, 1, 1, '2017-04-19 14:20:06'),
('rtrkpmMG11492586514', 'outkpmMG11492586337', 450000, 1, 1, '2017-04-19 14:21:54'),
('rtrkpmpwt1491751479', 'outkpmpwt1491748980', 100000, 2, 1, '2017-04-09 22:24:39'),
('rtrkpmpwt1491794227', 'outkpmpwt1491794076', 50000, 1, 1, '2017-04-10 10:17:07'),
('rtrkpmSM11492068946', 'outkpmSM11492068760', 60000, 1, 1, '2017-04-13 14:35:46'),
('rtrkpmSM11492069106', 'outkpmSM11492068454', 1000, 1, 1, '2017-04-13 14:38:26'),
('rtrkpmSM11492071350', 'outkpmSM11492071312', 4000, 1, 1, '2017-04-13 15:15:50'),
('rtrkpmSM11492072302', 'outkpmSM11492072176', 4000, 1, 1, '2017-04-13 15:31:42'),
('rtrkpmSM11492072305', 'outkpmSM11492072176', 4000, 1, 1, '2017-04-13 15:31:45'),
('rtrkpmSM11492072316', 'outkpmSM11492072176', 4000, 1, 1, '2017-04-13 15:31:56'),
('rtrkpmSM11492072668', 'outkpmSM11492072630', 3000, 1, 1, '2017-04-13 15:37:48'),
('rtrkpmSM11492072802', 'outkpmSM11492072776', 2000, 1, 1, '2017-04-13 15:40:02'),
('rtrkpmSM11492073087', 'outkpmSM11492072924', 1000, 1, 1, '2017-04-13 15:44:47'),
('rtrkpmSM11492074712', 'outkpmSM11492074096', 60000, 1, 1, '2017-04-13 16:11:52');

--
-- Triggers `transaksi_retur`
--
DROP TRIGGER IF EXISTS `retur`;
DELIMITER //
CREATE TRIGGER `retur` AFTER INSERT ON `transaksi_retur`
 FOR EACH ROW BEGIN
UPDATE transaksi_penjualan SET tot_item=tot_item-NEW.tot_item,
tot_harga=tot_harga-NEW.tot_harga
WHERE id=NEW.id_penjualan;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `tgl1` date NOT NULL,
  `tgl2` date NOT NULL,
  `transfer` varchar(220) NOT NULL,
  `transaksi` varchar(220) NOT NULL,
  `item` varchar(220) NOT NULL,
  `id_kpm` int(30) NOT NULL,
  `foc` varchar(220) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
