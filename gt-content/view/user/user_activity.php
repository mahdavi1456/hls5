<?php include"../../../header.php"; ?>
</head>
<body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
	<?php
	include "../../../nav.php"; include"../../../menu.php"; 
	$a_id = $_SESSION['account_id']; ?>

	<div class="content-wrapper">
		<br>
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">گزارش تردد <?php if(isset($_GET['ua_from_date'])) { echo "از " . $_GET['ua_from_date'] . " تا " . $_GET['ua_to_date']; } else { echo jdate('Y/m/d'); } ?></h3>
							<div class="card-tools">
								<form action="" method="get">
									<div class="input-group input-group-sm">
										<select name="u_id">
											<?php
											$db = new database();
											$user = new user();
								
											$res = $db->get_select_query("select * from user where a_id = $a_id", 1);
											if(count($res) > 0) {
												foreach($res as $row) { ?>
											<option value="<?php echo $row['u_id']; ?>" <?php if(isset($_GET['u_id']) && $_GET['u_id'] == $row['u_id']) echo "selected"; ?>><?php echo $user->get_user_name($row['u_id']) . " " . $user->get_user_family($row['u_id']); ?></option>
											<?php
												}
											} ?>
										</select>&nbsp
										&nbsp از: &nbsp
										<input type="text" name="ua_from_date" class="datepicker" value="<?php if(isset($_GET['ua_from_date'])) echo $_GET['ua_from_date']; else echo jdate('Y/m/d'); ?>" placeholder="از تاریخ" autocomplete="off">
										&nbsp تا: &nbsp
										<input type="text" name="ua_to_date" class="datepicker" value="<?php if(isset($_GET['ua_to_date'])) echo $_GET['ua_to_date']; else echo jdate('Y/m/d'); ?>" placeholder="تا تاریخ" autocomplete="off">
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
									<th>جمع حضور</th>
								</tr>
								<?php
								$i = 1;
								$gk = 0;
								$db = new database();
								$prime = new prime();
								$person = new person();
								$gd = new gdate();
								$total = 0;
														
								if(isset($_GET['search'])) {
									$u_id = $prime->eng_number($_GET['u_id']);
									$ua_from_date = $prime->eng_number(str_replace('/', '-', $_GET['ua_from_date']));
									$ua_to_date = $prime->eng_number(str_replace('/', '-', $_GET['ua_to_date']));
									$myDataArray1 = explode('-', $ua_from_date);
									$myYear1 = $myDataArray1[0];
									$mymonth1 = $myDataArray1[1]; 
									$myday1 = $myDataArray1[2];
									$myDataArray2 = explode('-', $ua_to_date);
									$myYear2 = $myDataArray2[0];
									$mymonth2 = $myDataArray2[1]; 
									$myday2 = $myDataArray2[2];
									
									if($mymonth1 < 10){
										$mymonth1 = "0" . $mymonth1;
									}
									if($myday1 < 10){
										$myday1 = "0" . $myday1;
									}
									if($mymonth2 < 10){
										$mymonth2 = "0" . $mymonth2;
									}
									if($myday2 < 10){
										$myday2 = "0" . $myday2;
									}
									$ua_from_date = $myYear1 . "-" . $mymonth1 . "-" . $myday1;
									$ua_to_date = $myYear2 . "-" . $mymonth2 . "-" . $myday2;
									$sql = "select * from user_activity where u_id = $u_id and ua_date between '$ua_from_date' and '$ua_to_date' order by ua_id desc";
								} else {
									$today = jdate('Y-m-d');
									
									$sql = "select * from user_activity where ua_date like '%$today%' order by ua_id desc";
								}
								$res = $db->get_select_query($sql);
								
								if(count($res) > 0) {
									foreach($res as $row) {
										$diff = $gd->new_diff($row['ua_in_time'], $row['ua_out_time']);
										?>
									<tr>
										<td><?php echo $prime->per_number($i); ?></td>
										<td><?php echo $user->get_user_name($row['u_id']) . " " . $user->get_user_family($row['u_id']); ?></td>
										<td><?php echo $prime->per_number($row['ua_date']); ?></td>
										<td><?php echo $prime->per_number($row['ua_in_time']); ?></td>
										<td><?php echo $prime->per_number($row['ua_out_time']); ?></td>
										<td><?php echo $prime->per_number($gd->new_convert_time($diff)); ?></td>
									</tr>
								<?php
									$i++;
									$total += $diff;
								}
								?>
										<tr style="font-size: 20px;">
											<td class="text-center" colspan="6">جمع کل حضور: <?php echo $gd->new_convert_time($total); ?></td>	
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
			</div>
		</section>
	</div>
</div>
<?php include"../../../footer.php"; ?>