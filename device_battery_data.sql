-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2018 at 02:17 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_gonzo`
--

-- --------------------------------------------------------

--
-- Table structure for table `device_battery_data`
--

CREATE TABLE `device_battery_data` (
  `record_id` int(10) NOT NULL,
  `device_id` varchar(32) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `battery_level` int(3) NOT NULL,
  `charging_state` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device_battery_data`
--

INSERT INTO `device_battery_data` (`record_id`, `device_id`, `date`, `battery_level`, `charging_state`) VALUES
(1, 'lapTest', '2018-02-04 11:24:12', 89, 0),
(2, 'lapTest', '2018-02-04 11:24:22', 64, 0),
(3, 'lapTest', '2018-02-05 11:24:32', 81, 0),
(4, 'lapTest', '2018-02-05 15:15:28', 92, 1),
(5, 'lapTest', '2018-02-06 15:15:30', 29, 1),
(6, 'lapTest', '2018-02-06 15:15:32', 39, 1),
(7, 'lapTest', '2018-02-07 15:15:34', 64, 1),
(8, 'lapTest', '2018-02-07 15:15:36', 92, 1),
(9, 'lapTest', '2018-02-08 15:15:38', 89, 1),
(10, 'lapTest', '2018-02-08 15:15:40', 37, 1),
(11, 'lapTest', '2018-02-09 15:15:42', 92, 1),
(12, 'lapTest', '2018-02-09 15:19:06', 93, 1),
(13, 'lapTest', '2018-02-10 15:19:08', 68, 1),
(14, 'lapTest', '2018-02-10 15:19:10', 78, 1),
(15, 'lapTest', '2018-02-11 15:19:12', 47, 1),
(16, 'lapTest', '2018-02-11 15:19:14', 85, 1),
(17, 'lapTest', '2018-02-12 15:19:16', 87, 1),
(18, 'lapTest', '2018-02-12 15:19:54', 62, 1),
(19, 'lapTest', '2018-02-13 11:36:06', 76, 0),
(20, 'lapTest', '2018-02-13 11:48:56', 84, 0),
(21, 'lapTest', '2018-02-14 13:32:54', 98, 0),
(22, 'lapTest', '2018-02-14 13:32:54', 28, 0),
(23, 'lapTest', '2018-02-15 15:33:42', 22, 0),
(24, 'lapTest', '2018-02-15 15:33:44', 58, 0),
(25, 'lapTest', '2018-02-16 15:33:46', 29, 0),
(26, 'lapTest', '2018-02-16 15:33:48', 47, 0),
(27, 'lapTest', '2018-02-17 15:33:50', 39, 0),
(28, 'lapTest', '2018-02-17 15:33:52', 88, 0),
(29, 'lapTest', '2018-02-18 15:33:54', 11, 0),
(30, 'lapTest', '2018-02-18 15:33:56', 28, 0),
(31, 'lapTest', '2018-02-19 15:33:58', 97, 0),
(32, 'lapTest', '2018-02-19 15:34:00', 78, 0),
(33, 'lapTest', '2018-02-20 15:34:02', 84, 0),
(34, 'lapTest', '2018-02-20 15:34:04', 74, 0),
(35, 'lapTest', '2018-02-21 15:34:06', 76, 0),
(36, 'lapTest', '2018-02-21 15:34:08', 54, 0),
(37, 'lapTest', '2018-02-22 15:34:10', 47, 0),
(38, 'lapTest', '2018-02-22 12:44:12', 97, 0),
(39, 'lapTest', '2018-02-23 12:44:12', 26, 1),
(40, 'lapTest', '2018-02-23 12:44:12', 41, 0),
(41, 'lapTest', '2018-02-24 12:44:12', 87, 1),
(42, 'lapTest', '2018-02-24 12:44:12', 46, 1),
(43, 'lapTest', '2018-02-25 12:44:12', 8, 1),
(44, 'lapTest', '2018-02-25 12:44:12', 47, 0),
(45, 'lapTest', '2018-02-26 12:44:12', 97, 1),
(46, 'lapTest', '2018-02-26 12:44:12', 28, 1),
(47, 'lapTest', '2018-02-27 12:44:12', 16, 1),
(48, 'lapTest', '2018-02-27 12:44:12', 24, 0),
(49, 'lapTest', '2018-02-28 12:44:12', 73, 1),
(50, 'lapTest', '2018-02-28 12:44:12', 19, 0),
(51, 'lapTest', '2018-03-01 12:44:12', 27, 1),
(52, 'lapTest', '2018-03-01 12:44:12', 47, 1),
(53, 'lapTest', '2018-03-02 12:44:12', 88, 1),
(54, 'lapTest', '2018-03-02 12:44:12', 93, 1),
(55, 'lapTest', '2018-03-03 12:44:12', 15, 1),
(56, 'lapTest', '2018-03-03 12:44:12', 91, 1),
(57, 'lapTest', '2018-03-04 12:44:12', 18, 0),
(58, 'lapTest', '2018-03-04 00:54:52', 78, 0),
(59, 'lapTest', '2018-03-05 00:54:52', 14, 1),
(60, 'lapTest', '2018-03-05 00:54:52', 11, 1),
(61, 'lapTest', '2018-03-06 00:54:52', 18, 0),
(62, 'lapTest', '2018-03-06 00:54:53', 78, 1),
(63, 'lapTest', '2018-03-07 00:54:53', 10, 0),
(64, 'lapTest', '2018-03-07 00:54:53', 77, 1),
(65, 'lapTest', '2018-03-08 00:54:53', 64, 0),
(66, 'lapTest', '2018-03-08 00:54:53', 53, 0),
(67, 'lapTest', '2018-03-09 00:54:53', 0, 1),
(68, 'lapTest', '2018-03-09 00:54:53', 4, 1),
(69, 'lapTest', '2018-03-10 00:54:53', 90, 0),
(70, 'lapTest', '2018-03-10 00:54:53', 77, 1),
(71, 'lapTest', '2018-03-11 00:54:53', 57, 0),
(72, 'lapTest', '2018-03-11 00:54:53', 69, 1),
(73, 'lapTest', '2018-03-12 00:54:53', 72, 1),
(74, 'lapTest', '2018-03-12 00:54:53', 25, 0),
(75, 'lapTest', '2018-03-13 00:54:53', 57, 1),
(76, 'lapTest', '2018-03-13 00:54:53', 44, 1),
(77, 'lapTest', '2018-03-14 00:54:53', 85, 1),
(78, 'lapTest', '2018-03-14 00:54:53', 73, 0),
(79, 'lapTest', '2018-03-15 00:54:53', 76, 0),
(80, 'lapTest', '2018-03-15 00:54:53', 7, 0),
(81, 'lapTest', '2018-03-16 00:54:53', 3, 0),
(82, 'lapTest', '2018-03-16 00:54:53', 94, 1),
(83, 'lapTest', '2018-03-17 00:54:53', 87, 0),
(84, 'lapTest', '2018-03-17 00:54:53', 32, 1),
(85, 'lapTest', '2018-03-18 00:54:53', 1, 1),
(86, 'lapTest', '2018-03-18 00:54:53', 65, 0),
(87, 'lapTest', '2018-03-19 00:54:53', 66, 0),
(88, 'lapTest', '2018-03-19 00:54:54', 93, 1),
(89, 'lapTest', '2018-03-20 00:54:54', 55, 1),
(90, 'lapTest', '2018-03-20 00:54:54', 60, 0),
(91, 'lapTest', '2018-03-21 00:54:54', 89, 0),
(92, 'lapTest', '2018-03-21 00:54:54', 65, 0),
(93, 'lapTest', '2018-03-22 00:54:54', 39, 1),
(94, 'lapTest', '2018-03-22 00:54:54', 55, 1),
(95, 'lapTest', '2018-03-23 00:54:54', 29, 0),
(96, 'lapTest', '2018-03-23 00:54:54', 25, 0),
(97, 'lapTest', '2018-03-24 00:54:54', 29, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device_battery_data`
--
ALTER TABLE `device_battery_data`
  ADD PRIMARY KEY (`record_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `device_battery_data`
--
ALTER TABLE `device_battery_data`
  MODIFY `record_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
