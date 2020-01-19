<?php include"../../../header.php"; 
$report = new report(); ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php include "../../../nav.php"; include"../../../menu.php"; ?>
	<div class="content-wrapper">
		<br>
		<div class="col-md-12">
			<?php
			if(isset($_POST['change-price'])) {
				$g_id = $_POST['g_id'];
				$g_price = $_POST['g_price'];
				$g_ez = $_POST['g_ez'];
				$db->ex_query("update game set g_price = $g_price, g_ez = $g_ez where g_id = $g_id");
				?>
				<div class="alert alert-success">مبلغ با موفقیت ویرایش شد</div>
			<?php
			}
			?>
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
							<?php echo $report->table_fullday('1'); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<?php include"../../../footer.php"; ?>