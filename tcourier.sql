-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2018 at 07:46 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tcourier`
--

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `nrp_courier` char(14) NOT NULL,
  `wilayah_courier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `nrp_customer` char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `list_pesanan`
--

CREATE TABLE `list_pesanan` (
  `id_list` int(8) UNSIGNED ZEROFILL NOT NULL,
  `id_makanan` int(3) UNSIGNED ZEROFILL NOT NULL,
  `id_pesanan` int(5) UNSIGNED ZEROFILL NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_customer` char(14) NOT NULL,
  `id_courier` char(14) NOT NULL,
  `wilayah` varchar(100) NOT NULL,
  `diterima` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `makanan`
--

CREATE TABLE `makanan` (
  `id_makanan` int(3) UNSIGNED ZEROFILL NOT NULL,
  `nama_makanan` varchar(100) NOT NULL,
  `wilayah_makanan` int(2) UNSIGNED ZEROFILL NOT NULL,
  `harga_makanan` int(255) NOT NULL,
  `deskripsi_makanan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `makanan`
--

INSERT INTO `makanan` (`id_makanan`, `nama_makanan`, `wilayah_makanan`, `harga_makanan`, `deskripsi_makanan`) VALUES
(001, 'Penyetan Bebek', 01, 10000, 'Sambal Pilihan Terenak'),
(002, 'Nasi Goreng Ijo', 01, 12000, 'Gk enak'),
(003, 'Ayam Geprek', 02, 10000, 'Custom Level PEDAS'),
(004, 'Pizza', 03, 20000, 'Mehong'),
(005, 'Sate Ayam', 02, 10000, 'Kulit Ayam Pilihan'),
(006, 'Katsu', 03, 15000, 'Lezat Biasah Saja'),
(007, 'Sosis Bakar', 03, 4000, 'Sosis enak ndak bikin kembung');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(5) UNSIGNED ZEROFILL NOT NULL,
  `nrp_pemesan` char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `nrp` char(14) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pwd` varchar(20) NOT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `idline` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `id_wilayah` int(2) UNSIGNED ZEROFILL NOT NULL,
  `nama_wilayah` varchar(10) NOT NULL,
  `ongkos_wilayah` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`id_wilayah`, `nama_wilayah`, `ongkos_wilayah`) VALUES
(01, 'Gebang', 7000),
(02, 'Keputih', 5000),
(03, 'Mulyos', 8000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD UNIQUE KEY `nrp_courier` (`nrp_courier`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`nrp_customer`);

--
-- Indexes for table `list_pesanan`
--
ALTER TABLE `list_pesanan`
  ADD PRIMARY KEY (`id_list`);

--
-- Indexes for table `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`id_makanan`),
  ADD KEY `wilayah_makanan` (`wilayah_makanan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `nrp_pemesan` (`nrp_pemesan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nrp`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `makanan`
--
ALTER TABLE `makanan`
  MODIFY `id_makanan` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `id_wilayah` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courier`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
