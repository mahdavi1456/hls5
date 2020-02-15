<?php include"../../../header.php"; ?>
</head>
<body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
	<?php include "../../../nav.php"; include"../../../menu.php"; ?>
	<div class="content-wrapper">
		<br>
		<div class="col-md-12"></div>
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">گزارشات ارسال پیامک</h3>
							<div class="card-tools"></div>
						</div>
						<div class="card-body table-responsive p-0">
							<table class="table table-striped">
								<tr>
									<th>#</th>
									<th>کاربر</th>
									<th>تاریخ</th>
									<th>متن پیامک</th>
									<th>خط ارسالی</th>
									<th>گیرندگان</th>
									<th>کد بالک</th>
									<th>وضعیت</th>
									<th>گزارشات</th>
								</tr>
								<?php
								$db = new database();
								$pr = new prime();
								$i = 1;
								$res = $db->get_select_query("select * from sms_log order by sl_id desc");
								if(count($res) > 0) {
									foreach($res as $row) { ?>
										<tr>
											<td><?php echo $pr->per_number($i); ?></td>
											<td><?php echo $pr->per_number($row['sl_user']); ?></td>
											<td><?php echo $pr->per_number($row['sl_date']); ?></td>
											<td><?php echo $pr->per_number($row['sl_text']); ?></td>
											<td><?php echo $pr->per_number($row['sl_line']); ?></td>
											<td>
												<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?php echo $i; ?>">مشاهده لیست</button>
												<div id="myModal<?php echo $i; ?>" class="modal fade" role="dialog">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<label class="modal-title">لیست گیرندگان</label>
															</div>
															<div class="modal-body">
																<textarea class="form-control" rows="10" readonly><?php echo $row['sl_rcpts']; ?></textarea>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
															</div>
														</div>
													</div>
												</div>
											</td>
											<td><?php echo $pr->per_number($row['sl_bulk']); ?></td>
											<td>
												<?php $sms = new sms();
												$list = $sms->get_delivery($row['sl_bulk']);
												echo explode(":", json_decode($list)[0])[1];
												?>		
											</td>
											<td><a href="http://ippanel.com" target="_blank" class="btn btn-success btn-sm">سامانه گزارشات</a></td>
										</tr>
										<?php
										$i++;
									}
								} else { ?>
									<tr>
										<td colspan="9" class="text-center">موردی جهت نمایش موجود نیست</td>
									</tr>
								<?php
								} ?>
							</table>	
						</div>					
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<?php include"../../../footer.php"; ?>