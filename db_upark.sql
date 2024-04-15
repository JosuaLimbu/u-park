-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 06:07 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_upark`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `create_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`id`, `role`, `username`, `password`, `create_at`) VALUES
(2, 'Admin', 'admin', '121212', '17 March 2024'),
(3, 'Operator', 'operator', '121212', '21 March 2024'),
(4, 'Operator', 'operator2', '121212', '24 March 2024');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detectin`
--

CREATE TABLE `tbl_detectin` (
  `plate_number` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `last_checked_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detectout`
--

CREATE TABLE `tbl_detectout` (
  `plate_number` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `last_checked_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plateregist`
--

CREATE TABLE `tbl_plateregist` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `plate_number` varchar(50) NOT NULL,
  `last_checked_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_plateregist`
--

INSERT INTO `tbl_plateregist` (`id`, `name`, `plate_number`, `last_checked_time`) VALUES
(1, 'Josua Limbu', 'B1034RF', '2024-03-28 10:41:10'),
(2, 'Tombeng Marchel', 'B1234MMC', NULL),
(3, 'Vito Korengkeng', 'DP4589TN', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicleentry`
--

CREATE TABLE `tbl_vehicleentry` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `plate_number` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `entry_time` varchar(50) NOT NULL,
  `exit_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vehicleentry`
--

INSERT INTO `tbl_vehicleentry` (`id`, `name`, `plate_number`, `date`, `entry_time`, `exit_time`) VALUES
(1776, 'Josua Limbu', 'B1034RF', '31 March 2024', '03:48:26 PM', '03:50:26 PM'),
(1780, 'Tombeng Marchel', 'B1234MMC', '31 March 2024', '04:12:29 PM', '04:15:29 PM\r\n'),
(1782, 'Josua Limbu', 'B1034RF', '31 March 2024', '04:37:54 PM', '04:38:27 PM'),
(1783, 'Josua Limbu', 'B1034RF', '30 March 2024', '04:44:22 PM', '04:44:47 PM'),
(1802, 'Josua Limbu', 'B1034RF', '1 April 2024', '11:41:56 PM', '11:42:32 PM'),
(1803, 'Josua Limbu', 'B1034RF', '2 April 2024', '08:34:18 AM', '08:35:12 AM'),
(1804, 'Josua Limbu', 'B1034RF', '2 April 2024', '08:34:37 AM', '08:35:12 AM'),
(1805, 'Josua Limbu', 'B1034RF', '2 April 2024', '10:01:53 AM', '10:06:02 AM'),
(1806, 'Josua Limbu', 'B1034RF', '2 April 2024', '10:04:40 AM', '10:06:02 AM'),
(1807, 'Josua Limbu', 'B1034RF', '2 April 2024', '10:11:46 AM', '10:11:46 AM'),
(1808, 'Josua Limbu', 'B1034RF', '2 April 2024', '10:12:20 AM', '10:12:37 AM'),
(1809, 'Josua Limbu', 'B1034RF', '2 April 2024', '09:39:12 PM', '09:39:12 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_plateregist`
--
ALTER TABLE `tbl_plateregist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicleentry`
--
ALTER TABLE `tbl_vehicleentry`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_plateregist`
--
ALTER TABLE `tbl_plateregist`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_vehicleentry`
--
ALTER TABLE `tbl_vehicleentry`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
