-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 03:44 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailpenjualan`
--

CREATE TABLE `detailpenjualan` (
  `DetailID` int(11) NOT NULL,
  `PenjualanID` int(11) NOT NULL,
  `ProdukID` int(11) NOT NULL,
  `JumlahProduk` int(11) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detailpenjualan`
--

INSERT INTO `detailpenjualan` (`DetailID`, `PenjualanID`, `ProdukID`, `JumlahProduk`, `Subtotal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 9, 5, '20000.00', '2024-02-28 22:08:33', '2024-02-28 09:13:06', '2024-02-28 09:13:06'),
(2, 1, 10, 5, '25000.00', '2024-02-28 22:08:33', '2024-02-28 09:13:06', '2024-02-28 09:13:06'),
(3, 2, 9, 5, '20000.00', '2024-02-28 22:16:24', '2024-02-28 09:16:45', '2024-02-28 09:16:45'),
(4, 3, 3, 10, '75000.00', '2024-02-28 22:17:30', '2024-02-28 09:17:47', '2024-02-28 09:17:47'),
(7, 4, 11, 1, '7000.00', '2024-02-28 22:56:00', '2024-02-28 10:01:26', '2024-02-28 10:01:26'),
(8, 5, 1, 1, '2500.00', '2024-02-28 22:58:24', '2024-02-28 10:01:28', '2024-02-28 10:01:28'),
(9, 6, 11, 1, '7000.00', '2024-02-28 23:00:06', '2024-02-28 10:01:30', '2024-02-28 10:01:30'),
(15, 8, 8, 3, '9000.00', '2024-02-28 23:17:07', NULL, NULL),
(16, 9, 1, 4, '10000.00', '2024-02-28 23:24:58', NULL, NULL),
(17, 9, 4, 1, '7500.00', '2024-02-28 23:24:58', NULL, NULL),
(18, 9, 8, 1, '3000.00', '2024-02-28 23:24:58', NULL, NULL),
(19, 10, 9, 5, '20000.00', '2024-02-29 09:07:21', NULL, NULL),
(20, 11, 4, 4, '30000.00', '2024-02-29 09:07:56', NULL, NULL),
(21, 12, 6, 5, '50000.00', '2024-02-29 09:09:42', NULL, NULL),
(22, 13, 7, 3, '36000.00', '2024-02-29 09:10:13', NULL, NULL),
(23, 14, 2, 2, '5500.00', '2024-02-29 09:10:44', NULL, NULL),
(24, 15, 8, 5, '15000.00', '2024-02-29 09:11:05', NULL, NULL),
(25, 16, 10, 1, '5000.00', '2024-02-29 09:11:37', NULL, NULL),
(26, 17, 1, 3, '7500.00', '2024-02-29 09:12:02', NULL, NULL),
(27, 18, 3, 2, '15000.00', '2024-02-29 09:12:16', NULL, NULL),
(28, 19, 7, 1, '12000.00', '2024-02-29 09:14:27', NULL, NULL),
(29, 20, 11, 2, '14000.00', '2024-02-29 09:14:57', NULL, NULL),
(30, 21, 11, 20, '140000.00', '2024-02-29 09:16:25', NULL, NULL),
(31, 22, 9, 30, '120000.00', '2024-02-29 09:18:27', NULL, NULL),
(32, 23, 7, 16, '192000.00', '2024-02-29 09:19:24', NULL, NULL),
(33, 24, 3, 8, '60000.00', '2024-02-29 09:21:45', NULL, NULL),
(34, 25, 2, 13, '35750.00', '2024-02-29 09:22:21', NULL, NULL);

--
-- Triggers `detailpenjualan`
--
DELIMITER $$
CREATE TRIGGER `hapuss` AFTER UPDATE ON `detailpenjualan` FOR EACH ROW BEGIN
UPDATE Produk SET Stok = Stok+old.JumlahProduk WHERE ProdukID=old.ProdukID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `keluar` AFTER INSERT ON `detailpenjualan` FOR EACH ROW BEGIN
UPDATE produk SET Stok = Stok-new.JumlahProduk WHERE ProdukID=new.ProdukID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', '2024-01-22 22:25:19', NULL, NULL),
(2, 'Petugas', '2024-01-22 22:25:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `PelangganID` int(11) NOT NULL,
  `NamaPelanggan` varchar(255) NOT NULL,
  `Alamat` text NOT NULL,
  `NomorTelepon` int(15) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`PelangganID`, `NamaPelanggan`, `Alamat`, `NomorTelepon`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Darrell', 'Perumahan Tiban\r\n', 44523122, '2024-02-01 21:32:30', '2024-02-28 06:45:13', NULL),
(2, 'Kevin', 'Perumahan Mitra', 689907675, '2024-02-02 20:14:38', '2024-02-27 21:38:40', NULL),
(4, 'Bryan', 'Perumahan Batam Centre', 12453431, '2024-02-28 13:53:51', '2024-02-28 06:45:20', NULL),
(5, 'Ari', 'Tg Uma', 24354443, '2024-02-28 13:54:05', '2024-02-28 06:45:30', NULL),
(6, 'Rizkan', 'Mega Legenda', 454678567, '2024-02-28 13:54:30', '2024-02-28 06:45:39', NULL),
(7, 'Diva', 'Tg Uma', 214435232, '2024-02-28 13:54:48', '2024-02-28 06:45:48', NULL),
(8, 'Ferdi', 'Bengkong', 32454334, '2024-02-28 13:55:14', '2024-02-28 06:45:58', NULL),
(9, 'Firman', 'Tg Uncang', 12234555, '2024-02-28 13:55:37', '2024-02-28 06:46:07', NULL),
(10, 'Fressa', 'Bengkong', 43545666, '2024-02-28 13:55:56', '2024-02-28 06:46:16', NULL),
(11, 'Yanda', 'Batam Centre', 5465766, '2024-02-28 13:56:11', '2024-02-28 06:46:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `PenjualanID` int(11) NOT NULL,
  `TanggalPenjualan` date NOT NULL,
  `TotalHarga` decimal(10,2) NOT NULL,
  `PelangganID` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `bayar` decimal(10,0) NOT NULL,
  `kembalian` decimal(10,0) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`PenjualanID`, `TanggalPenjualan`, `TotalHarga`, `PelangganID`, `user`, `bayar`, `kembalian`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, '2024-01-28', '9000.00', 11, 1, '10000', '1000', '2024-02-28 23:17:07', NULL, NULL),
(9, '2024-02-28', '20500.00', 1, 1, '25000', '4500', '2024-02-28 23:24:58', NULL, NULL),
(10, '2024-01-24', '20000.00', 2, 1, '25000', '5000', '2024-02-29 09:07:21', NULL, NULL),
(11, '2024-02-28', '30000.00', 6, 1, '50000', '20000', '2024-02-29 09:07:56', NULL, NULL),
(12, '2024-03-28', '50000.00', 10, 1, '100000', '50000', '2024-02-29 09:09:42', NULL, NULL),
(13, '2024-03-28', '36000.00', 7, 1, '40000', '4000', '2024-02-29 09:10:13', NULL, NULL),
(14, '2024-04-28', '5500.00', 4, 1, '6000', '500', '2024-02-29 09:10:44', NULL, NULL),
(15, '2024-07-28', '15000.00', 9, 1, '20000', '5000', '2024-02-29 09:11:05', NULL, NULL),
(16, '2024-05-28', '5000.00', 1, 1, '10000', '5000', '2024-02-29 09:11:37', NULL, NULL),
(17, '2024-05-28', '7500.00', 10, 1, '10000', '2500', '2024-02-29 09:12:02', NULL, NULL),
(18, '2024-06-28', '15000.00', 2, 1, '20000', '5000', '2024-02-29 09:12:16', NULL, NULL),
(19, '2024-04-28', '12000.00', 5, 1, '15000', '3000', '2024-02-29 09:14:27', NULL, NULL),
(20, '2024-07-28', '14000.00', 8, 1, '15000', '1000', '2024-02-29 09:14:57', NULL, NULL),
(21, '2024-08-28', '140000.00', 1, 1, '150000', '10000', '2024-02-29 09:16:25', NULL, NULL),
(22, '2024-09-28', '120000.00', 7, 1, '150000', '30000', '2024-02-29 09:18:27', NULL, NULL),
(23, '2024-10-28', '192000.00', 4, 1, '200000', '8000', '2024-02-29 09:19:24', NULL, NULL),
(24, '2024-11-28', '60000.00', 1, 1, '100000', '40000', '2024-02-29 09:21:45', NULL, NULL),
(25, '2024-12-28', '35750.00', 9, 1, '40000', '4250', '2024-02-29 09:22:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `ProdukID` int(11) NOT NULL,
  `NamaProduk` varchar(255) NOT NULL,
  `Harga` decimal(10,2) NOT NULL,
  `Stok` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`ProdukID`, `NamaProduk`, `Harga`, `Stok`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Chitato', '2500.00', 80, '2024-02-01 21:20:07', '2024-02-28 00:48:33', NULL),
(2, 'Taro', '2750.00', 80, '2024-02-01 22:08:33', '2024-02-28 00:48:42', NULL),
(3, 'Nutrisari', '7500.00', 190, '2024-02-01 21:20:07', '2024-02-28 00:49:00', NULL),
(4, 'Fruit Tea', '7500.00', 94, '2024-02-01 21:20:07', '2024-02-28 00:49:10', NULL),
(6, 'Roti Morning Bakery', '10000.00', 45, '2024-02-05 20:56:10', '2024-02-28 00:50:00', NULL),
(7, 'Roti Top Bakery', '12000.00', 80, '2024-02-28 13:50:37', NULL, NULL),
(8, 'Fresh Tea', '3000.00', 90, '2024-02-28 13:51:25', NULL, NULL),
(9, 'Aqua', '4000.00', 160, '2024-02-28 13:51:53', NULL, NULL),
(10, 'Nestle', '5000.00', 43, '2024-02-28 13:52:15', NULL, NULL),
(11, 'Astro', '7000.00', 178, '2024-02-28 13:52:34', '2024-02-28 00:53:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk_masuk`
--

CREATE TABLE `produk_masuk` (
  `ProdukMasukID` int(11) NOT NULL,
  `ProdukID` int(11) NOT NULL,
  `Stok_masuk` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_masuk`
--

INSERT INTO `produk_masuk` (`ProdukMasukID`, `ProdukID`, `Stok_masuk`, `user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 1, 10, 1, '2024-02-02 16:49:16', NULL, NULL);

--
-- Triggers `produk_masuk`
--
DELIMITER $$
CREATE TRIGGER `masuk` BEFORE INSERT ON `produk_masuk` FOR EACH ROW BEGIN
UPDATE produk SET Stok = Stok+new.Stok_masuk WHERE ProdukID=new.ProdukID;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah` AFTER DELETE ON `produk_masuk` FOR EACH ROW BEGIN
UPDATE Produk SET Stok = Stok-old.Stok_masuk WHERE ProdukID=old.ProdukID;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `foto` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `foto`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'c4ca4238a0b923820dcc509a6f75849b', 1, 'default.png', '2024-01-22 22:26:01', NULL, NULL),
(2, 'Petugas', 'c4ca4238a0b923820dcc509a6f75849b', 2, 'default.png', '2024-01-22 22:26:01', '2024-02-28 00:46:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `website`
--

CREATE TABLE `website` (
  `id_website` int(11) NOT NULL,
  `nama_website` varchar(255) NOT NULL,
  `logo_website` text DEFAULT NULL,
  `logo_pdf` text DEFAULT NULL,
  `favicon_website` text DEFAULT NULL,
  `komplek` text DEFAULT NULL,
  `jalan` text DEFAULT NULL,
  `kelurahan` text DEFAULT NULL,
  `kecamatan` text DEFAULT NULL,
  `kota` text DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `website`
--

INSERT INTO `website` (`id_website`, `nama_website`, `logo_website`, `logo_pdf`, `favicon_website`, `komplek`, `jalan`, `kelurahan`, `kecamatan`, `kota`, `kode_pos`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Point Of Sale', 'T&T Supermarket.svg', 'obor.png', 'obor.png', 'Komp. Pahlawan Mas', 'Jl. Raya Pahlawan No. 123', 'Kel. Sukajadi', 'Kec. Sukasari', 'Kota Batam', '29424', '2023-05-01 16:33:53', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD PRIMARY KEY (`DetailID`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`PelangganID`),
  ADD UNIQUE KEY `NomorTelepon` (`NomorTelepon`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`PenjualanID`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`ProdukID`);

--
-- Indexes for table `produk_masuk`
--
ALTER TABLE `produk_masuk`
  ADD PRIMARY KEY (`ProdukMasukID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id_website`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  MODIFY `DetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `PelangganID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `PenjualanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `ProdukID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk_masuk`
--
ALTER TABLE `produk_masuk`
  MODIFY `ProdukMasukID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `website`
--
ALTER TABLE `website`
  MODIFY `id_website` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
