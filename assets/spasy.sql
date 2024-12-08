-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 03:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spasy`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `label_jenis` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `label_jenis`) VALUES
(1, 'Organik'),
(2, 'Anorganik');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `nama_kategori` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `id_jenis`, `nama_kategori`) VALUES
(1, 1, 'Minyak'),
(2, 1, 'Sisa Makanan'),
(3, 1, 'Kayu'),
(4, 1, 'Kertas'),
(5, 2, 'Plastik'),
(6, 2, 'Besi'),
(7, 2, 'Kaca');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `aktivitas` longtext DEFAULT NULL,
  `timestamps` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengelolaan_sampah`
--

CREATE TABLE `pengelolaan_sampah` (
  `id_pengelolaan_sampah` int(11) NOT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `id_sampah` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `tanggal_pengelolaan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `nik` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`nik`, `email`, `password`, `nama`, `status`, `alamat`, `no_telp`) VALUES
('1', 'wawan@gmail.com', '1234', 'wawan', 'free user', 'empty', 'empty'),
('2', 'gin@gmail.com', '$2y$10$ay/fMDOfhKvrVhuPLL1Y5eFsJx7iKO0eV1xZMbto5SciWXvepTYqi', 'Gino', 'free user', 'empty', 'empty'),
('3', 'wahyu@gmail.com', '$2y$10$pPZR/QN4mI113Aihhs0Bquoj2Ss0twPZ4ksauCwjxFMtl8tE3FQoW', 'wahyu', 'free user', 'empty', 'empty'),
('4', 'gungun@gmail.com', '$2y$10$mPJ..G0MlCby62pNvddSgu8BIMbyo.cGGtEud3pDq84v20.k891MG', 'Gunawan', 'free user', 'empty', 'empty');

-- --------------------------------------------------------

--
-- Table structure for table `sampah`
--

CREATE TABLE `sampah` (
  `id_sampah` int(11) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `tanggal_masuk` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sampah`
--

INSERT INTO `sampah` (`id_sampah`, `nik`, `id_kategori`, `total`, `tanggal_masuk`) VALUES
(4, '2', 1, 0.02, '2024-12-01 00:00:00'),
(5, '2', 1, 0.01, '2024-12-01 14:52:00'),
(6, '2', 1, 0.01, '2024-12-01 14:52:00'),
(7, '2', 1, 0.01, '2024-12-01 14:56:00'),
(8, '2', 6, 0.02, '2024-12-01 15:12:00'),
(9, '2', 2, 0.04, '2024-12-01 15:20:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `Foreign Key` (`id_jenis`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `pengelolaan_sampah`
--
ALTER TABLE `pengelolaan_sampah`
  ADD PRIMARY KEY (`id_pengelolaan_sampah`),
  ADD KEY `id_sampah` (`id_sampah`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `sampah`
--
ALTER TABLE `sampah`
  ADD PRIMARY KEY (`id_sampah`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `Foreign Key` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengelolaan_sampah`
--
ALTER TABLE `pengelolaan_sampah`
  MODIFY `id_pengelolaan_sampah` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sampah`
--
ALTER TABLE `sampah`
  MODIFY `id_sampah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `kategori_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`);

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `pengguna` (`nik`);

--
-- Constraints for table `pengelolaan_sampah`
--
ALTER TABLE `pengelolaan_sampah`
  ADD CONSTRAINT `pengelolaan_sampah_ibfk_2` FOREIGN KEY (`id_sampah`) REFERENCES `sampah` (`id_sampah`),
  ADD CONSTRAINT `pengelolaan_sampah_ibfk_3` FOREIGN KEY (`nik`) REFERENCES `pengguna` (`nik`);

--
-- Constraints for table `sampah`
--
ALTER TABLE `sampah`
  ADD CONSTRAINT `sampah_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `sampah_ibfk_2` FOREIGN KEY (`nik`) REFERENCES `pengguna` (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
