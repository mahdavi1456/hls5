--
-- Table structure for table `sms_log`
--
DROP TABLE IF EXISTS `sms_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_log` (
`sl_id` int(11) NOT NULL AUTO_INCREMENT,
`a_id` int(11) NOT NULL,
`sl_user` int(11) NOT NULL,
`sl_date` varchar(16) CHARACTER SET utf8 NOT NULL,
`sl_line` varchar(17) CHARACTER SET utf8 NOT NULL,
`sl_bulk` int(15) NOT NULL,
`sl_rcpts` text CHARACTER SET utf8 NOT NULL,
`sl_text` longtext CHARACTER SET utf8 NOT NULL,
PRIMARY KEY (`sl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;