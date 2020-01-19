<?php include"header.php"; ?>
	<section id="login">
		<div class="container-fluid">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<?php
				$aru = new aru();
				if(isset($_POST['add-account'])){
					$a_id = $aru->add("account", $_POST, 0);

					$u_name = $_POST['a_name'];
					$u_family = $_POST['a_family'];
					$u_username = $_POST['a_mobile'];
					$u_password = rand(1000, 10000);
					$u_level = "مدیر";
					$u_mobile = $_POST['a_mobile'];
					$sql = "insert into user(a_id, u_name, u_family, u_username, u_password, u_level, u_mobile) values($a_id, '$u_name', '$u_family', '$u_username', '$u_password', '$u_level', '$u_mobile')";
					ex_query($sql);
					$theme_url = get_panel_dir();
					$msg = "با تشکر از ثبت نام شما در هلی سافت. \n نام کاربری: $u_username \n رمز ورود: $u_password \n آدرس پنل: $theme_url";
					
					send_sms_super_admin($u_mobile, $msg);
					?>
					<div class="alert alert-success">حساب کاربری شما با موفقیت ایجاد شد. اطلاعات ورود از طریق پیامک برای شما ارسال گردید.</div>
					<?php
					echo "<meta http-equiv='refresh' content='2'/>";
				}
				?>
				<div class="text-center well well-lg">
					<h3>ثبت نام نسخه ۱۴ روزه رایگان</h3>
					<hr>
					<form class="form-horizontal form-simple" method="post" action="" id="myForm">
						<fieldset class="form-group position-relative has-icon-left mb-0">
							<label>نام: <span class="red">*</span></label>
							<input type="text" class="form-control" name="a_name" placeholder="نام شما..." data-required="1">
							<span></span>
							<div class="form-control-position">
								<i class="icon-head"></i>
							</div>
						</fieldset>
						<fieldset class="form-group position-relative has-icon-left mb-0">
							<label>نام خانوادگی: <span class="red">*</span></label>
							<input type="text" class="form-control" name="a_family" placeholder="نام خانوادگی شما..." data-required="1">
							<span></span>
							<div class="form-control-position">
								<i class="icon-head"></i>
							</div>
						</fieldset>
						<fieldset class="form-group position-relative has-icon-left mb-0">
							<label>نام مرکز: <span class="red">*</span></label>
							<input type="text" class="form-control" name="a_center" placeholder="نام گیم نت، کافه بازی یا خانه بازی شما..." data-required="1">
							<span></span>
							<div class="form-control-position">
								<i class="icon-head"></i>
							</div>
						</fieldset>
						<fieldset class="form-group position-relative has-icon-left">
							<label>تلفن ثابت:</label>
							<input type="text" class="form-control" name="a_phone" placeholder="تلفن ثابت شما...">
							<div class="form-control-position">
								<i class="icon-key3"></i>
							</div>
						</fieldset>
						<fieldset class="form-group position-relative has-icon-left">
							<label>موبایل: <span class="red">*</span></label>
							<input type="text" class="form-control" name="a_mobile" placeholder="شماره موبایل شما..." data-required="1">
							<span></span>
							<div class="form-control-position">
								<i class="icon-key3"></i>
							</div>
						</fieldset>
						<fieldset class="form-group position-relative has-icon-left">
							<label>شهر: <span class="red">*</span></label>
							<input type="text" class="form-control" name="a_city" placeholder="نام شهر شما..." data-required="1">
							<span></span>
							<div class="form-control-position">
								<i class="icon-key3"></i>
							</div>
						</fieldset>
						<fieldset class="form-group position-relative has-icon-left">
							<label>آدرس: <span class="red">*</span></label>
							<textarea class="form-control" name="a_address" placeholder="آدرس شما..." data-required="1"></textarea>
							<span></span>
							<div class="form-control-position">
								<i class="icon-key3"></i>
							</div>
						</fieldset>
						<input type="hidden" name="a_date" value="<?php echo date('Y/m/d'); ?>">
						<input type="hidden" name="a_days" value="14">
						<button name="add-account" type="submit" class="btn btn-success btn-lg btn-block"><i class="icon-unlock2"></i>ثبت نام</button>
					</form>
				</div>
			</div>
			<div class="col-md-4">
				
			</div>
		</div>
	</section>
<?php include"footer.php"; ?>