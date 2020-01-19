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
) ENGINE=InnoDB AUTO_INCREMENT=255 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;