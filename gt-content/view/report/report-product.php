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
							<h3 class="card-title">گزارش موجودی محصولات</h3>
						</div>
						<div class="card-body table-responsive p-0">
							<table class="table table-striped">
								<tr>
									<th>#</th>
									<th>نام محصول</th>
									<th>موجودی</th>
								</tr>
								<?php
								$i = 1;
								$db = new database();
								$prime = new prime();
								$product = new product();
								$total_all = 0;
								$res = $db->get_select_query("select * from product");
								
								if(count($res) > 0) {
									foreach($res as $row) {
										$pr_id = $row['pr_id'];
										$pr_buy = $db->get_var_query("select sum(fb_quantity) from  factor_buy_body where pr_id = $pr_id");
										$pr_sell = $db->get_var_query("select sum(f_count) from  factor where pr_id = $pr_id");
										$total_all = ($row['pr_stock'] + $pr_buy) - $pr_sell
										?>
										<tr>
											<td><?php echo $prime->per_number($i); ?></td>
											<td><?php echo $prime->per_number($product->get_product_name($row['pr_id'])); ?></td>
											<td><?php echo $prime->per_number(number_format($total_all)); ?></td>
										</tr>
										<?php
										$i++;
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