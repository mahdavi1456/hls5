--
-- Table structure for table `user`
--
DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
`u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'کد',
`a_id` int(11) NOT NULL COMMENT 'کد اکانت',
`u_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام',
`u_family` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام خانوادگی',
`u_username` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام کاربری',
`u_password` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'رمز',
`u_level` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'سطح دسترسی',
`u_mobile` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'موبایل',
PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;