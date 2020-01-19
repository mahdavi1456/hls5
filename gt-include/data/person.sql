--
-- Table structure for table `person`
--
DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) NOT NULL DEFAULT '0',
  `p_name` varchar(15) DEFAULT NULL,
  `p_family` varchar(15) DEFAULT NULL,
  `p_fname` varchar(15) DEFAULT NULL,
  `p_birth` date DEFAULT NULL COMMENT 'تاریخ تولد',
  `p_code` varchar(15) DEFAULT NULL,
  `p_phone` varchar(15) DEFAULT NULL,
  `p_mobile` varchar(15) DEFAULT NULL,
  `p_address` text,
  `p_sharj` int(11) DEFAULT '0',
  `p_expire` varchar(15) DEFAULT NULL,
  `p_pack` int(11) NOT NULL,
  `p_regdate` date DEFAULT NULL,
  `p_commitment` date NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4696 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=MyISAM AUTO_INCREMENT=456 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;