-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2020 at 01:21 PM
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
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `ba_id` int(11) NOT NULL COMMENT 'کد ردیف',
  `ba_name` varchar(50) DEFAULT NULL COMMENT 'نام بانک',
  `ba_account_owner` varchar(50) NOT NULL COMMENT 'نام صاحب حساب',
  `ba_code` varchar(50) DEFAULT NULL COMMENT 'کد بانک',
  `ba_account_number` varchar(50) DEFAULT NULL COMMENT 'شماره حساب',
  `ba_branch_name` varchar(50) DEFAULT NULL COMMENT 'نام شعبه',
  `ba_branch_number` varchar(50) DEFAULT NULL COMMENT 'شماره شعبه',
  `ba_account_type` varchar(50) DEFAULT NULL COMMENT 'نوع حساب',
  `ba_shaba_number` varchar(50) DEFAULT NULL COMMENT 'شماره شبا',
  `ba_initial_balance` double NOT NULL DEFAULT 0 COMMENT 'موجودی اولیه'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`ba_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `ba_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد ردیف', AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
