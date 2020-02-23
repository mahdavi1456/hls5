<?php include"../../../header.php"; ?>
</head>
    <body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
    <?php include"../../../nav.php"; include"../../../menu.php"; ?>
    <div class="content-wrapper">
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<?php
									if(isset($_POST['del-fb']))
										{
											$f_id = $_POST['del-fb'];
											$db->ex_query("delete from factor_buy_body where f_id = $f_id");
											$db->ex_query("delete from factor_buy where f_id = $f_id");
											?><br>
											<div class="alert alert-success">
												مورد با موفقیت حذف شد
											</div>
											<script type="text/javascript">
												window.location.reload();
												return;
											</script>
											<?php
										} ?>
								</div>
								<div class="panel panel-success table-responsive">
									<div class="panel-heading">
										<h3 class="panel-title">جدول فاکتورهای خرید</h3>
									</div>
									<table class="table table-striped">
										<tr>
											<th>ردیف</th>
											<th>سرفاکتور</th>
											<th>تامین کننده</th>
											<th>مبلغ پرداختی</th>
											<th>مبلغ تخفیف</th>
											<th>تاریخ خرید</th>
											<th>مدیریت</th>
										</tr>
										<?php
										$db = new database();
										$prime = new prime();
										$person = new person();
										$product = new product();
										$i = 1;
										$list = $db->get_select_query("select * from factor_buy order by f_id desc");
										if(count($list)> 0){
											foreach($list as $l){
												$f_id = $l['f_id']; 
												$list = $db->get_select_query("select * from factor_buy inner join factor_buy_body on factor_buy.f_id = factor_buy_body.f_id");
												$total_price = $db->get_var_query("select sum(total_price) from factor_buy_body where f_id = $f_id"); 
												$fb_discount = $db->get_var_query("select sum(fb_discount) from factor_buy_body where f_id = $f_id");
												$price = $total_price - $fb_discount;
												?>
												<tr>
													<td><?php echo $prime->per_number($i);?></td>
													<td><?php echo $prime->per_number($l['f_id']); ?></td>
													<td><?php echo $person->get_person_name($l['p_id']); ?></td>
													<td><?php echo $prime->per_number(number_format($price)); ?></td>
													<td><?php echo $prime->per_number(number_format($fb_discount)); ?></td>
													<td><?php echo $prime->per_number($l['f_date']); ?></td>
													<td>
														<a class="btn btn-info btn-sm" href="reg-buy.php?f_id=<?php echo $f_id; ?>&edit=1"><i data-toggle="tooltip" title="ویرایش" class="fa fa-edit"></i></a>
														<form class="btn" onSubmit="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" action="" method="post">
															<input type="hidden" name="u_id" value="<?php echo $_SESSION['user_id']; ?>">
															<button name="del-fb" value="<?php echo $l['f_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>
														</form>
													</td>
												</tr>
												<?php
												$i++;
											}
										} else { ?>
											<tr>                   
												<tr><td class="text-center" colspan="9">موردی جهت نمایش موجود نیست</td>
											</tr>
											<?php												
										} ?>
									</table>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
	$('#result').mouseover(function(){
		$('#total_price').val("Loading...");
		var fb_quantity = $('#fb_quantity').val();
		var fb_price = $('#fb_price').val();
		$.post("back1.php", {load_data:1 ,fb_quantity:fb_quantity, fb_price:fb_price}, function(data){
			$('#total_price').val(data);
		});
	});
</script>

<?php include "../../../footer.php"; ?>