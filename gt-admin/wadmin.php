<?php include"header.php"; ?>
	<div class="container-fluid">
		<h2>مدیریت مشترکین</h2>
		<hr>
		<?php
		if(isset($_POST['remove-account'])) {
			$a_id = $_POST['remove-account'];
			$aru = new aru();
			$aru->remove('account', 'a_id', $a_id, 'int');
			?>
			<div class="alert alert-success">حذف با موفقیت انجام شد</div>
			<?php
		}
		if(isset($_POST['update-account'])) {
			$a_id = $_POST['a_id'];
			$a_name = $_POST['a_name'];
			$a_family = $_POST['a_family'];
			$a_center = $_POST['a_center'];
			$a_phone = $_POST['a_phone'];
			$a_mobile = $_POST['a_mobile'];
			$a_city = $_POST['a_city'];
			$a_mellicode = $_POST['a_mellicode'];
			$a_idnumber = $_POST['a_idnumber'];
			$a_postal = $_POST['a_postal'];
			$a_address = $_POST['a_address'];
			$a_email = $_POST['a_email'];
			$a_days = $_POST['a_days'];
			$sql = "update account set a_name = '$a_name', a_family = '$a_family', a_center = '$a_center', a_phone = '$a_phone', a_mobile = '$a_mobile', a_city = '$a_city', a_mellicode = '$a_mellicode', a_idnumber = '$a_idnumber', a_postal = '$a_postal', a_address = '$a_address', a_email = '$a_email', a_days = $a_days where a_id = $a_id";
			ex_query($sql);
			?>
			<div class="alert alert-success">ویرایش اطلاعات با موفقیت انجام شد</div>
			<?php
		}
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h4 class="panel-title">جدول مشترکین</h4>
					</div>
					<table id="myTable" class="table table-striped">
						<tr>
							<td colspan="16">
								<form action="" method="get">
									<label>جستجو بر اساس نام خانوادگی: </label>
									<input type="text" name="s" value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>" style="color: #000;" >
									<button name="search" class="btn btn-success btn-xs">جستجو</button>
									<a href="wadmin.php" class="btn btn-info btn-xs">نمایش همه</button>
								</form>
							</td>
						</tr>
						<tr>
							<th>ردیف</th>
							<th>شماره عضویت</th>
							<th>نام</th>
							<th>نام خانوادگی</th>
							<th>نام مرکز</th>
							<th>تلفن</th>
							<th>موبایل</th>
							<th>شهر</th>
							<th>تاریخ ثبت نام</th>
							<th>اعتبار</th>
							<th>آنلاین</th>
							<th>مدیریت</th>
						</tr>
						<?php
						$k = 1;				
						if(isset($_GET['s'])) {
							$s = $_GET['s'];
							$sql = "select * from account where a_family like '%" . $s . "%' order by a_id desc";
							$res = get_select_query($sql);
						} else {
							$sql = "select * from account order by a_id desc";
							$res = get_select_query($sql);
						}
						$c = count($res);
						if($c > 0){
							foreach($res as $row){
								$a_id = $row['a_id'];
								?>
							<tr>
								<td><?php echo per_number($k); ?></td>
								<td><?php echo per_number($row['a_id']); ?></td>
								<td><?php echo $row['a_name']; ?></td>
								<td><?php echo $row['a_family']; ?></td>
								<td><?php echo $row['a_center']; ?></td>
								<td><?php echo per_number($row['a_phone']); ?></td>
								<td><?php echo per_number($row['a_mobile']); ?></td>
								<td><?php echo per_number($row['a_city']); ?></td>
								<td><?php echo per_number($row['a_date']); ?></td>
								<td><?php echo per_number($row['a_days']); ?></td>
								<td><?php echo per_number(get_var_query("select count(g.g_id) from game g inner join person p on g.p_id = p.p_id where p.a_id = $a_id and g.g_status = 0")); ?></td>
								<td>
									<form onSubmit="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){ return false; }" method="post">
										<button type="button" data-toggle="modal" data-target="#LoginModal<?php echo $row['a_id']; ?>" class="btn btn-info btn-xs">ورودها</button>
										<button type="button" data-toggle="modal" data-target="#UserModal<?php echo $row['a_id']; ?>" class="btn btn-success btn-xs">کاربران</button>
										<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editModal<?php echo $row['a_id']; ?>">ویرایش</button>
										<button type="submit" class="btn btn-danger btn-xs" name="remove-account" value="<?php echo $row['a_id']; ?>">حذف</button>
									</form>
									<div id="editModal<?php echo $row['a_id']; ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">ویرایش</h4>
												</div>	
												<div class="modal-body">
													<form action="" method="post">
														<input name="a_id" type="hidden" value="<?php echo $row['a_id']; ?>" class="form-control">
														<table class="table">
															<tr>
																<th>نام</th>
																<th>نام خانوادگی</th>
																<th>نام مرکز</th>
															</tr>
															<tr>
																<td><input name="a_name" type="text" class="form-control" value="<?php echo $row['a_name']; ?>"></td>
																<td><input name="a_family" type="text" class="form-control" value="<?php echo $row['a_family']; ?>"></td>
																<td><input name="a_center" type="text" class="form-control" value="<?php echo $row['a_center']; ?>"></td>
															</tr>
															<tr>
																<th>تلفن</th>
																<th>موبایل</th>
																<th>شهر</th>
															</tr>
															<tr>
																<td><input name="a_phone" type="text" class="form-control" value="<?php echo $row['a_phone']; ?>"></td>
																<td><input name="a_mobile" type="text" class="form-control" value="<?php echo $row['a_mobile']; ?>"></td>
																<td><input name="a_city" type="text" class="form-control" value="<?php echo $row['a_city']; ?>"></td>
															</tr>
															<tr>
																<th>کد ملی</th>
																<th>شماره شناسنامه</th>
																<th>کد پستی</th>
															</tr>
															<tr>
																<td><input name="a_mellicode" type="text" class="form-control" value="<?php echo $row['a_mellicode']; ?>"></td>
																<td><input name="a_idnumber" type="text" class="form-control" value="<?php echo $row['a_idnumber']; ?>"></td>
																<td><input name="a_postal" type="text" class="form-control" value="<?php echo $row['a_postal']; ?>"></td>
															</tr>
															<tr>
																<th>آدرس</th>
																<th>ایمیل</th>
																<th>اعتبار</th>
															</tr>
															<tr>
																<td><textarea name="a_address" class="form-control"><?php echo $row['a_address']; ?></textarea></td>
																<td><input name="a_email" type="text" class="form-control" value="<?php echo $row['a_email']; ?>"></td>
																<td><input name="a_days" type="text" class="form-control" value="<?php echo $row['a_days']; ?>"></td>	
															</tr>
															<tr>
																<td colspan="3" class="text-center"><button name="update-account" class="btn btn-success">بروزرسانی اطلاعات</button></td>
															</tr>
														</table>
													</form>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
												</div>
											</div>
										</div>
									</div>
										<div id="LoginModal<?php echo $row['a_id']; ?>" class="modal fade" role="dialog">
											<div class="modal-dialog">
												<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">اطلاعات تکمیلی</h4>
												</div>
												<div class="modal-body">												
													<table class="table table-striped">
														<thead>
															<tr>
																<th>ردیف</th>
																<th>کاربر</th>
																<th>زمان</th>
																<th>IP</th>
															</tr>
														</thead>
														<tbody>
														<?php
														$a_id = $row['a_id'];
														$lr_res = get_select_query("select * from login_record lr inner join user u on lr.u_id = u.u_id where u.a_id = $a_id order by lr.lr_id desc limit 10");
														if(count($res) > 0) {
															foreach($lr_res as $lr_row) { ?>
																<tr>
																	<td><?php echo $i; ?></td>
																	<td><?php echo $lr_row['u_id']; ?></td>
																	<td><?php echo $lr_row['lr_time']; ?></td>
																	<td><?php echo $lr_row['lr_ip']; ?></td>
																</tr>
																<?php
																$i++;
															}
														} else { ?>
															<tr><td colspan="4">هیچ ورودی تاکنون برای این اشتراک ثبت نشده</td></tr>
														<?php
														}
														?>
														</tbody>
													</table>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
												</div>
											</div>
										</div>
									</div>
									
									<div id="UserModal<?php echo $row['a_id']; ?>" class="modal fade" role="dialog">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">اطلاعات ورود</h4>
												</div>
												<div class="modal-body">												
													<table class="table table-striped">
														<thead>
															<tr>
																<th>ردیف</th>
																<th>کاربر</th>
																<th>زمان</th>
																<th>IP</th>
															</tr>
														</thead>
														<tbody>
														<?php
														$a_id = $row['a_id'];
														$lr_res = get_select_query("select * from login_record lr inner join user u on lr.u_id = u.u_id where u.a_id = $a_id order by lr.lr_id desc limit 10");
														if(count($res) > 0) {
															foreach($lr_res as $lr_row) { ?>
																<tr>
																	<td><?php echo $i; ?></td>
																	<td><?php echo $lr_row['u_id']; ?></td>
																	<td><?php echo $lr_row['lr_time']; ?></td>
																	<td><?php echo $lr_row['lr_ip']; ?></td>
																</tr>
																<?php
																$i++;
															}
														} else { ?>
															<tr><td colspan="4">هیچ ورودی تاکنون برای این اشتراک ثبت نشده</td></tr>
														<?php
														}
														?>
														</tbody>
													</table>
													
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
							$k++;
							}
						} else { ?>
							<tr><td class="text-center" colspan="11">موردی جهت نمایش موجود نیست</td></tr>
						<?php
						} ?>
					</table>
				</div>
			</div>

		</div>
	</div>
<?php include"footer.php"; ?>