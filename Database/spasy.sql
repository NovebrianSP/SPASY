-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 03:14 PM
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
  `timestamps` datetime DEFAULT NULL,
  `id_target` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `nik`, `aktivitas`, `timestamps`, `id_target`) VALUES
(19, '2', 'Menambahkan 10.5 kg sampah ke kategori Besi', '2024-12-08 15:13:04', 11),
(20, '2', 'Menambahkan 13 kg sampah ke kategori Minyak', '2024-12-08 15:13:27', NULL),
(21, '2', 'Menambahkan 20 kg sampah ke kategori Kayu', '2024-12-08 15:14:01', NULL);

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
  `tanggal_masuk` datetime DEFAULT NULL,
  `id_target` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sampah`
--

INSERT INTO `sampah` (`id_sampah`, `nik`, `id_kategori`, `total`, `tanggal_masuk`, `id_target`) VALUES
(43, '2', 6, 10.5, '2024-12-08 21:12:00', 11),
(44, '2', 1, 13, '2024-12-08 21:13:00', NULL),
(45, '2', 3, 20, '2024-12-08 21:13:00', NULL);

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
  `target_sementara` float NOT NULL,
  `tanggal_target` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `target_sampah`
--

INSERT INTO `target_sampah` (`id_target`, `nik`, `id_kategori`, `target_total`, `target_sementara`, `tanggal_target`) VALUES
(11, '2', 6, 100, 10.5, '2024-12-08 21:12:00');

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
  ADD KEY `Foreign Key` (`nik`),
  ADD KEY `id_target` (`id_target`);

--
-- Indexes for table `target_sampah`
--
ALTER TABLE `target_sampah`
  ADD PRIMARY KEY (`id_target`),
  ADD KEY `nik` (`nik`),
  ADD KEY `id_kategori` (`id_kategori`);

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
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pengelolaan_sampah`
--
ALTER TABLE `pengelolaan_sampah`
  MODIFY `id_pengelolaan_sampah` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sampah`
--
ALTER TABLE `sampah`
  MODIFY `id_sampah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `target_sampah`
--
ALTER TABLE `target_sampah`
  MODIFY `id_target` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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

--
-- Constraints for table `target_sampah`
--
ALTER TABLE `target_sampah`
  ADD CONSTRAINT `target_sampah_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `pengguna` (`nik`),
  ADD CONSTRAINT `target_sampah_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
