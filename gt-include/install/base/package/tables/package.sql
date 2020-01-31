-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 11:51 AM
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
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `pk_id` int(11) NOT NULL COMMENT 'کد ردیف',
  `pk_name` varchar(20) NOT NULL COMMENT 'نام بسته',
  `pk_price` int(11) NOT NULL COMMENT 'مبلغ بسته',
  `pk_time` int(11) NOT NULL COMMENT 'زمان به دقیقه',
  `pk_expire` int(11) NOT NULL COMMENT 'اعتبار به روز'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`pk_id`, `pk_name`, `pk_price`, `pk_time`, `pk_expire`) VALUES
(1, 'بسته طلایی', 250000, 3000, 30),
(2, 'بسته نقره ای', 180000, 1800, 30),
(3, 'بسته برنزی', 140000, 1200, 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`pk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `pk_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد ردیف', AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
