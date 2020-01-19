--
-- Table structure for table `payment`
--
DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `pa_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `pa_price` int(11) NOT NULL DEFAULT '0',
  `pa_offer` int(11) NOT NULL DEFAULT '0',
  `pa_date` varchar(20) NOT NULL,
  `pa_details` text NOT NULL,
  `pa_type` varchar(15) NOT NULL,
  `pa_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2766 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;