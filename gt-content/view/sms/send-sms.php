<?php include"../../../header.php"; ?>
</head>
<body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
	<?php include "../../../nav.php"; include"../../../menu.php"; ?>
	<div class="content-wrapper">
		<br>
		<div class="col-md-12">
			<?php
			$opt = new option();
			$db = new database();
			if(isset($_POST['send_sms'])) {
				$sms = new sms();
				if($_POST['send_type'] != "-") {
					$sms_text = $_POST['sms_text'];	
					$sl_type = "bulk";
					$sl_user = $_SESSION['user_id'];
					$sl_date = jdate('Y/m/d H:i');
					$sl_line = $opt->get_option('sms_line');
					$sl_text = $sms_text;
				
					if($_POST['send_type'] == 0) {
						$sl_rcpts = $_POST['rcpts0'];
						$sl_bulk = $sms->send_sms1($sms_text, $sl_rcpts);
					} else if($_POST['send_type'] == 1) {
						$sl_rcpts = $_POST['rcpts1'];
						$sl_bulk = $sms->send_sms1($sms_text, $sl_rcpts);
					} else if($_POST['send_type'] == 2) {
						$sl_rcpts = $_POST['rcpts2'];
						$sl_bulk = $sms->send_sms1($sms_text, $sl_rcpts);
					} else if($_POST['send_type'] == "boys"){
						$sl_rcpts = $_POST['rcpts-boys'];
						$sl_bulk = $sms->send_sms1($sms_text, $sl_rcpts);
					} else if($_POST['send_type'] == "girls"){
						$sl_rcpts = $_POST['rcpts-girls'];
						$sl_bulk = $sms->send_sms1($sms_text, $sl_rcpts);
					}
					
					if($sl_bulk == "the username or password is incorrect") {
						?>
						<div class="alert alert-danger">تنظیمات پیامک اشتباه وارد شده است. لطفا از قسمت تنظیمات، نام کاربری و رمز پنل پیامک خود را تنظیم نمایید.</div>
						<?php
					} else if($sl_bulk == "credit not enough") {
						?>
						<div class="alert alert-danger">شارژ پنل پیامک شما برای انجام این ارسال کافی نمی باشد. لطفا جهت افزایش شارژ به پنل سامانه مراجعه نمایید.</div>
						<?php
					} else if($sl_bulk == "number not assign") {
						?>
						<div class="alert alert-danger">پنل شما مجوز ارسال با این خط را ندارد. لطفا با پشتیبان سیستم در تماس باشید یا خط دیگری جهت ارسال انتخاب کنید.</div>
						<?php
					} else {
						$sms->set_log("bulk", $sl_bulk, $sl_rcpts, $sms_text);
						?>
						<div class="alert alert-success">پیامک با موفقیت ارسال شد.</div>
						<?php
					}
					
				} else { ?>
					<div class="alert alert-danger">لطفا مخاطبین دریافت پیامک را انتخاب کنید</div>
					<?php
				}
			}
			?>
		</div>
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">ارسال پیامک</h3>
							<div class="card-tools"></div>
						</div>
						<div class="card-body table-responsive">
							<form method="post" action="" class="form" onSubmit="if(!confirm('آیا از ارسال این پیامک اطمینان دارید؟')){return false;}">
				
								<div class="row">
									<div class="col-md-3">
										<label>نوع مخاطبین</label>
										<select id="send-type" name="send_type" class="form-control">
											<option value="-">انتخاب گیرندگان</option>
											<option value="0">همه مشتریان</option>
											<option value="1">یک مشتری خاص</option>
											<option value="boys">فقط پسران</option>
											<option value="girls">فقط دختران</option>
											<option value="2">شماره دلخواه</option>
										</select>
									</div>					
									<div class="col-md-9">
										<label>گیرندگان</label>									
										<div class="p-alt" id="p-1">
											<?php
											$list = $db->get_select_query("select p_mobile from person");
											$rcpt_nm = array();
											foreach($list as $l) {
												if($l['p_mobile']!="") {
													array_push($rcpt_nm, $l['p_mobile']);
												}
											}
											?>
											<textarea rows="3" class="form-control" name="rcpts0" id="rcpts"><?php echo implode(",", $rcpt_nm); ?></textarea>
											<label class="red" id="rcpts-num"><?php echo "تعداد شماره ها: " . count($rcpt_nm); ?></label>		
										</div>								
										<div class="p-alt" id="p-2">
											<select style="width: 100%" name="rcpts1" class="select2 form-control">
												<?php
												$items = $db->get_select_query("select * from person");
												foreach($items as $item){ ?>
												<option value="<?php echo $item['p_mobile']; ?>"><?php echo $item['p_name'] . " " . $item['p_family']; ?></option>
												<?php
												} ?>
											</select>
										</div>								
										<div class="p-alt" id="p-3">
											<input type="text" name="rcpts2" class="form-control" placeholder="لطفا شماره های مورد نظر را به ترتیب وارد کنید و با , آن ها را جدا کنید">
										</div>
										<div class="p-alt" id="p-boys">
											<?php
											$list = $db->get_select_query("select p_mobile from person where p_gender = 1");
											$rcpt_nm = array();
											foreach($list as $l) {
												if($l['p_mobile']!="") {
													array_push($rcpt_nm, $l['p_mobile']);
												}
											}
											?>
											<textarea rows="3" class="form-control" name="rcpts-boys"><?php echo implode(",", $rcpt_nm); ?></textarea>
											<label class="red"><?php echo "تعداد شماره ها: " . count($rcpt_nm); ?></label>		
										</div>
										<div class="p-alt" id="p-girls">
											<?php
											$list = $db->get_select_query("select p_mobile from person where p_gender = 0");
											$rcpt_nm = array();
											foreach($list as $l) {
												if($l['p_mobile']!="") {
													array_push($rcpt_nm, $l['p_mobile']);
												}
											}
											?>
											<textarea rows="3" class="form-control" name="rcpts-girls"><?php echo implode(",", $rcpt_nm); ?></textarea>
											<label class="red"><?php echo "تعداد شماره ها: " . count($rcpt_nm); ?></label>		
										</div>
									</div>
								</div><br>
								<div class="row card card-info">
									<div class="card-header">متن پیامک</div>
									<div class="card-body">
										<textarea rows="5" id="sms_text" name="sms_text" value="" class="form-control" placeholder="متن پیامک..."></textarea>
									</div>
									<div class="card-footer">
										تعداد پیامک: <label class="red" id="sms_page"></label>
										تعداد کاراکتر باقی مانده تا پیام بعدی: <label class="red" id="sms_size">70</label>
									</div>
								</div>									
								<div class="row">
									<div class="col-md-12 text-center">
										<button name="send_sms" class="btn btn-info btn-lg">ارسال پیام</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<?php include"../../../footer.php"; ?>