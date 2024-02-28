-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2024 at 09:07 AM
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
(1, 1, 1, 6, '15000.00', '2024-02-05 18:40:48', NULL, NULL),
(2, 1, 3, 2, '15000.00', '2024-02-05 18:40:48', NULL, NULL),
(3, 2, 2, 12, '33000.00', '2024-02-05 18:43:22', NULL, NULL),
(4, 2, 1, 12, '30000.00', '2024-02-05 18:43:22', NULL, NULL),
(5, 3, 6, 5, '50000.00', '2024-02-05 21:00:53', NULL, NULL),
(6, 3, 3, 1, '7500.00', '2024-02-05 21:00:53', NULL, NULL),
(7, 4, 2, 2, '5500.00', '2024-02-28 11:00:04', NULL, NULL),
(8, 4, 1, 5, '12500.00', '2024-02-28 11:00:04', NULL, NULL),
(9, 5, 3, 3, '22500.00', '2024-02-28 11:04:07', NULL, NULL),
(10, 5, 2, 5, '13750.00', '2024-02-28 11:04:07', NULL, NULL),
(11, 6, 1, 1, '2500.00', '2024-02-28 14:49:32', NULL, NULL),
(12, 6, 10, 1, '5000.00', '2024-02-28 14:49:33', NULL, NULL);

--
-- Triggers `detailpenjualan`
--
DELIMITER $$
CREATE TRIGGER `hapus` AFTER DELETE ON `detailpenjualan` FOR EACH ROW BEGIN
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
  `NomorTelepon` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`PelangganID`, `NamaPelanggan`, `Alamat`, `NomorTelepon`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Darrell', 'Perumahan Tiban\r\n', '084597651452', '2024-02-01 21:32:30', '2024-02-27 21:38:14', NULL),
(2, 'Kevin', 'Perumahan Mitra', '081547223452', '2024-02-02 20:14:38', '2024-02-27 21:38:40', NULL),
(3, 'Halo', 'tes', '08154722', '2024-02-28 10:38:54', '2024-02-27 21:38:58', '2024-02-27 21:38:58'),
(4, 'Bryan', 'Perumahan Batam Centre', '081547222389', '2024-02-28 13:53:51', NULL, NULL),
(5, 'Ari', 'Tg Uma', '081547220238', '2024-02-28 13:54:05', NULL, NULL),
(6, 'Rizkan', 'Mega Legenda', '081547223440', '2024-02-28 13:54:30', '2024-02-28 00:56:20', NULL),
(7, 'Diva', 'Tg Uma', '081547223874', '2024-02-28 13:54:48', '2024-02-28 00:54:52', NULL),
(8, 'Ferdi', 'Bengkong', '081547223231', '2024-02-28 13:55:14', '2024-02-28 00:55:17', NULL),
(9, 'Firman', 'Tg Uncang', '081547223456', '2024-02-28 13:55:37', '2024-02-28 00:55:41', NULL),
(10, 'Fressa', 'Bengkong', '081547223456', '2024-02-28 13:55:56', NULL, NULL),
(11, 'Yanda', 'Batam Centre', '081547223098', '2024-02-28 13:56:11', NULL, NULL);

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
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`PenjualanID`, `TanggalPenjualan`, `TotalHarga`, `PelangganID`, `user`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2024-02-05', '30000.00', 1, 1, '2024-02-05 18:40:48', '2024-02-05 20:58:39', '2024-02-05 20:58:39'),
(2, '2024-02-05', '63000.00', 2, 1, '2024-02-05 18:43:22', NULL, NULL),
(3, '2024-02-05', '57500.00', 1, 1, '2024-02-05 21:00:53', NULL, NULL),
(4, '2024-02-27', '18000.00', 1, 1, '2024-02-28 11:00:04', NULL, NULL),
(5, '2024-02-27', '36250.00', 2, 1, '2024-02-28 11:04:07', NULL, NULL),
(6, '2024-02-28', '7500.00', 1, 1, '2024-02-28 14:49:32', NULL, NULL);

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
(1, 'Chitato', '2500.00', 99, '2024-02-01 21:20:07', '2024-02-28 00:48:33', NULL),
(2, 'Taro', '2750.00', 100, '2024-02-01 22:08:33', '2024-02-28 00:48:42', NULL),
(3, 'Nutrisari', '7500.00', 200, '2024-02-01 21:20:07', '2024-02-28 00:49:00', NULL),
(4, 'Fruit Tea', '7500.00', 100, '2024-02-01 21:20:07', '2024-02-28 00:49:10', NULL),
(5, 'SSD', '7500.00', 50, '2024-02-01 21:20:07', NULL, '2024-02-04 22:12:45'),
(6, 'Roti Morning Bakery', '10000.00', 50, '2024-02-05 20:56:10', '2024-02-28 00:50:00', NULL),
(7, 'Roti Top Bakery', '12000.00', 100, '2024-02-28 13:50:37', NULL, NULL),
(8, 'Fresh Tea', '3000.00', 100, '2024-02-28 13:51:25', NULL, NULL),
(9, 'Aqua', '4000.00', 200, '2024-02-28 13:51:53', NULL, NULL),
(10, 'Nestle', '5000.00', 49, '2024-02-28 13:52:15', NULL, NULL),
(11, 'Astro', '7000.00', 200, '2024-02-28 13:52:34', '2024-02-28 00:53:07', NULL);

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
(2, 'Cristian', 'c4ca4238a0b923820dcc509a6f75849b', 2, 'default.png', '2024-01-22 22:26:01', '2024-02-28 00:46:51', NULL),
(4, 'Darrell', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'default.png', '2024-02-27 21:14:46', '2024-02-27 21:15:08', '2024-02-27 21:15:08'),
(5, 'Darrell', 'd41d8cd98f00b204e9800998ecf8427e', 0, 'default.png', '2024-02-28 00:46:59', '2024-02-28 00:47:14', '2024-02-28 00:47:14');

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
  ADD PRIMARY KEY (`PelangganID`);

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
  MODIFY `DetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `PenjualanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
