-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 11:47 AM
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
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `p_id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `p_name` varchar(15) DEFAULT NULL COMMENT 'نام',
  `p_family` varchar(15) DEFAULT NULL COMMENT 'نام خانوادگی',
  `p_fname` varchar(15) DEFAULT NULL COMMENT 'نام پدر',
  `p_birth` date DEFAULT NULL COMMENT 'تاریخ تولد',
  `p_code` varchar(15) DEFAULT NULL COMMENT 'کد اشتراک',
  `p_gender` tinyint(1) NOT NULL COMMENT 'جنسیت',
  `p_mobile` varchar(15) DEFAULT NULL COMMENT 'موبایل',
  `p_sharj` smallint(6) DEFAULT 0 COMMENT 'شارژ به دقیقه',
  `p_expire` date DEFAULT NULL COMMENT 'تاریخ انقضا',
  `p_pack` int(3) DEFAULT 0 COMMENT 'بسته',
  `p_regdate` date DEFAULT NULL COMMENT 'تاریخ عضویت',
  `p_commitment` date DEFAULT NULL COMMENT 'تعهدنامه'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `person`
--

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `person`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
