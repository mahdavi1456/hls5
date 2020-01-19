<?php include "header.php"; $a_id = $_SESSION['account_id']; ?>
	<div class="container-fluid">
		<h2>تبریک تولد</h2>
		<hr>
		<form method="post" action="" class="form" onSubmit="if(!confirm('آیا از ارسال این پیامک اطمینان دارید؟')){return false;}">
			<?php
			if(isset($_POST['send_sms'])){
				$sms_text = $_POST['sms_text'];
				$sms_mobile = $_POST['sms_mobile'];
				send_sms($sms_mobile, $sms_text);
				?>
				<div class="alert alert-success">پیامک با موفقیت ارسال شد</div>
				<?php
			}
			?>	
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-warning">
						<div class="panel-heading">لیست تبریکات</div>
						<div class="panel-body table-responsive">
							<table class="table table-success">
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
								$today = jdate('Y-m-d');
								$a_id = $_SESSION['account_id'];
								$sql = "select * from person where a_id = $a_id order by p_birth desc";
								$res = get_select_query($sql);
								if(count($res)>0){
									foreach($res as $row){
										
										$date1 = strtotime($today);  
										$date2 = strtotime($row['p_birth']);  
										// Formulate the Difference between two dates 
										$diff = ($date2 - $date1) / 60 / 60 / 24;  
										
										$sp = explode('-', $row['p_birth']);
										$birth = $sp[1] . "/" . $sp[2];
										$now = jdate('m/d');
										$m = jdate('m');
										$b = $sp[1];
										if($birth == $now){	
										?>
									<tr>
										<td><?php echo per_number($i); ?></td>
										<td><?php echo per_number($row['p_id']); ?></td>
										<td><?php echo $row['p_name']; ?></td>
										<td><?php echo $row['p_family']; ?></td>
										<td><?php echo $row['p_fname']; ?></td>
										<td><?php echo per_number($row['p_birth']); ?></td>
										<td>
											<?php
											
											if($birth==$now){
												echo "<span style='background: lime; color: #fff; padding: 2px 5px;border-radius: 4px;'>امروز</span>";
											}else{
												
												if($m < $b){
													echo "<span style='background: blue; color: #fff; padding: 2px 5px;border-radius: 4px;'>" . per_number($b - $m) . " ماه دیگه</span>";
												} else if($m==$b){
													$d = jdate('d');
													$bd = $sp[2];
													echo "<span style='background: blue; color: #fff; padding: 2px 5px;border-radius: 4px;'>" . per_number($d - $bd) . " روز دیگه</span>";
												} else{
													echo "<span style='background: red; color: #fff; padding: 2px 5px;border-radius: 4px;'>" . per_number($m - $b) . " ماه پیش</span>";
												}
											}
											/*
											if($diff==0){
												echo "امروز";
											} else if($diff<0) {
												echo "<span style='color: red'>" . per_number(abs($diff)) . " روز گذشته </span>";
											} else{
												echo "<span style='color: lime'>" . per_number($diff) . " روز دیگه </span>";
											} */?>
										</td>
										<td><?php echo per_number($row['p_phone']); ?></td>
										<td><?php echo per_number($row['p_mobile']); ?></td>
										<td><?php echo get_package_name($row['p_pack']); ?></td>
										<td><?php echo per_number($row['p_expire']); ?></td>
										<td><?php echo per_number($row['p_sharj']); ?></td>
										<td>
											<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?php echo $row['p_id']; ?>">ارسال پیامک تبریک</button>
											<div id="myModal<?php echo $row['p_id']; ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">متن تبریک</h4>
														</div>
														<div class="modal-body">
															<?php $happy_text = get_option('happy_text'); ?>
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
									}
								} else { ?>
									<tr>
										<td colspan="12" class="text-center">امروز هیچ تولدی نداریم!</td>
									</tr>
								<?php
								} ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
<?php include "footer.php"; ?>