-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 12:09 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helisoft_auth`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL COMMENT 'کد',
  `a_id` int(11) NOT NULL COMMENT 'کد اکانت',
  `u_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام',
  `u_family` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام خانوادگی',
  `u_username` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام کاربری',
  `u_password` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'رمز',
  `u_level` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'سطح دسترسی',
  `u_mobile` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'موبایل',
  `u_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `a_id`, `u_name`, `u_family`, `u_username`, `u_password`, `u_level`, `u_mobile`, `u_code`) VALUES
(21, 14, 'علی', 'عبداللهی', '09136231715', '6767', 'مدیر', '09136231715', NULL),
(22, 15, 'عباس', 'جبلی', '09121593173', '5788', 'مدیر', '09121593173', NULL),
(24, 17, 'شهین', 'زینلی', '09132912744', '7488', 'مدیر', '09132912744', NULL),
(26, 19, 'ابراهیم', 'عبدالهی', '09137655576', '5111', 'مدیر', '09137655576', NULL),
(29, 22, 'صادق', 'مرادی', '09122753213', '30030', 'مدیر', '09122753213', NULL),
(30, 23, 'mahdiye', 'mohammadi', '09133906828', '7859', 'مدیر', '09133906828', NULL),
(33, 15, 'منشی', 'مجموعه', 'mon', '123456', 'مدیر', '', NULL),
(34, 25, 'فاطمه', 'کرمی', '09387617265', '4778', 'مدیر', '09387617265', NULL),
(35, 21, 'صادق', 'مرادی', '9122753213', '30030', 'مدیر', '', NULL),
(37, 27, 'S', '', '', '4574', 'مدیر', '', NULL),
(39, 29, 'حمیده', 'سلطانی', '09133933505', '3647', 'مدیر', '09133933505', NULL),
(40, 30, 'خانم', 'سمیرانی', '09127900806', '6164', 'مدیر', '09127900806', NULL),
(41, 31, 'خانم', 'سمیرانی', '09127900806', '3410', 'مدیر', '09127900806', NULL),
(46, 1, 'سید مرتضی', 'مهدوی', 'admin', 'admin', 'مدیر', '9112221212', '2525'),
(47, 1, 'رضا', 'عباس پور', 'reza', 'reza', 'مالی', '9120351868', '3535');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد', AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
