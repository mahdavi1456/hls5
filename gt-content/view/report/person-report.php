<?php include"../../../header.php"; ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php include "../../../nav.php"; include"../../../menu.php"; ?>
	<div class="content-wrapper">
		<br>
		<div class="col-md-12">
			
		</div>
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">گزارش جامع روز <?php if(isset($_GET['g_from_date'])) { echo "از " . $_GET['g_from_date'] . " تا " . $_GET['g_to_date']; } else { echo jdate('Y/m/d'); } ?></h3>
							<div class="card-tools">
								<form action="" method="get">
									<div class="input-group input-group-sm">
										<select name="g_type">
											<option <?php if(isset($_GET['g_type']) && $_GET['g_type'] == 'خانه بازی') echo "selected"; ?>>خانه بازی</option>
											<option <?php if(isset($_GET['g_type']) && $_GET['g_type'] == 'کافی نت') echo "selected"; ?>>کافی نت</option>
											<option <?php if(isset($_GET['g_type']) && $_GET['g_type'] == 'مهدکودک ساعتی') echo "selected"; ?>>مهدکودک ساعتی</option>
										</select>
										<div class="input-group-append">
											<button name="search" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="card-body table-responsive p-0">
							<table class="table table-striped">
								<tr>
									<th>#</th>
									<th>شخص</th>
									<th>تاریخ</th>
									<th>ورود</th>
									<th>خروج</th>
									<th>ساعت عادی</th>
									<th>مبلغ عادی</th>
									<th>ساعت VIP</th>
									<th>مبلغ VIP</th>
									<th>ساعت مازاد</th>
									<th>مبلغ مازاد</th>
									<th>ورودی</th>
									<th>شارژ</th>
									<th>فروشگاه</th>
									<th>تخفیف</th>
									<th>جزئیات</th>
								</tr>
								<?php
								$i = 1;
								$gk = 0;
								$db = new database();
								$prime = new prime();
								$person = new person();
								$gd = new gdate();
								$total_all = 0;
							
							
								if(isset($_GET['search'])) {
									$g_type = $_GET['g_type'];
									$g_from_date = $prime->eng_number(str_replace('/', '-', $_GET['g_from_date']));
									$g_to_date = $prime->eng_number(str_replace('/', '-', $_GET['g_to_date']));
									if($g_from_date == $g_to_date) {
										$today = $g_from_date;
										$sql = "select * from game where g_date like '%$today%' and g_status = 1 order by g_id desc";
									} else {
										$sql = "select * from game where g_type ='$g_type' and g_date between '$g_from_date' and '$g_to_date' and g_status = 1 order by g_id desc";
									}
								} else {
									$today = jdate('Y-m-d');
									$sql = "select * from game where g_date like '%$today%' and g_status = 1 order by g_id desc";
								}
								$res = $db->get_select_query($sql);
								
								if(count($res) > 0) {
									foreach($res as $row) { ?>
									<tr>
										<td><?php echo $prime->per_number($i); ?></td>
										<td><a href="<?php //echo get_person_link($p_id); ?>" target="_blank"><?php echo $person->get_person_name($row['p_id']); ?></a></td>
										<td><?php echo $prime->per_number($row['g_date']); ?></td>
										<td><?php echo $prime->per_number($row['g_in']); ?></td>
										<td><?php echo $prime->per_number($row['g_out']); ?></td>
										<td><?php echo $gd->convert_min_to_hour($row['g_total']); ?></td>
										<td><?php echo $prime->per_number(number_format($row['g_total_price'])); ?></td>
										<td><?php echo $gd->convert_min_to_hour($row['g_total_vip']); ?></td>
										<td><?php echo $prime->per_number(number_format($row['g_total_vip_price'])); ?></td>
										<td><?php echo $gd->convert_min_to_hour($row['g_extra']); ?></td>
										<td><?php echo $prime->per_number(number_format($row['g_extra_price'])); ?></td>
										<td><?php echo $prime->per_number(number_format($row['g_login_price'])); ?></td>
										<td><?php echo $gd->convert_min_to_hour($row['g_used_sharj']); ?></td>
										<td><?php echo $prime->per_number(number_format($row['g_total_shop'])); ?></td>
										<td><?php echo $prime->per_number(number_format($row['g_offer_price'])); ?></td>
										<td>
											<button type="button" data-toggle="modal" data-target="#showGameMeta<?php echo $i; ?>" class="btn btn-info btn-sm"><i class="fa fa-list"></i></button>
											<div id="showGameMeta<?php echo $i; ?>" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<label class="modal-title">جزئیات</label>
														</div>
														<div class="modal-body text-center">
															<table class="table">
																<tr>
																	<th class="text-center">ردیف</th>
																	<th class="text-center">شروع</th>
																	<th class="text-center">پایان</th>
																	<th class="text-center">مدت زمان</th>
																	<th class="text-center">تعداد</th>
																	<th class="text-center">وضعیت</th>
																</tr>
																<?php
																$g_id = $row['g_id'];
																$j = 1;
																$total = 0;
																$total_vip = 0;
																$res_gm = $db->get_select_query("select * from game_meta where g_id = $g_id");
																if(count($res_gm) > 0) {
																	foreach ($res_gm as $row2) { ?>
																	<tr>
																		<td><?php echo $prime->per_number($j); ?></td>
																		<td><?php echo $prime->per_number($row2['gm_time']); ?></td>
																		<td><?php echo $prime->per_number($row2['gm_time_end']); ?></td>
																		<td>
																			<?php
																			$diff = ($gd->new_diff($row2['gm_time'], $row2['gm_time_end'])) * $row2['gm_value'];
																			if ($row2['gm_key'] != "pause" && $row2['gm_key'] != "vip") {
																				$total += $gd->convert_per_to_min($diff);
																			}
																			if ($row2['gm_key'] == "vip") {
																				$total_vip += $gd->convert_per_to_min($diff);
																			}
																			echo $prime->per_number($gd->new_convert_time($diff));
																			?>
																		</td>
																		<td><?php echo $prime->per_number($row2['gm_value']); ?></td>
																		<td>
																			<?php
																			if ($row2['gm_key'] == "count") {
																				echo "تعداد";
																			}
																			if ($row2['gm_key'] == "pause") {
																				echo "توقف";
																			}
																			if ($row2['gm_key'] == "play") {
																				echo "ادامه";
																			}
																			if ($row2['gm_key'] == "vip") {
																				echo "ویژه";
																			}
																			?>
																		</td>
																	</tr>
																	<?php
																	$j++;
																	}
																}
																?>
															<tr>
																<th class="text-center">جمع ساعت: </th>
																<th colspan="2" class="text-center"><?php echo $gd->convert_min_to_hour($total); ?></th>
																<th class="text-center">جمع ویژه:</th>
																<th colspan="2" class="text-center"><?php echo $gd->convert_min_to_hour($total_vip); ?></th>
															</tr>
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
									$i++;
									$total_all += $row['g_total_price'] + $row['g_total_vip_price'] + $row['g_extra_price'] + $row['g_login_price'] + $row['g_total_shop'] - $row['g_offer_price'];
								}
								?>
										<tr style="font-size: 20px;">
											<td class="text-center" colspan="17">جمع مبالغ: <?php echo number_format($total_all); ?></td>	
										</tr>
										<?php
									} else { ?>
										<tr><td class="text-center" colspan="17">موردی جهت نمایش موجود نیست</td></tr>
									<?php
									}	
									?>
							</table>	
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<?php include"../../../footer.php"; ?>