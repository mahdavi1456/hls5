-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 12:12 PM
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
-- Database: `helisoft_gratech`
--

-- --------------------------------------------------------

--
-- Table structure for table `game_meta`
--

CREATE TABLE `game_meta` (
  `gm_id` int(11) NOT NULL COMMENT 'کد متای بازی',
  `g_id` int(11) NOT NULL COMMENT 'کد بازی',
  `gm_key` varchar(50) NOT NULL COMMENT 'کلید متای بازی',
  `gm_value` varchar(50) NOT NULL COMMENT 'مقدار متای بازی',
  `gm_date` date NOT NULL COMMENT 'تاریخ ثبت',
  `gm_time` time NOT NULL COMMENT 'زمان ثبت',
  `gm_time_end` time DEFAULT NULL COMMENT 'زمان اتمام'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='اطلاعات اضافی بازی';

--
-- Dumping data for table `game_meta`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game_meta`
--
ALTER TABLE `game_meta`
  ADD PRIMARY KEY (`gm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game_meta`
--
ALTER TABLE `game_meta`
  MODIFY `gm_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد متای بازی', AUTO_INCREMENT=296;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
