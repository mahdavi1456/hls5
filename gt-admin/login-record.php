<?php include"header.php"; ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php include "nav.php"; include"menu.php"; ?>
	<div class="content-wrapper">
		<br>
		<div class="col-md-12">
		</div>
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">سوابق ورود <?php if(isset($_GET['g_from_date'])) { echo "از " . $_GET['g_from_date'] . " تا " . $_GET['g_to_date']; } else { echo jdate('Y/m/d'); } ?></h3>
							<div class="card-tools">
								<form action="" method="get">
									<div class="input-group input-group-sm">
										<select name="g_type">
											<option <?php if(isset($_GET['g_type']) && $_GET['g_type'] == 'خانه بازی') echo "selected"; ?>>خانه بازی</option>
											<option <?php if(isset($_GET['g_type']) && $_GET['g_type'] == 'کافی نت') echo "selected"; ?>>کافی نت</option>
											<option <?php if(isset($_GET['g_type']) && $_GET['g_type'] == 'مهدکودک ساعتی') echo "selected"; ?>>مهدکودک ساعتی</option>
										</select>&nbsp
										&nbsp از: &nbsp
										<input type="text" name="g_from_date" class="datepicker" value="<?php if(isset($_GET['g_from_date'])) echo $_GET['g_from_date']; else echo jdate('Y/m/d'); ?>" placeholder="از تاریخ" autocomplete="off">
										&nbsp تا: &nbsp
										<input type="text" name="g_to_date" class="datepicker" value="<?php if(isset($_GET['g_to_date'])) echo $_GET['g_to_date']; else echo jdate('Y/m/d'); ?>" placeholder="تا تاریخ" autocomplete="off">
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
									<th>کد اشتراک</th>
									<th>نام کاربری</th>
									<th>رمز</th>
									<th>تاریخ و ساعت</th>
									<th>آی پی</th>
								</tr>
								<?php
								$i = 1;
								$gk = 0;
								$db = new database();
								$prime = new prime();
								$total_all = 0;
							
							
								if(isset($_GET['search'])) {
									$g_type = $_GET['g_type'];
									$g_from_date = $prime->eng_number(str_replace('/', '-', $_GET['g_from_date']));
									$g_to_date = $prime->eng_number(str_replace('/', '-', $_GET['g_to_date']));
									if($g_from_date == $g_to_date) {
										$today = $g_from_date;
										$sql = "select * from login_record where lr_time like '%$today%' order by lr_id desc";
									} else {
										$sql = "select * from login_record where lr_time between '$g_from_date' and '$g_to_date' order by lr_id desc";
									}
								} else {
									$today = jdate('Y-m-d');
									$sql = "select * from login_record where lr_time like '%$today%' order by lr_id desc";
								}
								$res = $db->get_select_query($sql, 1);
								
								if(count($res) > 0) {
									foreach($res as $row) { ?>
									<tr>
										<td><?php echo $prime->per_number($i); ?></td>
										<td><?php echo $row['a_id']; ?></td>
										<td><?php echo $row['lr_user']; ?></td>
										<td><?php echo $row['lr_pass']; ?></td>
										<td><?php echo $row['lr_time']; ?></td>
										<td><?php echo $row['lr_ip']; ?></td>
									</tr>
									<?php
									$i++;
									}
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
<?php include"footer.php"; ?>