-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 11:53 AM
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
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `o_id` int(11) NOT NULL COMMENT 'کد ردیف',
  `o_code` varchar(15) NOT NULL COMMENT 'کد تخفیف',
  `o_type` varchar(5) NOT NULL COMMENT 'نوع کد',
  `o_per` int(11) NOT NULL COMMENT 'میزان',
  `o_details` text NOT NULL COMMENT 'توضیحات'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`o_id`, `o_code`, `o_type`, `o_per`, `o_details`) VALUES
(1, 'عید', 'درصد', 20, 'کادوی عید');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد ردیف', AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
