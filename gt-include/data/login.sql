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
) ENGINE=MyISAM AUTO_INCREMENT=1439 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;