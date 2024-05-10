-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 10, 2024 at 11:22 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `incident_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(259) DEFAULT NULL,
  `mobilenumber` bigint(11) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `mobilenumber`, `email`, `username`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'admin', 1234567890, 'test@gmail.com', 'admin', '0e7517141fb53f21ee439b355b5a1d0a', '2023-09-12 05:16:16', '18-10-2016 04:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) DEFAULT NULL,
  `categoryDescription` longtext,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`, `categoryDescription`, `creationDate`, `updationDate`) VALUES
(1, 'Individual', 'E-commerce', '2023-08-28 07:10:55', '2024-05-02 14:51:34'),
(2, 'Enterprise', 'dsdas', '2023-08-11 10:54:06', '2024-05-02 14:51:48'),
(3, 'Goverment', 'Consumer complain lodged', '2023-09-12 06:26:48', '2024-05-02 14:52:11');

-- --------------------------------------------------------

--
-- Table structure for table `incidentremark`
--

DROP TABLE IF EXISTS `incidentremark`;
CREATE TABLE IF NOT EXISTS `incidentremark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `complaintNumber` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remark` mediumtext,
  `remarkDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incidentremark`
--

INSERT INTO `incidentremark` (`id`, `complaintNumber`, `status`, `remark`, `remarkDate`) VALUES
(1, 3, 'in process', 'your ticket forward to associated team', '2023-09-15 13:05:38'),
(2, 3, 'closed', 'Ticket close in favor of user', '2023-09-15 13:06:31'),
(3, 5, 'in process', 'We are reviewing the complaint', '2023-10-01 04:12:48'),
(4, 5, 'closed', 'Issue resolved', '2023-10-01 04:13:12'),
(5, 6, 'closed', 'closed', '2024-05-02 12:00:32'),
(6, 1, 'in process', 'Process', '2024-05-02 15:48:28'),
(7, 1, 'closed', 'closed', '2024-05-10 07:43:28'),
(8, 7, 'in process', 'In Progress', '2024-05-10 07:47:15'),
(9, 11, 'in process', 'In Progress', '2024-05-10 07:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `tblincidents`
--

DROP TABLE IF EXISTS `tblincidents`;
CREATE TABLE IF NOT EXISTS `tblincidents` (
  `incident_id` varchar(50) NOT NULL,
  `complaintNumber` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `category` varchar(11) DEFAULT NULL,
  `complaintPriority` varchar(255) DEFAULT NULL,
  `reporter_name` varchar(50) NOT NULL,
  `complaintDetails` mediumtext,
  `regDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT NULL,
  `lastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`complaintNumber`),
  UNIQUE KEY `incident_id` (`incident_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblincidents`
--

INSERT INTO `tblincidents` (`incident_id`, `complaintNumber`, `userId`, `category`, `complaintPriority`, `reporter_name`, `complaintDetails`, `regDate`, `status`, `lastUpdationDate`) VALUES
('RMG940322024', 1, 3, '1', 'High', 'Emily Johnson', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ', '2023-09-15 12:33:14', 'closed', '2024-05-10 11:20:06'),
('RMG840322024', 2, 4, '2', 'Low', 'David Miller', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \n', '2023-09-15 12:41:41', NULL, '2024-05-10 11:20:42'),
('RMG740322024', 3, 1, '2', 'Low', 'Anuj Kumar', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. \n', '2023-09-15 12:45:26', 'closed', '2024-05-02 17:02:21'),
('RMG640322024', 4, 5, '3', 'Low', 'John Doe', 'Testing', '2023-09-26 01:28:17', NULL, '2024-05-02 17:02:35'),
('RMG340322024', 6, 7, '1', 'Medium', 'shweta', 'Testing', '2024-05-02 11:34:43', 'closed', '2024-05-02 17:03:08'),
('RMG848942024', 7, 7, '1', 'Medium', 'shweta', 'sa', '2024-05-02 16:32:57', 'in process', '2024-05-10 07:47:15'),
('RMG131152024', 8, 7, '3', 'Low', 'shweta', 'gugfg', '2024-05-02 16:43:26', NULL, NULL),
('RMG607292024', 9, 7, '3', ' High', 'shweta', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2024-05-02 16:43:45', NULL, NULL),
('RMG879392024', 10, 7, '2', 'Medium', 'shweta', 'testing', '2024-05-02 16:51:16', NULL, NULL),
('RMG033712024', 11, 9, '1', 'Low', 'Testing', 'Testing', '2024-05-10 07:54:39', 'in process', '2024-05-10 07:55:37'),
('RMG957102024', 12, 19, '2', 'Low', 'shweta', 'Testing', '2024-05-10 08:26:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(255) DEFAULT NULL,
  `userEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `contactNo` bigint(11) DEFAULT NULL,
  `address` tinytext,
  `State` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pincode` int(6) DEFAULT NULL,
  `userImage` varchar(255) DEFAULT NULL,
  `regDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationDate` timestamp NULL DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `userEmail`, `password`, `contactNo`, `address`, `State`, `country`, `pincode`, `userImage`, `regDate`, `updationDate`, `status`) VALUES
(2, 'test', 'test@123', '202cb962ac59075b964b07152d234b70', 1285000000, NULL, NULL, NULL, NULL, NULL, '2023-09-13 05:05:11', NULL, 1),
(3, 'Emily Johnson', 'ej@gmail.com', '202cb962ac59075b964b07152d234b70', 1234567899, NULL, NULL, NULL, NULL, NULL, '2023-09-15 06:33:30', NULL, 1),
(4, 'David Miller', 'dm@gmail.com', '202cb962ac59075b964b07152d234b70', 8989898989, 'J-789, Near Metro Station', 'Delhi', 'India', 110110, 'e9a19a656ca1e4758c2025fe1adaeb64.jpg', '2023-09-15 06:43:53', NULL, 1),
(5, 'John Doe', 'jhndoe12@test.com', 'f925916e2754e5e03f75dd58a5733251', 4141414141, NULL, NULL, NULL, NULL, NULL, '2023-09-26 01:06:49', NULL, 1),
(9, 'Test', 'test@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 1234567890, NULL, NULL, NULL, NULL, NULL, '2024-05-10 07:53:23', NULL, 1),
(11, 'abc', 'abc@gmail.com', '900150983cd24fb0d6963f7d28e17f72', 1234567890, NULL, NULL, NULL, NULL, NULL, '2024-05-10 08:16:29', NULL, 1),
(19, 'shweta', 'shweta@gmail.com', 'd4e01d51b4ad551f784703652f4cbe48', 1234567890, 'gurugram', 'Basai', 'India', 122006, NULL, '2024-05-10 08:25:39', NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
