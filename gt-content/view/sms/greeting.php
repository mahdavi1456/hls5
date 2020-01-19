<?php include"../../../header.php"; ?>
</head>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<?php include "../../../nav.php"; include"../../../menu.php"; ?>
		<div class="content-wrapper">
			<br>
			<div class="col-md-12">
				<?php 
				$db = new database();
				$sms = new sms();
				$pack = new package();
				$opt = new option();
				$prime = new prime();
				if(isset($_POST['send_sms'])){
					$sms_text = $_POST['sms_text'];
					$sms_mobile = $_POST['sms_mobile'];
					$sl_bulk = $sms->send_sms($sms_mobile, $sms_text);
						
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
						$sms->set_log("birthday", $sl_bulk, $sms_mobile, $sms_text);
					?>
						<div class="alert alert-success">پیامک با موفقیت ارسال شد.</div>
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
								<h3 class="card-title">تبریک تولد</h3>
								<div class="card-tools">
									<form action="" method="get">
										<select name="p_birth" onchange="this.form.submit()">
											<option value="<?php echo jdate('-m-d'); ?>">امروز</option>
											<option <?php if(isset($_GET['p_birth']) && $_GET['p_birth'] == '-01-') echo 'selected'; ?> value="-01-">فروردین</option>
											<option <?php if(isset($_GET['p_birth']) && $_GET['p_birth'] == '-02-') echo 'selected'; ?> value="-02-">اردیبهشت</option>
											<option <?php if(isset($_GET['p_birth']) && $_GET['p_birth'] == '-03-') echo 'selected'; ?> value="-03-">خرداد</option>
											<option <?php if(isset($_GET['p_birth']) && $_GET['p_birth'] == '-04-') echo 'selected'; ?> value="-04-">تیر</option>
											<option <?php if(isset($_GET['p_birth']) && $_GET['p_birth'] == '-05-') echo 'selected'; ?> value="-05-">مرداد</option>
											<option <?php if(isset($_GET['p_birth']) && $_GET['p_birth'] == '-06-') echo 'selected'; ?> value="-06-">شهریور</option>
											<option <?php if(isset($_GET['p_birth']) && $_GET['p_birth'] == '-07-') echo 'selected'; ?> value="-07-">مهر</option>
											<option <?php if(isset($_GET['p_birth']) && $_GET['p_birth'] == '-08-') echo 'selected'; ?>value="-08-">آبان</option>
											<option <?php if(isset($_GET['p_birth']) && $_GET['p_birth'] == '-09-') echo 'selected'; ?> value="-09-">آذر</option>
											<option <?php if(isset($_GET['p_birth']) && $_GET['p_birth'] == '-10-') echo 'selected'; ?> value="-10-">دی</option>
											<option <?php if(isset($_GET['p_birth']) && $_GET['p_birth'] == '-11-') echo 'selected'; ?> value="-11-">بهمن</option>
											<option <?php if(isset($_GET['p_birth']) && $_GET['p_birth'] == '-12-') echo 'selected'; ?> value="-12-">اسفند</option>
										</select>
									</form>
								</div>
							</div>
							<div class="card-body table-responsive p-0">		
								<form method="post" action="" class="form" onSubmit="if(!confirm('آیا از ارسال این پیامک اطمینان دارید؟')){return false;}">
									<table class="table table-striped">
										<tr>
											<th>ردیف</th>
											<th>کد عضویت</th>
											<th>نام</th>
											<th>نام خانوادگی</th>
											<th>نام پدر</th>
											<th>تاریخ تولد</th>
											<th>چند روز دیگه؟</th>
											<th>تلفن</th>
											<th>موبایل</th>
											<th>بسته</th>
											<th>تاریخ انقضاء</th>
											<th>شارژ فعلی</th>
											<th>تبریک</th>
										</tr>
										<?php
										$i = 1;
										if(isset($_GET['p_birth'])) {	
											$p_birth = $_GET['p_birth'];
										} else {
											$p_birth = jdate('-m-d');
										}
										$sql = "select * from person where p_birth like '%$p_birth%' order by p_id desc";
										$res = $db->get_select_query($sql);	
										if(count($res) > 0) {
											foreach($res as $row) {
												?>
													<tr>
														<td><?php echo $prime->per_number($i); ?></td>
														<td><?php echo $prime->per_number($row['p_id']); ?></td>
														<td><?php echo $row['p_name']; ?></td>
														<td><?php echo $row['p_family']; ?></td>
														<td><?php echo $row['p_fname']; ?></td>
														<td><?php echo $prime->per_number($row['p_birth']); ?></td>
														<td>
															<?php
															if($birth == $now) {
																echo "<span style='background: lime; color: #fff; padding: 2px 5px;border-radius: 4px;'>امروز</span>";
															} else {
																if($m < $b){
																	echo "<span style='background: blue; color: #fff; padding: 2px 5px;border-radius: 4px;'>" . $prime->per_number($b - $m) . " ماه دیگه</span>";
																} else if($m==$b) {
																	$d = jdate('d');
																	$bd = $sp[2];
																	echo "<span style='background: blue; color: #fff; padding: 2px 5px;border-radius: 4px;'>" . $prime->per_number($d - $bd) . " روز دیگه</span>";
																} else{
																	echo "<span style='background: red; color: #fff; padding: 2px 5px;border-radius: 4px;'>" . $prime->per_number($m - $b) . " ماه پیش</span>";
																}
															}
															?>
														</td>
														<td><?php echo $prime->per_number($row['p_phone']); ?></td>
														<td><?php echo $prime->per_number($row['p_mobile']); ?></td>
														<td><?php echo $pack->get_package_name($row['p_pack']); ?></td>
														<td><?php echo $prime->per_number($row['p_expire']); ?></td>
														<td><?php echo $prime->per_number($row['p_sharj']); ?></td>
														<td>
															<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?php echo $row['p_id']; ?>">ارسال پیامک تبریک</button>
															<div id="myModal<?php echo $row['p_id']; ?>" class="modal fade" role="dialog">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal">&times;</button>
																			<label class="modal-title">متن تبریک</label>
																		</div>
																		<div class="modal-body">
																			<?php
																			$p_mobile = $row['p_mobile'];
																			$sql_last = $db->get_select_query("select * from sms_log where sl_type = 'birthday' and sl_rcpts = '$p_mobile'");
																			if(count($sql_last) > 0) {
																				?>
																				<label>سوابق ارسال</label>
																				<table class="table table-striped">
																					<tr>
																						<th>تاریخ</th>
																						<th>کاربر</th>
																						<th>شماره</th>
																						<th>خط ارسالی</th>
																					</tr>
																				<?php
																				foreach($sql_last as $sl) {
																					?>
																					<tr>
																						<td><?php echo $sl['sl_date']; ?></td>
																						<td><?php echo $sl['sl_user']; ?></td>
																						<td><?php echo $sl['sl_rcpts']; ?></td>
																						<td><?php echo $sl['sl_line']; ?></td>
																					</tr>
																					<tr>
																						<td colspan="4"><?php echo $sl['sl_text']; ?></td>
																					</tr>
																					<?php
																				}
																				?>
																				</table>
																				<hr>
																				<?php
																			}
																			?>
																			
																			<?php $happy_text = $opt->get_option('happy_text'); ?>
																			<form action="" method="post">
																				<label>متن پیام</label>
																				<textarea name="sms_text" rows="5" class="form-control"><?php echo $row['p_name'] . " " . $row['p_family'] . " عزیز \n$happy_text"; ?></textarea>
																				<br>
																				<label>شماره ارسالی</label>
																				<input type="text" name="sms_mobile" class="form-control" value="<?php echo $row['p_mobile']; ?>">
																				<br>
																				<button class="btn btn-success" name="send_sms">ارسال پیامک</button>
																			</form>
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
																		</div>
																	</div>
																</div>
															</div>
														</td>	
													</tr>
													<?php
													$i++;
												}
											} else { ?>
											<tr>
												<td colspan="13" class="text-center">امروز هیچ تولدی نداریم!</td>
											</tr>
											<?php
											} ?>
									</table>
								</form>
							</div>					
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<?php include"../../../footer.php"; ?>	