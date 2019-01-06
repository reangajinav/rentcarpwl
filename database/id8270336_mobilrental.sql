-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 06, 2019 at 02:08 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id8270336_mobilrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_cus` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id_cus`, `username`, `password`) VALUES
(1, 'simpul', 'ed7842df5fcdf18e348f1c048c90f064'),
(9, 'aingmacan', '149290ee26cd28993e4e58e26830f003'),
(10, 'skip', '08b43519a7e36ee4c6c5615d1663bcfd');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis`
--

CREATE TABLE `tb_jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenis`
--

INSERT INTO `tb_jenis` (`id_jenis`, `nama_jenis`) VALUES
(1, 'Manual'),
(2, 'Matic'),
(3, 'Manual dan Matic');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mobil`
--

CREATE TABLE `tb_mobil` (
  `id_mobil` int(5) NOT NULL,
  `foto_mobil` varchar(25) NOT NULL,
  `id_jenis` int(5) NOT NULL,
  `type_mobil` varchar(25) NOT NULL,
  `merk` varchar(25) NOT NULL,
  `no_polisi` varchar(12) NOT NULL,
  `warna` varchar(25) NOT NULL,
  `harga` int(15) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mobil`
--

INSERT INTO `tb_mobil` (`id_mobil`, `foto_mobil`, `id_jenis`, `type_mobil`, `merk`, `no_polisi`, `warna`, `harga`, `status`) VALUES
(7, 'avanza.jpg', 2, 'Avanza 2010', 'Toyota', 'B 1996 END', 'Silver', 200000, 1),
(8, 'mobilio.jpg', 1, 'Mobilio 2017', 'Honda', 'B 0102 BGL', 'Merah Marun', 275000, 1),
(9, 'ertiga.jpg', 1, 'Ertiga 2017', 'Suzuki', 'B 9876 TES', 'Silver', 265000, 0),
(10, 'jazz.jpg', 1, 'Jazz 2018', 'Honda', 'k 5418 py', 'hitam', 300000, 1),
(13, '22-12-2018innova.jpg', 1, 'Innova', 'Toyota', 'K 2244 km', 'Putih', 400000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_ktp` varchar(50) NOT NULL,
  `foto_pelanggan` varchar(100) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tanggal_lahir` varchar(25) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `status_peminjaman` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `username`, `password`, `no_ktp`, `foto_pelanggan`, `nama_lengkap`, `tanggal_lahir`, `alamat_pelanggan`, `no_telepon`, `status_peminjaman`) VALUES
(2, 'user1', '12345', '95123', 'balon.jpg', 'Balon Bolo2', '1998-03-09', 'Jl', '02131905947', 1),
(4, 'user3', '12345', '2147483647', '1444863361798.jpg', 'reang aji', '1998-07-04', 'rembang', '08994800271', 1),
(9, 'reang1801', 'fce68e2f469e46c466baf564e4f7ca63', '331711801980002', '05-12-20181444863377002.jpg', 'reang aji wiranto', '2018-01-27', 'jalan garuda no 120', '08994800271', 0),
(10, 'ulil1', '755f85c2723bb39381c7379a604160d8', '12582', '1443884641636.jpg', 'ulil albab', '2018-12-01', 'a', '565', 0),
(11, 'ulil12', '755f85c2723bb39381c7379a604160d8', '12582', '1444862596875.jpg', 'reang aji', '2018-12-01', 'a', '565', 0),
(12, 'nang1', '755f85c2723bb39381c7379a604160d8', '1323235', '1444863351499.jpg', 'nang', '2018-12-07', 'jalan garuda no 120', '23232', 0),
(14, 'gabriel', 'bcd879526f343c368a1939680384ce8e', '331711801980003', 'C360_2016-02-14-16-15-38-024.jpg', 'gabriel', '2019-01-01', 'jalan garuda no 120', '08994800271', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_bayar` int(5) NOT NULL,
  `id_transaksi` int(5) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `pembayaran` varchar(25) NOT NULL,
  `no_rek` varchar(20) DEFAULT NULL,
  `nama_bank` varchar(25) DEFAULT NULL,
  `atas_nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_bayar`, `id_transaksi`, `tgl_bayar`, `pembayaran`, `no_rek`, `nama_bank`, `atas_nama`) VALUES
