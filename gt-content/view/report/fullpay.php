<?php include"../../../header.php"; ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php include "../../../nav.php"; include"../../../menu.php"; ?>

	<div class="content-wrapper">
		<br>
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">گزارش مالی روز <?php if(isset($_GET['pa_from_date'])) { echo "از " . $_GET['pa_from_date'] . " تا " . $_GET['pa_to_date']; } else { echo jdate('Y/m/d'); } ?></h3>
							<div class="card-tools">
								<form action="" method="get">
									<div class="input-group input-group-sm">
										<select name="pa_type">
											<option <?php if(isset($_GET['pa_type']) && $_GET['pa_type'] == 'کارت') echo "selected"; ?>>کارت</option>
											<option <?php if(isset($_GET['pa_type']) && $_GET['pa_type'] == 'نقد') echo "selected"; ?>>نقد</option>
										</select>&nbsp
										&nbsp از: &nbsp
										<input type="text" name="pa_from_date" class="datepicker" value="<?php if(isset($_GET['pa_from_date'])) echo $_GET['pa_from_date']; else echo jdate('Y/m/d'); ?>" placeholder="از تاریخ" autocomplete="off">
										&nbsp تا: &nbsp
										<input type="text" name="pa_to_date" class="datepicker" value="<?php if(isset($_GET['pa_to_date'])) echo $_GET['pa_to_date']; else echo jdate('Y/m/d'); ?>" placeholder="تا تاریخ" autocomplete="off">
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
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<?php include"../../../footer.php"; ?>