-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2024 at 08:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_satta`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL COMMENT 'Admin ID',
  `admin_type` varchar(1) NOT NULL DEFAULT 'D' COMMENT 'S = Super Admin, A = Admin, J = Junior Admin, D = Demo Admin',
  `admin_name` varchar(50) NOT NULL COMMENT 'Admin Name',
  `gender` varchar(1) NOT NULL DEFAULT 'M' COMMENT 'Gender M, F,O',
  `admin_mobile` varchar(20) NOT NULL COMMENT 'admin mobile number',
  `admin_email` varchar(100) NOT NULL COMMENT 'admin email id',
  `password` varchar(60) NOT NULL COMMENT 'admin login password',
  `profile_pic` varchar(200) DEFAULT NULL COMMENT 'Admin Profile Pic',
  `last_login` datetime DEFAULT current_timestamp() COMMENT 'Admin Last Login Date and Time',
  `login_ip` varchar(50) DEFAULT NULL COMMENT 'Admin Login IP',
  `created_at` datetime DEFAULT current_timestamp() COMMENT 'Admin Register At',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Admin Profile updated_at',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Admin Status'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Admin Login Details';

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `admin_type`, `admin_name`, `gender`, `admin_mobile`, `admin_email`, `password`, `profile_pic`, `last_login`, `login_ip`, `created_at`, `updated_at`, `status`) VALUES
(1, 'S', 'Pankaj Tanwar', 'M', '7503794647', 'pankajku94@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, '2024-01-16 07:48:32', '127.0.0.1', '2023-09-17 14:18:57', '2024-01-16 06:48:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_history`
--

CREATE TABLE `tbl_login_history` (
  `id` bigint(20) NOT NULL COMMENT 'Incremented ID',
  `user_type` varchar(10) NOT NULL DEFAULT 'user' COMMENT 'User Type user, seller, admin',
  `user_id` varchar(50) NOT NULL COMMENT 'User ID',
  `ip` varchar(100) DEFAULT NULL COMMENT 'Login IP Address',
  `device` varchar(100) DEFAULT NULL COMMENT 'Login Device',
  `login_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Login Datetime'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Login history';

--
-- Dumping data for table `tbl_login_history`
--

INSERT INTO `tbl_login_history` (`id`, `user_type`, `user_id`, `ip`, `device`, `login_at`) VALUES
(1, 'admin', '1', '127.0.0.1', 'Chrome 120.0.0.0, Windows 10', '2024-01-16 07:20:06'),
(2, 'admin', '1', '127.0.0.1', 'Chrome 120.0.0.0, Windows 10', '2024-01-16 07:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_satta_records`
--

CREATE TABLE `tbl_satta_records` (
  `id` int(11) NOT NULL COMMENT 'Incremented unique id',
  `record_date` date NOT NULL COMMENT 'Record Date',
  `time_slot` time NOT NULL COMMENT 'Time Slots',
  `satta_number` int(11) NOT NULL COMMENT 'Satta Number',
  `created_at` datetime DEFAULT current_timestamp() COMMENT 'Created Date and Time',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Updated Date and Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Satta Records Table';

--
-- Dumping data for table `tbl_satta_records`
--

INSERT INTO `tbl_satta_records` (`id`, `record_date`, `time_slot`, `satta_number`, `created_at`, `updated_at`) VALUES
(2, '2024-01-16', '09:20:00', 13, '2024-01-16 10:50:56', '2024-01-16 05:20:56'),
(3, '2024-01-16', '09:40:00', 23, '2024-01-16 10:51:19', '2024-01-16 05:21:19'),
(4, '2024-01-16', '10:00:00', 53, '2024-01-16 10:51:56', '2024-01-16 05:21:56'),
(5, '2024-01-16', '10:20:00', 63, '2024-01-16 10:51:57', '2024-01-16 05:21:57'),
(6, '2024-01-16', '10:40:00', 93, '2024-01-16 10:51:57', '2024-01-16 05:21:57'),
(7, '2024-01-16', '11:00:00', 23, '2024-01-16 10:51:57', '2024-01-16 05:21:57'),
(8, '2024-01-16', '22:00:00', 10, '2024-01-16 12:15:30', '2024-01-16 06:45:30'),
(9, '2024-01-16', '13:40:00', 100, '2024-01-16 12:19:21', '2024-01-16 06:49:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_mobile` (`admin_mobile`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `tbl_login_history`
--
ALTER TABLE `tbl_login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_satta_records`
--
ALTER TABLE `tbl_satta_records`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Admin ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_login_history`
--
ALTER TABLE `tbl_login_history`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Incremented ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_satta_records`
--
ALTER TABLE `tbl_satta_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Incremented unique id', AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
