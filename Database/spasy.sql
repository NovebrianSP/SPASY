-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 12:56 PM
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
  `label_jenis` varchar(10) DEFAULT NULL
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
  `id_jenis` int(11) DEFAULT NULL,
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
  `timestamps` datetime DEFAULT NULL,
  `id_target` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `nik`, `aktivitas`, `timestamps`, `id_target`) VALUES
(1, '1', 'Menambahkan 2 kg sampah ke kategori Minyak', '2024-12-14 15:46:00', NULL),
(2, '1', 'Menambahkan 1.5 kg sampah ke kategori Besi', '2024-12-15 06:07:55', 1),
(3, '1', 'Menambahkan 2 kg sampah ke kategori Besi', '2024-12-15 06:08:12', NULL),
(4, '3', 'Menambahkan 1 kg sampah ke kategori Plastik', '2024-12-16 06:37:41', 2);

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
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Inactive',
  `alamat` varchar(100) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `start_sub_date` datetime DEFAULT NULL,
  `end_sub_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`nik`, `email`, `password`, `nama`, `status`, `alamat`, `no_telp`, `start_sub_date`, `end_sub_date`, `created_at`, `updated_at`) VALUES
('1', 'wage@gmail.com', '$2y$10$8d2RirEiibz0rBext73xP.lsiZOfq7iWn4V06S/27.8xd/kudaYMO', 'Wagiman', 'Active', 'empty', 'empty', '2024-12-15 12:07:10', '2025-12-15 12:07:10', '2024-12-14 21:40:10', '2024-12-15 12:07:10'),
('2', 'bayu@gmail.com', '$2y$10$1a0vDRFrXbhSn6aTvqYyvOHoVLyoza6mGqNDe2hnQqSG4UelrAFOm', 'Bayu', 'Active', 'empty', 'empty', '2024-12-16 06:15:30', '2025-01-16 06:15:30', '2024-12-15 12:10:13', '2024-12-16 12:15:30'),
('3', 'natan@gmail.com', '$2y$10$c0K.TU0YEQoNZS20asoMzuHF4.ozfsohMkR3aF/FBttZiIb1F1Ydy', 'Natan', 'Active', 'empty', 'empty', '2024-12-16 06:35:22', '2025-01-16 06:35:22', '2024-12-16 12:30:20', '2024-12-16 12:35:22'),
('4', 'janto@gmail.com', '$2y$10$n/eN2GijJ6Ilv0p1wbCF6eU5nDGjw6.F89xUYKQZnRkYMkNNWUqZ6', 'Janto', 'Active', 'empty', 'empty', '2024-12-16 10:13:41', '2025-01-16 10:13:41', '2024-12-16 15:45:23', '2024-12-16 16:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `sampah`
--

CREATE TABLE `sampah` (
  `id_sampah` int(11) NOT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `tanggal_masuk` datetime DEFAULT NULL,
  `id_target` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sampah`
--

INSERT INTO `sampah` (`id_sampah`, `nik`, `id_kategori`, `total`, `tanggal_masuk`, `id_target`) VALUES
(1, '1', 1, 2, '2024-12-14 21:45:00', NULL),
(2, '1', 6, 1.5, '2024-12-15 12:07:00', 1),
(3, '1', 6, 2, '2024-12-15 12:08:00', NULL),
(4, '3', 5, 1, '2024-12-16 12:37:00', 2);

--
-- Triggers `sampah`
--
DELIMITER $$
CREATE TRIGGER `update_target_progress` AFTER INSERT ON `sampah` FOR EACH ROW BEGIN
    DECLARE current_progress FLOAT;
    
    -- Hitung total sampah berdasarkan id_target yang sama
    SELECT SUM(total) INTO current_progress
    FROM sampah
    WHERE nik = NEW.nik
    AND id_kategori = NEW.id_kategori
    AND id_target = NEW.id_target;  -- Menambahkan kondisi id_target yang sesuai

    -- Update target_sampah dengan progress terbaru
    UPDATE target_sampah
    SET target_sementara = current_progress
    WHERE nik = NEW.nik 
    AND id_kategori = NEW.id_kategori
    AND id_target = NEW.id_target;  -- Update berdasarkan id_target yang sesuai
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `target_sampah`
--