(17, 18, '2018-03-12', 'Cash', '', '', ''),
(18, 20, '2018-10-28', 'Cash', '', '', ''),
(19, 21, '2018-10-11', 'Cash', '', '', ''),
(21, 22, '2018-12-11', 'Cash', '', '', ''),
(23, 25, '2018-12-11', 'Cash', '', '', ''),
(24, 0, '0000-00-00', '', '', '', ''),
(25, 0, '0000-00-00', '', '', '', ''),
(26, 36, '2019-01-06', 'Cash', '', '', ''),
(27, 33, '2019-01-07', 'Cash', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengembalian`
--

CREATE TABLE `tb_pengembalian` (
  `id_pengembalian` int(5) NOT NULL,
  `id_transaksi` int(5) NOT NULL,
  `harga` int(15) NOT NULL,
  `terlambat` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengembalian`
--

INSERT INTO `tb_pengembalian` (`id_pengembalian`, `id_transaksi`, `harga`, `terlambat`) VALUES
(5, 18, 200000, 1),
(7, 20, 200000, 0),
(9, 21, 275000, 0),
(10, 22, 200000, 1),
(11, 25, 300000, 0),
(12, 0, 0, 0),
(13, 36, 200000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(5) NOT NULL,
  `id_mobil` int(5) NOT NULL,
  `harga` int(11) NOT NULL,
  `id_pelanggan` int(5) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `tgl_sewa` datetime NOT NULL,
  `tgl_selesaisewa` datetime NOT NULL,
  `jumlah_harga` int(11) NOT NULL,
  `denda` int(11) DEFAULT NULL,
  `status_pembayaran` int(5) NOT NULL,
  `status_pengembalian` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_mobil`, `harga`, `id_pelanggan`, `nama_lengkap`, `tgl_sewa`, `tgl_selesaisewa`, `jumlah_harga`, `denda`, `status_pembayaran`, `status_pengembalian`) VALUES
(18, 7, 200000, 3, 'Andhika Elfriza', '2018-03-11 15:55:00', '2018-03-13 15:55:00', 400000, 200000, 1, 1),
(20, 7, 200000, 4, 'reang aji', '2018-10-30 14:05:00', '2018-10-31 14:05:00', 200000, 0, 1, 1),
(21, 8, 275000, 3, 'Andhika Elfriza', '2018-10-10 10:50:00', '2018-10-11 10:50:00', 275000, 0, 1, 1),
(22, 7, 200000, 2, 'Balon Bolo2', '2018-12-11 09:45:00', '2018-12-12 09:45:00', 200000, 200000, 1, 1),
(25, 10, 300000, 9, 'reang aji wiranto', '2018-12-10 10:00:00', '2018-12-11 10:00:00', 300000, 0, 1, 1),
(33, 7, 200000, 9, 'reang aji wiranto', '2018-12-11 12:00:00', '2018-12-12 12:00:00', 200000, 0, 1, 0),
(34, 0, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0),
(35, 0, 0, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0),
(36, 7, 200000, 14, 'gabriel', '2019-01-06 11:00:00', '2019-01-07 11:00:00', 200000, 0, 1, 1),
(37, 9, 265000, 14, 'gabriel', '2019-01-07 08:00:00', '2019-01-08 08:00:00', 265000, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500'),
(2, 'andhikaelfriza', '50f6ad15560121df2cc86ebc4dd44f1d'),
(3, 'reang', 'reang'),
(4, 'hendra', 'a04cca766a885687e33bc6b114230ee9'),
(5, 'hamble', 'd5db1e938f15cce4356443a145f7b260'),
(6, '', 'd41d8cd98f00b204e9800998ecf8427e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_cus`);

--
-- Indexes for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `tb_mobil`
--
ALTER TABLE `tb_mobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_mobil` (`id_mobil`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `id_cus` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_mobil`
--
ALTER TABLE `tb_mobil`
  MODIFY `id_mobil` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_bayar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  MODIFY `id_pengembalian` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
