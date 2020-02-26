-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2020 at 01:20 PM
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
-- Table structure for table `factor_buy_body`
--

CREATE TABLE `factor_buy_body` (
  `fb_id` int(11) NOT NULL COMMENT 'کد ردیف فاکتور خرید',
  `f_id` int(11) NOT NULL COMMENT 'کد فاکتور خرید',
  `pr_id` int(11) NOT NULL COMMENT 'کد محصول',
  `ba_id` int(11) NOT NULL COMMENT 'برداشت از',
  `fb_quantity` float NOT NULL COMMENT 'مقدار',
  `fb_price` double NOT NULL COMMENT 'مبلغ',
  `total_price` double NOT NULL COMMENT 'قیمت کل',
  `fb_discount` double NOT NULL DEFAULT 0 COMMENT 'مبلغ تخفیف',
  `fb_details` text DEFAULT NULL COMMENT 'توضیحات'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ردیف های فاکتور خرید';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `factor_buy_body`
--
ALTER TABLE `factor_buy_body`
  ADD PRIMARY KEY (`fb_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `factor_buy_body`
--
ALTER TABLE `factor_buy_body`
  MODIFY `fb_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد ردیف فاکتور خرید', AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
