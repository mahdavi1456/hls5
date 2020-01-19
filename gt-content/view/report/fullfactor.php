<?php include"../../../header.php"; 
$report = new report(); ?>
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
							<?php echo $report->table_fullfactor('1'); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<?php include"../../../footer.php"; ?>