CREATE TABLE `target_sampah` (
  `id_target` int(11) NOT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `target_total` float DEFAULT NULL,
  `target_sementara` float DEFAULT NULL,
  `tanggal_target` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `target_sampah`
--

INSERT INTO `target_sampah` (`id_target`, `nik`, `id_kategori`, `target_total`, `target_sementara`, `tanggal_target`) VALUES
(1, '1', 6, 20, 1.5, '2024-12-15 12:07:00'),
(2, '3', 5, 2, 1, '2024-12-21 12:35:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `target_sampah_view`
-- (See below for the actual view)
--
CREATE TABLE `target_sampah_view` (
`id_target` int(11)
,`nik` varchar(30)
,`id_kategori` int(11)
,`target_sementara` float
,`target_total` float
,`total_sampah_terkumpul` double
,`selisih_target` double
);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(100) NOT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `status_transaksi` enum('Ditagih','Lunas','Batal') DEFAULT NULL,
  `biaya_transaksi` int(11) DEFAULT NULL,
  `expiry_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `nik`, `status_transaksi`, `biaya_transaksi`, `expiry_time`) VALUES
('92', '2', 'Lunas', 378000, '2024-12-16 12:11:28'),
('ORDER-2-20241216060829', '2', 'Batal', 35000, '2024-12-17 06:08:35'),
('ORDER-2-20241216060854', '2', 'Lunas', 35000, '2024-12-17 06:09:07'),
('ORDER-2-20241216061401', '2', 'Lunas', 35000, '2024-12-17 06:14:21'),
('ORDER-2-20241216061519', '2', 'Lunas', 35000, '2024-12-17 06:15:30'),
('ORDER-3-20241216063159', '3', 'Lunas', 35000, '2024-12-17 06:35:22'),
('ORDER-4-20241216095442', '4', 'Batal', 199000, '2024-12-17 09:54:46'),
('ORDER-4-20241216101307', '4', 'Lunas', 35000, '2024-12-17 10:13:41');

-- --------------------------------------------------------

--
-- Structure for view `target_sampah_view`
--
DROP TABLE IF EXISTS `target_sampah_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `target_sampah_view`  AS SELECT `ts`.`id_target` AS `id_target`, `ts`.`nik` AS `nik`, `ts`.`id_kategori` AS `id_kategori`, `ts`.`target_sementara` AS `target_sementara`, `ts`.`target_total` AS `target_total`, coalesce(sum(`s`.`total`),0) AS `total_sampah_terkumpul`, `ts`.`target_sementara`- coalesce(sum(`s`.`total`),0) AS `selisih_target` FROM (`target_sampah` `ts` left join `sampah` `s` on(`ts`.`nik` = `s`.`nik` and `ts`.`id_kategori` = `s`.`id_kategori` and `ts`.`id_target` = `s`.`id_target`)) GROUP BY `ts`.`id_target`, `ts`.`nik`, `ts`.`id_kategori`, `ts`.`target_sementara`, `ts`.`target_total` ;

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
  ADD KEY `id_jenis` (`id_jenis`);

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
  ADD KEY `nik` (`nik`),
  ADD KEY `id_sampah` (`id_sampah`);

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
  ADD KEY `nik` (`nik`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `target_sampah`
--
ALTER TABLE `target_sampah`
  ADD PRIMARY KEY (`id_target`),
  ADD KEY `nik` (`nik`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `nik` (`nik`);

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
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengelolaan_sampah`
--
ALTER TABLE `pengelolaan_sampah`
  MODIFY `id_pengelolaan_sampah` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sampah`
--
ALTER TABLE `sampah`
  MODIFY `id_sampah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `target_sampah`
--
ALTER TABLE `target_sampah`
  MODIFY `id_target` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `pengelolaan_sampah_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `pengguna` (`nik`),
  ADD CONSTRAINT `pengelolaan_sampah_ibfk_2` FOREIGN KEY (`id_sampah`) REFERENCES `sampah` (`id_sampah`);

--
-- Constraints for table `sampah`
--
ALTER TABLE `sampah`
  ADD CONSTRAINT `sampah_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `pengguna` (`nik`),
  ADD CONSTRAINT `sampah_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `target_sampah`
--
ALTER TABLE `target_sampah`
  ADD CONSTRAINT `target_sampah_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `pengguna` (`nik`),
  ADD CONSTRAINT `target_sampah_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `pengguna` (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
