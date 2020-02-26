<?php include"../../../header.php"; 
$report = new report(); ?>
</head>
<body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
	<?php include "../../../nav.php"; include"../../../menu.php"; ?>

	<div class="content-wrapper">
		<br>
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">گزارش بدهکاران</h3>
						</div>
						<div class="card-body table-responsive p-0">
							<table class="table table-striped">
								<tr>
									<th>#</th>
									<th>نام شخص</th>
									<th>موبایل</th>
									<th>مبلغ بدهکاری</th>
								</tr>
								<?php
								$i = 1;
								$db = new database();
								$prime = new prime();
								$person = new person();
								$total_all = 0;
								$res = $db->get_select_query("select * from person");
								
								if(count($res) > 0) {
									foreach($res as $row) {
										$p_id = $row['p_id'];
										$status = $person->get_person_status($p_id);
										if($status < 0) {
											?>
											<tr>
												<td><?php echo $prime->per_number($i); ?></td>
												<td><?php echo $row['p_name'] . " " . $row['p_family']; ?></td>
												<td><?php echo $prime->per_number($row['p_mobile']); ?></td>
												<td><?php echo $prime->per_number(number_format(str_replace('-','',$status))); ?></td>
											</tr>
											<?php
											$i++;
										}
									}
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