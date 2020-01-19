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
							<h3 class="card-title">گزارش فاکتور روز <?php if(isset($_GET['f_from_date'])) { echo "از " . $_GET['f_from_date'] . " تا " . $_GET['f_to_date']; } else { echo jdate('Y/m/d'); } ?></h3>
							<div class="card-tools">
								<form action="" method="get">
									<div class="input-group input-group-sm">
										&nbsp از: &nbsp
										<input type="text" name="f_from_date" class="datepicker" value="<?php if(isset($_GET['f_from_date'])) echo $_GET['f_from_date']; else echo jdate('Y/m/d'); ?>" placeholder="از تاریخ" autocomplete="off">
										&nbsp تا: &nbsp
										<input type="text" name="f_to_date" class="datepicker" value="<?php if(isset($_GET['f_to_date'])) echo $_GET['f_to_date']; else echo jdate('Y/m/d'); ?>" placeholder="تا تاریخ" autocomplete="off">
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
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<?php include"../../../footer.php"; ?>