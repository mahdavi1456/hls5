-- MySQL dump 10.15  Distrib 10.0.38-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: helisoft_vorojakhadb
-- ------------------------------------------------------
-- Server version	10.0.38-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `helisoft_vorojakhadb`
--


--
-- Table structure for table `adjective`
--

DROP TABLE IF EXISTS `adjective`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adjective` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(50) NOT NULL,
  PRIMARY KEY (`ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adjective`
--

LOCK TABLES `adjective` WRITE;
/*!40000 ALTER TABLE `adjective` DISABLE KEYS */;
/*!40000 ALTER TABLE `adjective` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_cage` varchar(25) NOT NULL,
  `b_name` varchar(255) NOT NULL,
  `b_author` varchar(255) NOT NULL,
  `b_publisher` varchar(25) NOT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=MyISAM AUTO_INCREMENT=265 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buy_package`
--

DROP TABLE IF EXISTS `buy_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buy_package` (
  `bp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد ردیف',
  `p_id` int(11) NOT NULL COMMENT 'کد شخص',
  `pk_id` int(11) NOT NULL COMMENT 'کد بسته',
  `bp_time` float NOT NULL COMMENT 'مدت زمان',
  `bp_expire` varchar(15) NOT NULL COMMENT 'تاریخ انقضا',
  `bp_type` varchar(15) NOT NULL,
  PRIMARY KEY (`bp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buy_package`
--

LOCK TABLES `buy_package` WRITE;
/*!40000 ALTER TABLE `buy_package` DISABLE KEYS */;
/*!40000 ALTER TABLE `buy_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(75) DEFAULT NULL,
  `c_capacity` int(5) DEFAULT NULL,
  `c_date` date DEFAULT NULL,
  `c_fee` varchar(20) DEFAULT NULL,
  `t_id` int(11) DEFAULT NULL,
  `c_details` text,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_cost`
--

DROP TABLE IF EXISTS `course_cost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_cost` (
  `cc_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `cc_price` decimal(10,0) NOT NULL,
  `cc_details` text CHARACTER SET utf8 NOT NULL,
  `cc_date` date NOT NULL,
  PRIMARY KEY (`cc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_cost`
--

LOCK TABLES `course_cost` WRITE;
/*!40000 ALTER TABLE `course_cost` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_cost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_ticket`
--

DROP TABLE IF EXISTS `course_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_ticket` (
  `ct_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `ct_num` tinyint(4) NOT NULL,
  `ct_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `ct_price` decimal(10,0) NOT NULL,
  `ct_date` date NOT NULL,
  PRIMARY KEY (`ct_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_ticket`
--

LOCK TABLES `course_ticket` WRITE;
/*!40000 ALTER TABLE `course_ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factor`
--

DROP TABLE IF EXISTS `factor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factor` (
  `f_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد ردیف',
  `p_id` int(11) NOT NULL COMMENT 'کد شخص',
  `pr_id` int(11) NOT NULL COMMENT 'کد محصول',
  `f_count` int(11) NOT NULL COMMENT 'تعداد',
  `pr_price` int(11) NOT NULL COMMENT 'مبلغ',
  `f_date` datetime NOT NULL COMMENT 'تاریخ',
  `f_status` int(11) NOT NULL DEFAULT '0' COMMENT 'وضعیت پرداخت',
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=361 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factor`
--

LOCK TABLES `factor` WRITE;
/*!40000 ALTER TABLE `factor` DISABLE KEYS */;
/*!40000 ALTER TABLE `factor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد ردیف',
  `p_id` int(11) NOT NULL COMMENT 'کد شخص',
  `g_type` varchar(25) DEFAULT NULL COMMENT 'نوع ورود',
  `g_count` tinyint(5) NOT NULL DEFAULT '1' COMMENT 'تعداد',
  `g_in` time DEFAULT NULL COMMENT 'ساعت ورود',
  `g_out` time DEFAULT NULL COMMENT 'ساعت خروج',
  `g_date` date NOT NULL COMMENT 'تاریخ ورود',
  `g_total` smallint(6) DEFAULT '0' COMMENT 'جمع دقیقه عادی',
  `g_total_vip` smallint(6) DEFAULT '0' COMMENT 'جمع دقیقه ویژه',
  `g_extra` smallint(6) DEFAULT '0' COMMENT 'جمع دقیقه مازاد',
  `g_total_price` decimal(10,0) DEFAULT '0' COMMENT 'مبلغ عادی',
  `g_total_vip_price` decimal(10,0) DEFAULT '0' COMMENT 'مبلغ ویژه',
  `g_extra_price` decimal(10,0) DEFAULT '0' COMMENT 'مبلغ مازاد',
  `g_used_sharj` smallint(6) DEFAULT '0' COMMENT 'شارژ مصرف شده',
  `g_login_price` decimal(10,0) DEFAULT '0' COMMENT 'مدت مازاد',
  `g_total_shop` decimal(10,0) DEFAULT '0' COMMENT 'جمع فروشگاه',
  `g_offer_code` smallint(6) DEFAULT '0' COMMENT 'کد تخفیف',
  `g_offer_price` decimal(10,0) DEFAULT '0' COMMENT 'مبلغ تخفیف',
  `g_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'وضعیت حضور',
  `g_adjective` text COMMENT 'امانتی ها',
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_meta`
--

DROP TABLE IF EXISTS `game_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_meta` (
  `gm_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد متای بازی',
  `g_id` int(11) NOT NULL COMMENT 'کد بازی',
  `gm_key` varchar(50) NOT NULL COMMENT 'کلید متای بازی',
  `gm_value` varchar(50) NOT NULL COMMENT 'مقدار متای بازی',
  `gm_date` date NOT NULL COMMENT 'تاریخ ثبت',
  `gm_time` time NOT NULL COMMENT 'زمان ثبت',
  `gm_time_end` time DEFAULT NULL COMMENT 'زمان اتمام',
  PRIMARY KEY (`gm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=269 DEFAULT CHARSET=utf8 COMMENT='اطلاعات اضافی بازی';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_meta`
--

LOCK TABLES `game_meta` WRITE;
/*!40000 ALTER TABLE `game_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `game_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan`
--

DROP TABLE IF EXISTS `loan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loan` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `l_fromdate` date DEFAULT NULL,
  `l_fromdetails` text,
  `l_todate` date DEFAULT NULL,
  `l_todetails` text,
  `l_enddate` date DEFAULT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan`
--

LOCK TABLES `loan` WRITE;
/*!40000 ALTER TABLE `loan` DISABLE KEYS */;
/*!40000 ALTER TABLE `loan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_record`
--

DROP TABLE IF EXISTS `login_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_record` (
  `lr_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `lr_time` datetime NOT NULL,
  `lr_ip` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`lr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=396 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_record`
--

LOCK TABLES `login_record` WRITE;
/*!40000 ALTER TABLE `login_record` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offer`
--

DROP TABLE IF EXISTS `offer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offer` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد ردیف',
  `o_code` varchar(15) NOT NULL COMMENT 'کد تخفیف',
  `o_type` varchar(5) NOT NULL COMMENT 'نوع کد',
  `o_per` int(11) NOT NULL COMMENT 'میزان',
  `o_details` text NOT NULL COMMENT 'توضیحات',
  PRIMARY KEY (`o_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offer`
--

LOCK TABLES `offer` WRITE;
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `offer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package`
--

DROP TABLE IF EXISTS `package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package` (
  `pk_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد ردیف',
  `pk_name` varchar(20) NOT NULL COMMENT 'نام بسته',
  `pk_price` int(11) NOT NULL COMMENT 'مبلغ بسته',
  `pk_time` int(11) NOT NULL COMMENT 'زمان به دقیقه',
  `pk_expire` int(11) NOT NULL COMMENT 'اعتبار به روز',
  PRIMARY KEY (`pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package`
--

LOCK TABLES `package` WRITE;
/*!40000 ALTER TABLE `package` DISABLE KEYS */;
/*!40000 ALTER TABLE `package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `pa_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `pa_price` decimal(10,0) NOT NULL DEFAULT '0',
  `pa_date` datetime NOT NULL,
  `pa_details` text NOT NULL,
  `pa_type` varchar(15) NOT NULL,
  PRIMARY KEY (`pa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=826 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_name` varchar(15) DEFAULT NULL COMMENT 'نام',
  `p_family` varchar(15) DEFAULT NULL COMMENT 'نام خانوادگی',
  `p_fname` varchar(15) DEFAULT NULL COMMENT 'نام پدر',
  `p_birth` date DEFAULT NULL COMMENT 'تاریخ تولد',
  `p_code` varchar(15) DEFAULT NULL COMMENT 'کد اشتراک',
  `p_gender` tinyint(1) NOT NULL COMMENT 'جنسیت',
  `p_mobile` varchar(15) DEFAULT NULL COMMENT 'موبایل',
  `p_sharj` smallint(6) DEFAULT '0' COMMENT 'شارژ به دقیقه',
  `p_expire` date DEFAULT NULL COMMENT 'تاریخ انقضا',
  `p_pack` int(3) DEFAULT '0' COMMENT 'بسته',
  `p_regdate` date DEFAULT NULL COMMENT 'تاریخ عضویت',
  `p_commitment` date DEFAULT NULL COMMENT 'تعهدنامه',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4774 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person_meta`
--

DROP TABLE IF EXISTS `person_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person_meta` (
  `pm_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `pm_meta` varchar(255) NOT NULL,
  `pm_value` text NOT NULL,
  PRIMARY KEY (`pm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=538 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person_meta`
--

LOCK TABLES `person_meta` WRITE;
/*!40000 ALTER TABLE `person_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `person_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `pr_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد ردیف',
  `pr_name` varchar(20) NOT NULL COMMENT 'نام کالا',
  `pr_stock` int(11) NOT NULL COMMENT 'موجودی',
  `pr_buy` int(11) NOT NULL COMMENT 'قیمت خرید',
  `pr_sale` int(11) NOT NULL COMMENT 'قیمت فروش',
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) NOT NULL DEFAULT '0',
  `meta_key` varchar(20) NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`ID`, `a_id`, `meta_key`, `meta_value`) VALUES (9,1,'opt_name','خانه بازی وروجک ها'),(10,1,'opt_hour1','8000'),(11,1,'opt_hour2','8000'),(12,1,'save_opt',''),(13,1,'opt_home',''),(14,1,'sms_user','mahdavi1456'),(15,1,'sms_pass','m54692764o'),(16,1,'sms_line','+985000125475'),(25,14,'opt_name','خانه بازی وروجک ها'),(26,14,'opt_home',''),(27,14,'opt_hour1','4000'),(28,14,'opt_hour2','4000'),(29,14,'sms_user','boardland'),(30,14,'sms_pass','123456'),(31,14,'sms_line','+985000125475'),(32,14,'save_opt',''),(33,23,'opt_name','خانه بازی وروجک ها'),(34,23,'opt_home',''),(35,23,'opt_hour1','5000'),(36,23,'opt_hour2','3000'),(37,23,'sms_user',''),(38,23,'sms_pass',''),(39,23,'sms_line','-'),(40,23,'save_opt',''),(41,1,'happy_text','نوگول باغ زندگی \r\nتولدت مبارک\r\nگراتک'),(42,25,'opt_name','خانه بازی وروجک ها'),(43,25,'opt_home',''),(44,25,'sms_user',''),(45,25,'sms_pass',''),(46,25,'sms_line','-'),(47,25,'happy_text','تولدت مبارک'),(48,25,'opt_hour1','5000'),(49,25,'opt_hour2','5000'),(50,25,'save_opt',''),(51,21,'opt_name','خانه بازی وروجک ها'),(52,21,'opt_home',''),(53,21,'sms_user','9122753213'),(54,21,'sms_pass','خئهی30030'),(55,21,'sms_line','+981000152'),(56,21,'happy_text','سلام عزیزم\r\nتولد کوچولوی نازنینت\r\nمبارک\r\n\r\nدلتنگ ش'),(57,21,'opt_hour1','75000'),(58,21,'opt_hour2','60000'),(59,21,'save_opt',''),(60,22,'opt_name','خانه بازی وروجک ها'),(61,22,'opt_home',''),(62,22,'sms_user','9122753213'),(63,22,'sms_pass','0453608167'),(64,22,'sms_line','+985000125475'),(65,22,'happy_text','فرشته كوچولو\r\nروز به دنيا اومدن تو براي همه ما عزیزه،\r\nبه مناسبت تولدت، امروز در خانه بازی بالونیا یک ساعت مهمان ما هستی عزیزم\r\nمنتظرت هستیم'),(66,22,'opt_hour1',''),(67,22,'opt_hour2',''),(68,22,'save_opt',''),(69,29,'opt_name','خانه بازی وروجک ها'),(70,29,'opt_home',''),(71,29,'sms_user','09133933505'),(72,29,'sms_pass','soltani3505'),(73,29,'sms_line','+985000125475'),(74,29,'happy_text','تولدت مبارک\r\nخونه مادربزرگه'),(75,29,'opt_hour1','10000'),(76,29,'opt_hour2','10000'),(77,29,'save_opt',''),(78,33,'opt_name','خانه بازی وروجک ها'),(79,33,'opt_home',''),(80,33,'sms_user',''),(81,33,'sms_pass',''),(82,33,'sms_line','-'),(83,33,'happy_text',''),(84,33,'opt_hour1','8000'),(85,33,'opt_hour2','8000'),(86,33,'save_opt',''),(87,1,'free_time','15'),(88,1,'price_1_to_15','60000'),(89,1,'price_15_to_30','60000'),(90,1,'price_30_to_45','60000'),(91,1,'price_45_to_60','60000'),(92,1,'price_up_60','15000'),(93,29,'free_time','15'),(94,29,'price_1_to_15','2500'),(95,29,'price_15_to_30','5000'),(96,29,'price_30_to_45','7500'),(97,29,'price_45_to_60','10000'),(98,29,'price_up_60','15000'),(99,25,'free_time','15'),(100,25,'price_1_to_15','1200'),(101,25,'price_15_to_30','1100'),(102,25,'price_30_to_45','1000'),(103,25,'price_45_to_60','900'),(104,25,'price_up_60','15000'),(105,29,'part_calc','0'),(106,1,'part_calc','1'),(107,22,'free_time','15'),(108,22,'part_calc','1'),(109,22,'price_1_to_15','60000'),(110,22,'price_15_to_30','60000'),(111,22,'price_30_to_45','60000'),(112,22,'price_45_to_60','60000'),(113,22,'price_up_60','15000'),(114,1,'login_price','15000'),(115,1,'login_deadline','70'),(116,1,'baloon_round','1'),(117,22,'login_price','15000'),(118,22,'login_deadline','70'),(119,22,'baloon_round','1'),(120,29,'login_price','15000'),(121,29,'login_deadline','70'),(122,29,'baloon_round','0'),(123,22,'ppp','30'),(124,22,'price_vip','50000'),(125,15,'opt_name','خانه بازی وروجک ها'),(126,15,'opt_home',''),(127,15,'ppp','30'),(128,15,'sms_user',''),(129,15,'sms_pass',''),(130,15,'sms_line','-'),(131,15,'happy_text',''),(132,15,'free_time','15'),(133,15,'login_price','15000'),(134,15,'login_deadline','70'),(135,15,'part_calc','1'),(136,15,'price_up_60','15000'),(137,15,'price_vip','50000'),(138,15,'baloon_round','0'),(139,15,'save_opt',''),(140,1,'ppp','30'),(141,1,'price_vip','50000'),(142,29,'ppp','30'),(143,29,'price_vip','50000'),(144,1,'opt_address','ساری'),(145,1,'opt_sign','ممنون از اینکه به مجموعه ما سر زدید...'),(146,22,'opt_address','ساری'),(147,22,'opt_sign','ممنون از اینکه به مجموعه ما سر زدید...'),(148,0,'price_down_60','15000'),(149,0,'price_down_vip',''),(150,0,'round_type','quarter'),(151,0,'vip_price_down_60','50000'),(152,0,'vip_price_up_60','120000'),(153,0,'roles','<p>قوانین مجموعه در این قسمت نوشته می شوند</p>');
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_log`
--

DROP TABLE IF EXISTS `sms_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_log` (
  `sl_id` int(11) NOT NULL AUTO_INCREMENT,
  `sl_type` varchar(25) CHARACTER SET utf8 NOT NULL,
  `sl_user` int(11) NOT NULL,
  `sl_date` varchar(16) CHARACTER SET utf8 NOT NULL,
  `sl_line` varchar(17) CHARACTER SET utf8 NOT NULL,
  `sl_bulk` int(15) NOT NULL,
  `sl_rcpts` text CHARACTER SET utf8 NOT NULL,
  `sl_text` longtext CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`sl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_log`
--

LOCK TABLES `sms_log` WRITE;
/*!40000 ALTER TABLE `sms_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد',
  `u_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام',
  `u_family` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام خانوادگی',
  `u_username` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام کاربری',
  `u_password` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'رمز',
  `u_level` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'سطح دسترسی',
  `u_mobile` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'موبایل',
  `u_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_activity`
--

DROP TABLE IF EXISTS `user_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_activity` (
  `ua_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `ua_date` date NOT NULL,
  `ua_in_time` time NOT NULL,
  `ua_out_time` time NOT NULL,
  PRIMARY KEY (`ua_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_activity`
--

LOCK TABLES `user_activity` WRITE;
/*!40000 ALTER TABLE `user_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'helisoft_vorojakhadb'
--

--
-- Dumping routines for database 'helisoft_vorojakhadb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-19 11:56:09
