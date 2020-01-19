<?php session_start(); include "header.php"; ?>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		
		<?php include "nav.php"; include "menu.php"; ?>
		
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<br>
			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<?php
						$db = new database();
						$pr = new prime();
							
						$res = $db->get_accounts();
						if(count($res) > 0) {
						foreach($res as $row) {
							?>
						<div class="col-lg-3">
							<div class="card">
								<div class="card-header no-border">
									<div class="d-flex justify-content-between">
										<h3 class="card-title"># <?php echo $row['a_id']; ?></h3>
										<a href="javascript:void(0);">مشاهده گزارش</a>
									</div>
								</div>
								<div class="card-body">
									<div class="d-flex">
										<p class="d-flex flex-column">
											<span class="text-bold text-lg"><?php echo $row['a_center']; ?></span>
											<span><?php echo $row['a_name'] . " " . $row['a_family']; ?></span>
										</p>
										<p class="mr-auto d-flex flex-column text-right">
											<span class="text-success">
												<i class="fa fa-arrow-up"></i> <?php echo $row['a_phone']; ?>
											</span>
											<span class="text-muted"><?php echo $row['a_mobile']; ?></span>
										</p>
									</div>
									<div class="d-flex flex-row text-right">
										<span>
											<?php echo $row['a_city'] . " | " . $row['a_address']; ?>
										</span>
									</div><hr>
									<div class="">
										<span><?php echo $row['a_date']; ?></span>
										<span style="float: left;"><?php echo $row['a_days']; ?></span>
									</div>
									<hr>
									<div class="text-center">
										<pre class="btn-warning"><?php echo $row['a_username']; ?></pre>
										<pre class="btn-warning"><?php echo $row['a_password']; ?></pre>
										<pre class="btn-info"><?php echo $row['a_db_name']; ?></pre>
										<pre class="btn-info"><?php echo $row['a_db_user']; ?></pre>
										<pre class="btn-info"><?php echo $row['a_db_password']; ?></pre>
									</div>
								</div>
							</div>
						</div>
						<?php
							}
						} ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include"footer.php"; ?>