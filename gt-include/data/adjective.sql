--
-- Table structure for table `adjective`
--
DROP TABLE IF EXISTS `adjective`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adjective` (
`ad_id` int(11) NOT NULL AUTO_INCREMENT,
`a_id` int(11) NOT NULL,
`ad_name` varchar(50) NOT NULL,
PRIMARY KEY (`ad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;