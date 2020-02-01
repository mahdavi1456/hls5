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
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `g_id` int(11) NOT NULL COMMENT 'کد ردیف',
  `u_id` int(11) DEFAULT NULL,
  `p_id` int(11) NOT NULL COMMENT 'کد شخص',
  `g_type` varchar(25) DEFAULT NULL COMMENT 'نوع ورود',
  `g_count` tinyint(5) NOT NULL DEFAULT 1 COMMENT 'تعداد',
  `g_in` time DEFAULT NULL COMMENT 'ساعت ورود',
  `g_out` time DEFAULT NULL COMMENT 'ساعت خروج',
  `g_date` date NOT NULL COMMENT 'تاریخ ورود',
  `g_total` smallint(6) DEFAULT 0 COMMENT 'جمع دقیقه عادی',
  `g_total_vip` smallint(6) DEFAULT 0 COMMENT 'جمع دقیقه ویژه',
  `g_extra` smallint(6) DEFAULT 0 COMMENT 'جمع دقیقه مازاد',
  `g_total_price` decimal(10,0) DEFAULT 0 COMMENT 'مبلغ عادی',
  `g_total_vip_price` decimal(10,0) DEFAULT 0 COMMENT 'مبلغ ویژه',
  `g_extra_price` decimal(10,0) DEFAULT 0 COMMENT 'مبلغ مازاد',
  `g_used_sharj` smallint(6) DEFAULT 0 COMMENT 'شارژ مصرف شده',
  `g_login_price` decimal(10,0) DEFAULT 0 COMMENT 'مدت مازاد',
  `g_total_shop` decimal(10,0) DEFAULT 0 COMMENT 'جمع فروشگاه',
  `g_offer_code` smallint(6) DEFAULT 0 COMMENT 'کد تخفیف',
  `g_offer_price` decimal(10,0) DEFAULT 0 COMMENT 'مبلغ تخفیف',
  `g_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'وضعیت حضور',
  `g_adjective` text DEFAULT NULL COMMENT 'امانتی ها'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `game`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`g_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد ردیف', AUTO_INCREMENT=146;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
