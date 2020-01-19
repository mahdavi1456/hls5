--
-- Table structure for table `product`
--
DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `pr_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد ردیف',
  `a_id` int(11) NOT NULL DEFAULT '0',
  `pr_name` varchar(20) NOT NULL COMMENT 'نام کالا',
  `pr_stock` int(11) NOT NULL COMMENT 'موجودی',
  `pr_buy` int(11) NOT NULL COMMENT 'قیمت خرید',
  `pr_sale` int(11) NOT NULL COMMENT 'قیمت فروش',
  PRIMARY KEY (`pr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;