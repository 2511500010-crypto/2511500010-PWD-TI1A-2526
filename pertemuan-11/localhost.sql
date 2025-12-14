-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2025 at 08:32 AM
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
CREATE DATABASE IF NOT EXISTS `db_pwd2025` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `db_pwd2025`;

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
(1, 'MUHAMMAD MIFTAH ALQOIS', 'ANAKRAJA@Gmail.com', 'saya mempelajari banyak hal dari Bapak Dosen Yohanes Setiawan Japriadi', '2025-12-14 14:40:33'),
(2, 'Grezelco Govin', 'GogovinAja@Gmail.com', 'Saya suka memancing ikan di laut lepas', '2025-12-14 14:40:33'),
(3, 'Wulandaribelinyu', 'Tniabang@gmail.com', 'Nurfadilahcihuy', '2025-12-14 14:40:33'),
(4, '11111111', 'mahesarehan66@gmail.com', 'aaaaaaaaaaaaaaaa', '2025-12-14 14:40:33'),
(5, '11111111', 'mahesarehan66@gmail.com', 'aaaaaaaaaaaa', '2025-12-14 14:40:33'),
(6, 'Hengky', 'mahesarehan66@gmail.com', 'SAya suka Beelajar gitar', '2025-12-14 14:40:33'),
(7, 'aaaa', '2222@gmail.com', 'aaaaaaaaaaaaaa', '2025-12-14 15:03:35'),
(8, 'aaaa', '2222@gmail.com', 'qqqqqqqqqqqqqqqqqqqq', '2025-12-14 15:05:51'),
(9, 'aaaa', '2222@gmail.com', 'aaaaaaaaaaaaaaa', '2025-12-14 15:19:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  ADD PRIMARY KEY (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
