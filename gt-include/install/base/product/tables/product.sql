-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 11:49 AM
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
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pr_id` int(11) NOT NULL COMMENT 'کد ردیف',
  `pr_name` varchar(20) NOT NULL COMMENT 'نام کالا',
  `pr_stock` int(11) NOT NULL COMMENT 'موجودی',
  `pr_buy` int(11) NOT NULL COMMENT 'قیمت خرید',
  `pr_sale` int(11) NOT NULL COMMENT 'قیمت فروش'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pr_id`, `pr_name`, `pr_stock`, `pr_buy`, `pr_sale`) VALUES
(1, 'آب معدنی', 100, 1400, 1500),
(2, 'موکا', 1000, 9000, 9000),
(3, 'هات چاکلت', 999, 7000, 7000),
(4, 'چای', 0, 3000, 3000),
(5, 'دمنوش', 1000, 6000, 6000),
(6, 'شیرموز شکلات', 995, 11000, 11000),
(7, 'موهیتو', 993, 10000, 10000),
(8, 'لیموناد', 999, 9000, 9000),
(9, 'اسموتی هندوانه', 998, 11000, 11000),
(10, 'اسموتی موز', 998, 13000, 13000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد ردیف', AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
