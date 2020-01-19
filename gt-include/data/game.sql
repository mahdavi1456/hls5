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
  `g_count` int(11) NOT NULL DEFAULT '1' COMMENT 'تعداد',
  `g_in` varchar(10) DEFAULT NULL COMMENT 'ساعت ورود',
  `g_out` varchar(10) DEFAULT NULL COMMENT 'ساعت خروج',
  `g_date` varchar(15) DEFAULT NULL COMMENT 'تاریخ',
  `g_price` varchar(15) DEFAULT NULL COMMENT 'مبلغ',
  `g_ez` int(11) NOT NULL DEFAULT '0' COMMENT 'مبلغ اضافه',
  `g_status` int(11) NOT NULL DEFAULT '0' COMMENT 'وضعیت حضور',
  `g_adjective` text COMMENT 'امانتی',
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2511 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=4205 DEFAULT CHARSET=utf8 COMMENT='اطلاعات اضافی بازی';
/*!40101 SET character_set_client = @saved_cs_client */;