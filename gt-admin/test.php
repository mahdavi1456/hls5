<?php include"header.php"; ?>
<div class="container">
	<textarea class="form-control" style="direction: ltr;" rows="100">
	CREATE TABLE `account` (
		`a_id` int(11) NOT NULL,
		`a_name` varchar(50) NOT NULL,
		`a_family` varchar(50) NOT NULL,
		`a_center` varchar(50) NOT NULL,
		`a_phone` varchar(11) NOT NULL,
		`a_mobile` varchar(11) NOT NULL,
		`a_city` varchar(20) NOT NULL,
		`a_mellicode` varchar(11) DEFAULT NULL,
		`a_idnumber` varchar(11) DEFAULT NULL,
		`a_postal` varchar(25) NOT NULL,
		`a_address` text NOT NULL,
		`a_email` text,
		`a_date` date NOT NULL,
		`a_days` int(11) NOT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	
	-- --------------------------------------------------------
	
	CREATE TABLE `adjective` (
		`ad_id` int(11) NOT NULL,
		`a_id` int(11) NOT NULL,
		`ad_name` varchar(50) NOT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;

	-- --------------------------------------------------------

	CREATE TABLE `book` (
		`b_id` int(11) NOT NULL,
		`a_id` int(11) NOT NULL,
		`b_name` varchar(255) NOT NULL,
		`b_author` varchar(255) NOT NULL,
		`b_publisher` varchar(25) NOT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;

	-- --------------------------------------------------------

	CREATE TABLE `buy_package` (
		`bp_id` int(11) NOT NULL COMMENT 'کد ردیف',
		`p_id` int(11) NOT NULL COMMENT 'کد شخص',
		`pk_id` int(11) NOT NULL COMMENT 'کد بسته',
		`bp_time` float NOT NULL COMMENT 'مدت زمان',
		`bp_expire` varchar(15) NOT NULL COMMENT 'تاریخ انقضا',
		`bp_type` varchar(15) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;

	-- --------------------------------------------------------

	CREATE TABLE `factor` (
		`f_id` int(11) NOT NULL COMMENT 'کد ردیف',
		`p_id` int(11) NOT NULL COMMENT 'کد شخص',
		`pr_id` int(11) NOT NULL COMMENT 'کد محصول',
		`f_count` int(11) NOT NULL COMMENT 'تعداد',
		`pr_price` int(11) NOT NULL COMMENT 'مبلغ',
		`f_date` varchar(20) NOT NULL COMMENT 'تاریخ',
		`f_status` int(11) NOT NULL DEFAULT '0' COMMENT 'وضعیت پرداخت'
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	
	-- --------------------------------------------------------
	
	CREATE TABLE `game` (
		`g_id` int(11) NOT NULL COMMENT 'کد ردیف',
		`p_id` int(11) NOT NULL COMMENT 'کد شخص',
		`g_type` varchar(25) DEFAULT NULL COMMENT 'نوع ورود',
		`g_count` int(11) NOT NULL DEFAULT '1' COMMENT 'تعداد',
		`g_in` varchar(10) DEFAULT NULL COMMENT 'ساعت ورود',
		`g_out` varchar(10) DEFAULT NULL COMMENT 'ساعت خروج',
		`g_date` varchar(15) DEFAULT NULL COMMENT 'تاریخ',
		`g_price` varchar(15) DEFAULT NULL COMMENT 'مبلغ',
		`g_ez` int(11) NOT NULL DEFAULT '0' COMMENT 'مبلغ اضافه',
		`g_status` int(11) NOT NULL DEFAULT '0' COMMENT 'وضعیت حضور',
		`g_adjective` text COMMENT 'امانتی'
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	
	-- --------------------------------------------------------

	CREATE TABLE `game_meta` (
		`gm_id` int(11) NOT NULL COMMENT 'کد متای بازی',
		`g_id` int(11) NOT NULL COMMENT 'کد بازی',
		`gm_key` varchar(50) NOT NULL COMMENT 'کلید متای بازی',
		`gm_value` varchar(50) NOT NULL COMMENT 'مقدار متای بازی',
		`gm_date` date NOT NULL COMMENT 'تاریخ ثبت',
		`gm_time` time NOT NULL COMMENT 'زمان ثبت',
		`gm_time_end` time DEFAULT NULL COMMENT 'زمان اتمام'
	) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='اطلاعات اضافی بازی';

	-- --------------------------------------------------------

	CREATE TABLE `loan` (
		`l_id` int(11) NOT NULL,
		`a_id` int(11) NOT NULL,
		`p_id` int(11) NOT NULL,
		`b_id` int(11) NOT NULL,
		`l_fromdate` date DEFAULT NULL,
		`l_fromdetails` text,
		`l_todate` date DEFAULT NULL,
		`l_todetails` text,
		`l_enddate` date DEFAULT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;

	-- --------------------------------------------------------

	CREATE TABLE `login_record` (
		`lr_id` int(11) NOT NULL,
		`u_id` int(11) NOT NULL,
		`lr_time` datetime NOT NULL,
		`lr_ip` varchar(15) CHARACTER SET utf8 NOT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;

	-- --------------------------------------------------------

	CREATE TABLE `offer` (
		`o_id` int(11) NOT NULL,
		`a_id` int(11) NOT NULL,
		`o_code` varchar(15) NOT NULL,
		`o_type` varchar(5) NOT NULL,
		`o_per` int(11) NOT NULL,
		`o_details` text NOT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;

	-- --------------------------------------------------------

	CREATE TABLE `package` (
		`pk_id` int(11) NOT NULL,
		`a_id` int(11) NOT NULL DEFAULT '0',
		`pk_name` varchar(20) NOT NULL,
		`pk_price` int(11) NOT NULL,
		`pk_time` int(11) NOT NULL,
		`pk_expire` int(11) NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;

	-- --------------------------------------------------------

	CREATE TABLE `payment` (
		`pa_id` int(11) NOT NULL,
		`p_id` int(11) NOT NULL,
		`pa_price` int(11) NOT NULL DEFAULT '0',
		`pa_offer` int(11) NOT NULL DEFAULT '0',
		`pa_date` varchar(20) NOT NULL,
		`pa_details` text NOT NULL,
		`pa_type` varchar(15) NOT NULL,
		`pa_status` tinyint(4) NOT NULL DEFAULT '0'
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;

	-- --------------------------------------------------------

	CREATE TABLE `person` (
		`p_id` int(11) NOT NULL,
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
		`p_commitment` date NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;

	-- --------------------------------------------------------

	CREATE TABLE `person_meta` (
		`pm_id` int(11) NOT NULL,
		`p_id` int(11) NOT NULL,
		`pm_meta` varchar(255) NOT NULL,
		`pm_value` text NOT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;

	-- --------------------------------------------------------

	CREATE TABLE `product` (
		`pr_id` int(11) NOT NULL COMMENT 'کد ردیف',
		`a_id` int(11) NOT NULL DEFAULT '0',
		`pr_name` varchar(20) NOT NULL COMMENT 'نام کالا',
		`pr_stock` int(11) NOT NULL COMMENT 'موجودی',
		`pr_buy` int(11) NOT NULL COMMENT 'قیمت خرید',
		`pr_sale` int(11) NOT NULL COMMENT 'قیمت فروش'
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;

	-- --------------------------------------------------------

	CREATE TABLE `setting` (
		`ID` int(11) NOT NULL,
		`a_id` int(11) NOT NULL DEFAULT '0',
		`meta_key` varchar(20) NOT NULL,
		`meta_value` text NOT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;

	-- --------------------------------------------------------

	CREATE TABLE `sms_log` (
		`sl_id` int(11) NOT NULL,
		`a_id` int(11) NOT NULL,
		`sl_user` int(11) NOT NULL,
		`sl_date` varchar(16) CHARACTER SET utf8 NOT NULL,
		`sl_line` varchar(17) CHARACTER SET utf8 NOT NULL,
		`sl_bulk` int(15) NOT NULL,
		`sl_rcpts` text CHARACTER SET utf8 NOT NULL,
		`sl_text` longtext CHARACTER SET utf8 NOT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=latin1;

	-- --------------------------------------------------------

	CREATE TABLE `user` (
		`u_id` int(11) NOT NULL COMMENT 'کد',
		`a_id` int(11) NOT NULL COMMENT 'کد اکانت',
		`u_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام',
		`u_family` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام خانوادگی',
		`u_username` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'نام کاربری',
		`u_password` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'رمز',
		`u_level` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'سطح دسترسی',
		`u_mobile` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'موبایل'
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	</textarea>
</div>
<?php include"footer.php"; ?>