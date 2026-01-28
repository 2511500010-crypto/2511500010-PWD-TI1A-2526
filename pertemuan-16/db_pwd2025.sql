-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2026 at 05:26 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pwd2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dosen`
--

CREATE TABLE `tbl_dosen` (
  `id` int NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text,
  `tanggal_lahir` varchar(20) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `prodi` varchar(50) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `pasangan` varchar(100) DEFAULT NULL,
  `anak` text,
  `bidang_ilmu` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_dosen`
--

INSERT INTO `tbl_dosen` (`id`, `nim`, `nama`, `alamat`, `tanggal_lahir`, `jabatan`, `prodi`, `no_hp`, `pasangan`, `anak`, `bidang_ilmu`, `created_at`, `updated_at`) VALUES
(1, '2122700090', 'minggu', 'kkkkkkkkkkkkkkk', '1-agus-2026', 'naga langit', 'dak tau', '0812345431111', 'Kepoooo 123', 'kokokokokok', 'kaisar', '2026-01-28 03:44:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `cmid` int NOT NULL,
  `cnim` varchar(20) NOT NULL,
  `cnama` varchar(100) NOT NULL,
  `ctempat_lahir` varchar(50) NOT NULL,
  `ctanggal_lahir` date NOT NULL,
  `chobi` varchar(100) NOT NULL,
  `cpasangan` varchar(50) DEFAULT NULL,
  `cpekerjaan` varchar(50) DEFAULT NULL,
  `cnama_ortu` varchar(100) NOT NULL,
  `cnama_kakak` varchar(100) DEFAULT NULL,
  `cnama_adik` varchar(100) DEFAULT NULL,
  `dcreated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dupdated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`cmid`, `cnim`, `cnama`, `ctempat_lahir`, `ctanggal_lahir`, `chobi`, `cpasangan`, `cpekerjaan`, `cnama_ortu`, `cnama_kakak`, `cnama_adik`, `dcreated_at`, `dupdated_at`) VALUES
(251150012, '2511500010', 'Muhammad Miftah Alqois', 'Pkp', '2007-05-23', 'Mancing', 'Kepoooo 123', 'Mahasiswa', 'Ayah dan Ibu', 'KAkak', 'Adik', '2026-01-07 07:56:29', '2026-01-07 08:05:51'),
(251150013, '2511500018', 'Muhammad Miftah Alqois', 'Pkp', '2007-05-23', 'Mancing', 'Kepoooo', 'Mahasiswa', 'Ayah dan Ibu', 'KAkak', 'Adik', '2026-01-07 13:04:25', '2026-01-07 13:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tamu`
--

CREATE TABLE `tbl_tamu` (
  `cid` int NOT NULL,
  `cnama` varchar(100) DEFAULT NULL,
  `cemail` varchar(100) DEFAULT NULL,
  `cpesan` text,
  `dcreated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_tamu`
--

INSERT INTO `tbl_tamu` (`cid`, `cnama`, `cemail`, `cpesan`, `dcreated_at`) VALUES
(23, 'ffffffffffffffffffffffff', 'ffffffffffffffffffffffff@gmail.com', 'ssssssssssssssssssssssssssss', '2026-01-28 10:20:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`cmid`),
  ADD UNIQUE KEY `cnim` (`cnim`),
  ADD KEY `idx_nim` (`cnim`),
  ADD KEY `idx_nama` (`cnama`);

--
-- Indexes for table `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  ADD PRIMARY KEY (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_dosen`
--
ALTER TABLE `tbl_dosen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  MODIFY `cmid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251150014;

--
-- AUTO_INCREMENT for table `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
