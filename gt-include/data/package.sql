--
-- Table structure for table `package`
--
DROP TABLE IF EXISTS `package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package` (
  `pk_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) NOT NULL DEFAULT '0',
  `pk_name` varchar(20) NOT NULL,
  `pk_price` int(11) NOT NULL,
  `pk_time` int(11) NOT NULL,
  `pk_expire` int(11) NOT NULL,
  PRIMARY KEY (`pk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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