<?php include"../../../header.php"; 
 $db = new database(); 
 $report = new report(); ?>
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
							<h3 class="card-title">گزارش حساب اشخاص</h3>
							<div class="card-tools">
								<form action="" method="get">
									<div class="input-group input-group-sm">
										<div id="login-p-name-container" class="col-md-9 text-center">
											<select id="p_id" name="p_id" class="form-control select2">
												<?php
												$res = $db->get_select_query("select p_id, p_name, p_family from person");
												if(count($res) > 0) {
													foreach($res as $row) {
														?>
														<option value="<?php echo $row['p_id']; ?>" <?php if(isset($_GET['p_id']) && $_GET['p_id'] == $row['p_id']) { echo 'selected'; } ?> ><?php echo $row['p_name'] . " " . $row['p_family']; ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
										<div class="input-group-append">
											<button name="search" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div><br>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header bg-info">
										<h3 class="card-title">گزارش ورود</h3>
									</div>
									<div class="card-body p-0">
										<div class="card-body table-responsive p-0">
											<?php echo $report->table_fullday(2); ?>
										</div>
									</div>
									<div class="card-footer">
										
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="card">
									<div class="card-header bg-success">
										<h3 class="card-title">گزارش مالی</h3>
									</div>
									<div class="card-body p-0">
										<div class="card-body table-responsive p-0">
											<?php
											echo $report->table_fullpay(2); ?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="card">
									<div class="card-header bg-warning">
										<h3 class="card-title">گزارش فاکتور</h3>
									</div>
									<div class="card-body p-0">
										<div class="card-body table-responsive p-0">
											<?php echo $report->table_fullfactor('2'); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<?php include"../../../footer.php"; ?>