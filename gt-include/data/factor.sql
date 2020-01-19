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
  `f_date` varchar(20) NOT NULL COMMENT 'تاریخ',
  `f_status` int(11) NOT NULL DEFAULT '0' COMMENT 'وضعیت پرداخت',
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=415 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;