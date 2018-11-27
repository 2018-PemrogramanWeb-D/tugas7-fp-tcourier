create database tcourier;
 
use tcourier
-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2018 at 04:45 PM
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

--
-- Dumping data for table `courier`
--

INSERT INTO `courier` (`nrp_courier`, `wilayah_courier`) VALUES
('2', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `nrp_customer` char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`nrp_customer`) VALUES
('2');

-- --------------------------------------------------------

--
-- Table structure for table `list_pesanan`
--

CREATE TABLE `list_pesanan` (
  `id_list` int(8) UNSIGNED ZEROFILL NOT NULL,
  `id_makanan` int(3) UNSIGNED ZEROFILL NOT NULL,
  `id_pesanan` int(5) UNSIGNED ZEROFILL NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_customer` int(14) NOT NULL,
  `id_courier` int(14) NOT NULL,
  `wilayah` varchar(100) NOT NULL,
  `diterima` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_pesanan`
--

INSERT INTO `list_pesanan` (`id_list`, `id_makanan`, `id_pesanan`, `jumlah`, `id_customer`, `id_courier`, `wilayah`, `diterima`) VALUES
(00001003, 003, 00001, 1, 1, 0, '02', b'0'),
(00001004, 004, 00001, 1, 1, 0, '03', b'0'),
(00001005, 005, 00001, 1, 1, 0, '02', b'0'),
(00002001, 001, 00002, 1, 2, 0, '01', b'0'),
(00002002, 002, 00002, 1, 2, 0, '01', b'0'),
(00002003, 003, 00002, 3, 2, 0, '02', b'0'),
(00002005, 005, 00002, 1, 2, 0, '02', b'0'),
(00003003, 003, 00003, 1, 2, 0, '02', b'0'),
(00003005, 005, 00003, 88, 2, 0, '02', b'0');

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
(001, 'Penyetan', 01, 7000, 'enak'),
(002, 'Tikus Bakar', 01, 1000, 'gk enak'),
(003, 'kuda bakar', 02, 10000, 'mahal'),
(004, 'kelinci bakar', 03, 9000, 'kecil'),
(005, 'jangkrik bakar', 02, 5000, 'jijik');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(5) UNSIGNED ZEROFILL NOT NULL,
  `nrp_pemesan` char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `nrp_pemesan`) VALUES
(00001, '1'),
(00002, '2'),
(00003, '2');

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

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`nrp`, `nama`, `email`, `pwd`, `nohp`, `idline`) VALUES
('1', '', '1@gmail.com', '1', '1', '1'),
('2', '', '2@gmail.com', '2', '2', '2');

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
(01, 'Gebang', 5000),
(02, 'keputih', 5000),
(03, 'mulyos', 7000);

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
  MODIFY `id_makanan` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
ALTER TABLE `courier`
  ADD CONSTRAINT `courier_ibfk_1` FOREIGN KEY (`nrp_courier`) REFERENCES `users` (`nrp`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`nrp_customer`) REFERENCES `users` (`nrp`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`nrp_pemesan`) REFERENCES `users` (`nrp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
