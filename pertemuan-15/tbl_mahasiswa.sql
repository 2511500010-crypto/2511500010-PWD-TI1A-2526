-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 07, 2026 at 08:03 AM
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
(251150012, '2511500010', 'Muhammad Miftah Alqois', 'Pkp', '2007-05-23', 'Mancing', 'Kepoooo', 'Mahasiswa', 'Ayah dan Ibu', 'KAkak', 'Adik', '2026-01-07 07:56:29', '2026-01-07 07:56:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`cmid`),
  ADD UNIQUE KEY `cnim` (`cnim`),
  ADD KEY `idx_nim` (`cnim`),
  ADD KEY `idx_nama` (`cnama`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  MODIFY `cmid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251150013;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
