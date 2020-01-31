-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2020 at 10:47 PM
-- Server version: 10.0.38-MariaDB
-- PHP Version: 7.3.6

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
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `a_id` int(11) NOT NULL,
  `a_name` varchar(50) NOT NULL,
  `a_family` varchar(50) NOT NULL,
  `a_center` varchar(50) NOT NULL,
  `a_phone` varchar(11) NOT NULL,
  `a_mobile` varchar(11) NOT NULL,
  `a_city` varchar(20) NOT NULL,
  `a_address` text NOT NULL,
  `a_date` date NOT NULL,
  `a_days` int(11) NOT NULL,
  `a_db_name` varchar(50) DEFAULT NULL,
  `a_db_user` varchar(50) DEFAULT NULL,
  `a_db_password` varchar(50) DEFAULT NULL,
  `a_username` varchar(255) DEFAULT NULL,
  `a_password` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`a_id`, `a_name`, `a_family`, `a_center`, `a_phone`, `a_mobile`, `a_city`, `a_address`, `a_date`, `a_days`, `a_db_name`, `a_db_user`, `a_db_password`, `a_username`, `a_password`) VALUES
(1, 'سید مرتضی', 'مهدوی', 'گراتک', '3434254141', '9138630341', 'رفسنجان', 'خواجو', '0000-00-00', 0, 'helisoft_gratech', 'helisoft_gratech_user', 'bt*zIc^CPkLP', 'admin', 'admin'),
(14, 'علی', 'عبداللهی', 'بردلند', '3434224171', '9136231715', 'رفسنجان', 'خیابان عدالت، نبش عدالت 11', '2019-09-17', 14, '', '', NULL, NULL, NULL),
(15, 'عباس', 'جبلی', 'ابرار', '', '9121593173', 'تهران', 'خیابان قزوین', '2019-09-19', 14, 'helisoft', 'root', NULL, NULL, NULL),
(18, 'شهین', 'زینلی', 'خانه بازی', '34259051', '9132912744', 'رفسجان', 'خ کارگر کوچه 41', '2019-09-21', 14, '', '', NULL, NULL, NULL),
(19, 'ابراهیم', 'عبدالهی', 'سرزمین بازی شادیانه', '034-3422684', '09137655576', 'رفسنجان', 'میدان استادشهریار روبروی حوزه', '2019-09-21', 14, '', '', NULL, NULL, NULL),
(39, 'آقای', 'محمودی', 'آبنبات چوبی', '', '09113271840', '', '', '1398-10-30', 14, 'helisoft_abnabatdb', 'helisoft_abnabatuser', ';)0k)pO]$_Ao', '09113271840', '123456'),
(21, 'امیر', 'اسفندیاری', 'فیلینو', '-', '09121953286', 'تهران', '', '2019-09-22', 14, 'helisoft_filinodb', 'helisoft_filinouser', '}6&[A&p9F-JH', '09121953286', '4423366'),
(22, 'صادق', 'مرادی', 'بالونیا', '28162000', '9122753213', 'تهران', 'نونبیاد', '2019-09-22', 14, 'helisoft_balloniadb', 'helisoft_balloniauser', '}eKvE(4JaL9j', '09122753213', '30030'),
(23, 'خانم', 'نوری', 'وروجک ها', '', '09113290265', 'مازندران', 'ساری', '2020-01-16', 14, 'helisoft_vorojakhadb', 'helisoft_vorojakhauser', '$y_D@1FZGQaC', '09113290265', '0265'),
(25, 'فاطمه', 'کرمی', 'تارا', '', '9387617265', 'رفسنجان', 'رفسنجان', '2019-10-06', 14, '', '', NULL, NULL, NULL),
(28, 'خانم', 'حاتمی', 'صمیمانه', '', '09109175693', '', '', '2019-10-08', 14, 'helisoft_samimanehdb', 'helisoft_samimanehuser', 'BIUp0Fhe6M+#', '09109175693', '9376'),
(29, 'حمیده', 'سلطانی', 'خونه مادربزرگه', '', '9133933505', 'رفسنجان', 'شهید فکوری', '2019-10-11', 14, '', '', NULL, NULL, NULL),
(30, 'خانم', 'سمیرانی', 'خانه کودک آروشا', '', '9127900806', 'تهران', 'تهران', '2019-10-13', 14, '', '', NULL, NULL, NULL),
(36, 'خانم', 'نظام طلب', 'آراد', '', '09116542697', 'تهران', '', '0000-00-00', 14, 'helisoft_araddb', 'helisoft_araduser', 'ftJukA@pPcH[', '09116542697', '123456'),
(33, 'خانم', 'دهش', 'خانه کودک خاله هیلی', '', '9362977211', 'تهران', 'تهران', '2019-10-13', 14, '', '', NULL, NULL, NULL),
(34, 'کاظم', 'صانعی', 'لب خندون', '', '09133930151', 'کرمان', 'رفسنجان', '2019-10-30', 14, 'helisoft_labekhandondb', 'helisoft_labekhandonuser', '4BkIfo0k##0(', '09133930151', '0151'),
(35, 'آقای', 'علینقی', 'چیکولند', '', '', '', '', '0000-00-00', 0, 'helisoft_chikodb', 'helisoft_chikouser', '{;S&nqN.S;{J', '09128650407', '8142'),
(40, '', 'توکلی', 'خانه بازی ریزغولک', '02634466167', '09364399220', 'کرج', '', '2020-02-08', 14, 'helisoft_qoolak', 'helisoft_user_qoolak', '~l+1*gC}t+,o', 'qoolak', '09364399220');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`a_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
