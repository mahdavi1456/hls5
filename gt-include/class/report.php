<?php

class report
{
    public function table_fullday($load)
    { ?>
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
		
			if($load == 1){
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
			}
			if($load == 2){
				if(isset($_GET['search'])) {
					$p_id = $_GET['p_id'];
					$sql = "select * from game where p_id = $p_id order by g_id desc";
				} else {
					$today = jdate('Y-m-d');
					$sql = "select * from game where p_id = -1 order by g_id desc";
				}
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
		<?php
		
	}


	 public function table_fullpay($load)
    { ?>
		<table class="table table-striped">
			<tr>
				<th>#</th>
				<th>شخص</th>
				<th>تاریخ و ساعت</th>
				<th>مبلغ</th>
				<th>توضیحات</th>
				<th>نوع پرداخت</th>
			</tr>
			<?php
			$i = 1;
			$gk = 0;
			$db = new database();
			$prime = new prime();
			$person = new person();
			$gd = new gdate();
			$total_all = 0;
			if($load == 1){
				if(isset($_GET['search'])) {
					$pa_type = $_GET['pa_type'];
					$pa_from_date = $prime->eng_number(str_replace('/', '-', $_GET['pa_from_date']));
					$pa_to_date = $prime->eng_number(str_replace('/', '-', $_GET['pa_to_date']));	
					if($pa_from_date == $pa_to_date) {
						$today = $pa_from_date;
						$sql = "select * from payment where pa_type ='$pa_type' and pa_date like '%$today%' order by pa_id desc";
					} else {
						$sql = "select * from payment where pa_type ='$pa_type' and pa_date between '$pa_from_date' and '$pa_to_date' order by pa_id desc";
					}
				} else {
					$today = jdate('Y-m-d');
					$sql = "select * from payment where pa_date like '%$today%' order by pa_id desc";
				}
			}
			if($load == 2){
				if(isset($_GET['search'])) {
					$p_id = $_GET['p_id'];
					$sql = "select * from payment where p_id = $p_id order by pa_id desc";
				} else {
					$sql = "select * from payment where p_id = -1 order by pa_id desc";
				}
			}
			$res = $db->get_select_query($sql);
			
			if(count($res) > 0) {
				foreach($res as $row) { ?>
				<tr>
					<td><?php echo $prime->per_number($i); ?></td>
					<td><a href="<?php //echo get_person_link($p_id); ?>" target="_blank"><?php echo $person->get_person_name($row['p_id']); ?></a></td>
					<td><?php echo $prime->per_number($row['pa_date']); ?></td>
					<td><?php echo $prime->per_number(number_format($row['pa_price'])); ?></td>
					<td><?php echo $row['pa_details']; ?></td>
					<td><?php echo $row['pa_type']; ?></td>
				</tr>
			<?php
				$i++;
				$total_all += $row['pa_price'];
			}
			?>
					<tr style="font-size: 20px;">
						<td class="text-center" colspan="6">جمع مبالغ: <?php echo number_format($total_all); ?></td>	
					</tr>
					<?php
				} else { ?>
					<tr><td class="text-center" colspan="6">موردی جهت نمایش موجود نیست</td></tr>
				<?php
				}	
				?>
		</table>
		<?php
		
	}


	 public function table_fullfactor($load)
    { ?>
		<table class="table table-striped">
			<tr>
				<th>#</th>
				<th>شخص</th>
				<th>محصول</th>
				<th>مبلغ</th>
				<th>تعداد</th>
				<th>تاریخ و ساعت</th>
			</tr>
			<?php
			$i = 1;
			$gk = 0;
			$db = new database();
			$prime = new prime();
			$person = new person();
			$gd = new gdate();
			$pro = new product();
			$total_all = 0;
		
			if($load == 1){
				if(isset($_GET['search'])) {
					$f_from_date = $prime->eng_number(str_replace('/', '-', $_GET['f_from_date']));
					$f_to_date = $prime->eng_number(str_replace('/', '-', $_GET['f_to_date']));
					if($f_from_date == $f_to_date) {
						$today = $f_from_date;
						$sql = "select * from factor where f_date like '%$today%' order by f_id desc";
					} else {
						$sql = "select * from factor where f_date between '$f_from_date' and '$f_to_date' order by f_id desc";
					}
				} else {
					$today = jdate('Y-m-d');
					$sql = "select * from factor where f_date like '%$today%' order by f_id desc";
				}
			}
			if($load == 2){
				if(isset($_GET['search'])) {
					$p_id = $_GET['p_id'];
					$sql = "select * from factor where p_id = $p_id order by f_id desc";
				} else {
					$sql = "select * from factor where p_id = -1 order by f_id desc";
				}
			}
			$res = $db->get_select_query($sql);
			
			if(count($res) > 0) {
				foreach($res as $row) { ?>
				<tr>
					<td><?php echo $prime->per_number($i); ?></td>
					<td><a href="<?php //echo get_person_link($p_id); ?>" target="_blank"><?php echo $person->get_person_name($row['p_id']); ?></a></td>
					<td><?php echo $prime->per_number($pro->get_product_name($row['pr_id'])); ?></td>
					<td><?php echo $prime->per_number(number_format($row['pr_price'])); ?></td>
					<td><?php echo $row['f_count']; ?></td>
					<td><?php echo $row['f_date']; ?></td>
				</tr>
			<?php
				$i++;
				$total_all += $row['pr_price'];
			}
			?>
					<tr style="font-size: 20px;">
						<td class="text-center" colspan="6">جمع مبالغ: <?php echo number_format($total_all); ?></td>	
					</tr>
					<?php
				} else { ?>
					<tr><td class="text-center" colspan="6">موردی جهت نمایش موجود نیست</td></tr>
				<?php
				}	
				?>
		</table>	
		<?php
		
	}
}