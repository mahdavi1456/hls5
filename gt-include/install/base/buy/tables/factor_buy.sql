-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2020 at 01:19 PM
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
-- Table structure for table `factor_buy`
--

CREATE TABLE `factor_buy` (
  `f_id` int(11) NOT NULL COMMENT 'کد فاکتور',
  `p_id` int(11) NOT NULL COMMENT 'کد تامین کننده',
  `f_date` varchar(16) NOT NULL COMMENT 'تاریخ ثبت فاکتور',
  `u_id` int(11) NOT NULL COMMENT 'کد کاربر',
  `f_VAT_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'وضعیت گواهی ارزش افزوده',
  `f_payment` varchar(50) DEFAULT NULL COMMENT 'نحوه پرداخت'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `factor_buy`
--
ALTER TABLE `factor_buy`
  ADD PRIMARY KEY (`f_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `factor_buy`
--
ALTER TABLE `factor_buy`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد فاکتور', AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
